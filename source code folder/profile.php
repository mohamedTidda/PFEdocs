<?php
  session_start();
  if(isset($_SESSION['id'])){
    $pageTitle = 'profile';
  include 'init.php';
  $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

        $p_id=isset($_GET['p_id']) && is_numeric($_GET['p_id']) ? intval($_GET['p_id']) : 0;
        //get the information from DB about patient
         $stmt = $con->prepare("SELECT * FROM PFE_DB.patients WHERE p_id = ? LIMIT 1");
         $stmt->execute(array($p_id));
        $row = $stmt->fetch();
        ?>
    <h1 class="text-center">profile</h1>
    <div class="container">
      <?php 
        //chack iff there is relishin between doctor and patient 
         $stmt1 = $con->prepare("SELECT * FROM PFE_DB.patientofdoctor WHERE p_id = ? AND  D_id = ? LIMIT 1");
         $stmt1->execute(array($p_id, $_SESSION['id']));
         $r = $stmt1->fetch();
        if($stmt1->rowCount()>0){ ?>
           <button class="btn btn-danger pull-right confirm3" data-id="<?php echo $r["pOd_id"]; ?>">Remove</button>
        <?php }else{ ?>
             <button class="btn btn-primary bg-blue bg-blue-h pull-right add-">add to your patients</button>
        <?php }
      ?>
    </div>
           <div class="information block">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading text-center bg-blue">Information</div>
                <div class="panel-body">
                  <ul class="list-unstyled">
                      <li>
                        <i class="fa fa-user fa-fw"></i>
                        <span>Name</span>:<?php echo ' ' .$row['p_name'];?>
                    </li>
                      <li>
                        <i class="fa fa-calendar fa-fw"></i>
                        <span>Age</span>:<?php echo ' '.calculateAge($row["birth_date"])?>
                    </li>
                      <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <span>Phone number</span>:<?php echo ' '.$row['phone'];?>
                    </li>
                      <li>
                        <i class="fa fa-map-marker fa-fw"></i>
                        <span>Adress</span>: <?php echo ' '.$row['adress'];?>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
     </div>
     <div>
       <div class="container">
           <div class="panel panel-primary">
              <div class="panel-heading text-center bg-blue">Add history</div>
              <div class="panel-body">
                <div class="alert alert-success history-success hidden">Successfully added</div>
                <form class="historyForm form-horizontal" action="" method="POST">
                  <input type="hidden" name="p_id" value="<?php echo  $p_id ;?>">
                  <input type="hidden" name="d_id" value="<?php echo $_SESSION['id'] ; ?>">
                    <!-- Start Chronic diseases Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 col-md-3 control-label ">Chronic diseases</label>
                        <div class="col-sm-10 col-md-8">
                            <textarea type="text" name="chronicDiseases" class="chronicDiseases form-control"  autocomplete="off" placeholder=" Separated with (-) expmle: diseases1 - diseases2 - ..." /></textarea>
                        </div>
                    </div>
                    <!-- End Chronic diseases Field -->
                    <!-- Start Important medications Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 col-md-3 control-label ">Important medications</label>
                        <div class="col-sm-10 col-md-8">
                            <textarea type="text" name="importantMedications" class="importantMedications form-control"  autocomplete="off" placeholder=" Separated with (-) expmle: medication1 - medication2 - ..." /></textarea>
                        </div>
                    </div>
                    <!-- End Important medications Field -->
                    <!-- Start Submit Field -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-lg bg-blue bg-blue-h historyFormBtn" >Save</button>
                        </div>
                    </div>
                    <!-- End Submit Field -->
                </form>
              </div>
           </div>
       </div>
     </div>
     <div class="describe block">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading text-center bg-blue">All prescriptions</div>
                <div class="panel-body">
                   <?php
                      //get the information from DB about patient
                       $stmt1 = $con->prepare("SELECT * FROM PFE_DB.prescription WHERE p_id = ? ");
                       $stmt1->execute(array($p_id));
                       $rows1=$stmt1->fetchAll();
                          if($stmt1->rowCount() >0){
                                echo '<div class="row">';
                                    foreach ($rows1 as $row1) { 
                                       $stmt = $con->prepare("SELECT * FROM PFE_DB.doctors INNER JOIN PFE_DB.patients 
                                        WHERE patients.p_id = ? AND doctors.D_id=? ");
                                        $stmt->execute(array($p_id, $row1['d_id'] ));
                                        $rows=$stmt->fetchAll();
                                             if($stmt->rowCount()>0){
                                                  foreach ($rows as $row) {?>
                                                        <div class="col-sm-6 col-md-3 ">
                                                             <div class="description-list">
                                                               <h4 class="text-center"><?php echo $row['description'];?></h4>
                                                               <!-- doctor description -->
                                                                <span><?php echo 'Dr '.$row['D_name'];?></span>
                                                                 <span><?php echo $row['description'];?></span>
                                                             </div> 
                                                        </div>
                                                    <?php
                                                  }
                                             }
                                   }
                              echo '</div>';
                          }else{
                            echo 'there is no prescription ';
                          }
                    ?>
                  
                </div>
            </div>
        </div>
     </div>
<?php
include $tpl . 'footer_end.php';
}else{
    header('Location: index.php');
    exit();
  }
?>
