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
        $data['hari'] = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        $data['ruang'] = ['IT-1','IT-2','IT-3','LAB. MULTIMEDIA','LAB. SI & PROGRAMMING','LAB. RPL'];
        $data['kelas'] = ['ganjil','genap','ganjil/genap'];
        $data['semester'] = ['1','2','3','4','5','6','7','8'];
        $data['pengantar'] = $this->M_kuliah->mkPengantar();
        $this->form_validation->set_rules('kode_mk', 'Kode Mata Kuliah', 'required|xss_clean|trim');
        $this->form_validation->set_rules('nama_mk', 'Nama Mata Kuliah', 'required|xss_clean|trim');
        $this->form_validation->set_rules('dosen_satu', 'Dosen 1', 'required|xss_clean|trim');
        $this->form_validation->set_rules('dosen_dua', 'Dosen 2', 'xss_clean|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|xss_clean|trim');
        $this->form_validation->set_rules('mulai', 'Jadwal Mulai', 'required|xss_clean|trim');
        $this->form_validation->set_rules('selesai', 'Jadwal Selesai', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ruang', 'Ruang', 'required|xss_clean|trim');
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

    public function edit_pengantar(){

        $data['sidebar'] = '#menu4';
        $data['hari'] = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        $data['ruang'] = ['IT-1','IT-2','IT-3','LAB. MULTIMEDIA','LAB. SI & PROGRAMMING','LAB. RPL'];
        $data['kelas'] = ['ganjil','genap','ganjil/genap'];
        $data['semester'] = ['1','2','3','4','5','6','7','8'];
        $data['pengantar'] = $this->M_kuliah->mkPengantar();
        $this->form_validation->set_rules('kode_mk1', 'Kode Mata Kuliah', 'required|xss_clean|trim');
        $this->form_validation->set_rules('nama_mk1', 'Nama Mata Kuliah', 'required|xss_clean|trim');
        $this->form_validation->set_rules('dosen_satu1', 'Dosen 1', 'required|xss_clean|trim');
        $this->form_validation->set_rules('dosen_dua1', 'Dosen 2', 'xss_clean|trim');
        $this->form_validation->set_rules('hari1', 'Hari', 'required|xss_clean|trim');
        $this->form_validation->set_rules('mulai1', 'Jadwal Mulai', 'required|xss_clean|trim');
        $this->form_validation->set_rules('selesai1', 'Jadwal Selesai', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ruang1', 'Ruang', 'required|xss_clean|trim');
        $this->form_validation->set_rules('kelas1', 'Kelas', 'required|xss_clean|trim');
        $this->form_validation->set_rules('semester1', 'Semester', 'required|xss_clean|trim');
        if($this->form_validation->run()==FALSE){
            $this->load->view('template/header');
            $this->load->view('pages/kuliah_pengantar',$data);
            $this->load->view('template/footer',$data);
        }else{
            $this->M_kuliah->editMkPengantar();
            $this->session->set_flashdata('mk_pengantar', 'Diupdate');
            redirect('pengantar');
        }

    } 

    public function hapus_pengantar(){
        $this->M_kuliah->hapusMkPengantar();
        $this->session->set_flashdata('mk_pengantar', 'Dihapus');
        redirect('pengantar');
    }
}