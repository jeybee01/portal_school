<?php 
  include 'php/functions.php';
 $students = [];
 $sql = "SELECT class_students.student,users.* FROM class_students INNER JOIN users WHERE class_students.session = '$session_id' AND class_students.class = '$class_id' AND users.id = class_students.student";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$students[] = $row;
 unset($_SESSION['c_sess']);
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
  .session-box{
    width: 25%;
    margin: auto;
    padding: 25px;
  }
  .session-box select{
    margin-bottom: 10px;
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
          <div class="back-box"><a class="btn btn-danger" href="../classes/view_classes.php"> << Back</a> </div>
          
         <h2>Students List and result</h2>
          
        </div>
      </div>
  <!--start here -->


  
    
    
           <div class="table-responsive">
     
            <div class="row well session-box ">
        <form method="POST" action="php/change.php"> 

          <div class="form-group">
           <select class="form-control" name="session" style="w">
          <label for="class_name"><span class="glyphicon glyphicon-envelope"></span> Select a Session</label>

                <?php
                  foreach($sessions as $s){
                     $selected = ($s['id'] == $session_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
            </select>
            <input type="hidden" name="class" value="<?=$class_id + 1200?>">
            <button class="btn btn-primary">Change Session</button>
            
        </div>
            
          </form>
          </div>
  


        <div class="content-container">
           <?php
              if(count($students) == 0){
                ?>
                <p>There is no student in your class yet</p>
              <?php 

                }else{
                  ?>
                  <table class="table table-bordered table-striped" id="myTable">
           <h3 style="text-align: center;">List of <?=$class->get('short')?> Students</h3>

                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Of Birth</th>
                    <th colspan="2">Action</th>
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
                 <td><a onclick="remove_std('<?=$student["student"] + 1200?>')" style="color: blue;cursor: pointer;">Remove from Class</a></td>
                 <td><a href="result.php?std=<?=$student['id'] + 1200?>&class=<?=$class_id + 1200?>">View Results</a></td>               
               </tr>
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
<!-- generate datatable on our table -->

  <script>
    function remove_std(x) {
                   if(confirm('Are you sure you want to remove student')){
                      window.location.href = "php/remove.php?std="+x;
                   }
                }
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