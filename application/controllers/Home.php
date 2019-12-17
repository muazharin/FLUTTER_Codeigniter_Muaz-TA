<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') !== TRUE){
            redirect('login');
		}
		$this->load->model('M_home');
	}

	public function index()
	{
		$data['sidebar'] = '#menu1';
		$data['jml_dosen'] = $this->db->count_all_results('tb_dosen');
		$data['jml_mhs'] = $this->db->count_all_results('tb_mhs');
		$data['jml_list'] = $this->db->count_all_results('tb_list_mk');
		$data['jml_admin'] = $this->db->count_all_results('tb_admin');
		// $data['user'] = $this->M_home->getDataAdmin();
		$this->form_validation->set_rules('pass','Password Baru','required|xss_clean');
		$this->form_validation->set_rules('pass1','Konfirmasi Password','required|xss_clean|matches[pass]');
		if($this->form_validation->run()==FALSE){
			$this->load->view('template/header',$data);
			$this->load->view('home');
			$this->load->view('template/footer',$data);
		}else{
			$this->M_home->ubahPassword();
			$this->session->set_flashdata('user', 'Diubah');
			redirect('home');
		}
	}
}
