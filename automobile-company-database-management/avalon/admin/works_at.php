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
        <a class="nav-link" href="./stocks.php">Stocks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="./works_at.php">Employees</a>
    </li>
    </ul>

    <?php require_once 'process_works_at.php'; ?>

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
    <div class="mx-auto" style="width: 99%; padding-top: 5em;">
    <h1 class="display-4">Employee <small class="text-muted">Database Form</small></h1>

        <form action="process_works_at.php" method="POST">

            <input type="hidden" name="dealer_id" value="<?php echo $dealer_id; ?>">

            <?php
            $choices_dealer = $mysqli->query("SELECT * FROM dealer where dealer_id not in (Select dealer_id from works_at)") or die($mysqli->error);
            $choices_branch = $mysqli->query("SELECT * FROM branch") or die($mysqli->error);
            ?>

            <div class="col form-group" style="padding-top: 1em">   
            <label for="">Dealer Name</label>   
            <select name="dealer_id"  class="form-control"  id="ddlselect">
                <option selected disabled value=NULL>Choose an existing dealer...</option>
                <?php
                while($rows = $choices_dealer->fetch_assoc()){
                    $dealer_id = $rows['dealer_id'];
                    $f_name = $rows['f_name'];
                    $m_name = $rows['m_name'];
                    $l_name = $rows['l_name'];
                    echo "<option value=" . $dealer_id . ">" . $f_name . " " . $m_name  . " " . $l_name . "</option>";
                }
                ?>
            </select>
            </div>

            <div class="col form-group" style="padding-top: 1em">
            <label for="">Branch Name</label>
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
                
                    
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
 
            </div>
        </form>
    </div>
    

    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT
                                    works_at.dealer_id,
                                    dealer.f_name,
                                    dealer.m_name,
                                    dealer.l_name,
                                    works_at.branch_id,
                                    branch.branch_name,
                                    branch.city
                                FROM dealer
                                JOIN works_at
                                    ON dealer.dealer_id = works_at.dealer_id
                                JOIN branch
                                    ON branch.branch_id = works_at.branch_id ORDER BY dealer_id") or die(mysqli_error);
        //pre_r($result);
    ?>

    <div class="mx-auto" style="width: 99%; padding-top: 3em; padding-bottom: 5em;">
    <h1 class="display-4" style="padding-bottom: 0.3em;">Employee <small class="text-muted">Information Table</small></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Dealer Id</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Branch Id</th>
                    <th>Branch Name</th>
                    
                </tr>
            </thead>

        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['dealer_id']; ?></td>
                    <td><?php echo $row['f_name']; ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['l_name']; ?></td>
                    <td>
                     <form action="process_works_at.php" method="POST">
                     <input type="hidden" name="dealer_id_up" value="<?php echo $row['dealer_id']; ?>">
                    <select name = "branch_id_up">
                    <?php
                        $server = "localhost:3306";
                        $user = "root";
                        $pass = "";
                        $db = "sza";
                        $conn = mysqli_connect($server, $user, $pass, $db);
                        if(!$conn) die(mysqli_error($conn));

                        $query1 = "select * from branch where branch_id = $row[branch_id]";
                        $query2 = "select * from branch where branch_id != $row[branch_id]";
                        $result3 = mysqli_query($conn,$query1);
                        $result2 = mysqli_query($conn,$query2);
                        if (mysqli_num_rows($result3)> 0){
                            while($row1 = mysqli_fetch_assoc($result3)){
                                echo "<option value = '".$row1['branch_id']."'>"
                                .$row['branch_name']."</option>";
                            }
                        }
                        if (mysqli_num_rows($result2)> 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                                echo "<option value = '".$row2['branch_id']."'>"
                                .$row2['branch_name']."</option>";
                            }
                            echo "</select>";
                        }
                        mysqli_close($conn);
                    ?>
                
                
                
                </td>
                    <td>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                    </form>
                        <button onclick="check(<?php echo $row['dealer_id']; ?>)" type="button" class="btn btn-danger">Delete</button>

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
                                document.location.href = "process_works_at.php?delete=" + e;
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