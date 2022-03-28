@extends('layouts.admin.app')
@section('title-page', 'Booking')
@section('booking', 'active')

@push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2 class="margin-top-50">Data Booking - Menunggu Persetujuan</h2>
            </div>

            <div class="col-lg-6 margin-top-50">
                <div class="card">
                    <div class="card-header text-center">
                        Jadwal Terisi
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jam Awal</th>
                                    <th>Jam Akhir</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $no = 1;
                                ?>
                                @forelse ($data_meja as $dm)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $dm->jam_awal }}</td>
                                        <td>{{ $dm->jam_akhir }}</td>
                                    </tr>
                                <?php
                                    $no++
                                ?>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Data Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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

                        <a href="{{ url('admin/persetujuan/'. $no_transaksi .'/setuju') }}" class="btn btn-block btn-success">
                            Setujui
                        </a>
                        <a href="{{ url('admin/persetujuan/'. $no_transaksi .'/tolak') }}" class="btn btn-block btn-danger">
                            Tolak
                        </a>
                    </div>
                </div>

                <a href="{{ url('admin/booking') }}" class="btn btn-secondary margin-top-20">
                    <i class="fas fa-arrow-circle-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
