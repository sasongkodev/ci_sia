<?php

class Suplier_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get($id=null)
	{
		if ($id==null) {
			$query = $this->db->get('suplier')->result();
		}else{
			$query = $this->db->where('id', $id)->get('suplier')->row_object();					
		}

		return $query;
	}

	public function add($data)
	{
		return $this->db->insert('suplier', $data);
	}

	public function del($id)
	{
		return $this->db->where('id', $id)->delete('suplier');
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update('suplier', $data);
	}
}