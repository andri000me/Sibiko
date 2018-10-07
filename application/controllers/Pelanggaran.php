<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('pelanggaran_model','pelanggaran');
		$this->load->library('fpdf');
		$this->load->library('session');
	}

	public function index()
	{
		if (($this->session->userdata('role') == "admin") || ($this->session->userdata('role') == "guru" || ($this->session->userdata('role') == "super admin" ))){
		$header['title'] = 'Data Kejadian - SMK Negeri 2 Bojonegoro';
            $this->load->view('header',$header);
			$data['kategori']=$this->pelanggaran->get_all_kategori();
			$data['id_guru'] = $this->pelanggaran->get_guru();
			$this->load->view('pelanggaran/pelanggaran_view', $data);
			$this->load->view('footer');
        } else{
            redirect('login', 'refresh');
        }

	}

	public function ajax_list()
	{
		$list = $this->pelanggaran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pelanggaran) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pelanggaran->nis;
			$row[] = $pelanggaran->nama_siswa;
			$row[] = $pelanggaran->kelas;
			$row[] = $pelanggaran->tanggal_pelanggaran;
			$row[] = $pelanggaran->deskripsi_pelanggaran;
			$row[] = $pelanggaran->point_pelanggaran;

			//add html for action
			if ($this->session->userdata('role') == "guru") {
				$row[] = '<form class="form-inline" action="pelanggaran/cetak" method="POST" target="_blank">
				  <input name="id_pelanggaran" hidden type="text" value='."'".$pelanggaran->id_pelanggaran."'".'>
				   <input type=submit class="btn btn-sm btn-primary" value="Print">
				  </form>';
			}else{
			$row[] = '<form class="form-inline" action="pelanggaran/cetak" method="POST" target="_blank">
			<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_pelanggaran('."'".$pelanggaran->id_pelanggaran."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_pelanggaran('."'".$pelanggaran->id_pelanggaran."'".')"><i class="glyphicon glyphicon-trash"></i></a>
				  <input name="id_pelanggaran" hidden type="text" value='."'".$pelanggaran->id_pelanggaran."'".'>
				   <input type=submit class="btn btn-sm btn-primary" value="Print">
				  </form>';
			}


			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pelanggaran->count_all(),
						"recordsFiltered" => $this->pelanggaran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id_pelanggaran)
	{
		$data = $this->pelanggaran->get_by_id_pelanggaran($id_pelanggaran);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'id_pelanggaran' => $this->input->post('id_pelanggaran'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'tanggal_pelanggaran' => $this->input->post('tanggal_pelanggaran'),
				'subkategori' => $this->input->post('subkategori'),
				'point_pelanggaran' => $this->input->post('point_pelanggaran'),
				'tindak_lanjut' => $this->input->post('tindak_lanjut'),
				'keterangan' => $this->input->post('keterangan'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$insert = $this->pelanggaran->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'id_pelanggaran' => $this->input->post('id_pelanggaran'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'tanggal_pelanggaran' => $this->input->post('tanggal_pelanggaran'),
				'subkategori' => $this->input->post('subkategori'),
				'point_pelanggaran' => $this->input->post('point_pelanggaran'),
				'tindak_lanjut' => $this->input->post('tindak_lanjut'),
				'keterangan' => $this->input->post('keterangan'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$this->pelanggaran->update(array('id_pelanggaran' => $this->input->post('id_pelanggaran')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id_pelanggaran)
	{
		$this->pelanggaran->delete_by_id_pelanggaran($id_pelanggaran);
		echo json_encode(array("status" => TRUE));
	}

	function add_ajax_sub($id){
		    $query = $this->db->get_where('tbl_subkategori',array('id_kategori'=>$id));
		    $data = "<option value=''>- Pilih Sub Pelanggaran -</option>";
		    foreach ($query->result() as $value) {
		        $data .= "<option value='".$value->id_subkategori."'>".$value->deskripsi_pelanggaran."</option>";
		    }
		    echo $data;
		}
	function add_ajax_point($id){
		    $query = $this->db->get_where('tbl_subkategori',array('id_subkategori'=>$id));
		    foreach ($query->result() as $value) {
		        $data = "<option value=".$value->point_pelanggaran.">".$value->point_pelanggaran."</option>";
		    }
		    echo $data;
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

	public function laporan_filter(){
		$this->load->helper('url');
		$laporan['kelas']=$this->pelanggaran->get_all_kelas();
		$this->load->view('pelanggaran/laporan',$laporan);
	}

	public function laporan() {
		$this->load->helper('url');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		$data = array(
			'date1' => $date1,
			'date2' => $date2
		);
		$laporan['data'] = $this->pelanggaran->select_data($data);
		$this->load->model('pelanggaran');
		$this->load->view('pelanggaran/laporan_view', $laporan);
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

		$laporan['data'] = $this->pelanggaran->select_data_perkelas($data);
		$this->load->model('pelanggaran');
		$this->load->view('pelanggaran/laporan_view', $laporan);
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
			'data' => $this->pelanggaran->select_data_siswa($data),
			'data2' => $this->pelanggaran->select_biodata_siswa($data),
			'data3' => $this->pelanggaran->minus_pelanggaran($data),
			);

		$this->load->model('pelanggaran');
		$this->load->view('pelanggaran/laporan_siswa_view', $semua);
	}

	public function laporan_siswa_semua(){
		$this->load->helper('url');
		$nis = $this->input->post('nis');
		$data = array(
			'nis' => $nis,
		);
		$semua = array(
			'data' => $this->pelanggaran->select_semua_data_siswa($data),
			'data2' => $this->pelanggaran->select_biodata_siswa($data),
			);

		$this->load->model('pelanggaran');
		$this->load->view('pelanggaran/laporan_siswa_view', $semua);
	}

	public function laporan_point(){
		$this->load->helper('url');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		$data = array(
			'date1' => $date1,
			'date2' => $date2
		);
		$laporan['data'] = $this->pelanggaran->get_point_kejadian($data);
		$this->load->model('pelanggaran');
		$this->load->view('pelanggaran/laporan_point_view', $laporan);
	}

	public function cetak(){
		$id_pelanggaran = $this->input->post('id_pelanggaran');
		$data = array(
			'id_pelanggaran' => $id_pelanggaran
		);
		$semua = array(
			'data' => $this->pelanggaran->select_by_id($data),
			);
        $this->load->view('pelanggaran/laporan_by_id_view',$semua);
	}
}
