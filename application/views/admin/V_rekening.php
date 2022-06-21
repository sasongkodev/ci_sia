<div class="box box-success flat">
    <div class="box-header">
        <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#tambah"><i
                    class="fa fa-plus"></i></a>
    </div>
    <div class="box-body">
        <?= $this->session->flashdata('info') ? $this->session->flashdata('info') : '' ?>
        <?php if (count($data) > 0) : ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr style="background-color: #00a65a; color: #fff;">
                        <th style="text-align: center;" width="3%">NO.</th>
                        <th style="text-align: center;">No. Rekening</th>
                        <th style="text-align: center;">Nama Rekening</th>
                        <th style="text-align: center;">Saldo Normal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;
                    foreach ($data as $row) : ?>
                        <tr <?= empty($row->rek_induk) ? "style='background-color: #d4eae3; color: #000;'" : "" ?>>
                            <td align="center"><?= $no++ ?>.</td>
                            <td align="left"><?= $row->no_rek ?></td>
                            <td align="left"><?= $row->nama_rek ?></td>
                            <td align="center"><?php if ($row->saldo_normal == 'D') : echo 'Debit';
                                elseif ($row->saldo_normal == 'K') :echo 'Kredit'; endif; ?></td>
                            <td align="center">
                                <a href="<?= site_url('admin/rekening/update/' . $row->id_rek) ?>"
                                   class="btn btn-default btn-sm" title="Edit" data-toggle="modal"
                                   data-target="#update<?= $row->id_rek ?>"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="del(<?= $row->id_rek ?>)" class="btn btn-danger btn-sm"
                                   title="Hapus"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="update<?= $row->id_rek ?>">
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
                <h4 class="modal-title">Tambah Rekening</h4>
            </div>
            <form action="<?= site_url('admin/rekening/add') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Rekening Induk</label>
                                <select name="rek_induk" onchange="show(this.value)" class="form-control">
                                    <option value="" selected>Pilih</option>
                                    <?php if (count($rek_induk) > 0) : ?>
                                        <?php foreach ($rek_induk as $val) : ?>
                                            <option value="<?= $val->no_rek ?>"><?= $val->no_rek ?> - <?= $val->nama_rek ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">Data tidak ada</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>No. Rekening</label>
                                <input type="text" name="no_rek" id="no-rek" class="form-control"
                                       placeholder="No Rekening">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Rekening</label>
                        <input type="text" name="nama_rek" class="form-control" placeholder="Nama Rekening">
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Saldo Normal</label>
                                <select name="saldo_normal" class="form-control">
                                    <option value="" selected disabled>Pilih</option>
                                    <option value="D">Debit</option>
                                    <option value="K">Kredit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Akun Pembayaran</label>
                                <select name="akun_pembayaran" class="form-control">
                                    <option value="" selected disabled>Pilih</option>
                                    <option value="Y">Ya</option>
                                    <option value="T">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i
                                class="fa fa-times"></i> Batal
                    </button>
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
        var url = "<?= site_url('admin/rekening/del') ?>/" + id;
        var con = confirm('Apakah anda yakin menghapus data ini');

        if (con) {
            window.location.href = url;
        }
    }
    function show(key) {
        $('#no-rek').val(key+'.0000');
    }
</script>
