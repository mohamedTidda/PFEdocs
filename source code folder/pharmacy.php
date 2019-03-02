<?php
  session_start();
  if (isset($_SESSION['id'])){
    $pageTitle = 'Phamacy';
 	include 'init.php';
 	
    include $tpl . 'footer_end.php';
 }else{
 	header('Location: index.php');
    exit();
 } ?>