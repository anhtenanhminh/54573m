<?php

echo $this->load->view('Layout/header');
// echo "<pre>";
// var_dump($booking);exit;
?>
<div class="content">

	<div class="container">
		<h4>UPDATE TRANSFER DETAIL</h4>
		<div class="row line-strong"></div>
		<form method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="row row-border">
						<div class="title-row-div">
							<label class="title-row">Input Fields</label>
						</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Tour Code</label> <input
								type="hidden" value="<?php echo $tour['TourID'] ?>"
								name="TourID" id="tour-id" /> <input type="hidden"
								value="<?php echo $bkl_code;?>" name="BKLCode" id="bkl-code" />
							<input type="text" class="form-control input-sm select-size-lg"
								name="TourCode" placeholder="Tour Code"
								value="<?php echo $tour['TourCode']; ?>" readonly='true'
								id='tour-code'>
						</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">BKL Code</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								placeholder="BKL Code" name="TLTCode"
								value="<?php echo $booking['TLTCode']; ?>" readonly='true'>
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								placeholder="BKL Code" name="TLTCode" readonly='true'>
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">In Flt</label> <select
								id="in_flight" class="form-control input-sm select-size-lg"
								onchange="set_in_flight()">
								<option value=""></option>}
	    					<?php
        if ($flights) {
            foreach ($flights as $key => $row) {
                if ($booking) {
                    ?>
	    								<option value="<?php  echo $row;?>" name="InFlight"
									<?php if($booking["InFlight"]==$row){echo "selected='true'";}?>
									name="InFlight"><?php echo $row;?></option>}
	    					<?php
                } else {
                    ?>
	    								<option value="<?php  echo $row;?>" name="InFlight"><?php echo $row;?></option>			
	    					<?php
                }
            }
        }
        ?>
	    				</select>

						</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">From</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="FromPlace" value="<?php echo $booking['FromPlace']; ?>"
								id="from_label_in" readonly='true' onchange="change_back()">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="FromPlace" id="from_label_in" readonly='true'
								onchange="change_back()">		
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Time In</label>
	    				<?php if($booking){?>	    				
	    				<input type="text" class="form-control input-sm select-size-lg"
								id="time_label_in" name="TimeIn"
								value="<?php echo $booking['TimeIn']; ?>" readonly='true'
								onchange="change_back()">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								id="time_label_in" name="TimeIn" readonly='true'>		
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Pick Up(In)</label>
	    				<?php if($booking){?>
	    				<div class="form-group bfh-timepicker select-size-lg"
								data-input="form-control input-sm" data-name="PUIn"
								data-time="<?php echo $booking['PUIn']; ?>"
								onchange="change_back()" id="pick-up-in"></div>
	    				<?php }else{?>
	    				<div class="form-group bfh-timepicker select-size-lg"
								data-input="form-control input-sm" data-name="PUIn" data-time=""
								onchange="change_back()" id="pick-up-in"></div>
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Day in</label>
	    				<?php if($booking){?>
	    				<div class="form-group bfh-datepicker select-size-lg"
								data-input="form-control input-sm" data-name="ArrvDate1"
								data-date="<?php echo $booking['ArrvDate1']; ?>"
								id="arrv-date-1" onchange="change_back()"></div>
	    				<?php }else{?>
	    				<div class="form-group bfh-datepicker select-size-lg"
								data-input="form-control input-sm" data-name="ArrvDate1"
								data-date="" id="arrv-date-1" onchange="change_back()"></div>
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Hotel</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="Hotel" value="<?php echo $booking['Hotel']; ?>"
								placeholder="Hotel" id="hotel">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="Hotel" value="" placeholder="Hotel" id="hotel">
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">HTL Status</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="HotelStatus1"
								value="<?php echo $booking['HotelStatus1']; ?>"
								placeholder="HTL Status" id="hotel-status">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="HotelStatus1" value="" placeholder="HTL Status"
								id="hotel-status">
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">R/Type</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="RoomType1" value="<?php echo $RoomType1 ?>"
								placeholder="R/Type" id="rtye" onchange="change_back()">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="RoomType1" value="" placeholder="R/Type" id="rtye"
								onchange="change_back()">
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">R/Class</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="RoomClass1" value="<?php echo $booking['RoomClass1'];?>"
								placeholder="R/Class" id="rclass">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="RoomClass1" value="" placeholder="R/Class" id="rclass">
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">R/No</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="RoomNo1" value="<?php echo $RoomNo1; ?>"
								placeholder="R/No" id="rno" onchange="change_back()">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								name="RoomNo1" value="" placeholder="R/No" id="rno"
								onchange="change_back()">		
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Day Out</label>
	    				<?php if($booking){?>
	    				<div class="form-group bfh-datepicker select-size-lg"
								data-input="form-control input-sm" data-name="DeptDate1"
								data-date="<?php echo $booking['DeptDate1']; ?>"
								id="dept-date-1" onchange="change_back()"></div>
	    				<?php }else{?>
	    				<div class="form-group bfh-datepicker select-size-lg"
								data-input="form-control input-sm" data-name="DeptDate1"
								data-date="" id="dept-date-1" onchange="change_back()"></div>
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Out Flt</label> <select
								id="out_flight" class="form-control input-sm select-size-lg"
								onchange="set_out_flight()">
								<option value=""></option>
	    					<?php
        if ($flights_to) {
            foreach ($flights_to as $key => $row) {
                if ($booking) {

                    ?>	
	    								<option value="<?php echo $row;?>" name="OutFlight"
									<?php if($booking["OutFlight"]==$row){echo "selected='true'";}?>><?php echo $row;?></option>
	    					<?php
                } else {
                    ?>
	    								<option value="<?php echo $row;?>" name="OutFlight"><?php echo $row;?></option>
	    					<?php
                }
            }
        }
        ?>
	    				</select>


						</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">To</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								id="to_label_in" name="ToPlace"
								value="<?php echo $booking['ToPlace'] ?>" readonly='true'
								onchange="change_back()">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								id="to_label_in" name="ToPlace" value="" readonly='true'
								onchange="change_back()">	
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Time Out</label>
	    				<?php if($booking){?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								id="time_label_out" name="TimeOut"
								value="<?php echo $booking['TimeOut'] ?>" readonly='true'
								onchange="change_back()">
	    				<?php }else{?>
	    				<input type="text" class="form-control input-sm select-size-lg"
								id="time_label_out" name="TimeOut" value="" readonly='true'
								onchange="change_back()">
	    				<?php }?>
	    			</div>
						<div class="form-inline form-margin-bottom form-group">
							<label class="label-item-lg">Pick Up(Out)</label>
	    				<?php if($booking){?>
	    					<div class="form-group bfh-timepicker pick_time_out"
								data-input="form-control input-sm " data-name="PUOutFrom"
								data-time="<?php echo $booking['PUOutFrom'] ?>"
								onchange="change_back()" id="puout-from"></div>
	    				<?php }else{?>
	    					<div class="form-group bfh-timepicker pick_time_out"
								data-input="form-control input-sm " data-name="PUOutFrom"
								data-time="" onchange="change_back()" id="puout-from"></div>
	    				<?php }?>	
	    					<label>-</label>
	    				<?php if($booking){?>
	    					<div class="form-group bfh-timepicker pick_time_out"
								data-input="form-control input-sm " data-name="PUOutTo"
								data-time="<?php echo $booking['PUOutTo'] ?>"
								onchange="change_back()" id="puout-to"></div>
	    				<?php }else{?>
	    					<div class="form-group bfh-timepicker pick_time_out"
								data-input="form-control input-sm " data-name="PUOutTo"
								data-time="" onchange="change_back()" id="puout-to"></div>
	    				<?php }?>
	    			</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="button-action-div">
							<ul class="nav nav-tabs">
								<li class="nav active"><a href="#in" data-toggle="tab">In
										Transfer</a></li>
								<li class="nav"><a href="#out" data-toggle="tab">Out Transfer</a></li>
							</ul>
						</div>
					</div>
					<div class="tab-content">
						<div class="row row-none-border-1 tab-pane fade in active" id="in">
							<div class="col-md-5">
								<div class="row row-border">
									<div class="title-row-div">
										<label class="title-row">Tour Guest</label>
									</div>
									<div class="in_tranfer_list">
										<div class="title_guest">Guest Name</div>
										<div id="div-tour-optional-update-tour-common"
											class="list-scroll">
											<table id="table-tour-in_guest_list"
												class="table table-fixed">

												<tbody>
												<?php
            if ($in_tour_guest) {
                foreach ($in_tour_guest as $value) {
                    ?>
														   	<tr id='row_guest<?php echo $value["GuestID"]; ?>'
														onclick="select_guest_row('<?php echo $value["GuestID"]; ?>')">

														<input type="hidden"
															name="in_hidden_id[<?php echo $value['GuestID'];?>]"
															value="<?php echo $value['GuestID'];?>">
														<td id="item<?php echo $value["GuestID"]; ?>">
															<div class="glyphicon glyphicon-play icon-edit"></div>
															<div style='width: 195px'
																id="item-in-<?php echo $value['GuestID'];?>"><?php echo $value['GuestName'] ?></div>
														</td>

													</tr>
												<?php

}
            }
            ?>	
											</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="move_all_to_tranfer()">>></label>
								</div>
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="move_all_to_guest()"><<</label>
								</div>
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="move_single_row_to_tranfer()">></label>
								</div>
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="move_single_row_to_inguest()"><</label>
								</div>
							</div>
							<div class="col-md-5">
								<div class="row row-border">
									<div class="title-row-div">
										<label class="title-row">Transfered Guest</label>
									</div>
									<div class="in_tranfer_list">
										<div class="title_guest">Guest Name</div>
										<div id="div-tour-optional-update-tour-common"
											class="list-scroll">
											<table id="table-tour-transfer_guest_list"
												class="table table-fixed">
												<tbody>
									
												<?php
            if ($in_tour_tranfer_guest) {
                foreach ($in_tour_tranfer_guest as $value) {
                    ?>
														   	<tr id='row_transfer<?php echo $value["GuestID"]; ?>'
														onclick="select_transfer_guest_row('<?php echo $value["GuestID"]; ?>')">
														<input type='hidden'
															name='tranfer_hidden_id[<?php echo $value["GuestID"]; ?>]'
															value='<?php echo $value["GuestID"]; ?>'>
														<td id='item<?php echo $value["GuestID"]; ?>'>
															<div class="glyphicon glyphicon-play icon-edit"></div>
															<div style='width: 195px'
																id="item-in-<?php echo $value['GuestID']; ?>"><?php echo $value['GuestName'] ?></div>
														</td>
													</tr>
												<?php

}
            }
            ?>	
											</tbody>
											</table>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="row row-none-border-1 tab-pane fade" id="out"
							style="background-color: #f9f9f9">
							<div class="col-md-5">
								<div class="row row-border">
									<div class="title-row-div">
										<label class="title-row">Tour Guest</label>
									</div>
									<div class="out_tranfer_list">
										<div class="title_guest">Guest Name</div>
										<div id="div-tour-optional-update-tour-common"
											class="list-scroll">
											<table id="outtranfer_table-tour-in_guest_list"
												class="table table-fixed">

												<tbody>
											<?php
        foreach ($out_tour_guest as $key => $value) {
            ?>
											   	<tr
														id='outtranfer_row_guest<?php echo $value["GuestID"]; ?>'
														onclick="outtranfer_select_guest_row('<?php echo $value["GuestID"]; ?>')">

														<input type="hidden"
															name="outtranfer_in_hidden_id[<?php echo $value['GuestID'];?>]"
															value="<?php echo $value['GuestID'];?>">
														<td id="outtranfer_item<?php echo $value["GuestID"]; ?>">
															<div class="glyphicon glyphicon-play icon-edit"></div>
															<div style='width: 195px'
																id="item-out-<?php echo $value['GuestID'];?>"><?php echo $value['GuestName'] ?></div>
														</td>

													</tr>
											<?php
        }
        ?>
											</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="outtranfer_move_all_to_tranfer()">>></label>
								</div>
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="outtranfer_move_all_to_guest()"><<</label>
								</div>
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="outtranfer_move_single_row_to_tranfer()">></label>
								</div>
								<div class="row btn-center">
									<label class="btn btn-primary btn-sm button-md"
										onclick="outtranfer_move_single_row_to_inguest()"><</label>
								</div>
							</div>
							<div class="col-md-5">
								<div class="row row-border">
									<div class="title-row-div">
										<label class="title-row">Transfered Guest</label>
									</div>
									<div class="out_tranfer_list">
										<div class="title_guest">Guest Name</div>

										<div id="div-tour-optional-update-tour-common"
											class="list-scroll">
											<table id="outtranfer_table-tour-transfer_guest_list"
												class="table table-fixed">
												<tbody>
									
												<?php
            if ($out_tour_tranfer_guest) {
                foreach ($out_tour_tranfer_guest as $value) {
                    ?>
														   	<tr
														id='outtranfer_row_transfer<?php echo $value["GuestID"]; ?>'
														onclick="outtranfer_select_transfer_guest_row('<?php echo $value["GuestID"]; ?>')">
														<input type='hidden'
															name='outtranfer_tranfer_hidden_id[<?php echo $value["GuestID"]; ?>]'
															value='<?php echo $value["GuestID"]; ?>'>
														<td id='outtranfer_item<?php echo $value["GuestID"]; ?>'>
															<div class="glyphicon glyphicon-play icon-edit"></div>
															<div style='width: 195px'
																id="item-out-<?php echo $value['GuestID']; ?>"><?php echo $value['GuestName'] ?></div>
														</td>
													</tr>
												<?php

}
            }
            ?>	
											</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row row-border-1">
						<div class="title-row-div">
							<label class="title-row">Transfer Note</label>
						</div>
					<?php if($booking){?>
					<textarea class="form-control" rows="5" name="NoteTransfer"
							onchange="change_back()" id="note-transfer"><?php echo $booking['NoteTransfer']; ?></textarea>
					<?php }else{?>
					<textarea class="form-control" rows="5" name="NoteTransfer"
							onchange="change_back()" id="note-transfer"></textarea>
					<?php }?>
				</div>
					<div class="row row-border-1">
						<div class="title-row-div">
							<label class="title-row">In Note</label>
						</div>
					<?php if($booking){?>
					<textarea class="form-control" rows="5" name="NoteIn"
							onchange="change_back()" id="note-in"><?php echo $booking['NoteIn'] ?></textarea>
					<?php }else{?>
					<textarea class="form-control" rows="5" name="NoteIn"
							onchange="change_back()" id="note-in"></textarea>
					<?php }?>
				</div>
				</div>
			</div>
		</form>
		<div class="row" style="float: right;">
			<div class="button-action-div">
				<button class="btn btn-primary button-md btn-action" type="submit"
					onclick="update_transfer()">Update</button>
				<button class="btn btn-primary button-md btn-action" type="submit"
					onclick="back_home()">Back</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var flag_back = false;
	var row_id ="";
	tranfer_row_id = '';
	var data_id = new Array();
	var data_guest = new Array();
	var data_id_out = new Array();
	var data_guest_out = new Array();	
	var n_guest_transfer_in;
	var n_guest_transfer_out;
	var guest_transfer_in = new Array();
	var guest_transfer_out = new Array();
	$(document).ready(function()
	{	
		n_guest_transfer_in = $("#table-tour-transfer_guest_list > tbody > tr").length;
		n_guest_transfer_out = $("#outtranfer_table-tour-transfer_guest_list > tbody > tr").length;
		var i=0;
		if(n_guest_transfer_in>0)
		{
			$("#table-tour-transfer_guest_list > tbody > tr > td > div:nth-child(2)").each(function(){
				if($(this).html()!="")
				{
					guest_transfer_in[i] = $(this).html();
					i++;
				}
			});
		}

		i=0;
		if(n_guest_transfer_out>0)
		{
			$("#outtranfer_table-tour-transfer_guest_list > tbody > tr > td > div:nth-child(2)").each(function(){
				if($(this).html()!="")
				{
					guest_transfer_out[i] = $(this).html();
					i++;
				}
			});
		}
		$("#arrv-date-1").attr("disabled",true);
		$("#arrv-date-1 > div > input").attr("disabled",true);
		$("#hotel").attr("disabled",true);
		$("#hotel-status").attr("disabled",true);
		$("#rtye").attr("disabled",true);
		$("#rclass").attr("disabled",true);	
		$("#rno").attr("disabled",true);
		$("#dept-date-1").attr("disabled",true);
		$("#dept-date-1 > div > input").attr("disabled",true);		
		$("#pick-up-in").keypress(function(e){
		return checkKeyPress($(this).val().length, e);
	});

	$('input[name=PUIn],input[name=PUOutFrom],input[name=PUOutTo]').keypress(function(evt){
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
		$('input[name=PUIn],input[name=PUOutFrom],input[name=PUOutTo]').blur(function(event)
			{
				var name = $(this).attr('name');
				var time = $(this).val();
				if (time == '') return false;
				// if(!isNaN(time) && (time >=0 && time < 24) && time !='')
				// {
				// 	flag_check_time = true;
				// 	if(time<10)
				// 	{
				// 		$(this).val('0'+parseInt(time)+':00');
				// 	}
				// 	else
				// 	{
				// 		$(this).val(time+':00');
				// 	}
				// }
				// else if(time !='')
				// {
				// 	array_time = time.split(':');
				// 	if(array_time.length != 2 || array_time[0] >=24 || array_time[0] < 0 || array_time[1] < 0 || array_time[1] >59 || array_time[0].length !=2 || array_time[1].length!=2)
				// 	{
				// 		flag_check_time = false;
				// 		alert('Time must be formartted as [HH:MM]');
				// 		setTimeout(function(){
				// 		$('input[name='+name+']').trigger('focus');
				// 		},1);
				// 	}
					
				// }
				if (!checkChange(time)) {
					setTimeout(function(){
						$('input[name='+name+']').trigger('focus');
					},1);
				} else {
					$(this).val(reFormat(time));
				}
			});		
	});
	


	function change_back()
	{
		flag_back = true;
	}

	function set_in_flight()
	{
		flag_back = true;
		var id = $("#in_flight").val();
		var url= "<?php echo base_url('TransferController/select_flight_byid'); ?>";
		var data = {id:id};		
		var result= call_ajax(url,data);
		obj = JSON.parse(result);
		$("#from_label_in").val(obj[0].FltPlace);
		$("#time_label_in").val(obj[0].FltTime);
	}
	function set_out_flight()
	{
		flag_back = true;
		var id = $("#out_flight").val();
		var url= "<?php echo base_url('TransferController/select_flight_byid'); ?>";
		var data = {id:id};
		
		var result= call_ajax(url,data);
		var obj3 = JSON.parse(result);

		$("#to_label_in").val(obj3[0].FltPlace);
		$("#time_label_out").val(obj3[0].FltTime);
		
		
	}
	function outtranfer_move_all_to_tranfer()
	{
		var str = $("#outtranfer_table-tour-in_guest_list tbody").html();
		str =str.split("outtranfer_row_guest").join("outtranfer_row_transfer");
		str =str.split("outtranfer_select_guest_row").join("outtranfer_select_transfer_guest_row");
		str =str.split("outtranfer_in_hidden_id").join("outtranfer_tranfer_hidden_id");		
		$("#outtranfer_table-tour-transfer_guest_list tbody").append(str);
		$("#outtranfer_table-tour-in_guest_list tbody").html("");
		row_id = "";
	
	}
	function outtranfer_move_all_to_guest()
	{
		var str = $("#outtranfer_table-tour-transfer_guest_list tbody").html();
		str =str.split("outtranfer_row_transfer").join("outtranfer_row_guest");
		str =str.split("outtranfer_select_transfer_guest_row").join("outtranfer_select_guest_row");
		str =str.split("outtranfer_tranfer_hidden_id").join("outtranfer_in_hidden_id");		
		
		$("#outtranfer_table-tour-in_guest_list tbody").append(str);
		$("#outtranfer_table-tour-transfer_guest_list tbody").html("");
		tranfer_row_id = "";
	
	}
	function outtranfer_select_guest_row(id)
	{
		row_id=id;
		$("#outtranfer_table-tour-in_guest_list").find("tr").css("background","transparent");
		$("#outtranfer_row_guest"+row_id).css("background","#397FDB");
	}
	function outtranfer_select_transfer_guest_row(id)
	{
		tranfer_row_id=id;
		$("#outtranfer_table-tour-transfer_guest_list").find("tr").css("background","transparent");
		$("#outtranfer_row_transfer"+tranfer_row_id).css("background","#397FDB");
	}
	function outtranfer_move_single_row_to_tranfer()
	{
		if(row_id!=""){
		var t = $("#outtranfer_item"+row_id).html();
	
		$("#outtranfer_row_guest"+row_id).remove();
		var a ="<tr id='outtranfer_row_transfer"+row_id+ "' onclick='outtranfer_select_transfer_guest_row("+row_id+")'><input type='hidden' name='outtranfer_tranfer_hidden_id["+row_id+"]' value='"+row_id+"'>	<td id='outtranfer_item"+row_id+"'>"+t+"</td></tr>";
		$("#outtranfer_table-tour-transfer_guest_list tbody").append(a);
		row_id = "";
		}
	}
	function outtranfer_move_single_row_to_inguest()
	{
		if(tranfer_row_id!=""){
			var t = $("#outtranfer_item"+tranfer_row_id).html();
			
			$("#outtranfer_row_transfer"+tranfer_row_id).remove();
			var a ="<tr id='outtranfer_row_guest"+tranfer_row_id+ "' onclick='outtranfer_select_guest_row("+tranfer_row_id+")'><input type='hidden' name='outtranfer_in_hidden_id["+tranfer_row_id+"]' value='"+tranfer_row_id+"'>	<td id='outtranfer_item"+tranfer_row_id+"'>"+t+"</td></tr>";
		
			$("#outtranfer_table-tour-in_guest_list tbody").append(a);
			tranfer_row_id="";
		}
	}
	function move_all_to_tranfer()
	{
		var str = $("#table-tour-in_guest_list tbody").html();
		str =str.split("row_guest").join("row_transfer");
		str =str.split("select_guest_row").join("select_transfer_guest_row");
		str =str.split("in_hidden_id").join("tranfer_hidden_id");
		$("#table-tour-transfer_guest_list tbody").append(str);
		$("#table-tour-in_guest_list tbody").html("");
		row_id = "";
	}
	function move_all_to_guest()
	{
		var str = $("#table-tour-transfer_guest_list tbody").html();
		str =str.split("row_transfer").join("row_guest");
		str =str.split("select_transfer_guest_row").join("select_guest_row");
		str =str.split("tranfer_hidden_id").join("in_hidden_id");		
		$("#table-tour-in_guest_list tbody").append(str);
		$("#table-tour-transfer_guest_list tbody").html("");
		tranfer_row_id = "";		
	}
	function select_guest_row(id)
	{
		row_id=id;
		$("#table-tour-in_guest_list").find("tr").css("background","transparent");
		$("#row_guest"+row_id).css("background","#397FDB");
	}
	function select_transfer_guest_row(id)
	{
	
		tranfer_row_id=id;
		$("#table-tour-transfer_guest_list").find("tr").css("background","transparent");
		$("#row_transfer"+tranfer_row_id).css("background","#397FDB");
	}
	function move_single_row_to_tranfer()
	{
		if(row_id!=""){
		var t = $("#item"+row_id).html();
	
		$("#row_guest"+row_id).remove();
		var a ="<tr id='row_transfer"+row_id+ "' onclick='select_transfer_guest_row("+row_id+")'><input type='hidden' name='tranfer_hidden_id["+row_id+"]' value='"+row_id+"'>	<td id='item"+row_id+"'>"+t+"</td></tr>";
		$("#table-tour-transfer_guest_list tbody").append(a);
		row_id = "";
		}
	}
	function move_single_row_to_inguest()
	{
		if(tranfer_row_id!=""){
			var t = $("#item"+tranfer_row_id).html();
			
			$("#row_transfer"+tranfer_row_id).remove();
			var a ="<tr id='row_guest"+tranfer_row_id+ "' onclick='select_guest_row("+tranfer_row_id+")'><input type='hidden' name='in_hidden_id["+tranfer_row_id+"]' value='"+tranfer_row_id+"'>	<td id='item"+tranfer_row_id+"'>"+t+"</td></tr>";
		
			$("#table-tour-in_guest_list tbody").append(a);
			tranfer_row_id="";
		}
	}
	function back_home()
	{	
		var id = $("#tour-id").val();
		check_change();			
		if(flag_back==true)
		{
			var r = confirm("Data entered will be lose. Are you sure to exit ?");
			if(r)
			{
				location.href = "<?php echo base_url();?>transfer-management/update-tour-information";
			}
			else
			{
				return;
			}
		}
		else
		{
			location.href = "<?php echo base_url();?>transfer-management/update-tour-information";
		}		
	}
	function check_change()
	{	
		var m = $("#table-tour-transfer_guest_list > tbody > tr").length;
		var i =0;
		if(m!=n_guest_transfer_in)
		{			
			flag_back = true;
			return;
		}
		else
		{
			if(m!=0&&n_guest_transfer_in!=0)
			{
				$("#table-tour-transfer_guest_list > tbody > tr > td > div:nth-child(2)").each(function(){
					if($(this).html()!="")
					{
						for(i=0;i<n_guest_transfer_in;i++)
						{
							if(guest_transfer_in[i]!=$(this).html())
							{
								flag_back = true;
								return;													
							}
						}
					}					
				});
			}
			else
			{
				flag_back = false;
			}
		}	
		i =0;
		
		var n = $("#outtranfer_table-tour-transfer_guest_list > tbody > tr").length;
		if(n!=n_guest_transfer_out)
		{
			flag_back = true;
			return;
		}
		else
		{
			if(n!=0&&n_guest_transfer_out!=0)
			{
				$("#outtranfer_table-tour-transfer_guest_list > tbody > tr > td > div:nth-child(2)").each(function(){
					if($(this).html()!="")
					{
						for(i=0;i<n_guest_transfer_out;i++)
						{
							if(guest_transfer_out[i]!=$(this).html())
							{
								flag_back = true;	
								return;							
							}
						}
					}					
				});
			}
			else
			{
				flag_back = false;
			}
		}
	}
	function load_in_guest()
	{
		var n = $("#table-tour-transfer_guest_list > tbody > tr").length;
		if(n>0)
		{			
			var i=0;var j=0;var k=0;			
			$("#table-tour-transfer_guest_list > tbody > tr > input").each(function(){
				data_id[j] = $(this).val();
				j++;
			});		
			for(i=0;i<n;i++)
			{
				data_guest[i] = ($("#item-in-"+data_id[i]).html());
			}			
		}
		else
		{
			data_id = "false";
			data_guest = "false";
		}		
	}

	function load_out_guest()
	{
		var n = $("#outtranfer_table-tour-transfer_guest_list > tbody > tr").length;
		if(n>0)
		{			
			var i=0;var j=0;var k=0;			
			$("#outtranfer_table-tour-transfer_guest_list > tbody > tr > input").each(function(){
				data_id_out[j] = $(this).val();
				j++;
			});		
			for(i=0;i<=n;i++)
			{
				data_guest_out[i] = ($("#item-out-"+data_id_out[i]).html());
			}			
		}
		else
		{
			data_id_out    = "false";
			data_guest_out = "false";
		}		
	}
	function update_transfer()
	{		
		load_out_guest();
		load_in_guest();			
		check_change();	
			var dt = {
			bkl_code 			  : $("#bkl-code").val(),
			tour_id 			  : $("#tour-id").val(),
			tour_code			  : $("#tour-code").val(),
			inflight 			  : $("#in_flight").val(),
			fromplace 			  : $("#from_label_in").val(),
			timein 			      : $("#time_label_in").val(),
			puin  				  : $("#pick-up-in > div > input").val(),
			arrv_date			  : $("#arrv-date-1 > div > input").val(),
			hotel 				  : $("#hotel").val(),
			hotel_status		  : $("#hotel-status").val(),
			room_type			  : $("#rtye").val(),
			room_class			  : $("#rclass").val(),
			room_no 			  : $("#rno").val(),
			dept_date 			  : $("#dept-date-1 > div > input").val(),
			out_flight            : $("#out_flight").val(),
			to_place			  : $("#to_label_in").val(),
			time_out			  : $("#time_label_out").val(),
			puout_from			  : $("#puout-from > div > input").val(),
			puout_to			  : $("#puout-to > div > input").val(),
			note_transfer		  : $("#note-transfer").val(),
			note_in 			  : $("#note-in").val(),
			data_in_id            : data_id,
			data_in_guest		  : data_guest,
			data_out_id            : data_id_out,
			data_out_guest		  : data_guest_out	
		};	
			
		if(flag_back==false)
		{
			location.href = "<?php echo base_url();?>transfer-management/update-tour-information";
		}
		var execute = TestData();
		if(execute==false)
		{
			location.href = "<?php echo base_url();?>transfer-management/update-tour-information";
		}
		$.ajax({
                    url: "<?php echo base_url('TransferController/update_transfer'); ?>",
                         async: false,
                         type: "POST",  
                         data: dt, 
                         dataType: "json",                         
                         success: function(data) 
                         { 
                          	  alert(data);
                          	  location.href = "<?php echo base_url();?>transfer-management/update-tour-information?id="+dt.tour_id;
                         }
                 }); 			
	}
	function TestData()
	{
		if(Testintransfer()==true && TestOuttransfer()==false)
		{
			return true;
		}
		if(Testintransfer()==false && TestOuttransfer()==true)
		{
			return true;
		}
		if(Testintransfer()==true && TestOuttransfer()==true)
		{
			return true;
		}
		return false;
	}
	function Testintransfer()
	{
		if($("#hotel").val()=="" || $("#in_flight").val() =="" || $("#from_label_in").val()=="" || $("#time_label_in").val()=="" || $("#pick-up-in > div > input").val()=="" || $("#arrv-date-1 > div > input").val()=="")
		{
			return false;
		}
		return true;
	}
	function TestOuttransfer()
	{
		if($("#out_flight").val()=="" || $("#to_label_in").val()=="" ||$("#dept-date-1 > div > input").val()=="" || $("#time_label_out").val()=="" || $("#puout-from > div > input").val()=="" || $("#puout-to > div > input").val()=="")
		{
			return true;
		}
		return true;
	}

</script>
<style type="text/css">
.pick_time_out {
	width: 25%;
}

.out_tranfer_list {
	background-color: white;
	height: 145px;
	overflow: auto;
}

.in_tranfer_list {
	background-color: white;
	height: 145px;
	overflow: auto;
}

.title_guest {
	padding: 5px;
	border: 1px solid #A0A0A0;
}

.item_guest {
	padding: 5px;
}
</style>
<?php echo $this->load->view('Layout/footer');?>