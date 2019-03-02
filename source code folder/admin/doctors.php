<?php
  session_start();
  if (isset($_SESSION['ID'])){
    $pageTitle = 'Doctors';
 	include 'init.php';

	$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    
    
    if($do=='manage'){ //start manage page 
        //get all doctors from table 
    	$stmt = $con->prepare("SELECT * FROM PFE_DB.doctors WHERE groupID != 1");
		$stmt->execute();
        $rows = $stmt->fetchAll();
    	?>
     <h1 class="text-center">Manage doctors</h1>
     <div class="container">
     	<div class="alert alert-success deleted-success hidden"></div>
     	<div class="table-responsive">
     		<table class="table table-bordered text-center main-table">
     			<tr>
     				<td>#ID</td>
     				<td>Doctor's name</td>
     				<td>Age</td>
     				<td>Adress</td>
     				<td>Office</td>
     				<td>Phone number</td>
     				<td>Control</td>
     			</tr>
     			<?php
     			   foreach($rows as $row){
     			   	echo '<tr class="'.$row["D_id"].'">';
                             echo '<td>'.$row["D_id"].'</td>';
                             echo '<td>'.$row["D_name"].'</td>';
                             echo '<td>'.$row["age"].'</td>';
                             echo '<td>'.$row["adress"].'</td>';
                             echo '<td>'.$row["office"].'</td>';
                             echo '<td>'.$row["phone"].'</td>';
                             echo '<td>
                                     <a href="?do=edit&D_id='.$row["D_id"].'" class="btn btn-success">
                                     <i class="fa fa-edit"></i> Edit</a>
                                     <a data-id="'.$row["D_id"].'" class="btn btn-danger confirm">
                                     <i class="fa fa-close"></i> Delete</a>
                                   </td';
     			   	echo '</tr>';

     			   }
     			?>
     		</table>
     	</div>
     	<button class="bg-blue bg-blue-h add-doctor btn btn-primary"><i class="fa fa-plus"></i> New doctor</button> 
     </div>
<!-- ========= start model to add new doctor=============== -->
<div class="modal modal-d" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="text-center title">Add new doctor</h2>
      </div>
      <div class="modal-body" style="overflow: auto;">
      	    <div class="alert alert-success updated-success hidden">Successfully added</div>
    	 	<div class="alert alert-danger nameError hidden"></div>
    	 	<div class="alert alert-danger passwordError hidden"></div>
    	 	<div class="alert alert-danger adressError hidden"></div>
    	 	<div class="alert alert-danger officeError hidden"></div>
    	 	<div class="alert alert-danger phoneError hidden"></div>
      	    		<form class="addForm form-horizontal" action="" method="POST">
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
							<input type="password" name="newpassword" class=" password form-control" autocomplete="new-password"  placeholder="password to login" required="required" />
							<i class="fa fa-eye fa-2x show-pass"></i>
						</div>
					</div>
						<!-- End Password Field -->
           				<!-- Start Email Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 col-md-3 control-label">Adress</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="adress"  class="adress form-control" placeholder="doctor's adress"  required="required" />
							
						</div>
					</div>
						<!-- End Adress Field -->
           				<!-- Start Office Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 col-md-3 control-label">Office</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="office"  class="office form-control" placeholder="doctor's office" required="required" />
						</div>
					</div>
						<!-- End Office Field -->
           				<!-- Start Phone Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 col-md-3 control-label">Phone number</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="phone" class="phone form-control" placeholder="doctor's phone number"  required="required"/>
						</div>
					</div>
						<!-- End Phone Field -->
						<!-- Start Submit Field -->
					 <div class="modal-footer">
       						<button type="submit" class="btn btn-primary bg-blue bg-blue-h"><i class="fa fa-plus"></i> Add doctor</button>
       						<button type="button" class="btn-close btn btn-secondary" data-dismiss="modal">Close</button>
     				</div>
						<!-- End Submit Field -->
    		</form>
      </div>
    </div>
  </div>
</div>
		 <!-- ========= end model to add new doctor =============== -->
     <?Php  
    }elseif($do=='edit'){ //edit doctors page
    	// Check if get request id is numeric & it's integer galue
     $D_id=isset($_GET['D_id']) && is_numeric($_GET['D_id']) ? intval($_GET['D_id']) : 0;
     // Select all data depend dn this ID
     $stmt = $con->prepare("SELECT * FROM PFE_DB.doctors WHERE D_id = ? LIMIT 1");
        $stmt->execute(array($D_id));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		// If there's such ID show the form
       if($count>0){
          ?>
    	 <h1 class="text-center">Edit doctor</h1>
    	 <div class="container">
    	 	<div class="alert alert-success updated-success hidden">Successfully updated</div>
    	 	<div class="alert alert-danger nameError hidden"></div>
    	 	<div class="alert alert-danger nameError1 hidden"></div>
    	 	<div class="alert alert-danger adressError hidden"></div>
    	 	<div class="alert alert-danger officeError hidden"></div>
    	 	<div class="alert alert-danger phoneError hidden"></div>
    		<form class="editForm form-horizontal" action="" method="POST">
    			<!-- Start Username Field -->
    			<input type="hidden" name="D_id" value="<?php echo $D_id ?>" />
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label ">Your name</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="name" class="name name1 form-control" value="<?php echo $row['D_name'];?>" autocomplete="off" required="required" />
						</div>
					</div>
						<!-- End Username Field -->
						<!-- Start Password Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10 col-md-6">
							<input type="hidden" name="oldpassword" value="<?php echo $row['D_password']; ?>" />
							<input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave blank if you dont want to change" />
						</div>
					</div>
						<!-- End Password Field -->
           				<!-- Start Email Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Adress</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="adress" value="<?php echo $row['adress'];?>" class="adress form-control" required="required" />
							
						</div>
					</div>
						<!-- End Adress Field -->
           				<!-- Start Office Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Office</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="office" value="<?php echo $row['office']; ?>" class="office form-control" required="required"/>
						</div>
					</div>
						<!-- End Office Field -->
           				<!-- Start Phone Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Phone number</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="phone" value="<?php echo $row['phone'];?>" class="phone form-control" required="required" />
						</div>
					</div>
						<!-- End Phone Field -->
						<!-- Start Submit Field -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="Save" class="btn btn-primary btn-lg bg-blue bg-blue-h" />
						</div>
					</div>
						<!-- End Submit Field -->
    		</form>
    	 </div>
<?php   }else{
       	  echo 'no such id';
        }
   //end edit page
   }
     include $tpl . 'footer_end.php';
 }else{
 	header('Location: index.php');
    exit();
 } ?>