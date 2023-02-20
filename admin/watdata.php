<?php
include('../service/db.php');
session_start();
if (!isset($_SESSION['iduser'])) {
    header("location: ../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../components/header_include.php") ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Menager_wat</title>
</head>

<body>
    <?php include("../components/nav_admin.php") ?>
    <div class="container">
        <div class="d-flex bd-highlight mb-3">
            <div class="me-auto p-2 bd-highlight">
                <h2>วัด
            </div>
            <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-secondary" onclick="showWatCreateBox()">เพิ่มข้อมูลวัด</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อวัด</th>
                        <th scope="col">รายละเอียด</th>
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">ตำบล</th>
                        <th scope="col">latitude</th>
                        <th scope="col">longitude</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="mytablewat">
                    <tr>
                        <th scope="row" colspan="5">Loading...</th>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        
        <div class="row ">
            <form id="fileupload_form" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">เพิ่มรูปภาพวัด</label>
                    <div class="col-sm-6">
                        <select name="idwat" id="idwat" class="form-select my-2">
                            <option>เลือกวัด</option>
                            <option id="watselect"></option>
                        </select>
                        <input type="file" id="myfile" class="form-control" />
                        
                    </div>
                </div>

                <div class="form-group mt-2">
                    <div class="col-sm-offset-3 col-sm-6 m-t-15">
                        <input type="button" onclick="saveFile();" value="Upload" class="btn btn-success btn-lg btn-block">
                    </div>
                </div>

            </form>
            <span id="message_box" class="col-sm-offset-3 col-sm-6 m-t-15"></span>
        </div>
        <div class="row mb-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อวัด</th>
                            <th scope="col">รูป</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="mytableimage">
                        <tr>
                            <th scope="row" colspan="5">Loading...</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <script src="../js/index.js"></script>

    </div>
</body>

</html>