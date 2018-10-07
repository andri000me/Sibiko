<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_penghargaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (($this->session->userdata('role') != "admin") || $this->session->userdata('role') != "super admin") {
            
        }else{
        	redirect('login');
        }
		$this->load->model('kategori_penghargaan_model','kategori_penghargaan');
	}

	public function index($id=NULL)
	{
		$header['title'] = 'Kategori Kejadian - SMK Negeri 2 Bojonegoro';
		if($this->session->userdata('username'))
        {
			$this->load->view('header',$header);

		 $jml = $this->db->get('tbl_kategori_penghargaan');

		//pengaturan pagination
		 $config['base_url'] = base_url().'kategori_penghargaan/index';
		 $config['total_rows'] = $jml->num_rows();
		 $config['per_page'] = '10';
		 $config['first_page'] = 'Awal';
		 $config['last_page'] = 'Akhir';
		 $config['next_page'] = '&laquo;';
		 $config['prev_page'] = '&raquo;';

		//inisialisasi config
		 $this->pagination->initialize($config);

		//buat pagination
		$data['halaman'] = $this->pagination->create_links();

		//tamplikan data
		$data['query'] = $this->kategori_penghargaan->list_kategori_penghargaan($config['per_page'], $id);
		$data['kategori_penghargaan']=$this->kategori_penghargaan->get_all_kategori_penghargaan();			
		$this->load->view('penghargaan/kategori_penghargaan_view',$data);
		$this->load->view('footer');
        } else{
            redirect('login', 'refresh');
        }
	
	}

	public function subkategori_penghargaan()
	{
		$this->load->view('header');
		$data['kategori_penghargaan']=$this->kategori_penghargaan->get_all_kategori_penghargaan();			
		$this->load->view('penghargaan/subkategori_penghargaan_view',$data);
		$this->load->view('footer');
		
	}

	public function ajax_list()
	{
		$list = $this->kategori_penghargaan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kategori_penghargaan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kategori_penghargaan->nama_penghargaan;
			$row[] = $kategori_penghargaan->deskripsi_penghargaan;
			$row[] = $kategori_penghargaan->point_penghargaan;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" data-target=".modal-subkategori_penghargaan" href="javascript:void()" title="Edit" onclick="edit_subkategori_penghargaan('."'".$kategori_penghargaan->id_subkategori_penghargaan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_subkategori_penghargaan('."'".$kategori_penghargaan->id_subkategori_penghargaan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategori_penghargaan->count_all(),
						"recordsFiltered" => $this->kategori_penghargaan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function delete_kategori_penghargaan($id_kategori_penghargaan)
	{
		$this->kategori_penghargaan->delete_by_id_kategori_penghargaan($id_kategori_penghargaan);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_kategori_penghargaan($id_kategori_penghargaan)
	{
		$data = $this->kategori_penghargaan->get_by_id_kategori_penghargaan($id_kategori_penghargaan);
		echo json_encode($data);
	}


	public function add_kategori_penghargaan()
	{
		$data = array(
				'id_kategori_penghargaan' => $this->input->post('id_kategori_penghargaan'),
				'nama_penghargaan' => $this->input->post('nama_penghargaan'),
			);
		$insert = $this->kategori_penghargaan->add_kategori_penghargaan($data);
		redirect('kategori_penghargaan');
	}

	public function update_kategori_penghargaan()
	{
		$data = array(
				'id_kategori_penghargaan' => $this->input->post('id_kategori_penghargaan'),
				'nama_penghargaan' => $this->input->post('nama_penghargaan'),
			);
		$this->kategori_penghargaan->update_kategori_penghargaan(array('id_kategori_penghargaan' => $this->input->post('id_kategori_penghargaan')), $data);
		echo json_encode(array("status" => TRUE));
	}



	public function delete_subkategori_penghargaan($id_subkategori_penghargaan)
	{
		$this->kategori_penghargaan->delete_by_id_subkategori_penghargaan($id_subkategori_penghargaan);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_subkategori_penghargaan($id_subkategori_penghargaan)
	{
		$data = $this->kategori_penghargaan->get_by_id_subkategori_penghargaan($id_subkategori_penghargaan);
		echo json_encode($data);
	}


	public function add_subkategori_penghargaan()
	{
		$data = array(
				'id_subkategori_penghargaan' => $this->input->post('id_subkategori_penghargaan'),
				'id_kategori_penghargaan' => $this->input->post('id_kategori_penghargaan'),
				'deskripsi_penghargaan' => $this->input->post('deskripsi_penghargaan'),
				'point_penghargaan' => $this->input->post('point_penghargaan')
			);
		$insert = $this->kategori_penghargaan->add_subkategori_penghargaan($data);
		redirect('kategori_penghargaan');
	}

	public function update_subkategori_penghargaan()
	{
		$data = array(
				'id_subkategori_penghargaan' => $this->input->post('id_subkategori_penghargaan'),
				'id_kategori_penghargaan' => $this->input->post('id_kategori_penghargaan'),
				'deskripsi_penghargaan' => $this->input->post('deskripsi_penghargaan'),
				'point_penghargaan' => $this->input->post('point_penghargaan')
			);
		$this->kategori_penghargaan->update(array('id_subkategori_penghargaan' => $this->input->post('id_subkategori_penghargaan')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
}