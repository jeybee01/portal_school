<?php 
  session_start();


date_default_timezone_set("Africa/Lagos");                  # set your time zone (optional)
 

// 8 and 40 and 30  ini_set('session.gc_maxlifetime', 86400);                   # set how long (in secs, 86400=1day) you want you session to last, 
															#comment this off if you want to use default from server (optional)

# REQUIRED VALUES
######################################################################
#########     Please provide values for these varables     ###########
######################################################################

$db_host = 'localhost';
$db_username = 'root'; 
$db_password = '';
$db_name = 'portal';

// $db_host = 'localhost';
// $db_username = 'muhammadrec1fa'; 
// $db_password = '0c~T[BxDx2aP';
// $db_name = 'recifa';

# replace the values below with your values

# comment this part below when live 
define('ROOT', '/portal/');    # use this for localhost
//define('WEB_ROOT', $_SERVER['PROJECT_ROOT'].'/');    # use this for localhost
define('ROOT_URL', 'http://localhost/portal_school/');              # use this for localhost
 
# remove comment from this part below when live on server
// define('ROOT', ' /home/q6i7hg7vicom/public_html/recifa.com/');    		# use this when live on server
// define('WEB_ROOT', $_SERVER['PROJECT_ROOT'].'/');    # use this for localhost
// define('ROOT_URL', 'http://recifa.com/');    	        # use this when live on server



// session_set_cookie_params(2,592,000);                       # set how long (in secs, 86400=1day) you want you cookies to last, 
															#comment this off if you want to use PHP default or not using cookies at all (optional)	



If(ROOT === '' OR ROOT_URL ===''){
	echo '<p style="color:red;"> Please open your crib.php file and provide the required values</p>';
	return;
}

$db = new mysqli($db_host,$db_username,$db_password,$db_name);


function isLoggedIn(){
	return isset($_SESSION['email']);
}


function is($type){
	$user_type = '';
	 if(isset($_SESSION['type'])){
	 	$user_type = $_SESSION['type'];
	 }

	 return $user_type == $type;
}


function get_subject_teacher($class,$subject){
   global $db;
   $sql = "SELECT assign_subject.teacher,users.name FROM assign_subject INNER JOIN users WHERE assign_subject.class = '$class' AND assign_subject.subject = '$subject' AND users.id = assign_subject.teacher";
   $run = $db->query($sql);
   $info = $run->fetch_assoc();
    if(isset($info['name'])){
        $name = $info['name'];
        $color = 'green';
    }else{
        $name = 'No Teacher';
        $color = 'red';
    } 

    return array('name' => $name,'color'=>$color);
}


function get_categories()
{
  return array('1' => 'Kindergateen','2'=>'primary','3'=> 'Junior secondary', '4'=>'Senior sec (Sciene)', '5'=>'Senior sec (Art)');
}

function get_category_class($category,$user_id){
   global $db;
   $classes = [];
   $sql = "SELECT * FROM class WHERE category = '$category' AND user_id = '$user_id'";
   $run = $db->query($sql);
   while($row = $run->fetch_assoc()) $classes[] = $row;
   return $classes;
}
function get_category_subject($category,$user_id){
   global $db;
   $subjects = [];
   $sql = "SELECT subject_category.*,subjects.* FROM subject_category INNER JOIN subjects WHERE subject_category.category = '$category' AND subjects.id = subject_category.subject AND subjects.user_id = '$user_id'";
   $run = $db->query($sql);
   while($row = $run->fetch_assoc())$subjects[] = $row;
   return $subjects;
}

