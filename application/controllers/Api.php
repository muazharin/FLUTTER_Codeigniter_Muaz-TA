<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function login(){
        $username = $this->input->post('username',true);
        $password = md5($this->input->post('password',true));
        $qwe = $this->db->query('SELECT * FROM tb_admin WHERE username = "'.$username.'" AND password = "'.$password.'"');
        // $qwe = $this->db->query('SELECT * FROM tb_admin ');
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
            // $data['post'] = $post;
            // $data = [
            //     'value' => 1,
            //     'status' => 'login_berhasil',
            //     'body' => $qwe->result_array()
            // ];
        }
        echo json_encode($data);
    }

    public function mata_kuliah_pengantar(){
        $semester = $this->input->post('semester', true);
        if($this->input->post('logged_in_admin') != TRUE){
            echo "salah";
		}else{
            $api = $this->db->query('SELECT * FROM tb_mata_kuliah_pengantar WHERE semester = "'.$semester.'"')->result();
        }
        echo json_encode($api);
    }
}
