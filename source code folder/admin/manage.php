<?php 
 session_start();
include 'conct.php';
$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
  if($do=='manage'){

  }elseif($do=="addDoctor"){
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      		$user 	= $_POST['name'];
      		$pass   = $_POST['newpassword'];
			$adress = $_POST['adress'];
			$office = $_POST['office'];
			$phone  = $_POST['phone'];
			 $hashpass=sha1($pass);
			//insert the information in DB
		    $stmt=$con->prepare('INSERT INTO PFE_DB.doctors( D_name, D_password, adress, office, phone) VALUES (:D_name,:D_password, :adress, :office, :phone)');
            $stmt->execute(array(
	 	     'D_name'       => $user,
	 	     'D_password'  => $hashpass,
	 	     'adress'      => $adress,
	 	     'office'      =>$office,
	 	     'phone'       =>$phone
	        ));
		     if($stmt->rowCount()){
		     	echo 'inserted';
		     }else{
		     	echo 'not_inserted';
		     }
      }
  }elseif ($do=='updateDoctor') {// start update page
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          // get variables from the form
      	    $id 	= $_POST['D_id'];
			$user 	= $_POST['name'];
			$adress = $_POST['adress'];
			$office = $_POST['office'];
			$phone  = $_POST['phone'];
			// Password trick
            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
		   //Update The Database With This Info
		    $stmt = $con->prepare("UPDATE PFE_DB.doctors SET D_name =?, D_password=?, adress = ?, office = ?, phone = ? 
		   	       WHERE D_id = ?");
		    $stmt->execute(array($user, $pass, $adress, $office, $phone, $id));
		    $count= $stmt->rowCount() ;
		    if($count>0){
		  	  echo 'updated';
		  	  $_SESSION['username'] = $user;
		    }else{
		    	echo'not_updated';
		    }
        } 
   //end update page 
   }elseif($do=="delete"){
    	 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	 	$D_id=$_POST['Did'];
    	 	$table=$_POST['table'];
    	 	$col=$_POST['col'];
    	 	$stmt = $con->prepare("DELETE FROM  PFE_DB. $table WHERE $col = ?");
		    $stmt->execute(array($D_id));
            if($stmt->rowCount()>0){
            	echo 'deleted';
            }else{
            	echo 'not_deleted';
            }

    	 }
    }elseif($do=='checkName'){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
           $name=$_POST['name'];
           $col =$_POST['col'];
           $table=$_POST['table'];
           $stmt = $con->prepare("SELECT $col FROM PFE_DB. $table  WHERE $col = ? ");
	       $stmt->execute(array( $name));
	       $count= $stmt->rowCount();
	        if($count>0){
	          echo 'exist';
	        }else{
	         echo 'not_exist';
	        }
        }
    }elseif($do=='addPharmacy'){
    	       if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		      		$user 	= $_POST['name'];
		      		$pass   = $_POST['newpassword'];
					$adress = $_POST['adress'];
					$phone  = $_POST['phone'];
					$owner = $_POST['owner'];
					 $hashpass=sha1($pass);
			//insert the information in DB
		    $stmt=$con->prepare('INSERT INTO PFE_DB.pharmacy( ph_name, ph_password, adress, phone, owner_name) VALUES (:ph_name,:ph_password, :adress, :phone, :owner)');
            $stmt->execute(array(
	 	     'ph_name'       => $user,
	 	     'ph_password'  => $hashpass,
	 	     'adress'      => $adress,
	 	     'phone'       =>$phone,
	 	     'owner'       =>$owner
	        ));
		     if($stmt->rowCount()){
		     	echo 'inserted';
		     }else{
		     	echo 'not_inserted';
		     }
    	       }

    }elseif($do=='updatepharmacy'){
          // get variables from the form
      	    $id 	= $_POST['ph_id'];
			$user 	= $_POST['name'];
			$adress = $_POST['adress'];
			$phone  = $_POST['phone'];
			$owner  = $_POST['owner'];
			// Password trick
            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
		   //Update The Database With This Info
		    $stmt = $con->prepare("UPDATE PFE_DB.pharmacy SET ph_name =?, ph_password=?, adress = ?, phone = ?, 
		    	owner_name=? WHERE ph_id = ?");
		    $stmt->execute(array($user, $pass, $adress, $phone,$owner, $id));
		    if($stmt->rowCount()>0){
		  	  echo 'updated-ph';
		    }else{
		    	echo'not_updated-ph';
		    }
 
    }
   ?>


















