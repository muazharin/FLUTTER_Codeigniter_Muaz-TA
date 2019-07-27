<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		$this->load->model('M_mahasiswa');
	}

	public function index()
	{
		$data['mahasiswa'] = $this->M_mahasiswa->getAllMhs();
		$this->form_validation->set_rules('nim','NIM','required|trim|xss_clean|max_length[9]');
		$this->form_validation->set_rules('nama','Nama','required|trim|xss_clean');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required|trim|xss_clean');
		$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required|trim|xss_clean');
		// $this->form_validation->set_rules('foto','Foto','required|trim|xss_clean');
		if($this->form_validation->run()==FALSE){
			$data['sidebar'] = '#menu2';
			$this->load->view('template/header');
			$this->load->view('pages/mahasiswa',$data);
			$this->load->view('template/footer',$data);
		}else{
			$this->M_mahasiswa->tambah();
			$this->session->set_flashdata('mahasiswa', 'Ditambahkan');
			redirect('mahasiswa');
		}
		
	}

	public function hapus($id=null, $foto=null, $qrcode=null){
		$this->M_mahasiswa->hapus($id, $foto, $qrcode);
		$this->session->set_flashdata('mahasiswa', 'Dihapus');
		redirect('mahasiswa');
	}
}
