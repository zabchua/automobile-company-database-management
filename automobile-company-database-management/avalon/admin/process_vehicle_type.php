<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Type Add, Edit, Delete</title>

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
    $type_id = 0;
    $type_name = '';

    if (isset($_POST['save'])){
        $type_name = $_POST['type_name'];

        $mysqli->query("INSERT INTO vehicle_type (type_name) VALUES('$type_name')") or die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: vehicle_type.php");
    }

    if (isset($_GET['delete'])){
        $type_id = $_GET['delete'];
        $mysqli->query("DELETE FROM vehicle_type WHERE type_id=$type_id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: vehicle_type.php");
    }

    if (isset($_GET['edit'])){
        $type_id = $_GET["edit"];
        $update = true;
        $result = $mysqli->query("SELECT * FROM vehicle_type WHERE type_id=$type_id") or die($mysqli->error());
            $row = $result->fetch_array();
            $type_name = $row['type_name'];
    }

    if (isset($_POST['update'])){
        $type_id = $_POST['type_id'];
        $type_name = $_POST['type_name'];

        $mysqli->query("UPDATE vehicle_type SET type_name='$type_name' WHERE type_id=$type_id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: vehicle_type.php");
    }

    ?>
</body>
</html>