<?php
	function getTime(){
		$h = "6";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$s = $h * 60 * 60;
		$gmdate = gmdate("g:i A", time()-($s)); // the "-" can be switched to a plus if that's what your time zone is.
		echo "Our current time is :  $gmdate </br> ";
	}
	
	
	
	
	
	
	
	
?>