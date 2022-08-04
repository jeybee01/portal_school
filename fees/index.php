<?php 
 include '../functions.php';
 include '../_classes/Classes.php';
  $_SESSION['location'] = 'burser';
 if(!isLoggedIn() or $_SESSION['type'] != '3'){
   header('location:../index.php');
 }
 $classes = [];
 $user_id = getId();

  $sql = "SELECT user_id FROM users WHERE id = '$user_id' AND type = '3'";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();
  $admin = $info['user_id'];

 $sql = "SELECT * FROM class WHERE user_id = '$admin'ORDER BY short ASC";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$classes[] = $row;
 $session_id = $_SESSION['sess_id'];
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
           <h1>Manage Class</h1>
           <?php
              if(count($classes) == 0){
                ?>
                <p>Admin has not added any Class</p>
              <?php 

                }else{
                  ?>
                  <table>
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Short</th>
                    <th>Class Teacher</th>
                    <th colspan="">Action</th>
                 </tr>
                <?php 
                 $counter = 1;
                 foreach ($classes as $c) {
                  $class = new Classes($c['id']);
                   ?>
                <tr>
                 <td><?=$counter++?></td>
                 <td><?=$c['name']?></td>
                 <td><?=$c['short']?></td>
                 <td><?=$class->get_teacher($session_id)?></td>
                <td><a href="view_students.php?class=<?=$c['id'] + 1200?>">View Students</a></td>
               </tr>
               <?php } }?>
           </table>
          </div>
          
     </div>

     
     <script type="text/javascript">
       
                function delete_class(x) {
                   if(confirm('Are you sure you want to delete')){
                      window.location.href = 'php/delete_class.php?class='+x;
                   }
                }

     </script>
       
</body>
</html>