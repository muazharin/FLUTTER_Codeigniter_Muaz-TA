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

    public function updateabsenpengantar(){
        $this->load->library('kripto');
        $barcode = $this->input->post("barcode",true);
        $hasilbase = base64_decode($barcode);
        $len = strlen($hasilbase);
        $key = substr($hasilbase,'0','5');
        $str = substr($hasilbase,'5',$len);
        $data = $this->kripto->rc4($key, $str);
        $qwe = $this->db->query('SELECT * FROM tb_mhs WHERE kode_unik = "'.$data.'"')->result();
        $api = array();
        foreach($qwe as $q){
            $api=[
                'nim' => $q->nim,
                'nama' => $q->nama,
                'foto' => $q->foto,
            ];
        }
        echo json_encode($api);
    }

    public function absenmi(){
        $nim = $this->input->post('nim',true);
        $nama = $this->input->post('nama',true);
        $ket = $this->input->post('ab', true);
        $per = $this->input->post('per', true);
        $mk = $this->input->post('mk', true);
        $kls = $this->input->post('kls', true);
        $tanggal = date("Y-m-d H:i:s");
        $api =[];
        $cek = $this->db->query('SELECT * FROM tb_absen WHERE nim = "'.$nim.'" AND nama_mata_kuliah = "'.$mk.'" AND kelas = "'.$kls.'"');
        if($cek->num_rows()<=0){
            $api = [
                'pesan' => 'The student is does not exist! Please add first'
            ];
            echo json_encode($api);
        }else{
            $qwe = $this->db->query('UPDATE tb_absen SET per_'.$per.' = "'.$ab.'", tgl_'.$per.' = "'.$tanggal.'" WHERE nim = "'.$nim.'" AND nama_mata_kuliah="'.$mk.'" AND kelas = "'.$kls.'"');
            $qwe2 = $this->db->query('UPDATE tb_persentase SET nim = "'.$nim.'", nama_mata_kuliah = "'.$mk.'", pertemuan = "'.$per.'", kehadiran = "'.$ket.'"');
            $hitungqwe = $this->db->query('SELECT * FROM tb_persentase WHERE nim = "'.$nim.'" AND nama_mata_kuliah = "'.$mk.'" AND kehadiran = "'.$ket.'"')->num_rows();
            $qwe3 = $this->db->query('UPDATE tb_absen SET persentase = "'.$hitungqwe.'" WHERE nim = "'.$nim.'" AND nama_mata_kuliah = "'.$mk.'" AND kelas = "'.$kls.'"');
            $api = [
                'pesan' => 'The student successfully added!'
            ];
            echo json_encode($api);
        }
    }

    public function insertabsenpengantar(){
        $this->load->library('kripto');

        $barcode = $this->input->post("barcode",true);
        $kelas = $this->input->post("kelas",true);
        $mk = $this->input->post("mk",true);
        $hasilbase = base64_decode($barcode);
        $len = strlen($hasilbase);
        $key = substr($hasilbase,'0','5');
        $str = substr($hasilbase,'5',$len);
        $data = $this->kripto->rc4($key, $str);
        $qwe = $this->db->query('SELECT * FROM tb_mhs WHERE kode_unik = "'.$data.'"')->result();
        $api = array();
        $api2 = array();
        foreach($qwe as $q){
            $api=[
                'nim' => $q->nim,
                'nama_mhs' => $q->nama,
                'nama_mata_kuliah' => $mk,
                'kelas' => $kelas,
                'persentase' => '0',
            ];
            $api2 = [
                'nim' => $q->nim
            ];
        }
        $cek = $this->db->query('SELECT * FROM tb_absen WHERE nim = "'.$api['nim'].'" AND nama_mata_kuliah = "'.$mk.'" AND kelas = "'.$kelas.'"');
        if($cek->num_rows()>0){
            $d = [
                'jml' => $cek->num_rows(),
                'pes' => 'The student is already exist!'
            ];
            echo json_encode($d);
        }else{
            $this->db->insert('tb_absen', $api);
            $this->db->insert('tb_persentase', $api2);
            $d = [
                'jml' => $cek->num_rows(),
                'pes' => 'Data successfully added!'
            ];
            echo json_encode($d);
        }
        
    }

    public function absen(){
        $namamatakuliah = $this->input->post("nama_mata_kuliah", true);
        $kelas = $this->input->post("kelas", true);
        $qwe = $this->db->query('SELECT a.nim, a.nama_mhs, a.persentase, m.foto FROM tb_absen a LEFT JOIN tb_mhs m on a.nim = m.nim WHERE a.nama_mata_kuliah = "'.$namamatakuliah.'" AND a.kelas = "'.$kelas.'" ORDER BY nim ASC')->result();
        $api = array();
        foreach($qwe as $w){
            $api[] = [
                'nim' => $w->nim,
                'nama' => $w->nama_mhs,
                'persentase' => $w->persentase,
                'foto' => $w->foto
            ];
        }
        echo json_encode($api);

    }

    public function cekpertemuan(){
        $namamatakuliah = $this->input->post("nama_mata_kuliah", true);
        $kelas = $this->input->post("kelas", true);
        $cek1 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_satu = "h"');
        $cek2 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_dua = "h"');
        $cek3 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_tiga = "h"');
        $cek4 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_empat = "h"');
        $cek5 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_lima = "h"');
        $cek6 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_enam = "h"');
        $cek7 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_tujuh = "h"');
        $cek8 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_delapan = "h"');
        $cek9 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_sembilan = "h"');
        $cek10 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_sepuluh = "h"');
        $cek11 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_sebelas = "h"');
        $cek12 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_dua_belas = "h"');
        $cek13 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_tiga_belas = "h"');
        $cek14 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_empat_belas = "h"');
        $cek15 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_lima_belas = "h"');
        $cek16 = $this->db->query('SELECT * FROM tb_absen WHERE nama_mata_kuliah = "'.$namamatakuliah.'" AND kelas="'.$kelas.'" AND per_enam_belas = "h"');
        $api = [
            'cek1' => $cek1->num_rows(),
            'cek2' => $cek2->num_rows(),
            'cek3' => $cek3->num_rows(),
            'cek4' => $cek4->num_rows(),
            'cek5' => $cek5->num_rows(),
            'cek6' => $cek6->num_rows(),
            'cek7' => $cek7->num_rows(),
            'cek8' => $cek8->num_rows(),
            'cek9' => $cek9->num_rows(),
            'cek10' => $cek10->num_rows(),
            'cek11' => $cek11->num_rows(),
            'cek12' => $cek12->num_rows(),
            'cek13' => $cek13->num_rows(),
            'cek14' => $cek14->num_rows(),
            'cek15' => $cek15->num_rows(),
            'cek16' => $cek16->num_rows(),
        ];
        echo json_encode($api);
    }
}
