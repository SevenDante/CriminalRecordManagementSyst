



<html>

<head>
<title>Track</title>


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







table {
  margin-right:150px;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
   
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
   padding-left:290px;
   padding-top:70px;
padding-bottom:30px;

   }

.nik{
  border-style:groove;
  line-height:200%;
    margin-left:150px;
    margin-top:50px;
    margin-bottom:50px;
   margin-right:150px;
   padding-left:50px;
   padding-top:70px;
  padding-bottom:30px;

}

.bt{
  position:relative;
  top:-30px;
  left:110px;
}

</style>

</head>

<body >




<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
   
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
  
       
        <li><a href="index.html">HOME</a></li>
       
         </ul>
    </div>

  
  </div>
</nav>

    <div class="container" style="margin-top: 120px; text-align:center;">
   <p><h1> Track Your Case </h1></p>
</div>
   











<div class="st">
<form action="track.php" method="post">
   <input type="hidden" name="submitted" value="true" />

   
  Case_Id:<br>
  <input type="text" name="caseid" Placeholder="Case ID" required>
  <br><br>
  

 
<br><br>
<div class="bt">
<button type="submit" value="Search">search!</button>


<input type='reset' value='Reset' name='reset'>

</div>

</form>
</div>
<h2 style="text-align:center">Case Proceedings</h2>


<?php
     $m = new MongoClient();


     $db = $m->crimemgmt;


     $collection = $db->crimedata;

if (isset($_POST['submitted'])){

 // $name=$_POST['name'];
  $caseid=$_POST['caseid'];
      $caseid = (int)$caseid;//convert to float
//do we have to do a typecast here ! 

$rec = $collection->findOne(array("caseid" => $caseid));

$x=0;
foreach ((array)$rec as $d) {
 $x++;
}

if($x !=0)
{

//$rec->limit(1);


	foreach ((array)$rec as $document) {
   			  $document->{"caseid"};
		}


	$allrec = $rec['proceedings'];
                $y=1;
	//  for every case proceeding  
?>

<div class="st">
<?php
	foreach($allrec as $myrecord){

                    
     		  	   echo $y.")<br>";
                    ?>   
                    <table width="450">
                  <tr><td>Date: </td><td>
                   <?php      
                      echo date('Y-m-d',$myrecord["date"]->sec)."<br>";
 		     ?>
                 </td></tr>
                  <tr><td>Proceedings: </td><td>
                 
                   <?php	
                      echo $myrecord["desc"]."<br>"."<br>"."<br>";
                           $y++;
                    ?>
                 </td></tr>
                    </table>
                  <br><br>
 
                  <?php
		}
?>
</div>
<?php

}    
else{
?>
<div class="st">
<?php
?>    <div class="container">
   <p style="margin-top: 130px; text-align:center;  "><h3> No Case Id Found !! </h3></p>
</div>


</div>

<?php
}
}
?>

</body>
</html>
