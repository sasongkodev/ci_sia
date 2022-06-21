<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
           'admin/jenis_akun_model',
        ));
    }

    public function index()
    {
        $data['title'] = 'System';
        $data['sub_judul'] = 'System Akun';
        $data['content'] = 'admin/system/akun/V_jenis_akun';
        $data['data'] = $this->jenis_akun_model->get_jenis();
        $data['data_klasifikasi'] = $this->jenis_akun_model->get_klasifikasi();

        $this->load->view('admin/templates/V_main', $data);
    }

    public function add_jenis()
    {
        $data = $this->input->post();
        $simpan = $this->jenis_akun_model->add_jenis($data);
        if ($simpan)
        {
            $this->session->set_flashdata('info',
                '<div class="alert alert-success alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data berhasil disimpan.
              </div>');
        }else{
            $this->session->set_flashdata('info',
                '<div class="alert alert-danger alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Filed!</h4>
               Data gagal disimpan.
              </div>');
        }

        redirect(site_url('admin/system/akun'));
    }

    public function add_klasifikasi()
    {
        $data = $this->input->post();
        $id_jenis = $this->input->post('id_jen');
        $id_klas = $this->input->post('id_klas');
        $data['kode_klasifikasi'] = $id_jenis.''.$id_klas;
        unset($data['id_jen']);
        unset($data['id_klas']);
        $simpan = $this->jenis_akun_model->add_klasifikasi($data);
        if ($simpan)
        {
            $this->session->set_flashdata('info',
                '<div class="alert alert-success alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data berhasil disimpan.
              </div>');
        }else{
            $this->session->set_flashdata('info',
                '<div class="alert alert-danger alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Filed!</h4>
               Data gagal disimpan.
              </div>');
        }

        redirect(site_url('admin/system/akun'));
    }

    public function del_klasifikasi($id)
    {
        $del = $this->jenis_akun_model->del_klasifikasi($id);
        if ($del)
        {
            $this->session->set_flashdata('info',
                '<div class="alert alert-success alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data berhasil dihapus.
              </div>');
        }else{
            $this->session->set_flashdata('info',
                '<div class="alert alert-danger alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Filed!</h4>
               Data gagal dihapus.
              </div>');
        }

        redirect(site_url('admin/system/akun'));
    }

    public function get_edit_klasifikasi($id)
    {
        $data['klas'] = $this->jenis_akun_model->get_klasifikasi($id);
        $data['data'] = $this->jenis_akun_model->get_jenis();

        $this->load->view('admin/system/akun/v_edit_klasifikasi', $data);
    }

    public function update_klasifikasi()
    {
        $id = $this->input->post('id');
        $id_jenis = $this->input->post('id_jen');
        $id_klas = $this->input->post('id_klas');
        $data_klas = array(
            'kode_klasifikasi' => $id_jenis.''.$id_klas,
            'kode_jenis' => $this->input->post('kode_jenis'),
            'nama_klasifikasi' => $this->input->post('nama_klasifikasi'),
        );

        $update = $this->jenis_akun_model->update_klasifikasi($id, $data_klas);
        if ($update)
        {
            $this->session->set_flashdata('info',
                '<div class="alert alert-success alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data berhasil diubah.
              </div>');
        }else{
            $this->session->set_flashdata('info',
                '<div class="alert alert-danger alert-dismissible flat">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Filed!</h4>
               Data gagal diubah.
              </div>');
        }

        redirect(site_url('admin/system/akun'));
    }
}