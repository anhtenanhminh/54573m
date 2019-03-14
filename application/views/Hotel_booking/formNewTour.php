<?php echo $this->load->view('Layout/header'); ?>
<style>
label textarea {
	vertical-align: middle;
}

#table-guide tr td {
	padding: 1px;
}

#table-guide input {
	padding: 0px;
	border: none;
	height: 22px;
}
</style>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h4>New Tour</h4>
			</div>
			<div class="col-md-4" style="height: 35px">
				<div class="form-inline form-margin-bottom"
					style="padding-top: 5px;">
					<div class="form-group">
						<label style="color: red;">Select Location</label> <select
							class="form-control input-sm select-size-sm" id="location"
							onchange="change_location()" style="height: 25px;">
							<option value=""></option>
                            <?php
                            if ($location) {
                                foreach ($location as $row) {
                                    if ($row['Location_code'] != '')?>
                                        <option
								value="<?php echo $row['Location_code'] ?>"><?php echo $row['Location_name'] ?></option>
                                <?php

}
                            }
                            ?>
                        </select>
						<button class="btn btn-sm button-sm btn-primary"
							style="float: right; margin-left: 10px;"
							onclick="location.href='<?php echo base_url(); ?>hotel-booking'">Back
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"
			style="margin-top: 0px; margin-bottom: 12px;"></div>
		<div class="row row-border" style="margin-bottom: 11px;">
			<div class="title-row-div">
				<label class="title-row">Tour Request</label>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Tour Code</label> <input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 25px;"
							onchange="change_flag()">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">VN Code</label> <input type="text"
							class="form-control select-size chung input-small" id="vn-code"
							style="height: 25px;">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Group Name</label> <input type="text"
							class="form-control select-size chung input-small"
							id="group-name" style="height: 25px;">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Status</label> <select id="tour-status"
							class="form-control input-sm chung" style="height: 25px;">
							<option value=""></option>
                            <?php
                            if ($tourstatus) {
                                foreach ($tourstatus as $tourstatus) {
                                    if ($tourstatus['TourStatus'] !== '') {
                                        ?>
                                        <option
								value="<?php echo $tourstatus['TourStatus'] ?>"><?php echo $tourstatus['TourStatus'] ?></option>
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
						<label class="label-item">Campaign</label> <select name="campaign"
							class="form-control input-sm select-size chung" id="campaign"
							style="height: 25px;">
							<option value=""></option>
                            <?php
                            if ($campaign) {
                                foreach ($campaign as $campaign) {
                                    ?>
                                    <option
								value="<?php echo $campaign['Cam_Code'] ?>"><?php echo $campaign['Cam_Name'] ?></option>
                                <?php

}
                            }
                            ?>
                        </select>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Note</label> <input type="text"
							class="form-control select-size chung input-small" id="note"
							style="height: 25px;">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-margin-bottom">
					<div class="form-group" style="margin-bottom: 0px">
						<div id="" class="list-scroll" style="height: 100px;">
							<input id="id-guide" type="hidden"
								value="<?php echo ($max_guest) ? $max_guest : ""; ?>">
							<table id="table-guide" class="table table-bordered">
								<thead style="width: 100%;">
									<tr>
										<td style="width: 8%"></td>
										<td style='width: 92%'>Guest Name</td>
									</tr>
								</thead>
								<tbody style="width: 100%; height: 80%">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<button class="btn btn-sm button-md btn-primary btn-action chung"
					onclick="clear_tour()">Clear</button>
			</div>
		</div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Booking Detail</label>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group form-inline">
						<label class="label-item">City</label> <select
							class="form-control input-sm select-size chung" id="city"
							style="height: 25px;" onchange="get_rtypeandrclass()">
							<option value=""></option>
                            <?php
                            if ($city) {
                                foreach ($city as $city) {
                                    ?>
                                    <option
								value="<?php echo $city['city'] ?>"><?php echo $city['city'] ?></option>
                                <?php

}
                            }
                            ?>
                        </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline">
						<label class="label-item">Hotel</label> <select id="hotel"
							class="form-control input-sm select-size chung"
							style="height: 25px;" onchange="get_rtypeandrclass()">
                            <?php
                            if (isset($hotel)) {
                                foreach ($hotel as $hotel) {
                                    ?>
                                    <option
								value="<?php echo $hotel['HotelAlias'] ?>"><?php echo $hotel['HotelName'] ?></option>
                                <?php

}
                            }
                            ?>
                        </select>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-sm" style="vertical-align: top;">Note</label>
							<textarea id="note-bk" class="chung" id="" cols="45" rows="1"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-inline form-margin-bottom" hidden id="from">
						<div class="form-group">
							<label class="label-item-sm">From</label> <input type="text"
								class="chung" id="VN-Flight1" style="width: 450px;"
								disabled="true" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-inline form-margin-bottom" hidden id="back">
						<div class="form-group">
							<label class="label-item-sm">Back</label> <input type="text"
								class="chung" id="VN-Flight2" style="width: 450px;"
								disabled="true" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="container">
					<ul class="nav nav-tabs" style="background-color: #f5f5f5;">
						<li class="active" id="menu_1"><a data-toggle="tab" href="#menu1"
							style="background-color: #A9A9A9; padding: 5px 10px;">Stage 1</a></li>
						<li id="menu_2"><a data-toggle="tab" href="#menu2"
							style="background-color: #D3D3D3; padding: 5px 10px;">Stage 2</a></li>
					</ul>
					<div class="tab-content">
						<div id="menu1" class="tab-pane fade in active">
							<div class="form-inline form-margin-bottom"
								style="background-color: #A9A9A9;">
								<div class="form-group">
									<label class="label-item">Arrv Date</label>
									<div id="arrv-date-1"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="arrv-date-1"
										data-input="form-control input-sm"
										data-date="<?php echo date('Y/m/d') ?>"
										onchange="get_niteno_paxno('stage1')"></div>
								</div>
								<div class="form-group">
									<label class="label-item">Dept Date</label>
									<div id="dept-date-1"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="dept-date-1"
										data-input="form-control input-sm"
										data-date="<?php echo date('Y/m/d') ?>"
										onchange="get_niteno_paxno('stage1')"></div>
								</div>
								<div class="form-group">
									<label class="label-item-sm"
										style="color: red; font-size: 10px">SPE <input type="checkbox"
										class="chung" id="check-box-1"
										onchange="check_box_spe1('stage1')"></label>
								</div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Nite No</label> <input
										type="text" size=1 id="nite-no-1" class="chung check_num">
								</div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Pax No</label> <input
										type="text" size=1 id="pax-no-1" class="chung check_num">
								</div>
								<div class="form-group form-inline">
									<label class="label-item-md">Holiday No</label> <input
										type="text" size=1 id="holiday-no-1" class="chung check_num">
								</div>
								<div class="form-group form-inline">
									<label class="" style="margin-left: 10px; font-size: 12px">Note
										<textarea id="note-booking-1" rows="1"
											style="margin-top: 10px;" cols="30" class="chung"></textarea>
									</label>
								</div>
								<div class="form-group">
									<label class="label-item">R/Type</label> <select
										class="form-control input-sm select-size-sm chung"
										id="r-type-1" style="height: 25px;">
										<option value=""></option>

									</select>
								</div>
								<div class="form-group">
									<label class="label-item-sm">R/Class</label> <select
										class="form-control input-sm select-size-sm chung"
										id="r-class-1" style="height: 25px;">
										<option value=""></option>

									</select>
								</div>
								<div class="form-group">
									<label class="label-item-sm ">R/No</label> <input type="text"
										size=1 id="r-no-1" class="chung check_num">
								</div>
								<div class="form-group ">
									<label class="label-item-sm" style="margin-left: 5px;">L/C</label>
									<input type="text" class="chung check_time" size=3
										id="check-out-1" value="">
								</div>
								<button class="btn btn-primary btn-action chung"
									style="width: 60px; height: 30px;"
									onclick="more_room('stage1')">More</button>
								<div class="form-group">
									<label class="label-item-sm">Status</label> <select
										class="form-control input-sm select-size-sm chung"
										style="height: 25px;" id="hotel-status-1">
										<option value=""></option>
										<option value="OK">OK</option>
										<option value="WT">WT</option>
										<option value="CXL">CXL</option>
										<option value="CHG">CHG</option>
									</select>
								</div>
								<div class="form-group">
									<label style="witdh: 30px; font-size: 13px">Transfer Stage</label>
									<select class="form-control input-sm select-size-sm chung"
										id="op1">
										<option value=""></option>

									</select> <label class="label-item" id="lb-allotment-1"><span
										id="allotment_text_1">Allotment</span></label> <input
										type="checkbox" class="chung" id="check-box-allotment-1"
										onchange="allotment_change('stage1')" /> <input type="text"
										size=1 id="allotment-1" class="chung" hidden>
								</div>
								<button
									class="btn btn-primary button-sm btn-sm btn-action chung"
									style="float: right; margin-right: 20px;"
									onclick="clearStage(1)">CLear</button>
							</div>
							<div class="row add_room"
								style="background-color: #FFFF99; margin: 0px;" id="add-room-1">
								<label class="col-md-12"><span style="color: red;">Add more room</span></label>
								<div class="col-md-12" style="margin-top: 2px; height: 40px;">
									<div class="form-inline col-md-2">
										<label class="label-item-sm">R/Type</label> <select
											class="form-control input-sm select-size-sm" id="r-type-add"
											style="height: 25px;">
											<option value=""></option>

										</select>
									</div>
									<div class="form-inline col-md-2">
										<label class="label-item-sm">R/Class</label> <select
											class="form-control input-sm select-size-sm" id="r-class-add"
											style="height: 25px; width: 20px;">
											<option value=""></option>
										</select>
									</div>
									<div class="form-group form-inline col-md-1"
										style="padding-right: 0px;">
										<label class="label-item-sm ">R/No</label> <input type="text"
											id="r-no-add" style="width: 30px;" class="check_num">
									</div>
									<div class="form-group form-inline col-md-1"
										style="padding-right: 0px;">
										<label class="label-item-sm">L/C</label> <input type="text"
											style="width: 30px;" id="lc-add-more"
											class="check_time check_num" value="">
									</div>
									<div class="form-group form-inline col-md-1"
										style="padding-right: 0px;">
										<label class="label-item-sm ">AR/No</label> <input type="text"
											style="width: 25px;" id="ar-no-more">
									</div>
									<div class="form-group form-inline col-md-1">
										<button class="btn btn-primary btn-action"
											style="width: 45px; height: 30px;"
											onclick=" return add_more_room()">Add</button>
									</div>
									<div class="form-group form-inline col-md-2">
										<label class="label-item-sm ">R/L</label> <input type="text"
											size=4 readonly id="rl-more-add" class="chung"
											style="width: 110px;">
									</div>
									<div class="col-md-2">

										<button class="btn btn-primary btn-action"
											style="width: 55px; height: 30px;" onclick="clear_more()">Clear
										</button>
										<button class="btn btn-primary btn-action"
											style="width: 50px; height: 30px;"
											onclick="ok_more_room('stage1')">Ok</button>
									</div>
								</div>
							</div>
						</div>
						<div id="menu2" class="tab-pane fade">
							<div class="form-inline form-margin-bottom"
								style="background-color: #D3D3D3;">
								<div class="form-group">
									<label class="label-item">Arrv Date</label>
									<div id="arrv-date-2"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="arrv-date-2"
										data-input="form-control input-sm"
										data-date="<?php echo date('Y/m/d') ?>"
										onchange="get_niteno_paxno('stage2')"></div>
								</div>
								<div class="form-group">
									<label class="label-item">Dept Date</label>
									<div id="dept-date-2"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="dept-date-2"
										data-input="form-control input-sm"
										data-date="<?php echo date('Y/m/d') ?>"
										onchange="get_niteno_paxno('stage2')"></div>
								</div>
								<div class="form-group">
									<label class="label-item-sm"
										style="color: red; font-size: 10px">SPE <input type="checkbox"
										class="chung" id="check-box-2"
										onchange="check_box_spe1('stage2')"></label>
								</div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Nite No</label> <input
										type="text" size=1 id="nite-no-2" class="chung check_num">
								</div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Pax No</label> <input
										type="text" size=1 id="pax-no-2" class="chung check_num">
								</div>
								<div class="form-group form-inline">
									<label class="label-item-md">Holiday No</label> <input
										type="text" size=1 id="holiday-no-2" class="chung check_num">
								</div>
								<div class="form-group form-inline">
									<label class="" style="margin-left: 10px; font-size: 12px">Note
										<textarea id="note-booking-2" rows="1"
											style="margin-top: 10px;" cols="30" class="chung"></textarea>
									</label>
								</div>
								<div class="form-group">
									<label class="label-item">R/Type</label> <select
										class="form-control input-sm select-size-sm chung"
										id="r-type-2" style="height: 25px;">
										<option value=""></option>

									</select>
								</div>
								<div class="form-group">
									<label class="label-item-sm">R/Class</label> <select
										class="form-control input-sm select-size-sm chung"
										id="r-class-2" style="height: 25px;">
										<option value=""></option>

									</select>
								</div>
								<div class="form-group">
									<label class="label-item-sm ">R/No</label> <input type="text"
										size=1 id="r-no-2" class="chung check_num">
								</div>
								<div class="form-group ">
									<label class="label-item-sm" style="margin-left: 5px;">L/C</label>
									<input type="text" class="chung check_time check_num" size=3
										id="check-out-2" value="">
								</div>
								<button class="btn btn-primary btn-action chung"
									style="width: 60px; height: 30px;"
									onclick="more_room('stage2')">More</button>
								<div class="form-group">
									<label class="label-item-sm">Status</label> <select
										class="form-control input-sm select-size-sm chung"
										style="height: 25px;" id="hotel-status-2">
										<option value=""></option>
										<option value="OK">OK</option>
										<option value="WT">WT</option>
										<option value="CXL">CXL</option>
										<option value="CHG">CHG</option>
									</select>
								</div>
								<div class="form-group">
									<label style="witdh: 30px; font-size: 13px">Transfer Stage</label>
									<select class="form-control input-sm select-size-sm chung"
										id="op2">
										<option value=""></option>
									</select> <label class="label-item" id="lb-allotment-2"><span
										id="allotment_text_2">Allotment</span></label> <input
										type="checkbox" class="chung" id="check-box-allotment-2"
										onchange="allotment_change('stage2')" /> <input type="text"
										size=1 id="allotment-2" class="chung" hidden>
								</div>

								<button
									class="btn btn-primary button-sm btn-sm btn-action chung"
									style="float: right;" onclick="clearStage(2)">CLear</button>
							</div>

							<div class="row add_room2"
								style="background-color: #FFFF99; margin: 0px;" id="add-room-2">
								<label class="col-md-12"><span style="color: red;">Add more room</span></label>
								<div class="col-md-12" style="margin-top: 2px; height: 40px;">
									<div class="form-inline col-md-2">
										<label class="label-item-sm">R/Type</label> <select
											class="form-control input-sm select-size-sm"
											id="r-type-add-2" style="height: 25px;">
											<option value=""></option>
										</select>
									</div>
									<div class="form-inline col-md-2">
										<label class="label-item-sm">R/Class</label> <select
											class="form-control input-sm select-size-sm"
											id="r-class-add-2" style="height: 25px; width: 20px;">
											<option value=""></option>
										</select>
									</div>
									<div class="form-group form-inline col-md-1"
										style="padding-right: 0px;">
										<label class="label-item-sm ">R/No</label> <input type="text"
											id="r-no-add2" class="check_num" style="width: 30px;">
									</div>
									<div class="form-group form-inline col-md-1"
										style="padding-right: 0px;">
										<label class="label-item-sm">L/C</label> <input type="text"
											style="width: 30px;" class="check_num" id="lc-add-more2"
											value="">
									</div>
									<div class="form-group form-inline col-md-1"
										style="padding-right: 0px;">
										<label class="label-item-sm ">AR/No</label> <input type="text"
											style="width: 30px;" id="ar-no-more-2">
									</div>
									<div class="form-group form-inline col-md-1">
										<button class="btn btn-primary btn-action"
											style="width: 45px; height: 30px;" onclick="add_more_room1()">Add
										</button>
									</div>
									<div class="form-group form-inline col-md-2">
										<label class="label-item-sm ">R/L</label> <input type="text"
											size=4 id="rl-more-add1" readonly class="chung"
											style="width: 110px;">
									</div>
									<div class="col-md-2">
										<button class="btn btn-primary btn-action"
											style="width: 55px; height: 30px;" onclick="clear_more1()">Clear
										</button>
										<button class="btn btn-primary btn-action"
											style="width: 50px; height: 30px;"
											onclick="ok_more_room('stage2')">Ok</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong" style="margin-bottom: 5px"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="row ">
					<div class="button-action-div  form-margin-bottom col-md-offset-3">
						<button class="btn btn-primary btn-sm btn-action chung btn-add"
							id="add_btn" onclick="return add_to_booking_list()">Add to
							Booking List</button>
						<button class="btn btn-primary btn-sm btn-action db"
							onclick="return update_booking_list()" id="update-booking-list">Update
							to Booking List</button>
						<button class="btn btn-primary btn-sm btn-action db"
							onclick="delete_row_booking()" id="delete-booking-list">Delete
							Booking List</button>
						<button class="btn btn-primary btn-sm btn-action chung"
							onclick="clear_form()">CLear</button>
					</div>
				</div>
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Booking list</label>
					</div>
					<div class="list-scroll">
						<table id="table-booking-info" class="table table-bordered">
							<thead
								style='background-color: #2d6ca2; color: white; width: 100%;'>
								<tr class='testRow' style='text-align: center;'>
									<td style='width: 10%'>City</td>
									<td style='width: 13%'>Hotel</td>
									<td style='width: 9%'>Arrv Date</td>
									<td style='width: 9%'>Dept Date</td>
									<td style='width: 6%'>Nite No</td>
									<td style='width: 6%'>Pax. No</td>
									<td style='width: 15%'>Check Out</td>
									<td style='width: 9%'>Room type</td>
									<td style='width: 11%'>Status</td>
									<td style='width: 12%'>Note</td>
								</tr>
							</thead>
							<tbody style='width: 100%;'>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1 col-md-offset-5">
			<div class="button-action-div">
				<button class="btn btn-primary button-sm btn-action chung"
					onclick="create_new_tour()">Save</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var select_booking = "";
    var key = 0;
    var lastid_guide = 0;
    var originalGuideIndex = lastid_guide;
    var data_new_guide = new Array();  
    var d = 0;
    var g = 0;
    var ng = 0;
    var dem = 0;
    var flag = false;
    var vn_code = "";
    var FLG_Add_MoreRoom1 = false;
    var FLG_Add_MoreRoom2 = false;
    var flag_question = 1;
    var FLG_Change = false;
    var i_TLTCode = 0;
    // load page default
    $(document).ready(function () {
        //Duong
        $('#nite-no-1').keyup(function () {
            if ($('#nite-no-1').val() == 0) {
                var arr_date = $('input[name=arrv-date-1]').val();
                var dept_date = $('input[name=dept-date-1]').val();
                if (arr_date == '' || dept_date == '') {
                    $('#nite-no-1').val('');
                }
                else {
                    $('#nite-no-1').val(1);
                }
                return false;
            }
        });
        $('#nite-no-2').keyup(function () {
            if ($('#nite-no-2').val() == 0) {
                var arr_date = $('input[name=arrv-date-2]').val();
                var dept_date = $('input[name=dept-date-2]').val();
                if (arr_date == '' || dept_date == '') {
                    $('#nite-no-2').val('');
                }
                else {
                    $('#nite-no-2').val(1);
                }
                return false;
            }
        });
        $('#check_spe1').click(function () {
            if ($(this).is(':checked') == true) {
                $('#holiday-no-1').prop('disabled', true);
            }
            else {
                $('#holiday-no-1').prop('disabled', false);
            }
        });
        $('#check_spe').click(function () {
            if ($(this).is(':checked') == true) {
                $('#holiday-no-2').prop('disabled', true);
            }
            else {
                $('#holiday-no-2').prop('disabled', false);
            }
        });
        //validate time
        flag_check_time = true;
        $('.check_time,.check_num').keypress(function (evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9\b\t:]/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        });
        $('.check_time').blur(function (event) {
            var id = $(this).attr('id');            
            var time = $(this).val();
            if (!isNaN(time) && (time >= 0 && time < 24) && time != '') {
                flag_check_time = true;
                if (time < 10) {
                    $(this).val('0' + time + ':00');
                }
                else {
                    $(this).val(time + ':00');
                }
            }
            else if (time != '') {
                array_time = time.split(':');
                if (array_time.length != 2 || array_time[0] >= 24 || array_time[0] < 0 || array_time[1] < 0 || array_time[1] > 59 || array_time[0].length != 2 || array_time[1].length != 2) {
                    flag_check_time = false;
                    alert('Time must be formartted as [HH:MM]');
                    setTimeout(function () {
                        $('#' + id).trigger('focus');
                    }, 1);
                }

            }
        });

        /*check date format */
        $("input[name='arrv-date-1']").keypress(function(evt){
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /^[0-9\b\t\/]$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        });
        /*end check date format */

        //end Duong
        $('.add_room').hide();
        $('.add_room2').hide();
        $('.chung').attr('disabled', 'true');
        $('.db').attr('disabled', 'true');
        $("#arrv-date-1 > div > input").attr('disabled', 'true');
        $("#dept-date-1 > div > input").attr('disabled', 'true');
        $("#arrv-date-2 > div > input").attr('disabled', 'true');
        $("#dept-date-2 > div > input").attr('disabled', 'true');
        // keyup new guest
        lastid_guide = parseInt($("#id-guide").val());
        originalGuideIndex = lastid_guide;

        initGuest(true);
        //get hotel by city
        $('#city').change(function () {
            FLG_Change = true;
            var city = $(this).val();
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/ajax_call'); ?>",
                async: true,
                type: "POST",
                data: "city=" + city,
                dataType: "html",
                success: function (data) {
                    $('#hotel').html(data);
                }
            });
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/load_transfer'); ?>",
                async: true,
                type: "POST",
                data: "city=" + city,
                dataType: "html",
                success: function (data) {
                    $('#op1').html(data);
                    $('#op2').html(data);
                }
            });

        });

        $("#lc-add-more2").keypress(function (e) {
            return checkKeyPress($(this).val().length, e);
        });

        $("#lc-add-more2").change(function () {
            if (checkChange($(this).val()) == false) {
                setTimeout(function () {
                    $("#lc-add-more2").focus();
                }, 1);
                return false;
            } else {
                $("#lc-add-more2").val(reFormat($("#lc-add-more2").val()));
            }
        });

        $("#check-out-1").keypress(function (e) {
            return checkKeyPress($(this).val().length, e);
        });

        $("#check-out-1").change(function () {
            if (checkChange($(this).val()) == false) {
                setTimeout(function () {
                    $("#check-out-1").focus();
                }, 1);
                return false;
            } else {
                $("#check-out-1").val(reFormat($("#check-out-1").val()));
            }
        });

        $("#lc-add-more").keypress(function (e) {
            return checkKeyPress($(this).val().length, e);
        });

        $("#lc-add-more").change(function () {
            if (checkChange($(this).val()) == false) {
                setTimeout(function () {
                    $("#lc-add-more").focus();
                }, 1);
                return false;
            } else {
                $("#lc-add-more").val(reFormat($("#lc-add-more").val()));
            }
        });

        $("#check-out-2").keypress(function (e) {
            return checkKeyPress($(this).val().length, e);
        });

        $("#check-out-2").change(function () {
            if (checkChange($(this).val()) == false) {
                setTimeout(function () {
                    $("#check-out-2").focus();
                }, 1);
                return false;
            } else {
                $("#check-out-2").val(reFormat($("#check-out-2").val()));
            }
        });
    });

    //select location event
    function change_location() {
        var locat = $("#location").val();
        FLG_Change == true;
        if (locat == "") {
            $('.chung').attr('disabled', 'true');
            $("#guidename" + $("#id-guide").val()).attr('disabled', 'true');
            $("#arrv-date-1 > div > input").attr('disabled', 'true');
            $("#dept-date-1 > div > input").attr('disabled', 'true');
            $("#arrv-date-2 > div > input").attr('disabled', 'true');
            $("#dept-date-2 > div > input").attr('disabled', 'true');
        } else {
            $('.chung').removeAttr("disabled");
            $("#arrv-date-1 > div > input").removeAttr("disabled");
            $("#dept-date-1 > div > input").removeAttr("disabled");
            $("#arrv-date-2 > div > input").removeAttr("disabled");
            $("#dept-date-2 > div > input").removeAttr("disabled");
            $("#guidename" + $("#id-guide").val()).removeAttr("disabled");
        }
    }
    function more_room(stage) {
        if (stage == "stage1") {
            $('.add_room').show();
            $('#r-type-1').attr('disabled', 'true');
            $('#r-class-1').attr('disabled', 'true');
            $('#r-no-1').attr('disabled', 'true');
            $('#check-out-1').attr('disabled', 'true');
            $('#check-box-allotment').attr('disabled', 'true');
            $('#lb-allotment-1').attr('disabled', 'true');
            $('#ar-no-more').val("0");


            if ($('#check-out-1').val() != '') {
                $('#rl-more-add').val($("#booking-" + key + " td:nth-child(34)").html());
            }
            $('#r-type-1').val('');
            $('#r-class-1').val('');
            $('#r-no-1').val('');
            $('#check-out-1').val('');
            FLG_Add_MoreRoom = true;
        }
        else {
            $('.add_room2').show();
            $('#r-type-2').attr('disabled', 'true');
            $('#r-class-2').attr('disabled', 'true');
            $('#r-no-2').attr('disabled', 'true');
            $('#check-out-2').attr('disabled', 'true');
            $('#check-box-allotment-2').attr('disabled', 'true');
            $('#lb-allotment-2').attr('disabled', 'true');
            $('#ar-no-more-2').val("0");
            if ($('#check-out-2').val() != '') {
                $('#rl-more-add1').val($("#booking-" + key + " td:nth-child(33)").html());
            }

            $('#r-type-2').val('');
            $('#r-class-2').val('');
            $('#r-no-2').val('');
            $('#check-out-2').val('');

            FLG_Add_MoreRoom2 = true;
        }
    }
    //clear form event
    function clear_form() {
        if (select_booking != "") {
            select_booking_list(select_booking);
        }
        $("#note-booking").val('');
        //$("#nite-no").val('');
        $("#city").val('');
        $("#hotel").val('');
        $("#note-bk").val("");
        $("#VN-Flight1").val("");
        $("#VN-Flight2").val("");
        $("#rl-more-add, #rl-more-add1").val("");
        $(".btn-add").removeAttr("disabled");
        $("#update-booking-list").attr("disabled", true);
        $("#delete-booking-list").attr("disabled", true);
        $("#from").attr("hidden", true);
        $("#back").attr("hidden", true);
        $('#r-type-1').prop('disabled', false);
        $('#r-class-1').prop('disabled', false);
        $('#r-no-1').prop('disabled', false);
        $('#check-out-1').prop('disabled', false);
        $('#r-type-2').prop('disabled', false);
        $('#r-class-2').prop('disabled', false);
        $('#r-no-2').prop('disabled', false);
        $('#check-out-2').prop('disabled', false);
        clearStage("1");
        clearStage("2");
        list_checkout = '';
        list_checkout2 = '';
    }
    function clear_tour() {
        $("#tour-code").val('');
        $("#tour-status").val('');
        $("#group-name").val('');
        $("#note").val('');
        $("#note-tour").val('');
        $("#guest-tour tr input").val('');
        $("#campaign").val('');

        lastid_guide = originalGuideIndex;
        initGuest(false);
    }
   
    function keyup_guide(id) {
        var guidename = $("#guidename"+id).val();
        if (id == (lastid_guide - 1) && guidename != "" ) {
            var row_insert_guide = "";
            row_insert_guide += "<tr id='guide-" + lastid_guide + "' class=\"new_guide_table\" data-id=\"" + lastid_guide + "\">";
            row_insert_guide += "<td style='width:20px'><div class='glyphicon glyphicon-pencil icon-edit'></div></td>";
            row_insert_guide += "<td style='width:266px'><input data-id='" + lastid_guide + "' type='text' id='guidename" + lastid_guide + "' value='' onchange='getguide()' onkeyup=\"keyup_guide(" + lastid_guide + ")\"></td>";
            row_insert_guide += "</tr>";

            $("#table-guide tbody").append(row_insert_guide);
            $("#guidename"+id).keypress(function(evt){
               var theEvent = evt || window.event;
               var key = theEvent.keyCode || theEvent.which;
               if($("#guidename"+id).val()!=""&&theEvent.keyCode == 13){
                  $("#guidename"+(lastid_guide-1)).focus();
               }
            });
            lastid_guide++;
        }
    }
  
    function create_new_tour() {
        var Location_Code = $("#location").val();
        var TourCode = $("#tour-code").val();
        var VnCode = $("#vn-code").val();
        var GroupName = $("#group-name").val();
        var TourStatus = $("#tour-status").val();
        var data_new_guide = new Array();
        var error1 = "";
        var error2 = "";
        var error3 = "";
        var error4 = "";
        var data_arr_guide = new Array();
        var data_arr_id = new Array();
        var i = 0;
        if (!VnCode) {
            alert("Please enter VN Code");
            return false;
        }
        $("#table-guide > tbody > tr > td > input").each(function () {
            if ($(this).val() != "") {
                data_arr_guide[i] = $(this).val();
                i++;
            }
        });

        if (Location_Code == "") {
            alert("Please Choose Location ");
        }
        else if (TourCode == "") {
            alert("Please choose Tour Code ");
        }
        else if (i == 0) {
            alert("No in guest tour.");
        }
        else if (check_tourcode(TourCode) == 1) {
            alert("TourCode Existed ! ");
        }        
        else {
            var rowCount = $('#table-booking-info tr').length;
            if ($("#add_btn").prop("disabled") == false && rowCount == 1) {
                var r = confirm("Data hasn't been added to booking list yet. Do you want to continue ?");
                if (r) {
                    if ($("#vn-code").val() == "") {
                        alert("Please enter VN Code");
                    }
                    else {
                        var dt = {
                            data_tour: array_data_tour(),
                            data_booking: array_data_booking(),
                            data_guest: data_arr_guide
                        };
                        $.ajax({
                            url: "<?php echo base_url('HotelBookingController/create_new_tour'); ?>",
                            async: false,
                            type: "POST",
                            data: dt,
                            dataType: "json",
                            success: function (data) {

                                if (data.tourid != "") {
                                    var r = confirm("Do You Want Update In/Out Transfer ?.")
                                    if (r) {
                                        location.href = "<?php echo base_url();?>transfer-management/update-tour-information?id=" + data.tourid;
                                    }
                                    else {
                                        location.href = "<?php echo base_url();?>hotel-booking?code=" + $("#tour-code").val();
                                    }
                                }
                                else {
                                    alert(data.msg);
                                }
                            }
                        });
                    }
                }
                else {
                    return;
                }

            }
            else {

                var dt = {
                    data_tour: array_data_tour(),
                    data_booking: array_data_booking(),
                    //data_guest    : array_data_guest()
                    data_guest: data_arr_guide
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/create_new_tour'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function (data) {

                        if (data.tourid != "") {
                            var r = confirm("Do You Want Update In/Out Transfer ?.")
                            if (r) {
                                location.href = "<?php echo base_url();?>transfer-management/update-tour-information?id=" + data.tourid;
                            }
                            else {
                                location.href = "<?php echo base_url();?>hotel-booking?code=" + $("#tour-code").val();
                            }
                        }
                        else {
                            alert(data.msg);
                        }
                    }
                });
            }
        }
    }
    function check_tourcode(TourCode) {
        var result = "";
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/check_tourcode'); ?>",
            type: "POST",
            data: "code=" + TourCode,
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }
    function add_to_booking_list() {

        var location = $("#location").val();
        var city = $("#city").val();
        var hotel = $("#hotel").val();
        var note = $("#note-bk").val();
        var Allotment1 = "";
        var Allotment2 = "";
        var HoilidaySum1;
        var CheckOut1;
        var HTL_Total1;
        var LC1;
        var HTL_Total2;
        var LC2;
        var CheckOut2;
        /*stage 1*/
        var vn_flight_1 = $("#VN-Flight1").val();
        var arrv_date_1 = $("#arrv-date-1").val();
        var dept_date_1 = $("#dept-date-1").val();
        var nite_no_1 = $("#nite-no-1").val();
        var no_pax_1 = $("#pax-no-1").val();
        var room_no_1 = $("#r-no-1").val();
        var check_out_1 = $("#check-out-1").val();
        var note1 = $("#note-booking-1").val();
        var room_type_1 = $("#r-type-1").val();
        var room_class_1 = $("#r-class-1").val();
        var hotel_status_1 = $("#hotel-status-1").val();
        var holiday1 = $('#holiday-no-1').val();
        var op1 = $('#op1').val();
        var SPE1 = $("#check-box-1").prop('checked');      
        //alert(Tranfer_Price1);
        /*end stage 1*/
        /*stage 2*/
        var no_pax_2 = $("#pax-no-2").val();
        var arrv_date_2 = $("#arrv-date-2").val();
        var dept_date_2 = $("#dept-date-2").val();
        var nite_no_2 = $("#nite-no-2").val();
        var room_no_2 = $("#r-no-2").val();
        var check_out_2 = $("#check-out-2").val();
        var note2 = $("#note-booking-2").val();
        var room_type_2 = $("#r-type-2").val();
        var room_class_2 = $("#r-class-2").val();
        var hotel_status_2 = $("#hotel-status-2").val();
        var vn_flight_2 = $("#VN-Flight2").val();
        var op2 = $('#op2').val();
        var holiday2 = $('#holiday-no-2').val();
        var SPE2 = $("#check-box-2").prop('checked');
        /*end stage 2*/         

        /*check date 1 and date 2*/
            var flag_date = false;
            if (arrv_date_1 != "" && dept_date_1 != "") {
                var dt = {
                    arr_date: arrv_date_1,
                    dept_date: dept_date_1
                };

                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/chck_date'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, opj) {
                            if (key == "msg" && opj != "") {
                                alert(opj);
                                flag_date = true;
                            } else if (key == "date_arr" && opj != "") {
                                $("#arrv-date-1 > div > input").focus();
                                $("#arrv-date-1").val(opj);

                            } else {
                                if (opj != "") {
                                    $("#dept-date-1 > div > input").focus();
                                    $("#dept-date-1").val(opj);
                                }
                            }
                        });
                    }
                });
            }
            if (arrv_date_2 != "" && dept_date_2 != "") {
                var dt = {
                    arr_date: arrv_date_2,
                    dept_date: dept_date_2
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/chck_date'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, opj) {
                            if (key == "msg" && opj != "") {
                                alert(opj);
                                flag_date = true;
                            } else if (key == "date_arr" && opj != "") {
                                $("#arrv-date-2 > div > input").focus();
                                $("#arrv-date-2").val(opj);
                            } else {
                                if (opj != "") {
                                    $("#dept-date-2 > div > input").focus();
                                    $("#dept-date-2").val(opj);
                                }
                            }
                        });
                    }
                });
            }
            if(flag_date){
               return false;
            }           
        /*end check date 1 and date 2*/
        

        if (arrv_date_1 != "" || dept_date_1 != "" || check_out_1 != "" || nite_no_1 != "") {
            if (no_pax_1 == "") {
                alert("Please enter value for PaxNo Stage 1!");
                return false;
            }
        }
        if (arrv_date_2 != "" || dept_date_2 != "" || check_out_2 != "" || nite_no_2 != "") {
            if (no_pax_2 == "" && flag_question == 1) {
                alert("Please enter value for PaxNo Stage 2!");
                return false;
            }
        }
        if (hotel == "" || city == "") {
            alert("Please select the hotel.");
            $("#city").focus();
            return false;
        }
        /*check box allotment 1*/
        if ($("#check-box-allotment-1").prop('checked') == true) {
            var date1 = new Date(arrv_date_1);                
            var date2 = new Date(dept_date_1);/**/                
            if (date2 - date1 <= 0) {
               alert("Please try again date to have allotment at Stage 1");
               return false;
            } else if (room_type_1.trim() == "") {
               alert("Please Choose Room Type1, Not Empty");
               return false;                    
            } else if (room_class_1.trim() == "") {
               alert("Please Choose Room Class1, Not Empty");
               return false;                    
            } else if (arrv_date_1.trim() == "" || dept_date_1.trim() == "") {
               alert("ArrvDate1 and DeptDate1 can`t empty");
               return false;                   
            } else if ($('#allotment-1').val() == "" || $('#allotment-1').val() == "0") {
               alert("Please Enter Allotment Room No1");
               return false;                    
            } 
            /* check allotment database */ 
           var flag_allotment1 = false;
           var dt = {
                    city: city,
                    hotel: hotel,
                    arrv_date: arrv_date_1,
                    dept_date: dept_date_1,
                    room_no : $("#allotment-1").val(),
                    r_class : $("#r-class-1").val()
                };                    
          $.ajax({
              url: "<?php echo base_url('HotelBookingController/check_allotment'); ?>",
              async: false,
              type: "POST",
              data: dt,
              dataType: "json",              
              success: function(data) {
                 if(data.msg !=""){
                    flag_allotment1 = true;
                    alert(data.msg);
                 }
                 else{
                    Allotment1 = data.AllotmentID + "-" + dt.arrv_date + "-" + dt.dept_date + "-" + dt.room_no;
                 }
              }
          });
          if(flag_allotment1){
            return false;
          }
          /*end check database*/
        }        
        /*end check box allotment 1*/
       
        /*check box allotment 2*/
        if ($("#check-box-allotment-2").prop('checked') == true) {
            var date1 = new Date(arrv_date_1);                
            var date2 = new Date(dept_date_1);/**/                
            if (date2 - date1 <= 0) {
               alert("Please try again date to have allotment at Stage 1");
               return false;
            } else if (room_type_2.trim() == "") {
               alert("Please Choose Room Type1, Not Empty");
               return false;                    
            } else if (room_class_2.trim() == "") {
               alert("Please Choose Room Class1, Not Empty");
               return false;                    
            } else if (arrv_date_2.trim() == "" || dept_date_2.trim() == "") {
               alert("ArrvDate1 and DeptDate1 can`t empty");
               return false;                   
            } else if ($('#allotment-2').val() == "" || $('#allotment-2').val() == "0") {
               alert("Please Enter Allotment Room No1");
               return false;                    
            } 
            /* check allotment database */ 
           var flag_allotment2 = false;
           var dt = {
                    city: city,
                    hotel: hotel,
                    arrv_date: arrv_date_2,
                    dept_date: dept_date_2,
                    room_no : $("#allotment-2").val(),
                    r_class : $("#r-class-2").val()
                };                    
          $.ajax({
              url: "<?php echo base_url('HotelBookingController/check_allotment'); ?>",
              async: false,
              type: "POST",
              data: dt,
              dataType: "json",              
              success: function(data) {
                 if(data.msg !=""){
                    flag_allotment2 = true;
                    alert(data.msg);
                 }
                 else{
                    Allotment2 = data.AllotmentID + "-" + dt.arrv_date + "-" + dt.dept_date + "-" + dt.room_no;                   
                 }
              }
          });
          if(flag_allotment2){
            return false;
          }
          /*end check database*/
        }        
        /*end check box allotment 2*/    
        if ($('#menu_1').attr('class') == 'active') {
            if (arrv_date_1 == "" || dept_date_1 == "") {
                alert("Please select arrive date.");
                return false;
            }
        }
         
        else {
            if (arrv_date_2 == "" || dept_date_2 == "") {
                if (flag_question == 1) {
                    alert("Please select arrive date.");
                    return false;
                }
            }
        }      
        /*set value stage 1*/
        if (no_pax_1 == "") {
            no_pax_1 = 0;
        }
        if (holiday1 == "") {
            HoilidaySum1 = 0;
        }
        else {
            HoilidaySum1 = holiday1;
        }
        
        CheckOut1 = $("#check-out-1").val();
        if (list_checkout != "") {
            CheckOut1 = list_checkout;
        }
        if (room_type_1 != "" && room_class_1 != "") {
            if ($("#check-out-1").val() == "") {
                CheckOut1 = "0:00";
            }
            else {
                CheckOut1 = check_out_1;
            }
            if ($("#check-box-1").prop('checked') == true) {
                var dt = {
                    city: city,
                    hotel: hotel,
                    r_class: room_class_1,
                    r_type: room_type_1,
                    check_out: CheckOut1,
                    room_no_1: room_no_1,
                    nite_no_1: nite_no_1,
                    pax_no_1: no_pax_1,
                    spe: SPE1
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_room_list'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function (data) {
                        //debugger;
                        HTL_Total1 = data.httotal;
                        LC1 = data.lc;
                    }
                });
            }
            else {
                HTL_Total1 = "";
                LC1 = "";
            }

        }
        else {
            HTL_Total1 = "";
            LC1 = "";
        }      
        var Tranfer_Price1 = GetTransferPrice(op1);
        /*end value stage 1*/

        /*set value stage 2*/
        if (no_pax_2 == "") {
            no_pax_2 = 0;
        }        
        if (holiday2 == "") {
            HoilidaySum2 = 0;
        }
        else {
            HoilidaySum2 = holiday2;
        }
        CheckOut2 = $("#check-out-2").val();
        if (list_checkout2 != "") {
            CheckOut2 = list_checkout2;
        }
        if (room_type_2 != "" && room_class_2 != "") {
            if ($("#check-out-2").val() == "") {
                CheckOut2 = "0:00";
            }
            else {
                CheckOut2 = check_out_2;
            }
            if ($("#check-box-1").prop('checked') == true) {
                var dt = {
                    city: city,
                    hotel: hotel,
                    r_class: room_class_2,
                    r_type: room_type_2,
                    check_out: CheckOut2,
                    room_no_1: room_no_2,
                    nite_no_1: nite_no_2,
                    pax_no_1: no_pax_2,
                    spe: SPE2
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_room_list'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function (data) {
                        //debugger;
                        HTL_Total2 = data.httotal;
                        LC2 = data.lc;
                    }
                });
            }
            else {
                HTL_Total2 = "";
                LC2 = "";
            }
        }
        else {
            HTL_Total2 = "";
            LC2 = "";
        }
        var Tranfer_Price2 = GetTransferPrice(op2);
        LC1 = LC1 + "-" + Tranfer_Price1 + "-";
        LC2 = LC2 + "-" + Tranfer_Price2 + "-";
        var hotelalias = get_hotelalias(hotel);
        var TLTCODE = create_TLTCode(location, hotel, arrv_date_1, i_TLTCode);
        i_TLTCode = TLTCODE.substr(TLTCODE.lastIndexOf("-") + 1);

        key++;
        var row = "";

        row += "<tr id='booking-" + key + "' onclick=\"select_booking_list('" + key + "')\">";
        /*hotel info*/
        row += "<td style='width:10%;'>" + city + "</td>";//1
        row += "<td style='width:13%;'>" + hotel + "</td>";//2
        row += "<td style='display:none;'>" + TLTCODE + "</td>"; //3
        row += "<td style='display:none;'>" + note + "</td>"; //4
        /*From HCM*/
        row += "<td style='display: none;'>" + vn_flight_1 + "</td>";//5
        /*Back HCM*/

        row += "<td style='display: none;'>" + vn_flight_2 + "</td>";//6
        /*Stage1*/
        row += "<td style='width:9%;'>" + arrv_date_1 + "</td>";//7
        row += "<td style='width:9%'>" + dept_date_1 + "</td>";//8
        row += "<td style='width:6%'>" + nite_no_1 + "</td>";//9
        row += "<td style='width:6%;'>" + no_pax_1 + "</td>";//10
        row += "<td style='width:15%;'>" + CheckOut1 + "</td>";//11
        row += "<td style='display:none;'>" + room_no_1 + "</td>"; //12
        row += "<td style='width:9%;'>" + room_type_1 + "</td>";//13
        row += "<td style='display:none;'>" + room_class_1 + "</td>"; //14
        row += "<td style='display:none;'>" + Allotment1 + "</td>"; //15
        row += "<td style='width:11%;'>" + hotel_status_1 + "</td>";//16
        row += "<td style='width:12%;'>" + note1 + "</td>";//17
        row += "<td style='display:none;'>" + HTL_Total1 + "</td>";//18
        row += "<td style='display:none;'>" + LC1 + "</td>";//19

        /*stage 2*/
        row += "<td style='display: none;'>" + arrv_date_2 + "</td>";//20
        row += "<td style='display: none;'>" + dept_date_2 + "</td>";//21
        row += "<td style='display: none;'>" + nite_no_2 + "</td>";//22
        row += "<td style='display: none;'>" + no_pax_2 + "</td>";//23
        row += "<td style='display: none;'>" + CheckOut2 + "</td>";//24
        row += "<td style='display: none;'>" + room_no_2 + "</td>";//25
        row += "<td style='display: none;'>" + room_type_2 + "</td>";//26
        row += "<td style='display: none;'>" + room_class_2 + "</td>";//27
        row += "<td style='display:none;'>" + Allotment2 + "</td>"; //28
        row += "<td style='display: none;'>" + hotel_status_2 + "</td>";//29
        row += "<td style='display: none;'>" + note2 + "</td>";//30
        row += "<td style='display:none;'>" + HTL_Total2 + "</td>";//31
        row += "<td style='display:none;'>" + LC2 + "</td>";//32
        row += "<td style='display:none;'>" + $('#rl-more-add1').val() + " </td>"
        row += "<td style='display:none;'>" + $('#rl-more-add').val() + " </td>"
        row += "</tr>";        
        $("#table-booking-info tbody").append(row);
        $('#rl-more-add').val('');
        $('#rl-more-add1').val('');
        $("#city").val("");
        $("#hotel").val("");
        $("#VN-Flight1").val("");
        $("#VN-Flight2").val("");
        $("#arrv-date-1").val("");
        $("#dept-date-1").val("");
        $("#nite-no-1").val("");
        $("#pax-no-1").val("");
        $("#r-no-1").val("");
        $("#check-out-1").val("");
        $("#note-booking-1").val("");
        $("#r-type-1").val("");
        $("#r-class-1").val("");
        $("#hotel-status-1").val("");
        $("#arrv-date-2").val("");
        $("#dept-date-2").val("");
        $("#nite-no-2").val("");
        $("#pax-no-2").val("");
        $("#r-no-2").val("");
        $("#check-out-2").val("");
        $("#note-booking-2").val("");
        $("#r-type-2").val("");
        $("#r-class-2").val("");
        $("#hotel-status-2").val("");
        $("#op1").val("");
        $("#op2").val("");
        $("#note-bk").val("");
        $("#holiday-no-1").val("");
        $("#holiday-no-2").val("");
        $("#check-box-1").prop("checked", false);
        $("#check-box-2").prop("checked", false);

        $("#allotment_text_1").attr("hidden",true);
        $("#allotment-1").attr("hidden", true);
        $("#check-box-allotment-1").prop("checked",false);
        
        $("#allotment_text_2").attr("hidden",true);
        $("#allotment-2").attr("hidden", true);
        $("#check-box-allotment-2").prop("checked",false);


        flag_question += 1;
        if($("#vn-code").val() == "" || $("#vn-code").val() == "undefined"){
            dt = {
                location: $("#location").val(),
                arrv_date: arrv_date_1
            };
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/create_VNCode'); ?>",
                type: "POST",
                async: false,
                data: dt,
                dataType: "json",
                success: function (data) {
                    vn_code = data;
                }
            });
            $("#vn-code").val(vn_code);
        }
        FLG_Change = false;
        $("#location").attr("disabled", true);
    }

    function array_data_booking() {
        var i = 1;
        var rowCount = $('#table-booking-info tr').length;
        var list_result = [];
        for (i = 1; i < rowCount; i++) {
            list_result.push({
                'City': $("#booking-" + i + " td:nth-child(1) ").html(),
                'Hotel': $("#booking-" + i + " td:nth-child(2) ").text(),
                'TLTCODE': $("#booking-" + i + " td:nth-child(3) ").html(),
                'Note': $("#booking-" + i + " td:nth-child(4) ").html(),
                'VNFlight1': $("#booking-" + i + " td:nth-child(5) ").html(),
                'VNFlight2': $("#booking-" + i + " td:nth-child(6) ").html(),
                'ArrvDate1': $("#booking-" + i + " td:nth-child(7) ").html(),
                'DeptDate1': $("#booking-" + i + " td:nth-child(8)").html(),
                'NiteNo1': $("#booking-" + i + " td:nth-child(9) ").html(),
                'PaxNo1': $("#booking-" + i + " td:nth-child(10)").html(),
                'CheckOut1': $("#booking-" + i + " td:nth-child(11) ").html(),
                'RoomNo1': $("#booking-" + i + " td:nth-child(12) ").html(),
                'RoomType1': $("#booking-" + i + " td:nth-child(13) ").html(),
                'RoomClass1': $("#booking-" + i + " td:nth-child(14) ").html(),
                'Allotment1': $("#booking-" + i + " td:nth-child(15) ").html(),
                'HotelStatus1': $("#booking-" + i + " td:nth-child(16) ").html(),
                'Note1': $("#booking-" + i + " td:nth-child(17) ").html(),
                'HTL_Total1': parseInt("0" + $("#booking-" + i + " td:nth-child(18) ").html()),
                'LC1': $("#booking-" + i + " td:nth-child(19) ").html(),
                'ArrvDate2': $("#booking-" + i + " td:nth-child(20) ").html(),
                'DeptDate2': $("#booking-" + i + " td:nth-child(21) ").html(),
                'NiteNo2': $("#booking-" + i + " td:nth-child(22) ").html(),
                'PaxNo2': $("#booking-" + i + " td:nth-child(23) ").html(),
                'CheckOut2': $("#booking-" + i + " td:nth-child(24) ").html(),
                'RoomNo2': $("#booking-" + i + " td:nth-child(25) ").html(),
                'RoomType2': $("#booking-" + i + " td:nth-child(26) ").html(),
                'RoomClass2': $("#booking-" + i + " td:nth-child(27) ").html(),
                'Allotment2': $("#booking-" + i + " td:nth-child(28) ").html(),
                'HotelStatus2': $("#booking-" + i + " td:nth-child(29) ").html(),
                'Note2': $("#booking-" + i + " td:nth-child(30) ").html(),
                'HTL_Total2': parseInt("0" + $("#booking-" + i + " td:nth-child(31) ").html()),
                'LC2': $("#booking-" + i + " td:nth-child(32) ").html(),
                "SPE1": $("#check-box-1").prop("checked") ? "1" : "0",
                "SPE2": $("#check-box-2").prop("checked") ? "1" : "0",
                "Room_List1": $("#booking-" + i + " td:nth-child(34) ").html(),
                "Room_List2": $("#booking-" + i + " td:nth-child(33) ").html()
            });
        }
        return list_result;
    }

    function select_booking_list(key) {
        $("#table-booking-info").find("tr").css("background", "transparent");
        $("#booking-" + key).css("background", "#397FDB");
        $('.db').removeAttr('disabled', 'true');
        $('#add_btn').attr('disabled', 'true');
        select_booking = key;
        /*hotel info*/
        $("#city").val($("#booking-" + key + " td:nth-child(1)").html());

        $.ajax({
            url: "<?php echo base_url('HotelBookingController/ajax_call'); ?>",
            async: false,
            type: "POST",
            data: "city=" + $("#city").val(),
            dataType: "html",
            success: function(data) {
                $('#hotel').html(data);
            }
        });
        $("#hotel").val($("#booking-" + key + " td:nth-child(2) ").text());
        var dt = {
            city: $("#booking-" + key + " td:nth-child(1)").html(),
            hotel: $("#booking-" + key + " td:nth-child(2)").text()
        };
        if (dt.city != "" && dt.hotel != "") {
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/get_rtypeandrclass'); ?>",
                async: false,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data) {
                    var output = "";
                    var output1 = "";
                    $.each(data, function(key, opj) {
                        if (key == "rtype" && opj != "") {
                            $("#r-type-1").html(opj);
                            $("#r-type-2").html(opj);
                            $("#r-type-add").html(opj);
                            $("#r-type-add-2").html(opj);
                        } else if (key == "rclass" && opj != "") {
                            $("#r-class-1").html(opj);
                            $("#r-class-2").html(opj);
                            $("#r-class-add").html(opj);
                            $("#r-class-add-2").html(opj);
                        }
                    });
                }
            });
        } else {
            $("#r-type-1").html("<option></option>");
            $("#r-type-2").html("<option></option>");
            $("#r-type-add").html("<option></option>");
            $("#r-type-add-2").html("<option></option>");
            $("#r-class-1").html("<option></option>");
            $("#r-class-2").html("<option></option>");
            $("#r-class-add").html("<option></option>");
            $("#r-class-add-2").html("<option></option>");            
        }
        

        if ($("#booking-" + key + " td:nth-child(4)").html() == "") {
            $("#note-bk").val("");
        }
        else {
            $("#note-bk").val($("#booking-" + key + " td:nth-child(4)").html());
        }
        /*from HCM*/
        if ($("#booking-" + key + " td:nth-child(5)").html() == "") {
            $("#VN-Flight1").val("");
        }
        else {
            $("#VN-Flight1").val($("#booking-" + key + " td:nth-child(5)").html());
        }
        /*back HCM*/
        if ($("#booking-" + key + " td:nth-child(6)").html() == "") {
            $("#VN-Flight2").val("");
        }
        else {
            $("#VN-Flight2").val($("#booking-" + key + " td:nth-child(6)").html());
        }
        /*Stage1*/
        if ($("#booking-" + key + " td:nth-child(7)").html() == "") {
            $("#arrv-date-1").val("");
        }
        else {
            $("#arrv-date-1").val($("#booking-" + key + " td:nth-child(7)").html());
        }
        if ($("#booking-" + key + " td:nth-child(8)").html() == "") {
            $("#dept-date-1").val("");
        }
        else {
            $("#dept-date-1").val($("#booking-" + key + " td:nth-child(8)").html());
        }
        if ($("#booking-" + key + " td:nth-child(9)").html() == "") {
            $("#nite-no-1").val("");
        }
        else {
            $("#nite-no-1").val($("#booking-" + key + " td:nth-child(9)").html());
        }

        if ($("#booking-" + key + " td:nth-child(10)").html() == "") {
            $("#pax-no-1").val("");
        }
        else {
            $("#pax-no-1").val($("#booking-" + key + " td:nth-child(10)").html());
        }

        if ($("#booking-" + key + " td:nth-child(11)").html() == "") {
            $("#check-out-1").val("");
        }
        else {
            $("#check-out-1").val($("#booking-" + key + " td:nth-child(11)").html());
        }

        if ($("#booking-" + key + " td:nth-child(12)").html() == "") {
            $("#r-no-1").val("");
        }
        else {
            $("#r-no-1").val($("#booking-" + key + " td:nth-child(12)").html());
        }

        if ($("#booking-" + key + " td:nth-child(13)").html() == "") {
            $("#r-type-1").val("");
        }
        else {
            $("#r-type-1").val($("#booking-" + key + " td:nth-child(13)").html());
        }
        if ($("#booking-" + key + " td:nth-child(14)").html() == "") {
            $("#r-class-1").val("");
        }
        else {
            $("#r-class-1").val($("#booking-" + key + " td:nth-child(14)").html());
        }

        if ($("#booking-" + key + " td:nth-child(15)").html() == "") {
            $("#check-box-allotment-1").prop("checked", false);
        }
        else {
            $("#allotment_text_1").removeAttr("hidden");
            $("#check-box-allotment-1").prop("checked", true);
            $("#lb-allotment-1").removeAttr("hidden");
            $("#allotment-1").removeAttr("hidden");
            var r_noallontment = "";
            var dt = {
                str_allotment: $("#booking-" + key + " td:nth-child(15)").html()
            };
            $.ajax({
                async: false,
                url: "<?php echo base_url('HotelBookingController/chk_Allotment_RNo'); ?>",
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data) {         
                     console.log(data);           
                    r_noallontment = data.rno_allotment;
                }
            });           
            $("#allotment-1").val(r_noallontment);           
        }

        if ($("#booking-" + key + " td:nth-child(16)").html() == "") {
            $("#hotel-status-1").val("");
        }
        else {
            $("#hotel-status-1").val($("#booking-" + key + " td:nth-child(16)").html());
        }        
        if ($("#booking-" + key + " td:nth-child(17)").html() == "") {
            $("#note-booking-1").val("");
        }
        else {
            $("#note-booking-1").val($("#booking-" + key + " td:nth-child(17)").html());
        }
        /*Stage 2*/
        if ($("#booking-" + key + " td:nth-child(20)").html() == "") {
            $("#arrv-date-2").val("");
        }
        else {
            $("#arrv-date-2").val($("#booking-" + key + " td:nth-child(20)").html());
        }
        if ($("#booking-" + key + " td:nth-child(21)").html() == "") {
            $("#dept-date-2").val("");
        }
        else {
            $("#dept-date-2").val($("#booking-" + key + " td:nth-child(21)").html());
        }
        if ($("#booking-" + key + " td:nth-child(22)").html() == "") {
            $("#nite-no-2").val("");
        }
        else {
            $("#nite-no-2").val($("#booking-" + key + " td:nth-child(22)").html());
        }
        if ($("#booking-" + key + " td:nth-child(23)").html() == "") {
            $("#pax-no-2").val("");
        }
        else {
            $("#pax-no-2").val($("#booking-" + key + " td:nth-child(23)").html());
        }
        if ($("#booking-" + key + " td:nth-child(24)").html() == "") {
            $("#check-out-2").val("");
        }
        else {
            $("#check-out-2").val($("#booking-" + key + " td:nth-child(24)").html());
        }
        if ($("#booking-" + key + " td:nth-child(25)").html() == "") {
            $("#r-no-2").val("");
        }
        else {
            $("#r-no-2").val($("#booking-" + key + " td:nth-child(25)").html());
        }
        if ($("#booking-" + key + " td:nth-child(26)").html() == "") {
            $("#r-type-2").val("");
        }
        else {
            $("#r-type-2").val($("#booking-" + key + " td:nth-child(26)").html());
        }

        if ($("#booking-" + key + " td:nth-child(27)").html() == "") {
            $("#r-class-2").val("");
        }
        else {
            $("#r-class-2").val($("#booking-" + key + " td:nth-child(27)").html());
        }

        if ($("#booking-" + key + " td:nth-child(28)").html() == "") {
            $("#check-box-allotment-2").prop("checked", false);
        }
        else {
            $("#allotment_text_2").removeAttr("hidden");            
            $("#check-box-allotment2").prop("checked", true);
            $("#allotment-2").removeAttr("hidden");
            var r_noallontment = "";
            var dt = {
                str_allotment: $("#booking-" + key + " td:nth-child(28)").html()
            };
            $.ajax({
                async: false,
                url: "<?php echo base_url('HotelBookingController/chk_Allotment_RNo'); ?>",
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data) {
                    r_noallontment = data.rno_allotment;
                }
            });
            $("#allotment-2").val(r_noallontment);           
        }

        if ($("#booking-" + key + " td:nth-child(29)").html() == "") {
            $("#hotel-status-2").val("");
        }
        else {
            $("#hotel-status-2").val($("#booking-" + key + " td:nth-child(29)").html());
        }

        if ($("#booking-" + key + " td:nth-child(30)").html() == "") {
            $("#note-booking-2").val("");
        }
        else {
            $("#note-booking-2").val($("#booking-" + key + " td:nth-child(30)").html());
        }

    }
    function array_data_tour() {
        var list_result = {
            Location_Code: $("#location").val(),
            TourCode: $("#tour-code").val(),
            VnCode: $("#vn-code").val(),
            GroupName: $("#group-name").val(),
            TourStatus: $("#tour-status").val(),
            Note: $("#note").val(),
            Cam_code: $("#campaign").val()
        };
        return list_result;
    }

    function create_TLTCode(location, hotel, arrv_date_1, i_TLTCode) {
        var result = "";
        var dt = {
            location: location,
            hotel: hotel,
            arrv_date_1: arrv_date_1,
            i_TLTCode: i_TLTCode
        };
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/create_TLTCode'); ?>",
            type: "POST",
            data: dt,
            async: false,
            dataType: "json",
            success: function (data) {
                result = data.str_TLTCode;
            }
        });
        return result;
    }
    function get_hotelalias(hotel) {
        var result = "";
        var hotelname = hotel;
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/get_hotelalias'); ?>",
            type: "POST",
            data: "hotelname=" + hotel,
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }
    function delete_row_booking() {
        if (select_booking == "") {
            alert("No booking selected!!!");
        } else {
            var r = confirm("Are you sure to want to delete this booking ?");
            if (r == true) {
                $("#booking-" + select_booking).remove();
                $("#update-booking-list").attr("disabled", true);
                $("#delete-booking-list").attr("disabled", true);
                $("#add_btn").attr("disabled", false);
                FLG_Change = false;
            }
        }
    }
    /*Auto Caculator when chang date*/
    function get_niteno_paxno(stage) {
        var oneDay = 24*60*60*1000;
        if (stage == "stage1") {
            var arrv_date_1 = new Date($("#arrv-date-1").val());
            var dept_date_1 = new Date($("#dept-date-1").val());
            if($("#dept-date-1").val()=="" || $("#arrv-date-1").val() == ""){
                $('#nite-no-1').val("0");
            }
            else{
                var diffDays = Math.round((dept_date_1.getTime() - arrv_date_1.getTime())/(oneDay));
                $('#nite-no-1').val(diffDays);
            }
        }
        else if (stage == "stage2") {
            var arrv_date_2 = new Date($("#arrv-date-2").val());
            var dept_date_2 = new Date($("#dept-date-2").val());
            if($("#arrv-date-2").val() == "" || $("#dept-date-2").val() == ""){
                $('#nite-no-2').val("0");
            }
            else{
                var diffDays = Math.round((dept_date_2.getTime() - arrv_date_2.getTime())/(oneDay));
                $('#nite-no-2').val(diffDays);
            }

        }
    }
    /*end Auto Caculator when chang date*/

    function getguide() {
        var i = 0;
        $("#table-guide > tbody > tr > td > input").each(function () {
            if ($(this).val() != "") {
                i++;
            }
        });
        $("#pax-no-1").val(i);
        $("#pax-no-2").val(i);
    }
    function get_rtypeandrclass() {
        var dt = {
            city: $("#city").val(),
            hotel: $("#hotel").val()
        };

        if ($("#city").val() != "" || $("#hotel").val() != "") {
            $("#from").attr("hidden", false);
            $("#back").attr("hidden", false);
        }
        else {
            $("#from").attr("hidden", true);
            $("#back").attr("hidden", true);
        }

        if ($("#city").val() != "" && $("#hotel").val() != "") {
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/get_rtypeandrclass'); ?>",
                async: true,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function (data) {
                    var output = "";
                    var output1 = "";
                    $.each(data, function (key, opj) {
                        if (key == "rtype" && opj != "") {
                            $("#r-type-1").html(opj);
                            $("#r-type-2").html(opj);
                            $("#r-type-add").html(opj);
                            $("#r-type-add-2").html(opj);
                        }
                        else if (key == "rclass" && opj != "") {
                            $("#r-class-1").html(opj);
                            $("#r-class-2").html(opj);
                            $("#r-class-add").html(opj);
                            $("#r-class-add-2").html(opj);
                        }
                    });
                }
            });
        }
        else {
            $("#r-type-1").html("<option></option>");
            $("#r-type-2").html("<option></option>");
            $("#r-type-add").html("<option></option>");
            $("#r-class-1").html("<option></option>");
            $("#r-class-2").html("<option></option>");
            $("#r-class-add").html("<option></option>");
            $("#r-class-add-2").html("<option></option>");
            $("#r-type-add-2").html("<option></option>");
        }
    }
    function allotment_change(stage) {
        if (stage == "stage1") {
            if ($("#check-box-allotment-1").prop('checked') == true) {
                $('#allotment-1').attr('hidden', false);
                // $('#allotment-1').val("0");
                $("#allotment_text_1").attr('hidden',false);
            }
            else {
                $('#allotment-1').attr('hidden', true);
                $("#allotment_text_1").attr('hidden',true);
            }
        }
        else if (stage == "stage2") {
            if ($("#check-box-allotment-2").prop('checked') == true) {
                $('#allotment-2').attr('hidden', false);
                // $('#allotment-2').val("0");
                $("#allotment_text_2").attr('hidden',false);
            }
            else {
                $('#allotment-2').attr('hidden', true);
                $("#allotment_text_2").attr('hidden',true);
            }
        }

    }
    function clear_more() {
        $('#r-type-add').val("");
        $('#r-class-add').val("");
        $('#r-no-add').val("");
        $('#lc-add-more').val("");
        $('#rl-more-add').val('');
        $('#ar-no-more').val('');
        list_checkout = '';
    }
    function clear_more1() {
        $('#r-type-add-2').val("");
        $('#r-class-add-2').val("");
        $('#r-no-add2').val("");
        $('#lc-add-more2').val("");
        $('#rl-more-add1').val('');
        $('#ar-no-more-2').val('');
        list_checkout2 = '';
    }
    list_checkout = '';
    function add_more_room() {
        if ($('#lc-add-more').val() != '') {
            list_checkout += $('#lc-add-more').val() + "[" + $('#r-type-add').val() + "/" + $('#r-class-add').val() + "];";
        }
        else {
            list_checkout += "12:00" + "[" + $('#r-type-add').val() + "/" + $('#r-class-add').val() + "];";
        }       
        var dt = {
            rtye: $('#r-type-add').val(),
            rclass: $('#r-class-add').val(),
            rno: $('#r-no-add').val(),
            check_spe: $('#check-box-1').prop('checked'),
            city: $('#city').val(),
            hotel: $('#hotel').val(),
            checkout: $('#lc-add-more').val(),
            niteno: $('#nite-no-1').val(),
            paxno: $('#pax-no-1').val(),
            holiday: $('#holiday-no-1').val(),
            vncode: $('#vn-code').val(),
            roomlist: $('#rl-more-add').val(),
            arnomore: $('#ar-no-more').val(),
            arrivedate: $('#arrv-date-1').val(),
            deptdate: $('#dept-date-1').val(),
            arnomore2: $('#ar-no-more-2').val()
        };
        var regex =  /^\d{4}\/(0?[1-9]|1[012])\/(0?[1-9]|[12][0-9]|3[01])$/;
        if(!regex.test(dt.arrivedate)){
            $("input[name='arrv-date-1']").focus();
            window.alert("Invalid Date!!!!");
            return false;
        }
        if(!regex.test(dt.deptdate)){
            $("input[name='dept-date-1']").focus();
            window.alert("Invalid Date!!!!");
            return false;            
        }
        var date1 = new Date(dt.arrivedate);
        var date2 = new Date(dt.deptdate);
        if(date1 - date2 > 0){
            $("input[name='dept-date-1']").focus();
            window.alert("Arrv Date bigger Dept Date!!!");
            return false;            
        }
        if ($('#r-type-add').val() == "") {
            $('#r-type-add').focus();
            window.alert("Please Choose Room Type");
            return false;            
        }
        else if ($('#r-class-add').val() == "") {
            $('#r-class-add').focus();
            window.alert("Please Choose Room Class");
            return false;
        }
        else if ($('#r-no-add').val() == "") {
            $('#r-no-add').focus();
            window.alert("Please enter room number");
            return false;
        }
        else if (parseInt($('#ar-no-more').val()) > parseInt($('#r-no-add').val())) {
            $('#ar-no-more').focus();
            window.alert('Allotment Room No is more than Room No. Please try again');
            return false;
        }
        else {
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/add_more_room'); ?>",
                async: true,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function (data) {

                    if (data.msg != "") {
                        alert(data.msg);
                        return;
                    }
                    
                    if (data.r_list != "") {
                        $('#r-type-add').val('');
                        $('#r-class-add').val('');
                        $('#r-no-add').val('');
                        $('#lc-add-more').val('');

                        $('#rl-more-add').val(data.r_list);
                        
                    }
                }
            });
        }
    }
    list_checkout2 = '';
    function add_more_room1() {
        if ($('#lc-add-more2').val() != '') {
            list_checkout2 += $('#lc-add-more2').val() + "[" + $('#r-type-add-2').val() + "/" + $('#r-class-add-2').val() + "];";
        }
        else {
            list_checkout2 += "12:00" + "[" + $('#r-type-add-2').val() + "/" + $('#r-class-add-2').val() + "];";
        }
        console.log(list_checkout2);
        var dt = {
            rtye: $('#r-type-add-2').val(),
            rclass: $('#r-class-add-2').val(),
            rno: $('#r-no-add2').val(),
            check_spe: $('#check-box-2').prop('checked'),
            city: $('#city').val(),
            hotel: $('#hotel').val(),
            checkout: $('#lc-add-more2').val(),
            niteno: $('#nite-no-2').val(),
            paxno: $('#pax-no-2').val(),
            holiday: $('#holiday-no-2').val(),
            vncode: $('#vn-code').val(),
            roomlist: $('#rl-more-add1').val(),
            arnomore: $('#ar-no-more').val(),
            arrivedate: $('#arrv-date-2').val(),
            deptdate: $('#dept-date-2').val(),
            arnomore2: $('#ar-no-more-2').val()
        };


        if ($('#r-type-add-2').val() == "") {
            window.alert("Please input all data");
        }
        else if ($('#r-class-add-2').val() == "") {
            window.alert("Please input all data");
        }
        else if ($('#r-no-add2').val() == "") {
            window.alert("Please input all data");
        }
        else if (parseInt($('#ar-no-more-2').val()) > parseInt($('#r-no-add2').val())) {
            alert('Allotment Room No is more than Room No. Please try again');
        }
        else {
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/add_more_room'); ?>",
                async: true,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function (data) {

                    if (data.msg != "") {
                        alert(data.msg);
                        return;
                    }

                    if (data.r_list != "") {
                        $('#r-type-add-2').val('');
                        $('#r-class-add-2').val('');
                        $('#r-no-add2').val('');
                        $('#lc-add-more2').val('');

                        $('#rl-more-add1').val(data.r_list);
                    }
                }
            });
        }
    }
    function ok_more_room(stage) {
        if (stage == "stage1") {
            $('#r-type-1').attr('disabled', false);
            $('#r-class-1').attr('disabled', false);
            $('#r-no-1').attr('disabled', false);
            $('#check-out-1').attr('disabled', false);
            $('#check-box-allotment').attr('disabled', false);
            $('#lb-allotment-1').attr('disabled', false);
            $('.add_room').hide();
            FLG_Add_MoreRoom1 = false;
        }
        else {
            $('#r-type-2').attr('disabled', false);
            $('#r-class-2').attr('disabled', false);
            $('#r-no-2').attr('disabled', false);
            $('#check-out-2').attr('disabled', false);
            $('#check-box-allotment').attr('disabled', false);
            $('#lb-allotment-2').attr('disabled', false);
            $('.add_room2').hide();
            FLG_Add_MoreRoom1 = false;
        }


    }
    function check_lc(type) {
        if (type == "1") {
            var check_out = $('#check-out-1').val();
        }
        if (type == "2") {
            var check_out = $('#check-out-2').val();
        }
        if (type == "3") {
            var check_out = $('#lc-add-more').val();
        }
        if (type == "4") {
            var check_out = $('#lc-add-more2').val();
        }
        var dt = {
            check_out: check_out
        };
        //alert($('#check-out-1').val());
        if (check_out != "") {
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/check_lc'); ?>",
                async: true,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function (data) {
                    $.each(data, function (key, opj) {
                        if (key == "msg") {
                            if (opj != "") {
                                if (type == "1") {
                                    $('#check-out-1').html("12:00");
                                }
                                if (type == "2") {
                                    $('#check-out-2').html("12:00");
                                }
                                if (type == "3") {
                                    $('#lc-add-more').html("12:00");
                                }
                                if (type == "4") {
                                    $('#lc-add-more2').html("12:00");
                                }
                                //$('check-out-1').html("12:00");
                                window.alert(opj);
                            }
                        }

                    });

                }
            });
        }
    }
    function update_booking_list() {     
        var location = $("#location").val();
        var city = $("#city").val();
        var hotel = $("#hotel").val();
        var note = $("#note-bk").val();
        var TLTCode = $("#booking-" + key + " td:nth-child(3)").html();       
        var Allotment1 = "";
        var Allotment2 = "";
        var HoilidaySum1;
        var CheckOut1;
        var HTL_Total1;
        var LC1;
        var HTL_Total2;
        var LC2;
        var CheckOut2;
        /*stage 1*/
        var vn_flight_1 = $("#VN-Flight1").val();
        var arrv_date_1 = $("#arrv-date-1").val();
        var dept_date_1 = $("#dept-date-1").val();
        var nite_no_1 = $("#nite-no-1").val();
        var no_pax_1 = $("#pax-no-1").val();
        var room_no_1 = $("#r-no-1").val();
        var check_out_1 = $("#check-out-1").val();
        var note1 = $("#note-booking-1").val();
        var room_type_1 = $("#r-type-1").val();
        var room_class_1 = $("#r-class-1").val();
        var hotel_status_1 = $("#hotel-status-1").val();
        var holiday1 = $('#holiday-no-1').val();
        var op1 = $('#op1').val();
        var SPE1 = $("#check-box-1").prop('checked');        
        /*end stage 1*/
        /*stage 2*/
        var no_pax_2 = $("#pax-no-2").val();
        var arrv_date_2 = $("#arrv-date-2").val();
        var dept_date_2 = $("#dept-date-2").val();
        var nite_no_2 = $("#nite-no-2").val();
        var room_no_2 = $("#r-no-2").val();
        var check_out_2 = $("#check-out-2").val();
        var note2 = $("#note-booking-2").val();
        var room_type_2 = $("#r-type-2").val();
        var room_class_2 = $("#r-class-2").val();
        var hotel_status_2 = $("#hotel-status-2").val();
        var vn_flight_2 = $("#VN-Flight2").val();
        var op2 = $('#op2').val();
        var holiday2 = $('#holiday-no-2').val();
        var SPE2 = $("#check-box-2").prop('checked');
        /*end stage 2*/
       
        /*check date 1 and date 2*/
        var flag_date = false;
        if (arrv_date_1 != "" && dept_date_1 != "") {
            var dt = {
                arr_date: arrv_date_1,
                dept_date: dept_date_1
            };
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/chck_date'); ?>",
                async: false,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data) {
                    $.each(data, function(key, opj) {
                        if (key == "msg" && opj != "") {
                            alert(opj);
                            flag_date = true;
                        } else if (key == "date_arr" && opj != "") {
                            $("#arrv-date-1 > div > input").focus();
                            $("#arrv-date-1").val(opj);

                        } else {
                            if (opj != "") {
                                $("#dept-date-1 > div > input").focus();
                                $("#dept-date-1").val(opj);

                            }
                        }
                    });
                }
            });
        }
        if (arrv_date_2 != "" && dept_date_2 != "") {
            var dt = {
                arr_date: arrv_date_2,
                dept_date: dept_date_2
            };
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/chck_date'); ?>",
                async: false,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data) {
                    $.each(data, function(key, opj) {
                        if (key == "msg" && opj != "") {
                            alert(opj);
                            flag_date = true;
                        } else if (key == "date_arr" && opj != "") {
                            $("#arrv-date-2 > div > input").focus();
                            $("#arrv-date-2").val(opj);
                        } else {
                            if (opj != "") {
                                $("#dept-date-2 > div > input").focus();
                                $("#dept-date-2").val(opj);
                            }
                        }
                    });
                }
            });
        }
        if(flag_date){
           return false;
        }           
        /*end check date 1 and date 2*/
        if (hotel == "" || city == "") {
            error3 = "Please select the hotel.";
            $("#city").focus();
        }     
        /*check box allotment 1*/
        if ($("#check-box-allotment-1").prop('checked') == true) {
            var date1 = new Date(arrv_date_1);                
            var date2 = new Date(dept_date_1);/**/                
            if (date2 - date1 <= 0) {
               alert("Please try again date to have allotment at Stage 1");
               return false;
            } else if (room_type_1.trim() == "") {
               alert("Please Choose Room Type1, Not Empty");
               return false;                    
            } else if (room_class_1.trim() == "") {
               alert("Please Choose Room Class1, Not Empty");
               return false;                    
            } else if (arrv_date_1.trim() == "" || dept_date_1.trim() == "") {
               alert("ArrvDate1 and DeptDate1 can`t empty");
               return false;                   
            } else if ($('#allotment-1').val() == "" || $('#allotment-1').val() == "0") {
               alert("Please Enter Allotment Room No1");
               return false;                    
            } 
            /* check allotment database */ 
           var flag_allotment1 = false;
           var dt = {
                    city: city,
                    hotel: hotel,
                    arrv_date: arrv_date_1,
                    dept_date: dept_date_1,
                    room_no : $("#allotment-1").val(),
                    r_class : $("#r-class-1").val()
                };                    
          $.ajax({
              url: "<?php echo base_url('HotelBookingController/check_allotment'); ?>",
              async: false,
              type: "POST",
              data: dt,
              dataType: "json",              
              success: function(data) {
                 if(data.msg !=""){
                    flag_allotment1 = true;
                    alert(data.msg);
                 }
                 else{
                    Allotment1 = data.AllotmentID + "-" + dt.arrv_date + "-" + dt.dept_date + "-" + dt.room_no;
                 }
              }
          });
          if(flag_allotment1){
            return false;
          }
          /*end check database*/
        }        
        /*end check box allotment 1*/     
        /*check box allotment 2*/
        if ($("#check-box-allotment-2").prop('checked') == true) {
            var date1 = new Date(arrv_date_1);                
            var date2 = new Date(dept_date_1);/**/                
            if (date2 - date1 <= 0) {
               alert("Please try again date to have allotment at Stage 1");
               return false;
            } else if (room_type_2.trim() == "") {
               alert("Please Choose Room Type1, Not Empty");
               return false;                    
            } else if (room_class_2.trim() == "") {
               alert("Please Choose Room Class1, Not Empty");
               return false;                    
            } else if (arrv_date_2.trim() == "" || dept_date_2.trim() == "") {
               alert("ArrvDate1 and DeptDate1 can`t empty");
               return false;                   
            } else if ($('#allotment-2').val() == "" || $('#allotment-2').val() == "0") {
               alert("Please Enter Allotment Room No1");
               return false;                    
            } 
            /* check allotment database */ 
           var flag_allotment2 = false;
           var dt = {
                    city: city,
                    hotel: hotel,
                    arrv_date: arrv_date_2,
                    dept_date: dept_date_2,
                    room_no : $("#allotment-2").val(),
                    r_class : $("#r-class-2").val()
                };                    
          $.ajax({
              url: "<?php echo base_url('HotelBookingController/check_allotment'); ?>",
              async: false,
              type: "POST",
              data: dt,
              dataType: "json",              
              success: function(data) {
                 if(data.msg !=""){
                    flag_allotment2 = true;
                    alert(data.msg);
                 }
                 else{
                    Allotment2 = data.AllotmentID + "-" + dt.arrv_date + "-" + dt.dept_date + "-" + dt.room_no;                   
                 }
              }
          });
          if(flag_allotment2){
            return false;
          }
          /*end check database*/
        }        
        /*end check box allotment 2*/


        if (no_pax_1 == "") {
            no_pax_1 = 0;
        }
        if (nite_no_1 == "") {
            nite_no_1 = 0;
        }

        if (no_pax_2 == "") {
            no_pax_2 = 0;
        }
        if (nite_no_2 == "") {
            nite_no_2 = 0;
        }        

        if (room_type_1 != "" && room_class_1 != "") {
            if ($("#check-out-1").val() == "") {
                CheckOut1 = "0:00";
            }
            else {
                CheckOut1 = check_out_1;
            }
            if ($("#check-box-1").prop('checked') == true) {
                var dt = {
                    city: city,
                    hotel: hotel,
                    r_class: room_class_1,
                    r_type: room_type_1,
                    check_out: CheckOut1,
                    room_no_1: room_no_1,
                    nite_no_1: nite_no_1,
                    pax_no_1: no_pax_1,
                    spe: SPE1
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_room_list'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function (data) {
                        //debugger;
                        alert(data.httotal);
                        HTL_Total1 = data.httotal;
                        LC1 = data.lc;
                    }
                });
            }
            else {
                HTL_Total1 = "";
                LC1 = "";
            }

        }
        else {
            HTL_Total1 = "";
            LC1 = "";
        }
        var Tranfer_Price1 = GetTransferPrice(op1);


        if (room_type_2 != "" && room_class_2 != "") {
            if ($("#check-out-2").val() == "") {
                CheckOut2 = "0:00";
            }
            else {
                CheckOut2 = check_out_2;
            }
            if ($("#check-box-1").prop('checked') == true) {
                var dt = {
                    city: city,
                    hotel: hotel,
                    r_class: room_class_2,
                    r_type: room_type_2,
                    check_out: CheckOut2,
                    room_no_1: room_no_2,
                    nite_no_1: nite_no_2,
                    pax_no_1: no_pax_2,
                    spe: SPE2
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_room_list'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function (data) {
                        //debugger;
                        HTL_Total2 = data.httotal;
                        LC2 = data.lc;
                    }
                });
            }
            else {
                HTL_Total2 = "";
                LC2 = "";
            }
        }
        else {
            HTL_Total2 = "";
            LC2 = "";
        }
        var Tranfer_Price2 = GetTransferPrice(op2);
        LC1 = LC1 + "-" + Tranfer_Price1 + "-";
        LC2 = LC2 + "-" + Tranfer_Price2 + "-";

        key = select_booking;
        /*hotel info*/
        $("#booking-" + key + " td:nth-child(1)").html(city);
        $("#booking-" + key + " td:nth-child(2)").html(hotel);
        $("#booking-" + key + " td:nth-child(3)").html(TLTCode);
        $("#booking-" + key + " td:nth-child(4)").html(note);
        /*From HCM*/
        $("#booking-" + key + " td:nth-child(5)").html(vn_flight_1);
        /*Back HCM*/
        $("#booking-" + key + " td:nth-child(6)").html(vn_flight_2);
        /*Stage 1*/
        $("#booking-" + key + " td:nth-child(7)").html(arrv_date_1);
        $("#booking-" + key + " td:nth-child(8)").html(dept_date_1);
        $("#booking-" + key + " td:nth-child(9)").html(nite_no_1);
        $("#booking-" + key + " td:nth-child(10)").html(no_pax_1);
        $("#booking-" + key + " td:nth-child(11)").html(check_out_1);
        $("#booking-" + key + " td:nth-child(12)").html(room_no_1);
        $("#booking-" + key + " td:nth-child(13)").html(room_type_1);
        $("#booking-" + key + " td:nth-child(14)").html(room_class_1);
        $("#booking-" + key + " td:nth-child(15)").html(Allotment1);
        $("#booking-" + key + " td:nth-child(16)").html(hotel_status_1);
        $("#booking-" + key + " td:nth-child(17)").html(note1);
        $("#booking-" + key + " td:nth-child(18)").html(HTL_Total1);
        $("#booking-" + key + " td:nth-child(19)").html(LC1);

        /*Stage 2*/
        $("#booking-" + key + " td:nth-child(20)").html(arrv_date_2);
        $("#booking-" + key + " td:nth-child(21)").html(dept_date_2);
        $("#booking-" + key + " td:nth-child(22)").html(nite_no_2);
        $("#booking-" + key + " td:nth-child(23)").html(no_pax_2);
        $("#booking-" + key + " td:nth-child(24)").html(check_out_2);
        $("#booking-" + key + " td:nth-child(25)").html(room_no_2);
        $("#booking-" + key + " td:nth-child(26)").html(room_type_2);
        $("#booking-" + key + " td:nth-child(27)").html(room_class_2);
        $("#booking-" + key + " td:nth-child(28)").html(Allotment2);
        $("#booking-" + key + " td:nth-child(29)").html(hotel_status_2);
        $("#booking-" + key + " td:nth-child(30)").html(note2);
        $("#booking-" + key + " td:nth-child(18)").html(HTL_Total2);
        $("#booking-" + key + " td:nth-child(19)").html(LC2);
        select_booking_list(key);
        $("#update-booking-list").attr("disabled", true);
        $("#delete-booking-list").attr("disabled", true);
        $(".btn-add").removeAttr("disabled");
        $("#city").val("");
        $("#hotel").val("");
        $("#VN-Flight1").val("");
        $("#VN-Flight2").val("");
        $("#arrv-date-1").val("");
        $("#dept-date-1").val("");
        $("#nite-no-1").val("");
        $("#pax-no-1").val("");
        $("#r-no-1").val("");
        $("#check-out-1").val("");
        $("#note-booking-1").val("");
        $("#r-type-1").val("");
        $("#r-class-1").val("");
        $("#hotel-status-1").val("");
        $("#arrv-date-2").val("");
        $("#dept-date-2").val("");
        $("#nite-no-2").val("");
        $("#pax-no-2").val("");
        $("#r-no-2").val("");
        $("#check-out-2").val("");
        $("#note-booking-2").val("");
        $("#r-type-2").val("");
        $("#r-class-2").val("");
        $("#hotel-status-2").val("");
        $("#op1").val("");
        $("#op2").val("");
        $("#note-bk").val("");
        $("#holiday-no-1").val("");
        $("#holiday-no-2").val("");
        $("#check-box-1").prop("checked", false);
        $("#check-box-2").prop("checked", false);

        $("#allotment_text_1").attr("hidden",true);
        $("#allotment-1").attr("hidden", true);
        $("#check-box-allotment-1").prop("checked",false);
        
        $("#allotment_text_2").attr("hidden",true);
        $("#allotment-2").attr("hidden", true);
        $("#check-box-allotment-2").prop("checked",false);
        FLG_Change = false;
    }
    function check_box_spe1(stage) {
        myclear_two();
        if (stage == "stage1") {
            if ($("#check-box-1").prop("checked") == true) {
                $("#holiday-no-1").val("0");
                $("#holiday-no-1").attr("readonly", true);
            }
            else {
                $("#holiday-no-1").attr("readonly", false);
            }
        }
        else if (stage == "stage2") {
            if ($("#check-box-2").prop("checked") == true) {
                $("#holiday-no-2").val("0");
                $("#holiday-no-2").attr("readonly", true);
            }
            else {
                $("#holiday-no-2").attr("readonly", false);
            }
        }


    }
    function myclear_two() {
        $("#rl-more-add").val("");
        $("#r-type-add").val("");
        $("#r-class-add").val("");
        $("#r-no-add").val("");
    }
    function GetTransferPrice(op1) {
        if (op1 != "") {
            var result = "";
            var tranferID = op1;
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/GetTransferPrice'); ?>",
                type: "POST",
                data: "tranferID=" + op1,
                async: false,
                success: function (data) {
                    result = data;
                }
            });
        }
        else {
            result = "";
        }

        return result;
    }
    function change_flag() {
        FLG_Change = true;
    }

    function initGuest(disabled) {
        var row_insert_guide = "";
        row_insert_guide += "<tr id='guide-" + lastid_guide + "' data-id=\"" + lastid_guide + "\"class=\"new_guide_table\" >";
        row_insert_guide += "<td style='width:20px'><div class='glyphicon glyphicon-pencil icon-edit'></div></td>";
        row_insert_guide += "<td style='width:266px'><input";
        if (disabled) row_insert_guide += " disabled='true' ";
        row_insert_guide += " data-id='" + lastid_guide + "' id='guidename" + lastid_guide + "' type='text' value='' onchange='getguide()' onkeyup=\"keyup_guide(" + lastid_guide + ")\"></td>";
        row_insert_guide += "</tr>";
        lastid_guide++;
        $("#table-guide tbody").html(row_insert_guide);
    }

    function clearStage(tabindex) {
        $("input[name=arrv-date-" + tabindex + "]").val("");
        $("input[name=dept-date-" + tabindex + "]").val("");
        $("#nite-no-" + tabindex).val("");
        $("#pax-no-" + tabindex).val("");
        $("#holiday-no-" + tabindex).val("");
        $("#r-type-" + tabindex).val("");
        $("#r-class-" + tabindex).val("");
        $("#r-no-" + tabindex).val("");
        $("#check-out-" + tabindex).val("");

        if (($("#menu_1").hasClass("active") && $("#add-room-1").is(":visible") == false) || ($("#menu_2").hasClass("active") && $("#add-room-2").is(":visible") == false)) {
            $("#r-type-" + tabindex).prop("disabled", false);
            $("#r-class-" + tabindex).prop("disabled", false);
            $("#r-no-" + tabindex).prop("disabled", false);
            $("#check-out-" + tabindex).prop("disabled", false);
        } else {
            $("#r-type-" + tabindex).prop("disabled", true);
            $("#r-class-" + tabindex).prop("disabled", true);
            $("#r-no-" + tabindex).prop("disabled", true);
            $("#check-out-" + tabindex).prop("disabled", true);
        }

        $("#hotel-status-" + tabindex).val("");
        $("#op" + tabindex).val("");
        $("#check-box-" + tabindex).prop("checked", false);
        $("#check-box-allotment-" + tabindex).prop("checked", false);
        $('#allotment-' + tabindex).attr('hidden', true);
        $("#note-booking-" + tabindex).val("");
        // $("#add-room-"+tabindex).hide();
    }
</script>
<?php echo $this->load->view('Layout/footer'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        disableMenu();
    });
    $(document).ready(function () {
        $('#menu_1, #menu_2').click(function () {
            $('#add-room-1, #add-room-2').css('display', 'none');
        });
    });
</script>