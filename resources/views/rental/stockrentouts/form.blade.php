<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">


                    <div class="box-body">
                        <div class="form-group">
                            <label >Nama Barang</label>
                            {!! Form::select('product_id', $products, null, [ 'required','class' => 'form-control select', 'placeholder' => '-- Pilih Barang --', 'id' => 'product_id']) !!}
                            <span class="help-block with-errors"></span>
                            <div>Belum ada Barang?
                            <a href="rentalbarang"> Tambah</a></div>
                        </div>

                        <div class="form-group">
                            <label >Penyewa</label>
                            {!! Form::select('renter_id', $renters, null, [ 'required','class' => 'form-control select', 'placeholder' => '-- Pilih Penyewa --', 'id' => 'renter_id']) !!}
                            <span class="help-block with-errors"></span>
                            <div>Belum ada Penyewa?
                            <a href="penyewa"> Tambah</a></div>
                        </div>

                        <div class="form-group">
                            <label >Stok Keluar</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            <span class="help-block with-errors"></span>
                        </div>

                      

                        <div class="form-group">
                            <label >Tanggal Keluar</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tanggal" name="tanggal"  autocomplete="off" required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <!-- <label >ID Pemilik</label> -->
                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" readonly>
                            <span class="help-block with-errors"></span>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
