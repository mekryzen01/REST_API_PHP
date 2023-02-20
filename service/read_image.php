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
    foreach ($db->query('SELECT *,ROW_NUMBER() OVER(ORDER BY rowder) AS row_num FROM `image_wat` JOIN watinfo USING(id)') as $row) {
        array_push($loop, array(
            'row_num' => $row['row_num'],
            'rowder' => $row['rowder'],
            'id' => $row['id'],
            'wat_name' => $row['wat_name'],
            'path' => $row['path'],
        ));
    }
    echo json_encode($loop);
    $db = null;
} catch (PDOException $e) {
    print "Error!:" . $e->getMessage() . "<br/>";
    die();
}
