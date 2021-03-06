@extends('layouts.master')

@section('dashboard')
   Gudang
   <small>Manajemen Gudang</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('berandagudang') }}"><i class="fa fa-dashboard"></i>Manajemen Gudang</a></li>
    <li class="active"><a href="{{ url('gudang') }}"><i class="fa fa-truck"></i>Gudang</a></li>
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
            <table id="warehouses-table" class="table table-striped">
                <thead>
                <tr>
                    <!-- <th>No</th> -->
                    <th>Nama Gudang</th>
                    <th>Pemilik</th>
                    <th>Telepon</th>
                    <th>Lokasi</th>
                    <th>Jumlah Ruang</th>
                    <th>Kapasitas Total *(Ton)</th>
                   
                    <th>Gambar</th>
                    
                    <th>Opsi</th>
                </tr>
                
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    @include('gudang.warehouses.form')

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
        var table = $('#warehouses-table').DataTable({
            autoWidth   : false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.warehouses') }}",
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                {data: 'user_name', name: 'user_name'},
                // {data: 'pemilik', name: 'pemilik'},
                {data: 'hp', name: 'hp'},
                {data: 'lokasi', name: 'lokasi'},
                {data: 'ruang', name: 'ruang'},
                {data: 'kapasitas', name: 'kapasitas'},
                {data: 'show_photo', name: 'show_photo'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
                
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Gudang');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('gudang') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Ubah Gudang');

                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    // $('#pemilik').val(data.pemilik);
                    $('#hp').val(data.hp);
                    $('#lokasi').val(data.lokasi);
                    $('#ruang').val(data.ruang);
                    $('#kapasitas').val(data.kapasitas);
                    $('#user_id').val(data.user_id);
                    
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
                    url : "{{ url('gudang') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('gudang') }}";
                    else url = "{{ url('gudang') . '/' }}" + id;

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
