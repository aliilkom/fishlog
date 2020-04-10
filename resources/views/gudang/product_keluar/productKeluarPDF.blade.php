<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>


</head>

<style>
    #table-data {
        border-collapse: collapse;
        padding: 3px;
    }

    #table-data td, #table-data th {
        border: 1px solid black;
    }
</style>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
            <table>
                    <tr  align="center">
                        <td class="title">
                            <!-- <img src="https://api.minapoli.com/media/customers/p/0f567bc89dce587d8567211a73889d84.png" class="rounded mx-auto d-block text-center"> -->
                            <h1>Struk Stok Keluar</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table class="text-center" id="table-data" width="100%">
        <tr>
            <td><b>ID Struk</b></td>
            <td>: {{ $product_keluar->id }}</td>
            <td><b>Nama</b></td>
            <td>: {{ $product_keluar->customer->nama }}</td>
        </tr>

        <tr>
            <td><b>Tanggal Keluar</b></td>
            <td>: {{ $product_keluar->tanggal }}</td>
            <td><b>Perusahaan</b></td>
            <td>: {{ $product_keluar->customer->perusahaan }}</td>
            
        </tr>

        <tr>
            <td><b>Gudang</b></td>
            <td >: {{ $product_keluar->product->warehouse->nama }}</td>
            <td><b>Telepon</b></td>
            <td>: {{ $product_keluar->customer->telepon }}</td>
            
        </tr>
        
        <tr>
            <td><b>Barang</b></td>
            <td >: {{ $product_keluar->product->nama }}</td>
            <td><b>Alamat</b></td>
            <td>: {{ $product_keluar->customer->alamat }}</td>
           
        </tr>

        <tr>
            <td><b>Stok Keluar</b></td>
            <td >: {{ $product_keluar->jumlah }}</td>
            <td><b>Pembayaran</b></td>
            <td>: {{ $product_keluar->pembayaran }}</td>
           
        </tr>

    </table>

    {{--<hr  size="2px" color="black" align="left" width="45%">--}}

    <br><br><br>
    <table border="0" width="100%">
        <tr align="right">
            <td>Hormat Kami</td>
        </tr>
    </table>

    <table border="0" width="80%">
        <tr align="right">
            <!-- <td><img src="https://upload.wikimedia.org/wikipedia/en/f/f4/Timothy_Spall_Signature.png" width="100px" height="100px"></td> -->
        </tr>
    <br><br><br>
    </table>
    <table border="0" width="100%">
        <tr align="right">
            <td>{{Auth::user()->name}}</td>
        </tr>
    </table>
</div>

