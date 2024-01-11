<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\DataTransaksi;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTransaksi::jurnal()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $detail = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" data-id="'.$row->id.'" class="btn btn-primary btn-sm" id="detail">Detail</a>';
                        $proses = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm ms-1" id="proses">proses</a>';
                        $button = $detail.$proses;
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('jurnal');
    }

    public function show($id)
    {
        $dataTransaksi = DataTransaksi::findOrFail($id);
        return response()->json($dataTransaksi);
    }
}
