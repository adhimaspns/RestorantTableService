<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\User;
use Illuminate\Support\Facades\DB;

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
                    $button = '<a href="laporan/'.$data->no_transaksi.'/detail" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    // $button = '<a href="booking/menunggu-persetujuan/'.$data->no_transaksi.'/detail'.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
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

    public function detail($no_transaksi)
    {
        $laporan   = Booking::where('no_transaksi', $no_transaksi)->orderBy('created_at', 'DESC')->first();
        $data_meja = Meja::where('id_meja', $laporan->mejaID)->first();
        $data_user = User::where('id_user', $laporan->customerID)->first();

        return view('pages.admin.laporan.detail', compact('laporan', 'data_meja', 'data_user'));
    }

    public function proses_laporan_by_date(Request $request)
    {
        //! Request
        $tgl_awal  = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        //! Cari data 
        $laporan = Booking::with(['meja'])->whereDate('created_at', '>=', $tgl_awal)
                            ->whereDate('created_at', '<=', $tgl_akhir)
                            ->where('status', 'Berhasil')->get(); 
        $sum     = Booking::with(['meja'])->whereDate('created_at', '>=', $tgl_awal)
                    ->whereDate('created_at', '<=', $tgl_akhir)
                    ->where('status', 'Berhasil')->sum('grandtotal');

        $pdf            = PDF::loadview('pages.admin.laporan.cetak', compact('laporan', 'tgl_awal', 'tgl_akhir', 'sum'));
        return $pdf->download('laporan-transaksi.pdf');

        // return view('pages.admin.laporan.cetak', compact('laporan', 'tgl_awal', 'tgl_akhir', 'sum'));
    }
}
