@extends('layouts.admin.app')
@section('title-page', 'Meja Settings')
@section('setting', 'active')
@section('meja-setting', 'active')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card margin-top-50">
                    <div class="card-body">
                        <h2 class="margin-0-0-20">Edit Data Meja</h2>

                        <img src="{{ URL::asset('uploads/'. $data->foto) }}" alt="tampil" srcset="" 
                            style="
                                width: 100%;
                                height: 350px;
                                background-image: cover;
                                margin-bottom: 20px;
                            "
                        >

                        <form action="{{ url('admin/meja-setting/'. $data->id_meja) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label>Nama Meja</label>
                                <input type="text" name="nama_meja" class="form-control" value="{{ $data->nama_meja }}" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required>{{ $data->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Jenis Meja</label>
                                <select name="jenis_meja" class="form-control" required>
                                    <option value="">=== Pilih Meja ===</option>
                                    <option value="Lesehan" @if ( $data->jenis_meja == "Lesehan") {{ 'selected' }} @endif>Lesehan</option>
                                    <option value="Tempat Duduk" @if ( $data->jenis_meja == "Tempat Duduk") {{ 'selected' }} @endif>Tempat Duduk</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Kapasitas <i>(Max:1000)</i></label>
                                    <input type="text" id="kapasitas" min="1" class="form-control @error('kapasitas') is-invalid  @enderror" name="kapasitas" value="{{ $data->kapasitas }}" required>
                                    @error('kapasitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label>Satuan</label>
                                    <select name="satuan" class="form-control @error('satuan') is-invalid  @enderror">
                                        <option value="">=== Pilih Satuan ===</option>
                                        <option value="Orang" @if ($data->satuan == "Orang") {{ 'selected' }} @endif>Orang</option>
                                        <option value="Kursi" @if ($data->satuan == "Kursi") {{ 'selected' }} @endif>Kursi</option>
                                    </select>
                                    @error('satuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Foto <i>(Optional, max : 2Mb)</i></label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid  @enderror">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" id="harga" name="harga" class="form-control" value="{{ $data->harga }}" required>
                            </div>

                            <button type="submit" class="btn btn-block btn-success margin-top-20">Simpan</button>
                        </form>
                    </div>
                </div>

                <a href="{{ url('admin/meja-setting') }}" class="btn btn-secondary margin-bottom-50 margin-top-20">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection

@push('prepend-scripts')
    <script src="{{ URL::asset('addon/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::asset('addon/js/jquery.maskMoney.min.js') }}"></script>

    <script>
        $('#harga').maskMoney({prefix:'Rp. ',allowNegative:false,thousand:'.',decimal:'.',precision:0,affixesStay:false});
        $('#kapasitas').maskMoney({prefix:'',allowNegative:false,thousand:'.',decimal:'.',precision:0,affixesStay:false});
    </script>
@endpush

