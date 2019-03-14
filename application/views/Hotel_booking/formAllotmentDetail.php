<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.dataTables_info {
	display: none;
}

#table-allotment-list_filter {
	display: none;
}

#table-allotment-list {
	white-space: nowrap;
	table-layout: fixed;
}

#table-allotment-list td {
	overflow: hidden;
	text-overflow: ellipsis;
}

.dataTables_scrollHeadInner td {
	overflow: hidden;
	text-overflow: ellipsis;
}

.dataTables_scrollHeadInner table {
	white-space: nowrap;
	table-layout: fixed;
}
</style>
<div class="content">
	<div class="container">
		<h4>
			ALLOTMENT DETAIL
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='<?php echo base_url();?>hotel-booking'">Back</button>
		</h4>
		<div class="row line-strong" style="margin-top: 20px;"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Information</label>
			</div>
			<div class="col-md-10 form-margin-bottom">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="label-item">City Name</label> <select id="city"
								class="form-control input-sm select-size-md">
								<option value=""></option>
		    					<?php
        if ($city) {
            foreach ($city as $row) {
                ?>
								    <option value="<?php echo $row['city']?>"><?php echo $row['city']?></option>
								<?php

}
        }
        ?>	
		    				</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="label-item">Hotel Name</label> <select id="hotel"
								class="form-control input-sm select-size-md">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="label-item">R/Class</label> <select id="room-class"
								class="form-control input-sm select-size-md">
								<option value=""></option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group form-inline form-margin-bottom">
							<label for="tourcode" class=" label-item ">Add More</label> <input
								type="checkbox" id="check-add-more">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-inline form-group">
							<label class="label-item">Cut Of Time</label> <input id="cut-day"
								class="check_num" type="text" size="1" disabled> (Day)
						</div>
					</div>
					<div class="col-md-5 form-margin-bottom">
						<div class=" form-inline">
							<label class="label-item">From Date</label>
							<div id="from-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="from-date"
								data-input="form-control input-sm"
								data-date="<?php echo date('Y/m/d')?>"></div>
							<!-- <input type="text" id="from-date" class="form-group select-size date-format" disabled> -->
						</div>
					</div>
					<div class="col-md-4">
						<div class=" form-inline">
							<label class="label-item">To Date</label>
							<div id="to-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="to-date"
								data-input="form-control input-sm"
								data-date="<?php echo date('Y/m/d')?>"></div>
						</div>
					</div>
				</div>
				<div class="row ">
					<div class="col-md-3 form-margin-bottom">
						<div class="form-inline">
							<label class=" label-item " style="width: 120px;">Room No / Day</label>
							<input id="room-day" class="check_num" type="text" size="1"
								disabled>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-inline">
							<label class=" label-item " style="width: 120px;">Room No / Times</label>
							<input id="room-time" class="check_num" type="text" size="1"
								disabled>
						</div>
					</div>
				</div>
				<div class="row">
					<div class=" col-md-10">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Note</label>
								<textarea class="form-control" name="" id="note" cols="100"
									rows="2" disabled></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1 col-md-offset-1">
				<div class="button-action-div">
					<button class="btn btn-primary button-sm btn-sm btn-action"
						onclick="search_allotment_price()">Search</button>
					<button id="button-add"
						class="btn btn-primary button-sm btn-sm btn-action"
						onclick="create_allotment_price()" disabled="true">Add</button>
					<button class="btn btn-primary button-sm btn-sm btn-action"
						onclick="clear_data()">Clear</button>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Allotment List</label>
			</div>
			<div class="row">
				<div class="col-md-10">
					<div id="div-allotment-list" class="list-scroll">
						<table id="table-allotment-list" class="cell-border"
							style="margin: 0px">
							<thead>
								<td title="Hotel Name" style="">Hotel Name</td>
								<td title="Room Class" style="">Room Class</td>
								<td title="Room No" style="">Room No</td>
								<td title="Room Day" style="" id="rom_day">Room Day</td>
								<td title="Cut Of Time" style="">Cut Of Time</td>
								<td title="From Date" style="">From Date</td>
								<td title="To Date" style="">To Date</td>
								<td title="Note" style="">Note</td>
							</thead>
							<tbody>
								<?php
        if ($allotment_info) {
            foreach ($allotment_info as $key => $row) {
                ?>
										   	<tr id='alloment-<?php echo $key+1; ?>'
									onclick="select_alloment_price('<?php echo $row["AllotmentID"]; ?>',<?php echo $key+1;?>)">
									<input type="hidden" value="<?php echo $row["AllotmentID"]; ?>">
									<td id="hotel_name_<?php echo $key+1 ?>"
										title='<?php echo $row["HotelName"]; ?>' style=''><?php echo $row["HotelName"]; ?></td>
									<td id="room_class_<?php echo $key+1 ?>"
										title='<?php echo $row["RoomClass"]; ?>' style=''><?php echo $row["RoomClass"]; ?></td>
									<td title='<?php echo $row["RoomNo"]; ?>' style=''><input
										onblur="calculate_room_no(<?php echo $key +1 ?>)" type="text"
										id='room_no_<?php echo $key+1; ?>'
										value='<?php echo $row["RoomNo"]; ?>'
										style='border: none; width: 70%;'>
										<div style="display: none" class="hidden"
											id="hidden_room_no_<?php echo $key+1; ?>"><?php echo $row["RoomNo"] ?></div>
									</td>
									<td title='<?php echo $row["RoomDay"]; ?>' style=''><input
										onblur="calculate_room_no(<?php echo $key +1 ?>)" type="text"
										id='room_day_<?php echo $key+1; ?>'
										value='<?php echo $row["RoomDay"]; ?>'
										style='border: none; width: 70%;'>
										<div style="display: none" class="hidden"
											id="hidden_room_day_<?php echo $key+1; ?>"><?php echo $row["RoomDay"] ?></div>
									</td>
									<td id="cut_of_time_<?php echo $key+1 ?>"
										title='<?php echo $row["CutOfTime1"]; ?>' style=''><?php echo $row["CutOfTime1"]; ?></td>
									<td id="from_date_<?php echo $key+1 ?>"
										title='<?php echo $row["FromDate"]; ?>' style=''><?php echo $row["FromDate"]; ?></td>
									<td id="to_date_<?php echo $key+1 ?>"
										title='<?php echo $row["ToDate"]; ?>' style=''><?php echo $row["ToDate"]; ?></td>
									<td id="note_<?php echo $key+1 ?>"
										title='<?php echo $row["Note"]; ?>' style=''><?php echo $row["Note"]; ?></td>
								</tr>
								<?php

}
        }
        ?>	
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-2">
					<div class="button-action-div">
						<button class="btn btn-sm button-lg btn-primary btn-action"
							onclick="update_alloment_price()">Update</button>
						<br>
						<button class="btn btn-sm button-lg btn-primary btn-action"
							onclick="delete_allotment_detail()">Delete</button>
						<br>
						<button class="btn btn-sm button-lg btn-primary btn-action"
							onclick="reset_select()">Reset</button>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var selected_alloment = "";
	var selected_no = "";
	var alowmentTable;
	/* Create an array with the values of all the input boxes in a column, parsed as numbers */
	$.fn.dataTable.ext.order['dom-text-numeric'] = function  ( settings, col )
	{
		return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
			return $('input', td).val() * 1;
		} );
	}


	$(document).ready(function(){
		flag_check_todate=true;
		check_date();
		$('.hidden').css('display','none');
		//Duong- paint nhung dong` co roomNo và roomDay = 0
		check_value();
		//end Duong- paint nhung dong` co roomNo và roomDay = 0

		//Dương===========================================
		//validate input number only
		$('.check_num').keydown(function(e){
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				// Allow: Ctrl+A, Command+A
				(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
				// Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
				// let it happen, don't do anything
				return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		//validate fromdate and todate
		
		$('#to-date').on('change.bfhdatepicker',(function(){
			check_date();
		}));
		//end Dương=======================================
		alowmentTable = $('#table-allotment-list').DataTable({
				responsive: true,
  				paging:false,
  				scrollY: 140,
  				scrollX: false,
  				searching:false,
  				info: false,
				columns: [
					null,
					null,
					{ "orderDataType": "dom-text-numeric" },
					{ "orderDataType": "dom-text-numeric" },
					null,
					null,
					null,
					null
				]
			});

//		$('#table-allotment-list tbody').on( 'click', 'td', function () {
//			alert( alowmentDatatable.cell( this ).data() );
//		} );
		// $('.dataTables_scrollHead').height(23);
		$('input[name=from-date]').prop('disabled', true);
  		$('#from-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=from-date]').val())){
  				$('input[name=from-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  				setTimeout(function(){
  					$('input[name=from-date]').focus();
  				},1);
  			} else {
  				$('input[name=from-date]').css('border', "1px solid #ccc");
  				if ($('input[name=from-date]').val()!=""&&$('#room-day').val()!=""){
  					var date_from = new Date($('input[name=from-date]').val());
  					var date_to = new Date($('input[name=to-date]').val());
  					var result = ((date_to - date_from)/(1000*60*60*24)+1)*parseInt($('#room-day').val());
  					if(result >= 0)
  						$("#room-time").val(result);
  					else
  						alert('Error date. Please try again');
  				}
  			}
		});
		$('input[name=to-date]').prop('disabled', true);
  		$('#to-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=to-date]').val())){
  				$('input[name=to-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  				setTimeout(function(){
  					$('input[name=to-date]').focus();
  				},1);
  			} else {
  				$('input[name=to-date]').css('border', "1px solid #ccc");
  				if ($('input[name=to-date]').val()!=""&&$('#room-day').val()!=""){
  					var date_from = new Date($('input[name=from-date]').val());
  					var date_to = new Date($('input[name=to-date]').val());
  					var result = ((date_to - date_from)/(1000*60*60*24)+1)*parseInt($('#room-day').val());
  					$("#room-time").val(result);
  				}
  			}
		});

  		$("#room-day").change().blur(function(){
  			if ($('input[name=to-date]').val()!="" && $('input[name=from-date]').val()!=""){
  				var date_from = new Date($('input[name=from-date]').val());
  				var date_to = new Date($('input[name=to-date]').val());
  				var result = ((date_to - date_from)/(1000*60*60*24)+1)*parseInt($('#room-day').val());
  				if(result >= 0)
  				{
  					$("#room-time").val(result);
  				}
  				else
  				{
  					alert('Error date. Please try again');
  				}
  				
  			}
  			else
  				{
  					alert('Error date. Please try again');
  				}
  		});
		$("#check-add-more").change(function(){
			if($('#check-add-more').is(':checked')){
				$('#button-add').prop('disabled', false);
				$('#note').prop('disabled', false);
				$('#cut-day').prop('disabled', false);
				$('input[name=from-date]').prop('disabled', false);
				$('input[name=to-date]').prop('disabled', false);
				$("#from-date").children().prop('disabled', false);
				$("#to-date").children().prop('disabled', false);
				$('#room-day').prop('disabled', false);
				$('#room-time').prop('disabled', false);
				$('#note').prop('disabled', false);
			} else {
				$('#button-add').prop('disabled', true);
				$('#note').prop('disabled', true);
				$('#cut-day').prop('disabled', true);
				$("#from-date").children().prop('disabled', true);
				$("#to-date").children().prop('disabled', true);
				$('input[name=from-date]').prop('disabled', true);
				$('input[name=to-date]').prop('disabled', true);
				$('#room-day').prop('disabled', true);
				$('#room-time').prop('disabled', true);
				$('#note').prop('disabled', true);
			}
		});
		$('#city').change(function () {
	    	var city=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('HotelBookingController/get_hotel_by_city'); ?>",
	            async: false,
	            type: "POST",  
	            data: "city="+ city, 
	            dataType: "html",				                         
	            success: function(data) {
	                $('#hotel').html(data);
	            }
	        });
	 	});

	 	$('#hotel').change(function () {
	    	var dt = {
	    		city 	: 	$("city").val(),
	    		hotel 	: 	$(this).val()
	    	};
	        $.ajax({   
	            url: "<?php echo base_url('HotelBookingController/get_room_hotel'); ?>",
	            async: false,
	            type: "POST",  
	            data: dt, 
	            dataType: "html",		                         
	            success: function(data) {
	                $('#room-class').html(data);
	            }
	        });
	 	});

	 	$('#room-day').change(function(){
	 		if (isNaN($('#room-day').val())){
	 			alert("Wrong Input of Room Day");
	 			$('#room-day').val("");
	 		}
	 	});	 	
	 	$('#table-allotment-list tbody tr').first().find("div").css("display","block");
	 	$('#table-allotment-list tbody tr').first().css("background","#397FDB");
	 	selected_no = $('#table-allotment-list tbody tr').first().attr("id");
	 	selected_alloment = $('#table-allotment-list tbody tr').first().find("div").find("input").val();
	});
