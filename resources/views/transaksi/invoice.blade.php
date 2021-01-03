<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Makam</title>
    <style>
        .table-border {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-border tr td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px 10px;
        }

        .table-text-top tr td {
            vertical-align: text-top;
        }
        td.table-title {
            background-color: silver;
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .text-right {
            text-align: right;
        }

        .text-top {
            vertical-align: text-top;
        }

        .page-break {
            page-break-after: always;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div style="text-align: center">
            <h3>Invoice Pembelian Makam by Rekam</h3>
        </div>
        <strong>Data Makam</strong>
        <table class="table-text-top">
            <tr>
                <td>Nama Makam</td>
                <td>:</td>
                <td>{{ $transaksi->makam->nama }}</td>
            </tr>
            <tr>
                <td>Harga Makam</td>
                <td>:</td>
                <td>{{ $transaksi->makam->harga_rupiah }}</td>
            </tr>
            <tr>
                <td>Lokasi Makam</td>
                <td>:</td>
                <td>{{ $transaksi->makam->alamat }}</td>
            </tr>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>Kec. {{ $transaksi->makam->kecamatan->nama }}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>Kab. {{ $transaksi->makam->kabupaten->nama }}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>Prov. {{ $transaksi->makam->provinsi->nama }}</td>
            </tr>
        </table>
        <strong>Data Transaksi</strong>
        <table class="table-text-top">
            <tr>
                <td>Total Transaksi</td>
                <td>:</td>
                <td>{{ $transaksi->makam->harga_rupiah }}</td>
            </tr>
            <tr>
                <td>Waktu Transaksi</td>
                <td>:</td>
                <td>{{ $transaksi->waktu_transaksi }}</td>
            </tr>
            <tr>
                <td>Waktu Pembayaran</td>
                <td>:</td>
                <td>{{ $transaksi->waktu_pembayaran }}</td>
            </tr>
        </table>
        <br>
        <br>
        <div style="float: right; text-align: center;">
            <span>Surabaya, {{ $transaksi->tanggal }}</span>
            <br>
            <span>Penjual Makam</span>
            <br>
            <br>
            <br>
            TTD
            <br>
            <span>{{ $transaksi->makam->user->name }}</span>
        </div>
    </div>
</body>

</html>
