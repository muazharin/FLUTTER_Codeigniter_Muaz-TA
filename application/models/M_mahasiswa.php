<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Mahasiswa extends CI_Model {

    public function getAllMhs(){
        return $this->db->get('tb_mhs')->result_array();
    }
    
    public function getAllMhsNim($nim){
        $this->db->where('nim', $nim);
        return $this->db->get('tb_mhs')->result_array();
    }
    
    public function save($nim, $nama, $tempat_lahir, $tanggal_lahir, $image_name, $str){
        $this->load->library('upload');
        $config['upload_path'] = './assets/images/mahasiswa';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $this->input->post('nim');
        $config['overwrite'] = true;

        $this->upload->initialize($config);
	    if (!empty($_FILES['foto']['name'])) {
	        if ( $this->upload->do_upload('foto') ) {
	            $foto = $this->upload->data();
	            $data = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'tmpt_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tanggal_lahir,
                    'foto' => $foto['file_name'],
                    'kode_unik' => $str,
                    'qr_code' => $image_name
                ];
                $this->db->insert('tb_mhs',$data);
	        }else {
              die("gagal upload");
	        }
	    }else {
	      echo "tidak masuk";
	    }

    }

    public function rc4($key, $str) {

        $s = array();
    
        for ($i = 0; $i < 256; $i++) {
            $s[$i] = $i;    //inisialisasi state array
        }
    
        $j = 0;
    
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
        }
    
        $i = 0;
        $j = 0;
        $res = '';     
    
        for ($y = 0; $y < strlen($str); $y++) {
            $i = ($i + 1) % 256;
            $j = ($j + $s[$i]) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
            $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
        }
    
        return $res;
    
    }

    public function tambah(){
        
        $nim = $this->input->post('nim', true);
        $nama = $this->input->post('nama', true);
        $tempat_lahir = $this->input->post('tempat_lahir', true);
        $tanggal_lahir = $this->input->post('tanggal_lahir', true);
        $key = substr($nim,'4','5');
        $str = 'E1E1'.$tanggal_lahir.$key.$tempat_lahir;
        $dataqr = $this->rc4($key, $str);
        $qr = base64_encode($key.$dataqr);

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qr_mhs/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        
        $image_name=$nim.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->save($nim, $nama, $tempat_lahir, $tanggal_lahir, $image_name, $str);
    }

    public function update($id_mhs, $nim, $nama, $tempat_lahir, $tanggal_lahir, $image_name, $str){
        $this->load->library('upload');
        $config['upload_path'] = './assets/images/mahasiswa';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $this->input->post('nim');
        $config['overwrite'] = true;

        $path_mhs = './assets/images/mahasiswa/';
        $path_qrcode = './assets/images/qr_mhs/';
        

        $this->upload->initialize($config);
	    if (!empty($_FILES['foto1'])) {
	        if ( $this->upload->do_upload('foto1') ) {
                @unlink($path_mhs.$this->input->post('fotolama1'));
                @unlink($path_qrcode.$nim);
                $foto = $this->upload->data();
	            $data = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'tmpt_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tanggal_lahir,
                    'foto' => $foto['file_name'],
                    'kode_unik' => $str,
                    'qr_code' => $image_name
                ];
                $this->db->where('id_mhs', $id_mhs);
                $this->db->update('tb_mhs',$data);
	        }else {
                // @unlink($path_mhs.$this->input->post('fotolama1'));
                $data = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'tmpt_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tanggal_lahir,
                    'qr_code' => $image_name
                ];
                $this->db->where('id_mhs', $id_mhs);
                $this->db->update('tb_mhs',$data);
	        }
	    }else {
	      echo "tidak masuk";
	    }
    }

    public function edit(){
        
        $id_mhs = $this->input->post('id_mhs1', true);
        $nim = $this->input->post('nim1', true);
        $nama = $this->input->post('nama1', true);
        $tempat_lahir = $this->input->post('tempat_lahir1', true);
        $tanggal_lahir = $this->input->post('tanggal_lahir1', true);
        $key = substr($nim,'4','5');
        $str = 'E1E1'.$tanggal_lahir.$key.$tempat_lahir;
        $dataqr = $this->rc4($key, $str);
        $qr = base64_encode($key.$dataqr);

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
 
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/qr_mhs/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        
        $image_name=$nim.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $qr; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->update($id_mhs, $nim, $nama, $tempat_lahir, $tanggal_lahir, $image_name, $str);
    }

    public function hapus($id, $foto, $qrcode){
        $path_mhs = './assets/images/mahasiswa/';
        @unlink($path_mhs.$foto);
        
        $path_qrcode = './assets/images/qr_mhs/';
        @unlink($path_qrcode.$qrcode);

        $this->db->where('id_mhs', $id);
        return $this->db->delete('tb_mhs');
    }

    
}