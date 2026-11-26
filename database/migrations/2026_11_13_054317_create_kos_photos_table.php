
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kos_photos', function (Blueprint $table) {
            $table->id();

            // Menghubungkan foto dengan data kos
            $table->foreignId('kos_id')
                  ->constrained('kos')
                  ->cascadeOnDelete();

            // Lokasi file foto
            $table->string('photo_path');

            // Keterangan foto (opsional)
            $table->string('caption')->nullable();

            // Penanda foto utama
            $table->boolean('is_primary')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kos_photos');
    }
};
