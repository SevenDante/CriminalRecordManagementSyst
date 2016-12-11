<html>
<head>
<title>Search</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>


	 /* Add a dark background color with a little bit see-through */
	.navbar {
 	   margin-bottom: 0;
 	   background-color: #2d2d30;
 	   border: 0;
 	   font-size: 11px !important;
 	   letter-spacing: 4px;
             
 	   opacity:0.9;

	}

	/* Add a gray color to all navbar links */
	.navbar li a, .navbar .navbar-brand {
 	   color: #d5d5d5 !important;
         
	}

	/* On hover, the links will turn white */
	.navbar-nav li a:hover {
 	   color: #fff !important;
	}

	/* The active link */
	.navbar-nav li.active a {
  	  color: #fff !important;
  	  background-color:#29292c !important;
	}

	/* Remove border color from the collapsible button */
	.navbar-default .navbar-toggle {
 	   border-color: transparent;
	}


	

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
 padding: 5px;
    text-align: left;

}

 .st{

   border-style: groove;
line-height:200%;
  
   margin-left:150px;
   margin-top:50px;
   margin-bottom:50px;
   margin-right:150px;
   padding-left:50px;
   padding-top:70px;
padding-bottom:30px;

   }

.nik{
   
   background-size:cover; 
  border-style:groove;
  line-height:200%;
    
    margin-top:50px;
    margin-bottom:50px;
   
   padding-left:50px;
   padding-top:70px;
  padding-bottom:30px;

}

.bt{
  position:relative;
  top:30px;
  left:210px;
}



</style>

</head>




<body>
  
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
   
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
  
       
        <li><a href="#home">HOME</a></li>
       
         </ul>
    </div>

  
  </div>
</nav>

    <div class="container" style="margin-top: 120px; text-align:center;">
   <p><h1> Search Criminals </h1></p>
</div>
   







 <div class="container" >
<div class="jumbotron"  >
  



<div class="st">
<form action="nnss.php" method="post">
   <input type="hidden" name="submitted" value="true" />
Full name:
  <input type="text" name="name" placeholder="Full Name"><br>
  Sex:
  <input type="radio" name="gender" value="male" > Male
  <input type="radio" name="gender" value="female"> Female
  <input type="radio" name="gender" value="other"> Other<br>
<!--
  Age:
   <input type="text" name="age" placeholder="Age"><br>
-->

<br><br>
<div class="bt">
<button type="submit" value="Search">search!</button>


<input type='reset' value='Reset' name='reset'>

</div>

</form>
</div>
<h2 style="text-align:center">Search Results</h2>




<?php
     
     $m = new MongoClient();
     $db = $m->crimemgmt;
     $collection = $db->criminal;

if (isset($_POST['submitted'])){

  $name=$_POST['name'];
  $gender=$_POST['gender'];
//  $Age=$_POST['age'];
//  $age=(int)$Age; 
//  $charges=$_POST['charges'];
                  //converting to int because in our database age isstored as int and not string
  /*

  $query = array('Accussed_name' => $name);
  $genderQuery=array('age' => $age);
  $cursor = $collection->find($nameQuery);
*/


/*
  $condition = [
            ["Accussed_name" => $name]
];
*/

$cnt=1;
  $cursor = $collection->find(array('$and'=>array(array("name" => $name),array("gender" => $gender)
                                                 //,array("age" => $age )
                                                 //,array("charges" => $charges)
                                                )));   //this the seaching condition which will generate a cursor
             
$x = 0;
?>
<div class="jumbotron"  >
<div class="nik">

<?php
       foreach ($cursor as $row) {
        $x++; 
      }
   ?>
<p style="text-align:center; color:GREEN; font-size:25px;"><?php echo "<br> $x Result(s) found !!  <br>"; ?></p>



<?php    
     foreach ($cursor as $row) {
       $pic= $row["picture"] ;


?>
         <table width="650";>
    <tr> <?php echo $cnt++ ?><td>Name: </td><td>
  
     <?php
        $acc_name= $row["name"] ;

        ?>
 
  <?php echo $acc_name;  ?>         

</td></tr>
 
<tr><td>Gender: </td><td>
<?php   
$ch= $row["gender"] ;
echo $ch;
?>
</td></tr>



<tr><td>Age: </td><td>
<?php   
$ch= $row["age"] ;
echo $ch;
?>
</td></tr>



<!--

<tr><td>Arrest Date: </td><td>
<?php   
$ch= $row["arrest date"] ;
echo $ch;
?>
</td></tr>
-->

             
<tr><td>Location Arrest:
</td></tr>
             
<tr><td>area: </td><td>
<?php $a= $row[address][area] ;?>
<?php echo $a; ?>
</td></tr>
             
<tr><td>city: </td><td>
<?php $a= $row[address][city] ;?>
<?php echo $a; ?>
</td></tr>


<tr><td>state: </td><td>
<?php $a= $row[address][district] ;?>
<?php echo $a; ?>
</td></tr>


<tr><td>state: </td><td>
<?php $a= $row[address][state] ;?>
<?php echo $a; ?>
</td></tr>
             




<br><br><br>
<?php

$t=0;
   $cas= $row['caseid'];
    $collection1 = $db->crimedata;




$cursor = $collection1->find(array("caseid" => $cas));
?>
<tr><td>Charges: </td><td>
<?php
foreach ($cursor as $document) {
foreach($document[crime_type] as $crimetype)            //type of case
        {
            echo $crimetype."<br>";
        }
}

?>
</td></tr>
</table>
<?php
     }


?>





<?php
   
}  
?>





</div>
</div>














</div>
</div>

</body>

</html>
