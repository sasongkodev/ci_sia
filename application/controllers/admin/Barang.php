<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'admin/barang_model',
        ));

        if ($this->session->userdata('status') !== 'admin') {
            redirect(site_url('login'),'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Barang';
        $data['sub_judul'] = 'Barang';
        $data['content'] = 'admin/V_barang';
        $data['data'] = $this->barang_model->get();

        $this->load->view('admin/templates/V_main', $data);
    }

    public function add()
    {
        $data = $this->input->post();

        $simpan = $this->barang_model->add($data);
        if ($simpan) {
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

        redirect(site_url('admin/barang'),'refresh');
    }

    public function del($id)
    {

        $del = $this->barang_model->del($id);
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

        redirect(site_url('admin/barang'),'refresh');
    }

    public function update($id)
    {
        $data['data'] = $this->barang_model->get($id);
        $this->load->view('admin/V_edit_barang', $data);
    }

    public function save_update()
    {
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($data['id']);

        $update = $this->barang_model->update($id, $data);
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

        redirect(site_url('admin/barang'),'refresh');
    }

}