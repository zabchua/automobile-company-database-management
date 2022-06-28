  <?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "sza_officialdb");  
 if(isset($_POST["appointment_id"]))  
 {  
      $query = "SELECT * FROM appointment WHERE appointment_no = '".$_POST["appointment_id"]."'";  
      
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>