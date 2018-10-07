<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (($this->session->userdata('role') != "admin") || $this->session->userdata('role') != "super admin") {
            
        }else{
        	redirect('login');
        }
		$this->load->model('kategori_model','kategori');
	}

	public function index($id=NULL)
	{
		$header['title'] = 'Kategori Kejadian - SMK Negeri 2 Bojonegoro';
		if($this->session->userdata('username'))
        {
			$this->load->view('header',$header);

		 $jml = $this->db->get('tbl_kategori');

		//pengaturan pagination
		 $config['base_url'] = base_url().'kategori/index';
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
		$data['query'] = $this->kategori->list_kategori($config['per_page'], $id);
		$data['kategori']=$this->kategori->get_all_kategori();			
		$this->load->view('pelanggaran/kategori_view',$data);
		$this->load->view('footer');
        } else{
            redirect('login', 'refresh');
        }
	
	}

	public function subkategori()
	{
		$this->load->view('header');
		$data['kategori']=$this->kategori->get_all_kategori();			
		$this->load->view('pelanggaran/subkategori_view',$data);
		$this->load->view('footer');
		
	}

	public function ajax_list()
	{
		$list = $this->kategori->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kategori) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kategori->nama_pelanggaran;
			$row[] = $kategori->deskripsi_pelanggaran;
			$row[] = $kategori->point_pelanggaran;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" data-target=".modal-subkategori" href="javascript:void()" title="Edit" onclick="edit_subkategori('."'".$kategori->id_subkategori."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_subkategori('."'".$kategori->id_subkategori."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategori->count_all(),
						"recordsFiltered" => $this->kategori->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function delete_kategori($id_kategori)
	{
		$this->kategori->delete_by_id_kategori($id_kategori);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_kategori($id_kategori)
	{
		$data = $this->kategori->get_by_id_kategori($id_kategori);
		echo json_encode($data);
	}


	public function add_kategori()
	{
		$data = array(
				'id_kategori' => $this->input->post('id_kategori'),
				'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
			);
		$insert = $this->kategori->add_kategori($data);
		redirect('kategori');
	}

	public function update_kategori()
	{
		$data = array(
				'id_kategori' => $this->input->post('id_kategori'),
				'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
			);
		$this->kategori->update_kategori(array('id_kategori' => $this->input->post('id_kategori')), $data);
		echo json_encode(array("status" => TRUE));
	}



	public function delete_subkategori($id_subkategori)
	{
		$this->kategori->delete_by_id_subkategori($id_subkategori);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_subkategori($id_subkategori)
	{
		$data = $this->kategori->get_by_id_subkategori($id_subkategori);
		echo json_encode($data);
	}


	public function add_subkategori()
	{
		$data = array(
				'id_subkategori' => $this->input->post('id_subkategori'),
				'id_kategori' => $this->input->post('id_kategori'),
				'deskripsi_pelanggaran' => $this->input->post('deskripsi_pelanggaran'),
				'point_pelanggaran' => $this->input->post('point_pelanggaran')
			);
		$insert = $this->kategori->add_subkategori($data);
		redirect('kategori');
	}

	public function update_subkategori()
	{
		$data = array(
				'id_subkategori' => $this->input->post('id_subkategori'),
				'id_kategori' => $this->input->post('id_kategori'),
				'deskripsi_pelanggaran' => $this->input->post('deskripsi_pelanggaran'),
				'point_pelanggaran' => $this->input->post('point_pelanggaran')
			);
		$this->kategori->update_subkategori(array('id_subkategori' => $this->input->post('id_subkategori')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
}