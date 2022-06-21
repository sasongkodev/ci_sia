<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function get($id= null)
    {
        if ($id == null) {
            $query = $this->db->get('barang')->result();
        }else{
            $query = $this->db->where('id_barang', $id)->get('barang')->row_object();
        }

        return $query;
    }

    public function add($data)
    {
        return $this->db->insert('barang', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_barang', $id)->update('barang', $data);
    }

    public function del($id)
    {
        return $this->db->where('id_barang', $id)->delete('barang');
    }
}