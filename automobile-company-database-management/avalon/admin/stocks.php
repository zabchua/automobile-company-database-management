<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Drop Add, Edit, Delete</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="sweetalert2.all.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(function(){
            $("#ddlselect").change(function(){
                var displaycourse=$("#ddlselect option:selected").text();
                $("#txtresults").val(displaycourse);
            })
        })
    </script>
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
        <a class="nav-link active" href="./stocks.php">Stocks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./works_at.php">Employees</a>
    </li>
    </ul>

    <?php require_once 'process_stocks.php'; ?>

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
    <h1 class="display-4">Stocks <small class="text-muted">Database Form</small></h1>

        <form action="process_stocks.php" method="POST">

            <input type="hidden" name="serial_no" value="<?php echo $serial_no; ?>">

            <?php
            $choices_items = $mysqli->query("SELECT * FROM item") or die($mysqli->error);
            $choices_branch = $mysqli->query("SELECT * FROM branch") or die($mysqli->error);
            ?>

            <div class="col form-group" style="padding-top: 1em">   
            <label for="">Item Serial No</label> 
            <?php if ($update == true):?>
                <button disabled type="button" class="btn btn-secondary btn-sm">
                <?php echo $serial_no; ?>
                </button>
            <?php endif; ?>
            
            <select name="serial_no"  class="form-control"  id="ddlselect">
                <option selected disabled value=NULL>Choose an existing item...</option>
                <?php
                while($rows = $choices_items->fetch_assoc()){
                    $serial_no = $rows['serial_no'];
                    echo "<option value='$serial_no'>$serial_no</option>";
                }
                ?>
            </select>
            </div>

            <div class="col form-group" style="padding-top: 1em">
            <label for="">Branch Name</label>
            <?php if ($update == true):?>
                <button disabled type="button" class="btn btn-secondary btn-sm">
                <?php echo $branch_name; ?>
                </button>
            <?php endif; ?>
            <select name="branch_id"  class="form-control"  id="ddlselect">
                <option selected disabled value=NULL>Choose an existing branch...</option>
                <?php
                while($rows = $choices_branch->fetch_assoc()){
                    $branch_id = $rows['branch_id'];
                    $branch_name = $rows['branch_name'];
                    echo "<option value='$branch_id'>$branch_name</option>";
                }
                ?>
            </select>
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
        $result = $mysqli->query("SELECT
                                    stocks.serial_no,
                                    item.model_name,
                                    stocks.branch_id,
                                    branch.branch_name,
                                    branch.city
                                FROM item
                                JOIN stocks
                                    ON item.serial_no = stocks.serial_no
                                JOIN branch
                                    ON branch.branch_id = stocks.branch_id;") or die(mysqli_error);
        //pre_r($result);
    ?>

    <div class="mx-auto" style="width: 99%; padding-top: 3em; padding-bottom: 5em;">
    <h1 class="display-4" style="padding-bottom: 0.3em;">Stocks <small class="text-muted">Information Table</small></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Item Serial No.</th>
                    <th>Item Model Name</th>
                    <th>Branch Id</th>
                    <th>Branch Name</th>
                    <th>Branch City</th>
                    <th>Actions</th>
                </tr>
            </thead>

        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['serial_no']; ?></td>
                    <td><?php echo $row['model_name']; ?></td>
                    <td><?php echo $row['branch_id']; ?></td>
                    <td><?php echo $row['branch_name']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td>
                        <a href="stocks.php?edit=<?php echo $row['serial_no']; ?>"
                            class="btn btn-info">Edit</a>
                        <button onclick="check(<?php echo $row['serial_no']; ?>)" type="button" class="btn btn-danger">Delete</button>

                        <script>
                        function check(e, a){
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
                                document.location.href = "process_stocks.php?delete=" + e;
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