<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
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
        return view('user');
    }

    public function store(Request $request)
    {
        $request->validate($this->validation());
        User::create($request->all());
        return response()->json(['success' => 'Data has been created successfully!']);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate($this->validation());
        $user->fill($request->post())->save();
        return response()->json(['success' => 'Data has been updated successfully!']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success' => 'Data has been deleted successfully!']);
    }

    public function validation()
    {
        return [
            'nama' => 'required',
            'nip' => 'required',
            'kode_satker' => 'required',
            'password' => 'required',
            'role' => 'required',
        ];
    }
}
