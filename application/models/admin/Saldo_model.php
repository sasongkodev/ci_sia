<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_model extends CI_Model {

	public function get($id= null)
	{
		if ($id == null) {
			$query = $this->db->select('*')
			->from('saldo_awal as sa')
			->join('rekening as rek', 'sa.id_rek=rek.id_rek')
			->get()->result();
		}else{
			$query = $this->db->select('*')
			->from('saldo_awal as sa')
			->join('rekening as rek', 'sa.id_rek=rek.id_rek')
			->where('id_saldo', $id)
			->get()->row_object();
		}

		return $query;
	}
	
	public function add($data)
	{
		return $this->db->insert('saldo_awal', $data);
	}

	public function update($id, $data)
	{
		return $this->db->where('id_saldo', $id)->update('saldo_awal', $data);
	}

	public function del($id)
	{
		return $this->db->where('id_saldo', $id)->delete('saldo_awal');
	}

}

/* End of file saldo_model.php */
/* Location: ./application/models/admin/saldo_model.php */