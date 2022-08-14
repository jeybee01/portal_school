<div class="nav side-nav">
<?php
  if($_SESSION['type'] == '0'){

  	?> 
      <h2 style="text-align: center;">SCHOOL PORTAL</h2>

 <ul class="list-group">
  <li class=" dropdown list-group-item"><span class="fa fa-graduation-cap"></span> 
     <button  style="border:none;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">TEACHERS
    <span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-menu-right">
      <li>
    <a href="<?=ROOT_URL?>teachers/view_teachers.php"id="<?=($_SESSION['location'] == 'teachers') ? 'user' : ''?>">Manage Teacher</a>
      <li class="divider"></li>
      <li>
    <a href="<?=ROOT_URL?>teachers/add_teacher.php"id="<?=($_SESSION['location'] == 'teachers') ? 'user' : ''?>">Add Teacher</a>
        </li>
       </ul>
  </li>

    <li class=" dropdown list-group-item"><span class="fa fa-briefcase"></span> 
     <button  style="border:none;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">SCHOOL
    <span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-menu-right">
      <li>
     <a href="<?=ROOT_URL?>school/index.php"id="<?=($_SESSION['location'] == 'school') ? 'user' : ''?>">Manage School</a>
   </li>
      <li class="divider"></li>
      <li>
     <a href="<?=ROOT_URL?>school/add.php"id="<?=($_SESSION['location'] == 'school') ? 'user' : ''?>">Add School</a>
        </li>
       </ul>
  </li>

  <li class=" dropdown list-group-item">
    <a href="<?=ROOT_URL?>session/index.php" class="acolor" id="<?=($_SESSION['location'] == 'session') ? 'user' : ''?>">
      <span class="fa fa-calendar mr"></span>SESSIONS
    </a>
  </li>
  <li class=" dropdown list-group-item"><span class="fa fa-briefcase"></span> 
     <button  style="border:none;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">SUBJECT
    <span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-menu-right">

      <li>
     <a href="<?=ROOT_URL?>subjects/index.php" id="<?=($_SESSION['location'] == 'subjects') ? 'user' : ''?>">Manage Subject</a></li>
      <li class="divider"></li>
  <li>
     <a href="<?=ROOT_URL?>subjects/add_subject.php" id="<?=($_SESSION['location'] == 'subjects') ? 'user' : ''?>">Add Subject</a></li>
       </ul>
  </li>
  </span> 

  <li class=" dropdown list-group-item"><span class="fa fa-users"></span>
    <button  style="border:none;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">CLASSES
    <span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-menu-right">
      <li>
     <a href="<?=ROOT_URL?>classes/index.php"id="<?=($_SESSION['location'] == 'classes') ? 'user' : ''?>">Manage Class</a>
      </li>
      <li class="divider"></li>
     <li>
     <a href="<?=ROOT_URL?>classes/add_class.php"id="<?=($_SESSION['location'] == 'classes') ? 'user' : ''?>">Add Class</a>
      </li></ul>
     
  </li>
  <li class=" dropdown list-group-item"><span class="fa fa-money"></span> 
     <button  style="border:none;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">BURSER
    <span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-menu-right">
      <li>
       <a href="<?=ROOT_URL?>burser/index.php"id="<?=($_SESSION['location'] == 'burser') ? 'user' : ''?>">Manage Burser</a>
      </li>
      <li class="divider"></li>
      <li>
       <a href="<?=ROOT_URL?>burser/add_burser.php"id="<?=($_SESSION['location'] == 'burser') ? 'user' : ''?>">Add Burser</a>
      </li>
       </ul>
  </li>
  <li class=" dropdown list-group-item"><span class="fa fa-user logout mr"></span>
      <a href="<?=ROOT_URL?>profile/index.php" class="acolor" id="<?=($_SESSION['location'] == 'profile') ? 'user' : ''?>"> PROFILE</a>
 </li>
  <li class=" dropdown list-group-item"><span class="fa fa-power-off mr"></span>
      <a href="<?=ROOT_URL?>logout.php" class="acolor">Log-out</a>

   </li>


  
</ul>


<!--     <a href="<?=ROOT_URL?>school/index.php"id="<?=($_SESSION['location'] == 'school') ? 'user' : ''?>">School</a>
  	<a href="<?=ROOT_URL?>teachers/index.php" id="<?=($_SESSION['location'] == 'teachers') ? 'user' : ''?>">Teachers</a>
    <a href="<?=ROOT_URL?>session/index.php" id="<?=($_SESSION['location'] == 'session') ? 'user' : ''?>">Session</a>
     <a href="<?=ROOT_URL?>subjects/index.php" id="<?=($_SESSION['location'] == 'subjects') ? 'user' : ''?>">Subjects</a>
     <a href="<?=ROOT_URL?>classes/index.php"id="<?=($_SESSION['location'] == 'classes') ? 'user' : ''?>">Classes</a>
       <a href="<?=ROOT_URL?>burser/index.php"id="<?=($_SESSION['location'] == 'burser') ? 'user' : ''?>">Burser</a> -->
  <?php }else if($_SESSION['type'] == '1'){
  	 ?>
      <h2 style="text-align: center;">SCHOOL PORTAL</h2>

      <ul class="list-group">
<li class=" dropdown list-group-item"><span class="fa fa-users"></span>
    <button  style="border:none;" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">CLASSES
    <span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-menu-right">
      <li>
     <a href="<?=ROOT_URL?>student/index.php"id="<?=($_SESSION['location'] == 'classes') ? 'user' : ''?>">Manage Students</a>
      </li>
      <li class="divider"></li>
     <li>
     <a href="<?=ROOT_URL?>student/add_students.php"id="<?=($_SESSION['location'] == 'classes') ? 'user' : ''?>">Add Student</a>
      </li></ul>
     
  </li>

  <li class=" dropdown list-group-item"><span class="fa fa-user  mr">
  <a href="<?=ROOT_URL?>subjects/view_teachers_subject.php" id="<?=($_SESSION['location'] == 'subjects') ? 'user' : ''?>"> Subjects</a></span>
 </li>
 <li class=" dropdown list-group-item"><span class="fa fa-power-off mr">
      <a href="<?=ROOT_URL?>logout.php" class="acolor"> Log-out</a></span>

   </li>

  </ul>

     <?php }else if($_SESSION['type'] == '2'){
  	 ?>

<h2 style="text-align: center;">SCHOOL PORTAL</h2>

<ul class="list-group">
<li class=" dropdown list-group-item"><span class="fa fa-home mr">
<a class="acolor" href="<?=ROOT_URL?>students/index.php"id="<?=($_SESSION['location'] == 'home') ? 'user' : ''?>">Home</a>
</li>

<li class=" dropdown list-group-item"><span class="fa fa-users mr">
<a  class="acolor" href="<?=ROOT_URL?>students/class_mates.php"id="<?=($_SESSION['location'] == 'class_mates') ? 'user' : ''?>">Class Mates</a>
</li>

<li class=" dropdown list-group-item"><span class="fa fa-briefcase mr">
<a class="acolor" href="<?=ROOT_URL?>student/result.php" id="<?=($_SESSION['location'] == 'result') ? 'user' : ''?>">Results</a>

</li>
  <li class=" dropdown list-group-item"><span class="fa fa-power-off mr"></span>
      <a href="<?=ROOT_URL?>logout.php" class="acolor">Log-out</a>

   </li>

</ul>


  <?php }else if($_SESSION['type'] == '3'){
      ?>
      <a href="<?=ROOT_URL?>fees/index.php"id="<?=($_SESSION['location'] == 'burser') ? 'user' : ''?>">Class</a>
  <?php } ?>
</div>