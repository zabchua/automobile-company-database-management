<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Add, Edit, Delete</title>

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
    $dealer_id = 0;
    $fname = '';
    $mname = '';
    $lname = '';
    $hn = '';
    $st = '';
    $city = '';
    $country = '';
    $pn = '';
    $email = '';

    if (isset($_POST['save'])){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $hn = $_POST['hn'];
        $st = $_POST['st'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $pn = $_POST['pn'];
        $email = $_POST['email'];

        $mysqli->query("INSERT INTO dealer (f_name, m_name, l_name, house_no, street, city, country, phone_no, email) VALUES('$fname', '$mname', '$lname', '$hn', '$st', '$city', '$country', '$pn', '$email')") or die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: dealer.php");
    }

    if (isset($_GET['delete'])){
        $dealer_id = $_GET['delete'];
        $mysqli->query("DELETE FROM dealer WHERE dealer_id=$dealer_id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: dealer.php");
    }

    if (isset($_GET['edit'])){
        $dealer_id = $_GET["edit"];
        $update = true;
        $result = $mysqli->query("SELECT * FROM dealer WHERE dealer_id=$dealer_id") or die($mysqli->error());
            $row = $result->fetch_array();
            $fname = $row['f_name'];
            $mname = $row['m_name'];
            $lname = $row['l_name'];
            $hn = $row['house_no'];
            $st = $row['street'];
            $city = $row['city'];
            $country = $row['country'];
            $pn = $row['phone_no'];
            $email = $row['email'];
    }

    if (isset($_POST['update'])){
        $dealer_id = $_POST['dealer_id'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $hn = $_POST['hn'];
        $st = $_POST['st'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $pn = $_POST['pn'];
        $email = $_POST['email'];

        $mysqli->query("UPDATE dealer SET f_name='$fname', m_name='$mname', l_name='$lname', house_no='$hn', street='$st', city='$city', country='$country', phone_no='$pn', email='email' WHERE dealer_id=$dealer_id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: dealer.php");
    }

    ?>
</body>
</html>