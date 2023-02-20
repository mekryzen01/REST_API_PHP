<?php 
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');
if($_SERVER['REQUEST_METHOD'] !== 'GET'){
    echo json_encode(array("status"=> "error"));
    die();
}
try{
   
    $loop=array();
    foreach($db->query('SELECT *,ROW_NUMBER() OVER(ORDER BY id) AS row_num FROM `watinfo` JOIN districts USING(district_id) ORDER BY id')as $row){
        array_push($loop,array(
            'row_num' => $row['row_num'],
            'id' => $row['id'],
            'wat_name' => $row['wat_name'],
            'detail' => $row['detail'],
            'address' => $row['address'],
            'district_id' => $row['district_id'],
            'name_th' => $row['name_th'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude']
        ));
    }
    echo json_encode($loop);
    $db= null;
}catch(PDOException $e){
    print "Error!:".$e->getMessage()."<br/>";
    die();
}
