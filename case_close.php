<?php

session_start();
require ('connect.php');

$collection = $db->crimedata;  
$temp = $_SESSION['case_id'];

$mydate= new MongoDate();

$collection->update(
    array("caseid"=>$_SESSION['case_id']),
    array('$push'=> array("proceedings" => array("date"=>$mydate,"desc" => "CASE CLOSED") )));

$collection->update(
   array("caseid"=>$_SESSION['case_id']),array('$set'=> array("status"=>"closed")));
header ("Location:summary.php");
exit();

?>