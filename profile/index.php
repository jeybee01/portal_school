<?php 
 include '../functions.php';
 $_SESSION['location'] = 'profile';
if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $image = ($_SESSION['pic'] == '') ? 'icdm.jpg' : $_SESSION['pic'];

 if($_SESSION['type'] == '2'){
   $user = getId();
    $sql = "SELECT class,session FROM class_students WHERE student = '$user' ORDER BY id DESC";
    $run = $db->query($sql);
   $info = $run->fetch_assoc();          
   $class_id = isset($info['class']) ? $info['class'] : '';
   $class = '';  
   if(!empty($class_id)){
     include '../_classes/Classes.php';
     $class_obj = new Classes($class_id);
     $class = $class_obj->get('short');
   }
 }
 ?>
 <!DOCTYPE html>
<html>
<head>
  <title>portal</title>
  <link rel="stylesheet" type="text/css" href="../datatable/dataTable.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">

</head>

<body>
<section class="main-section">
  <!--side-nav start here -->
    <?php include '../includes/menu.php'?>
  <!--side-nav End here -->

  <!--small screen side-nav start here -->
    <?php include '../includes/header.php'?>

  <!--small screen side-nav end here -->

   <!--wrapper start here -->
  <div class="wrapper">
  <div class="main-nav">
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header" id="menu-box">
    <span class="navbar-brand" id="menu-btn" style="display: ;" onclick="openNav()">Menu</span>
  </div>
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="color: #235a81;">Admin Dashboard</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#" style="color: #235a81;"><span class="glyphicon " ></span> Welcome Admin!</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  </div>

  <div class="main-content">
    <div class="container-fluid">
  <!--container-fluid start here -->

      <div class="container width-80">
        <div class="row ">
         <h2> Admin Profile</h2>
          
        </div>
      </div>
  <!--start here -->

   <section class="center-text well">
    <div class="login-form box-center">           
   <ul class="tab">
  <li><a href="#" class="tablinks " onclick="openCity(event, 'profile')">Profile</a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'eProfile')">Edit Profile</a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'password')">Change Password</a></li>
</ul>

<div id="profile" class="tabcontent active-box">
      <div class="row">
   <h3 style="text-align: center;" >Admin Records</h3>
      <div class="col-md-6">
                   <div class="img-card" style="width: 100px; height: 100px;">
                 <img src="../images/logo.jpg" alt="Profile-pics">
            </div>
      </div>
     <div class="col-md-6">

              <div class="info-card"  >
                <p><strong> Fullname:</strong><br> <?=$_SESSION['name']?></p>
                <?php
                  if($_SESSION['type'] == '2'){
                    ?>
                  <p><strong> Registration Number:</strong><br> <?=$_SESSION['reg_num']?></p>
                  <p><strong> Class:<?=$class?></p>
                  <?php } ?>
                   <?php
                  if($_SESSION['type'] == '1'){
                    ?>
                  <p><strong> Id Number:</strong><br> <?=$_SESSION['reg_num']?></p>
                  <p><strong> Qualification:</strong><br> <?=$_SESSION['qualification']?></p>
                  <?php } ?>
                  <p><strong> Email:</strong><br> <?=$_SESSION['email']?></p>
                  <p><strong> Phone Number:</strong><br> <?=$_SESSION['phone']?></p>
                  <p><strong> State:</strong><br> <?=$_SESSION['state']?></p>
                  <p><strong> Gender:</strong><br> <?=($_SESSION['gender'] == '1') ? 'Male' : 'Female'?></p>
                  
              </div>
            </div>
        
      </div>
</div>

