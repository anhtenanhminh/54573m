<?php echo $this->load->view('Layout/header');?>
<style type="text/css">
.dataTables_info {
	display: none;
}

#table-tour-info-new-optional_filter {
	display: none;
}

#div-tour-info-new-optional {
	overflow: hidden;
}

#table-tour-info-new-optional {
	white-space: nowrap;
	table-layout: fixed;
}

#table-tour-info-new-optional td {
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
		<h4>
			NEW OPTIONAL TOUR GUIDE TABLE
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;" onclick="back_home()">Back</button>
		</h4>
		<div class="row line-strong" style="margin-top: 20px;"></div>
		<div class="row">
			<div class="form-inline form-margin-bottom">
				<div class="form-group">
					<label class="label-item">Table Code</label> <input id="TBCode"
						type="text" class="form-control input-sm select-size"
						value="<?php echo ($TBLCode)?$TBLCode:""; ?>" readonly>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Guide Information</label>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Guide Name</label> <select id="guide"
								class="form-control input-sm select-size">
								<option value=""></option>
								<?php
        if ($guide) {
            foreach ($guide as $row) {
                ?>
									<option value="<?php echo $row['GuideID']?>"><?php echo $row['GuideName']?></option>
									<?php
            }
        }
        ?>
						</select>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Telephone</label> <input type="text"
								id="guide-tel" class="form-control input-sm select-size"
								readonly>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Car Information</label>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Car No.</label> <select id="car-no"
									class="form-control input-sm select-size">
									<option value=""></option>
								<?php
        if ($car_info) {
            foreach ($car_info as $row) {
                ?>
									<option value="<?php echo $row['CarDriverID']?>"><?php echo $row['CarNo']?></option>
									<?php
            }
        }
        ?>	
						</select>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Driver Name</label> <input type="text"
									id="driver-name" class="form-control input-sm select-size"
									readonly>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Car Seat</label> <input type="text"
									id="car-seat" class="form-control input-sm select-size"
									readonly>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Telephone</label> <input type="text"
									id="driver-tel" class="form-control input-sm select-size"
									readonly>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-3">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Schedule Time</label>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">From</label>
							<div id="from-date" class="form-group bfh-timepicker"
								data-placeholder="hh:ii" data-format="y/m/d" data-align="right"
								data-name="from-time"
								data-input="form-control input-sm select-size-md" data-time=""></div>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">To</label>
							<div id="to-date" class="form-group bfh-timepicker"
								data-placeholder="hh:ii" data-format="y/m/d" data-align="right"
								data-name="to-time"
								data-input="form-control input-sm select-size-md" data-time=""></div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-6">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Search Field</label>
					</div>
					<div class="col-md-6">
						<div class="form-inline">
							<div class="form-group">
								<label class="label-item">Date In</label>
								<div id="date-in" class="form-group bfh-datepicker"
									data-placeholder="yyyy/mm/dd" data-format="y/m/d"
									data-align="right" data-name="date-in"
									data-input="form-control input-sm select-size-md"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group button-action-div">
							<button
								class="btn-search btn btn-primary btn-sm button-md btn-action"
								onclick="get_data_search()">Search</button>
						</div>
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
					<div id="div-tour-info-new-optional" class="list-scroll"
						style="height: 200px">
						<table id="table-tour-info-new-optional"
							class="table table-bordered" style="width: 100%"></table>
					</div>
					<div class="">
						<div class="form-inline form-margin-bottom">
							<div class="form-group" style="margin-top: 10px;">
								<label>Total of Guest</label> <input id="count-per" type="text"
									class="form-control input-sm select-size-sm" readonly> <label>Person(s)</label>
							</div>
						</div>
						<div class="form-inline">

							<div class="form-group">
								<div class="checkbox form-margin-top-right">
									<label> <input name="check-all" value="t" type="checkbox"
										id="select-all"> Check All <input type="hidden" id="GNo"
										value="0">
									</label>
								</div>
								<div class="checkbox form-margin-top-right">
									<label> <input name="check-all" value="f" type="checkbox"
										id="unselectall"> Uncheck All
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
					<div id="div-guest-transfer-new-optional" class="list-scroll">
						<table id="table-guest-transfer-new-optional"
							class="table table-fixed"></table>
					</div>
				</div>
			</div>
		</div>
		<div class="row btn-center">
			<button class="btn btn-primary btn-sm button-md"
				onclick="create_optional_tour_guide()">Save</button>
		</div>
	</div>
