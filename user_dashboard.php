<?php
session_start();
require ('connect.php');
?>

<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<style>
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
<body>
<?php
 if($_SESSION['user_name']){
     
    
?>
<nav class="navbar navbar-default navbar-static-top"> 

<div class="container">
    Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname']?> 
    <button type="button" class="btn btn-default navbar-btn navbar-right"><a href="logout.php">Logout</a></button>
    
</div>
</nav>

<div class="row container">    
<div class="container col-md-3">
    
    <nav class="nav-sidebar">
                <ul class="nav">
                    <li><a href="newsearch.php">Search a criminal</a></li>
                </ul>
            </nav>
    
</div>
<!--    col-md-offset-2-->
<div class="container  col-md-9">
<ul class="nav nav-pills nav-justified">
  <li class="active"><a data-toggle="pill" href="#user-details">Profile</a></li>
  <li><a data-toggle="pill" href="#usercases">Cases</a></li>
  <li><a data-toggle="pill" href="#register-case">Register a case</a></li>
</ul>    
    
<div class="tab-content">
<br>
<div id="user-details" class="tab-pane active">
<div class='container'>

    
<?php
$collection = $db->policeuser;
$row = $collection->findOne(array('username'=> $_SESSION['user_name']));
     $img=$db->IMG;
     $output=$img->findOne(array('pic_id'=>$_SESSION['user_name']));
?>

     <div class="row">
         <div class="col-md-3 col-lg-3 " align="center"> 
             
             <?php
     if($output)
     {
    echo '<img height="200px" src="data:image/jpg;base64,'.$output['image'].'" class="img-circle img-responsive" />';
     }
     ?>
             
             
<!--             <img alt="User Pic" src="data:image/jpg;base64,'.$output['image'].'" class="img-circle img-responsive"> -->
         </div>
         
         <div class=" col-md-9 col-lg-9 "> 
                  <table>
                    <tbody>
                      <tr>
                        <td>OfficerID:</td>
                        <td><?php echo $row[officerid];?></td>
                      </tr>
                      <tr>
                        <td>First Name:</td>
                        <td><?php echo $row[FName];?></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td><?php echo $row[LName];?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?php echo $row[Email];?>"><?php echo $row[Email];?></a></td>
                      </tr>
                      <tr>
                        <td>Contact No:</td>
                        <td><?php echo $row[off_no];?></td>
                      </tr>
                      <tr>
                        <td>Sex:</td>
                        <td><?php echo $row[gender];?></td>
                      </tr>
                      <tr>
                        <td>Join Date:</td>
                        <td><?php echo $row[join_date];?></td>
                      </tr>
<!--
                      <tr>
                        <td>DOB:</td>
                        <td><?php echo $row[off_dob];?></td>
                      </tr>
-->
                    <tr>
                        <td>Post:</td>
                        <td><?php echo $row[post];?></td>
                      </tr>
                    <tr><td></td></tr>
                    <tr><td>Address</td></tr>    
                    <tr>
                        <td>Area:</td>
                        <td><?php echo $row[address][area];?></td>
                        </tr>
                        <tr>
                        <td>City:</td>
                        <td><?php echo $row[address][city];?></td>
                        </tr>
                        <tr>
                        <td>District:</td>
                        <td><?php echo $row[address][district];?></td>
                        </tr>
                        <tr>
                        <td>State:</td>
                        <td><?php echo $row[address][state];?></td>
                        </tr>
                        <tr>
<!--
                        <td>PIN:</td>
                        <td><?php echo $row[address][pin];?></td>
                        </tr>
-->
                    
                    </tbody>
                  </table>
         </div>
    </div>
    </div>
    </div>



<div id="register-case" class="tab-pane">
<div class='container'>
    <a href="complaint-page.php">Register a complaint.</a><br>  
</div>
</div>


<div id="usercases" class="tab-pane">
<div class='container'>

<?php
$officecase = $db->crimedata;
$rec = $officecase->find(array('inv_officer.officerid'=> $_SESSION['officerid']));

if($rec->count()==0){
    echo "You have no cases.";
}else{
   
    echo "<div class='row'>";
    echo "<div class='container'>";
    echo "<div class='col-md-8'>";
    echo "<h4>YOUR CASES:</h4>";
    echo "<div class='table-responsive'>";
    echo "<table id='mycasetable' class='table table-bordred table-striped'>";
    echo "<thead>";           
    echo "<table id='mytable' class='table table-bordred table-striped'>";
    echo "<thead>";
    echo "<th>Case ID</th><th>URL</th><th>STATUS</th></thead><tbody>"; 
    
    foreach($rec as $myrec){
    $temp = $myrec['caseid'];
             
    echo "<tr>";
    echo "<td>".$myrec['caseid']."</td>";
    echo "<td><a href='case-detail.php?case=$temp'>Link</a>";
    echo "</td>";
    echo "<td>".$myrec['status']."</td>";    
    
    echo "</tr>";
    
    }
    echo "</tbody></table>";              
    echo "</table></div></div></div></div>";
}//end if else
?>     
         
</div> <!--endcontainer-->
</div><!--end tabpane-->

</div><!--end tabcontent-->
</div><!--end container-->
</div><!--end row-->
<?php
}//end outer if 
else{
    echo "Please Log in";
}  
?>
</body>
</html>
