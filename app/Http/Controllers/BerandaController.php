<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data_meja = Meja::where('status', 'Kosong')->orderBy('nama_meja', 'ASC')->paginate(10);

        return view('pages.beranda', compact('data_meja'));
    }
}
