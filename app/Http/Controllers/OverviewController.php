<?php

namespace App\Http\Controllers;

use App\Models\DataTransaksi;
use Illuminate\Support\Facades\DB;
use DataTables;

class OverviewController extends Controller
{
    public function index()
    {
        // $data = DataTransaksi::get();
        return view('overview', [
            'rekeningKoran' => DataTransaksi::rekeningKoran()->count(),
            'jurnal' => DataTransaksi::jurnal()->count(),
            'pembukuan' => DataTransaksi::pembukuan()->count(),
            'pelaporan' => DataTransaksi::pelaporan()->count()
        ]);
    }

    public function barChart() {
        $items = DB::table('data_transaksi')
                    ->select(DB::raw('count(*) as jumlah, bulan'))
                    ->where('kode_satker', auth()->user()->kode_satker)
                    ->groupBy('bulan')
                    ->get();

        return response()->json([
            'data' => $items
        ]);
    }

    public function pieChart() {
        $items = DB::table('data_transaksi')
                    ->select(DB::raw('count(*) as jumlah, jenis'))
                    ->where('kode_satker', auth()->user()->kode_satker)
                    ->groupBy('jenis')
                    ->get();

        return response()->json([
            'data' => $items
        ]);
    }

    public function lelangTable()
    {
        $items = DB::table('data_transaksi')
                    ->select(DB::raw('sum(debet) as debet, sum(kredit) as kredit, sum(debet-kredit) as saldo, nama_transaksi'))
                    ->where('kode_satker', auth()->user()->kode_satker)
                    ->where('jenis', 'L')
                    ->groupBy('nama_transaksi')
                    ->get();

        return DataTables::of($items)
            ->addIndexColumn()
            ->make(true);
    }

    public function piutangTable()
    {
        $items = DB::table('data_transaksi')
                    ->select(DB::raw('sum(debet) as debet, sum(kredit) as kredit, sum(debet-kredit) as saldo, nama_transaksi'))
                    ->where('kode_satker', auth()->user()->kode_satker)
                    ->where('jenis', 'P')
                    ->groupBy('nama_transaksi')
                    ->get();

        return DataTables::of($items)
            ->addIndexColumn()
            ->make(true);
    }
}
