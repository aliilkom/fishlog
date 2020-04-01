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
                            <label >Nama Gudang</label>
                            <input type="text" class="form-control" id="nama" name="nama"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
<!-- 
                        <div class="form-group">
                            <label >Nama Pemilik</label>
                            <input type="text" class="form-control" id="pemilik" name="pemilik"   required>
                            <span class="help-block with-errors"></span>
                        </div> -->

                        <div class="form-group">
                            <label >No HP</label>
                            <input type="text" class="form-control" id="hp" name="hp"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Jumlah Ruang</label>
                            <input type="number" class="form-control" id="ruang" name="ruang"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Kapasitas *(Ton)</label>
                            <input type="number" class="form-control" id="kapasitas" name="kapasitas"   required>
                            <span class="help-block with-errors"></span>
                        </div>
                        
                        <div class="form-group">
                            <label >Gambar</label>
                            <input type="file" class="form-control" id="image" name="image" >
                            <span class="help-block with-errors"></span>
                        </div>

                        <!-- <div class="form-group">
                            <label >User</label>
                             {!! Form::select('user_id', $user, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih User --', 'id' => 'user_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div> -->

                        <div class="form-group">
                            <label >ID Pemilik</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" readonly>
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
