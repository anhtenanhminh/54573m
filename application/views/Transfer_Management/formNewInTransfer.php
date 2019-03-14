<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
table thead tr td {
	padding: 1px !important;
	vertical-align: middle;
}
</style>
<div class="content">

	<div class="container">
		<h1>
			NEW IN-TRANSFER
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='<?php echo base_url();?>transfer-management/in-transfer'">Back</button>
		</h1>
		<div class="row line-strong"></div>
		<form method="post">
			<div class="row">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Table Code</label> <input type="text"
							class="form-control input-sm select-size" name="TBLCodeIn"
							value="<?php echo $Btl_code?>" readonly>
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
										class="form-control input-sm select-size" name="CarDriverID">
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
									<label class="label-item">Driver Name</label> <input
										type="text" id="driver-name"
										class="form-control input-sm select-size" readonly>
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

								<div id="from-date"
									class="form-group bfh-timepicker select-size-md"
									data-align="right"
									data-input="form-control input-sm select-size-md"
									data-name="STimeFrom" data-time=""></div>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">To</label>
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
							<label class="label-item">Date In</label>
							<div id="date-in" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="date-in"
								data-input="form-control input-sm select-size-md"
								data-date="<?php echo date('Y/m/d'); ?>"></div>

						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item-sm">From</label> <select id="from-place"
								class="form-control input-sm select-size" name="FromPlace">
								<option></option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item">Time In</label> <select id="time-in"
								class="form-control input-sm select-size" name="TimeIn">


							</select>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item-sm">Flt In</label> <select id="flt-in"
								class="form-control input-sm select-size-sm" name="FlightIn">

							</select>
						</div>
					</div>
				</div>
				<div class="col-md-1">
					<div class="button-action-div">
						<label
							class="btn-search btn btn-primary btn-sm button-sm btn-action"
							onclick="get_data_search()">Search</label>
					</div>
				</div>
			</div>
			<div class="row line-strong"></div>
			<div class="row row-border">
				<div class="title-row-div">
					<label class="title-row">In-Transfer Information</label>
				</div>
				<div class="col-md-9">
					<div class="row row-border">
						<div id="div-new-instransfer" class="list-scroll"
							style="height: 270px">
							<table id="table-tour-new-intransfer" class="display nowrap">

							</table>

						</div>
						<div class="">
							<div class="form-inline">
								<div class="form-group">
									<div class="checkbox form-margin-top-right">
										<label> <input type="checkbox" id="selecctall"> Check Al
										</label>
									</div>

									<div class="checkbox form-margin-top-right">
										<label> <input type="checkbox" id="uncheckall"> Uncheck Al
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
						<div id="div-guest-transfer-new-inransfer" class="list-scroll">
							<table id="guest-transfer-new-intransfer"
								class="table table-bordered table-hover dataTable no-footer"></table>
						</div>
					</div>
				</div>
			</div>
			<div class="row btn-center">
				<input type="submit" name="submit" value="Save"
					onclick="return checksubmit();"
					class="btn btn-primary btn-sm button-md"></input>
			</div>
		</form>
	</div>
</div>
<style type="text/css">
.form-margin-top-right {
	margin-top: 0px;
	margin-right: 10px;
}
</style>
<script type="text/javascript">
	function checksubmit () {
		if ($("#table-tour-new-intransfer tbody tr").length > 0) {
			var flag = false;
			$(".select_check").each(function(){
				if($(this).prop("checked")==true){
					flag = true;
				}
			});
			if(flag==true){				
				return confirm("Are you sure to save ?");
			}else{
				alert("You must select at least one row.");
				return false;
			}	
			
		} else {
			alert("Data was not saved. Please search data first!");
			return false;
		}
	}

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

		$('input[name=date-in]').attr('readonly', false);
		$('#date-in').on("change.bfhdatepicker",function () {
			if (!isdate($('input[name=date-in]').val())){
				$('input[name=date-in]').css('border', "1px solid red");
				window.alert("Input Invalid");
			} else {
				var date = $('input[name=date-in]').val().replace(/\//g, "").substr(2);
				var newCode = "TRI." + date;


				$.ajax({   
					url: "<?php echo base_url('TransferController/get_table_code'); ?>",
					async: false,
					type: "POST",  
					data: "table_code="+ newCode, 
					dataType: "text",				                         
					success: function(data) {				
						$("input[name=TBLCodeIn]").val(newCode+"-"+data);
					}				
				});
				$('input[name=date-in]').css('border', "1px solid #ccc");
				$("#time-in").val("");
				$("#flt-in").val("");
				get_from_place($('input[name=date-in]').val());
			}
		});
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
					setTimeout(function(){
						$('body').css("cursor", "");
						$("#show-result").fadeIn();
					}, 500);
				}
			});
		});

		$('#from-place').change(function () {
			$('body').css("cursor", "wait");
			var dt = {
				from_place 	: $(this).val(),
				date_in 	: $('input[name=date-in]').val()
			};
			$.ajax({   
				url: "<?php echo base_url('TransferController/get_flight'); ?>",
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
					$.each (data, function(key, opj) {
						if (key=="TimeIn"){
							$("#time-in").html(opj);
						}
						if (key=="InFlight"){
							$("#flt-in").html(opj);
						}
					});
					setTimeout(function(){
						$('body').css("cursor", "");
						$("#show-result").fadeIn();
					}, 200);
				}
			});
		});
	});

