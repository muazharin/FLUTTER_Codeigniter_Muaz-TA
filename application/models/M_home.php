<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Home extends CI_Model {

    public function ubahPassword(){
        $data=[
            'password' => md5($this->input->post('pass',true))
        ];
        $this->db->where('id_admin', 2);
        $this->db->update('tb_admin', $data);
    }
}
