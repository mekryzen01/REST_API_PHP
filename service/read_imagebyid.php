
<?php
header("AcceSS-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('./db.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(array("status" => "error"));
    die();
}
try {
    $idwat = $_REQUEST['id'];
    $stmt = $db->prepare("SELECT * FROM `image_wat`  WHERE id = '$idwat'");
    $stmt->execute();
    $output = array();
    foreach ($stmt as $rs) {
        $resultarray = array(
            'rowder' => $rs['rowder'],
            'id' => $rs['id'],
            'path' => $rs['path'],
        );
        array_push($output, $resultarray);
    }
    echo json_encode($output);

    $db = null;
} catch (PDOException $e) {
    print "Error!:" . $e->getMessage() . "<br/>";
    die();
}
