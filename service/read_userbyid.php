<?php 
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');

if($_SERVER['REQUEST_METHOD'] !== 'GET'){
    echo json_encode(array("status"=> "error"));
    die();
}
try{
   $stmt = $db->prepare("SELECT * FROM `user` WHERE iduser = ?");
   $stmt->execute([$_REQUEST['iduser']]);
   foreach($stmt as $row){
    $show = array(
        'iduser' => $row['iduser'],
        'Name' => $row['Name'],
            'Sername' => $row['Sername'],
            'email' => $row['email'],
            'password' => $row['password'],
    );
    echo json_encode($show);
    break;
   }
    $db= null;
}catch(PDOException $e){
    print "Error!:".$e->getMessage()."<br/>";
    die();
}
