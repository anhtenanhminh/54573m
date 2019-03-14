<?php echo $this->load->view('Layout/header')?>
<div class="content">

	<div class="container">
		<h4 style="margin-top: 6px; margin-bottom: 0px;">
			UPDATE OPTIONAL TOUR GUIDE TABLE
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;" onclick="back()">Back</button>
		</h4>
		<div class="row line-strong" style="margin-top: 20px;"></div>
		<div class="row" style="margin-bottom: 5px;">
			<div class="form-inline form-margin-bottom">
				<div class="form-group">
					<label class="label-item">Table Code</label> <input id="TBCode"
						type="text" class="form-control input-sm select-size"
						value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["TBLCodeOptionalTour"]:""; ?>"
						readonly>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Guide Information</label>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Guide Name</label> <select id="guide"
									class="form-control input-sm select-size-sm">
									<option value=""></option>
		    						<?php
            if ($guide) {
                foreach ($guide as $row) {
                    if ($row['GuideID'] == $optional_tour_guide[0]["GuideID"]) {
                        ?>
										   			<option value="<?php echo $row['GuideID']?>" selected><?php echo $row['GuideName']?></option>
										   		<?php } else{?>
										      	<option value="<?php echo $row['GuideID']?>"><?php echo $row['GuideName']?></option>
										<?php

}
                }
            }
            ?>	
		    					</select>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Telephone</label> <input
									id="guide-tel" type="text"
									class="form-control input-sm select-size-sm"
									value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["GuideTel"]:""; ?>"
									readonly>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item" style="display: inline-grid;">Pecuniary
									Penalty</label> <input type="text"
									class="form-control input-sm select-size-sm"
									value="<?php echo $optional_tour_guide[0]['GPecuPenalty'] ?>"
									readonly id="Pecuniary"> <label>VND</label>
							</div>
						</div>

					</div>
					<div class="col-md-6">
						<textarea class="form-control" rows="5" readonly id="GComplain"><?php echo $optional_tour_guide[0]['GComplainNote'] ?></textarea>
						<label> <input type="checkbox" id="complain_check" value="1" />
							Complain
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Car Information</label>
					</div>
					<div class="col-md-12">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Car No.</label> <select id="car-no"
									class="form-control input-sm select-size">
									<option value=""></option>
		    						<?php
            if ($cardriver) {
                foreach ($cardriver as $row) {
                    if ($row['CarDriverID'] == $optional_tour_guide[0]["CarDriverID"]) {
                        ?>
										   			<option value="<?php echo $row['CarDriverID']?>"
										selected><?php echo $row['CarNo']?></option>
										   		<?php } else{?>
										      	<option value="<?php echo $row['CarDriverID']?>"><?php echo $row['CarNo']?></option>
										<?php

}
                }
            }
            ?>	
	    						</select>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Driver Name</label> <input
									id="driver-name" type="text"
									class="form-control input-sm select-size"
									value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["DriverName"]:""; ?>"
									readonly>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Seat</label> <input id="car-seat"
									type="text" class="form-control input-sm select-size-sm"
									value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["CarSeat"]:""; ?>"
									readonly>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Telephone</label> <input
									id="driver-tel" type="text"
									class="form-control input-sm select-size-sm"
									value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["DriverTel"]:""; ?>"
									readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Schedule Time</label>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">From</label> <input type="text"
								class="form-control input-sm select-size-sm"
								value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["STimeFrom"]:""; ?>"
								readonly>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">To</label> <input type="text"
								class="form-control input-sm select-size-sm"
								value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["STimeTo"]:""; ?>"
								readonly>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Actual Time</label>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-sm">From</label>
							<div class="form-group bfh-timepicker"
								data-input="form-control input-sm select-size-sm"
								data-time="<?php echo $optional_tour_guide[0]['ATimeFrom'] ?>"
								data-name="actualy-from"></div>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-sm">To</label>
							<div class="form-group bfh-timepicker"
								data-input="form-control input-sm select-size-sm"
								data-time="<?php echo $optional_tour_guide[0]['ATimeTo'] ?>"
								data-name="actualy-to"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Field</label>
			</div>
			<div class="col-md-3">
				<div class="form-inline">
					<div class="form-group">
						<label class="label-item">Date</label> <input type="text"
							id='dtpDate' class="form-control input-sm select-size"
							value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["DateGo"]:""; ?>"
							readonly>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-inline">
					<div class="form-group">
						<label class="label-item-md">Tour Name</label> <input type="text"
							class="form-control input-sm select-size-xlg"
							value="<?php echo ($optional_tour_guide)?$optional_tour_guide[0]["TourName"]:""; ?>"
							readonly>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Optional Tours Information</label>
			</div>
			<div class="col-md-9">
				<div class="row row-border">
					<div id="div-tour-optional-guide-update" class="list-scroll">
						<table id="table-tour-optional-guide-update"
							class="table table-fixed">
							<thead>
								<td style="width: 20px"></td>
								<td style="width: 20px"></td>
								<td style="width: 150px">Tour Code</td>
								<td style="width: 300px">Tour Name</td>
								<td style="width: 150px">Hotel</td>
								<td style="width: 120px">RegPlace</td>
								<td style="width: 67px">PAX</td>
							</thead>
							<tbody>
								<?php
        if ($optional_tour_list) {
            foreach ($optional_tour_list as $key => $row) {
                ?>
										   	<tr id='optional-<?php echo $key; ?>'
									onclick="get_guest_transfer('<?php echo $key; ?>','<?php echo $row["TourCode"];?>','<?php echo $row["TourName"]; ?>')">
									<td style='width: 20px'>
										<div class="glyphicon glyphicon-play icon-edit">
											<input type="hidden"
												value="<?php echo $row["BookingOptionalID"]; ?>">
										</div>
									</td>
											   	<?php if ($optional_tour_guide[0]["TBLCodeOptionalTour"]==$row["TBLCodeOptionalTour"]){?>
											   	<td style="width: 20px"><input type='checkbox'
										id='check-<?php echo $row["BookingOptionalID"]; ?>' checked></td>
											   	<?php } else {?>
											   	<td style="width: 20px"><input type='checkbox'
										id='check-<?php echo $row["BookingOptionalID"]; ?>'></td>
											   	<?php }?>
										   		<td style='width: 150px'><?php echo ($row["TourCode"]!=null)?$row["TourCode"]:""; ?></td>
									<td style='width: 300px'><?php echo ($row["TourName"]!=null)?$row["TourName"]:""; ?></td>
									<td style='width: 150px'><?php echo ($row["Hotel"]!=null)?$row["Hotel"]:""; ?></td>
									<td style='width: 120px'><?php echo ($row["RegPlace"]!="")?"VIETNAM":"JAPAN"; ?></td>
									<td style='width: 67px'>0</td>
								</tr>
								<?php

}
        }
        ?>	
							</tbody>
						</table>
					</div>
					<div class="">
						<div class="form-inline">
							<div class="form-group">
								<div class="checkbox form-margin-top-right">
									<label> <input type="checkbox" name="check-all" value="t">
										Check All
									</label>
								</div>
								<div class="checkbox form-margin-top-right">
									<label> <input type="checkbox" name="check-all" value="f">
										Uncheck All
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Transfered Guest</label>
					</div>
					<div id="div-guest-optional-guide-update" class="list-scroll">
						<table id="table-guest-optional-guide-update"
							class="table table-fixed">
							<thead></thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row btn-center">
			<button class="btn btn-primary btn-sm button-md"
				onclick="update_optional_tour_guide()">Update</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		GComplain_check = "<?php echo $optional_tour_guide[0]['GComplain'] ?>";
		if(GComplain_check == 1)
		{
			$('#Pecuniary').prop('readonly',false);
			$('#GComplain').prop('readonly',false);
			$('#complain_check').prop('checked',true);
				
		}
		//back function's variables
		guide_name = $('#guide').val();
		pecuniary = $('#Pecuniary').val();
		g_complain = $('#GComplain').val();
		complain_check = $('#complain_check').is(':checked');
		car_no = $('#car-no').val();
		actual_from_time = $('input[name=actualy-from]').val();
		actual_to_time = $('input[name=actualy-to]').val();
		//end back function's variables
		//Duong_check time
		$('input[name=actualy-from],input[name=actualy-to]').keypress(function(evt){
			var theEvent = evt || window.event;
		    var key = theEvent.keyCode || theEvent.which;
		    key = String.fromCharCode( key );
		    var regex = /[0-9\b\t:]/;
		     if( !regex.test(key)) 
		    {
		        theEvent.returnValue = false;
		    	if(theEvent.preventDefault) theEvent.preventDefault();
		  	}
		});
		$('input[name=actualy-from],input[name=actualy-to]').blur(function(event)
			{
				var name = $(this).attr('name');
				var time = $(this).val();
				if(!isNaN(time) && (time >=0 && time < 24) && time !='')
				{
					flag_check_time = true;
					if(time<10)
					{
						$(this).val('0'+time+':00');
					}
					else
					{
						$(this).val(time+':00');
					}
				}
				else if(time !='')
				{
					array_time = time.split(':');
					if(array_time.length != 2 || array_time[0] >=24 || array_time[0] < 0 || array_time[1] < 0 || array_time[1] >59 || array_time[0].length !=2 || array_time[1].length!=2)
					{
						flag_check_time = false;
						alert('Time must be formartted as [HH:MM]');
						setTimeout(function(){
						$('input[name='+name+']').trigger('focus');
						},1);
					}
					
				}
			});
		//End Duong
		$('#guide').change(function () {
	    	var guide=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('TransferController/get_tel_guide'); ?>",
	            async: false,
	            type: "POST",  
	            data: "guide="+ guide, 
	            dataType: "text",				                         
	            success: function(data) {
	                $('#guide-tel').val(data);
	            }
	        });
	 	});
		$('#car-no').change(function () {
	    	var driver=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('OptionalController/get_info_car'); ?>",
	            async: false,
	            type: "POST",  
	            data: "driver="+ driver, 
	            dataType: "json",				                         
	            success: function(data) {
	            	$.each (data, function(key, opj) {
	            		$('#driver-name').val(opj["DriverName"]);
	                	$('#car-seat').val(opj["CarSeat"]);
	                	$('#driver-tel').val(opj["DriverTel"]);
	            	});
		            setTimeout(function(){
		            		$('body').css("cursor", "");
		            		$("#show-result").fadeIn();
		            		}, 500);
	            }
	        });
	 	});
	 	$('input[name="check-all"]').change(function(){
	 		if ($('input[name=check-all]:checked').val()=="t"){
	 			$('#table-tour-optional-guide-update tbody tr input').prop( "checked", true );	
	 			$("#count-per").val($("#GNo").val());
	 		} else {
	 			$('#table-tour-optional-guide-update tbody tr input').prop( "checked", false);
	 			$("#count-per").val(0);
	 		}
	 	});
                $("#complain_check").click(function () {
		
		if($('#complain_check').prop('checked')) {
		   ($("#GComplain").removeAttr('readonly'));
		   ($("#Pecuniary").removeAttr('readonly'));
		} else {
		    ($("#GComplain").attr('readonly','true').val(''));
		    ($("#Pecuniary").attr('readonly','true').val(''));

		}});

        $("input[name='actualy-from']").keypress(function(e){
		return checkKeyPress($(this).val().length, e);
	});
	$("input[name='actualy-to']").keypress(function(e){
		return checkKeyPress($(this).val().length, e);
	});

	// $("input[name='actualy-from']").change(function(){
	// 	if (checkChange($(this).val()) == false) {
	// 		setTimeout(function(){
	// 			$("input[name='actualy-from']").focus();
	// 		},1);
	// 		return false;
	// 	} else {
	// 		$("input[name='actualy-from']").val(reFormat($("input[name='actualy-from']").val()));
	// 	}
	// });

	// $("input[name='actualy-to']").change(function(){
	// 	if (checkChange($(this).val()) == false) {
	// 		setTimeout(function(){
	// 			$("input[name='actualy-to']").focus();
	// 		},1);
	// 		return false;
	// 	} else {
	// 		$("input[name='actualy-to']").val(reFormat($("input[name='actualy-to']").val()));
	// 	}
	// });
	});

