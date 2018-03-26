<?php
require "../db/db.php";
			
			
			$username = @mysqli_real_escape_string($conn,$_POST['username']);
      $password = @mysqli_real_escape_string($conn,$_POST['password']);
      $password = md5($password);
				
			
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
				
			}		
			
			if(isset($_POST['username']) && isset($_POST['password'])){	
				if(!empty($_POST['username']) && !empty($_POST['password'])){
				//create query
				$query = "SELECT username FROM admins WHERE username = '$username' and password = '$password'";
				$result = mysqli_query($conn, $query);
				
				$count = mysqli_num_rows($result);
				if($count == 1){
          session_start();
					$_SESSION['loggedin'] = 'Admin';
					
					echo "<script language = \"javascript\"> window.location = \"../adminpage/index.php\"</script>";
        }
        else{
					echo "<script>
            $(document).ready(function(){
                $('#idspan').text('Please enter correct username and password');
            }
            </script>";
				}
      }
      else{
				echo "<script>
            $(document).ready(function(){
                $('#idspan').text('Please enter your username and password');
            }
            </script>";
			}
		}
		
?>

<!DOCTYPE html>
<html>
  <head>
  <title>ADMIN| Login</title>
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
              <div class="card blue-grey darken-1 z-depth-5">
                <div class="card-content white-text">
                <span class="card-title card col s4 offset-s4 teal darken-1 white-text center z-depth-5">ADMIN</span>
                <div id = "idspan"><span></span></div>
                  <form id="form" action = "" method = "post" >
                  <div class="row">
                    <div class="input-field col s6">
                      <input name = "username" id="first_name" type="text" class="validate">
                      <label for="first_name">Username</label>
                    </div>
                    <div class="input-field col s6">
                      <input name = "password" id="last_name" type="password" class="validate">
                      <label for="last_name">Password</label>
                    </div>
                  </div>
                </div>
                <div class="card-action teal center">
                    <input class="btn" id = "adminlogin_button" type = "submit" value = "Log In"/>
                </div>
                </form>
              </div>
            </div>
          </div>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../scripts/materialize/js/materialize.min.js"></script>
    <script>

      $('#home').click(function(){
        window.location = "../index.php";
        });

    </script>
  </body>
</html>
