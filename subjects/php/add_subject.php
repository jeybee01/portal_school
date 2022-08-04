<?php 

 include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

 if(isset($_POST)){
 	$_SESSION['errors'] = [];
 	$subject_name = sanitize($_POST['subject_name']);
 	  checkIfEmpty($subject_name,'Subject Name','subject_name');
 	$short = sanitize($_POST['short']);
 	  checkIfEmpty($short,'Subject short name','subject_short');
 	$category = $_POST['categories'];
 	if(!$category or count($category) == 0){
       $_SESSION['errors']['category'] ='Subject must have atleast one category';
 	}
 	$user_id = getId();


      if(isset($_SESSION['subject'])){
          $subject_id = $_SESSION['subject'];          
           $sql = "SELECT id FROM subjects WHERE id = '$subject_id' AND user_id = '$user_id'";
          $run = $db->query($sql);
        if($run->num_rows == 0){
          echo "<script>alert('noo');window.history.back()</script>";
        }

        $sql = "SELECT id FROM subjects WHERE name = '$subject_name' and id != '$subject_id' and user_id = '$user_id'"; 
        $message = 'Successfully updated Subject';

      }else{
          $sql = "SELECT id FROM Subjects WHERE name = '$subject_name' and user_id = '$user_id'";         
          $message = 'Successfully added subject';
      }

      $run = $db->query($sql);
      if($run->num_rows > 0){
         $_SESSION['errors']['subject_name'] = 'This Subject already exist';
      }

       if(count($_SESSION['errors']) != 0){
     	echo "<script>window.history.back()</script>";
     	exit();
       }

       if(isset($_SESSION['subject'])){
     	$sql = "UPDATE subjects SET name = '$subject_name',short = '$short'  WHERE id = '$subject_id' And user_id = '$user_id'";
       }else{
       	$sql  ="INSERT INTO `subjects`( `name`, `short`, `user_id`) VALUES ('$subject_name','$short','$user_id')";
       }

        $run = $db->query($sql);

          
     if($run){
           $subject_id = (isset($_SESSION['subject'])) ? $subject_id : $db->insert_id;
          unset($_SESSION['subject']);

          $del = "DELETE FROM subject_category WHERE subject = '$subject_id'";
          $run = $db->query($del);
          if($run){
               $sql = "INSERT INTO `subject_category`(`subject`, `category`) VALUES ";
               foreach ($category as $cat) {
                  $sql.="('$subject_id','$cat'),";
               }

               $sql = substr($sql,0,strlen($sql) - 1);
               $run = $db->query($sql);

               if($run){
                 echo "<script>alert('".$message."');window.location.href='../view_subjects.php'</script>";
               }else{
                  $_SESSION['errors']['message'] = 'Error occured,Try again';
                 echo "<script>alert('alert 1');window.history.back()</script>";
                  exit();
               }

          }else{
            $_SESSION['errors']['message'] = 'Error occured,Try again';
            echo "<script>alert('rrrr');window.history.back()</script>";
           exit();
          }
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>alert('hhjjjjjjj');window.history.back()</script>";
     	exit();
     }




 	   
 	 
 }




 ?>a