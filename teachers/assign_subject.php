<?php
  include '../functions.php';
   include '../_classes/Teacher.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $user_id = getId();
 if(isset($_GET['teacher'])){
   $teacher = sanitize($_GET['teacher']);
   $teacher = filter_var($teacher,FILTER_VALIDATE_INT);
   //  print_r($teacher);
   // exit();
   if($teacher == '' or !$teacher){
     echo "<script>window.history.back()</script>";
   exit();
   }
   $teacher = $teacher - 1200;  
   $sql = "SELECT id FROM users WHERE user_id = '$user_id' AND id = '$teacher'";
   $run = $db->query($sql);
   if($run->num_rows == 0){
    echo "<script>window.history.back()</script>";
    exit();
   }

   $teacher = new Teacher($teacher);
   $teacher_subjects = $teacher->get_subjects();   
  }else{
   echo "<script>window.history.back()</script>";
   exit();
 }
  $categories = get_categories();

  if(isset($_GET['category'])){
    $category = sanitize($_GET['category']);
    $category = filter_var($category,FILTER_VALIDATE_INT);

  }else{
    $category = '1';
  }

  $classes = get_category_class($category,$user_id);
  $subject = get_category_subject($category,$user_id);


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
          
         <h2> Assign Subject To Teachers</h2>
         <hr>
         <h4>Subject Records</h4>
          
        </div>
      </div>
  <!--start here -->






<div class="table-responsive">

          <div class="form-group">
                <p><strong>Teacher Name:</strong> <?=$teacher->get('name')?></p>
        </div>
        <hr>

          
            <div id="classbtn" >
              <?php
               foreach ($categories as $key => $value) {
                    $id_name = ($key == $category) ? 'active' : '';
                  ?>
                  <button class="btn btn-info" onclick="show_category('<?=$key?>')" id="<?=$id_name?>"><?=$value?></button>
               <?php } ?>
             
            </div>
          <form class="form-horizontal" role="form" method="POST" action="php/assign_subject.php"> 

           <table class="table table-bordered table-striped" id="myTable">

            <?php
                for($i = -1; $i < count($subject); $i++){
                    ?>
                    <tr>
                      <?php 
                       if($i == -1){
                         ?>
                         <td> <strong> Subject</strong> </td>
                       <?php }else{
                          ?>
                          <td> <?=$subject[$i]['name']?></td>
                       <?php } ?>
                       <?php
                        for($j=0;$j<count($classes);$j++){
                           if($i == -1){
                            ?>
                            <td><strong> <?=$classes[$j]['short']?> </strong></td>
                        <?php }else{
                             $input_name = str_replace(' ','_',$classes[$j]['short']).'_'.str_replace(' ','_',$subject[$i]['short']);
                             $subject_teacher = get_subject_teacher($classes[$j]['id'],$subject[$i]['id'])
                           ?>
                           <td id="assign_subject_check">
                             <input type="checkbox" name="<?=$input_name?>">
                             <span style="color:<?=$subject_teacher['color']?>"><?=$subject_teacher['name']?></span>
                           </td>
                             <?php } } ?>
                    </tr>
                <?php } ?>
           </table>
           <input type="hidden" name="teacher" value="<?=$teacher->get('id') + 1200?>">
           <input type="hidden" name="category" value="<?=$category?>">
           <div id="classbtn">
           <button class="btn btn-primary" type="submit">Click to Assign Subject</button>
           </div>
          </form>
  
          
           
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
    function show_category(cat){
           window.location.href='assign_subject.php?teacher='+<?=$teacher->get('id') + 1200?>+'&category='+cat
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
