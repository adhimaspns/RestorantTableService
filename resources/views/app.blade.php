@extends('layouts.app')
@section('title-page', 'Restaurant Table Service')
@section('beranda', 'active')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        @forelse ($data_meja as $meja)
            <center>
            <div class="col col-sm-12 margin-top-50 margin-bottom-50">
                <div class="card" style="width: 18rem !important;">
                    <img src="{{ URL::asset('uploads/' . $meja->foto) }}" class="card-img-top" alt="img-meja" style="
                        height: 250px !important;
                        background-size: cover !important;
                        background-repeat: no-repeat;
                        background-position: 50% 50%;
                    ">
                    <div class="card-body">
                        <h5 class="card-title">{{ $meja->nama_meja }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-chair"></i> {{ $meja->jenis_meja }}</h6>
                        <p class="card-text">{!! Str::limit($meja->deskripsi, 25, ' ...') !!}</p>

                        <i class="text-muted">Rp. {{ number_format($meja->harga, 0, ',', '.') }} /Jam</i>

                        @if (Auth::check())
                            <a href="{{ url('proses-checkout/' .$meja->id_meja ) }}" class="btn btn-success"><i class="fas fa-calendar-check"></i> Booking</a>
                        @else
                            <a href="{{ url('login') }}" class="btn btn-success"><i class="fas fa-calendar-check"></i> Booking</a>
                        @endif
                    </div>
                </div>
            </div>
            </center>
            @empty
                Data Kosong
        @endforelse
    </div>
</div>
@endsection

