<?php 
 include '../functions.php';
 $_SESSION['location'] = 'session';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $sessions = [];
 $user_id = getId();
$sessions = [];
 $sql = "SELECT session.id As session_id,session.name AS session_name,term.* FROM session INNER JOIN term WHERE session.user_id = '$user_id' AND term.session = session.id ORDER BY id DESC";
 $run =  $db->query($sql);
 if(!$run)echo $db->error;
 while($row = $run->fetch_assoc())$sessions[] = $row;
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

    
    
     <div class="wrapper-container">
    <div class="table-responsive">           
            <?php
              if(count($sessions) == 0){
                ?>
            <form method="POST" action="php/add_session.php" id="my_form">
               <h1> Add Session</h1>
               <hr>
                <div  class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="session" required  id="my_input">
                </div>
                 <div class="form-group">
                <button class="btn btn-primary" type="submit">Add</button>
                </div>
           </form>
          <?php } else{        
                 ?>
              <h1>Manage Session</h1> 
              <table class="table table-bordered table-striped" id="myTable">
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Present Term</th>
                    <th colspan="5">Action</th>
                 </tr>
                <?php 
                 $counter = 1;
                 foreach ($sessions as $session) {
                 $term = $session['id'];
                $next_term = false;
                if(trim($session['name']) == 'Second')
                    $next_term = true;
                else if(trim($session['name']) == 'First')
                    $next_term = true;  
                  ?>
                <tr>
                 <td><?=$counter?></td>
                 <td><?=$session['session_name']?></td>
                 <td><?=$session['name']?></td>
                 <td>
                    <?php 
 
                           if($next_term and $counter++ == 1){
                            ?>
                            <a class="btn btn-primary" onclick="go_next()" >Go to next term</a>
                           <?php }else if(!$next_term and $counter++ == 1){
                             ?>
                             <a class="btn btn-primary" onclick="start_session('<?=$session['session_name']?>')" style="text-decoration: underline;">Start new session</a>
                         <?php }else{
                              ?>
                              <small style="color:red">Term Completed</small>
                         <?php } ?>
                 </td>
                     <?php
                       if($session['status'] == '0'){
                        ?>
                        <td colspan="5"><a class="btn btn-success" href="resumption_date.php?session=<?=$session['session_id'] + 1200?>&term=<?=$session['id'] + 1200?>">Release Result</a></td>
                       <?php }else{
                          $resumption=date_create($session['resumption_date']);
                           $resumption =  date_format($resumption,"d M Y");
                         ?>
                         <td><small style="color:green">Result Released</small></td>
                         <td><?=$resumption?></td>
                         <td><a class="btn btn-danger" href="hold.php?session=<?=$session['session_id'] + 1200?>&term=<?=$session['id'] + 1200?>">Hold Result</a><td>
                         <td><a class="btn btn-info" href="resumption_date.php?session=<?=$session['session_id'] + 1200?>&term=<?=$session['id'] + 1200?>">Edit Resumption Date</a></td>
                       <?php } ?>

               </tr>
             <?php  } } ?>
            </table>
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
function go_next(){
                   if(confirm('Are you sure you want to go to next term')){
                      window.location.href = 'php/go_to_next.php';
                   }
                }

                function start_session(year){
                   if(confirm('Are you sure you want to start new session')){
                      year = year.split("/")[1];
                      if(year){
                        new_year = parseInt(year) + 1;
                        session = year+'/'+new_year;
                        window.location.href = 'php/add_session_2.php?session='+session;
                      }
                    }

                  
                }


</script>
</body>
</html>