<!DOCTYPE html>
<html>
<?php
	$month = $_POST["month"];
	$coach = $_POST["coach"];
	$day = $_POST["day"];
	
	$servername = "localhost";
	$username = "i3688079_wp2";
	$password = "H]~qYlYTLLnb#J4Z0i[43^@2";
	$dbname = "i3688079_scheduling";
	
	$timeFilled = array_fill(9, 17, false);
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if(!$conn){
	    die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = 'SELECT * FROM appointment WHERE facilitator = "'.$coach.'" AND month = '.$month.' AND day ='.$day. ' AND (time BETWEEN 9 AND 17)';
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
	    		//echo $row["name"]." ".$row["email"]." ".$row["phone"]." ".$row["facilitator"]." ".$row["month"]." ".$row["day"]." ".$row["time"]. "<br>";
	        	$timeFilled[$row["time"]] = true;
		}
	}
	for($i=9; $i<17; $i++){
		if($timeFilled[$i] == true){
			echo '<label class="timeOptionU">';
				echo "<p>".($i>12?(sprintf("%u-%u",$i-12,$i-11)):(sprintf("%u-%u",$i,$i+1))).":00".($i>11?"PM":"AM")." is Booked</p>";
			echo '</label>';
		}else{
			echo '<label class="timeOptionA">';
				echo '<input type="radio" name="time" value="'. $i .'" required/>';
				echo "<p>".($i>12?(sprintf("%u-%u",$i-12,$i-11)):(sprintf("%u-%u",$i,$i+1))).":00".($i>11?"PM":"AM")." is Available</p>";
			echo '</label>';
		}
	}
	$conn->close();
?>
</html>