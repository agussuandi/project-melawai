<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try
        {
            $data = [
                'username'  => $request->input('username'),
                'password'  => $request->input('password')
            ];

            auth()->attempt($data);

            if (auth()->check()) {
                return redirect()->route('karyawan.index')->with('success', 'Login berhasil');
            }
            else {
                return redirect()->back()->with('error', 'Username atau Password tidak sesuai');
            }
        }
        catch (\Throwable $e)
        {
            return redirect()->back()->with('error', 'Login gagal');
        }
    }
}
