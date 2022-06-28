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

 
    

    if (isset($_POST['save'])){
        $dealer_id = $_POST['dealer_id'];
        $branch_id = $_POST['branch_id'];

        $mysqli->query("INSERT INTO works_at (dealer_id, branch_id) VALUES('$dealer_id', '$branch_id')") or die($mysqli->error);
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: works_at.php");
    }

    if (isset($_GET['delete'])){
        $dealer_id = $_GET['delete'];

        $mysqli->query("DELETE FROM works_at WHERE dealer_id=$dealer_id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: works_at.php");
    }

    if (isset($_GET['edit'])){
        $dealer_id = $_GET['edit'];
        $update = true;
        
        $result = $mysqli->query("SELECT
                                    works_at.dealer_id,
                                    dealer.f_name,
                                    dealer.m_name,
                                    dealer.l_name,
                                    branch.branch_name
                                FROM dealer
                                JOIN works_at
                                    ON dealer.dealer_id=works_at.dealer_id
                                JOIN branch
                                    ON branch.branch_id=works_at.branch_id
                                WHERE works_at.dealer_id=$dealer_id ") or die($mysqli->error);
            $row = $result->fetch_array();
            $dealer_id = $row['dealer_id'];
            $f_name = $row['f_name'];
            $m_name = $row['m_name'];
            $l_name = $row['l_name'];
            $branch_name = $row['branch_name'];
    }

    if (isset($_POST['update'])){
        $dealer_ids = $_POST['dealer_id_up'];
        $branch_ids = $_POST['branch_id_up'];

        $mysqli->query("UPDATE works_at SET branch_id='$branch_ids' WHERE dealer_id=$dealer_ids") or die($mysqli->error);
echo "UPDATE works_at SET branch_id='$branch_ids' WHERE dealer_id=$dealer_ids";
        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";
        header("location: works_at.php");
    }

    ?>
</body>
</html>