<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.tb-tr-selected {
	background: #397FDB none repeat scroll 0% 0%;
}

.dataTables_info {
	display: none;
}

#table-tour-info_filter {
	display: none;
}

#div-tour-info, #div-transfer-detail {
	overflow: hidden;
}

#table-tour-info-home thead tr th, #table-booking-info thead tr th {
	padding: 0px !important;
}

#table-tour-info {
	white-space: nowrap;
	table-layout: fixed;
}

#table-tour-info td {
	overflow: hidden;
	text-overflow: ellipsis;
}

.dataTables_scrollHeadInner table {
	white-space: nowrap;
	table-layout: fixed;
}

.dataTables_scrollHeadInner td {
	overflow: hidden;
	text-overflow: ellipsis;
}
</style>
<div class="content">

	<div class="container">
		<h3 style="margin-top: 6px; margin-bottom: 0px;">UPDATE TOUR
			INFORMATION</h3>
		<div class="row line-strong"
			style="margin-top: 0px; margin-bottom: 12px;"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields </label>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Tour Code</label> <input type="text"
								id="tour-code" class="form-control input-sm select-size"
								placeholder="Tour Code"
								value="<?php if(isset($search_tourinfo['tourcode'])){echo $search_tourinfo['tourcode'];}elseif(isset($tour_code)){echo $tour_code;}?>">
							<input type="hidden" id="tourid"
								value="<?php if(isset($tour_id)){ echo $tour_id;}else{echo '';}?>">
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Vn Code</label> <input type="text"
								id="vn-code" class="form-control input-sm select-size"
								placeholder="Vn Code" value="">
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Tour Status</label> <select
								id="tour-status" class="form-control input-sm select-size-md">
								<option value=""></option>
								<option value="RQ">RQ</option>
								<option value="CHG">CHG</option>
								<option value="CXL">CXL</option>
								<option value="OK">OK</option>
								<option value="FNL">FNL</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Guest Name</label> <input type="text"
								id="guest-name" class="form-control input-sm select-size"
								placeholder="Guest Name">
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="checkbox form-margin-top-right">
						<label> <input type="checkbox" id="not-yet-update"> Not yet update
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Infomation</label>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">BKL Code</label> <input type="text"
										id="tlt-Code" class="form-control input-sm select-size-md"
										placeholder="BKL Code">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">City</label> <select id="city"
										class="form-control input-sm select-size-md">
										<option></option>
										<option></option>
										<?php
        if ($city) {
            foreach ($city as $row) {
                ?>
											<option value="<?php echo $row['City']?>"><?php echo $row['City']?></option>
											<?php

}
        }
        ?>	

									</select>
								</div>
							</div>

						</div>
						<div class="col-md-6">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item-sm">Hotel</label> <select id="hotel"
										class="form-control input-sm select-size-md">
										<option></option>
									</select>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-6">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Date</label>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item-md">Flight In</label> <input
									type="text" id="flight-in"
									class="form-control input-sm select-size-md"
									placeholder="Flight In">
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item-md">Flight Out</label> <input
									type="text" id="flight-out"
									class="form-control input-sm select-size-md"
									placeholder="Flight Out">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Date In</label>
								<div id="date-in" class="form-group bfh-datepicker select-size"
									data-placeholder="yyyy-mm-dd" data-format="y-m-d"
									data-align="right" data-name="date-in"
									data-input="form-control input-sm" data-date=""></div>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Date Out</label>
								<div id="date-out" class="form-group bfh-datepicker select-size"
									data-placeholder="yyyy-mm-dd" data-format="y-m-d"
									data-align="right" data-name="date-out"
									data-input="form-control input-sm" data-date=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="button-action-div-1">
					<button class="btn btn-primary btn-sm button-sm btn-action"
						onclick="clear_data()">Clear</button>
					<button
						class="btn-search btn btn-primary btn-sm button-sm btn-action"
						onclick="get_data_search_1()">Search</button>
					</br>
				</div>
			</div>

		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-8">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Common Tour Information</label>
					</div>
					<div class="list-scroll" id="div-tour-info" style="height: 150px">
						<table id="table-tour-info" onscroll="get_data_search()"
							class="cell-border" style="width: 100%"></table>

					</div>
					<div class="row btn-center">
						<form method="post"
							action="<?php echo base_url('TransferController/export_ExcelTourInfoForm') ?>">
							<input type="hidden" name="tour-id" id="tour_id" value=""> <input
								type="hidden" name="tltcode" id="tltcode" value=""> <input
								type="hidden" name="tourcode" id="tourcode" value=""> <input
								type="hidden" name="vncode" id="vncode" value=""> <input
								type="submit" id="print-tour-info"
								class="btn btn-primary btn-sm button-xlg btn-print"
								style="font-weight: 900;" value="Print Tour Information"
								onclick="return check_print()">
					
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-2">
					<?php //echo form_open('transfer-management/update-in-transfer'); ?>
					<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Tour Guest</label>
					</div>
					<div id="div-guest-tour" class="list-scroll">
							<?php if($guest!=""){?>
							<table id="guest-tour" class="table table-fixed">
							<thead>
								<td style="width: 174px;">Guest Name</td>
							</thead>
							<tbody>
									<?php foreach($guest as $key => $row){?>
									<tr id="<?php echo "guest-tour-".$row['GuestID'];?>"
									onclick="select_guest_tour(<?php echo $row['GuestID'];?>)">
									<td style="width: 174px;"><?php echo $row['GuestName'];?></td>
								</tr>                                                           
									<?php }?>    
								</tbody>
								<?php }else{?>
								<table id="guest-tour" class="table table-fixed"></table>
								<?php }?>
							</table>
					</div>
					<div class="row btn-center">
						<button type="submit" class="btn btn-primary btn-sm button-lg"
							onClick="update_optional_tour()" disabled="true"
							id="update_optional">Update Optional Tour</button>
					</div>
					<div class="row btn-center">
						<button class="btn btn-primary btn-sm button-lg" disabled="true"
							id="update_guest" onclick="update_guest()">Update Guest</button>
					</div>
				</div>
					<?php //echo form_close();?>
				</div>
			<div class="col-md-2">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Transfered Guest</label>
					</div>
					<div id="div-guest-transfer" class="list-scroll">

						<table id="guest-transfer" class="table table-fixed">

						</table>


					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
			<?php //echo form_open('transfer-management/update-transfer-detail'); ?>
			<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Update Transfer Detail</label>
			</div>
			<div class="col-md-10">
				<div class="list-scroll" id="div-transfer-detail">
					<table class="cell-border" id="table-transfer-detail">
					</table>
				</div>
			</div>
			<div class="col-md-2">
				<div class="button-action-div">
					<button class="btn btn-primary btn-sm button-lg btn-action"
						onclick="create_copy()" id="cr_copy" disabled="true">Create Copy</button>
					<br>
					<button type="submit"
						class="btn btn-primary btn-sm button-lg btn-action"
						onClick="getUpdate()" disabled="true" id="update">Update</button>
					<br>
					<button class="btn btn-primary btn-sm button-lg btn-action"
						onclick="javascript: delete_current_booking();" disabled="true"
						id="delete">Delete</button>
					<br>
				</div>
			</div>
		</div>

	</div>

