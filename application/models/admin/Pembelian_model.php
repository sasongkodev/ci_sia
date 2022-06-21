<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{
    public function get($id= null)
    {
        if ($id == null) {
            $query = $this->db->select('*, sum(harga_jual*qty) as total_harga')
                ->from('pembelian as p')
                ->join('pembelian_detail as pd', 'p.id_pembelian=pd.id_pembelian')
                ->join('barang as b', 'b.id_barang=pd.id_barang')
                ->join('suplier as s', 's.id=p.id_suplier')
                ->join('pembayaran as pem', 'p.id_pembelian=pem.id_pembelian', 'left')
                ->order_by('p.id_pembelian','DESC')
                ->group_by('p.id_pembelian')
                ->get()->result();
        }else{
            $query = $this->db->where('id_pembelian', $id)->get('pembelian')->row_object();
        }

        return $query;
    }

    public function add($data)
    {
        $this->db->insert('pembelian', $data);
        return $this->db->insert_id();
    }

    public function add_pembelian_detail($data)
    {
        return $this->db->insert('pembelian_detail', $data);
    }

    public function get_last_id()
    {
        $query = $this->db->order_by('id_pembelian', 'DESC')->get('pembelian')->row();
        if (count($query) == 0)
        {
            return 0;
        }else{
            return $query->id_pembelian;
        }
    }

    public function get_invoice($no_nota)
    {
        return $this->db->select('*')
            ->from('pembelian as p')
            ->join('pembelian_detail as pd', 'p.id_pembelian=pd.id_pembelian')
            ->join('barang as bar', 'bar.id_barang=pd.id_barang')
            ->where('no_nota_pembelian', $no_nota)
            ->get()->result();
    }

    public function get_status_bayar($no_nota)
    {
        $query = $this->db->select('*')
            ->from('pembelian as p')
            ->join('pembayaran as pem', 'p.id_pembelian=pem.id_pembelian','left')
            ->where('no_nota_pembelian', $no_nota)
            ->get()->row();
        return $query->id_bayar;
    }

    public function get_pembelian_by_nota($no_nota)
    {
        return $this->db->select('*')
            ->from('pembelian as p')
            ->join('suplier as s','p.id_suplier=s.id')
            ->where('no_nota_pembelian', $no_nota)
            ->get()->row();
    }

    public function pembayaran($data)
    {
        return $this->db->insert('pembayaran', $data);
    }

}