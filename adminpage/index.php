<?php
session_start();
if(!isset($_SESSION['loggedin'])){
	header("Location: ../admin/index.php");
}else{
    require "../db/db.php";
    
	if(isset($_POST['flightid']) && isset($_POST['pname']) && isset($_POST['mpesa']) && isset($_POST['pgender']) && isset($_POST['idnumber'])){
		$flightid = $_POST['flightid'];
		$pname = $_POST['pname'];
		$mpesa = $_POST['mpesa'];
		$pgender = $_POST['pgender'];
		$idnumber = $_POST['idnumber'];
		if(!empty($flightid) && !empty($pname) && !empty($mpesa) && !empty($pgender) && !empty($idnumber)){
			
			$sql2 = "SELECT seatavail FROM flights WHERE flightid = '$flightid'";
			$result2 = mysqli_query($conn,$sql2);
			$roww = mysqli_fetch_array($result2,mysqli_num);
            
            if($roww){
			
            $sql = "INSERT INTO booked(name,gender,age,mpesa,flightid) VALUES ('$pname','$pfa','$page','$pgender','$flightid')";
            
            if(mysqli_query($conn,$sql)){
                $sql1 = "UPDATE flights SET seatavail=seatavail-1 WHERE flightid = '$flightid'";
                
                if(mysqli_query($conn,$sql1)){
					
					$sql3 = "SELECT ticketno FROM booked WHERE flightid = '$flightid' AND father = '$pfather' AND name = '$pname' AND age = '$page'";
					$result = mysqli_query($conn,$sql3);
					$row = mysqli_fetch_array($result,MYSQLI_NUM);
                    $_SESSION['ticketno'] = $row[0];
                    
                    echo '<script language ="javascript"> window.location = "confirm.html"</script>';
                }
            }
            else{
                echo '<div class="msg">There is some problem connecting to server, Please try again later...</div>'; 
            }
        }
        else{
            echo '<div class="msg">Seats not available</div>';
        }
    }
    else{
        echo '<div class="msg">Please fillup all the details</div>';
    }
}
}
?>



