<?php 
 include 'php/resumption.php';
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
    <style type="text/css">
       .card p{
         color: red;
         font-family: sans-serif;
         font-size: 14pt;
         text-align: right;
       }
    </style>
</head>
<body>
  
     <?php include '../includes/menu.php'?>  
    
     <div class="wrapper-container">
      <div id="header">
         <h1 style="text-align: center;">Dashboard</h1>
         <i class="icofont-navigation-menu  menu-icon"></i>
      </div>
       <form method="POST" action="php/set_date.php">
        <div class="content-container">
           <h1>Resumption Date</h1>
            <hr>
            <div class="card">
                <label>Enter Resumption Date</label>
                <input type="date" name="date" value="<?=(isset($termInfo['resumption_date'])) ? $termInfo['resumption_date'] : ''?>" min="<?=date('Y-m-d')?>" >
                <input type="hidden" name="session" value="<?=$session + 1200?>">
                <input type="hidden" name="term" value="<?=$term + 1200?>">

                <?php
                 if(isset($_SESSION['errors']['date'])){
                  ?>
                  <p><?=$_SESSION['errors']['date']?></p>
               <?php } ?>
            </div>
    
                <div id="classbtn">
                  <button type="submit">Set Date</button>
              </div>
            <?php unset($_SESSION['errors']);?>  
          </div>
        </form>
          
     </div>
       
</body>
</html>