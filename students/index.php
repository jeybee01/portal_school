<?php 
  include 'php/functions.php';
  if(empty($class_id) or empty($session_id)){
      echo "<script>window.history.back()</script>";
      exit;
  }
 $class_obj = new Classes($class_id);
 $class_info = $class_obj->get_teacher($session_id);
$teacher = (isset($class_info['name'])) ? $class_info['name'] : 'No Teacher';
$phone = (isset($class_info['phone_number'])) ? $class_info['phone_number'] : '';
$email= (isset($class_info['email'])) ? $class_info['email'] : 'No T';
 $details = get_details($class_id,$user);
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
          
         <h2>Students Records</h2>
          
        </div>
      </div>
  <!--start here -->
    
    
     <div class="table-responsive">

         <div class="content-container">

            <table class="table table-bordered">
                  <tr>
                      <th>School</th>
                      <td><?=isset($details['sch']) ? $details['sch'] : ''?></td>
                  </tr>
                  <tr>
                      <th>Name</th>
                      <td><?=$_SESSION['name']?></td>
                  </tr>

                  <tr>
                      <th>Class</th>
                      <td><?=$class_obj->get('name')?></td>
                  </tr>
                  <tr>
                      <th>Class Teacher</th>
                      <td><?=$teacher?></td>
                  </tr>
                  <tr>
                      <th>Teachers Phone</th>
                      <td><?=$phone?></td>
                  </tr>
                   <tr>
                      <th>Teachers Email</th>
                      <td><?=$email?></td>
                  </tr>



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