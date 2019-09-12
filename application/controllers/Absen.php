<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		// $this->load->model('M_dosen');
    }

    public function index(){
        $data['sidebar'] = '#menu5';
        $data['sidebar1'] = '';
        $this->load->view('template/header');
        $this->load->view('pages/absen');
        $this->load->view('template/footer',$data);
    }
}