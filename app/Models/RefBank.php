<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefBank extends Model
{
    protected $table = 'ref_bank';
    protected $guarded = [];

    public function scopePersatker($query, $jenis = null)
    {
        return $this->where([
            'kode_satker' => auth()->user()->kode_satker,
            'jenis_rekening' => $jenis,
            'status_rekening' => 'aktif'
        ]);
    }
}
