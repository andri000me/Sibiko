<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan_model extends CI_Model {

	var $table = 'tbl_bimbingan';
	var $column = array('id_bimbingan','nama_siswa','kelas','masalah_siswa');
	var $order = array('tanggal_bimbingan' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->select('*');
		$this->db->from('tbl_bimbingan');
        $this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_bimbingan.nis');

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

	public function get_by_id_bimbingan($id_bimbingan)
	{
		$this->db->from($this->table);
		$this->db->where('id_bimbingan',$id_bimbingan);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id_bimbingan($id_bimbingan)
	{
		$this->db->where('id_bimbingan', $id_bimbingan);
		$this->db->delete($this->table);
	}

	public function select_by_id($data) {
		$condition = "id_bimbingan = " . "'" . $data['id_bimbingan'] ."'";
		$this->db->select('*');
		$this->db->from('tbl_bimbingan');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_bimbingan.nis');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

	public function select_data($data) {
		$condition = "tanggal_bimbingan BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY `tanggal_bimbingan` ASC";
		$this->db->select('*');
		$this->db->from('tbl_bimbingan');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_bimbingan.nis');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_data_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'" . " AND " . 'tanggal_bimbingan ' . "BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY 'tanggal_bimbingan' ASC";
		$this->db->select('*');
		$this->db->from('tbl_bimbingan');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_semua_data_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_bimbingan');
        $this->db->where($condition);
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
