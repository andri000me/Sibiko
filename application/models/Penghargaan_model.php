<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penghargaan_model extends CI_Model {

	var $table = 'tbl_penghargaan';
	var $column = array('id_penghargaan');
	var $order = array('tanggal_penghargaan' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->select('*');
		$this->db->from('tbl_penghargaan');
        $this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_penghargaan.nis');
        $this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_penghargaan.id_guru');
        $this->db->join('tbl_subkategori_penghargaan', 'tbl_subkategori_penghargaan.id_subkategori_penghargaan = tbl_penghargaan.subkategori_penghargaan');

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

	public function get_by_id_penghargaan($id_penghargaan)
	{
		$this->db->from($this->table);
		$this->db->where('id_penghargaan',$id_penghargaan);
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

	public function delete_by_id_penghargaan($id_penghargaan)
	{
		$this->db->where('id_penghargaan', $id_penghargaan);
		$this->db->delete($this->table);
	}

	function get_guru() {
		$this->db->select('*');
		$this->db->from('tbl_guru');
		$query = $this->db->get();
			
		return $query->result();
	}

	function get_siswa() {
		$this->db->select('*');
		$this->db->from('tbl_siswa');
		$query = $this->db->get();
			
		return $query->result();
	}

	function get_all_kategori_penghargaan() {
			$this->db->select('*');
			$this->db->from('tbl_kategori_penghargaan');
			$query = $this->db->get();
			
			return $query->result();
		}


	public function select_data($data) {
		$condition = "tanggal_penghargaan BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY `tanggal_penghargaan` ASC";
		$this->db->select('*');
		$this->db->from('tbl_penghargaan');
        $this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_penghargaan.nis');
        $this->db->join('tbl_subkategori_penghargaan', 'tbl_subkategori_penghargaan.id_subkategori_penghargaan = tbl_penghargaan.subkategori_penghargaan');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_data_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'" . " AND " . 'tanggal_penghargaan ' . "BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY 'tanggal_penghargaan' ASC";
		$this->db->select('*');
		$this->db->from('tbl_penghargaan');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_penghargaan.id_guru');
		$this->db->join('tbl_subkategori_penghargaan', 'tbl_subkategori_penghargaan.id_subkategori_penghargaan = tbl_penghargaan.subkategori_penghargaan');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_semua_data_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_penghargaan');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_penghargaan.id_guru');
		$this->db->join('tbl_subkategori_penghargaan', 'tbl_subkategori_penghargaan.id_subkategori_penghargaan = tbl_penghargaan.subkategori_penghargaan');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

    function get_all_kelas() {
		$this->db->select('*');
		$this->db->from('tbl_kelassiswa');
		$this->db->where("char_length(nama_kelas) < 13");
		$query = $this->db->get();
			
		return $query->result();
	}

    public function select_data_perkelas($data) {
		$condition = "kelas LIKE  " . "'" . $data['kelas_siswa'] . "'" . " AND tanggal_penghargaan BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY 'tanggal_penghargaan' ASC";
		$this->db->select('*');
		$this->db->from('tbl_penghargaan');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_penghargaan.nis');
		$this->db->join('tbl_subkategori_penghargaan', 'tbl_subkategori_penghargaan.id_subkategori_penghargaan = tbl_penghargaan.subkategori_penghargaan');
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

    public function select_by_id($data) {
		$condition = "id_penghargaan = " . "'" . $data['id_penghargaan'] ."'";
		$this->db->select('*');
		$this->db->from('tbl_penghargaan');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_penghargaan.nis');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_penghargaan.id_guru');
		$this->db->join('tbl_subkategori_penghargaan', 'tbl_subkategori_penghargaan.id_subkategori_penghargaan = tbl_penghargaan.subkategori_penghargaan');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

}
