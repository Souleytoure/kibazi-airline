<?php
require "../db/db.php";

	if(isset($_POST['ticketno'])){
		$ticketno = $_POST['ticketno'];
		
		if(!empty($ticketno)){
			
			$sql = "SELECT flightid FROM booked WHERE ticketno = $ticketno";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_num_rows($result);
			if($row != 0){
                $_SESSION['ticketno'] = $ticketno;
			echo '<script language="javascript">window.location="../bookingpage/confirm.html"</script>';
            }
            else{
                echo '<script language="javascript">document.getElementById("idspan").textContent="Provide valid ticket ID";</script>';
            }
        }
        else{
            echo '<script language="javascript">Materialize.toast("Please enter a ticket number!", 3000, "rounded")</script>';
        }
    }

    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: ../index.php");
    }
    else{
    echo'


<!DOCTYPE html>
<html>
  <head>
  <title>Kibazi| Print</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
    .container{
        margin-top: 10%;
    }

    .input-field input[type=text]{
        border-top: 2px solid #808080;
        border-right: 2px solid #808080;
        box-shadow: 0 1px 0 0 #808080;
    }

    .input-field input[type=text]:focus{
     border-top: 2px solid #26a69a;
     border-right: 2px solid #26a69a;
     box-shadow: 0 1px 0 0 #000;
     }

     .input-field input[type=text].invalid {
     border-top: 2px solid red;
     border-right: 2px solid red;
     box-shadow: 0 1px 0 0 red;
     }

     .input-field input[type=text].valid {
     border-top: 2px solid #4CAF50;
     border-right: 2px solid #4CAF50;
     box-shadow: 0 1px 0 0 #4CAF50;
     }

</style>  
</head>

  <body>
  <div class="container">
  <span class="new badge light-green" data-badge-caption="Welcome '.$_SESSION["user"].'"></span>
  </div>
    <div class="container">
        <form class="col s6" action = "printticket.php" method="post">
            <div class="row card-panel z-depth-1 z-depth-5">
                <div class="card-action center z-depth-2">
                    <div class="card-panel cyan white-text">
                        <h5 class="card-inner-p">Flight Details</h5>
                        <!-- make toast -->
                        <div id = "idspan"><span></span></div>
                    </div>
                </div>
                <div class="input-field col s12 centre">
                    <input name="ticketno" id="ticketno" type="text" class="validate" required="true">
                    <label for="flightid">Ticket Number: </label>
                </div>            
                <div class="row col s12 ">
                        <input class="btn waves-effect left" id = "okbut" type = "submit" value = "OK">
                        <input class="btn red waves-effect right" id = "cancelbut" type = "button" value = "CANCEL">

                </div>
        </form>
    </div>
    ';
 }?> 
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
	
            $('#cancelbut').click(function(){
                window.location = "../loggedinpage/loggedin.php";
            });
                
        });
    </script>

  </body>
</html>