<?php echo $this->load->view('Layout/header')?>
<div class="content">

	<div class="container">
		<h4>
			UPDATE IN-TRANSFER
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;" onclick="back_home()">Back</button>
		</h4>
		<div class="row line-strong" style="margin-top: 20px;"></div>
		<form action="" method="post">
			<div class="row">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Table Code</label> <input type="text"
							name="codein" class="form-control input-sm select-size"
							value="<?php echo ($codein)?$codein:"" ?>" id="tblcode" readonly>
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
										class="form-control input-sm select-size_per"
										name="transfer[GuideID]">
										<option value=""></option>
										<?php
        // $guidid =isset( $transfer['GuideID'])? $transfer['GuideID']:'';
        if ($guide) {
            foreach ($guide as $key => $row) {
                if ($transfer) {
                    ?>
													<option value="<?php echo $row['GuideID']?>"
											<?php if($row["GuideName"] == $transfer["GuideName"]) echo "selected";?>><?php echo $row['GuideName']?></option>
													<?php
                } else {
                    ?>
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
									<label class="label-item">Telephone</label> <input type="text"
										id="guide-tel" class="form-control input-sm select-size_per"
										name="GuideTel"
										value="<?php echo isset($transfer['GuideTel'])?$transfer['GuideTel']:""; ?>"
										readonly>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Pecuniary Penalty</label> <input
										type="text" id="Pecuniary" name="transfer[GPecuPenalty]"
										<?php if($transfer){if(!$transfer["GComplain"]){echo "disabled";}} ?>
										value="<?php if($transfer){if($transfer['GComplain']){echo $transfer['GPecuPenalty'];}} ?>"
										class="form-control input-sm select-size-sm"> <label>VND</label>
								</div>
							</div>

						</div>
						<div class="col-md-6">
							<textarea class="form-control" rows="5"
								<?php if($transfer){if(!$transfer["GComplain"]){echo "disabled";}} ?>
								name="transfer[GComplainNote]" id="GComplain"><?php echo  isset($transfer['GComplainNote'])?$transfer['GComplainNote']:""; ?></textarea>
							<label> <input type="checkbox" id="complain_check" value="1"
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
										class="form-control input-sm select-size" name="CarDriverID">
										<option value=""></option>
										<?php
        if ($car_info) {
            foreach ($car_info as $row) {
                if ($transfer) {
                    ?>
													<option value="<?php echo $row['CarDriverID']?>"
											<?php if($row['CarNo']==$transfer["CarNo"]) echo "selected";?>><?php echo $row['CarNo']?></option>
													<?php
                } else {
                    ?>
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
										id="driver-name" class="form-control input-sm select-size"
										readonly=""
										value="<?php echo  isset($transfer['DriverName'])?$transfer['DriverName']:"";?>">

									</input>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Seat</label> <input type="text"
										id="car-seat"
										value="<?php echo    isset($transfer['CarSeat'])?$transfer['CarSeat']:""; ?>"
										class="form-control input-sm select-size-sm" readonly>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Telephone</label> <input type="text"
										id="driver-tel" class="form-control input-sm select-size-sm"
										value="<?php echo   isset($transfer['DriverTel'])?$transfer['DriverTel']:""; ?>"
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
									name="transfer[STimeFrom]"
									value="<?php echo  isset($transfer['STimeFrom'])?$transfer['STimeFrom']:""; ?>"
									class="form-control input-sm select-size-sm" readonly
									id="schedule-from">
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">To</label> <input type="text"
									name="transfer[STimeTo]"
									class="form-control input-sm select-size-sm"
									value="<?php echo  isset($transfer['STimeTo'])?$transfer['STimeTo']:"";?>"
									readonly id="schedule-to">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="row row-border-1">
						<div class="title-row-div" id="actual-time">
							<label class="title-row">Actual Time</label>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">From</label> <input id="ac-time-from"
									type="text" name="ATimeFrom"
									class="form-control input-sm select-size-sm"
									value="<?php echo  isset($transfer['ATimeFrom'])?$transfer['ATimeFrom']:""; ?>">
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">To</label> <input id="ac-time-to"
									type="text" name="ATimeTo"
									class="form-control input-sm select-size-sm"
									value="<?php echo isset($transfer['ATimeTo'])?$transfer['ATimeTo']:""; ?>">
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
							<label class="label-item">Date In</label> <input type="text"
								name="transfer[DateIn]"
								class="form-control input-sm select-size"
								value="<?php if($dt){echo $dt[0]["ArrvDate1"];}else{echo "";} ?>"
								id="date-in" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item-sm">From</label> <input type="text"
								name="fromplace"
								value="<?php if($dt){echo $dt[0]["FromPlace"];}else{echo "";} ?>"
								class="form-control input-sm select-size" id="from-place"
								readonly>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item">Time In</label> <input type="text"
								name="timein"
								value="<?php if($dt){echo $dt[0]["TimeIn"];}else{echo "";} ?>"
								class="form-control input-sm select-size" id="time-in" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline">
						<div class="form-group">
							<label class="label-item-sm">Flt In</label> <input type="text"
								name="flightin" value=""
								class="form-control input-sm select-size" readonly>
						</div>
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
						<div id="div-new-instransfer" class="list-scroll">
							<table id="table-booking-intransfer" class="table table-fixed">
								<thead>
								<?php if($search_data) {?>
								<tr>
										<td style='min-width: 30px; max-width: 30px;'>Sel</td>
										<td style='min-width: 50px; max-width: 50px;'>In FLT</td>
										<td style='min-width: 40px; max-width: 40px;'>From</td>
										<td style='min-width: 50px; max-width: 50px;'>Time In</td>
										<td style='min-width: 60px; max-width: 60px;'>Pick In</td>
										<td style='min-width: 80px; max-width: 80px;'>Tour Code</td>
										<td style='min-width: 50px; max-width: 50px;'>Status</td>
										<td style='min-width: 80px; max-width: 80px;'>BKL Code</td>
										<td style='min-width: 80px; max-width: 80px;'>Hotel</td>
										<td style='min-width: 40px; max-width: 40px;'>R/Type</td>
										<td style='min-width: 40px; max-width: 40px;'>R/No.</td>
										<td style='min-width: 70px; max-width: 70px;'>Day In</td>
										<td style='min-width: 50px; max-width: 50px;'>Out FLT</td>
										<td style='min-width: 30px; max-width: 30px;'>To</td>
										<td style='min-width: 70px; max-width: 70px;'>Day Out</td>
										<td style='min-width: 60px; max-width: 60px;'>Time Out</td>
										<td style='min-width: 60px; max-width: 60px;'>Pick Out</td>
										<td style='min-width: 158px; max-width: 158px;'>Optional Tour</td>
									</tr>
								</thead>
							<?php }?>                      
							<tbody>
								<?php
        if ($search_data) {
            $i = 1;
            foreach ($search_data as $key => $item) {
                ?>
											<tr
										onclick='check_click("<?php echo $item["TourID"];?>","<?php echo $item["TLTCode"];?>")'
										id='transfer-<?php echo  $item["TourID"]."-". $item["TLTCode"]?>'>
										<td style='min-width: 30px; max-width: 30px;'>
													<?php if ($item["TBLCodeIn"]!=null&&$item["TBLCodeIn"]!=""){?>
													<input type='checkbox' class='select_check'
											value='<?php echo $item['TourID'] ?>*<?php echo $item['TLTCode'] ?>'
											<?php echo "checked='true'"?>
											name='list_check["<?php echo $item['TourID'] ?>-<?php echo $item['TLTCode'] ?>"]'
											id='check-<?php echo $item['TourID'] ?>-<?php echo $item['TLTCode'] ?>'>
													<?php } else {?>
													<input type='checkbox' class='select_check'
											value='<?php echo $item['TourID'] ?>*<?php echo $item['TLTCode'] ?>'
											name='list_check["<?php echo $item['TourID'] ?>-<?php echo $item['TLTCode'] ?>"]'
											id='check-<?php echo $item['TourID'] ?>-<?php echo $item['TLTCode'] ?>'>
													<?php }?>
												</td>
										<td style='min-width: 50px; max-width: 50px;'><?php if($item["InFlight"]) echo $item["InFlight"];?></td>
										<td style='min-width: 40px; max-width: 40px;'><?php if($item["FromPlace"]) echo $item["FromPlace"];?></td>
										<td style='min-width: 50px; max-width: 50px;'><?php if($item["TimeIn"]) echo $item["TimeIn"];?></td>
										<td style='min-width: 60px; max-width: 60px;'><?php if($item["PUIn"]) echo $item["PUIn"];?></td>
										<td style='min-width: 80px; max-width: 80px;'><?php if($item["TourCode"]) echo $item["TourCode"];?></td>
										<td style='min-width: 50px; max-width: 50px;'><?php if($item["TourStatus"]) echo $item["TourStatus"];?></td>
										<td style='min-width: 80px; max-width: 80px;'><?php if($item["TLTCode"]) echo $item["TLTCode"];?></td>
										<td style='min-width: 80px; max-width: 80px;'><?php if($item["Hotel"]) echo $item["Hotel"];?></td>
										<td style='min-width: 40px; max-width: 40px;'><?php if($item["RoomType1"]) echo $item["RoomType1"];?></td>
										<td style='min-width: 40px; max-width: 40px;'><?php if($item["RoomNo1"]) echo $item["RoomNo1"];?></td>
										<td style='min-width: 70px; max-width: 70px;'><?php if($item["ArrvDate1"]) echo $item["ArrvDate1"];?></td>
										<td style='min-width: 50px; max-width: 50px;'><?php if($item["OutFlight"]) echo $item["OutFlight"];?></td>
										<td style='min-width: 30px; max-width: 30px;'><?php if($item["ToPlace"]) echo $item["ToPlace"];?></td>
										<td style='min-width: 70px; max-width: 70px;'><?php if($item["DeptDate1"]) echo $item["DeptDate1"];?></td>
										<td style='min-width: 60px; max-width: 60px;'><?php if($item["TimeOut"]) echo $item["TimeOut"];?></td>
										<td style='min-width: 60px; max-width: 60px;'><?php if($item["PUOutFrom"]) echo $item["PUOutFrom"];?></td>
										<td style='min-width: 158px; max-width: 158px;'><?php if($item["TBLCodeIn"]) echo $item["TBLCodeIn"];?></td>
									</tr>
											<?php
                $i ++;
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
										<label> <input type="checkbox" id="selecctall"> Check Al
										</label>
									</div>
									<div class="checkbox form-margin-top-right">
										<label> <input type="checkbox" id="unselecctall"> Uncheck Al
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
						<textarea class="form-control" rows="7" readonly></textarea>
					</div>
				</div>
			</div>
		</form>
		<div class="row btn-center">
			<button class="btn btn-primary btn-sm button-md"
				onclick="update_tranfer_in()" id="update_intranfer">Update</button>
		</div>
	</div>


</div>
<style type="text/css">
.select-size_per {
	width: 123px !important;
}
</style>
<script type="text/javascript">
var guide = $("#guide").val();
var carno = $("#car-no").val();
var afrom = $("#ac-time-from").val();
var ato   = $("#ac-time-to").val();
var i = 1;
var tr_check = "";
var data_array = new Array();
var chk_comlain = $("#complain_check").prop("checked");
var pecuniary   = $("#Pecuniary").val();
var gcomplainnote = $("#GComplain").val();
$("#table-booking-intransfer > tbody > tr > td > input").each(function(){
	if($(this).prop("checked")==true)
	{
		data_array[i] = $(this).val();
		i++;
	}
});
$(document).ready(function(){
		disableMenu();
		<?php if(!isset($search_data)) { ?>
			$("#selecctall").attr("disabled", true);
			$("#unselecctall").attr("disabled", true);
			<?php } ?>
			$("#selecctall").change(function(){
				$(".select_check").prop('checked', $(this).prop("checked"));
				$("#unselecctall").prop('checked',false);
			});
			
			
			$("#unselecctall").change(function(){
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

			$('input[name=submit]').click(function(){
				if (!$("input[type=checkbox].select_check:checked").length) {
					alert("You must select at least one row!");
					return false;
				}
				return confirm("Are you sure update!"); 
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

			$("#complain_check").click(function () {				
				if($('#complain_check').prop('checked')) {
					($("#GComplain").removeAttr('disabled'));
					($("#Pecuniary").removeAttr('disabled'));
				} else {
					($("#GComplain").attr('disabled','true'));
					($("#Pecuniary").attr('disabled','true'));
					($("#GComplain").val(""));
					($("#Pecuniary").val(""));
				}
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

		});

function GetChangeOutInfor()
{
	var i =1;
	var data_list = new Array();
	$("#table-booking-intransfer > tbody > tr > td > input").each(function()
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

function back_home()
{
	var flag = GetChangeOutInfor();
	if(guide!=$("#guide").val()||carno!=$("#car-no").val()||afrom!=$("#ac-time-from").val()||ato!=$("#ac-time-to").val()||flag==true||chk_comlain!=$("#complain_check").prop("checked")||pecuniary!=$("#Pecuniary").val()||gcomplainnote!=$("#GComplain").val())
	{
		var r = confirm("Data entered will be lose. Are you sure to exit? ");
		if (r == true) 
		{
			location.href = '<?php echo base_url();?>transfer-management/in-transfer';
		}
	}
	else
	{
		location.href = '<?php echo base_url();?>transfer-management/in-transfer';
	}	
}
function update_tranfer_in()
{
	var chk = false;
	var data_array_check = new Array();
	var i =0;
	var n = $("#table-booking-intransfer > tbody > tr").length;
	if(n==0)
	{
		chk = false;
	}
    $("#table-booking-intransfer > tbody > tr > td > input").each(function(){
		if($(this).prop("checked")==true)
		{
			chk = true;
			data_array_check[i] = $(this).val();
			i++;
		}
	});		
	if(chk==false)
	{
		alert("You must select at least one row.");
		return;
	}
	var flag = GetChangeOutInfor();	
	if(guide==$("#guide").val()&&carno==$("#car-no").val()&&afrom==$("#ac-time-from").val()&&ato==$("#ac-time-to").val()&&flag==false&&chk_comlain==$("#complain_check").prop("checked")&&pecuniary==$("#Pecuniary").val()&&gcomplainnote==$("#GComplain").val())
	{
		location.href="<?php echo base_url();?>transfer-management/in-transfer";
		return;
	}
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
	if($("#atime-from").val()=="")
	{
		alert("Select Actual Time From Please !.");
		return;
	}
	if($("#ac-time-to").val()=="")
	{
		alert("Select Actual Time To Please !.");
		return;
	}
	var d = {
		TBLCodeIn      : $("#tblcode").val(),
		guide_info     : guide_info(),
		car_info       : car_info(),
		schedule_f     : $("#schedule-from").val(),
		schedule_t     : $("#schedule-to").val(),
		actual_f       : $("#ac-time-from").val(),
		actual_t       : $("#ac-time-to").val(),
		data_array_check:data_array_check,
		search_field   : search_field()
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
				url: "<?php echo base_url('TransferController/coutguesttotalseat'); ?>",
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
						url: "<?php echo base_url('TransferController/SaveData'); ?>",
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
								location.href="<?php echo base_url();?>transfer-management/in-transfer";
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
				url: "<?php echo base_url('TransferController/SaveData'); ?>",
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
						location.href="<?php echo base_url();?>transfer-management/in-transfer";
					}
				}
			});
		}
		else
		{
			return;
		}	
	}
function search_field()
{
	var dt = {
		date_in    : $("#date-in").val(),
		from_place : $("#from-place").val(),
		time_in    : $("#time-in").val()
	};
	return dt;
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
function  guide_info()
{
	var dt = {
		guideId        : $("#guide").val(),
		guideTel       : $("#guide-tel").val(),
		guidePecuniary : $("#Pecuniary").val(),
		guideGComplain : $("#GComplain").val(),
		check_Complain : $("#complain_check").prop("checked")
	};
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