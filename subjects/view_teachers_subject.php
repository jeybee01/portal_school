<?php 
 include '../functions.php';
 include '../_classes/Classes.php';
 $_SESSION['location'] = 'subjects';
 if(!isLoggedIn() or $_SESSION['type'] != '1'){
   header('location:../index.php');
 }
  $subjects = [];
  $user_id = getId();
  $sql = "SELECT  assign_subject.*,subjects.name FROM assign_subject INNER JOIN subjects WHERE assign_subject.teacher = '$user_id' AND subjects.id = assign_subject.subject ";
  $run = $db->query($sql);
  while($row = $run->fetch_assoc())$subjects[] = $row;
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
            <?php
              if(count($subjects) == 0){
                ?>
                 <h1>You are Not Taking any Subject</h1>
              <?php }else{
                  foreach($subjects as $subject){
                    $class = new Classes($subject['class']);
                     ?>
                 <a href="subject_result.php?class=<?=$subject['class'] + 1200?>&subject=<?=$subject['subject'] + 1200?>"> 
                     <div class="content-container-card" style="background-color:#1c3b5f;color: #fff;">
                        <h1><?=$subject['name']?></h1>
                        <h1><?=$class->get('name').' ('.$class->get('short').')'?></h1>
                    </div>
              </a>

                  
              <?php } } ?>
                         </div>
          
     </div>
       
</body>
</html>