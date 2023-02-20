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
    <title>Menager_user</title>
</head>

<body>
    <?php include("../components/nav_admin.php") ?>
    <div class="container">
        <div class="d-flex bd-highlight mb-3">
            <div class="me-auto p-2 bd-highlight">
                <h2>Users
            </div>
            <!-- <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-secondary" onclick="showUserCreateBox()">Create</button>
            </div> -->
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">นามสกุล</th>
                        <th scope="col">อีเมล์</th>
                        <th scope="col">ประเภทสิทธิ์</th>
                        <th scope="col">วันที่สมัคร</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="mytable">
                    <tr>
                        <th scope="row" colspan="5">Loading...</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../js/index.js"></script>
    </div>
</body>

</html>