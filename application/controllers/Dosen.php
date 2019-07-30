<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		// $this->load->model('M_mahasiswa');
    }

    public function index()
	{
    
        $data['sidebar'] = '#menu3';
        $this->load->view('template/header');
        $this->load->view('pages/dosen',$data);
        $this->load->view('template/footer',$data);
	} 
}