<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTransaksi extends Model
{
    protected $table = 'data_transaksi';
    protected $guarded = [];

    public function scopeRekeningKoran()
    {
        return $this->where([
            'kode_satker' => auth()->user()->kode_satker,
            'status' => '1',
        ]);
    }
    public function scopeJurnal()
    {
        return $this->where([
            'kode_satker' => auth()->user()->kode_satker,
            'status' => '2',
        ]);
    }
    public function scopePembukuan()
    {
        return $this->where([
            'kode_satker' => auth()->user()->kode_satker,
            'status' => '3',
        ]);
    }
    public function scopePelaporan()
    {
        return $this->where([
            'kode_satker' => auth()->user()->kode_satker,
            'status' => '4',
        ]);
    }
}
