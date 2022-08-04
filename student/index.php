<?php 
  include 'php/functions.php';
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
        
        <?php
          if(isset($info)){
            ?>
               <h1 align="center" style="margin-top: 20px"><?= $class->get('name').' ('.$class->get('short').')';?></h1>
          <?php } ?>
        <div class="content-container">

             <?php 
                  if(isset($info)){
                     ?>
            <a href="add_students.php"> 
               <div class="content-container-card">
                    <i class="icofont-bag-alt  book-icon"></i>
                    <h1>Add Student</h1>
                </div>
            </a>
            <a href="view_students.php">
                 <div class="content-container-card">
                    <i class="icofont-bag-alt  book-icon"></i>
                    <h1>Manage Students</h1>
                </div>
              </a>
                  <?php }else{
                     ?>
                 <div class="content-container-card">
                    <h1>No Class has been assigned to you this session</h1>
                </div>     
                  <?php } ?>
         </div>
          
     </div>
       
</body>
</html>