<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Models\RefSatker;

class RefSatkerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RefSatker::latest()->get();
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
        return view('ref_satker');
    }

    public function store(Request $request)
    {
        $request->validate($this->validation());
        RefSatker::create($request->all());
        return response()->json(['success' => 'Data has been created successfully!']);
    }

    public function show($id)
    {
        $refSatker = RefSatker::findOrFail($id);
        return response()->json($refSatker);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validation());
        $refSatker = RefSatker::findOrFail($id);
        $refSatker->fill($request->post())->save();
        return response()->json(['success' => 'Data has been updated successfully!']);
    }

    public function destroy($id)
    {
        $refSatker = RefSatker::findOrFail($id);
        $refSatker->delete();

        return response()->json(['success' => 'Data has been deleted successfully!']);
    }

    public function validation()
    {
        return [
            'kode_satker' => 'required',
            'nama_satker' => 'required',
            'no_nota_debet' => 'required',
            'no_nota_kredit' => 'required',
        ];
    }
}
