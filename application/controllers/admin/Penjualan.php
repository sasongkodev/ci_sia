<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    var $data_item = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->model( array(
            'admin/penjualan_model',
            'admin/barang_model',
            'admin/customer_model',
            'admin/akun_model',
        ));

        if ($this->session->userdata('status') !== 'admin') {
            redirect(site_url('login'),'refresh');
        }
    }

    public function index()
    {

        $data['title'] = 'Penjualan';
        $data['sub_judul'] = 'Penjualan';
        $data['content'] = 'admin/penjualan/V_penjualan';
        $data['data'] = $this->penjualan_model->get();

        $this->load->view('admin/templates/V_main', $data);
    }

    public function add_penjualan()
    {
        $data['title'] = 'Add Penjualan';
        $data['sub_judul'] = 'Penjualan';
        $data['content'] = 'admin/penjualan/V_tambah_penjualan';
        $data['customer'] = $this->customer_model->get();
        $data['barang'] = $this->barang_model->get();
        $this->load->view('admin/templates/V_main', $data);
    }
    public function add()
    {
        $id_customer = $this->input->post('id_customer');
        $tgl_penjualan = $this->input->post('tgl_penjualan');
        $qty = $this->input->post('qty');
        $id_barang = $this->input->post('id_barang');
        $last_id = $this->penjualan_model->get_last_id()+1;
        $no = sprintf('%04s', $last_id);
        $no_nota = date('dmY').'-'.$no;
        $data_penjualan = array(
            'id_customer' => $id_customer,
            'no_nota_penjualan' => $no_nota,
            'tgl_penjualan' => $tgl_penjualan,
        );
        $id_penjualan = $this->penjualan_model->add($data_penjualan);
        $i=0;
        foreach ($qty as $item => $value)
        {
            $penjualan_detail = array(
                'id_penjualan' => $id_penjualan,
                'id_barang' => $id_barang[$i],
                'qty' => $value
            );
            $this->penjualan_model->add_penjualan_detail($penjualan_detail);
            $i++;
        }
        if ($id_penjualan) {
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
        redirect(site_url('admin/penjualan'),'refresh');
    }

    public function del($id)
    {

        $del = $this->penjualan_model->del($id);
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

        redirect(site_url('admin/penjualan'),'refresh');
    }

    public function update($id)
    {
        $data['data'] = $this->penjualan_model->get($id);
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
        $data['content'] = 'admin/penjualan/V_invoice';
        $data['data'] = $this->penjualan_model->get_invoice($no_nota);
        $data['status_bayar'] = $this->penjualan_model->get_status_bayar($no_nota);
        $data['data_penjualan'] = $this->penjualan_model->get_penjualan_by_nota($no_nota);
        $data['rek'] = $this->akun_model->get();

        $this->load->view('admin/templates/V_main', $data);
    }

    public function pembayaran()
    {
        $no_nota = $this->input->post('no_nota_penjualan');
        $id_penjualan = $this->input->post('id_penjualan');
        $no_akun = $this->input->post('no_akun');
        $catatan = $this->input->post('catatan');

        $data_bayar = array(
            'id_penjualan' => $id_penjualan,
            'id_rek' => $no_akun,
            'catatan' => $catatan,
            'tgl_bayar' => date('y-m-d'),
        );

        $simpan = $this->penjualan_model->pembayaran($data_bayar);
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

        redirect(site_url('admin/penjualan/invoice/'.$no_nota),'refresh');
    }
}