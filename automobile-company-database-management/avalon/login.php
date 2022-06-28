<?php
  session_start();

  if(isset( $_POST['login'])) {
    require('./config/db.php');
    
    $email = filter_var( $_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING );
   

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $users = $stmt -> fetch();


    if( isset($users) ) {
      if( password_verify($password, $users -> password )) {
    //    echo "The password is correct";
        $_SESSION['userId'] = $users->user_id;
        header('Location: loggedin.php');
      } else {
        // echo "The login email or password is wrong";
        $wrongLogin = "The email or password is wrong";
      }

  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>SZA Auto</title>
</head>
<body>
  <nav>
    <div class="logo"> <a href="index.php"><img src="images/logo.png" alt="#"></a> </div>
    <ul>
      <li><a href="index.php">Home</a></li>
      
    </ul>
  </nav>

  <div class="container">
    <h1 class="display-6">Sign in</h1>
      <br />
        <?php if(isset($wrongLogin)) { ?>
          <p style="background-color: red"><?php echo $wrongLogin ?></p>
        <?php } ?>
   
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="email" class="details">Email Address</label>
            <input required type="email" name="email" class="form-control" />
            
          </div>
          <div class="form-group">
            <label for="password" class="details">Password</label>
            <input required type="password" name="password" class="form-control" />
          </div>
          <button name="login" type="submit" class="btn btn-primary">Sign in</button>
          <p class="text-center">Not a member? <a href="register.php">Sign Up</a></p>  

        </form>
  </div>

  <?php require('./inc/footer.html'); ?>

