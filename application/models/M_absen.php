<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Absen extends CI_Model {

    public function getAllDataAbsen(){
        // $query = $this->db->query("SELECT * FROM tb_absen WHERE nama_mata_kuliah = 'PEMROGRAMAN WEB' AND kelas = 'RPL'");
        // return $query->result_array();
        $this->db->where('nama_mata_kuliah', 'PEMROGRAMAN WEB');
        $this->db->where('kelas', 'RPL');
        return $this->db->get('tb_absen')->result_array();
    }
    
    public function getAllDataAbsenBy(){
        $matkul = $this->input->post('matkul',true);
        $kelas = $this->input->post('kelas',true);
        $query = $this->db->query("SELECT * FROM tb_absen WHERE nama_mata_kuliah = '".$matkul."' AND kelas = '".$kelas."'");
        return $query->result_array();
    }

    public function getMatKul(){
        $query = $this->db->query("SELECT * FROM tb_list_mk ");
        return $query->result_array();
    }

    public function getDataAbsen(){
        $mk =  $this->uri->segment(3);
        $kls =  $this->uri->segment(4);
        $this->db->where('nama_mata_kuliah',$mk);
        $this->db->where('kelas',$kls);
        return $this->db->get('tb_absen')->result_array();
    }
}