</div>
<script type="text/javascript">
var count=0;
	$(document).ready(function(){
		disableMenu();
		$('input[name=date-in]').attr('readonly', false);
		$('#date-in').on("change.bfhdatepicker",function () {
			if (!isdate($('input[name=date-in]').val())){
				$('input[name=date-in]').css('border', "1px solid red");
				window.alert("Input Invalid");
			} else {
				$('input[name=date-in]').css('border', "1px solid #ccc");
				var dt = {
					TBLCode: $('input[name=date-in]').val()
				};
				$.ajax({   
					url: "<?php echo base_url('OptionalController/make_TBLCode'); ?>",
					type: "POST",  
					data: dt, 
					dataType: "text",	
					beforeSend: function(){
						$("body").css("cursor", "wait");
					},    
					complete: function() {
						$("body").css("cursor","default");
					},   			                         
					success: function(data) {
						$("#TBCode").val(data);
					}
				});
			}
		});

		$('input[name=from-date]').attr('readonly', false);
		$('#from-date').on("change.bfhdatepicker",function () {
			if (!isdate($('input[name=from-date]').val())){
				$('input[name=from-date]').css('border', "1px solid red");
				window.alert("Input Invalid");
			} else {
				$('input[name=from-date]').css('border', "1px solid #ccc");
			}
		});

		$('input[name=to-date]').attr('readonly', false);
		$('#to-date').on("change.bfhdatepicker",function () {
			if (!isdate($('input[name=to-date]').val())){
				$('input[name=to-date]').css('border', "1px solid red");
				window.alert("Input Invalid");
			} else {
				$('input[name=to-date]').css('border', "1px solid #ccc");
			}
		});

		$('#guide').change(function () {
			var guide=$(this).val();
			$.ajax({   
				url: "<?php echo base_url('OptionalController/get_tel_guide'); ?>",
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
				type: "POST",  
				data: "driver="+ driver, 
				dataType: "json",	
				beforeSend: function(){
					$("body").css("cursor", "wait");
				},    
				complete: function() {
					$("body").css("cursor","default");
				},  			                         
				success: function(data) {
					$.each (data, function(key, opj) {
						$('#driver-name').val(opj["DriverName"]);
						$('#car-seat').val(opj["CarSeat"]);
						$('#driver-tel').val(opj["DriverTel"]);
					});
				}
			});
		});


		$("#select-all").change(function()
		{
			$('#table-tour-info-new-optional tbody tr input').prop( "checked", true );	
			$("#count-per").val(count);	
			$("#unselectall").prop('checked',false);
		});      
		$("#unselectall").change(function(){
			$('#table-tour-info-new-optional tbody tr input').prop( "checked", false );	
			$("#select-all").prop('checked',false);
			$("#count-per").val("0");
		});
		$("#table-tour-info-new-optional > tbody > tr > td > input").each(function(){
			if($(this).prop("checked")==true)
			{
				if($("#unselectall").prop("checked")==true)
				{
					$("#unselectall").prop("checked","false");
				}
			}
		});
		$("input[name=from-time]").attr('readonly', "");
		$("input[name=to-time]").attr('readonly', "");
	});

