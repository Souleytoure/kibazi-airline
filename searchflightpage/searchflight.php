<?php
require "../db/db.php";
session_start();
if(!isset($_SESSION["user"])){
	header("Location: ../index.php");
}else{
			if(isset($_POST['source']) && isset($_POST['destination']) && isset($_POST['date'])){
				
				$source = $_POST['source'];
				$destination = $_POST['destination'];
				$date = $_POST['date'];
				
				if(!empty($source) && !empty($destination) && !empty($date)){
					
					$query = "SELECT * FROM flights WHERE source= '$source' AND destination = '$destination' AND date = '$date'";
					$result = $conn->query($query);
					
					if($result->num_rows > 0){


                        echo'
                        <div class="container">
                        <div class="row">
                        <div class="col s12">
                        <table class="striped">
                            <thead>
                                <tr>
                                    <th>FlightID</th>
                                    <th>Date</th>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <th>Class</th>
                                    <th>price</th>
                                    <th>Seat Available</th>
                                </tr>
                            </thead>';

						while($row = $result->fetch_assoc()){
                            echo"
                            <tbody>
                            <tr>
                                <td>".$row["flightid"]."</td>
                                <td>".$row["date"]."</td>
                                <td>".$row["source"]."</td>
                                <td>".$row["destination"]."</td>
                                <td>".$row["deptime"]."</td>
                                <td>".$row["arrtime"]."</td>
                                <td>".$row["class"]."</td>
                                <td>".$row["price"]."</td>
                                <td>".$row["seatavail"]."</td>
                            </tr>
                            </tbody>";
                        }
                        
                        echo'
                            </table>
                            </div>
                            </div>
                            </div>';
                        }
                        else{
                            echo '<div class="container row">No Flights found...</div>';
                        }
                        
                        mysqli_free_result($result);
                    }
                    else{
                        echo '<div class="container">Please fill up all the fields...</div>';
                    }
                }
            }
                
?>

<!DOCTYPE html>
<html>
  <head>
  <title>Kibazi| Search</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <style>
    
    .container{
        margin-top: 5%;
    }

    .card-inner-p{
        text-align: center;
    }
    
    *::-webkit-scrollbar{
        width: 10px;
    }

    *::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        border-radius: 10px;
    }

    *::-webkit-scrollbar-thumb{
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    }
    
    table{
        overflow-y:scroll;
        height:100px;
        width: 100%;
 
    }

    table::-webkit-scrollbar,::-webkit-scrollbar{
        width: 10px;
    }

    table::-webkit-scrollbar-track,::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        box-shadow: inset 0 0 6px rgba(0,0,0,0.3);  
        border-radius: 10px;
    }

    table::-webkit-scrollbar-thumb,::-webkit-scrollbar-thumb{
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
        box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
    }
    
    </style>

</head>

  <body>
  <div class="container">
    <span class="new badge light-green" data-badge-caption="Welcome <?php echo $_SESSION["user"]; ?>"></span>
    </div><br>
    <div class="container">
        <a id="backButton" class="btn cyan z-depth-4 tooltipped" data-position="right" data-delay="10" data-tooltip="Previous Page">
            <i class="material-icons">arrow_back</i>
        </a>
        <a id="bookButton" class="btn btn-floating pulse cyan right z-depth-1 tooltipped" data-position="left" data-delay="10" data-tooltip="Book tickets">
            <i class="material-icons">book</i>
        </a>    
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel hoverable white z-depth-2">
                    <div class="row">
                        <div class="container">
                            <form class="col s12" action = "searchflight.php" method="post">
                                <div class="row">
                                    <div class="input-field col s4">
                                    <i class="material-icons prefix">flight_takeoff</i>
                                    <?php
                                    require "../db/db.php";
                                    $sql = "SELECT source FROM flights";
                                    $result = mysqli_query($conn, $sql);

                                    echo'<select name="source" id="source">
                                        <option value="" disabled selected>Source</option>';
                                        while($row = mysqli_fetch_array($result)){
                                            echo'<option id="source" value="'.$row['source'].'">'.$row['source'].'</option>'; 
                                        }
                                    echo'</select>
                                    <label for="source">Source</label>';
                                    ?>
                                    </div>
                                    <div class="input-field col s4">
                                    <i class="material-icons prefix">flight_landing</i>
                                    <?php
                                    require "../db/db.php";
                                    $sql = "SELECT destination FROM flights";
                                    $result = mysqli_query($conn, $sql);

                                    echo'<select name="destination" id="destination">
                                        <option value="" disabled selected>Destination</option>';
                                        while($row = mysqli_fetch_array($result)){
                                            echo'<option id="destination" value="'.$row['destination'].'">'.$row['destination'].'</option>'; 
                                        }
                                    echo'</select>
                                    <label for="destination">Destination</label>';
                                    ?>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">date_range</i>
                                        <input id="date" name="date" type="text" class="datepicker">  
                                        <label for="date">Date</label>
                  
                                    </div>
                                </div>
                                <input class="btn cyan waves-effect" id = "searchBut" type = "submit" value = "Search"/>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    
    <script>

    $(document).ready(function(){
        $('ul.tabs').tabs();
        $('select').material_select();
        
        $('#backButton').click(function(){
          window.location = "../loggedinpage/loggedin.php";
        });
        
        $('#bookButton').click(function(){
            window.location = "../bookingpage/ticketbookingpage.php";
        });

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
        });

        $('.tooltipped').tooltip({delay: 10});

    });

    </script>
    
  </body>
</html>
