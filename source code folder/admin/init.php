<?php
include 'conct.php';

$tpl='includes/tamplates/'; // tamplates directory 
$lang='includes/languges/' ; // english directory 
$func='includes/fonctions/'; //functions directory
$css='layouts/css/'; //css directry
$js='layouts/js/'; //js directory
$nrl='layouts/css/'; //normalize directory
$img='layouts/image/'; //image directory

//include th imprtant files
 include $func . 'functions.php'; 
 include $lang."english.php";
 include $tpl."header.php";
 //include the navbar if there is no variabale called $nonavbar
 if(!isset($nonavbar)){ include $tpl."navbar.php";}
 //if(!isset($nosidebar)){ include $tpl."sidebar.php";}
//if(!isset($nofooter)){ include $tpl.'footer.php';}



 

?>