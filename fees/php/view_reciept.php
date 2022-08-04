<?php 
  include '../functions.php';
   $user_id = getId();
  if(!isLoggedIn() or $_SESSION['type'] != '3'){
   header('location:../index.php');
 }

  $sql = "SELECT user_id FROM users WHERE id = '$user_id' AND type = '3'";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();
  $admin = $info['user_id'];

  $get_fees = "SELECT fees FROM users WHERE id = '$admin'";
  $run = $db->query($get_fees);
  $my_fees = $run->fetch_assoc();
  $school_fees = $my_fees['fees'];


  if(isset($_GET['student']) && isset($_GET['term']) && isset($_GET['c'])){

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

   $get_term = "SELECT session,name FROM term WHERE id = '$term'";
   $run_qry =$db->query($get_term);
   if($run_qry->num_rows > 0){
    $my_term = $run_qry->fetch_assoc();
    $session_id = $my_term['session'];
    $term_name = $my_term['name'];
    $check = "SELECT id,name FROM session WHERE id = '$session_id' AND user_id = '$admin'";
    $run = $db->query($check);
    if($run->num_rows == 0){
      echo "<script>alert('Error occured 6');window.history.back();</script>";
       exit;
    }
    $session_info = $run->fetch_assoc();
    $session_name = $session_info['name'];

    $sql = "SELECT id,status FROM fees WHERE student = '$student' AND term = '$term'";
    $run = $db->query($sql);
    if($run->num_rows > 0){
       $info = $run->fetch_assoc();
       if($info['status'] != '1'){
         echo "<script>alert('Error occured 6');window.history.back();</script>";
         exit;
       }
    }else{
        echo "<script>alert('Error occured 6');window.history.back();</script>";
         exit;
    }

    $c = sanitize($_GET['c']);
    $c = filter_var($c,FILTER_VALIDATE_INT);
    if(!$c or $c == ''){
      echo "<script>alert('Error occured 4');window.history.back()</script>";
      exit;
    }
    $c = $c - 1200;


  $check = "SELECT * FROM class WHERE id = '$c' AND user_id = '$admin'";
  $run = $db->query($check);
  if($run->num_rows == 0){
    echo "<script>alert('Error occured 5');window.history.back();</script>";
    exit;
   }

   $class_info = $run->fetch_assoc();
   $class_name = $class_info['name'];
   $short = $class_info['short'];

  $check = "SELECT class_students.*,users.name FROM class_students INNER JOIN users WHERE class_students.student = '$student' AND class_students.session = '$session_id' AND class_students.class = '$c' AND users.id =  class_students.student";
   $run = $db->query($check);
    if($run->num_rows == 0){
    echo "<script>alert('Error occured 6');window.history.back();</script>";
    exit;
   }

   $std_info = $run->fetch_assoc();
   $student_name = $std_info['name'];



 $sql = "SELECT * FROM fees WHERE term = '$term' AND student = '$student'";
 $run = $db->query($sql);
 $fees_info = $run->fetch_assoc();
 $date_payed = $fees_info['date_of_payment'];




    



   }else{
    echo "<script>alert('Error occured 6');window.history.back();</script>";
    exit;
   }
}
?>
