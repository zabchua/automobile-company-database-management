<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

  <?php
    $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

    if (isset($_GET['data'])){
      $serial_no = $_GET['data'];
      $result = $mysqli->query("SELECT * FROM item WHERE serial_no = $serial_no") or die(mysqli_error);
      $row = $result->fetch_array(); 
    }
  ?>
  
  <div class="layout transition">
    <div class="row" style="width: 90%; margin: auto; padding-top: 3em">
      <div class="col-8" style="color: #FF6046">
        <p class="fw-bolder fs-1 text-uppercase"><?php echo $row['model_name'] ?> <?php echo $row['year'] ?></p>
        <button type="button" class="btn btn-outline-danger btn-sm">Download Brochure</button>
        <p></p>
        <button type="button" class="btn btn-outline-danger btn-sm">Compare Vehicles</button>
        <p></p>
        <button type="button" class="btn btn-outline-danger btn-sm">Print</button>
      </div>
      <div class="col-4">
        <p class="fw-bolder fs-1 text-uppercase text-end">PHP <?php echo number_format($row['price']); ?>.00</p>
        <p class="text-end">MSRP</p>
        <div class="dividersmol"></div>
        <div class="row">
          <div class="col-6">
            <p class="fw-bolder " style="font-size: 15px"><?php echo $row['transmission'] ?></p>
            <p class=" text-uppercase" style="font-size: 12px">transmission</p>
          </div>
          <div class="col-6">
            <p class="fw-bolder " style="font-size: 15px"><?php echo $row['engine'] ?></p>
            <p class=" text-uppercase" style="font-size: 12px">fuel type/engine</p>
          </div>
        </div>
        <div class="row" style="margin-top: 1em">
          <div class="col-6">
          </div>
          <div class="col-6">
            <p class="fw-bolder" style="font-size: 15px"><?php echo $row['seat_capacity'] ?></p>
            <p class=" text-uppercase" style="font-size: 12px">seating capacity</p>
          </div>
        </div>
      </div>
    </div>
    <div style="margin-bottom: 2em" class="row">
      <img class="image" src="./images/<?php echo $serial_no?>.jpg" alt="Car Picture">
    </div>
    <div style="margin-bottom: 2em" class="row">
      <a href="./test-drive/index.php?data=<?php echo $serial_no; ?>&and=<?php echo $row['model_name']; ?>" style="width: 40%; margin: auto" class="btn btn-danger btn-sm">Schedule a Test Drive for this Vehicle</a>
    </div>
  </div>

  <?php require('./inc/footer.html'); ?>

<style>
  .image{
    max-width: 60%;
    margin: auto;
  }

  .layout{
      margin: auto;
      width: 85vw;
      height: max-content;
      background-color: white;
      padding-bottom: 3em;
      margin-bottom: 5em;
  }
  p{
    margin-bottom: -0.1em !important;
  }
  button{
    margin-bottom: 0.5em;
  }
  .dividersmol{
    height: 1px;
    background-color: gray;
    width: 100%;
    margin-top: 1em;
    margin-bottom: 1em; 
  }
  .transition{
  animation: transitionIn 1.5s;
  }
  @keyframes transitionIn {
    from{
      opacity: 0;
      transform: translateY(20px);
    }
    to{
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>