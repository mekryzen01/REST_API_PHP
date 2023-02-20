<?php 
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');

$data = json_decode(file_get_contents("php://input"));

if($_SERVER['REQUEST_METHOD'] !== 'PATCH'){
    echo json_encode(array("status"=> "error"));
    die();
}
try{
   $stmt = $db->prepare("UPDATE user SET Name=?, Sername=?, email=?, password=? WHERE iduser=?");
   $stmt -> bindParam(1,$data->Name);
   $stmt -> bindParam(2,$data->Sername);
   $stmt -> bindParam(3,$data->email);
   $stmt -> bindParam(4,$data->password);
   $stmt -> bindParam(5,$data->iduser);

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
