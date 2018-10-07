<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran_model extends CI_Model {

	var $table = 'tbl_pelanggaransiswa';
	var $column = array('id_pelanggaran','nama_siswa','kelas','tanggal_pelanggaran');
	var $order = array('tanggal_pelanggaran' => 'DESC');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
        $this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_pelanggaransiswa.nis');
        $this->db->join('tbl_subkategori', 'tbl_subkategori.id_subkategori = tbl_pelanggaransiswa.subkategori');
        $this->db->order_by('tanggal_pelanggaran','desc');

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

	public function get_by_id_pelanggaran($id_pelanggaran)
	{
		$this->db->from($this->table);
		$this->db->where('id_pelanggaran',$id_pelanggaran);
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

	public function delete_by_id_pelanggaran($id_pelanggaran)
	{
		$this->db->where('id_pelanggaran', $id_pelanggaran);
		$this->db->delete($this->table);
	}

	function get_all_kategori() {
			$this->db->select('*');
			$this->db->from('tbl_kategori');
			$query = $this->db->get();

			return $query->result();
		}

	function get_guru() {
		$this->db->select('*');
		$this->db->from('tbl_guru');
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

	function get_poin($nis)
	{
		$this->db->select("SUM(point_pelanggaran) as poin");
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->where("nis",$nis);

		$query = $this->db->get();
		return $query->result();
	}

	function get_point_kejadian($data) {
		$condition = "tanggal_pelanggaran BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] ."'";
		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_pelanggaransiswa.nis');
        $this->db->where($condition);
		//$this->db->where("char_length(kelas_siswa) < 13");
		$this->db->select_sum('point_pelanggaran','total');
		$this->db->group_by('tbl_siswa.nis');
		//$this->db->having('total > 20 ');
		//$this->db->having('tanggal_pelanggaran > ', '2016-01-01');
		$this->db->order_by('total','desc');
		$query = $this->db->get();

		return $query->result();
		}

	public function select_data($data) {
		$condition = "tanggal_pelanggaran BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY 'tanggal_pelanggaran' ASC";
		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_pelanggaransiswa.nis');
		$this->db->join('tbl_subkategori', 'tbl_subkategori.id_subkategori = tbl_pelanggaransiswa.subkategori');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_data_perkelas($data) {
		$condition = "kelas LIKE  " . "'" . $data['kelas_siswa'] . "'" . " AND tanggal_pelanggaran BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY 'tanggal_pelanggaran' ASC";
		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_pelanggaransiswa.nis');
		$this->db->join('tbl_subkategori', 'tbl_subkategori.id_subkategori = tbl_pelanggaransiswa.subkategori');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }

    public function select_data_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'" . " AND " . 'tanggal_pelanggaran ' . "BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "' ORDER BY 'tanggal_pelanggaran' ASC";
		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->join('tbl_subkategori', 'tbl_subkategori.id_subkategori = tbl_pelanggaransiswa.subkategori');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_pelanggaransiswa.id_guru');
        $this->db->where($condition);
		$query = $this->db->get();


		return $query->result();
    }

    public function select_semua_data_siswa($data) {
		$condition = "nis LIKE " . "'" . $data['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->join('tbl_subkategori', 'tbl_subkategori.id_subkategori = tbl_pelanggaransiswa.subkategori');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_pelanggaransiswa.id_guru');
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
		$condition = "id_pelanggaran = " . "'" . $data['id_pelanggaran'] ."'";
		$this->db->select('*');
		$this->db->from('tbl_pelanggaransiswa');
		$this->db->join('tbl_subkategori', 'tbl_subkategori.id_subkategori = tbl_pelanggaransiswa.subkategori');
		$this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_pelanggaransiswa.nis');
		$this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_pelanggaransiswa.id_guru');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }
}
