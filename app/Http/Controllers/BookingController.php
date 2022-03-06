<?php

namespace App\Http\Controllers;


use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Meja;
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
                                ->whereDate('created_at', Carbon::today())->first();

        if ($user_booking == null) {
            // return "Data Tidak ada";
            $user_booking = null;
            $data_meja    = null;

            return view('pages.booking.index', compact('user_booking', 'data_meja'));
        } else {
            // return "ada Data";
            $data_meja    = Meja::where('id_meja', $user_booking->mejaID)->first();

            return view('pages.booking.index', compact('user_booking', 'data_meja'));
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
