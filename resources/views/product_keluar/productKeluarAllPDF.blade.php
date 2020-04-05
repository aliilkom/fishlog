{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<meta name="viewport"--}}
{{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">--}}
{{--<!-- Font Awesome -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">--}}
{{--<!-- Ionicons -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">--}}

{{--<title>Product keluar Exports All PDF</title>--}}
{{--</head>--}}
{{--<body>--}}
<style>
    #product-keluar {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #product-keluar td, #product-keluar th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #product-keluar tr:nth-child(even){background-color: #f2f2f2;}

    #product-keluar tr:hover {background-color: #ddd;}

    #product-keluar th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<h1>Data Stok Keluar</h1>
    <table id="product-keluar" width="100%">
        <thead>
        <tr>
            <td><b>Gudang</b></td>
            <td><b>Barang</b></td>
            <td><b>Stok Keluar</b></td>
            <td><b>Pembeli</b></td>
            <td><b>Pembayaran</b></td>
            <td><b>Tanggal keluar</b></td>
        </tr>
        </thead>
        @foreach($product_keluar as $p)
            <tbody>
            <tr>
                <td>{{ $p->product->warehouse->nama }}</td>
                <td>{{ $p->product->nama }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->customer->nama }}</td>
                <td>{{ $p->pembayaran }}</td>
                <td>{{ $p->tanggal }}</td>
            </tr>
            </tbody>
        @endforeach

    </table>


{{--<!-- jQuery 3 -->--}}
{{--<script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>--}}
{{--<!-- Bootstrap 3.3.7 -->--}}
{{--<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}


