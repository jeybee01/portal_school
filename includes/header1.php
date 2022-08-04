<nav class="navbar navbar-default">
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display --> 
    <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">SCHOOL PORTAL</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	
		<?php 
		if(isset($_SESSION['regNumber'], $_SESSION['password'])) {
		
			$query = "SELECT * FROM students WHERE regNumber = '".$_SESSION['regNumber']."' AND password = '".$_SESSION['password']."'";;

			if($result = mysqli_query($con, $query)) {
				$row = mysqli_fetch_assoc($result);
			}else{
				die("Error with the query in the database");
			}
		?>

			<form class="navbar-form navbar-right" action="searchresults.php" method="GET">
			
				<div class="welcome"><?php echo "Welcome ".$row['lastname'].", ".$row['firstname']." with Application Number: <a href='profile.php'>".$_SESSION['regNumber']."</a>!";?></div>

				<a href="logout.php">Log Out <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>

			</form>

		<?php 
		} else {
			echo "<span class='not-logged'>Not logged in.</span>";
        }
		?>
    </div>
</div>
</nav>