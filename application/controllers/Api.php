<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function login(){
        $username = $this->input->post('username',true);
        $password = md5($this->input->post('password',true));
        $qwe = $this->db->query('SELECT * FROM tb_admin WHERE username = "'.$username.'" AND password = "'.$password.'"');
        if($qwe->num_rows() <= 0){
            $data[]= [
                'value' => 0,
                'status' => 'login_gagal',
            ];
		}else{
            $a = $qwe->result();
            $res['rest'] = $a;
            $data = array();
            foreach($a as $r){
                $data[] = [
                    'value' => 1,
                    'status' => 'login_berhasil',
                    'username' => $r->username,
                    'foto' => $r->foto,
                ];    
            }
        }
        echo json_encode($data);
    }

    public function mata_kuliah_pengantar(){
        $semester = $this->input->post("semester", true);
        $kelas = $this->input->post("kelas", true);
        $qwe = $this->db->query('SELECT * FROM tb_mata_kuliah_pengantar WHERE semester = "'.$semester.'" AND kelas = "'.$kelas.'"')->result();
        $api = array();
        foreach($qwe as $q){
            $api[] = [
                'kodematakuliah' => $q->kode_mata_kuliah,
                'namamatakuliah' => $q->nama_mata_kuliah,
                'dosensatu' => $q->dosen_satu,
                'hari' => $q->hari,
                'mulai' => $q->mulai,
                'selesai' => $q->selesai,
                'ruang' => $q->ruang,
            ];
        }
        echo json_encode($api);
    }

    public function absen(){
        $namamatakuliah = $this->input->post("nama_mata_kuliah", true);
        $kelas = $this->input->post("kelas", true);
        $qwe = $this->db->query('SELECT * FROM ');

    }
}
