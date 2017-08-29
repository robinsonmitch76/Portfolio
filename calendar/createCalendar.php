<!DOCTYPE html>
<html>
<?php
$month = $_POST["month"];
$year = date("Y");
$coach = $_POST["coach"];
if(($month < 3) && (ltrim(date('m'),0) > 3)){
	$year += 1;
}
echo '<h2 class="calendarHeader" style="text-align:center;">'.date('F', mktime(0,0,0,$month,10)).' '.$year.'</h2>';

echo draw_calendar($month,$year,$coach);

function draw_calendar($month,$year,$coach){
	
	$dayColor = array("#00ff00","#60ff00","#80ff00","#c0ff00","#ffff00","#ffc000","#ff8000","#ff6000","#ff0000");
	
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
	$headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';
	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	
	$aptInDay = array_fill(1, $days_in_month, 0);

	$servername = "localhost";
	$username = "not providing to github";
	$password = "not providing to github";
	$dbname = "not providing to github";
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = 'SELECT * FROM appointment WHERE facilitator = "'.$coach.'" AND month = '.$month;
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0){
	    // output data of each row
	    //echo $result->num_rows;
	    while($row = $result->fetch_assoc()){
	    	$aptInDay[$row["day"]] += 1;
	        //echo $row["name"]." ".$row["email"]." ".$row["phone"]." ".$row["facilitator"]." ".$row["month"]." ".$row["day"]." ".$row["time"]. "<br>";
	    }
	}
	$conn->close();
	
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
	/* row for week one */
	$calendar.= '<tr class="calendar-row">';
	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;
	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day"><input required id="day-'.$list_day.'" type="radio" name ="calendar-day" value="'.$list_day.'"/><label style="background-color:'.$dayColor[$aptInDay[$list_day]].';"';
		if($aptInDay[$list_day] < 8){
			$calendar .=' for="day-' . $list_day . '"';
		}
		$calendar .='>';
	//$calendar.= '<td class="calendar-day"><input id="day-'.$list_day.'" type="radio" name ="calendar-day" value="'.$list_day.'"/><label for="day-'.$list_day.'">';
			
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
		$calendar.= '</label></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;
	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;
	/* final row */
	$calendar.= '</tr>';
	/* end the table */
	$calendar.= '</table>';
	/* all done, return result */
	return $calendar;
}
?>
</html>
