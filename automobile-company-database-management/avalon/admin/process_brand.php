<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Add, Edit, Delete</title>

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
    $brand_id = 0;
    $brand_name = '';

    if (isset($_POST['save'])){
        $brand_name = $_POST['brand_name'];

        $mysqli->query("INSERT INTO brand (brand_name) VALUES('$brand_name')") or die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: brand.php");
    }

    if (isset($_GET['delete'])){
        $brand_id = $_GET['delete'];
        $mysqli->query("DELETE FROM brand WHERE brand_id=$brand_id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: brand.php");
    }

    if (isset($_GET['edit'])){
        $brand_id = $_GET["edit"];
        $update = true;
        $result = $mysqli->query("SELECT * FROM brand WHERE brand_id=$brand_id") or die($mysqli->error());
            $row = $result->fetch_array();
            $brand_name = $row['brand_name'];
    }

    if (isset($_POST['update'])){
        $brand_id = $_POST['brand_id'];
        $brand_name = $_POST['brand_name'];

        $mysqli->query("UPDATE brand SET brand_name='$brand_name' WHERE brand_id=$brand_id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: brand.php");
    }

    ?>
</body>
</html>