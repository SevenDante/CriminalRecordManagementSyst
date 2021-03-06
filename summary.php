	<!DOCTYPE html>
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
  
       
        <li><a href="index.html">HOME</a></li>
       
         </ul>
    </div>

  
  </div>
</nav>
<br>
<br>
<br>
<br>



  <?php  

    session_start();
    require ('connect.php');

    $collection = $db->crimedata;  
      $criminalcollection = $db->criminal;
   $temp = $_SESSION['case_id'];

    //$criminal = $criminalcollection->findOne(array("caseid" => $temp));
    $mydate= new MongoDate();
    $db->crimedata;
    //echo "<h1 style="text-align: center">"."Criminal case summary"."</h1>"."<br>";
?>

<p  ><h2 style=" text-align: center;">Summary</h2></p>

<?php



	$cursor = $collection->find(array("caseid" => $temp));
    $criminalcursor = $criminalcollection -> find(array("caseid" => $temp));

	
?>

<div class="jumbotron" style="  border-style:groove; margin-left:50px; margin-right:50px; font-size: 15px; line-height: 200%; paddin-left:50px; font-weight: bold;" >

<?php

  foreach ($cursor as $document) {
        echo "Case Id : ".$document["caseid"] . "\n"."<br>";                 //case id
        echo "Report date : ".date('Y-m-d H:i:s', $document[report_date]->sec)."<br>";
        echo "Incident date : ". $document[incident_date]."<br>";
        echo "Types of crime : ";
        
        foreach($document[crime_type] as $crimetype)            //type of case
        {
            echo $crimetype. " , ";
        }
        echo "<br>";
        foreach ($document["petitioner_detail"] as $key ) {         //display petitioner
           $i++;
           if($i==1)
            echo "Petitioner name : ".$key."<br>";
           if ($i==2) {
                echo "Petitioner Address : ".$key."<br>";
           }
            if ($i==3) {
                echo "Petitioner Contact : ".$key."<br>";
           }
            if ($i==4) {
                echo "Petitioner Age : ".$key."<br>";
           }

            if ($i==5) {
                echo "Petitioner Gender : ".$key."<br>";
           }
        }
        $i=0;
        foreach ($document["victim_detail"] as $key ) {             //display victim details
           $i++;
           if($i==1)
            echo "Victim name : ".$key."<br>";
           if ($i==2) {
                echo "Victim Address : ".$key."<br>";
           }
            if ($i==3) {
                echo "Victim Age : ".$key."<br>";
           }

            if ($i==4) {
                echo "Victim Gender : ".$key."<br>";
           }
        }
        $i=0;
        foreach ($document["inv_officer"] as $key ) {       //display officer investigating the case
           $i++;
           if($i==1)
            echo "Officer ID : ".$key."<br>";
           if ($i==2) {
                echo "Officer fullname  : ".$key." ";
           }
            if ($i==3) {
                echo $key."<br>";
           }
        }
        foreach ($document["proceedings"] as $key=>$pro ) {             //display proceedings
            echo date('Y-m-d H:i:s', $pro["date"]->sec)." => ";
            echo $pro["desc"]."<br>";
            }
        

     }

?>
</div>

<p  ><h3 style=" text-align: center;">Criminal</h3></p>


<div class="jumbotron" style="  border-style:groove; margin-left:50px; margin-right:50px; font-size: 15px; line-height: 200%; paddin-left:50px; font-weight: bold;" >


<?php
//echo "<h1>"."Criminal details"."</h1>";
    foreach ($criminalcursor as $document1) {
    echo "<br><br>";  
   
    $img=$db->IMG;
    $output=$img->findOne(array('pic_criminal'=>$document1['name']));
   
    echo '<div class="row">';
        

    if($output){
        echo '<div class="col-md-3">';
        echo '<img height="200px" src="data:image/jpg;base64,'.$output['image'].'" class="img-responsive" height="200" width="200" />';
        echo '</div>';
    }
        
    echo '<div class="col-md-9">';
        
    echo "Full Name : ".$document1["name"]."<br>";
    echo "Gender : ".$document1["gender"]."<br>";
    echo  "Arrest date : ".date('Y-m-d ', $document1["arrest date"]->sec)."<br>";
    echo "Location of arrest : ".$document1["location Arrest"]."<br>";
    echo "Age : ".$document1["age"]."<br>";
    $i=0;
    foreach ($document1["address"] as $key ) {             //display address details
       $i++;
       if($i==1)
        echo "Area : ".$key."<br>";
       if ($i==2) {
            echo "City : ".$key."<br>";
       }
        if ($i==3) {
            echo "District : ".$key."<br>";
       }

        if ($i==4) {
            echo "State : ".$key."<br>";
       }
    }
    echo '</div></div>';

}



 
    





     ?>


</div>

       </body>
  </html>
