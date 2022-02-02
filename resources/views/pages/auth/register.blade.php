@extends('layouts.auth')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 margin-top-100">
                <div class="card margin-bottom-50">
                    <div class="card-header text-center">
                        Register
                    </div>
                    <div class="card-body">
                        <form action="{{ url('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control  @error('nama') is-invalid  @enderror" value="{{ old('nama') }}" placeholder="Adhimas Putra Nugraha Sugianto">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control  @error('username') is-invalid  @enderror" value="{{ old('username') }}" placeholder="min:3">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pasword</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control  @error('alamat') is-invalid  @enderror" placeholder="Dsn. Mlaten Ds. Mlaten RT 01 RW 02">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jns_kelamin" class="form-control  @error('jns_kelamin') is-invalid  @enderror">
                                    <option value="">=== Pilih Jenis Kelamin ===</option>
                                    <option value="Laki-laki" @if (old('jns_kelamin') == "Laki-laki") {{ 'selected' }} @endif>Laki-laki</option>
                                    <option value="Perempuan" @if (old('jns_kelamin') == "Perempuan") {{ 'selected' }} @endif>Perempuan</option>
                                </select>
                                @error('jns_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="number" name="no_telp" min="1" class="form-control  @error('no_telp') is-invalid  @enderror" value="{{ old('no_telp') }}" placeholder="min:11, max:13">
                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection