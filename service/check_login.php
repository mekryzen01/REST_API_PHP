<?php
include('db.php');
session_start();



if (isset($_REQUEST['Login'])) {
    print_r($_REQUEST);

    $email = $_POST['email'];
    $password = $_POST['password'];


    $select_stmtapi = $db->prepare("SELECT * FROM user where email = :email and password = :password and status_id = 1 or status_id = 0");
    $select_stmtapi->bindParam(':email', $email);
    $select_stmtapi->bindParam(':password', $password);
    $select_stmtapi->execute();
    $rowapi = $select_stmtapi->fetch(PDO::FETCH_ASSOC);

    if ($rowapi) {
        if ($rowapi['status_id'] == 0) {
            //User
            $_SESSION['iduser'] = $rowapi['iduser'];
            header("location: ../page/index_user.php");
        } else if ($rowapi['status_id'] == 1) {
            //Admin
            $_SESSION['iduser'] = $rowapi['iduser'];
            header('location: ../admin/index_admin.php');
        }
    } else {
        echo "<script>alert('Login Error'); window.location = '../login.php';</script>";
    }
}
