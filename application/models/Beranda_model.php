<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function jumlah_siswa(){
	  $query = $this->db->query("
	   SELECT * FROM tbl_siswa WHERE char_length(kelas_siswa) < 12");
	  return $query->num_rows();
	 }

	 public function jumlah_bimbingan(){
	  $query = $this->db->query("
	   SELECT * FROM tbl_bimbingan");
	  return $query->num_rows();
	 }

	 public function jumlah_kejadian(){
	  $query = $this->db->query("
	   SELECT * FROM tbl_pelanggaransiswa");
	  return $query->num_rows();
	 }

	 public function jumlah_penghargaan(){
	  $query = $this->db->query("
	   SELECT * FROM tbl_penghargaan");
	  return $query->num_rows();
	 }

	 public function list_pelanggaran($num, $offset)
	 {
		$this->db->order_by('id_pelanggaran', 'ASC');

		$data = $this->db->get('tbl_pelanggaransiswa', $num, $offset);

		return $data->result();
	 }

	 function get_point_kejadian() {
			$this->db->select('*');
			$this->db->from('tbl_pelanggaransiswa');
			$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_pelanggaransiswa.nis');
			$this->db->where("char_length(kelas_siswa) < 13");
			$this->db->select_sum('point_pelanggaran','total');
			$this->db->group_by('tbl_siswa.nis'); 
			//$this->db->having('total > 20 ');
			$this->db->having('tanggal_pelanggaran > ', date("Y-m-d"));
			$this->db->order_by('total','desc');
			$this->db->limit(10);
			$query = $this->db->get();
			
			return $query->result();
		}

	function get_point_penghargaan() {
			$this->db->select('*');
			$this->db->from('tbl_penghargaan');
			$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_penghargaan.nis');
			$this->db->where("char_length(kelas_siswa) < 13");
			$this->db->select_sum('poin_penghargaan','total_penghargaan');
			$this->db->group_by('tbl_siswa.nis'); 
			$this->db->having('tanggal_penghargaan > ', date("Y-m-d"));
			$this->db->limit(3);
			$this->db->order_by('total_penghargaan','desc');
			$query = $this->db->get();
			
			return $query->result();
		}

}

