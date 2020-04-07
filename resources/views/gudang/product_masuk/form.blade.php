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
                            {!! Form::select('product_id', $products, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Product --', 'id' => 'product_id']) !!}
                            <span class="help-block with-errors"></span>
                            <a href="barang"> Tambah Barang</a>
                        </div>

                        <div class="form-group">
                            <label >Penyuplai</label>
                            {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Renter --', 'id' => 'supplier_id']) !!}
                            <span class="help-block with-errors"></span>
                            <a href="penyuplai"> Tambah Penyuplai</a>
                        </div>

                        <div class="form-group">
                            <label >Stok Masuk</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Pembayaran</label>
                            <input type="text" class="form-control" id="pembayaran" name="pembayaran" required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Masuk</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tanggal" name="tanggal"   required>
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
