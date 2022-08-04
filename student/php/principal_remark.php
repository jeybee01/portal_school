<?php 
  include '../../functions.php';
  if(!isLoggedIn() or $_SESSION['type'] != '0'){
  	  echo "<script>alert('error occored');window.history.back()</script>";
       exit;
  }
   $user_id = getId();
  if(isset($_POST)){
  	    $class = sanitize($_POST['class']);
         $class = filter_var($class,FILTER_VALIDATE_INT);

        $session = sanitize($_POST['session']);
           $session = filter_var($session,FILTER_VALIDATE_INT);
        $term_id = sanitize($_POST['term']);
          $term_id = filter_var($term_id,FILTER_VALIDATE_INT);

           $student_id = sanitize($_POST['student']);
          $student_id = filter_var($student_id,FILTER_VALIDATE_INT);

          if(!$class or $class == '' or !$term_id or $term_id == '' or !$session or $session == '' or $student_id == '' or !$student_id){
          	 echo "<script>alert('error occored 1');window.history.back()</script>";
              exit; 
          } 
         
         $term_id = $term_id - 1200;
         $session = $session - 1200;
         $student_id = $student_id - 1200;
         $class = $class - 1200;

          $sql = "SELECT id FROM class WHERE id = '$class' AND user_id = '$user_id'";
    

       $run = $db->query($sql);
      if($run->num_rows == 0){
        echo "<script>alert('error occored 2 ');window.history.back()</script>";
        exit;
      }



      $sql = "SELECT id FROM session WHERE user_id = '$user_id' AND id = '$session'";
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

      // get the principal remark

      $remark = sanitize($_POST['remark']);
     $remark = trim($remark);
      $remark = ltrim($remark);
       if(empty($remark)){
          echo "<script>alert('enter valid remark');window.history.back()</script>";
         exit;
       }

       $sql = "SELECT id FROM remarks WHERE student_id = '$student_id' AND term = '$term_id'";
       $run = $db->query($sql);
       if($run->num_rows == 0){
        $sql = "INSERT INTO `remarks`(`principal`, `teacher`, `student_id`, `term`) VALUES ('$remark','','$student_id','$term_id')";
       }else{
        $sql = "UPDATE remarks SET principal = '$remark' WHERE student_id = '$student_id' AND term = '$term_id'";
       }

        $run = $db->query($sql);
        if($run){
            echo "<script>alert('Successfully saved remark');window.location.href='../result.php?std=".($student_id + 1200)."&class=".($class+1200)."'</script>";
           exit;    
        }else{
           echo "<script>alert('error occured');window.history.back()</script>";
           exit;    
        }



    }