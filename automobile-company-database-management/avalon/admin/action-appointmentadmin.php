<?php
// Include the database connection file
$con=mysqli_connect("localhost","root","","sza_officialdb");


 
if (isset($_POST['branchId']) && !empty($_POST['branchId'])) {
 

 $query = "SELECT * FROM works_at left join branch using(branch_id) left join dealer using(dealer_id) WHERE branch_id = ".$_POST['branchId'];


 $result = $con->query($query);
 
 if ($result->num_rows > 0) {
 echo '<option value="">Select Dealer</option>';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row['dealer_id'].'">'.$row['f_name'].' '.$row['l_name']. '</option>';
 }
 } else {
 echo '<option value="">No dealer available</option>';
 }

}else{
    $query = "SELECT * FROM works_at left join branch using(branch_id) left join dealer using(dealer_id)";


    $result = $con->query($query);
    
    if ($result->num_rows > 0) {
    echo '<option value="">Select Car Model</option>';
    while ($row = $result->fetch_assoc()) {
    echo '<option value="'.$row['dealer_id'].'">'.$row['f_name'].' '.$row['l_name']. '</option>';
    }
    } else {
    echo '<option value="">No dealer available</option>';
    }

}
?>