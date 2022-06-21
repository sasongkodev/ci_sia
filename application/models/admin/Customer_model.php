<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function get($id= null)
	{
		if ($id == null) {
			$query = $this->db->get('customer')->result();
		}else{
			$query = $this->db->where('id_customer', $id)->get('customer')->row_object();
		}

		return $query;
	}
	
	public function add($data)
	{
		return $this->db->insert('customer', $data);
	}

	public function update($id, $data)
	{
		return $this->db->where('id_customer', $id)->update('customer', $data);
	}

	public function del($id)
	{
		return $this->db->where('id_customer', $id)->delete('customer');
	}

}
