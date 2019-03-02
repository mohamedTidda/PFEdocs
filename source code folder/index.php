<?php
    session_start();
	$pageTitle ='Login';
    $nonavbar=$loginNav='';
	if (isset($_SESSION['id'])) {
		header('Location:'.$_SESSION['page'].'.php'); // Redirect To Dashboard Page
		exit();
	}
	  include 'init.php';
?> 
   <div class="main-background">
   	<div class="overlay">
   			</div>
		<div class="container text-center" >
			<div class="row">
				<div class="col-md-6">
					<form class="login login-form" action="" method="POST">
						<h3 class="text-center">Log in to your count</h3>
						<div class="alert alert-danger nameError hidden"></div>
						<div class="alert alert-danger passError hidden"></div>
						<div class="alert alert-danger typeError hidden"></div>
						<div class="alert alert-danger loginError hidden"></div>
                        <div class="control">
						<label class="control-label pull-left">Name</label>
						<input class="form-control user" data-id="req" type="text" name="user" placeholder="Username" autocomplete="off" required="required"/>
						</div>
						<div class="control">
						<label class="control-label pull-left">Password</label>
						<input class="form-control pass" data-id="req" type="password" name="pass" placeholder="Password" required="required" autocomplete="new-password"/>
					</div>
						<label class="control-label pull-left">Type</label>
						<select name="type" class="form-control selector" style="margin-bottom: 20px;">
							<option value="0">choose you count's type</option>
							<option value="doctors">Doctor</option>
							<option value="pharmacy">Pharmacy</option>
							<option value="patients">Patient</option>
						</select>
						<input class="btn btn-primary btn-block  bg-blue-h bg-blue" type="submit" value="Login" />
			        </form>
				</div>
				<div class="col-md-6">
					<div class="descrpition">
					<h2 class="text-center">Welcome to NHS Southwark CCG</h2>
					<p>
						NHS Southwark Clinical Commissioning Group (CCG) is made up of all ​GP surgeries in the local area. We are responsible for planning, monitoring and paying for most of the health services you will receive as a resident of Southwark. Our job is to make the most effective use we can of the money we have been allocated and make sure that it is being used to best meet your needs.
					</p>
					 </div>
				</div>
			</div>
		</div> 

  </div>
<?php
 include $tpl . 'footer_end.php';
 ?>