<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		$this->load->model('M_dosen');
    }

    public function index()
	{
        $data['dosen'] = $this->M_dosen->getAllDosen();
        $data['minat']=['Rekayasa Perangkat Lunak', 'Jaringan', 'Komputasi Cerdas dan Visualisasi'];
        $this->form_validation->set_rules('nip','NIP','numeric|max_length[18]|trim|xss_clean');
		$this->form_validation->set_rules('nama','Nama','required|trim|xss_clean');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean');
		$this->form_validation->set_rules('minat_ajar','Minat Ajar','required|trim|xss_clean');
		$this->form_validation->set_rules('keterangan','Keterangan','trim|xss_clean');
		if($this->form_validation->run()==FALSE){
			$data['sidebar'] = '#menu3';
            $this->load->view('template/header');
            $this->load->view('pages/dosen',$data);
            $this->load->view('template/footer',$data);
		}else{
			$this->M_dosen->tambah();
			$this->session->set_flashdata('dosen', 'Ditambahkan');
            redirect('dosen');
            // echo 'ok';
		}
        
    } 

    public function edit()
	{
        $data['dosen'] = $this->M_dosen->getAllDosen();
        $data['minat']=['Rekayasa Perangkat Lunak', 'Jaringan', 'Komputasi Cerdas dan Visualisasi'];
        $this->form_validation->set_rules('nip1','NIP','numeric|max_length[18]|trim|xss_clean');
		$this->form_validation->set_rules('nama1','Nama','required|trim|xss_clean');
		$this->form_validation->set_rules('email1','Email','required|valid_email|trim|xss_clean');
		$this->form_validation->set_rules('minat_ajar1','Minat Ajar','required|trim|xss_clean');
		$this->form_validation->set_rules('keterangan1','Keterangan','trim|xss_clean');
		if($this->form_validation->run()==FALSE){
			$data['sidebar'] = '#menu3';
            $this->load->view('template/header');
            $this->load->view('pages/dosen',$data);
            $this->load->view('template/footer',$data);
		}else{
			$this->M_dosen->edit();
			$this->session->set_flashdata('dosen', 'Ditambahkan');
            redirect('dosen');
            // echo 'ok';
		}
        
    } 
    
    public function hapus($id=null, $foto=null){
		$this->M_dosen->hapus($id, $foto);
		$this->session->set_flashdata('dosen', 'Dihapus');
		redirect('dosen');
	}
}