<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\MasterMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        return view('pages.admin.menu.makanan.index');
    }

    public function index_minuman()
    {
        return view('pages.admin.menu.minuman.index');
    }

    public function makanan_json()
    {
        $makanan  = MasterMenu::where('kategori', 'Makanan')->where('status', 'Tersedia')->orderBy('nama_menu', 'ASC')->get();
        return DataTables::of($makanan)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="makanan/'. $data->id_menu . '/detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    $button .= '&nbsp;&nbsp;'; 
                    $button .= '<a href="makanan/'. $data->id_menu . '/edit" class="btn btn-warning btn-sm "><i class="fas fa-edit"></i></a>';

                    return $button;
                })
                ->addColumn('harga', function($data){

                    return "Rp. " . number_format($data->harga,0, ',', '.'); 
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function minuman_json()
    {
        $minuman  = MasterMenu::where('kategori', 'Minuman')->where('status', 'Tersedia')->orderBy('nama_menu', 'ASC')->get();
        return DataTables::of($minuman)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="minuman/'. $data->id_menu . '/detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    $button .= '&nbsp;&nbsp;'; 
                    $button .= '<a href="minuman/'. $data->id_menu . '/edit" class="btn btn-warning btn-sm "><i class="fas fa-edit"></i></a>';

                    return $button;
                })
                ->addColumn('harga', function($data){

                    return "Rp. " . number_format($data->harga,0, ',', '.'); 
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function makanan_store(Request $request)
    {

        //! Foto
        $path       = public_path() . '/uploads/menu/makanan/'; 
        $foto       = $request->file;
        $filename   = $foto->getClientOriginalName();
        $foto->move($path, $filename);

        MasterMenu::create([
            'nama_menu'     => $request->menu,
            'satuan'        => $request->satuan,
            'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
            'status'        => "Tersedia",
            'kategori'      => "Makanan",
            'foto'          => $filename
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data makanan!');
    }

    public function minuman_store(Request $request)
    {
        //! Foto
        $path       = public_path() . '/uploads/menu/minuman/'; 
        $foto       = $request->file;
        $filename   = $foto->getClientOriginalName();
        $foto->move($path, $filename);

        MasterMenu::create([
            'nama_menu'     => $request->menu,
            'satuan'        => $request->satuan,
            'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
            'status'        => "Tersedia",
            'kategori'      => "Minuman",
            'foto'          => $filename
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data makanan!');
    }

    public function show($id)
    {
        $data_makanan = MasterMenu::where('id_menu', $id)->first();

        return view('pages.admin.menu.makanan.show', compact('data_makanan'));
    }

    public function show_minuman($id)
    {
        $data_minuman = MasterMenu::where('id_menu', $id)->first();

        return view('pages.admin.menu.minuman.show', compact('data_minuman'));
    }

    public function edit($id)
    {
        $data_menu = MasterMenu::where('id_menu', $id)->first();
        return view('pages.admin.menu.makanan.edit', compact('data_menu'));
    }

    public function edit_minuman($id)
    {
        $data_menu = MasterMenu::where('id_menu', $id)->first();
        return view('pages.admin.menu.minuman.edit', compact('data_menu'));
    }

    public function update(Request $request, $id)
    {
        $data_menu = MasterMenu::where('id_menu', $id)->first();

        if ($request->file) {

            $path  = public_path() . '/uploads/menu/makanan/'; 

            if ($data_menu->foto != null && $data_menu->foto != '') {

                $foto_lama  = public_path('/uploads/menu/makanan/' . $data_menu->foto); 

                if (File::exists($foto_lama)) {
                    unlink($foto_lama);
                }
            }

            $foto       = $request->file;
            $filename   = $foto->getClientOriginalName();
            $foto->move($path, $filename);

            $data_menu->update([
                'nama_menu'     => $request->menu,
                'satuan'        => $request->satuan,
                'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
                'status'        => "Tersedia",
                'kategori'      => "Makanan",
                'foto'          => $filename
            ]);

            return redirect('admin/menu/makanan')->with('success', 'Data berhasil di edit!');
        } else {

            $data_menu->update([
                'nama_menu'     => $request->menu,
                'satuan'        => $request->satuan,
                'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
            ]);

            return redirect('admin/menu/makanan')->with('success', 'Data berhasil di edit!');
        }
    }

    public function update_minuman(Request $request, $id)
    {
        $data_menu = MasterMenu::where('id_menu', $id)->first();

        if ($request->file) {

            $path  = public_path() . '/uploads/menu/minuman/'; 

            if ($data_menu->foto != null && $data_menu->foto != '') {

                $foto_lama  = public_path('/uploads/menu/minuman/' . $data_menu->foto); 

                if (File::exists($foto_lama)) {
                    unlink($foto_lama);
                }
            }

            $foto       = $request->file;
            $filename   = $foto->getClientOriginalName();
            $foto->move($path, $filename);

            $data_menu->update([
                'nama_menu'     => $request->menu,
                'satuan'        => $request->satuan,
                'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
                'foto'          => $filename
            ]);

            return redirect('admin/menu/minuman')->with('success', 'Data berhasil di edit!');
        } else {

            $data_menu->update([
                'nama_menu'     => $request->menu,
                'satuan'        => $request->satuan,
                'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
            ]);

            return redirect('admin/menu/minuman')->with('success', 'Data berhasil di edit!');
        }
    }
}
