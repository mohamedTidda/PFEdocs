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
                               foreach ($rows1 as $row1) {
                                  //get the information from DB about patient
                                $stmt = $con->prepare("SELECT * FROM PFE_DB.mdicines_described WHERE prescription_id = ? ");
                                $stmt->execute(array($row1['id']));
                                $rows=$stmt->fetchAll();
                                  if($stmt->rowCount() > 0){
                                     foreach ($rows as $row) {
                                       echo $row['name'].'<br>';
                                     }
                                  }
                               }
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
