<div class="box box-success flat">
	<div class="box-header">
		<a href="#" class="btn btn-primary btn-flat" title="Tambah" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i></a>		
	</div>
	<div class="box-body">
		<?= $this->session->flashdata('info') ? $this->session->flashdata('info') : '' ?>
		<?php if(count($data) > 0) : ?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr style="background-color: #00a65a; color: #fff;">
							<th style="text-align: center;">NO.</th>
							<th style="text-align: center;">Nama</th>
							<th style="text-align: center;">Alamat</th>
							<th style="text-align: center;">Email</th>
							<th style="text-align: center;">Telepon</th>
							<th style="text-align: center;">AKsi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($data as $row) : ?>
							<tr>
								<td align="center" width="3%"><?= $i++ ?>.</td>
								<td><?= $row->nama_suplier ?></td>
								<td><?= $row->alamat ?></td>
								<td align="center"><?= $row->email ?></td>
								<td align="center"><?= $row->no_telepon ?></td>
								<td align="center">
									<a href="<?= site_url('admin/suplier/update/'.$row->id) ?>" class="btn btn-default" title="Edit" data-toggle="modal" data-target="#update<?= $row->id ?>"><i class="fa fa-edit"></i></a>
									<a href="#" onclick="del(<?= $row->id ?>)"  class="btn btn-danger" title="Hapus"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<div class="modal fade" id="update<?= $row->id ?>">
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

                <p>Belum ada data suplier</p>
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
                <h4 class="modal-title">Tambah Suplier</h4>
              </div>
              <form action="<?= site_url('admin/suplier/add') ?>" method="post">
				<div class="modal-body">
                	<div class="form-group">
                		<label>Nama Suplier</label>
                		<input type="text" name="nama_suplier" class="form-control" placeholder="Nama Suplier">
                	</div>
                	<div class="form-group">
                		<label>Alamat</label>
                		<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                	</div>
                	<div class="form-group">
                		<label>Email</label>
                		<input type="email" name="email" class="form-control" placeholder="Email">
                	</div>
                	<div class="form-group">
                		<label>No. Telpon</label>
                		<input type="text" name="no_telepon" class="form-control" placeholder="No Telpon">
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
		var url = "<?= site_url('admin/suplier/del') ?>/"+id;
		var con = confirm('Apakah anda yakin menghapus data ini');

		if(con)
		{
			window.location.href = url;
		}
 	}
</script>