<?php echo $this->load->view('Layout/header')?>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h4>Update Tour</h4>
			</div>
			<div class="col-md-4">
				<div class="form-inline form-margin-bottom"
					style="padding-top: 5px;">
					<div class="form-group">
						<label class="" style="color: red;">Select Location</label> <select
							class="form-control input-sm select-size" disabled id="location">
							<option
								value="<?php echo ($tour_info)?$tour_info[0]["Location_Code"]:"" ?>"><?php echo ($tour_info)?$tour_info[0]["Location_name"]:"" ?></option>
						</select>
						<button class="btn btn-sm button-sm btn-primary"
							onclick="back_home()">Back</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Tour Request</label>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Tour Code</label> <input type="hidden"
							id="type-srch" class="form-control select-size"
							value="<?php if(isset($type_sr)){echo $type_sr;}else{echo '';}?>"
							style="height: 25px;"> <input type="hidden" id="type-back"
							class="form-control select-size"
							value="<?php if(isset($type)){echo $type;}else{echo '';}?>"
							style="height: 25px;"> <input type="text" id="tour-code"
							class="form-control select-size"
							value="<?php echo ($tour_info)?$tour_info[0]["TourCode"]:"" ?>"
							style="height: 25px;"> <input type="hidden" id="id"
							class="form-control input-sm select-size"
							value="<?php echo ($tour_info)?$tour_info[0]["TourID"]:"" ?>"> <input
							type="hidden" id="room-list-1"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["Room_List1"];}?>"> <input
							type="hidden" id="room-list-2"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["Room_List2"];}?>"> <input
							type="hidden" id="list-check-out-1"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="list-check-out-2"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="tltcode"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["TLTCode"];}else{echo "";}?>">
						<input type="hidden" id="from-hcm-date"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["VNFlight1DeptDate"];}else{echo "";}?>">
						<input type="hidden" id="from-hcm-dept-time"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["VNFlight1DeptTime"];}else{echo "";}?>">
						<input type="hidden" id="from-hcm-arrv-time"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["VNFlight1ArrvTime"];}else{echo "";}?>">
						<input type="hidden" id="back-hcm-date"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["VNFlight2DeptDate"];}else{echo "";}?>">
						<input type="hidden" id="back-hcm-dept-time"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["VNFlight2DeptTime"];}else{echo "";}?>">
						<input type="hidden" id="back-hcm-arrv-time"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["VNFlight2ArrvTime"];}else{echo "";}?>">
						<input type="hidden" id="ex-stage1-allotment"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["Allotment1_Old"];}else{echo "";}?>">
						<input type="hidden" id="ex-stage2-allotment"
							class="form-control input-sm select-size"
							value="<?php if($booking){echo $booking[0]["Allotment2_Old"];}else{echo "";}?>">
						<input type="hidden" id="class-name-1"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="class-name-2"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="hotel-price-1"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="hotel-price-2"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="htl-total-1"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="htl-total-2"
							class="form-control input-sm select-size" value=""> <input
							type="hidden" id="lc-1" class="form-control input-sm select-size"
							value=""> <input type="hidden" id="lc-2"
							class="form-control input-sm select-size" value="">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">VN Code</label> <input type="text"
							id="vn-code" class="form-control select-size"
							value="<?php echo ($tour_info)?$tour_info[0]["VnCode"]:"" ?>"
							style="height: 25px;">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Group Name</label> <input type="text"
							id="group-name" class="form-control select-size"
							value="<?php echo ($tour_info)?$tour_info[0]["GroupName"]:"" ?>"
							style="height: 25px;">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Status</label> <select id="tour-status"
							class="form-control input-sm select-size-sm"
							style="height: 25px;">
                     <?php
                    if ($tourstatus) {
                        foreach ($tourstatus as $tourstatus) {
                            ?>
                     <option
								value="<?php echo $tourstatus['TourStatus']?>"
								<?php if($tourstatus['TourStatus']==$tour_info[0]["TourStatus"]){ echo "selected"; } ?>><?php echo $tourstatus['TourStatus']?></option>
                     <?php }}?>
                  </select>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Campaign</label> <select id="campaign"
							class="form-control input-sm select-size" style="height: 25px;">
							<option value=""></option>
                     <?php
                    if ($campaign) {
                        foreach ($campaign as $campaign) {
                            if ($tour_info) {
                                ?>
                     <option value="<?php echo $campaign['Cam_Code']?>"
								<?php if($tour_info[0]['Cam_Code']==$campaign['Cam_Code']){echo "selected='true'";}?>><?php echo $campaign['Cam_Name']?></option>
                     <?php
                            } else {
                                ?>
                     <option value="<?php echo $campaign['Cam_Code']?>"><?php echo $campaign['Cam_Name']?></option>
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
						<label class="label-item">Note</label> <input type="text"
							id="note-tour" class="form-control select-size"
							value="<?php echo ($tour_info)?$tour_info[0]["Note"]:"" ?>"
							style="height: 25px;">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="list-scroll" style="height: 100px;">
						<input id="id-guide" type="hidden"
							value="<?php echo ($max_guest)?$max_guest:""; ?>">
						<table id="table-guide" class="table table-fixed"
							style="height: 258px;" onchange="get_pax_no()">
							<thead style="width: 286px;">
								<tr>
									<td style="width: 20px"></td>
									<td style='width: 266px;'>Guest Name</td>
								</tr>
							</thead>
							<tbody style="width: 286px; height: 85%">
                        <?php
                        if ($guest) {
                            foreach ($guest as $row) {
                                ?>
                        <tr id="guide-<?php echo $row['GuestID']?>"
									onclick="editing_guide(<?php echo $row['GuestID']?>)"
									class="guide_table">
									<td style="width: 20px">
										<div class="glyphicon glyphicon-pencil icon-edit"></div>
									</td>
									<td style="width: 266px"><input
										data-id="<?php echo $row['GuestID']?>"
										id="guidename<?php echo $row['GuestID']?>" type="text"
										value="<?php echo $row['GuestName']?>"></td>
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
			<div class="col-md-1">
				<button class="btn btn-sm button-md btn-primary btn-action"
					onclick="clear_form()">Clear</button>
			</div>
		</div>
		<br>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Booking Detail</label>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group form-inline">
						<label for="sel1" class="label-item">City</label> <select
							id="city" class="form-control input-sm select-size"
							style="height: 25px;" onchange="get_rtypeandrclass()">
							<option value=""></option>
                     <?php
                    if ($city) {
                        foreach ($city as $city) {
                            if ($booking) {
                                ?>
                     <option value="<?php echo $city['city']?>"
								<?php if($city['city']==$booking[0]["City"]){ echo "selected"; }?>><?php echo $city['city']?></option>
                     <?php

} else {
                                ?>
                     <option value="<?php echo $city['city']?>"><?php echo $city['city']?></option>
                     <?php }}}?>
                  </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline">
						<label for="sel1" class="label-item">Hotel</label> <select
							id="hotel" class="form-control input-sm select-size"
							style="height: 25px;" onchange="get_rtypeandrclass()">
							<option value=""></option>
                     <?php
                    if ($hotel) {
                        foreach ($hotel as $key => $value) {
                            if ($booking) {

                                ?>
                     <option value="<?php echo $value['HotelName'];?>"
								<?php if($value['HotelName']==$booking[0]["Hotel"]){ echo "selected='true'"; }?>><?php echo $value['HotelName']?></option>
                     <?php
                            } else {
                                ?>
                     <option value="<?php echo $value['HotelName']?>"><?php echo $value['HotelName']?></option>
                     <?php
                            }
                        }
                    }
                    ?>
                  </select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-sm">Note</label> <input id="note-bk"
								style="width: 450px;" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6" hidden id="from">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-sm">From</label> <input id="VN-Flight1"
								style="width: 450px;" />
						</div>
					</div>
				</div>
				<div class="col-md-6" hidden id="back">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-sm">Back</label> <input id="VN-Flight2"
								style="width: 450px;" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="container">
					<ul class="nav nav-tabs" style="background-color: #f5f5f5;">
						<li id='menu_1' class="active"><a data-toggle="tab" href="#menu1"
							style="background-color: #A9A9A9;">Stage 1</a></li>
						<li id='menu_2'><a data-toggle="tab" href="#menu2"
							style="background-color: #D3D3D3;">Stage 2</a></li>
					</ul>
					<div class="tab-content">
						<div id="menu1" class="tab-pane fade in active">
							<div class="form-inline form-margin-bottom"
								style="background-color: #A9A9A9; padding: 0px 10px;">
								<div class="form-group">
									<label class="label-item">Arr Date</label>
                           <?php if($booking){?>
                           <div id="arrv-date-1"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="arrv-date-1"
										data-input="form-control input-sm"
										data-date="<?php echo $booking[0]["ArrvDate1"];?>"
										onchange="get_niteno_paxno('stage1')"></div>
                           <?php }else{?>
                           <div id="arrv-date-1"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="arrv-date-1"
										data-input="form-control input-sm"
										data-date="<?php echo date("Y/m/d");?>"
										onchange="get_niteno_paxno('stage1')"></div>
                           <?php }?>
                        </div>
								<div class="form-group">
									<label class="label-item">Dept Date</label>
                           <?php if($booking){?>
                           <div id="dept-date-1"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="dept-date-1"
										data-input="form-control input-sm"
										data-date="<?php echo $booking[0]["DeptDate1"];?>"
										onchange="get_niteno_paxno('stage1')"></div>
                           <?php }else{?>
                           <div id="dept-date-1"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="dept-date-1"
										data-input="form-control input-sm"
										data-date="<?php echo date("Y/m/d");?>"
										onchange="get_niteno_paxno('stage1')"></div>
                           <?php }?>
                        </div>
								<div class="form-group">
									<label class="label-item-sm"
										style="color: red; font-size: 10px">SPE <input type="checkbox"
										id="check_spe1"></label>
								</div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Nite No</label>
                           <?php if($NiteNo!=0){?>
                           <input type="text" size=1 class="check_num"
										id="nite-no-1" value="<?php echo $NiteNo;?>">
                           <?php }else{?>
                           <input type="text" class="check_num" size=1
										id="nite-no-1" value="">
                           <?php }?>
                        </div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Pax No</label> <input
										type="text" size=1 id="pax-no-1" class="check_num"
										value="<?php if($booking){echo $booking[0]['PaxNo1'];}?>">
								</div>
								<div class="form-group form-inline">
									<label class="label-item-md">Holiday No</label> <input
										type="text" size=1 id="holiday-no-1" class="check_num">
								</div>
								<div class="form-group form-inline">
									<label class="" style="margin-left: 10px; font-size: 12px">Note</label>
								</div>
								<div class="form-group form-inline">
									<textarea id="note-booking-1" rows="2"
										style="margin-top: 10px;" cols="30"></textarea>
								</div>
								<div class="form-group">
									<label class="label-item">R/Type</label> <select
										class="form-control input-sm select-size-sm" id="r-type-1"
										style="height: 25px;" onchange="">
										<option value=""></option>
                              <?php
                            if ($rtype) {
                                foreach ($rtype as $value) {
                                    if ($booking) {
                                        ?>
                              <option value="<?php echo $value ?>"
											<?php if($value==$booking[0]["RoomType1"]){ echo "selected"; }?>><?php echo $value ?></option>
                              <?php

} else {
                                        ?>
                              <option value="<?php echo $value ?>"><?php echo $value ?></option>
                              <?php }}}?>
                           </select>
								</div>
								<div class="form-group">
									<label class="label-item">R/Class</label> <select
										class="form-control input-sm select-size-sm" id="r-class-1"
										style="height: 25px;">
										<option value=""></option>
                              <?php
                            if ($rclass) {
                                foreach ($rclass as $value) {
                                    if ($booking) {
                                        ?>
                              <option value="<?php echo $value ?>"
											<?php if($value==$booking[0]["RoomClass1"]){ echo "selected"; }?>><?php echo $value ?></option>
                              <?php

} else {
                                        ?>
                              <option value="<?php echo $value ?>"><?php echo $value ?></option>
                              <?php }}}?>
                           </select>
								</div>
								<div class="form-group">
									<label class="label-item-sm ">R/No</label>
                           <?php if($booking){?>
                           <input type="text" size=1 id="r-no-1"
										class="check_num" value="<?php echo $booking[0]["RoomNo1"];?>">
                           <?php }else{?>
                           <input type="text" size=1 id="r-no-1"
										class="chung check_num">
                           <?php }?>
                        </div>
								<div class="form-group ">
									<label class="" style="font-size: 12px;">L/C</label> <input
										type="text" size=3 class="check_time" id="check-out-1"
										value="<?php if($booking){if($booking[0]['CheckOut1']!="" && $booking[0]['CheckOut1']!="NULL"){echo $booking[0]['CheckOut1'];}}else{echo '';}?>">
								</div>
								<button class="btn btn-primary btn-action"
									style="width: 60px; height: 30px;" onclick="more_room()">More</button>
								<div class="form-group">
									<label class="" style="font-size: 12px;">Status</label> <select
										class="form-control input-sm select-size-sm"
										style="height: 25px;" id="hotel-status-1">
										<option value=""></option>
                              <?php if($booking){?>
                              <option value="OK"
											<?php if("OK"==$booking[0]["HotelStatus1"]){ echo "selected"; }?>>OK</option>
										<option value="WT"
											<?php if("WT"==$booking[0]["HotelStatus1"]){ echo "selected"; }?>>WT</option>
										<option value="CXL"
											<?php if("CXL"==$booking[0]["HotelStatus1"]){ echo "selected"; }?>>CXL</option>
										<option value="CHG"
											<?php if("CHG"==$booking[0]["HotelStatus1"]){ echo "selected"; }?>>CHG</option>
                              <?php }else{?>
                              <option value="OK">OK</option>
										<option value="WT">WT</option>
										<option value="CXL">CXL</option>
										<option value="CHG">CHG</option>
                              <?php }?>
                           </select>
								</div>
								<div class="form-group">
									<label style="witdh: 30px; font-size: 13px">Transfer Stage</label>
									<select class="form-control input-sm select-size-sm" id="op1">
										<option value=""></option>
                              <?php if($transfer){foreach($transfer as $row){?>
                              <option
											value="<?php echo $row['Location'];?>"><?php echo $row['Content'];?></option>
                              <?php }}?>
                           </select>
									<div class="form-group form-inline" style="width: 75px;">
										<label class="label-item" id="lb-allotment-1" hidden>Allotment</label>
									</div>
									<input type="checkbox" id="check-box-allotment"
										onchange="allotment_change()" /> <input type="text" size=1
										id="allotment-1" class="chung" hidden>
								</div>
								<button class="btn btn-primary button-sm btn-sm btn-action"
									style="float: right;" onclick="clear_booking()">CLear</button>
							</div>
							<div class="row add_room active"
								style="background-color: #FFFF99; margin-left: 0px; margin-right: 0px;"
								id="add-room-1">
								<label class="col-md-12"><span style="color: red;">Add more room</span></label>
								<div class="col-md-12"
									style="padding-left: 0px; padding-right: 0px; margin-left: -5px; margin-right: -5px; margin-top: 10px; height: 35px">
									<div class="form-inline col-md-2" style="">
										<label class="label-item-sm">R/Type</label> <select
											class="form-control input-sm select-size-sm" id="r-type-add"
											style="height: 25px;">
											<option value=""></option>
                                 <?php
                                if ($rtype) {
                                    foreach ($rtype as $value) {
                                        ?>
                                 <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                 <?php }}?>
                              </select>
									</div>
									<div class="form-inline col-md-2">
										<label class="label-item-sm">R/Class</label> <select
											class="form-control input-sm select-size-sm" id="r-class-add"
											style="height: 25px; width: 20px;">
											<option value=""></option>
                                 <?php
                                if ($rclass) {
                                    foreach ($rclass as $value) {
                                        ?>
                                 <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                 <?php }}?>
                              </select>
									</div>
									<div class="form-group form-inline col-md-1">
										<label class="label-item-sm "> R/No </label> <input
											type="text" id="r-no-add" class="check_num"
											style="width: 20px;">
									</div>
									<div class="form-group form-inline col-md-2">
										<label class="label-item-sm" style="margin-left: 5px;">L/C</label>
										<input type="text" style="width: 40px;" id="lc-add"
											class="check_time check_num" value="">
									</div>
									<div class="form-group form-inline col-md-1">
										<label class="label-item-sm ">AR/No</label> <input type="text"
											style="width: 15px;" value="0" id="ar-no-add">
									</div>
									<div class="form-group form-inline col-md-2"
										style="padding-right: 0px; padding-left: 0px; margin-bottom: 0px; width: 22%">
										<button class="btn btn-primary btn-action"
											style="width: 45px; height: 30px;" onclick="Add_More_Room()">Add</button>
										<label class="label-item-sm" style="width: 60px;">Room List</label>
										<input type="text" size=4 id="r-l-add" class="chung"
											style="width: 130px;" onkeypress='validate(event)'>
									</div>
									<div class="col-md-2"
										style="width: 11%; text-align: right; padding: 0px; padding-right: 3px;">
										<button class="btn btn-primary btn-action"
											style="width: 55px; height: 30px;" onclick="clear_more()">Clear</button>
										<button class="btn btn-primary btn-action"
											style="width: 50px; height: 30px;" onclick="mr_room()">Ok</button>
									</div>
								</div>
							</div>
						</div>
						<div id="menu2" class="tab-pane fade">
							<div class="form-inline form-margin-bottom"
								style="background-color: #D3D3D3; padding: 0px 10px;">
								<div class="form-group">
									<label class="label-item">Arr Date</label>
                           <?php if($booking){?>
                           <div id="arrv-date-2"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="arrv-date-2"
										data-input="form-control input-sm"
										data-date="<?php echo $booking[0]["ArrvDate2"];?>"
										onchange="get_niteno_paxno('stage2')"></div>
                           <?php }else{?>
                           <div id="arrv-date-2"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="arrv-date-2"
										data-input="form-control input-sm"
										data-date="<?php echo date("Y/m/d");?>"
										onchange="get_niteno_paxno('stage2')"></div>
                           <?php }?>
                        </div>
								<div class="form-group">
									<label class="label-item">Dept Date</label>
                           <?php if($booking){?>
                           <div id="dept-date-2"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="dept-date-2"
										data-input="form-control input-sm"
										data-date="<?php echo $booking[0]["DeptDate1"];?>"
										onchange="get_niteno_paxno('stage2')"></div>
                           <?php }else{?>
                           <div id="dept-date-2"
										class="form-group bfh-datepicker select-size-md"
										data-placeholder="yyyy/mm/dd" data-format="y/m/d"
										data-align="right" data-name="dept-date-2"
										data-input="form-control input-sm"
										data-date="<?php echo date("Y/m/d");?>"
										onchange="get_niteno_paxno('stage2')"></div>
                           <?php }?>
                        </div>
								<div class="form-group">
									<label class="label-item-sm"
										style="color: red; font-size: 10px">SPE <input type="checkbox"
										id="check_spe"></label>
								</div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Nite No</label> <input
										type="text" size=1 id="nite-no-2" class="check_num">
								</div>
								<div class="form-group form-inline">
									<label class="" style="font-size: 12px">Pax No</label> <input
										type="text" class="check_num" size=1 id="pax-no-2"
										value="<?php if($booking){echo $booking[0]['PaxNo2'];}?>">
								</div>
								<div class="form-group form-inline">
									<label class="label-item-md">Holiday No</label> <input
										type="text" size=1 id="holiday-no-2" class="check_num">
								</div>
								<div class="form-group form-inline">
									<label class="" style="margin-left: 10px; font-size: 12px">Note</label>
								</div>
								<div class="form-group form-inline">
									<textarea id="note-booking-2" rows="2"
										style="margin-top: 10px;" cols="30" class=""></textarea>
								</div>
								<div class="form-group">
									<label class="label-item">R/Type</label> <select
										class="form-control input-sm select-size-sm chung"
										id="r-type-2" style="height: 25px;">
										<option value=""></option>
                              <?php
                            if ($rtype) {
                                foreach ($rtype as $value) {
                                    ?>
                              <option value="<?php echo $value ?>"><?php echo $value ?></option>
                              <?php }}?>
                           </select>
								</div>
								<div class="form-group">
									<label class="label-item">R/Class</label> <select
										class="form-control input-sm select-size-sm chung"
										id="r-class-2" style="height: 25px;">
										<option value=""></option>
                              <?php
                            if ($rclass) {
                                foreach ($rclass as $value) {
                                    ?>
                              <option value="<?php echo $value ?>"><?php echo $value ?></option>
                              <?php }}?>
                           </select>
								</div>
								<div class="form-group">
									<label class="label-item-sm ">R/No</label> <input type="text"
										size=1 id="r-no-2" class="chung check_num"
										value="<?php if($booking){echo $booking[0]['RoomNo2'];}?>">
								</div>
								<div class="form-group ">
									<label class="" style="font-size: 12px;">L/C</label> <input
										type="text" class="chung check_time check_num" size=3
										id="check-out-2"
										value="<?php if($booking){echo $booking[0]['CheckOut2'];}?>">
								</div>
								<button class="btn btn-primary btn-action"
									style="width: 60px; height: 30px;" onclick="more_room()">More</button>
								<div class="form-group">
									<label class="" style="font-size: 12px;">Status</label> <select
										class="form-control input-sm select-size-sm"
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
									</select> <label class="label-item" id="lb-allotment-2" hidden>Allotment</label>
									<input type="checkbox" id="check-box-allotment2"
										onchange="allotment_change2()" style="margin-left: 77px;" /> <input
										type="text" size=1 id="allotment-2" class="chung" hidden>
								</div>
								<button class="btn btn-primary button-sm btn-sm btn-action"
									style="float: right;" onclick="clear_booking()">CLear</button>
							</div>
							<div class="row add_room"
								style="background-color: #FFFF99; margin-left: 0px; margin-right: 0px;"
								id="add-room-2">
								<label class="col-md-12"><span style="color: red;">Add more room</span></label>
								<div class="col-md-12"
									style="padding-left: 10px; padding-right: 10px; margin-top: 10px; height: 35px;">
									<div class="form-inline col-md-2"
										style="padding-left: 0px; padding-right: 0px;">
										<label class="label-item-sm">R/Type</label> <select
											class="form-control input-sm select-size-sm"
											id="r-type-add-2" style="height: 25px;">
											<option value=""></option>
                                 <?php
                                if ($rtype) {
                                    foreach ($rtype as $value) {
                                        ?>
                                 <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                 <?php }}?>
                              </select>
									</div>
									<div class="form-inline col-md-2">
										<label class="label-item-sm">R/Class</label> <select
											class="form-control input-sm select-size-sm"
											id="r-class-add-2" style="height: 25px; width: 20px;">
											<option value=""></option>
                                 <?php
                                if ($rclass) {
                                    foreach ($rclass as $value) {
                                        ?>
                                 <option value="<?php echo $value;?>"><?php echo $value; ?></option>
                                 <?php }}?>
                              </select>
									</div>
									<div class="form-group form-inline col-md-1"
										style="padding: 0px">
										<label class="label-item-sm ">R/No</label> <input type="text"
											id="r-no-add2" class="check_num" style="width: 20px;">
									</div>
									<div class="form-group form-inline col-md-2">
										<label class="label-item-sm" style="margin-left: 5px;">L/C</label>
										<input type="text" style="width: 40px;" id="lc-add2"
											class="check_num check_time">
									</div>
									<div class="form-group form-inline col-md-1">
										<label class="label-item-sm ">AR/No</label> <input type="text"
											style="width: 15px;" value="0" id="ar-no-add2">
									</div>
									<div class="form-group form-inline col-md-2"
										style="padding-right: 0px; padding-left: 0px; margin-bottom: 0px; width: 22%">
										<button class="btn btn-primary btn-action"
											style="width: 45px; height: 30px;" onclick="Add_More_Room()">Add</button>
										<label class="label-item-sm" style="width: 60px;">Room List</label>
										<input type="text" size=4 id="r-l-add2" class="chung"
											style="width: 130px;" onkeypress='validate(event)'>
									</div>
									<div class="col-md-2"
										style="width: 11%; text-align: right; padding: 0px; padding-right: 3px;">
										<button class="btn btn-primary btn-action"
											style="width: 55px; height: 30px;" onclick="clear_more()">Clear</button>
										<button class="btn btn-primary btn-action"
											style="width: 50px; height: 30px;" onclick="mr_room()">Ok</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="row ">
					<div class="button-action-div  form-margin-bottom col-md-offset-3">
						<button class="btn btn-primary btn-sm btn-action btn-update"
							onclick="return update_booking()" id="update-booking-list"
							disabled="true">Update to Booking List</button>
						<button class="btn btn-primary btn-sm btn-action "
							onclick="delete_booking()" disabled="true"
							id="delete-booking-list">Delete Booking List</button>
						<button class="btn btn-primary btn-sm btn-action cc"
							onclick="clear_booking_list()" disabled="true"
							id="clear-booking-list">CLear</button>
						<button class="btn btn-primary btn-sm btn-action cc"
							disabled="true" onclick="return add_to_booking_list()"
							id="add-booking-list">Add to Booking List</button>
						<label style="color: blue;"><input type="checkbox" id="cke_bx">
							Add Booking List</label>
					</div>
				</div>
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Booking list</label>
					</div>
					<div class="list-scroll" style="height: 90px;">
						<table class="table table-fixed" id="table-booking-info">
							<thead style='background-color: #2d6ca2; color: white;'>
								<td style='min-width: 130px; max-width: 130px;'>City</td>
								<td style='min-width: 180px; max-width: 180px;'>Hotel</td>
								<td style='min-width: 100px; max-width: 100px;'>Arrv Date</td>
								<td style='min-width: 100px; max-width: 100px;'>Dept Date</td>
								<td style='min-width: 50px; max-width: 50px;'>Nite. No</td>
								<td style='min-width: 50px; max-width: 50px;'>Pax No</td>
								<td style='min-width: 180px; max-width: 180px;'>Check Out</td>
								<td style='min-width: 100px; max-width: 100px;'>Room Type</td>
								<td style='min-width: 100px; max-width: 100px;'>Status</td>
								<td style='min-width: 120px; max-width: 120px;'>Note</td>
							</thead>
							<tbody>
                        <?php
                        $key = 1;
                        if ($booking) {
                            foreach ($booking as $row) {
                                ?>
                        <tr id="booking-<?php echo $key;?>"
									onclick="select_booking_list(<?php echo $key;?>)">
									<td style="width: 130px; max-width: 130px;"><?php echo $row['City']?></td>
									<td style="width: 180px; max-width: 180px;"><?php echo $row['Hotel'];?></td>
									<td style="display: none;"><?php echo $row['TLTCode'];?></td>
									<td style="display: none;"><?php echo $row['Note'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight1'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight2'];?></td>
									<td style="width: 100px; max-width: 100px;"><?php echo $row['ArrvDate1']?></td>
									<td style="width: 100px; max-width: 100px;"><?php echo $row['DeptDate1']?></td>
									<td style="width: 50px; max-width: 50px;"><?php echo $row['NiteNo1']?></td>
									<td style="width: 50px; max-width: 50px;"><?php echo $row['PaxNo1']?></td>
									<td style='min-width: 180px; max-width: 180px;'><?php echo $row['CheckOut1']?></td>
									<td style="display: none;"><?php echo $row['RoomNo1'];?></td>
									<td style="width: 100px; max-width: 100px;"><?php echo $row['RoomType1']?></td>
									<td style="display: none;"><?php echo $row['RoomClass1'];?></td>
									<td style="display: none;"><?php echo $row['Allotment1'];?></td>
									<td style="width: 100px; max-width: 100px;"><?php echo $row['HotelStatus1']?></td>
									<td style="width: 120px; max-width: 120px;"><?php echo $row['Note1']?></td>
									<td style="display: none;"><?php echo $row['HTL_Total1'];?></td>
									<td style="display: none;"><?php echo $row['LC1'];?></td>
									<td style="display: none;"><?php echo $row['ArrvDate2'];?></td>
									<td style="display: none;"><?php echo $row['DeptDate2'];?></td>
									<td style="display: none;"><?php echo $row['NiteNo2'];?></td>
									<td style="display: none;"><?php echo $row['PaxNo2'];?></td>
									<td style="display: none;"><?php echo $row['CheckOut2'];?></td>
									<td style="display: none;"><?php echo $row['RoomNo2'];?></td>
									<td style="display: none;"><?php echo $row['RoomType2'];?></td>
									<td style="display: none;"><?php echo $row['RoomClass2'];?></td>
									<td style="display: none;"><?php echo $row['Allotment2'];?></td>
									<td style="display: none;"><?php echo $row['HotelStatus2'];?></td>
									<td style="display: none;"><?php echo $row['Note2']?></td>
									<td style="display: none;"><?php echo $row['HTL_Total2'];?></td>
									<td style="display: none;"><?php echo $row['LC2'];?></td>
									<td style="display: none;"><?php echo $row['Room_List1'];?></td>
									<td style="display: none;"><?php echo $row['Room_List2'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight1DeptDate'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight1DeptTime'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight1ArrvTime'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight2DeptDate'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight2DeptTime'];?></td>
									<td style="display: none;"><?php echo $row['VNFlight2ArrvTime'];?></td>
									<td style="display: none;"><?php echo $row['AllotmentList1_Old'];?></td>
									<td style="display: none;"><?php echo $row['AllotmentList2_Old'];?></td>
									<td style="display: none;"><?php echo $row['Transfer_price1'];?></td>
									<td style="display: none;"><?php echo $row['Transfer_price2'];?></td>
									<td style="display: none;"><?php echo $row['HoilidaySum1'];?></td>
									<td style="display: none;"><?php echo $row['HoilidaySum2'];?></td>
									<td style="display: none;"><?php echo $row['AllotmentList1'];?></td>
									<td style="display: none;"><?php echo $row['AllotmentList2'];?></td>
									<td style="display: none;"><?php echo $row['Allotment1_Old'];?></td>
									<td style="display: none;"><?php echo $row['Allotment2_Old'];?></td>
								</tr>
                        <?php
                                $key += 1;
                            }
                        }
                        ?>
                     </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1 col-md-offset-5">
			<div class="button-action-div">
				<button class="btn btn-primary button-sm btn-action"
					onclick="save_update_tour()">Save</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var select_tour = "";
    var select_booking = "";
    var idtour = $("#id").val()
    var data_arr_guide = new Array();
    var data_new_guide = new Array();
    var d = 0;
    var g = 0;
    var nc = 0;
    var ng = 0;
    var i_TLTCode = 0;
    var str_Static_VNCode = $("#vn-code").val();
    var HTL_Total1 = 0;
    var LC1 = 0;
    var HTL_Total2 = 0;
    var LC2 = 0;
    var str_Stage1_AllotmentID = "";
    var Stage1_RoomNo = 0;
    var Alloment_list1 = "";
    var Alloment_list2 = "";
    var str_Stage2_AllotmentID = "";
    var Stage2_RoomNo = 0;
    var Alloment_list2 = "";
    var delete_result = new Array();
    var Room_List1 = "";
    var Room_List2 = "";
    var flag_guest = 0;
    var dt_guest = new Array();
    var dt_id = new Array();
    var deleted_booking = new Array();
    var j = 0;
    $("#table-guide > tbody > tr > td > input").each(function() {
        if ($(this).val() != "") {
            dt_guest[j] = $(this).val();
            dt_id[j] = $(this).data('id');
            j = j + 1;
        }
    });

    $(document).ready(function() {
        disableMenu();
        var n = $("#table-booking-info > tbody > tr").length;
        if (n > 0) {
            select_booking_list(1);
        }
        $('#nite-no-1').keyup(function() {
            if ($('#nite-no-1').val() == 0) {
                var arr_date = $('input[name=arrv-date-1]').val();
                var dept_date = $('input[name=dept-date-1]').val();
                if (arr_date == '' || dept_date == '') {
                    $('#nite-no-1').val('');
                } else {
                    $('#nite-no-1').val(1);
                }
                return false;
            }
        });
        $('#nite-no-2').keyup(function() {
            if ($('#nite-no-2').val() == 0) {
                var arr_date = $('input[name=arrv-date-2]').val();
                var dept_date = $('input[name=dept-date-2]').val();
                if (arr_date == '' || dept_date == '') {
                    $('#nite-no-2').val('');
                } else {
                    $('#nite-no-2').val(1);
                }
                return false;
            }
        });

        $('#check_spe1').click(function() {
            if ($(this).is(':checked') == true) {
                $('#holiday-no-1').prop('disabled', true);
                $('#holiday-no-1').val(0);
            } else {
                $('#holiday-no-1').prop('disabled', false);
            }
        });
        $('#check_spe').click(function() {
            if ($(this).is(':checked') == true) {
                $('#holiday-no-2').prop('disabled', true);
            } else {
                $('#holiday-no-2').prop('disabled', false);
            }
        });
        //validate time
        flag_check_time = true;
        $('.check_time,.check_num').keypress(function(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9\b\t:]/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        });
        $('.check_time').blur(function(event) {
            var id = $(this).attr('id');
            var time = $(this).val();
            if (!isNaN(time) && (time >= 0 && time < 24) && time != '') {
                flag_check_time = true;
                if (time < 10) {
                    $(this).val('0' + time + ':00');
                } else {
                    $(this).val(time + ':00');
                }
            } else if (time != '') {
                array_time = time.split(':');
                if (array_time.length != 2 || array_time[0] >= 24 || array_time[0] < 0 || array_time[1] < 0 || array_time[1] > 59 || array_time[0].length != 2 || array_time[1].length != 2) {
                    flag_check_time = false;
                    alert('Time must be formartted as [HH:MM]');
                    setTimeout(function() {
                        $('#' + id).trigger('focus');
                    }, 1);
                }

            }
        });
        //get hotel by city
        $('.add_room').hide();

        var rowCount = $('#table-booking-info > tbody > tr').length;
        if (rowCount > 1) {
            $('#delete-booking-list').removeAttr("disabled");
            $('#update-booking-list').prop("disabled", false);
        } else if (rowCount == 1) {
            $('#update-booking-list').prop("disabled", false);
        } else {
            $('#update-booking-list').attr("disabled", true);
            $('#delete-booking-list').attr("disabled", true);
            $('#add-booking-list').attr("disabled", true);
            $('#clear-booking-list').attr("disabled", true);
            $("cke_bx").prop("checked", false);
        }


        $('#city').change(function() {
            var city = $(this).val();
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/ajax_call'); ?>",
                async: false,
                type: "POST",
                data: "city=" + city,
                dataType: "html",
                success: function(data) {
                    $('#hotel').html(data);
                }
            });

            $.ajax({
                url: "<?php echo base_url('HotelBookingController/load_transfer'); ?>",
                async: false,
                type: "POST",
                data: "city=" + city,
                dataType: "html",
                success: function(data) {
                    $('#op1').html(data);
                    $('#op2').html(data);
                }
            });
        });

        //
        var check;
        $("#cke_bx").on("click", function() {
            var rowCount = $('#table-booking-info tr').length;
            check = $("#cke_bx").is(":checked");
            if (check) {
                if (rowCount > 2) {
                    $('#delete-booking-list').prop("disabled", false);

                }
                if (rowCount > 1) {
                    $('#update-booking-list').prop("disabled", false);
                }
                $('.btn-update').attr('disabled', 'true');
                $('.cc').prop("disabled", false);
            } else {
                $('.cc').attr('disabled', 'true');
                $('.btn-update').prop('disabled', false);
            }
        });

        if ($('#menu_1').attr('class') == 'active') {
            $("#add-room-2").hide();
        } else {
            $("#add-room-1").hide();
        }
        //get r-class by hotel
        //////////
        lastid_guide = parseInt($("#id-guide").val());
        var row_insert_guide = "";
        row_insert_guide += "<tr id='guide-" + lastid_guide + "' data-id=\"" + lastid_guide + "\"class=\"new_guide_table\" >";

        row_insert_guide += "<td style='width:20px'><div class='glyphicon glyphicon-pencil icon-edit'></div></td>";
        row_insert_guide += "<td style='width:266px;'><input data-id='" + lastid_guide + "' id='guidename" + lastid_guide + "' type='text' value='' onchange='getguide()' onkeyup=\"keyup_guide(" + lastid_guide + ")\"></td>";
        row_insert_guide += "</tr>";
        lastid_guide++;
        $("#table-guide").find("tbody").html($("#table-guide").find("tbody").html() + row_insert_guide);

    });

    function show_info(key) {
        /*room list 1*/
        if ($("#booking-" + key + " td:nth-child(33)").html() != "" && $("#booking-" + key + " td:nth-child(33)").html() != "NULL") {
            $("#r-type-1").attr("disabled", true);
            $("#r-class-1").attr("disabled", true);
            $("#r-no-1").attr("disabled", true);
            $("#check-out-1").attr("disabled", true);
            $("#r-type-1").val("");
            $("#r-class-1").val("");
            $("#check-out-1").val("");
            $("#r-no-1").val("");
            $("#room-list-1").val($("#booking-" + key + " td:nth-child(33)").html());
        } else {
            $("#r-type-1").attr("disabled", false);
            $("#r-class-1").attr("disabled", false);
            $("#r-no-1").attr("disabled", false);
            $("#check-out-1").attr("disabled", false);
            $("#r-type-1").val("");
            $("#r-class-1").val("");
            $("#check-out-1").val("");
            $("#r-no-1").val("");
            $("#room-list-1").val("");
        }
        /*room list 2*/
        if ($("#booking-" + key + " td:nth-child(34)").html() != "" && $("#booking-" + key + " td:nth-child(34)").html() != "NULL") {
            $("#r-type-2").attr("disabled", true);
            $("#r-class-2").attr("disabled", true);
            $("#r-no-2").attr("disabled", true);
            $("#check-out-2").attr("disabled", true);
            $("#r-type-2").val("");
            $("#r-class-2").val("");
            $("#check-out-2").val("");
            $("#r-no-2").val("");
            $("#room-list-2").val($("#booking-" + key + " td:nth-child(34)").html());

        } else {
            $("#r-type-2").attr("disabled", false);
            $("#r-class-2").attr("disabled", false);
            $("#r-no-2").attr("disabled", false);
            $("#check-out-2").attr("disabled", false);
            $("#r-type-2").val("");
            $("#r-class-2").val("");
            $("#check-out-2").val("");
            $("#r-no-2").val("");
        }

        if ($("#booking-" + key + " td:nth-child(11)").html() != "" && $("#booking-" + key + " td:nth-child(11)").html() != "NULL") {
            $("#check-out-1").val($("#booking-" + key + " td:nth-child(11)").html());
        } else {
            $("#check-out-1").val("");
        }

        if ($("#booking-" + key + " td:nth-child(24)").html() != "" && $("#booking-" + key + " td:nth-child(24)").html() != "NULL") {
            $("#check-out-2").val($("#booking-" + key + " td:nth-child(24)").html());
        } else {
            $("#check-out-2").val("");
        }
        /*from hcm*/
        if ($("#booking-" + key + " td:nth-child(35)").html() != "" && $("#booking-" + key + " td:nth-child(35)").html() != "NULL") {
            $("#from-hcm-date").val($("#booking-" + key + " td:nth-child(35)").html());
        } else {
            $("#from-hcm-date").val("");
        }

        if ($("#booking-" + key + " td:nth-child(36)").html() != "" && $("#booking-" + key + " td:nth-child(36)").html() != "NULL") {
            $("#from-hcm-dept-time").val($("#booking-" + key + " td:nth-child(36)").html());
        } else {
            $("#from-hcm-dept-time").val("");
        }

        if ($("#booking-" + key + " td:nth-child(37)").html() != "" && $("#booking-" + key + " td:nth-child(37)").html() != "NULL") {
            $("#from-hcm-arrv-time").val($("#booking-" + key + " td:nth-child(37)").html());
        } else {
            $("#from-hcm-arrv-time").val("");
        }
        /*back HCM*/
        if ($("#booking-" + key + " td:nth-child(38)").html() != "" && $("#booking-" + key + " td:nth-child(38)").html() != "NULL") {
            $("#back-hcm-date").val($("#booking-" + key + " td:nth-child(38)").html());
        } else {
            $("#back-hcm-date").val("");
        }

        if ($("#booking-" + key + " td:nth-child(39)").html() != "" && $("#booking-" + key + " td:nth-child(39)").html() != "NULL") {
            $("#back-hcm-dept-time").val($("#booking-" + key + " td:nth-child(39)").html());
        } else {
            $("#back-hcm-dept-time").val("");
        }

        if ($("#booking-" + key + " td:nth-child(40)").html() != "" && $("#booking-" + key + " td:nth-child(40)").html() != "NULL") {
            $("#back-hcm-arrv-time").val($("#booking-" + key + " td:nth-child(40)").html());
        } else {
            $("#back-hcm-arrv-time").val("");
        }       
        /*Process Update Allotment*/
        if ($("#booking-" + key + " td:nth-child(41)").html() != "" && $("#booking-" + key + " td:nth-child(41)").html() != "NULL") {
            $("#ex-stage1-allotment").val($("#booking-" + key + " td:nth-child(41)").html());
        } else {
            $("#ex-stage1-allotment").val("");
        }

        if ($("#booking-" + key + " td:nth-child(42)").html() != "" && $("#booking-" + key + " td:nth-child(42)").html() != "NULL") {
            $("#ex-stage2-allotment").val($("#booking-" + key + " td:nth-child(42)").html());
        } else {
            $("#ex-stage2-allotment").val("");
        }
        /*Load RoomType and RoomClass*/
        var dt = {
            city: $("#city").val(),
            hotel: $("#hotel").val()
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
            $("#r-class-1").html("<option></option>");
            $("#r-class-2").html("<option></option>");
            $("#r-class-add").html("<option></option>");
            $("#r-class-add-2").html("<option></option>");
            $("#r-type-add-2").html("<option></option>");
        }

        /*Room Type stage 1 & 2*/
        if ($("#booking-" + key + " td:nth-child(13)").html() != "" && $("#booking-" + key + " td:nth-child(13)").html() != "NULL") {
            $("#r-type-1").val($("#booking-" + key + " td:nth-child(13)").html());
        } else {
            $("#r-type-1").val("");
        }

        if ($("#booking-" + key + " td:nth-child(26)").html() != "" && $("#booking-" + key + " td:nth-child(26)").html() != "NULL") {
            $("#r-type-2").val($("#booking-" + key + " td:nth-child(26)").html());
        } else {
            $("#r-type-2").val("");
        }
        /*Room Class stage 1 & 2*/
        if ($("#booking-" + key + " td:nth-child(14)").html() != "" && $("#booking-" + key + " td:nth-child(14)").html() != "NULL") {
            $("#r-class-1").val($("#booking-" + key + " td:nth-child(14)").html());
        } else {
            $("#r-class-1").val("");
        }

        if ($("#booking-" + key + " td:nth-child(27)").html() != "" && $("#booking-" + key + " td:nth-child(27)").html() != "NULL") {
            $("#r-class-2").val($("#booking-" + key + " td:nth-child(27)").html());
        } else {
            $("#r-class-2").val("");
        }
        /*Room No stage 1 & 2*/
        if ($("#booking-" + key + " td:nth-child(12)").html() != "" && $("#booking-" + key + " td:nth-child(12)").html() != "NULL") {
            $("#r-no-1").val($("#booking-" + key + " td:nth-child(12)").html());
        } else {
            $("#r-no-1").val("");
        }

        if ($("#booking-" + key + " td:nth-child(25)").html() != "" && $("#booking-" + key + " td:nth-child(25)").html() != "NULL") {
            $("#r-no-2").val($("#booking-" + key + " td:nth-child(25)").html());
        } else {
            $("#r-no-2").val("");
        }
        /*TLTCODE*/
        if ($("#booking-" + key + " td:nth-child(3)").html() != "" && $("#booking-" + key + " td:nth-child(3)").html() != "NULL") {
            $("#tltcode").val($("#booking-" + key + " td:nth-child(3)").html());
        } else {
            $("#tltcode").val("");
        }
    }

    function keyup_guide(id) {
        var guidename = $("#guidename"+id).val();
        if (id == (lastid_guide - 1) && guidename != "") {
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

    function editing_guide(id) {
        $("#table-guide tbody tr td").find("div").css("display", "none");
        $("#guide-" + id + " td:nth-child(1)").find("div").css("display", "block");
    }

    function new_guide(id) {
        $("#table-guide tbody tr td").find("div").css("display", "none");
        $("#" + id + " td:nth-child(1)").find("div").css("display", "block");
    }

    function clear_form() {
        $("#tour-code").val('');
        $("#tour-status").val('');
        $("#group-name").val('');
        $("#note-tour").val('');
        $("#table-guide > tbody").html($("#table-guide > tbody > tr").last().html());
    }

    function select_booking_list(key) {
        $("#table-booking-info").find("tr").css("background", "transparent");
        $("#booking-" + key).css("background", "#397FDB");
        if ($('#menu_1').attr('class') == 'active') {
            $("#add-room-1").hide();
            $("#r-type-add").val("");
            $("#r-class-add").val("");
            $("#r-no-add").val("");
            $("#lc-add").val("");
            $("#ar-no-add").val("0");
        } else {
            $("#add-room-2").hide();
            $("#r-type-add-2").val("");
            $("#r-class-add-2").val("");
            $("#r-no-add2").val("");
            $("#lc-add2").val("");
            $("#ar-no-add2").val("0");
        }
        show_info(key);
        select_booking = key;
        var rowCount = $('#table-booking-info tr').length;
        $("#cke_bx").prop("checked", false);
        $("#add-booking-list").attr("disabled", true);
        if (rowCount > 2) {
            $("#delete-booking-list").removeAttr("disabled");
        }
        $("#update-booking-list").prop("disabled", false);
        $("#clear-booking-list").attr("disabled", true);
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
        $("#r-l-add").val(Room_List1);
        $("#hotel").val($("#booking-" + key + " td:nth-child(2)").html());
        //get_rtypeandrclass();
        var dt = {
            city: $("#booking-" + key + " td:nth-child(1)").html(),
            hotel: $("#booking-" + key + " td:nth-child(2)").html()
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
            $("#r-class-1").html("<option></option>");
            $("#r-class-2").html("<option></option>");
            $("#r-class-add").html("<option></option>");
            $("#r-class-add-2").html("<option></option>");
            $("#r-type-add-2").html("<option></option>");
        }
       
        if ($("#booking-" + key + " td:nth-child(4)").html() == "") {
            $("#note-bk").val("");
        } else {
            $("#note-bk").val($("#booking-" + key + " td:nth-child(4)").html());
        }
        /*from HCM*/
        if ($("#booking-" + key + " td:nth-child(5)").html() == "") {
            $("#VN-Flight1").val("");
        } else {
            $("#VN-Flight1").val($("#booking-" + key + " td:nth-child(5)").html());
        }
        /*back HCM*/
        if ($("#booking-" + key + " td:nth-child(6)").html() == "") {
            $("#VN-Flight2").val("");
        } else {
            $("#VN-Flight2").val($("#booking-" + key + " td:nth-child(6)").html());
        }
        /*Stage1*/
        if ($("#booking-" + key + " td:nth-child(7)").html() == "") {
            $("#arrv-date-1").val("");
        } else {
            $("#arrv-date-1").val($("#booking-" + key + " td:nth-child(7)").html());
        }
        if ($("#booking-" + key + " td:nth-child(8)").html() == "") {
            $("#dept-date-1").val("");
        } else {
            $("#dept-date-1").val($("#booking-" + key + " td:nth-child(8)").html());
        }
        if ($("#booking-" + key + " td:nth-child(9)").html() == "") {
            $("#nite-no-1").val("");
        } else {
            $("#nite-no-1").val($("#booking-" + key + " td:nth-child(9)").html());
        }

        if ($("#booking-" + key + " td:nth-child(10)").html() == "") {
            $("#pax-no-1").val("");
        } else {
            $("#pax-no-1").val($("#booking-" + key + " td:nth-child(10)").html());
        }

        if ($("#booking-" + key + " td:nth-child(11)").html() == "") {
            $("#check-out-1").val("");
        } else {
            $("#check-out-1").val($("#booking-" + key + " td:nth-child(11)").html());
        }

        if ($("#booking-" + key + " td:nth-child(12)").html() == "") {
            $("#r-no-1").val("");
        } else {
            $("#r-no-1").val($("#booking-" + key + " td:nth-child(12)").html());
        }

        if ($("#booking-" + key + " td:nth-child(13)").html() == "") {
            $("#r-type-1").val("");
        } else {
            $("#r-type-1").val($("#booking-" + key + " td:nth-child(13)").html());
        }
        if ($("#booking-" + key + " td:nth-child(14)").html() == "") {
            $("#r-class-1").val("");
        } else {
            $("#r-class-1").val($("#booking-" + key + " td:nth-child(14)").html());
        }
         /*Allotment 1 & 2*/
        if ($("#booking-" + key + " td:nth-child(15)").html() != "" && $("#booking-" + key + " td:nth-child(15)").html() != "NULL") {
            $("#check-box-allotment").prop("checked", true);
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
        } else {
            $("#check-box-allotment").prop("checked", false);
        }

        if ($("#booking-" + key + " td:nth-child(28)").html() != "" && $("#booking-" + key + " td:nth-child(28)").html() != "NULL") {
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
        } else {
            $("#check-box-allotment2").prop("checked", false);
        }       
        if ($("#booking-" + key + " td:nth-child(16)").html() == "") {
            $("#hotel-status-1").val("");
        } else {
            $("#hotel-status-1").val($("#booking-" + key + " td:nth-child(16)").html());
        }
        //alert($("#booking-"+key+" td:nth-child(16)").html());
        if ($("#booking-" + key + " td:nth-child(17)").html() == "") {
            $("#note-booking-1").val("");
        } else {
            $("#note-booking-1").val($("#booking-" + key + " td:nth-child(17)").html());
        }
        /*Stage 2*/
        if ($("#booking-" + key + " td:nth-child(20)").html() == "") {
            $("#arrv-date-2").val("");
        } else {
            $("#arrv-date-2").val($("#booking-" + key + " td:nth-child(20)").html());
        }
        if ($("#booking-" + key + " td:nth-child(21)").html() == "") {
            $("#dept-date-2").val("");
        } else {
            $("#dept-date-2").val($("#booking-" + key + " td:nth-child(21)").html());
        }
        if ($("#booking-" + key + " td:nth-child(22)").html() == "") {
            $("#nite-no-2").val("");
        } else {
            $("#nite-no-2").val($("#booking-" + key + " td:nth-child(22)").html());
        }
        if ($("#booking-" + key + " td:nth-child(23)").html() == "") {
            $("#pax-no-2").val("");
        } else {
            $("#pax-no-2").val($("#booking-" + key + " td:nth-child(23)").html());
        }
        if ($("#booking-" + key + " td:nth-child(24)").html() == "") {
            $("#check-out-2").val("");
        } else {
            $("#check-out-2").val($("#booking-" + key + " td:nth-child(24)").html());
        }
        if ($("#booking-" + key + " td:nth-child(25)").html() == "") {
            $("#r-no-2").val("");
        } else {
            $("#r-no-2").val($("#booking-" + key + " td:nth-child(25)").html());
        }
        if ($("#booking-" + key + " td:nth-child(26)").html() == "") {
            $("#r-type-2").val("");
        } else {
            $("#r-type-2").val($("#booking-" + key + " td:nth-child(26)").html());
        }

        if ($("#booking-" + key + " td:nth-child(27)").html() == "") {
            $("#r-class-2").val("");
        } else {
            $("#r-class-2").val($("#booking-" + key + " td:nth-child(27)").html());
        }
        if ($("#booking-" + key + " td:nth-child(29)").html() == "") {
            $("#hotel-status-2").val("");
        } else {
            $("#hotel-status-2").val($("#booking-" + key + " td:nth-child(29)").html());
        }

        if ($("#booking-" + key + " td:nth-child(30)").html() == "") {
            $("#note-booking-2").val("");
        } else {
            $("#note-booking-2").val($("#booking-" + key + " td:nth-child(30)").html());
        }
    }

    function delete_booking() {
        if (select_booking == "") {
            alert("No booking selected!!!");
        } else {
            var r = confirm("Are you sure to want to delete this booking ?");
            if (r == true) {
                var i = 0;
                var array = new Array();
                array[i] = $("#id").val();
                array[i + 1] = $("#booking-" + select_booking + " td:nth-child(3) ").html();
                delete_result.push(array);
                $("#booking-" + select_booking).remove();
                deleted_booking.push(select_booking);
                select_booking = "";
            }
        }
    }   
    function update_booking() { 
        if (select_booking == "") {
            alert("No booking selected!!!");
            return false;
        } else if (flag_check_time) 
        {
            var location = $("#location").val();
            var city = $("#city").val();
            var hotel = $("#hotel").val();
            //alert(hotel);
            var note = $("#note-bk").val();
            var TLTCode = $("#booking-" + select_booking + " td:nth-child(3)").html();
            ///alert(TLTCode);
            var Allotment1;
            var Allotment2;
            /*FROM HCM*/
            var vn_flight_1 = $("#VN-Flight1").val();
            var VNFlight1DeptDate = $("#from-hcm-date").val();
            var VNFlight1DeptTime = $("#from-hcm-dept-time").val();
            var VNFlight1ArrvTime = $("#from-hcm-arrv-time").val();
            /*BACK HCM*/
            var vn_flight_2 = $("#VN-Flight2").val();
            var VNFlight2DeptDate = $("#back-hcm-date").val();
            var VNFlight2DeptTime = $("#back-hcm-dept-time").val();
            var VNFlight2ArrvTime = $("#back-hcm-arrv-time").val();
            /*stage 1*/
            var arrv_date_1 = $("#arrv-date-1").val();
            var dept_date_1 = $("#dept-date-1").val();
            var nite_no_1 = $("#nite-no-1").val();
            var no_pax_1 = $("#pax-no-1").val();
            var room_no_1 = $("#r-no-1").val();
            if ($("#list-check-out-1").val() != "") {
                var check_out_1 = $("#list-check-out-1").val();
            } else {
                var check_out_1 = $("#check-out-1").val();
            }
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
            if ($("#list-check-out-2").val() != "") {
                var check_out_2 = $("#list-check-out-2").val();
            } else {
                var check_out_2 = $("#check-out-2").val();
            }
            var note2 = $("#note-booking-2").val();
            var room_type_2 = $("#r-type-2").val();
            var room_class_2 = $("#r-class-2").val();
            var hotel_status_2 = $("#hotel-status-2").val();
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

            if (city == "") {
                alert("Please select the hotel.");
                $("#city").focus();
                return false;
            }
            /*check box allotment 1*/
            if ($("#check-box-allotment").prop('checked') == true) {
                var date1 = new Date(arrv_date_1);                
                var date2 = new Date(dept_date_1);/**/                
                if (date2 - date1 <= 0) {
                   alert("Please try again date to have allotment at Stage 1");
                   return false;
                } else if (room_no_1.trim() == "" || room_no_1.trim() == "0") {
                   alert("Please enter room number at Stage 1");
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
                } else if (parseInt($('#allotment-1').val()) > parseInt(room_no_1)) {
                   alert("Check about compare room no between Room No and Allotment1 Room No");
                   return false;                    
                }
                /* check allotment database */               
               var dt = {
                        city: city,
                        hotel: hotel,
                        arrv_date: arrv_date_1,
                        dept_date: dept_date_1,
                        room_no : $("#allotment-1").val(),
                        TourID :  $("#id").val()
                    };                    
              $.ajax({
                  url: "<?php echo base_url('HotelBookingController/check_allotment_1'); ?>",
                  async: false,
                  type: "POST",
                  data: dt,
                  dataType: "json",                  
                  success: function(data) {
                     if(data.msg1 !="" || data.msg2 !="" || data.msg3 !=""){
                        if(data.msg1 != ""){
                           alert(data.msg1);
                           return false;
                        }
                        if(data.msg2 != ""){
                           alert(data.msg2);
                           return false;
                        }
                        if(data.msg3 != ""){
                           alert(data.msg3);
                           return false;
                        }
                     }
                  }
              });
              /*end check database*/
            }
            /*end check box allotment 1*/
            /*check box allotment 2*/
            if ($("#check-box-allotment-2").prop('checked') == true) {
                if (room_no_2.trim() == "" || room_no_2.trim() == "0") {
                   alert("Please enter room number at Stage 2");
                   return false;                   
                } else if (room_type_2.trim() == "") {
                   alert("Please Choose Room Type2, Not Empty");
                   return false;                   
                } else if (room_class_2.trim() == "") {
                   alert("Please Choose Room Class2, Not Empty");
                   return false;                    
                } else if (arrv_date_2.trim() == "" || dept_date_2.trim() == "") {
                   alert("ArrvDate2 and DeptDate1 can`t empty");
                   return false;                   
                } else if ($('#allotment-2').val() == "" || $('#allotment-2').val() == "0") {
                   alert("Please Enter Allotment Room No2");
                   return false;                   
                } else if (parseInt($('#allotment-2').val()) > parseInt(room_no_2)) {
                   alert("Check about compare room no between Room No and Allotment2 Room No");
                   return false;                   
                }
                /* check data base alloment 2*/
                var dt = {
                    city: city,
                    hotel: hotel,
                    arrv_date: arrv_date_2,
                    dept_date: dept_date_2,
                    room_no: $("#allotment-2").val()
                };
               
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/check_allotment_1'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",                    
                     success: function(data) {
                        if(data.msg1 !="" || data.msg2 !="" || data.msg3 !=""){
                           if(data.msg1 != ""){
                              alert(data.msg1);
                              return false;
                           }
                           if(data.msg2 != ""){
                              alert(data.msg2);
                              return false;
                           }
                           if(data.msg3 != ""){
                              alert(data.msg3);
                              return false;
                           }
                        }
                     }
                });
                /*end check data base alloment 2*/
            }
            /*end check box allotment 2*/        
            if (no_pax_1 == "") {
                 no_pax_1 = 0;
             }
             if (nite_no_1 == "") {
                 nite_no_1 = 0;
             }
             if ($("#check-box-allotment").prop('checked') == true) {
                 var dt = {
                     city: city,
                     hotel: hotel,
                     arrv_date: arrv_date_1,
                     dept_date: dept_date_1,
                     room_no: $("#allotment-1").val(),
                     r_class: room_class_1
                 };
                 $.ajax({
                     url: "<?php echo base_url('HotelBookingController/GetAllotmentID'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         Allotment1 = data.idallotment;
                     }
                 });
             } else {
                 Allotment1 = "";
             }
             Room_List1 = $("#room-list-1").val();

             if (no_pax_2 == "") {
                 no_pax_2 = 0;
             }
             if (nite_no_2 == "") {
                 nite_no_2 = 0;
             }
             if ($("#check-box-allotment-2").prop('checked') == true) {
                 var dt = {
                     city: city,
                     hotel: hotel,
                     arrv_date: arrv_date_2,
                     dept_date: dept_date_2,
                     room_no: $("#allotment-2").val(),
                     r_class: room_class_2
                 };
                 $.ajax({
                     url: "<?php echo base_url('HotelBookingController/GetAllotmentID'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         Allotment2 = data.idallotment;
                     }
                 });
             } else {
                 Allotment2 = "";
             }
             Room_List2 = $("#room-list-2").val();

             key = select_booking;
             /*hotel info*/
             $("#booking-" + key + " td:nth-child(1)").html(city);
             $("#booking-" + key + " td:nth-child(2)").html(hotel);
             $("#booking-" + key + " td:nth-child(3)").html(TLTCode);
             $("#booking-" + key + " td:nth-child(4)").html(note);
             /*From HCM*/
             $("#booking-" + key + " td:nth-child(5)").html(vn_flight_1);
             $("#booking-" + key + " td:nth-child(35)").html(VNFlight1DeptDate);
             $("#booking-" + key + " td:nth-child(36)").html(VNFlight1DeptTime);
             $("#booking-" + key + " td:nth-child(37)").html(VNFlight1ArrvTime);
             /*Back HCM*/
             $("#booking-" + key + " td:nth-child(6)").html(vn_flight_2);
             $("#booking-" + key + " td:nth-child(38)").html(VNFlight2DeptDate);
             $("#booking-" + key + " td:nth-child(39)").html(VNFlight2DeptTime);
             $("#booking-" + key + " td:nth-child(40)").html(VNFlight2ArrvTime);
             /*Stage 1*/
             $("#booking-" + key + " td:nth-child(7)").html(arrv_date_1);
             $("#booking-" + key + " td:nth-child(8)").html(dept_date_1);
             $("#booking-" + key + " td:nth-child(9)").html(nite_no_1);
             $("#booking-" + key + " td:nth-child(10)").html(no_pax_1);
             console.log(check_out_1);
             $("#booking-" + key + " td:nth-child(11)").html(check_out_1);
             $("#booking-" + key + " td:nth-child(12)").html(room_no_1);
             $("#booking-" + key + " td:nth-child(13)").html(room_type_1);
             $("#booking-" + key + " td:nth-child(14)").html(room_class_1);
             $("#booking-" + key + " td:nth-child(15)").html(Allotment1);
             $("#booking-" + key + " td:nth-child(16)").html(hotel_status_1);
             $("#booking-" + key + " td:nth-child(17)").html(note1);
             $("#booking-" + key + " td:nth-child(33)").html(Room_List1);
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
             $("#booking-" + key + " td:nth-child(34)").html(Room_List2);
             /*Proccess Allotment*/
             $("#booking-" + key + " td:nth-child(41)").html($("#ex-stage1-allotment").val());
             $("#booking-" + key + " td:nth-child(42)").html($("#ex-stage2-allotment").val());

             select_booking_list(key);             
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
             $("#allotment-1").attr("hidden",true);
             $("#lb-allotment-1").attr("hidden",true);
             $("#check-box-allotment").prop("checked",false);

             $("#allotment-2").attr("hidden",true);
             $("#lb-allotment-2").attr("hidden",true);
             $("#check-box-allotment-2").prop("checked",false);

             //FLG_Change = false;
         }
        
    }

    function add_to_booking_list() {
        str_Static_VNCode = $("#tltcode").val().trim();
        var obj_List_1;
        var obj_List_2;
        var obj_Array_1 = [];
        var obj_Array_2 = [];
        var location = $("#location").val();
        var city = $("#city").val();
        var hotel = $("#hotel").val();
        var note = $("#note-bk").val();
        var Allotment1;
        var HoilidaySum1;
        var CheckOut1;
        var CheckOut2;
        var HoilidaySum2;
        var Room_List1;
        var Room_List2;
        var rowCount = $('#table-booking-info tr').length;
        var key = rowCount - 1;
        /*FROM HCM*/
        var vn_flight_1 = $("#VN-Flight1").val();
        var VNFlight1DeptDate = $("#from-hcm-date").val();
        var VNFlight1DeptTime = $("#from-hcm-dept-time").val();
        var VNFlight1ArrvTime = $("#from-hcm-arrv-time").val();
        /*BACK HCM*/
        var vn_flight_2 = $("#VN-Flight2").val();
        var VNFlight2DeptDate = $("#back-hcm-date").val();
        var VNFlight2DeptTime = $("#back-hcm-dept-time").val();
        var VNFlight2ArrvTime = $("#back-hcm-arrv-time").val();
        /*stage 1*/
        var arrv_date_1 = $("#arrv-date-1").val();
        var dept_date_1 = $("#dept-date-1").val();
        var nite_no_1 = $("#nite-no-1").val();
        var no_pax_1 = $("#pax-no-1").val();
        var room_no_1 = $("#r-no-1").val();
        var check_out_1 = $("#check-out-1").val();

        if ($("#list-check-out-1").val() != "") {
            CheckOut1 = $("#list-check-out-1").val();
        } else {
            CheckOut1 = $("#check-out-1").val();
        }
        var note1 = $("#note-booking-1").val();
        var room_type_1 = $("#r-type-1").val();
        var room_class_1 = $("#r-class-1").val();
        var hotel_status_1 = $("#hotel-status-1").val();
        HTL_Total1 = $("#htl-total-1").val();
        var Room_List1 = $("#room-list-1").val();
        var holiday1 = $('#holiday-no-1').val();
        var op1 = $('#op1').val();
        var SPE1 = $("#check_spe1").prop('checked');
        //alert(Tranfer_Price1);
        /*end stage 1*/
        /*stage 2*/
        var no_pax_2 = $("#pax-no-2").val();
        var arrv_date_2 = $("#arrv-date-2").val();
        var dept_date_2 = $("#dept-date-2").val();
        var nite_no_2 = $("#nite-no-2").val();
        var room_no_2 = $("#r-no-2").val();
        var check_out_2 = $("#check-out-2").val();
        if ($("#list-check-out-2").val() != "") {
            CheckOut2 = $("#list-check-out-2").val();
        } else {
            CheckOut2 = $("#check-out-2").val();
        }
        var note2 = $("#note-booking-2").val();
        var room_type_2 = $("#r-type-2").val();
        var room_class_2 = $("#r-class-2").val();
        var hotel_status_2 = $("#hotel-status-2").val();
        var op2 = $('#op2').val();
        var holiday2 = $('#holiday-no-2').val();
        var SPE2 = $("#check_spe").prop('checked');
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
        if (hotel == "" || city == "") {
            alert("Please select the hotel.");
            $("#city").focus();
            return false;            
        }
        /*check box allotment 1*/
        if ($("#check-box-allotment").prop('checked') == true) {
            var date1 = new Date(arrv_date_1);            
            var date2 = new Date(dept_date_1);           
            if (date2 - date1 <= 0) {
               alert("Please try again date to have allotment at Stage 1");
               return false;     
            } else if (room_no_1.trim() == "" || room_no_1.trim() == "0") {
               alert("Please enter room number at Stage 1");
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
            } else if (parseInt($('#allotment-1').val()) > parseInt(room_no_1)) {
               alert("Check about compare room no between Room No and Allotment1 Room No");
               return false;                
            }
            var dt = {
                  city: city,
                  hotel: hotel,
                  arrv_date: arrv_date_1,
                  dept_date: dept_date_1,
                  room_no : $("#allotment-1").val(),
                  TourID :  $("#id").val()
              };
            $.ajax({
            url: "<?php echo base_url('HotelBookingController/check_allotment_1'); ?>",
            async: false,
            type: "POST",
            data: dt,
            dataType: "json",          
            success: function(data) {
                  if(data.msg1 !="" || data.msg2 !="" || data.msg3 !=""){
                     if(data.msg1 != ""){
                        alert(data.msg1);
                        return false;
                     }
                     if(data.msg2 != ""){
                        alert(data.msg2);
                        return false;
                     }
                     if(data.msg3 != ""){
                        alert(data.msg3);
                        return false;
                     }
                  }
               }
           });                             
        }
         /*check box allotment 2*/
        if ($("#check-box-allotment-2").prop('checked') == true) {
            if (room_no_2.trim() == "" || room_no_2.trim() == "0") {
               alert("Please enter room number at Stage 2");
               return false;                   
            } else if (room_type_2.trim() == "") {
               alert("Please Choose Room Type2, Not Empty");
               return false;                   
            } else if (room_class_2.trim() == "") {
               alert("Please Choose Room Class2, Not Empty");
               return false;                    
            } else if (arrv_date_2.trim() == "" || dept_date_2.trim() == "") {
               alert("ArrvDate2 and DeptDate1 can`t empty");
               return false;                   
            } else if ($('#allotment-2').val() == "" || $('#allotment-2').val() == "0") {
               alert("Please Enter Allotment Room No2");
               return false;                   
            } else if (parseInt($('#allotment-2').val()) > parseInt(room_no_2)) {
               alert("Check about compare room no between Room No and Allotment2 Room No");
               return false;                   
            }
             /* check data base alloment 2*/
            var dt = {
                 city: city,
                 hotel: hotel,
                 arrv_date: arrv_date_2,
                 dept_date: dept_date_2,
                 room_no: $("#allotment-2").val()
            };
            $.ajax({
                 url: "<?php echo base_url('HotelBookingController/check_allotment_1'); ?>",
                 async: false,
                 type: "POST",
                 data: dt,
                 dataType: "json",              
                  success: function(data) {
                     if(data.msg1 !="" || data.msg2 !="" || data.msg3 !=""){
                        if(data.msg1 != ""){
                           alert(data.msg1);
                           return false;
                        }
                        if(data.msg2 != ""){
                           alert(data.msg2);
                           return false;
                        }
                        if(data.msg3 != ""){
                           alert(data.msg3);
                           return false;
                        }
                     }
                  }
            });
                /*end check data base alloment 2*/
         }
         /*end check box allotment 2*/   
         /*set value stage 1*/
         if (no_pax_1 == "") {
             no_pax_1 = 0;
         }
         if (holiday1 == "") {
             HoilidaySum1 = 0;
         } else {
             HoilidaySum1 = holiday1;
         }

         if ($("#check-box-allotment").prop('checked') == true) {
             var dt = {
                 city: city,
                 hotel: hotel,
                 arrv_date: arrv_date_1,
                 dept_date: dept_date_1,
                 room_no: $("#allotment-1").val(),
                 r_class: room_class_1
             };
             $.ajax({
                 url: "<?php echo base_url('HotelBookingController/GetAllotmentID'); ?>",
                 async: false,
                 type: "POST",
                 data: dt,
                 dataType: "json",
                 success: function(data) {
                     Allotment1 = data.idallotment;
                 }
             });
         } else {
             Allotment1 = "";
         }
      
         if (room_type_1 != "" && room_class_1 != "") {
             if ($("#check-out-1").val() == "") {
                 CheckOut1 = "12:00";
             } else {
                 CheckOut1 = check_out_1;
             }
             if ($("#check_spe1").prop('checked') == true) {
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
                     url: "<?php echo base_url('HotelBookingController/GetPriceSPE'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         obj_List_1 = data.obj_List_1;
                     }
                 });
                 /*get class_name*/
                 var class_name = "";
                 var dt = {
                     city: city,
                     hotel: hotel,
                     r_type: room_type_1,
                     r_class: room_class_1
                 };
                 $.ajax({
                     url: "<?php echo base_url('HotelBookingController/GetHotelClassName'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         class_name = data.class_name;
                     }
                 });
                 $("#class-name-1").val(class_name);
             } else {
                 var dt = {
                     rtye: room_type_1,
                     rclass: room_class_1,
                     rno: room_no_1,
                     check_spe: SPE1,
                     city: city,
                     hotel: hotel,
                     checkout: CheckOut1,
                     niteno: nite_no_1,
                     paxno: no_pax_1,
                     holiday: HoilidaySum1,
                     vncode: str_Static_VNCode
                 };
                 $.ajax({
                     url: "<?php echo base_url('HotelBookingController/GetPrice'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         obj_List_1 = data.obj_List_1;
                     }
                 });
             }
             obj_Array_1 = obj_List_1.split("+");
             HTL_Total1 = parseFloat(obj_Array_1[0]);
             LC1 = parseFloat(obj_Array_1[1]);
             Room_List1 = "";
             /*get hotel price*/
             var hotel_price = "";
             var dt = {
                 city: city,
                 hotel: hotel,
                 rtye: room_type_1,
                 rclass: room_class_1,
                 check_spe: SPE1,
                 vn_code: str_Static_VNCode
             };
             $.ajax({
                 url: "<?php echo base_url('HotelBookingController/GetHotelPrice'); ?>",
                 async: false,
                 type: "POST",
                 data: dt,
                 dataType: "json",
                 success: function(data) {
                     hotel_price = data.hotel_price + ",";
                 }
             });
             $("#hotel-price-1").val(hotel_price);
         } else {
             if ($("#htl-total-1").val() == "") {
                 HTL_Total1 = 0;
             } else {
                 HTL_Total1 = parseFloat($("#htl-total-1").val());
             }
             if ($("#lc-1").val() == "") {
                 LC1 = 0;
             } else {
                 LC1 = parseFloat($("#lc-1").val());
             }
         }         
         var Tranfer_Price1 = GetTransferPrice(op1);
         /*end value stage 1*/

         /*set value stage 2*/
         if (no_pax_2 == "") {
             no_pax_2 = 0;
         }
         if ($("#check-box-allotment-2").prop('checked') == true) {
             var dt = {
                 city: city,
                 hotel: hotel,
                 arrv_date: arrv_date_2,
                 dept_date: dept_date_2,
                 room_no: $("#allotment-2").val(),
                 r_class: room_class_2
             };
             $.ajax({
                 url: "<?php echo base_url('HotelBookingController/GetAllotmentID'); ?>",
                 async: false,
                 type: "POST",
                 data: dt,
                 dataType: "json",
                 success: function(data) {
                     Allotment2 = data.idallotment;
                 }
             });
         } else {
             Allotment2 = "";
         }
         if (holiday2 == "") {
             HoilidaySum2 = 0;
         } else {
             HoilidaySum2 = holiday2;
         }
         Room_List2 = $("#room-list-2").val();
         if (room_type_2 != "" && room_class_2 != "") {
             if ($("#check-out-2").val() == "") {
                 CheckOut2 = "12:00";
             } else {
                 CheckOut2 = check_out_2;
             }
             if ($("#check_spe").prop('checked') == true) {
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
                     url: "<?php echo base_url('HotelBookingController/GetPriceSPE'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         obj_List_2 = data.obj_List_1;
                     }
                 });
                 /*get class_name*/
                 var class_name = "";
                 var dt = {
                     city: city,
                     hotel: hotel,
                     r_type: room_type_2,
                     r_class: room_class_2
                 };
                 $.ajax({
                     url: "<?php echo base_url('HotelBookingController/GetHotelClassName'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         class_name = data.class_name;
                     }
                 });
                 $("#class-name-2").val(class_name);
             } else {
                 var dt = {
                     rtye: room_type_2,
                     rclass: room_class_2,
                     rno: room_no_2,
                     check_spe: SPE2,
                     city: city,
                     hotel: hotel,
                     checkout: CheckOut2,
                     niteno: nite_no_2,
                     paxno: no_pax_2,
                     holiday: HoilidaySum2,
                     vncode: str_Static_VNCode
                 };
                 $.ajax({
                     url: "<?php echo base_url('HotelBookingController/GetPrice'); ?>",
                     async: false,
                     type: "POST",
                     data: dt,
                     dataType: "json",
                     success: function(data) {
                         obj_List_2 = data.obj_List_1;
                     }
                 });
             }
             /*HTL_Total1 & LC1*/
             obj_Array_2 = obj_List_2.split("+");
             HTL_Total2 = parseFloat(obj_Array_2[0]);
             LC2 = parseFloat(obj_Array_2[1]);
             Room_List2 = "";
             /*get hotel price*/
             var hotel_price = "";
             var dt = {
                 city: city,
                 hotel: hotel,
                 rtye: room_type_2,
                 rclass: room_class_2,
                 check_spe: SPE2,
                 vn_code: str_Static_VNCode
             };
             $.ajax({
                 url: "<?php echo base_url('HotelBookingController/GetHotelPrice'); ?>",
                 async: false,
                 type: "POST",
                 data: dt,
                 dataType: "json",
                 success: function(data) {
                     hotel_price = data.hotel_price + ",";
                 }
             });
             $("#hotel-price-2").val(hotel_price);
         } else {
             if ($("#htl-total-2").val() == "") {
                 HTL_Total2 = 0;
             } else {
                 HTL_Total2 = parseFloat($("#htl-total-2").val());
             }
             if ($("#lc-2").val() == "") {
                 LC2 = 0;
             } else {
                 LC2 = parseFloat($("#lc-2").val());
             }
         }

         var Tranfer_Price2 = GetTransferPrice(op2);
         var ht1;
         var ht2;
         if ($("#hotel-price-1").val() == "") {
             ht1 = "0";
         } else {
             ht1 = $("#hotel-price-1").val();
         }

         if ($("#hotel-price-2").val() == "") {
             ht2 = "0";
         } else {
             ht2 = $("#hotel-price-2").val();
         }
         LC1 = LC1 + "-" + ht1 + Tranfer_Price1 + "-" + $("#class-name-1").val();
         LC2 = LC2 + "-" + ht2 + Tranfer_Price2 + "-" + $("#class-name-2").val();
         var hotelalias = get_hotelalias(hotel);
         var TLTCODE = create_TLTCode(location, hotel, arrv_date_1, i_TLTCode);
         i_TLTCode = TLTCODE.substr(TLTCODE.lastIndexOf("-") + 1);
         key++;
         var row = "";
         //row  += "<tr id='booking-"+TLTCODE+"-"+key+"' onclick=select_booking_list('"+TLTCODE+","+key+"')>";
         row += "<tr id='booking-" + key + "' onclick=\"select_booking_list('" + key + "')\">";
         /*hotel info*/
         row += "<td style='width:110px;'>" + city + "</td>"; //1
         row += "<td style='width:150px;'>" + hotel + "</td>"; //2
         row += "<td style='display:none;'>" + TLTCODE + "</td>"; //3
         row += "<td style='display:none;'>" + note + "</td>"; //4
         /*From HCM*/
         row += "<td style='display: none;'>" + vn_flight_1 + "</td>"; //5
         /*Back HCM*/

         row += "<td style='display: none;'>" + vn_flight_2 + "</td>"; //6
         /*Stage1*/
         row += "<td style='width:95px;'>" + arrv_date_1 + "</td>"; //7
         row += "<td style='width:95px'>" + dept_date_1 + "</td>"; //8
         row += "<td style='width:70px'>" + nite_no_1 + "</td>"; //9
         row += "<td style='width:70px;'>" + no_pax_1 + "</td>"; //10
         row += "<td style='width:95px;'>" + CheckOut1 + "</td>"; //11
         row += "<td style='display:none;'>" + room_no_1 + "</td>"; //12
         row += "<td style='width:95px;'>" + room_type_1 + "</td>"; //13
         row += "<td style='display:none;'>" + room_class_1 + "</td>"; //14
         row += "<td style='display:none;'>" + Allotment1 + "</td>"; //15
         row += "<td style='width:120px;'>" + hotel_status_1 + "</td>"; //16
         row += "<td style='width:140px;'>" + note1 + "</td>"; //17
         row += "<td style='display:none;'>" + HTL_Total1 + "</td>"; //18
         row += "<td style='display:none;'>" + LC1 + "</td>"; //19
         /*stage 2*/
         row += "<td style='display: none;'>" + arrv_date_2 + "</td>"; //20
         row += "<td style='display: none;'>" + dept_date_2 + "</td>"; //21
         row += "<td style='display: none;'>" + nite_no_2 + "</td>"; //22
         row += "<td style='display: none;'>" + no_pax_2 + "</td>"; //23
         row += "<td style='display: none;'>" + CheckOut2 + "</td>"; //24
         row += "<td style='display: none;'>" + room_no_2 + "</td>"; //25
         row += "<td style='display: none;'>" + room_type_2 + "</td>"; //26
         row += "<td style='display: none;'>" + room_class_2 + "</td>"; //27
         row += "<td style='display:none;'>" + Allotment2 + "</td>"; //28
         row += "<td style='display: none;'>" + hotel_status_2 + "</td>"; //29
         row += "<td style='display: none;'>" + note2 + "</td>"; //30
         row += "<td style='display:none;'>" + HTL_Total2 + "</td>"; //31
         row += "<td style='display:none;'>" + LC2 + "</td>"; //32
         /*ROOM LIST 1 & 2*/
         row += "<td style='display:none;'>" + Room_List1 + "</td>"; //33
         row += "<td style='display:none;'>" + Room_List2 + "</td>"; //34
         /*From HCM*/
         row += "<td style='display:none;'>" + VNFlight1DeptDate + "</td>"; //35
         row += "<td style='display:none;'>" + VNFlight1DeptTime + "</td>"; //36
         row += "<td style='display:none;'>" + VNFlight1ArrvTime + "</td>"; //37
         /*Back HCM*/
         row += "<td style='display:none;'>" + VNFlight2DeptDate + "</td>"; //38
         row += "<td style='display:none;'>" + VNFlight2DeptTime + "</td>"; //39
         row += "<td style='display:none;'>" + VNFlight2ArrvTime + "</td>"; //40
         row += "<td style='display:none;'></td>"; //41
         row += "<td style='display:none;'></td>"; //42
         row += "<td style='display:none;'>" + Tranfer_Price1 + "</td>"; //43
         row += "<td style='display:none;'>" + Tranfer_Price2 + "</td>"; //44

         row += "<td style='display:none;'>" + HoilidaySum1 + "</td>"; //45
         row += "<td style='display:none;'>" + HoilidaySum2 + "</td>"; //46

         row += "<td style='display:none;'>" + Alloment_list1 + "</td>"; //47
         row += "<td style='display:none;'>" + Alloment_list2 + "</td>"; //48
         row += "<td style='display:none;'></td>"; //49
         row += "<td style='display:none;'></td>"; //50
         row += "</tr>";
         $("#table-booking-info tbody").append(row);
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
         $("#cke_bx").prop("checked", false);
         $("#add-booking-list").attr("disabled", true);
         $("#update-booking-list").prop("disabled", false);
         $("#clear-booking-list").attr("disabled", true);
         $("#allotment-1").attr("hidden",true);
         $("#lb-allotment-1").attr("hidden",true);
         $("#check-box-allotment").prop("checked",false);

         $("#allotment-2").attr("hidden",true);
         $("#lb-allotment-2").attr("hidden",true);
         $("#check-box-allotment-2").prop("checked",false);

         if (rowCount > 2) {
             $("#delete-booking-list").removeAttr("disabled");
         }        
    }

    function get_hotelalias(hotel) {
        var result = "";
        var hotelname = hotel;
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/get_hotelalias'); ?>",
            type: "POST",
            data: "hotelname=" + hotel,
            async: false,
            success: function(data) {
                result = data;
            }
        });

        return result;
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
            success: function(data) {
                result = data.str_TLTCode;
            }
        });
        return result;
    }

    function create_array_data_booking() {
        var list_result = {

            City: $("#city").val(),
            Hotel: $("#hotel").val(),
            Note: $("#note-bk").val(),
            VNFlight1: $("#VN-Flight1").val(),
            VNFlight2: $("#VN-Flight2").val(),
            HotelStatus1: $("#hotel-status-1").val(),
            HotelStatus2: $("#hotel-status-2").val(),
            ArrvDate1: $("#arrv-date-1").val(),
            DeptDate1: $("#dept-date-1").val(),
            ArrvDate2: $("#arrv-date-2").val(),
            DeptDate2: $("#dept-date-2").val(),
            NiteNo1: $("#nite-no-1").val(),
            NiteNo2: $("#nite-no-2").val(),
            PaxNo1: $("#pax-no-1").val(),
            PaxNo2: $("#pax-no-2").val(),
            RoomNo1: $("#r-no-1").val(),
            RoomNo2: $("#r-no-2").val(),
            RoomType1: $("#r-type-1").val(),
            RoomType2: $("#r-type-2").val(),
            RoomClass1: $("#r-class-1").val(),
            RoomClass2: $("#r-class-2").val(),
            Note1: $("#note-booking-1").val(),
            Note2: $("#note-booking-2").val(),
            CheckOut1: $("#check-out-1").val(),
            CheckOut2: $("#check-out-2").val(),

        }
        return list_result;
    }

    function save_update_tour() {
        //star update tour,book,guest
        var data_arr_guide = new Array();
        var data_arr_id = new Array();
        var i = 0;
        $("#table-guide > tbody > tr > td > input").each(function() {
            if ($(this).val() != "") {
                data_arr_guide[i] = $(this).val();
                data_arr_id[i] = $(this).data('id');
                i++;
            }
        });
        if (data_arr_guide == "") {
            data_arr_guide[0] = "false";
        }
        //alert(data_arr_guide);
        /////////
        var dt = {
            TourID: $("#id").val(),
            data: create_array_data_tour(),
            data_guest: data_arr_guide,
            data_id: data_arr_id,
            data_booking: array_data_booking(),
            AllontmentID1: str_Stage1_AllotmentID,
            AllontmentID2: str_Stage2_AllotmentID,
            roomno_stage1: Stage1_RoomNo,
            roomno_stage2: Stage2_RoomNo,
            delete_booking: delete_result,
            dt_guest: dt_guest,
            dt_id: dt_id
        };

        if (dt.data_booking == "") {
            dt.data_booking = "false";
        }
        if (dt.delete_booking.length == 0) {
            dt.delete_booking = "false";
        }
        if (dt.data_guest.length == 0) {
            dt.data_guest = "false";
        }
        if (dt.dt_guest.length == 0) {
            dt.dt_guest = "false";
        }
        var countbk = $("#table-booking-info > tbody > tr").length;
        if ($("#add-booking-list").prop("disabled") == false) {
            if (countbk == 0) {
                var r = confirm("Data hasn't been added to booking list yet. Do you want to continue ?");
                if (r) {
                    $.ajax({
                        async: false,
                        url: "<?php echo base_url('HotelBookingController/save_update_tour'); ?>",
                        type: "POST",
                        data: dt,
                        dataType: "json",                       
                        success: function(data) {
                            location.href = '<?php echo base_url();?>hotel-booking';
                        }
                    });
                } else {
                    return;
                }
            }
        } else {
            $.ajax({
               async: false,
               url: "<?php echo base_url('HotelBookingController/save_update_tour'); ?>",
               type: "POST",
               data: dt,
               dataType: "json",              
               success: function(data) {                 
                  location.href = '<?php echo base_url();?>hotel-booking?tour_code=' + $("#tour-code").val();
               }
            });
        }
    }

    function create_array_data_tour() {
        var list_result = {
            Location_Code: $("#location").val(),
            TourCode: $("#tour-code").val(),
            VnCode: $("#vn-code").val(),
            GroupName: $("#group-name").val(),
            TourStatus: $("#tour-status").val(),
            Note: $("#note-tour").val(),
            Cam_code: $("#campaign").val()
        }
        return list_result;
    }

    function clear_booking() {
        if ($('#menu_1').attr('class') == 'active') {
            $("#note-booking-1").val('');
            $("#arrv-date-1").val('');
            $("#dept-date-1").val('');
            $("#nite-no-1").val('');
            $("#pax-no-1").val('');
            $("#r-type-1").val('');
            $("#r-class-1").val('');
            $("#hotel-status-1").val('');
            $("#VN-Flight1").val('');
            $("#r-no-1").val('');
            $("#check-out-1").val('');
            $("#op1").val('');
            $("#check-box-allotment").attr('checked', false);
            $('#allotment-1').prop('hidden', true);
            $('#check_spe1').prop('checked', false);
            $('#holiday-no-1').prop('disabled', false);
            $('#holiday-no-1').val('');
            $("#add-room-1").hide();
            $("#r-type-1").removeAttr("disabled");
            $("#r-class-1").removeAttr("disabled");
            $("#r-no-1").removeAttr("disabled");
            $("#check-out-1").removeAttr("disabled");
        } else {
            $("#note-booking-2").val('');
            $("#arrv-date-2").val('');
            $("#dept-date-2").val('');
            $("#nite-no-2").val('');
            $("#pax-no-2").val('');
            $("#r-type-2").val('');
            $("#r-class-2").val('');
            $("#hotel-status-2").val('');
            $("#VN-Flight2").val('');
            $("#r-no-2").val('');
            $("#check-out-2").val('');
            $("#op2").val('');
            $("#check-box-allotment2").attr('checked', false);
            $('#allotment-2').prop('hidden', true);
            $('#check_spe').prop('checked', false);
            $('#holiday-no-2').prop('disabled', false);
            $('#holiday-no-2').val('');
            $("#add-room-2").hide();
            $("#r-type-2").removeAttr("disabled");
            $("#r-class-2").removeAttr("disabled");
            $("#r-no-2").removeAttr("disabled");
            $("#check-out-2").removeAttr("disabled");
        }
    }

    function clear_booking_list() {
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
        $("#delete-booking-list").attr("disabled", true);
        $("#clear-booking-list").attr("disabled", true);
        if ($('#menu_1').attr('class') == 'active') {
            $('#r-type-1').prop('disabled', false);
            $('#r-class-1').prop('disabled', false);
            $('#r-no-1').prop('disabled', false);
            $('#check-out-1').prop('disabled', false);
        } else {
            $('#r-type-2').prop('disabled', false);
            $('#r-class-2').prop('disabled', false);
            $('#r-no-2').prop('disabled', false);
            $('#check-out-2').prop('disabled', false);
        }
    }
    var FLG_Add_MoreRoom;

    function more_room()
    {
       if($('#menu_1').attr('class') == 'active')
       {
          if(flag_check_time)
          {
             $('#add-room-1').show();
             // $('.chung').attr('disabled', 'true');
          }
          $("#r-type-1").attr("disabled",true);
          $("#r-class-1").attr("disabled",true);
          $("#r-no-1").attr("disabled",true);
          $("#check-out-1").attr("disabled",true);

          $("#r-type-1").val("");
          $("#r-class-1").val("");
          $("#check-out-1").val("");
          $("#r-no-1").val("");
          $("#r-l-add").val(Room_List1);
          $("#check-box-allotment").prop("checked",false);
          $("#r-type-add").focus();
          $("#r-l-add").val($("#room-list-1").val());
       }
       else
       {
          $('#add-room-2').show();
          // $('.chung').attr('disabled', 'true');
          $("#r-type-2").attr("disabled",true);
          $("#r-class-2").attr("disabled",true);
          $("#r-no-2").attr("disabled",true);
          $("#check-out-2").attr("disabled",true);

          $("#r-type-2").val("");
          $("#r-class-2").val("");
          $("#check-out-2").val("");
          $("#r-no-2").val("");
          $("#r-l-add2").val(Room_List2);
          $("#check-box-allotment2").prop("checked",false);
          $("#r-type-add-2").focus();
          $("#r-l-add2").val($("#room-list-2").val());
       }
    }

    function get_niteno_paxno(stage) {
        FLG_Change = true;
        if (stage == "stage1") {
            var arrv_date_1 = $("#arrv-date-1").val();
            var dept_date_1 = $("#dept-date-1").val();
            var dt = {
                arr_date: arrv_date_1,
                dept_date: dept_date_1,

            };
            if (arrv_date_1 != "" && dept_date_1 != "") {
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_niteno_paxno'); ?>",
                    async: true,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        if (data.msg != "") {
                            alert(data.msg);
                            $("#arrv-date-1 > div > input").focus();
                            $('#nite-no-1').val(data.niteno);
                        } else {
                            $('#nite-no-1').val(data.niteno);
                        }
                    }
                });
            }
        } else if (stage == "stage2") {
            var arrv_date_2 = $("#arrv-date-2").val();
            var dept_date_2 = $("#dept-date-2").val();

            var dt = {
                arr_date: arrv_date_2,
                dept_date: dept_date_2
            };
            if (arrv_date_2 != "" && dept_date_2 != "") {
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_niteno_paxno'); ?>",
                    async: true,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        if (data.msg != "") {
                            alert(data.msg);
                            $("#arrv-date-2 > div > input").focus();
                            $('#nite-no-2').val(data.niteno);
                        } else {
                            $('#nite-no-2').val(data.niteno);
                        }

                    }
                });
            }
        }
    }


    function clear_more() {
        if ($('#menu_1').attr('class') == 'active') {
            $("#r-type-add").val("");
            $("#r-class-add").val("");
            $("#r-no-add").val("");
            $("#lc-add").val("");
            $("#ar-no-add").val("0");
            $("#r-l-add").val("");
        } else {
            $("#r-type-add-2").val("");
            $("#r-class-add-2").val("");
            $("#r-no-add2").val("");
            $("#lc-add2").val("");
            $("#ar-no-add2").val("0");
            $("#r-l-add2").val("");
        }
    }


    function mr_room() {
        if ($('#menu_1').attr('class') == 'active') {
            if (flag_check_time) {
                $('#add-room-1').hide();
                $('.chung').removeAttr('disabled');
            }
            $("#r-type-1").removeAttr("disabled");
            $("#r-class-1").removeAttr("disabled");
            $("#r-no-1").removeAttr("disabled");
            $("#check-out-1").removeAttr("disabled");
            $("#r-type-1").val("");
            $("#r-class-1").val("");
            $("#r-no-1").val("");
            $("#check-out-1").val("");
        } else {
            $('#add-room-2').hide();
            $('.chung').removeAttr('disabled');
            $("#r-type-2").removeAttr("disabled");
            $("#r-class-2").removeAttr("disabled");
            $("#r-no-2").removeAttr("disabled");
            $("#check-out-2").removeAttr("disabled");
            $("#r-type-2").val("");
            $("#r-class-2").val("");
            $("#r-no-2").val("");
            $("#check-out-2").val("");
        }
    }

    function back_home() {
        var type_back = $("#type-back").val();
        var type_srch = $("#type-srch").val();
        if (type_back == "1") {
            location.href = '<?php echo base_url();?>hotel-booking?sr_bk=' + type_srch;
        } else {
            location.href = '<?php echo base_url();?>transfer-management/update-tour-information';
        }
    }

    function Add_More_Room() {
        var obj_List_1 = "";
        var obj_Array_1 = [];
        var obj_List_2 = "";
        var obj_Array_2 = [];
        if ($('#menu_1').attr('class') == 'active') {
            if ($("#r-type-add").val() == "" || $("#r-class-add").val() == "" || $("#r-no-add").val() == "") {
                alert("Please input all data");
                return;
            }
            if ($("#check_spe1").prop("checked") == true) {
                /*sum price*/
                var dt = {
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    r_type: $("#r-type-add").val(),
                    r_class: $("#r-class-add").val(),
                    check_out: $("#lc-add").val(),
                    room_no_1: $("#r-no-add").val(),
                    nite_no_1: $("#nite-no-1").val(),
                    pax_no_1: $("#pax-no-1").val(),
                    spe: $("#check_spe1").val()
                };

                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/GetPriceSPE'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        obj_List_1 = data.obj_List_1;
                    }
                });
                /*get class_name*/
                var class_name = $("#class-name-1").val();
                var dt = {
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    r_type: $("#r-type-add").val(),
                    r_class: $("#r-class-add").val()
                };

                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/GetHotelClassName'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        class_name += data.class_name + ",";
                    }
                });
                $("#class-name-1").val(class_name);
            } else {
                var dt = {
                    rtye: $("#r-type-add").val(),
                    rclass: $("#r-class-add").val(),
                    rno: $("#r-no-add").val(),
                    check_spe: $("#check_spe1").prop("checked"),
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    checkout: $("#lc-add").val(),
                    niteno: $("#nite-no-1").val(),
                    paxno: $("#pax-no-1").val(),
                    holiday: $("#holiday-no-1").val(),
                    vncode: $("#vn-code").val(),
                    arnomore: $('#ar-no-add').val(),
                    arrivedate: $('#arrv-date-1').val(),
                    deptdate: $('#dept-date-1').val()
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/GetPrice'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        obj_List_1 = data.obj_List_1;
                    }
                });
            }
            /*get hotel price*/
            var hotel_price = $("#hotel-price-1").val();
            var dt = {
                city: $("#city").val(),
                hotel: $("#hotel").val(),
                rtye: $("#r-type-add").val(),
                rclass: $("#r-class-add").val(),
                check_spe: $("#check_spe1").prop("checked"),
                vn_code: str_Static_VNCode
            };

            $.ajax({
                url: "<?php echo base_url('HotelBookingController/GetHotelPrice'); ?>",
                async: false,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data) {
                    hotel_price += data.hotel_price + ",";
                }
            });
            $("#hotel-price-1").val(hotel_price);
            /*get check_out*/
            var check_out = $("#list-check-out-1").val();
            if ($("#lc-add").val() != "") {
                check_out += $("#lc-add").val() + "[" + $("#r-type-add").val() + "/" + $("#r-class-add").val() + "] ;";
            } else {
                check_out += "12:00" + "[" + $("#r-type-add").val() + "/" + $("#r-class-add").val() + "] ;";
            }
            $("#list-check-out-1").val(check_out);
            /*HTL_Total1 & LC1*/
            obj_Array_1 = obj_List_1.split("+");
            HTL_Total1 = HTL_Total1 + parseFloat(obj_Array_1[0]);
            LC1 = LC1 + parseFloat(obj_Array_1[1]);
            $("#htl-total-1").val(HTL_Total1);
            $("#lc-1").val(LC1);
            /*Room List1*/
            if ($('#ar-no-add').val() == "" || isNaN($('#ar-no-add').val())) {
                alert('Invalid data format for "AR/No" field!!!');
            } else if (flag_check_time) {
                // alert(flag);
                var dt = {
                    rtye: $("#r-type-add").val(),
                    rclass: $("#r-class-add").val(),
                    rno: $("#r-no-add").val(),
                    check_spe: $("#check_spe1").prop("checked"),
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    checkout: $("#lc-add").val(),
                    niteno: $("#nite-no-1").val(),
                    paxno: $("#pax-no-1").val(),
                    holiday: $("#holiday-no-1").val(),
                    vncode: $("#vn-code").val(),
                    arnomore: $('#ar-no-add').val(),
                    arrivedate: $('#arrv-date-1').val(),
                    deptdate: $('#dept-date-1').val()
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/add_more_room'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        if (data.msg != "") {
                            alert(data.msg);
                        }
                        if (data.r_list != "") {
                            var r_list = $("#r-l-add").val();
                            $("#r-l-add").val(r_list + data.r_list);
                            $("#room-list-1").val($("#r-l-add").val());
                        }
                        str_Stage1_AllotmentID = data.allotment_id;
                        Stage1_RoomNo = data.room_no;
                        Alloment_list1 = data.allotment_list;
                    }
                });
                $("#r-type-add").val("");
                $("#r-class-add").val("");
                $("#r-no-add").val("");
                $("#lc-add").val("");
                $("#ar-no-add").val("0");
            }
        } else {
            if ($("#check_spe").prop("checked") == true) {
                var dt = {
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    r_type: $("#r-type-add-2").val(),
                    r_class: $("#r-class-add-2").val(),
                    check_out: $("#lc-add2").val(),
                    room_no_1: $("#r-no-add2").val(),
                    nite_no_1: $("#nite-no-2").val(),
                    pax_no_1: $("#pax-no-2").val(),
                    spe: $("#check_spe").val()
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/GetPriceSPE'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        obj_List_2 = data.obj_List_1;
                    }
                });

                var class_name = $("#class-name-2").val();
                var dt = {
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    r_type: $("#r-type-add-2").val(),
                    r_class: $("#r-class-add-2").val()
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/GetHotelClassName'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        class_name += data.class_name + ",";
                    }
                });
                $("#class-name-2").val(class_name);
            } else {
                var dt = {
                    rtye: $("#r-type-add-2").val(),
                    rclass: $("#r-class-add-2").val(),
                    rno: $("#r-no-add2").val(),
                    check_spe: $("#check_spe").prop("checked"),
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    checkout: $("#lc-add2").val(),
                    niteno: $("#nite-no-2").val(),
                    paxno: $("#pax-no-2").val(),
                    holiday: $("#holiday-no-2").val(),
                    vncode: $("#vn-code").val(),
                    arnomore: $('#ar-no-add2').val(),
                    arrivedate: $('#arrv-date-2').val(),
                    deptdate: $('#dept-date-2').val()
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/GetPriceSPE'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        obj_List_2 = data.obj_List_1;
                    }
                });
            }
            /*get hotel price*/
            var hotel_price = $("#hotel-price-2").val();
            var dt = {
                city: $("#city").val(),
                hotel: $("#hotel").val(),
                rtye: $("#r-type-add-2").val(),
                rclass: $("#r-class-add-2").val(),
                check_spe: $("#check_spe").prop("checked"),
                vn_code: str_Static_VNCode
            };
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/GetHotelPrice'); ?>",
                async: false,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data) {
                    hotel_price += data.hotel_price + ",";
                }
            });
            $("#hotel-price-2").val(hotel_price);
            /*get check_out*/
            var check_out = $("#list-check-out-2").val();
            if ($("#lc-add2").val() != "") {
                check_out += $("#lc-add2").val() + "[" + $("#r-type-add-2").val() + "/" + $("#r-class-add-2").val() + "] ;";
            } else {
                check_out += "12:00" + "[" + $("#r-type-add-2").val() + "/" + $("#r-class-add-2").val() + "] ;";
            }
            $("#list-check-out-2").val(check_out);
            /*HTL_Total1 & LC1*/
            obj_Array_2 = obj_List_2.split("+");
            HTL_Total2 = HTL_Total2 + parseFloat(obj_Array_2[0]);
            LC2 = LC2 + parseFloat(obj_Array_2[1]);
            $("#htl-total-2").val(HTL_Total2);
            $("#lc-2").val(LC2);
            if ($("#r-type-add-2").val() == "" || $("#r-class-add-2").val() == "" || $("#r-no-add2").val() == "") {
                alert("Please input all data");
            } else if ($('#ar-no-add2').val() == "" || isNaN($('#ar-no-add2').val())) {
                alert('Invalid data format for "AR/No" field!!!');
            } else if (flag_check_time) {
                // alert(flag);
                var dt = {
                    rtye: $("#r-type-add-2").val(),
                    rclass: $("#r-class-add-2").val(),
                    rno: $("#r-no-add2").val(),
                    check_spe: $("#check_spe").prop("checked"),
                    city: $("#city").val(),
                    hotel: $("#hotel").val(),
                    checkout: $("#lc-add2").val(),
                    niteno: $("#nite-no-2").val(),
                    paxno: $("#pax-no-2").val(),
                    holiday: $("#holiday-no-2").val(),
                    vncode: $("#vn-code").val(),
                    arnomore: $('#ar-no-add2').val(),
                    arrivedate: $('#arrv-date-2').val(),
                    deptdate: $('#dept-date-2').val()
                };
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/add_more_room'); ?>",
                    async: false,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    success: function(data) {
                        if (data.msg != "") {
                            alert(data.msg);
                        }
                        if (data.r_list != "") {
                            var r_list = $("#r-l-add2").val();
                            $("#r-l-add2").val(r_list + data.r_list);
                            $("#room-list-2").val($("#r-l-add2").val());
                        }
                        str_Stage2_AllotmentID = data.allotment_id;
                        Stage2_RoomNo = data.room_no;
                        Alloment_list2 = data.allotment_list;
                    }
                });
                $("#r-type-add-2").val("");
                $("#r-class-add-2").val("");
                $("#r-no-add2").val("");
                $("#lc-add2").val("");
                $("#ar-no-add2").val("0");
            }
        }
    }

    function allotment_change()
    {
       if($("#check-box-allotment").prop('checked')==true)
       {
          $('#allotment-1').prop('hidden',false);
          // $('#allotment-1').val("0");
          $('#lb-allotment-1').prop('hidden',false);
          // $("#check-box-allotment").css('margin-left', 0);
       }
       else
       {
          $('#allotment-1').prop('hidden',true);
          $('#lb-allotment-1').prop('hidden',true);
          // $("#check-box-allotment").css('margin-left', '77px');
       }
    }

    function allotment_change2()
    {
       if($("#check-box-allotment2").prop('checked')==true)
       {
          $('#allotment-2').prop('hidden',false);
          $('#allotment-2').val("0");
          $('#lb-allotment-2').prop('hidden',false);
          $("#check-box-allotment2").css('margin-left', 0);

       }
       else
       {
          $('#allotment-2').prop('hidden',true);
          $('#lb-allotment-2').prop('hidden',true);
          $("#check-box-allotment2").css('margin-left', '77px');
       }
    }

    function get_rtypeandrclass() {
        var dt = {
            city: $("#city").val(),
            hotel: $("#hotel").val()
        };
        if ($("#city").val() != "" || $("#hotel").val() != "") {
            $("#from").attr("hidden", false);
            $("#back").attr("hidden", false);
        } else {
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
            $("#r-class-1").html("<option></option>");
            $("#r-class-2").html("<option></option>");
            $("#r-class-add").html("<option></option>");
            $("#r-class-add-2").html("<option></option>");
            $("#r-type-add-2").html("<option></option>");
        }
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
                success: function(data) {
                    result = data;
                }
            });
        } else {
            result = "";
        }

        return result;
    }

    function inArray(needle, haystack) {
        var length = haystack.length;
        for (var i = 0; i < length; i++) {
            if (haystack[i] == needle) return true;
        }
        return false;
    }

    function array_data_booking() {
        var i = 1;
        var rowCount = $('#table-booking-info tr').length;
        var list_result = [];
        for (i = 1; i < rowCount; i++) {
            if (!inArray(i, deleted_booking)) {
                list_result.push({
                    'City': $("#booking-" + i + " td:nth-child(1) ").html(),
                    'Hotel': $("#booking-" + i + " td:nth-child(2) ").html(),
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
                    'HTL_Total1': $("#booking-" + i + " td:nth-child(18) ").html(),
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
                    'HTL_Total2': $("#booking-" + i + " td:nth-child(31) ").html(),
                    'LC2': $("#booking-" + i + " td:nth-child(32) ").html(),
                    'SPE1': $("#check_spe1").prop("checked"),
                    'SPE2': $("#check_spe").prop("checked"),
                    'RoomList1': $("#booking-" + i + " td:nth-child(33) ").html(),
                    'RoomList2': $("#booking-" + i + " td:nth-child(34) ").html(),
                    'VNFlight1DeptDate': $("#booking-" + i + " td:nth-child(35) ").html(),
                    'VNFlight1DeptTime': $("#booking-" + i + " td:nth-child(36) ").html(),
                    'VNFlight1ArrvTime': $("#booking-" + i + " td:nth-child(37) ").html(),
                    'VNFlight2DeptDate': $("#booking-" + i + " td:nth-child(38) ").html(),
                    'VNFlight2DeptTime': $("#booking-" + i + " td:nth-child(39) ").html(),
                    'VNFlight2ArrvTime': $("#booking-" + i + " td:nth-child(40) ").html(),
                    'AllotmentList1_Old': $("#booking-" + i + " td:nth-child(41) ").html(),
                    'AllotmentList2_Old': $("#booking-" + i + " td:nth-child(42) ").html(),
                    'Transfer_price1': $("#booking-" + i + " td:nth-child(43) ").html(),
                    'Transfer_price2': $("#booking-" + i + " td:nth-child(44) ").html(),
                    'HoilidaySum1': $("#booking-" + i + " td:nth-child(45) ").html(),
                    'HoilidaySum2': $("#booking-" + i + " td:nth-child(46) ").html(),
                    'AllotmentList1': $("#booking-" + i + " td:nth-child(47) ").html(),
                    'AllotmentList2': $("#booking-" + i + " td:nth-child(48) ").html(),
                    'Allotment1_Old': $("#booking-" + i + " td:nth-child(49) ").html(),
                    'Allotment2_Old': $("#booking-" + i + " td:nth-child(50) ").html()
                });
            }
        }
        return list_result;
    }

    function get_pax_no() {
        var dem = 0;
        $("#table-guide > tbody > tr > td > input").each(function() {
            if ($(this).val() != "") {
                dem++;
            }
        });

        $("#pax-no-1").val(dem);
        $("#pax-no-2").val(dem);
    }

    function getguide() {
        var i = 0;
        $("#table-guide > tbody > tr > td > input").each(function() {
            if ($(this).val() != "") {

                i++;
            }
        });
        $("#pax-no-1").val(i);
        $("#pax-no-2").val(i);
    }
</script>
<script type="text/javascript">
    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }
    $(document).ready(function() {
        $('#menu_1, #menu_2').click(function() {
            $('#add-room-1, #add-room-2').css('display', 'none');
        });
    });
</script>