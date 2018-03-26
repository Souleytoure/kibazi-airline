<?php
	//create connection
	require "db/db.php";
	$username = mysqli_real_escape_string($conn,$_POST['username']);
  	$password = mysqli_real_escape_string($conn,$_POST['password']);
  	$password = md5($password);
			
		if(isset($_POST['username']) && isset($_POST['password'])){	
			if(!empty($_POST['username']) && !empty($_POST['password'])){
				//create query
			$query = "SELECT username FROM users WHERE username = '$username' and password = '$password'";
			$result = mysqli_query($conn, $query);
				
            $count = mysqli_num_rows($result);
            if($count == 1){
				//what was that for
                //header("Location : signup.php"); 
				session_start();
				$_SESSION["contact"];
				$_SESSION["user"] = $username;
                header("Location: loggedinpage/loggedin.php");
                }
                else{
					
					echo '<div class="container center"><div class="row"><div class="col s8 offset-s2"><div class="card blue-grey white-text">Password or Username is wrong</div></div></div></div>';
                }
            }
            else{
				echo '<div class="container center"><div class="row"><div class="col s8 offset-s2"><div class="card blue-grey white-text">Enter Username and Password</div></div></div></div>';
			}
		}
		
?>