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
            margin: 0 auto;
        }

        .header-laporan {
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 800px;
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

        .detail-customer {
            display: flex;
            width: 100%;
            flex-direction: row;
        }
        .detail-customer .right {            
            background-color: red;
        }
        .detail-customer .left{
            
        }

        .data-laporan,
        .detail-customer {
            width: 100%
        }

    </style>
</head>

<body>
    <div class="container-laporan">
        <div class="header-laporan">
            <h1>Invoice Pembelian</h1>
            <h2>CV. Sumber Karunia</h2>
            <h4>{{$pembayaran[0]->updated_at->format('M Y D, h:m:s')}}</h4>
        </div>
        <div class="detail-customer">
            <div class="left">
                <h4>Nama Pembeli        : {{ $user[0]->name }} </h4>
                <h4>Alamat              : {{ $user[0]->alamat }}</h4>
                <h4>Total Pembayaran    : {{ $pembayaran[0]->total }}</h4>
                <h4>Metode Pembayaran   : {{ $pembayaran[0]->metode_pembayaran }}</h4>
            </div>
            
        </div>
        <div class="data-laporan">
            <h3>Detail Pesanan</h3>
            <table class="table">
                <thead>
                    <tr style="padding: 20px">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($orderDetails as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->produk->nama }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->sub_total }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="font-weight:bold" colspan="4">Pengiriman</td>
                        <td style="font-weight:bold">{{ $pengiriman[0]->biaya }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold" colspan="4">Total</td>
                        <td style="font-weight:bold">{{ $pembayaran[0]->total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
