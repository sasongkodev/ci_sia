<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Tambah Item Barang</h4>
</div>
<form action="<?= site_url('admin/barang/save_update') ?>" method="post">
    <div class="modal-body">
        <div class="row">
            <div class="col-xs-8">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="hidden" name="id" value="<?= $data->id_barang ?>">
                    <input type="text" name="nama_barang" class="form-control" value="<?= $data->nama_barang ?>"
                           placeholder="Nama Barang">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    <label>Satuan</label>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" name="satuan" class="form-control" value="<?= $data->satuan ?>"
                               placeholder="Satuan">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Harga Beli</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input type="text" name="harga_beli" value="<?= $data->harga_beli ?>" class="form-control"
                               placeholder="Rp.">
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Harga Jual</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input type="text" name="harga_jual" value="<?= $data->harga_jual ?>" class="form-control"
                               placeholder="Rp.">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <label>Stok</label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="number" name="stok" class="form-control" placeholder="Stok" value="<?= $data->stok ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
    </div>
</form>