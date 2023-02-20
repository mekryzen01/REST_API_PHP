<?php 
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');
if($_SERVER['REQUEST_METHOD'] !== 'GET'){
    echo json_encode(array("status"=> "error"));
    die();
}
try{
   $stmt = $db->prepare("SELECT * FROM `watinfo` join districts using(district_id)  WHERE id = ?");
   $stmt->execute([$_REQUEST['id']]);
   foreach($stmt as $row){
    $show = array(
        'id' => $row['id'],
            'wat_name' => $row['wat_name'],
            'detail' => $row['detail'],
            'address' => $row['address'],
            'district_id' => $row['district_id'],
            'name_th' => $row['name_th'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
    );
    echo json_encode($show);
    break;
   }
    $db= null;
}catch(PDOException $e){
    print "Error!:".$e->getMessage()."<br/>";
    die();
}
