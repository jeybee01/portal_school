<?php 
 include '../functions.php';
 include '../_classes/Classes.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $classes = [];
 $user_id = getId();
  if(isset($_GET['category'])){
    $category = sanitize($_GET['category']);
    $category = filter_var($category,FILTER_VALIDATE_INT);

  }else{
    $category = '1';
  }
 $sql = "SELECT * FROM class WHERE user_id = '$user_id' AND category = '$category' ORDER BY short ASC";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$classes[] = $row;
 $session_id = $_SESSION['sess_id'];
  $categories = get_categories();
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
         <h2>Manage Classes</h2>
         <h4>Classes Records</h4>
          
        </div>
      </div>
  <!--start here -->
<div class="table-responsive">

      <div align="center">
        <?php
               foreach ($categories as $key => $value) {
                $id_name = ($key == $category) ? 'active' : '';
                  ?>
                  <button class="btn btn-primary" onclick="show_category('<?=$key?>')" id="<?=$id_name?>"><?=$value?></button>        
        <?php } ?>
       </div> 


        <div class="content-container">
           <?php
              if(count($classes) == 0){
                ?>
                <p>You have not added any class</p>
              <?php 

                }else{
                  ?>
             <table class="table table-bordered table-striped" id="myTable">
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Short</th>
                    <th>Class Teacher</th>
                    <th colspan="4">Actions</th>
                 </tr>
                <?php 
                 $counter = 1;
                 foreach ($classes as $c) {
                  $class = new Classes($c['id']);
                   $class_info = $class->get_teacher($session_id);
                   $teacher = (isset($class_info['name'])) ? $class_info['name'] : 'No Teacher';
                   ?>
                <tr>
                 <td><?=$counter++?></td>
                 <td><?=$c['name']?></td>
                 <td><?=$c['short']?></td>
                 <td><?=$teacher?></td>
                <td><a class="btn btn-primary" href="add_class.php?class=<?=$c['id'] + 1200?>">Edit</a></td>
                <td><a class="btn btn-danger" onclick="delete_class('<?=$c['id'] + 1200?>')" >Delete</a></td>
                <td><a class="btn btn-info" href="../student/view_students.php?class=<?=$c['id'] + 1200?>" >View Class</a></td>
                <td><a class="btn btn-primary" href="../teachers/assign_teachers.php?c=<?=$c['id'] + 1200?>">assign Teacher</a></td>
               </tr>
               <?php } }?>
           </table>
          </div>   

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
     function delete_class(x) {
                   if(confirm('Are you sure you want to delete')){
                      window.location.href = 'php/delete_class.php?class='+x;
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