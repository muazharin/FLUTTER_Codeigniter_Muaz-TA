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
        foreach($qwe as $q){
            $api=[
                'nim' => $q->nim,
                'nama_mhs' => $q->nama,
                'nama_mata_kuliah' => $mk,
                'kelas' => $kelas,
                'persentase' => '0',
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
}
