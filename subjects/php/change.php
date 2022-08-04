<?php 
 include '../../functions.php';
 $_SESSION['location'] = 'subjects';
 if(!isLoggedIn() or $_SESSION['type'] != '1'){
   header('location:../index.php');
 }
 $user_id = getId();
 if(isset($_POST)){
   $class = sanitize($_POST['class']);
   $class = filter_var($class,FILTER_VALIDATE_INT);

   $subject = sanitize($_POST['subject']);
   $subject = filter_var($subject,FILTER_VALIDATE_INT);

   if(!$subject or $subject == '' or $class == '' or !$class){
       echo "<script>alert('error occored');window.history.back()</script>";
       exit;
   }

    $session = sanitize($_POST['session']);
   $session = filter_var($session,FILTER_VALIDATE_INT);

   $term = sanitize($_POST['term']);
  $term = filter_var($term,FILTER_VALIDATE_INT);


    if(!$session or $session == '' or $term == '' or !$term){
       echo "<script>alert('error occored');window.history.back()</script>";
       exit;
   }

   
   $subject = $subject - 1200;
   $class= $class - 1200;


   $sql = "SELECT id FROM assign_subject WHERE teacher = '$user_id' AND class = '$class' AND subject = '$subject' ";
   $run = $db->query($sql);

    if($run->num_rows == 0){
      echo "<script>alert('error occored');window.history.back()</script>";
       exit;
   }


 $_SESSION['c_sr'] = $session - 1200;
 $_SESSION['term_id'] = $term - 1200;

 header('location:../subject_result.php?class='.($class + 1200).'&subject='.($subject + 1200));  



 }
?>