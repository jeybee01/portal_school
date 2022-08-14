<?php 
  include 'php/functions.php';
   if(!isset($info)){
    echo "<script>window.history.back();</script>";
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
          <div class="back-box"><a class="btn btn-danger" href="../student/index.php"> << Back</a> </div>
         <h2>Add Student</h2>
         <h4>Students Records</h4>
          
        </div>
      </div>
  <!--start here -->



  <section class="center-text well">
    
    <div class="login-form box-center">

        <div class="content-container">
          <form method="POsT" action="php/add_student.php">
           <h1>Add Student to your Class (<?=$class->get('short')?>)</h1>
           <hr>
            <div class="form-group">
                <label for="fullname">FullName</label>
                <input type="text" name="fullname" class="form-control"  placeholder="Enter fullname" required autofocus>
            </div>
             <divclass="form-group">
                <label for="reg_num">Registration Number</label>
                <input type="text" name="reg_num" class="form-control"  placeholder="Enter Registration Number" required>
            </div>
             <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control"  placeholder="Enter Phone Number" required>
            </div>
             <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"  placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select required name="gender" class="form-control" >
                  <option value="1">Male</option>
                   <option value="2">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input type="date" name="dob" class="form-control"  placeholder="Enter Date Of Birth" max="<?=date('Y') - 1?>-01-01" required>
            </div>
            <div class="form-group">
                <label for="state">State of Origin</label>
                <input type="text" name="state" class="form-control"  placeholder="Enter State of Origin" required>
            </div>
            
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Save</button>
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
$(document).ready(function(){
  //inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
      $('.alert').hide();
    })
});
</script>
</body>
</html>
