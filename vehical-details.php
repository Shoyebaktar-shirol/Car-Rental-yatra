<?php
session_start();
include ('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
  // Retrieve form data
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];
  $message = $_POST['message'];
  $useremail = $_SESSION['login'];
  $status = 0;
  $vhid = $_GET['vhid'];
  $bookingno = mt_rand(100000000, 999999999);
  $fromsource = $_POST['fromsource']; // Retrieve from source
  $destination = $_POST['destination']; // Retrieve destination
  $distance = $_POST['distance']; // Retrieve distance
  $price = $_POST['price']; // Retrieve price
  $total = $_POST['total']; // Retrieve total

  // Check for overlapping bookings
  // ...

  // If no overlapping bookings, proceed with insertion
  // Prepare and execute INSERT query
  $sql = "INSERT INTO tblbooking (BookingNumber, userEmail, VehicleId, FromDate, ToDate, message, Status, From_source, Destination, Distance, Price,total) 
          VALUES (:bookingno, :useremail, :vhid, :fromdate, :todate, :message, :status, :fromsource, :destination, :distance, :price,:total)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
  $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
  $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
  $query->bindParam(':todate', $todate, PDO::PARAM_STR);
  $query->bindParam(':message', $message, PDO::PARAM_STR);
  $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
  $query->bindParam(':status', $status, PDO::PARAM_STR);
  $query->bindParam(':fromsource', $fromsource, PDO::PARAM_STR);
  $query->bindParam(':destination', $destination, PDO::PARAM_STR);
  $query->bindParam(':distance', $distance, PDO::PARAM_STR);
  $query->bindParam(':price', $price, PDO::PARAM_STR);
  $query->bindParam(':total', $total, PDO::PARAM_STR);
  $query->execute();

  // Check if insertion was successful
  if ($query->rowCount() > 0) {
    echo "<script>alert('Booking successful.');</script>";
    echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
  } else {
    echo "<script>alert('Something went wrong. Please try again');</script>";
    echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
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
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
    data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>

  <!-- Start Switcher -->
  <?php include ('includes/colorswitcher.php'); ?>
  <!-- /Switcher -->

  <!--Header-->
  <?php include ('includes/header.php'); ?>
  <!-- /Header -->

  <!--Listing-Image-Slider-->

  <?php
  $vhid = intval($_GET['vhid']);
  $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      $_SESSION['brndid'] = $result->bid;
      ?>

      <section id="listing_img_slider">
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4); ?>" class="img-responsive"
            alt="image" width="900" height="560"></div>
        <?php if ($result->Vimage5 == "") {
        } else {
          ?>
          <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5); ?>" class="img-responsive"
              alt="image" width="900" height="560"></div>
        <?php } ?>
      </section>
      <!--/Listing-Image-Slider-->


      <!--Listing-detail-->
      <section class="listing-detail">
        <div class="container">
          <div class="listing_detail_head row">
            <div class="col-md-9">
              <h2><?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->VehiclesTitle); ?></h2>
            </div>
            <!-- <div class="col-md-3">
              <div class="price_info">
                <p>INR<?php echo htmlentities($result->PricePerKM); ?> </p>Per Km

              </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-md-9">
              <div class="main_features">
                <ul>

                  <li> <i class="fa fa-calendar" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->ModelYear); ?></h5>
                    <p>Reg.Year</p>
                  </li>
                  <li> <i class="fa fa-cogs" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->FuelType); ?></h5>
                    <p>Fuel Type</p>
                  </li>

                  <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->SeatingCapacity); ?></h5>
                    <p>Seats</p>
                  </li>
                </ul>
              </div>
              <div class="listing_more_info">
                <div class="listing_detail_wrap">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs gray-bg" role="tablist">
                    <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview"
                        role="tab" data-toggle="tab">Vehicle Overview </a></li>

                    <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab"
                        data-toggle="tab">Accessories</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- vehicle-overview -->
                    <div role="tabpanel" class="tab-pane active" id="vehicle-overview">

                      <p><?php echo htmlentities($result->VehiclesOverview); ?></p>
                    </div>


                    <!-- Accessories -->
                    <div role="tabpanel" class="tab-pane" id="accessories">
                      <!--Accessories-->
                      <table>
                        <thead>
                          <tr>
                            <th colspan="2">Accessories</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Air Conditioner</td>
                            <?php if ($result->AirConditioner == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>AntiLock Braking System</td>
                            <?php if ($result->AntiLockBrakingSystem == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>Power Steering</td>
                            <?php if ($result->PowerSteering == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>


                          <tr>

                            <td>Power Windows</td>

                            <?php if ($result->PowerWindows == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>CD Player</td>
                            <?php if ($result->CDPlayer == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>Leather Seats</td>
                            <?php if ($result->LeatherSeats == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>Central Locking</td>
                            <?php if ($result->CentralLocking == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>Power Door Locks</td>
                            <?php if ($result->PowerDoorLocks == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Brake Assist</td>
                            <?php if ($result->BrakeAssist == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>Driver Airbag</td>
                            <?php if ($result->DriverAirbag == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>Passenger Airbag</td>
                            <?php if ($result->PassengerAirbag == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>Crash Sensor</td>
                            <?php if ($result->CrashSensor == 1) {
                              ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            <?php }
  } ?>

        </div>

        <!--Side-Bar-->
        <aside class="col-md-3">

          <div class="share_vehicle">
            <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i
                  class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square"
                  aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square"
                  aria-hidden="true"></i></a> </p>
          </div>
          <div class="sidebar_widget">
            <div class="widget_heading">
              <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
            </div>


            <form method="post">
              <div class="form-group">
                <label>From Date:</label>
                <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
              </div>

              <div class="form-group">
                <label>To Date:</label>
                <input type="date" class="form-control" name="todate" placeholder="To Date" required>
              </div>

              <div class="form-group">
                <label>Message:</label>
                <textarea rows="3" class="form-control" name="message" placeholder="Message" required></textarea>
              </div>

              <!-- <div class="form-group">
                    <label>From source:</label>
                    <input type="text" rows="1" class="form-control" name="fromsource" placeholder="Enter Source" required></input>
                  </div>


                  <div class="form-group">
                    <label>Destination:</label>
                    <input type="text" rows="1" class="form-control" name="destination" placeholder="Enter destination" required> </input>
                  </div> -->

              <div class="form-group">
                <label>Distance:</label>

                <select name="distance" id="distance" class="form-control" onchange="calculateTotal()">
                  <option value="100 KM"> Less than 100 KM</option>
                  <option value="200 KM"> Less than 200 KM</option>
                  <option value="300 KM"> Less than 300 KM</option>
                  <option value="400 KM"> Less than 400 KM</option>
                  <option value="500 KM"> Less than 500 KM</option>
                  <option value="600 KM"> Less than 600 KM</option>
                  <option value="700 KM"> Less than 700 KM</option>
                  <option value="800 KM"> Less than 800 KM</option>
                  <option value="900 KM"> Less than 900 KM</option>
                  <option value="1000 KM"> Less than 1000 KM</option>
                  <option value="1200 KM"> Less than 1200 KM</option>
                  <option value="1400 KM"> Less than 1400 KM</option>
                  <option value="1600 KM"> Less than 1600 KM</option>
                  <option value="1800 KM"> Less than 1800 KM</option>
                  <option value="2000 KM"> Less than 2000 KM</option>
                  <option value="2500 KM"> Less than KM</option>
                  <option value="3000 KM"> Less than 3000 KM</option>
                </select>

              </div>

              <div class="form-group">
                <label>Price per KM:</label>
                <input type="text" rows="1" class="form-control" id="priceperkm" name="price" disabled
                  placeholder="  <?php echo htmlentities($ppKMs = $result->PricePerKM); ?>"> <?php ($ppKMs); ?> </input>
              </div>

              <div class="form-group">
                <label>Approximate total:</label>
                <input type="text" rows="1" class="form-control" name="total" id="approxtot"
                  placeholder="<?php echo htmlentities($gtotal = $tdistance * $ppKMs); ?>"> <?php ($gtotal); ?> </input>
              </div>


              <div class="form-group">
                <label>total:</label>
                <input type="text" rows="1" class="form-control" name="total" disabled
                  placeholder="<?php echo htmlentities($gtotal = $tdistance * $ppKMs); ?>"> <?php ($gtotal); ?> </input>
              </div>

              <?php if ($_SESSION['login']) { ?>
                <div class="form-group">
                  <input type="submit" class="btn" name="submit" value="Book Now">
                </div>






              <?php } else { ?>
                <!-- The modal -->
                <div class="modal" id="terms-modal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">


                      </div>
                      <div class="modal-footer">


                      </div>
                    </div>
                  </div>
                </div>




                <form action="upload.php" method="post" enctype="multipart/form-data">
                  <label for="pan-card">Upload PAN Card:*</label><br>
                  <input type="file" id="pan-card" name="pan_card" accept=".pdf,.jpg,.jpeg" required /><br>

                  <label for="driving-license">Upload Driving License: *</label>
                  <input type="file" id="driving-license" name="driving_license" accept=".pdf,.jpg,.jpeg"
                    required /><br />
                </form>


                <label for="terms-checkbox">
                  I agree to the <a href="terms-conditions.html" target="_blank">Terms and Conditions</a>
                </label>


                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For
                  Book</a>
                <br>
                <label>

                </label>
            </div>


          <?php } ?>
          </form>
      </div>
      </aside>
      <!--/Side-Bar-->
    </div>

    <div class="space-20"></div>
    <div class="divider"></div>

    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">
        <?php
        $bid = $_SESSION['brndid'];
        $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerKM,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:bid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bid', $bid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $result) { ?>
            <div class="col-md-3 grid_listing">
              <div class="product-listing-m gray-bg">
                <div class="product-listing-img"> <a
                    href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                      src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive"
                      alt="image" /> </a>
                </div>
                <div class="product-listing-content">
                  <h5><a
                      href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BrandName); ?>
                      , <?php echo htmlentities($result->VehiclesTitle); ?></a></h5>
                  <p class="list-price"> INR <?php echo htmlentities($result->PricePerKM); ?></p>

                  <ul class="features_list">

                    <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?>
                      seats</li>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?>
                      model</li>
                    <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?></li>
                  </ul>
                </div>
              </div>
            </div>
          <?php }
        } ?>

      </div>
    </div>
    <!--/Similar-Cars-->

    </div>
  </section>
  <!--/Listing-detail-->

  <!--Footer -->
  <?php include ('includes/footer.php'); ?>
  <!-- /Footer-->

  <!--Back to top-->
  <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  <!--/Back to top-->

  <!--Login-Form -->
  <?php include ('includes/login.php'); ?>
  <!--/Login-Form -->

  <!--Register-Form -->
  <?php include ('includes/registration.php'); ?>

  <!--/Register-Form -->

  <!--Forgot-password-Form -->
  <?php include ('includes/forgotpassword.php'); ?>



  <script>

    function calculateTotal() {
      // Get the selected distance
      var distance = parseInt(document.getElementById("distance").value);

      // Get the price per kilometer from the database (assuming you have retrieved it and stored it in a variable)
      var pricePerKM = <?php echo htmlentities($ppKMs); ?>;
      // Calculate the approximate total
      var total = distance * pricePerKM;

      // Update the value of the approximate total input field
      document.getElementById("approxtot").value = total;
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