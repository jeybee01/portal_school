<?php 

 include '../functions.php';
 if(!isLoggedIn() or $_SESSION['type'] != '0'){
   header('location:../index.php');
 }

 if(isset($_POST)){
    $_SESSION['errors'] = [];
    $name = sanitize($_POST['name']);
       checkIfEmpty($name,'School Name','school');
    $address = sanitize($_POST['address']);
         checkIfEmpty($address,'School Address','address');
    $motto = sanitize($_POST['motto']);
        checkIfEmpty($motto,'School Motto','motto');   
    $admin = getId();         

      if(count($_SESSION['errors']) != 0){
         echo "<script>window.history.back()</script>";
         exit();
       }

       $sql = "SELECT * FROM school WHERE admin_id = '$admin'";
       $run = $db->query($sql);
       if($run->num_rows > 0){
        $sql = "UPDATE school SET name = '$name',address = '$address',motto = '$motto' WHERE admin_id = '$admin'";
       }else{
        $sql = "INSERT INTO `school`(`name`, `motto`, `address`, `admin_id`) VALUES ('$name','$motto','$address','$admin')";
       }

       $run = $db->query($sql);
        if($run){
         echo "<script>alert('Successfully saved school details');window.location.href='index.php'</script>";
     }else{
      $_SESSION['errors']['message'] = 'Error occured,Try again';
      echo "<script>window.history.back()</script>";
      exit();
     }

}

 ?>