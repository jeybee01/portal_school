<?php 

 include '../../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

 if(isset($_POST)){
 	$_SESSION['errors'] = [];
 	$class_name = sanitize($_POST['class_name']);
 	  checkIfEmpty($class_name,'Class Name','class_name');
 	$short = sanitize($_POST['short']);
 	  checkIfEmpty($short,'Class short name','class_short');
 	$category = sanitize($_POST['category']);
 	$category = filter_var($category,FILTER_VALIDATE_INT);
 	if(!$category or ($category != '1' and $category != '2' and $category != '3' and $category != '4')){
       $_SESSION['errors']['category'] = 'Enter valid Category';
 	}
 	$user_id = getId();


      if(isset($_SESSION['class'])){
        $class_id = $_SESSION['class'];
             
          $sql = "SELECT id FROM class WHERE id = '$class_id' AND user_id = '$user_id'";
          $run = $db->query($sql);
		  if($run->num_rows == 0){
		    echo "<script>window.history.back()</script>";
		  }

		    $sql = "SELECT id FROM class WHERE name = '$class_name' and id != '$class_id' and user_id = '$user_id'";      
          $message = 'Successfully updated classs';
 

      }else{
          $sql = "SELECT id FROM class WHERE name = '$class_name' and user_id = '$user_id'";         
          $message = 'Successfully added class';
      }

      $run = $db->query($sql);
      if($run->num_rows > 0){
         $_SESSION['errors']['class_name'] = 'This Class already exist';
      }

       if(count($_SESSION['errors']) != 0){
     	echo "<script>window.history.back()</script>";
     	exit();
       }

       if(isset($_SESSION['class'])){
     	$sql = "UPDATE class SET name = '$class_name',short = '$short', category = '$category' WHERE id = '$class_id' And user_id = '$user_id'";
       }else{
       	$sql  ="INSERT INTO `class`( `name`, `short`, `category`, `user_id`) VALUES ('$class_name','$short','$category','$user_id')";
       }

    

        $run = $db->query($sql);

          
     if($run){
          unset($_SESSION['class']);
     	   echo "<script>alert('".$message."');window.location.href='../view_classes.php'</script>";
     }else{
     	$_SESSION['errors']['message'] = 'Error occured,Try again';
     	echo "<script>window.history.back()</script>";
     	exit();
     }




 	   
 	 
 }




 ?>a