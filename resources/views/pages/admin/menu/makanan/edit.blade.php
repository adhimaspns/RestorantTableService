@extends('layouts.admin.app')
@section('title-page', 'Menu')
@section('menu', 'active')
@section('makanan', 'active')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 margin-bottom-50 margin-top-50">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Edit Data</h2>
                    </div>
    
                    <div class="card-body">
                        <img src="{{ URL::asset('uploads/menu/makanan/'. $data_menu->foto) }}"  alt="tampil" srcset="" 
                            style="
                                width: 100%;
                                height: 350px;
                                background-image: cover;
                            "
                            class="img-thumbnail"
                        >

                        <hr>

                        <form action="{{ url('admin/menu/makanan/' . $data_menu->id_menu) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Menu Makanan</label>
                                <input type="text" name="menu" class="form-control" value="{{ $data_menu->nama_menu }}" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                    <select name="satuan" class="form-control">
                                        <option value="">=== Pilih Satuan ===</option>
                                        <option value="Piring" @if ($data_menu->satuan == "Piring") {{ 'selected' }} @endif>Piring</option>
                                        <option value="Mangkok" @if ($data_menu->satuan == "Mangkok") {{ 'selected' }} @endif>Mangkok</option>
                                        <option value="Gelas" @if ($data_menu->satuan == "Gelas") {{ 'selected' }} @endif>Gelas</option>
                                        {{-- <option value="Kursi" @if (old('satuan') == "Kursi") {{ 'selected' }} @endif>Kursi</option> --}}
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Ganti Foto (Optional)</label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid  @enderror">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" id="harga" name="harga" class="form-control" value="{{ $data_menu->harga }}" required>
                            </div>

                            <button type="submit" class="btn btn-block btn-success">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>

                <a href="{{ url('admin/menu/makanan') }}" class="btn btn-secondary margin-top-20">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection