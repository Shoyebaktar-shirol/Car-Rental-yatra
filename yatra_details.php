


<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
  // Retrieve form data
  $useremail = $_SESSION['login'];
  $status = 0;
  $y_id = $_GET['y_id'];
  $bookingno = mt_rand(100000000, 999999999);
  $useremail = $_SESSION['login'];
  $date = $_POST['date'];
  $package = $_POST['package'];
 
  $numberofseats = $_POST['numberofseats'];
 
  $totalprice = $_POST['totalprice'];

 
  
  // Check for overlapping bookings
  // ...

  // If no overlapping bookings, proceed with insertion
  // Prepare and execute INSERT query
  $sql = "INSERT INTO tblyatrabooking (Booking_number, UserEmail,Status ,Package,Date,Number_of_seats,Total_price,Yatraid) 
  VALUES (:bookingno, :useremail,:status,:package, :date , :numberofseats, :totalprice ,:y_id)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingno',  $bookingno , PDO::PARAM_STR);
$query->bindParam(':useremail',  $useremail , PDO::PARAM_STR);
$query->bindParam(':status' , $status, PDO::PARAM_STR);
$query->bindParam(':package', $package , PDO::PARAM_STR);
$query->bindParam(':date', $date, PDO::PARAM_STR);
$query->bindParam(':numberofseats', $numberofseats, PDO::PARAM_STR);
$query->bindParam(':totalprice',  $totalprice , PDO::PARAM_STR);
$query->bindParam(':y_id' , $y_id , PDO::PARAM_STR);


$query->execute();

// Check if insertion was success
if ($query->rowCount() > 0) {
echo "<script>alert('Booking successful.');</script>";
echo "<script type='text/javascript'> document.location = 'myyatra-booking.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";
echo "<script type='text/javascript'> document.location = 'yatra-listing.php'; </script>";
}
}


?>


<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>Car Rental | Vehicle Details</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <!--Custome Style -->
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <!--slick-slider -->
  <link href="assets/css/slick.css" rel="stylesheet">
  <!--bootstrap-slider -->
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <!--FontAwesome Font Style -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">

  <!-- SWITCHER -->
  <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>

  <!-- Start Switcher -->
  <?php include('includes/colorswitcher.php'); ?>
  <!-- /Switcher -->

  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!--Listing-Image-Slider-->

  <?php
 $yid = intval($_GET['y_id']);
 $sql = "SELECT * FROM tbl_yatra WHERE yatra_id = :yid";
 $query = $dbh->prepare($sql);
 $query->bindParam(':yid', $yid, PDO::PARAM_INT);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      $_SESSION['brndid'] = $result->bid;
  ?>


      <section id="listing_img_slider">
        <div><img src="admin/<?php echo htmlentities($result->image_1); ?>" class="img-responsive" alt="image" width="900" height="560" style="padding: 10px;">
          <p>Image-Info-1: <?php echo htmlentities($result->ImgDescription_1); ?></p></div>
        <div><img src="admin/<?php echo htmlentities($result->image_2); ?>" class="img-responsive" alt="image" width="900" height="560"  style="padding: 10px;" >
          <p>Image-Info-2: <?php echo htmlentities($result->ImgDescription_2); ?></p></div></div>
        <div><img src="admin/<?php echo htmlentities($result->image_3); ?>" class="img-responsive" alt="image" width="900" height="560"  style="padding: 10px;">
          <p>Image-Info-3: <?php echo htmlentities($result->ImgDescription_3); ?></p></div></div>
        <div><img src="admin/<?php echo htmlentities($result->image_4); ?>" class="img-responsive" alt="image" width="900" height="560"  style="padding: 10px;">
          <p>Image-Info-4: <?php echo htmlentities($result->ImgDescription_4); ?></p></div></div>
        <?php if ($result->image_5 == "") {
        } else {
        ?>
          <div><img src="admin/<?php echo htmlentities($result->image_5); ?>" class="img-responsive" alt="image" width="900" height="560"  style="padding: 10px;">
            <p>Image-Info-5: <?php echo htmlentities($result->ImgDescription_5); ?></p></div></div>
        <?php } ?>
      </section>
      <!--/Listing-Image-Slider-->


      <!--Listing-detail-->
      <section class="listing-detail">
        <div class="container">
          <div class="listing_detail_head row">
            <div class="col-md-9">
              <h2><?php echo htmlentities($result->yatra_name); ?>  </h2>
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-9">
              <div class="main_features">
                <ul>

                  <li> <i class="fa fa-inr" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->package); ?></h5>
                    <p>Package Price</p>
                  </li>
                  <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->people_count); ?></h5>
                    <p>Seats</p>
                  </li>

                  
                </ul>
              </div>
              <div class="listing_more_info">
                <div class="listing_detail_wrap">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs gray-bg" role="tablist">
                    <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Yatra Overview </a></li>

                    
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- vehicle-overview -->
                    <div role="tabpanel" class="tab-pane active" id="vehicle-overview">

                      <p><?php echo htmlentities($result->description); ?></p>
                    </div>


                  
                    
                  </div>
                </div>

              </div>


          <?php }
      } ?>

