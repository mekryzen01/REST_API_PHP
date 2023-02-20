<?php 
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');

$data = json_decode(file_get_contents("php://input"));

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo json_encode(array("status"=> "error"));
    die();
}
try{
   $stmt = $db->prepare("INSERT INTO user (iduser, Name, Sername, email, password, status_id, time_create) VALUES (?,?,?,?,?,0,NOW()) ");
   $stmt -> bindParam(1,$data->null);
   $stmt -> bindParam(2,$data->Name);
   $stmt -> bindParam(3,$data->Sername);
   $stmt -> bindParam(4,$data->email);
   $stmt -> bindParam(5,$data->password);

   if($stmt->execute()){
    echo json_encode(array("status"=> "success"));
   }else{
    echo json_encode(array("status"=> "error"));
   }

    $db= null;
}catch(PDOException $e){
    print "Error!:".$e->getMessage()."<br/>";
    die();
}
