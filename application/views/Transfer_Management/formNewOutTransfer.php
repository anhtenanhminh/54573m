<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
table thead tr td {
	padding: 1px !important;
	vertical-align: middle;
}

.dataTables_scrollHeadInner table thead tr td {
	height: 35px !important;
}
</style>
<div class="content">

	<div class="container">
		<h3 style="margin-top: 6px; margin-bottom: 0px;">
			NEW OUT TRANSFER
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='<?php echo base_url();?>transfer-management/out-transfer'">Back</button>
		</h3>
		<div class="row line-strong"
			style="margin-top: 20px; margin-bottom: 12px;"></div>

		<div class="row">
			<div class="form-inline form-margin-bottom">
				<div class="form-group">
					<label class="label-item">Table Code</label> <input type="text"
						class="form-control input-sm select-size" name="TBLCodeOut"
						value="<?php echo $Btl_code; ?>" readonly>
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
								class="form-control input-sm select-size" name="GuideID">
								<option value="false"></option>
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
									class="form-control input-sm select-size" name="CarDriverID">
									<option value="false"></option>
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
									name="seats" readonly>
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
							<label class="label-item">From Date</label>
							<div id="from-date"
								class="form-group bfh-timepicker select-size-md"
								data-align="right"
								data-input="form-control input-sm select-size-md"
								data-name="STimeFrom" data-time=""></div>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">To Date</label>
							<div id="to-date"
								class="form-group bfh-timepicker select-size-md"
								data-align="right"
								data-input="form-control input-sm select-size-md"
								data-name="STimeTo" data-time=""></div>
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
						<label class="label-item">Date Out</label>
						<div id="date-out" class="form-group bfh-datepicker select-size"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="date-out"
							data-input="form-control input-sm select-size-md"
							data-date="<?php echo date('Y/m/d');?>"></div>
						<!--	<input class="form-control input-sm select-size-md date-format" type="text"  name="DateIn" value="<?php echo date('Y/m/d');?>" />-->

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-inline">
					<div class="form-group">
						<label class="label-item">Time Out</label> <select id="time-out"
							class="form-control input-sm select-size">
							<option></option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-inline">
					<div class="form-group">
						<label class="label-item-md">Pick Up</label> <select
							id="pick-out-from" name="pupfrom"
							class="form-control input-sm select-size-sm"
							onchange="get_pickup_out_to()">

						</select>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-inline">
					<div class="form-group">
						<label class="label-item-sm">-</label> <select id="pick-out-to"
							name="pupto" class="form-control input-sm select-size-sm">

						</select>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="button-action-div">
					<label
						class="btn-search btn btn-primary btn-sm button-md btn-action"
						onclick="get_data_search()">Search</label>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Out-Transfer Information</label>
			</div>
			<div class="col-md-9">
				<div class="row row-border">
					<div id="div-new-outstransfer" class="list-scroll"
						style="height: 270px">
						<table id="table-tour-new-outtransfer" class="display nowrap"></table>
					</div>
					<div class="">
						<div class="form-inline">
							<div class="form-group">
								<div class="checkbox form-margin-top-right">
									<label> <input type="checkbox" id="selecctall"> Check All
									</label>
								</div>
								<div class="checkbox form-margin-top-right">
									<label> <input type="checkbox" id="uncheckall"> Uncheck All
									</label>
								</div>
								<div class="form-group form-margin-top-right">
									<label>Guest No</label> <input type="text"
										class="form-control input-sm" size="1" readonly
										style="margin-top: 3px;" id="guest-no">
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
					<div id="div-guest-transfer-new-outtransfer" class="list-scroll">
						<table id="guest-transfer-new-outtransfer"
							class="table table-bordered table-hover dataTable no-footer"></table>
					</div>
				</div>
			</div>
		</div>
		<div class="row btn-center">
			<button name="submit" onclick="addNewTransferOut()" value="Save"
				class="btn btn-primary btn-sm button-md btn-print">Save</button>
		</div>

	</div>
