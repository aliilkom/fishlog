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
                        <label >Dari</label>
                        {!! Form::select('product1_id', $product1, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Barang --', 'id' => 'product1_id', 'required']) !!}
                        <span class="help-block with-errors"></span>
                    </div>
                    
                    <div class="form-group">
                        <label >Ke</label>
                        {!! Form::select('product2_id', $product2, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Barang --', 'id' => 'product2_id', 'required']) !!}
                        <span class="help-block with-errors"></span>
                    </div>


                    <div class="form-group">
                            <label >Jumlah Pindah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required >
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Pindah</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off"  required>
                            <span class="help-block with-errors"></span>
                        </div>
                        

                        <div class="form-group">
                            <!-- <label >ID Pemilik</label> -->
                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    <!-- /.box-body -->
                    <div class="form-group">
                            <!-- <label >Manajemen</label> -->
                            <input type="hidden" class="form-control" id="manajemen" name="manajemen" value="rental" readonly>
                            <span class="help-block with-errors"></span>
                        </div>




                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
