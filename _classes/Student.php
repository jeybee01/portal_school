<?php 
  class Student{
 	 private $name;
 	 private $id;
 	 private $email;
 	 private $phone_num;
 

 	 public function __construct($id=""){
         
         global $db;

         $sql = "SELECT * FROM users WHERE id = '$id' AND status = '2'";
         $run = $db->query($sql);
         if($run->num_rows > 0){
           $info = $run->fetch_assoc();
           $this->id = $id;
           $this->name = $info['name'];
           $this->email = $info['email'];
           $this->phone_num = $info['phone_number'];


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


   public function getClass($session){
      global $db;
      $sql = "SELECT class FROM class_students WHERE student = '$this->id' AND session = '$session'";
       $run = $db->query($sql);
      $info = $run->fetch_assoc();
      return $info['class'];
   }

   public function get_result($session){
     global $db;
     $results = [];
     $sql = "SELECT results.*,subjects.name FROM results INNER JOIN subjects WHERE subjects.id = results.subject_id AND session = '$session' AND student_id = '$this->id'";
     $run = $db->query($sql);
     while($row = $run->fetch_assoc())$results[$row['name'].''] = array('c.a'=>$row['c.a'],'exams'=>$row['exams']);
     return $results;
     
   }


   



}
?>