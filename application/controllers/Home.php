<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') !== TRUE){
            redirect('login');
		}
		// $this->load->model('M_home');
	}

	public function index()
	{
		$data['sidebar'] = '#menu1';
		$this->load->view('template/header');
		$this->load->view('home');
		$this->load->view('template/footer',$data);
	}
}
