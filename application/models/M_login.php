<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {
    
    public function usercheck(){

        $user = $this->input->post('username',true);
        $password = md5($this->input->post('pass',true));
        $this->db->where('username', $user);
        $this->db->where('password', $password);
        return $this->db->get('tb_admin', 1);
        
    }
}