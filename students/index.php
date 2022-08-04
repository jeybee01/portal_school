<?php 
  include 'php/functions.php';
  if(empty($class_id) or empty($session_id)){
      echo "<script>window.history.back()</script>";
      exit;
  }
 $class_obj = new Classes($class_id);
 $class_info = $class_obj->get_teacher($session_id);
$teacher = (isset($class_info['name'])) ? $class_info['name'] : 'No Teacher';
$phone = (isset($class_info['phone_number'])) ? $class_info['phone_number'] : '';
$email= (isset($class_info['email'])) ? $class_info['email'] : 'No T';
 $details = get_details($class_id,$user);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
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

            <table border="1" style="border-collapse: collapse;">
                  <tr>
                      <th>School</th>
                      <td><?=isset($details['sch']) ? $details['sch'] : ''?></td>
                  </tr>
                  <tr>
                      <th>Name</th>
                      <td><?=$_SESSION['name']?></td>
                  </tr>

                  <tr>
                      <th>Class</th>
                      <td><?=$class_obj->get('name')?></td>
                  </tr>
                  <tr>
                      <th>Class Teacher</th>
                      <td><?=$teacher?></td>
                  </tr>
                  <tr>
                      <th>Teachers Phone</th>
                      <td><?=$phone?></td>
                  </tr>
                   <tr>
                      <th>Teachers Email</th>
                      <td><?=$email?></td>
                  </tr>



            </table>   

         </div>
          
     </div>


       
</body>
</html>