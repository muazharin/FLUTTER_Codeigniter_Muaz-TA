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
        $config['file_name'] = base64_encode($this->input->post('nama'));
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
    
    public function edit(){
        $id_dosen = $this->input->post('id_dosen1', true);
        $nip = $this->input->post('nip1',true);
        $nama = $this->input->post('nama1',true);
        $email = $this->input->post('email1',true);
        $minat_ajar = $this->input->post('minat_ajar1',true);
        $keterangan = $this->input->post('keterangan1',true);
        
        // $this->load->library('upload');
        $config['upload_path'] = './assets/images/dosen';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        $config['file_name'] = base64_encode($this->input->post('nama1'));
        $config['overwrite'] = true;

        // $this->upload->initialize($config);
        $this->load->library('upload', $config);
	    
        if ( $this->upload->do_upload('foto1') ) {
            $foto = $this->upload->data();
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'email' => $email,
                'minat_ajar' => $minat_ajar,
                'foto' => $foto['file_name'],
                'keterangan' => $keterangan
            ];
            $path_dosen = './assets/images/dosen/';
            @unlink($path_dosen.$this->input->post('foto2'));
            $this->db->where('id_dosen',$id_dosen);
            $this->db->update('tb_dosen',$data);
        }else {
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'email' => $email,
                'minat_ajar' => $minat_ajar,
                'keterangan' => $keterangan
            ];
            $this->db->where('id_dosen',$id_dosen);
            $this->db->update('tb_dosen',$data);
        }
    
    }

    public function hapus($id, $foto){
        $path_dosen = './assets/images/dosen/';
        @unlink($path_dosen.$foto);

        $this->db->where('id_dosen', $id);
        return $this->db->delete('tb_dosen');
    }

}