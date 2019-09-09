<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kuliah extends CI_Model {

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
            'kelas' => $this->input->post('kelas', true),
            'semester' => $this->input->post('semester', true),
        ];
        $this->db->insert('tb_mata_kuliah_pengantar', $data);

        $this->db->where('nama_mata_kuliah', $this->input->post('nama_mk', true));
        $hasil= $this->db->get('tb_list_mk');
        if($hasil->num_rows()>0){
            $data=[
                'nama_mata_kuliah' => $this->input->post('nama_mk',true)
            ];
            $this->db->update('tb_list_mk', $data);
        }else{
            $data=[
                'nama_mata_kuliah' => $this->input->post('nama_mk',true)
            ];
            $this->db->input('tb_list_mk', $data);
        }
    }
}