<?php 
 $user = 'root';
 $pass = '';
 try{
    $db = new PDO('mysql:host=localhost;dbname=project_rest_api',$user,$pass);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
    die('Unable to connect with the database');
 }
