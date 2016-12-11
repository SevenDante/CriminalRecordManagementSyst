
        <html>

        <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <style>
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

        .bt{
          position:relative;
          top:30px;
          left:210px;
        }
            
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
        </style>


        <script type="text/javascript">

        //action="addcriminal.php"
        function validForm()
        {
             var inc_date = document.getElementById("arrestDate").value;
            var mydate=new Date(inc_date);
            var today = new Date();
            if (inc_date == "")									
            { 
          
          //something is wrong
          alert('REQUIRED FIELD ERROR: Please enter date in field!');
          return false;
          }
          else if (mydate<today)
          { 
          //something else is wrong
            alert('You cannot enter Arrest date that is before current date');
            return false;
          }
            var number = document.forms["register_form"]["mobile_no"];
            var val = number.value
            if (/^\d{10}$/.test(val)) {
                // value is ok, use it
            } else {
                alert("Invalid mobile number; must be ten digits")
                number.focus()
                return false
            }
        }

        </script>
        </head>
        <body>
        <h2 style="text-align:center">Add Criminal Details</h2>
        <div class="container">
        <form action="addcriminal.php" method="post" name="register_form" id="register_form" enctype="multipart/form-data" onsubmit="return validForm()">
            
        <label>Full name:</label><input type="text" name="name" id="name" required>
        <label>Sex:</label>
        <label>Male</label><input type="radio" name="gender" value="male" checked> 
        <label>Female</label><input type="radio" name="gender" value="female"> 
       

<!--Y--><label>Age:</label><input type="number" name="criminalAge" required>
        
        <label>Address:</label><br>
<!--Y--><label>Area/Locality:</label><input type="text" name="add_area" required><br>
<!--Y--><label>City/Town:</label><input type="text" name="add_city" required><br>
<!--Y--><label>District:</label><input type="text" name="add_dist" required>
<!--Y--><label>State:</label><input type="text" name="add_state" required><br>     
        

        <label>Location of arrest:</label><input type="text" name="locationArrest" required><br>
        
        <br>

        <br><br>
        <input type="file" name="pic" id="pic">
            <input type="submit" value="submit" name="submit">
        <div class="bt">	
            
        </div>

        </form>   
        </div>
        
        </body>
        </html>
