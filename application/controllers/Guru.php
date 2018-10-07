<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('guru_model','guru');
	}

	public function index()
	{
		if (($this->session->userdata('role') == "admin") || ($this->session->userdata('role') == "super admin" )){
		 $header['title'] = 'Data Guru - SMK Negeri 2 Bojonegoro';
			$this->load->helper('url');
			$this->load->view('header',$header);
			$this->load->view('guru/guru_view');
			$this->load->view('footer');
		}else{
			redirect('login');
		}
	}

	public function edit()
	{
		$u_id = $this->session->userdata('u_id');
		$data = array(
			'u_id' => $u_id,
		);
		$semua = array(
			'dataguru' => $this->guru->select_user_guru($data),
		);

		$header['title'] = 'Edit Akun Guru - SMK Negeri 2 Bojonegoro';
			$this->load->helper('url');
			$this->load->view('header',$header);
			$this->load->view('guru/edit_view',$semua);
			$this->load->view('footer');

	}

	public function ajax_list()
	{
		$list = $this->guru->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $guru) {
			$no++;
			$row = array();
			$row[] = $guru->id_guru;
			$row[] = $guru->nama_guru;
			$row[] = $guru->alamat_guru;
			$row[] = $guru->jabatan_guru;
			$row[] = $guru->status;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_guru('."'".$guru->id_guru."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_guru('."'".$guru->id_guru."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->guru->count_all(),
						"recordsFiltered" => $this->guru->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id_guru)
	{
		$data = $this->guru->get_by_id_guru($id_guru);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'nama_guru' => $this->input->post('nama_guru'),
				'alamat_guru' => $this->input->post('alamat_guru'),
				'jabatan_guru' => $this->input->post('jabatan_guru'),
				'no_telepon_guru' => $this->input->post('no_telepon_guru'),
				'status' => $this->input->post('status'),
			);
		$insert = $this->guru->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'nama_guru' => $this->input->post('nama_guru'),
				'alamat_guru' => $this->input->post('alamat_guru'),
				'jabatan_guru' => $this->input->post('jabatan_guru'),
				'no_telepon_guru' => $this->input->post('no_telepon_guru'),
				'status' => $this->input->post('status'),
			);
		$this->guru->update(array('id_guru' => $this->input->post('id_guru')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id_guru)
	{
		$this->guru->delete_by_id_guru($id_guru);
		echo json_encode(array("status" => TRUE));
	}

	function importcsv() {
	 	$this->load->library('csvimport');
        $data['dataguru'] = $this->guru->get_guru();
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
                        'id_guru'=>$row['id_guru'],
                        'nama_guru'=>$row['nama_guru'],
                        'alamat_guru'=>$row['alamat_guru'],
                        'jabatan_guru'=>$row['jabatan_guru'],
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
