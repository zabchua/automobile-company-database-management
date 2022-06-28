<?php
 
  if(isset( $_POST['register'])) {
    require('./config/db.php');
    
    // $userName = $_POST["userName"];
    // $userEmail = $_POST["userEmail"];
    // $password = $_POST["password"];
    $f_name    = filter_var($_POST['f_name'], FILTER_SANITIZE_STRING); 
    $m_name   = filter_var($_POST['m_name'], FILTER_SANITIZE_STRING); 
    $l_name     = filter_var($_POST['l_name'], FILTER_SANITIZE_STRING); 
    $house_no  = filter_var($_POST['house_no'], FILTER_SANITIZE_STRING); 
    $street     = filter_var($_POST['street'], FILTER_SANITIZE_STRING); 
    $city       = filter_var($_POST['city'], FILTER_SANITIZE_STRING); 
    $country    = filter_var($_POST['country'], FILTER_SANITIZE_STRING); 
    $phone_no  = filter_var($_POST['phone_no'], FILTER_SANITIZE_STRING); 
    $email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING );
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    if( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
      $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');
      $stmt -> execute([$email]);
      $totalUsers = $stmt -> rowCount();


      if( $totalUsers > 0 ) {
        $emailTaken = "Email has already been taken.";
      } else {
        $stmt = $pdo -> prepare('INSERT into users(f_name, m_name, l_name, house_no, street, city, country, phone_no,  email, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ');
        $stmt -> execute( [ $f_name, $m_name, $l_name, $house_no, $street, $city, $country, $phone_no, $email, $passwordHashed] );
        header('Location: login.php');
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
      <h1 class="display-6">Registration</h1>
      <br />
            <?php if(isset($emailTaken)) { ?>
              <p style="background-color: red"><?php echo $emailTaken?></p>
            <?php } ?>
       
        <form action="register.php" method="POST">

        <div class="userDetails">
          <div class="form-group">
            <label for="f_name" class="details">First Name</label>
            <input required type="text" name="f_name" class="form-control" autofocus placeholder="e.g. Juan Miguel" />
          </div>

          <div class="form-group">
            <label for="m_name" class="details">Middle Name</label>
            <input required type="text" name="m_name" class="form-control" placeholder="e.g. Cirilo" />
          </div>

          <div class="form-group">
            <label for="l_name" class="details">Last Name</label>
            <input required type="text" name="l_name" class="form-control" placeholder="e.g. Dela Cruz" />
          </div>

          <div class="form-group">
            <label for="house_no" class="details">House Number</label>
            <input required type="text" name="house_no" class="form-control" placeholder="e.g. 123" />
          </div>

          <div class="form-group">
            <label for="street" class="details">Street</label>
            <input required type="text" name="street" class="form-control" placeholder="e.g. Ped Xing"/>
          </div>

          <div class="form-group">
            <label for="city" class="details">City</label>
            <input required type="text" name="city" class="form-control" placeholder="e.g. Baguio"  />
          </div>

          <div class="form-group">
            <label for="country" class="details">Country</label>
            <input required type="text" name="country" class="form-control" placeholder="e.g Philippines"/>
          </div>

          <div class="form-group">
            <label for="tel" class="details">Phone Number</label>
            <input required type="text" name="phone_no" class="form-control" placeholder="e.g. 09123456789"/>
          </div>

          <div class="form-group">
            <label for="email" class="details">Email Address</label>
            <input required type="email" name="email" class="form-control" placeholder="e.g. juan123@gmail.com"  />
          </div>
          <div class="form-group">
            <label for="password" class="details">Password</label>
            <input required type="password" name="password" class="form-control" placeholder="e.g. 1234" />
          </div>
        </div>

        <div class="button">
          <button name="register" type="submit" class="btn btn-primary">Sign up</button>
        </div>

          <div class="signin">
            <p class="text-center">Already a member? <a href="login.php">Sign in</a></p>
          </div>

        </form>
      
  </div>

  <?php require('./inc/footer.html'); ?>