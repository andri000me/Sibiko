<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata('username')=="") {
            redirect('login');
        }
        $this->load->helper('text');
        $this->load->model('wali_model','wali');
        	}

	public function index()
	{
		$header['title'] = 'Data Wali Siswa - SMK Negeri 2 Bojonegoro';
        $nis = $this->session->userdata('u_id');
		$data = array(
			'nis' => $nis,
		);
		$semua = array(
			'dataSiswa' => $this->wali->select_biodata_siswa($data),
			'dataBimbingan' => $this->wali->select_bimbingan_siswa($data),
			'dataPelanggaran' => $this->wali->select_pelanggaran_siswa($data),
			'dataPenghargaan' => $this->wali->select_penghargaan_siswa($data),
		);
		
			$this->load->helper('url');
			$this->load->view('header',$header);
			$this->load->view('wali/wali_view',$semua);
			$this->load->view('footer');
        }

        function importcsv() {
	 	$this->load->library('csvimport');
        $data['dataguru'] = $this->wali->get_wali();
        $data['error'] = ''; 
 
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
 
        $this->load->library('upload', $config);
 

        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
 
            $this->load->view('csvindex', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  'assets/uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'u_id'=>$row['u_id'],
                        'nama'=>$row['nama'],
                        'username'=>$row['username'],
                        'password'=>$row['password'],
                        'no_telepon_guru'=>$row['no_telepon_guru'],
                        'status'=>$row['status'],
                    );
                    $this->guru->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url().'guru');
            } else 
                $this->session->set_flashdata('failed', 'Format data salah, pastikan nama kelas dan data siswa benar !');
                $this->load->view('guru_view', $data);
            }
 
        } 

	}
