<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

	var $table = 'tbl_kelassiswa';
	var $column = array('kode_kelas','nama_kelas','nama_guru');
	var $order = array('kode_kelas' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->select('*');
		$this->db->from('tbl_kelassiswa');
        $this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_kelassiswa.wali_kelas');

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}


	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function get_all_kelas() {
			$this->db->select('*');
			$this->db->from('tbl_kelassiswa');
			$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_kelassiswa.wali_kelas');
			$query = $this->db->get();
			
			return $query->result();
		}

	function get_wali_kelas() {
			$this->db->select('*');
			$this->db->from('tbl_guru');
			$query = $this->db->get();
			
			return $query->result();
		}

	public function list_kelas($num, $offset)
	 {
		$this->db->order_by('kode_kelas', 'ASC');

		$data = $this->db->get('tbl_kelassiswa', $num, $offset);

		return $data->result();
	 }

	public function add_kelas($data)
	{
		$this->db->insert('tbl_kelassiswa', $data);
		return $this->db->insert_id();
	}

	public function get_by_kode_kelas($kode_kelas)
	{
		$this->db->from('tbl_kelassiswa');
		$this->db->where('kode_kelas',$kode_kelas);
		$query = $this->db->get();

		return $query->row();
	}

	public function update_kelas($where, $data)
	{
		$this->db->update('tbl_kelassiswa', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_kode_kelas($kode_kelas)
	{
		$this->db->where('kode_kelas', $kode_kelas);
		$this->db->delete('tbl_kelassiswa');
	}

	function get_guru() {
		$this->db->select('*');
		$this->db->from('tbl_guru');
		$query = $this->db->get();
			
		return $query->result();
	}


}
