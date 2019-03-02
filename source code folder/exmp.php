<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$n=0;
 	  $n++;
      $m_name=$_POST['m-name'];
      $dose=$_POST['dose'];
      $repeated=$_POST['repeated'];
      $box=$_POST['box'];
      $form=$_POST['form'];
      $time=$_POST['time'];
      $medicines_r=array();
      $medicines_r[$n]=array(
      	'name'     =>$m_name,
      	'dose'     =>$dose,
      	'repeated' =>$repeated,
      	'box'      =>$box,
      	'form'     =>$form,
      	'time'     =>$time);
      
      foreach ($medicines_r as $row) {
      	echo $row['name'] .'<br>';
      	echo $row['dose'] .'<br>';
      	echo $row['repeated'] .'<br>';
      	echo $row['box'] .'<br>';
      	echo $row['form'] .'<br>';
      	echo $row['time'] .'<br>';
      }
    }