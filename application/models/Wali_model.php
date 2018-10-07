<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali_model extends CI_Model {

	var $table = 'tbl_wali';
	var $column = array('id_wali','nama_wali','nis');
	var $order = array('id_wali' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function insert_csv($data) {
        $this->db->insert('tbl_guru', $data);
    }

    public function get_wali()
	{
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();

		return $query->row();
	}

	public function select_bimbingan_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_bimbingan');
        $this->db->where($condition);
        //$this->db->limit(5);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_pelanggaran_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->join('tbl_subkategori', 'tbl_subkategori.id_subkategori = tbl_pelanggaransiswa.subkategori');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_pelanggaransiswa.id_guru');
        $this->db->where($condition);
        //$this->db->limit(5);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_penghargaan_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_penghargaan');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_penghargaan.id_guru');
		$this->db->join('tbl_subkategori_penghargaan', 'tbl_subkategori_penghargaan.id_subkategori_penghargaan = tbl_penghargaan.subkategori_penghargaan');
        $this->db->where($condition);
       // $this->db->limit(5);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_biodata_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_siswa');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

}
