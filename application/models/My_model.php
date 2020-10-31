<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My_model extends CI_Model
{
    // menagmbil isi parameter dari getData di controller page
    public function getData($table)
    {
        // ini cara menentukan tabel apa saja yang di akan di panggil sesuai dengan controllernya
        return $this->db->get($table);
    }

    // fungsi tambah data
    public function tambahDataModel($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function getIdModel($table, $where)
    {
        return  $this->db->get_where($table, $where);
    }

    public function updateDataModel($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapusdata($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
} // end model
