<?php 
  include 'php/functions.php';
   if(!isset($info)){
    echo "<script>window.history.back();</script>";
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../teachers/teacher.css">
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
          <form method="POsT" action="php/add_student.php">
           <h1>Add Student to your Class (<?=$class->get('short')?>)</h1>
           <hr>
            <div class="card">
                <label>Name</label>
                <input type="text" name="fullname" required>
            </div>
             <div class="card">
                <label>Registration Number</label>
                <input type="text" name="reg_num" required>
            </div>
             <div class="card">
                <label>Phone</label>
                <input type="number" name="phone" required>
            </div>
             <div class="card">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="card">
                <label>Gender</label>
                <select required name="gender">
                  <option value="1">Male</option>
                   <option value="2">Female</option>
                </select>
            </div>
            <div class="card">
                <label>Date Of Birth</label>
                <input type="date" name="dob" max="<?=date('Y') - 1?>-01-01" required>
            </div>
            <div class="card">
                <label>State of Origin</label>
                <input type="text" name="state" required>
            </div>
            
                <div id="classbtn">
                  <button type="submit">Save</button>
               </div>
          
          </div>
          
     </div>
       
</body>
</html>