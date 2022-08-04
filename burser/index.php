<?php 
 include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $teachers = [];
 $user_id = getId();
 $sql = "SELECT * FROM users WHERE user_id = '$user_id' AND type = '3'";
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
         <h2>Manage Buser</h2>
         <h4>Buser Records</h4>
          
        </div>
      </div>
  <!--start here -->
    
      <div class="table-responsive">
           <?php
              if(count($teachers) == 0){
                ?>
                <p>You have not added any Burser</p>
              <?php 

                }else{
                  ?>
                  <table class="table table-bordered table-striped" id="myTable">
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Qualification</th>
                    <th>State</th>
                    <th colspan="">Action</th>
                 </tr>
                <?php 
                 $counter = 1;
                 foreach ($teachers as $teacher) {
                   ?>
                <tr>
                 <td><?=$counter++?></td>
                 <td><?=$teacher['name']?></td>
                 <td><?=$teacher['email']?></td>
                 <td><?=$teacher['phone_number']?></td>
                 <td><?=$teacher['qualification']?></td>
                 <td><?=$teacher['state']?></td>
                <td><a class="btn btn-danger" onclick="delete_teacher('<?=$teacher['id'] + 1200?>')">Delete</a></td>
               </tr>
               <?php } }?>
           </table>
          
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
     function delete_teacher(x) {
                   if(confirm('Are you sure you want to delete')){
                      window.location.href = 'php/delete_burser.php?teacher='+x;
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