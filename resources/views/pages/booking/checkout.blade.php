@extends('layouts.checkout')
@section('title-page', 'Checkout')
@section('title-content', 'Checkout')

{{-- @push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush --}}

@section('main-content')
    <div class="container">
        <div class="row justify-content-center margin-top-50">
            <div class="col-lg-6 offset-lg-2 col-sm-12">
                <div class="card border border-danger">
                    <div class="card-header text-center bg-danger text-white">
                        <h4 class="text-center">Jadwal Sudah Terisi</h4>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            *
                            Pastikan memilih jam yang belum terisi, jika memilih jam yang telah terisi maka tidak akan di Acc oleh admin!.
                        </p>
                        <table class="table table-striped">
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
                                @forelse ($meja as $mj)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $mj->jam_awal }}</td>
                                        <td>{{ $mj->jam_akhir }}</td>
                                    </tr>
                                <?php
                                    $no++;
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success border border-success text-white text-center">
                        <h4 class="text-center">Data Meja</h4>
                    </div>

                    <div class="card-body"> 
                        <table>
                            <tr>
                                <td>Nama Meja</td>
                                <td>: {{ $data_checkout->meja->nama_meja}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>: {!! Str::limit($data_checkout->meja->deskripsi, 25, ' ...') !!} </td>
                            </tr>
                            <tr>
                                <td>Jenis Meja</td>
                                <td>: {{ $data_checkout->meja->jenis_meja }}</td>
                            </tr>
                            <tr>
                                <td>Daya Tampung</td>
                                <td>: {{ $data_checkout->meja->kapasitas }} {{ $data_checkout->meja->satuan }}</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>: {{ number_format($data_checkout->meja->harga, 0, ',', '.') }} <i>/Jam</i></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 offset-lg-8 margin-bottom-50">
                <div class="card">
                    <div class="card-header bg-primary border border-primary text-white text-center">
                        <h4 class="text-center">Pilih Waktu Booking</h4>
                    </div>

                    <div class="card-body"> 
                        <form action="{{ url('checkout') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Jam Awal</label>
                                <input type="time" name="jam_awal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Jam Akhir</label>
                                <input type="time" name="jam_akhir" class="form-control">
                            </div>

                            <!-- Hidden Value -->
                            <input type="hidden" name="no_transaksi" value="{{ $data_checkout->no_transaksi }}">
                            <input type="hidden" name="mejaID" value="{{ $data_checkout->mejaID }}">

                            <button type="submit" class="btn btn-block btn-sm btn-primary">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
