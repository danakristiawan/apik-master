<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\RefBank;
use Illuminate\Http\Request;

class RefBankController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RefBank::latest()->get();
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
        return view('ref_bank');
    }

    public function store(Request $request)
    {
        $request->validate($this->validation());
        RefBank::create($request->all());
        return response()->json(['success' => 'Data has been created successfully!']);
    }

    public function show($id)
    {
        $refBank = RefBank::findOrFail($id);
        return response()->json($refBank);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validation());
        $refBank = RefBank::findOrFail($id);
        $refBank->fill($request->post())->save();
        return response()->json(['success' => 'Data has been updated successfully!']);
    }

    public function destroy($id)
    {
        $refBank = RefBank::findOrFail($id);
        $refBank->delete();

        return response()->json(['success' => 'Data has been deleted successfully!']);
    }

    public function validation()
    {
        return [
            'kode_satker' => 'required',
            'nomor_rekening' => 'required',
            'uraian_rekening' => 'required',
            'jenis_rekening' => 'required',
            'nama_bank' => 'required',
            'surat_izin' => 'required',
            'tanggal_surat' => 'required',
            'status_rekening' => 'required',
        ];
    }
}
