<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_akun_model extends CI_Model
{
    public function get_jenis($id = null)
    {
        if ($id == null)
        {
            $query = $this->db->get('jenis_akun')->result();
        }else{
            $query = $this->db->where('kode_jenis', $id)->get('jenis_akun')->row();
        }
        return $query;
    }

    public function add_jenis($data)
    {
        return $this->db->insert('jenis_akun', $data);
    }

    public function get_klasifikasi($id = null)
    {
        if ($id == null)
        {
            $query = $this->db->select('*')
                ->from('klasifikasi_akun as k')
                ->join('jenis_akun as j', 'k.kode_jenis=j.kode_jenis')
                ->get()->result();
        }else{
            $query = $this->db->select('*')
                ->from('klasifikasi_akun as k')
                ->join('jenis_akun as j', 'k.kode_jenis=j.kode_jenis')
                ->where('kode_klasifikasi', $id)
                ->get()->row();
        }
        return $query;
    }

    public function add_klasifikasi($data)
    {
        return $this->db->insert('klasifikasi_akun', $data);
    }

    public function del_klasifikasi($id)
    {
        return $this->db->where('kode_klasifikasi', $id)->delete('klasifikasi_akun');
    }

    public function update_klasifikasi($id, $data)
    {
        return $this->db->where('kode_klasifikasi', $id)->update('klasifikasi_akun', $data);
    }
}