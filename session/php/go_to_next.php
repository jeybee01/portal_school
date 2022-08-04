<?php 
   include '../../functions.php';
  if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
   }
   
   $user_id = getId();
  
   // get the current session
  $sql = "SELECT * FROM session WHERE user_id = '$user_id' ORDER BY id DESC";
  $run =  $db->query($sql);
  $session = $run->fetch_assoc(); 

  if(count($session) == 0){
  echo "<script>alert('An Error occcured');window.history.back()</script>";
           return;
 }
  $session = $session['id'];
  
     // get the current term
   $sql = "SELECT * FROM term WHERE session = '$session' ORDER BY id DESC";
   $run = $db->query($sql);
   $term = $run->fetch_assoc();
  
    if($term['name'] == 'First')
    	$term = 'Second';
   else if($term['name'] == 'Second')
         $term = 'Third';
   else{
   	  header('location:../index.php');
   	  exit;
   }
  
   echo   $sql = "INSERT INTO `term`(`name`, `session`) VALUES ('$term','$session')";
        $run = $db->query($sql);
        if($run){
         echo "<script>alert('Successfully started ".$term." Term');window.location.href='../index.php'</script>";      
        }else{
            echo "<script>alert('An Error occcured');window.history.back()</script>";
           return;
        } 
              
 
 ?>