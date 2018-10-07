<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {

public function select_data($input) {
        $condition = "nis LIKE " . "'" . $input['nis'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_siswa');
        $this->db->where($condition);
		$query = $this->db->get();

		return $query->result();
    }
}