/*
Get data search by ajax
Parameter: none
Return: none
*/
function get_data_search(){
	var dt = {
		date_in	: 	$('input[name=date-in]').val()
	};
	$.ajax({
		url: "<?php echo base_url('OptionalController/search_new_optional_tour_guide'); ?>",

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
			$('#div-tour-info-new-optional').html('<table id="table-tour-info-new-optional" class="table table-bordered" style="width:100%;"></table>');
			var output = "";			
			output += "<thead>";
			output	+= "<tr>";
			output	+= "<td style='width:50px'></td>";
			output	+= "<td style='width:40px'>Se</td>";
			output	+= "<td style='width:130px'>Tour Code</td>";
			output	+= "<td style='width:200px'>Tour Name</td>";
			output	+= "<td style='width:200px'>Hotel</td>";
			output	+= "<td style='width:130px'>RegPlace</td>";
			output	+= "<td style='width:127px'>Pax</td>";
			output	+= "</tr>";
			output	+= "</thead>";
			output	+= "<tbody>";
			$.each (data, function(key, opj) {
				if (key=="msg")
				{
					if (opj=="false"){									
						window.alert("Data not found!!!");                                        
						return false;
					} 
				} 
				else if(key=="data")
				{		
					$.each (opj, function(key1, row) 
					{
							output += "<tr id='optional-"+key1+"' onclick=\"get_guest_transfer('"+key1+"','"+row["TourCode"]+"','"+row["TourName"]+"')\">";
							output += "<td style='width:50px'><div class='glyphicon glyphicon-play icon-edit'><input type='hidden' value='"+row["BookingOptionalID"]+"'></div></td>";
							output += "<td style='width:40px' class='select_check' onchange='un_check()'><input type='checkbox' id='check-"+row["BookingOptionalID"]+"' onchange=\"select_check_box('"+row["BookingOptionalID"]+"',"+row["NPer"]+")\" checked></td>";
							output += "<td style='width:130px'>"+((row["TourCode"]!=null)?row["TourCode"]:"")+"</td>";
							output += "<td style='width:200px'>"+((row["TourName"]!=null)?row["TourName"]:"")+"</td>";
							output += "<td style='width:200px'>"+((row["Hotel"]!=null)?row["Hotel"]:"")+"</td>";
							output += "<td style='width:130px'>"+((row["RegPlace"]!=null&&row["RegPlace"]!="")?"VIETNAM":"JAPAN")+"</td>";
							output += "<td style='width:127px'>"+((row["NPer"]!=null)?row["NPer"]:"")+"</td>";
							output += "</tr>";
					});				
				}				
		});			
			output	+= "</tbody>";	
			count = data.total; 		
			$("#count-per").val(data.total);
			$('#table-tour-info-new-optional').html(output);
			$('#table-tour-info-new-optional').DataTable({
				responsive: true,
				scrollY: 150,
				paging: false,
				scrollX: false
			});
			$('.dataTables_scrollHead').height(35);
			$(".table-fixed").find("tr").css("cursor","default");
			$("#select-all").prop("checked",true);
			$("#table-guest-transfer-new-optional").html("");
		}
	});	
}

/*
Get guest transfer by ajax
Parameter: key, Table code, Tour Name
Return: none
*/
function get_guest_transfer(key,TLTCode,TourName){
	// window.alert($("#optional-"+TLTCode).html());
	$("#table-tour-info-new-optional tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#optional-"+key+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-tour-info-new-optional").find("tr").css("background","transparent");
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
			$('#table-guest-transfer-new-optional').html(outputGuest);
		}
	});
}

/*
Event for select check box ajax
Parameter: ID booking optional, number Person
Return: none
*/
function select_check_box(BookingOptionalID,NPer){
	if ($("#check-"+BookingOptionalID).is(":checked")){
		$("#count-per").val(parseInt($("#count-per").val())+NPer);
	} else {
		$("#count-per").val(parseInt($("#count-per").val())-NPer);
	}
}

