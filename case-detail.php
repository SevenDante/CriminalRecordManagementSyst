<?php
    session_start();
    require ('connect.php');
    $collection = $db->crimedata;
?>

<html>
<header>
    <title>Proceedings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
    label{
    display: inline-block;
    float: left;
    clear: left;
    width: 250px;
    text-align: right;
}
input {
  display: inline-block;
  float: left;
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
    background-color: #4CAF50;
    color: white;
}
    
    </style>
</header>

<body>
<?php
//find particular case
$_SESSION['case_id'] = (int)$_GET['case'];

$rec = $collection->findOne(array('caseid'=>$_SESSION['case_id']));
//validation
if(!is_array($rec))
{
    exit();
}
?>
<nav class="navbar navbar-default navbar-static-top"> 

<div class="container"><p style="text-align: center;">
    Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname']?></p> 
    <button type="button" class="btn btn-default navbar-btn navbar-right"><a href="logout.php">Logout</a></button>
    
    <input type="button" value="Add a criminal" class="btn btn-success navbar-btn navbar-right"  onclick="location.href='register-criminal.php';" <?php if($rec["status"]=="closed") echo "disabled='disabled'" ; ?>><input type="button" value="Summary" class="btn btn-success navbar-btn navbar-right"  onclick="location.href='summary.php';" <?php if($rec["status"]=="closed") echo "enabled" ;else echo "disabled"; ?>>
<!--        <input href="register-criminal.php" -->
<!--Add criminal</button>-->
 <button type="button" class="btn  btn-info navbar-btn navbar-left"><a href='user_dashboard.php'> Dashboard</a></button>


</div>
</nav>
<br>   
<div class="container">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">
    <div class="jumbotron"  >
CaseID: <?php echo $rec["caseid"];?><br><br>
Type of crime:<br> 

<?php foreach($rec["crime_type"] as $temp){
        echo $temp."<br>";
    }
?>
</div>
<br>
    
    
    Petitioner's Details:<br>
         <div class="row">

         <div class=" col-md-9 col-lg-9 "> 
                  <table >
                    <tbody>
                      <tr>
                        <td>Petitioner's Name:</td>
                        <td><?php echo $rec['petitioner_detail']['pName'];?></td>
                      </tr>
                      <tr>
                        <td>Petitioner's Address:</td>
                        <td><?php echo $rec['petitioner_detail']['pAdd'];?></td>
                      </tr>
                      <tr>
                        <td>Petitioner's Contact:</td>
                        <td><?php echo $rec['petitioner_detail']['pContact'];?></td>
                      </tr>
                      <tr>
                        <td>Petitioner's Age:</td>
                        <td><?php echo $rec['petitioner_detail']['pAge'];?></td>
                      </tr>
                      <tr>
                        <td>Petitioner's Gender:</td>
                        <td><?php echo $rec['petitioner_detail']['pGender'];?></td>
                      </tr>

                     
                    </tbody>
                  </table>
         </div>
    </div>

    
<br>
Victim's Details:<br>
    
         <div class="row">
     
         <div class=" col-md-9 col-lg-9 "> 
                  <table >
                    <tbody>
                      <tr>
                        <td>Victim's Name::</td>
                        <td><?php echo $rec['victim_detail']['vName'];?></td>
                      </tr>
                      <tr>
                        <td>Victim's Address::</td>
                        <td><?php echo $rec['victim_detail']['vAdd'];?></td>
                      </tr>
                      <tr>
                        <td>Victim's Age:</td>
                        <td><?php echo $rec['victim_detail']['vAge'];?></td>
                      </tr>
                      <tr>
                        <td>Victim's Gender:</td>
                        <td><?php echo $rec['victim_detail']['vGender'];?></td>
                      </tr>
                        
                    

                     
                    </tbody>
                  </table>
         </div>
    </div>
    
