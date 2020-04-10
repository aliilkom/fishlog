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
                            <a href="barang">Tambah</a></div>
                        </div>

                        <div class="form-group">
                            <label >Pembeli</label>
                            {!! Form::select('customer_id', $customers, null, [ 'required','class' => 'form-control select', 'placeholder' => '-- Pilih Pembeli --', 'id' => 'customer_id']) !!}
                            <span class="help-block with-errors"></span>
                            <div>Belum ada Pembeli?
                            <a href="pembeli">Tambah</a></div>
                        </div>

                        <div class="form-group">
                            <label >Stok Keluar</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Pembayaran</label>
                            <select class="form-control" name="pembayaran" id="pembayaran" required onchange="showfield(this.options[this.selectedIndex].value)">
                                <option value="" disabled selected>-- Pilih Pembayaran --</option>
                                <option>Cash</option>
                                <option>Cicil</option>
                                <option value="Tempo">Tempo</option>
                            </select>
                            <br>
                            <div id="div1" display="none;"></div>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Keluar</label>
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
<script type="text/javascript">
    function showfield(name){
    if(name=='Tempo')document.getElementById('div1').innerHTML='<b>Tempo</b> <input class="form-control" type="text" name="pembayaran" />';
    else document.getElementById('div1').innerHTML='';
    }
</script>