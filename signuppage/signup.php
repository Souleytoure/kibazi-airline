<?php
include_once '../db/db.php';
		
		if(!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['contact']) && !empty($_POST['email'])){		
		
			$name = $_POST['name'];
			$username = $_POST['username'];
      $password = $_POST['password'];
			$contact = $_POST['contact'];
      $email = $_POST['email'];

      $password = md5($password);

		
			//create query
			$query = "INSERT INTO users(username, password, name, email, contact) VALUES ('$username', '$password', '$name', '$email', '$contact')";
			
			if(mysqli_query($conn, $query)){
        session_start();
        $_SESSION["contact"] = $contact;
        header("location:../index.php");
			}else{
				//error page can fit here
        echo '<div class="container center"><div class="row"><div class="col s8 offset-s2"><div class="card blue-grey white-text">Error</div></div></div></div>';
        
			}
		}
		
?>

<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../scripts/materialize/css/materialize.min.css"  media="screen,projection"/>
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
                <div class="card-content">
                  <span class="card-title card col s4 offset-s4 teal darken-1 white-text center">Sign Up</span>
                  <div id="form">
                  <form action = "signup.php" method = "post" >
                  <div class="row white-text">
                    <div class="input-field col s6">
                      <input name = "name" id="first_name" type="text" class="validate" required="true">
                      <label for="first_name">Name</label>
                    </div>
                    <div class="input-field col s6">
                      <input name = "username" id="last_name" type="text" class="validate" required="true">
                      <label for="last_name">Username</label>
                    </div>
                    <div class="input-field col s6">
                      <input name = "password" id="last_name" type="password" class="validate" required="true" min="5">
                      <label for="last_name">Password</label>
                    </div>
                    <div class="input-field col s6">
                      <input name = "confirm_password" id="last_name" type="password" class="validate" required="true" min="5">
                      <label for="last_name">Confirm Password</label>
                    </div>
                    <div class="input-field col s6">
                      <input name = "contact" id="last_name" type="text" class="validate" required="true">
                      <label for="last_name">Contact Number</label>
                    </div>
                    <div class="input-field col s6">
                      <input name = "email" id="last_name" type="email" class="validate" required="true">
                      <label for="last_name">Email</label>
                    </div>
                  </div>
                  <div class="card-action center">
                        <input class="btn" id = "signup_button" type = "submit" value = "Sign Up"/>
                  </div>
                </form>
                </div>
                </div>
              </div>
            </div>
          </div>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../scripts/materialize/js/materialize.min.js"></script>
    <script type = "text/javascript" src = "signuppage.js"></script> 
  </body>
</html>
