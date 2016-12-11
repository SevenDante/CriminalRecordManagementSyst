<?php
session_start();
$m = new MongoClient();
$db = $m->crimemgmt;

if ($_POST['submit']){
  
  $name=$_POST['name'];
  $address=array('area'=>$_POST['add_area'],'city'=>$_POST['add_city'],'district'=>$_POST['add_dist'],'state'=>$_POST['add_state']);
  $gender=$_POST['gender'];

 // $arrestDate = new MongoDate(strtotime($_POST['arrestDate']));
  $locationArrest=$_POST['locationArrest'];
  $age = $_POST['criminalAge'];


    
$images=$db->IMG;
$im=file_get_contents($_FILES['pic']['tmp_name']);
       
	$res2=$images->insert(array("pic_criminal"=>$_POST['name'] ,"image"=>base64_encode($im)));
   
//   if($res2)
//   {
//	echo "Stored img";
//    }
        

$doc = array(
  "name" => $name,
  "gender" => $gender,
  "arrest date"=> new MongoDate(),
  "location Arrest"=>$locationArrest,
  "age"=>$age,
//  "charges"=>$charges,
  "caseid"=>$_SESSION['case_id'],
  "address"=>$address,
);


$db->criminal->insert($doc);
$temp = $_SESSION['case_id'];
header ("Location:case-detail.php?case=$temp");
}

?>






