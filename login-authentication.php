<?php
session_start();
require ('connect.php');

if($_POST['submit']){
$username = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);    

    
$collection = $db->policeuser;

//VALIDATION : usename and password authentication
$row = $collection->findOne(array('username'=> $username, 'password'=> $password));

//$row contains an array (if exist)
if(is_array($row)) {
    $_SESSION['user_name'] = $row[username];
    $_SESSION['fname'] = $row[FName];
    $_SESSION['lname'] = $row[LName];
    $_SESSION['officerid']=$row[officerid];
    
}else{
    echo "Invalid Username or Password!";
}//end if-else

}//END IF

//EDIT 1

if(isset($_SESSION["user_name"])) {
header("Location:user_dashboard.php");
}

?>