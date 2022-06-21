<div class="box box-success flat">
    <div class="box-header">
        <a href="<?= site_url('admin/pembelian/add_pembelian') ?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i></a>
    </div>
    <div class="box-body">
        <?= $this->session->flashdata('info') ? $this->session->flashdata('info') : '' ?>
        <?php if(count($data) > 0) : ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr style="background-color: #00a65a; color: #fff;">
                        <th style="text-align: center;" width="3%">NO.</th>
                        <th style="text-align: center;">No Nota</th>
                        <th style="text-align: center;">Nama Suplier</th>
                        <th style="text-align: center;">Tanggal Pembelian</th>
                        <th style="text-align: center;">Total</th>
                        <th style="text-align: center;">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; foreach($data as $row) : ?>
                        <tr>
                            <td align="center"><?= $no++ ?>.</td>
                            <td align="center"><a href="<?= site_url('admin/pembelian/invoice/'.$row->no_nota_pembelian) ?>"><?= $row->no_nota_pembelian?></a></td>
                            <td align="left"><?= $row->nama_suplier?></td>
                            <td align="center"><?= $row->tgl_pembelian ?></td>
                            <td align="center"><?= number_format($row->total_harga,2,',','.')?></td>
                            <td align="center"><?= $row->id_bayar == null ? '<span class="text-danger">Outstanding</span>' : '<span class="text-success">Complate</span>'?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="callout callout-info flat">
                <h4><i class="fa fa-info"></i> Informasi!</h4>

                <p>Belum ada data pembelian.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<!--js-->