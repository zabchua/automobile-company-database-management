<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Add, Edit, Delete</title>

</head>

<body>
    <?php

    $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

    //DEFAULTS
    $update = false;
    $user_id = 0;
    $fname = '';
    $mname = '';
    $lname = '';
    $hn = '';
    $st = '';
    $city = '';
    $country = '';
    $pn = '';
    $email = '';

    if (isset($_POST['update'])){
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $hn = $_POST['hn'];
        $st = $_POST['st'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $pn = $_POST['pn'];
        $email = $_POST['email'];

        $mysqli->query("UPDATE users SET f_name='$fname', m_name='$mname', l_name='$lname', house_no='$hn', street='$st', city='$city', country='$country', phone_no='$pn', email='$email' WHERE user_id=$user_id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";

        header("location: customer-profile.php");
    }

    if (isset($_GET['delete'])){
        $appointment_no = $_GET['delete'];
        $mysqli->query("DELETE FROM appointment WHERE appointment_no=$appointment_no") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: customer-profile.php#appointments");
    }

    ?>
</body>
</html>