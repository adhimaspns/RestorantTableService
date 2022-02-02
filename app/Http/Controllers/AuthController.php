<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.auth.register');
    }

    public function proses_login(Request $request)
    {

        //! Validasi
        $rules  = [
            'nama'          => 'required',
            'username'      => 'required|min:3|unique:users,username',
            'password'      => 'required|min:6',
            'alamat'        => 'required',
            'jns_kelamin'   => 'required',
            'no_telp'       => 'required|min:11|max:13|unique:users,no_telp',
        ];

        $pesan  = [
            'required'      => 'Harap isi bidang ini!',
            'unique'        => 'Value sudah ada!',
            'min'           => "Value belum mencukupi batas minimum!",
            'max'           => "Value melebihi batas maksimum!"
        ];

        $this->validate($request, $rules, $pesan); 

        //! Register
        User::create([
            'nama'          => $request->nama,
            'alamat'        => $request->alamat,
            'jns_kelamin'   => $request->jns_kelamin,
            'no_telp'       => $request->no_telp,
            'username'      => $request->username,
            'password'      =>  bcrypt($request->username),
            'status'        => "Aktif",
            'level'         => "Customer"
        ]); 

        return redirect('/')->with('success', 'Selamat anda berhasil registrasi!');
    }
}
