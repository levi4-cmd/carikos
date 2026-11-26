<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kos extends Model
{
    protected $table = 'kos';

    protected $guarded = [];

    protected $casts = [
        'rating'      => 'float',
        'reviews'     => 'integer',
        'lat'         => 'float',
        'lng'         => 'float',
        'harga_mulai' => 'integer',
    ];

    // Relasi ke akun pemilik kos
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relasi ke foto-foto kos
    public function photos(): HasMany
    {
        return $this->hasMany(KosPhoto::class);
    }

    // Kelas CSS berdasarkan tipe kos
    public function getTypeClassAttribute(): string
    {
        return match (mb_strtolower((string) $this->type)) {
            'putri'     => 'is-putri',
            'putra'     => 'is-putra',
            'campur'    => 'is-campur',
            'kontrakan' => 'is-kontrakan',
            default     => 'is-lain',
        };
    }

    // Link WhatsApp
    public function getWhatsappUrlAttribute(): ?string
    {
        if (empty($this->phone)) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $this->phone);

        if (empty($digits)) {
            return null;
        }

        $digits = ltrim($digits, '0');

        return 'https://wa.me/62' . $digits;
    }

    // Daftar fasilitas dan ikon
    public function facilityItems(): Collection
    {
        return collect(preg_split('/[,;]/', (string) $this->facilities))
            ->map(fn ($text) => trim($text))
            ->filter()
            ->values()
            ->map(fn ($text) => [
                'text' => $text,
                'icon' => self::iconFor($text),
            ]);
    }

    // Menentukan ikon berdasarkan nama fasilitas
    protected static function iconFor(string $text): string
    {
        $map = [
            '/wi-?fi/i'              => 'bi-wifi',
            '/parkir/i'              => 'bi-p-square',
            '/cctv/i'                => 'bi-camera-video',
            '/mandi|\bkm\b/i'        => 'bi-droplet',
            '/dapur/i'               => 'bi-cup-hot',
            '/\bac\b/i'              => 'bi-snow',
            '/listrik/i'             => 'bi-lightning-charge',
            '/laundry|cuci/i'        => 'bi-basket',
            '/kasur|bed/i'           => 'bi-moon-stars',
            '/aman|satpam|security/i'=> 'bi-shield-check',
        ];

        foreach ($map as $pattern => $icon) {
            if (preg_match($pattern, $text)) {
                return $icon;
            }
        }

        return 'bi-check2';
    }
}
