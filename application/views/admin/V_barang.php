<div class="box box-success flat">
    <div class="box-header">
        <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i></a>
    </div>
    <div class="box-body">
        <?= $this->session->flashdata('info') ? $this->session->flashdata('info') : '' ?>
        <?php if(count($data) > 0) : ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr style="background-color: #00a65a; color: #fff;">
                        <th style="text-align: center;" width="3%">NO.</th>
                        <th style="text-align: center;">Nama barang</th>
                        <th style="text-align: center;">Satuan</th>
                        <th style="text-align: center;">Harga Beli</th>
                        <th style="text-align: center;">Harga Jual</th>
                        <th style="text-align: center;">Stok</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; foreach($data as $row) : ?>
                        <tr>
                            <td align="center"><?= $no++ ?>.</td>
                            <td><?= $row->nama_barang ?></td>
                            <td align="center"><?= $row->satuan ?></td>
                            <td align="center"><?= number_format($row->harga_beli,2,',','.')?></td>
                            <td align="center"><?= number_format($row->harga_jual,2,',','.')?></td>
                            <td align="center"><?=$row->stok?></td>
                            <td align="center">
                                <a href="<?= site_url('admin/barang/update/'.$row->id_barang) ?>" class="btn btn-default btn-sm" title="Edit" data-toggle="modal" data-target="#update<?= $row->id_barang ?>"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="del(<?= $row->id_barang ?>)" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="update<?= $row->id_barang ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="callout callout-info flat">
                <h4><i class="fa fa-info"></i> Informasi!</h4>

                <p>Belum ada data customer.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Form tambah data -->
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Item Barang</h4>
            </div>
            <form action="<?= site_url('admin/barang/add') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" name="satuan" class="form-control" placeholder="Satuan">
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
                                    <input type="text" name="harga_beli" class="form-control" placeholder="Rp.">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="text" name="harga_jual" class="form-control" placeholder="Rp.">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Stok</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="number" name="stok" class="form-control" placeholder="Stok">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function del(id) {
        var url = "<?= site_url('admin/barang/del') ?>/"+id;
        var con = confirm('Apakah anda yakin menghapus data ini');

        if(con)
        {
            window.location.href = url;
        }
    }
</script>