function cleanInput($input){
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return htmlentities(strip_tags($output));
  }


   function sanitize(&$input) { 
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $input[$var] = sanitize($val);
        }
    }
    else {
        // if (get_magic_quotes_gpc()) {
        //     $input = stripslashes($input);
        // }
        $input  = cleanInput($input);
        $input = $GLOBALS['db']->real_escape_string($input);
    }

    return $input;
   }

     function set_db_values($assoc_array, $update_user=true)
  {
     global $db;
      $changes = "";

     foreach ($assoc_array as $prop => $value) {
       $changes.=$prop." = '".$value."' , ";
     }

     $changes = trim(substr($changes,0,strrpos($changes,',')));
    
     $this->id = ($this->id=="")?$this->user_id():$this->id;
     $sql = "UPDATE ".$table." SET ".$changes." WHERE id = '$this->id'";



     $run = $db->query($sql);
     if($update_user) $this->update_user();
     return $run;

  }


 function checkIfEmpty($value,$text,$error){
   if(!$value or $value == ''){
     echo "<script>alert('Invalid ".$text."');window.history.back();</script>";
     exit;
   }

 }

 function get_session(){
    return isset($_SESSION['session']) ? $_SESSION['session'] : '';
 }

 function set_session($session)
  {
    $_SESSION['session'] = $session;
  } 


  function get_sessions_list($user_id)
  {
      global $db;
      $sessions = [];
      $sql = "SELECT * FROM session WHERE user_id = '$user_id' ORDER BY id Desc";
      $run = $db->query($sql);
      while($row = $run->fetch_assoc())$sessions[]  = $row;
      return $sessions;    
  }

  function get_term($session)
  {
      global $db;
      $sql = "SELECT * FROM term WHERE session = '$session' ORDER BY id DESC";
     $run = $db->query($sql);
     return $run->fetch_assoc(); 
  }


 function validateEmail($value,$text,$error,$id=''){
       global $db;
    if(!$value or !filter_var($value,FILTER_VALIDATE_EMAIL) or $value == ''){
    	echo "<script>alert('Invalid ".$text."');window.history.back();</script>";    
       exit;
    }

}


 function validatePhone($value,$text,$error,$id=''){
      global $db;
     if(!$value or strlen($value) < 11 or $value == ''){
        echo "<script>alert('Invalid ".$text."');window.history.back();</script>";    
        exit;
    }


    
}

 function validateEmail2($value,$text,$error,$id=''){
       global $db;
    if(!$value or !filter_var($value,FILTER_VALIDATE_EMAIL) or $value == ''){
        echo "<script>alert('Invalid ".$text."');window.history.back();</script>";   
        exit;
     }
}


 function validatePhone2($value,$text,$error,$id=''){
      global $db;
     if(!$value or strlen($value) < 11 or $value == ''){
        echo "<script>alert('Invalid ".$text."');window.history.back();</script>";    
        exit;
  }

}


  function getId(){
          global $db;
          if(isset($_SESSION['email'])){
               $email = $_SESSION['email'];
               $sql = "SELECT id FROM users WHERE email = '$email'";
               $run = $db->query($sql);
               $info = $run->fetch_assoc();
               return $info['id'];
          }else{
              return "";
          }
  }

function getClass($class,$user_id){
  global $db;
  $sql = "SELECT * FROM class WHERE id  = '$class' AND user_id = '$user_id'";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();
  return $info;
}

function get_subject($subject,$user_id){
  global $db;
  $sql = "SELECT * FROM subjects WHERE id  = '$subject' AND user_id = '$user_id'";
  $run = $db->query($sql);
  $info = $run->fetch_assoc();
  return $info;
}


function get_subject_cat($subject){
  $categories = [];
  global $db;
  $sql = "SELECT category FROM subject_category WHERE subject = '$subject'";
  $run = $db->query($sql);
  while($row = $run->fetch_assoc())$categories[] = $row['category'];
  return $categories;
}


 function uploadFile($file_name,$location,$file){
  
  $allowed_file_types = array('.png','.jpeg','.jpg','.pdf','.doc','.docx');  
  if(isset($_FILES[$file_name.'']['name'])){
         $filename = $_FILES[$file_name.'']["name"];
         $file_basename = substr($filename, 0, strripos($filename, '.'));
         $file_ext = substr($filename, strripos($filename, '.'));
         $filesize = $_FILES[$file_name.'']["size"];
          if(!empty($filename)){
                 if ($filesize > 2000000) {
                    
                echo  '<script>alert('.$file_name.'" File is too large, Max: 2MB");</script>';
                  
                    exit;

                }
                if (!in_array($file_ext,$allowed_file_types)){ 
                        $message =  "Please select a file with any of these format; \"png\",\"jpeg\", \"jpg\", \"pdf\", \"doc\", \"docx\".";
                 echo  '<script>alert('.$message.');</script>';
                    exit;
                    
                 
                     
                }

                $new_file_name = $file.$file_ext;
                $location = $location.$new_file_name;
                $temp = $_FILES[$file_name.'']['tmp_name'];

                  if(move_uploaded_file($temp, $location) ){
                        return $new_file_name;
                  }else{
                       return '';                      

                  }




            }

  }else{
       return '';
  }

}


 function get($table,$column,$id)
 {
   global $db;
   $field = ($table == 'bookings') ? 'booking_id' : 'id';
    $sql = "SELECT ".$column." FROM ".$table." WHERE ".$field." = '$id'";
    $run = $db->query($sql);
    $info = $run->fetch_assoc();
    return $info[$column.'']; 
 }

  function get_positions($std_array)
 {
   $pos_array = [];

   arsort($std_array);

   $counter = 1;
   foreach($std_array as $s=>$v){
    $pos = $counter.'';
    $last = get_last((int)substr($pos, -1));
     $pos_array[$s] = $pos.''.$last;
     $counter++;
   }

   return $pos_array;

   
 }


 function get_last($position)
 {
   $positions = array('TH','ST','ND','RD','TH','TH', 'TH','TH','TH','TH');

   return $positions[$position];
 }


 






?>