<?php
session_start();
if(isset($_SESSION["user"])){
	header("Location: loggedinpage/loggedin.php");
}else{


echo'
<!DOCTYPE html>
<html>
  <head>
  <title>Kibazi| Login</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="scripts/materialize/css/materialize.min.css"  media="screen,projection"/>
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
        <div class="row">
            <div class="col s8 offset-s2">
              <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                <span class="card-title card col s4 offset-s4 teal darken-1 white-text center">Log In</span>
                  <div id="form">
                  <form action = "login.php" method = "post" >
                  <div class="row">
                    <div class="input-field col s6">
                      <input name = "username" id="first_name" type="text" class="validate" required="true">
                      <label for="first_name">Username</label>
                    </div>
                    <div class="input-field col s6">
                      <input name = "password" id="last_name" type="password" class="validate" required="true">
                      <label for="last_name">Password</label>
                    </div>
                  </div>
                  <input class="btn" id = "login_button" type = "submit" value = "Log In"/>
                </form>
                </div>
                </div>
                <div class="card-action">
                    <input class="btn" id = "signup_button" type = "button" value = "Sign Up"/>
                    <input class="btn right" id = "admin_button" type = "button" value = "Admin LogIn"/>
                </div>
              </div>
            </div>
          </div>
    </div>
    ';
 }?> 
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="scripts/materialize/js/materialize.min.js"></script>
    <script>
      $(document).ready(function(){
	
        $('#signup_button').click(function(){
            //sign up page
            window.location = 'signuppage/signup.php';
        });
        
        $('#admin_button').click(function(){
            //admin login page
            window.location = 'admin/index.php';
        });
      });

    </script>
  </body>
</html>