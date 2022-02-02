@extends('layouts.admin.app')
@section('title-page', 'User Settings')
@section('setting', 'active')
@section('user', 'active')

@push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body margin-top-100 table-responsive p-0">
                    <h2 class="margin-0-0-50">Monitoring User</h2>
                    <table class="table table-hover text-nowrap table-striped table-bordered" id="user-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Nomor Telepon</th>
                                <th>Bergabung Pada</th>
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

    <script>
        $(function() {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                paging    : true,
                autoWidth : false,  
                responsive: true, 
                ajax: "{{ url('admin/user-json') }}",
                columns: [
                    { "data": null,"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {data: 'nama',   name: 'nama'},
                    {data: 'username',   name: 'username'},
                    {data: 'no_telp',   name: 'no_telp'},
                    {data: 'created_at',   name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush

