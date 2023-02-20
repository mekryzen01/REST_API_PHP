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
    foreach($db->query('SELECT *,ROW_NUMBER() OVER(ORDER BY iduser) AS row_num FROM `user` JOIN status USING(status_id) ORDER BY iduser')as $row){
        array_push($loop,array(
            'row_num' => $row['row_num'],
            'iduser' => $row['iduser'],
            'Name' => $row['Name'],
            'Sername' => $row['Sername'],
            'email' => $row['email'],
            'status_name' => $row['status_name'],
            'Timecreate' => $row['time_create']
        ));
    }
    echo json_encode($loop);
    $db= null;
}catch(PDOException $e){
    print "Error!:".$e->getMessage()."<br/>";
    die();
}



?>