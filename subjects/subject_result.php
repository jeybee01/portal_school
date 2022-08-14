<?php include 'php/subject_result.php';
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
          
         <h2>Subject Assessment</h2>
         <p>Click a session and Term to view a Class Assessment</p>
          
        </div>
      </div>
  <!--start here -->
 
        <div align="center" class="row">
        <form method="POST" action="php/change.php"> 
          <div  class="form-group">
             <select name="session" class="form-control" onchange="change_term(this)">
                <?php
                  foreach($sessions as $s){
                     $selected = ($s['id'] == $session_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
            </select>
            </div>
          <div  class="form-group">
            <select name="term"  class="form-control">
                <?php
                  foreach($terms as $s){
                     $selected = ($s['id'] == $term_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
                  <input type="hidden" name="subject" value="<?=$subject + 1200?>">
                  <input type="hidden" name="class" value="<?=$class + 1200?>">
            </select>
                  </div>
            <button class="btn btn-primary" id="btn">Change</button>
          </form>
  

        </div>
        
        <div class="table-responsive">
           <h1><?=$subject_name.' '.$class_name?></h1>
         <form method="POST" action="php/submit_result.php">  
              <input type="hidden" name="subject" value="<?=$subject + 1200?>">
               <input type="hidden" name="class" value="<?=$class + 1200?>">
               <input type="hidden" name="term" value="<?=$term_id + 1200?>">
               <input type="hidden" name="session" value="<?=$session_id + 1200?>">
            <table class="table table-bordered table-striped" id="myTable">
  
              <h3 style="text-align:center"><strong> Scores</strong></h3>
              <tr>
                  <th>S/n</th>
                  <th>Student Name</th>
                  <th> 1st  C.A (<?=$assessment['first']?>)</th>
                  <th> 2nd  C.A (<?=$assessment['second']?>)</</th>
                  <th>Exams (<?=$assessment['exam']?>)</</th>
                  <th> Total (100)</</th>
                  <th>Position</th>
              </tr>
              <?php 
               $counter = 1;
              
                foreach($students as $student){

                    $reg_num = $student['reg_num'];
                    
                   $first_ca = isset($term_scores[$reg_num]['first_test']) ? $term_scores[$reg_num]['first_test'] : '0   ';
                    $second_ca = isset($term_scores[$reg_num]['second_test']) ? $term_scores[$reg_num]['second_test'] : '0';
                   $exam = isset($term_scores[$reg_num]['exams']) ? $term_scores[$reg_num]['exams'] : '0';
                   
                    $std_pos = isset($positions[$reg_num]) ? $positions[$reg_num] : 'N/A';

                  ?>
                 <tr>
                 <td><?=$counter++?></td>
                 <td><?=$student['name']?></td>
                 <td><input type="text" name="<?=$student['reg_num']?>_1st_ca" value="<?=$first_ca?>"> <br>
                      <?php
                        if(isset($_SESSION['errors'][$student['reg_num'].'_1st_ca'])){
                            ?>
                            <small style="color:red"><?=$_SESSION['errors'][$student['reg_num'].'_1st_ca'] ?></small>
                        <?php } ?>
                </td>
                 <td><input type="text" name="<?=$student['reg_num']?>_2nd_ca" value="<?=$second_ca?>">
                    <br>
                      <?php
                        if(isset($_SESSION['errors'][$student['reg_num'].'_2nd_ca'])){
                            ?>
                            <small style="color:red"><?=$_SESSION['errors'][$student['reg_num'].'_2nd_ca'] ?></small>
                        <?php } ?>
                 </td>
                 <td><input type="text" name="<?=$student['reg_num']?>_exam" value="<?=$exam?>">
                    <br>
                      <?php
                        if(isset($_SESSION['errors'][$student['reg_num'].'_exam'])){
                            ?>
                            <small style="color:red"><?=$_SESSION['errors'][$student['reg_num'].'_exam'] ?></small>
                        <?php } ?>
                 </td>
                 <td><?=$first_ca + $second_ca + $exam?></td>
                 <td><?=$std_pos?></td>
              </tr>  
                <?php } ?>                       
            </table>
            
           <button class="btn btn-primary" type="submit">SAVE</button>

          </form> 
   

<?php unset($_SESSION['errors']) ?>
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
function change_term(x) {
       // body...
        self=x;
       event.preventDefault();
        var value  =  x.value;
        var select = document.querySelector('select[name="term"]');

        if(value){
            $.ajax({
                type:'POST',
                url:'php/change_term.php',
                data:'session='+value,
                beforeSend : function(){
                 // Show image container
                 $( "#btn" ).attr('disabled','disabled');
                },
                success:function(result){

                 $('#btn').removeAttr('disabled');
                  result = JSON.parse(result);
                  if(result.msg.trim() == 'success'){
                    select.innerHTML = '';
                      var terms = result.terms;
                      for(var i = 0; i<terms.length; i++){
                           select.innerHTML+="<option value='"+(parseInt(terms[i].id) + 1200)+"'>"+terms[i].name+"</option>";
                      }
                  }
                }
            }); 
        }else{
            // $('#city').html('<option value="">Select state first</option>'); 
        }

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