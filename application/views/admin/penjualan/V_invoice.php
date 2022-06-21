<div class="box box-success flat">
    <div class="box-header">
        <div class="pull-left">
            <a href="<?= site_url('admin/penjualan') ?>" class="btn btn-default btn-flat btn-sm"><i
                        class="fa fa-arrow-circle-left"></i> Kembali</a>
        </div>
        <div class="pull-right">
            <?php if ($status_bayar == null) : ?>
                <a href="<?= site_url('admin/penjualan/bayar') ?>" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#pembayaran"><i class="fa fa-money"></i> Pembayaran</a>
            <?php else: ?>
                <a href="#" class="btn btn-success btn-flat btn-sm"><i class="fa fa-check-circle-o"></i> Lunas</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-body">
        <?= $this->session->flashdata('info') ? $this->session->flashdata('info') : '' ?>
        <div style="text-align: center">
            <p><h2>INVOICE PENJUALAN</h2></p>
        </div>
        <div class="row">
            <div class="col-md-8">
                Kepada : <?= $data_penjualan->nama_customer ?>
            </div>
            <div class="col-md-4">
                <dl class="dl-horizontal">
                    <dt>No. Invoice :</dt>
                    <dd><?= $data_penjualan->no_nota_penjualan ?></dd>
                    <dt>Tanggal Invoice :</dt>
                    <dd><?= $data_penjualan->tgl_penjualan ?></dd>
                </dl>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr style="background-color: #00a65a; color: #fff;">
                    <th style="text-align: center" width="3%">NO.</th>
                    <th style="text-align: center">Item Barang</th>
                    <th style="text-align: center">Quantity</th>
                    <th style="text-align: center">Satuan</th>
                    <th style="text-align: center">Harga</th>
                    <th style="text-align: center">Total IDR</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; $total_qty = 0; $total_harga = 0;
                foreach ($data as $row) : ?>
                    <tr>
                        <td align="center"><?= $no++ ?>.</td>
                        <td align="center"><?= $row->nama_barang ?></td>
                        <td align="center"><?= $row->qty ?></td>
                        <td align="center"><?= $row->satuan ?></td>
                        <td align="center"><?= number_format($row->harga_jual, 2, ',', '.') ?></td>
                        <td align="center"><?= number_format($row->harga_jual * $row->qty, 2, ',', '.') ?></td>
                    </tr>
                <?php
                $total_qty = $total_qty + $row->qty;
                $total_harga = $total_harga + ($row->harga_jual * $row->qty);
                endforeach; ?>
                <tr style='background-color: #d4eae3; color: #000;'>
                    <td colspan="2">Terbilang : </td>
                    <td align="center"><strong><?= $total_qty ?></strong></td>
                    <td colspan="2"></td>
                    <td align="center"><strong><?= number_format($total_harga,2,',','.') ?></strong></td>
                </tr>
                <tr>
                    <td colspan="4"><i><?= strtoupper(terbilang($total_harga)) ?> RUPIAH</i></td>
                    <td align="right">Sub Total : </td>
                    <td align="center"><?= number_format($total_harga,2,',','.') ?></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Sudah dibayar : </td>
                    <td align="center"><?= $status_bayar == null ? '0' : number_format($total_harga,2,',','.')?></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Sisa : </td>
                    <td align="center"><?= $status_bayar == null ? number_format($total_harga,2,',','.'): '0'?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- pembayaran -->
<div class="modal fade" id="pembayaran">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Pembayaran Penjualan</h4>
      </div>
      <form action="<?= site_url('admin/penjualan/pembayaran') ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label>No Nota</label>
            <input type="hidden" name="id_penjualan" value="<?= $data_penjualan->id_penjualan ?>">
            <input type="text" name="no_nota_penjualan" class="form-control" value="<?= $data_penjualan->no_nota_penjualan ?>" readonly>
        </div>
        <div class="form-group">
            <label>No. Akun</label>
            <select name="no_akun" class="form-control select2" style="width: 100%;">
                <option value="" selected disabled>Pilih</option>
                <?php foreach($rek as $r) : ?>
                    <option value="<?= $r->kode_akun ?>"><?= $r->kode_akun?> - <?= $r->nama_akun?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" placeholder="Catatan" rows="6"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Bayar</button>
    </div>
    </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>