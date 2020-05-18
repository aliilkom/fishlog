@extends('layouts.master')

@section('dashboard')
   Tagihan
   <small>Manajemen Rental</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('berandarental') }}"><i class="fa fa-dashboard"></i>Manajemen Rental</a></li>
    
    <li class="active"><a href="{{ url('tagihan') }}"><i class="fa fa-money"></i>Tagihan</a></li>
@endsection

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    
@endsection

@section('content')
    

    <div class="box col-md-6">

        <div class="box-header">
            <h3 class="box-title">Daftar Tagihan</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="bills-table" class="table table-bordered">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Penyewa</th>
                    <th>Nama Barang</th>
                    <th>Stok Barang</th>
                    <th>Update Stok</th>
                    <th>Tagihan Sewa</th>
                    <th>Keterangan</th>
                    <!-- <th>Cetak Tagihan</th> -->
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    {{--@include('renters.form_import')--}}

    @include('rental.renters.form')

@endsection

@section('bot')
 <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    <script type="text/javascript">
        var table = $('#bills-table').DataTable({
            autoWidth   : false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.bills') }}",
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'barang', name: 'barang'},
                {data: 'stok', name: 'stok'},
                {data: 'tr_jml', name: 'tr_jml'},
                {data: 'totalTagihan', name: 'totalTagihan'},
                {data: 'tr_ket', name: 'tr_ket'},

            ]
        });
    </script>
@endsection
