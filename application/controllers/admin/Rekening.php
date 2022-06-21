<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'admin/akun_model',
			'admin/jenis_akun_model',
		));

		if ($this->session->userdata('status') !== 'admin') {
            redirect(site_url('login'),'refresh');
        }
	}
	public function index()
	{

		$data['title'] = 'Akun';
		$data['sub_judul'] = 'Akun';
		$data['content'] = 'admin/V_akun';
		$data['data'] = $this->akun_model->get();
		$data['klas_akun'] = $this->jenis_akun_model->get_klasifikasi();
		$data['header'] = $this->akun_model->get_header();

		$this->load->view('admin/templates/V_main', $data);
	}

	public function add()
	{
		$data = $this->input->post();
		$id_klas = $this->input->post('id_klas');
		$id_akun = $this->input->post('id_akun');
		$kode_akun = $id_klas.''.$id_akun;
		unset($data['id_klas']);
		unset($data['id_akun']);
		$data['kode_akun'] = $kode_akun;

		$simpan = $this->akun_model->add($data);
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

		redirect(site_url('admin/rekening'),'refresh');
	}

	public function del($id)
	{

		$del = $this->akun_model->del($id);
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

		redirect(site_url('admin/rekening'),'refresh');
	}

	public function update($id)
	{
		$data['data'] = $this->akun_model->get($id);
        $data['klas_akun'] = $this->jenis_akun_model->get_klasifikasi();
        $data['header'] = $this->akun_model->get_header();
		$this->load->view('admin/V_edit_akun', $data);
	}

	public function save_update()
	{
		$id = $this->input->post('id');
        $data = $this->input->post();
        $id_klas = $this->input->post('id_klas');
        $id_akun = $this->input->post('id_akun');
        $kode_akun = $id_klas.''.$id_akun;
        unset($data['id_klas']);
        unset($data['id_akun']);
		unset($data['id']);
        $data['kode_akun'] = $kode_akun;

		$update = $this->akun_model->update($id, $data);
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

		redirect(site_url('admin/rekening'),'refresh');
	}

}

/* End of file Rekening.php */
/* Location: ./application/controllers/admin/Rekening.php */