<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Meja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class MejaController extends Controller
{
    public function index()
    {
        return view('pages.admin.meja.index');
    }

    public function meja_json()
    {
        $meja  = Meja::where('status', '!=', 'Non Aktif')->orderBy('status', "ASC")->get();
        return DataTables::of($meja)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="meja-setting/'. $data->id_meja . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    $button .= '&nbsp;&nbsp;'; 
                    $button .= '<a href="meja-setting/'. $data->id_meja . '/edit" class="btn btn-warning btn-sm "><i class="fas fa-edit"></i></a>';
                    $button .= '&nbsp;&nbsp;'; 
                    $button .= '<a href="meja-off/'. $data->id_meja. '" class="btn btn-danger btn-sm "><i class="fas fa-times"></i> Non Aktifkan</a>';

                    return $button;
                })
                ->addColumn('harga', function($data){

                    return "Rp. " . number_format($data->harga,0, ',', '.'); 
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function store(Request $request)
    {
        //! Validasi
        $rules  = [
            'file'     => 'mimes:jpeg,jpg,png | max:10000',
        ];

        $pesan  = [
            'mimes'      => 'Ekstensi harus, JPEG, JPG, PNG',
            'max'        => 'Ukuran melebihi 2Mb'
        ];

        $this->validate($request, $rules, $pesan); 

        //! Foto
        $path       = public_path() . '/uploads/'; 
        $foto       = $request->file;
        $filename   = $foto->getClientOriginalName();
        $foto->move($path, $filename);

        //! Insert Data
        Meja::create([
            'nama_meja'     => $request->nama_meja,
            'deskripsi'     => $request->deskripsi,
            'jenis_meja'    => $request->jenis_meja,
            'kapasitas'     => $request->kapasitas,
            'satuan'        => $request->satuan,
            'foto'          => $filename,
            'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
            'status'        => "Kosong"
        ]); 

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $data_meja  = Meja::findOrFail($id);

        return view('pages.admin.meja.show', compact('data_meja'));
    }

    public function edit($id)
    {
        $data = Meja::findOrFail($id);

        return view('pages.admin.meja.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        //! Validasi
        $rules  = [
            'file'        => 'mimes:jpeg,jpg,png | max:10000',
            'kapasitas'   => 'max:10',
        ];

        $pesan  = [
            'mimes'      => 'Ekstensi harus, JPEG, JPG, PNG',
            'max'        => 'Ukuran melebihi ketentuan'
        ];

        $this->validate($request, $rules, $pesan); 

        $data = Meja::findOrFail($id);

        //! Kondisi Foto
        if ($request->file) {

            //! Update dengan foto 
            $path = public_path() . '/uploads/'; 

            if ($data->foto != null && $data->foto != '') {

                $foto_lama = public_path('uploads/' . $data->foto);

                if (File::exists($foto_lama)) {
                    unlink($foto_lama);
                }
            }

            $foto       = $request->file;
            $filename   = $foto->getClientOriginalName();
            $foto->move($path, $filename);

            $data->update([
                'nama_meja'     => $request->nama_meja,
                'deskripsi'     => $request->deskripsi,
                'jenis_meja'    => $request->jenis_meja,
                'kapasitas'     => preg_replace("/[^0-9]/", "", $request->kapasitas),
                'satuan'        => $request->satuan,
                'foto'          => $filename,
                'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
            ]);
        } 

        $data->update([
            'nama_meja'     => $request->nama_meja,
            'deskripsi'     => $request->deskripsi,
            'jenis_meja'    => $request->jenis_meja,
            'kapasitas'     => preg_replace("/[^0-9]/", "", $request->kapasitas),
            'satuan'        => $request->satuan,
            'harga'         => preg_replace("/[^0-9]/", "", $request->harga),
        ]);

        return redirect('admin/meja-setting')->with('success', 'Data berhasil diupdate!');
    }

    public function meja_off($id)
    {
        $data_meja  = Meja::findOrFail($id);

        //! Update Status 
        $data_meja->update([
            'status'        => "Non Aktif"
        ]); 

        return redirect()->back()->with('success', "Meja berhasil di non aktifkan");
    }

}
