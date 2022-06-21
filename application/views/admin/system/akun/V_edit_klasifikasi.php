<div class="box box-success flat">
    <div class="box-header">
        <h4><i class="fa fa-plus-circle"></i><strong> Form Update Klasifikasi Akun</strong></h4>
        <hr>
    </div>
    <div class="box-body">
        <form class="form-horizontal" action="<?= site_url('admin/system/akun/update_klasifikasi') ?>" method="post">
            <div class="form-group">
                <label class="col-xs-4 control-label">Jenis Akun</label>
                <div class="col-xs-8">
                    <select name="kode_jenis" onchange="pilih(this.value)" autofocus class="form-control select2" style="width: 100%">
                        <option value="" selected disabled>Pilih</option>
                        <?php foreach ($data as $item) : ?>
                            <option <?= $klas->kode_jenis == $item->kode_jenis ? 'selected' : '' ?> value="<?= $item->kode_jenis ?>"><?= $item->jenis_akun ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label">Kode Klasifikasi Akun</label>
                <div class="col-xs-2">
                    <input type="hidden" name="id" value="<?= $klas->kode_klasifikasi?>">
                    <input type="text"readonly name="id_jen" id="id-jen" class="form-control" placeholder="-" value="<?= $klas->kode_jenis ?>">
                </div>
                <div class="col-xs-6">
                    <input type="text" name="id_klas" id="id-klas" value="<?= substr($klas->kode_klasifikasi,1,3) ?>" class="form-control" placeholder="Kode Klasifikasi Akun">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label">Nama Klasifikasi Akun</label>
                <div class="col-xs-8">
                    <input type="text" name="nama_klasifikasi" value="<?= $klas->nama_klasifikasi ?>" class="form-control" placeholder="Klasifikasi Akun">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-2">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check-square-o"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
