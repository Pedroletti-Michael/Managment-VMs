<?php

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
