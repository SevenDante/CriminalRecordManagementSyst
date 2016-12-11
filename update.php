<?php 

session_start();

$_SESSION['post']=$_POST["post"];
$_SESSION['off_no']=$_POST["off_no"];
$_SESSION['area']=$_POST["area"];
$_SESSION['city']=$_POST["city"];
$_SESSION['email']=$_POST["email"];
$_SESSION['district']=$_POST["district"];
$_SESSION['state']=$_POST["state"];
$_SESSION['password']=md5($_POST["password"]);



 $m = new MongoClient();
 $db = $m->crimemgmt;
$collection = $db->policeuser;



if(($_POST['post']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'post' => $_SESSION['post'] 
    									  )
    					  )
);

}



if(!empty($_POST['email']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'Email' => $_SESSION['email'] 
    									  )
    					  )
);

}



if(!empty($_POST['off_no']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'off_no' => $_SESSION['off_no'] 
    									  )
    					  )
);

}



if(!empty($_POST['area']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'address.area' => $_SESSION['area'] 
    									  )
    					  )
);

}

if(!empty($_POST['city']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'address.city' => $_SESSION['city'] 
    									  )
    					  )
);

}


if(!empty($_POST['district']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'address.district' => $_SESSION['district'] 
    									  )
    					  )
);

}

if(!empty($_POST['state']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'address.state' => $_SESSION['state'] 
    									  )
    					  )
);

}


if(!empty($_POST['password']))
{
	$collection->update(
    				array('officerid' => $_SESSION['officer_id']),
    				array('$set' => array(
    										'password' => $_SESSION['password'] 
    									  )
    					  )
);

}


session_destroy();

 ?>