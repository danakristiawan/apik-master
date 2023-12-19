<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'nip' => ['required', 'unique:users,nip'],
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        ]);

       $user = User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
        ]);

        if (Auth::attempt(['nip' => $user->nip, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }
    }
}
