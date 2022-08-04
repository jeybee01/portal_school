<?php 
 include '../../functions.php';
  $_SESSION['location'] = 'burser';
 if(!isLoggedIn() or $_SESSION['type'] != '3'){
   header('location:../index.php');
 }
 $classes = [];
 $user_id = getId();

  $sql = "SELECT user_id FROM users WHERE id = '$user_id' AND type = '3'";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();
  $admin = $info['user_id'];



  if(isset($_GET['student']) && isset($_GET['term']) && isset($_GET['status']) && isset($_GET['c'])){

    $student = sanitize($_GET['student']);
    $student = filter_var($student,FILTER_VALIDATE_INT);
    if(!$student or $student == ''){
      echo "<script>alert('Error occured 1');window.history.back()</script>";
      exit;
    }
    $student = $student - 1200;


    $term = sanitize($_GET['term']);
    $term = filter_var($term,FILTER_VALIDATE_INT);
    if(!$term or $term == ''){
      echo "<script>alert('Error occured 2');window.history.back()</script>";
      exit;
    }
    $term = $term - 1200;

   $get_term = "SELECT session FROM term WHERE id = '$term'";
   $run_qry =$db->query($get_term);
   if($run_qry->num_rows > 0){
    $my_term = $run_qry->fetch_assoc();
    $session_id = $my_term['session'];
    $check = "SELECT id FROM session WHERE id = '$session_id' AND user_id = '$admin'";
    $run = $db->query($check);
    if($run->num_rows == 0){
      echo "<script>alert('Error occured 6');window.history.back();</script>";
       exit;
    }

   }else{
    echo "<script>alert('Error occured 6');window.history.back();</script>";
    exit;
   }

    $status = sanitize($_GET['status']);
    $status = filter_var($status,FILTER_VALIDATE_INT);
    if(!$status or $status == '' or ($status == '1' and $status == '-1')){
      echo "<script>alert('Error occured 3');window.history.back()</script>";
      exit;
    }

    $c = sanitize($_GET['c']);
    $c = filter_var($c,FILTER_VALIDATE_INT);
    if(!$c or $c == ''){
      echo "<script>alert('Error occured 4');window.history.back()</script>";
      exit;
    }
    $c = $c - 1200;


  $check = "SELECT id FROM class WHERE id = '$c' AND user_id = '$admin'";
  $run = $db->query($check);
  if($run->num_rows == 0){
    echo "<script>alert('Error occured 5');window.history.back();</script>";
    exit;
   }

  $check = "SELECT id FROM class_students WHERE student = '$student' AND session = '$session_id' AND class = '$c'";
   $run = $db->query($check);
  if($run->num_rows == 0){
    echo "<script>alert('Error occured 6');window.history.back();</script>";
    exit;
   }




     
     $date = date('d/m/Y');

     $sql = "SELECT id FROM fees WHERE term = '$term' AND student = '$student'";
     $run = $db->query($sql);
     if($run->num_rows > 0){
       $sql = "UPDATE fees SET status = '$status',date_of_payment = '$date' WHERE term = '$term' AND student = '$student'";
     }else{
       $sql = "INSERT INTO `fees`(`term`, `student`, `date_of_payment`, `status`) VALUES ('$term','$student','$date','$status')";
     }
    
     $run = $db->query($sql);
     $text = ($status == '1') ? 'Confirmed' : 'Cancelled';
     if($run){
      echo "<script>alert('Successfully ".$text." Payment');window.location.href='../view_students.php?class=".($c + 1200)."'</script>";
    exit;
     }else{
      echo "<script>alert('Error occured 7');window.history.back()</script>";
        exit;
     }


 }else{
    echo "<script>alert('Error occured 8');window.history.back()</script>";
    exit;
  }


 ?> 