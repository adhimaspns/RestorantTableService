<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.admin.laporan.index');
    }

    public function laporan_json()
    {
        $laporan  = Booking::where('status', 'Berhasil')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($laporan)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    // $button = '<a href="booking/menunggu-persetujuan/'.$data->no_transaksi.'/detail'.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    $button = '<a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    // $button .= '&nbsp;&nbsp;'; 
                    // $button .= '<a href="meja-setting/'. $data->id_meja . '/edit" class="btn btn-primary btn-sm "><i class="fas fa-calendar-check"></i> Setujui</a>';
                    // $button .= '&nbsp;&nbsp;'; 
                    // $button .= '<a href="meja-setting/'. $data->id_meja . '/edit" class="btn btn-danger btn-sm "><i class="fas fa-times"></i> Tolak</a>';

                    return $button;
                })
                ->addColumn('grandtotal', function($data){

                    return "Rp. " . number_format($data->grandtotal,0, ',', '.'); 
                })
                ->addColumn('created_at', function($data){

                    return date('d M Y', strtotime($data->created_at)); 
                })
                ->addColumn('bukti_transfer', function($data){

                    // return "Rp. " . number_format($data->grandtotal,0, ',', '.'); 
                    if ($data->bukti_transfer == null) {
                        return "-";
                    } else {
                        return $data->bukti_transfer;
                    }
                    
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
