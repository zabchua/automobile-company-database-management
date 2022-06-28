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
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="./index.php">Customers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#">User Role</a>
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

    <?php require_once 'process.php'; ?>
    
    <?php

    if (isset($_SESSION['message'])): ?>
        <div style="z-index: 100; width: 100%" class="position-absolute alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM users") or die(mysqli_error);
        //pre_r($result);
    ?>
    
    <div class="container transition">
    <div style="padding-top: 3em;">
        <a class="btn btn-dark" href="../foradmin.php" role="button">Go back to homepage</a>
    </div>

    <div class="mx-auto" style="width: 99%; padding-top: 3em; padding-bottom: 5em;">
    <h1 class="display-4" style="padding-bottom: 0.3em;">User <small class="text-muted">Role</small></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>

        
        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php echo $row['user_id']; ?>
                    </td>
                    <td>
                        <?php echo $row['email']; ?>
                    </td>

                    <td>
                        <form action="process_role.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <select name="userInfo">
                            <?php if($row['role'] == "customer") { ?>
                                <option selected="selected" value="customer">Customer</option>
                                <option value="admin">Admin</option>  
                            <?php } elseif($row['role'] == "admin") { ?>
                                <option selected="selected" value="admin">Admin</option>
                                <option value="customer">Customer</option> 
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-info" name="update">Update User</button>
                        <button onclick="check(<?php echo $row['user_id']; ?>)" type="button" class="btn btn-danger">Delete User</button>

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
                                document.location.href = "process_role.php?delete=" + e;
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
                    </form>
                    </td>
                </tr>

                
            <?php endwhile; ?>
        </table>
    </div>       
    </div>
</body>
</html>