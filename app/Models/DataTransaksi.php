<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataTransaksi extends Model
{
    protected $table = 'data_transaksi';
    protected $guarded = [];

    public function scopePerStatus($query, $status = null)
    {
        // return $query = $this->where([
        //         'kode_satker' => auth()->user()->kode_satker,
        //         'status' => $status,
        //     ]);

        return DB::table('data_transaksi')
                ->select(DB::raw('*, (tanggal||"-"||bulan||"-20"||tahun) as tgl_lengkap'))
                ->where('kode_satker', auth()->user()->kode_satker)
                ->where('status', $status);
    }

    public function scopeBarChart()
    {
        return DB::table('data_transaksi')
                ->select(DB::raw('count(*) as jumlah, bulan'))
                ->where('kode_satker', auth()->user()->kode_satker)
                ->groupBy('bulan')
                ->get();
    }

    public function scopePieChart()
    {
        return DB::table('data_transaksi')
                ->select(DB::raw('count(*) as jumlah, jenis'))
                ->where('kode_satker', auth()->user()->kode_satker)
                ->groupBy('jenis')
                ->get();
    }

    public function scopeDetailPerJenis($query, $jenis = null)
    {
        return $query = DB::table('data_transaksi')
                ->select(DB::raw('sum(debet) as debet, sum(kredit) as kredit, sum(debet-kredit) as saldo, nama_transaksi'))
                ->where('kode_satker', auth()->user()->kode_satker)
                ->where('jenis', $jenis)
                ->groupBy('nama_transaksi')
                ->get();
    }

    public function scopeSumPerJenis($query, $jenis = null)
    {
        return $query = DB::table('data_transaksi')
                ->select(DB::raw('coalesce(sum(debet),0) as debet, coalesce(sum(kredit),0) as kredit, coalesce(sum(debet-kredit),0) as saldo, kode_satker'))
                ->where('kode_satker', auth()->user()->kode_satker)
                ->where('jenis', $jenis)
                ->groupBy('kode_satker')
                ->first();
    }
}
