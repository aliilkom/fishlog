@extends('layouts.master')

@section('dashboard')
   Barang
   <small>Manajemen Rental</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('berandarental') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
    
    <li class="active"><a href="{{ url('rentalbarang') }}"><i class="fa fa-database"></i>Barang</a></li>
@endsection

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary">Tambah</a>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-table" class="table table-striped">
                <thead>
                <tr>
                    <!-- <th>No</th> -->
                    <th>Lokasi Gudang</th>
                    <th>Nama Barang</th>
                    <th>SKU</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Spesifikasi</th>
                    <th>Gambar</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    @include('rental.products.form')

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
        var table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.rentalproducts') }}",
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
                {data: 'show_photo', name: 'show_photo'},
               
                {data: 'action', name: 'action', orderable: false, searchable: false}
           
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Barang');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('rentalbarang') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Ubah Barang');

                    $('#id').val(data.id);
                    $('#warehouse_id').val(data.warehouse_id);
                    $('#nama').val(data.nama);
                    $('#sku').val(data.sku);
                    $('#jumlah').val(data.jumlah);
                    $('#satuan').val(data.satuan);
                    $('#category_id').val(data.category_id);
                    $('#merk_id').val(data.merk_id);
                    $('#spesifikasi').val(data.spesifikasi);
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Apakah kamu yakin?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Hapus'
            }).then(function () {
                $.ajax({
                    url : "{{ url('rentalbarang') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('rentalbarang') }}";
                    else url = "{{ url('rentalbarang') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
