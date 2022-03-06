@extends('layouts.checkout')
@section('title-page', 'Bukti Pembayaran')
@section('title-content', 'Bukti Pembayaran')

{{-- @push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush --}}

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 margin-top-100">
                <div class="card margin-bottom-50">
                    <div class="card-header text-center">
                        Bukti Pembayaran
                    </div>
                    <div class="card-body">
                        <p class="lead text-center">
                            Untuk pembayaran bisa transfer melalui Rekening BRI :
                            <b>3714 0102 3780 534</b> Atas Nama <b>Adhimas Putra Nugraha Sugianto</b>, dan screenshoot bukti transfer anda kemudian upload dengan menekan tombol dibawah  : 
                        </p>

                        <div class="card-body border border-success border-radius-20">
                            <form action="{{ url('booking/bukti-pembayaran/' . $data_booking->no_transaksi) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Pilih Foto</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-block btn-success">
                                    Upload
                                </button>
                            </form>
                        </div>

                        <p class="lead margin-top-20 text-danger">
                            <b>Catatan</b>: Jika telah upload bukti pembayaran dan telah di acc oleh admin maka akan muncul pada halaman booking anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
