<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (($this->session->userdata('role') != "admin") || $this->session->userdata('role') != "super admin") {
            
        }else{
        	redirect('login');
        }
		$this->load->library('fpdf');
		$this->load->model('surat_model','surat');
	}

	public function index()
	{
		$header['title'] = 'Data Penghargaan - SMK Negeri 2 Bojonegoro';
			$this->load->view('surat/surat_view');		
	}

	public function search()
	{
		$keyword = $this->uri->segment(3);
		$data = $this->db->from('tbl_siswa')->like('nama_siswa',$keyword)->get();	
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->nama_siswa,
				'nis'	=>$row->nis,
				'kelas_siswa'	=>$row->kelas_siswa

			);
		}
		echo json_encode($arr);
	}

	public function cetak()
	{
		$nis = $this->input->post('nis');
		$input = array(
			'nis' => $nis,
		);
		$semua = array(
			'data' => $this->surat->select_data($input),
			);
        $this->load->view('surat/surat_cetak',$semua);
	}

}
	