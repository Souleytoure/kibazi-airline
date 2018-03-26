<?php
	require "../db/db.php";
	session_start();
	$ticketno = $_SESSION['ticketno'];
	

	$query = "SELECT booked.ticketno,booked.name,booked.time,flights.flightid,flights.source,flights.destination,flights.deptime,flights.arrtime,flights.class 
			 FROM booked LEFT JOIN flights 
			 ON booked.flightid = flights.flightid 
			 WHERE ticketno = '$ticketno'";
			 
			 $result = mysqli_query($conn,$query);
			 $data = JSON_encode(mysqli_fetch_assoc($result));
			echo ("$data");
?>

