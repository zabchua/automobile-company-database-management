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
    <?php
    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

    //DEFAULTS
    $update = false;
    $serial_no = 0;
    $model_name = '';
    $year = '';
    $transmission = '';
    $color = '';
    $speed = '';
    $engine = '';
    $seat_capacity = '';
    $price = '';
    $availability = '';
    $description = '';

    if (isset($_POST['save'])){
        $model_name = $_POST['model_name'];
        $year = $_POST['year'];
        $transmission = $_POST['transmission'];
        $color = $_POST['color'];
        $speed = $_POST['speed'];
        $engine = $_POST['engine'];
        $seat_capacity = $_POST['seat_capacity'];
        $price = $_POST['price'];
        $availability = $_POST['availability'];
        $description = $_POST['description'];

        
        if ($mysqli->query("INSERT INTO item (model_name, year, transmission, color, speed, engine, seat_capacity, price, availability, description) VALUES('$model_name', '$year', '$transmission', '$color', '$speed', '$engine', '$seat_capacity', '$price', '$availability', '$description')") or die($mysqli->error) === TRUE) {
                        
                    $idbrand = "SELECT brand_id FROM brand WHERE (brand_name = '$_POST[manufacturer]')";
                    $idtype = "SELECT type_id FROM vehicle_type WHERE (type_name = '$_POST[type]')";
                    $last_id = $mysqli->insert_id;

                    $result = mysqli_query($mysqli,$idbrand);
                    $result_fortype = mysqli_query($mysqli,$idtype);
                    //inserts data in branded//                    
                    if (mysqli_num_rows($result)> 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $query1 = "INSERT into branded values ($last_id, $row[brand_id])";
                            echo $query1;
                            mysqli_query($mysqli, $query1);
                        }
                        echo "</select>";
                    }
                    
                    //inserts data in categorized//
                    
                        if (mysqli_num_rows($result_fortype)> 0){
                            while($row = mysqli_fetch_assoc($result_fortype)){
                                $query1 = "INSERT into categorized values ($last_id, $row[type_id])";
                                mysqli_query($mysqli, $query1);
                            }
                            echo "</select>";
                        }
                             
                                                
                  }

        $_SESSION['message'] = "Record Model: '$model_name' has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: item.php");
    }

    if (isset($_GET['delete'])){
        $serial_no = $_GET['delete'];
        $mysqli->query("DELETE FROM item WHERE serial_no=$serial_no") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: item.php");
    }

    if (isset($_GET['edit'])){
        $serial_no = $_GET["edit"];
        $update = true;
        $result = $mysqli->query("SELECT * FROM item WHERE serial_no = $serial_no") or die($mysqli->error());
            $row = $result->fetch_array();
            $model_name = $row['model_name'];
            $year = $row['year'];
            $transmission = $row['transmission'];
            $color = $row['color'];
            $speed = $row['speed'];
            $engine = $row['engine'];
            $seat_capacity = $row['seat_capacity'];
            $price = $row['price'];
            $availability = $row['availability'];
            $description = $row['description'];
           
    }

    if (isset($_POST['update'])){
        $serial_no = $_POST['serial_no'];
        $model_name = $_POST['model_name'];
        $year = $_POST['year'];
        $transmission = $_POST['transmission'];
        $color = $_POST['color'];
        $speed = $_POST['speed'];
        $engine = $_POST['engine'];
        $seat_capacity = $_POST['seat_capacity'];
        $price = $_POST['price'];
        $availability = $_POST['availability'];
        $description = $_POST['description'];
        $brand = $_POST['manufacturer'];
        $type = $_POST['type'];

        

        $mysqli->query("UPDATE item SET model_name='$model_name', year='$year', transmission='$transmission', color='$color', speed='$speed', engine='$engine', seat_capacity='$seat_capacity', price='$price', availability='$availability', description='$description' WHERE serial_no=$serial_no") or die($mysqli->error);
        $mysqli->query("UPDATE branded SET brand_id = (select brand_id from brand where brand_name = '$brand') WHERE serial_no=$serial_no") or die($mysqli->error);
        $mysqli->query("UPDATE categorized SET type_id = (select type_id from vehicle_type where type_name = '$type') WHERE serial_no=$serial_no") or die($mysqli->error);
        
        $_SESSION['message'] = "Record  Model: '$model_name' has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: item.php");
    }

    ?>
</body>
</html>