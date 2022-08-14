<?php 
  include 'php/functions.php';
  $_SESSION['location'] = 'class_mates';
  if(!empty($_SESSION['class_mate_session']))
      echo $_SESSION['class_mate_session'];
  $session_id = (!empty($_SESSION['class_mate_session'])) ? $_SESSION['class_mate_session'] : $session_id;
  $students = get_class_mates($session_id,$user);
  $sessions = get_sessions_list($admin_id);
  $sql = "SELECT class FROM class_students WHERE session = '$session_id'  AND student = '$user'";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();
  $class_id = (isset($info['class'])) ? $info['class'] : '';
  if(!empty($class_id)){
     $class_obj = new Classes($class_id);
 }else{
    $_SESSION['error_msg'] = 'No Class Found in this session';  
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
          
         <h2>List of Class Mates</h2>
          
        </div>
      </div>
  <!--start here -->

     <div class="table-responsive">
  
          <div align="center">
        <form method="POST" action="change.php"> 
          <div class="form-group">
             <select class="form-control" name="session" style="width:50%">
                <?php
                  foreach($sessions as $s){
                     $selected = ($s['id'] == $session_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
            </select>
            </div>
          <div class="form-group">
            <button class="btn btn-primary">Change</button>
                  </div>
          </form>
  

        </div>

        <div class="content-container">
<?php if(!empty($_SESSION['error_msg'])){ ?>

                <p style="color:red;" align="center"><?=$_SESSION['error_msg']?></p>

<?php }else{ ?>
    
           <h1><?=!empty($class_obj->get('short')) ? $class_obj->get('short') : ''?></h1>
           <?php
              if(count($students) == 0){
                ?>
                <p>There is no student in your class yet</p>
              <?php 

                }else{
                  ?>
                  <table  class="table table-bordered table-striped" id="myTable">
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Of Birth</th>
                 </tr>
                <?php 
                 $counter = 1;
                 foreach ($students as $student) {
                   ?>
                <tr>
                 <td><?=$counter++?></td>
                 <td><?=$student['name']?></td>
                 <td><?=$student['reg_num']?></td>
                 <td><?=$student['email']?></td>
                 <td><?=$student['phone_number']?></td>
                 <td><?=$student['dob']?></td>
               <?php } }?>
           </table>            
   
<?php } ?>


           
<?php unset($_SESSION['error_msg']);?>

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
</body>
</html>