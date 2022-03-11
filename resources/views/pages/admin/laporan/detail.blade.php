@extends('layouts.admin.app')
@section('title-page', 'Laporan')
@section('laporan', 'active')

@push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 margin-top-50 margin-bottom-50">
                <div class="card">
                    <div class="card-header bg-alert-success text-center">
                        Invoice
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td class="lead font-weight-bold">Tanggal Booking</td>
                                <td class="lead">: {{ $laporan->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Kode Transaksi</td>
                                <td class="lead">: {{ $laporan->no_transaksi }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Durasi</td>
                                <td class="lead">: {{ $laporan->jam_awal }} s/d {{ $laporan->jam_akhir }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Customer</td>
                                <td class="lead">: {{ $data_user->nama }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Status</td>
                                <td class="lead">: <span class="badge badge-success">{{ $laporan->status }}</span></td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Grandtotal</td>
                                <td class="lead">: Rp. {{ number_format($laporan->grandtotal,0,',','.') }},-</td>
                            </tr>
                        </table>

                        <hr>

                        <table>
                            <tr>
                                <td class="lead font-weight-bold">Nama Meja</td>
                                <td class="lead">: {{ $data_meja->nama_meja }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Jenis Meja</td>
                                <td class="lead">: {{ $data_meja->jenis_meja }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Kapasitas</td>
                                <td class="lead">: {{ $data_meja->kapasitas }} {{ $data_meja->satuan }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Harga</td>
                                <td class="lead">: Rp. {{ number_format($data_meja->harga, 0,',','.') }} /Jam</td>
                            </tr>
                        </table>

                        <hr>
                        <h4 class="text-center">Bukti Transfer</h4>
                        <img src="{{ URL::asset('uploads/bukti-transfer/'. $laporan->bukti_transfer) }}"
                                alt="bukti-transfer"
                                class="margin-0-0-50"
                                style="
                                    width: 350px !important;
                                    height: auto !important;
                                "
                            >
                    </div>
                </div>

                <a href="{{ url('admin/laporan') }}" class="btn btn-secondary margin-top-20">
                    <i class="fas fa-arror-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection

