<?php session_start(); 
if($_SESSION["id"] == null ){
  header("Location:../index.php");
}

// 10 mins in seconds
// $inactive = 600;
// $inactive = 10;
// $session_life = time() - $_SESSION['timeout'];
// if($session_life > $inactive) {
//    header("Location: ../authentication/log_out.php");
// }
// $_SESSION['timeout']=time();
