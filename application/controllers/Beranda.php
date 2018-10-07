<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username') == "") {
            redirect('login');
        }
		$this->load->model('beranda_model','beranda');
        $this->load->helper('text');
	}

	public function index($id=NULL)
	{
        $data = array(
        		'jumlah_siswa' => $this->beranda->jumlah_siswa(),
        		'jumlah_bimbingan' => $this->beranda->jumlah_bimbingan(),
        		'jumlah_kejadian' => $this->beranda->jumlah_kejadian(),
        		'jumlah_penghargaan' => $this->beranda->jumlah_penghargaan(),
        		);
        	$header['title'] = 'Beranda - SMK Negeri 2 Bojonegoro';

        $jml = $this->db->get('tbl_kategori');

		//pengaturan pagination
		 $config['base_url'] = base_url().'beranda/index';
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
		$data['query'] = $this->beranda->list_pelanggaran($config['per_page'], $id);
		$data['kejadian']=$this->beranda->get_point_kejadian();	
		$data['penghargaan']=$this->beranda->get_point_penghargaan();

        $this->load->view('header', $header);
		$this->load->view('beranda_view', $data);
		$this->load->view('footer');
	}
		
}