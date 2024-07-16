<?php
session_start();
error_reporting(0);
include ('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $yatra_name = $_POST['yatra_name'];
        $description = $_POST['description'];
        $package = $_POST['package'];
        $people_count = $_POST['people_count'];

        // Array to store uploaded file paths
        $uploaded_files = array();
        $uploaded_descriptions = array();

        // Process each file input individually
        for ($i = 1; $i <= 5; $i++) {
            if (isset($_FILES["fileToUpload" . $i])) {
                $target_dir = "yatra_images/";
                $imageFileType = strtolower(pathinfo($_FILES["fileToUpload" . $i]["name"], PATHINFO_EXTENSION));
            
                $uploaded_file_path = $target_dir . basename($_FILES["fileToUpload" . $i]["name"]);
            
                $uploadOk = 1;
            
                $check = getimagesize($_FILES["fileToUpload" . $i]["tmp_name"]);
                if ($check === false) {
                    $error = "File is not an image.";
                    $uploadOk = 0;
                }
            
                if ($_FILES["fileToUpload" . $i]["size"] > 500000000) {
                    $error = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
            
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
            
                if ($uploadOk == 0) {
                    $error = "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload" . $i]["tmp_name"], $uploaded_file_path)) {
                        $uploaded_files[] = $uploaded_file_path;
                        $uploaded_descriptions[] = $_POST["ImgDescription_" . $i];
                    } else {
                        $error = "Sorry, there was an error uploading your file.";
                    }
                }
            }
            
        }

        if (count($uploaded_files) > 0) {
            $sql = "INSERT INTO tbl_yatra (yatra_name, description, package, people_count, image_1, image_2, image_3, image_4, image_5, ImgDescription_1, ImgDescription_2, ImgDescription_3, ImgDescription_4, ImgDescription_5) VALUES (:yatra_name, :description, :package, :people_count, :image_1, :image_2, :image_3, :image_4, :image_5, :ImgDescription_1, :ImgDescription_2, :ImgDescription_3, :ImgDescription_4, :ImgDescription_5)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':yatra_name', $yatra_name, PDO::PARAM_STR);
            $query->bindParam(':description', $description, PDO::PARAM_STR);
            $query->bindParam(':package', $package, PDO::PARAM_STR);
            $query->bindParam(':people_count', $people_count, PDO::PARAM_INT);

            // Bind each image path and description to corresponding parameter
            for ($i = 0; $i < 5; $i++) {
                if (isset($uploaded_files[$i])) {
                    $query->bindParam(':image_' . ($i + 1), $uploaded_files[$i], PDO::PARAM_STR);
                    $query->bindParam(':ImgDescription_' . ($i + 1), $uploaded_descriptions[$i], PDO::PARAM_STR);
                } else {
                    // If less than 5 images uploaded, bind null
                    $query->bindValue(':image_' . ($i + 1), null, PDO::PARAM_NULL);
                    $query->bindValue(':ImgDescription_' . ($i + 1), null, PDO::PARAM_NULL);
                }
            }

            $query->execute();
            $msg = "Yatra added successfully";
        } else {
            $error = "Please upload at least one image.";
        }
    }
}
?>


<!doctype html>

<head>
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
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Custom CSS from the second code -->
    <link rel="stylesheet" href="path/to/your/custom.css">
</head>

<body>
    <?php include ('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include ('includes/leftbar.php'); ?>

        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Add Yatra</h2>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Add Yatra</div>
                                    <div class="panel-body">
                                        <form method="post" enctype="multipart/form-data">

                                            <?php if ($error) { ?>
                                                <div class="errorWrap"><strong>ERROR</strong>:
                                                    <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } else if ($msg) { ?>
                                                    <div class="succWrap"><strong>SUCCESS</strong>:
                                                    <?php echo htmlentities($msg); ?>
                                                    </div>
                                            <?php } ?>

                                            <br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Yatra Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="yatra_name" required>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Description</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="description"
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Package Details</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="package" required>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">No. of People</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" name="people_count"
                                                        required>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="container"
                                                style=" display:flex; flex-wrap: wrap; padding-top:2rem;">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Images</label>
                                                    <div class="col-sm-8">
                                                        <!-- Multiple file inputs for images -->
                                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                            <input style="margin-top:0.3rem" type="file"
                                                                class="form-control" name="fileToUpload<?php echo $i; ?>"
                                                                id="fileToUpload<?php echo $i; ?>" required>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Images Description</label>
                                                    <div class="col-sm-8">

                                                        <input style="margin-top:0.3rem" type="text"
                                                            class="form-control" name="ImgDescription_1"
                                                            id="ImgDescription_1" required>
                                                        <input style="margin-top:0.3rem" type="text"
                                                            class="form-control" name="ImgDescription_2"
                                                            id="ImgDescription_2" required>
                                                        <input style="margin-top:0.3rem" type="text"
                                                            class="form-control" name="ImgDescription_3"
                                                            id="ImgDescription_3" required>
                                                        <input style="margin-top:0.3rem" type="text"
                                                            class="form-control" name="ImgDescription_4"
                                                            id="ImgDescription_4" required>
                                                        <input style="margin-top:0.3rem" type="text"
                                                            class="form-control" name="ImgDescription_5"
                                                            id="ImgDescription_5" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <button class="btn btn-primary" name="submit"
                                                        type="submit">Submit</button>
                                                </div>
                                            </div>
                                            <br>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Loading Scripts -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
    <!-- Script tags -->
</body>

</html>
