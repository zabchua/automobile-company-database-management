<?php
  session_start();
  
  if( isset($_SESSION['userId'])) {
    require('./config/db.php');
    
    $userId = $_SESSION['userId']; // 3

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE user_id = ? ');
    $stmt -> execute([ $userId ]);

    $users = $stmt -> fetch();
  }
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>SZA Automobile Company</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="sweetalert2.all.min.js"></script>
      
      <link rel="stylesheet" href="profile-style.css">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- awesome fontfamily -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Tweaks for older IEs-->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   
   <?php require_once 'process.php'; ?>

   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width:60vw">
         <div class="modal-content">
            <div class="modal-header">
            <h1>Edit profile</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
            <div class="mx-auto" style="width: 99%;">

               <form action="process.php" method="POST">
                     <input type="hidden" name="user_id" value="<?php echo $users->user_id ?>">
                     <div class="hstack gap-3">
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">First Name</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $users->f_name ?>" placeholder="e.g. Juan Miguel" required autofocus>
                     </div>
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">Middle Name</label>
                        <input type="text" name="mname" class="form-control" value="<?php echo $users->m_name ?>" placeholder="e.g. Cirilo" required>
                     </div>
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $users->l_name ?>" placeholder="e.g. Dela Cruz" required>
                     </div>
                     </div>
                     <div class="hstack gap-2">
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">House No.</label>
                        <input type="text" name="hn" class="form-control" value="<?php echo $users->house_no ?>" placeholder="e.g. 123" required>
                     </div>
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">Street</label>
                        <input type="text" name="st" class="form-control" value="<?php echo $users->street ?>" placeholder="e.g. Ped Xing" required>
                     </div>
                     </div>
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">City</label>
                        <input type="text" name="city" class="form-control" value="<?php echo $users->city ?>" placeholder="e.g. Baguio" required pattern="[a-zA-Z]{2,}">
                     </div>
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">Country</label>
                        <input type="text" name="country" class="form-control" value="<?php echo $users->country ?>" placeholder="e.g Philippines" required pattern="[a-zA-Z]{2,}">
                     </div>
                     <div class="hstack gap-2">
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">Phone Number</label>
                        <input type="tel" name="pn" class="form-control" value="<?php echo $users->phone_no ?>" placeholder="e.g. 09123456789" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" required>
                     </div>
                     <div class="col form-group" style="padding-top: 1em">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $users->email ?>" placeholder="e.g. juan123@gmail.com" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$"  required>
                     </div>
                     </div>
                     <div class="form-group" style="padding-top: 1em">
                        <?php
                        if ($update == true):
                        ?>
                           <button type="submit" class="btn btn-info" name="update">Update</button>
                        <?php else: ?>
                           <button type="submit" class="btn btn-primary" name="update">Update</button>
                        <?php endif; ?>
                     </div>
               </form>
            </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>

   <!-- body -->
   
   <body class="main-layout">

   <div class="wrapper">

      <div class="sidebar">
         <!-- Sidebar  -->
        <nav id="sidebar">

            <div id="dismiss">
                <i class="fa fa-arrow-left"></i>
            </div>

            <ul class="list-unstyled components">
                
                <li class="active">
                    <a href="#home">Home</a>
                </li>
                <li>
                    <a href="#about">About</a>
                </li>
                <li>
                    <a href="#why_choose_us">why Choose Us</a>
                </li>
                <li>
                    <a href="#testimonial">Testimonial</a>
                </li>
                <li>
                    <a href="#contact">Contact</a>
                </li>
                <li>
                    <a href="logout.php">Log Out</a>
                </li>
            </ul>

        </nav>
      </div>


      <div id="content">
         <!-- section -->
         <section id="home" class="top_section">
            <div class="row">
               <div class="col-lg-12">
                  <!-- header -->
                  <header>
                     <!-- header inner -->
                     <div class="container">
                        <div class="row">
                           <div class="col-lg-3 logo_section">
                              <div class="full">
                                 <div class="center-desk">
                                    <div class="logo"> <a href="loggedin.php"><img src="images/logo.png" alt="#"></a> </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-9">
                              <div class="right_header_info">
                                 <ul>
                                    <li><img style="margin-right: 15px;" src="images/phone_icon.png" alt="#" /><a href="#">987-654-3210</a></li>
                                    <li><img style="margin-right: 15px;" src="images/mail_icon.png" alt="#" /><a href="./customer-profile.php"><?php echo $users->f_name ?></a></li>
                                    <li><img src="images/search_icon.png" alt="#" /></li>
                                    <li>
                                       <button type="button" id="sidebarCollapse">
                                          <img src="images/menu_icon.png" alt="#" />
                                       </button>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end header inner -->
                  </header>
      <!-- end header -->
               </div>
            </div>

         <!-- ACTUAL PROFILE PAGE -->
         <div style="margin-top: 1em" class="profile-box container dark-bg">
               <div class="profile-greeting text-center">

                  <!-- <div class="profile-picture">
                     <img src=".\images\profile-picture.png" alt="Profile Picture">
                  </div> -->

                  <h1 class="fs-1 fw-bolder" style="color: #FFA700">Hello, <?php echo $users->f_name ?>.</h1>

                  <div class="divider-line"></div>

                  <h2 class="profile-padtop">Profile Information</h2>

                  <div class="row justify-content-center">
                     <div class="col-3 text-right">
                        Name
                     </div>
                     <div class="col-3 text-left">
                        <h4><?php echo $users->f_name ?> <?php echo $users->m_name ?> <?php echo $users->l_name ?></h4>
                     </div>
                  </div>

                  <div class="row justify-content-center">
                     <div class="col-3 text-right">
                        Home Address
                     </div>
                     <div class="col-3 text-left">
                        <h4><?php echo $users->house_no ?> <?php echo $users->street ?> street, <?php echo $users->city ?>, <?php echo $users->country ?></h4>
                     </div>
                  </div>

                  <div class="row justify-content-center">
                     <div class="col-3 text-right">
                        Phone Number
                     </div>
                     <div class="col-3 text-left">
                        <h4><?php echo $users->phone_no ?></h4>
                     </div>
                  </div>

                  <div class="row justify-content-center">
                     <div class="col-3 text-right">
                        Email Address
                     </div>
                     <div class="col-3 text-left">
                        <h4><?php echo $users->email ?></h4>
                     </div>
                  </div>

                  <!-- Button trigger modal -->
                  <!-- <div class="profile-mt"></div> -->
                  <button type="button" style="margin-top: 2em; z-index: 99999999;" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Edit Profile Information
                  </button>

                  <script> 
                     var myModal = document.getElementById('myModal')
                     var myInput = document.getElementById('myInput')

                     myModal.addEventListener('shown.bs.modal', function () {
                     myInput.focus()
                     })
                  </script>

               </div>
            </div>
            
      </section>
      <!-- end section -->

      

      <!-- section -->
      <section id="contact" style="margin-top: 3em" class="dark_bg_blue layout_padding cross_layout padding_top_0">
      
      <?php
        $mysqli = new mysqli('localhost', 'root', '', 'sza') or die(mysqli_error($mysqli));

        $result = $mysqli->query("SELECT *
                                 FROM item
                                 LEFT JOIN appointment
                                    ON item.serial_no=appointment.serial_no
                                 LEFT JOIN branch
                                    ON branch.branch_id=appointment.branch_id
                                 LEFT JOIN dealer
                                    ON dealer.dealer_id=appointment.dealer_id
                                 WHERE appointment.cust_id=$users->user_id 
                                    AND appointment.status<>'Done'") or die(mysqli_error);
        //pre_r($result);
      ?>

      <div class="container">
         <h1 id="appointments" style="color: white; margin-bottom:2em" class="fs-1 fw-bolder text-center">Your Appointments</h1>

         <div class="row justify-content-center">

            <?php
            if (mysqli_num_rows($result)==0):?>
                  <p style="color: white;" class="text-center">You have no ongoing appointments at the moment.</p> 

                  <a href="./test-drive/index.php" style="margin-top:3em; width: 50%" class="btn btn-info">Set an appointment for a test drive</a>
            <?php endif;?>

            <?php while ($row = $result->fetch_assoc()): ?>

               <div class="card" style="width: 22rem; margin-right: 1rem; margin-top: 3rem; background-color: #FAFAF4">
                  <div class="card-body">
                     <?php if($row['status'] == 'Scheduled'): ?>
                        <h5 class="card-title fw-bold fs-6" style="color: #56B700"><?php echo $row['status']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">A dealer has been assigned to you and will be ready for you on the test drive date.</h6>
                        <h6 class="card-text fs-6">Your dealer is <?php echo $row['f_name']?> <?php echo $row['l_name']?></p>
                        <h6 class="card-text fs-6">You can contact them through phone: 0<?php echo $row['phone_no']?> </p>
                        <h6 class="card-text fs-6">or via email: <?php echo $row['email']?></p>

                     <?php elseif($row['status'] == 'Processing'): ?>
                        <h5 class="card-title fw-bold fs-6" style="color: #FF8639"><?php echo $row['status']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">You have reserved a slot, we will send you a confirmation email soon.</h6>

                     <?php endif;?>
                     
                     <p class="card-text" style="margin-top: 1em"><?php echo date('g:i A, l - d M Y', strtotime($row['date'])); ?></p>
                     <p class="card-text fs-6"> <?php echo $row['branch_name']?> </p>
                     <div class="divider-line"></div>

                     <p style="margin-top: 1em" class="card-text fw-bold"><?php echo $row['model_name']?> <?php echo $row['year']; ?></p>
                     <p class="card-text fs-6"> <?php echo $row['color']?> </p>
                     <p class="card-text fs-6"> <?php echo $row['seat_capacity']?> Seater</p>
                     <p class="card-text fs-6"> <?php echo $row['transmission']?> </p>
                     <p class="card-text fs-6"> <?php echo $row['speed']?> hp</p>
                     <p class="card-text fs-6"> <?php echo $row['engine']?> </p>
                     <p style="margin-bottom: 3em" class="card-text fs-6"> PHP <?php echo number_format($row['price']); ?>.00</p>

                     
                  </div>

                  <button onclick="check(<?php echo $row['appointment_no']; ?>)" type="button" style="width: 10rem" class="btn btn-danger btn-sm position-absolute top-100 start-50 translate-middle">Cancel Appointment</button>

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
                            title: 'Are you sure you want to cancel?',
                            text: "Your appointment slot might not be available again.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, cancel it!',
                            cancelButtonText: 'Nevermind!',
                            reverseButtons: true
                            }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = "process.php?delete=" + e;
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
                        </script>
               </div>

            <?php endwhile; ?>   
         </div>

      </div>

      </section>
      <!-- end section -->

      <!-- footer -->
      <footer>
         <div class="container">
           <div class="row">
              <div class="col-md-6">
                <div class="full">
                  <h3>AVALON MOTORS</h3>
                </div>
              </div>
              <div class="col-md-6">
                <div class="full">
                   <ul class="social_links">
                      <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                   </ul>
                </div>
              </div>
              <div class="col-md-4">
                 <div class="full">
                    <h4 class="widget_heading">SUBSCRIBE</h4>
                 </div>
                 <div class="full subribe_form">
                    <form>
                      <fieldset>
                         <div class="field">
                           <input type="email" name="mail" placeholder="Enter your email" />
                         </div>
                         <div class="field">
                           <button class="submit_bt">Submit</button>
                         </div>
                      </fieldset>
                    </form>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="full">
                   <h4 class="widget_heading">Usefull Links</h4>
                 </div>
                 <div class="full f_menu">
                    <ul>
                       <li><a href="#">Home</a></li>
                       <li><a href="#">About</a></li>
                       <li><a href="#">Our Cars</a></li>
                       <li><a href="#">Services</a></li>
                       <li><a href="#">Testimonial</a></li>
                    </ul>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="full">
                   <h4 class="widget_heading">Contact Details</h4>
                   <div class="full cont_footer">
                     <p><strong>AVALON Car : Adderess</strong><br><br>Newyork 10012, USA<br>Phone: +987 654 3210<br>demo@gmail.com</p>
                   </div>
                 </div>
              </div>
           </div>
         </div>
      </footer>
      <!-- end footer -->

      <!-- copyright -->

      <div class="cpy_right">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                     <div class="full">
                        <p>© 2019 All Rights Reserved. Design by <a href="https://html.design">Free Html Templates</a></p>
                     </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- right copyright -->

   </div>
</div>

   <div class="overlay"></div>
      
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- Scrollbar Js Files -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
      </script>
    
      <script>
      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: 40.645037, lng: -73.880224},
          });

        var image = 'images/location_point.png';
          var beachMarker = new google.maps.Marker({
             position: {lat: 40.645037, lng: -73.880224},
             map: map,
             icon: image
          });
        }
        </script>
        <!-- google map js -->
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
        <!-- end google map js -->

        <!-- <body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
 
<script type="text/javascript">
 
var timer = setInterval(function(){ auto_logout() }, 9000);
 
  
function reset_interval(){
 
    clearInterval(timer);
  
    timer = setInterval(function(){ auto_logout() }, 9000);
 
}
 
function auto_logout(){
    
        alert("Session expired. To continue please login again.")

        window.location="logout.php";
 
} -->
 
</script>
   </body>
</html>