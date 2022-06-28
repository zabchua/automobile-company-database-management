<?php

//FORM PROCESSING
$email_error = $phone_error = "";
$email = $pn = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!empty($_POST["email"])) {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }
    }

    if (!empty($_POST["pn"])) {
        $pn = test_input($_POST["pn"]);
        $mobileregex = "/^[6-9][0-9]{9}$/";  
        if(!preg_match($mobileregex, $pn) === 1){
            $phone_error = "Invalid phone format";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}