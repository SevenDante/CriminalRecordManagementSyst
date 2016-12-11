<?php 
session_start();
require ('connect.php');
$collection = $db->crimedata;
$user_collection = $db->counters;

if($_POST['submit'])
{
//    $caseid = $_POST['caseid'];
//    $caseid = (int)$caseid;//convert to float

    $row = $collection->findOne(array('caseid'=> $caseid));

    if(is_array($row)){
      echo "CaseID already exist. <a href='complaint-page.php'>Try Again</a>";
    }
//
    else{
//
    $crimetype = $_POST['crimetype'];
        
    //CHANGED
    $petitioner =  array( 'pName' => $_POST['petitionerName'],'pAdd' => $_POST['petitionerAddress'],'pContact' => $_POST['petitionerContact'],'pAge' => $_POST['petitionerAge'],'pGender'=> $_POST['petitionerGender']);






// $mno=$_POST['petitionerContact'];
//    //$message=  $_POST["message"];
//   
//    
//$ch = curl_init();
//$user="im7manish@gmail.com:madhubala";
//$receipientno=$mno;
//$senderID="TEST SMS";
//$msgtxt="hi";
//curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
//$buffer = curl_exec($ch);
//   /*  if(empty ($buffer))
//	{
//          echo " buffer is empty ";
//        }
//	else
//	{
//                echo $buffer; 
// 		echo"message has been sent";
//	}
//
//*/
//	curl_close($ch);






















    //CHANGED
    $victim =  array( 'vName' => $_POST['VictimName'],'vAdd' => $_POST['VictimAddress'],/*'vContact' => $_POST['VictimContact'],*/'vAge' => $_POST['VictimAge'],'vGender'=>$_POST['VictimGender']);
      
    $incidentdate = $_POST['incident_date'];
      
    $reportdate = new MongoDate();
        
//********************AUTO INCREMENT***************//
function getNextSequence($name){
global $user_collection;
$retval = $user_collection->findAndModify(
array('_id' => $name),
array('$inc' => array("seq" => 1)),
null,
array(
"new" => true,
"upsert" => true,
)
);
return $retval['seq'];
}


        
//************************************************//

    $collection->insert(array(
            'caseid'=>getNextSequence("userid"),
            'crime_type'=> $crimetype,
            'petitioner_detail'=>$petitioner,
            'victim_detail'=>$victim,
            'status'=>"open",
            'incident_date'=>$incidentdate,
           'report_date'=>new MongoDate(),
            'inv_officer' => array(
                    'officerid'=> $_SESSION['officerid'],
                    'officerfname'=> $_SESSION['fname'],
                    'officerlname'=> $_SESSION['lname']
            ),
            'proceedings'=>array(array('date'=>$reportdate,'desc'=>'CASE OPENED'))
//            
    ));
    header("Location: user_dashboard.php");
    }
//
}
else
{
    exit();
}
?>
