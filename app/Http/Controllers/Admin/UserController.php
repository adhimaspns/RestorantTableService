<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.admin.users.index');
    }

    public function user_json()
    {
        $user  = User::where('level', 'Customer')->where('status', 'Aktif')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="user-setting/'.$data->id_user.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    $button .= '&nbsp;&nbsp;'; 
                    $button .= '<a href="user-nonaktif/'. $data->id_user.'" class="btn btn-danger btn-sm "><i class="fas fa-user-times"></i> Non Aktifkan</a>';

                    return $button;
                })
                ->addColumn('created_at', function($data){
                    return date('d M Y - H:i:s', strtotime($data->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function show($id)
    {
        $user   = User::findOrFail($id);

        return view('pages.admin.users.detail', compact('user'));
    }

    public function user_nonaktif($id)
    {
        $user = User::findOrFail($id);

        //! Update Status
        $user->update([
            'status'   => "Tidak Aktif"
        ]); 

        return redirect()->back()->with('success', 'Customer berhasil di nonaktifkan!');
    }
}
