<?php
include('includes/config.php');

// Check if yatra_id is provided
if (isset($_GET['yatra_id'])) {
    $yatra_id = intval($_GET['yatra_id']);

    // Fetch yatra details from the database
    $sql = "SELECT * FROM tbl_yatra WHERE yatra_id = :yatra_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':yatra_id', $yatra_id, PDO::PARAM_INT);
    $query->execute();
    $yatra = $query->fetch(PDO::FETCH_ASSOC);

    if ($yatra) {
        // Display yatra details
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Car Rental Portal | View Full Yatra Details</title>

        <!-- Font awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Sandstone Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Bootstrap Datatables -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <!-- Bootstrap social button library -->
        <link rel="stylesheet" href="css/bootstrap-social.css">
        <!-- Bootstrap select -->
        <link rel="stylesheet" href="css/bootstrap-select.css">
        <!-- Admin Stye -->
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <?php include('includes/header.php'); ?>
        <div class="ts-main-content">
            <?php include('includes/leftbar.php'); ?>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                         <h2 class="page-title">Full Yatra Details</h2> 
                            <div class="panel panel-default">
                             <div class="panel-body">
                                <h1>Yatra Details</h1>
                        <h2><?php echo htmlentities($yatra['yatra_name']); ?></h2>
                         <p>Description: <?php echo htmlentities($yatra['description']); ?></p>
                        <p>Package Details: <?php echo htmlentities($yatra['package']); ?></p>
                        <p>No. of People: <?php echo htmlentities($yatra['people_count']); ?></p>
                        <h3>Images:</h3>

                       <div class="row">
    <div class="col-md-2">
        <!-- Image 1 -->
        <img src="<?php echo htmlentities($yatra['image_1']); ?>" alt="Yatra Image 1" class="img-responsive">
        <p>Description1: <?php echo htmlentities($yatra['ImgDescription_1']); ?></p>
    </div>
    <div class="col-md-2">
        <!-- Image 2 -->
        <img src="<?php echo htmlentities($yatra['image_2']); ?>" alt="Yatra Image 2" class="img-responsive">
        <p>Description2: <?php echo htmlentities($yatra['ImgDescription_2']); ?></p>
    </div>
    <div class="col-md-2">
        <!-- Image 3 -->
        <img src="<?php echo htmlentities($yatra['image_3']); ?>" alt="Yatra Image 3" class="img-responsive">
        <p>Description3: <?php echo htmlentities($yatra['ImgDescription_3']); ?></p>
    </div>
    <div class="col-md-2">
        <!-- Image 4 -->
        <img src="<?php echo htmlentities($yatra['image_4']); ?>" alt="Yatra Image 4" class="img-responsive">
        <p>Description4: <?php echo htmlentities($yatra['ImgDescription_4']); ?></p>
    </div>
    <div class="col-md-2">
        <!-- Image 5 -->
        <img src="<?php echo htmlentities($yatra['image_5']); ?>" alt="Yatra Image 5" class="img-responsive">
        <p>Description5: <?php echo htmlentities($yatra['ImgDescription_5']); ?></p>
    </div>
</div>

                    

                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Yatra not found.";
    }
} else {
    echo "Yatra ID not provided.";
}
?>
