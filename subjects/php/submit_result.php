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

   $session_id = $session - 1200;
   $term_id = $term - 1200;

   $sql = "SELECT users.user_id,scores.* FROM users INNER JOIN scores WHERE users.id = '$user_id' AND scores.admin_id = users.user_id";
   $run = $db->query($sql);
   $assessment = $run->fetch_assoc();

   if(!isset($assessment)){
      echo "<script>alert('Error occured 1');window.history.back()</script>";
      exit();
   }

  $students = [];
  $sql = "SELECT class_students.student,users.reg_num FROM class_students INNER JOIN users WHERE class_students.session = '$session_id' AND class_students.class = '$class' AND users.id = class_students.student";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$students[] = $row;

 
 $term_scores = [];
foreach($students as $std){
  $reg_num = $std['reg_num'];
  $first_test = (isset($_POST[$reg_num.'_1st_ca']) and filter_var($_POST[$reg_num.'_1st_ca'],FILTER_VALIDATE_INT)) ? $_POST[$reg_num.'_1st_ca'] : 0;
  $second_test = (isset($_POST[$reg_num.'_2nd_ca']) and filter_var($_POST[$reg_num.'_2nd_ca'],FILTER_VALIDATE_INT))  ? $_POST[$reg_num.'_2nd_ca'] : 0;
  $exams = (isset($_POST[$reg_num.'_exam']) and filter_var($_POST[$reg_num.'_exam'],FILTER_VALIDATE_INT))  ? $_POST[$reg_num.'_exam'] : 0;
  $term_scores[$reg_num] = array('first_test'=>$first_test,'second_test'=>$second_test,'exams'=>$exams);
}

  $total_scores = [];

  foreach($term_scores as $tk=>$tv){
     $total_scores[$tk] = $tv['first_test'] + $tv['second_test'] + $tv['exams'];
  }

  $positions = get_positions($total_scores);



 foreach ($students as $student) {
   $reg_num = $student['reg_num'];
   $student_id = $student['student'];
   $first_test = 0;
   $second_test = 0;
   $exam = 0;
   if(isset($_POST[$reg_num.'_1st_ca'])){ 
       $first_test = sanitize($_POST[$reg_num.'_1st_ca']);
       $first_test = filter_var($first_test,FILTER_VALIDATE_FLOAT);
       if(($first_test == '' or !$first_test or $first_test > $assessment['first']) and $first_test != 0){
        $first_test = 0;
         $_SESSION['errors'][$reg_num.'_1st_ca'] = 'scores invalid or higher than the overrall marks';
    }
   }

  if(isset($_POST[$reg_num.'_2nd_ca'])){ 
       $second_test = sanitize($_POST[$reg_num.'_2nd_ca']);
       $second_test = filter_var($second_test,FILTER_VALIDATE_FLOAT);
       if(($second_test == '' or !$second_test or $second_test > $assessment['second']) and $second_test != 0){
        $second_test = 0;
        $_SESSION['errors'][$reg_num.'_2nd_ca'] = 'scores invalid or higher than the overrall marks';
    }
  }

   if(isset($_POST[$reg_num.'_exam'])){ 
       $exam = sanitize($_POST[$reg_num.'_exam']);
       $exam = filter_var($exam,FILTER_VALIDATE_FLOAT);
       if(($exam == '' or !$exam or $exam > $assessment['exam']) and $exam != 0){
        $exam = 0;
         $_SESSION['errors'][$reg_num.'_exam'] = 'scores invalid or higher than the overrall marks';
    }
  }



    $std_pos = isset($positions[$reg_num]) ? $positions[$reg_num] : 'N/A';



   $sql = "SELECT id FROM results WHERE student_id = '$student_id' AND class = '$class' AND subject_id = '$subject' AND term = '$term_id'";
   $run = $db->query($sql);

   if($run->num_rows == 0)
      $sql = "INSERT INTO `results`(`student_id`, `subject_id`, `term`, `class`, `first_test`, `second_test`, `exams`,`position`) VALUES ('$student_id','$subject','$term_id','$class','$first_test','$second_test','$exam','$std_pos')";
   else 
     $sql = "UPDATE results SET first_test = '$first_test',second_test = '$second_test',exams = '$exam',position = '$std_pos' WHERE student_id = '$student_id' AND class = '$class' AND subject_id = '$subject' AND term = '$term_id'";

   $run = $db->query($sql);

   if($run){
     $executed = true;
   }else{
    $executed = false;
    break;
   }
     
 }

 if($executed){
     echo "<script>alert('Successfully uploaded scores');window.location.href='../subject_result.php?class=".($class + 1200)."&subject=".($subject + 1200)."'</script>";
   }else{
    echo "<script>alert('Error occured 1');window.history.back()</script>";
    exit();
   }



 

 }  