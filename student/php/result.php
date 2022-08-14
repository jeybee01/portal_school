<?php 
 include '../functions.php';
 include '../_classes/Classes.php';
  if(!isLoggedIn()){
   header('location:../index.php');
 }
 $_SESSION['location'] = ($_SESSION['type'] == '2') ? 'result' : 'classes';
 $user_id = getId();
 if(!isset($_GET['std']) and $_SESSION['type'] != '2'){
    echo "<script>alert('Error occured ');window.history.back();</script>";
    exit;
 }else{
 	$student_id = isset($_GET['std']) ? sanitize($_GET['std']) : $user_id + 1200;
 	$student_id = filter_var($student_id,FILTER_VALIDATE_INT);

 	if($student_id == '' or !$student_id){
 		 echo "<script>alert('Error occured');window.history.back();</script>";
        exit;
 	}

 	$student_id = $student_id - 1200;
 }

 if($_SESSION['type'] == '0' and isset($_GET['class'])){
   
   $class  = sanitize($_GET['class']);
   $class = filter_var($class,FILTER_VALIDATE_INT);

   if(!$class or $class == ''){
   	 echo "<script>alert('Error occured 1');window.history.back();</script>";
     exit;
   }

   $class = $class - 1200;

   $sql = "SELECT id FROM class WHERE id = '$class' AND user_id = '$user_id'";
   $run = $db->query($sql);

   if($run->num_rows == 0){
   	 	echo "<script>alert('Error occured 2');window.history.back();</script>";
        exit;
   }

   $admin_id = $user_id;



 }else if($_SESSION['type'] == '1' and isset($_GET['class'])){
   
   $session_id = $_SESSION['sess_id'];
   $class  = sanitize($_GET['class']);
   $class = filter_var($class,FILTER_VALIDATE_INT);
   if(!$class or $class == ''){
   	 echo "<script>alert('Error occured');window.history.back();</script>";
     exit;
   }
   $class = $class - 1200;

   $sql = "SELECT id FROM class_teachers WHERE teacher = '$user_id' AND session = '$session_id' AND class = '$class'";
   $run = $db->query($sql);
   if($run->num_rows == 0){
   	 echo "<script>alert('Error occured ');window.history.back();</script>";
     exit;
   }

   $sql = "SELECT user_id FROM users WHERE id = '$user_id'";
   $run = $db->query($sql);
   $info = $run->fetch_assoc();
   if(!isset($info)){
     echo "<script>alert('Error occured');window.history.back();</script>";
     exit;
   }

   $admin_id = $info['user_id'];




 }else if($_SESSION['type'] == '2'){

   if($student_id != $user_id){
   	 echo "<script>alert('Error occured');window.history.back();</script>";
     exit;
   }

   $sql = "SELECT class_students.class,class.user_id,class.id AS class_id FROM class_students INNER JOIN class WHERE class_students.student = '$student_id' AND class.id = class_students.class ORDER BY class_students.id DESC";

   $run = $db->query($sql);
   $info = $run->fetch_assoc();

   if(!isset($info)){
   	 echo "<script>alert('Error occured 1');window.history.back();</script>";
     exit;
   }

   $admin_id = $info['user_id'];
   $class = $info['class_id'];
 }else{
 	echo "<script>alert('Error occured');window.history.back();</script>";
    exit;
 }

// get the school details
 $sql = "SELECT * FROM school WHERE admin_id = '$admin_id'";
 $run = $db->query($sql);
 $school = $run->fetch_assoc();
 if(!isset($school)){
 	 echo "<script>alert('Error occured');window.history.back();</script>";
     exit;
 }



 // get session

 $sessions = get_sessions_list($admin_id);

 if(isset($_SESSION['c_sess']))
    $session_id = $_SESSION['c_sess'];
 else if(isset($_SESSION['c_s']))
     $session_id = $_SESSION['c_s'];
  else
    $session_id = $_SESSION['sess_id']; 


    //$session_id = isset($_SESSION['c_sess']) ? $_SESSION['c_sess'] : $_SESSION['sess_id'];
    $term_id = isset($_SESSION['term']) ? $_SESSION['term'] : get_term($session_id)['id'];

  $terms = [];
 $sql = "SELECT * FROM term WHERE session = '$session_id'";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$terms[] = $row;


 // student details

