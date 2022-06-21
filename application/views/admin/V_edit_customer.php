 <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span></button>
    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Suplier</h4>
  </div>
  <form action="<?= site_url('admin/customer/save_update') ?>" method="post">
    <div class="modal-body">
     <div class="form-group">
      <label>Nama Suplier</label>
      <input type="hidden" name="id" value="<?= $data->id_customer ?>">
      <input type="text" name="nama_customer" class="form-control" placeholder="Nama Customer" value="<?= $data->nama_customer ?>">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control" placeholder="Alamat"><?= $data->alamat ?></textarea>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $data->email ?>">
    </div>
    <div class="form-group">
      <label>No. Telp</label>
      <input type="text" name="no_telepon" class="form-control" placeholder="No Telepo" value="<?= $data->no_telepon ?>">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
  </div>
</form>