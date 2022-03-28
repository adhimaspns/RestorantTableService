<?php

namespace App\Http\Controllers;


use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Meja;
use App\Models\Menu;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // return "booking";
        

        $today     = date('Ymd');
        $user_auth = Auth::user()->id_user;
        $carbon    = Carbon::today();
        $date      = date('Y m d', strtotime($carbon));

        $user_booking = Booking::where('customerID', $user_auth)
                                ->whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->first();

        if ($user_booking == null) {
            // return "Data Tidak ada";
            $user_booking = null;
            $data_meja    = null;

            return view('pages.booking.index', compact('user_booking', 'data_meja'));
        } else {
            // return "ada Data";
            $data_meja     = Meja::where('id_meja', $user_booking->mejaID)->first();
            $data_menu     = Menu::where('no_transaksi', $user_booking->no_transaksi)->get();
            $subtotal_menu = Menu::where('no_transaksi', $user_booking->no_transaksi)->sum('subtotal');
            $subtotal_meja = $user_booking->grandtotal - $subtotal_menu; 

            return view('pages.booking.index', compact('user_booking', 'data_meja', 'data_menu', 'subtotal_meja'));
        }

        //! Status Booking
        // if ($user_booking->status == "Menunggu Persetujuan") {
        //     return "Menunggu";
        // } elseif ($user_booking->status == "Menunggu Pembayaran") {
        //     return "Menunggu Pembayaran";
        // } else {
        //     return "Kosong";
        // }
    }
}
