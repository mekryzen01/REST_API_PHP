<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link -->
    <?php include('./components/header_include.php'); ?>
    <!-- css -->
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/page.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>Login</title>
</head>

<body>
    <!-- header -->
    <?php include('./components/nav_user.php') ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4 col-lg-4">
                <div class="text-center">
                    <img src="" alt="" width="150px" height="150px">
                </div>
            </div>
        </div>
        <form action="./service/check_login.php" method="post">
            <div class="row justify-content-center my-2">
                <div class="col-12 col-md-4 col-lg-4">
                    <label for="">อีเมล์ :</label>
                </div>
            </div>
            <div class="row justify-content-center my-2">
                <div class="col-12 col-md-4 col-lg-4">
                    <input type="email" class="form-control rounded-pill" name="email">
                </div>
            </div>
            <div class="row justify-content-center my-2">
                <div class="col-12 col-md-4 col-lg-4">
                    <label for="">รหัสผ่าน :</label>
                </div>
            </div>
            <div class="row justify-content-center my-2">
                <div class="col-12 col-md-4 col-lg-4">
                    <input type="password" class="form-control rounded-pill" name="password">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-12 col-md-4 col-lg-4">
                    <input type="submit" value="เข้าสู่ระบบ" class="form-control rounded-pill btn btn-success" name="Login">
                </div>
            </div>
        </form>
    </div>
    <?php include('./components/footer_include.php') ?>
</body>

</html>