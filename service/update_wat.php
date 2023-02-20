<?php
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    echo json_encode(array("status" => "error"));
    die();
}
try {
    $stmt = $db->prepare("UPDATE watinfo SET wat_name=?, detail=?, address=?, district_id=?,latitude=?, longitude=?  WHERE id=?");
    $stmt->bindParam(1, $data->wat_name);
    $stmt->bindParam(2, $data->detail);
    $stmt->bindParam(3, $data->address);
    $stmt->bindParam(4, $data->district_id);
    $stmt->bindParam(5, $data->latitude);
    $stmt->bindParam(6, $data->longitude);
    $stmt->bindParam(7, $data->id);

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
