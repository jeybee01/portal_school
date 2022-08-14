<?php 
 include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $categories = get_categories();
 $subject_id = 0;
  $user_id = getId();
 if(isset($_GET['subject'])){
  $subject_id = sanitize($_GET['subject']);
  $subject_id = filter_var($subject_id,FILTER_VALIDATE_INT);
  if(!$subject_id){
    echo "<script>window.history.back()</script>";
  }
  $subject_id = $subject_id - 1200;
  $sql = "SELECT id FROM subjects WHERE id = '$subject_id' AND user_id = '$user_id'";
   $run = $db->query($sql);
      if($run->num_rows == 0){
        echo "<script>window.history.back()</script>";
      }
  $_SESSION['subject'] = $subject_id;
 }

 $subject = get_subject($subject_id,$user_id);
 $subject_categories = get_subject_cat($subject_id);
 if(!$subject or count($subject) == 0){
  $text = 'Add';
  unset($_SESSION['subject']);
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
          <div class="back-box"><a class="btn btn-danger" href="../subjects/index.php"> << Back</a> </div>
         <h2>Add Subjects</h2>
         <h4>Subject Records</h4>

          
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
      <form action="php/add_subject.php" method="POST">

        <div class="form-group">
          <label for="fullname"><span class="glyphicon glyphicon-envelope"></span> Subject Name</label>
           <input type="text" name="subject_name" placeholder="Enter Subject fullname" class="form-control" value="<?=isset($subject['name']) ? $subject['name'] : ''?>"  autofocus required>
          <?php
                 if(isset($_SESSION['errors']['subject_name'])){
                  ?>
                  <p><?=$_SESSION['errors']['subject_name']?></p>
               <?php } ?>
        </div>
        
        <div class="form-group">
          <label for="id_number"><span class="glyphicon glyphicon-envelope"></span> Subject Short-name</label>
           <input type="text" name="short" class="form-control"  placeholder="Enter Subject Short-name" value="<?=isset($subject['short']) ? $subject['short'] : ''?>">
                 <?php
                 if(isset($_SESSION['errors']['subject_short'])){
                  ?>
                  <p><?=$_SESSION['errors']['subject_short']?></p>
               <?php } ?>
        </div>

       <div class="form-group">
        <div>
          <label for="phone"><span class="glyphicon glyphicon-envelope"></span> Subject Class Category</label>
        </div>
                 <?php 
                      foreach ($categories as $category_key => $category_value) {
                         $checked = (in_array($category_key,$subject_categories)) ? 'checked' : '';
                         ?>
                         <div class="row category-box">
                          <div class="mm">
                            <input  class="form-control subject-box"  type="checkbox" name="categories[]" value="<?=$category_key?>">
                          </div>
                          <div class="-mar20">
                       <?=$checked?>  <?=$category_value?>
                            
                          </div>
                           
                         </div>
                      <?php } ?>
                 <?php
                 if(isset($_SESSION['errors']['category'])){
                  ?>
                  <p><?=$_SESSION['errors']['category']?></p>
               <?php } ?>
        </div>

        
                <button type="submit" class="btn btn-primary"><?=$text?></button>

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