</div>
<script
	src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript"> 
		var select_tour = "";
		var select_tlt = "";
		var select_booking_id = "";
		var select_bkl_code = "";
		var tour_code ="";
		var vn_code   ="";
		var search_condition_obj={};
		$(document).ready(function(){			
			var check_tourinfo = '<?php echo isset($search_tourinfo);?>';
			if(check_tourinfo||$("#tourid").val()!="")
			{
				get_data_search();
				var times  = setInterval(function(){
					if($("#table-tour-info").length>0){
						clearInterval(times);
						get_info_booking($("#tourid").val());
					}
				},5000);
			}

			$('input[name=date-in]').attr('id', 'date-in');
			$('input[name=date-out]').attr('id', 'date-out');

			$('input[name=date-in]').attr('readonly', false);
			$('input[name=date-in]').on("change.bfhdatepicker",function () {
				if (!isdate($('input[name=date-in]').val())){
					$('input[name=date-in]').css('border', "1px solid red");
					window.alert("Input Invalid");
				} else {
					$('input[name=date-in]').css('border', "1px solid #ccc");
				}
			});

			$('input[name=date-out]').attr('readonly', false);
			$('#date-out').on("change.bfhdatepicker",function () {
				if (!isdate($('input[name=date-out]').val())){
					$('input[name=date-out]').css('border', "1px solid red");
					window.alert("Input Invalid");
				} else {
					$('input[name=date-out]').css('border', "1px solid #ccc");
				}
			});
			/*get hotel when select city*/
			$('#city').change(function () {
				var city=$(this).val();
				$.ajax({   
					url: "<?php echo base_url('TransferController/get_hotel'); ?>",
					async: false,
					type: "POST",  
					data: "city="+ city, 
					dataType: "html",				                         
					success: function(data) {
						$('#hotel').html(data);
					}
				});
			});
		
		});

