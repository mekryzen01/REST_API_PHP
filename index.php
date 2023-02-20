<?php
include('./service/db.php');
$select_1 = $db->prepare("SELECT COUNT(id) AS nubwat FROM `watinfo`;");
$select_1->execute();
$row = $select_1->fetch(PDO::FETCH_ASSOC);
/////////////////////////////////////////////////////////////////////////////
$select_2 = $db->prepare("SELECT COUNT(iduser) AS nubuser FROM `user` WHERE status_id = 1 ;");
$select_2->execute();
$row1 = $select_2->fetch(PDO::FETCH_ASSOC);
///////////////////////////////////////////////////////////////////////////////////////////////
$select_3 = $db->prepare("SELECT COUNT(district_id)as nub_zip FROM `districts` WHERE zip_code = 57000;");
$select_3->execute();
$row2 = $select_3->fetch(PDO::FETCH_ASSOC);

$select_dis = $db->prepare("SELECT * FROM `districts` WHERE zip_code = 57000;");
$select_dis->execute();
$rs = $select_dis->fetchAll(PDO::FETCH_ASSOC);



$select_wat = $db->prepare("SELECT * FROM `image_wat` join watinfo using(id)");
$select_wat->execute();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("./components/header_include.php") ?>
    <link rel="stylesheet" href="./css/page.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="./js/index.js"></script>


    <title>หน้าหลัก</title>
</head>


<body>
    <?php include("./components/nav_user.php") ?>
    <section id="frist" class="mt-3">
        <div class="container-fluid ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6 col-md-6 align-self-center">
                        <h1>ยินดีต้อนรับเข้าสู่ ระบบค้นหาวัด</h1>
                        <div class="" id="formshow"></div>
                        <!-- <form action="./showtumbon.php" role="search" method="POST"><label for="exampleDataList" class="form-label">ค้นหาตำบลที่ต้องการ</label>
                            <select name="text-search" class="form-control">
                                <option>เลือกตำบล</option>
                                <option id="selectjs"></option>
                            </select>
                            <div class="col-12" style="padding-top: 25px;">
                                <input type="submit" name="search-filter" class="btn btn-primary" value="search"> </input>
                            </div>
                        </form> -->
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 ">
                        <div class="slideshow-container">
                            <div class="mySlides fade">
                                <div class="numbertext">1 / 3</div>
                                <img src="./image/wat/1.jpg" style="width:100%" height="370px">
                            </div>
                            <div class="mySlides fade">
                                <div class="numbertext">2 / 3</div>
                                <img src="./image/wat/2.jpg" style="width:100%" height="370px">

                            </div>
                            <div class="mySlides fade">
                                <div class="numbertext">3 / 3</div>
                                <img src="./image/wat/3.jpg" style="width:100%" height="370px">

                            </div>
                        </div>
                        <br>

                        <div style="text-align:center">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="second" class="my-3">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <?php echo "<h5 class='card-title'>จำนวนวัด</h5>" . $row['nubwat'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <?php echo "<h5 class='card-title'>จำนวนผู้ใช้</h5>" . $row1['nubuser'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <?php echo "<h5 class='card-title'>จำนวนตำบล</h5>" . $row2['nub_zip'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="three" class="my-3 mb-5">
        <div class="container-fluid">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="row">
                        <h2>ข้อมูลวัดที่มี</h2>
                    </div>
                    <div class="" id="show"></div>
                    <!-- <img src="" width="100%" height="150px" alt=""> -->
                </div>
            </div>
        </div>
    </section>
    <?php include('./components/footer_include.php') ?>


    <script src="./js/slider.js"></script>
    

</body>

</html>