function select_alloment_price(AllotmentID,key){
	$('#'+selected_no).css('background','transparent');
	$('.null').css('background','#ff9900');
	$("#"+selected_no+ " td:nth-child(1)").find("div").css("display","none");
	$("#"+key+ " td:nth-child(1)").find("div").css("display","block");	
	$("#alloment-"+key).css("background","#397FDB");
	selected_alloment = AllotmentID;
	selected_no = "alloment-"+key;
}

function search_allotment_price(){
	//$('#table-allotment-list').dataTable().fnDestroy();
	city_searched = $("#city").val();
	hotel_searched = $("#hotel").val();
	var dt = {
	   	city	: 	$("#city").val(),
	   	hotel 	: 	$("#hotel").val()
	};
	$.ajax({   
	    url: "<?php echo base_url('HotelBookingController/search_allotment_price'); ?>",
	    type: "POST",  
	        data: dt, 
	        dataType: "json",		
	        beforeSend: function(){
		    	$("body").css("cursor", "wait");
			},    
			complete: function() {
				$("body").css("cursor","default");
			},                          
	       	success: function(data) {
	       		$('#div-allotment-list').html('<table id="table-allotment-list" class="cell-border" style="margin:0px"></table>');
	       		var output = "";
				var dataNotFound = false;
	        	$.each (data, function(key, opj) {
		    		if (key=="msg"){
		    			if (opj=="false"){
		    				$("body").css("cursor","default");
			    			output += "<thead>";
							output += "<td title='Hotel Name' >Hotel Name</td>";
							output += "<td title='Room Class' >Room Class</td>";
							output += "<td title='Room No' >Room No</td>";
							output += "<td title='Room Day'>Room Day</td>";
							output += "<td title='Cut Of Time' >Cut Of Time</td>";
							output += "<td title='From Date' >From Date</td>";
							output += "<td title='To Date' >To Date</td>";
							output += "<td title='Note' >Note</td>";
						output += "</thead>";
							dataNotFound = true;
			    		}

		    		} else {
		    			output += "<thead>";
							
							output += "<td title='Hotel Name' >Hotel Name</td>";
							output += "<td title='Room Class' >Room Class</td>";
							output += "<td title='Room No' >Room No</td>";
							output += "<td title='Room Day'>Room Day</td>";
							output += "<td title='Cut Of Time' >Cut Of Time</td>";
							output += "<td title='From Date' >From Date</td>";
							output += "<td title='To Date' >To Date</td>";
							output += "<td title='Note' >Note</td>";
						output += "</thead>";
		    			$.each (opj, function(key, row) {
			    			output += "<tr role='row' id='alloment-"+(key+1)+"' onclick=\"select_alloment_price('"+row["AllotmentID"]+"',"+(key+1)+")\">";
								output += "<input type='hidden' value='"+row["AllotmentID"]+"'>";
							    output += "<td  title='"+((row["HotelName"]!=null)?row["HotelName"]:"")+"'>"+((row["HotelName"]!=null)?row["HotelName"]:"")+"</td>";;
							    output += "<td  title='"+((row["RoomClass"]!=null)?row["RoomClass"]:"")+"'>"+((row["RoomClass"]!=null)?row["RoomClass"]:"")+"</td>";;
							    output += "<td><input onchange='calculate_room_no("+(key+1)+")' type='text' id='room_no_"+(key+1)+"' value='"+((row["RoomNo"]!=null)?row["RoomNo"]:"")+"' style='width:70%;border:none;text-align:left'><div style='display:none' class='hidden' id='hidden_room_no_"+(key+1)+"'>"+((row["RoomNo"]!=null)?row["RoomNo"]:"")+"</div></td>";
							    output += "<td><input onchange='calculate_room_no("+(key+1)+")' type='text' id='room_day_"+(key+1)+"' value='"+((row["RoomDay"]!=null)?row["RoomDay"]:"")+"' style='width:70%;border:none;text-align:left'><div style='display:none' class='hidden' id='hidden_room_day_"+(key+1)+"'>"+((row["RoomDay"]!=null)?row["RoomDay"]:"")+"</div></td>";
							    output += "<td  title='"+((row["CutOfTime1"]!=null)?row["CutOfTime1"]:"")+"'>"+((row["CutOfTime1"]!=null)?row["CutOfTime1"]:"")+"</td>";;
							    output += "<td  id='from_date_"+(key+1)+"'  title='"+((row["FromDate"]!=null)?row["FromDate"]:"")+"'>"+((row["FromDate"]!=null)?row["FromDate"]:"")+"</td>";;
							    output += "<td  id='to_date_"+(key+1)+"' title='"+((row["ToDate"]!=null)?row["ToDate"]:"")+"'>"+((row["ToDate"]!=null)?row["ToDate"]:"")+"</td>";;
							    output += "<td  title='"+((row["Note"]!=null)?row["Note"]:"")+"'>"+((row["Note"]!=null)?row["Note"]:"")+"</td>";;
							output += "</tr>";
			        	});
		    		}
		    	});

				$("#table-allotment-list").html(output);
				$('#table-allotment-list tbody tr').first().find("div").css("display","block");
	 			$('#table-allotment-list tbody tr').first().css("background","#397FDB");
	 			selected_no = $('#table-allotment-list tbody tr').first().attr("id");
	 			check_value();
	 			selected_alloment = $('#table-allotment-list tbody tr').first().find("div").find("input").val();

				if (!dataNotFound) {
					alowmentTable = $('#table-allotment-list').DataTable({
						responsive: true,
						paging:false,
						scrollY: 140,
						scrollX: false,
						searching:false,
						info: false,
						columns: [
							null,
							null,
							{ "orderDataType": "dom-text-numeric" },
							{ "orderDataType": "dom-text-numeric" },
							null,
							null,
							null,
							null
						]
					});
				} else {
					$('#table-allotment-list').dataTable({
						responsive: true,
						paging:false,
						scrollY: 140,
						scrollX: false,
						searching:false,
						info: false
					});
				}

	    }
	});
		
}