<!--
<?php
echo "Victim's Name: ".$rec['victim_detail']['vName']."<br>"; 
echo "Victim's Address: ".$rec['victim_detail']['vAdd']."<br>"; 
echo "Victim's Contact: ".$rec['victim_detail']['vContact']."<br>"; 
echo "Victim's DOB: ".$rec['victim_detail']['vDob']."<br>"; 
?>  
-->
<br>


Criminal's Details:<br>
<?php
$crecord = $db->criminal->find(array('caseid'=>$_SESSION['case_id']));
foreach($crecord as $myrec){
    $img=$db->IMG;
    $output=$img->findOne(array('pic_criminal'=>$myrec['name']));
            
 ?>
<div class="jumbotron"  style="    border-style: solid;">

     <div class="row">
         <div class="col-md-3 col-lg-3 " align="center">
    <?php
     if($output){
   
    echo '<img height="200px" src="data:image/jpg;base64,'.$output['image'].'" class="img-circle img-responsive" />';
     }

    echo '</div>';
         
    echo  '<div class=" col-md-9 col-lg-9 "> 
                  <table >
                    <tbody>';
    
    echo "<div class='row'><tr><td>criminal's name: </td>
                        <td>".$myrec['name']."</td>
                      </tr>
                      <tr>
                        <td>criminal's age:</td>
                        <td>".$myrec['age']."</td>
                      </tr>
                      
                      <tr>
                        <td>criminal's Arrest Date:</td>
                        <td>".date('Y-m-d',$myrec['arrest date']->sec)."</td>
                      </tr>
                      
                      <tr>
                        <td>criminal's arrest location:</td>
                        <td>".$myrec['location Arrest']."</td>
                      </tr>
                      <tr>
                        <td><b>criminal's Address:</b></td>
                      </tr>
                      <tr>
                        <td>criminal's area:</td>
                        <td>".$myrec[address][area]."</td>
                      </tr>
                      <tr>
                        <td>criminal's city:</td>
                        <td>".$myrec['address']['city']."</td>
                      </tr>
                      <tr>
                        <td>criminal's state:</td>
                        <td>".$myrec['address']['state']."</td>
                      </tr></div>
                      
                      ";
    echo "</tbody></table></div></div>";
    
    ?>
            </div>
<?php
}
?>
<br><br>





<br>    
<br>
<div class="jumbotron"  style="    border-style: solid;">
<h4>STATUS: </h4><?php echo $rec["status"]?><br>
</div>




<!--Proceedings: <br>-->
<?php
$allrec = $rec['proceedings'];
                
//  for every case proceeding

    echo "<div class='row'>";
    echo "<div class='col-md-12'>";
    echo "<h4>Proceedings:</h4>";
    
foreach($allrec as $myrecord){
    
    echo'<div class="row">
         <div class="col-md-8 col-md-offset-2 " align="center">
                  <table >
                    <tbody>';
    $mydate = $myrecord["date"];
    
    echo "<tr>
            <td>Date: </td>
            <td>".date('Y-m-d',$mydate->sec)."</td>
          </tr>
           <tr>
            <td>Description:</td>
            <td>".$myrecord["desc"]."</td>
          </tr>";
     echo "</tbody></table></div></div>";
//    
//    
//    
//    
//    echo "<br>DATE: ".$myrecord["date"]."<br>";
//    echo "DESCRIPTION:<br>".$myrecord["desc"]."<br>";
}
    echo "</div></div>";
?>
<!--form for adding a proceeding-->
<br><br><br>
<div class="container">
<div class="row">
    <div class="col-md-8 col-md-offset-2" >
            
<form name="inv_form" method="POST" action="addProceedings.php">
<!--<label>Date:</label><input type="datetime-local" name="date" required>-->
<label>Description:</label>
<input type="text" name="description" required>
<label></label><input type="submit" name="submit" value="Submit" <?php if($rec["status"]=="closed") echo "disabled='disabled'"; ?>>
    
</form> 
    <input type="button" onclick="location.href='case_close.php';" value="Case Close" 
       <?php if($rec["status"]=="closed") echo "disabled='disabled'"; ?>
           />
</div>
</div>
</div>
            
            
</div>
        </div></div>
</body>
</html>
