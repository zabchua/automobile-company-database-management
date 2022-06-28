<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Add, Edit, Delete</title>

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
    $branch_id = 0;
    $branch_name = '';
    $lot_no = '';
    $street = '';
    $city = '';
    $country = '';

    if (isset($_POST['save'])){
        $branch_name = $_POST['branch_name'];
        $lot_no = $_POST['lot_no'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        $mysqli->query("INSERT INTO branch (branch_name, lot_no, street, city, country) VALUES('$branch_name', '$lot_no', '$street', '$city', '$country')") or die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: branch.php");
    }

    if (isset($_GET['delete'])){
        $branch_id = $_GET['delete'];
        $mysqli->query("DELETE FROM branch WHERE branch_id=$branch_id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: branch.php");
    }

    if (isset($_GET['edit'])){
        $branch_id = $_GET["edit"];
        $update = true;
        $result = $mysqli->query("SELECT * FROM branch WHERE branch_id=$branch_id") or die($mysqli->error());
            $row = $result->fetch_array();
            $branch_name = $row['branch_name'];
            $lot_no = $row['lot_no'];
            $street = $row['street'];
            $city = $row['city'];
            $country = $row['country'];
    }

    if (isset($_POST['update'])){
        $branch_id = $_POST['branch_id'];
        $branch_name = $_POST['branch_name'];
        $lot_no = $_POST['lot_no'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        $mysqli->query("UPDATE branch SET branch_name='$branch_name', lot_no='$lot_no', street='$street', city='$city', country='$country' WHERE branch_id=$branch_id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: branch.php");
    }

    ?>
</body>
</html>