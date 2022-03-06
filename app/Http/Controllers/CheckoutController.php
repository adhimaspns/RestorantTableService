<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Auth;
use App\Models\Meja;
use App\Models\Booking;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function cetak_notransaksi($id)
    {
        $data_meja = Meja::findOrFail($id);

        //! Membuat Nomor Transaksi
        $hari_ini     = date('Ymd');
        $data_booking = Booking::where('no_transaksi', 'LIKE', '%'.$hari_ini.'%')->max('no_transaksi');

        $akhir_no_transaksi     = substr($data_booking, 8, 4);
        $lanjut_no_urut         = $akhir_no_transaksi + 1;
        $no_transaksi_baru      = $hari_ini.sprintf('%04s', $lanjut_no_urut);

        //! Create Data Booking
        $booking  = new Booking;

        $booking->no_transaksi  = $no_transaksi_baru;
        $booking->customerID    = Auth::user()->id_user;
        $booking->mejaID        = $id;
        // $booking->status        = "Belum Bayar";
        $booking->save();

        return redirect('booking/checkout/'. $booking->no_transaksi);
    }

    public function booking_checkout($no_transaksi)
    {
        $hari_ini      = date('Y-m-d');

        $data_checkout = Booking::where('no_transaksi', $no_transaksi)->with(['meja'])->first(); 
        $meja          = Booking::where('mejaID', $data_checkout->mejaID)->where('jam_awal', '!=', null)->where('jam_akhir', '!=', null)->where('created_at', $hari_ini)->get(); 

        return view('pages.booking.checkout', compact('meja', 'data_checkout'));
    }

    public function checkout(Request $request)
    {
        //! Request
        $jam_awal       = $request->jam_awal; 
        $jam_akhir      = $request->jam_akhir;
        $no_transaksi   = $request->no_transaksi;

        $data_booking   = Booking::where('no_transaksi', $no_transaksi)->first();
        $data_meja      = Meja::findOrFail($request->mejaID)->first();

        $timeDifference = Carbon::parse($jam_akhir)->diffInMinutes(Carbon::parse($jam_awal));
        $timeDifference = $timeDifference / 60;

        $grand_total    = $data_meja->harga * $timeDifference;

        //! Insert data Booking
        $data_booking->update([
            'jam_awal'     => $jam_awal,
            'jam_akhir'    => $jam_akhir,
            'status'       => "Menunggu Persetujuan",
            'grandtotal'   => $grand_total
        ]);

        return redirect('booking');

        // return redirect('booking/bukti-pembayaran/' .  $no_transaksi);

        // return number_format($grand_total,0,',','.' );
        // return number_format($data_meja->harga,0,',','.');
        // return $timeDifference;
    }

    public function proses_bukti_bayar(Request $request, $no_transaksi)
    {
        $data_booking = Booking::where('no_transaksi', $no_transaksi)->first();

        //! Validasi
        $rules  = [
            'file'     => 'mimes:jpeg,jpg,png | max:2000',
        ];

        $pesan  = [
            'mimes'      => 'Ekstensi harus, JPEG, JPG, PNG',
            'max'        => 'Ukuran melebihi 2Mb'
        ];

        $this->validate($request, $rules, $pesan); 

        //! Foto
        $path       = public_path() . '/uploads/bukti-transfer/'; 
        $foto       = $request->file;
        $filename   = $foto->getClientOriginalName();
        $foto->move($path, $filename);

        //! Update data booking
        $data_booking->update([
            'bukti_transfer'    => $filename,
            // 'status'            => "Sukses Transfer"
            'status'            => "Diproses"
        ]); 

        return redirect()->back()->with('success', 'Pembayaran diproses!');
    }
}
