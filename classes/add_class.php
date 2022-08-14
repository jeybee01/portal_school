<?php 
 include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $categories = get_categories();
   

 $class_id = 0;
 $user_id = getId();
 if(isset($_GET['class'])){
  $class_id = sanitize($_GET['class']);
  $class_id = filter_var($class_id,FILTER_VALIDATE_INT);
  if(!$class_id){
    echo "<script>window.history.back()</script>";
  }
  $class_id = $class_id - 1200;
  $sql = "SELECT id FROM class WHERE id = '$class_id' AND user_id = '$user_id'";
  $run = $db->query($sql);
  if($run->num_rows == 0){
    echo "<script>window.history.back()</script>";
  }
  $_SESSION['class'] = $class_id;
 }
 $class = getClass($class_id,$user_id);
 if(!$class or count($class) == 0){
  $text = 'Add';
  unset($_SESSION['class']);
 }else{
  $text = 'Edit';
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
         <h2>Add Class</h2>
         <!-- <h4>Teachers Records</h4> -->
          
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
      <form action="php/add_class.php" method="POST">

        <div class="form-group">
          <label for="class_name"><span class="glyphicon glyphicon-envelope"></span> Class Name</label>
          <input type="text" name="class_name" value="<?=(isset($class['name'])) ? $class['name'] : ''?>" class="form-control"  placeholder="Enter classname" required autofocus>
          <?php
                 if(isset($_SESSION['errors']['class_name'])){
                  ?>
                  <p><?=$_SESSION['errors']['class_name']?></p>
               <?php } ?>
        </div>
        
        <div class="form-group">
          <label for="short"><span class="glyphicon glyphicon-envelope"></span> Short Classname</label>
          <input type="text" name="short" value="<?=(isset($class['short'])) ? $class['short'] : ''?>" class="form-control"  placeholder="Enter short classname" required>
            <?php
                 if(isset($_SESSION['errors']['class_short'])){
                  ?>
                  <p><?=$_SESSION['errors']['class_short']?></p>
               <?php } ?>
        </div>

      


                <div class="form-group">
          <label for="gender"><span class="glyphicon glyphicon-envelope"></span> Class Category</label>
           <select name="category"  class="form-control">
                  <?php
                    foreach ($categories as $category_key=>$category_value){
                         $selected = '';
                        if(isset($class['category']))
                             $selected= ($class['category'] == $category_key) ? 'selected' : '';   
                      ?>
                    <option value="<?=$category_key?>" <?=$selected?>><?=$category_value?></option>   
                  <?php }  ?>
                </select>
                 <?php
                 if(isset($_SESSION['errors']['category'])){
                  ?>
                  <p><?=$_SESSION['errors']['category']?></p>
               <?php } ?>
        </div>

             

        <!-- <input class="btn btn-primary" type="submit" name="submit"> -->
        <button class="btn btn-primary" type="submit"><?=$text?></button>

      </form>
          <?php unset($_SESSION['errors']);?>

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