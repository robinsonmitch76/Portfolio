<?php
	get_header();	
	include "calendar/proccessPost.php";
	include "calendar/calendarFunctions.php";
?>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="/calendar/jQueryEvents.js"></script>
<script src="/calendar/calendarFunctions.js"></script>
<link rel="stylesheet" type="text/css" href="../../../calendar/calendar.css"/>
<?php do_action( 'boutique_before_homepage_content' );?>
<div id="primary" class="content-area">
	<div style="width:215px; margin-left:auto;margin-right:auto;">
		<?php getTime(); ?>
		<script> getTime(); </script>
	</div>
	<form id="sceduleForm" action="" method="post">
		<div class="inputContainer" style="margin-left:auto; margin-right:auto; width:203px;">
			<div class="inputLabel" style="text-align: center; width:100%;"><b>Name (required):</b></div></br><div class="inputField"><input id="input-name" type="text" name="contact-name" required/></div>
		</div>
		<div class="inputContainer" style="margin-left:auto; margin-right:auto; width:203px; text-align:center;">
			<div class="inputLabel" style="text-align: center; width:100%;"><b>E-mail (required):</b></div><div class="inputField"><input id="input-email" type="text" name="contact-email" required/></div>
		</div>
		<div class="inputContainer" style="margin-left:auto; margin-right:auto; width:203px; text-align:center;">
			<div class="inputLabel" style="text-align: center; width:100%;"><b>Phone (required):</b></div>
			<div class="inputField">
				<input id="phone-input1" type="text" name="contact-phone1" size="3" pattern=".{3,3}" maxlength="3" required/>
				<input id="phone-input2" type="text" name="contact-phone2" size="3" pattern=".{3,3}" maxlength="3" required/>
				<input id="phone-input3" type="text" name="contact-phone3" size="3" pattern=".{3,3}" maxlength="3" required/>
			</div>
		</div>
		<div style="text-align:center;"><b>Please Choose a facilitator (required):</b></div>
		<div class="inputContainer" id="facilitators">
			<label><input type="radio" name="facilitator" value="Pam Robinson" required/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/PamRobinsonAbout.png" /><p>Pam Robinson</p></label><label><input type="radio" name="facilitator" value="Connie Perret"/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/ConniePerrett.png" /><p>Connie Perrett</p></label><label><input type="radio" name="facilitator" value="Pam Housley"/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/PamHousley.png"/><p>Pam Housley</p></label><label><input type="radio" name="facilitator" value="Becky Larsen"/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/BeckyLarsen.png" /><p>Beckie Strong Larsen</p></label><label><input type="radio" name="facilitator" value="Sara Thacker"/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/SaraThacker.png" /><p>Sara Thacker</p></label><label><input type="radio" name="facilitator" value="Shari Angell"/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/ShariAngell.png" /><p>Shari Angell</p></label><label><input type="radio" name="facilitator" value="Keri Tolboe"/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/KeriTolboe.png"/><p>Keri Tolboe</p></label><label><input type="radio" name="facilitator" value="Diana Nield"/><img src="http://www.ihacoachingandconsulting.com/wp-content/uploads/2017/07/DianaNield.png"/><p>Diana Nield</p></label>
		</div>
		<div id="MonthSelector">
			<div style="margin-bottom:15px;"><b>Please Choose Month (required):</b></div>
			<?php $curMonth = ltrim(date('m'),0); ?>
			<label class="MonthOption"><input required type="radio" name="Month" value="<?php echo $curMonth;?>"/>
				<p><?php echo date('F', mktime(0,0,0,$curMonth,10));?></p>
			</label>
			<label class="MonthOption"><input type="radio" name="Month" value="<?php echo ((($curMonth + 1)%12) == 0) ? 12 : (($curMonth + 1)%12);?>"/>
				<p><?php echo date('F', mktime(0,0,0,$curMonth+1,10));?></p>
			</label>
			<label class="MonthOption"><input type="radio" name="Month" value="<?php echo ((($curMonth + 2)%12) == 0) ? 12 : (($curMonth + 2)%12);?>"/>
				<p><?php echo date('F', mktime(0,0,0,$curMonth+2,10));?></p>
			</label>
		</div>
		<div id="DaySelector"></div>
		<div id="timeSelector"></div>
		<div class="inputContainer">
			<div id="submit"><input type="submit"></div>
		</div>
	</form>	
</div>
<?php get_footer(); ?>