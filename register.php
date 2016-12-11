        <html>
        <head>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            
        <script type="text/javascript">       
            function valid_form(){
                var x = document.forms["register_form"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                alert("Not a valid e-mail address");
                return false;
            }
                var fname = document.getElementById("fname").value.trim();
                var lname = document.getElementById("lname").value.trim();
                var uname = document.getElementById("uname").value.trim();
                var pass1 = document.getElementById("pass1").value;
                var pass2 = document.getElementById("pass2").value;

                if (fname > 31 && (fname < 65 || fname > 90) &&
                  (fname < 97 || fname > 122)) {
                  alert("Enter letters only in first name.");
                  return false;
               }

                if (lname > 31 && (lname < 65 || lname > 90) &&
                (lname < 97 || lname > 122)) {
                alert("Enter letters only in last name.");
                return false;
               }

                if(fname.length == 0 || lname.length == 0 || uname.length == 0){
                   alert("First,Last and User name should not be empty.") ;
                    return false;
                }

                if(pass1.length < 5){
                    alert("Password should be greater than 5 char");
                    return false;
                    }

                if(pass1 != pass2){
                    alert("Password doesn't match.");
                    return false;
                }
                
                
                var inc_date = document.getElementById("join_date").value;
            var mydate=new Date(inc_date);
            var today = new Date();
            if (inc_date == "")									
            { 
          
          //something is wrong
          alert('REQUIRED FIELD ERROR: Please enter date in field!');
          return false;
          }
          else if (mydate>today)
          { 
          //something else is wrong
            alert('You cannot enter a join date that is after today');
            return false;
          }

                return true;


            }


        </script>


        <!--submission.html-->
        </head>
        <body>

        <div class="container">
          <div class="span3">
            <h2>Sign Up</h2>
            <form action="addpolice.php" method="POST" name="register_form" id="register_form" onsubmit="return valid_form()" enctype="multipart/form-data">
            <label>OfficerID</label>
            <input type="text" name="officerid" id="officerid" class="span3" required/>  
            <br>
            <label>First Name</label>
            <input type="text" name="fname" id="fname" class="span3"  required/>
            <br>
            <label>Last Name</label>
            <input type="text" name="lname" id="lname" class="span3" required/>
      <br>  <label>Email Address</label>
            <input type="email" name="email" id="email" class="span3" required/>
       <br> <label>Username</label>
            <input type="text" name="uname" id="uname" class="span3" required/>
       <br> <label>Password</label>
            <input type="password" name="pass1" id="pass1" class="span3" required/>
       <br> <label>Confirm Password</label>
            <input type="password" name="pass2" id="pass2" class="span3" required/>
            <h4></h4>
       <br>     
            <label>Sex:</label>
            Male<input type="radio" name="gender" value="male" checked> 
            Female<input type="radio" name="gender" value="female"> 
       <br> <label>Joined On:</label>
            <input type="date" name="join_date" id="join_date" class="span3" required/>
       <br> <label>Post/Designation:</label>
            <select name="post">
  <option value="Inspector">Inspector</option>
  <option value="Sub Inpector">Sub Inpector</option>
  <option value="Superintendent of Police">Superintendent of Police</option>
  <option value="Assistant Commissioner of Police">Assistant Commissioner of Police</option>
<option value=" Deputy Superintendent of Police">Deputy Superintendent of Police</option>

</select>
       <br> <label>Contact no:</label>
            <input type="number" name="off_no" id="off_no" class="span3" required/>
<!--       <br> <label>DOB:</label>-->
<!--            <input type="datetime-local" name="off_dob" id="off_dob" class="span3" required/>-->
            <br>
       <br>     <label>Address:</label>
            <label>Area/Locality:</label><input type="text" name="off_add_area" required><br>
            <label>City/Town:</label><input type="text" name="off_add_city" required><br>
            <label>District:</label><input type="text" name="off_add_dist" required>
<!--            <label>PIN:</label><input type="number" name="off_add_pin" required>-->
            <label>State:</label><input type="text" name="off_add_state" required><br>
                
               <input type="file" name="pic" id="pic">
            
                

            <input type="submit" value="Submit" class="btn btn-primary pull-right" name="submit">
                
                
                
                
            </form></div></div>
        </body>    
        </html>