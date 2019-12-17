<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {
    public function index () {
        
        $key = '15001';
        $str = 'E1E11997-10-2815001Kendari';

        $sentence = $str;
        $s = $key;
        
        $start = microtime(TRUE);
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
    
        echo $res;
        $finish = microtime(TRUE);
        echo $totaltime = $finish - $start;
        echo "<br>";
        $this->getEncrypt($sentence, $s);
    }

    function getEncrypt($text = "", $key = "", $bts = 16){

        $key =$this->keySchedule($key);
        $hasilAkhirEncrypt = array();
        $ulang = ceil(strlen($text)/$bts);

        for($i = 1; $i <= $ulang; $i++){
            $awal = ($i - 1)*$bts;
            $akhir = $bts;
            $chiper = $this->encrypt(str_pad(substr($text, $awal, $akhir), 16), $key);
            $hasilReverseBlock = $this->reverseBlockConverter($chiper); 
            
            array_push($hasilAkhirEncrypt, $hasilReverseBlock);
        }
        

        return $hasilAkhirEncrypt;
    }

    function getDecrypt($arrChiper = "", $key = ""){
        $hasilAkhirDecrypt = array();
        $key =$this->keySchedule($key);
        foreach ($arrChiper as $chiper) {
            
            $plaintext = $this->decrypt($chiper, $key);
            $hasilDecrypt = $this->reverseBlockConverter($plaintext);
            array_push($hasilAkhirDecrypt, $hasilDecrypt);
        }
        return $hasilAkhirDecrypt;
    }
    
    // function for shift binary of $x to the right side as much as $n with 32 bit length
    function ROR($x, $n, $bits = 32)
    {
        // exponential operation of 2 by $x and result minus 1
        $mask = pow(2, $n) - 1;

        //  $x bitwise XOR with $mask
        $mask_bits = $x & $mask;

        // return the value of right shift
        return ($x >> $n) | ($mask_bits << ($bits - $n));
    }

    // function for shift binary of $x to the left side as much as $n with 32 bit length
    function ROL($x, $n, $bits = 32)
    {
        // calling the ROR function with some input
        return $this->ROR($x, $bits - $n, $bits);
    }

    // function to create 4 register with 32 length each block
    function blockConverter($sentence)
    {
        //variable inisialization
        $encode = array();
        $res = null;

        // looping for change input string into binary
        for ($i=0; $i < strlen($sentence); $i++) { 

            // if the counter modulo by 4 is zero, then the entire binary is adding to $encode
            if ($i % 4 == 0 && $i != 0) {
                    
                array_push($encode, $res);
                $res = "";
            }

            // change data type char into decimal number
            $charToDecimal = ord($sentence[$i]);
            
            // change data type decimal into binary number
            $decimalToBinary = decbin($charToDecimal);

            
            // if the binary length is less than 8, then adding 0 in front of th binary number
            if (strlen($decimalToBinary) < 8) {
                    
                $eightBits = str_pad($decimalToBinary, 8, 0, STR_PAD_LEFT);                
            
            }else{

                $eightBits = $decimalToBinary;
            }

            // adding each binary to a variable
            $res = $res . $eightBits;
        }

        // adding the entire binary to an array
        array_push($encode, $res);

        // return value of 4 register
        return $encode;
    }

    // function to reverse 4 register into a char
    function reverseBlockConverter($block)
    {
        //variable inisialization
        $sentence = "";
                
        // looping for change input decimal into binary
        for ($i=0; $i < count($block); $i++) { 
            
            // change data type decimal into binary number
            $decimalToBinary = decbin($block[$i]);

            // if the binary length is less than 32, then adding 0 in front of th binary number
            if (strlen($decimalToBinary) < 32) {
                
                $thirtyTwoBits = str_pad($decimalToBinary, 32, 0, STR_PAD_LEFT);            
            
            }else{

                $thirtyTwoBits = $decimalToBinary;
            }
            
            // looping for change 32 bit of binary into char
            for ($j=0; $j < 4; $j++) { 
                
                // take the first 8 binaries
                $getSpesifikBinary = substr($thirtyTwoBits, $j*8, 8);

                // change data type binary into decimal number
                $binerToDecimal = bindec($getSpesifikBinary);

                // change data type decimal into char
                $decimalToChar = chr($binerToDecimal);
                
                // adding each char to a variable
                $sentence .= $decimalToChar;
            }
        }

        // return the value of char
        return $sentence;
    }

    // function for make generate key from user input
    function keySchedule($userKey)
    {
        // variable instantiation
        $r = 20;
        $w = 32;
        $modulo = pow(2, $w);

        // looping for instantiation variable $s with the default value is 0
        for ($i=0; $i < (2 * $r + 4); $i++) { 
                
                $s[$i] = 0;
        }

        // instantiation of array $s in index 0 with default value
        $s[0] = 0xB7E15163;

        // looping for instantiate of array $s in index after 0
        for ($i=1; $i < (2 * $r + 4); $i++) { 
            
                $s[$i] = ($s[$i - 1] + 0x9E3779B9) % (2 ** $w);
        }


        // calling function blockConverter for user input key
        $encode = $this->blockConverter(str_pad($userKey, 16));

        // counting array of $encode
        $encodeLenght = count($encode);
        
        // make instansiation of array $l with default value is 0
        for ($i=0; $i < $encodeLenght; $i++) { 
                
                $l[$i] = 0;
        }

        // adding value from $encode to array $l
        for ($i=1; $i < $encodeLenght + 1; $i++) { 
                
                $l[$encodeLenght - $i] = bindec($encode[$i - 1]);
        }

        // count the maximum value between $encodeLenght and sum of iteration
        $v = max($encodeLenght, 2*$r+4);

        //variable instantiation
        $A = 0;
        $B = 0;
        $i = 0;
        $j = 0;

        // adding value of generate key into array $s
        for ($index = 0; $index < $v; $index++) { 
                
            $A = $s[$i] = $this->ROL(($s[$i] + $A + $B) % $modulo, 3, 32);
            $B = $l[$j] = $this->ROL(($l[$j] + $A + $B) % $modulo,  ($A + $B) % 32, 32);
            $i = ($i + 1) % (2 * $r + 4);
            $j = ($j + 1) % $encodeLenght;
        }

        // return value of generate key
        
        return $s;
    }

    // function for encryption with input Sentence as plaintext and S as array from key
    function encrypt($sentence, $s)
    {
        $start1 = microtime(TRUE);
        // convert plaintext into 4 register with 32 bit lenght
        $encode = $this->blockConverter($sentence);
        $encodeLenght = count($encode);

        // convert each register from binary number into decimal number
        $A = bindec($encode[0]);
        $B = bindec($encode[1]);
        $C = bindec($encode[2]);
        $D = bindec($encode[3]);

        // inisialtization of array for return
        $cipher = array();

        // variable instantiation
        $r = 20;
        $w = 32;
        $logw = 5;
        $modulo = pow(2, $w);
        
        // instantiation variable B and D
        $B = ($B + $s[0]) % $modulo;
        $D = ($D + $s[1]) % $modulo;

        // looping for processing encryption
        for ($i=1; $i < $r + 1; $i++) { 
            
            // multiplication between D with 2
            // adding 1 with $twoMultipleD
            // multiplication variable $twoMultipleDPlusOne with D
            $twoMultipleD = gmp_mul("2",$D);
            $twoMultipleDPlusOne = gmp_add($twoMultipleD, "1");
            $DMultipleTwoMultipleDPlusOne = gmp_mul($D, $twoMultipleDPlusOne);


            // multiplication between B with 2
            // adding 1 with $twoMultipleB
            // multiplication variable $twoMultipleBPlusOne with B
            $twoMultipleB = gmp_mul("2",$B);
            $twoMultipleBPlusOne = gmp_add($twoMultipleB, "1");
            $BMultipleTwoMultipleBPlusOne = gmp_mul($B, $twoMultipleBPlusOne);

            
            // $DMultipleTwoMultipleDPlusOne mod by $modulo
            //shift to left from $t_temp as much as $logw with 32 bit length
            $u_temp = gmp_mod($DMultipleTwoMultipleDPlusOne, $modulo);
            $u = $this->ROL($u_temp, $logw, 32);

            // BDMultipleTwoMultipleBPlusOne mod by $modulo
            //shift to left from $u_temp as much as $logw with 32 bit length
            $t_temp = gmp_mod($BMultipleTwoMultipleBPlusOne, $modulo);
            $t = $this->ROL($t_temp, $logw, 32);
            
            // $t mod by 32
            // $u mod by 32
            $tmod = gmp_mod($t, 32);
            $umod = gmp_mod($u, 32);

            // A bitwise XOR with T
            //shift to left from $AXorT as much as $umod with 32 bit length
            // adding $ROLA wiht $s
            // $ROLAPlusS mod by $modulo
            $AXorT = gmp_xor($A, $t);
            $ROLA =  $this->ROL($AXorT, $umod, 32);
            $ROLAPlusS = gmp_add($ROLA, $s[2 * $i]);
            $A = gmp_mod($ROLAPlusS, $modulo);
            
            // C bitwise XOR with U
            //shift to left from $CXorU as much as $umod with 32 bit length
            // adding $ROLC wiht $s
            // $ROLCPlusS mod by $modulo
            $CXorU = gmp_xor($C, $u);
            $ROLC =  $this->ROL( $CXorU, $tmod, 32);
            $ROLCPlusS = gmp_add($ROLC, $s[2 * $i + 1]);
            $C = gmp_mod($ROLCPlusS, $modulo);

            // rotate value from register B -> A, C -> B, D -> C, A -> D
            $temp = $A;
            $A = $B;
            $B = $C;
            $C = $D;
            $D = $temp;

        }

        // add $A with $s and then mod by $modulo
        // add $C with $s and then mod by $modulo
        $A = ($A + $s[ 2 * $r + 2]) % $modulo;
        $C = ($C + $s[ 2 * $r + 3]) % $modulo;
        

        // adding 4 register to an array $cipher
        array_push($cipher, $A, $B, $C, $D);
        
        // print_r($chiper);
        // return value result of encryption

        echo $cipher;
        $finish1 = microtime(TRUE);
        echo $totaltime = $finish - $start;
    }
    
    // function for decryption with input Sentence as plaintext and S as array from key    
    function decrypt($sentence, $s)
    {
        // convert ciphertext into 4 register with 32 bit lenght        
        $encode = $this->blockConverter($sentence);
        $encodeLenght = count($encode);

        // convert each register from binary number into decimal number        
        $A = bindec($encode[0]);
        $B = bindec($encode[1]);
        $C = bindec($encode[2]);
        $D = bindec($encode[3]);

        // inisialtization of array for return
        $original = array();

        // variable instantiation      
        $r = 20;
        $w = 32;
        $logw = 5;
        $modulo = pow(2, $w);

        // instantiation variable B and D
        $C = ($C - $s[ 2 * $r + 3]) % $modulo;
        $A = ($A - $s[ 2 * $r + 2]) % $modulo;

        // looping for processing decryption
        for ($i = $r; $i >= 1; $i--) { 

            // rotate value from register C -> D, B -> C, A -> B, D -> A        
            $temp = $D;
            $D = $C;
            $C = $B;
            $B = $A;
            $A = $temp;
            
                
            // multiplication between D with 2
            // adding 1 with $twoMultipleD
            // multiplication variable $twoMultipleDPlusOne with D
            $twoMultipleD = gmp_mul("2",$D);
            $twoMultipleDPlusOne = gmp_add($twoMultipleD, "1");
            $DMultipleTwoMultipleDPlusOne = gmp_mul($D, $twoMultipleDPlusOne);
            

            // multiplication between B with 2
            // adding 1 with $twoMultipleB
            // multiplication variable $twoMultipleBPlusOne with B
            $twoMultipleB = gmp_mul("2",$B);
            $twoMultipleBPlusOne = gmp_add($twoMultipleB, "1");
            $BMultipleTwoMultipleBPlusOne = gmp_mul($B, $twoMultipleBPlusOne);
            
            
            // BDMultipleTwoMultipleBPlusOne mod by $modulo
            //shift to left from $u_temp as much as $logw with 32 bit length
            $t_temp = gmp_mod($BMultipleTwoMultipleBPlusOne, $modulo);
            $t = $this->ROL($t_temp, $logw, 32);
            
            
            // $DMultipleTwoMultipleDPlusOne mod by $modulo
            //shift to left from $t_temp as much as $logw with 32 bit length
            $u_temp = gmp_mod($DMultipleTwoMultipleDPlusOne, $modulo);
            $u = $this->ROL($u_temp, $logw, 32);


            // $t mod by 32
            // $u mod by 32
            $tmod = gmp_mod($t, 32);
            $umod = gmp_mod($u, 32);


            // $C minus by $s
            // $CMinusS mod by $modulo
            // $CMinusSModByModulo is shift to right as much as $tmod with 32 bit length
            //  $RORCMinusSModByModuloAndTMod bitwise XOR with $u
            $CMinusS = gmp_sub($C, $s[2 * $i + 1]);
            $CMinusSModByModulo = gmp_mod($CMinusS, $modulo);
            $RORCMinusSModByModuloAndTMod = $this->ROR($CMinusSModByModulo, $tmod, 32);
            $C = gmp_xor($RORCMinusSModByModuloAndTMod, $u);
            

            // $A minus by $s
            // $AMinusS mod by $modulo
            // $AMinusSModByModulo is shift to right as much as $umod with 32 bit length
            //  $RORAMinusSModByModuloAndUMod bitwise XOR with $t
            $AMinusS = gmp_sub($A, $s[2 * $i]);            
            $AMinusSModByModulo = gmp_mod($AMinusS, $modulo);
            $RORAMinusSModByModuloAndUMod = $this->ROR($AMinusSModByModulo, $umod, 32);
            $A = gmp_xor($RORAMinusSModByModuloAndUMod, $t);
            
        }

        // $D minus by $s and then mod by $modulo
        // $B minus by $s and then mod by $modulo
        $D = ($D - $s[1]) % $modulo;
        $B = ($B - $s[0]) % $modulo;
        
        // adding 4 register to an array $original
        array_push($original, $A, $B, $C, $D);
        
        // return value result of decryption
        return $original;
    }
}