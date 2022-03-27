@extends('layouts.admin.app')
@section('title-page', 'Menu')
@section('menu', 'active')
@section('makanan', 'active')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 margin-top-50">
                <div class="card">
                    <div class="card-header text-center">
                        Detail {{$data_makanan->nama_menu}}
                    </div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <td class="lead font-weight-normal">Nama Menu </td>
                                <td class="lead font-weight-light">: {{$data_makanan->nama_menu}}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-normal">Porsi Penyajian</td>
                                <td class="lead font-weight-light">: 1 {{$data_makanan->satuan}}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-normal">Ketersediaan</td>
                                <td class="lead font-weight-light">: {{$data_makanan->status}}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-normal">Harga /porsi</td>
                                <td class="lead font-weight-light">: Rp. {{ number_format($data_makanan->harga, 0, ',','.')}}</td>
                            </tr>
                        </table>

                        <hr>

                        <img src="{{ URL::asset('uploads/menu/makanan/'. $data_makanan->foto) }}"  alt="tampil" srcset="" 
                            style="
                                width: 100%;
                                height: 350px;
                                background-image: cover;
                            "
                        >
                    </div>
                </div>

                <a href="{{ url('admin/menu/makanan') }}" class="btn btn-secondary margin-top-20 margin-bottom-50">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection


