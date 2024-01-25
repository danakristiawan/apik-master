<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\RefMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RefMenuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RefMenu::latest()->get();
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
        return view('ref_menu');
    }

    public function store(Request $request)
    {
        $request->validate($this->validation());
        RefMenu::create($request->all());
        return response()->json(['success' => 'Data has been created successfully!']);
    }

    public function show($id)
    {
        $refMenu = RefMenu::findOrFail($id);
        return response()->json($refMenu);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validation());
        $refMenu = RefMenu::findOrFail($id);
        $refMenu->fill($request->post())->save();
        return response()->json(['success' => 'Data has been updated successfully!']);
    }

    public function destroy($id)
    {
        $refMenu = RefMenu::findOrFail($id);
        $refMenu->delete();

        return response()->json(['success' => 'Data has been deleted successfully!']);
    }

    public function validation()
    {
        return [
            'menu_name' => 'required',
            'role_name' => 'required',
            'route_name' => 'required',
            'url_name' => 'required',
            'no_urut' => 'required',
        ];
    }
}
