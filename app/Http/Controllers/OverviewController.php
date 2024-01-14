<?php

namespace App\Http\Controllers;

use App\Models\DataTransaksi;

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

        // dd($data->count());
    }
}
