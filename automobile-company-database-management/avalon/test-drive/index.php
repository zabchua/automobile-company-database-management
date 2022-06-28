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
    <!-- <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#">Customers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./dealer.php">Dealers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./supplier.php">Suppliers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-warning" href="./item.php">Items</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted" href="./branch.php">Branches</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted" href="./brand.php">Brands</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted" href="./vehicle_type.php">Vehicle Types</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./set_appointment.php">Appointments</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./provides.php">Supply Drop</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./stocks.php">Stocks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./works_at.php">Employees</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./deals_with.php">Dealings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./branded.php">Brandings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./categorized.php">Categories</a>
    </li>
    </ul> -->

    <div class="bg"></div>

    <?php
        session_start();
        
        if( isset($_SESSION['userId'])) {
            require('../config/db.php');
            
            $userId = $_SESSION['userId']; // 3

            $stmt = $pdo -> prepare('SELECT * FROM users WHERE user_id = ? ');
            $stmt -> execute([ $userId ]);

            $users = $stmt -> fetch();
        }
    ?>

    <?php require_once 'process.php'; ?>
    
    <div class="container transition">
    <div style="padding-top: 3em;">
        <a class="btn btn-dark" href="../loggedin.php" role="button">Go back to homepage</a>
    </div>
    
    <div class="mx-auto form-bg" style="width: 99%; padding-top: 3em;">
    <h1 class="display-4">Appointment <small class="text-muted">Form</small></h1>
    <p style="font-size:30px">Your Information </p>
        <form action="process.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $users->user_id ?>">
            <div class="hstack gap-3">
            <div class="col form-group" style="padding-top: 1em">
                <label for="">First Name</label>
                <input type="text" name="fname" class="form-control" disabled value="<?php echo $users->f_name ?>" placeholder="e.g. Juan Miguel" required autofocus>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Middle Name</label>
                <input type="text" name="mname" class="form-control" disabled value="<?php echo $users->m_name ?>" placeholder="e.g. Cirilo" required>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Last Name</label>
                <input type="text" name="lname" class="form-control" disabled value="<?php echo $users->l_name; ?>" placeholder="e.g. Dela Cruz" required>
            </div>
            </div>
            <div class="hstack gap-2">
            <div class="col form-group" style="padding-top: 1em">
                <label for="">House No.</label>
                <input type="text" name="hn" class="form-control" disabled value="<?php echo $users->house_no; ?>" placeholder="e.g. 123" required>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Street</label>
                <input type="text" name="st" class="form-control" disabled value="<?php echo $users->street; ?>" placeholder="e.g. Ped Xing" required>
            </div>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">City</label>
                <input type="text" name="city" class="form-control" disabled value="<?php echo $users->city; ?>" placeholder="e.g. Baguio" required pattern="[a-zA-Z]{2,}">
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Country</label>
                <input type="text" name="country" class="form-control" disabled value="<?php echo $users->country; ?>" placeholder="e.g Philippines" required pattern="[a-zA-Z]{2,}">
            </div>
            <div class="hstack gap-2">
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Phone Number</label>
                <input type="tel" name="pn" class="form-control" disabled value="<?php echo $users->phone_no; ?>" placeholder="e.g. 09123456789" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" required>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" disabled value="<?php echo $users->email; ?>" placeholder="e.g. juan123@gmail.com" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$"  required>
            </div>
            </div>
            <p style="font-size:30px; margin-top: 2em">Schedule an Appointment </p>
<!-- >>>>>>>>>>>>>>>>>>>>Appointment part<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->           
<div class="hstack gap-2">
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Car Model</label>
                    <select name="model" class="form-control"  value="<?php echo $model; ?>" placeholder="e.g. Honda" required>
                        <?php
                        if (isset($_GET['data'])){
                            $serial_no = $_GET['data'];
                            $model_name = $_GET['and'];
                            echo "<option selected value='$serial_no'>$model_name</option>";

                            $choices_models = $mysqli->query("SELECT * FROM item WHERE serial_no <> $serial_no") or die($mysqli->error);
                            while($rows = $choices_models->fetch_assoc()){
                                $serial_no = $rows['serial_no'];
                                $model_name = $rows['model_name'];
                                echo "<option value='$serial_no'>$model_name</option>";
                            }
                        }
                        else {?>
                        <option selected disabled value=NULL>Choose an existing model...</option>
                        <?php
                        $choices_models = $mysqli->query("SELECT * FROM item") or die($mysqli->error);
                            while($rows = $choices_models->fetch_assoc()){
                                $serial_no = $rows['serial_no'];
                                $model_name = $rows['model_name'];
                                echo "<option value='$serial_no'>$model_name</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Company Branch</label>
                    <select name="branches" class="form-control"  value="<?php echo $branch; ?>" placeholder="e.g. Sedan" required>
                    <option selected disabled value=NULL>Choose a branch near you...</option>
                        <?php
                        $choices_branches = $mysqli->query("SELECT * FROM branch") or die($mysqli->error);

                        while($rows = $choices_branches->fetch_assoc()){
                            $branch_id = $rows['branch_id'];
                            $branch_name = $rows['branch_name'];
                            echo "<option value='$branch_id'>$branch_name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
          
            <div class="col form-group" style="padding-top: 1em; ">
                <label for="">Date of Appointment</label>
                <input id="datefield" type="datetime-local" name="date" value="<?php echo $date; ?>" class="form-control" required/>
            </div>             

            <div class="form-group" style="padding-top: 1em; padding-bottom: 5em">
            <?php
            if ($update == true):
            ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>  
    </div>
</body>
</html>