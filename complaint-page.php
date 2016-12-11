        <html>
        <head>
            <title>Register a Complaint</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
            <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <script>
            $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }  

        function validateform()  
        {  
            
            var inc_date = document.getElementById("incident_date").value;
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
            alert('You cannot enter a incident date that is after report date');
            return false;
          }
            
            var number = document.forms["complaint-form"]["petitionerContact"];
            var val = number.value
            if (/^\d{10}$/.test(val)) {
                // value is ok, use it
            } else {
                alert("Invalid petitioner number; must be ten digits");
                number.focus();
                return false;
            }




            var vnumber = document.forms["complaint-form"]["VictimContact"];
            var val = vnumber.value
            if (/^\d{10}$/.test(val)) {
                // value is ok, use it
            } else {
                alert("Invalid victim number; must be ten digits");
                number.focus();
                return false;
            }
            return true;




        }
            </script>

            <style>


            .wizard {
            margin: 20px auto;
            background: #fff;
        }

            .wizard .nav-tabs {
                position: relative;
                margin: 40px auto;
                margin-bottom: 0;
                border-bottom-color: #e0e0e0;
            }

            .wizard > div.wizard-inner {
                position: relative;
            }

        .connecting-line {
            height: 2px;
            background: #e0e0e0;
            position: absolute;
            width: 80%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 50%;
            z-index: 1;
        }

        .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
            color: #555555;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 70px;
            height: 70px;
            line-height: 70px;
            display: inline-block;
            border-radius: 100px;
            background: #fff;
            border: 2px solid #e0e0e0;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 25px;
        }
        span.round-tab i{
            color:#555555;
        }
        .wizard li.active span.round-tab {
            background: #fff;
            border: 2px solid #5bc0de;

        }
        .wizard li.active span.round-tab i{
            color: #5bc0de;
        }

        span.round-tab:hover {
            color: #333;
            border: 2px solid #333;
        }

        .wizard .nav-tabs > li {
            width: 25%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #5bc0de;
            transition: 0.1s ease-in-out;
        }

        .wizard li.active:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #5bc0de;
        }

        .wizard .nav-tabs > li a {
            width: 70px;
            height: 70px;
            margin: 20px auto;
            border-radius: 100%;
            padding: 0;
        }

            .wizard .nav-tabs > li a:hover {
                background: transparent;
            }

        .wizard .tab-pane {
            position: relative;
            padding-top: 50px;
        }

        .wizard h3 {
            margin-top: 0;
        }

        @media( max-width : 585px ) {

            .wizard {
                width: 90%;
                height: auto !important;
            }

            span.round-tab {
                font-size: 16px;
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard .nav-tabs > li a {
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard li.active:after {
                content: " ";
                position: absolute;
                left: 35%;
            }
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
        </head>

        <body>
        <div class="container">
            <h2>Register Complaint.</h2>
            <p>(All fields are compulsory)</p>

 
                    <form role="form" name="complaint-form" method="POST" action="addComplaint.php" onsubmit="return validateform()">
 
        <!--                            -->
<!--        <label>case-id:</label><input type="number" name="caseid"><br><br>                       -->
        <label>Date of Incident:</label><input type="date" name="incident_date" id="incident_date" required><br>
<!--        <label>Date of Report:</label><input type="datetime-local" name="report_date" required><br>   -->
        <label>Type:</label><br /><br>
        <label></label><input type="checkbox" name="crimetype[]" value="Theft">theft<br />
        <label></label><input type="checkbox" name="crimetype[]" value="Kidnapping">kidnapping<br />
        <label></label><input type="checkbox" name="crimetype[]" value="Drug trafficking">drug_trafficking<br />
        <label></label><input type="checkbox" name="crimetype[]" value="Money laundering">money_laundering<br />
        <label></label><input type="checkbox" name="crimetype[]" value="Murder">murder<br />
        <label></label><input type="checkbox" name="crimetype[]" value="Fraud">fraud<br />
        <label></label><input type="checkbox" name="crimetype[]" value="Terrorism">terrorism<br />
        <!--                            -->

     
        <!--                        -->
        Petitioner's Details:<br />
        <label>Petitioner's Name:</label><input type="text" name="petitionerName" required><br>
        <label>Petitioner's Address:</label><input type="text" name="petitionerAddress" required><br>
        <label>Petitioner's Contact No:</label><input type="number" name="petitionerContact" required><br>
<!--Y--><label>Petitioner's Age:</label><input type="number" name="petitionerAge" required><br>      
        <label>Petitioner's Gender:</label>
<!--Y--><label>Male </label><input type="radio" name="petitionerGender" value="male" checked><br>
<!--Y--><label>Female </label><input type="radio" name="petitionerGender" value="female">
        <!--                        -->
<br><br><br><br>
        <!--                        -->
        Victim(s) Details:<br />
        <label>Victim's Name:</label><input type="text" name="VictimName" required><br>
        <label>Victim's Address:</label><input type="text" name="VictimAddress" required><br>
<!--Y--><label>Victim's Age:</label><input type="number" name="VictimAge" required><br>
<!--Y--><label>Victim's Gender:</label><br>
<!--Y--><label>Male </label><input type="radio" name="VictimGender" value="male" checked>
<!--Y--> <label>Female </label><input type="radio" name="VictimGender" value="female">
        <!--                        -->
 <br><br><br><br>            
                                <input type="submit" name="submit" value="Submit">
                          
                           
                        
                    </form>
                </div>
          
          
        


        </body>
        </html>