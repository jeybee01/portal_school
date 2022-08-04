<?php 
  class Teacher{ 
 	 private $name;
 	 private $id;
 	 private $email;
 	 private $phone_num;
 	 private $qualifiction;
     private $user_id;

 	 public function __construct($id=""){
         
         global $db;

         $sql = "SELECT * FROM users WHERE id = '$id' AND type = '1'";
         $run = $db->query($sql);
         if($run->num_rows > 0){
           $info = $run->fetch_assoc();
           $this->id = $id;
           $this->name = $info['name'];
           $this->email = $info['email'];
           $this->phone_num = $info['phone_number'];
           $this->user_id = $info['user_id'];

         }else{
          echo "<script>alert('Teacher not found')window.history.back()</script>";
         }


 	 }

 	 public function get($attr){
 	 	 if(isset($this->$attr))
 	 	 	return $this->$attr;
 	 	 else
 	 	 	echo 'attr not available';
 	 }
     
   public function get_subjects(){
   	  global $db;
   	  $subjects = [];
      $sql = "SELECT  assign_subject.*,subjects.name FROM assign_subject INNER JOIN subjects WHERE assign_subject.teacher = '$this->id' AND subjects.id = assign_subject.subject";
      $run = $db->query($sql);
      while($row = $run->fetch_assoc())$subjects[] = $row;
      return $subjects;
   }

   public function get_class($session){
      global $db;
        $sql = "SELECT class_teachers.class,class.short FROM class_teachers INNER JOIN class WHERE class.id = class_teachers.class AND class_teachers.session = '$session' AND class_teachers.teacher = '$this->id'";
      $run = $db->query($sql);
      $info = $run->fetch_assoc();
    
     return (isset($info['short'])) ? $info['short'] : 'No Class';
   }  
 	
 }



 ?>