</div>
<script type="text/javascript">
	var flag = 0;
	$(document).ready(function(){
		disableMenu();
		$("#selecctall").change(function(){
			$(".select_check").prop('checked', $(this).prop("checked"));
			$("#uncheckall").prop('checked',false);
		});
		$("#uncheckall").change(function(){
			$(".select_check").prop('checked',false);
			$("#selecctall").prop('checked',false);
		});

		$("input[name=STimeFrom]").attr("readonly", true);
		$("input[name=STimeTo]").attr("readonly", true);

		$('input[name=date-out]').attr('readonly', false);
		get_time_out($('input[name=date-out]').val());
		get_pickup_out_from($('input[name=date-out]').val());
		$('#date-out').on("change.bfhdatepicker",function () {
			if (!isdate($('input[name=date-out]').val())){
				$('input[name=date-out]').css('border', "1px solid red");
				window.alert("Input Invalid");
			} else {
				var date = $('input[name=date-out]').val().replace(/\//g, "").substr(2);
				var newCode = "TRO." + date + $("input[name=TBLCodeOut]").val().trim().substr(-3);
				$("input[name=TBLCodeOut]").val(newCode);

				$('input[name=date-out]').css('border', "1px solid #ccc");
				get_time_out($('input[name=date-out]').val());
				get_pickup_out_from($('input[name=date-out]').val());
			}
		});

		$('#guide').change(function () {
			var guide=$(this).val();
			$.ajax({   
				url: "<?php echo base_url('TransferController/get_tel_guide'); ?>",
				type: "POST",  
				data: "guide="+ guide, 
				dataType: "text",		
				beforeSend: function(){
					$("body").css("cursor", "wait");
				},    
				complete: function() {
					$("body").css("cursor","default");
				},		                         
				success: function(data) {
					$('#guide-tel').val(data);
				}
			});
		});
		$('#car-no').change(function () {
			var driver=$(this).val();
			$.ajax({   
				url: "<?php echo base_url('TransferController/get_info_car'); ?>",
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
	});
function get_time_out(dateout) {
	$('body').css("cursor", "wait");
	$.ajax({   
		url: "<?php echo base_url('TransferController/get_time_out'); ?>",
		type: "POST",  
		data: "dateout="+ dateout, 
		dataType: "html",				                         
		beforeSend: function(){
			$("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},  
		success: function(data) {
			$("#time-out").html(data);
			setTimeout(function(){
				$('body').css("cursor", "");
				$("#show-result").fadeIn();
			}, 300);
		}
	});
}
function get_pickup_out_from(dateout) {
	$('body').css("cursor", "wait");
	$.ajax({   
		url: "<?php echo base_url('TransferController/get_pickup_out_from'); ?>",
		type: "POST",  
		data: "dateout="+ dateout, 
		dataType: "html",				                         
		beforeSend: function(){
			$("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},  
		success: function(data) {
			$("#pick-out-from").html(data);
			setTimeout(function(){
				$('body').css("cursor", "");
				$("#show-result").fadeIn();
				$("#pick-out-to").html('<option value=""></option>');
			}, 300);
		}
	});
}
function get_pickup_out_to(dataout) {

	var dataout ={date :$('input[name=date-out]').val() ,from: $("#pick-out-from").val()};
	$('body').css("cursor", "wait");
	$.ajax({   
		url: "<?php echo base_url('TransferController/get_pickup_out_to'); ?>",
		type: "POST",  
		data: dataout, 
		dataType: "html",				                         
		beforeSend: function(){
			$("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},  
		success: function(data) {

			$("#pick-out-to").html(data);
			setTimeout(function(){
				$('body').css("cursor", "");
				$("#show-result").fadeIn();
			}, 300);
		}
	});
}
function addNewTransferOut ()
{
	if(flag!=0)
	{
		var r  = confirm("Are you sure to save ?");
		if(r)
		{
			//alert($('#guide').val());
			if($('#guide').val()=="false")
			{
				window.alert("No input Giude.");
			}
			if($('#car-no').val()=="false")
			{
				window.alert("No input Car-Driver.");
			}		
			var selected = [];
			$('#table-tour-new-outtransfer input:checked').each(function() {
				selected.push($(this).attr('value'));
			});
			var dataout ={
				list_check:selected,
				Seats :$('input[name=seats]').val() ,
				DateOut :$('input[name=date-out]').val() ,
				TBLCodeOut :$('input[name=TBLCodeOut]').val() ,
				GuideID :$('#guide').val() ,
				CarDriverID :$('#car-no').val() ,
				STimeFrom :$('input[name=STimeFrom]').val() ,
				STimeTo :$('input[name=STimeTo]').val() ,
				TimeSearch:$('#pick-out-from').val()+'-'+$('#pick-out-to').val()
			};

			$.ajax({   
				url: "<?php echo base_url('TransferController/addnewtransferout');?>",
				type: "POST",  
				data: dataout, 
				dataType: "json",
				success: function(data) {
					$.each (data, function(key, opj) {
						if(key=="msg")
						{
							location.href='<?php echo base_url();?>transfer-management/out-transfer';
						}
					});
				}
			});
		}

	}
	else
	{
		window.alert("Data was not saved. Please search data first!");
	}	
}
function get_data_search(){
	$("body").css("cursor","wait");
	if ($("input[name=date-out]").val()!=""){
		var dt = {
			date_out		: 	$("input[name=date-out]").val(),
			time_out		: 	$("#time-out").val(),
			pick_out_from	: 	$("#pick-out-from").val(),
			pick_out_to		: 	$("#pick-out-to").val()
		};
		
		$.ajax({
			url: "<?php echo base_url('TransferController/search_new_outtransfer'); ?>",
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
				$('#div-new-outstransfer').html('<table id="table-tour-new-outtransfer" class="display nowrap"></table>');
				var output = "";
				output += "<thead style='background-color:#3071a9;color: #ffffff;'>";				
				output	+= "<th title='Sel'>Sel</th>";
				output	+= "<th title='Tour Code'>Tour Code</th>";
				output	+= "<th title='BKL Code'>BKL Code</th>";
				output	+= "<th title='Out FLT'>Out FLT</th>";
				output	+= "<th title='To'>To</th>";
				output	+= "<th title='Day Out'>Day Out</th>";
				output	+= "<th title='Time Out'>Time Out</th>";
				output	+= "<th title='Pick Out'>Pick Out</th>";
				output	+= "<th title='Hotel'>Hotel</th>";
				output	+= "<th title='R/Type'>R/Type</th>";
				output	+= "<th title='R/No.'>R/No.</th>";
				output	+= "<th title='Day In'>Day In</th>";
				output	+= "<th title='In FLT'>In FLT</th>";
				output	+= "<th title='From'>From</th>";
				output	+= "<th title='Time In'>Time In</th>";
				output	+= "<th title='Pick In'>Pick In</th>";
				output	+= "<th title='Status'>Status</th>";
				output	+= "<th title='Optional Tour'>Optional Tour</th>";				
				output	+= "</thead>";
				output	+= "<tbody>";
				$.each (data, function(key, opj) {
					if (key=="msg"){
						if (opj=="false"){
				  			//window.alert("Data not found!!!");
				  			flag = 0;
				  			return false;
				  		}
				  	} else if(key=="data"){
				  		$.each (opj, function(key, row) {
				  			output += "<tr id='transfer-"+row["TourID"]+"-"+row["TLTCode"]+"' onclick=\"get_guest_transfer('"+row["TourID"]+"','"+row["TLTCode"]+"')\">";
				  			output += "<td><input checked='true' onchange='check_all()' type='checkbox'  class='select_check' value='"+row["TourID"]+"*"+row["TLTCode"]+"' name='list_check["+row["TourID"]+"-"+row["TLTCode"]+"]' id='check-"+row["TourID"]+"-"+row["TLTCode"]+"'></td>";
				  			output += "<td title='"+((row["TourCode"]!=null)?row["TourCode"]:"")+"'>"+((row["TourCode"]!=null)?row["TourCode"]:"")+"</td>";
				  			output += "<td title='"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"'>"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"</td>";
				  			output += "<td title='"+((row["OutFlight"]!=null)?row["OutFlight"]:"")+"'>"+((row["OutFlight"]!=null)?row["OutFlight"]:"")+"</td>";
				  			output += "<td title='"+((row["ToPlace"]!=null)?row["ToPlace"]:"")+"'>"+((row["ToPlace"]!=null)?row["ToPlace"]:"")+"</td>";
				  			output += "<td title='"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"'>"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"</td>";
				  			output += "<td title='"+((row["TimeOut"]!=null)?row["TimeOut"]:"")+"'>"+((row["TimeOut"]!=null)?row["TimeOut"]:"")+"</td>";
				  			output += "<td title='"+((row["PUOutFrom"]!=null)?row["PUOutFrom"]:"")+"'>"+((row["PUOutFrom"]!=null)?row["PUOutFrom"]:"")+"</td>";
				  			output += "<td title='"+((row["Hotel"]!=null)?row["Hotel"]:"")+"'>"+((row["Hotel"]!=null)?row["Hotel"]:"")+"</td>";
				  			output += "<td title='"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"'>"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"</td>";
				  			output += "<td title='"+((row["RoomNo1"]!=null)?row["RoomNo1"]:"")+"'>"+((row["RoomNo1"]!=null)?row["RoomNo1"]:"")+"</td>";
				  			output += "<td title='"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"'>"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"</td>";
				  			output += "<td title='"+((row["InFlight"]!=null)?row["InFlight"]:"")+"' >"+((row["InFlight"]!=null)?row["InFlight"]:"")+"</td>";
				  			output += "<td title='"+((row["FromPlace"]!=null)?row["FromPlace"]:"")+"'>"+((row["FromPlace"]!=null)?row["FromPlace"]:"")+"</td>";
				  			output += "<td title='"+((row["TimeIn"]!=null)?row["TimeIn"]:"")+"'>"+((row["TimeIn"]!=null)?row["TimeIn"]:"")+"</td>";
				  			output += "<td title='"+((row["PUIn"]!=null)?row["PUIn"]:"")+"'>"+((row["PUIn"]!=null)?row["PUIn"]:"")+"</td>";
				  			output += "<td title='"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"'>"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"</td>";
				  			output += "<td>"+((row["TBLCodeOut"]!=null)?row["TBLCodeOut"]:"")+"</td>";
				  			output += "</tr>";
				  			flag = flag +1;
				  		});
}
else
{
	get_guest_transfer(opj['TourID'],opj['TLTCode']);
}
});
output	+= "</tbody>";
$('#table-tour-new-outtransfer').html(output);
$('#table-tour-new-outtransfer').DataTable({
	paging: false,
	responsive:true,
	scrollY: 200,
	scrollX: true,
	searching:false,
	info:false
});
$("body").css("cursor","");
$(".table-fixed").find("tr").css("cursor","default");
}
});
} else {
	window.alert("Please select date out!!!");
}
}

function get_guest_transfer(TourID,TLTCode){
	$("#table-tour-new-outtransfer").find("tr").css("background","transparent");
	$("#transfer-"+TourID+"-"+TLTCode).css("background","#397FDB");	
	var dt = {
		TourID 		: 	TourID,
		TLTCode 	: 	TLTCode
	};

	$.ajax({   
		url: "<?php echo base_url('TransferController/get_guest_transfer_new_outtransfer'); ?>",
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
			$('#div-guest-transfer-new-outtransfer').html('<table id="guest-transfer-new-outtransfer" class="table table-bordered table-hover dataTable no-footer"></table>');
			var outputGuest = "";
			$.each (data, function(key, opj) {
				if (key=="guest") {
					outputGuest += "<thead>";
					outputGuest += "<td style='width:244px'>Guest Name</td>";
					outputGuest += "</thead>";
					outputGuest	+= "<tbody>";
					$.each (opj, function(key1, row) {
						outputGuest += "<tr id='guest-tour-"+row["GuestID"]+"' onclick=select_guest_tour('"+row["GuestID"]+"')>";
						outputGuest += "<td style='width:244px'>"+row["GuestName"]+"</td>";
						outputGuest += "</tr>";
					});
					outputGuest	+= "</tbody>";
				}
				else
				{
					if($('#check-'+TourID+"-"+TLTCode).prop('checked')==true)
					{
						$('#guest-no').val(opj);
					}
					else
					{
						$('#guest-no').val("0");
					}			    	
				}
			});

			$('#guest-transfer-new-outtransfer').html(outputGuest);
		}
	});
}
function check_all()
{
	$("#uncheckall").prop('checked',false);
	$("#selecctall").prop('checked',false);	
}
function select_guest_tour(guestID)
{
	$("#guest-transfer-new-outtransfer").find("tr").css("background","transparent");
	$("#guest-tour-"+guestID).css("background","#397FDB");
}
</script>
<?php echo $this->load->view('Layout/footer');?>