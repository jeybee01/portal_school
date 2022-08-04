<?php
   include '../../functions.php';
   $terms = [];
   if(!isLoggedIn() or $_SESSION['type'] != '1'){
        $res = array('msg'=>'failed');   
     }

     if(isset($_POST)){
        $user_id = getId();
 	 $session = sanitize($_POST['session']);
         $session = filter_var($session,FILTER_VALIDATE_INT);

  
           
     if(empty($session)){
        $res = array('msg'=>'failed');   
     }

    $session = $session - 1200;
     $sql = "SELECT user_id FROM class WHERE id = '$user_id'";
     $run = $db->query($sql);
     $info = $run->fetch_assoc();
    $admin_id = isset($info['user_id']) ? $info['user_id'] : '';
      

        $sql = "SELECT id FROM session WHERE id = '$session' AND user_id = '$admin_id'";
        $run = $db->query($sql);

        if($run->num_rows == 0){
           $res = array('msg'=>'failed');   
        }else{
           $sql = "SELECT * FROM term WHERE session = '$session'";
           $run = $db->query($sql);
            while($row = $run->fetch_assoc())$terms[] = $row;	
           $res = array('msg'=>'success','terms'=>$terms);   
        }


     }else{
        $res = array('msg'=>'failed');   
     }
  
  echo json_encode($res);
?>