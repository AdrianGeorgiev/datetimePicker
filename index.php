<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<style type="text/css">

.xdsoft_datetimepicker {
	width: 100%;
}
.xdsoft_datepicker {
	width: 90% !important;
}
.xdsoft_timepicker {
	width: 8% !important;
}


/* .xdsoft_date {
	background-color: green !important;
}

.xdsoft_disabled{
	background-color: red !important;
} */
</style>
</head>
<body>
	<form method="post" action="result.php">
		Name: <input type="text" name="name"><br>
		E-mail: <input type="text" name="email"><br>	
		<h3>DateTimePicker</h3>
		<input type="text" name= "date" id="datetimepicker3">
		<br>
		<input type="submit">
	</form>
</body>
<script src="js/jquery.js"></script>
<script src="js/php-date-formatter.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
<script>
$.datetimepicker.setLocale('en');
var disableDateHours = [];
var allowTimes = [
	'09:00',
	'09:30',
	'10:00',
	'10:30',
	'11:00',
	'11:30',
	'12:00',
	'12:30'
];
var onSelectDate = function (newDate, me){
	var newfDate = newDate.getDate() +"."+ (newDate.getMonth() + 1) + '.' + newDate.getFullYear();
	if(disableDateHours.map(i => i.date).includes(newfDate)){
		var disableHours = disableDateHours.filter(i => i.date === newfDate)[0].hours;
		var allowhours = options.allowTimes.filter((x) => !disableHours.includes(x));
		if(allowhours.length > 0){
			options.timepicker = true;
			options.allowTimes = allowhours;
		} else {
			options.timepicker = false
		}

	} else {
		options.timepicker = true;
		options.allowTimes = allowTimes
	}
	$('#datetimepicker3').datetimepicker(options);
};

var options = {
	inline:true,
	formatDate:'d.m.Y',
	allowTimes: allowTimes,
	minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1971/06/01',
	disabledWeekDays: [0,6],
	// minTime:'9:00',
	// maxTime:'13:00',
	step: 30,
	//weeks: true,
	timepickerScrollbar: false,
	dayOfWeekStart: 1,
	onSelectDate: onSelectDate.bind(this),
	onGenerate: function(date, me){
		// var time = options.allowTimes[0].split(':')
		// date.setHours(parseInt(time[0],10));
		// date.setMinutes(parseInt(time[1],10))
		$("#datetimepicker3").val(date);
	}
}

$.ajax({
	url: "data.php",
	type: "get",
	success: function (response) {
		options.disabledDates = response.disabledDates;
		options.highlightedDates =  response.disabledDates;
		var now = new Date();
		var dateNow = now.getDate() +"."+ (now.getMonth() + 1) + '.' + now.getFullYear();
		if(response.disableHours.map(i => i.date).includes(dateNow)){
			var disableHours = response.disableHours.filter(i => i.date === dateNow)[0].hours;
			options.allowTimes = options.allowTimes.filter((x) => !disableHours.includes(x))
		}
		disableDateHours = response.disableHours;
		
		$('#datetimepicker3').datetimepicker(options);
	}.bind(this),
	error: function(jqXHR, textStatus, errorThrown) {
		console.log(textStatus, errorThrown);
	}
});

</script>
</html>
