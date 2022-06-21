<div class="box box-success flat">
    <div class="box-header">
        <i class="fa fa-plus-circle"> Add Penjualan</i>
    </div>
    <form class="form-horizontal" action="<?= site_url('admin/penjualan/add') ?>" method="post">
        <div class="box-body">
            <div class="form-group">
                <label class="col-xs-2 control-label">Customer</label>
                <div class="col-xs-4">
                    <select required name="id_customer" class="form-control select2" style="width: 100%">
                        <option value="" selected disabled>Pilih</option>
                        <?php foreach ($customer as $row) : ?>
                            <option value="<?= $row->id_customer ?>"><?= $row->nama_customer ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-2 control-label">Tanggal Penjualan</label>
                <div class="col-xs-4">
                    <input required type="date" name="tgl_penjualan" class="form-control" value="<?= date('mm/dd/yyyy') ?>">
                </div>
            </div>
            <hr>
            <a class="btn btn-default btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i
                        class="fa fa-plus"></i> Tambah Item Barang</a>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr style="background-color: #00a65a; color: #fff;">
                        <th style="text-align: center" width="3%">NO.</th>
                        <th style="text-align: center">Item Barang</th>
                        <th style="text-align: center">Qty</th>
                        <th style="text-align: center">Satuan</th>
                        <th style="text-align: center">Harga</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody id="isi">

                    </tbody>
                    <tr style="background-color: #d4eae3">
                        <td colspan="2" align="center"><strong>Sub total</strong></td>
                        <td id="total-qty" align="center"></td>
                        <td></td>
                        <td id="total-harga" align="center"></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <a href="<?= site_url('admin/penjualan') ?>" class="btn btn-default btn-flat"><i class="fa fa-times"></i> Batal</a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check-square-o"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!--tambah item barang-->
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Item Barang</h4>
            </div>
            <form class="form-horizontal" id="form-barang" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Kode Barang</label>
                        <div class="col-xs-9">
                            <select name="id_barang" onchange="pilih(this.value)" id="id-barang"
                                    class="form-control select2" style="width: 100%">
                                <option value="" selected>Pilih</option>
                                <?php foreach ($barang as $row) : ?>
                                    <option value="<?= $row->id_barang ?>"><?= $row->id_barang ?>
                                        - <?= $row->nama_barang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Nama Barang</label>
                        <div class="col-xs-9">
                            <input type="text" name="nama_barang" id="nama-barang" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Satuan</label>
                        <div class="col-xs-4">
                            <input type="text" name="satuan" id="satuan" class="form-control" readonly>
                        </div>
                        <label class="col-xs-1 control-label">Stok</label>
                        <div class="col-xs-4">
                            <input type="text" name="stok" id="stok" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Harga</label>
                        <div class="col-xs-9">
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" name="harga_jual" id="harga-jual" class="form-control"
                                       placeholder="Rp." readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Qty</label>
                        <div class="col-xs-4">
                            <input type="text" name="qty" id="qty" class="form-control" required>
                        </div>
                        <span class="text-danger" id="err"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i
                                class="fa fa-times"></i>Batal
                    </button>
                    <a onclick="add()" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add</a>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function pilih(id) {
        $.ajax({
            url: "<?= site_url('admin/penjualan/get_detail_barang') ?>/" + id,
            success: function (data) {
                var obj = JSON.parse(data)
                $('#satuan').val(obj.satuan);
                $('#nama-barang').val(obj.nama_barang);
                $('#harga-jual').val(obj.harga_jual);
                $('#stok').val(obj.stok);
            }
        })
    }
    var total_harga = 0;
    var total_qty = 0;
    var no = 1;
    function add() {
        var id = $('#id-barang').val();
        var stok = $('#stok').val();
        var nama_barang = $('#nama-barang').val();
        var satuan = $('#satuan').val();
        var harga_jual = parseFloat($('#harga-jual').val()) * parseFloat($('#qty').val());
        var qty = $('#qty').val();
        if(parseInt(qty) < parseInt(stok))
        {
            $('#isi').append('<tr id="row' + no + '"><td align="center">' + no + '.</td><td>' + nama_barang + '</td><td align="center" id="qty' + no + '">' + qty + '</td><td align="center">' + satuan + '</td><td align="center" id="harga' + no + '">' + harga_jual + '</td><td align="center"><a href="#" class="btn btn-default btn-sm" onclick="hapus(' + no + ')"><i class="fa fa-trash"></i></a></td>' +
                '<input type="hidden" name="qty[]" value="' + qty + '"><input type="hidden" name="id_barang[]" value="' + id + '"></tr>');
            $('#total-qty').html(total_qty = total_qty + parseInt(qty));
            $('#total-harga').html(total_harga = total_harga + parseFloat(harga_jual));
            no++;
            $('#form-barang')[0].reset();
            $('#err').html('')
            $('#tambah').modal('hide');
        }else{
            console.log('qty lebih besar dari stok');
            $('#qty').focus();
            $('#err').html('<i class="fa fa-times-circle"></i> Qty tidak boleh lebih dari stok')
        }


    }
    function hapus(no) {
        $('#total-qty').html(total_qty = total_qty - parseInt($('#qty' + no + '').html()));
        $('#total-harga').html(total_harga = total_harga - parseFloat($('#harga' + no + '').html()));
        $('#row' + no + '').remove();
    }
</script>
<script>
    //    $(function () {
    //        $("#form-barang").submit(function (e) {
    //            e.preventDefault(); //prevent default action
    //            var post_url = $(this).attr("action"); //get form action url
    //            var request_method = $(this).attr("method"); //get form GET/POST method
    //            var form_data = $(this).serialize(); //Encode form elements for submission
    //            $.ajax({
    //                url: post_url,
    //                type: request_method,
    //                data: form_data,
    //                success: function (result) {
    //                    console.log(result);
    //                    $('#form-barang')[0].reset();
    //                    $('#tambah').modal('hide');
    //                    $('#isi').html(result);
    //                },
    //                error: function () {
    //                    console.log('gagal');
    //                }
    //            })
    //        });
    //    });
</script>
