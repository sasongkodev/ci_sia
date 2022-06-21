<div class="box box-success flat">
    <div class="box-header">
        <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i></a>
    </div>
    <div class="box-body">
        <?= $this->session->flashdata('info') ? $this->session->flashdata('info') : ''?>
        <?php if (count($data) > 0) :?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr style="background-color: #00a65a; color: #fff;">
                        <th style="text-align: center">NO.</th>
                        <th style="text-align: center">KODE AKUN</th>
                        <th style="text-align: center">NAMA AKUN</th>
                        <th style="text-align: center">KLASIFIKASI</th>
                        <th style="text-align: center">JENIS</th>
                        <th style="text-align: center">AKSI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; foreach ($data as $item) :?>
                        <tr <?= $item->header == 'T' ? "style='background-color: #d4eae3; color: #000;'" : "" ?>>
                            <td align="center" width="3%"><?= $no++?>.</td>
                            <td align="center" ><?= $item->kode_akun?></td>
                            <td align="left" ><?= $item->nama_akun?></td>
                            <td align="left" ><?= $item->nama_klasifikasi?></td>
                            <td align="left" ><?= $item->jenis_akun?></td>
                            <td align="center" >
                                <a href="<?= site_url('admin/rekening/update/'.$item->kode_akun) ?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit<?= $item->kode_akun ?>"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="del(<?= $item->kode_akun ?>)" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                            <div class="modal fade" id="edit<?= $item->kode_akun ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    </div>
                                </div>
                            </div>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        <?php else:?>
            <div style="text-align: center">

                <p align="center" class="text-danger"><h3><i class="fa fa-battery-empty"></i> Tidak ada data</h3></p>
            </div>
        <?php endif;?>
    </div>
</div>
<!--tambah akun-->
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Tambah Akun</h4>
            </div>
            <form class="form-horizontal" action="<?= site_url('admin/rekening/add') ?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-xs-3 control-label"> KLASIFIKASI AKUN</label>
                    <div class="col-xs-9">
                        <select required name="kode_klasifikasi" autofocus onchange="pilih(this.value)" class="form-control select2" style="width: 100%">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($klas_akun as $row) :?>
                                <option value="<?= $row->kode_klasifikasi ?>" ><?= $row->nama_klasifikasi ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">KODE AKUN</label>
                    <div class="col-xs-2">
                        <input type="text" readonly class="form-control" name="id_klas" id="id-klas">
                    </div>
                    <div class="col-xs-3">
                        <input type="text" required class="form-control" name="id_akun" id="id-akun">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">NAMA AKUN</label>
                    <div class="col-xs-9">
                        <input type="text" required name="nama_akun" class="form-control" placeholder="Nama Akun">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">SALDO NORMAL</label>
                    <div class="col-xs-6">
                        <select name="saldo_normal" class="form-control">
                            <option value="">Pilih</option>
                            <option value="D">DEBIT</option>
                            <option value="K">KREDIT</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-xs-3 control-label">HEADER</label>
                    <div class="col-xs-9">
                        <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" onclick="cek()" name="header" value="T" id="header">
                        </span>
                            <select name="kode_akun_header" id="akun-header" class="form-control">
                                <?php if (count($header) > 0) :?>
                                    <?php foreach ($header as $item) :?>
                                        <option value="<?= $item->kode_akun ?>"><?= $item->kode_akun ?> - <?= $item->nama_akun ?></option>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <option value="">Tidak ada Header</option>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Add</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function pilih(kode) {
        $('#id-klas').val(kode);
    }

    function cek() {
        if ($('#header').is(":checked"))
        {
            $('#akun-header').attr('disabled',true);
            $('#akun-header').attr('required',true);
        }else{
            $('#akun-header').attr('disabled',false);
        }
    }

    function del(id) {
        var url = "<?= site_url('admin/rekening/del') ?>/" + id;
        var con = confirm('Apakah anda yakin menghapus data ini');

        if (con) {
            window.location.href = url;
        }
    }
</script>
