<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Transaksi</title>
</head>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <h2>Restaurant Table Service</h2>


    <table>
        <tr>
            <td>Tanggal Transaksi</td>
            <td>: {{ $data_booking->created_at }}</td>
        </tr>
        <tr>
            <td>Nomor Transaksi</td>
            <td>: {{ $data_booking->no_transaksi }}</td>
        </tr>
        <tr>
            <td>Jam Awal</td>
            <td>: {{ $data_booking->jam_awal }}</td>
        </tr>
        <tr>
            <td>Jam Akhir</td>
            <td>: {{ $data_booking->jam_akhir }}</td>
        </tr>
        {{-- <tr>
            <td>Grandtotal</td>
            <td>: {{ number_format($data_booking->grandtotal, 0,',','.') }}</td>
        </tr> --}}
    </table>

    <h4>Data Booking</h4>
    <table>
        <tr>
            <td>Nama Meja</td>
            <td>: {{ $data_meja->nama_meja }}</td>
        </tr>
        <tr>
            <td>Jenis Meja</td>
            <td>: {{ $data_meja->jenis_meja }}</td>
        </tr>
        <tr>
            <td>Kapasitas</td>
            <td>: {{ $data_meja->kapasitas }} {{ $data_meja->satuan }}</td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>: {{ number_format($subtotal_meja,0,',','.') }}</td>
        </tr>
    </table>

    <h4>Menu</h4>
    <table>
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
            @foreach ($data_menu as $dm)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $dm->menu }}</td>
                    <td>{{ $dm->jml }}</td>
                    <td>{{ number_format($dm->harga) }}</td>
                    <td>{{ number_format($dm->subtotal) }}</td>
                </tr>
            <?php
                $no++;
            ?>
            @endforeach
        </tbody>
    </table>

    <h4>Total Yang Harus Dibayarkan</h4>
    <table>
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Nominal</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Booking Meja</td>
                <td>{{ number_format($subtotal_meja,0,',','.') }}</td>
            </tr>
            <tr>
                <td>Menu</td>
                <td>{{ number_format($sum_menu,0,',','.') }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>{{ number_format($data_booking->grandtotal, 0,',','.') }} </td>
            </tr>
        </tbody>
    </table>
</body>
</html>