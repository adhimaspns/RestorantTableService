@extends('layouts.admin.app')
@section('title-page', 'Booking')
@section('booking', 'active')
@section('pembayaran', 'active')

@push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2 class="margin-top-50">Data Booking - Menunggu Pembayaran</h2>
            </div>

            <div class="col-lg-12 margin-top-20 margin-bottom-50">
                <div class="card">
                    <div class="card-header">
                        Booking - {{ $no_transaksi }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Meja</th>
                                    <th>Durasi</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{ $data_booking->meja->nama_meja }}</td>
                                    <td>{{ $data_booking->jam_awal }} s/d {{ $data_booking->jam_akhir }}</td>
                                    <td>Rp. {{ number_format($data_booking->grandtotal, 0, ',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        @if ($data_booking->bukti_transfer != null)
                            <p>
                                Bukti Transfer :
                            </p>
                            <img src="{{ URL::asset('uploads/bukti-transfer/'. $data_booking->bukti_transfer) }}"
                                alt="bukti-transfer"
                                class="margin-0-0-50"
                                style="
                                    width: 350px !important;
                                    height: auto !important;
                                "
                            >
                        @else
                            <p>
                                Bukti Transfer : -
                            </p>
                        @endif

                        <a href="{{ url('admin/persetujuan/'. $no_transaksi .'/checkout') }}" class="btn btn-block btn-success">
                            Checkout
                        </a>
                        <a href="{{ url('admin/persetujuan/'. $no_transaksi .'/gagal') }}" class="btn btn-block btn-danger">
                            Gagal
                        </a>

                    </div>
                </div>

                <a href="{{ url('admin/booking/menunggu-pembayaran') }}" class="btn btn-secondary margin-top-20">
                    <i class="fas fa-arrow-circle-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
