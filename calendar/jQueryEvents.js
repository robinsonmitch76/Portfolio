$(document).ready(function(){
		var coachSelected = "";
		var monthSelected = "";
		var daySelected = "";
		
		$("#sceduleForm").submit(function(event) {
			var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    			if (filter.test($("#input-email").val())){
			}else{
				alert("Please enter a valid email address.");
				event.preventDefault();
			}
		});
		
		$("#facilitators > label").mouseup(function(){
			$('#MonthSelector').css("display","block");
			coachSelected = $(this).children('input').val(); 
			$("input[name='Month']:checked").removeAttr("checked");
			$('.calendarHeader').remove();
            		$('.calendar').remove();
		});
		$(".MonthOption").mouseup(function(){
            		monthSelected = $(this).children('input').val();
			$.ajax({
				url: "/calendar/createCalendar.php",
				type : "POST",
				data:{example : "example", month : monthSelected, coach : coachSelected},
				success: function(result){
					$('.calendarHeader').remove();
            				$('.calendar').remove();
            				$(".timeOption").remove();
					$("#DaySelector").append(result);
						$('input[name=calendar-day]').bind("invalid",function(){
							return false;
						});
						$("#day-1").bind("invalid",function(){
							alert("Please Select a Date");
							return false;
						});
				}
			});
			
			$("#DaySelector").off("click").on("click", "label", function(){
				if($(this).attr("for") != null){
					daySelected = $(this).siblings().val();
					$(".timeOptionA").remove();
					$(".timeOptionU").remove();
					$.ajax({
						url: "/calendar/createDay.php",
						type : "POST",
						data:{example : "example", month : monthSelected, coach : coachSelected, day : daySelected},
						success: function(result){
							$("#timeSelector").append(result);
						}
					});
				}
			});
			
		});
	});