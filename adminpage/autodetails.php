<?php

require "../db/db.php";
	
			$flightid = $_POST['flightid'];
			
			$query = "SELECT * FROM flights WHERE flightid = '$flightid'";
				
				$result = mysqli_query($conn, $query);
				
				if(!$result){
					echo 'Please enter valid Flight ID';
				}else{
				$data = json_encode(mysqli_fetch_assoc($result));
					
					echo ("$data");
				}
			
	

?>