<div id="eProfile" class="tabcontent">
              <div id="card-edit" class="row">
                 <form method="POST" action="profile.php">
                <h3 style="text-align: center;" >Edit profile</h3>

                <div class="form-group">
          <label for="fullname"><span class="glyphicon glyphicon-envelope"></span> Fullname</label>
          <input type="text" name="fullname" class="form-control"  value="<?=$_SESSION['name']?>" autofocus>
          <?php 
                   if(isset($_SESSION['errors']['fullname'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['fullname']?></p>
                   <?php } ?>
        </div>


          <div class="form-group">
          <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
          <input type="text" class="form-control" name="email" value="<?=$_SESSION['email']?>">
           <?php 
                   if(isset($_SESSION['errors']['email'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['email']?></p>
                   <?php } ?>

        </div>
      
      <div class="form-group">
          <label for="phone"><span class="glyphicon glyphicon-envelope"></span> Phone</label>
          <input type="text" name="phone" class="form-control"  value="<?=$_SESSION['phone']?>">
                  <?php 
                   if(isset($_SESSION['errors']['number'])){
                     ?>
                    <p style="color:red;text-align: left;"><?=$_SESSION['errors']['number']?></p>
                   <?php } ?>
        </div>
                 
              
                <div class="form-group">
          <label for="state"><span class="glyphicon glyphicon-envelope"></span> State of Origin</label>
          <input type="text" name="state" class="form-control"  value="<?=$_SESSION['state']?>" >
                   <?php
                    if(isset($_SESSION['errors']['state'])){
                      ?>
                      <p><?=$_SESSION['errors']['state']?></p>
                    <?php } ?>
        </div>
                

                <?php
                 if($_SESSION['type'] == '0'){
                   ?>
                   <div class="form-group">
                  <label for="fees"> <span class="glyphicon glyphicon-envelope"></span> School Fees</label>
                  <input type="text" name="fees" class="form-control" value="<?=$_SESSION['fees']?>" >
                      <?php
                    if(isset($_SESSION['errors']['fees'])){
                      ?>
                      <p><?=$_SESSION['errors']['fees']?></p>
                    <?php } ?>
                </div>
                 <?php } ?>

                 <div class="form-group">
          <label for="gender"><span class="glyphicon glyphicon-envelope"></span> Gender</label>
           <select class="form-control"  name="gender">
                  <option <?=($_SESSION['gender'] == '1') ? 'selected' : ''?> value="1">Male</option>
                   <option <?=($_SESSION['gender'] == '2') ? 'selected' : ''?> value="2">Female</option>
                </select>
            <?php
                    if(isset($_SESSION['errors']['gender'])){
                      ?>
                      <p><?=$_SESSION['errors']['gender']?></p>
                    <?php } ?>
        </div>
                 

                <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
                </div>
              </form>
            </div>
</div>

<div id="password" class="tabcontent">
              <div id="card-edit" class="row">
                <h3 style="text-align: center;" >Change Password</h3>

                 <form method="POST" action="profile.php">

                 <div class="form-group">
                  <label for="old_password">old Password</label>
                  <input type="Password" name="old_password" class="form-control">
                      <?php
                    if(isset($_SESSION['errors']['old_password'])){
                      ?>
                      <p><?=$_SESSION['errors']['old_password']?></p>
                    <?php } ?>
                </div>
                 <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input type="Password" name="new_password" class="form-control">
                      <?php
                    if(isset($_SESSION['errors']['new_password'])){
                      ?>
                      <p><?=$_SESSION['errors']['new_password']?></p>
                    <?php } ?>
                </div>
                 <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="Password" name="confirm_password" class="form-control">
                      <?php
                    if(isset($_SESSION['errors']['confirm_password'])){
                      ?>
                      <p><?=$_SESSION['errors']['confirm_password']?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
                </div>
              </form>
            </div>
</div>
</div>
</section>
       
  <!--container-fluid end here -->
  </div>
  </div>
  <!--wrapper end here -->
</section>
<!--for table extra functionality -->
  <script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../datatable/jquery.dataTables.min.js"></script>
<script src="../datatable/dataTable.bootstrap.min.js"></script>
<script src="../bootstrap/js/main.js"></script>
<!-- generate datatable on our table -->

  <script>

</script>
</body>
</html>