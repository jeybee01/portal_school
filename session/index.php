<?php 
 include '../functions.php';
 $_SESSION['location'] = 'session';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
 $sessions = [];
 $user_id = getId();
$sessions = [];
 $sql = "SELECT session.id As session_id,session.name AS session_name,term.* FROM session INNER JOIN term WHERE session.user_id = '$user_id' AND term.session = session.id ORDER BY id DESC";
 $run =  $db->query($sql);
 if(!$run)echo $db->error;
 while($row = $run->fetch_assoc())$sessions[] = $row;
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
           
            <?php
              if(count($sessions) == 0){
                ?>
            <form method="POST" action="php/add_session.php" id="my_form">
               <h1> Add Session</h1>
               <hr>
                <div class="card">
                    <label>Name</label>
                    <input type="text" name="session" required style="border:1px solid #1c3b5f" id="my_input">
                </div>
                 <div class="card1" align="center">
                <button type="submit">Add</button>
                </div>
           </form>
          <?php } else{        
                 ?>
              <h1>Manage Session</h1> 
              <table>
                  <tr>
                    <th>S/n</th>
                    <th>Name</th>
                    <th>Present Term</th>
                    <th colspan="5">Action</th>
                 </tr>
                <?php 
                 $counter = 1;
                 foreach ($sessions as $session) {
                 $term = $session['id'];
                $next_term = false;
                if(trim($session['name']) == 'Second')
                    $next_term = true;
                else if(trim($session['name']) == 'First')
                    $next_term = true;  
                  ?>
                <tr>
                 <td><?=$counter?></td>
                 <td><?=$session['session_name']?></td>
                 <td><?=$session['name']?></td>
                 <td>
                    <?php 
 
                           if($next_term and $counter++ == 1){
                            ?>
                            <a onclick="go_next()" style="color:blue;text-decoration: underline;cursor: pointer;">go to next term</a>
                           <?php }else if(!$next_term and $counter++ == 1){
                             ?>
                             <a onclick="start_session('<?=$session['session_name']?>')" style="color:blue;text-decoration: underline;cursor: pointer;">Start new session</a>
                         <?php }else{
                              ?>
                              <small style="color:red">Term Completed</small>
                         <?php } ?>
                 </td>
                     <?php
                       if($session['status'] == '0'){
                        ?>
                        <td colspan="5"><a href="resumption_date.php?session=<?=$session['session_id'] + 1200?>&term=<?=$session['id'] + 1200?>">Release Result</a></td>
                       <?php }else{
                          $resumption=date_create($session['resumption_date']);
                           $resumption =  date_format($resumption,"d M Y");
                         ?>
                         <td><small style="color:green">Result Released</small></td>
                         <td><?=$resumption?></td>
                         <td><a href="hold.php?session=<?=$session['session_id'] + 1200?>&term=<?=$session['id'] + 1200?>">Hold Result</a><td>
                         <td><a href="resumption_date.php?session=<?=$session['session_id'] + 1200?>&term=<?=$session['id'] + 1200?>">Edit Resumption Date</a></td>
                       <?php } ?>

               </tr>
             <?php  } } ?>
            </table>
      </div>
          
     </div>

     
     <script type="text/javascript">
       
                function go_next(){
                   if(confirm('Are you sure you want to go to next term')){
                      window.location.href = 'php/go_to_next.php';
                   }
                }

                function start_session(year){
                   if(confirm('Are you sure you want to start new session')){
                      year = year.split("/")[1];
                      if(year){
                        new_year = parseInt(year) + 1;
                        session = year+'/'+new_year;
                        window.location.href = 'php/add_session_2.php?session='+session;
                      }
                    }

                  
                }


                

     </script>
     </body>
</html>