function get_from_place(datein) {
	$('body').css("cursor", "wait");
	$.ajax({   
		url: "<?php echo base_url('TransferController/get_from_place'); ?>",
		type: "POST",  
		data: "datein="+ datein, 
		dataType: "html",				                         
		beforeSend: function(){
			$("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},  
		success: function(data) {
			$("#from-place").html(data);
			setTimeout(function(){
				$('body').css("cursor", "");
				$("#show-result").fadeIn();
			}, 300);
		}
	});
};

function get_data_search(){
	$("body").css("cursor","wait");
	if ($("#date-in").val()!=""){
		if ($("#from-place").val()!=""){
			if ($("#time-in").val()) {
				var dt = {
					date_in			: 	$("#date-in").val(),
					from_place		: 	$("#from-place").val(),
					time_in			: 	$("#time-in").val(),
					flight_in		: 	$("#flt-in").val()
				};
				$.ajax({
					url: "<?php echo base_url('TransferController/search_new_intransfer'); ?>",
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
						$('#div-new-instransfer').html('<table id="table-tour-new-intransfer" class="display nowrap"></table>');
						var output = "";
						output += "<thead style='background-color:#3071a9;color: #ffffff;'>";
						output	+= "<th title='Sel'>Sel</th>";
						output	+= "<th title='In FLT'>In FLT</th>";
						output	+= "<th title='From'>From</th>";
						output	+= "<th title='Time In'>Time In</th>";
						output	+= "<th title='Pick In'>Pick In</th>";
						output	+= "<th title='Tour Code'>Tour Code</th>";
						output	+= "<th title='Status'>Status</th>";
						output	+= "<th title='BKL Code'>BKL Code</th>";
						output	+= "<th title='Hotel'>Hotel</th>";
						output	+= "<th title='R/Type'>R/Type</th>";
						output	+= "<th title='R/No.'>R/No.</th>";
						output	+= "<th title='Day In'>Day In</th>";
						output	+= "<th title='Out FLT'>Out FLT</th>";
						output	+= "<th title='To'>To</th>";
						output	+= "<th title='Day Out'>Day Out</th>";
						output	+= "<th title='Time Out'>Time Out</th>";
						output	+= "<th title='Pick Out'>Pick Out</th>";
						output	+= "<th title='Optional Tour'>Optional Tour</th>";
						
						output	+= "</thead>";
						output	+= "<tbody>";
						$.each (data, function(key, opj) {
							if (key=="msg"){
								if (opj=="false"){
									window.alert("Data not found!!!");
									return false;
								}
							} else if(key=="data") {
								$.each (opj, function(key, row) {
									output += "<tr id='transfer-"+row["TourID"]+"-"+row["TLTCode"]+"' onclick=\"get_guest_transfer('"+row["TourID"]+"','"+row["TLTCode"]+"')\">";
									output += "<td><input checked='true' onchange='check_all()' type='checkbox' class='select_check' value='"+row["TourID"]+"*"+row["TLTCode"]+"' name='list_check["+row["TourID"]+"-"+row["TLTCode"]+"]' id='check-"+row["TourID"]+"-"+row["TLTCode"]+"' ></td>";
									output += "<td title='"+((row["InFlight"]!=null)?row["InFlight"]:"")+"'>"+((row["InFlight"]!=null)?row["InFlight"]:"")+"</td>";
									output += "<td title='"+((row["FromPlace"]!=null)?row["FromPlace"]:"")+"'>"+((row["FromPlace"]!=null)?row["FromPlace"]:"")+"</td>";
									output += "<td title='"+((row["TimeIn"]!=null)?row["TimeIn"]:"")+"'>"+((row["TimeIn"]!=null)?row["TimeIn"]:"")+"</td>";
									output += "<td title='"+((row["PUIn"]!=null)?row["PUIn"]:"")+"'>"+((row["PUIn"]!=null)?row["PUIn"]:"")+"</td>";
									output += "<td title='"+((row["TourCode"]!=null)?row["TourCode"]:"")+"'>"+((row["TourCode"]!=null)?row["TourCode"]:"")+"</td>";
									output += "<td title='"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"'>"+((row["TourStatus"]!=null)?row["TourStatus"]:"")+"</td>";
									output += "<td title='"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"'>"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"</td>";
									output += "<td title='"+((row["Hotel"]!=null)?row["Hotel"]:"")+"'>"+((row["Hotel"]!=null)?row["Hotel"]:"")+"</td>";
									output += "<td title='"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"'>"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"</td>";
									output += "<td title='"+((row["RoomNo1"]!=null)?row["RoomNo1"]:"")+"'>"+((row["RoomNo1"]!=null)?row["RoomNo1"]:"")+"</td>";
									output += "<td title='"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"'>"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"</td>";
									output += "<td title='"+((row["OutFlight"]!=null)?row["OutFlight"]:"")+"'>"+((row["OutFlight"]!=null)?row["OutFlight"]:"")+"</td>";
									output += "<td title='"+((row["ToPlace"]!=null)?row["ToPlace"]:"")+"'>"+((row["ToPlace"]!=null)?row["ToPlace"]:"")+"</td>";
									output += "<td title='"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"'>"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"</td>";
									output += "<td title='"+((row["TimeOut"]!=null)?row["TimeOut"]:"")+"'>"+((row["TimeOut"]!=null)?row["TimeOut"]:"")+"</td>";
									output += "<td title='"+((row["PUOutFrom"]!=null)?row["PUOutFrom"]:"")+"'>"+((row["PUOutFrom"]!=null)?row["PUOutFrom"]:"")+"</td>";
									output += "<td title='"+((row["TBLCodeIn"]!=null)?row["TBLCodeIn"]:"")+"'>"+((row["TBLCodeIn"]!=null)?row["TBLCodeIn"]:"")+"</td>";
									output += "</tr>";
								});
							} else {
								get_guest_transfer(opj['TourID'],opj['TLTCode']);				    			
							} 
						});
						output	+= "</tbody>";
						$('#table-tour-new-intransfer').html(output);				       			       	
						$('#table-tour-new-intransfer').DataTable({
							paging: false,
							responsive:true,
							scrollY: 200,
							scrollX: 2000,
							searching:false,
							info:false
						});
						// $('.dataTables_scrollHead').height(35);
						$("body").css("cursor","");
					}
				});
			} else {
				window.alert("Please enter time in!!!");
			}
		} else{
			window.alert("Please enter place from!!!");
		}
	} else {
		window.alert("Please select date in!!!");
	}
}

function get_guest_transfer(TourID,TLTCode){
	$("#table-tour-new-intransfer").find("tr").css("background","transparent");
	$("#transfer-"+TourID+"-"+TLTCode).css("background","#397FDB");
	//alert($('#check-'+TourID+"-"+TLTCode).prop('checked'));
	var dt = {
		TourID 		: 	TourID,
		TLTCode 	: 	TLTCode
	};

	$.ajax({   
		url: "<?php echo base_url('TransferController/get_guest_transfer_new_intransfer'); ?>",
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
			$('#div-guest-transfer-new-inransfer').html('<table id="guest-transfer-new-intransfer" class="table table-bordered table-hover dataTable no-footer"></table>');
			var outputGuest = "";
			$.each (data, function(key, opj) {
				if (key=="guest") {
					outputGuest += "<thead>";
					outputGuest += "<td style='width:244px'>Guest Name</td>";
					outputGuest += "</thead>";
					outputGuest += "<tbody>";
					$.each (opj, function(key1, row) {
						outputGuest += "<tr id='guest-tour-"+row['GuestID']+"' onclick=select_guest_tour('"+row["GuestID"]+"')>";
						outputGuest += "<td style='width:244px'>"+row['GuestName'];
						outputGuest += "</td>";
						outputGuest += "</tr>";
					});
					outputGuest +="</tbody>";
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
			$('#guest-transfer-new-intransfer').html(outputGuest);
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

	$("#guest-transfer-new-intransfer").find("tr").css("background","transparent");
	$("#guest-tour-"+guestID).css("background","#397FDB");
}
</script>

<?php echo $this->load->view('Layout/footer');?>