$sql = "SELECT * FROM users WHERE id = '$student_id'";
$run = $db->query($sql);
$student = $run->fetch_assoc();
 if(!isset($student)){
 	 echo "<script>alert('Student Does not exist');window.history.back();</script>";
     exit;
 }



$dob=date_create($student['dob']);
$dob =  date_format($dob,"d M Y");

 
 // get resumption date

 $sql = "SELECT session.id,session.name AS session_name,term.* FROM session INNER JOIN term WHERE session.id = '$session_id' AND term.id = '$term_id' AND term.session = session.id";
 $run = $db->query($sql);
 $term_info = $run->fetch_assoc();
 $resumption_date = (!empty($term_info['resumption_date'])) ? $term_info['resumption_date'] : 'N/A';
 $term_name = (!empty($term_info['name'])) ? $term_info['name'].' term' : 'N/A';
 $session_name = (!empty($term_info['session_name'])) ? $term_info['session_name'] : 'N/A';
 $term_status = (!empty($term_info['status'])) ? $term_info['status'] : '0';
  if($resumption_date!='N/A'){
    $resumption_date=date_create($resumption_date);
    $resumption_date =  date_format($resumption_date,"d M Y");
  }


// get class details;


$sql = "SELECT class FROM class_students WHERE student = '$student_id' AND session = '$session_id'";
$run = $db->query($sql);
$class_info = $run->fetch_assoc();
 if(!isset($class_info)){
 	 $_SESSION['msg'] = 'Student did not register this session';
   $class_id = 0;
 }else{
  $class_id = $class_info['class'];
 $class_obj = new Classes($class_id);
  // getting the student result 
$results = [];
 $sql = "SELECT first_test,second_test,exams,position,subject_id,(first_test+second_test+exams) AS total FROM results WHERE term = '$term_id' AND student_id = '$student_id' AND class = '$class_id'";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$results[$row['subject_id']] = $row;
         if(count($results) == 0){
            $_SESSION['msg'] = 'No result for this term yet';
         }else{
// get behaviour
 $sql = "SELECT * FROM behaviour WHERE student_id = '$student_id' AND term = '$term_id'";
 $run = $db->query($sql);
 $behaviours = $run->fetch_assoc();

 $behaviour = array('Attendance','Skills','Punctuality','Neatness','Politeness','Self Control','RelationShip');

// get remarks

 $sql = "SELECT * FROM remarks WHERE student_id = '$student_id' AND term = '$term_id'";
 $run = $db->query($sql);
 $remark = $run->fetch_assoc();

 // get the class Subjects;

 $subjects = $class_obj->getSubjects($admin_id);



// get total score

 $sql = "SELECT SUM(first_test+second_test+exams) AS total,student_id, position FROM results WHERE term = '$term_id' AND class = '$class_id'GROUP BY student_id";
 $run = $db->query($sql);
 while($row = $run->fetch_assoc())$student_result[$row['student_id']] = $row;


 $total_scores = (!empty($student_result[$student_id]['total'])) ? $student_result[$student_id]['total'] : '0';
 $total_average = $total_scores/count($subjects);
$std_pos = (!empty($student_result[$student_id]['position'])) ? $student_result[$student_id]['position'] : 'N/A';
if($std_pos != 'N/A')
    $std_pos = $std_pos.''.get_last((int)substr($std_pos, -1));
  }


 }




 function get_grade($scores)
{
  if($scores>=70 && $scores <=100)
      return 'A';
  else if($scores>=60 && $scores<=69)
      return 'B';
  else if($scores>=50 && $scores <= 59)
      return 'C';
 else if($scores>=40 && $scores <= 49)
      return 'D';
 else   
     return 'F';


}

 ?>