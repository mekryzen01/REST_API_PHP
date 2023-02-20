<?php
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(array("status" => "error"));
    die();
}
try {

    $loop = array();
    foreach ($db->query('SELECT * FROM `image_wat` join (SELECT * FROM watinfo)as t1 ON image_wat.id = t1.id GROUP BY image_wat.id HAVING COUNT(1)') as $row) {
        array_push($loop, array(
            'id' => $row['id'],
            'wat_name' => $row['wat_name'],
            'path' => $row['path'],
            'detail' => $row['detail'],
            'address' => $row['address'],
            'district_id' => $row['district_id'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],

        ));
    }
    echo json_encode($loop);
    $db = null;
} catch (PDOException $e) {
    print "Error!:" . $e->getMessage() . "<br/>";
    die();
}
