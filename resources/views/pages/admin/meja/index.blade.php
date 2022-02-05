@extends('layouts.admin.app')
@section('title-page', 'Meja Settings')
@section('setting', 'active')
@section('meja-setting', 'active')

@push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body margin-top-100 table-responsive p-0">
                    <h2 class="margin-0-0-50">Setting Meja</h2>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary margin-0-0-20" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Meja
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('admin/meja-setting') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nama Meja</label>
                                            <input type="text" name="nama_meja" class="form-control" value="{{ old('nama_meja') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Meja</label>
                                            <select name="jenis_meja" class="form-control" required>
                                                <option value="">=== Pilih Meja ===</option>
                                                <option value="Lesehan" @if (old('jenis_meja') == "Lesehan") {{ 'selected' }} @endif>Lesehan</option>
                                                <option value="Tempat Duduk" @if (old('jenis_meja') == "Tempat Duduk") {{ 'selected' }} @endif>Tempat Duduk</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label>Kapasitas</label>
                                                <input type="number" min="1" class="form-control" name="kapasitas" value="{{ old('kapasitas') }}" required>
                                            </div>
                                            <div class="col">
                                                <label>Satuan</label>
                                                <select name="satuan" class="form-control">
                                                    <option value="">=== Pilih Satuan ===</option>
                                                    <option value="Orang" @if (old('satuan') == "Orang") {{ 'selected' }} @endif>Orang</option>
                                                    <option value="Kursi" @if (old('satuan') == "Kursi") {{ 'selected' }} @endif>Kursi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" name="file" class="form-control @error('file') is-invalid  @enderror" required>
                                            @error('file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" id="harga" name="harga" class="form-control" value="{{ old('harga') }}" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover text-nowrap table-striped table-bordered" id="data-meja">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Meja</th>
                                <th>Jenis Meja</th>
                                <th>Kapasitas</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('prepend-scripts')
    <script src="{{ URL::asset('addon/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::asset('addon/datatables/datatables.min.js') }}" defer></script>
    <script src="{{ URL::asset('addon/js/jquery.maskMoney.min.js') }}"></script>

    <script>
        $('#harga').maskMoney({prefix:'Rp. ',allowNegative:false,thousand:'.',decimal:'.',precision:0,affixesStay:false});
    </script>

    <script>
        $(function() {
            $('#data-meja').DataTable({
                processing: true,
                serverSide: true,
                paging    : true,
                autoWidth : false,  
                responsive: true, 
                ajax: "{{ url('admin/meja-json') }}",
                columns: [
                    { "data": null,"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {data: 'nama_meja',   name: 'nama_meja'},
                    {data: 'jenis_meja',  name: 'jenis_meja'},
                    {data: 'kapasitas',   name: 'kapasitas'},
                    {data: 'harga',       name: 'harga'},
                    {data: 'action',      name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush

