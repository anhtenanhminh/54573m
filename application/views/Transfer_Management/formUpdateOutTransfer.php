<?php echo $this->load->view('Layout/header')?>
<div class="content">

	<div class="container">
		<h3 style="margin-top: 6px; margin-bottom: 0px;">
			UPDATE OUT-TRANSFER
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;" onclick="back_home()">Back</button>
		</h3>
		<div class="row line-strong"
			style="margin-top: 20px; margin-bottom: 12px;"></div>
		<form action="" method="post">
			<div class="row">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Table Code</label> <input
							id="TBLCodeOut" type="text" name="transfer[TBLCodeOut]"
							class="form-control input-sm select-size"
							value="<?php echo ($codeout)?$codeout:"" ?>" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="row row-border-1">
						<div class="title-row-div">
							<label class="title-row">Guide Information</label>
						</div>
						<div class="col-md-6" style="padding-right: 0px">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Guide Name</label> <select id="guide"
										class="form-control input-sm" name="transfer[GuideID]"
										style="max-width: 140px;">
										<option value=""></option>
			    					<?php
            $guidid = isset($transfer['GuideID']) ? $transfer['GuideID'] : '';
            if ($guide) {
                foreach ($guide as $row) {
                    ?>
											<option value="<?php echo $row['GuideID']?>"
											<?php if($guidid== $row['GuideID'] ) echo "selected";?>><?php echo $row['GuideName']?></option>
										<?php
                }
            }
            ?>
			    				</select>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Telephone</label> <input
										id="guide-tel" name="" type="text"
										class="form-control input-sm" style="max-width: 140px;"
										value="<?php echo isset($transfer['GuideTel'])?$transfer['GuideTel']:""; ?>"
										readonly>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Pecuniary Penalty</label> <input
										type="text" id="pecuniary"
										class="form-control input-sm select-size-sm"
										<?php if($transfer){if(!$transfer["GComplain"]){echo "disabled";}} ?>
										name="transfer[GPecuPenalty]"
										value="<?php if($transfer){if($transfer['GComplain']){echo $transfer['GPecuPenalty'];}} ?>">
									<label>VND</label>
								</div>
							</div>

						</div>
						<div class="col-md-6">
							<textarea class="form-control" id="content"
								<?php if($transfer){if(!$transfer["GComplain"]){echo "disabled";}} ?>
								rows="5" name="transfer[GComplainNote]"><?php if($transfer){if($transfer["GComplain"]){echo $transfer["GComplainNote"];}}?></textarea>
							<label> <input type="checkbox" id="check-complain"
								<?php if($transfer){if($transfer["GComplain"]){echo "checked='true'";}}?>>
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
                    $driverid = isset($transfer['CarDriverID']) ? $transfer['CarDriverID'] : "";
                    if ($car_info) {
                        foreach ($car_info as $row) {
                            ?>
											<option value="<?php echo $row['CarDriverID']?>"
											<?php if( $driverid== $row['CarDriverID'] ) echo "selected";?>><?php echo $row['CarNo']?></option>
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
										id="driver-name" type="text"
										value="<?php echo  isset($transfer['DriverName'])?$transfer['DriverName']:"";?>"
										class="form-control input-sm select-size" readonly="">
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Seat</label> <input id="car-seat"
										type="text"
										value="<?php echo isset($transfer['CarSeat'])?$transfer['CarSeat']:""; ?>"
										class="form-control input-sm select-size-sm" readonly>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Telephone</label> <input
										id="driver-tel" type="text"
										value="<?php echo isset($transfer['DriverTel'])?$transfer['DriverTel']:""; ?>"
										class="form-control input-sm select-size-sm" readonly>
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
									name="transfer[STimeFrom]"
									value="<?php echo  isset($transfer['STimeFrom'])?$transfer['STimeFrom']:""; ?>"
									id="schedule-from" readonly>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">To</label> <input type="text"
									class="form-control input-sm select-size-sm"
									name="transfer[STimeTo]"
									value="<?php echo  isset($transfer['STimeTo'])?$transfer['STimeTo']:"";?>"
									id="schedule-to" readonly>
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
								<label class="label-item">From</label> <input type="text"
									id="afrom" name="ATimeFrom"
									value="<?php echo  isset($transfer['ATimeFrom'])?$transfer['ATimeFrom']:""; ?>"
									class="form-control input-sm select-size-sm" id="ac-time-from">
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">To</label> <input type="text" id="ato"
									name="ATimeTo" class="form-control input-sm select-size-sm"
									value="<?php echo isset($transfer['ATimeTo'])?$transfer['ATimeTo']:""; ?>"
									id="ac-time-to">
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
							<label class="label-item">Date Out</label> <input type="text"
								name="transfer[DateOut]"
								class="form-control input-sm select-size"
								value="<?php echo isset($transfer['DateOut'])?$transfer['DateOut']:"";?>"
								id="date-out" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item-md">Pick Up</label> <input type="text"
								name="transfer[TimeSearch]"
								class="form-control input-sm select-size-sm"
								value="<?php echo isset($transfer['TimeSearch'])?  str_replace("-", "",$transfer['TimeSearch']):"";?>"
								id="pu-from" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item-sm">-</label> <input type="text"
								class="form-control input-sm select-size-sm"
								value="<?php echo (isset($search_data)&&$search_data!=false&&isset($search_data[0]["PUOutTo"]))?$search_data[0]["PUOutTo"]:""; ?>"
								id="pu-to" readonly>
						</div>
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
						<div id="div-new-instransfer" class="list-scroll">
							<table id="table-tour-new-intransfer" class="table table-fixed">
								<thead>
									<tr>
										<td style='min-width: 30px; max-width: 30px;'>Sel</td>
										<td style='min-width: 85px; max-width: 85px;'>Tour Code</td>
										<td style='min-width: 120px; max-width: 120px;'>BKL Code</td>
										<td style='min-width: 50px; max-width: 50px;'>Out FLT</td>
										<td style='min-width: 30px; max-width: 30px;'>To</td>
										<td style='min-width: 70px; max-width: 70px;'>Day Out</td>
										<td style='min-width: 60px; max-width: 60px;'>Time Out</td>
										<td style='min-width: 60px; max-width: 60px;'>Pick Out</td>
										<td style='min-width: 140px; max-width: 140px;'>Hotel</td>
										<td style='width: 95px; max-width: 95px;'>R/Type</td>
										<td style='width: 40px; max-width: 40px;'>R/No.</td>
										<td style='width: 80px; max-width: 80px;'>Day In</td>
										<td style='width: 50px; max-width: 50px;'>In FLT</td>
										<td style='width: 40px; max-width: 40px;'>From</td>
										<td style='width: 50px; max-width: 50px;'>Time In</td>
										<td style='width: 60px; max-width: 60px;'>Pick In</td>
										<td style='width: 50px; max-width: 50px;'>Status</td>
										<td style='width: 158px; max-width: 158px;'>Optional Tour</td>
									</tr>
								</thead>
								<tbody>
						<?php

if (isset($booking) && $booking)
        foreach ($booking as $key => $item) {
            ?>
								<tr
										id='transfer-<?php echo  $item["TourID"]."-". $item["TLTCode"]?>'
										onclick='check_click("<?php echo $item["TourID"];?>","<?php echo $item["TLTCode"];?>")'>
										<td style='min-width: 30px;'><input type='checkbox'
											class='select_check'
											<?php if($item["TBLCodeOut"]!=""&&$item["TBLCodeOut"]!="NULL"){echo "checked='true'";}?>
											value='<?php echo $item['TourID'] ?>*<?php echo $item['TLTCode'] ?>'
											name='list_check["<?php echo $item['TourID'] ?>-<?php echo $item['TLTCode'] ?>"]'
											id='check-<?php echo $item['TourID'] ?>-<?php echo $item['TLTCode'] ?>'
											onchange="uncheck_all()"></td>
										<td style='min-width: 85px; max-width: 85px;'><?php if($item["TourCode"]) echo $item["TourCode"];?></td>
										<td style='min-width: 120px; max-width: 120px;'><?php if($item["TLTCode"]) echo $item["TLTCode"];?></td>
										<td style='min-width: 50px; max-width: 50px;'><?php if($item["OutFlight"]) echo $item["OutFlight"];?></td>
										<td style='min-width: 30px; max-width: 30px;'><?php if($item["ToPlace"]) echo $item["ToPlace"];?></td>
										<td style='min-width: 70px; max-width: 70px;'><?php if($item["DeptDate1"]) echo $item["DeptDate1"];?></td>
										<td style='min-width: 60px; max-width: 60px;'><?php if($item["TimeOut"]) echo $item["TimeOut"];?></td>
										<td style='min-width: 60px; max-width: 60px;'><?php if($item["PUOutFrom"]) echo $item["PUOutFrom"];?></td>
										<td style='min-width: 140px; max-width: 140px;'><?php if($item["Hotel"]) echo $item["Hotel"];?></td>
										<td style='width: 95px; max-width: 95px;'><?php if($item["RoomType1"]) echo $item["RoomType1"];?></td>
										<td style='width: 40px; max-width: 40px;'><?php if($item["RoomNo1"]) echo $item["RoomNo1"];?></td>
										<td style='width: 70px; max-width: 70px;'><?php if($item["ArrvDate1"]) echo $item["ArrvDate1"];?></td>
										<td style='width: 50px; max-width: 50px;'><?php if($item["InFlight"]) echo $item["InFlight"];?></td>
										<td style='width: 40px; max-width: 40px;'><?php if($item["FromPlace"]) echo $item["FromPlace"];?></td>
										<td style='width: 50px; max-width: 50px;'><?php if($item["TimeIn"]) echo $item["TimeIn"];?></td>
										<td style='width: 60px; max-width: 60px;'><?php if($item["PUIn"]) echo $item["PUIn"];?></td>
										<td style='width: 50px; max-width: 50px;'><?php if($item["TourStatus"]) echo $item["TourStatus"];?></td>
										<td style='width: 158px; max-width: 158px;'><?php if($item["TBLCodeIn"]) echo $item["TBLCodeIn"];?></td>
									</tr>
								<?php
        }

    ?>

						</tbody>
							</table>

						</div>
						<div class="">
							<div class="form-inline">
								<div class="form-group">
									<div class="checkbox form-margin-top-right">
										<div class="checkbox form-margin-top-right">
											<label> <input type="checkbox" id="selecctall" /> Check All
											</label>
										</div>
										<div class="checkbox form-margin-top-right">
											<label> <input type="checkbox" id="unselectall" /> Uncheck
												All
											</label>
										</div>

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
						<div id="div-guest-transfer-intransfer" class="list-scroll">
							<table id="guest-transfer-intransfer" class="table table-fixed"></table>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="row btn-center">
			<input type="submit" value="Update"
				class="btn btn-primary btn-sm button-md" name="submit"
				onclick="update_out_transfer()">
		</div>
	</div>

</div>
<script type="text/javascript">
var guide = $("#guide").val();
var carno = $("#car-no").val();
var afrom = $("#afrom").val();
var ato   = $("#ato").val();
var i = 1;
var tr_check = "";
var data_array = new Array();
var chk_comlain = $("#check-complain").prop("checked");
var pecuniary   = $("#pecuniary").val();
var gcomplainnote = $("#content").val();
$("#table-tour-new-intransfer > tbody > tr > td > input").each(function(){
	if($(this).prop("checked")==true)
	{
		data_array[i] = $(this).val();
		i++;
	}
});
	$(document).ready(function(){ 
		disableMenu();
             $("#selecctall").change(function(){
            $(".select_check").prop('checked', $(this).prop("checked"));
            $("#unselectall").prop('checked',false);
                     });      
                $("#unselectall").change(function(){
                $(".select_check").prop('checked',false);
                $("#selecctall").prop('checked',false);
                  });
		


		$('input[name=ATimeFrom],input[name=ATimeTo').keypress(function(evt){
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
		$('input[name=ATimeFrom],input[name=ATimeTo]').blur(function(event)
			{
				var name = $(this).attr('name');
				var time = $(this).val();
				if (time == '') return false;
				if (!checkChange(time)) {
					setTimeout(function(){
						$('input[name='+name+']').trigger('focus');
					},1);
				} else {
					$(this).val(reFormat(time));
				}
			});

		
		$('#check-complain').change(function(){
			if ($(this).is(":checked")) {
				$("#pecuniary").prop('disabled', false);
				$("#content").prop('disabled', false);
			} else {
				$("#pecuniary").val("");
				$("#content").val("");
				$("#pecuniary").prop('disabled', true);
				$("#content").prop('disabled', true);
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
function GetChangeOutInfor()
{
	var i =1;
	var data_list = new Array();
	$("#table-tour-new-intransfer > tbody > tr > td > input").each(function()
	{
		if($(this).prop("checked")==true)
		{
			data_list[i] = $(this).val();
			i++;
		}		
	});
	var n = data_array.length;
	var m = data_list.length;	
	var j=1;var k = 1;
	if(m!=n)
	{
		return true;
	}
	else
	{
		for(j=1;j<=n;j++)
		{
			var flag = false;
			for(k=1;k<=m;k++)
			{
				if(data_array[j]==data_list[k])
				{
					flag = true;
				}
			}
			if(flag==false)
			{
				return true;
			}
		}
		return false;
	}
}
function uncheck_all()
{
	$("#selecctall").prop('checked',false);
	$("#unselectall").prop('checked',false);
}

function back_home()
{
	var flag = GetChangeOutInfor();	
	if(guide!=$("#guide").val()||carno!=$("#car-no").val()||afrom!=$("#afrom").val()||ato!=$("#ato").val()||flag==true||chk_comlain!=$("#check-complain").prop("checked")||pecuniary!=$("#pecuniary").val()||gcomplainnote!=$("#content").val())
	{
		var r = confirm("Data entered will be lose. Are you sure to exit? ");
		if (r == true) 
		{
			location.href = '<?php echo base_url();?>transfer-management/out-transfer';
		}
	}
	else
	{
		location.href = '<?php echo base_url();?>transfer-management/out-transfer';
	}	
}


function update_out_transfer()
{
	var n = $("#table-tour-new-intransfer > tbody > tr").length;
	var chk = false;
	var data_array_check = new Array();
	var i =0;
	var flag = GetChangeOutInfor();
	if(guide==$("#guide").val()&&carno==$("#car-no").val()&&afrom==$("#afrom").val()&&ato==$("#ato").val()&&flag==false&&chk_comlain==$("#check-complain").prop("checked")&&pecuniary==$("#pecuniary").val()&&gcomplainnote==$("#content").val())
	{
		location.href="<?php echo base_url();?>transfer-management/out-transfer";
		return;
	}
	$("#table-tour-new-intransfer > tbody > tr > td > input").each(function(){
		if($(this).prop("checked")==true)
		{
			chk = true;
			data_array_check[i] = $(this).val();
			i++;
		}
	});		
	if($("#guide").val()=="")
	{
		alert("Select GuideName Please !.");
		return;
	}
	if($("#car-no").val()=="")
	{
		alert("Select CarNo Please !.");
		return;
	}
	if($("#afrom").val()=="")
	{
		alert("Select Actual Time From Please !.");
		return;
	}
	if($("#ato").val()=="")
	{
		alert("Select Actual Time To Please !.");
		return;
	}	
	if(chk==false)
	{
		alert("You must select at least one row.");
		return;
	}
	//alert($("#TBLCodeOut").val());	
	var d = {
		TBLCodeOut       : $("#TBLCodeOut").val(),
		guide_info       : guide_info(),
		car_info         : car_info(),
		schedule_f       : $("#schedule-from").val(),
		schedule_t       : $("#schedule-to").val(),
		actual_f         : $("#afrom").val(),
		actual_t         : $("#ato").val(),
		data_array_check :data_array_check,
		search_field     : search_field()
	};	
	if($("#car-seat").val()!="")
	{
			var guestcarseat;
			var dt = {
				tblcode    : $("#tblcode").val(),
				data_check : data_array_check
			};
			$.ajax({   
				async: false,
				url: "<?php echo base_url('TransferController/coutguesttotalseat1'); ?>",
				type: "POST",
				dataType: "json",
				data: dt,
				success: function(data) 
				{
					guestcarseat = data.gt;
				}
			});			
			var car = parseInt($("#car-seat").val());			
			if(car<parseInt(guestcarseat))
			{			
				var r = confirm("Not enough car seat. Are you sure to update ?");
				if(r)
				{				
					$.ajax({   
						async: false,
						url: "<?php echo base_url('TransferController/SVData'); ?>",
						type: "POST",
						dataType: "json",
						data: d,
						success: function(data) 
						{
							if(data.msg!="")
							{
								alert(data);
							}	
							else
							{
								location.href="<?php echo base_url();?>transfer-management/out-transfer";
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
	
	var r = confirm("Are you sure to update ?");
	if(r)
	{
		$.ajax({   
						async: false,
						url: "<?php echo base_url('TransferController/SVData'); ?>",
						type: "POST",
						dataType: "json",
						data: d,
						success: function(data) 
						{
							if(data.msg!="")
							{
								alert(data);
							}	
							else
							{
								location.href="<?php echo base_url();?>transfer-management/out-transfer";
							}	
						}
			});
	}
	else
	{
		return;
	}
	
}
function car_info()
{
		var dt ={
			carno       : $("#car-no").val(),
			driver_name : $("#driver-name").val(),
			car_seat	: $("#car-seat").val(),
			driver_tel  : $("#driver-tel").val()	
		};
		return dt;
}
function search_field()
{
		var dt = {
			date_out    : $("#date-out").val(),
			pu_from     : $("#pu-from").val(),
			pu_to       : $("#pu-to").val()
		};
		return dt;
}
function  guide_info()
{
		var dt = {
			guideId        : $("#guide").val(),
			guideTel       : $("#guide-tel").val(),
			guidePecuniary : $("#pecuniary").val(),
			guideGComplain : $("#content").val(),
			check_Complain : $("#check-complain").prop("checked")
		};
		if(dt.check_Complain==true)
		{
			dt.check_Complain = 1;
		}
		else
		{
			dt.check_Complain = 0;
		}
		return dt;
}
function check_click(tour_id,tlt_code){
	if(tr_check!=""){
		$("#transfer-"+tr_check).css("background","transparent");
	}
	$("#transfer-"+tour_id+"-"+tlt_code).css("background","#397FDB");
	$("#transfer-"+tour_id+"-"+tlt_code).dblclick(function(){
		var check_box = $("#check-"+tour_id+"-"+tlt_code).prop("checked");
		$("#check-"+tour_id+"-"+tlt_code).prop("checked",!check_box);
	});
	tr_check = tour_id+"-"+tlt_code;
}
</script>
<?php echo $this->load->view('Layout/footer');?>