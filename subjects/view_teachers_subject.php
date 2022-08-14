<?php 
 include '../functions.php';
 include '../_classes/Classes.php';
 $_SESSION['location'] = 'subjects';
 if(!isLoggedIn() or $_SESSION['type'] != '1'){
   header('location:../index.php');
 }
  $subjects = [];
  $user_id = getId();
  $sql = "SELECT  assign_subject.*,subjects.name FROM assign_subject INNER JOIN subjects WHERE assign_subject.teacher = '$user_id' AND subjects.id = assign_subject.subject ";
  $run = $db->query($sql);
  while($row = $run->fetch_assoc())$subjects[] = $row;
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
          
         <h2>Subjects and Classes</h2>
         <p>Click a Subject to view a Class Assessment</p>
          
        </div>
      </div>
  <!--start here -->

    
    
     <div class="table-responsive">

        <div class="content-container">
            <?php
              if(count($subjects) == 0){
                ?>
                 <h1>You are Not Taking any Subject</h1>
                   
              <?php }else{?>
                <table class="table table-bordered table-striped" id="myTable">
                  <tr>
                    <th>S/n</th>
                    <th>Subject Name</th>
                    <th>Class Name</th>
                    <th>Actions</th>
                 </tr>
                 <?php 
                 $counter = 1;
                  foreach($subjects as $subject){
                    $class = new Classes($subject['class']);
                     ?>
                <tr>
                 <td><?=$counter++?></td>
                 <td><?=$subject['name']?></td>
                 <td><?=$class->get('name')?></td>
                 <td><a class="btn btn-primary" href="subject_result.php?class=<?=$subject['class'] + 1200?>&subject=<?=$subject['subject'] + 1200?>"> 
                      View Results
              </a></td>               
               </tr>


                  
              <?php } } ?>
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