/*get data after click search*/
var i = 0;
pos = 0;
flag = true;
function get_data_search_1(){
	var dt = {
		tour_code		: 	$("#tour-code").val(),
		vn_code			: 	$("#vn-code").val(),
		tour_status		: 	$("#tour-status").val(),
		guest_name		: 	$("#guest-name").val(),
		not_yet_update    : 	$("#not-yet-update").is(':checked'),
		tlt_code		: 	$("#tlt-Code").val(),
		city 			: 	$("#city").val(),
		hotel 			: 	$("#hotel").val(),
		flight_in		: 	$("#flight-in").val(),
		flight_out		: 	$("#flight-out").val(),
		date_in			: 	$("input[name=date-in]").val(),
		date_out 		: 	$("input[name=date-out]").val(),
		vi_tri			: 	0 
	};
	get_data_search_ajax(dt);

}
function check_print()
{
	if(select_tour=="")
	{
		alert('PLease choose tour to print');
		return false;
	}
	else
	{
		return true;
	}
}
function get_data_search()
{
	if (i == 0)
	{
		pos=0;
		i++;
	}
	else
	{
		pos = pos + 11;
		i++;
	}
	
	var dt = {
		tour_code		: 	$("#tour-code").val(),
		vn_code		: 	$("#vn-code").val(),
		tour_status		: 	$("#tour-status").val(),
		guest_name		: 	$("#guest-name").val(),
		not_yet_update    : 	$("#not-yet-update").is(':checked'),
		tlt_code		: 	$("#tlt-Code").val(),
		city 			: 	$("#city").val(),
		hotel 		: 	$("#hotel").val(),
		flight_in		: 	$("#flight-in").val(),
		flight_out		: 	$("#flight-out").val(),
		date_in		: 	$("input[name=date-in]").val(),
		date_out 		: 	$("input[name=date-out]").val(),
		vi_tri		: 	pos 
	};
	
	if(i == 1)
	{
		get_data_search_ajax(dt);
	}
	else
	{
		get_data_search_ajax_1(dt);
	}

	if($("#tour-code").val() != "" || $("#vn-code").val()	!= "" || $("#tour-status").val()	!= "" ||
		$("#guest-name").val()	!= "" || $("#not-yet-update").is(':checked') != false || $("#tlt-Code").val()	!= "" || $("#city").val()	!= "" ||
		$("#hotel").val()	!= "" || $("#flight-in").val()	!= "" || $("#flight-out").val()	!= "" || $("input[name=date-in]").val()	!= "" || $("input[name=date-out]").val() !="")
	{
		flag = true;
	}
	else
	{
		flag = false;
	}
}

