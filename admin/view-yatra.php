<?php
include('includes/config.php');
session_start();
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_REQUEST['del'])) {
        $delid = intval($_GET['del']);
        $sql = "delete from tbl_yatra  WHERE  yatra_id=:delid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':delid', $delid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Yatra record deleted successfully";
    }
?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Car Rental Portal | View Yatras</title>

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
                            <h2 class="page-title">View Yatras</h2>
                            <div class="panel panel-default">
                                <div class="panel-heading">List of Yatras</div>
                                <div class="panel-body">
                                    <table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Yatra Name</th>
                                                <th>Description</th>
                                                <th>Package Details</th>
                                                <th>No. of People</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tbl_yatra";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($result->yatra_name); ?></td>
                                                        <td><?php echo htmlentities($result->description); ?></td>
                                                        <td><?php echo htmlentities($result->package); ?></td>
                                                        <td><?php echo htmlentities($result->people_count); ?></td>
                                                        <!-- Display only one image -->
                                                        <td><img src="<?php echo htmlentities($result->image_1); ?>" style="width:100px;height:100px;" /></td>
                                                        <td>
                                                            <!-- Add view link -->
                                                            <a href="view_full_yatra_details.php?yatra_id=<?php echo $result->yatra_id; ?>">
                                                                View
                                                            </a>

                                                            <a href="update-yatra.php?yatra_id=<?php echo $result->yatra_id; ?>">
                                                                <i class="fa fa-edit"></i> </a>
                                                            <a href="view-yatra.php?del=<?php echo $result->yatra_id; ?>" onclick="return confirm('Do you want to delete');">
                                                                <i class="fa fa-close"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php $cnt++;
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7">No Record Found</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loading Scripts -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.display').DataTable();
            });
        </script>
    </body>

    </html>
<?php } ?>