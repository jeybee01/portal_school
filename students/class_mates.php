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
          <div align="center">
        <form method="POST" action="change.php"> 
             <select name="session" style="width:50%">
                <?php
                  foreach($sessions as $s){
                     $selected = ($s['id'] == $session_id) ? 'selected' : '';
                     ?>
                   <option <?=$selected?> value="<?=$s['id'] + 1200?>"><?=$s['name']?></option>  
                  <?php } ?>
            </select>
            <button>Change</button>
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
                  <table>
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
</body>
  
     <script type="text/javascript">
       
                function remove_std(x) {
                   if(confirm('Are you sure you want to remove student')){
                      window.location.href = "php/remove.php?std="+x;
                   }
                }

     </script>
</html>