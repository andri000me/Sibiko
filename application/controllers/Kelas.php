<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (($this->session->userdata('role') != "admin") || $this->session->userdata('role') != "super admin") {
            
        }else{
        	redirect('login');
        }
		$this->load->model('kelas_model','kelas');
	}

	public function index($id=NULL)
	{
		$header['title'] = 'Data Kelas - SMK Negeri 2 Bojonegoro';
		if($this->session->userdata('username'))
        {
        	$data['id_guru'] = $this->kelas->get_guru();
            $this->load->view('header',$header);
			$this->load->view('kelas/kelas_view',$data);
			$this->load->view('footer');
        } else{
            redirect('login', 'refresh');
        }
		
	}

	public function ajax_list()
	{
		$list = $this->kelas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kelas) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kelas->kode_kelas;
			$row[] = $kelas->nama_kelas;
			$row[] = $kelas->nama_guru;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_kelas('."'".$kelas->kode_kelas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_kelas('."'".$kelas->kode_kelas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kelas->count_all(),
						"recordsFiltered" => $this->kelas->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function delete_kelas($kode_kelas)
	{
		$this->kelas->delete_by_kode_kelas($kode_kelas);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_kelas($kode_kelas)
	{
		$data = $this->kelas->get_by_kode_kelas($kode_kelas);
		echo json_encode($data);
	}


	public function add_kelas()
	{
		$data = array(
				'kode_kelas' => $this->input->post('kode_kelas'),
				'nama_kelas' => $this->input->post('nama_kelas'),
				'wali_kelas' => $this->input->post('wali_kelas'),
			);
		$insert = $this->kelas->add_kelas($data);
		redirect('kelas');
	}

	public function update_kelas()
	{
		$data = array(
				'kode_kelas' => $this->input->post('kode_kelas'),
				'nama_kelas' => $this->input->post('nama_kelas'),
				'wali_kelas' => $this->input->post('wali_kelas'),
			);
		$this->kelas->update_kelas(array('kode_kelas' => $this->input->post('kode_kelas')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
}