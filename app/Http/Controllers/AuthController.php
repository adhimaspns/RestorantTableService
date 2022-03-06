<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function proses_login(Request $request)
    {
        //! Cek apakah user terdaftar pada database (Cocokan dengan username dan password) 
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            
            //! Jika ada kecocokan, maka cek user yang sedang request login memiliki level apa 
            if (Auth::user()->level == "Kasir") {

                //! Jika memiliki level kasir maka akan dialihkan ke halaman admin 
                return redirect('admin/beranda');

            } else {
                
                //! Jika tidak maka dianggap user biasa 
                return redirect('beranda');
            }
            
        } else {
            return redirect('login')->with('gagal-login', "Username dan password tidak cocok!");
        }
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function proses_register(Request $request)
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

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('login')->with('success', 'Anda berhasil loggout!');
    }
}