function create_allotment_price(){
	var r = confirm("You sure to add new alloment!");
	if (r){
		if ($("#city").val()==""){
			alert("Empty City. Please try again");
		} else if($("#hotel").val()==""){
			alert("Empty Hotel. Please try again");
		} else if($("#room-class").val()==""){
			alert("Empty Room. Please try again");
		} else if(!flag_check_todate){
			alert('Error date. Please try again');
		}else if($("#room-day").val()==""){
			alert("Empty Room No / Day. Please try again");
		} else if($("#room-time").val()==""){
			$("#room-time").val(0);
			if (isNaN($('#room-time').val())){
		 		alert("Wrong Input of Room no");
		 		$('#room-day').val("");
		 		return;
		 	}
		 	var dt = {
		    	data	: 	create_array_data()
		   	};
		    $.ajax({   
		        url: "<?php echo base_url('HotelBookingController/create_allotment_price'); ?>",
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

					alert(data['msg']);
					if(data['status'] == 'success')
					{
						$("#check-add-more").click();
						$("#cut-day").val("");
			       		$("#room-day").val("");
			       		$("#room-time").val("");
			       		$("#note").val("");
			       		$("#city").val("");
			       		$("#hotel").val("");
			       		$("#room-class").val("");
			       		search_allotment_price();
					}
					
		       	}
		    });
		} else{
			if (isNaN($('#room-time').val())){
		 		alert("Wrong Input of Room Time");
		 		$('#room-day').val("");
		 		return;
		 	}
		 	var dt = {
		    	data	: 	create_array_data()
		   	};
		    $.ajax({   
		        url: "<?php echo base_url('HotelBookingController/create_allotment_price'); ?>",
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
		       		alert(data['msg']);
		       		if(data['status'] == 'success')
					{
			       		$("#check-add-more").click();
			       		$("#cut-day").val("");
			       		$("#room-day").val("");
			       		$("#room-time").val("");
			       		$("#note").val("");
			       		$("#city").val("");
			       		$("#hotel").val("");
			       		$("#room-class").val("");
			       		search_allotment_price();
		       		}
		       	}
		    });
		}
	}
	
}
function create_array_data(){
	var list_result = {
		City			: 	$("#city").val(),
		HotelName		: 	$("#hotel").val(),
		RoomClass		: 	$("#room-class").val(),
		CutOfTime1		: 	$("#cut-day").val(),
		FromDate		: 	$("input[name=from-date]").val(),
		ToDate			: 	$("input[name=to-date]").val(),
		RoomNo			: 	$("#room-time").val(),
		RoomDay			: 	$("#room-day").val(),
		Note 			: 	$("#note").val(),
		Holiday 		: 	"",
		CutOfTime2 		: 	0,
		Status 			: 	"",
		Day 			: 	"",
		AddRoomNo 		: 	0
	}
	return list_result;
}

