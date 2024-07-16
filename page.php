<?php
session_start();
error_reporting(0);
include ('includes/config.php');
?>

<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>Car Rental Portal | Page Details</title>
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

  <!-- Fav and touch icons -->
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
  <<!-- Start Switcher -->
    <?php include ('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include ('includes/header.php'); ?>
    <?php
    $pagetype = $_GET['type'];
    $sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
      foreach ($results as $result) { ?>
        <section class="page-header aboutus_page">
          <div class="container">
            <div class="page-header_wrap">
              <div class="page-heading">
                <h1><?php echo htmlentities($result->PageName); ?></h1>
              </div>
              <ul class="coustom-breadcrumb">
                <li><a href="#">Home Page</a></li>




                <li><?php echo htmlentities($result->PageName); ?></li>
              </ul>
            </div>
          </div>
          <!-- Dark Overlay-->
          <div class="dark-overlay"></div>
        </section>
        <section class="about_us section-padding">
          <div class="container">
            <div class="section-header text-center">


              <h2><?php echo htmlentities($result->PageName); ?></h2>
              <p><?php echo $result->detail; ?> </p>
            </div>
          <?php }
    } ?>
      </div>
    </section>
    <!-- /About-us-->


    <h1>Frequently Asked Questions</h1>

    <h2>General Questions</h2>
    <ul>
      <li>
        <h3>How do I make a reservation?</h3>
        <p>To make a reservation, you can either book online through our website or contact our customer service
          hotline.</p>
      </li>
      <li>
        <h3>What documents do I need to rent a car?</h3>
        <p>You will typically need a valid driver's license, a credit card, and proof of insurance. Additional
          requirements may vary depending on your location and the type of car you're renting.</p>
      </li>
      <li>
        <h3>What is the minimum age requirement to rent a car?</h3>
        <p>The minimum age requirement to rent a car is usually 21 years old, but it may vary by location and car rental
          company. Some companies may also impose additional fees for renters under 25.</p>
      </li>
    </ul>

    <h2>Booking and Payment</h2>
    <ul>
      <li>
        <h3>Can I modify or cancel my reservation?</h3>
        <p>Yes, you can usually modify or cancel your reservation, although there may be fees involved depending on when
          you make changes and the terms of your booking.</p>
      </li>
      <li>
        <h3>What forms of payment do you accept?</h3>
        <p>We typically accept major credit cards, debit cards, and sometimes cash. However, specific payment methods
          may vary depending on the location and rental company.</p>
      </li>
      <li>
        <h3>Do I need to pay a security deposit?</h3>
        <p>Yes, most car rental companies require a security deposit at the time of pickup. The amount may vary
          depending on factors such as the type of car and your rental history.</p>
      </li>
    </ul>

    <h2>Vehicle Policies</h2>
    <ul>
      <li>
        <h3>Can I drive the rental car across state lines or to another country?</h3>
        <p>Driving restrictions vary by rental company and location. Some companies may allow cross-border travel with
          prior authorization and additional fees, while others may restrict it entirely. It's important to check the
          rental agreement and policies beforehand.</p>
      </li>
      <li>
        <h3>What happens if I return the car late?</h3>
        <p>Most car rental companies have a grace period for late returns, after which you may be charged an additional
          fee. If you anticipate being late, it's best to contact the rental company as soon as possible to avoid any
          penalties.</p>
      </li>
      <li>
        <h3>Am I allowed to smoke or bring pets in the rental car?</h3>
        <p>Smoking and pet policies vary by rental company, but many have strict no-smoking and no-pet policies due to
          cleanliness and allergy concerns. Violating these policies may result in additional cleaning fees.</p>
      </li>
    </ul>


    <<!--Footer -->
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

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:26:12 GMT -->

</html>