<?php
   session_start();
  if(isset($_SESSION['ID'])){
     $pageTitle = 'Pharmacists';
 	 include 'init.php';
     $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
     
      if($do=='manage'){
	                 //get all doctors from table 
	    	$stmt = $con->prepare("SELECT * FROM PFE_DB.pharmacy");
			$stmt->execute();
	        $rows = $stmt->fetchAll();
	    	?>
	     <h1 class="text-center">Manage Pharmacists</h1>
	     <div class="container">
	     	<div class="alert alert-success deleted-success hidden"></div>
	     	<div class="table-responsive">
	     		<table class="table table-bordered text-center main-table">
	     			<tr>
	     				<td>#ID</td>
	     				<td>pharmacy's name</td>
	     				<td>Adress</td>
	     				<td>Phone number</td>
	     				<td>Owner</td>
	     				<td>Control</td>
	     			</tr>
	     			<?php
	     			   foreach($rows as $row){
	     			   	echo'<tr class="'.$row["ph_id"].'">';
	                             echo '<td>'.$row["ph_id"].'</td>';
	                             echo '<td>'.$row["ph_name"].'</td>';
	                             echo '<td>'.$row["adress"].'</td>';
	                             echo '<td>'.$row["phone"].'</td>';
	                             echo '<td>'.$row["owner_name"].'</td>';
	                             echo '<td>
	                                     <a href="?do=edit&ph_id='.$row["ph_id"].'" class="btn btn-success">
	                                     <i class="fa fa-edit"></i> Edit</a>
	                                     <a data-id="'.$row["ph_id"].'" class="btn btn-danger confirm1">
	                                     <i class="fa fa-close"></i> Delete</a>
	                                   </td';
	     			   	echo '</tr>';

	     			   }
	     			?>
	     		</table>
	     	</div>
	     	<button class="bg-blue bg-blue-h add-ph btn btn-primary"><i class="fa fa-plus"></i> New pharmacy</button> 
	     </div>

<!-- ========= start model to add new doctor=============== -->
<div class="modal modal-ph" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="text-center title">Add new pharmacy</h2>
      </div>
      <div class="modal-body" style="overflow: auto;">
      	    <div class="alert alert-success updated-success hidden">Successfully added</div>
    	 	<div class="alert alert-danger nameError hidden"></div>
    	 	<div class="alert alert-danger passwordError hidden"></div>
    	 	<div class="alert alert-danger adressError hidden"></div>
    	 	<div class="alert alert-danger officeError hidden"></div>
    	 	<div class="alert alert-danger phoneError hidden"></div>
      	    		<form class="addForm-ph form-horizontal" action="" method="POST">
    			<!-- Start Username Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 col-md-3 control-label ">Pharmacy's name</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="name" class="name form-control"  autocomplete="off" placeholder="pharmacy's name to login" required="required" />
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
							<input type="text" name="adress"  class="adress form-control" placeholder="pharmacy's adress"  required="required" />
							
						</div>
					</div>
						<!-- End Adress Field -->
           				<!-- Start Phone Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 col-md-3 control-label">Phone number</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="phone" class="phone form-control" placeholder="pharmacy's phone number"  required="required"/>
						</div>
					</div>
						<!-- End Phone Field -->
           				<!-- Start Office Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 col-md-3 control-label">Owner's name</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="owner"  class="office form-control" placeholder="pharmacy's owner" required="required" />
						</div>
					</div>
						<!-- End Office Field -->
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
	       <?php  
        }elseif($do=='edit'){
        	    // Check if get request userid is numeric & get gts gnteger galue
                $ph_id=isset($_GET['ph_id']) && is_numeric($_GET['ph_id']) ? intval($_GET['ph_id']) : 0;

			     // Select all data depend dn this ID
			    $stmt = $con->prepare("SELECT * FROM PFE_DB.pharmacy WHERE ph_id = ? LIMIT 1");
			    $stmt->execute(array($ph_id));
				$row = $stmt->fetch();
				$count = $stmt->rowCount();
				// If there's such ID show the form
				if($count>0){ ?>
                    <h1 class="text-center">Edit pharmacy</h1>
    	            <div class="container">
		    	 	<div class="alert alert-success updated-success hidden">Successfully updated</div>
		    	 	<div class="alert alert-danger nameError hidden"></div>
		    	 	<div class="alert alert-danger nameError1 hidden"></div>
		    	 	<div class="alert alert-danger adressError hidden"></div>
		    	 	<div class="alert alert-danger officeError hidden"></div>
		    	 	<div class="alert alert-danger phoneError hidden"></div>
    		<form class="ph-editForm form-horizontal" action="" method="POST">
    			<!-- Start Username Field -->
    			<input type="hidden" name="ph_id" value="<?php echo $ph_id ?>" />
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label ">pharmacy's name</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="name" class="name form-control" value="<?php echo $row['ph_name'];?>" autocomplete="off" required="required" />
						</div>
					</div>
						<!-- End Username Field -->
						<!-- Start Password Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10 col-md-6">
							<input type="hidden" name="oldpassword" value="<?php echo $row['ph_password']; ?>" />
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
           				<!-- Start Phone Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Phone number</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="phone" value="<?php echo $row['phone'];?>" class="phone form-control" required="required" />
						</div>
					</div>
						<!-- End Phone Field -->
           				<!-- Start Office Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Owner</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="owner" value="<?php echo $row['owner_name']; ?>" class="office form-control" required="required"/>
						</div>
					</div>
						<!-- End Office Field -->
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
					echo 'no such id like these';
				}
        }
     include $tpl .'footer_end.php';
   }else{
 	 header('Location: index.php');
     exit();
   } ?>