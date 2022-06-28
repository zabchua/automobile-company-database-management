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
</head>

<body>
    <?php
    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

    //DEFAULTS
    $update = false;
    $branch_name = '';
    $company_name = '';

    if (isset($_POST['save'])){
        $branch_id = $_POST['branch_id'];
        $supplier_id = $_POST['supplier_id'];

        $mysqli->query("INSERT INTO provides (branch_id, supplier_id) VALUES('$branch_id', '$supplier_id')") or die($mysqli->error());
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: provides.php");
    }

    if (isset($_GET['delete'], $_GET['and'])){
        $branch_id = $_GET['delete'];
        $supplier_id = $_GET['and'];

        $mysqli->query("DELETE FROM provides WHERE (branch_id=$branch_id AND supplier_id=$supplier_id)") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: provides.php");
    }

    if (isset($_GET['edit'], $_GET['and'])){
        $branch_id = $_GET['edit'];
        $supplier_id = $_GET['and'];

        $update = true;
        $result = $mysqli->query("SELECT branch.branch_name, supplier.company_name FROM branch JOIN provides ON branch.branch_id = provides.branch_id JOIN supplier ON supplier.supplier_id = provides.supplier_id WHERE provides.branch_id=$branch_id AND provides.supplier_id=$supplier_id") or die($mysqli->error);
            $row = $result->fetch_array();
            $branch_name = $row['branch_name'];
            $company_name = $row['company_name'];
    }

    if (isset($_POST['update'])){
        $branch_id = $_POST['branch_id'];
        $supplier_id = $_POST['supplier_id'];

        $mysqli->query("UPDATE provides SET branch_id='$branch_id', supplier_id='$supplier_id' WHERE branch_id=$branch_id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: provides.php");
    }

    ?>
</body>
</html>