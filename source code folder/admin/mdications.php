<?php
   session_start();
  if (isset($_SESSION['ID'])){
    $pageTitle = 'Medications';
 	include 'init.php';
 	 echo 'Medications';
     include $tpl . 'footer_end.php';
 }else{
 	header('Location: index.php');
    exit();
 } ?>