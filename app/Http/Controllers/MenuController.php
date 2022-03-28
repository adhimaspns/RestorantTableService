<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MasterMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function checkout($no_transaksi)
    {
        $menu_makanan   = MasterMenu::where('status', 'Tersedia')->where('kategori', 'Makanan')->get();
        $menu_minuman   = MasterMenu::where('status', 'Tersedia')->where('kategori', 'Minuman')->get();
        $data_menu      = Menu::where('no_transaksi', $no_transaksi)->orderBy('created_at', 'DESC')->get();
        $sum_subtotal   = Menu::where('no_transaksi', $no_transaksi)->sum('subtotal');

        return view('pages.menu.checkout', compact('no_transaksi', 'menu_makanan', 'menu_minuman', 'data_menu', 'sum_subtotal'));
    }

    public function proses_pesan_menu(Request $request, $kategori_proses, $no_transaksi)
    {
        //! Makanan
        if ($kategori_proses == "makanan") {

            $data_master  = MasterMenu::where('nama_menu', $request->menu_makanan)->first();
            $data_makanan = Menu::where('menu', $request->menu_makanan)->where('no_transaksi', $no_transaksi)->first();
            $cek_jml      = Menu::where('menu', $request->menu_makanan)->where('no_transaksi', $no_transaksi)->count();

            //! Cek jika data sudah ada
            if (!$cek_jml) {

                //! Hitung subtotal
                $subtotal = $request->jml * $data_master->harga;

                //! Insert data
                Menu::create([
                    'no_transaksi'      => $no_transaksi,
                    'menu'              => $request->menu_makanan,
                    'kategori'          => "Makanan",
                    'jml'               => $request->jml,
                    'harga'             => $data_master->harga,
                    'subtotal'          => $subtotal,
                ]);

                return redirect('pesan-menu/'. $no_transaksi)->with('success', 'Data berhasil dimasukkan!');

            } else {

                //! Cek jml
                $jml_lama = Menu::where('menu', $request->menu_makanan)->where('no_transaksi', $no_transaksi)->first();

                //! Aritmatika
                $jml_baru  = $jml_lama->jml +$request->jml;
                $subtotal  = $jml_baru * $data_master->harga;

                $data_makanan->update([
                    'jml'               => $jml_baru,
                    'subtotal'          => $subtotal,
                ]);

                return redirect('pesan-menu/'. $no_transaksi)->with('success', 'Data berhasil dimasukkan!');
            }
        } 

        //! Minuman
        if ($kategori_proses == "minuman") {

            $data_master  = MasterMenu::where('nama_menu', $request->menu_minuman)->first();
            $data_minuman = Menu::where('menu', $request->menu_minuman)->where('no_transaksi', $no_transaksi)->first();
            $cek_jml      = Menu::where('menu', $request->menu_minuman)->where('no_transaksi', $no_transaksi)->count();

            //! Cek jika data sudah ada
            if (!$cek_jml) {

                //! Hitung subtotal
                $subtotal = $request->jml * $data_master->harga;

                //! Insert data
                Menu::create([
                    'no_transaksi'      => $no_transaksi,
                    'menu'              => $request->menu_minuman,
                    'kategori'          => "Minuman",
                    'jml'               => $request->jml,
                    'harga'             => $data_master->harga,
                    'subtotal'          => $subtotal,
                ]);

                return redirect('pesan-menu/'. $no_transaksi)->with('success', 'Data berhasil dimasukkan!');

            } else {

                //! Cek jml
                $jml_lama = Menu::where('menu', $request->menu_minuman)->where('no_transaksi', $no_transaksi)->first();

                //! Aritmatika
                $jml_baru  = $jml_lama->jml +$request->jml;
                $subtotal  = $jml_baru * $data_master->harga;

                $data_minuman->update([
                    'jml'               => $jml_baru,
                    'subtotal'          => $subtotal,
                ]);

                return redirect('pesan-menu/'. $no_transaksi)->with('success', 'Data berhasil dimasukkan!');
            }

        }
    }

    public function checkout_akhir(Request $request, $no_transaksi)
    {
        //! Data
        $detail_menu      = Menu::where('no_transaksi', $no_transaksi)->get();
        $grandtotal_menu  = Menu::where('no_transaksi', $no_transaksi)->sum('subtotal');
        $data_booking     = Booking::where('no_transaksi', $no_transaksi)->first();


        //! Aritmatika
        $grandtotal   = $data_booking->grandtotal + $grandtotal_menu; 


        //! Update Grandtotal Booking
        $data_booking->update([
            'grandtotal'    => $grandtotal
        ]);

        return redirect('booking');

    }
}
