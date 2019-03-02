<?php
  session_start();
  if(isset($_SESSION['id'])){
    $pageTitle = 'Doctors';
 	include 'init.php';
 	$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 	if($do=='manage'){ //start manage page 

 	}elseif($do=='edit'){ //edit doctors page
    	// Check if get request userid is numeric & get gts gnteger galue
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
  }
?>