function delete_allotment_detail(){
	if (selected_alloment==""){
		alert("No allotment selected!");
	} else {
		var r = confirm("Are you sure to delete allotment!");
		if (r){
			var dt = {
			    id	: 	selected_alloment
			};
			$.ajax({   
			    url: "<?php echo base_url('HotelBookingController/delete_allotment_price'); ?>",
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
			   		$.each(data,function(key,opj){
			   			if (opj){
			   				$("#"+selected_no).remove();
			   				alert("Delete success!!");
			   			} else {
			   				alert("Delete fail!!");
			   			}
			   		});
			   	}
			});
		}
	}
}

function clear_data(){
	$("#button-add").prop('disabled',true);
	$("#city").val("");
	$("#hotel").val("");
	$("#room-class").val('');
	$("#check-add-more").attr('checked', false);
	$("#cut-day").attr('disabled', true);
	$("#cut-day").val("");
	$("#room-day").attr('disabled', true);
	$("#room-day").val("");
	$("#note").attr('disabled', true);
	$("#note").val("");
	$('#room-time').prop('disabled', true);
	$("#room-time").val("");
	$("#from-date").children().prop('disabled', true);
	$("#to-date").children().prop('disabled', true);
	$("input[name=from-date]").prop('disabled', true);
	$("input[name=from-date]").val("");
	$("input[name=to-date]").prop('disabled', true);
	$("input[name=to-date]").val("");
}

