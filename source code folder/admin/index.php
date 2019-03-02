<?php
    session_start();
	$pageTitle = 'Login';
    $nonavbar='';
	if (isset($_SESSION['ID'])) {
		header('Location: dashboard.php'); // Redirect To Dashboard Page
		exit();
	}
	include 'init.php';

 
	//check if user coming from form
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$hashedPass = sha1($password);
		// Check If The User Exist In Database
		$stmt = $con->prepare("SELECT D_id, D_name, D_password FROM PFE_DB.doctors WHERE D_name = ? AND D_password = ? AND groupID = 1 LIMIT 1");
        $stmt->execute(array($username, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// If Count > 0 This Mean The Database Contain Record About This Username
			if ($count > 0) {
				$_SESSION['username'] = $username; // Register Session Name
				$_SESSION['ID'] = $row['D_id']; // Register Session ID
				header('Location: dashboard.php'); // Redirect To Dashboard Page
				exit();
			}


	}
?>
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<h4 class="text-center">Admin Login</h4>
		<input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off" />
		<input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password" />
		<input class="btn btn-primary btn-block" type="submit" value="Login" />
	</form>

<?php include $tpl . 'footer_end.php';?>