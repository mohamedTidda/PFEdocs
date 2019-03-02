<?php 

      $stmt = $con->prepare("SELECT * FROM socialnetwork. users  WHERE userid = ? ");
      $stmt->execute(array( $_SESSION['id']));
      $filed= $stmt->fetch();
      $count_row= $stmt->rowCount();
      if($count_row>0){
      $name=$filed['name'];
      $image_profile=$filed['profileimage'];
      

      }else{
          echo $stmt->errorInfo();
        }
       

?>
<!--<div class="area"></div> -->
<nav class="main-menu ">
  <!-- Sidebar user panel -->
   <div class="user-panel">
    <div class="pull-left image">
      <?php 
            $img_dir='';
         if($image_profile!=''){
             $img_dir= 'layout/image/profile_img/'.$image_profile;

          }else{
            $img_dir="layout/image/avatar.png";
          }
       ?>
       <img src="<?php echo $img_dir?>"  class="img-circle"  alt="user image">
    </div>
     <div class="pull-left info">
          <p><?php echo $name; ?></p>
          <a href="profile.php">Online <i class=" sid-fa fa fa-circle fa-s"></i></a>
     </div>
   
  </div> 
            <ul>
                <li>
                    <a href="profile.php">
                        <i class=" fa fa-user-o fa-s"></i>
                        <span class="nav-text">
                            Profile
                        </span>
                    </a>
                  
                </li>
                <li class=" ">
                    <a href="index.php">
                        <i class="fa fa-newspaper-o fa-2x fa-s "></i>
                        <span class="nav-text">
                          Home
                        </span>
                    </a>
                    
                </li>
                <li class=" ">
                    <a href="messages.php">
                       <i class="fa fa-wechat fa-2x fa-s"></i>
                        <span class="nav-text">
                            Messages
                        </span>
                    </a>
                    
                </li>
                <li class=" ">
                    <a href="friends.php">
                       <i class="fa fa-users fa-2x fa-s"></i>
                        <span class="nav-text">
                            Friends
                        </span>
                    </a>
                   
                </li>
                <li>
                    <a href="friends-request.php">
                        <i class="fa fa-users fa-2x fa-s"></i>
                        <span class="nav-text">
                            Friends request
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file-o fa-2x fa-s"></i>
                        <span class="nav-text">
                            Pages
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                       <i class="fa fa-calendar fa-2x fa-s"></i>
                        <span class="nav-text">
                            Events
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                        <i class="fa  fa-file-photo-o fa-2x fa-s"></i>
                        <span class="nav-text">
                            Photos
                        </span>
                    </a>
                </li>
               <li>
                    <a href="settings.php">
                       <i class="fa fa-info fa-2x fa-s"></i>
                        <span class="nav-text">
                            Settings
                        </span>
                    </a>
                </li> 
            </ul>

            <ul class="logout">
                <li>
                   <a href="logout.php">
                         <i class="fa fa-power-off fa-2x fa-s"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>  
            </ul>
        </nav> 