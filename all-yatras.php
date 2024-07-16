<?php
session_start();
include ('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>Car Rental Portal</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <link href="assets/css/slick.css" rel="stylesheet">
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
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



  <!-- Resent Cat-->




  <!-- for Yatra -->
  <div class="container" style="margin-top:70px">
    <div class="section-header text-center">
      <h2>Find the Best <span>Yatra</span></h2>
      <p>Explore amazing adventures with Yatra Tourism! Whether you're into peaceful pilgrimages or exciting trips,
        we've got something for everyone. Dive into different cultures, visit historical spots, and enjoy stunning
        views. Let us show you hidden gems and make memories that will stick with you. Begin your journey with Yatra
        Tourism now</p>
    </div>

    <br>
    <br>


    <h5 style="color: red;">Explore Yatra / Tourism Places</h5>
    <select name="tourism_places">
      <option>Find Places</option>
      <h3>Find Places Hare</h3>
      </o>
      <option value="#">Tirupati - Balagi</option>
      <option value="#">Rishikesh</option>
      <option value="#">Kanyakumari</option>
      <option value="#">Agra - Taj Mahal</option>
      <option value="#">Jaipur - Hawa Mahal</option>
      <option value="#">Goa</option>

    </select>

    <style>
      select {

        background-color: whitesmoke;
      }

      option {
        background-color: palegreen;
      }
    </style>




    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <div class="row">

      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New Yatra</a></li>
        </ul>
      </div>
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">



          <?php $sql = "SELECT * FROM tbl_yatra ";
          $query = $dbh->prepare($sql);
          $query->execute();

          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $result) {
              ?>

              <div class="col-list-3" style="margin-bottom: 70px;">
                <div class="recent-car-list">
                  <div class="car-info-box">
                    <a href="yatra_details.php?y_id=<?php echo htmlentities($result->yatra_id); ?>">
                      <img src="admin/<?php echo htmlentities($result->image_1); ?>" class="img-responsive" alt="image">
                      <!-- <img src="<?php echo htmlentities($result->image_1); ?>" class="img-responsive" alt="image" /> -->
                    </a>
                    <ul>
                      <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->yatra_name); ?></li>
                      <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->package); ?>
                      </li>
                      <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->people_count); ?>
                        seats</li>

                    </ul>
                  </div>
                  <div class="car-title-m">
                    <h6><a href="yatra-details.php?y_id=<?php echo htmlentities($result->yatra_id); ?>">
                        <?php echo htmlentities($result->yatra_name); ?></a></h6>

                  </div>

                </div>
              </div>

            <?php }
          } ?>

        </div>
      </div>
    </div>


    <!-- /Resent Cat -->


  </div>


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
  <!--/Forgot-password-Form -->

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <!--Switcher-->
  <script src="assets/switcher/js/switcher.js"></script>
  <!--bootstrap-slider-JS-->
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <!--Slider-JS-->
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>