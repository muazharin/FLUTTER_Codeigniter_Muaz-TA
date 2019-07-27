<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('M_login');
    }

    public function index(){

        $this->form_validation->set_rules('username','Username','required|trim|xss_clean');
        $this->form_validation->set_rules('pass','Password','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->load->view('pages/login');
            // echo "gagal wle!";
		}else{
            $valid = $this->M_login->usercheck();
            if($valid->num_rows() > 0){
                $data = $valid->row_array();
                $id = $data['id_admin'];
                $user = $data['username'];
                $sesdata = [
                    'id_admin' => $id,
                    'username' => $user,
                    'logged_in_admin' => true
                ];
                $this->session->set_userdata($sesdata);
                redirect('home');
            }else{
                echo "gagal wle!";
                // $this->session->set_flashdata('msg','Username or Password is Wrong');
                redirect('login');
            }
		}
    }
    
    public function logout(){
        $this->session->unset_userdata('username');
		session_destroy();
		redirect('login');
    }
}
