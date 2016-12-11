<html>
<head>

<style>

.y{

  margin-left:150px;
  margin-top:50px;
  margin-right:200px;
  padding-left:20px;
  padding-top:20px;
  border-style:groove;
  line-height:200%;
}

</style>

        <script type="text/javascript">       
            function valid_form(){
                var x = document.forms["register_form"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                alert("Not a valid e-mail address");
                return false;
            }
        }
</script>

</head>


<body>

<div class="y">
<form action="upd.php" method="post">
<input type="hidden" name="submitted" value="true" />
Officer_ID:<input type="text" name="id">
<button type="submit" value="Search">search!</button>

</form>
</div>

</body>

</html>

<?php
session_start();
if (isset($_POST['submitted'])){
$offr_id=$_POST['id'];
$_SESSION['officer_id']     =$_POST['id'];			
     $m = new MongoClient();
     $db = $m->crimemgmt;
 
     $collection = $db->policeuser;


$rec = $collection->find(array('officerid'=> $offr_id));

?>

<div class="y">
<?php


$y=0;
foreach($rec as $row)
{
$y++;

}
if(!$y){
    echo "No Officer Id Found";
}
foreach($rec as $row)
{


if($y>0){
  
   echo"<h2 align='center'>Details</h2>";
 
    $a=$row["FName"];
    echo"Name   ".$a."<br>"; 
   
     echo"username   ".$row["username"]."<br>";
     echo"Email      ".$row["Email"]."<br>";
     echo"off_no   ".$row["off_no"]."<br>";

     echo"Post   ".$row["post"]."<br>";
    echo"Area     ".$row["address"]["area"]."<br>";
    echo"City     ".$row["address"]["city"]."<br>";
    echo"District  ".$row["address"]["district"]."<br>";
  
    echo"State   ".$row["address"]["state"]."<br>";


  ?>

</div>
<div class="y">

   <h2 align='center'>Update Details</h2>
<form action="update.php" method="post" name="register_form" onsubmit="return valid_form()">
Email: <input type="text" name="email" id="email"><br>
password: <input type="password" name="password"><br>
post: <select name="post">
   <option disabled selected value> Select </option>
  <option value="Police Constable">Police Constable</option>
  <option value="Senior Police Constable">Senior Police Constable</option>
  <option value="Police Head Constable">Police Head Constable</option>
  <option value="Assistant Sub-Inspector">Assistant Sub-Inspector</option>
    <option value="Sub-Inspector of Police">Sub-Inspector of Police</option>
  <option value="Inspector of Police">Inspector of Police</option>
  <option value="Assistant Commissioner of Police">Assistant Commissioner of Police</option>
  <option value="Superintendent of Police">Superintendent of Police</option>
  <option value="Joint Commissioner of Police">Joint Commissioner of Police</option>
</select><br>
phone_no: <input type="text" name="off_no"><br>
Address:<br>
area: <input type="text" name="area"><br>
city: <input type="text" name="city"><br>
district: <input type="text" name="district"><br>
state: <input type="text" name="state"><br>
<input type="submit" name="submit">
</form>

</div>
<?php

   
  }

 }


}




?>
