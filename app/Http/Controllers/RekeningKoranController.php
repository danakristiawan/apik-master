<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\DataTransaksi;
use Illuminate\Http\Request;

class RekeningKoranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTransaksi::perStatus('1')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $detail = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" data-id="'.$row->id.'" class="btn btn-primary btn-sm" id="detail">Detail</a>';
                        $proses = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm ms-1" id="proses">proses</a>';
                        $button = $proses;
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('rekening_koran');
    }

    public function show($id)
    {
        $dataTransaksi = DataTransaksi::findOrFail($id);
        return response()->json($dataTransaksi);
    }
}
