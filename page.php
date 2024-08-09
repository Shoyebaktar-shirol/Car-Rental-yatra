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



  <!-- Start Switcher -->
  <?php include ('includes/colorswitcher.php'); ?>
  <!-- /Switcher -->

  <!--Header-->
  <?php include ('includes/header.php'); ?>
  <?php
  $pagetype = $_GET['type'];
  $sql = "SELECT type, detail, PageName FROM tblpages WHERE type=:pagetype";
  $query = $dbh->prepare($sql);
  $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
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



      <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental FAQ</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Set a comfortable font and color */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }

        /* Container styling */
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header styling */
        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2em;
            color: #333;
        }

        /* FAQ section styling */
        .faq {
            margin-top: 20px;
        }

        .faq-item {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            font-size: 1.2em;
            color: #007bff;
        }

        .faq-answer {
            margin-top: 10px;
            font-size: 1em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Frequently Asked Questions</h1>
        </header>

        <section class="faq">
            <div class="faq-item">
                <h2 class="faq-question">1. What documents do I need to rent a car?</h2>
                <p class="faq-answer">To rent a car, you will need a valid driver's license, a credit card in your name, and proof of insurance. An international driver's permit is required for non-residents.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">2. What is the minimum age requirement to rent a car?</h2>
                <p class="faq-answer">The minimum age requirement to rent a car is typically 21 years old. Drivers under 25 may incur a young driver surcharge.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">3. Can I extend my rental period?</h2>
                <p class="faq-answer">Yes, you can extend your rental period. Contact our customer service as soon as possible to arrange for an extension and ensure vehicle availability.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">4. What happens if I return the car late?</h2>
                <p class="faq-answer">Returning the car late may incur additional charges. A late fee is typically applied for each hour or day past the agreed return time.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">5. Are there any mileage limits?</h2>
                <p class="faq-answer">Most rentals include a mileage limit. Excess mileage may incur additional charges. Check the rental agreement for specifics regarding mileage limits.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">6. Can I drive the rental car out of state or country?</h2>
                <p class="faq-answer">Yes, but you must inform us in advance. There may be restrictions and additional fees for driving the car out of state or country.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">7. What should I do if the car breaks down?</h2>
                <p class="faq-answer">If the car breaks down, contact our roadside assistance service immediately. We will guide you through the necessary steps to resolve the issue.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">8. Can I add an additional driver?</h2>
                <p class="faq-answer">Yes, you can add an additional driver to the rental agreement. There may be an additional fee, and the additional driver must meet the rental requirements.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">9. What is the fuel policy?</h2>
                <p class="faq-answer">Our standard fuel policy is "full to full." This means you should return the car with a full tank of gas to avoid additional fuel charges.</p>
            </div>

            <div class="faq-item">
                <h2 class="faq-question">10. How do I make a reservation?</h2>
                <p class="faq-answer">You can make a reservation online through our website, by phone, or in person at our rental office. Ensure to have your rental dates, vehicle preference, and payment information ready.</p>
            </div>
        </section>
    </div>
</body>
</html>

      
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

</html>
