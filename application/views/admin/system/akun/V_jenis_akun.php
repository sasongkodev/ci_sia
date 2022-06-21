<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Jenis Akun</a></li>
        <li><a href="#tab_2" data-toggle="tab">Klasifikasi akun</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="box box-primary flat">
                    <div class="box-header">
                        <h4><i class="fa fa-file"></i> Jenis Akun</h4>
                    </div>
                    <div class="box-body">
                        <?= $this->session->flashdata('info') ? $this->session->flashdata('info') : ''?>
                        <?php if (count($data) > 0) :?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: #3c8dbc; color: #fff;">
                                    <th style="text-align: center" width="3%">NO.</th>
                                    <th style="text-align: center">KODE JENIS AKUN</th>
                                    <th style="text-align: center">JENIS AKUN</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach ($data as $row) :?>
                                    <tr>
                                        <td align="center"><?= $no++ ?>.</td>
                                        <td align="center"><?= $row->kode_jenis?></td>
                                        <td align="left"><?= $row->jenis_akun?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <?php else:?>
                            <div style="text-align: center">

                            <p align="center"><h3><i class="fa fa-battery-empty"></i> Tidak ada data</h3></p>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="box box-success flat">
                    <div class="box-header">
                        <h4><i class="fa fa-plus-circle"></i><strong> Form Add Jenis Akun</strong></h4>
                        <hr>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" action="<?= site_url('admin/system/akun/add_jenis') ?>" method="post">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Kode Jenis Akun</label>
                                <div class="col-xs-4">
                                    <input type="text" autofocus name="kode_jenis" class="form-control" placeholder="Kode Jenis Akun">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Jenis Akun</label>
                                <div class="col-xs-9">
                                    <input type="text" autofocus name="jenis_akun" class="form-control" placeholder="Jenis Akun">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-2">
                                    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check-square-o"></i> Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="box box-primary flat">
                        <div class="box-header">
                            <h4><i class="fa fa-file"></i> Klasifikasi Akun</h4>
                        </div>
                        <div class="box-body">
                            <?php if (count($data_klasifikasi) > 0) :?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr style="background-color: #3c8dbc; color: #fff;">
                                            <th style="text-align: center" width="3%">NO.</th>
                                            <th style="text-align: center">KODE KLASIFIKASI AKUN</th>
                                            <th style="text-align: center">KLASIFIKASI AKUN</th>
                                            <th style="text-align: center">JENIS AKUN</th>
                                            <th style="text-align: center">AKSI</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1; foreach ($data_klasifikasi as $row) :?>
                                            <tr>
                                                <td align="center"><?= $no++ ?>.</td>
                                                <td align="center"><?= $row->kode_klasifikasi?></td>
                                                <td align="left"><?= $row->nama_klasifikasi?></td>
                                                <td align="center"><?= $row->jenis_akun?></td>
                                                <td align="center">
                                                    <a href="#" onclick="update('<?= $row->kode_klasifikasi?>')" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="#" onclick="del('<?= $row->kode_klasifikasi?>')" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else:?>
                                <div style="text-align: center">

                                    <p align="center"><h3><i class="fa fa-battery-empty"></i> Tidak ada data</h3></p>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5" id="form-edit">
                    <div class="box box-success flat">
                        <div class="box-header">
                            <h4><i class="fa fa-plus-circle"></i><strong> Form Add Klasifikasi Akun</strong></h4>
                            <hr>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal" action="<?= site_url('admin/system/akun/add_klasifikasi') ?>" method="post">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">Jenis Akun</label>
                                    <div class="col-xs-8">
                                        <select name="kode_jenis" onchange="pilih(this.value)" autofocus class="form-control select2" style="width: 100%">
                                            <option value="" selected disabled>Pilih</option>
                                            <?php foreach ($data as $item) : ?>
                                                <option value="<?= $item->kode_jenis ?>"><?= $item->jenis_akun ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">Kode Klasifikasi Akun</label>
                                    <div class="col-xs-2">
                                        <input type="text"readonly name="id_jen" id="id-jen" class="form-control" placeholder="-">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="text" name="id_klas" id="id-klas" class="form-control" placeholder="Kode Klasifikasi Akun">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">Nama Klasifikasi Akun</label>
                                    <div class="col-xs-8">
                                        <input type="text" name="nama_klasifikasi" class="form-control" placeholder="Klasifikasi Akun">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-2">
                                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check-square-o"></i> Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<script>
    function pilih(val) {
        $('#id-jen').val(val);
    }

    function del(id) {
        var url = "<?= site_url('admin/system/akun/del_klasifikasi') ?>/" + id;
        var con = confirm('Apakah anda yakin menghapus data ini');

        if (con) {
            window.location.href = url;
        }
    }

    function update(id) {
        $.ajax({
            url : '<?= site_url('admin/system/akun/get_edit_klasifikasi') ?>/'+id,
            success : function (res) {
                $('#form-edit').html(res);
            },
            error : function () {
                console.log('gagal');
            }
        });
    }
</script>

