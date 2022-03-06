<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $booking_berhasil       = Booking::where('status', 'Berhasil')->whereDate('created_at', Carbon::today())->count();
        $menunggu_pembayaran    = Booking::where('status', 'Menunggu Pembayaran')->whereDate('created_at', Carbon::today())->count();
        $menunggu_persetujuan   = Booking::where('status', 'Menunggu Persetujuan')->whereDate('created_at', Carbon::today())->count();

        return view('pages.admin.beranda', compact('booking_berhasil', 'menunggu_pembayaran', 'menunggu_persetujuan'));
    }
}