function reset_select(){	
	clear_data();
	search_allotment_price();
}
city_searched='';
hotel_searched='';

function array_data_allotment(){
		var i = 1;
		var rowCount = $('#table-allotment-list tbody tr').length;
		var list_result = [];
		for (i=1;i<=rowCount;i++){
		
				list_result.push({
					'allotment_id': $('#table-allotment-list tbody tr:nth-child('+i+')  input').val(),
					'room_no':$('#table-allotment-list tbody tr:nth-child('+i+') td:nth-child(4) input').val(),
					'room_day':$('#table-allotment-list tbody tr:nth-child('+i+') td:nth-child(5) input').val()
				});
			
		}
		console.log(list_result);
		return list_result;
	}
function update_alloment_price()
{  
	updated_city = city_searched;
	updated_hotel = hotel_searched;
	var dt = {
                allotment_list: array_data_allotment()
            };
	$.ajax({   
	    url: "<?php echo base_url('HotelBookingController/update_alloment_price'); ?>",
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
	   		$('#check-add-more').prop('checked',false);
   			$('#button-add').prop('disabled', true);
			$('#note').prop('disabled', true);
			$('#cut-day').prop('disabled', true);
			$("#from-date").children().prop('disabled', true);
			$("#to-date").children().prop('disabled', true);
			$('input[name=from-date]').prop('disabled', true);
			$('input[name=to-date]').prop('disabled', true);
			$('#room-day').prop('disabled', true);
			$('#room-time').prop('disabled', true);
			$('#note').prop('disabled', true);
	   		alert(data['mes']);	   				   		
			city_searched='';
			hotel_searched='';
			search_allotment_price();
	   	}
	});			
}
function calculate_room_no(id)
{
	var fromdate = $('#from_date_'+id).html().replace(/-/g, "/");
	var todate = $('#to_date_'+id).html().replace(/-/g, "/");
	var array_fromdate = fromdate.split('/');
	var array_todate = todate.split('/');
	var fromdate_date = new Date(parseInt(array_fromdate[0]),parseInt(array_fromdate[1])-1,parseInt(array_fromdate[2]));
	var todate_date = new Date(array_todate[0],array_todate[1]-1,array_todate[2]);
	var difference = (todate_date.getTime()-fromdate_date.getTime())/86400000;
	var result = (difference + 1)*$('#room_day_'+id).val();
	$('#room_no_'+id).val(result);
	$('#hidden_room_day_'+id).html($('#room_day_'+id).val());
	$('#hidden_room_no_'+id).html($('#room_no_'+id).val());

	$('.dataTables_scrollHead').height(23);

	var _order = alowmentTable.order();
	var _orderColumn = _order[0][0];
	var _orderType = _order[0][1]; // asc or desc
	if (_orderColumn == 3) {
		alowmentTable.order( [ _orderColumn, _orderType ] ).draw();
	}

	check_value();
}

