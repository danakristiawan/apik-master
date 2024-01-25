<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Models\RefKodeSubTransaksi;

class RefKodeSubTransaksiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RefKodeSubTransaksi::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $detail = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" data-id="'.$row->id.'" class="btn btn-primary btn-sm" id="detail">Detail</a>';
                        $ubah = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" data-id="'.$row->id.'" class="btn btn-primary btn-sm ms-1" id="ubah">Ubah</a>';
                        $hapus = ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm" id="hapus">Hapus</a>';
                        $button = $detail.$ubah.$hapus;
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('ref_kode_sub_transaksi');
    }

    public function store(Request $request)
    {
        $request->validate($this->validation());
        RefKodeSubTransaksi::create($request->all());
        return response()->json(['success' => 'Data has been created successfully!']);
    }

    public function show($id)
    {
        $refKodeSubTransaksi = RefKodeSubTransaksi::findOrFail($id);
        return response()->json($refKodeSubTransaksi);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validation());
        $refKodeSubTransaksi = RefKodeSubTransaksi::findOrFail($id);
        $refKodeSubTransaksi->fill($request->post())->save();
        return response()->json(['success' => 'Data has been updated successfully!']);
    }

    public function destroy($id)
    {
        $refKodeSubTransaksi = RefKodeSubTransaksi::findOrFail($id);
        $refKodeSubTransaksi->delete();

        return response()->json(['success' => 'Data has been deleted successfully!']);
    }

    public function validation()
    {
        return [
            'kode_transaksi' => 'required',
            'kode_sub_transaksi' => 'required',
            'nama_sub_transaksi' => 'required',
        ];
    }
}