function get_guest_transfer(key,TLTCode,TourName){
	// window.alert($("#optional-"+TLTCode).html());
	$("#table-tour-optional-guide-update tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#optional-"+key+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-tour-optional-guide-update ").find("tr").css("background","transparent");
	// var rowValue = $("#optional-"+TLTCode).data('id');
	$("#optional-"+key).css("background","#397FDB");
	var dt = {
		TLTCode 	: 	TLTCode
	};

	$.ajax({   
        url: "<?php echo base_url('OptionalController/get_guest_transfer_new_optional'); ?>",
        type: "POST",  
        data: dt, 
        dataType: "json", 
        beforeSend: function(){
	    	$("body").css("cursor", "wait");
		},    
		complete: function() {
		    $("body").css("cursor","default");
		},                   
        success: function(data){
        	var outputGuest = "";
        	outputGuest += "<thead>";
				outputGuest += "<td style='width:20px'></td>";
				outputGuest += "<td style='width:230px'>Guest Name</td>";
			outputGuest += "</thead>";
			outputGuest	+= "<tbody>";
			$.each (data, function(key, opj) {
				
				if (key=="guest_E") {
			    	
			    	$.each (opj, function(key1, row) {
			    		outputGuest += "<tr id='guest-tour-"+row["GuestID"]+"' onclick=select_guest_tour('"+row["GuestID"]+"')>";
			    			outputGuest += "<td style='width:20px'><div class='glyphicon glyphicon-play icon-edit'></div></td>";
			    			outputGuest += "<td style='width:230px'>"+row["GuestName"]+"</td>";
			    		outputGuest += "</tr>";
			    	});
			    	
			    }
			    if (key=="guest_I") {
			    	$.each (opj, function(key1, row) {
			    		outputGuest += "<tr id='guest-tour-"+row["GuestID"]+"' onclick=select_guest_tour('"+row["GuestID"]+"')>";
			    			outputGuest += "<td style='width:20px'><div class='glyphicon glyphicon-play icon-edit'></div></td>";
			    			outputGuest += "<td style='width:230px'>"+row["GuestName"]+"</td>";
			    		outputGuest += "</tr>";
			    	});
			    }
			    
		   	});
		   	outputGuest	+= "</tbody>";
		    $('#table-guest-optional-guide-update').html(outputGuest);
        }
    });
}

function select_guest_tour(guestID){
	$("#table-guest-optional-guide-update tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#guest-tour-"+guestID+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-guest-optional-guide-update").find("tr").css("background","transparent");
	$("#guest-tour-"+guestID).css("background","#397FDB");
}
function select_check_box(BookingOptionalID,NPer){
	if ($("#check-"+BookingOptionalID).is(":checked")){
		$("#count-per").val(parseInt($("#count-per").val())+NPer);
	} else {
		$("#count-per").val(parseInt($("#count-per").val())-NPer);
	}
}
function update_optional_tour_guide(){
	var checkAllCheck = false;
	var i = 0 ;
	if($('input[name=actualy-from]').val()=='')
	{
		alert('Select actual time from please !');
		return false;
	}
	else if($('input[name=actualy-to]').val()=='')
	{
		alert('Select actual time to please !');
		return false;
	}
	var r = confirm("Are you sure to update!");
	if (r){
		$("#table-tour-optional-guide-update tbody tr").each(function(){
			if ($("#table-tour-optional-guide-update tbody #optional-"+i+" td:nth-child(2) input").is(":checked")) {
				checkAllCheck = true;
			}
			i++;
		});
		if (checkAllCheck){
			var dt = {
				'TBLCodeOptionalTour'	: $("#TBCode").val(),
				list_check 				: create_array_check_list(),
				data 					: create_array_data()
			};

			$.ajax({   
		        url: "<?php echo base_url('OptionalController/update_optional_tour_guide'); ?>",
		        type: "POST", 
		        data: dt, 
		        dataType: "json", 
		        beforeSend: function(){
		    		$("body").css("cursor", "wait");
			    },    
			    complete: function() {
			    	$("body").css("cursor","default");
			    },                   
		        success: function(data){
		        	$.each (data, function(key, opj){
		        		if (opj=="true"){
		        			alert("Data update success!");
		        			location.href="<?php echo base_url();?>optional-tour/optional-tour-transfer";
		        		} else {
		        			alert("Data update fail!");
		        		}
		        	})
				}
			});
		}
		else alert("You must select at least one row!!!");
	}
	
}

function create_array_data(){
	var result = [];
	if($('#complain_check').is(':checked'))
	{
		var complain_check = 1;
	}
	else
	{
		var complain_check = null;
	}
	result.push({
		'STimeFrom'				: $("#date-in").val(),
		'CarDriverID'			: parseInt($("#car-no").val()),
		'GuideID'				: parseInt($("#guide").val()),
		'DateGo'				: $('#dtpDate').val(),
		'ATimeFrom'				: $('input[name=actualy-from]').val(),
		'ATimeTo'				: $('input[name=actualy-to]').val(),
		'GComplainNote'			: $('#GComplain').val(),
		'GComplain'				: complain_check,
		'GPecuPenalty'			: $('#Pecuniary').val(),
		// 'TourName'				: create_string_list_tour()
	});
	return result;
}

function create_array_check_list(){
	var result= [];
	var i = 0;
	$("#table-tour-optional-guide-update tbody tr").each(function(){
		if ($("#table-tour-optional-guide-update tbody #optional-"+i+" td:nth-child(2) input").is(":checked")){
			result.push({data:parseInt($("#table-tour-optional-guide-update tbody #optional-"+i+" td:nth-child(1) input").val()),check:1});
		} else {
			result.push({data:parseInt($("#table-tour-optional-guide-update tbody #optional-"+i+" td:nth-child(1) input").val()),check:0});
		}
		i++;
	});
	console.log(result);
	return result;
}

function create_string_list_tour(){
	var result = [];
	var i = 0;
	$("#table-tour-optional-guide-update tbody tr").each(function(){
		if ($("#table-tour-optional-guide-update tbody #optional-"+i+" td:nth-child(2) input").is(":checked")){
			result.push($('<div />').html($("#table-tour-optional-guide-update tbody #optional-"+i+" td:nth-child(4)").html()).text());
		}
		i++;
	});
	return result.join();
}

function back()
{
	if(
		guide_name != $('#guide').val()|| 
		pecuniary != $('#Pecuniary').val()||
		g_complain != $('#GComplain').val()|| 
		complain_check != $('#complain_check').is(':checked')|| 
		car_no != $('#car-no').val()|| 
		actual_from_time != $('input[name=actualy-from]').val()|| 
		actual_to_time != $('input[name=actualy-to]').val()
		)
	{
		var rs = confirm('Data entered will be lose. Are you sure to exit ?');
		if(rs == true)
			location.href='<?php echo base_url();?>optional-tour/optional-tour-transfer';
	}
	else
	{
		location.href='<?php echo base_url();?>optional-tour/optional-tour-transfer';
	}
}
</script>
<?php echo $this->load->view('Layout/footer');?>