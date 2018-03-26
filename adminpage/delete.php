<?php

require "db/db.php";
	
			$flightid = $_POST['flightid'];
			$date = $_POST['date'];
			$source = $_POST['source'];
			$destination = $_POST['destination'];
			$deptime = $_POST['deptime'];
			$arrtime = $_POST['arrtime'];
			$clas = $_POST['clas'];
			$price = $_POST['price'];
			$seatavail = $_POST['seatavail'];
			
			if(!empty($flightid) && !empty($date) && !empty($source) && !empty($destination) && !empty($deptime) && !empty($arrtime)
				 && !empty($clas) && !empty($price) && !empty($seatavail)){		
			
							
				//create query
				$query = "DELETE FROM flights WHERE flightid='$flightid'";
				
				if(mysqli_query($conn, $query)){
					
					echo 'Flight has been deleted successfully.';
				}else{
					
					echo 'There is some problem at server...Please try again';
				}
			}else{
				echo 'Please fill up all the fields';
			}
	

?>
