<?php 

 include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

 if(isset($_POST)){
    $_SESSION['errors'] = [];
    $first = sanitize($_POST['first']);
    $first = filter_var($first,FILTER_VALIDATE_INT);
       checkIfEmpty($first,'First Test Score','first');
  $second = sanitize($_POST['second']);
  $second = filter_var($second,FILTER_VALIDATE_INT);   
         checkIfEmpty($second,'Second Test Score','second');
    $exam = sanitize($_POST['exam']);
    $exam = filter_var($exam,FILTER_VALIDATE_INT);   
        checkIfEmpty($exam,'Examination Score','exam');   

    $total= ($exam + $first + $second);
    $admin = getId();         

      if(count($_SESSION['errors']) != 0){
         echo "<script>window.history.back()</script>";
         exit();
       }

       if( $total!=100){
           $_SESSION['errors']['message'] = 'The Total Assessment Must be 100';
          echo "<script>window.history.back()</script>";
          exit();
       }

       $sql = "SELECT * FROM scores WHERE admin_id = '$admin'";
       $run = $db->query($sql);
       if($run->num_rows > 0){
        $sql = "UPDATE scores SET first = '$first',second = '$second',exam = '$exam' WHERE admin_id = '$admin'";
       }else{
        $sql = "INSERT INTO `scores`(`first`, `second`, `exam`, `admin_id`) VALUES ('$first','$second','$exam','$admin')";
       }

       $run = $db->query($sql);
        if($run){
         echo "<script>alert('Successfully saved school Assessment');window.location.href='index.php'</script>";
     }else{
      $_SESSION['errors']['message'] = 'Error occured,Try again';
      echo "<script>window.history.back()</script>";
      exit();
     }

}

 ?>