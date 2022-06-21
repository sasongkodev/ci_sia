<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Tambah Saldo Awal</h4>
	</div>
	<form action="<?= site_url('admin/saldo/save_update') ?>" method="post">
		<div class="modal-body">
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
						<label>Periode</label>
						<select name="periode" class="form-control">
							<option value="" selected disabled>Pilih</option>
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
				<div class="col-xs-6">
					<div class="form-group">
						<label>Rekening</label>
						<select name="id_rek" class="form-control">
							<option value="" selected disabled>Pilih</option>
							<?php if(count($rek) > 0) : ?>
								<?php foreach($rek as $val) :?>
									<option <?= $data->id_rek == $val->id_rek ? 'selected' : ''?> value="<?= $val->id_rek ?>"><?= $val->no_rek ?> (<?= $val->nama_rek ?>)</option>
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
					<input type="text" name="saldo_awal" class="form-control" value="<?= $data->saldo_awal ?>" placeholder="Sald Awal">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Simpan</button>
		</div>
	</form>
</div>