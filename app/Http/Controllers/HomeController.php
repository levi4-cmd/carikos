<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $total = Kos::count();

        // Jumlah kos per tipe
        $byType = Kos::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        // Jumlah kos per area (dicocokkan dari alamat)
        $areas = collect(['Rajabasa', 'Gedong Meneng', 'Kampung Baru', 'Labuhan Ratu', 'Sepang Jaya'])
            ->mapWithKeys(fn ($area) => [
                $area => Kos::where('address', 'like', "%{$area}%")->count(),
            ])
            ->filter();

        // Rating tertinggi, minimal 10 rating supaya tidak menyesatkan
        $top = Kos::whereNotNull('rating')
            ->where('reviews', '>=', 10)
            ->orderByDesc('rating')
            ->orderByDesc('reviews')
            ->limit(6)
            ->get();

        return view('pages.home', compact('total', 'byType', 'areas', 'top'));
    }
}