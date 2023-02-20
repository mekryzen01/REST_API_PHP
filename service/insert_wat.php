<?php
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("status" => "error"));
    die();
}
try {
    $stmt = $db->prepare("INSERT INTO watinfo (id, wat_name, detail, address, district_id, latitude, longitude) VALUES (?,?,?,?,?,?,?) ");
    $stmt->bindParam(1, $data->null);
    $stmt->bindParam(2, $data->wat_name);
    $stmt->bindParam(3, $data->detail);
    $stmt->bindParam(4, $data->address);
    $stmt->bindParam(5, $data->district_id);
    $stmt->bindParam(6, $data->latitude);
    $stmt->bindParam(7, $data->longitude);

    if ($stmt->execute()) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error"));
    }

    $db = null;
} catch (PDOException $e) {
    print "Error!:" . $e->getMessage() . "<br/>";
    die();
}
