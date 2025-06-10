<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    // Jika perlu, tambahkan properti protected $table, $fillable, dll sesuai kebutuhan

    // Contoh:
    // protected $table = 'institutions';
    // protected $fillable = ['name', 'domain', ...];

    /**
     * Accessor untuk mendapatkan subdomain dari hostname saat ini
     */
    public function getSubdomainAttribute()
    {
        $host = request()->getHost();
        if (str_contains($host, '.')) {
            return explode('.', $host)[0];
        }
        return null; // atau handle kasus domain utama
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
