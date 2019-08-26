<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuliah extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		// $this->load->model('M_dosen');
    }

    public function pengantar(){

        $data['sidebar'] = '#menu4';
        $data['sidebar1'] = '#menu4-1';
        $this->load->view('template/header');
        $this->load->view('pages/kuliah_pengantar',$data);
        $this->load->view('template/footer',$data);

    } 
    
    public function peminatan(){

        $data['sidebar'] = '#menu4';
        $data['sidebar1'] = '#menu4-2';
        $this->load->view('template/header');
        $this->load->view('pages/kuliah_peminatan',$data);
        $this->load->view('template/footer',$data);

    } 
}