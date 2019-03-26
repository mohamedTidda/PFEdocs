<?php
 session_start();
include 'admin/conct.php';
$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
if($do=='manage'){

}elseif($do=='ckeckUser'){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    	    $check=false;
    		$name=$_POST['user'];
	        $pass=$_POST['pass'];
	        $type= $_POST['type'];
	        $shapass=sha1($pass);
             if($type=="doctors"){
             	$col1="D_name";
             	$col2="D_password";
                $col3="D_id";
             	$check=true;
             }elseif($type=="pharmacy"){
             	$col1="ph_name";
             	$col2="ph_password";
                $col3="ph_id";
             	$check=true;
             }elseif($type=="patients"){
             	$col1="p_name";
             	$col2="p_password";
                $col3="p_id";
             	$check=true;
             }else{
             	echo 'wrong';
             	$check=false;
             }
            if($check==true){
		        // check if the user exist in the database
		        $stmt = $con->prepare("SELECT * FROM PFE_DB. $type WHERE $col1 = ? AND $col2=?");
		        $stmt->execute(array( $name,$shapass));
		        $row= $stmt->fetch();
		        if($stmt->rowCount()>0){
		        	echo 'user_exist';
                       $_SESSION['id']= $row[$col3];          //register session id
                       $_SESSION['username']= $row[$col1];   //register session name 
                       $_SESSION['page']=$type;              //register session page to redirect 
		        }else{
		        	echo 'user_not_exist';
		        }
            }else{
               echo 'wrong'; 
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
    }elseif ($do=='updateDoctor') {// start Doctor update page
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          // get variables from the form
            $id     = $_POST['D_id'];
            $user   = $_POST['name'];
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
   }elseif($do=='updatepatient'){ // start patient update page
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          // get variables from the form
            $id     = $_POST['p_id'];
            $user   = $_POST['name'];
            $phone  = $_POST['phone'];
            $adress = $_POST['adress'];
           //Update The Database With This Info
            $stmt = $con->prepare("UPDATE PFE_DB.patients SET p_name =?, phone = ?, adress = ?
                   WHERE p_id = ?");
            $stmt->execute(array($user,  $phone, $adress, $id));
            $count= $stmt->rowCount() ;
            if($count>0){
              echo 'updated-p';
            }else{
                echo 'nto_updated-p';
            }
            
    }
   }elseif($do=="delete"){
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $D_id=$_POST['id'];
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
    }elseif ($do=='search') {

      if(isset($_POST['txt'])){
       $name=$_POST['txt'];
       $result='';
         $stmt=$con->prepare("SELECT * FROM PFE_DB.patients WHERE p_name LIKE '%".$name."%' ");
         $stmt->execute();
         $count=$stmt->rowCount();
         $rows=$stmt->fetchAll();
        if($count > 0){
          $result.='<p>search result</p>';
          foreach ($rows as $row) {
            $result.='<div class="iteam-search" ><a href="profile.php?p_id='.$row['p_id'].'">'.
            $row['p_name']
            .'</a></div>';
          }
              echo $result;
        }else{
          echo '<p>no result !</p>';
        }
     }


}elseif($do =='search-medicine'){
      if(isset($_POST['txt'])){
       $name=$_POST['txt'];
         $result='';
         $stmt=$con->prepare("SELECT * FROM PFE_DB.medicines WHERE name LIKE '%".$name."%' ");
         $stmt->execute();
         $count=$stmt->rowCount();
         $rows=$stmt->fetchAll();
        if($count > 0){
          $result.='<p>search result</p>';
           $result.='<ul class="list-unstyled">';
          foreach ($rows as $row) {
            $result.='<li class="medice-n">'.$row['name'].'</li>';
          }
          $result.='</ul>';
              echo $result;
        }else{
          echo '<p>no result !</p>';
        }
     }
}elseif($do=='add-medicine'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $m_name=$_POST['m-name'];
      $dose=$_POST['dose'];
      $repeated=$_POST['repeated'];
      $boxs=$_POST['box'];
      $form=$_POST['form'];
      $time_use=$_POST['time'];
      $p_id=$_POST['p_id'];
      $d_id=$_POST['d_id'];
            //insert the information in DB
        $stmt=$con->prepare('INSERT INTO PFE_DB.mdicines_described(name, dose, repeated, boxs , form, time_use,p_id,
          d_id, prescribe_date, already_added) VALUES (:name,:dose, :repeated, :boxs, :form, :time_use, :p_id, :d_id, now(),0)');
            $stmt->execute(array(
           'name'     => $m_name,
           'dose'     => $dose,
           'repeated' => $repeated,
           'boxs'     =>$boxs,
           'form'     =>$form,
           'time_use' =>$time_use,
           'p_id'     =>$p_id,
           'd_id'     =>$d_id
          ));
        if($stmt->rowCount()>0){
              $stmt1=$con->prepare("SELECT * FROM PFE_DB.mdicines_described WHERE p_id=? AND d_id=? AND already_added=0 ORDER BY id DESC LIMIT 1");
              $stmt1->execute(array($p_id, $d_id));
              $row=$stmt1->fetch(); 
              if($stmt1->rowCount()>0){
                 echo $row['id'].'-'.$row['name'].'-'.$row['dose'].'-'.
                      $row['repeated'].'-'.$row['boxs'].'-'.$row['form'].'-'.$row['time_use'];
              }else{
                echo 'not_result_found';
              }
        }else{
          echo 'not_mdicines_described';
        }
    }
}elseif ($do =='get-medicine-id') {
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $m_name=$_POST['m-name'];
            $dose=$_POST['dose'];
            $repeated=$_POST['repeated'];
            $boxs=$_POST['box'];
            $form=$_POST['form'];
            $time_use=$_POST['time'];
            $p_id=$_POST['p_id'];
            $d_id=$_POST['d_id'];
            $date=date('Y-m-d');

            $stmt1=$con->prepare("SELECT id FROM PFE_DB.mdicines_described WHERE name=? AND dose=? AND  repeated=? AND 
                     boxs=? AND form=? AND  time_use=? AND p_id=? AND  d_id=? AND  prescribe_date=? 
                     ORDER BY id DESC LIMIT 1");
            $stmt1->execute(array($m_name, $dose, $repeated, $boxs, $form, $time_use, $p_id, $d_id, $date));
            $row=$stmt1->fetch(); 
             if($stmt1->rowCount() > 0){
                echo $row['id'];
             }else{
               echo 'error';
             }

      }
}elseif ($do=='get-medicine-info') {
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $m_id=$_POST['m_id'];
     $result='';
     $stmt=$con->prepare("SELECT * FROM PFE_DB.mdicines_described WHERE id=?");
     $stmt->execute(array($m_id));
     $row=$stmt->fetch(); 
     if($stmt->rowCount() >0){
       echo $row['id'].'-'.$row['name'].'-'.$row['dose'].'-'.
            $row['repeated'].'-'.$row['boxs'].'-'.$row['form'].'-'.$row['time_use'];
       
     }else{
      echo 'bad';
     }
   }
 
}elseif($do=='save-prescription') {
    $p_id = $_POST['Pid'];
    $stmt=$con->prepare('INSERT INTO PFE_DB.prescription(p_id, d_id, add_time) VALUES (:p_id,:d_id, now())');
     $stmt->execute(array(
        'p_id' => $p_id,
       'd_id'  => $_SESSION['id']));
        if($stmt->rowCount()>0){
           $stmt1=$con->prepare("SELECT * FROM PFE_DB.prescription  ORDER BY prescription.id DESC LIMIT 1");
           $stmt1->execute();
           $row=$stmt1->fetch(); 
           if($stmt1->rowCount()>0){
                 $stmt2=$con->prepare('UPDATE PFE_DB.mdicines_described  INNER JOIN PFE_DB.prescription SET 
                  mdicines_described.prescription_id=? , mdicines_described.already_added = 1 
                 WHERE mdicines_described.prescribe_date=prescription.add_time AND mdicines_described.already_added = 0 
                 AND mdicines_described.p_id=prescription.p_id AND mdicines_described.d_id=prescription.d_id');
                $stmt2->execute(array($row['id']));
                if($stmt2->rowCount()>0){
                  echo 'prescribtion_saved';
                }else{
                   echo 'prescribtion_not_saved1';
                 }
           } else{
              echo 'prescribtion_not_saved2';
           }      
   }else{
    echo 'prescribtion_not_saved3';
   }

}elseif ($do=='change-medicine') {
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $id        =$_POST['ch-id'];
     $name      =$_POST['ch-m-name'];
     $dose      =$_POST['ch-dose'];
     $repeated  =$_POST['ch-repeated'];
     $box       =$_POST['ch-box'];
     $form      =$_POST['ch-form'];
     $time      =$_POST['ch-time'];
        //Update The Database With This Info
        $stmt = $con->prepare("UPDATE PFE_DB.mdicines_described SET
                                name =?, dose=?, repeated = ?, boxs = ?, form = ? , time_use=?
                                WHERE id = ?");
        $stmt->execute(array($name, $dose, $repeated, $box , $form, $time, $id));
        if($stmt->rowCount()>0){
          echo 'medicine_updated'.'-'.$id.'-'.$name.'-'.$dose.'-'.$repeated.'-'.$box.'-'.$form.'-'.$time;
        }else{
           echo 'not_medicine_updated';
        }
  }
  
}elseif ($do=='add-patient') {
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $d_id       =$_POST['d_id'];
      $name       =$_POST['name'];
      $password   =$_POST['password'];
      $birth_date =$_POST['birth_date'];
      $adress     =$_POST['adress'];
      $phone      =$_POST['phone'];
       $shapass=sha1($password);
        //insert the information in DB
        $stmt=$con->prepare('INSERT INTO PFE_DB.patients(p_name, p_password, birth_date, phone , adress) VALUES (:p_name,:p_password, :birth_date, :phone, :adress)');
        $stmt->execute(array(
           'p_name'     => $name,
           'p_password' =>$shapass,
           'birth_date' => $birth_date,
           'phone'      =>$adress,
           'adress'     =>$phone
          ));
        if($stmt->rowCount()>0){
           $stmt1=$con->prepare("SELECT * FROM PFE_DB.patients WHERE p_name=? LIMIT 1");
           $stmt1->execute(array($name));
           $row=$stmt1->fetch();
             if($stmt1->rowCount()>0){
                //insert relashin 
                  $stmt = $con->prepare("INSERT INTO PFE_DB.patientofdoctor(D_id , p_id) VALUES (:p_id, :d_id)");
                  $stmt->execute(array(
                    'p_id' => $d_id, 
                     'd_id'=> $row['p_id']
                   ));
                       if($stmt->rowCount()>0){
                         echo 'inserted';
                       }else{
                        echo 'not_inserted';
                       }
             }
        }
  }
}elseif($do=='add-patientofdoctor'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $d_id=$_POST['d_id'];
        $name=$_POST['name'];
          //get P_id from DB to instest it to relationship between doctor and patient
          $stmt1=$con->prepare("SELECT * FROM PFE_DB.patients WHERE p_name=? LIMIT 1");
          $stmt1->execute(array($name));
          $row=$stmt1->fetch();
              if($stmt1->rowCount()>0){
                      //get P_id from DB to instest it to relationship between doctor and patient
                      $stmt1=$con->prepare("SELECT pOd_id FROM PFE_DB.patientofdoctor WHERE p_id=? AND D_id=?LIMIT 1");
                      $stmt1->execute(array($row['p_id'], $d_id));
                      $count=$stmt1->rowCount();
                      if($count> 0){
                        echo 'allredy_exist';
                      }else{
                         //insert relashin 
                          $stmt = $con->prepare("INSERT INTO PFE_DB.patientofdoctor(D_id , p_id) VALUES (:p_id, :d_id)");
                         $stmt->execute(array(
                         'p_id' => $d_id, 
                         'd_id'=> $row['p_id']
                          ));
                           if($stmt->rowCount()>0){
                             echo 'inserted';
                           }else{
                            echo 'not_inserted';
                           }

                      }
                 }
       
  }
}elseif ($do =='addPatientHistory') {
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $p_id        = $_POST['p_id'];
    $diseases    = $_POST['chronicDiseases'] ;
    $medications = $_POST['importantMedications'] ;
        $stmt=$con->prepare('INSERT INTO PFE_DB.patienthistory(p_id, d_id, chronicDiseases, importantMedications) VALUES (:p_id,:d_id, :diseases, :medications)');
        $stmt->execute(array(
        'p_id'         => $p_id,
        'd_id'         => $_SESSION['id'],
        'diseases'    =>$diseases,
        'medications' =>$medications ));
        if($stmt->rowCount()>0){
          echo 'history_inserted';
        }else{
          echo 'not_history_inserted';
        }
  }
}