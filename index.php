<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">




</head>
<style type="text/css">

</style>
<body>
  <?php include 'includes/header1.php'; ?>


<section class="center-text">
    
    <strong>Log In</strong>

    <div class="login-form box-center">
      <?php 

        if(isset($_SESSION['prompt'])) {
          showPrompt();
        }

        if(isset($_SESSION['errprompt'])) {
          showError();
        }

      ?>
      <form action="account/login.php" method="POST">
        
        <div class="form-group">
          <label for="regNumber"><span class="glyphicon glyphicon-envelope"></span> Email</label>
          <input type="text" class="form-control" name="email" placeholder="Enter Your Email" required autofocus>
        </div>

        <div class="form-group">
          <label for="password"><span class="glyphicon glyphicon-lock"></span> Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
        </div>
        
        <a href="#">Apply Now?</a>
        <input class="btn btn-primary" type="submit" name="login" value="Log In">

      </form>
    </div>

  </section>

    <script type="text/javascript" src="jquery/jquery.min.js"></script>

    <script>
</script>
</body>
</html>
