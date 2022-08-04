<?php 
  include '../functions.php';
  include '../_classes/Classes.php';
   include '../_classes/Teacher.php';
 $_SESSION['location'] = 'classes';
 if(!isLoggedIn()){
   header('location:../index.php');
 }
 $user_id = getId();



 if($_SESSION['type']=='1'){
   $get_admin = "SELECT user_id FROM users WHERE id = '$user_id'";
   $run_get = $db->query($get_admin);
   $info = $run_get->fetch_assoc();
   $admin = $info['user_id'];
   $sessions = get_sessions_list($admin);
    $session_id = isset($_SESSION['c_s']) ? $_SESSION['c_s'] : $_SESSION['sess_id'];
     $sql = "SELECT id,class FROM class_teachers WHERE teacher = '$user_id' AND session = '$session_id'";
      $run = $db->query($sql);
      $info = $run->fetch_assoc();
      if(isset($info)){
      $class_id = $info['class'] ;
      $class = new Classes($class_id);
      $teacher = new Teacher($user_id);
     
      $admin = $teacher->get('user_id');
      
       $check = "SELECT id FROM class WHERE id = '$class_id' AND user_id = '$admin'";
      $run = $db->query($check);
      if($run->num_rows == 0){
        echo "<script>alert('Error occured');window.history.back();</script>";
        exit;
      }


     }
 }else if($_SESSION['type'] == '0' && isset($_GET['class'])){
  $class_id = sanitize($_GET['class']);
  $class_id = $class_id - 1200;
  $sql = "SELECT id FROM class WHERE id = '$class_id' AND user_id = '$user_id'";
  $run = $db->query($sql);
  if($run->num_rows == 0){
    //echo "<script>alert('Error occured 1');window.history.back();</script>";
        exit;
  }

      $class = new Classes($class_id);
      $teacher = new Teacher($user_id);

  $sessions = get_sessions_list($user_id);
  $session_id = isset($_SESSION['c_s']) ? $_SESSION['c_s'] : $_SESSION['sess_id'];



 }else{
    echo "<script>alert('Error occured');window.history.back();</script>";
        exit;
 }



?>