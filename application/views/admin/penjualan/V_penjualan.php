<div class="box box-success flat">
    <div class="box-header">
        <a href="<?= site_url('admin/penjualan/add_penjualan') ?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i></a>
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
                        <th style="text-align: center;">Nama Customer</th>
                        <th style="text-align: center;">Tanggal Penjualan</th>
                        <th style="text-align: center;">Total</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; foreach($data as $row) : ?>
                        <tr>
                            <td align="center"><?= $no++ ?>.</td>
                            <td align="center"><a href="<?= site_url('admin/penjualan/invoice/'.$row->no_nota_penjualan) ?>"><?= $row->no_nota_penjualan?></a></td>
                            <td align="center"><?= $row->nama_customer?></td>
                            <td align="center"><?= $row->tgl_penjualan ?></td>
                            <td align="center"><?= number_format($row->total_harga,2,',','.')?></td>
                            <td align="center"><?= $row->id_bayar == null ? 'Outstanding' : 'Complate'?></td>
                            <td align="center">
                                <a href="#" onclick="del(<?= $row->id_penjualan ?>)" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="update<?= $row->id_penjualan ?>">
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
<!--js-->
<script>
    function del(id) {
        var url = "<?= site_url('admin/barang/del') ?>/"+id;
        var con = confirm('Apakah anda yakin menghapus data ini');

        if(con)
        {
            window.location.href = url;
        }
    }
</script>