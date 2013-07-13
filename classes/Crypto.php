<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:29 PM
 *
 */

class Crypto {
    public function SecureThis($pin){
        $salt = '$1$' . substr(microtime(),0,8);
        return crypt($pin, $salt);
    }
    public function CheckThis($pin,$salt){
        $this_salt = '$1$' . $salt;
        return crypt($pin,$this_salt);
    }
    public function ParseHash($hash){
        $hash_parts = explode('$',$hash);
        return $hash_parts;
    }
}
?>