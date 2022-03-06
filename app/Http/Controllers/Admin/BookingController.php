<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Meja;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('pages.admin.booking.index');
    }

    public function booking_json()
    {
        $booking  = Booking::where('status', 'Menunggu Persetujuan')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($booking)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="booking/menunggu-persetujuan/'.$data->no_transaksi.'/detail'.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    // $button .= '&nbsp;&nbsp;'; 
                    // $button .= '<a href="meja-setting/'. $data->id_meja . '/edit" class="btn btn-primary btn-sm "><i class="fas fa-calendar-check"></i> Setujui</a>';
                    // $button .= '&nbsp;&nbsp;'; 
                    // $button .= '<a href="meja-setting/'. $data->id_meja . '/edit" class="btn btn-danger btn-sm "><i class="fas fa-times"></i> Tolak</a>';

                    return $button;
                })
                ->addColumn('grandtotal', function($data){

                    return "Rp. " . number_format($data->grandtotal,0, ',', '.'); 
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

    public function persetujuan($no_transaksi, $status)
    {
        $data_booking = Booking::where('no_transaksi', $no_transaksi)->first();

        //! Update Status
        if ($status == "tolak") {
            $data_booking->update([
                'status'    => "Salah Jadwal"
            ]);

            return redirect('admin/booking')->with('success', 'Transaksi berhasil dibatalkan!');
        } elseif ($status == "setuju") {
            
            $data_booking->update([
                'status'    => "Menunggu Pembayaran"
            ]);

            return redirect('admin/booking')->with('success', 'Transaksi berhasil disetujui!');
        } elseif ($status == "checkout") {
            $data_booking->update([
                'status'    => "Sukses"
            ]);

            return redirect('admin/booking/menunggu-pembayaran')->with('success', 'Transaksi sukses!');
        } elseif ($status == "gagal") {
            $data_booking->update([
                'status'    => "gagal"
            ]);

            return redirect('admin/booking/menunggu-pembayaran')->with('success', 'Transaksi berhasil digagalkan!');
        } elseif ($status == "berhasil") {
            $data_booking->update([
                'status'    => "Berhasil"
            ]);

            return redirect('admin/booking/sukses')->with('success', "Transaksi berhasil!");
        }

    }

    public function pembayaran()
    {
        return view('pages.admin.booking.pembayaran');
    }

    public function pembayaran_json()
    {
        $booking  = Booking::where('status', 'Menunggu Pembayaran')->orWhere('status', 'Diproses')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($booking)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="menunggu-pembayaran/'.$data->no_transaksi.'/detail'.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';

                    return $button;
                })
                ->addColumn('grandtotal', function($data){

                    return "Rp. " . number_format($data->grandtotal,0, ',', '.'); 
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

    public function pembayaran_detail($no_transaksi)
    {
        $data_booking = Booking::where('no_transaksi', $no_transaksi)->first();

        return view('pages.admin.booking.pembayaran_detail', compact('data_booking', 'no_transaksi'));
    }

    public function persetujuan_json()
    {
        $booking  = Booking::where('status', 'Menunggu Persetujuan')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($booking)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="menunggu-persetujuan/'.$data->no_transaksi.'/detail'.'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    // $button .= '&nbsp;&nbsp;'; 
                    // $button .= '<a href="meja-setting/'. $data->id_meja . '/edit" class="btn btn-primary btn-sm "><i class="fas fa-calendar-check"></i> Setujui</a>';
                    // $button .= '&nbsp;&nbsp;'; 
                    // $button .= '<a href="meja-setting/'. $data->id_meja . '/edit" class="btn btn-danger btn-sm "><i class="fas fa-times"></i> Tolak</a>';

                    return $button;
                })
                ->addColumn('grandtotal', function($data){

                    return "Rp. " . number_format($data->grandtotal,0, ',', '.'); 
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function persetujuan_detail($no_transaksi)
    {
        $hari_ini      = date('Y-m-d');

        $data_booking = Booking::where('no_transaksi', $no_transaksi)->with(['meja'])->first();
        $data_meja    = Booking::where('mejaID', $data_booking->mejaID)->where('jam_awal', '!=', null)->where('jam_akhir', '!=', null)->where('created_at', $hari_ini)->get();

        return view('pages.admin.booking.persetujuan_detail', compact('data_meja', 'no_transaksi', 'data_booking'));
    }

    public function booking_sukses()
    {
        return view('pages.admin.booking.sukses');
    }

    public function booking_sukses_json()
    {
        $booking  = Booking::where('status', 'Sukses')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($booking)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<a href="/admin/persetujuan/'.$data->no_transaksi.'/berhasil'.'" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Selesaikan Transaksi</a>';
                    // $button = '<a href="/{no_transaksi}/{status}/'.$data->no_transaksi.'/detail'.'" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Selesaikan Transaksi</a>';

                    return $button;
                })
                ->addColumn('grandtotal', function($data){

                    return "Rp. " . number_format($data->grandtotal,0, ',', '.'); 
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
