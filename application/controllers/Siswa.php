<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('siswa_model','siswa');
		$this->load->library('fpdf');
	}

	public function index()
	{
		if (($this->session->userdata('role') == "admin") || ($this->session->userdata('role') == "super admin")){
		    $header['title'] = 'Data Siswa - SMK Negeri 2 Bojonegoro';
            $this->load->helper('url');
			$this->load->view('header',$header);
			$data['kelas_siswa']=$this->siswa->get_all_kelas();
			$data['datasiswa'] = $this->siswa->get_siswa();
			
			$this->load->view('siswa/siswa_view', $data);
			$this->load->view('footer');
		} 
	}


	public function data()
	{
		if($this->session->userdata('nis'))
        {
        $this->load->model('wali_model','wali');
		$header['title'] = 'Data Siswa Siswa - SMK Negeri 2 Bojonegoro';
        $nis = $this->session->userdata('nis');
		$data = array(
			'nis' => $nis,
		);
		$semua = array(
			'dataSiswa' => $this->wali->select_biodata_siswa($data),
			'dataBimbingan' => $this->wali->select_bimbingan_siswa($data),
			'dataPelanggaran' => $this->wali->select_pelanggaran_siswa($data),
			'dataPenghargaan' => $this->wali->select_penghargaan_siswa($data),
		);
		
			$this->load->helper('url');
			$this->load->view('header',$header);
			$this->load->view('siswa/siswa_data_view',$semua);
			$this->load->view('footer');
			}else{
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
				'status' => $this->input->post('status'),
			);
		$insert = $this->siswa->save($data);
		echo json_encode(array("status" => TRUE));
	}

	 function importcsv() {
	 	$this->load->library('csvimport');
        $data['datasiswa'] = $this->siswa->get_siswa();
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
                        'nis'=>$row['nis'],
                        'nama_siswa'=>$row['nama_siswa'],
                        'alamat_siswa'=>$row['alamat_siswa'],
                        'jurusan_siswa'=>$row['jurusan_siswa'],
                        'tempat_lahir_siswa'=>$row['tempat_lahir_siswa'],
                        'tanggal_lahir_siswa'=>$row['tanggal_lahir_siswa'],
                        'jenis_kelamin_siswa'=>$row['jenis_kelamin_siswa'],
                        'agama_siswa'=>$row['agama_siswa'],
                        'asal_sekolah_siswa'=>$row['asal_sekolah_siswa'],
                        'tahun_angkatan_siswa'=>$row['tahun_angkatan_siswa'],
                        'nama_ayah_siswa'=>$row['nama_ayah_siswa'],
                        'pekerjaan_ayah_siswa'=>$row['pekerjaan_ayah_siswa'],
                        'nama_ibu_siswa'=>$row['nama_ibu_siswa'],
                        'pekerjaan_ibu_siswa'=>$row['pekerjaan_ibu_siswa'],
                        'no_telepon_ortu'=>$row['no_telepon_ortu'],
                        'kelas_siswa'=>$row['kelas_siswa'],
                    );
                    $this->siswa->insert_csv($insert_data);
                }
                 $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url().'siswa');
            } else 
                $this->session->set_flashdata('failed', 'Format data salah, pastikan nama kelas dan data siswa benar !');
                $this->load->view('siswa_view', $data);
            }
 
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


	function do_upload(){
		$this->load->library('upload');
        $nmfile = "foto_".time();
        $config['upload_path'] = 'assets/foto/'; 
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '2048';
        $config['max_width']  = '2000';
        $config['max_height']  = '1400';
        $config['file_name'] = $this->input->post('nis');
 		
 		$this->upload->do_upload('foto_siswa');
        $this->upload->initialize($config);
        $this->upload->overwrite = true;
        
		if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('siswa/form_upload', $error);
		}
		else{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('sukses', $data);
		}
	}

}
