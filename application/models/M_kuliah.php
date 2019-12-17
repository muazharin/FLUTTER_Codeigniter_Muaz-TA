<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kuliah extends CI_Model {

    // pengantar 
    public function mkPengantar(){
        $query = $this->db->query("SELECT * FROM tb_mata_kuliah_pengantar");
        return $query->result_array();
    }

    public function tambahMkPengantar(){
        $data = [
            'kode_mata_kuliah' => $this->input->post('kode_mk', true),
            'nama_mata_kuliah' => $this->input->post('nama_mk', true),
            'dosen_satu' => $this->input->post('dosen_satu', true),
            'dosen_dua' => $this->input->post('dosen_dua', true),
            'hari' => $this->input->post('hari', true),
            'mulai' => $this->input->post('mulai', true),
            'selesai' => $this->input->post('selesai', true),
            'ruang' => $this->input->post('ruang', true),
            'kelas' => $this->input->post('kelas', true),
            'semester' => $this->input->post('semester', true),
        ];
        $this->db->insert('tb_mata_kuliah_pengantar', $data);

        $this->db->where('nama_mata_kuliah', $this->input->post('nama_mk', true));
        $hasil= $this->db->get('tb_list_mk');
        if($hasil->num_rows()<=0){
            $data=[
                'nama_mata_kuliah' => $this->input->post('nama_mk',true)
            ];
            $this->db->insert('tb_list_mk', $data);   
        }
    }
    
    public function editMkPengantar(){
        $data = [
            'kode_mata_kuliah' => $this->input->post('kode_mk1', true),
            'nama_mata_kuliah' => $this->input->post('nama_mk1', true),
            'dosen_satu' => $this->input->post('dosen_satu1', true),
            'dosen_dua' => $this->input->post('dosen_dua1', true),
            'hari' => $this->input->post('hari1', true),
            'mulai' => $this->input->post('mulai1', true),
            'selesai' => $this->input->post('selesai1', true),
            'ruang' => $this->input->post('ruang1', true),
            'kelas' => $this->input->post('kelas1', true),
            'semester' => $this->input->post('semester1', true),
        ];
        $this->db->where('id_mata_kuliah_pengantar', $this->input->post('id_mata_kuliah_pengantar1', true));
        $this->db->update('tb_mata_kuliah_pengantar', $data);
    }

    public function hapusMkPengantar(){
        $id = $this->uri->segment(3);
        $this->db->where('id_mata_kuliah_pengantar', $id);
        $this->db->delete('tb_mata_kuliah_pengantar');
    }
    
    // peminatan 
    public function mkPeminatan(){
        $query = $this->db->query("SELECT * FROM tb_mata_kuliah_peminatan");
        return $query->result_array();
    }

    public function tambahMkPeminatan(){
        $data = [
            'kode_mata_kuliah' => $this->input->post('kode_mk', true),
            'nama_mata_kuliah' => $this->input->post('nama_mk', true),
            'dosen_satu' => $this->input->post('dosen_satu', true),
            'dosen_dua' => $this->input->post('dosen_dua', true),
            'hari' => $this->input->post('hari', true),
            'mulai' => $this->input->post('mulai', true),
            'selesai' => $this->input->post('selesai', true),
            'ruang' => $this->input->post('ruang', true),
            'kelas' => $this->input->post('kelas', true),
            'semester' => $this->input->post('semester', true),
        ];
        $this->db->insert('tb_mata_kuliah_peminatan', $data);

        $this->db->where('nama_mata_kuliah', $this->input->post('nama_mk', true));
        $hasil= $this->db->get('tb_list_mk');
        if($hasil->num_rows()<=0){
            $data=[
                'nama_mata_kuliah' => $this->input->post('nama_mk',true)
            ];
            $this->db->insert('tb_list_mk', $data);   
        }
    }
    
    public function editMkPeminatan(){
        $data = [
            'kode_mata_kuliah' => $this->input->post('kode_mk1', true),
            'nama_mata_kuliah' => $this->input->post('nama_mk1', true),
            'dosen_satu' => $this->input->post('dosen_satu1', true),
            'dosen_dua' => $this->input->post('dosen_dua1', true),
            'hari' => $this->input->post('hari1', true),
            'mulai' => $this->input->post('mulai1', true),
            'selesai' => $this->input->post('selesai1', true),
            'ruang' => $this->input->post('ruang1', true),
            'kelas' => $this->input->post('kelas1', true),
            'semester' => $this->input->post('semester1', true),
        ];
        $this->db->where('id_mata_kuliah_peminatan', $this->input->post('id_mata_kuliah_peminatan1', true));
        $this->db->update('tb_mata_kuliah_peminatan', $data);
    }

    public function hapusMkPeminatan(){
        $id = $this->uri->segment(3);
        $this->db->where('id_mata_kuliah_peminatan', $id);
        $this->db->delete('tb_mata_kuliah_peminatan');
    }
}