<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Absen extends CI_Model {

    public function getAllDataAbsen(){
        // $query = $this->db->query("SELECT * FROM tb_absen WHERE nama_mata_kuliah = 'PEMROGRAMAN WEB' AND kelas = 'RPL'");
        // return $query->result_array();
        $this->db->where('nama_mata_kuliah', 'FISIKA');
        $this->db->where('kelas', 'ganjil');
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
        $mk =  rawurldecode($this->uri->segment(3));
        $kls =  $this->uri->segment(4);
        $this->db->where('nama_mata_kuliah',$mk);
        $this->db->where('kelas',$kls);
        return $this->db->get('tb_absen')->result_array();
    }

    public function edit(){
        $id = $this->input->post('id_absen');
        $data = [
            'kelas' => $this->input->post('kel'),
            // 'per_satu' => $this->input->post('per_satu'),
            // 'per_dua' => $this->input->post('per_dua'),
            // 'per_tiga' => $this->input->post('per_tiga'),
            // 'per_empat' => $this->input->post('per_empat'),
            // 'per_lima' => $this->input->post('per_lima'),
            // 'per_enam' => $this->input->post('per_enam'),
            // 'per_tujuh' => $this->input->post('per_tujuh'),
            // 'per_delapan' => $this->input->post('per_delapan'),
            // 'per_sembilan' => $this->input->post('per_sembilan'),
            // 'per_sepuluh' => $this->input->post('per_sepuluh'),
            // 'per_sebelas' => $this->input->post('per_sebelas'),
            // 'per_dua_belas' => $this->input->post('per_dua_belas'),
            // 'per_tiga_belas' => $this->input->post('per_tiga_belas'),
            // 'per_empat_belas' => $this->input->post('per_empat_belas'),
            // 'per_lima_belas' => $this->input->post('per_lima_belas'),
            // 'per_enam_belas' => $this->input->post('per_enam_belas')
        ];
        $this->db->where('id_absen', $id);
        return $this->db->update('tb_absen', $data);
    }

    public function hapus(){
        $nim = $this->uri->segment(4);
        $nmk = $this->uri->segment(5);
        $this->db->where('nim', $nim);
        $this->db->where('nama_mata_kuliah', $nmk);
        $this->db->delete('tb_persentase');


        $id = $this->uri->segment(3);
        $this->db->where('id_absen', $id);
        return $this->db->delete('tb_absen');
    }
}
