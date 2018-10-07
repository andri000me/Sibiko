<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghargaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('penghargaan_model','penghargaan');
		$this->load->library('fpdf');
	}

	public function index()
	{
		if (($this->session->userdata('role') == "admin") || ($this->session->userdata('role') == "guru" || ($this->session->userdata('role') == "super admin" ))){
		$header['title'] = 'Data Penghargaan - SMK Negeri 2 Bojonegoro';
        $this->load->helper('url');
		$data['id_guru'] = $this->penghargaan->get_guru();
		$data['kategori_penghargaan'] = $this->penghargaan->get_all_kategori_penghargaan();
		$data['siswa'] = $this->penghargaan->get_siswa();
		$this->load->view('penghargaan/penghargaan_view', $data);
		$this->load->view('footer');
		} else{
            redirect('login', 'refresh');
        }
	}

	public function ajax_list()
	{
		$list = $this->penghargaan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $penghargaan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $penghargaan->nama_siswa;
			$row[] = $penghargaan->tanggal_penghargaan;
			$row[] = $penghargaan->deskripsi_penghargaan;
			$row[] = $penghargaan->poin_penghargaan;
			$row[] = $penghargaan->nama_guru;

			//add html for action
			if ($this->session->userdata('role') == "guru") {
			$row[] = '<form class="form-inline" action="penghargaan/cetak" method="POST" target="_blank">
				  <input name="id_penghargaan" hidden type="text" value='."'".$penghargaan->id_penghargaan."'".'>
				   <input type=submit class="btn btn-sm btn-primary" value="Print">
				  </form>';
			}else{
				$row[] = '<form class="form-inline" action="penghargaan/cetak" method="POST" target="_blank">
			<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_penghargaan('."'".$penghargaan->id_penghargaan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_penghargaan('."'".$penghargaan->id_penghargaan."'".')"><i class="glyphicon glyphicon-trash"></i></a>
				  <input name="id_penghargaan" hidden type="text" value='."'".$penghargaan->id_penghargaan."'".'>
				   <input type=submit class="btn btn-sm btn-primary" value="Print">
				  </form>';
			}


			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->penghargaan->count_all(),
						"recordsFiltered" => $this->penghargaan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id_penghargaan)
	{
		$data = $this->penghargaan->get_by_id_penghargaan($id_penghargaan);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'id_penghargaan' => $this->input->post('id_penghargaan'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas_siswa'),
				'tanggal_penghargaan' => $this->input->post('tanggal_penghargaan'),
				'subkategori_penghargaan' => $this->input->post('subkategori_penghargaan'),
				'poin_penghargaan' => $this->input->post('poin_penghargaan'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$insert = $this->penghargaan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'id_penghargaan' => $this->input->post('id_penghargaan'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas_siswa'),
				'tanggal_penghargaan' => $this->input->post('tanggal_penghargaan'),
				'subkategori_penghargaan' => $this->input->post('subkategori_penghargaan'),
				'poin_penghargaan' => $this->input->post('poin_penghargaan'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$this->penghargaan->update(array('id_penghargaan' => $this->input->post('id_penghargaan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id_penghargaan)
	{
		$this->penghargaan->delete_by_id_penghargaan($id_penghargaan);
		echo json_encode(array("status" => TRUE));
	}

	public function search()
	{
		$keyword = $this->uri->segment(3);
		$data = $this->db->from('tbl_siswa')->where('char_length(kelas_siswa) <12')->like('nama_siswa',$keyword)->get();
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

	function add_ajax_sub($id,$nis){
		$url = site_url('penghargaan/getPoin/'.$nis);
		$poin = file_get_contents($url);
		$decode_poin = json_decode($poin, true);

		if (($decode_poin[0]['poin']) <= 75) {
			if ($id == 1) {
				$query = $this->db->get_where('tbl_subkategori_penghargaan',array('id_kategori_penghargaan'=>1));
				$data = "<option value=''>- Pilih Sub Penghargaan -</option>";
		    	foreach ($query->result() as $value) {
		        $data .= "<option value='".$value->id_subkategori_penghargaan."'>".$value->deskripsi_penghargaan."</option>";
		    }
			}
		}else{
			$query = $this->db->get_where('tbl_subkategori_penghargaan',array('id_kategori_penghargaan'=>$id));
			$data = "<option value=''>- Pilih Sub Penghargaan -</option>";
	    	foreach ($query->result() as $value) {
	        $data .= "<option value='".$value->id_subkategori_penghargaan."'>".$value->deskripsi_penghargaan."</option>";
	    }
		};
    echo $data;
	}
	function add_ajax_point($id)
	{
		    $query = $this->db->get_where('tbl_subkategori_penghargaan',array('id_subkategori_penghargaan'=>$id));
		    foreach ($query->result() as $value) {
		        $data = "<option value=".$value->point_penghargaan.">".$value->point_penghargaan."</option>";
		    }
		    echo $data;
		}

	public function getPoin($nis)
	{
		$this->load->model('Pelanggaran_model');
		$data = $this->Pelanggaran_model->get_poin($nis);
		echo json_encode($data);
	}

	public function laporan_filter(){
		$this->load->helper('url');
		$laporan['kelas']=$this->penghargaan->get_all_kelas();
		$this->load->view('penghargaan/laporan', $laporan);

	}

	public function laporan() {
		$this->load->helper('url');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		$data = array(
			'date1' => $date1,
			'date2' => $date2
		);
		$laporan['data'] = $this->penghargaan->select_data($data);
		$this->load->model('penghargaan');
		$this->load->view('penghargaan/laporan_view', $laporan);
	}

	public function laporan_perkelas() {
		$this->load->helper('url');
		$kelas_siswa = $this->input->post('kelas_siswa');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		$data = array(
			'kelas_siswa' => $kelas_siswa,
			'date1' => $date1,
			'date2' => $date2
		);
		$laporan['data'] = $this->penghargaan->select_data_perkelas($data);
		$this->load->model('penghargaan');
		$this->load->view('penghargaan/laporan_view', $laporan);
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
			'data' => $this->penghargaan->select_data_siswa($data),
			'data2' => $this->penghargaan->select_biodata_siswa($data),
			);

		$this->load->model('penghargaan');
		$this->load->view('penghargaan/laporan_siswa_view', $semua);
	}

	public function laporan_siswa_semua(){
		$this->load->helper('url');
		$nis = $this->input->post('nis');
		$data = array(
			'nis' => $nis,
		);
		$semua = array(
			'data' => $this->penghargaan->select_semua_data_siswa($data),
			'data2' => $this->penghargaan->select_biodata_siswa($data),
			);

		$this->load->model('penghargaan');
		$this->load->view('penghargaan/laporan_siswa_view', $semua);
	}

	public function cetak(){
		$id_penghargaan = $this->input->post('id_penghargaan');
		$data = array(
			'id_penghargaan' => $id_penghargaan,
		);
		$semua = array(
			'data' => $this->penghargaan->select_by_id($data),
			);
        $this->load->view('penghargaan/laporan_by_id_view',$semua);
	}

}
