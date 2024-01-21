<?php

namespace App\Http\Controllers;

use App\Models\DataTransaksi;
use Illuminate\Support\Facades\DB;
use DataTables;

class OverviewController extends Controller
{
    public function index()
    {
        return view('overview', [
            'rekeningKoran' => DataTransaksi::perStatus('1')->count(),
            'jurnal' => DataTransaksi::perStatus('2')->count(),
            'pembukuan' => DataTransaksi::perStatus('3')->count(),
            'pelaporan' => DataTransaksi::perStatus('4')->count(),
            'sumLelang' => DataTransaksi::sumPerJenis('L'),
            'sumPiutang' => DataTransaksi::sumPerJenis('P'),
        ]);
    }

    public function barChart() {
        return response()->json([
            'data' => DataTransaksi::barChart(),
        ]);
    }

    public function pieChart() {
        return response()->json([
            'data' => DataTransaksi::pieChart(),
        ]);
    }

    public function detailPerJenis($jenis = null)
    {
        return DataTables::of(DataTransaksi::detailPerJenis($jenis))
            ->addIndexColumn()
            ->make(true);
    }
}
