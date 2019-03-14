$(document).ready(function() {

	$(function() {
		// $('#date-in').datetimepicker({    
		//     lang:'en',
		//     timepicker:false,
		//     format:'Y/m/d',
		//     formatDate:'Y/m/d'
	    
		// });
		// 	$('.date-format').datetimepicker({    
		//     lang:'en',
		//     timepicker:false,
		//     format:'Y/m/d',
		//     formatDate:'Y/m/d'
		// });
		$(".datepicker").datepicker();
		// Pass the user selected date format.
		$("#format").change(function() {
		$(".datepicker").datepicker("option", "dateFormat", $(this).val());
		});

		//$('.timepicker').timepicker();


	});
	
});
function isdate(date_vali){
		var year = date_vali.slice(0, 4);
		var month = date_vali.slice(5, 7);
		var date = date_vali.slice(8, 10);
		if (date_vali.length!=10&&date_vali.length!=0){
			return false;
		}
		else if (parseInt(date)<1 || parseInt(date)>31){
			return false;
		} else if (parseInt(month)<1 || parseInt(month)>12){
			return false;
		} else if (parseInt(year)<1000 || parseInt(year)>3000){
			return false;
		} else 
		return true;
	}
function call_ajax_json(url,data)
{
	var data_result = "";
	$.ajax({
	async: false,
	url : url,
	type: "POST",
	data : data,
	dataType: "json",
	success: function(result)
	{
		data_result = result;
	}
	});		

	return data_result;

}
function call_ajax(url,data)
{
	var data_result = "";
	$.ajax({
	async: false,
	url : url,
	type: "POST",
	data : data,
	
	success: function(result)
	{
		
		data_result = result;
	}
	});		
	return data_result;

}

function formatTime(time) {
    var result = false, m;
    var re = /^\s*([01]?\d|2[0-3]):?([0-5]\d)\s*$/;
    if ((m = time.match(re))) {
        result = (m[1].length == 2 ? "" : "0") + m[1] + ":" + m[2];
    }
    return result;
}

function calculateTime(timefrom, timeto) {
        //get values
    var valuestart = timefrom;
    var valuestop = timeto;

             //create date format       
    var timeStart = new Date("01/01/2007 " + valuestart);
    var timeEnd = new Date("01/01/2007 " + valuestop);

    var difference = timeEnd - timeStart;    
    var hou = ~~(difference / 60 / 60 / 1000);
    var sec = (difference/1000/60)%60;
    var result = hou+":"+sec;
    return result;   
}
