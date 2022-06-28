<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(function(){
            $("#ddlselect").change(function(){
                var displaycourse=$("#ddlselect option:selected").text();
                $("#txtresults").val(displaycourse);
            })
        })
    </script>
</head>
<body>

    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

    $result = $mysqli->query("SELECT company_name FROM supplier") or die($mysqli->error);

    ?>

    <select name="company_name" id="ddlselect">
        <?php
        while($rows = $result->fetch_assoc()){
            $company_name = $rows['company_name'];
            echo "<option value='$company_name'>$company_name</option>";
        }
        ?>
    </select>
    <input type="text" readonly="readonly" id="txtresults"/>
</body>
</html>

