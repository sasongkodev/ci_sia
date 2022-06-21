<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model {

	public function get($id= null)
	{
		if ($id == null) {
			$query = $this->db->select('*')
                ->from('akun as a')
                ->join('klasifikasi_akun as ka', 'a.kode_klasifikasi=ka.kode_klasifikasi')
                ->join('jenis_akun as ja','ka.kode_jenis=ja.kode_jenis')
                ->order_by('kode_akun','ASC')
                ->get()->result();
		}else{
//			$query = $this->db->where('kode_akun', $id)->get('akun')->row_object();
            $query = $this->db->select('*')
                ->from('akun as a')
                ->join('klasifikasi_akun as ka', 'a.kode_klasifikasi=ka.kode_klasifikasi')
                ->join('jenis_akun as ja','ka.kode_jenis=ja.kode_jenis')
                ->where('kode_akun', $id)
                ->get()->row_object();
		}

		return $query;
	}
	
	public function add($data)
	{
		return $this->db->insert('akun', $data);
	}

	public function update($id, $data)
	{
		return $this->db->where('kode_akun', $id)->update('akun', $data);
	}

	public function del($id)
	{
		return $this->db->where('kode_akun', $id)->delete('akun');
	}

	public function get_header()
	{
		return $this->db->where('kode_akun_header', '')->or_where('header', 'T')->get('akun')->result();
	}

}

