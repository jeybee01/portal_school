<?php include 'php/result.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../icofont/icofont.css">
     <link rel="stylesheet" type="text/css" href="../icofont/icofont.min.css">
     <link rel="stylesheet" type="text/css" href="../css/student_result.css">
    <title>My Admin</title>
</head>
<body>
  
    <?php include '../includes/menu.php'?>
    
    
     <div class="wrapper-container">

     	<div class="container">
		<div class="title">
			<h1><?=$school['name']?></h1>
			<p>Motto:<?=$school['motto']?></p>
			<small><?=$school['address']?>.</small>
			<hr>
			
			<h3> STUDENT TERM RESULT</h3>

			    <div align="center">
        <form method="POST" action="php/change_2.php"> 
             <select name="session" onchange="change_term(this)">
                <?php
                  foreach($sessions as $s){
                     $selected = ($s['id'] == $session_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
            </select>
            <select name="term">
                <?php
                  foreach($terms as $s){
                     $selected = ($s['id'] == $term_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
                  <input type="hidden" name="student" value="<?=$student_id + 1200?>">
                  <input type="hidden" name="class" value="<?=$class + 1200?>">
            </select>
            <button>Change</button>
          </form>
  

        </div>
			
		</div>
		<hr>
		<div class="row">

<?php if(!empty($_SESSION['msg'])){ ?>

                    <p style="color:red;" align="center"><?=$_SESSION['msg']?></p>

<?php 

		unset($_SESSION['msg']); 
	}else{

?>

		

<?php // check if result is released\


              if($_SESSION['type'] == '1' or $_SESSION['type'] == '0' or ($_SESSION['type'] == '2' and $term_status == '1')){
              	?>
              	 <div class="table-head">
				<div class="info">
					<p>Name: <strong><?=$student['name']?></strong></p>
					<p>Admision No: <strong><?=$student['reg_num']?></strong></p>
					<p>DOB: <strong><?=$dob?></strong></p>
					<p>School resumes:  <strong><?=$resumption_date?></strong></p>

				</div>
				<div class="info">
					<p>Class: <strong> <?=$class_obj->get('short')?></strong></p>
					<p>Total Scores<strong><?=$total_scores?></strong></p>
					<p>Total Average  <strong><?=$total_average?></strong></p>
					<p>No Of pupil in Class: <strong> <?=$class_obj->get_num_of_students($session_id)?></strong></p>
					<p>Position: <strong><?=$std_pos?></strong> </p>

				</div>

			</div>
              	<table>
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
			<table>
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
				
			</table>
			 <div class="table-footer">

				<div class="info">
			    <form method="POST" action="php/behaviour.php">		
				  <table>
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
				 </form> 

				</div>
           

				<div class="info">
					<p><strong>Class Teacher Remark:</strong></p>    
					<?php 

                      if($_SESSION['type'] == '1'){
                             ?>
                      <form method="POST" action="php/teachers_remark.php">
                       		<textarea name="remark">
                       			 <?=isset($remark['teacher']) ? $remark['teacher'] : ''?>
                       		</textarea>
                     <input type="hidden" name="term" value="<?=$term_id + 1200?>">
				     <input type="hidden" name="session" value="<?=$session_id + 1200?>">
				      <input type="hidden" name="student" value="<?=$student_id + 1200?>">
                     <input type="hidden" name="class" value="<?=$class + 1200?>"> <br>
                     <input type="submit">
           
                       	</form>
                      <?php }else{
                      	 ?>
                      	  <p><?=(!empty($remark['teacher']) ? $remark['teacher'] : 'No remark yet')?></p>
                      <?php } ?>                   
                       	                    
           
					
					<p class="sign"><strong>_________________</strong> </p>
				</div>

				<div class="info">
					<p><strong>Principal Remark: </strong></p>
						<?php 

                      if($_SESSION['type'] == '0'){
                             ?>
                      <form method="POST" action="php/principal_remark.php">
                       		<textarea name="remark">
                       			 <?=isset($remark['principal']) ? $remark['principal'] : ''?>
                       		</textarea>
                     <input type="hidden" name="term" value="<?=$term_id + 1200?>">
				     <input type="hidden" name="session" value="<?=$session_id + 1200?>">
				      <input type="hidden" name="student" value="<?=$student_id + 1200?>">
                     <input type="hidden" name="class" value="<?=$class + 1200?>"> <br>
                     <input type="submit">
           
                       	</form>
                      <?php }else{
                      	 ?>
                      	 <p><?=(!empty($remark['principal']) ? $remark['principal'] : 'No remark yet')?></p>
                     <?php } ?>

					<p class="sign"><strong>_________________</strong> </p>

				</div>

			</div>
              <?php }else{
              	 ?>
              	 <p style="color:red" align="center">This Term Result has not been released</p>
               <?php } ?>
	
<?php }  ?>	
			
			
		</div>
		
	</div>
    
          
     </div>
</body>
 <script src="../jquery/jquery.min.js"></script>
  <script type="text/javascript">
  	
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
</html>