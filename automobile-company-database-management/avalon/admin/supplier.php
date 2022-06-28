<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Add, Edit, Delete</title>

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
        <a class="nav-link active" href="#">Suppliers</a>
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
    </ul>

    <?php require_once 'process_supplier.php'; ?>

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
    <h1 class="display-4">Supplier <small class="text-muted">Database Form</small></h1>
        <form action="process_supplier.php" method="POST">
            <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>">
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Company Name</label>
                <input type="text" name="company_name" class="form-control" value="<?php echo $company_name; ?>" placeholder="e.g. General Motors Inc." required autofocus>
            </div>
            <div class="hstack gap-2">
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Lot No.</label>
                <input type="text" name="lot_no" class="form-control" value="<?php echo $lot_no; ?>" placeholder="e.g. 123" required>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Street</label>
                <input type="text" name="st" class="form-control" value="<?php echo $st; ?>" placeholder="e.g. Ped Xing" required>
            </div>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" placeholder="e.g. Baguio" required pattern="[a-zA-Z]{2,}">
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Country</label>
                <input type="text" name="country" class="form-control" value="<?php echo $country; ?>" placeholder="e.g Philippines" required pattern="[a-zA-Z]{2,}">
            </div>
            <div class="hstack gap-2">
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Phone Number</label>
                <input type="tel" name="pn" class="form-control" value="<?php echo $pn; ?>" placeholder="e.g. 09123456789" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" required>
            </div>
            <div class="col form-group" style="padding-top: 1em">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="e.g. juan123@gmail.com" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$"  required>
            </div>
            </div>
            <div class="form-group" style="padding-top: 1em">
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
        $result = $mysqli->query("SELECT * FROM supplier") or die(mysqli_error);
        //pre_r($result);
    ?>

    <div class="mx-auto" style="width: 99%; padding-top: 3em; padding-bottom: 5em;">
    <h1 class="display-4" style="padding-bottom: 0.3em;">Supplier <small class="text-muted">Information Table</small></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Lot No.</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Phone No.</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>

        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['company_name']; ?></td>
                    <td><?php echo $row['lot_no']; ?></td>
                    <td><?php echo $row['street']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php echo $row['phone_no']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="supplier.php?edit=<?php echo $row['supplier_id']; ?>"
                            class="btn btn-info">Edit</a>
                        <button onclick="check(<?php echo $row['supplier_id']; ?>)" type="button" class="btn btn-danger">Delete</button>

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
                                document.location.href = "process_supplier.php?delete=" + e;
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