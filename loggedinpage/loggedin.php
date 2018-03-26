<?php
session_start();
if(!isset($_SESSION["user"])){
	header("Location: ../index.php");
}
else{
echo'


<!DOCTYPE html>
<html>
  <head>
  <title>Kibazi| Home</title>
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
</style>  
</head>

  <body>
  
    <div class="container">
    <span class="new badge light-green" data-badge-caption="Welcome '.$_SESSION["user"].'"></span>
    </div>
    <br>
    <div class="container">
        <div class="row">
        <div class="col s12">
            <input class="btn pulse cyan leftz-depth-1" id = "print_button" type = "button" value = "Print Booked Tickets"/>        
            <input class="btn pulse cyan right z-depth-1" 
			id = "logout_button" type = "button" value = "Log out"/>
        </div>
        </div>
    </div>
   
    <div class="container">
        <div class="row">
            <div class="col s6">
                <div class="card">
                    <div class="card-image">
                        <img src="sign.jpg">
                    </div>   
            <div class="card-action light-blue waves-effect" style="width:100%; text-align:center">
                <input class="white-text btn" id = "search_button" type = "button" value = "Search Flights"/>
            </div>
        </div>
    </div>
    <div class="col s6">
        <div class="card">
            <div class="card-image">
                <img src="sign.jpg">
            </div>
                <div class="card-action light-blue waves-effect" style="width:100%; text-align:center">
                        <input class="white-text btn" id = "book_button" type = "button" value = "Book Tickets"/>
                </div>
            </div>
        </div>
    </div>
</div>
';
 }?> 
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

    <script>

        $(document).ready(function(){
            $('#search_button').click(function(){
                window.location = '../searchflightpage/searchflight.php';
                
            });
            
            $('#book_button').click(function(){
                window.location = '../bookingpage/ticketbookingpage.php';
                
            });
            
            $('#print_button').click(function(){
                
                window.location = '../printticket/printticket.php';
                
            });
            
            $('#logout_button').click(function(){
                var check = confirm('Are you sure you want to log out?');
                if(check == true){
                window.location = '../logout.php';
                }
            });
        });
    
    </script>
  </body>
</html>
