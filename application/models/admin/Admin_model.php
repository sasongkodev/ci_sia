<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function cek_login($data)
	{
		return $this->db->where($data)->get('admin')->row();
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/admin/Admin_model.php */