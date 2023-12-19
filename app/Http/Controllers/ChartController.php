<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index() {
        $items = DB::table('data_transaksi')
                    ->select(DB::raw('count(*) as jumlah, bulan'))
                    ->groupBy('bulan')
                    ->get();
    
        return response()->json([
            'data' => $items
        ]);
    }
}
