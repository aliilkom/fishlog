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
                            <!-- <img src="https://api.minapoli.com/media/renters/p/0f567bc89dce587d8567211a73889d84.png" class="rounded mx-auto d-block text-center"> -->
                            <h1>Struk Stok Rental Masuk</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table class="text-center" id="table-data" width="100%">
        <tr>
            <td><b>ID Struk</b></td>
            <td>: {{ $Stockrentin->id }}</td>
            <td><b>Penyewa</b></td>
            <td>: {{ $Stockrentin->renter->nama }}</td>
        </tr>

        <tr>
            <td><b>Tanggal Masuk</b></td>
            <td>: {{ $Stockrentin->tanggal }}</td>
            <td><b>Telepon</b></td>
            <td>: {{ $Stockrentin->renter->telepon }}</td>
            
        </tr>

        <tr>
            <td><b>Gudang</b></td>
            <td >: {{ $Stockrentin->product->warehouse->nama }}</td>
            <td><b>Alamat</b></td>
            <td>: {{ $Stockrentin->renter->alamat }}</td>
            
        </tr>
        
        <tr>
            <td><b>Barang</b></td>
            <td >: {{ $Stockrentin->product->nama }}</td>
            <td><b>Email</b></td>
            <td>: {{ $Stockrentin->renter->email }}</td>
           
        </tr>

        <tr>
            <td><b>Stok Masuk</b></td>
            <td >: {{ $Stockrentin->jumlah }}</td>
            <td><b>Pembayaran</b></td>
            <td>: {{ $Stockrentin->pembayaran }}</td>
           
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
