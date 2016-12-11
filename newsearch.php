

<html>

<head>
<title>Search Criminals</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    
<style>


/*
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
 padding: 5px;
    text-align: left;

}
*/

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
   background:/home/hp/Downloads/Extras/12052414_10153338142773127_8030776760617452001_o.jpg ;
   background-size:cover; 
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
  top:30px;
  left:210px;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #337ab7;
    color: white;
}
</style>

</head>

<body>
    <nav class="navbar navbar-default navbar-static-top"> 
    <div class="container">
    Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname']?> 
    <button type="button" class="btn btn-default navbar-btn navbar-right"><a href="logout.php">Logout</a></button>
    
        </div>
</nav>
<div class="container"><a href='user_dashboard.php'>Go back to your dashboard</a></div><br>  

<h2 style="text-align:center">Search Criminals</h2>
<div class="st">
<form action="newsearch.php" method="post">
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

<div class="nik">

<?php
       foreach ($cursor as $row) {
        $x++; 
      }
   ?>
<p style="text-align:center; color:GREEN; font-size:25px;"><?php echo "<br> $x Result(s) found !!  <br>"; ?></p>



<?php    
     foreach ($cursor as $row) {
//       $pic= $row["picture"] ;
    $img=$db->IMG;
    $output=$img->findOne(array('pic_criminal'=>$row['name']));

?>
    <div class="row">
         <div class="col-md-3 col-lg-3 " align="center">
    
    <?php
         
          if($output){
   
    echo '<img height="200px" src="data:image/jpg;base64,'.$output['image'].'" class="img-responsive" />';
     }

    echo '</div>';
         
    echo  '<div class=" col-md-9 col-lg-9 ">'; 
             
             
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
<?php $a= $row['age'] ;?>
<?php echo $a; ?>
</td></tr>


<tr><td>Arrest Date: </td><td>
<?php   
$ch= $row["arrest date"] ;
echo date('Y-m-d',$ch->sec);
?>
</td></tr>
             
<tr><td>Case#: </td><td>
<?php   
$ch= $row["caseid"] ;
echo "<a href='case-detail.php?case=$ch'>$ch</a>";
?>
</td></tr>

<tr><td>Location of Arrest: </td><td>
<?php   
$ch= $row["location Arrest"] ;
echo $ch;
?>
</td></tr>
             


             
<tr><td>Address:
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
<?php $a= $row[address][state] ;?>
<?php echo $a; ?>
</td></tr>
             
</table>
        </div>

    </div>
<br><br><br>
<?php
     }
?>





<?php
   
}  
?>





</div>


</body>
</html>



