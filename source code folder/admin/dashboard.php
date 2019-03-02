<?php
 session_start();
 if(isset($_SESSION['ID'])){
 	$pageTitle = 'Dashboard';
 	include 'init.php';
?>
   <div class="container text-center home-stats">
     <h1 class="">Dashboard</h1>
   	 <div class="row">
   	 	<div class="col-md-3">
   	 		<div class="stat st-doctor">
               <i class="fa fa-user-md"></i>
               <div class="info"> 
                   Total Doctors
                   <span><a href="doctors.php"><?php echo countItems("D_id","doctors"); ?></a></span>
               </div>
   	 		</div>
   	 	</div>
   	 	<div class="col-md-3">
   	 		<div class="stat st-pharmacy">
                <i class="fa fa-medkit"></i>
                <div class="info"> 
      	 			  Total Pharmacists
      	 			  <span><a href="pharmacists.php"><?php echo countItems("ph_id","pharmacy"); ?></a></span>
      	 		 </div>
            </div>
   	 	</div>
   	 	<div class="col-md-3">
   	 		<div class="stat st-patient">
                  <i class="fa fa-medkit"></i>
                  <div class="info"> 
   	 			       Total Patients
   	 			       <span><a href="patients.php"><?php echo countItems("p_id","patients"); ?></a></span>
   	 		      </div>
            </div>
   	 	</div>
   	 	<div class="col-md-3">
   	 		<div class="stat st-medication">
                <i class="fa fa-medkit"></i>
                <div class="info"> 
   	 			      Statistics
   	 			       <span><?php echo countItems("m_id","medicine"); ?></span>
   	 		   </div>
            </div>   
   	 	</div>
   	 </div>
   </div>
   <div class="container latest"> 
   	 <div class="row">
   	 	<div class="col-sm-6">
   	 		<div class="panel panel-default">
   	 			<div class="panel-heading">
   	 				<i class="fa fa-user-md fa-2x"></i> Doctors
   	 			</div>
   	 			<div class="panel-body">
   	 				test
   	 			</div>
   	 		</div>
   	 	</div>
   	 	<div class="col-sm-6">
   	 		<div class="panel panel-default">
   	 			<div class="panel-heading">
   	 				<i class="fa fa-medkit fa-2x"></i> Pharmacists
   	 			</div>
   	 			<div class="panel-body">
   	 				test
   	 			</div>
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