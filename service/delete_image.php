<?php 
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');

$data = json_decode(file_get_contents("php://input"));

if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
    echo json_encode(array("status"=> "error"));
    die();
}
try{
   $stmt = $db->prepare("DELETE FROM image_wat WHERE rowder=?");
   $stmt -> bindParam(1,$data->rowder);
   

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
