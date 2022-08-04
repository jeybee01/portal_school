<?php
  include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
  $user = getId();

  if(isset($_GET['session']) and isset($_GET['term'])){

    $session = sanitize($_GET['session']);
      $session = filter_var($session,FILTER_VALIDATE_INT);
    $term = sanitize($_GET['term']);
       $term = filter_var($term,FILTER_VALIDATE_INT);

       if (empty($term) or empty($session)) {
           	echo "<script>alert('error occured');window.history.back()</script>";
  	       exit();
       }

       $session = $session - 1200;
       $term  = $term - 1200;

       $sql = "SELECT session.id,term.* FROM session INNER JOIN term WHERE session.id = '$session' AND term.id = '$term' AND term.session = session.id AND session.user_id = '$user'";
       $run = $db->query($sql);
       if($run->num_rows == 0){
       	  	echo "<script>alert('error occured');window.history.back()</script>";
        	exit();
       }

       
  $sql = "UPDATE term SET status = '0' WHERE id = '$term'";
   $run = $db->query($sql);
   if($run){
      echo "<script>alert('Successfully hold result');window.location.href='index.php'</script>";
      exit();
   }else{
        echo "<script>alert('error occured');window.history.back()</script>";
       exit();
   }

  }else{
  	echo "<script>alert('error occured');window.history.back()</script>";
  	exit();
  }