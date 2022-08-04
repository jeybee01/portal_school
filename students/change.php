<?php 
include '../functions.php';
  if(isset($_POST)){
    $session_i = sanitize($_POST['session']);
    $session_i = filter_var($session_i,FILTER_VALIDATE_INT);

    if(!empty($session_i)){
        $_SESSION['class_mate_session'] = $session_i - 1200;
    }

  }

  header('location:class_mates.php');

 ?>