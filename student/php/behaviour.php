<?php 
  include '../../functions.php';
  if(!isLoggedIn() or $_SESSION['type'] != '1'){
  	  echo "<script>alert('error occored');window.history.back()</script>";
       exit;
  }
   $user_id = getId();
   $session_id = $_SESSION['sess_id'];
  if(isset($_POST)){
  	    $class = sanitize($_POST['class']);
         $class = filter_var($class,FILTER_VALIDATE_INT);

        $session = sanitize($_POST['session']);
           $session = filter_var($session,FILTER_VALIDATE_INT);
        $term_id = sanitize($_POST['term']);
          $term_id = filter_var($term_id,FILTER_VALIDATE_INT);

           $student_id = sanitize($_POST['student']);
          $student_id = filter_var($student_id,FILTER_VALIDATE_INT);

          if(!$class or $class == '' or !$term_id or $term_id == '' or !$session_id or $session_id == '' or $student_id == '' or !$student_id){
          	 echo "<script>alert('error occored 1');window.history.back()</script>";
              exit; 
          } 
         
         $term_id = $term_id - 1200;
         $session = $session - 1200;
         $student_id = $student_id - 1200;
         $class = $class - 1200;

          $sql = "SELECT id FROM class_teachers WHERE class = '$class' AND session = '$session_id' AND teacher = '$user_id'";
    

       $run = $db->query($sql);
      if($run->num_rows == 0){
      	echo "<script>alert('error occored 2 ');window.history.back()</script>";
        exit;
      }


      $get_admin = "SELECT user_id FROM users WHERE id = '$user_id'";
      $run = $db->query($get_admin);
      $admin_info = $run->fetch_assoc();

      if(!isset($admin_info)){
      	 echo "<script>alert('error occored 3');window.history.back()</script>";
       exit;
      }

      $admin = $admin_info['user_id'];

      $sql = "SELECT id FROM session WHERE user_id = '$admin' AND id = '$session'";
      $run = $db->query($sql);
      if($run->num_rows == 0){
      	 echo "<script>alert('error occored');window.history.back()</script>";
       exit;
      }

      $sql = "SELECT id FROM term WHERE session = '$session' AND id = '$term_id'";
      $run = $db->query($sql);
      if($run->num_rows == 0){
      	 echo "<script>alert('error occored');window.history.back()</script>";
       exit;
      }









  //get all the behaviour

       $attendance = sanitize($_POST['attendance']);
        $attendance = filter_var($attendance,FILTER_VALIDATE_INT);
       $skills = sanitize($_POST['skills']);
        $skills = filter_var($skills,FILTER_VALIDATE_INT);
      $punctuality = sanitize($_POST['punctuality']);
        $punctuality = filter_var($punctuality,FILTER_VALIDATE_INT);
      $neatness = sanitize($_POST['neatness']);
        $neatness = filter_var($neatness,FILTER_VALIDATE_INT);
       $politeness = sanitize($_POST['politeness']);
        $politeness = filter_var($politeness,FILTER_VALIDATE_INT);
      $self_control = sanitize($_POST['self_control']);
        $self_control = filter_var($self_control,FILTER_VALIDATE_INT);
       $relationship = sanitize($_POST['relationship']);
        $relationship = filter_var($relationship,FILTER_VALIDATE_INT);
       
  
        if(empty($attendance)or empty($skills) or empty($punctuality)or empty($neatness) or empty($politeness) or empty($self_control) or empty($relationship)){
            echo "<script>alert('Mark All behaviours');window.history.back()</script>";
           exit;    
        }


        $sql = "SELECT id FROM behaviour WHERE term = '$term_id' AND student_id = '$student_id'";

        $run = $db->query($sql);
        if($run->num_rows == 0){
          $sql = "INSERT INTO `behaviour`( `attendance`, `skills`, `punctuality`, `neatness`, `politeness`, `self_control`, `relationship`, `term`, `student_id`) VALUES ('$attendance','$skills','$punctuality','$neatness','$politeness','$self_control','$relationship','$term_id','$student_id')";
        }else{
          $sql = "UPDATE `behaviour` SET `attendance`='$attendance',`skills`='$skills',`punctuality`='$punctuality',`neatness`='$neatness',`politeness`='$politeness',`self_control`='$self_control',`relationship`='$relationship' WHERE term = '$term_id' AND student_id = '$student_id'";
        }

        $run = $db->query($sql);
        if($run){
            echo "<script>alert('Successfully marked behaviour');window.location.href='../result.php?std=".($student_id + 1200)."&class=".($class+1200)."'</script>";
           exit;    
        }else{
           echo "<script>alert('error occured');window.history.back()</script>";
           exit;    
        }

  }





 ?>