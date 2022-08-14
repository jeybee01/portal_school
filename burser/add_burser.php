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
<style type="text/css">
    .acolor{
    color: #333;
  }
  .mr{
    margin-right: 20px;
  }
  section .wrapper{
    overflow: auto;
  }
  .center-text{
    width: 60%;
    margin: auto;
  }
 
  .category-box{
    display: flex;
    justify-content: normal;
    align-items: center;
  }
  .subject-box{
    width: 20px;
  }
  .-mar20{
    margin-left: 10px;
  }
  .back-box .btn{
    position: fixed;
    top: 65px;
    left: 22%;
    z-index: 999;
  }
</style>
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
          <div class="back-box"><a class="btn btn-danger" href="../burser/index.php"> << Back</a> </div>
         <h2>Add Burser</h2>
         <h4>Bursers Records</h4>
          
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

          <form method="POsT" action="php/add_burser.php">
           <div class="form-group">
          <label for="fullname"><span class="glyphicon glyphicon-envelope"></span> Fullname</label>
          <input type="text" name="fullname" class="form-control"  placeholder="Enter Your fullname" required autofocus>
        </div>
        
        <div class="form-group">
          <label for="phone"><span class="glyphicon glyphicon-envelope"></span> Phone</label>
          <input type="number" name="phone" class="form-control"  placeholder="Enter Your fullname" required>
        </div>
      
           <div class="form-group">
          <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
          <input type="text" class="form-control" name="email" placeholder="Enter Your Email" required>
        </div>  
             

                <div class="form-group">
          <label for="gender"><span class="glyphicon glyphicon-envelope"></span> Gender</label>
           <select class="form-control" required name="gender">
                  <option value="1">Male</option>
                   <option value="2">Female</option>
                </select>
        </div>

            

             <div class="form-group">
          <label for="qualification"><span class="glyphicon glyphicon-envelope"></span> Qualification</label>
          <input type="text" name="qualification" class="form-control"  placeholder="Enter Your Qualification" required>
        </div>
           
              <div class="form-group">
          <label for="state"><span class="glyphicon glyphicon-envelope"></span> State of Origin</label>
          <input type="text" name="state" class="form-control"  placeholder="Enter Your State of Origin" required>
        </div>

            
                <div id="classbtn">
                  <button class="btn btn-primary" type="submit">Save</button>
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
