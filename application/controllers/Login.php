<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller {
 
    public function index($error = NULL) {
        $data = array(
            'title' => 'Login Page',
            'action' => site_url('login/proses'),
            'action2' => site_url('login/prosesSiswa'),
            'error' => $error
        );
        $this->load->view('login', $data);
    }
 
    public function proses() {
        $this->load->model('login_model');
        $login = $this->login_model->login($this->input->post('username'), md5($this->input->post('password')));
 
        if ($login == 1) {
//          ambil detail data
            $row = $this->login_model->data_login($this->input->post('username'), md5($this->input->post('password')));
 
//          daftarkan session
            $data = array(
                'logged' => TRUE,
                'u_id' => $row->u_id,
                'username' => $row->username,
                'nama' => $row->nama,
                'role' => $row->role
            );
            $this->session->set_userdata($data);
 
//            redirect ke halaman sukses
            if ($this->session->userdata('role') == 'admin') {
                redirect(site_url('beranda'));
            }elseif ($this->session->userdata('role') == 'super admin') {
               redirect(site_url('beranda'));
            }elseif ($this->session->userdata('role') == 'guru') {
               redirect(site_url('beranda'));
            }
            redirect(site_url('wali'));
        } else {
            redirect(site_url('login'));
            $error = 'username / password salah';
            $this->index($error);
        }
    }

    public function prosesSiswa() {
        $this->load->model('login_model');
        $login = $this->login_model->loginSiswa($this->input->post('username'), $this->input->post('password'));
 
        if ($login == 1) {
//          ambil detail data
            $row = $this->login_model->data_loginSiswa($this->input->post('username'), $this->input->post('password'));
 
//          daftarkan session
            $data = array(
                'logged' => TRUE,
                'nis' => $row->nis,
                'nama_siswa' => $row->nama_siswa,
            );
            $this->session->set_userdata($data);
 
//            redirect ke halaman sukses
            redirect(site_url('siswa/data'));
        } else {
            redirect(site_url('login'));
            $error = 'username / password salah';
            $this->index($error);
        }
    }
 
    function logout() {
//        destroy session
        $this->session->sess_destroy();
        
//        redirect ke halaman login
        redirect(site_url('login'));
    }
 
}