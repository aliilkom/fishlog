@extends('layouts.master')

@section('dashboard')
   Rental Stok Masuk
@endsection

@section('breadcrumb')
    <li><a href="{{ url('beranda2') }}"><i class="fa fa-dashboard"></i>Rental Gudang</a></li>
    <li class="active">Stok Masuk</li>
@endsection

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box">

        

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary" >Tambah</a>
            <a href="{{ route('exportPDF.StockrentinAll') }}" class="btn btn-danger">PDF</a>
            <a href="{{ route('exportExcel.StockrentinAll') }}" class="btn btn-success">Excel</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-rout-table" class="table table-striped">
                <thead>
                <tr>
                    <!-- <th>No</th> -->
                    <th>Nama Barang</th>
                    <th>Penyewa</th>
                    <th>Jumlah</th>
                    <th>Pembayaran</th>
                    <th>Tanggal Masuk</th>
                    <th>Opsi</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>



    <div class="box col-md-6">

        <div class="box-header">
            <h3 class="box-title">Export Invoice</h3>
        </div>

        {{--<div class="box-header">--}}
            {{--<a onclick="addForm()" class="btn btn-primary" >Tambah</a>--}}
            {{--<a href="{{ route('exportPDF.StockrentinAll') }}" class="btn btn-danger">PDF</a>--}}
            {{--<a href="{{ route('exportExcel.StockrentinAll') }}" class="btn btn-success">Excel</a>--}}
        {{--</div>--}}

        <!-- /.box-header -->
        <div class="box-body">
            <table id="invoice" class="table table-striped">
                <thead>
                <tr>
                <!-- <th>No</th> -->
                    <th>Nama Barang</th>
                    <th>Penyewa</th>
                    <th>Jumlah</th>
                    <th>Pembayaran</th>
                    <th>Tanggal Masuk</th>
                    <th>Export Invoice</th>
                </tr>
                </thead>

                @foreach($invoice_data as $i)
                    <tbody>
                        <!-- <td>{{ $i->id }}</td> -->
                        <td>{{ $i->product->nama }}</td>
                        <td>{{ $i->renter->nama }}</td>
                        <td>{{ $i->jumlahsrent }}</td>
                        <td>{{ $i->pembayaran }}</td>
                        <td>{{ $i->tanggal }}</td>
                        <td>
                            <a href="{{ route('exportPDF.Stockrentin', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">Export PDF</a>
                        </td>
                    </tbody>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    @include('stockrentins.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>


    <!-- InputMask -->
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <script>
    $(function () {
    // $('#items-table').DataTable()
    $('#invoice').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'processing'  : true,
    // 'serverSide'  : true
    })
    })
    </script>

    <script>
        $(function () {

            //Date picker
            $('#tanggal').datepicker({
                autoclose: true,
                // dateFormat: 'yyyy-mm-dd'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>

    <script type="text/javascript">
        var table = $('#products-rout-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.stockrentins') }}",
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'products_name', name: 'products_name'},
                {data: 'renter_name', name: 'renter_name'},
                {data: 'jumlahsrent', name: 'jumlahsrent'},
                {data: 'pembayaran', name: 'pembayaran'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Rental Stok Keluar');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('stokrentalmasuk') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Ubah Rental Stok Keluar');

                    $('#id').val(data.id);
                    $('#product_id').val(data.product_id);
                    $('#renter_id').val(data.renter_id);
                    $('#jumlahsrent').val(data.jumlahsrent);
                    $('#pembayaran').val(data.pembayaran);
                    $('#tanggal').val(data.tanggal);
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
                    url : "{{ url('stokrentalmasuk') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('stokrentalmasuk') }}";
                    else url = "{{ url('stokrentalmasuk') . '/' }}" + id;

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
