<?php
   session_start();
  if (isset($_SESSION['ID'])){
    $pageTitle = 'Patients';
 	include 'init.php';
 	 echo 'Patients';
     include $tpl . 'footer_end.php';
 }else{
 	header('Location: index.php');
    exit();
 } ?>