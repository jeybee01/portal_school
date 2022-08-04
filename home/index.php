<?php 
 include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 header('location:../index.php')
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
          <a href="p"> 
               <div class="content-container-card">
                    <i class="icofont-bag-alt  book-icon"></i>
                    <h1> Add Teacher</h1>
                </div>
            </a>
            <a href="teacher/manageteachers.php">
                 <div class="content-container-card">
                    <i class="icofont-bag-alt  book-icon"></i>
                    <h1> Manage Teacher</h1>
                </div>
              </a>
          </div>
          
     </div>
       
</body>
</html>