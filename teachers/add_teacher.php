<?php 
  include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
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

  <!--side-nav end here -->
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
      <li><a href="#"><span class="glyphicon " ></span style="color: #235a81;"> Welcome Admin!</a></li>
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
          <div class="back-box"><a class="btn btn-danger" href="../teachers/"> << Back</a> </div>
         <h2>Add </h2>
         <h4>Teachers Records</h4>
          
        </div>
      </div>
  <!--start here -->


  <section class="center-text well">
    
    <div class="login-form box-center">
      <?php 

        if(isset($_SESSION['prompt'])) {
          showPrompt();
        }

        if(isset($_SESSION['errprompt'])) {
          showError();
        }

      ?>
      <form action="php/add_teacher.php" method="POST">

        <div class="form-group">
          <label for="fullname"><span class="glyphicon glyphicon-envelope"></span> Fullname</label>
          <input type="text" name="fullname" class="form-control"  placeholder="Enter Your fullname" required autofocus>
          <?php 
                   if(isset($_SESSION['errors']['fullname'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['fullname']?></p>
                   <?php } ?>
        </div>
        
        <div class="form-group">
          <label for="id_number"><span class="glyphicon glyphicon-envelope"></span> Id Number</label>
          <input type="text" name="id_number" class="form-control"  placeholder="Enter Your fullname" required>
           <?php 
                   if(isset($_SESSION['errors']['id_number'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['id_number']?></p>
           <?php } ?>
        </div>

       <div class="form-group">
          <label for="phone"><span class="glyphicon glyphicon-envelope"></span> Phone</label>
          <input type="number" name="phone" class="form-control"  placeholder="Enter Your fullname" required>
                  <?php 
                   if(isset($_SESSION['errors']['number'])){
                     ?>
                    <p style="color:red;text-align: left;"><?=$_SESSION['errors']['number']?></p>
                   <?php } ?>
        </div>

        <div class="form-group">
          <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
          <input type="text" class="form-control" name="email" placeholder="Enter Your Email" required>
           <?php 
                   if(isset($_SESSION['errors']['email'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['email']?></p>
                   <?php } ?>

        </div>

                <div class="form-group">
          <label for="gender"><span class="glyphicon glyphicon-envelope"></span> Gender</label>
           <select class="form-control" required name="gender">
                  <option value="1">Male</option>
                   <option value="2">Female</option>
                </select>
           <?php 
                   if(isset($_SESSION['errors']['gender'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['gender']?></p>
                   <?php }  ?>
        </div>

               <div class="form-group">
          <label for="qualification"><span class="glyphicon glyphicon-envelope"></span> Qualification</label>
          <input type="text" name="qualification" class="form-control"  placeholder="Enter Your Qualification" required>
                  <?php 
                   if(isset($_SESSION['errors']['qualification'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['qualification']?></p>
                   <?php } ?>
        </div>

                       <div class="form-group">
          <label for="state"><span class="glyphicon glyphicon-envelope"></span> State of Origin</label>
          <input type="text" name="state" class="form-control"  placeholder="Enter Your State of Origin" required>
                   <?php 
                   if(isset($_SESSION['errors']['state'])){
                     ?>
                    <p style="color:red;text-align: left;"> <?=$_SESSION['errors']['state']?></p>
                   <?php } ?>
        </div>

        <input class="btn btn-primary" type="submit" name="submit">

      </form>
          <?php unset($_SESSION['errors']);?>

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

</body>
</html>
