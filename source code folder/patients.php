<?php
  session_start();
  if(isset($_SESSION['id'])){
    $pageTitle = 'Patients';
 	include 'init.php';
 	$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 	if($do=='manage'){ //start manage page 
 		     //get all doctors from table 
    	     $stmt = $con->prepare("SELECT * FROM PFE_DB.patients INNER JOIN PFE_DB.patientofdoctor
    	      WHERE patients.p_id=patientofdoctor.p_id AND patientofdoctor.D_id=? 
              ORDER BY patientofdoctor.pOd_id DESC ");
		      $stmt->execute(array($_SESSION['id']));
              $rows = $stmt->fetchAll();
        ?>
              <h1 class="text-center">My patients</h1>
     <div class="container">
        <div class="alert alert-success deleted-success hidden"></div>
        <div class="table-responsive">
            <table class="table table-bordered text-center main-table">
                <tr>
                    <td>Name</td>
                    <td>Age</td>
                    <td>Phone number</td>
                    <td>Adress</td>
                    <td>Control</td>
                </tr>
                <?php
                   foreach($rows as $row){
                    echo '<tr class="'.$row["pOd_id"].'">';
                             echo '<td>'.$row["p_name"].'</td>';
                             echo '<td>'. calculateAge($row["birth_date"]).'</td>';
                             echo '<td>'.$row["phone"].'</td>';
                             echo '<td>'.$row["adress"].'</td>';
                             echo '<td>
                                     <a href="?do=edit&p_id='.$row["p_id"].'" class="btn btn-success">
                                        <i class="fa fa-edit"></i> Edit</a>
                                     <a data-id="'.$row["pOd_id"].'" class="btn btn-danger confirm2">
                                         <i class="fa fa-close"></i> Delete</a>
                                     <a href="profile.php?p_id='.$row["p_id"].'" class="btn btn-info"/>
                                         <i class="fa fa-question-circle"></i> Move info</a>
                                     <a href="?do=prescribe&p_id='.$row["p_id"].'" class="btn btn-info"/>
                                         <i class="fa fa-pen-square"></i> Write prescription</a>
                                   </td';
                    echo '</tr>';

                   }
                ?>
            </table>
        </div>
    <button class="bg-blue bg-blue-h add-patient btn btn-primary"><i class="fa fa-plus"></i>Add new patient</button> 
     </div>
<!-- ========= start model to add new doctor=============== -->
<div class="modal modal-p" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="text-center title">Add new patient</h2>
      </div>
      <div class="modal-body" style="overflow: auto;">
            <div class="alert alert-success updated-success hidden">Successfully added</div>
            <div class="alert alert-danger nameError hidden"></div>
            <div class="alert alert-danger existError hidden position_relative">
              <div class="existError_p"></div> 
              <button  class="bg-blue bg-blue-h btn btn-primary btn_add">
                <i class="fa fa-plus"></i> Add patient</button>
            </div>
            <div class="alert alert-danger passwordError hidden"></div>
            <div class="alert alert-danger adressError hidden"></div>
            <div class="alert alert-danger birth_dateError hidden"></div>
            <div class="alert alert-danger phoneError hidden"></div>
                    <form class="addForm-p form-horizontal" action="" method="POST">
                      <input type="hidden" name="d_id" value="<?php echo $_SESSION['id']; ?>">
                <!-- Start Username Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 col-md-3 control-label ">Your name</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" name="name" class="name form-control"  autocomplete="off" placeholder="doctor's name to login" required="required" />
                        </div>
                    </div>
                        <!-- End Username Field -->
                        <!-- Start Password Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 col-md-3 control-label">Password</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="password" name="password" class="password form-control" autocomplete="new-password"  placeholder="password to login" required="required" />
                            <i class="fa fa-eye fa-2x show-pass"></i>
                        </div>
                    </div>
                        <!-- End Password Field -->
                        <!-- Start birth date Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 col-md-3 control-label">Birth date</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="date" name="birth_date"  class="birth_date form-control" placeholder="doctor's adress"  required="required" />
                            
                        </div>
                    </div>
                        <!-- End birth date Field -->
                        <!-- Start Office Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 col-md-3 control-label">Adress</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" name="adress"  class="adress form-control" placeholder="doctor's office" required="required" />
                        </div>
                    </div>
                        <!-- End Office Field -->
                        <!-- Start Phone Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 col-md-3 control-label">Phone number</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="tel" name="phone" class="phone form-control" placeholder="doctor's phone number"  required="required"/>
                        </div>
                    </div>
                        <!-- End Phone Field -->
                        <!-- Start Submit Field -->
                     <div class="modal-footer">
                            <button type="submit" class="btn btn-primary bg-blue bg-blue-h"><i class="fa fa-plus"></i> Add patient</button>
                            <button type="button" class="btn-close btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                        <!-- End Submit Field -->
            </form>
      </div>
    </div>
  </div>
</div>
         <!-- ========= end model to add new doctor =============== -->
<?php }elseif($do=='edit'){
        // Check if get request id is numeric & it's integer galue
        $p_id=isset($_GET['p_id']) && is_numeric($_GET['p_id']) ? intval($_GET['p_id']) : 0;
        // Select all data depend on this ID
        $stmt = $con->prepare("SELECT * FROM PFE_DB.patients WHERE p_id = ? LIMIT 1");
        $stmt->execute(array($p_id));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count>0){?>
         <h1 class="text-center">Edit patient</h1>
         <div class="container">
            <div class="alert alert-success updated-success hidden">Successfully updated</div>
            <div class="alert alert-danger nameError hidden"></div>
            <div class="alert alert-danger nameError1 hidden"></div>
            <div class="alert alert-danger adressError hidden"></div>
            <div class="alert alert-danger phoneError hidden"></div>
            <form class="p-editForm form-horizontal" action="" method="POST">
                <!-- Start Username Field -->
                <input type="hidden" name="p_id" value="<?php echo $p_id ?>" />
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label ">Patient name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="name" class="name name1 form-control" value="<?php echo $row['p_name'];?>" autocomplete="off" required="required" />
                        </div>
                    </div>
                        <!-- End Username Field -->
                        <!-- Start Phone Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Phone number</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="phone" value="<?php echo $row['phone'];?>" class="phone form-control" required="required" />
                        </div>
                    </div>
                        <!-- End Phone Field -->
                        <!-- Start adress Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Adress</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="adress" value="<?php echo $row['adress'];?>" class="adress form-control" required="required" />
                            
                        </div>
                    </div>
                        <!-- End Adress Field -->
                        <!-- Start Submit Field -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Save" class="btn btn-primary btn-lg bg-blue bg-blue-h" />
                        </div>
                    </div>
                        <!-- End Submit Field -->
            </form>
         </div>
<?php }else{
           echo 'bad'; 
        }
    }elseif($do =='more-info'){

    }elseif($do='prescribe'){
        $p_id=isset($_GET['p_id']) && is_numeric($_GET['p_id']) ? intval($_GET['p_id']) : 0;
        // Select the information of the patient
        $stmt = $con->prepare("SELECT * FROM PFE_DB.patients WHERE p_id = ? LIMIT 1");
        $stmt->execute(array($p_id));
        $row = $stmt->fetch(); 
        //select the information of the doctor
        $stmt = $con->prepare("SELECT * FROM PFE_DB.doctors WHERE D_id = ? LIMIT 1");
        $stmt->execute(array($_SESSION['id']));
        $row1 = $stmt->fetch(); 
         ?>
       <div class="container">
           <h1 class="title-prescribe text-center">prescribe page</h1>
           <div class="row plus-margin"> 
                <div class="col-sm-6">
                              <div class="alert alert-danger medicine-nameError hidden"></div>
                              <div class="alert alert-danger doseError hidden"></div>
                              <div class="alert alert-danger repeatedError hidden"></div>
                              <div class="alert alert-danger boxError hidden"></div>
                              <div class="alert alert-danger formError hidden"></div>
                              <div class="alert alert-danger timeError hidden"></div>
                    <form class="prescribe-form" action="" method="POST">
                      <input type="hidden" name="p_id" value="<?php echo $p_id ;?>">
                      <input type="hidden" name="d_id" value="<?php echo $_SESSION['id'] ;?>">
                        <!-- start name field -->
                        <div class="form-group ">
                        <label class="control-label ">medicine name</label>
                        <input class="form-control medicine-name" data-id="req" type="text" name="m-name" placeholder="Medicine name" autocomplete="off" />
                        <div class="m-resultRearch"></div>
                        </div>
                        <!-- end name field -->
                        <!-- start dose field -->
                        <div class="form-group ">
                        <label class="control-label ">dose</label>
                        <input class="form-control dose" data-id="req" type="number" name="dose" placeholder="Dose"  autocomplete="new-password" step="0.5" min="0"/>
                       </div>
                       <!-- end dose field -->
                          <!-- start Repeated field -->
                        <div class="form-group ">
                        <label class="control-label ">Repeated</label>
                        <input class="form-control repeated" data-id="req" type="number" name="repeated" placeholder="Repeated" 
                        min="0"/>
                       </div>
                       <!-- end Repeated field -->
                          <!-- start box field -->
                        <div class="form-group ">
                        <label class="control-label ">Box</label>
                        <input class="form-control box" data-id="req" type="number" name="box" placeholder="Box" 
                        min="0"/>
                       </div>
                       <!-- end box field -->
                       <!-- start form field -->
                        <div class=" form-group">
                        <label class="control-label ">Form</label>
                            <select name="form" class="form form-control form">
                            <option value="0">choose the form of medicine</option>
                            <option value="Troches">Troches</option>
                            <option value="Injection">Injection</option>
                            <option value="Liquid"> Liquid</option>
                            <option value="Topical Ointment">Topical Ointment</option>
                            <option value="Add-Water Powder">Add-Water Powder</option>
                        </select>
                       </div>
                       <!-- end form field -->
                       <!-- start time field -->
                        <div class="form-group ">
                        <label class="control-label ">Time</label>
                            <select name="time" class="form-control time">
                            <option value="0">choose time of use</option>
                            <option value="morning">morning</option>
                            <option value="before meal">before meal</option>
                            <option value="after meal">after meal</option>
                        </select>
                       </div>
                        <!-- end time field -->
                        <a href="#" class="btn btn-primary bg-blue-h bg-blue add-medicine"  >
                                   <i class="fa fa-plus"></i> add
                        </a>
                        <!-- <input type="submit" name="sub" value="save"> -->
                    </form>
                </div>
             <button data-id="<?php echo $row['p_id'] ?>" class="pull-right btn btn-primary bg-blue-h bg-blue save-prescribtion">save prescribtion</button>
                <div class="col-sm-6 prescription">
                    <div class="row">
                      <h4 class="text-center"><?php echo $row1['description'];?></h4>
                          <!-- doctor description -->
                        <div class="col-xs-6 col-sm-6  doctor-info">
                           <span><?php echo 'Dr '.$row1['D_name'];?></span>
                           <span><?php echo $row1['description'];?></span>
                        </div>
                          
                        <div class="pull-right"><?php echo  $row1['adress'].': '.date("d/m/Y");?></div>
                        <!-- patient description -->
                        <div class=" col-xs-6 col-sm-6  patient-info">
                           <span> Name:<?php echo ' '. $row['p_name'] ;?></span>
                            <span>Age: <?php echo ' '. calculateAge($row["birth_date"]) ;?></span>
                        </div>
                    </div>

                    <div class="medicine">
                      <h4 class="text-center">PRESCRIPTION</h4>
                      <ul class="list-unstyled medicine-list ">
                      </ul>
                    </div>
                </div>
           </div>
       </div>
<?php }

include $tpl . 'footer_end.php';
}else{
    header('Location: index.php');
    exit();
  }
?>