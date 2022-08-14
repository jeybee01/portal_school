<?php include 'php/result.php' ?>

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
    
  <div class="container">
        <div class="row ">
         <h2>Student Results</h2>
        </div>
      </div>
  <!--start here -->

    
<div class="table-responsive">
        <div class=" session-container">
                    <div align="center" class="col-md-12 well">
        <form method="POST" action="php/change_2.php">
            <div class="form-group">
              <select class="form-control" name="session" onchange="change_term(this)">
                <?php
                  foreach($sessions as $s){
                     $selected = ($s['id'] == $session_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
            </select>
            </div> 
             
             <div class="form-group">
                   <select class="form-control" name="term">
                <?php
                  foreach($terms as $s){
                     $selected = ($s['id'] == $term_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
                  <input type="hidden" name="student" value="<?=$student_id + 1200?>">
                  <input type="hidden" name="class" value="<?=$class + 1200?>">
            </select>
             </div>
             <div class="form-group">
            <button class="btn btn-primary">Change</button>
             </div>
        
          </form>
  

        </div>
        </div>



   <div class=" result-container">
		<div class="result-title" style=" padding: 20px; margin-bottom: 10px">

      <div class="img-card col-md-3 col-xs-3">
        <img src="../images/logo.jpg" alt="logo" width="100" height="100">
      </div>

      <div class="name-address col-md-6 col-xs-6" style="text-align: center;">
			<h1><?=$school['name']?></h1>
      <small class="motto">Motto:<?=$school['motto']?></small>
			<small><?=$school['address']?>.</small>
    </div>
       <div class="img-card col-md-3 col-xs-3">
        <img src="../images/logo.jpg" alt="logo" width="100" height="100">
      </div>

    </div>
		<div class="result-info">

<?php if(!empty($_SESSION['msg'])){ ?>

  <p style="color:red;" align="center"><?=$_SESSION['msg']?></p>

<?php 

		unset($_SESSION['msg']); 
	}else{

?>

		

<?php // check if result is released\


              if($_SESSION['type'] == '1' or $_SESSION['type'] == '0' or ($_SESSION['type'] == '2' and $term_status == '1')){
              	?>
   <div class="row">
				<div class="col-md-6 col-xs-6">
					<p>Name: <strong><?=$student['name']?></strong></p>
					<p>Admision No: <strong><?=$student['reg_num']?></strong></p>
					<p>DOB: <strong><?=$dob?></strong></p>
					<p>School resumes:  <strong><?=$resumption_date?></strong></p>
        </div>

				<div class="col-md-6 col-xs-6">
					<p>Class: <strong> <?=$class_obj->get('short')?></strong></p>
					<p>Total Scores<strong><?=$total_scores?></strong></p>
					<p>Total Average  <strong><?=$total_average?></strong></p>
					<p>No Of pupil in Class: <strong> <?=$class_obj->get_num_of_students($session_id)?></strong></p>
					<p>Position: <strong><?=$std_pos?></strong> </p>
        </div>
   </div>
  <div class="score-table">
        <table class="table table-bordered">
				<tr>
					<!-- <th>S</th> -->
					<th colspan="7" id="session_holder"><?=$session_name.' , '.$term_name?></th>
              	</tr>
				<tr>
					<th>Subject</th>
					<th> First C.A</th>
					<th> Second C.A</th>
					<th> Exam</th>
					<th> Total Scores</th>
					<th> Grade</th>
					<th> Position</th>
				</tr>
				
					<?php
                       foreach($subjects as $s){
                       	$subject_id = $s['id'];
                       	$total = (!empty($results[$subject_id]['total'])) ? $results[$subject_id]['total'] : '';
                       	?>
                       	<tr>
                       	  <td><?=$s['name']?></td>
                       	  <td><?=(!empty($results[$subject_id]['first_test'])) ? $results[$subject_id]['first_test'] :  '0' ?></td>
					      <td><?=(!empty($results[$subject_id]['second_test'] )) ? $results[$subject_id]['second_test'] : '0' ?></td>
					      <td><?=(!empty($results[$subject_id]['exams'] )) ? $results[$subject_id]['exams'] : '0' ?></td>
					      <td><?=(!empty($results[$subject_id]['total'] )) ? $results[$subject_id]['total'] : '0' ?></td>
					      <td><?=get_grade($total)?></td>
					      <td><?=(!empty($results[$subject_id]['position'] )) ? $results[$subject_id]['position'] : 'N/A' ?></td>
					    </tr> 
                       <?php } ?>						
			</table>
    </div>
    <div class="grade-table">
			<table class="table table-bordered">
				<tr>
					<th>Marks</th>
					<th>Grade</th>
					<th>merit</th>
				</tr>
				<tr>
					<td>70-100</td>
					<td>A</td>
					<td>EXCELLENT</td>
				</tr>
				<tr>
					<td>60-69</td>
					<td>B</td>
					<td>VERY GOOD</td>
				</tr>
				<tr>
					<td>50-59</td>
					<td>C</td>
					<td>GOOD</td>
				</tr>
				<tr>
					<td>40-49</td>
					<td>D</td>
					<td>PASS</td>
				</tr>
				<tr>
					<td>39</td>
					<td>F</td>
					<td>FAIL</td>
				</tr>
				
			</table> </div>
		<div class="table-footer">

				<div class="behaviour-table">
			    <form method="POST" action="php/behaviour.php">		
				  <table class="table table-bordered">
				  	 <tr>
				  	 	<th>Behavioural</th>
				  	 	<th>5</th>
                        <th>4</th>
                        <th>3</th>
                        <th>2</th>
                        <th>1</th>
				  	 </tr>	
				  	 <?php 
                       foreach($behaviour as $b){
                       	?>
                       	<tr>
				  	 	<td><?=$b?></td>
                       <?php 
                          $b = strtolower($b);
                          $b = str_replace(' ','_',$b);
                   $count = (isset($behaviours[$b])) ? $behaviours[$b] : '';
                         for($i=1;$i<=5;$i++){
                         	 if($_SESSION['type'] == '1'){
                         	 	$checked = ($count == $i) ? 'checked' : '';
                         	 	$data = '<input type="radio" name="'.$b.'" value="'.$i.'"'.$checked.'/>';
                         	 }else{
                         	 	$data = ($count == $i) ? '&#10003' : '';
                         	 }
                         	?>
                            <td><?=$data?></td>
                      <?php }  
                         ?> 
                         </tr>
                       <?php } ?>  	
				 </table>
				 <input type="hidden" name="term" value="<?=$term_id + 1200?>">
				 <input type="hidden" name="session" value="<?=$session_id + 1200?>">
				   <input type="hidden" name="student" value="<?=$student_id + 1200?>">
                  <input type="hidden" name="class" value="<?=$class + 1200?>">
				  <?php
                     if($_SESSION['type'] == '1'){
                     	?>
                     	<button>Save</button>
                     <?php } ?>
				 </form> </div>
         
         <div class="row"> 
				<div class="col-md-6 col-xs-6 remark-info">
					<p><strong>Class Teacher Remark:</strong></p>    
					<?php 

                      if($_SESSION['type'] == '0'){
                             ?>

             <form method="POST" action="php/teachers_remark.php">
              <div class="form-group">
             <textarea name="remark" class="form-control">
              <?=isset($remark['teacher']) ? $remark['teacher'] : ''?>
              </textarea>
              <br>
          <p class="sign"><strong>Sign/Date_________________</strong> </p>

           </div>
                      
              <input type="hidden" name="term" value="<?=$term_id + 1200?>">
				     <input type="hidden" name="session" value="<?=$session_id + 1200?>">
				      <input type="hidden" name="student" value="<?=$student_id + 1200?>">
                     <input type="hidden" name="class" value="<?=$class + 1200?>"> <br>
                     <input class="btn btn-primary" type="submit">
           
              </form>
                      <?php }else{
                      	 ?>

                          <div class="form-group">
             <textarea name="remark" class="form-control" disabled="">
              <?=isset($remark['teacher']) ? $remark['teacher'] : ''?>
              </textarea>
              <br>
          <p class="sign"><strong>Sign/Date_________________</strong> </p>

           </div>
                      	  <!-- <p><?=(!empty($remark['teacher']) ? $remark['teacher'] : 'No remark yet')?></p> -->
                      <?php } ?>                   
                       	                    
           
					
        </div>

				<div class="col-md-6 col-xs-6 remark-info">
					<p><strong>Principal Remark: </strong></p>
						<?php 

                      if($_SESSION['type'] == '0'){
                             ?>
                      <form method="POST" action="php/principal_remark.php">
                        <div class="form-group">
                       		<textarea name="remark" class="form-control">
                       			 <?=isset($remark['principal']) ? $remark['principal'] : ''?>
                       		</textarea>
                          <br>
          <p class="sign"><strong>Sign/Date_________________</strong> </p>

                        </div>
                     <input type="hidden" name="term" value="<?=$term_id + 1200?>">
				     <input type="hidden" name="session" value="<?=$session_id + 1200?>">
				      <input type="hidden" name="student" value="<?=$student_id + 1200?>">
                     <input type="hidden" name="class" value="<?=$class + 1200?>"> <br>
                     <input class="btn btn-primary" type="submit">
           
                       	</form>
                      <?php }else{
                      	 ?>
                        <div class="form-group">
                          <textarea name="remark" class="form-control">
                             <?=isset($remark['principal']) ? $remark['principal'] : ''?>
                          </textarea>
                          <br>
          <p class="sign"><strong>Sign/Date_________________</strong> </p>

                        </div>
                      	 <!-- <p><?=(!empty($remark['principal']) ? $remark['principal'] : 'No remark yet')?></p> -->
                     <?php } ?>

        </div>
      </div>
         </div>

			</div>
              <?php }else{
              	 ?>
              	 <p style="color:red; text-align: center;" align="center">This Term Result has not been released</p>
               <?php } ?>
	
<?php }  ?>			    
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
                data:'session='+value+'&class='+"<?=$class_id + 1200?>",
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
</script>
</body>
</html>