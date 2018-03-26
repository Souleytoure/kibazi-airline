<?php
require "../db/db.php";

$source = $_POST['source'];
$destination = $_POST['destination'];

$query = "SELECT * FROM flights WHERE source = '$source' AND destination = '$destination'";

$result = mysqli_query($conn, $query);
				
if(!$result){
	echo 'Flights not available';
}
else{
	$data = json_encode(mysqli_fetch_assoc($result));
	echo ("$data");
}
			
	

?>
