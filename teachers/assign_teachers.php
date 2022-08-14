<?php 
 include '../functions.php';
  include '../_classes/Teacher.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

 $user_id = getId();

$session_id = $_SESSION['sess_id'];



 if(isset($_GET['c'])){
   $class = sanitize($_GET['c']);
   $class = filter_var($class,FILTER_VALIDATE_INT);
   
   if(!$class or $class == ''){
     echo "<script>alert('error occured');window.history.back();</script>";
     exit;
   }

   $class = $class - 1200;

   $sql = "SELECT short FROM class WHERE id = '$class' AND user_id = '$user_id'";
   $run = $db->query($sql);
   if($run->num_rows == 0){
       echo "<script>alert('error occured');window.history.back();</script>";
     exit;
   }

   $class_info = $run->fetch_assoc();

 }else{
   echo "<script>alert('error occured');window.history.back();</script>";
   exit;
 }


 $teachers = [];
  $sql = "SELECT * FROM users WHERE user_id = '$user_id' AND type = '1'";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$teachers[] = $row;


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
          <div class="back-box"><a class="btn btn-danger" href="../classes/view_classes.php"> << Back</a> </div>
          
         <h2>Asign a teacher to a Class</h2>
           <p>Choose a Teacher for <?=$class_info['short']?></p>

          
        </div>
      </div>
  <!--start here -->



           <div class="table-responsive">

        <div class="content-container">
           <?php
              if(count($teachers) == 0){
                ?>
                <p>You have not added any teacher</p>
              <?php 

                }else{
                  ?>
                  <table class="table table-bordered table-striped" id="myTable">
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th colspan="">Action</th>
                 </tr>
                <?php 
                 $counter = 1;
                 foreach ($teachers as $teacher) {
                   $teacher_obj = new Teacher($teacher['id']);
                   ?>
                <tr>
                 <td><?=$counter++?></td>
                 <td><?=$teacher['name']?></td>
                 <td><?=$teacher['email']?></td>
                 <td><?=$teacher_obj->get_class($session_id);?></td>
                 <td><a class="btn btn-info" href="php/assign_teacher.php?teacher=<?=$teacher['id'] + 1200?>&class=<?=$class + 1200?>">Assign</a></td>               </tr>
               <?php } }?>
           </table>
          </div>
          
     </div>
       

  <!--container-fluid end here -->
</div>

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
    function remove_std(x) {
                   if(confirm('Are you sure you want to remove student')){
                      window.location.href = "php/remove.php?std="+x;
                   }
                }
  function delete_teacher(x) {
                   if(confirm('Are you sure you want to delete')){
                      window.location.href = 'php/delete_teacher.php?teacher='+x;
                   }
                }

                 function show_category(cat){

           window.location.href='view_classes.php?category='+cat
        }
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