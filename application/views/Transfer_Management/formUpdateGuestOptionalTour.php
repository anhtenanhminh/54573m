<?php echo $this->load->view('Layout/header')?>
<div class="content">

	<div class="container">
		<h1>
			UPDATE GUEST'S OPTIONAL TOUR
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;" onclick="back_home()">Back</button>
		</h1>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="row">
				<div class="col-md-3">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Tour Code</label> <input id="tour-code"
								type="text" class="form-control input-sm select-size"
								value="<?php echo ($tour_info)?$tour_info[0]["TourCode"]:"" ?>"
								readonly> <input id="count-guest" type="hidden"
								class="form-control input-sm select-size"
								value="<?php echo $count_guest;?>"> <input id="tour-id"
								type="hidden" class="form-control input-sm select-size"
								value="<?php echo $id_tour;?>">
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">Vn Code</label> <input id="vn-code"
								type="text" class="form-control input-sm select-size"
								value="<?php echo ($tour_info)?$tour_info[0]["VNCode"]:"" ?>"
								readonly>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-sm">City</label> <select id="city"
								class="form-control input-sm select-size-md">
								<option></option>
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
				<div class="col-md-3">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-lg">Packet Name</label> <select
								class="form-control input-sm select-size-md">
								<option></option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row btn-center">
						<button class="btn btn-primary btn-sm button-xlg"
							onclick="location.href='<?php echo base_url('optional-tour/option-tour-list?c=' . $id_tour);?>'">Optional
							Tour Management</button>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Common Tours</label>
					</div>
					<div class="col-md-7">
						<div class="row row-border-1">
							<div class="title-row-div">
								<label class="title-row">Registered Optional Tours</label>
							</div>
							<div class="col-md-3">
								<div class="row btn-center">
									<button class="btn btn-primary btn-sm button-md"
										onclick="update_tour_optional_common()">Save</button>
								</div>
								<div class="row btn-center">
									<button class="btn btn-primary btn-sm button-md"
										onclick="delete_tour_reg_common()" id="delete-rg-common">Delete</button>
								</div>
								<form
									action="<?php echo base_url('TransferController/export_golf_spa');?>"
									method="POST">
									<input type="hidden" name="optionaltourlistid"
										id="optionaltourlistid" value=""> <input type="hidden"
										name="tourname" id="tourname"> <input type="hidden"
										name="date" id="date"> <input type="hidden" name="pu-from"
										id="pu_from"> <input type="hidden" name="time" id="time"> <input
										type="hidden" name="cty" id="cty"> <input type="hidden"
										name="tee-time" id="tee_time"> <input type="hidden"
										name="payment" id="pay_ment"> <input type="hidden"
										name="tourcode" id="tourcode"> <input type="hidden"
										name="vncode" id="vncode">
									<div class="row btn-center">
										<input type="submit" class="btn btn-primary btn-sm button-md"
											id="btnPrint" disabled="true" value="Print">
									</div>
								</form>

							</div>
							<div class="col-md-9">
								<div id="div-reg-optional-tour-common" class="list-scroll">
									<table id="table-reg-optional-tour-common"
										class="table table-fixed">
										<thead>
											<tr>
												<td style='width: 20px'></td>
												<td style='width: 110px'>Tour Name</td>
												<td style='width: 68px'>Date</td>
												<td style='width: 68px'>PU From</td>
												<td style='width: 68px'>From Time</td>
												<td style='width: 70px'>City Name</td>
												<td style='width: 68px'>Tee of time</td>
												<td style='width: 68px'>Payment</td>
											</tr>
										</thead>
										<tbody>
									<?php
        $index_common = 0;
        if ($optional_tour_reg_common) {
            foreach ($optional_tour_reg_common as $key => $row) {
                $index_common = $key;
                ?>
											   	<tr id="new-optional-tour-common-<?php echo $key+1;?>"
												onclick="select_optional_tour_common_regis(<?php echo $key+1;?>)">
												<td style='width: 20px'
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)">
													<div class="glyphicon glyphicon-play icon-edit">
														<input type="hidden"
															value="<?php echo $row["OptionalTourListID"];?>">
													</div>
												</td>
												<td style='width: 110px'><input type="text" readonly=""
													value="<?php echo $row["TourName"];?>"
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)"></td>
												<td style='width: 68px'><input type="text"
													value="<?php echo $row["Date"];?>"
													id='datecommon<?php echo $key+1 ?>'
													onblur="check_date(<?php echo $key+1; ?>)"
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)"></td>
												<td style='width: 68px'><input type="text"
													value="<?php echo $row["PUFrom"];?>"
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)"></td>
												<td style='width: 68px'><input
													id='fromtimecommon<?php echo $key+1 ?>'
													class="checktime common" type="text"
													value="<?php echo $row["FromTime"];?>"
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)"></td>
												<td style='width: 70px'><input type="text"
													value="<?php echo $row["City"];?>"
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)"></td>
												<td style='width: 68px'><input type="text"
													value="<?php echo $row["Teeoftime"];?>"
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)"></td>
												<td style='width: 68px'><input type="text"
													value="<?php echo $row["Payment"];?>"
													onclick="select_tour_reg_common(<?php echo $key+1; ?>)"></td>
											</tr>
									<?php

}
        }
        ?>	
									<tr
												id="new-optional-tour-common-<?php echo count($optional_tour_reg_common)+1;?>"
												onclick="select_optional_tour_common_regis(<?php echo count($optional_tour_reg_common)+1;?>)">
												<td style='width: 20px'
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
												<td style='width: 110px'><input type="text" readonly=""
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
												<td style='width: 68px'><input type="text"
													id='datecommon<?php echo count($optional_tour_reg_common)+1 ?>'
													onblur="check_date(<?php echo count($optional_tour_reg_common)+1;; ?>)"
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
												<td style='width: 68px'><input type="text"
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
												<td style='width: 68px'><input
													id='fromtimecommon<?php echo count($optional_tour_reg_common)+1 ?>'
													class="checktime common" type="text"
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
												<td style='width: 70px'><input type="text"
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
												<td style='width: 68px'><input type="text"
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
												<td style='width: 68px'><input type="text"
													onclick="select_tour_reg_common(<?php echo count($optional_tour_reg_common)+1;?>)"></td>
											</tr>

										</tbody>
									</table>
									<input type="hidden" id="index-common"
										value="<?php echo count($optional_tour_reg_common)+1; ?>">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1">
						<div class="button-action-div-1">
							<button class="btn btn-primary btn-sm button-sm btn-action"
								onclick="move_optional_tour_common()" id="insert-tour-common"><<</button>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row row-border-1">
							<div class="title-row-div">
								<label class="title-row">Optional Tours Information</label>
							</div>
							<div id="div-tour-optional-update-tour-common"
								class="list-scroll">
								<table id="table-tour-optional-update-tour-common"
									class="table table-fixed">
									<thead>
										<tr>
											<td style='width: 20px'></td>
											<td style='width: 195px'>Tour Name</td>
											<td style='width: 80px'>From Time</td>
											<td style='width: 80px'>To Time</td>
											<td style='width: 80px'>City Name</td>
										</tr>
									</thead>
									<tbody>
										<?php
        if ($optional_tour) {
            foreach ($optional_tour as $row) {
                ?>
												   	<tr
											id='tour-common-<?php echo $row["OptionalTourListID"]; ?>'
											onclick="select_optional_tour_common('<?php echo $row["OptionalTourListID"]; ?>')">

											<td style='width: 20px'>
												<div class="glyphicon glyphicon-play icon-edit">
													<input type="hidden"
														value="<?php echo $row["OptionalTourListID"]; ?>">
												</div>
											</td>
											<td style='width: 195px'><?php echo $row["TourName"]; ?></td>
											<td style='width: 80px'><?php echo $row["FromTime"]; ?></td>
											<td style='width: 80px'><?php echo $row["ToTime"]; ?></td>
											<td style='width: 80px'><?php echo $row["City"]; ?></td>
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
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Individual Tours</label>
			</div>
			<div class="col-md-3">
				<div class="row-none-border-1">
					<div id="div-guest-individual" class="list-scroll">
						<table id="table-guest-individual" class="table table-fixed">
							<thead>
								<tr>
									<td style="width: 20px"></td>
									<td style='width: 208px'>Guest Name</td>
								</tr>
							</thead>
							<tbody>
								<?php
        if ($guest) {
            foreach ($guest as $row) {
                ?>
											   <tr id="guest-<?php echo $row["GuestID"]; ?>"
									onclick="select_guest_individual(<?php echo $row["GuestID"]; ?>)">
									<td style="width: 20px"><div
											class="glyphicon glyphicon-play icon-edit"></div></td>
									<td style='width: 208px'><?php echo $row["GuestName"]; ?></td>
								</tr>
								<?php

}
        }
        ?>	
							</tbody>
						</table>
						<input id="guestid-selected" type="hidden"
							value="<?php echo $guest[0]["GuestID"]?>">
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Registed Optional Tours</label>
					</div>
					<div class="col-md-3">
						<div class="checkbox form-margin-top-right">
							<label> <input type="checkbox" disabled="true">Copy
							</label>
						</div>
						<div class="row btn-center">
							<button class="btn btn-primary btn-sm button-md"
								onclick="update_tour_optional_individual()">Save</button>
						</div>
						<div class="row btn-center">
							<button class="btn btn-primary btn-sm button-md"
								onclick="delete_tour_reg_individual()"
								id="delete-tour-individual">Delete</button>
						</div>
					</div>
					<div class="col-md-9">
						<div id="div-reg-optional-tour-individual" class="list-scroll">
							<table id="table-reg-optional-tour-individual"
								class="table table-fixed">
								<thead>
									<tr>
										<td style='width: 20px'></td>
										<td style='width: 143px'>Tour Name</td>
										<td style='width: 68px'>Date</td>
										<td style='width: 30px'>VN</td>
										<td style='width: 68px'>PU From</td>
										<td style='width: 68px'>PU To</td>
										<td style='width: 68px'>From Time</td>
										<td style='width: 68px'>To Time</td>
										<td style='width: 70px'>Tour Free</td>
										<td style='width: 70px'>City Name</td>
									</tr>
								</thead>
								<tbody>
									<?php
        $index_individual = 0;
        if ($optional_tour_reg_individual) {
            foreach ($optional_tour_reg_individual as $key => $row) {
                $index_individual = $key;
                ?>
												<tr id="new-optional-tour-individual-<?php echo $key+1; ?>"
										onclick="select_optional_tour_individual_regis(<?php echo $key+1; ?>)">
										<td style='width: 20px'
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)">
											<div class="glyphicon glyphicon-play icon-edit">
												<input type="hidden"
													value="<?php echo $row["OptionalTourListID"];?>"> <input
													type="hidden" value="old" />
											</div>
										</td>
										<td style='width: 143px'><input type="text" readonly
											value="<?php echo $row["TourName"];?>"
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 68px'><input type="text"
											value="<?php echo $row["Date"];?>"
											id='dateindividual<?php echo $key+1 ?>'
											onblur="check_date1(<?php echo $key+1; ?>)"
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 30px'><input type="text"
											value="<?php echo $row["RegPlace"];?>"
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 68px'><input type="text"
											value="<?php echo $row["PUFrom"];?>" readonly=""
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 68px'><input type="text"
											value="<?php echo $row["PUTo"];?>" readonly=""
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 68px'><input
											id='fromtimeindividual<?php echo $key +1 ?>'
											class="checktime individual" type="text"
											value="<?php echo $row["FromTime"];?>"
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 68px'><input type="text"
											value="<?php echo $row["ToTime"];?>"
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 70px'><input type="text"
											value="<?php echo $row["TourFree"];?>"
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
										<td style='width: 70px'><input type="text"
											value="<?php echo $row["City"];?>"
											onclick="select_tour_reg_individual(<?php echo $key+1; ?>)"></td>
									</tr>
									<?php

}
        }
        ?>
									<tr
										id="new-optional-tour-individual-<?php echo count($optional_tour_reg_individual) + 1; ?>"
										onclick="select_optional_tour_individual_regis(<?php echo count($optional_tour_reg_individual)+1; ?>)">
										<td style='width: 20px'
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 143px'><input type="text" readonly=""
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 68px'><input type="text"
											id='dateindividual<?php echo count($optional_tour_reg_individual) + 1; ?>'
											onblur="check_date1(<?php echo count($optional_tour_reg_individual)+1; ?>)"
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 30px'><input type="text"
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 68px'><input type="text" readonly=""
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 68px'><input type="text" readonly=""
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 68px'><input
											id="fromtimeindividual<?php echo count($optional_tour_reg_individual) + 1; ?>"
											class="checktime individual" type="text"
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 68px'><input
											id="totimeindividual<?php echo count($optional_tour_reg_individual) + 1; ?>"
											class="checktime individual" type="text"
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 70px'><input type="text"
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
										<td style='width: 70px'><input type="text"
											onclick="select_tour_reg_individual(<?php echo count($optional_tour_reg_individual) + 1; ?>)"></td>
									</tr>

								</tbody>
							</table>
							<input type="hidden" id="index-individual"
								value="<?php echo count($optional_tour_reg_individual) + 1; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="button-action-div-1">
					<button class="btn btn-primary btn-sm button-sm btn-action"
						onclick="move_optional_tour_individual()"
						id="move-tour-individual"><<</button>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Optional Tours Information</label>
					</div>
					<div id="div-tour-optional-update-tour-individual"
						class="list-scroll">
						<table id="table-tour-optional-update-tour-individual"
							class="table table-fixed">
							<thead>
								<tr>
									<td style='width: 20px'></td>
									<td style='width: 200px'>Tour Name</td>
									<td style='width: 75px'>From Time</td>
									<td style='width: 75px'>To Time</td>
									<td style='width: 68px'>City Name</td>
								</tr>
							</thead>
							<tbody>
								<?php
        if ($optional_tour) {
            foreach ($optional_tour as $row) {
                ?>
										   	<tr
									id='tour-individual-<?php echo $row["OptionalTourListID"]; ?>'
									onclick="select_optional_tour_individual('<?php echo $row["OptionalTourListID"]; ?>')">
									<td style='width: 20px'>
										<div class="glyphicon glyphicon-play icon-edit">
											<input type="hidden"
												value="<?php echo $row["OptionalTourListID"];?>">
										</div>
									</td>
									<td style='width: 200px'><?php echo $row["TourName"]; ?></td>
									<td style='width: 75px'><?php echo $row["FromTime"]; ?></td>
									<td style='width: 75px'><?php echo $row["ToTime"]; ?></td>
									<td style='width: 68px'><?php echo $row["City"]; ?></td>
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

<script type="text/javascript">

var selectTourOptionalCommon = "";
var selectTourOptionalIndividual = "";
var selectmoveTourOptionalIndividual = "";
var selectmoveTourOptionalCommon = "";
var indexNewOptionalTourCommon = parseInt($("#index-common").val());
var indexNewOptionalTourIndividual = parseInt($("#index-individual").val());
var selectRegTourOptionalCommon = 0;
var selectRegTourOptionalIndividual = 0;
var flgDataChgE =true;

var selectGuestIndividual = $("#guestid-selected").val();
	$(document).ready(function(){
		$("#table-guest-individual tbody tr:nth-child(1)").css("background","#397FDB");
		$("#table-guest-individual tbody tr:nth-child(1) td:nth-child(1) div").css("display","block");
		$("#table-tour-optional-update-tour-common").find("tr").css("cursor","default");
		$("#table-tour-optional-update-tour-individual").find("tr").css("cursor","default");
		$('#city').change(function () {
	    	var city=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('TransferController/get_optional_tour_update'); ?>",
	            async: false,
	            type: "POST",  
	            data: "city="+ city, 
	            dataType: "json",				                         
	            success: function(data) {
	                var output_optional_tour_common = "";
	                var output_optional_tour_individual = "";
					$.each (data, function(key, opj) {
						if (key=="optional_tour_info") {
					    	$.each (opj, function(key1, row) {
					    		output_optional_tour_common += "<tr id='tour-common-"+row["OptionalTourListID"]+"' onclick=select_optional_tour_common('"+row["OptionalTourListID"]+"')>";
					    			output_optional_tour_common += "<td style='width:20px'><div class='glyphicon glyphicon-play icon-edit'><input type='hidden' value='"+((row["OptionalTourListID"]!=null)?row["OptionalTourListID"]:"")+"'></div></td>";
					    			output_optional_tour_common += "<td style='width:195px'>"+((row["TourName"]!=null)?row["TourName"]:"")+"</td>";
					    			output_optional_tour_common += "<td style='width:80px'>"+((row["FromTime"]!=null)?row["FromTime"]:"")+"</td>";
					    			output_optional_tour_common += "<td style='width:80px'>"+((row["ToTime"]!=null)?row["ToTime"]:"")+"</td>";
					    			output_optional_tour_common += "<td style='width:80px'>"+((row["City"]!=null)?row["City"]:"")+"</td>";
					    		output_optional_tour_common += "</tr>";

					    		output_optional_tour_individual += "<tr id='tour-individual-"+row["OptionalTourListID"]+"' onclick=\"select_optional_tour_individual('"+row["OptionalTourListID"]+"')\">";
					    			output_optional_tour_individual += "<td style='width:20px'><div class='glyphicon glyphicon-play icon-edit'><input type='hidden' value='"+((row["OptionalTourListID"]!=null)?row["OptionalTourListID"]:"")+"'></div></td>";
					    			output_optional_tour_individual += "<td style='width:200px'>"+((row["TourName"]!=null)?row["TourName"]:"")+"</td>";
					    			output_optional_tour_individual += "<td style='width:75px'>"+((row["FromTime"]!=null)?row["FromTime"]:"")+"</td>";
					    			output_optional_tour_individual += "<td style='width:75px'>"+((row["ToTime"]!=null)?row["ToTime"]:"")+"</td>";
					    			output_optional_tour_individual += "<td style='width:68px'>"+((row["City"]!=null)?row["City"]:"")+"</td>";
					    		output_optional_tour_individual += "</tr>";
					    	});
					    }
				   	});
				    $('#table-tour-optional-update-tour-common tbody').html(output_optional_tour_common);
				    $('#table-tour-optional-update-tour-individual tbody').html(output_optional_tour_individual);
	            }
	        });
	 	});	

	});
function select_guest_individual(guestid){
	$("#table-guest-individual tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#guest-"+guestid+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-guest-individual").find("tr").css("background","transparent");
	$("#guest-"+guestid).css("background","#397FDB");
	selectGuestIndividual = guestid;
	var dt = {
		tour_code 	: $("#tour-code").val(),
		guestid		: guestid
	};
	$.ajax({   
    	url: "<?php echo base_url('TransferController/get_optional_tour_reg_individual'); ?>",
	    async: false,
		type: "POST",  
	    data: dt,
	    dataType: "json",				                         
	    success: function(data) {
	    	var output = "";
	    	$.each (data, function(key, opj) {
	    		if (key=="msg"){
	    			if (opj=="false"){
		    			output += "<tr id='new-optional-tour-individual-1' onclick=\"select_optional_tour_individual_regis(1)\">"
							output +=	"<td style='width:20px' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:143px'><input type='text' readonly='' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:68px'><input type='text' id='dateindividual1' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:30px'><input type='text' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:68px'><input type='text' readonly='' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:68px'><input type='text' readonly='' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:68px'><input type='text' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:68px'><input type='text' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:70px'><input type='text' onclick=\"select_tour_reg_individual(1)\"></td>";
							output +=	"<td style='width:70px'><input type='text' onclick=\"select_tour_reg_individual(1)\"></td>";
						output += "</tr>";
						indexNewOptionalTourIndividual=1;
		    		}
	    		} else {
	    			$.each (opj, function(key, row) {
		    			output += "<tr id='new-optional-tour-individual-"+(key+1)+"' onclick=\"select_optional_tour_individual_regis("+(key+1)+")\">";
				            output += "<td style='width:20px' onclick=\"select_tour_reg_individual("+(key+1)+")\"><div class='glyphicon glyphicon-play icon-edit'><input type='hidden' value='"+((row["OptionalTourListID"]!=null)?row["OptionalTourListID"]:"")+"'/> <input type='hidden' value='old'/></div></td>";
				            output += "<td style='width:143px'><input type='text' value='"+((row["TourName"]!=null)?row["TourName"]:"")+"' readonly='' onclick=\"select_tour_reg_individual("+(key+1)+")\"></td>";
				            output += "<td style='width:68px'><input type='text' value='"+((row["Date"]!=null)?row["Date"]:"")+"' id='dateindividual"+(key+1)+"'></td>";
				            output += "<td style='width:30px'><input type='text' value='"+((row["RegPlace"]!=null)?row["RegPlace"]:"")+"' onclick=\"select_tour_reg_individual("+(key+1)+")\"></td>";
				            output += "<td style='width:68px'><input type='text' value='"+((row["PUFrom"]!=null)?row["PUFrom"]:"")+"' readonly='' onclick=\"select_tour_reg_individual("+(key+1)+")\"></td>";
				            output += "<td style='width:68px'><input type='text' value='"+((row["PUTo"]!=null)?row["PUTo"]:"")+"' readonly='' onclick=\"select_tour_reg_individual("+(key+1)+")\"></td>";
				            output += "<td style='width:68px'><input type='text' value='"+((row["FromTime"]!=null)?row["FromTime"]:"")+"' onclick=\"select_tour_reg_individual("+(key+1)+")\"></td>";
				            output += "<td style='width:68px'><input type='text' value='"+((row["ToTime"]!=null)?row["ToTime"]:"")+"' onclick=\"select_tour_reg_individual("+(key+1)+")\"></td>";
				            output += "<td style='width:70px'><input type='text' value='"+((row["TourFree"]!=null)?row["TourFree"]:"")+"'></td>";
				            output += "<td style='width:70px'><input type='text' value='"+((row["City"]!=null)?row["City"]:"")+"' onclick=\"select_tour_reg_individual("+(key+1)+")\"></td>";
			            output += "</tr>";
		        	});
					indexNewOptionalTourIndividual=opj.length+1;
 					output += "<tr id='new-optional-tour-individual-"+(indexNewOptionalTourIndividual)+"' onclick=\"select_optional_tour_individual_regis("+(indexNewOptionalTourIndividual)+")\">"
						output +=	"<td style='width:20px' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:143px'><input type='text' readonly='' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:68px'><input type='text' id='dateindividual"+(indexNewOptionalTourIndividual)+"' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:30px'><input type='text' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:68px'><input type='text' readonly='' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:68px'><input type='text' readonly='' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:68px'><input type='text' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:68px'><input type='text' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:70px'><input type='text' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
						output +=	"<td style='width:70px'><input type='text' onclick=\"select_tour_reg_individual("+(indexNewOptionalTourIndividual)+")\"></td>";
					output += "</tr>";
	    		}
            });
	       	$('#table-reg-optional-tour-individual tbody').html(output);
	       	$("body").css("cursor","");
	       	$(".table-fixed").find("tr").css("cursor","default");
	    }
	});
}

function select_optional_tour_common(optionalTOurID){
	$("#table-tour-optional-update-tour-common tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#tour-common-"+optionalTOurID+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-tour-optional-update-tour-common").find("tr").css("background","transparent");
	$("#tour-common-"+optionalTOurID).css("background","#397FDB");
	selectmoveTourOptionalCommon = optionalTOurID;
}
function select_optional_tour_common_regis(optionalTOurID){
	$("#new-optional-tour-common-"+selectTourOptionalCommon+ " td:nth-child(1)").find("div").css("display","none");
	$("#new-optional-tour-common-"+optionalTOurID+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-reg-optional-tour-common").find("tr").css("background","transparent");
	$("#table-reg-optional-tour-common").find("tr td input").css("background","transparent");
	$("#new-optional-tour-common-"+optionalTOurID).css("background","#397FDB");
	$("#new-optional-tour-common-"+optionalTOurID+ " td input").css("background","#397FDB");
	selectTourOptionalCommon = optionalTOurID;
}
function select_optional_tour_individual_regis(optionalTOurID){	
	$("#new-optional-tour-individual-"+selectTourOptionalIndividual+ " td:nth-child(1)").find("div").css("display","none");
	$("#new-optional-tour-individual-"+optionalTOurID+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-reg-optional-tour-individual").find("tr").css("background","transparent");
	$("#table-reg-optional-tour-individual").find("tr td input").css("background","transparent");
	$("#new-optional-tour-individual-"+optionalTOurID).css("background","#397FDB");
	$("#new-optional-tour-individual-"+optionalTOurID +" td input").css("background","#397FDB");
	selectTourOptionalIndividual = optionalTOurID;
}
function select_optional_tour_individual(optionalTOurID){
	$("#table-tour-optional-update-tour-individual tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#tour-individual-"+optionalTOurID+ " td:nth-child(1)").find("div").css("display","block");
	$("#table-tour-optional-update-tour-individual").find("tr").css("background","transparent");
	$("#tour-individual-"+optionalTOurID).css("background","#397FDB");
	selectmoveTourOptionalIndividual = optionalTOurID;
}
function move_optional_tour_common()
{
	if(selectmoveTourOptionalCommon!="")
	{
		$("#new-optional-tour-common-"+indexNewOptionalTourCommon+" td:nth-child(1)").html("<div class='glyphicon glyphicon-play icon-edit'><input id='optional-id-"+indexNewOptionalTourCommon+"' type='hidden' value="+$("#tour-common-"+selectmoveTourOptionalCommon+" td:nth-child(1) input").val()+"></div>");
		$("#new-optional-tour-common-"+indexNewOptionalTourCommon+" td:nth-child(2) input").val($('<div />').html($("#tour-common-"+selectmoveTourOptionalCommon+" td:nth-child(2)").html()).text());
		$("#new-optional-tour-common-"+indexNewOptionalTourCommon+" td:nth-child(5) input").val($('<div />').html($("#tour-common-"+selectmoveTourOptionalCommon+" td:nth-child(3)").html()).text());
		$("#new-optional-tour-common-"+indexNewOptionalTourCommon+" td:nth-child(6) input").val($('<div />').html($("#tour-common-"+selectmoveTourOptionalCommon+" td:nth-child(5)").html()).text());
		indexNewOptionalTourCommon++;
		var html_new_optional_tour_common = "";
		html_new_optional_tour_common += "<tr id='new-optional-tour-common-"+indexNewOptionalTourCommon+"' onclick=\"select_optional_tour_common_regis("+indexNewOptionalTourCommon+")\">";
			html_new_optional_tour_common += "<td style='width:20px' onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
			html_new_optional_tour_common += "<td style='width:110px'><input type='text' readonly onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
			html_new_optional_tour_common += "<td style='width:68px'><input type='text' id='datecommon"+indexNewOptionalTourCommon+"' onblur=\"check_date("+indexNewOptionalTourCommon+")\" onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
			html_new_optional_tour_common += "<td style='width:68px'><input type='text' onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
			html_new_optional_tour_common += "<td style='width:68px'><input type='text' onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
			html_new_optional_tour_common += "<td style='width:70px'><input type='text' onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
			html_new_optional_tour_common += "<td style='width:68px'><input type='text' onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
			html_new_optional_tour_common += "<td style='width:68px'><input type='text' onclick=\"select_tour_reg_common("+indexNewOptionalTourCommon+")\"></td>";
		html_new_optional_tour_common += "</tr>";
		$("#table-reg-optional-tour-common tbody").append(html_new_optional_tour_common);
		$("#delete-rg-common").removeAttr("disabled");
		flgDataChgE = false;
	}
	else
	{		
		alert("Please choose insert.!");
	}
	
}
function move_optional_tour_individual()
{	
	if(selectmoveTourOptionalIndividual!="")
	{		
		$("#new-optional-tour-individual-"+indexNewOptionalTourIndividual+" td:nth-child(1)").html("<div class='glyphicon glyphicon-play icon-edit'><input type='hidden' value="+$("#tour-individual-"+selectmoveTourOptionalIndividual+" td:nth-child(1) input").val()+">"+"<input type='hidden' value='new'></div>");
		$("#new-optional-tour-individual-"+indexNewOptionalTourIndividual+" td:nth-child(2) input").val($('<div />').html($("#tour-individual-"+selectmoveTourOptionalIndividual+" td:nth-child(2)").html()).text());
		$("#new-optional-tour-individual-"+indexNewOptionalTourIndividual+" td:nth-child(7) input").val($('<div />').html($("#tour-individual-"+selectmoveTourOptionalIndividual+" td:nth-child(3)").html()).text());
		$("#new-optional-tour-individual-"+indexNewOptionalTourIndividual+" td:nth-child(8) input").val($('<div />').html($("#tour-individual-"+selectmoveTourOptionalIndividual+" td:nth-child(4)").html()).text());
		$("#new-optional-tour-individual-"+indexNewOptionalTourIndividual+" td:nth-child(10) input").val($('<div />').html($("#tour-individual-"+selectmoveTourOptionalIndividual+" td:nth-child(5)").html()).text());
		indexNewOptionalTourIndividual++;
		var html_new_optional_tour_individual = "";
		html_new_optional_tour_individual += "<tr id='new-optional-tour-individual-"+indexNewOptionalTourIndividual+"' onclick=\"select_optional_tour_individual_regis("+indexNewOptionalTourIndividual+")\">";
			html_new_optional_tour_individual += "<td style='width:20px' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:142px'><input type='text' readonly onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:68px'><input type='text' id='dateindividual"+indexNewOptionalTourIndividual+"' onblur=\"check_date1("+indexNewOptionalTourIndividual+")\" onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:30px'><input type='text' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:68px'><input type='text' readonly='' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:68px'><input type='text' readonly='' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:68px'><input type='text' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:68px'><input type='text' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:70px'><input type='text' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
			html_new_optional_tour_individual += "<td style='width:70px'><input type='text' onclick=\"select_tour_reg_individual("+indexNewOptionalTourIndividual+")\"></td>";
		html_new_optional_tour_individual += "</tr>";
		$("#table-reg-optional-tour-individual tbody").append(html_new_optional_tour_individual);
		$("#delete-tour-individual").removeAttr("disabled");
		flgDataChgE = false;
	}
	else
	{
		alert("Please choose insert.!");
	}
	
}
function select_tour_reg_common(id)
{
	$("#table-reg-optional-tour-common tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#new-optional-tour-common-"+id+ " td:nth-child(1)").find("div").css("display","block");
	$("#new-optional-tour-common-"+id+ " td:nth-child(1)").css("cursor","default");
    tourname = $("#new-optional-tour-common-"+id+" td:nth-child(2) input").val();   
      
	if (id!=(indexNewOptionalTourCommon)) 
    {
            if(tourname.indexOf("SPA")>=0||tourname.indexOf("GOLF")>=0||tourname.indexOf("RESTAURANT")>=0)
            {            	
            	$('#optionaltourlistid').val($("#new-optional-tour-common-"+id+" td:nth-child(1) input").val());
            	$('#tourname').val($("#new-optional-tour-common-"+id+" td:nth-child(2) input").val());
            	$('#date').val($("#new-optional-tour-common-"+id+" td:nth-child(3) input").val());
            	$('#pu_from').val($("#new-optional-tour-common-"+id+" td:nth-child(4) input").val());
            	$('#time').val($("#new-optional-tour-common-"+id+" td:nth-child(5) input").val());
            	$('#cty').val($("#new-optional-tour-common-"+id+" td:nth-child(6) input").val());
            	$('#tee_time').val($("#new-optional-tour-common-"+id+" td:nth-child(7) input").val());
            	$('#pay_ment').val($("#new-optional-tour-common-"+id+" td:nth-child(8) input").val());
            	$('#tourcode').val($("#tour-code").val());
            	$('#vncode').val($("#vn-code").val());            	
                $("#btnPrint").attr("disabled",false);
            }
            else
            {
                $("#btnPrint").attr("disabled",true);
            }
            selectRegTourOptionalCommon = id;
	}
	else
	{
		 $("#btnPrint").attr("disabled",true);
	}       
}

function select_tour_reg_individual(id)
{	
	$("#table-reg-optional-tour-individual tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#new-optional-tour-individual-"+id+ " td:nth-child(1)").find("div").css("display","block");
	$("#new-optional-tour-individual-"+id+ " td:nth-child(1)").css("cursor","default");
	if (id!=(indexNewOptionalTourIndividual)) {
		selectRegTourOptionalIndividual = id;
	};
}

function delete_tour_reg_common()
{
	if($("#table-reg-optional-tour-common > tbody > tr").length>1)
	{		
		var r = confirm("Are you sure to delete!!!");
	    if (r == true)
	    {
	    	var dt = {
	    		tour_code      : $("#tour-code").val(),
	    		option_list_id : $("#new-optional-tour-common-"+selectRegTourOptionalCommon+" > td > div > input").val(),
	    		count_guest    : $("#count-guest").val()
	    	};

	    	$.ajax({   
	    	url: "<?php echo base_url('TransferController/delete_tour_optional_common'); ?>",
		    async: false,
		    type: "POST",  
		    data: dt,
		    dataType: "json",				                         
		    success: function(data) {
		    		
		    	}
			});
	    	
	        var i=selectRegTourOptionalCommon;
			for (i=selectRegTourOptionalCommon;i<indexNewOptionalTourCommon;i++){
				var i1=i+1;
				$("#new-optional-tour-common-"+i+" td:nth-child(2) input").val($("#new-optional-tour-common-"+i1+" td:nth-child(2) input").val());
				$("#new-optional-tour-common-"+i+" td:nth-child(3) input").val($("#new-optional-tour-common-"+i1+" td:nth-child(3) input").val());
				$("#new-optional-tour-common-"+i+" td:nth-child(4) input").val($("#new-optional-tour-common-"+i1+" td:nth-child(4) input").val());
				$("#new-optional-tour-common-"+i+" td:nth-child(5) input").val($("#new-optional-tour-common-"+i1+" td:nth-child(5) input").val());
				$("#new-optional-tour-common-"+i+" td:nth-child(6) input").val($("#new-optional-tour-common-"+i1+" td:nth-child(6) input").val());
				$("#new-optional-tour-common-"+i+" td:nth-child(7) input").val($("#new-optional-tour-common-"+i1+" td:nth-child(7) input").val());
				$("#new-optional-tour-common-"+i+" td:nth-child(8) input").val($("#new-optional-tour-common-"+i1+" td:nth-child(8) input").val());
			}
			indexNewOptionalTourCommon--;
			$("#new-optional-tour-common-"+i).remove();
			i=i-1;
			$("#new-optional-tour-common-"+i+" td:nth-child(1) div").remove();
			select_optional_tour_common_regis(1);
			selectRegTourOptionalCommon =1;
			flgDataChgE = true;		
			location.reload();			
	    }
	}
	else
	{
		var n = $("#table-reg-optional-tour-common > tbody > tr").length;
		if(n>1)
		{
			alert("Please choose delete!..");
		}
		else
		{
			$("#delete-rg-common").attr("disabled",true);
			$("insert-tour-common").focus();
		}
	}	
}

function delete_tour_reg_individual()
{
	if($("#table-reg-optional-tour-individual > tbody >tr").length>1)
	{		
		var r = confirm("Are you sure to delete!!!");
	    if (r == true) 
	    {
	    	var dt = {
	    		tour_code      : $("#tour-code").val(),
	    		option_list_id : $("#new-optional-tour-individual-"+selectRegTourOptionalIndividual+" > td > div > input:nth-child(1)").val(),
	    		count_guest    : $("#count-guest").val(),
	    		id_tour        : $("#tour-id").val()
	    	};	    	
	    	if($("#new-optional-tour-individual-"+selectRegTourOptionalIndividual+" > td > div > input:nth-child(2)").val()=="old"){
	    		$.ajax({   
			    	url: "<?php echo base_url('TransferController/delete_tour_reg_individual'); ?>",
				    async: false,
				    type: "POST",  
				    data: dt,
				    dataType: "json",				                         
				    success: function(data) {

				    	}
				});
				location.reload();
	    	}	
			var i=selectRegTourOptionalIndividual;
			for (i=selectRegTourOptionalIndividual;i<indexNewOptionalTourIndividual;i++){
				var i1=i+1;
				$("#new-optional-tour-individual-"+i+" td:nth-child(2) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(2) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(3) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(3) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(4) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(4) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(5) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(5) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(6) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(6) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(7) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(7) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(8) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(8) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(9) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(9) input").val());
				$("#new-optional-tour-individual-"+i+" td:nth-child(10) input").val($("#new-optional-tour-individual-"+i1+" td:nth-child(10) input").val());
			}
			indexNewOptionalTourIndividual--;
			$("#new-optional-tour-individual-"+i).remove();
			i=i-1;
			$("#new-optional-tour-individual-"+i+" td:nth-child(1) div").remove();
			select_optional_tour_individual_regis(1);
			selectRegTourOptionalIndividual = 1;
			flgDataChgE = true;
	    }

	}
	else
	{
		var n = $("#table-reg-optional-tour-individual > tbody >tr").length;
		if(n>1)
		{
			alert("Please choose delete!..");
		}
		else
		{
			$("#delete-tour-individual").attr("disabled",true);
			$("move-tour-individual").focus();
		}
	}    
}
function update_tour_optional_common()
{	
	if(CheckDateNull(1)==true)
	{
		return;
	}
	if(flag_check_date==false)
	{
		return;
	}
	
	var n = $("#table-reg-optional-tour-common > tbody >tr").length;
	if(n>1)
	{
		var dt = {
			tour_code 	: $("#tour-code").val(),
			guestid 	: selectGuestIndividual,
			data 		: create_list_data_common()
		};
		$.ajax({   
	    	url: "<?php echo base_url('TransferController/update_tour_optional_common'); ?>",
		    async: false,
		    type: "POST",  
		    data: dt,
		    dataType: "json",				                         
		    success: function(data) {		    	
		    	alert(data["msg"]);
		    }
		});
		flgDataChgE = false;
	}
	else
	{
		var dt = {
			tour_code 	: $("#tour-code").val(),
			guestid 	: selectGuestIndividual,
			data 		: create_list_data_common()
		};
		$.ajax({   
	    	url: "<?php echo base_url('TransferController/update_tour_optional_common'); ?>",
		    async: false,
		    type: "POST",  
		    data: dt,
		    dataType: "json",				                         
		    success: function(data) {  	
		    }
		});	
		flgDataChgE = false;	
	}
	location.reload();
}
function CheckDateNull(tableid)
{
	if(tableid==1)
	{
		var i;
		var n = $("#table-reg-optional-tour-common > tbody >tr").length;
		if(n>1)
		{
			for(i=1;i<n;i++)
			{
				if($("#datecommon"+i).val()=="")
				{
					alert("Please enter date.");
					return true;
				}
			}
		}	
	}
	else
	{		
		var i;
		var n = $("#table-reg-optional-tour-individual > tbody >tr").length;
		if(n>1)
		{
			for(i=1;i<n;i++)
			{
				if($("#dateindividual"+i).val()=="")
				{
					alert("Please enter date.");
					return true;
				}
			}
		}	
	}
	
}
function create_list_data_common(){
	var i = 1;
	var list_result = [];
	for (i=1;i<indexNewOptionalTourCommon;i++){
		if ($("#new-optional-tour-common-"+i+" td:nth-child(3) input").val()!=""){
			list_result.push({
				'OptionalTourListID': $("#new-optional-tour-common-"+i+" td:nth-child(1) input").val(),
				'TourName' 			: $("#new-optional-tour-common-"+i+" td:nth-child(2) input").val(),
				'Date' 				: $("#new-optional-tour-common-"+i+" td:nth-child(3) input").val(),
				'PUFrom' 			: $("#new-optional-tour-common-"+i+" td:nth-child(4) input").val(),
				'FromTime'  		: $("#new-optional-tour-common-"+i+" td:nth-child(5) input").val(),
				'City' 				: $("#new-optional-tour-common-"+i+" td:nth-child(6) input").val(),
				'Teeoftime' 		: $("#new-optional-tour-common-"+i+" td:nth-child(7) input").val(),
				'Payment' 			: $("#new-optional-tour-common-"+i+" td:nth-child(8) input").val(),
				'Vncode'			: $("#vn-code").val(),
				'TourCode'			: $("#tour-code").val()
			});
		}
	}
	return list_result;
}

function update_tour_optional_individual()
{	
	if(CheckDateNull(2)==true)
	{
		return;
	}
	if(flag_check_date1==false)
	{
		return;
	}

	var n = $("#table-reg-optional-tour-individual > tbody >tr").length;
	if(n>1)
	{
		var dt = {
			tour_code 	: $("#tour-code").val(),
			guestid 	: selectGuestIndividual,
			data 		: create_list_data_individual()
		};
		console.log(dt.data);
		$.ajax({   
	    	url: "<?php echo base_url('TransferController/update_tour_optional_individual'); ?>",
		    async: false,
		    type: "POST",  
		    data: dt,
		    dataType: "json",				                         
		    success: function(data) {
		    	alert(data["msg"]);		    	
		    }
		});
		flgDataChgE = false;
	}
	location.reload();
}

function create_list_data_individual(){
	var i = 1;
	var list_result = [];
	for (i=1;i<indexNewOptionalTourIndividual;i++){
		if ($("#new-optional-tour-individual-"+i+" td:nth-child(3) input").val()!="") {		
			list_result.push({
				'OptionalTourListID': $("#new-optional-tour-individual-"+i+" td:nth-child(1) input").val(),
				'TourName' 			: $("#new-optional-tour-individual-"+i+" td:nth-child(2) input").val(),
				'Date' 				: $("#new-optional-tour-individual-"+i+" td:nth-child(3) input").val(),
				'RegPlace' 			: $("#new-optional-tour-individual-"+i+" td:nth-child(4) input").val(),
				'PUFrom' 			: $("#new-optional-tour-individual-"+i+" td:nth-child(5) input").val(),
				'PUTo' 				: $("#new-optional-tour-individual-"+i+" td:nth-child(6) input").val(),
				'FromTime'  		: $("#new-optional-tour-individual-"+i+" td:nth-child(7) input").val(),
				'ToTime'  			: $("#new-optional-tour-individual-"+i+" td:nth-child(8) input").val(),
				'TourFree' 			: $("#new-optional-tour-individual-"+i+" td:nth-child(9) input").val(),
				'City' 				: $("#new-optional-tour-individual-"+i+" td:nth-child(10) input").val(),	
				'Vncode'			: $("#vn-code").val(),
				'TourCode'			: $("#tour-code").val()
			});
		}
	}
	return list_result;
}

function back_home()
{	
	if(flgDataChgE==true)
	{
		location.href='<?php echo base_url();?>transfer-management/update-tour-information';
	}
	else
	{
		var r = confirm("Data entered will be lose. Are you sure to exit ?");
		if(r)
		{
			location.href='<?php echo base_url();?>transfer-management/update-tour-information';
		}
		else
		{
			return;
		}
	}
}
flag_check_date = true;
function check_date(i)
{
	var dt = {
		date : $("#new-optional-tour-common-"+i+" td:nth-child(3) input").val()
	};
	$.ajax({
                    url: "<?php echo base_url('TransferController/check_date'); ?>",
                    type: "POST",  
                    data: dt, 
                    dataType: "json", 
                    async : false,                          
                    success: function(data) 
                    {                                     
                        $.each (data, function(key, opj)
                        {     
                        	if(key=="msg")
                        	{
                        		if(opj!="")
                        		{                        			
                        			
                        			flag_check_date = false;
                        			alert(opj);
                        		}
                        		else
                        		{
                        			flag_check_date = true;
                        		}
                        	}                    
                                                                                                                            
                        });
                        if(flag_check_date == false)
                        {
                        	setTimeout(function(){
								$("#new-optional-tour-common-"+i+" td:nth-child(3) input").focus();
								},1);
                        }
                    }                  
                });	
}
flag_check_date1 = true;

function check_date1(i)
{
	var dt = {
		date : $("#new-optional-tour-individual-"+i+" td:nth-child(3) input").val()
	};
	$.ajax({
                    url: "<?php echo base_url('TransferController/check_date'); ?>",
                    async: true,
                    type: "POST",  
                    data: dt, 
                    dataType: "json",
                    async : false,                         
                    success: function(data) 
                    {                                     
                        $.each (data, function(key, opj)
                        {     
                        	if(key=="msg")
                        	{
                        		if(opj!="")
                        		{ 
                        			
                        			flag_check_date1 = false;
                        			alert(opj);
                        		} 
                        		else
                        		{
                        			flag_check_date1 = true;
                        		}
                        	}                    
                                                                                                                            
                        });
                         if(flag_check_date1 == false)
                        {
                        	setTimeout(function(){
								$("#new-optional-tour-individual-"+i+" td:nth-child(3) input").focus();
								},1);
                        	
                        }
                    }                  
                });
	//alert($("#new-optional-tour-common-"+i+" td:nth-child(3) input").val());
}

//=======================Dương Check Time=================
flag_check_time_common = true;
flag_check_time_individual = true;
$(document).ready(function(){

	$('.checktime').blur(function(event){
		var id = $(this).attr('id');
		current_class = $(this).attr('class');
			var dt = {time : $(this).val()};
			$.ajax({
				url:'<?php echo base_url("TransferController/check_time") ?>',
				dataType: 'json',
				type: 'POST',
				data: dt,
				async: false,
				success: function(result)
				{
					
					if(result['msg'] !='')
					{
						
						if(current_class=='checktime common')
						{
							flag_check_time_common = false;
						}
						else
						{
							flag_check_time_individual = false;
						}
						alert(result['msg']);
					}
					else
					{
						if(current_class=='checktime common')
						{
							flag_check_time_common = true;	
						}
						else
						{
							flag_check_time_individual = true;
						}
					}
				}
				
			});
			if(flag_check_time_individual == false || flag_check_time_common == false)
			{
				//$(this).val(cur_val);
				setTimeout(function(){
						$('#'+id).trigger('focus');
						},1);
			}
		});
});
//=======================Dương Check Time=================
$('input').change(function(){
	flgDataChgE = false;
});
</script>
<?php echo $this->load->view('Layout/footer');?>