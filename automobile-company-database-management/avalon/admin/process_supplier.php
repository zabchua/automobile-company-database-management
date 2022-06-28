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
    <?php
    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

    //DEFAULTS
    $update = false;
    $supplier_id = 0;
    $company_name = '';
    $lot_no = '';
    $st = '';
    $city = '';
    $country = '';
    $pn = '';
    $email = '';

    if (isset($_POST['save'])){
        $company_name = $_POST['company_name'];
        $lot_no = $_POST['lot_no'];
        $st = $_POST['st'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $pn = $_POST['pn'];
        $email = $_POST['email'];

        $mysqli->query("INSERT INTO supplier (company_name, lot_no, street, city, country, phone_no, email) VALUES('$company_name', '$lot_no', '$st', '$city', '$country', '$pn', '$email')") or die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: supplier.php");
    }

    if (isset($_GET['delete'])){
        $supplier_id = $_GET['delete'];
        $mysqli->query("DELETE FROM supplier WHERE supplier_id=$supplier_id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: supplier.php");
    }

    if (isset($_GET['edit'])){
        $supplier_id = $_GET["edit"];
        $update = true;
        $result = $mysqli->query("SELECT * FROM supplier WHERE supplier_id=$supplier_id") or die($mysqli->error());
            $row = $result->fetch_array();
            $company_name = $row['company_name'];
            $lot_no = $row['lot_no'];
            $st = $row['street'];
            $city = $row['city'];
            $country = $row['country'];
            $pn = $row['phone_no'];
            $email = $row['email'];
    }

    if (isset($_POST['update'])){
        $supplier_id = $_POST['supplier_id'];
        $company_name = $_POST['company_name'];
        $lot_no = $_POST['lot_no'];
        $st = $_POST['st'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $pn = $_POST['pn'];
        $email = $_POST['email'];

        $mysqli->query("UPDATE supplier SET company_name='$company_name', lot_no='$lot_no', street='$st', city='$city', country='$country', phone_no='$pn', email='email' WHERE supplier_id=$supplier_id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: supplier.php");
    }

    ?>
</body>
</html>