<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		$this->load->model('M_absen');
    }

    public function index(){
        // $this->load->library('pagination');
        // $config['base_url'] = 'http://localhost/muaz_ta/absen/index';
        // $config['total_rows'] = $this->M_absen->countAll();
        // $config['per_page'] = 10;

        $data['sidebar'] = '#menu5';
        $data['sidebar1'] = '';
        $data['judul_matkul'] = 'PEMROGRAMAN WEB';
        $data['judul_kelas'] = 'RPL';
        $data['matkul'] = $this->M_absen->getMatKul();
        $data['kelas'] = ['ganjil','genap','ganjil/genap','RPL','KCV','KBJ'];
        $data['absen'] = $this->M_absen->getAllDataAbsen();
        if($this->input->post('matkul') && $this->input->post('kelas')){
            $data['judul_matkul'] = $this->input->post('matkul');
            $data['judul_kelas'] = $this->input->post('kelas');
            $data['absen'] = $this->M_absen->getAllDataAbsenBy();
        }
        $this->load->view('template/header');
        $this->load->view('pages/absen',$data);
        $this->load->view('template/footer',$data);
    }
}