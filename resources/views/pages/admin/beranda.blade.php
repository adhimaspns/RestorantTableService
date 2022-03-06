@extends('layouts.admin.app')
@section('title-page', 'Beranda')
@section('beranda', 'active')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center margin-top-50">

            <div class="col-lg-12">
                <h2 class="text-center margin-0-0-50">Transaksi Harian</h2>
            </div>

            <div class="col-lg-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <h5>Menunggu Persetujuan</h5>
                        <h3>{{$menunggu_persetujuan}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h5>Menunggu Pembayaran</h5>
                        <h3>{{$menunggu_pembayaran}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h5>Transaksi Berhasil</h5>
                        <h3>{{$booking_berhasil}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


