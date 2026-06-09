<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    protected $fillable = ['nama', 'alamat', 'no_telepon'];

    public function simpanans(): HasMany
    {
        return $this->hasMany(Simpanan::class);
    }

    public function pinjamans(): HasMany
    {
        return $this->hasMany(Pinjaman::class);
    }

    public function angsurans(): HasMany
    {
        return $this->hasMany(Angsuran::class);
    }
}
