<?php
include "config.php";

// Check if $_SESSION or $_COOKIE already set
if( isset($_SESSION['userid']) ){
  header('Location: home.php');
  exit;
}else if( isset($_COOKIE['rememberme'] )){
 
  // Decrypt cookie variable value
  $userid = decryptCookie($_COOKIE['rememberme']);
 
  $sql_query = "select count(*) as cntUser,id from users where id='".$userid."'";
  $result = mysqli_query($con,$sql_query);
  $row = mysqli_fetch_array($result);

  $count = $row['cntUser'];

  if( $count > 0 ){
     $_SESSION['userid'] = $userid; 
     header('Location: home.php');
     exit;
  }
}

// Encrypt cookie
function encryptCookie( $value ) {

   $key = hex2bin(openssl_random_pseudo_bytes(4));

   $cipher = "aes-256-cbc";
   $ivlen = openssl_cipher_iv_length($cipher);
   $iv = openssl_random_pseudo_bytes($ivlen);

   $ciphertext = openssl_encrypt($value, $cipher, $key, 0, $iv);

   return( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
}

// Decrypt cookie
function decryptCookie( $ciphertext ) {

   $cipher = "aes-256-cbc";

   list($encrypted_data, $iv,$key) = explode('::', base64_decode($ciphertext));
   return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);

}

// On submit
if(isset($_POST['but_submit'])){

  $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
  $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);
 
  if ($uname != "" && $password != ""){

     $sql_query = "select count(*) as cntUser,id from users where loginname='".$uname."' and pwd='".$password."'";
     $result = mysqli_query($con,$sql_query);
     $row = mysqli_fetch_array($result);

     $count = $row['cntUser'];

     if($count > 0){
        $userid = $row['id'];
        if( isset($_POST['rememberme']) ){

           // Set cookie variables
           $days = 30;
           $value = encryptCookie($userid);
           setcookie ("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 1000));
        }
 
        $_SESSION['userid'] = $userid; 
        header('Location: home.php');
        exit;
     } else{
        echo "Invalid username and password";
     }

  }

}