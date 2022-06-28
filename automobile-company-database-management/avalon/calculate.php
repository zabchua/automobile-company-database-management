<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Add, Edit, Delete</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    session_start();

    if (isset($_POST['calculate'])){
        $percent = $_POST['percent'];
        $months = $_POST['months'];
        $serial_no = $_POST['serial_no'];
        
        if ($months == 6){
            $interest = 0.001;
        }elseif ($months == 12){
            $interest = 0.005;
        }elseif ($months == 12){
            $interest = 0.009;
        }elseif ($months == 24){
            $interest = 0.01;
        }elseif ($months == 36){
            $interest = 0.02;
        }elseif ($months == 48){
            $interest = 0.025;
        }elseif ($months == 60){
            $interest = 0.05;
        }

        $left = $price - ($percent*$price);
        $total = $left + ($left*$interest*$months);
        $permonth = ($left + ($left*$interest*$months))/$months;
        
        $_SESSION['total'] = $total;
        $_SESSION['permonth'] = $permonth;
        $_SESSION['msg_type'] = "success";

        header("location: ./carmodel.php?data=$serial_no");
    }

    ?>
</body>
</html>

<div class="image">

      <!-- compute first hehe -->
      <?php
        $price = $row['price'];
        $ten = 0.1*$price;
        $fifteen = 0.15*$price;
        $twenty = 0.2*$price;
        $twentyfive = 0.25*$price;
        $thirty = 0.3*$price;
        $thirtyfive = 0.35*$price;
        $forty = 0.4*$price;
        $fortyfive = 0.45*$price;
        $fifty = 0.5*$price;
        $sixty = 0.6*$price;
      ?>

      <form action="">
        <div class="row">
          <input type="hidden" name="serial_no" value="<?php echo $row['serial_no']; ?>">
          <input type="hidden" name="price" value="<?php echo $price; ?>">
          <div class="mb-3 col-4">
            <label for="dp" class="form-label">Downpayment</label>
            <select name="percent" class="form-select" aria-label="Default select example" id="dp">
              <option value="0.1">10% = PHP <?php echo number_format($ten); ?>.00</option>
              <option value="0.15">15% = PHP <?php echo number_format($fifteen); ?>.00</option>
              <option value="0.2">20% = PHP <?php echo number_format($twenty); ?>.00</option>
              <option value="0.25">25% = PHP <?php echo number_format($twentyfive); ?>.00</option>
              <option value="0.3">30% = PHP <?php echo number_format($thirty); ?>.00</option>
              <option value="0.35">35% = PHP <?php echo number_format($thirtyfive); ?>.00</option>
              <option value="0.4">40% = PHP <?php echo number_format($forty); ?>.00</option>
              <option value="0.45">45% = PHP <?php echo number_format($fortyfive); ?>.00</option>
              <option value="0.5">50% = PHP <?php echo number_format($fifty); ?>.00</option>
              <option value="0.6">60% = PHP <?php echo number_format($sixty); ?>.00</option>
            </select>
          </div>
          <div class="mb-3 col-3">
            <label for="dp" class="form-label">No. of Months</label>
            <select name="months" class="form-select" aria-label="Default select example" id="dp">
              <option value="6">6 Months</option>
              <option value="12">12 Months</option>
              <option value="18">18 Months</option>
              <option value="24">24 Months</option>
              <option value="36">36 Months</option>
              <option value="48">48 Months</option>
              <option value="60">60 Months</option>
            </select>
          </div>
          <div class="mb-3 col-2">
            <label for="sub">Plan</label> <p></p>
            <button type="submit" id="sub" name="calculate" class="btn btn-danger">Calculate</button>
            </form>
          </div>
          <div class="mb-3 col-2">
          </div>
        </div>
        <p></p>

    </div>

    <!-- <div class="image">
      <?php
        $price = $row['price'];
        $ten = 0.1*$price;
        $fifteen = 0.15*$price;
        $twenty = 0.2*$price;
        $twentyfive = 0.25*$price;
        $thirty = 0.3*$price;
        $thirtyfive = 0.35*$price;
        $forty = 0.4*$price;
        $fortyfive = 0.45*$price;
        $fifty = 0.5*$price;
        $sixty = 0.6*$price;
      ?>

      <form action="">
        <div class="row">
          <input type="hidden" name="serial_no" value="<?php echo $row['serial_no']; ?>">
          <input type="hidden" name="price" value="<?php echo $price; ?>">
          <div class="mb-3 col-4">
            <label for="dp" class="form-label">Downpayment</label>
            <select name="percent" class="form-select" aria-label="Default select example" id="dp">
              <option value="0.1">10% = PHP <?php echo number_format($ten); ?>.00</option>
              <option value="0.15">15% = PHP <?php echo number_format($fifteen); ?>.00</option>
              <option value="0.2">20% = PHP <?php echo number_format($twenty); ?>.00</option>
              <option value="0.25">25% = PHP <?php echo number_format($twentyfive); ?>.00</option>
              <option value="0.3">30% = PHP <?php echo number_format($thirty); ?>.00</option>
              <option value="0.35">35% = PHP <?php echo number_format($thirtyfive); ?>.00</option>
              <option value="0.4">40% = PHP <?php echo number_format($forty); ?>.00</option>
              <option value="0.45">45% = PHP <?php echo number_format($fortyfive); ?>.00</option>
              <option value="0.5">50% = PHP <?php echo number_format($fifty); ?>.00</option>
              <option value="0.6">60% = PHP <?php echo number_format($sixty); ?>.00</option>
            </select>
          </div>
          <div class="mb-3 col-3">
            <label for="dp" class="form-label">No. of Months</label>
            <select name="months" class="form-select" aria-label="Default select example" id="dp">
              <option value="6">6 Months</option>
              <option value="12">12 Months</option>
              <option value="18">18 Months</option>
              <option value="24">24 Months</option>
              <option value="36">36 Months</option>
              <option value="48">48 Months</option>
              <option value="60">60 Months</option>
            </select>
          </div>
          <div class="mb-3 col-2">
            <label for="sub">Plan</label> <p></p>
            <button type="submit" id="sub" name="calculate" class="btn btn-danger">Calculate</button>
            </form>
          </div>
          <div class="mb-3 col-2">
          </div>
        </div>
        <p></p>

    </div> -->