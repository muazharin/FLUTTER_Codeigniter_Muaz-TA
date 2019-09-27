<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in_admin') != TRUE){
            redirect('login');
		}
		$this->load->model('M_absen');
    }

    public function index(){
        $data['sidebar'] = '#menu5';
        $data['judul_matkul'] = 'PEMROGRAMAN WEB';
        $data['judul_kelas'] = 'RPL';
        $data['matkul'] = $this->M_absen->getMatKul();
        $data['kelas'] = ['ganjil','genap','ganjil/genap','RPL','KCV','KBJ'];
        $data['absen'] = $this->M_absen->getAllDataAbsen();
        if($this->input->post('matkul') && $this->input->post('kelas')){
            $data['judul_matkul'] = $this->input->post('matkul');
            $data['judul_kelas'] = $this->input->post('kelas');
            $data['absen'] = $this->M_absen->getAllDataAbsenBy();
        }
        $this->load->view('template/header');
        $this->load->view('pages/absen',$data);
        $this->load->view('template/footer',$data);
    }

    public function export(){
        $data['export']=$this->M_absen->getDataAbsen();
        $mk =  $this->uri->segment(3);
        $kls =  $this->uri->segment(4);
        require(APPPATH.'PHPExcel/Classes/PHPExcel.php');
		require(APPPATH.'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

		$objPhpExcel = new PHPExcel();

		$objPhpExcel->getProperties()->setCreator("MuaZ");
		$objPhpExcel->getProperties()->setLastModifiedBy("MuaZ");
		$objPhpExcel->getProperties()->setTitle("Absen");
		$objPhpExcel->getProperties()->setSubject("MuaZ");
		$objPhpExcel->getProperties()->setDescription($mk);

		$objPhpExcel->setActiveSheetIndex(0);

		$objPhpExcel->getActiveSheet()->setCellValue('A1','Mata Kuliah');
		$objPhpExcel->getActiveSheet()->setCellValue('A2','Kelas');
		$objPhpExcel->getActiveSheet()->setCellValue('B1',$mk);
		$objPhpExcel->getActiveSheet()->setCellValue('B2',$kls);
		$objPhpExcel->getActiveSheet()->setCellValue('A3','No');
		$objPhpExcel->getActiveSheet()->setCellValue('B3','NIM');
		$objPhpExcel->getActiveSheet()->setCellValue('C3','Nama');
		$objPhpExcel->getActiveSheet()->setCellValue('D3','1');
		$objPhpExcel->getActiveSheet()->setCellValue('E3','2');
		$objPhpExcel->getActiveSheet()->setCellValue('F3','3');
		$objPhpExcel->getActiveSheet()->setCellValue('G3','4');
		$objPhpExcel->getActiveSheet()->setCellValue('H3','5');
		$objPhpExcel->getActiveSheet()->setCellValue('I3','6');
		$objPhpExcel->getActiveSheet()->setCellValue('J3','7');
		$objPhpExcel->getActiveSheet()->setCellValue('K3','8');
		$objPhpExcel->getActiveSheet()->setCellValue('L3','9');
		$objPhpExcel->getActiveSheet()->setCellValue('M3','10');
		$objPhpExcel->getActiveSheet()->setCellValue('N3','11');
		$objPhpExcel->getActiveSheet()->setCellValue('O3','12');
		$objPhpExcel->getActiveSheet()->setCellValue('P3','13');
		$objPhpExcel->getActiveSheet()->setCellValue('Q3','14');
		$objPhpExcel->getActiveSheet()->setCellValue('R3','15');
		$objPhpExcel->getActiveSheet()->setCellValue('S3','16');
		$objPhpExcel->getActiveSheet()->setCellValue('T3','tgl_1');
		$objPhpExcel->getActiveSheet()->setCellValue('U3','tgl_2');
		$objPhpExcel->getActiveSheet()->setCellValue('V3','tgl_3');
		$objPhpExcel->getActiveSheet()->setCellValue('W3','tgl_4');
		$objPhpExcel->getActiveSheet()->setCellValue('X3','tgl_5');
		$objPhpExcel->getActiveSheet()->setCellValue('Y3','tgl_6');
		$objPhpExcel->getActiveSheet()->setCellValue('Z3','tgl_7');
		$objPhpExcel->getActiveSheet()->setCellValue('AA3','tgl_8');
		$objPhpExcel->getActiveSheet()->setCellValue('AB3','tgl_9');
		$objPhpExcel->getActiveSheet()->setCellValue('AC3','tgl_10');
		$objPhpExcel->getActiveSheet()->setCellValue('AD3','tgl_11');
		$objPhpExcel->getActiveSheet()->setCellValue('AE3','tgl_12');
		$objPhpExcel->getActiveSheet()->setCellValue('AF3','tgl_13');
		$objPhpExcel->getActiveSheet()->setCellValue('AG3','tgl_14');
		$objPhpExcel->getActiveSheet()->setCellValue('AH3','tgl_15');
		$objPhpExcel->getActiveSheet()->setCellValue('AI3','tgl_16');

		$baris=4;
		$x=1;

		foreach($data['export'] as $p){
			$objPhpExcel->getActiveSheet()->setCellValue('A'.$baris, $x);
			$objPhpExcel->getActiveSheet()->setCellValue('B'.$baris, $p['nim']);
			$objPhpExcel->getActiveSheet()->setCellValue('C'.$baris, $p['nama_mhs']);
			$objPhpExcel->getActiveSheet()->setCellValue('D'.$baris, $p['per_satu']);
			$objPhpExcel->getActiveSheet()->setCellValue('E'.$baris, $p['per_dua']);
			$objPhpExcel->getActiveSheet()->setCellValue('F'.$baris, $p['per_tiga']);
			$objPhpExcel->getActiveSheet()->setCellValue('G'.$baris, $p['per_empat']);
			$objPhpExcel->getActiveSheet()->setCellValue('H'.$baris, $p['per_lima']);
			$objPhpExcel->getActiveSheet()->setCellValue('I'.$baris, $p['per_enam']);
			$objPhpExcel->getActiveSheet()->setCellValue('J'.$baris, $p['per_tujuh']);
			$objPhpExcel->getActiveSheet()->setCellValue('K'.$baris, $p['per_delapan']);
			$objPhpExcel->getActiveSheet()->setCellValue('L'.$baris, $p['per_sembilan']);
			$objPhpExcel->getActiveSheet()->setCellValue('M'.$baris, $p['per_sepuluh']);
			$objPhpExcel->getActiveSheet()->setCellValue('N'.$baris, $p['per_sebelas']);
			$objPhpExcel->getActiveSheet()->setCellValue('O'.$baris, $p['per_dua_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('P'.$baris, $p['per_tiga_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('Q'.$baris, $p['per_empat_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('R'.$baris, $p['per_lima_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('S'.$baris, $p['per_enam_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('T'.$baris, $p['tgl_satu']);
			$objPhpExcel->getActiveSheet()->setCellValue('U'.$baris, $p['tgl_dua']);
			$objPhpExcel->getActiveSheet()->setCellValue('V'.$baris, $p['tgl_tiga']);
			$objPhpExcel->getActiveSheet()->setCellValue('W'.$baris, $p['tgl_empat']);
			$objPhpExcel->getActiveSheet()->setCellValue('X'.$baris, $p['tgl_lima']);
			$objPhpExcel->getActiveSheet()->setCellValue('Y'.$baris, $p['tgl_enam']);
			$objPhpExcel->getActiveSheet()->setCellValue('Z'.$baris, $p['tgl_tujuh']);
			$objPhpExcel->getActiveSheet()->setCellValue('AA'.$baris, $p['tgl_delapan']);
			$objPhpExcel->getActiveSheet()->setCellValue('AB'.$baris, $p['tgl_sembilan']);
			$objPhpExcel->getActiveSheet()->setCellValue('AC'.$baris, $p['tgl_sepuluh']);
			$objPhpExcel->getActiveSheet()->setCellValue('AD'.$baris, $p['tgl_sebelas']);
			$objPhpExcel->getActiveSheet()->setCellValue('AE'.$baris, $p['tgl_dua_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('AF'.$baris, $p['tgl_tiga_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('AG'.$baris, $p['tgl_empat_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('AH'.$baris, $p['tgl_lima_belas']);
			$objPhpExcel->getActiveSheet()->setCellValue('AI'.$baris, $p['tgl_enam_belas']);
			$x++;
			$baris++;
		}

		$filename=$mk.'xlsx';

		$objPhpExcel->getActiveSheet()->setTitle('Absen Mata Kuliah '.$mk.'-'.$kls);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename:"'.$filename.'"');
		header('Cache-Control: max-age=0');

		$write=PHPExcel_IOFactory::createWriter($objPhpExcel,'Excel2007');
		$write->save('php://output');

		exit;
    }
}