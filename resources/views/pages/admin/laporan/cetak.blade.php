<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
</head>
<body>
    <center>
        <h2>Laporan Transaksi</h2>

        <table>
            <tr>
                <td>Dari Tanggal</td>
                <td>: {{ $tgl_awal }}</td>
            </tr>
            <tr>
                <td>Sampai Tanggal</td>
                <td>: {{ $tgl_akhir }}</td>
            </tr>
        </table>
        <table border="1" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Transaksi</th>
                    <th>Nama Meja</th>
                    <th>Status</th>
                    <th>Grandtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $no = 1;
                ?>
                @forelse ($laporan as $lp)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $lp->no_transaksi }}</td>
                        <td>{{ $lp->meja->nama_meja }}</td>
                        <td>{{ $lp->status }}</td>
                        <td>Rp. {{ number_format($lp->grandtotal, 0, ',','.') }}</td>
                    </tr>
                <?php
                    $no++
                ?>
                @empty
                    <tr>
                        <td>Data Kosong</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4">Total</td>
                    <td>Rp. {{ number_format($sum, 0,',','.') }}</td>
                </tr>
            </tbody>
        </table>
    </center>

</body>
</html>