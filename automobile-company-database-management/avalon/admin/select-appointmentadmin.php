  <?php  
 if(isset($_POST["appointment_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "sza_officialdb");  
      $query = "SELECT *, dealer.f_name as dfname,
                        dealer.m_name as dmname,
                        dealer.l_name as dlname,
                       users.f_name as cfname,
                        users.m_name as cmname,
                        users.l_name as clname,
                        users.phone_no as cphone_no,
                        users.email as cemail
                        
                        from appointment left join branch using(branch_id) left join users on(appointment.cust_id = users.user_id) left join dealer using(dealer_id) left join item using(serial_no)  WHERE appointment_no = '".$_POST["appointment_id"]."';
      ";
      
      //echo $query;
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '
                     <h1>Appointment No.'.$row["appointment_no"].' ('.$row["status"].')
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">'.$row["cfname"].' '.$row["cmname"].' '.$row["clname"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Date</label></td>  
                     <td width="70%">'.$row["date"].'</td>  
                </tr>  
                
                <tr>  
                     <td width="30%"><label>Model</label></td>  
                     <td width="70%">'.$row["model_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Branch</label></td>  
                     <td width="70%">'.$row["branch_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Assigned Delear</label></td>  
                     <td width="70%">';

                     if(empty($row["dealer_id"])){
                        $output .= '!--Assign dealer--! </td> ';
                    }else{
                        $output .= ''.$row["dfname"].' '.$row["dmname"].' '.$row["dlname"].''; 
                    }
                     
                $output.='
                </tr> 
                <tr>  
                <td width="30%"><label>Cust. Contact Info.</label></td>  
                <td width="70%">'.$row["cphone_no"].' <br> '.$row["cemail"].'</td>  
                </tr>  
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>