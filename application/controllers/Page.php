<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('My_model', 'm');
    }

    public function index()
    {
        $data['title'] = "Crud Ci AJAX";
        $this->load->view('home/page_ajax', $data);
    }

    public function ambildata()
    {
        $dataBarang = $this->m->getData('tbl_barang')->result();
        echo json_encode($dataBarang);
    }

    public function tambahDataCi()
    {
        $kode_barang_ci = $this->input->post('kode_barang_ajax_ci');
        $nama_barang_ci = $this->input->post('nama_barang_ajax_ci');
        $harga_barang_ci = $this->input->post('harga_barang_ajax_ci');
        $stok_barang_ci = $this->input->post('stok_barang_ajax_ci');

        if ($kode_barang_ci == '') {
            $result['pesan_json'] = "Kode Barang Silahkan Di isi";
        } elseif ($nama_barang_ci == '') {
            $result['pesan_json'] = "Nama Barang Harus Di isi";
        } elseif ($harga_barang_ci == '') {
            $result['pesan_json'] = "Harga Barang Harus Du isi";
        } elseif ($stok_barang_ci == '') {
            $result['pesan_json'] = "Stok Barang Harus Di isi";
        } else {
            // langkah selanjutnya kalau semua inputan semuanya sudah ter isi

            // pesan kosong saja jika semua inputan terisi
            $result['pesan_json'] = "";

            $data = array(
                'kode_barang' => $kode_barang_ci,
                'nama_barang' => $nama_barang_ci,
                'harga' => $harga_barang_ci,
                'stok' => $stok_barang_ci
            );

            $this->m->tambahDataModel($data, 'tbl_barang');
        }

        echo json_encode($result);
    }

    public function GetId()
    {
        $id_ci = $this->input->post('id_ajax_edit');
        $where = array('id' => $id_ci);

        $data_barang_ci = $this->m->getIdModel('tbl_barang', $where)->result();

        echo json_encode($data_barang_ci);
    }

    public function EditData()
    {
        $id = $this->input->post('id_ajax_edit');
        $kode_barang_ci = $this->input->post('kode_barang_ajax_edit');
        $nama_barang_ci = $this->input->post('nama_barang_ajax_edit');
        $harga_barang_ci = $this->input->post('harga_barang_edit');
        $stok_barang_ci = $this->input->post('stok_barang_edit');

        if ($kode_barang_ci == '') {
            $result['pesan_json'] = "Kode Barang Silahkan Di isi";
        } elseif ($nama_barang_ci == '') {
            $result['pesan_json'] = "Nama Barang Harus Di isi";
        } elseif ($harga_barang_ci == '') {
            $result['pesan_json'] = "Harga Barang Harus Du isi";
        } elseif ($stok_barang_ci == '') {
            $result['pesan_json'] = "Stok Barang Harus Di isi";
        } else {
            // langkah selanjutnya kalau semua inputan semuanya sudah ter isi

            // pesan kosong saja jika semua inputan terisi
            $result['pesan_json'] = "";
            $where = array('id' => $id);
            $data = array(
                'kode_barang' => $kode_barang_ci,
                'nama_barang' => $nama_barang_ci,
                'harga' => $harga_barang_ci,
                'stok' => $stok_barang_ci
            );

            $this->m->updateDataModel($where, $data, 'tbl_barang');
        }

        echo json_encode($result);
    }


    public function HapusData()
    {
        $id_ci = $this->input->post('id_ajax_delete');
        $where = array('id' => $id_ci);
        $this->m->hapusdata($where, 'tbl_barang');
    }
} //End Controller
