<?php

namespace Database\Seeders;

use App\Models\Kos;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    /**
     * Memindahkan 64 data dari config/kos.php ke tabel kos.
     * Aman dijalankan berulang kali (updateOrCreate berdasarkan id).
     */
    public function run(): void
    {
        foreach (config('kos', []) as $row) {
            $data = collect($row)
                ->except('id')
                ->map(fn ($value) => $value === '' ? null : $value)
                ->all();

            $data['type'] = $data['type'] ?? 'Belum diketahui';

            Kos::updateOrCreate(['id' => $row['id']], $data);
        }
    }
}