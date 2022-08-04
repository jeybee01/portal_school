<?php  
  class Classes{

  	 private $id;
  	 private $name;
  	 private $short;
  	 private $category;
    
    public function __construct($id=""){
          global $db;
          $sql = "SELECT * FROM class WHERE id = '$id'";
            $run = $db->query($sql);
         if($run->num_rows > 0){
           $info = $run->fetch_assoc();
           $this->id = $id;
           $this->name = $info['name'];
           $this->short = $info['short'];
           $this->category = $info['category'];


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


 	 public function getSubjects($user_id){
        global $db;
        $subjects = [];
        $sql = "SELECT subjects.*,subject_category.subject FROM subjects INNER JOIN subject_category WHERE   subject_category.category = '$this->category' AND subjects.id = subject_category.subject AND subjects.user_id = '$user_id' ORDER BY subjects.name ASC";
        $run = $db->query($sql);
        while($row = $run->fetch_assoc())$subjects[] = $row;
        return $subjects;

 	 }


 	 public function getStudents($session){
              global $db;
              $students = [];
              $sql = "SELECT student FROM class_students WHERE class = '$this->id' AND session = '$session'";
              $run = $db->query($sql);
              while($row = $run->fetch_assoc())$students[] = $row;
              return $students;
 	 }


   public function get_teacher($session){
        global $db;

        $sql = "SELECT class_teachers.teacher,users.name,users.email,users.phone_number FROM class_teachers INNER JOIN users WHERE users.id = class_teachers.teacher AND class_teachers.session = '$session' AND class_teachers.class = '$this->id'";
        $run = $db->query($sql);
        $info = $run->fetch_assoc();

        return $info;

   }


   public function get_num_of_students($session){
         global $db;

         $sql = "SELECT id FROM class_students WHERE class = '$this->id' AND session = '$session'";
         $run = $db->query($sql);

         return $run->num_rows;

   }







  }



 ?>