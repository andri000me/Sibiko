<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login_model extends CI_Model {
    
//    untuk mengcek jumlah username dan password yang sesuai
    function login($username,$password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query =  $this->db->get('user');
        return $query->num_rows();
    }
    
//    untuk mengambil data hasil login
    function data_login($username,$password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get('user')->row();
    }

    function loginSiswa($username) {
        $this->db->where('nis', $username);
        $query =  $this->db->get('tbl_siswa');
        return $query->num_rows();
    }
    
//    untuk mengambil data hasil login
    function data_loginSiswa($username) {
        $this->db->where('nis', $username);
        return $this->db->get('tbl_siswa')->row();
    }
}