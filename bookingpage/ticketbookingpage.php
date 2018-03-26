<?php
session_start();
if(!isset($_SESSION["user"])){
	header("Location: ../index.php");
}else{
    require "../db/db.php";
    
	if(isset($_POST['flightid']) && isset($_POST['pname']) && isset($_POST['mpesa']) 
		&& isset($_POST['pgender']) && isset($_POST['idnumber']))
		{
		$flightid = $_POST['flightid'];
		$pname = $_POST['pname'];
		$mpesa = $_POST['mpesa'];
		$pgender = $_POST['pgender'];
		$idnumber = $_POST['idnumber'];
		
		require_once('AfricasTalkingGateway.php');
		$username   = "username";
        $apikey     = "your api key here";
		$recipients = "$mpesa";
        $message    = "Hello ".$_SESSION["user"].",\nYou have successfully booked a flight.\nYour booking is associated with Flight Number ".$flightid.".\nFor cancellations kindly email your username and flight id.\n\nWe look forward to have you on board\nKibazi";

		$gateway    = new AfricasTalkingGateway($username, $apikey);

		try 
	{ 
  
		$results = $gateway->sendMessage($recipients, $message);
            
		foreach($results as $result) {
    
		echo " Number: " .$result->number;
		echo " Status: " .$result->status;
		echo " MessageId: " .$result->messageId;
		echo " Cost: "   .$result->cost."\n";
  }
}
		catch ( AfricasTalkingGatewayException $e )
{
		echo "Encountered an error while sending: ".$e->getMessage();
}
		if(!empty($flightid) && !empty($pname) && !empty($mpesa) && !empty($pgender) && !empty($idnumber)){
			
			$sql2 = "SELECT seatavail FROM flights WHERE flightid = '$flightid'";
			$result2 = mysqli_query($conn,$sql2);
			$roww = mysqli_fetch_array($result2);
            
            if($roww){
			
            $sql = "INSERT INTO booked(name,gender,mpesa,idnumber,flightid) VALUES ('$pname','$pgender','$mpesa','$idnumber','$flightid')";
            
            if(mysqli_query($conn,$sql)){
                $sql1 = "UPDATE flights SET seatavail=seatavail-1 WHERE flightid = '$flightid'";
                
                if(mysqli_query($conn,$sql1)){
					
					$sql3 = "SELECT ticketno FROM booked WHERE flightid = '$flightid' AND idnumber = '$idnumber' AND name = '$pname' AND mpesa = '$mpesa'";
					$result = mysqli_query($conn,$sql3);
					$row = mysqli_fetch_array($result);
                    $_SESSION['ticketno'] = $row[0];
                    
                    echo '<script language ="javascript"> window.location = "confirm.html"</script>';
                }
            }
            else{
                echo '<div class="msg">There is some problem connecting to server, Please try again later...</div>'; 
            }
        }
        else{
            echo "<script>
            $(document).ready(function(){
                $('#idspan').text('No seats available');
            }
            </script>";
        }
    }
    else{
        echo "<script>
            $(document).ready(function(){
                $('#idspan').text('Please fill all the fields');
            }
            </script>";
    }
}
}
?>



<!DOCTYPE html>
<html>
  <head>
  <title>Kibazi| Booking</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<style>
    .container{
        margin-top: 5%;
    }

    .card-inner-p{
        text-align: center;
    }
    
    *::-webkit-scrollbar{
        width: 10px;
    }

    *::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        border-radius: 10px;
    }

    *::-webkit-scrollbar-thumb{
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    }
</style>

</head>

  <body>
      
  <div class="container">
    <span class="new badge light-green" data-badge-caption="Welcome <?php echo $_SESSION["user"]; ?>"></span>
    </div><br>
    <div class="container">
        <form class="col s12" id="bookform" action = "ticketbookingpage.php" method="post">
            <div class="row">
                <div class="card-action center z-depth-4">
                    <div class="card-panel cyan white-text">
                        <h5 class="card-inner-p">Flight Details</h5>
                        <!-- make toast -->
                        <div id = "idspan"><span></span></div>
                    </div>
                </div>
                <div class="input-field col s4">
                    <input name="flightid" id="flightid" type="text" class="validate">
                    <label for="flightid">Flight ID</label>
                </div>
                <div class="input-field col s4">
                    <label>Source</label>
                    <input value=" " name="source" id="source" type="text" disabled = "disabled">                       
                </div>
                <div class="input-field col s4">
                        <input value=" " name="destination" id="destination" type="text" disabled = "disabled">
                        <label for="destination">Destination</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " name="date" id="date" type="text" disabled = "disabled">
                        <label for="date">Date</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " type = "text" id = "deptime"  name = "deptime" disabled = "disabled">
                        <label for="deptime">Depature Time</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " type = "text" id = "arrtime"  name = "arrtime" disabled = "disabled">
                        <label for="arrtime">Arrival Time</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " type = "text" id = "class"  name = "class" disabled = "disabled">
                        <label for="class">Class</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " type = "text" id = "seatavail"  name = "seatavail" disabled = "disabled">
                        <label for="seatavail">Seats Avail</label>
                </div>
                <div class="input-field col s4">
                    <label for="price">Price</label>
                    <input value=" " type = "text" id = "price"  name = "price" disabled = "disabled">
                </div>
                
            </div>

            <div class="row">
                    <div class="card-action center z-depth-4">
                        <div class="card-panel cyan white-text">
                            <h5 class="card-inner-p">Passenger Details</h5>
                        </div>
                    </div>
                    <div class="input-field col s4">
                        <input name="pname" id="pname" type="text" required="true">
                        <label for="pname">Full Name</label>
                    </div>

                    <div class="input-field col s4">
                            <input type = "text" id = "idnumber"  name = "idnumber" required="true">
                            <label for="idnumber">ID/Passport Number</label>
                    </div>

                    <div class="input-field col s4">
                        <input type = "text" id = "mpesa"  name = "mpesa" required="true">
                        <label for="mpesa">Phone Number</label>
                    </div>

                    <div class="col s12">
                        <br>
                        <select id="pgender" name="pgender">
                            <option disabled selected>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    
                <br>    
                </div>
                
                <div class="row">
                        <input class="btn pulse waves-effect left" id = "bookbut" type = "submit" value = "BOOK">
                        <input class="btn red waves-effect right" id = "cancelbut" type = "button" value = "CANCEL">

                </div>
        </form>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <script>

        $(document).ready(function(){

            $('select').material_select();
	
            $('#cancelbut').click(function(){
                window.location = "../loggedinpage/loggedin.php";
            });

            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: false // Close upon selecting a date,
            });

            $('.timepicker').pickatime({
                default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
                twelvehour: false, // Use AM/PM or 24-hour format
                donetext: 'OK', // text for done-button
                cleartext: 'Clear', // text for clear-button
                canceltext: 'Cancel', // Text for cancel-button
                autoclose: false, // automatic close timepicker
                ampmclickable: true, // make AM PM clickable
                aftershow: function(){} //Function for after opening timepicker
            });
            
            
            $('#flightid').keyup(function(){
                var flightid = $('#flightid').val();
                
                if(flightid == ''){
                    $('#idspan').text('Please enter a valid ID');
                                $('#date').attr("value",'');
                                $('#source').attr("value",'');
                                $('#destination').attr("value",'');
                                $('#deptime').attr("value",'');
                                $('#arrtime').attr("value",'');
                                $('#class').attr("value",'');
                                $('#price').attr("value",'');
                                $('#seatavail').attr("value",'');
                                $('#idspan').text('Please enter a valid ID');
                
                }else{
                    
                    $.ajax({
                        url : 'autodetails.php',
                        type : 'POST',
                        data : 'flightid=' +flightid,						 
                        success : function(data){
                                
                                
                                if(data == 'null'){
                                
                                $('#source').attr("value",'');
                                $('#destination').attr("value",'');
                                $('#deptime').attr("value",'');
                                $('#arrtime').attr("value",'');
                                $('#class').attr("value",'');
                                $('#price').attr("value",'');
                                $('#date').attr("value",'');
                                $('#seatavail').attr("value",'');
                                $('#idspan').text('Please enter a valid ID');
                                
                                }
                                else{
                                    
                                    var fdetails = $.parseJSON(data);	
                                    $('#source').attr("value",fdetails.source);
                                    $('#destination').attr("value",fdetails.destination);
                                    $('#deptime').attr("value",fdetails.deptime);
                                    $('#arrtime').attr("value",fdetails.arrtime);
                                    $('#class').attr("value",fdetails.class);
                                    $('#price').attr("value",fdetails.price);
                                    $('#date').attr("value",fdetails.date);
                                    $('#seatavail').attr("value",fdetails.seatavail);
                                    $('#idspan').text('');
                                }
                            }
                        });
                    }
            });
        });


    </script>
  </body>
</html>
