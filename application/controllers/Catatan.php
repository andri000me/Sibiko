<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('catatan_model','catatan');
	}

	public function index()
	{
		if (($this->session->userdata('role') == "admin") || ($this->session->userdata('role') == "guru" || ($this->session->userdata('role') == "super admin" ))){
		$header['title'] = 'Data Catatan - SMK Negeri 2 Bojonegoro';
		$this->load->helper('url');
		$this->load->view('header',$header);
		$this->load->view('catatan_view');
		$this->load->view('footer');
		}else{
			redirect('login');
		}
	}

	public function ajax_list()
	{
		$list = $this->catatan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $catatan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $catatan->nama_siswa;
			$row[] = $catatan->kelas;
			$row[] = $catatan->tanggal;
			$row[] = $catatan->keterangan;

			//add html for action
			if ($this->session->userdata('role') == "guru") {
				$row[] = '';
			}else{
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_catatan('."'".$catatan->id_catatan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_catatan('."'".$catatan->id_catatan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			}
			
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->catatan->count_all(),
						"recordsFiltered" => $this->catatan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id_catatan)
	{
		$data = $this->catatan->get_by_id_catatan($id_catatan);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'tanggal' => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
			);
		$insert = $this->catatan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'tanggal' => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
			);
		$this->catatan->update(array('id_catatan' => $this->input->post('id_catatan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id_catatan)
	{
		$this->catatan->delete_by_id_catatan($id_catatan);
		echo json_encode(array("status" => TRUE));
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

	public function laporan_filter(){
		$this->load->helper('url');
		$this->load->view('cetak_catatan');
	}

	public function laporan() {
		$this->load->helper('url');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		$data = array(
			'date1' => $date1,
			'date2' => $date2
		);
		$laporan['data'] = $this->catatan->select_data($data);
		$this->load->model('catatan');
		$this->load->view('laporan_catatan', $laporan);
	}
}
