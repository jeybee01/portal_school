<?php
  include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
  $user = getId();

  if(isset($_POST)){
        $_SESSION['errors'] = [];

    $session = sanitize($_POST['session']);
      $session = filter_var($session,FILTER_VALIDATE_INT);
    $term = sanitize($_POST['term']);
       $term = filter_var($term,FILTER_VALIDATE_INT);
    $date = sanitize($_POST['date']);
      checkIfEmpty($date,'Resumption Date','date');
    $today = date('Y-m-d');
     
     if(strtotime($date) < strtotime($today)){
        $_SESSION['errors']['date'] = 'Resumption Date has passed';
     }



       if (empty($term) or empty($session)) {
           	echo "<script>alert('error occured');window.history.back()</script>";
  	       exit();
       }

       if(count($_SESSION['errors']) != 0){
         echo "<script>window.history.back()</script>";
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

   $sql = "UPDATE Term SET resumption_date = '$date',status = '1' WHERE id = '$term'";
   $run = $db->query($sql);
   if($run){
      echo "<script>alert('Successfully released result');window.location.href='../index.php'</script>";
      exit();
   }


  }else{
  	echo "<script>alert('error occured');window.history.back()</script>";
  	exit();
  }