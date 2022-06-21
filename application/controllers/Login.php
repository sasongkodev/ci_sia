<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'admin/admin_model',
		));
	}

	public function index()
	{
		$this->load->view('V_login');
	}

	public function cek_login()
	{
		$username = $this->input->post('username');
		$pass = $this->input->post('password');

		$data = array(
			'username' => $username,
			'password' => md5($pass),
		);

		$cek = $this->admin_model->cek_login($data);
		if (count($cek) > 0) {
			$data_sess = array(
				'id_admin' => $cek->id_admin,
				'nama_admin' => $cek->nama_admin,
				'status' => 'admin',
			);
			$this->session->set_userdata($data_sess);
			redirect(site_url('admin/home'),'refresh');
		}else{
			redirect(site_url('login'),'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('login'),'refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */