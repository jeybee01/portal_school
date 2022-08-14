<?php 
 include 'php/resumption.php';
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
  section .wrapper{
    overflow: auto;
  }
  .center-text{
    width: 60%;
    margin: auto;
  }
 
  .category-box{
    display: flex;
    justify-content: normal;
    align-items: center;
  }
  .subject-box{
    width: 20px;
  }
  .-mar20{
    margin-left: 10px;
  }
  .back-box .btn{
    position: fixed;
    top: 65px;
    left: 22%;
    z-index: 999;
  }
</style>
<body>
<section class="main-section">
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
          <div class="back-box"><a class="btn btn-danger" href="../session/index.php"> << Back</a> </div>
         <h2>Add Resumption Date</h2>
          
        </div>
      </div>
  <!--start here -->


    
     <section class="center-text well">
    <div class="login-form box-center">
       <form method="POST" action="php/set_date.php">
        <div class="content-container">
        <p style="text-align:center">Set School Resumption Date</p>

            <hr>
            <div class="form-group">
                <label for="date">Enter Resumption Date</label>
                <input type="date" class="form-control" name="date" value="<?=(isset($termInfo['resumption_date'])) ? $termInfo['resumption_date'] : ''?>" min="<?=date('Y-m-d')?>" >
                <input type="hidden" name="session" value="<?=$session + 1200?>">
                <input type="hidden" name="term" value="<?=$term + 1200?>">

                <?php
                 if(isset($_SESSION['errors']['date'])){
                  ?>
                  <p><?=$_SESSION['errors']['date']?></p>
               <?php } ?>
            </div>
    
                <div id="classbtn">
                  <button class="btn btn-primary" type="submit">Set Date</button>
              </div>
            <?php unset($_SESSION['errors']);?>  
          </div>
        </form>
          
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