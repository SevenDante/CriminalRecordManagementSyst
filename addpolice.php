<?php

    require ("connect.php");

     //$img=$db->createCollection("IMG");

    
    $collection = $db->policeuser;
    
    if($_POST["submit"]){
        $images=$db->createCollection("IMG");
                       $im=file_get_contents($_FILES['pic']['tmp_name']);
       
	$res2=$images->insert(array("pic_id"=>$_POST['uname'] ,"image"=>base64_encode($im)));
   
   if($res2)
   {
	echo "Stored img";
    }
        
        
        
        
        $offid = $_POST['officerid'];
        $email = ($_POST['email']);
        $fname = ($_POST['fname']);
        $lname = ($_POST['lname']);
        $pass = ($_POST['pass1']);
        $uname = ($_POST['uname']);
        $gender=$_POST['gender'];       
    
        $address = array('area'=>$_POST['off_add_area'],
                         'city'=>$_POST['off_add_city'],
                         'district'=>$_POST['off_add_dist'],
                         'pin'=>$_POST['off_add_pin'],
                         'state'=>$_POST['off_add_state']
                        );
        
        $gender=$_POST['gender'];
        $join = $_POST['join_date'];
        $post = $_POST['post'];
        $contact = $_POST['off_no'];
        $dob = $_POST['off_dob'];
        
        $pass = md5($pass); //secure password with md5 

        $row = $collection->findOne(array('username'=> $uname));
        
       
        
        
        //VALIDATION : whether user exist or not
        if(is_array($row)){
            echo "User already exist.";
        }
        
        else{
            
        $rec['officerid']= $offid;
        $rec['FName'] = $fname;
        $rec['LName'] = $lname;
        $rec['username'] = $uname;
        $rec['Email'] = $email;
        $rec['password'] = $pass;
        
        
        $rec['gender'] = $gender;
        $rec['join_date'] = $join;
        $rec['post'] = $post;
        $rec['off_no'] = $contact;
        $rec['off_dob'] = $dob;
        $rec['address']= $address;
            


        $collection ->insert($rec);
        
        header("location: login.php");
        }//end if-else
    } 

    else {
    exit();
    }//end outer if-else

?>
