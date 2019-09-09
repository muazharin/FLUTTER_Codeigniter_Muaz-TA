<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuliah extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		$this->load->model('M_kuliah');
    }

    public function pengantar(){

        $data['sidebar'] = '#menu4';
        $data['sidebar1'] = '#menu4-1';
        $data['kelas'] = ['genap','ganjil'];
        $data['semester'] = ['1','2','3','4'];
        $data['pengantar'] = $this->M_kuliah->mkPengantar();
        $this->form_validation->set_rules('kode_mk', 'Kode Mata Kuliah', 'required|xss_clean|trim');
        $this->form_validation->set_rules('nama_mk', 'Nama Mata Kuliah', 'required|xss_clean|trim');
        $this->form_validation->set_rules('dosen_satu', 'Dosen 1', 'required|xss_clean|trim');
        $this->form_validation->set_rules('dosen_dua', 'Dosen 2', 'required|xss_clean|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|xss_clean|trim');
        if($this->form_validation->run()==FALSE){
            $this->load->view('template/header');
            $this->load->view('pages/kuliah_pengantar',$data);
            $this->load->view('template/footer',$data);
        }else{
            $this->M_kuliah->tambahMkPengantar();
            $this->session->set_flashdata('mk_pengantar', 'Ditambahkan');
            redirect('pengantar');
        }

    } 
    
    public function peminatan(){

        $data['sidebar'] = '#menu4';
        $data['sidebar1'] = '#menu4-2';
        $this->load->view('template/header');
        $this->load->view('pages/kuliah_peminatan',$data);
        $this->load->view('template/footer',$data);

    } 
}