<!DOCTYPE html>
<html>
  <head>
  <title>ADMIN| Dashboard</title>
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
    <span class="new badge yellow" data-badge-caption="<?php echo $_SESSION['loggedin']; ?>"></span>
    </div><br>
    <div class="container">
        <form class="col s12">
            <div class="row card-panel hoverable">
                <div class="card-action center z-depth-4">
                    <div class="card-panel teal darken-1 ">
                        <h5 class="teal darken-1 white-text">Edit Flight Details</h5>
                        <!-- make toast -->
                        <div id = "idspan"><span></span></div>
                    </div>
                </div>
                <div class="input-field col s4">
                    <input name="flightid" id="flightid" type="text" class="validate">
                    <label for="flightid">Flight ID</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " name="source" id="source" type="text" class="validate">
                        <label for="source">Source</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " name="destination" id="destination" type="text" class="validate">
                        <label for="destination">Destination</label>
                </div>
                <div class="input-field col s4">
                    <input value=" " name="date" class="datepicker" id="date" type="text" class="validate">
                    <label for="date">Date</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " name="deptime" type = "text" id = "deptime" class="validate timepicker">
                        <label for="deptime">Depature Time</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " name="arrtime" type = "text" id = "arrtime" class="validate timepicker">
                        <label for="arrtime">Arrival Time</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " name="class" type = "text" id = "class" class="validate">
                        <label for="class">Class</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " type = "text" id = "seatavail" min="0"  name = "seatavail" class="validate">
                        <label for="seatavail">Seats Avail</label>
                </div>
                <div class="input-field col s4">
                        <input value=" " type = "text" id = "price"  name = "price" class="validate">
                        <label for="price">Price</label>
                        <span id = "msgSpan"></span>
                </div>
            </div>
            <div class="row center">
            <div class = "third"><span id = "msgSpan"></span></div>
                <div class="col s3">
                    <input class="btn z-depth-4" id = "addbut" type = "button" value = "Add"/>
                </div>
                <div class="col s3">
                    <input class="btn z-depth-4" id = "deletebut" type = "button" value = "Delete"/>
                </div>
                <div class="col s3">
                    <input class="btn z-depth-4" id = "updatebut" type = "button" value = "Update"/>
                </div>
                <div class="col s3">
                    <input class="btn z-depth-4" id = "homebut" type = "button" value = "HOME"/>
                </div>
            </div>
        </form>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <script>

        $(document).ready(function(){

            $('#homebut').click(function(){
                window.location = "../index.php";
            });

            $('select').material_select('destroy');

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


	
            $('#addbut').click(function(){
                var flightid = $('#flightid').val();
                var date = $('#date').val();
                var  source = $('#source').val();
                var  destination = $('#destination').val();
                var deptime = $('#deptime').val();
                var arrtime = $('#arrtime').val();
                var clas = $('#class').val();
                var  price = $('#price').val();
                var seatavail = $('#seatavail').val();
                
                if(flightid == '' || date == '' || source == '' || destination == '' || deptime == '' || arrtime == '' || clas == '' || price == '' || seatavail == ''){
                    $('#msgSpan').text("Please enter all fields");
                }
                else{
                    
                    $.ajax({
                        url : 'add.php',
                        type : 'POST',
                        data : {flightid : flightid,
                                date : date,
                                source : source,
                                destination : destination,
                                deptime : deptime,
                                arrtime : arrtime,
                                clas : clas,
                                price : price,
                                seatavail : seatavail
                            }, 
                            success : function(data){
                                $('#msgSpan').html(data);
                            }
                        });
                    }
                });
            
            $('#updatebut').click(function(){
                var flightid = $('#flightid').val();
                var date = $('#date').val();
                var source = $('#source').val();
                var destination = $('#destination').val();
                var deptime = $('#deptime').val();
                var arrtime = $('#arrtime').val();
                var clas = $('#class').val();
                var price = $('#price').val();
                var seatavail = $('#seatavail').val();
                
                if(flightid == '' || date == '' || source == '' || destination == '' || deptime == '' || arrtime == '' || clas == '' || price == '' || seatavail == ''){
                    $('#msgSpan').text("Please enter all fields");
                }else{
                    
                    $.ajax({
                        url : 'update.php',
                        type : 'POST',
                        data : {flightid : flightid,
                                date : date,
                                source : source,
                                destination : destination,
                                deptime : deptime,
                                arrtime : arrtime,
                                clas : clas,
                                price : price,
                                seatavail : seatavail}, 
                        success : function(data){
                                $('#msgSpan').html(data);
                }});
                }
            });
            
            $('#deletebut').click(function(){
                var flightid = $('#flightid').val();
                var date = $('#date').val();
                var source = $('#source').val();
                var destination = $('#destination').val();
                var deptime = $('#deptime').val();
                var arrtime = $('#arrtime').val();
                var clas = $('#class').val();
                var price = $('#price').val();
                var seatavail = $('#seatavail').val();
                
                if(flightid == '' || date == '' || source == '' || destination == '' || deptime == '' || arrtime == '' || clas == '' || price == '' || seatavail == ''){
                    $('#msgSpan').text("Please enter all fields");
                }else{
                    
                    $.ajax({
                        url : 'delete.php',
                        type : 'POST',
                        data : {flightid : flightid,
                                date : date,
                                source : source,
                                destination : destination,
                                deptime : deptime,
                                arrtime : arrtime,
                                clas : clas,
                                price : price,
                                seatavail : seatavail
                            }, 
                        success : function(data){
                                $('#msgSpan').html(data);
                }});
                }
            });
            
            $('#homebut').click(function(){
                window.location = "../index.php";
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
                
                }
                else{
                    
                    $.ajax({
                        url : 'autodetails.php',
                        type : 'POST',
                        data : 'flightid=' +flightid,						 
                        success : function(data){
                                
                                
                                if(data == 'null'){
                                
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
                                
                                var fdetails = $.parseJSON(data);	
                                $('#date').attr("value",fdetails.date);
                                $('#source').attr("value",fdetails.source);
                                $('#destination').attr("value",fdetails.destination);
                                $('#deptime').attr("value",fdetails.deptime);
                                $('#arrtime').attr("value",fdetails.arrtime);
                                $('#class').attr("value",fdetails.class);
                                $('#price').attr("value",fdetails.price);
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