<!-- <?php $sql="SELECT * FROM tbl_yatra ";
$query = $dbh -> prepare($sql);
$query->execute();

$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>  

<div class="col-list-3">
    <div class="recent-car-list">
        <div class="car-info-box">
            <a href="yatra_details.php?y_id=<?php echo htmlentities($result->yatra_id);?>">
                <img src="admin/<?php echo htmlentities($result->image_1);?>" class="img-responsive" alt="image">
                <img src="<?php echo htmlentities($result->image_1); ?>" class="img-responsive" alt="image" 
            </a>
            <ul>
                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->yatra_name);?></li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->package);?></li>
                <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->people_count);?> seats</li>
                
            </ul>
        </div>
        <div class="car-title-m">
            <h6><a href="yatra-details.php?vhid=<?php echo htmlentities($result->yatra_id);?>"> <?php echo htmlentities($result->yatra_name);?></a></h6>
           
        </div>
        
    </div>
</div>

<?php }}?>
       
      </div>
    </div>
  </div>
</section> -->

            </div>


            <!--Side-Bar-->
            <aside class="col-md-3">

              <div class="share_vehicle">
                <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
              </div>
              <div class="sidebar_widget">
                <div class="widget_heading">
                  <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
                </div>


                <form method="post">
                  <div class="form-group">
                    <label> Date:</label>
                    <input type="date" class="form-control" name="date" placeholder="From Date" required>
                  </div>

                  <div class="form-group">
                    <label>Package</label>
                    <input type="number" class="form-control" id="package" name="package_amount"  placeholder="  <?php echo htmlentities($packagepricepp = $result->package); ?>"> <?php ($packagepricepp); ?> </input>
                  </div>
                  <!-- Hidden input field to store the package value -->
                 <input type="hidden" name="package" value="<?php echo htmlentities($packagepricepp); ?>">

                  <div class="form-group">
                    <label>Number Of Seats</label>
                    <input type="text" class="form-control" id="Number_of_seats" name="numberofseats" placeholder="Number of seats" oninput="calculateAmount()"  >
                </div>

                  

               

                <div class="form-group">
                    <label>Total Price</label>
                    <input type="text" class="form-control" id="totalprice" name="totalprice" placeholder="<?php echo htmlentities($amount = $noofSeats * $packagepricepp); ?>"> <?php ($amount); ?> </input>
                </div>
                  

                  <?php if ($_SESSION['login']) { ?>
                    <div class="form-group">
                      <input type="submit" class="btn" name="submit" value="Book Now">
                    </div>



                  <?php } else { ?>
                    <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For
                      Book</a>

                  <?php } ?>
                </form>
              </div>
            </aside>
            <!--/Side-Bar-->
          </div>

          <div class="space-20"></div>
          <div class="divider"></div>

          

        </div>
      </section>

      <!--/Listing-detail-->

      <!--Footer -->
      <?php include('includes/footer.php'); ?>
      <!-- /Footer-->

      <!--Back to top-->
      <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
      <!--/Back to top-->

      <!--Login-Form -->
      <?php include('includes/login.php'); ?>
      <!--/Login-Form -->

      <!--Register-Form -->
      <?php include('includes/registration.php'); ?>

      <!--/Register-Form -->

      <!--Forgot-password-Form -->
      <?php include('includes/forgotpassword.php'); ?>



 


<script>

function calculateAmount() {
    // Get the selected distance
    var noOfSeats = parseInt(document.getElementById("Number_of_seats").value);
    
    // Get the price per kilometer from the database (assuming you have retrieved it and stored it in a variable)
    var pricePerPerson = <?php echo htmlentities($packagepricepp); ?>;
    
    if (isNaN(noOfSeats) || noOfSeats <= 0) {
        // Set the total price to 0 if the number of seats is not provided or is invalid
        document.getElementById("totalprice").value = 0;
    } else {
        // Calculate the approximate total
        var total = noOfSeats * pricePerPerson;
        
        // Update the value of the approximate total input field
        document.getElementById("totalprice").value = total;
    }
}
</script>

      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/interface.js"></script>
      <script src="assets/switcher/js/switcher.js"></script>
      <script src="assets/js/bootstrap-slider.min.js"></script>
      <script src="assets/js/slick.min.js"></script>
      <script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>