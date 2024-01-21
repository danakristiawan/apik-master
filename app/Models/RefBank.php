<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefBank extends Model
{
    protected $table = 'ref_bank';
    protected $guarded = [];

    public function scopeLelangPersatker()
    {
        return $this->where([
            'kode_satker' => auth()->user()->kode_satker,
            'jenis_rekening' => '1',
            'status_rekening' => 'Aktif'
        ]);
    }

    public function scopePiutangPersatker()
    {
        return $this->where([
            'kode_satker' => auth()->user()->kode_satker,
            'jenis_rekening' => '2',
            'status_rekening' => 'Aktif'
        ]);
    }
}
