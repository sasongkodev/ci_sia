<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') !== 'admin') {
            redirect(site_url('login'),'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['sub_judul'] = '<i class="fa fa-dashboard"></i> Dashboard';
        $data['content'] = 'admin/V_dashboard';
        $this->load->view('admin/templates/V_main', $data);
    }
}