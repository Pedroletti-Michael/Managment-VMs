<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 18.03.2020
* Description : File used to encrypt and decrypt char
*/

/**
* Function used to encrypt a string
*/
function encrypt($string){
  $pwdK = "mkHndhU83csnUia.Dhjc73jh";
  return $pwdK . base64_encode($string);
}

/**
* Function used to decrypt a string
*/
function decrypt($string){
  $pwdK = "mkHndhU83csnUia.Dhjc73jh";
  $str = str_replace($pwdK, "", $string);
  return base64_decode($str);
}
