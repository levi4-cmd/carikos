<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    // Menampilkan daftar kos untuk pencari
    public function index(Request $request)
    {
        $query = Kos::with([
            'photos' => function ($q) {
                $q->orderByDesc('is_primary')
                  ->orderBy('id');
            }
        ]);

        if ($request->filled('lokasi')) {
            $kata = trim($request->input('lokasi'));

            $query->where(function ($q) use ($kata) {
                $q->where('name', 'like', "%{$kata}%")
                  ->orWhere('address', 'like', "%{$kata}%");
            });
        }

        if ($request->filled('tipe')) {
            $query->where('type', $request->input('tipe'));
        }

        if (is_numeric($request->input('min_harga'))) {
            $query->where(
                'harga_mulai',
                '>=',
                (int) $request->input('min_harga')
            );
        }

        if (is_numeric($request->input('max_harga'))) {
            $query->where(
                'harga_mulai',
                '<=',
                (int) $request->input('max_harga')
            );
        }

        if ($request->input('urut') === 'rating') {
            $query->orderByRaw('rating IS NULL')
                  ->orderByDesc('rating')
                  ->orderByDesc('reviews');
        } else {
            $query->orderBy('name');
        }

        return view('kos.index', [
            'kos' => $query->get(),
            'total' => Kos::count(),
        ]);
    }

    // Menampilkan detail kos beserta foto
    public function show($id)
    {
        $kos = Kos::with([
            'photos' => function ($q) {
                $q->orderByDesc('is_primary')
                  ->orderBy('id');
            }
        ])->findOrFail($id);

        $nearby = collect();

        if ($kos->lat !== null && $kos->lng !== null) {
            $nearby = Kos::where('id', '!=', $kos->id)
                ->whereNotNull('lat')
                ->whereNotNull('lng')
                ->orderByRaw(
                    '((lat - ?) * (lat - ?)) + ((lng - ?) * (lng - ?))',
                    [$kos->lat, $kos->lat, $kos->lng, $kos->lng]
                )
                ->limit(3)
                ->get();
        }

        return view('kos.detail', compact('kos', 'nearby'));
    }

    // Form tambah kos
    public function create()
    {
        abort_unless(auth()->user()->role === 'pemilik', 403);

        return view('kos.create');
    }

    // Menyimpan kos baru beserta foto
    public function store(Request $request)
    {
        abort_unless($request->user()->role === 'pemilik', 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Putri,Putra,Campur,Kontrakan'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
            'facilities' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'maps_url' => ['nullable', 'url', 'max:2000'],
            'harga_mulai' => ['nullable', 'integer', 'min:0'],

            'photos' => ['nullable', 'array', 'max:10'],
            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Pisahkan foto dari data kos
        unset($validated['photos']);

        // Simpan informasi kos
        $kos = $request->user()->kos()->create($validated);

        // Simpan foto
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('kos-photos', 'public');

                $kos->photos()->create([
                    'photo_path' => $path,
                    'caption' => null,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()
            ->route('kos.index')
            ->with('success', 'Kos dan foto berhasil ditambahkan!');
    }

    // Menampilkan daftar kos milik pemilik yang login
    public function myKos(Request $request)
    {
        abort_unless($request->user()->role === 'pemilik', 403);

        $kos = $request->user()->kos()
            ->with('photos')
            ->latest()
            ->get();

        return view('kos.mine', compact('kos'));
    }

    // Form edit kos
    public function edit(Request $request, $id)
    {
        abort_unless($request->user()->role === 'pemilik', 403);

        $kos = $request->user()->kos()
            ->with([
                'photos' => function ($q) {
                    $q->orderByDesc('is_primary')
                      ->orderBy('id');
                }
            ])
            ->findOrFail($id);

        return view('kos.edit', compact('kos'));
    }

    // Memperbarui informasi kos dan menambahkan foto baru
    public function update(Request $request, $id)
    {
        abort_unless($request->user()->role === 'pemilik', 403);

        $kos = $request->user()->kos()->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Putri,Putra,Campur,Kontrakan'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
            'facilities' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'maps_url' => ['nullable', 'url', 'max:2000'],
            'harga_mulai' => ['nullable', 'integer', 'min:0'],

            'photos' => ['nullable', 'array', 'max:10'],
            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Ambil foto baru sebelum menghapus dari data validasi
        $newPhotos = $request->file('photos', []);

        unset($validated['photos']);

        // Perbarui informasi kos
        $kos->update($validated);

        // Simpan foto tambahan
        if (!empty($newPhotos)) {
            $hasPrimary = $kos->photos()
                ->where('is_primary', true)
                ->exists();

            foreach ($newPhotos as $index => $photo) {
                $path = $photo->store('kos-photos', 'public');

                $kos->photos()->create([
                    'photo_path' => $path,
                    'caption' => null,
                    'is_primary' => !$hasPrimary && $index === 0,
                ]);
            }
        }

        return redirect()
            ->route('pemilik.kos.edit', $kos->id)
            ->with('success', 'Informasi dan foto kos berhasil diperbarui!');
    }

    // Menghapus satu foto tertentu dari kos
    public function destroyPhoto(Request $request, $id, $photoId)
    {
        abort_unless($request->user()->role === 'pemilik', 403);

        // Pastikan kos adalah milik pemilik yang login
        $kos = $request->user()->kos()->findOrFail($id);

        // Pastikan foto termasuk dalam kos tersebut
        $photo = $kos->photos()->findOrFail($photoId);

        $wasPrimary = $photo->is_primary;

        // Hapus file foto
        Storage::disk('public')->delete($photo->photo_path);

        // Hapus data foto
        $photo->delete();

        // Jika foto utama dihapus, pilih foto lain sebagai foto utama
        if ($wasPrimary) {
            $nextPhoto = $kos->photos()->orderBy('id')->first();

            if ($nextPhoto) {
                $nextPhoto->update([
                    'is_primary' => true,
                ]);
            }
        }

        return redirect()
            ->route('pemilik.kos.edit', $kos->id)
            ->with('success', 'Foto kos berhasil dihapus!');
    }

    // Menghapus kos beserta seluruh file fotonya
    public function destroy(Request $request, $id)
    {
        abort_unless($request->user()->role === 'pemilik', 403);

        $kos = $request->user()->kos()
            ->with('photos')
            ->findOrFail($id);

        // Hapus semua file foto dari penyimpanan
        foreach ($kos->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        // Hapus data kos
        $kos->delete();

        return redirect()
            ->route('pemilik.kos.index')
            ->with('success', 'Data kos berhasil dihapus!');
    }
}
