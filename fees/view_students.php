<?php 
  include 'php/functions.php';   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/class.css">
    <link rel="stylesheet" type="text/css" href="../icofont/icofont.css">
     <link rel="stylesheet" type="text/css" href="../icofont/icofont.min.css">
    <title>My Admin</title>
</head>
<body>
  
       <?php include '../includes/menu.php'?>  
    
    
     <div class="wrapper-container">
      <div id="header">
         <h1 style="text-align: center;">Dashboard</h1>
         <i class="icofont-navigation-menu  menu-icon"></i>
      </div>

        <div class="content-container">
           <h1>List of <?=$class->get('short')?> Students</h1>
           <?php
              if(count($students) == 0){
                ?>
                <p>There is no student in your class yet</p>
              <?php 

                }else{
                  ?>
                  <table>
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Of Birth</th>
                    <?php
                     foreach($terms as $term){
                         ?>
                         <th><?=$term['name']?></th>
                     <?php } ?>
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
                  <?php
                   foreach($terms as $term){
                      if(has_paid($student['id'],$term['id'])){
                         ?>
                         <td>
                             <a href="view_reciept.php?student=<?=$student['id'] + 1200?>&term=<?=$term["id"] + 1200?>&c=<?=$class_id + 1200?>">View Reciept</a> <br><br>
                             <a style="color:blue;cursor: pointer;" onclick="change_status('<?=$student["id"] + 1200?>','<?=$term["id"] + 1200?>','-1')">Cancel Payment</a> <br><br>
                             Status: <span style="color:green;">
                                 Paid
                             </span>
                         </td>
                      <?php }else{
                          ?>
                          <td>
                            <a style="color:blue;cursor: pointer;" onclick="change_status('<?=$student["id"] + 1200?>','<?=$term["id"] + 1200?>','1')">Confirm Payment</a> <br> <br>
                            Status: <span style="color:red">
                                    Not paid
                                    </span>  
                          </td>  
                   <?php }  } ?>             
               </tr>
               <?php } }?>
           </table>
          </div>
          
     </div>
       
</body>
  
     <script type="text/javascript">
       
                function change_status(student,term,status) {
                    var text = (status == '1') ? 'Confirm' : 'Cancel';
                    var c = "<?=$class_id + 1200?>"
                   if(confirm('Are you sure you want to '+text+' payment')){
                      window.location.href = "php/respond.php?student="+student+"&term="+term+"&status="+status+'&c='+c;
                   }
                }

     </script>
</html>