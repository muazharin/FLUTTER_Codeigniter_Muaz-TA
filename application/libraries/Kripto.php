<?php

Class Kripto {
    
    public function rc4 ($key, $str) {

        $s = array();
    
        for ($i = 0; $i < 256; $i++) {
            $s[$i] = $i;    //inisialisasi state array
        }
    
        $j = 0;
        // KSA
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
        }
    
        $i = 0;
        $j = 0;
        $res = '';     
        // PRGA
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
}

?>