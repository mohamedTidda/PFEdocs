<?php
include 'admin/conct.php';

$tpl='include/tamplates/'; // tamplates directory 
$lang='include/languges/' ; // english directory 
$func='include/fonctions/'; //functions directory
$css='layout/css/'; //css directry
$js='layout/js/'; //js directory
$nrl='layout/css/'; //normalize directory
$img='layout/image/'; //image directory

//include th imprtant files
 include $func . 'functions.php'; 
 include $lang."english.php";
 include $tpl."header.php";
 //include the navbar if there is no variabale called $nonavbar
 if(!isset($nonavbar)){ include $tpl."navbar.php";}
 if(isset($loginNav)){ include $tpl."login-nav.php";}
 ?>