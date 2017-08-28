function getTime(){
	var h = new Date().getHours();
	var m = new Date().getMinutes();
	var a = "AM";
	if(h>11)
		a = "PM";
	if(h == 0){
		h = 12;
	}
	if(h > 12)
		h -= 12;
	document.write("Your current time is : " + h + ":");
	if(m<10){
		document.write("0");
	 }
	 document.write(m + " " + a + "</br></br>");
}