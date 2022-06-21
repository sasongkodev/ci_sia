<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Tambah Akun</h4>
</div>
<form class="form-horizontal" action="<?= site_url('admin/rekening/save_update') ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label class="col-xs-3 control-label"> KLASIFIKASI AKUN</label>
            <div class="col-xs-9">
                <select required name="kode_klasifikasi" id="kode-klas-edit<?= $data->kode_akun ?>" autofocus onchange="pilih(this.value)" class="form-control select2" style="width: 100%">
                    <option value="" disabled selected>Pilih</option>
                    <?php foreach ($klas_akun as $row) :?>
                        <option <?= $data->kode_klasifikasi == $row->kode_klasifikasi ? 'selected' : '' ?> value="<?= $row->kode_klasifikasi ?>" ><?= $row->nama_klasifikasi ?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">KODE AKUN</label>
            <div class="col-xs-2">
                <input type="hidden" name="id" value="<?= $data->kode_akun ?>">
                <input type="text" readonly class="form-control" name="id_klas" id="id-klas-edit<?= $data->kode_akun ?>">
            </div>
            <div class="col-xs-3">
                <input type="text" required class="form-control" name="id_akun" value="<?= substr($data->kode_akun,2,5) ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">NAMA AKUN</label>
            <div class="col-xs-9">
                <input type="text" required name="nama_akun" class="form-control" placeholder="Nama Akun" value="<?= $data->nama_akun ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">SALDO NORMAL</label>
            <div class="col-xs-6">
                <select name="saldo_normal" class="form-control">
                    <option value="">Pilih</option>
                    <option <?= $data->saldo_normal == 'D' ? 'selected' : '' ?> value="D">DEBIT</option>
                    <option <?= $data->saldo_normal == 'K' ? 'selected' : '' ?> value="K">KREDIT</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-xs-3 control-label">HEADER</label>
            <div class="col-xs-9">
                <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" <?= $data->header == 'T' ? 'checked' : '' ?> onclick="cek()" name="header" value="T" id="header-edit<?= $data->kode_akun ?>">
                        </span>
                    <select name="kode_akun_header" id="akun-header-edit<?= $data->kode_akun ?>" class="form-control">
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
<script>
    $(document).ready(function () {
        var kode_klas = $('#kode-klas-edit<?= $data->kode_akun ?>').val();
        $('#id-klas-edit<?= $data->kode_akun ?>').val(kode_klas);

        cek();
    })

    function cek() {
        if ($('#header-edit<?= $data->kode_akun ?>').is(":checked"))
        {
            $('#akun-header-edit<?= $data->kode_akun ?>').attr('disabled',true);
            $('#akun-header-edit<?= $data->kode_akun ?>').attr('required',true);
        }else{
            $('#akun-header-edit<?= $data->kode_akun ?>').attr('disabled',false);
        }
    }
</script>