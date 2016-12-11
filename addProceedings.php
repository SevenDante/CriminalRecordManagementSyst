<?php

session_start();
require ('connect.php');

$collection = $db->crimedata;  
$temp = $_SESSION['case_id'];

//VALIDATION
if($_POST['submit']){
$newdata = array("date"=>new MongoDate(),"desc" => $_POST['description']);

//update the case page with the proceeding
$collection->update(array("caseid"=>$_SESSION['case_id']),  array('$push'=> array("proceedings" => $newdata )));



//redirect to case page

header ("Location:case-detail.php?case=$temp");
exit();
}
?>
