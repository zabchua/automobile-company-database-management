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
<?php  
session_start();

 $connect = mysqli_connect("localhost", "root", "", "sza_officialdb");  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $status= mysqli_real_escape_string($connect, $_POST["status"]);  
      $branch = mysqli_real_escape_string($connect, $_POST["branch"]);  
      $dealer = mysqli_real_escape_string($connect, $_POST["dealer"]);  
      
      if($_POST["appointment_id"] != '')  
      {  
           $query = "  
           UPDATE appointment  SET 
           status='$status',   
           branch_id='$branch',   
           dealer_id='$dealer'
           WHERE appointment_no='".$_POST["appointment_id"]."'";  
        
           mysqli_query($connect, $query);
      
           
           ?>
           <script type="text/javascript">
           window.location = "appointment-admin.php";
           </script>      
               <?php
             
      } else{
        
        
        ?>
<script type="text/javascript">
window.location = "appointment-admin.php";
</script>      
    <?php 
      }
      
      
 }  
 ?>
 