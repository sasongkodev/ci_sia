<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
           'admin/pembelian_model',
            'admin/barang_model',
            'admin/suplier_model',
            'admin/akun_model',

        ));
        if ($this->session->userdata('status') !== 'admin') {
            redirect(site_url('login'),'refresh');
        }
    }

    public function index()
    {

        $data['title'] = 'Pembelian';
        $data['sub_judul'] = 'Pembelian';
        $data['content'] = 'admin/pembelian/V_pembelian';
        $data['data'] = $this->pembelian_model->get();

        $this->load->view('admin/templates/V_main', $data);
    }

    public function add_pembelian()
    {
        $data['title'] = 'Add Pembelian';
        $data['sub_judul'] = 'Pembelian';
        $data['content'] = 'admin/pembelian/V_tambah_pembelian';
        $data['suplier'] = $this->suplier_model->get();
        $data['barang'] = $this->barang_model->get();
        $this->load->view('admin/templates/V_main', $data);
    }
    public function add()
    {
        $id_suplier = $this->input->post('id_suplier');
        $tgl_pembelian = $this->input->post('tgl_pembelian');
        $qty = $this->input->post('qty');
        $id_barang = $this->input->post('id_barang');
        $last_id = $this->pembelian_model->get_last_id()+1;
        $no = sprintf('%04s', $last_id);
        $no_nota = date('dmY').'-'.$no;
        $data_pembelian = array(
            'id_suplier' => $id_suplier,
            'no_nota_pembelian' => $no_nota,
            'tgl_pembelian' => $tgl_pembelian,
        );
        if (count($qty) > 0) {
            $id_pembelian = $this->pembelian_model->add($data_pembelian);
            $i=0;
            foreach ($qty as $item => $value)
            {
                $pembelian_detail = array(
                    'id_pembelian' => $id_pembelian,
                    'id_barang' => $id_barang[$i],
                    'qty' => $value
                );
                $this->pembelian_model->add_pembelian_detail($pembelian_detail);
                $i++;
            }
            if ($id_pembelian) {
                $this->session->set_flashdata('info',
                    '<div class="alert alert-success alert-dismissible flat">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    Success. Data berhasil disimpan
                    </div>');
            }else{
                $this->session->set_flashdata('info',
                    '<div class="alert alert-danger alert-dismissible flat">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Filed!</h4>
                    Filed. Data gagal disimpan
                    </div>');
            }
            redirect(site_url('admin/pembelian'),'refresh');
        }else{
            $this->session->set_flashdata('info',
                    '<div class="alert alert-warning alert-dismissible flat">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="fa fa-warning"></i> Warning!</h4>
                    Warning. Data item barang tidak boleh kosong.
                    </div>');
            redirect(site_url('admin/pembelian/add_pembelian'),'refresh');

        }
        
    }

    public function del($id)
    {

        $del = $this->pembelian_model->del($id);
        if ($del) {
            $this->session->set_flashdata('info',
                '<div class="alert alert-success alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Success. Data berhasil dihapus
              </div>');
        }else{
            $this->session->set_flashdata('info',
                '<div class="alert alert-danger alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Filed!</h4>
                Filed. Data gagal dihapus
              </div>');
        }

        redirect(site_url('admin/pembelian'),'refresh');
    }

    public function update($id)
    {
        $data['data'] = $this->pembelian_model->get($id);
        $data['rek_induk'] = $this->penjualan_model->get_rek_induk();
        $this->load->view('admin/V_edit_rek', $data);
    }

    public function save_update()
    {
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($data['id']);

        $update = $this->penjualan_model->update($id, $data);
        if ($update) {
            $this->session->set_flashdata('info',
                '<div class="alert alert-success alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Success. Data berhasil diubah
              </div>');
        }else{
            $this->session->set_flashdata('info',
                '<div class="alert alert-danger alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Filed!</h4>
                Filed. Data gagal diubah
              </div>');
        }

        redirect(site_url('admin/penjualan'),'refresh');
    }

    public function get_detail_barang($id)
    {
        $data = $this->barang_model->get($id);
        echo json_encode($data);
    }

    public function invoice($no_nota)
    {
        $data['title'] = 'Invoice';
        $data['sub_judul'] = 'Invoice Penjualan';
        $data['content'] = 'admin/pembelian/V_invoice';
        $data['data'] = $this->pembelian_model->get_invoice($no_nota);
        $data['status_bayar'] = $this->pembelian_model->get_status_bayar($no_nota);
        $data['data_pembelian'] = $this->pembelian_model->get_pembelian_by_nota($no_nota);
        $data['rek'] = $this->akun_model->get();

        $this->load->view('admin/templates/V_main', $data);
    }

    public function pembayaran()
    {
        $no_nota = $this->input->post('no_nota_pembelian');
        $id_pembelian = $this->input->post('id_pembelian');
        $no_akun = $this->input->post('no_akun');
        $catatan = $this->input->post('catatan');

        $data_bayar = array(
            'id_pembelian' => $id_pembelian,
            'id_rek' => $no_akun,
            'catatan' => $catatan,
            'tgl_bayar' => date('y-m-d'),
        );

        $simpan = $this->pembelian_model->pembayaran($data_bayar);
        if ($simpan) {
            $this->session->set_flashdata('info',
                '<div class="alert alert-success alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Success. Pembayaran berhasil.
              </div>');
        }else{
            $this->session->set_flashdata('info',
                '<div class="alert alert-danger alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Filed!</h4>
                Filed. Pembayaran gagal.
              </div>');
        }

        redirect(site_url('admin/pembelian/invoice/'.$no_nota),'refresh');
    }
}