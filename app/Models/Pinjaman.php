<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';

    protected $fillable = ['tanggal_pinjaman', 'anggota_id', 'jumlah_pinjaman', 'lama_angsuran'];

    protected $casts = [
        'tanggal_pinjaman' => 'date',
        'jumlah_pinjaman' => 'decimal:2',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }
}
