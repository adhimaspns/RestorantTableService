@extends('layouts.admin.app')
@section('title-page', 'Booking')
@section('booking', 'active')
@section('booking-sukses', 'active')

@push('prepend-styles')
    <link rel="stylesheet" href="{{ URL::asset('addon/datatables/datatables.min.css') }}">
@endpush

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="margin-top-100 ">Data Booking - Transaksi Sukses</h2>
                <div class="card-body margin-bottom-50 table-responsive p-0">
                    <table class="table table-hover text-nowrap table-striped table-bordered" id="data-meja">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Jam Awal</th>
                                <th>Jam Akhir</th>
                                <th>Status</th>
                                <th>Bukti Tranfser</th>
                                <th>Total Dibayarkan</th>
                                <th>Aksi</th>
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
                ajax: "{{ url('admin/booking-sukses-json') }}",
                columns: [
                    { "data": null,"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {data: 'no_transaksi',   name: 'no_transaksi'},
                    {data: 'jam_awal',       name: 'jam_awal'},
                    {data: 'jam_akhir',      name: 'jam_akhir'},
                    {data: 'status',         name: 'status'},
                    {data: 'bukti_transfer', name: 'bukti_transfer'},
                    {data: 'grandtotal',     name: 'grandtotal'},
                    {data: 'action',         name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush

