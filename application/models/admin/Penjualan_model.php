<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    public function get($id= null)
    {
        if ($id == null) {
            $query = $this->db->select('*, sum(harga_jual*qty) as total_harga')
                ->from('penjualan as p')
                ->join('penjualan_detail as pd', 'p.id_penjualan=pd.id_penjualan')
                ->join('barang as b', 'b.id_barang=pd.id_barang')
                ->join('customer as c', 'c.id_customer=p.id_customer')
                ->join('pembayaran as pem', 'p.id_penjualan=pem.id_penjualan', 'left')
                ->order_by('p.id_penjualan','DESC')
                ->group_by('p.id_penjualan')
                ->get()->result();
        }else{
            $query = $this->db->where('id_penjualan', $id)->get('penjualan')->row_object();
        }

        return $query;
    }

    public function add($data)
    {
        $this->db->insert('penjualan', $data);
        return $this->db->insert_id();
    }

    public function add_penjualan_detail($data)
    {
        return $this->db->insert('penjualan_detail', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_penjualan', $id)->update('penjualan', $data);
    }

    public function del($id)
    {
        return $this->db->where('id_penjualan', $id)->delete('penjualan');
    }

    public function get_last_id()
    {
        $query = $this->db->order_by('id_penjualan', 'DESC')->get('penjualan')->row();
        return $query->id_penjualan;
    }

    public function get_invoice($no_nota)
    {
        return $this->db->select('*')
            ->from('penjualan as p')
            ->join('penjualan_detail as pd', 'p.id_penjualan=pd.id_penjualan')
            ->join('barang as bar', 'bar.id_barang=pd.id_barang')
            ->where('no_nota_penjualan', $no_nota)
            ->get()->result();
    }

    public function get_status_bayar($no_nota)
    {
        $query = $this->db->select('*')
            ->from('penjualan as p')
            ->join('pembayaran as pem', 'p.id_penjualan=pem.id_penjualan','left')
            ->where('no_nota_penjualan', $no_nota)
            ->get()->row();
        return $query->id_bayar;
    }

    public function get_penjualan_by_nota($no_nota)
    {
         return $this->db->select('*')
             ->from('penjualan as p')
             ->join('customer as c','p.id_customer=c.id_customer')
             ->where('no_nota_penjualan', $no_nota)
             ->get()->row();
     }

     public function pembayaran($data)
     {
         return $this->db->insert('pembayaran', $data);
     }

}