//Nghi add
function get_data_search_ajax(data)
{
	$('#tour_id').val("");
	$('#tltcode').val("");
	$('#tourcode').val("");
	$('#vncode').val("");
	
	
	$.ajax({
		url: "<?php echo base_url('TransferController/get_data_search_tour_info'); ?>",
		type: "POST",  
		data: data, 
		dataType: "json",     
		beforeSend: function(){
			$("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},                    
		success: function(data) {
			$('#div-tour-info').html('<table id="table-tour-info" onscroll="get_data_search()" class="cell-border" style="width: 100%">');
			var output = "";
			output += "<thead>";
			output	+= "<tr>";					
			output	+= "<td id='tour-code-title' title='Tour Code' style='width:135px'>Tour Code</td>";
			output	+= "<td id='vncode-title' title='Vn Code' style='width:85px'>Vn Code</td>";
			output	+= "<td id='status-title'title='Status' style='width:50px'>Status</td>";
			output	+= "<td id='tourstatuschage-title' title='Tour Status Changed' style='width:135px'>Tour Status Changed</td>";
			output	+= "<td id='groupname-title' title='Group Name' style='width:200px'>Group Name</td>";
			output	+= "<td id='nopax-title' title='No.Pax' style='width:45px'>No.Pax</td>";
			output	+= "<td id='note-title' title='Note' style='width:187px'>Note</td>";
			output	+= "</tr>";
			output	+= "</thead>";
			output	+= "<tbody>";
			$.each (data, function(key, opj) {
				if (key=="msg"){
					if (opj=="false"){
						window.alert("Data not found!!!");
						$("#update").attr("disabled",true);
						$("#update_guest").attr("disabled",true);
						$("#update_optional").attr("disabled",true);
						$("#cr_copy").attr("disabled",true);
						$("#delete").attr("disabled",true); 
						$("#table-transfer-detail").html("");
						select_tour ="";
						$("#table-transfer-detail").html("");
						return false;
					}
					else
					{            
						// select_tour ="";                       
						$("#update_guest").attr("disabled",false);
						$("#update_optional").attr("disabled",false);   
						$("#table-transfer-detail").html("");                                 
					}

				} else {
					$.each (opj, function(key, row) {
						output += "<tr id='tour-"+row["TourID"]+"' onclick=get_info_booking('"+row["TourID"]+"')>";		    				
						output += "<td class='tour-code-body' title='"+((row["TourCode"]!=null)?row["TourCode"]:"")+"' style='width:135px'>"+((row["TourCode"]!=null)?row["TourCode"]:"")+"</td>";
						output += "<td class='vncode-body' title='"+((row["VnCode"]!=null)?row["VnCode"]:"")+"' style='width:85px'>"+((row["VnCode"]!=null)?(row["VnCode"]):"")+"</td>";
						output += "<td class='status-body' title='"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"' style='width:50px'>"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"</td>";
						output += "<td class='tourstatuschage-body' title='"+((row["TourStatusDateChange"]!=null)?row["TourStatusDateChange"]:"")+"' style='width:135px'>"+((row["TourStatusDateChange"]!=null)?(row["TourStatusDateChange"]):"")+"</td>";
						output += "<td class='groupname-body' title='"+((row["GroupName"]!=null)?row["GroupName"]:"")+"' style='width:200px'>"+((row["GroupName"]!=null)?row["GroupName"]:"")+"</td>";
						output += "<td class='nopax-body' title='"+((row["NPer"]!=null)?row["NPer"]:"")+"' style='width:45px'>"+((row["NPer"]!=null)?row["NPer"]:"")+"</td>";
						output += "<td class='note-body' title='"+((row["Note"]!=null)?row["Note"]:"")+"' style='width:187px'>"+((row["Note"]!=null)?row["Note"]:"")+"</td>";
						output += "</tr>";
					});
				}
		});
	output	+= "</tbody>";
	$('#table-tour-info').html(output);
	$('#table-tour-info').DataTable({
		responsive: false,
		scrollY: 115,
		paging: false,
		scrollX: false,
		scrollX: true,
		searching:false,
		info:false
	});
		$('.dataTables_scrollHead').height(35);
		$('.dataTables_scrollBody').attr('onscroll','get_data_search()')
		$(".table-fixed").find("tr").css("cursor","default");
	}
	});

}

function get_data_search_ajax_1(data)
{
	$('#tour_id').val("");
	$('#tltcode').val("");
	$('#tourcode').val("");
	$('#vncode').val("");	
	$.ajax({
		url: "<?php echo base_url('TransferController/get_data_search_tour_info'); ?>",
		type: "POST",  
		data: data, 
		dataType: "json",     
		beforeSend: function(){
			$("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},                    
		success: function(data) {	    	
	    	//$('#div-tour-info').html('<table id="table-tour-info" class="cell-border"></table>');
	    	var output = "";
	    	$.each (data, function(key, opj) {
	    		if (key=="msg"){
	    			if (opj=="false")
	    			{
	    				finish = true;
	    				alert("Data Not Found!!");
	    				$("#update").attr("disabled",true);
	    				$("#update_guest").attr("disabled",true);
	    				$("#update_optional").attr("disabled",true);
	    				$("#cr_copy").attr("disabled",true);
	    				$("#delete").attr("disabled",true);
	    				$("#table-transfer-detail").html("");
	    				select_tour ="";
	    				$("#table-transfer-detail").html("");
	    			}
	    			else
	    			{   
	    				// select_tour ="";                                 
	    				$("#update_guest").attr("disabled",false);
	    				$("#update_optional").attr("disabled",false); 
	    				$("#table-transfer-detail").html("");                                   
	    			}
	    		} else {
	    			$.each (opj, function(key, row) {
	    				output += "<tr id='tour-"+row["TourID"]+"' onclick=get_info_booking('"+row["TourID"]+"')>";
	    				output += "<td class='tour-code-body' title='"+((row["TourCode"]!=null)?row["TourCode"]:"")+"' style='width:135px'>"+((row["TourCode"]!=null)?row["TourCode"]:"")+"</td>";
	    				output += "<td class='vncode-body' title='"+((row["VnCode"]!=null)?row["VnCode"]:"")+"' style='width:85px'>"+((row["VnCode"]!=null)?(row["VnCode"]):"")+"</td>";
	    				output += "<td class='status-body' title='"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"' style='width:50px'>"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"</td>";
	    				output += "<td class='tourstatuschage-body' title='"+((row["TourStatusDateChange"]!=null)?row["TourStatusDateChange"]:"")+"' style='width:135px'>"+((row["TourStatusDateChange"]!=null)?(row["TourStatusDateChange"]):"")+"</td>";
	    				output += "<td class='groupname-body' title='"+((row["GroupName"]!=null)?row["GroupName"]:"")+"' style='width:200px'>"+((row["GroupName"]!=null)?row["GroupName"]:"")+"</td>";
	    				output += "<td class='nopax-body' title='"+((row["NPer"]!=null)?row["NPer"]:"")+"' style='width:45px'>"+((row["NPer"]!=null)?row["NPer"]:"")+"</td>";
	    				output += "<td class='note-body' title='"+((row["Note"]!=null)?row["Note"]:"")+"' style='width:187px'>"+((row["Note"]!=null)?row["Note"]:"")+"</td>";
	    				output += "</tr>";
	    			});
}
});
if(flag)
{
	$('#table-tour-info tbody').html(output);
}
else
{
	$('#table-tour-info tbody').append(output);  
}

}
});
}
function get_info_booking(bookingID){	
	select_tlt = "";	
	$("#table-tour-info").find("tr").css("background","transparent");
	$("#tour-"+bookingID).css("background","#397FDB");
	
	select_tour = bookingID;
	if(select_tour!="")
	{
		$("#update_optional").removeAttr("disabled");
		$("#update_guest").removeAttr("disabled");
	}
	tour_code =$("#tour-"+select_tour+" td:nth-child(1)").html();
	vn_code   =$("#tour-"+select_tour+" td:nth-child(2)").html();
        $.ajax({ 
        	url: "<?php echo base_url('TransferController/get_info_booking'); ?>",
        	async: true,
        	type: "POST",  
        	data: "bookingID="+bookingID, 
        	dataType: "json",   
        	beforeSend: function(){
        		$("body").css("cursor", "wait");
        	},    
        	complete: function() {
        		$("body").css("cursor","default");
        	},                
        	success: function(data){   
        		//alert(dat.msg);     	
        		var outputTransfer = "";
        		var outputGuest = "";
        		$.each (data, function(key, opj) {
        			if (key=="transfer"){		    			
        				outputTransfer += "<thead>";
        				outputTransfer	+= "<tr>";
        				outputTransfer	+= "<td style='width:135px'>BKL Code</td>";
        				outputTransfer	+= "<td style='width:40px'>In FLT</td>";
        				outputTransfer	+= "<td style='width:40px'>From</td>";
        				outputTransfer	+= "<td style='width:70px'>Time In</td>";
        				outputTransfer	+= "<td style='width:70px'>Pick In</td>";
        				outputTransfer	+= "<td style='width:90px'>Hotel</td>";
        				outputTransfer	+= "<td style='width:70px'>HTL Status</td>";
        				outputTransfer	+= "<td style='width:70px'>R/Type</td>";
        				outputTransfer	+= "<td style='width:40px'>R/No.</td>";
        				outputTransfer	+= "<td style='width:70px'>Day In</td>";
        				outputTransfer	+= "<td style='width:70px'>Out FLT</td>";
        				outputTransfer	+= "<td style='width:70px'>To</td>";
        				outputTransfer	+= "<td style='width:70px'>Day Out</td>";
        				outputTransfer	+= "<td style='width:70px'>Pick Out</td>";
        				outputTransfer	+= "<td style='width:149px'>Note</td>";
        				outputTransfer	+= "</tr>";
        				outputTransfer	+= "</thead>";
        				outputTransfer	+= "<tbody>";
        				$.each (opj, function(key1, row) 
        				{        					
        					outputTransfer += "<tr id='transfer-"+row["TourID"]+"-"+(row["TLTCode"].trim()).replace("/","")+"' onclick=\"get_guest_transfer('"+row["TourID"]+"','"+(row["TLTCode"].trim())+"')\">";
        					outputTransfer += "<td title='"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"' style='width:135px'>"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["InFlight"]!=null)?row["InFlight"]:"")+"' style='width:40px'>"+((row["InFlight"]!=null)?row["InFlight"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["FromPlace"]!=null)?row["FromPlace"]:"")+"' style='width:40px'>"+((row["FromPlace"]!=null)?row["FromPlace"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["TimeIn"]!=null)?row["TimeIn"]:"")+"' style='width:70px'>"+((row["TimeIn"]!=null)?row["TimeIn"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["PUIn"]!=null)?row["PUIn"]:"")+"' style='width:70px'>"+((row["PUIn"]!=null)?row["PUIn"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["Hotel"]!=null)?row["Hotel"]:"")+"' style='width:90px'>"+((row["Hotel"]!=null)?row["Hotel"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["HotelStatus1"]!=null)?row["HotelStatus1"]:"")+"' style='width:70px'>"+((row["HotelStatus1"]!=null)?row["HotelStatus1"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"' style='width:70px'>"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["RoomNo1"]!=null)?row["RoomNo1"]:"")+"' style='width:40px'>"+((row["RoomNo1"]!=null)?row["RoomNo1"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"' style='width:70px'>"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["OutFlight"]!=null)?row["OutFlight"]:"")+"' style='width:70px'>"+((row["OutFlight"]!=null)?row["OutFlight"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["ToPlace"]!=null)?row["ToPlace"]:"")+"' style='width:70px'>"+((row["ToPlace"]!=null)?row["ToPlace"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"' style='width:70px'>"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["PUOutTo"]!=null)?row["PUOutTo"]:"")+"' style='width:70px'>"+((row["PUOutTo"]!=null)?row["PUOutTo"]:"")+"</td>";
        					outputTransfer += "<td title='"+((row["Note1"]!=null)?row["Note1"]:"")+"' style='width:149px'>"+((row["Note1"]!=null)?row["Note1"]:"")+"</td>";
        					outputTransfer += "</tr>";
        				});
					outputTransfer	+= "</tbody>";
					var times  = setInterval(function () {
						if($("#table-transfer-detail > tbody > tr").length>0)
						{
							select_tlt = $("#table-transfer-detail > tbody > tr > td:nth-child(1)").html();
							clearInterval(times);
							get_guest_transfer(select_tour, select_tlt);
						}
					}, 100);
					}	
					if(key=="msg"&&opj=="true")
					{	
						$("#cr_copy").attr("disabled",true);
						$("#delete").attr("disabled",true);
						$("#update").attr("disabled",true);
					}
					if(key=="msg"&&opj=="") 
					{
						$("#cr_copy").attr("disabled",false);
						$("#delete").attr("disabled",false);
						$("#update").attr("disabled",false);
					}		
					if (key=="guest") {
						outputGuest += "<thead>";
						outputGuest += "<td style='width:174px'>Guest Name</td>";
						outputGuest += "</thead>";
						outputGuest	+= "<tbody>";
						$.each (opj, function(key1, row) {
							outputGuest += "<tr id='guest-tour-"+row["GuestID"]+"' onclick=select_guest_tour('"+row["GuestID"]+"')>";
							outputGuest += "<td style='width:174px'>"+((row["GuestName"]!=null)?row["GuestName"]:"")+"</td>";
							outputGuest += "</tr>";
						});
						outputGuest	+= "</tbody>";
					};
				});
				outputTransfer = '<table class="cell-border" id="table-transfer-detail">' + outputTransfer + "</table>";
				$('#div-transfer-detail').html(outputTransfer);
				$('#guest-tour').html(outputGuest);

				$('#tour_id').val(select_tour);
				$('#tltcode').val(select_tlt);
				$('#tourcode').val(tour_code);
				$('#vncode').val(vn_code);
				// console.log($("#table-transfer-detail").html());
				if($("#table-transfer-detail").html()!="")
				{
					$("#table-transfer-detail").DataTable({
						responsive: true,
						scrollY: 90,
						paging: false,
						scrollX: true,
						searching:false,
						info:false
					});
				}

			}
		});
	}

function select_guest_tour(guestID){
	$("#guest-tour").find("tr").css("background","transparent");
	$("#guest-tour-"+guestID).css("background","#397FDB");
}
function select_guest_tour_transfer(guestID){
	$("#guest-transfer > tbody > tr").css("background","transparent");
	$("#guesttour-"+guestID).css("background","#397FDB");
}
function get_guest_transfer(bookingID,TLTCode)
{		
	$("#table-transfer-detail").find("tr").css("background","transparent");
	$("#transfer-"+bookingID+"-"+TLTCode.replace("/","")).css("background","#397FDB");
	select_booking_id = bookingID;
	select_bkl_code = TLTCode;
	var dt = {
		bookingID 	: 	bookingID,
		TLTCode 	: 	TLTCode
	};
	var i = 1 ;
	$.ajax({   
		url: "<?php echo base_url('TransferController/get_guest_transfer'); ?>",
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
			$.each (data, function(key, opj) {
				if (key=="guest") {
					outputGuest += "<thead>";
					outputGuest += "<td style='width:174px'>Guest Name</td>";
					outputGuest += "</thead>";
					outputGuest	+= "<tbody>";
					$.each (opj, function(key1, row) {
						outputGuest += "<tr id='guesttour-"+ key1 +"' onclick=select_guest_tour_transfer("+ key1 +")>";
						outputGuest += "<td style='width:174px'>"+((row["GuestName"]!=null)?row["GuestName"]:"")+"</td>";
						outputGuest += "</tr>";
					});
					outputGuest	+= "</tbody>";
					i = i +1;
				}
			});
			$('#guest-transfer').html(outputGuest);
		}
	});
}

function update_optional_tour(){
	if (select_tour==""){
		alert("No tour selected!!!");
	} else {
		if ($("#tour-"+select_tour+" td:nth-child(3)").html()=="CXL"){
			alert("It were CXL");
		} else{
			var tour_code =$("#tour-"+select_tour+" td:nth-child(1)").html();
			
			var n = $("#guest-tour > tbody > tr").length;		
			location.href="<?php echo base_url();?>transfer-management/update-guest-optional-tour?id="+select_tour+"&count="+n+"&tourcode="+tour_code;
		}
	}	
}
function update_guest()
{
    //alert(select_tour);
    if (select_tour==""){
    	alert("No tour selected!!!");
    } else {
    	if ($("#tour-"+select_tour+" td:nth-child(3)").html()=="CXL"){
    		alert("It were CXL");
    	} else{
			var tour_code =$("#tour-"+select_tour+" td:nth-child(1)").html();
			location.href="<?php echo base_url();?>hotel-booking/update-tour?id="+select_tour+"&tourcode="+tour_code;
		}
	}
}
function delete_current_booking()
{
	var tltCode = $("#table-transfer-detail tr.tb-tr-selected td:nth-child(1)").text();
	var code = tltCode.indexOf("/");
	if(code > 0)
	{
		alert("You can't delete this record.");
		return false;
	}
	if(confirm("Are you sure to delete?"))
	{
		var url= "<?php echo base_url('TransferController/delete_booking_by_tltcode'); ?>";
		var data = {tour_id:select_tour,tlt_code:tltCode};
		var result= call_ajax(url,data);
		get_info_booking(select_tour);
	}
	
}
function getUpdate()
{
	var tourStatus = $("table#table-tour-info tr.tb-tr-selected td:nth-child(3)").text().trim();
	var transferStatus = $("table#table-transfer-detail tr.tb-tr-selected td:nth-child(7)").text().trim();
	if(tourStatus == "CXL" || transferStatus == "CXL")
	{
		alert("It were CXL.");
	}	
	else if($("#table-transfer-detail tbody tr").length > 0)
	{
		var tour_code =$("#tour-"+select_tour+" td:nth-child(1)").html();
		location.href='update-transfer-detail?id='+select_tour+'&code='+select_bkl_code+"&tourcode="+tour_code;
	}
	return false;
}

function create_copy()
{
	var tourStatus = $("table#table-tour-info tr.tb-tr-selected td:nth-child(3)").text().trim();
	var transferStatus = $("table#table-transfer-detail tr.tb-tr-selected td:nth-child(7)").text().trim();
	
	var dt = {
		TourID 		: 	select_booking_id,
		TLTCode 	: 	select_bkl_code
	};

	$.ajax({ 
		url: "<?php echo base_url('TransferController/get_copy_booking'); ?>",
		type: "POST", 
		data: dt, 
		dataType: "json",
		error: function(a,b,c){
			get_info_booking(dt.TourID);
		},
		success: function(data){
		}	     
	});
	get_info_booking(dt.TourID);

}
function clear_data()
{
	$("#tour-code").val("");
	$("#vn-code").val("");
	$("#tour-code").val("");
	$("#vn-code").val("");
	$("#tour-status").val("");
	$("#guest-name").val("");
	$("#tlt-Code").val("");
	$("#city").val("");
	$("#hotel").val("");
	$("#flight-in").val("");
	$("#flight-out").val("");
	$("input[name=date-in]").val("");
	$("input[name=date-out]").val("");
	$("#not-yet-update").prop("checked", false);
}


</script>
<?php echo $this->load->view('Layout/footer');?>