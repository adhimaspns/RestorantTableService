@extends('layouts.app')
@section('title-page', 'Restaurant Table Service')
@section('booking', 'active')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if ($user_booking == null && $data_meja == null OR $user_booking->status == "Berhasil")
                    @if ($user_booking == null OR $user_booking->status == "Berhasil")
                        <div class="alert alert-secondary margin-top-50 text-center" style="margin-top: 150px !important;" role="alert">
                            Tidak ada transaksi
                        </div>
                    @endif
                @else
                    @if ($user_booking->status == "Menunggu Pembayaran")
                        <div class="alert alert-success text-center" style="margin-top: 150px" role="alert">
                            Booking telah disetujui admin, silahkan melakukan pembayaran!
                        </div>
                    @endif
                    @if ($user_booking->status == "Diproses")
                        <div class="alert alert-success text-center" style="margin-top: 150px" role="alert">
                            Transaksi sedang diproses oleh admin!
                        </div>
                    @endif

                    @if ($user_booking->status == "Menunggu Persetujuan")
                        <div class="alert alert-warning text-center" style="margin-top: 150px" role="alert">
                            Booking anda menunggu persetujuan admin!
                        </div>
                    @endif

                    @if ($user_booking->status == "Salah Jadwal")
                        <div class="alert alert-danger text-center" style="margin-top: 150px" role="alert">
                            Booking anda dibatalkan oleh admin!
                        </div>
                        <p class="lead text-center">
                            Admin membatalkan booking anda karena telah memilih waktu yang telah di booking orang lain.
                        </p>
                    @endif
                    @if ($user_booking->status == "gagal")
                        <div class="alert alert-danger text-center" style="margin-top: 150px" role="alert">
                            Booking anda digagalkan!
                        </div>
                        <p class="lead text-center">
                            Admin menggagalkan bookingan anda karena melanggar aturan!
                        </p>
                    @endif
                @endif
            </div>

            @if ($user_booking != null && $data_meja != null)
                <div class="col-lg-8 margin-top-50">
                    @if ($user_booking->status == "Menunggu Pembayaran" OR $user_booking->status == "Menunggu Persetujuan" OR $user_booking->status == "Diproses")
                        <table class="table table-bordered table-striped table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Meja</th>
                                    <th>Durasi</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{ $data_meja->nama_meja}}</td>
                                    <td>{{ $user_booking->jam_awal }} s/d {{ $user_booking->jam_akhir}}</td>
                                    <td>Rp. {{ number_format($user_booking->grandtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                    @endif

                    @if ($user_booking->status == "Menunggu Pembayaran")
                        <p class="lead text-center">
                            Untuk pembayaran transfer melalui Rekening BRI :
                            <b>3714 0102 3780 534</b> Atas Nama <b>Adhimas Putra Nugraha Sugianto</b>, jika dalam kurun waktu 30 menit dari durasi awal booking belum melakukan pembayaran maka akan dibatalkan oleh admin. screenshoot bukti transfer anda kemudian upload dengan menekan tombol dibawah! 
                        </p>
                        <center>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-lg fa-money-check-alt"></i> Upload Bukti Pembayaran
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Upload bukti transfer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('booking/bukti-pembayaran/' . $user_booking->no_transaksi) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Pilih Foto</label>
                                                    <input type="file" name="file" class="form-control @error('file') is-invalid  @enderror" required>
                                                    @error('file')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-block btn-success">
                                                Upload
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </center>
                    @endif

                    @if ($user_booking->status == "Diproses")
                        <p class="lead text-center">
                            Pembayaran sedang diproses, jika pembayaran berhasil maka akan muncul Nomor Booking dan tunjukan kepada petugas ditempat!
                        </p>
                    @endif
                </div>

                <div class="col-lg-6">
                    @if ($user_booking->status == "Sukses")
                        <div class="card" style="margin-top: 150px;">
                            <div class="card-header text-center bg-alert-success">
                                <b>Pembayaran Sukses</b>
                            </div>
                            <div class="card-body">
                                <center>
                                    <table>
                                        <tr>
                                            <td class="lead font-weight-bolder">Nomor Booking </td>
                                            <td class="lead font-weight-bolder">: {{ $user_booking->no_transaksi }}</td>
                                        </tr>
                                    </table>

                                    <p class="lead margin-top-20 font-italic">
                                        Tunjukan nomor ini kepada admin!
                                    </p>
                                </center>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        
    </div>
@endsection

{{-- @push('prepend-scripts')
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
@endpush --}}

