<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->input->post('logged_in_admin') != TRUE){
            echo "salah";
		}
		// $this->load->model('M_absen');
    }

    public function index(){
        // $api = $this->db->get('tb_mhs')->result();
        if($this->input->post('logged_in_admin') != TRUE){
            echo "salah";
		}else{
            $api = $this->db->query('SELECT nim, nama FROM tb_mhs')->result();
        }
        
        echo json_encode($api);
    }

    public function mata_kuliah_pengantar(){
        $semester = $this->input->post('semester', true);
        if($this->input->post('logged_in_admin') != TRUE){
            echo "salah";
		}else{
            $api = $this->db->query('SELECT * FROM tb_mata_kuliah_pengantar WHERE semester = "'.$semester.'"')->result();
        }
        echo json_encode($api);
    }
}
