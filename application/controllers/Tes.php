<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

    public function index () {
        $key = '2573';
        $str = 'HALO';


        $s = array();
    
        for ($i = 0; $i < 4; $i++) {
            $s[$i] = $i;    //inisialisasi state array
        }

        echo json_encode($s);
        echo "<br>";
        echo "KSA";
        echo "<br>";
        $j = 0;
        // KSA
        for ($i = 0; $i < 4; $i++) {
            $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 4;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
            echo json_encode($s);
            echo "<br>";
        }
        
        echo "PRGA";
        echo "<br>";
    
        $i = 0;
        $j = 0;
        $res = ''; 
        $k =  array();    
        // PRGA
        for ($y = 0; $y < strlen($str); $y++) {
            $i = ($i + 1) % 4;
            $j = ($j + $s[$i]) % 4;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
            $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 4]);
            $k[]= ord($str[$y]) ^ $s[($s[$i] + $s[$j]) % 4];
            echo json_encode($s);
            echo "<br>";
        }
        echo json_encode($k);
        echo "<br>";
        echo $res;
    }
}