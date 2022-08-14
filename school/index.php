<?php 
  include '../functions.php';
  $_SESSION['location'] = 'school';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $user = getId();
 $sql = "SELECT school.*,scores.* FROM school INNER JOIN scores WHERE school.admin_id = '$user' AND scores.admin_id = '$user'  ";
 $run = $db->query($sql);
 $info = $run->fetch_assoc();
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
      <a href="#" class="navbar-brand" id="menu-btn"><span onclick="openNav()">Menu</span></a>
      <a class="navbar-brand" href="#" style="color: #235a81;">Admin Dashboard</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon " ></span style="color: #235a81;"> Welcome Admin!</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  </div>
  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <?php include '../includes/menu.php'?>
  
</div>

  <div class="main-content">
    <div class="container-fluid">
  <!--container-fluid start here -->

      <div class="container width-80">
        <div class="row ">
          <!-- <div class="back-box"><a class="btn btn-danger" href="../classes/view_classes.php"> << Back</a> </div> -->
         <p>Click the Button below to Add School or Assessment Details</p>
         <!-- <h4>Teachers Records</h4> -->
          
        </div>
      </div>
  <!--start here -->

      <section class="center-text well">
  
    <div class="login-form box-center">

  
      <div align="center">
<ul class="tab">
  <li><a href="#" class="tablinks" onclick="openTab(event, 'school')">School Details</a></li>
  <li><a href="#" class="tablinks" onclick="openTab(event, 'assessment')">Assessment Details</a></li>
</ul>
        
      </div>   
        <div class="content-container">
        <div style="color: red;" align="center"><?=(isset($_SESSION['errors']['message']) ? $_SESSION['errors']['message'] : '' )?></div> 

        <div id="school" class="tabcontent active-box">
        <form method="POST" action="add.php">
           <h1>Add School Details</h1>
           <hr>
           <div class="form-group">
          <label for="class_name"><span class="glyphicon glyphicon-envelope"></span> School Name</label>
          <input type="text" name="name" value="<?=isset($info['name']) ? $info['name'] : '' ?>" class="form-control"   required autofocus>
          <small style="color: red;"><?=(isset($_SESSION['errors']['school']) ? $_SESSION['errors']['school'] : '' )?></small>  
        </div>


            <div class="form-group">
          <label for="class_name"><span class="glyphicon glyphicon-envelope"></span> School Address</label>
          <input type="text" name="address" value="<?=isset($info['address']) ? $info['address'] : '' ?>" class="form-control"   required>
          <small style="color: red;"><?=(isset($_SESSION['errors']['address']) ? $_SESSION['errors']['address'] : '' )?></small>
        </div>

                    <div class="form-group">
          <label for="class_name"><span class="glyphicon glyphicon-envelope"></span> School Motto</label>
          <input type="text" name="motto" value="<?=isset($info['motto']) ? $info['motto'] : '' ?>" class="form-control"   required>
          <small style="color: red;"><?=(isset($_SESSION['errors']['motto']) ? $_SESSION['errors']['motto'] : '' )?></small>
        </div>
             
            
                <div>
                  <button class="btn btn-primary" type="submit">Save</button>
               </div>
           </form>

            </div>

    <div id="assessment" class="tabcontent">
        <form method="POST" action="assessment.php">
           <h1>Add Assessment Details</h1>
           <hr>

           <div class="form-group">
          <label for="first"><span class="glyphicon glyphicon-envelope"></span> First Test Score</label>
          <input type="text" name="first" value="<?=isset($info['first']) ? $info['first'] : '' ?>" class="form-control"   required autofocus>
          <small style="color: red;"><?=(isset($_SESSION['errors']['first']) ? $_SESSION['errors']['first'] : '' )?></small>
        </div>
            

             <div class="form-group">
          <label for="second"><span class="glyphicon glyphicon-envelope"></span> Second Test Score</label>
          <input type="text" name="second" value="<?=isset($info['second']) ? $info['second'] : '' ?>" class="form-control"   required >
           <small style="color: red;"><?=(isset($_SESSION['errors']['second']) ? $_SESSION['errors']['second'] : '' )?></small>
        </div>

               <div class="form-group">
          <label for="exam"><span class="glyphicon glyphicon-envelope"></span> Examination Score</label>
          <input type="text" name="exam" value="<?=isset($info['exam']) ? $info['exam'] : '' ?>" class="form-control"   required >
           <small style="color: red;"><?=(isset($_SESSION['errors']['exam']) ? $_SESSION['errors']['exam'] : '' )?></small>
        </div>
            
            
                <div id="classbtn">
                  <button class="btn btn-primary" type="submit">Save</button>
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
$(document).ready(function(){
  //inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
      $('.alert').hide();
    })
});
       <?php unset($_SESSION['errors']);?>

</script>
</body>
</html>