<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_alumni extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (($this->session->userdata('role') != "admin") || $this->session->userdata('role') != "super admin") {
            
        }else{
        	redirect('login');
        }
		$this->load->model('siswa_alumni_model','siswa');
		$this->load->library('fpdf');
	}

	public function index()
	{
		$header['title'] = 'Data Siswa - SMK Negeri 2 Bojonegoro';
		if (($this->session->userdata('role') == "admin") || ($this->session->userdata('role') == "guru" || ($this->session->userdata('role') == "super admin" ))){
            $this->load->helper('url');
			$this->load->view('header',$header);
			$data['kelas_siswa']=$this->siswa->get_all_kelas();
			$data['datasiswa'] = $this->siswa->get_siswa();
			$this->load->view('siswa/siswa_alumni_view', $data);
			$this->load->view('footer');
        } else{
            redirect('login', 'refresh');
        }
        
	}

	public function ajax_list()
	{
		$list = $this->siswa->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $siswa) {
			$no++;
			$row = array();
			$row[] = $siswa->nis;
			$row[] = $siswa->nama_siswa;
			$row[] = $siswa->alamat_siswa;
			$row[] = $siswa->jurusan_siswa;
			$row[] = $siswa->tahun_angkatan_siswa;

			//add html for action
			$row[] = '<form class="form-inline" action="siswa/profil" method="POST" target="_blank">
				<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_siswa('."'".$siswa->nis."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_siswa('."'".$siswa->nis."'".')"><i class="glyphicon glyphicon-trash"></i></a>
				   <input name="nis" hidden type="text" value='."'".$siswa->nis."'".'>
				   <input type=submit class="btn btn-sm btn-primary" value="Print">
				  </form>';

		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->siswa->count_all(),
						"recordsFiltered" => $this->siswa->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($nis)
	{
		$data = $this->siswa->get_by_nis($nis);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		
		$data = array(
				'nis' => $this->input->post('nis'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'alamat_siswa' => $this->input->post('alamat_siswa'),
				'jurusan_siswa' => $this->input->post('jurusan_siswa'),
				'tempat_lahir_siswa' => $this->input->post('tempat_lahir_siswa'),
				'tanggal_lahir_siswa' => $this->input->post('tanggal_lahir_siswa'),
				'jenis_kelamin_siswa' => $this->input->post('jenis_kelamin_siswa'),
				'agama_siswa' => $this->input->post('agama_siswa'),
				'asal_sekolah_siswa' => $this->input->post('asal_sekolah_siswa'),
				'tahun_angkatan_siswa' => $this->input->post('tahun_angkatan_siswa'),
				'nama_ayah_siswa' => $this->input->post('nama_ayah_siswa'),
				'pekerjaan_ayah_siswa' => $this->input->post('pekerjaan_ayah_siswa'),
				'nama_ibu_siswa' => $this->input->post('nama_ibu_siswa'),
				'pekerjaan_ibu_siswa' => $this->input->post('pekerjaan_ibu_siswa'),
				'no_telepon_ortu' => $this->input->post('no_telepon_ortu'),
				'kelas_siswa' => $this->input->post('kelas_siswa'),
			);
		$insert = $this->siswa->save($data);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_update()
	{

		$data = array(
				'nis' => $this->input->post('nis'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'alamat_siswa' => $this->input->post('alamat_siswa'),
				'jurusan_siswa' => $this->input->post('jurusan_siswa'),
				'tempat_lahir_siswa' => $this->input->post('tempat_lahir_siswa'),
				'tanggal_lahir_siswa' => $this->input->post('tanggal_lahir_siswa'),
				'jenis_kelamin_siswa' => $this->input->post('jenis_kelamin_siswa'),
				'agama_siswa' => $this->input->post('agama_siswa'),
				'asal_sekolah_siswa' => $this->input->post('asal_sekolah_siswa'),
				'tahun_angkatan_siswa' => $this->input->post('tahun_angkatan_siswa'),
				'nama_ayah_siswa' => $this->input->post('nama_ayah_siswa'),
				'pekerjaan_ayah_siswa' => $this->input->post('pekerjaan_ayah_siswa'),
				'nama_ibu_siswa' => $this->input->post('nama_ibu_siswa'),
				'pekerjaan_ibu_siswa' => $this->input->post('pekerjaan_ibu_siswa'),
				'no_telepon_ortu' => $this->input->post('no_telepon_ortu'),
				'kelas_siswa' => $this->input->post('kelas_siswa'),

			);

		
		$this->siswa->update(array('nis' => $this->input->post('nis')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($nis)
	{
		$this->siswa->delete_by_nis($nis);
		echo json_encode(array("status" => TRUE));
	}

	public function profil(){
        
		$nis = $this->input->post('nis');
		$input = array(
			'nis' => $nis,
		);
		$semua = array(
			'data' => $this->siswa->select_data($input),
			);
        $this->load->view('siswa/siswa_profil',$semua);
	}


}
