<?php
  include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }
  $user_id = getId();
 $has_run = false;
if(isset($_POST)){
   $teacher = sanitize($_POST['teacher']);
   $teacher = filter_var($teacher,FILTER_VALIDATE_INT);
   if($teacher == '' or !$teacher){
     echo "<script>window.history.back()</script>";
   exit();
   }
   $teacher = $teacher - 1200;  
   $sql = "SELECT id FROM users WHERE user_id = '$user_id' AND id = '$teacher'";
   $run = $db->query($sql);
   if($run->num_rows == 0){
    echo "<script>window.history.back()</script>";
    exit();
   }

    $category = sanitize($_POST['category']);
    $category = filter_var($category,FILTER_VALIDATE_INT);

     $classes = get_category_class($category,$user_id);
    $subject = get_category_subject($category,$user_id);

    for($i = 0; $i < count($subject); $i++){
       for($j=0;$j<count($classes);$j++){
            $input_name = str_replace(' ','_',$classes[$j]['short']).'_'.str_replace(' ','_',$subject[$i]['short']);
           if(isset($_POST[$input_name])){
             $subject_id = $subject[$i]['id'];
             $class_id = $classes[$j]['id'];
             $sql = "SELECT id FROM assign_subject WHERE subject = '$subject_id'AND  class = '$class_id'";
             $run = $db->query($sql);
             if($run->num_rows == 0)
                 $sql = "INSERT INTO `assign_subject`( `subject`, `class`, `teacher`) VALUES ('$subject_id','$class_id','$teacher')";  
             else
                 $sql = "UPDATE assign_subject SET teacher = '$teacher' WHERE subject = '$subject_id' AND class = '$class_id' "; 
              $run = $db->query($sql);
              if($run)
                 $has_run = true;
               else {
                  //echo "<script>alert('error occured');window.history.back()</script>";
                  echo $db->error; 
                  exit;              
               }
           }

       }


    }

     if($has_run){
      echo "<script>alert('Successfully Assigned Subject');window.location.href='../assign_subject.php?teacher=".($teacher + 1200)."'</script>";
     }else{
      echo "<script>alert('error occured 1');window.history.back()</script>"; 
                  exit; 
     }

}


?>