<?php 
 include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $teachers = [];
 $user_id = getId();
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
<style type="text/css">
    .acolor{
    color: #333;
  }
  .mr{
    margin-right: 20px;
  }
</style>
<body>
<section>
  <!--side-nav start here -->
    <?php include '../includes/menu.php'?>

  <!--side-nav end here -->

  <!--wrapper start here -->
  <div class="wrapper">
  <div class="main-nav">
    <nav class="navbar navbar-default">
  <div class="container-fluid">
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
         <h2>Manage Teachers</h2>
         <h4>Teachers Records</h4>
          
        </div>
      </div>
  <!--start here -->

        <!--this row start here -->
<!--       <div class="row">
        <?php
        // if(isset($_SESSION['error'])){
        //   echo
        //   "
        //   <div class='alert alert-danger text-center'>
        //     <button class='close'>&times;</button>
        //     ".$_SESSION['error']."
        //   </div>
        //   ";
        //   unset($_SESSION['error']);
        // }
        // if(isset($_SESSION['success'])){
        //   echo
        //   "
        //   <div class='alert alert-success text-center'>
        //     <button class='close'>&times;</button>
        //     ".$_SESSION['success']."
        //   </div>
        //   ";
        //   unset($_SESSION['success']);
        // }
        ?>
      </div> -->
      <!--this row stop here -->

        <div class="row">
        <a href="#addnew" class="btn btn-primary new" data-toggle="modal"><span class="glyphicon glyphicon-plus">NEW</span></a>
        <!-- <a href="#print" class="btn btn-primary print" data-toggle="modal"><span class="glyphicon glyphicon-print">PRINT</span></a> -->
        <?php
      // include_once('add_modal.php');

        ?>
      </div>

      
<div class="table-responsive">
  <?php
              if(count($teachers) == 0){
                ?>
                <p>You have not added any teacher</p>
              <?php 

                }else{
                  ?>  
        <table class="table table-bordered table-striped" id="myTable">
          <thead>
              <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Id Number</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Qualification</th>
                    <th>State</th>
                    <th colspan="2">Action</th>
                 </tr>
          </thead>
          <tbody>

            <?php 
                 $counter = 1;
                 foreach ($teachers as $teacher) {
                   ?>
                <tr>
                 <td><?=$counter++?></td>
                 <td><?=$teacher['name']?></td>
                 <td><?=$teacher['reg_num']?></td>
                 <td><?=$teacher['email']?></td>
                 <td><?=$teacher['phone_number']?></td>
                 <td><?=$teacher['qualification']?></td>
                 <td><?=$teacher['state']?></td>
                <td><a class='btn btn-primary btn-sm' href="assign_subject.php?teacher=<?=$teacher['id'] + 1200?>">view subjects</a></td>
                <td><a class='btn btn-danger btn-sm' onclick="delete_teacher('<?=$teacher['id'] + 1200?>')" >Delete</a></td>
               </tr>
               <?php } }?>
</div>
    </div>
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