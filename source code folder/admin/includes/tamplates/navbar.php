<?php 
?>
<nav class="navbar navbar-inverse bg-blue">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand bg-blue-h" href="dashboard.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a class="bg-blue-h" href="doctors.php">Doctors</a></li>
        <li><a class="bg-blue-h" href="pharmacists.php">Pharmacists</a></li>
        <li><a class="bg-blue-h" href="patients.php">Patients</a></li>
        <li><a class="bg-blue-h" href="mdications.php">Medications</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="bg-blue-f dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../index.php">Visit my count</a></li>
            <li><a href="doctors.php?do=edit&D_id=<?php echo $_SESSION['ID'] ?>">Edit Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>