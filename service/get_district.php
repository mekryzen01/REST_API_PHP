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
    foreach ($db->query('SELECT * FROM  districts where zip_code = 57000') as $row) {
        array_push($loop, array(
            'district_id' => $row['district_id'],
            'name_th' => $row['name_th'],
        ));
    }
    // print_r($loop);
    echo json_encode($loop);
    // $db = null;
} catch (PDOException $e) {
    print "Error!:" . $e->getMessage() . "<br/>";
    die();
}
