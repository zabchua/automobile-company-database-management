
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Appointment List</title>  
           <link rel="stylesheet" href="style.css">
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
         
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
           <script src="sweetalert2.all.min.js"></script>
           
           
      </head>  
      <body>  

      <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="./index.php">Customers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./user_role.php">User Role</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./dealer.php">Dealers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./supplier.php">Suppliers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-warning" href="./item.php">Items</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted" href="./branch.php">Branches</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted" href="./brand.php">Brands</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted" href="./vehicle_type.php">Vehicle Types</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#">Appointments</a>
    </li> 
    <li class="nav-item">
        <a class="nav-link" href="./provides.php">Supply Drop</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./stocks.php">Stocks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./works_at.php">Employees</a>
    </li>
    
    </ul>
    <?php require_once 'process-appointmentadmin.php'; ?>

    <?php

    if (isset($_SESSION['message'])): ?>
        <div style="z-index: 100; width: 100%" class="position-absolute alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <div class="container">
    <div style="padding-top: 3em;">
        <a class="btn btn-dark"  button type="button" href="../foradmin.php" role="button">Go back to homepage</a>
       
    </div>
           <div class="mx-auto" style="width: 99%; padding-top: 3em; padding-bottom: 5em;">
                <h3 align="center">Appointment List</h3> 
                <form action="" method="GET">
                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                <input type = "text" name = "search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder = "search for data" class=" float-end"> 
               </form>
                <div class="table-responsive">  
                     
                     <div id="appointment_table">  
                          <table class="table">  
                               <thead>
                                    <tr>  
                                    <th>Appointment No.</th> 
                                    <th>Name</th>  
                                    <th>Status</th>  
                                    <th>Branch</th>
                                    <th>Model</th>
                                    <th>Dealer</th>     
                                    <th>Edit</th>  
                                    <th>View</th>  
                                    <th>delete</th>  
                               </tr> 
                              
                              </thead>
                              
                               <?php  
                                    $connect = mysqli_connect("localhost", "root", "", "sza_officialdb");
                                    if(!$connect) die(mysqli_error($connect));
                                   if(isset($_GET['search']))
                                   { 
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT *, dealer.f_name as dfname,
                                        dealer.m_name as dmname,
                                        dealer.l_name as dlname,
                                        users.f_name as cfname,
                                        users.m_name as cmname,
                                        users.l_name as clname
                         from appointment left join branch using(branch_id) left join users on(appointment.cust_id = users.user_id) left join dealer using(dealer_id) left join item using(serial_no)
                         WHERE  users.f_name LIKE '$filtervalues%' 
                              or users.l_name LIKE '$filtervalues%' 
                              or dealer.f_name LIKE '$filtervalues%' 
                              or dealer.l_name LIKE '$filtervalues%' 
                              or branch.branch_name LIKE '$filtervalues%' 
                              or status LIKE '$filtervalues%'  or appointment_no LIKE '$filtervalues%'
                                ORDER BY cust_id DESC";

                                   }else{

                                        
                                        $query = "SELECT *, dealer.f_name as dfname,
                                        dealer.m_name as dmname,
                                        dealer.l_name as dlname,
                                        users.f_name as cfname,
                                        users.m_name as cmname,
                                        users.l_name as clname
                                        from appointment left join branch using(branch_id) left join users on(appointment.cust_id = users.user_id) left join dealer using(dealer_id) left join item using(serial_no)  ORDER BY user_id DESC";
                                   }
                                  
                                   

                                   $result = mysqli_query($connect, $query);  
                              if(mysqli_num_rows($result) > 0){
                                   while($row = mysqli_fetch_array($result))  
                                   {  
                                       ?>  
                                       <tr>  
                                        
                                        <td><?php echo $row["appointment_no"]; ?></td>
                                        
                                        <td><?php echo $row["cfname"]; echo " "; echo $row["clname"]; ?></td> 
                                        <td><?php echo $row["status"]; ?></td> 
                                        <td><?php echo $row["branch_name"]; ?></td> 
                                        <td><?php echo $row["model_name"]; ?></td> 
                                        <td><?php 
                                        if(empty($row["dealer_id"])){
                                            echo '!--Assign dealer--!';
                                        }else{
                                            echo $row["dfname"]; echo " "; echo $row["dlname"]; 
                                        }
                                       
                                        
                                        ?></td> 
                                        
                                        <td><input type="button" name="edit" value="Edit" id="<?php echo $row["appointment_no"]; ?>" class="btn btn-info btn-xs edit_data" /></td>  
                                        <td><input type="button" name="view" value="view" id="<?php echo $row["appointment_no"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                                        <td><button onclick="check(<?php echo $row['appointment_no']; ?>)" type="button" class="btn btn-xs btn-danger">Delete</button>
    
                                            <script>
                                            function check(e){
                                            const swalWithBootstrapButtons = Swal.mixin({
                                            customClass: {
                                                 confirmButton: 'btn btn-success',
                                                 cancelButton: 'btn btn-danger'
                                            },
                                            buttonsStyling: false
                                            })
    
                                            swalWithBootstrapButtons.fire({
                                            title: 'Are you sure?',
                                            text: "You won't be able to revert this!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Yes, delete it!',
                                            cancelButtonText: 'No, cancel!',
                                            reverseButtons: true
                                            }).then((result) => {
                                            if (result.isConfirmed) {
                                                 document.location.href = "process-appointmentadmin.php?delete=" + e;
                                            } else if (
                                                 /* Read more about handling dismissals below */
                                                 result.dismiss === Swal.DismissReason.cancel
                                            ) {
                                                 swalWithBootstrapButtons.fire(
                                                 'Cancelled',
                                                 'Record not deleted :)',
                                                 'error'
                                                 )
                                            }
                                            })
                                            }
                                            </script></td>  
                                            </tr>  
                                       
                                            <?php  
                                  } 
                               } else{ echo "No results";} 
                              
                               ?> 
                                
                          </table>  
                     </div>  
                </div>  
           </div>  
      </body>  
 </html>  
 <div id="dataModal" class="modal fade">  
      
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header" >  
                     <h4 class="modal-title" style="color:black">Customer Appointment Details  </h4>
                     <button type="button" class="btn btn-default" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="appointment_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal"  >Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header"> 
                     
                     <h4 class="modal-title"  style="color:black" >Edit Customer Appointment Details</h4>  
                     <button type="button" class="btn btn-default" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                        

                          <label>Status</label>  <br>
                          <input type="radio" id="processing" name="status" value="Processing"><label>Processing</label>
                          <input type="radio" id="scheduled" name="status" value="Scheduled"><label>Scheduled</label>
                          <input type="radio" id="finished" name="status" value="Finished"><label>Finished</label><br>
                          <br/> 

                          
                            <!-- Branch dropdown -->
                            <label>Branch</label>
                            <select name = "branch" class="form-control" id="branch">
                            <option value="">Select Branch</option>
                            <?php
                            $query = "SELECT * FROM branch";
                            $result = $connect->query($query);
                            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['branch_id'].'">'.$row['branch_name'].'</option>';
                            }
                            }else{
                            echo '<option value="">Country not available</option>';
                            }
                            ?>
                            </select>
                                    <br />
                            
                            <!-- dealer dropdown -->
                            <label>Dealer</label>
                            <select name = "dealer" class="form-control" id="dealer" >
                            <?php
                            $query = "SELECT * FROM dealer";
                            $result = $connect->query($query);
                            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['dealer_id'].'">'.$row['f_name'].' '.$row['l_name'].'</option>';
                            }
                            }else{
                            echo '<option value="">Country not available</option>';
                            }
                            ?>
                            </select>
                                    <br />

 





                     
                          
                          <br/> 
                          <br/> 
                          <input type="hidden" name="appointment_id" id="appointment_id" />  
                          <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 
 
 
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Update");  
           $('#insert_form')[0].reset();  
      });  
      


     
        
 
        // Close modal on button click
        $(".btn").click(function(){
            $("#dataModal").modal('hide');
        });
        // Close modal on button click
        $(".btn").click(function(){
            $("#add_data_Modal").modal('hide');
        });
  
      $(document).on('click', '.edit_data', function(){  
           var appointment_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch-appointmentadmin.php",  
                method:"POST",  
                data:{appointment_id:appointment_id},  
                dataType:"json",  
                success:function(data){  
                     $('#status').val(data.status);
                     $('#branch').val(data.branch_id);
                     $('#dealer').val(data.dealer_id);
                     $('#appointment_id').val(data.appointment_no); 
                     if (data.status == "Finished"){
                    $("input:radio[value='Finished']").prop('checked',true);
                         }
                         else if(data.status == "Scheduled"){
                              $("input:radio[value='Scheduled']").prop('checked',true);
                         }
                         
                         else{
                    $("input:radio[value='Processing']").prop('checked',true);
                        }
                        

                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           
           if($('#dealer').val() == "")  
           {  
                alert("Please select a dealer");  
           }    
           else  
           {  
                $.ajax({  
                     url:"insert-appointmentadmin.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#appointment_table').html(data);
                          
                     }  
                });  
            }
      });  
      $(document).on('click', '.view_data', function(){  
           var appointment_id = $(this).attr("id");  
           if(appointment_id != '')  
           {  
                $.ajax({  
                     url:"select-appointmentadmin.php",  
                     method:"POST",  
                     data:{appointment_id:appointment_id},  
                     success:function(data){  
                          $('#appointment_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
  // Country dependent ajax
  $("#branch").on("change",function(){
      var branchId = $(this).val();
      var DealerId = $(this).val();
      $.ajax({
        url :"action-appointmentadmin.php",
        type:"POST",
        cache:false,
        data:{branchId:branchId},
        success:function(data){
          $("#dealer").html(data);
         
        }
      });

     
    });
    
    });  


 </script>
 