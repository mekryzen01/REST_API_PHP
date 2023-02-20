<?php
include('../service/db.php');
session_start();
if (!isset($_SESSION['iduser'])) {
    header("location: ../login.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../components/header_include.php") ?>
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">

    <title>Admin_Dashbord</title>
</head>

<body>
    <?php include('../components/nav_admin.php') ?>
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include("../components/footer_include.php") ?>
</body>

</html>