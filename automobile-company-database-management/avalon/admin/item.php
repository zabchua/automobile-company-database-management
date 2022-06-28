<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Add, Edit, Delete</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<body>
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="./index.php">Customers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./user_role.php">User Role</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./dealer.php">Dealers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./supplier.php">Suppliers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="./item.php">Items</a>
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
        <a class="nav-link" href="./appointment-admin.php">Appointments</a>
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
    </ul>

    <?php require_once 'process_item.php'; ?>
    
    <?php

    if (isset($_SESSION['message'])): ?>
        <div style="z-index: 100; width: 100%" class="position-absolute alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <div class="container transition">
    <div style="padding-top: 3em;">
        <a class="btn btn-dark" href="../foradmin.php" role="button">Go back to homepage</a>
    </div>
    
    <div class="mx-auto" style="width: 99%; padding-top: 3em;">
    <h1 class="display-4">Item <small class="text-muted">Database Form</small></h1>
        <form action="process_item.php" method="POST">
            <input type="hidden" name="serial_no" value="<?php echo $serial_no; ?>">
            <div class="hstack gap-2">
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Model Name</label>
                    <input type="text" name="model_name" class="form-control" value="<?php echo $model_name; ?>" placeholder="e.g. Fortuner" required autofocus>
                </div>
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Year</label>
                    <input type="text" name="year" class="form-control" value="<?php echo $year; ?>" placeholder="e.g. 1965" required pattern="^[0-9]*$">
                </div>
            </div>
            <div class="hstack gap-2">
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Manufacturer</label>
                    <select name="manufacturer" class="form-control"  value="<?php echo $manufacturer; ?>" placeholder="e.g. Honda" required>
                        <?php
                        $server = "localhost:3306";
                        $user = "root";
                        $pass = "";
                        $db = "sza";
                        $conn = mysqli_connect($server, $user, $pass, $db);
                        if(!$conn) die(mysqli_error($conn));

                        $query = "select * from brand";
                        $result = mysqli_query($conn,$query);
                        if (mysqli_num_rows($result)> 0){
                            echo "<option value = others> -Select- </option>";
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value = '".$row['brand_name']."'>"
                                .$row['brand_name']."</option>";
                            }
                            echo "</select>";
                        }
                        mysqli_close($conn);
                    ?>
                    </select>
                </div>
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Vehicle Type</label>
                    <select name="type" class="form-control"  value="<?php echo $type; ?>" placeholder="e.g. Sedan" required>
                        <?php
                        $server = "localhost:3306";
                        $user = "root";
                        $pass = "";
                        $db = "sza";
                        $conn = mysqli_connect($server, $user, $pass, $db);
                        if(!$conn) die(mysqli_error($conn));

                        $query = "select * from vehicle_type";
                        $result = mysqli_query($conn,$query);
                        if (mysqli_num_rows($result)> 0){
                            echo "<option value = others> -Select- </option> ";
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value = '".$row['type_name']."'>"
                                .$row['type_name']."</option>";
                            }
                            echo "</select>";
                        }
                        mysqli_close($conn);
                    ?>
                    </select>
                </div>
            </div>

            <div class="hstack gap-3">
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Transmission</label>
                    <select name="transmission" class="form-control"  value="<?php echo $transmission; ?>" placeholder="e.g. Manual" required>
                        <option class="disabled" selected>Choose...</option>
                        <option>Manual transmission</option>
                        <option>Automatic transmission</option>
                        <option>Continuously variable transmission (CVT)</option>
                        <option>Semi-automatic and dual-clutch transmissions</option>
                    </select>
                </div>
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Color</label>
                    <input type="text" name="color" class="form-control" value="<?php echo $color; ?>" placeholder="e.g. Red" required>
                </div>
                <div class="col form-group" style="padding-top: 1em">
                    <label for="">Speed (units in hp)</label>
                    <input type="text" name="speed" class="form-control" value="<?php echo $speed; ?>" placeholder="e.g. 180" required pattern="^[0-9]*$">
                </div>
            </div>
            <div class="hstack gap-4">
                <div class="form-group col-md-4" style="padding-top: 1em">
                    <label for="">Engine</label>
                    <input type="text" name="engine" class="form-control" value="<?php echo $engine; ?>" placeholder="e.g. Ford Supercharged 5.2-Liter V8: A Predator" required>
                </div>
                <div class="form-group col-md-2" style="padding-top: 1em">
                    <label for="">Seat Capacity</label>
                    <input type="text" name="seat_capacity" class="form-control" value="<?php echo $seat_capacity; ?>" placeholder="e.g 4" required pattern="^[0-9]*$">
                </div>
                <div class="form-group col-md-3" style="padding-top: 1em">
                    <label for="">Price (php)</label>
                    <input type="tel" name="price" class="form-control" value="<?php echo $price; ?>" placeholder="e.g. 5000000" pattern="^[0-9]*$" required>
                </div>
                <div class="form-group col-md-2" style="padding-top: 1em">
                <label for="">Availability</label>
                    <select name="availability" class="form-control"  value="<?php echo $availability; ?>" placeholder="e.g. Not Available" required>
                        <option class="disabled" selected>Choose...</option>
                        <option>Available</option>
                        <option>Not Available</option>
                    </select>
                </div>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Description</label>
                <input type="textbox" name="description" class="form-control" value="<?php echo $description; ?>" placeholder="e.g. The Fortuner is powered by a 2393cc 4-cylinder Diesel engine produces 148 hp of power and 400 Nm of torque and 2755cc 4-cylinder Diesel engine produces 201 hp of power and 500 Nm of torque. It comes with the option of a 6-Speed Manual and 6-Speed Automatic transmission gearbox." >
            </div>
            <div class="form-group" style="padding-top: 2em">
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

    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM item") or die(mysqli_error);
        //pre_r($result);
    ?>

    <div class="mx-auto" style="width: 99%; padding-top: 3em; padding-bottom: 5em;">
    <h1 class="display-4" style="padding-bottom: 0.3em;">Item <small class="text-muted">Information Table</small></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Model Name</th>
                    <th>Year</th>
                    <th>Transmission</th>
                    <th>Color</th>
                    <th>Speed</th>
                    <th>Engine</th>
                    <th>Seat Capacity</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>

        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['serial_no']; ?></td>
                    <td><?php echo $row['model_name']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['transmission']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td><?php echo $row['speed']; ?></td>
                    <td><?php echo $row['engine']; ?></td>
                    <td><?php echo $row['seat_capacity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['availability']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="item.php?edit=<?php echo $row['serial_no']; ?>"
                            class="btn btn-info">Edit</a>
                        <button onclick="check(<?php echo $row['serial_no']; ?>)" type="button" class="btn btn-danger">Delete</button>

                        <script>
                        function check(e){
                            const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                            })

                            swalWithBootstrapButtons.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true
                            }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = "process_item.php?delete=" + e;
                            } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Record not deleted :)',
                                'error'
                                )
                            }
                            })
                        }
                        </script>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php

        function pre_r( $array ) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>
    </div>
</body>
</html>