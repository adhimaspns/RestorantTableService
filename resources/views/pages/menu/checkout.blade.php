@extends('layouts.checkout')
@section('title-page', 'Pesan Menu')
@section('title-content', 'Pesan Menu')

{{-- @push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush --}}

@section('main-content')
    <div class="container">
        <div class="row justify-content-center margin-top-50">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        Menu Makanan
                    </div>
                    <div class="card-body">
                        <form action="{{ url('pesan-menu/proses/makanan/'. $no_transaksi) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Menu Makanan</label>
                                <select name="menu_makanan" class="form-control">
                                    <option value="">=== Pilih Menu Makanan ===</option>
                                    @forelse ($menu_makanan as $mm)
                                        <option value="{{ $mm->nama_menu }}">{{ $mm->nama_menu }} || 1 {{ $mm->satuan }} @ {{ number_format($mm->harga,0, ',','.') }}</option>
                                    @empty
                                        Data Kosong
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jml" min="1" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success btn-block">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        Minuman
                    </div>
                    <div class="card-body">
                        <form action="{{ url('pesan-menu/proses/minuman/'. $no_transaksi) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Minuman</label>
                                <select name="menu_minuman" class="form-control">
                                    <option value="">=== Pilih Minuman ===</option>
                                    @forelse ($menu_minuman as $minuman)
                                        <option value="{{ $minuman->nama_menu }}">{{ $minuman->nama_menu }} || 1 {{ $minuman->satuan }} @ {{ number_format($minuman->harga,0, ',','.') }}</option>
                                    @empty
                                        Data Kosong
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jml" min="1" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success btn-block">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 margin-top-50 margin-bottom-50">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $no = 1;
                        ?>
                        @forelse ($data_menu as $dm)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $dm->menu }}</td>
                                <td>{{ $dm->jml }}</td>
                                <td>Rp. {{ number_format($dm->harga, 0,',','.') }}</td>
                                <td>Rp. {{ number_format($dm->subtotal, 0,',','.') }}</td>
                            </tr>
                        <?php
                            $no++;
                        ?>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="4" class="text-center">Total</td>
                            <td>Rp. {{ number_format($sum_subtotal,0,',','.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <a href="{{ url('pesan-menu/checkout/'. $no_transaksi) }}" class="btn btn-block btn-primary">
                    Checkout
                </a>

                {{-- <form action="{{ url('pesan-menu/checkout/'. $no_transaksi) }}" method="post">
                    @csrf

                    <input type="text" name="no_transaksi" value="{{}}">
                    <button type="submit" class="btn btn-primary btn-block">
                        Checkout
                    </button>
                </form> --}}
            </div>
        </div>
    </div>
@endsection

@push('prepend-scripts')
    <script src="{{ URL::asset('addon/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::asset('addon/js/jquery.maskMoney.min.js') }}"></script>

    <script>
        $('#harga').maskMoney({prefix:'Rp. ',allowNegative:false,thousand:'.',decimal:'.',precision:0,affixesStay:false});
    </script>

@endpush
