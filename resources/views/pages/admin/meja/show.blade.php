@extends('layouts.admin.app')
@section('title-page', 'Meja Settings')
@section('setting', 'active')
@section('meja-setting', 'active')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="margin-top-50 margin-0-0-20">Setting Meja</h2>

                <div class="card">
                    <div class="card-body">

                        <img src="{{ URL::asset('uploads/'. $data_meja->foto) }}"  alt="tampil" srcset="" 
                            style="
                                width: 100%;
                                height: 350px;
                                background-image: cover;
                            "
                        >

                        <table class="margin-top-50">
                            <tr class="lead">
                                <td>Nama Meja</td>
                                <td>: {{ $data_meja->nama_meja }}</td>
                            </tr>
                            <tr class="lead">
                                <td>Deskripsi</td>
                                <td>: {{ $data_meja->deskripsi }}</td>
                            </tr>
                            <tr class="lead">
                                <td>Jenis Meja</td>
                                <td>: {{ $data_meja->jenis_meja }}</td>
                            </tr>
                            <tr class="lead">
                                <td>Kapasitas Meja</td>
                                <td>: {{ $data_meja->kapasitas }}</td>
                            </tr>
                            <tr class="lead">
                                <td>Harga</td>
                                <td>: {{ number_format($data_meja->harga, 0, ',', '.') }} /jam</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <a href="{{ url('admin/meja-setting') }}" class="btn btn-secondary margin-top-50 margin-bottom-50"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
@endsection



