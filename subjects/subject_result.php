<?php include 'php/subject_result.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/result.css">
    <link rel="stylesheet" type="text/css" href="../icofont/icofont.css">
     <link rel="stylesheet" type="text/css" href="../icofont/icofont.min.css">
    <title>My Admin</title>
    <style type="text/css">
        select{
    height: 30px;
    width: 30%;
    border-radius: 15px;
    outline: none;
    /*background-color: whitesmoke;*/
    border:1px solid whitesmoke;
    padding: 5px;
    margin: 3px 0;
}


    </style>
</head>
<body>
     <?php include '../includes/menu.php'?>  

    <div id="wrapper">
             <div id="header">
              <h1 style="text-align: center;">Dashboard</h1>
        </div>
        <div align="center">
        <form method="POST" action="php/change.php"> 
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
                  <input type="hidden" name="subject" value="<?=$subject + 1200?>">
                  <input type="hidden" name="class" value="<?=$class + 1200?>">
            </select>
            <button id="btn">Change</button>
          </form>
  

        </div>
        
          <div class="content-container">

                     
           <h1><?=$subject_name.' '.$class_name?></h1>
         <form method="POST" action="php/submit_result.php">  
              <input type="hidden" name="subject" value="<?=$subject + 1200?>">
               <input type="hidden" name="class" value="<?=$class + 1200?>">
               <input type="hidden" name="term" value="<?=$term_id + 1200?>">
               <input type="hidden" name="session" value="<?=$session_id + 1200?>">
            <table>
              <tr>
                  <th></th>
                  <th></th>
                  <th colspan="5">Score</th>
              </tr>
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
            
           <button type="submit">SAVE</button>

          </form> 
    </div>
</div>

<?php unset($_SESSION['errors']) ?>
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


  </script>
</html>