function check_value()
{
	var i = 1;
	var rowCount = $('#table-allotment-list tbody tr').length;
	for (i=1;i<=rowCount;i++){
			var	room_no = $('#table-allotment-list tbody tr:nth-child('+i+') td:nth-child(4) input').val();
			var	room_day = $('#table-allotment-list tbody tr:nth-child('+i+') td:nth-child(5) input').val();
		if(room_no == 0 && room_day == 0)
		{
			$('#table-allotment-list > tbody > tr:nth-child('+i+')').attr('class','null');
		}
	}
}

$("#table-allotment-list input[type=text]").keydown(function(e){
//	if (e.charCode != 0 && (e.charCode < 48 || e.charCode > 57)) return false;
	if (e.keyCode == 13) {
		var _inputId = $(this).attr('id');
		calculate_room_no(_inputId.substr(9, _inputId.length));
		return;
	}

	// Allow: backspace, delete, tab, escape and .
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 110, 190]) !== -1 ||
		// Allow: Ctrl+A, Command+A
		(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
		// Allow: home, end, left, right, down, up
		(e.keyCode >= 35 && e.keyCode <= 40)) {
		// let it happen, don't do anything
		return;
	}
	// Ensure that it is a number and stop the keypress
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});

function check_date()
{
	var from_date = $('input[name=from-date]').val();
	var to_date = $('input[name=to-date]').val();

	var array_fromdate = from_date.split('/');
	var array_todate = to_date.split('/');
	var fromdate_date = new Date(parseInt(array_fromdate[0]),parseInt(array_fromdate[1])-1,parseInt(array_fromdate[2]));
	var todate_date = new Date(array_todate[0],array_todate[1]-1,array_todate[2]);
	var difference = todate_date.getTime()-fromdate_date.getTime()
	if(difference <= 0 || isNaN(difference) || from_date=='' || to_date =='')
	{
		flag_check_todate = false;
	}
	else
	{
		flag_check_todate= true;
	}
}
</script>
<?php echo $this->load->view('Layout/footer');?>
</div>

