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
							<th style="text-align: center;">Periode</th>
							<th style="text-align: center;">No. Rekening</th>
							<th style="text-align: center;">Nama Rekening</th>
							<th style="text-align: center;">Saldo Awal</th>
							<th style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($data as $row) : ?>
						<tr>
							<td align="center"><?= $no++ ?>.</td>
							<td align="center"><?= $row->periode ?></td>
							<td align="center"><?= $row->kode_akun ?></td>
							<td align="center"><?= $row->nama_akun ?></td>
							<td align="center"><?= number_format($row->saldo_awal,2,',','.') ?></td>
							<td align="center">
								<a href="<?= site_url('admin/saldo/update/'.$row->kode_akun) ?>" class="btn btn-default" title="Edit" data-toggle="modal" data-target="#update<?= $row->kode_akun ?>"><i class="fa fa-edit"></i></a>
								<a href="#" onclick="del(<?= $row->kode_akun ?>)" class="btn btn-danger" title="Hapus"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<div class="modal fade" id="update<?= $row->kode_akun ?>">
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
					<h4 class="modal-title">Tambah Saldo Awal</h4>
				</div>
				<form action="<?= site_url('admin/saldo/add') ?>" method="post">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-4">
								<div class="form-group">
									<label>Periode</label>
									<select name="periode" class="form-control">
										<option value="" selected=" disabled">Pilih</option>
										<option value="2011">2011</option>
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
									</select>
								</div>
							</div>
							<div class="col-xs-8">
								<div class="form-group">
									<label>Rekening</label>
									<select name="id_rek" class="form-control select2" style="width: 100%">
										<option value="" selected disabled>Pilih</option>
										<?php if(count($rek) > 0) : ?>
											<?php foreach($rek as $val) :?>
												<option value="<?= $val->kode_akun ?>"><?= $val->kode_akun ?> (<?= $val->nama_akun ?>)</option>
											<?php endforeach; ?>
										<?php else: ?>
											<option value="">Data tidak ada</option>
										<?php endif;?>
									</select>					
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Saldo Awal</label>
							<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<input type="text" name="saldo_awal" class="form-control" placeholder="Sald Awal">
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
			var url = "<?= site_url('admin/saldo/del') ?>/"+id;
			var con = confirm('Apakah anda yakin menghapus data ini');

			if(con)
			{
				window.location.href = url;
			}
		}
	</script>