<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Add, Edit, Delete</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<body>
    <?php

    $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

    //DEFAULTS
    $update = false;

    if (isset($_POST['save'])){
        $user_id = $_POST['user_id'];
        $serial_no = $_POST['model'];
        $branch_id = $_POST['branches'];
        $date = $_POST['date'];

        $insert_date = date('Y-m-d H:i:s', strtotime($date));
                            
        $mysqli->query("INSERT INTO appointment (serial_no, date, branch_id, cust_id, status) VALUES('$serial_no', '$insert_date', '$branch_id', '$user_id', 'Processing')")  or die($mysqli->error);
        
        $_SESSION['message'] = "Appointment slot has been reserved! $query1, --$branch--";
        $_SESSION['msg_type'] = "success";

        header("location: ../customer-profile.php#appointments");
    }

    ?>
</body>
</html>