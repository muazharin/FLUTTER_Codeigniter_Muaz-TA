<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dosen extends CI_Model {

    public function getAllDosen(){
        return $this->db->get('tb_dosen')->result_array();
    }

    public function tambah(){
        $nip = $this->input->post('nip',true);
        $nama = $this->input->post('nama',true);
        $email = $this->input->post('email',true);
        $minat_ajar = $this->input->post('minat_ajar',true);
        $keterangan = $this->input->post('keterangan',true);
        
        // $this->load->library('upload');
        $config['upload_path'] = './assets/images/dosen';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $this->input->post('nama');
        $config['overwrite'] = true;

        // $this->upload->initialize($config);
        $this->load->library('upload', $config);
	    
        if ( $this->upload->do_upload('foto') ) {
            $foto = $this->upload->data();
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'email' => $email,
                'minat_ajar' => $minat_ajar,
                'foto' => $foto['file_name'],
                'keterangan' => $keterangan
            ];
            $this->db->insert('tb_dosen',$data);
        }else {
            die("gagal upload");
        }
    
    }

}