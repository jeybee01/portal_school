<?php 
  include '../functions.php';
  if(!isLoggedIn()){
     echo "<script>window.location.href='../index.php'</script>";
     exit();
  }

  function random_characters($length, $special_chars=false){
		$characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if($special_chars) $characters.="~!@#$%^&*()_+";
        $charactersLength = strlen($characters);

        $random_characters = "";
        for ($i = 0; $i < $length; $i++) {
            $random_characters .= $characters[rand(0, $charactersLength - 1)];
        }

        return $random_characters;
}

  

  if(isset($_POST)){
  
     $user_id = getId();
      $sql = "SELECT pic FROM users WHERE id = '$user_id'";
      $run = $db->query($sql);
      $info = $run->fetch_assoc();
     
     if($info['pic'] != ''){
     	$file = explode('.',$info['pic'])[0];
     }else{
     	 $file = random_characters(3).$user_id.random_characters(3);
     }

    $uploaded = uploadFile('upload','../image/profile_pics/',$file);

    if($uploaded != ''){
    	 $sql = "UPDATE users SET pic = '$uploaded' WHERE id = '$user_id'";
    	 $run = $db->query($sql);
    	 if($run){
        $_SESSION['pic'] = $uploaded;
         echo "<script>alert('Successfully updated picture');window.location.href='index.php'</script>";
       }
       else
       	  	echo "<script>alert('Error');window.history.back()</script>";
    }else{
       	echo "<script>alert('Error');window.history.back()</script>";
     	exit();
    }
  }


 ?>