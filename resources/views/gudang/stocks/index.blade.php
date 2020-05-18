@extends('layouts.master')

@section('dashboard')
   Stok Barang
   <small>Manajemen Gudang</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
    <li class="active"><a href="{{ url('barang') }}"><i class="fa fa-database"></i>Stok Barang</a></li>
@endsection

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <!-- /.box-header -->
        <div class="box-body">
            <table id="stocks-table" class="table table-striped">
                <thead>
                <tr>
                    <!-- <th>No</th> -->
                    <th>Lokasi Gudang</th>
                    <th>Nama Barang</th>
                    <th>SKU</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Spesifikasi</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}

    <script type="text/javascript">
        var table = $('#stocks-table').DataTable({
            autoWidth   : false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.stocks') }}",
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'warehouse_nama', name: 'warehouse_nama'},
                {data: 'nama', name: 'nama'},
                {data: 'sku', name: 'sku'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'satuan', name: 'satuan'},
                {data: 'category_name', name: 'category_name'},
                {data: 'merk_name', name: 'merk_name'},
                {data: 'spesifikasi', name: 'spesifikasi'},
                {data: 'action', name: 'action'},
               
           
            ]
        });

    </script>

@endsection
