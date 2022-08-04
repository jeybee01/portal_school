<?php
  include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
   $user_id = getId(); 

   if(isset($_POST)){
    $name = sanitize($_POST['session']);
 	     
         if($name == '' or !$name){
          echo "<script>alert('Enter session');window.history.back()</script>";
           return;

         }    
 	 $sql = "INSERT INTO `session`(`name`, `user_id`) VALUES ('$name','$user_id')";



 	  $run = $db->query($sql);

    if($run){
        $session_id = $db->insert_id;
        $sql = "INSERT INTO `term`(`name`, `session`) VALUES ('First','$session_id')";
        $run = $db->query($sql);
        if($run){
          $_SESSION['session'] = $name;
          $_SESSION['sess_id'] = $session_id;
         echo "<script>alert('Successfully added session');window.location.href='../index.php'</script>";      
        }else{
            echo "<script>alert('An Error occcured');window.history.back()</script>";
           return;
        } 
      
       
  	   }else{
   	      echo "<script>alert('An Error occcured');window.history.back()</script>";
           return;
   }  
 }
 
 ?>	