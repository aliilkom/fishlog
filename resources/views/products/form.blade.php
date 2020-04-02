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
                            <label >Gudang</label>
                            {!! Form::select('warehouse_id', $warehouse, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Gudang --', 'id' => 'warehouse_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                            <a href="gudang"> Tambah Gudang</a>
                        </div>

                        <div class="form-group">
                            <label >Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select class="form-control" name="satuan" id="satuan" required>
                                <option>Kg</option>
                                <option>Pcs</option>
                                <option>Box</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                       
                        <div class="row">
  
                            <div class="form-group col-md-5">
                                <label >Kategori</label>
                                {!! Form::select('category_id', $category, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Kategori --', 'id' => 'category_id', 'required']) !!}
                                <span class="help-block with-errors"></span>
                                <a href="kategori"> Tambah Kategori</a>
                            </div>

                            <div class="form-group col-md-5 col-md-push-2">
                                <label >Merek</label>
                                {!! Form::select('merk_id', $merk, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Merek --', 'id' => 'merk_id', 'required']) !!}
                                <span class="help-block with-errors"></span>
                                <a href="merek"> Tambah Merek</a>
                            </div>

                        </div>

                        <div class="form-group">
                            <label >Spesifikasi</label>
                            <input type="text" class="form-control" id="spesifikasi" name="spesifikasi"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Gambar</label>
                            <input type="file" class="form-control" id="image" name="image" >
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
