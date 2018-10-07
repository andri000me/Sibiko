<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		 
		$this->load->model('bimbingan_model','bimbingan');
		$this->load->library('fpdf');
	}

	public function index()
	{
		if (($this->session->userdata('role') == "admin") || ($this->session->userdata('role') == "guru" || ($this->session->userdata('role') == "super admin"))){
			$header['title'] = 'Data Bimbingan - SMK Negeri 2 Bojonegoro';
			$this->load->helper('url');
			$this->load->view('header',$header);
			$this->load->view('bimbingan/bimbingan_view');
			$this->load->view('footer');
		}else{
			redirect('login');
		}
	}

	public function ajax_list()
	{
		$list = $this->bimbingan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $bimbingan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $bimbingan->nis;
			$row[] = $bimbingan->nama_siswa;
			$row[] = $bimbingan->kelas;
			$row[] = $bimbingan->tanggal_bimbingan;
			$row[] = $bimbingan->masalah_siswa;

			//add html for action
			if ($this->session->userdata('role') == "guru") {
            	$row[] = '<form class="form-inline" action="bimbingan/cetak" method="POST" target="_blank">
				  <input name="id_bimbingan" hidden type="text" value='."'".$bimbingan->id_bimbingan."'".'>
				   <input type=submit class="btn btn-sm btn-primary" value="Print">
				  </form>';
        	}else{
        		$row[] = '<form class="form-inline" action="bimbingan/cetak" method="POST" target="_blank">
					  <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_bimbingan('."'".$bimbingan->id_bimbingan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_bimbingan('."'".$bimbingan->id_bimbingan."'".')"><i class="glyphicon glyphicon-trash"></i></a>
				  <input name="id_bimbingan" hidden type="text" value='."'".$bimbingan->id_bimbingan."'".'>
				   <input type=submit class="btn btn-sm btn-primary" value="Print">
				  </form>';
        	}
			
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->bimbingan->count_all(),
						"recordsFiltered" => $this->bimbingan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id_bimbingan)
	{
		$data = $this->bimbingan->get_by_id_bimbingan($id_bimbingan);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'id_bimbingan' => $this->input->post('id_bimbingan'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'tanggal_bimbingan' => $this->input->post('tanggal_bimbingan'),
				'masalah_siswa' => $this->input->post('masalah_siswa'),
				'solusi_bimbingan' => $this->input->post('solusi_bimbingan'),
				'keterangan' => $this->input->post('keterangan'),
			);
		$insert = $this->bimbingan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'id_bimbingan' => $this->input->post('id_bimbingan'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'tanggal_bimbingan' => $this->input->post('tanggal_bimbingan'),
				'masalah_siswa' => $this->input->post('masalah_siswa'),
				'solusi_bimbingan' => $this->input->post('solusi_bimbingan'),
				'keterangan' => $this->input->post('keterangan'),
			);
		$this->bimbingan->update(array('id_bimbingan' => $this->input->post('id_bimbingan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id_bimbingan)
	{
		$this->bimbingan->delete_by_id_bimbingan($id_bimbingan);
		echo json_encode(array("status" => TRUE));
	}

	public function search()
	{
		$keyword = $this->uri->segment(3);
		$new_keyword = urldecode($keyword);
		$data = $this->db->from('tbl_siswa')->where('char_length(kelas_siswa) <12')->like('nama_siswa', $new_keyword)->get();	
		foreach($data->result() as $row)
		{
			$arr['query'] = $new_keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->nama_siswa.' | '.$row->kelas_siswa,
				'nis'	=>$row->nis,
				'kelas_siswa'	=>$row->kelas_siswa

			);
		}
		echo json_encode($arr);
	}

	public function laporan_filter(){
		$this->load->helper('url');
		$this->load->view('bimbingan/laporan');

	}

	public function laporan() {
		$this->load->helper('url');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		$data = array(
			'date1' => $date1,
			'date2' => $date2
		);
		$laporan['data'] = $this->bimbingan->select_data($data);
		$this->load->model('bimbingan');
		$this->load->view('bimbingan/laporan_view', $laporan);
	}

	public function laporan_siswa(){
		$this->load->helper('url');
		$nis = $this->input->post('nis');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		$data = array(
			'nis' => $nis,
			'date1' => $date1,
			'date2' => $date2
		);
		$semua = array(
			'data' => $this->bimbingan->select_data_siswa($data),
			'data2' => $this->bimbingan->select_biodata_siswa($data),
			);
		
		$this->load->model('bimbingan');
		$this->load->view('bimbingan/laporan_siswa_view', $semua);
	}

	public function laporan_siswa_semua(){
		$this->load->helper('url');
		$nis = $this->input->post('nis');
		$data = array(
			'nis' => $nis,
		);
		$semua = array(
			'data' => $this->bimbingan->select_semua_data_siswa($data),
			'data2' => $this->bimbingan->select_biodata_siswa($data),
			);
		
		$this->load->model('bimbingan');
		$this->load->view('bimbingan/laporan_siswa_view', $semua);
	}

	public function cetak(){
		$id_bimbingan = $this->input->post('id_bimbingan');
		$data = array(
			'id_bimbingan' => $id_bimbingan,
		);
		$semua = array(
			'data' => $this->bimbingan->select_by_id($data),
			);
        $this->load->view('bimbingan/laporan_perbimbingan_view',$semua);
	}

}
