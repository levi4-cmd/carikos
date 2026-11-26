<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('Belum diketahui')->index();
            $table->decimal('rating', 2, 1)->nullable();
            $table->unsignedInteger('reviews')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('address')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->text('facilities')->nullable();
            $table->text('notes')->nullable();
            $table->text('maps_url')->nullable();
            $table->unsignedInteger('harga_mulai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};