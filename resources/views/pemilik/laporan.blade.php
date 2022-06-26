<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container-laporan {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header-laporan {
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 800px;
            height: 1200px;
        }

        .data-laporan thead {
            background-color: rgb(0, 201, 184);
        }

        table td th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px !important;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
</head>

<body>
    <div class="container-laporan">
        <div class="header-laporan">
            <h1>Laporan Penjualan</h1>
            <h2>CV. Sumber Karunia</h2>
            <h3>Dari {{ $tanggalAwal }} - {{ $tanggalSekarang }}</h3>
        </div>
        <div class="data-laporan">
            <table class="table">
                <thead>
                    <tr style="padding: 20px">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Pembelian</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                        $totalLaporan = count($laporans);
                    @endphp
                    @foreach ($laporans as $key => $laporan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $laporan['produk']->nama }}</td>
                            <td>{{ $laporan->created_at }}</td>
                            <td>{{ $laporan->jumlah }}</td>
                            <td>{{ $laporan['produk']->harga }}</td>
                            <td>{{ $laporan->jumlah * $laporan['produk']->harga }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="font-weight: bold">
                            Total Keseluruhan
                        </td>
                        <td colspan="1" style="font-weight: bold">
                            {{ $totalBarang }}
                        </td>
                        <td></td>
                        <td style="font-weight: bold">
                            {{ $totalHarga }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