function select_guest_tour(guestID){
	$("#table-guest-transfer-new-optional tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#guest-tour-"+guestID+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-guest-transfer-new-optional").find("tr").css("background","transparent");
	$("#guest-tour-"+guestID).css("background","#397FDB");
}

function create_optional_tour_guide()
{
	if($("#TBCode").val()=="")
	{
		alert("Please enter table code.");
		return;
	}
	else
	{		
		if(CheckDuplicadeTBLCodeOptionalTour()==true)
		{	
			
			alert("[ "+$("#TBCode").val()+" ] existed.");
			return;
		}
	}	
	var n = $("#table-tour-info-new-optional > tbody > tr").length;
	if(n==0)
	{
		alert("Data was not saved. Please search data first!");
		return;
	}
	var dt = {
				list_check : create_array_check_list(),
				data : create_array_data()
			};
	if(dt.list_check=="")
	{
		alert("You must select at least one row.");
		return;
	}
	if(Check_Input()==false)
	{
		return;
	}
	if($("#car-seat").val()!="")
	{
		var countcarseat = CountTotalGuestChkSeat(dt.list_check);
		if($("#car-seat").val()<countcarseat)
		{
			var r = confirm("Not enough car seat. Are you sure to save ?");
			if(r)
			{
				$.ajax({   
						url: "<?php echo base_url('OptionalController/create_optional_tour_guide'); ?>",
						type: "POST", 
						data: dt, 
						dataType: "json", 				       
						success: function(data){						
							if(data.msg!="")
							{
								alert(data.msg);
							}
							else
							{
								location.href="<?php echo base_url();?>optional-tour/optional-tour-transfer";
							}
						}
					});
			}
			else
			{
				return;
			}
		}
	}
	var r = confirm("Are you sure to save ?");
	if(r)
	{
		$.ajax({   
					url: "<?php echo base_url('OptionalController/create_optional_tour_guide'); ?>",
						type: "POST", 
						data: dt, 
						dataType: "json",     
						
						       
						success: function(data){						
							if(data.msg!="")
							{
								alert(data.msg);
							}
							else
							{
								location.href="<?php echo base_url();?>optional-tour/optional-tour-transfer";
							}
						}	
			});
	}
	else
	{
		return;
	}
}
function CountTotalGuestChkSeat(ds)
{
	var countcarseat;
	var dt={
		data : ds
	};	
	$.ajax({   
		 	async: false,
            url: "<?php echo base_url('OptionalController/CountTotalGuestChkSeat'); ?>",
            type: "POST",
            dataType: "json",
            data: dt,
             success: function(data) 
             {
             	countcarseat =   data;
	         }
	    });
	return countcarseat;
}
function Check_Input()
{
	if($("#guide").val()=="")
	{
		alert("Select GuideName Please !.");
		$("#guide").focus();
		return false;
	}
	if($("#car-no").val()=="")
	{
		alert("Select CarNo Please !.");
		$("#car-no").focus();
		return false;
	}
	if($("#from-date > div > input").val()=="")
	{
		alert("Select Schedule Time From Please !.");
		$("#from-date > div > input").focus();
		return false;
	}

	if($("#to-date > div > input").val()=="")
	{
		alert("Select Schedule Time To Please !.");
		$("#to-date > div > input").focus();
		return false;
	}	
}
function CheckDuplicadeTBLCodeOptionalTour()
{
	var bool;
	var dt = {
		TBLCodeOptionalTour : $("#TBCode").val()
	};
	$.ajax({   
		 	async: false,
            url: "<?php echo base_url('OptionalController/CheckDuplicadeTBLCodeOptionalTour'); ?>",
            type: "POST",
            dataType: "json",
            data: dt,
             success: function(data) 
             {
             	bool =   data;
	         }
	    });
	return bool;
}
function create_array_data(){
	var result = [];
	result.push({
		'TBLCodeOptionalTour'	: $("#TBCode").val(),
		'STimeFrom'				: $("#date-in").val(),
		'CarDriverID'			: parseInt($("#car-no").val()),
		'GuideID'				: parseInt($("#guide").val()),
		'DateGo'				: $('input[name=date-in]').val(),
		'STimeFrom'				: $('input[name=from-time]').val(),
		'STimeTo'				: $('input[name=to-time]').val(),
		'PUFrom'				: "",
		'PUTo'					: "",
		'TourName'				: create_string_list_tour()
	});
	return result;
}

function create_array_check_list(){
	var result= [];
	var i = 0;
	$("#table-tour-info-new-optional tbody tr").each(function(){
		if ($("#table-tour-info-new-optional tbody #optional-"+i+" td:nth-child(2) input").is(":checked")){
			result.push(parseInt($("#table-tour-info-new-optional tbody #optional-"+i+" td:nth-child(1) input").val()));
		}
		i++;
	});
	return result;
}

function create_string_list_tour(){
	var result = [];
	var i = 0;
	$("#table-tour-info-new-optional tbody tr").each(function(){
		if ($("#table-tour-info-new-optional tbody #optional-"+i+" td:nth-child(2) input").is(":checked")){
			result.push($('<div />').html($("#table-tour-info-new-optional tbody #optional-"+i+" td:nth-child(4)").html()).text());
		}
		i++;
	});
	return result.join();
}
function un_check()
{
	$("#select-all").prop('checked',false);
	$("#unselectall").prop('checked',false);
}
function back_home()
{
	var n = $("#table-tour-info-new-optional > tbody > tr").length;
	if($("#TBCode").val()!="" && n>0)
	{
		var r = confirm("Data entered will be lose. Are you sure to exit ?");
		if(r)
		{
			location.href="<?php echo base_url();?>optional-tour/optional-tour-transfer";
		}
		else
		{
			return;
		}
	}
	else
	{
		location.href="<?php echo base_url();?>optional-tour/optional-tour-transfer";
	}
}
</script>
<?php echo $this->load->view('Layout/footer');?>