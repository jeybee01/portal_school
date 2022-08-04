<?php 
 include '../functions.php';
 include '../_classes/Classes.php';
 $_SESSION['location'] = 'subjects';
 if(!isLoggedIn() or $_SESSION['type'] != '1'){
   header('location:../index.php');
 }
 $user_id = getId();
 if(isset($_GET['subject']) and isset($_GET['class'])){
   $class = sanitize($_GET['class']);
   $class = filter_var($class,FILTER_VALIDATE_INT);

   $subject = sanitize($_GET['subject']);
   $subject = filter_var($subject,FILTER_VALIDATE_INT);

   if(!$subject or $subject == '' or $class == '' or !$class){
       echo "<script>alert('error occored');window.history.back()</script>";
       exit;
   }
   
   $subject = $subject - 1200;
   $class= $class - 1200;

   $sql = "SELECT  assign_subject.*,subjects.name FROM assign_subject INNER JOIN subjects WHERE assign_subject.teacher = '$user_id'  AND assign_subject.subject = '$subject' AND assign_subject.class = '$class' AND subjects.id = assign_subject.subject ";
  
   $run = $db->query($sql);
   
   $info = $run->fetch_assoc();

   $subject_name = $info['name'];
   $c = new Classes($info['class']);
   $class_name = $c->get('short');

   if($run->num_rows == 0){
      echo "<script>alert('error occored');window.history.back()</script>";
       exit;
   }

   $get_admin = "SELECT user_id FROM users WHERE id = '$user_id'";
   $run_get = $db->query($get_admin);
   $info = $run_get->fetch_assoc();
   $admin = $info['user_id'];
   $sessions = get_sessions_list($admin);

    $session_id = isset($_SESSION['c_sr']) ? $_SESSION['c_sr'] : $_SESSION['sess_id'];
    $term_id = isset($_SESSION['term_id']) ? $_SESSION['term_id'] : get_term($session_id)['id'];

  $terms = [];
 $sql = "SELECT * FROM term WHERE session = '$session_id'";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$terms[] = $row;

  $sql = "SELECT users.user_id,scores.* FROM users INNER JOIN scores WHERE users.id = '$user_id' AND scores.admin_id = users.user_id";
   $run = $db->query($sql);
   $assessment = $run->fetch_assoc();

   if(!isset($assessment)){
      echo "<script>alert('Error occured 1');window.history.back()</script>";
      exit();
   }

     


   $students = [];
  $sql = "SELECT class_students.student,users.* FROM class_students INNER JOIN users WHERE class_students.session = '$session_id' AND class_students.class = '$class' AND users.id = class_students.student";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$students[] = $row;

$term_scores = [];
$term_scores_sql = "SELECT results.*,users.reg_num FROM results INNER JOIN users WHERE results.term = '$term_id' AND results.class = '$class' AND results.subject_id = '$subject' AND users.id = results.student_id";
$run = $db->query($term_scores_sql);
while($row = $run->fetch_assoc()){
  $reg_num = $row['reg_num'];
  $term_scores[$reg_num] = $row;
}

  $total_scores = [];

  foreach($term_scores as $tk=>$tv){
     $total_scores[$tk] = $tv['first_test'] + $tv['second_test'] + $tv['exams'];
  }

  $positions = get_positions($total_scores);




 }else{
   echo "<script>alert('error occored');window.history.back()</script>";
   exit;
 }



 

 ?>