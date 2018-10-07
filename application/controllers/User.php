<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model','user');
	}

	public function index()
	{
		if (($this->session->userdata('role') == "admin")|| $this->session->userdata('role') == "super admin"){
            
		$header['title'] = 'Data User - SMK Negeri 2 Bojonegoro';

			$this->load->helper('url');
			$this->load->view('header',$header);
			$this->load->view('user/user_view');
			$this->load->view('footer');

	}else{
redirect('login');
}
}

	public function ajax_list()
	{
		$list = $this->user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->nama;
			$row[] = $user->username;
			$row[] = $user->role;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_user('."'".$user->u_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_user('."'".$user->u_id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user->count_all(),
						"recordsFiltered" => $this->user->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($u_id)
	{
		$data = $this->user->get_by_u_id($u_id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'u_id' => $this->input->post('u_id'),
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'role' => $this->input->post('role'),
			);
		$insert = $this->user->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'u_id' => $this->input->post('u_id'),
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'role' => $this->input->post('role'),
			);
		$this->user->update(array('u_id' => $this->input->post('u_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($u_id)
	{
		$this->user->delete_by_u_id($u_id);
		echo json_encode(array("status" => TRUE));
	}

	function importcsv() {
	 	$this->load->library('csvimport');
        $data['datauser'] = $this->user->get_user();
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
                        'password'=>md5($row['password']),
                        'role'=>$row['role'],
                    );
                    $this->user->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url().'user');
            } else 
                $this->session->set_flashdata('failed', 'Format data salah, pastikan nama kelas dan data siswa benar !');
                $this->load->view('user_view', $data);
            }
 
        } 
}
