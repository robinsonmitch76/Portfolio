<?php
	proccessPost();
	
	function proccessPost(){
		if($_POST["contact-phone1"] && $_POST["contact-phone2"] && $_POST["contact-phone3"]){
		}
			$_POST["contact-phone"] = $_POST["contact-phone1"].$_POST["contact-phone2"].$_POST["contact-phone3"];
		if($_POST["contact-name"] && $_POST["contact-email"] && $_POST["contact-phone"] && $_POST["facilitator"] && $_POST["Month"] && $_POST["calendar-day"] && $_POST["time"]){
			EnterToDB();
		}
	}
	
	function EnterToDB(){
		$servername = "localhost";
		$username = "i3688079_wp2";
		$password = "H]~qYlYTLLnb#J4Z0i[43^@2";
		$dbname = "i3688079_scheduling";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn){
		    die("Connection failed: " . mysqli_connect_error());
		}
		$sql = 'SELECT * FROM appointment WHERE name = "'.$_POST["contact-name"].'" AND email = "'.$_POST["contact-email"].'" AND phone = "'.$_POST["contact-phone"].'" AND facilitator = "'.$_POST["facilitator"].'" AND month = '.$_POST["Month"].' AND day ='.$_POST["calendar-day"]. ' AND time = '.$_POST["time"].';';
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			$conn->close();
		}else{
			$sql =  'INSERT INTO appointment'.'(name, email, phone, facilitator, month, day, time)'.' VALUES ("'.$_POST["contact-name"].'", "'.$_POST["contact-email"].'", "'.$_POST["contact-phone"].'", "'.$_POST["facilitator"].'", "'. $_POST["Month"].'", "'.$_POST["calendar-day"].'", "'.$_POST["time"].'");';
			if ($conn->query($sql)){} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
	}
?>