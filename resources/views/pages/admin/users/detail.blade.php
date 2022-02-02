@extends('layouts.admin.app')
@section('title-page', 'User Settings')
@section('setting', 'active')
@section('user', 'active')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="margin-0-0-50 margin-top-50">Detail Customer</h2>

                <div class="card">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td class="lead font-weight-bold">Nama Lengkap</td>
                                <td class="lead">: {{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Jenis Kelamin</td>
                                <td class="lead">: {{ $user->jns_kelamin }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Nomor Telepon</td>
                                <td class="lead">: {{ $user->no_telp }}</td>
                            </tr>
                            <tr>
                                <td class="lead font-weight-bold">Alamat Lengkap</td>
                                <td class="lead">: {{ $user->alamat }}</td>
                            </tr>
                        </table>

                        <p class="lead text-center margin-top-50">
                            <span class="font-italic">Bergabung Pada</span> {{ date('d M Y', strtotime($user->created_at)) }}
                        </p>
                    </div>

                    <a href="{{ url('admin/user-setting') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection


