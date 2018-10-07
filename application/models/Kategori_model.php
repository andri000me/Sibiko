<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	var $table = 'tbl_subkategori';
	var $column = array('id_subkategori','deskripsi_pelanggaran','point_pelanggaran');
	var $order = array('id_subkategori' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->select('*');
		$this->db->from($this->table);
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_subkategori.id_kategori');

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


	function get_all_kategori() {
			$this->db->select('*');
			$this->db->from('tbl_kategori');
			$query = $this->db->get();
			
			return $query->result();
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

	public function list_kategori($num, $offset)
	 {
		$this->db->order_by('id_kategori', 'ASC');

		$data = $this->db->get('tbl_kategori', $num, $offset);

		return $data->result();
	 }

	public function add_kategori($data)
	{
		$this->db->insert('tbl_kategori', $data);
		return $this->db->insert_id();
	}

	public function get_by_id_kategori($id_kategori)
	{
		$this->db->from('tbl_kategori');
		$this->db->where('id_kategori',$id_kategori);
		$query = $this->db->get();

		return $query->row();
	}

	public function update_kategori($where, $data)
	{
		$this->db->update('tbl_kategori', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id_kategori($id_kategori)
	{
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('tbl_kategori');
	}


	public function add_subkategori($data)
	{
		$this->db->insert('tbl_subkategori', $data);
		return $this->db->insert_id();
	}

	public function get_by_id_subkategori($id_subkategori)
	{
		$this->db->from('tbl_subkategori');
		$this->db->where('id_subkategori',$id_subkategori);
		$query = $this->db->get();

		return $query->row();
	}

	public function update_subkategori($where, $data)
	{
		$this->db->update('tbl_subkategori', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id_subkategori($id_subkategori)
	{
		$this->db->where('id_subkategori', $id_subkategori);
		$this->db->delete('tbl_subkategori');
	}



}
