<?php
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(array("status" => "error"));
    die();
}
try {
    $id = $_REQUEST['district_id'];
    $stmt = $db->prepare("SELECT * FROM `image_wat` 
    join(SELECT * FROM watinfo )as t1 ON image_wat.id = t1.id  
    join (select district_id,name_th from districts) as t2 on t1.district_id = t2.district_id  
    GROUP BY image_wat.id 
    HAVING COUNT(1) AND t1.district_id = $id");
    $stmt->execute();
    $output = array();
    foreach ($stmt as $rs) {
        $resultarray = array(
            'id' => $rs['id'],
            'wat_name' => $rs['wat_name'],
            'path' => $rs['path'],
            'detail' => $rs['detail'],
            'address' => $rs['address'],
            'district_id' => $rs['district_id'],
            'name_th' => $rs['name_th'],
            'latitude' => $rs['latitude'],
            'longitude' => $rs['longitude'],
        );
        array_push($output, $resultarray);
    }
    echo json_encode($output);

    $db = null;
} catch (PDOException $e) {
    print "Error!:" . $e->getMessage() . "<br/>";
    die();
}
