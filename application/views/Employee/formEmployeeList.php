<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.selected {
	background-color: #397FDB;
}

table thead tr th {
	background-color: #2D6CA2;
	color: white;
	padding: 5px 2px;
}

.dataTables_scrollBody {
	height: 375px;
}

#table-staff-list tbody {
	overflow-y: scroll;
	width: 100% !important;
	height: 375px !important;
}
/* #div-staff-list anh huong chieu cao staff list, ket hop voi scrolly*/
#div-staff-list {
	height: 575px !important;
}

.very-small {
	width: 55px !important;
}
</style>

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<div class="content" style="width: 95%">
	<div class="container" style="width: 95%">
		<div class="row">
			<div class="col-md-4" style="padding-top: 15px">
				<div class="title-row-div">
					<label class="title-row" style="font-size: 25px">Employee
						Information</label>
				</div>
			</div>
			<div class="col-md-6 col-md-offset-2" style="padding-top: 10px">
				<div class="row">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<input type = hidden class="form-control input-sm select-size-sm" id="staffID">
							<label class="label-item">Branch</label>
							<select class="form-control input-sm select-size-sm"
								id="staffBranch">
								<option></option>
								<?php if($branches) {foreach($branches as $branch) { ?>
								<option value="<?php echo $branch['staffBranch']?>"><?php echo $branch['staffBranch']?></option>
								<?php }}?>	
							</select>
						</div>
						<div class="form-group">
							<label class="label-item">Office</label>
							<select
								class="form-control input-sm select-size-sm" id="StaffOffice">
								<option></option>
								<?php if($offices) {foreach($offices as $office) { ?>
								<option value="<?php echo $office['StaffOffice']?>"><?php echo $office['StaffOffice']?></option>
								<?php }}?>
							</select>
						</div>
						<div class="form-group" style="padding-top: 5px">
							<button class="btn btn-primary btn-sm button-md btn-action"
								onclick="clear_data()">Clear</button>
							<button
								class="btn-search btn btn-primary btn-sm button-md btn-action"
								onclick="get_data_search('')">Search</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bang ds nhan vien -->
		<div class="row">
			<div class="col-md-11">
				<div class="row row-border-1 table-border">
					<div class="title-row-div">
						<label class="title-row">Staff List</label>
					</div>
					<div class="list-scroll" id="div-staff-list">
						<table id="table-staff-list" class="nowrap cell-border"
							style="width: 100%">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-1" style="margin-top: 30px">
				<div class="button-action-div">
					<label>Staff's ID:</label><input type="text"
						class="form-control select-size-md chung input-sm" id="staffidlb"
						value=" ">
					<br> <button type="button"
						class="btn btn-sm button-lg btn-primary btn-action" id="btnUpdate"
						tabindex=8>Update</button>
					<button type="button"
						class="btn btn-sm button-lg btn-primary btn-action"
						id="btnViewDetail" tabindex=9>View Detail</button>
					<a href="<?php echo base_url('staffinfo/newstaff'); ?>"
						target="_blank">
						<button type="button"
							class="btn btn-sm button-lg btn-primary btn-action"
							id="btnNewStaff" tabindex=10>New Employee</button>
					</a>
					<button type="button"
						class="btn btn-sm button-lg btn-primary btn-action"
						onclick="staff_delete_record()" tabindex=11>Delete</button>
					<button type="button"
						class="btn btn-sm button-lg btn-primary btn-action"
						onclick="staff_reset_id()" tabindex=12>Reset ID</button>
					<br><br>
					<label id="lb-total">Total:</label><br>
					<label id="total-staff" class="red-label"></label><br>
					<label id="lb-total">Coming:</label><br>
					<label id="coming-staff" class="red-label"></label><br>
					<label id="lb-total">Working:</label><br>
					<label id="working-staff" class="red-label"></label><br>
					<label id="lb-total">Resigned:</label><br>
					<label id="resgined-staff" class="red-label"></label><br>

					
				</div>
			</div>
		</div>
		<!-- Detail nhan vien -->
	</div>
</div>
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!--  Modal View Detail-->
<div class="modal fade" id="myModalViewDetail" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="container" style="width: 100%">
				<div class="content">
					<div class="row row-border" style="margin-bottom: 11px;">
						<div class="form-group">
							<h4 style="margin-top: 6px; margin-bottom: 0px;">
								View Staff Detail
								<button type="button" class="btn btn-sm button-sm btn-primary"
									style="float: left;" id="btnUpdate_" data-dismiss="modal">Update</button>
								<button type="button" class="btn btn-sm button-sm btn-primary"
									style="float: right;" data-dismiss="modal">Back</button>
							</h4>
						</div>
						<div class="row line-strong" style="margin-top: 2px;"></div>
						<div class="title-row-div">
							<label class="title-row">Personal info:</label>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Staff ID</label> <input
										id="txtStaffID" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">Staff Name</label> <input
										id="txtStaffName" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">D.O.B.</label> <input
										id="txtDOB" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">Japanese</label> <input
										id="txtJP" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value="">
									<div class="form-inline form-margin-bottom"
										style="color: blue;">
										<label class="title-row">Working Info:</label>
									</div>
									<label class="label-item">Office</label> <input
										id="txtStaffOffice" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">Branch</label> <input
										id="txtStaffBranch" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">Dept</label> <input
										id="txtStaffDept" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value="">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Last Name</label> <input
										id="txtLastName" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">Middle Name</label> <input
										id="txtMiddleName" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item" style="height: 50px;">First
										Name</label> <input id="txtFirstName" type="text"
										style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value="">
									<div class="form-inline form-margin-bottom"
										style="color: white;">
										<label class="title-row">-</label> <label class="title-row">-</label>
									</div>
									<label class="label-item">Working stt</label> <input
										id="txtWorkStt" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">Joined</label> <input
										id="txtJoinedDate" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value=""> <label class="label-item">Resigned</label> <input
										id="txtResignedDate" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md input-view"
										value="">
								</div>
							</div>
						</div>
						<div class="col-md-3" style="width: 400px">
							<label class="label-item">Note:</label> <input id="txtNote"
								type="text" style="height: 215px;"
								class="form-control input-sm input-view" value="">
						</div>
					</div>
					<div class="row row-border" style="margin-bottom: 11px;">
						<div class="title-row-div">
							<label class="title-row">System Account Info:</label>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Email ID</label> <input type="text"
										id="txtEmail"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <input type="text" id="txtEmailAdd"
										class="input-small form-control select-size-xlg chung input-view"
										style="height: 30px;"> <label class="label-item">AD</label> <input
										type="text" id="txtAD"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Hisgo</label>
									<input type="text" id="txtHisgo"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Nippo</label>
									<input type="text" id="txtNippo"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Challenge</label>
									<input type="text" id="txtChallenge"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Vacation</label>
									<input type="text" id="txtVacation"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Domain</label> <input id="txtDomain"
										type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Created Date</label>
									<input id="txtEmailCreate" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Created Date</label>
									<input id="txtADCreate" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Created Date</label>
									<input id="txtHisgoCreate" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Created Date</label>
									<input id="txtNippoCreate" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Created Date</label>
									<input id="txtChallengeCreate" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;"> <label class="label-item">Created Date</label>
									<input id="txtVacationCreate" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Alias 1</label> <input type="text"
										class="input-small form-control select-size-md chung input-view"
										id="txtAlias1" required="required" style="height: 30px;"> <label
										class="label-item">CLC Date</label> 
									<input id="txtEmailCLC" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
									<label class="label-item">CLC Date</label>
									<input id="txtADCLC" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
									<label class="label-item">CLC Date</label>
									<input id="txtHisgoCLC" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
									<label class="label-item">CLC Date</label>
									<input id="txtNippoCLC" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
									<label class="label-item">CLC Date</label>
									<input id="txtChallengeCLC" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
									<label class="label-item">CLC Date</label>
									<input id="txtVacationCLC" type="text"
										class="input-small form-control select-size-md chung input-view"
										style="height: 30px;">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Alias 2</label> <input type="text"
										class="input-small form-control select-size-md chung input-view"
										id="txtAlias2" style="height: 30px;"> <label
										class="label-item">Others</label> <input type="text"
										class="input-small form-control select-size-md chung input-view"
										id="txtOther" style="height: 30px;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- End Modal View Detail -->

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<!--  Modal Update-->
<div class="modal fade" id="myModalUpdate" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="container" style="width: 100%">
				<div class="content">
					<div class="row row-border" style="margin-bottom: 11px;">
						<div class="form-group">
							<h4 style="margin-top: 6px; margin-bottom: 0px;">
								Updating Staff Detail
								<button type="button" class="btn btn-sm button-sm btn-primary"
									style="float: left;" id="btnSave"
									onclick="return staff_update()" data-dismiss="modal">Save</button>
									<button type="button" class="btn btn-sm button-sm btn-primary"
									style="float: left;" id="btnCheckdata">Check data</button>
								<button type="button" class="btn btn-sm button-sm btn-primary"
									style="float: right;" data-dismiss="modal">Back</button>
							</h4>
						</div>
						<div class="row line-strong" style="margin-top: 2px;"></div>
						<div class="title-row-div">
							<label class="title-row">Personal info:</label>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Staff ID</label>
									<input id="txtStaffID_u" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value="">
									<label class="label-item">Staff Name</label>
									<input id="txtStaffName_u" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value=""> 
									<label class="label-item">D.O.B.</label>
									<div id="txtDOB_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtDOB_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">Japanese</label> <input id="txtJP_u"
										type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value="">
									<div class="form-inline form-margin-bottom"
										style="color: blue;">
										<label class="title-row">Working Info:</label>
									</div>
									<label class="label-item">Office</label> <input
										id="txtStaffOffice_u" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value=""> <label
										class="label-item">Branch</label> <input id="txtStaffBranch_u"
										type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value=""> <label
										class="label-item">Dept</label> <input id="txtStaffDept_u"
										type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value="">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Last Name</label> <input
										id="txtLastName_u" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value=""> <label
										class="label-item">Middle Name</label> <input
										id="txtMiddleName_u" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value=""> <label
										class="label-item" style="height: 50px;">First Name</label> <input
										id="txtFirstName_u" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value="">
									<div class="form-inline form-margin-bottom"
										style="color: white;">
										<label class="title-row">-</label> <label class="title-row">-</label>
									</div>
									<label class="label-item">Working stt</label> <input
										id="txtWorkStt_u" type="text" style="height: 30px;"
										class="form-control input-sm select-size-md" value=""> <label
										class="label-item">Joined</label>
									<div id="txtJoinedDate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtJoinedDate_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">Resigned</label>
									<div id="txtResignedDate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtResignedDate_u"
										data-input="form-control input-sm" data-date=""></div>
								</div>
							</div>
						</div>
						<div class="col-md-3" style="width: 400px">
							<label class="label-item">Note:</label> <input id="txtNote_u"
								type="text" style="height: 215px;" class="form-control input-sm"
								value="">
						</div>
					</div>
					<div class="row row-border" style="margin-bottom: 11px;">
						<div class="title-row-div">
							<label class="title-row">System Account Info:</label>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Email ID</label> <input type="text"
										id="txtEmail_u"
										class="input-small form-control select-size-md chung"
										style="height: 30px;"> <input type="text" id="txtEmailAdd_u"
										class="input-small form-control select-size-xlg chung"
										style="height: 30px;"> <label class="label-item">AD</label> <input
										type="text" id="txtAD_u"
										class="input-small form-control select-size-md chung"
										style="height: 30px;"> <label class="label-item">Hisgo</label>
									<input type="text" id="txtHisgo_u"
										class="input-small form-control select-size-md chung"
										style="height: 30px;"> <label class="label-item">Nippo</label>
									<input type="text" id="txtNippo_u"
										class="input-small form-control select-size-md chung"
										style="height: 30px;"> <label class="label-item">Challenge</label>
									<input type="text" id="txtChallenge_u"
										class="input-small form-control select-size-md chung"
										style="height: 30px;"> <label class="label-item">Vacation</label>
									<input type="text" id="txtVacation_u"
										class="input-small form-control select-size-md chung"
										style="height: 30px;">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Domain</label> <input
										id="txtDomain_u" type="text"
										class="input-small form-control select-size-md chung"
										style="height: 30px;"> <label class="label-item">Created Date</label>
									<div id="txtEmailCreate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtEmailCreate_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">Created Date</label>
									<div id="txtADCreate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtADCreate_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">Created Date</label>
									<div id="txtHisgoCreate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtHisgoCreate_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">Created Date</label>
									<div id="txtNippoCreate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtNippoCreate_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">Created Date</label>
									<div id="txtChallengeCreate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtChallengeCreate_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">Created Date</label>
									<div id="txtVacationCreate_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtVacationCreate_u"
										data-input="form-control input-sm" data-date=""></div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Alias 1</label> <input type="text"
										class="input-small form-control select-size-md chung"
										id="txtAlias1_u" required="required" style="height: 30px;">
									<label class="label-item">CLC Date</label>
									<div id="txtEmailCLC_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtEmailCLC_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">CLC Date</label>
									<div id="txtADCLC_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtHisgoCLC_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">CLC Date</label>
									<div id="txtHisgoCLC_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtHisgoCLC_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">CLC Date</label>
									<div id="txtNippoCLC_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtNippoCLC_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">CLC Date</label>
									<div id="txtChallengeCLC_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtChallengeCLC_u"
										data-input="form-control input-sm" data-date=""></div>
									<label class="label-item">CLC Date</label>
									<div id="txtVacationCLC_u"
										class="form-group bfh-datepicker select-size-md chung"
										data-placeholder="yyyy-mm-dd" data-format="y-m-d"
										data-align="right" data-name="txtVacationCLC_u"
										data-input="form-control input-sm" data-date=""></div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Alias 2</label> <input
										id="txtAlias2_u" type="text"
										class="input-small form-control select-size-md chung"
										style="height: 30px;"> <label class="label-item">Others</label>
									<input id="txtOther_u" type="text"
										class="input-small form-control select-size-md chung"
										style="height: 30px;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Update Detail -->

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<!-- script -->
<script
	src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
		var staffTable = false;
		var staff_ID = "";
		var value = "";
		var recordidindb = "";
		$(document).ready(function(){
			$('#staffidlb').attr("readonly", true);
			get_data_search("");
			/*get office when select bracnh*/
			$('#staffBranch').change(function () {
				var staffBranch=$(this).val();
				$.ajax({   
					url: "<?php echo base_url('StaffInfoController/get_staffoffice'); ?>",
					async: false,
					type: "POST",  
					data: "staffBranch="+ branch, 
					dataType: "html",				                         
					success: function(data) {
						$('#StaffOffice').html(data);
					}
				});
			});
		});

		//Nut clear
		function clear_data()
		{
			$("#staffBranch").val("");
			$("#StaffOffice").val("");
		}
		
		//Ham Search & load staffTable
		function get_data_search(id) {
			$("#staffID").val(id);
			if (staffTable) {
				staffTable.ajax.reload();
			} else {
				staffTable = $("#table-staff-list").DataTable({
					responsive: true,
					//anh huong chieu cao staff list
					scrollY: 550,
					paging: false,
					searching: false,
					scrollX: true,
					info: false,
					order:[],
					ajax: {
						url: "<?php echo base_url('StaffInfoController/get_data_search_staffoffice_list'); ?>",
						async: false,
						type: "POST",  
						data: function(x){
							x.staffBranch = $("#staffBranch").val();
							x.StaffOffice = $("#StaffOffice").val();
							x.id = $("#staffID").val();
						},

						dataType: "json",
						dataSrc: "tableData"
					},
					columns: [
						{"data":"StaffID", "title":"StaffID"},
						{"data":"StaffName", "title":"Full Name"},
						{"data":"staffBranch", "title":"Branch"},
						{"data":"StaffOffice", "title":"Office"},
						{"data":"StaffDept", "title":"Dept."},
						{"data":"WorkStt", "title":"Wrk Stt"},
						{"data":"DOB", "title":"DOB"},
						{"data":"JoinedDate", "title":"Joined"},
						{"data":"ResignedDate", "title":"Resigned"},
						{"data":"Email", "title":"Email ID"},
						{"data":"Note", "title":"Note"},
					],
					"processing": true,
					"columnDefs": [ {
			            "searchable": false,
			            "orderable": false,
			            "targets": 0
			        } ]
				});
			}			
		}
		// End search
		
		//click chon 1 dong record, lay StaffID
    	$('#table-staff-list tbody').on( 'click', 'tr', function () {
    		staffTable.$('tr.selected').removeClass('selected');
    	    $(this).addClass('selected');
    	    var recordId = staffTable.row(this).data().StaffID;
    	    recordidindb = staffTable.row(this).data().id;
    	    $("#staffidlb").val(recordId);
    		value = recordId;
    	});
		
		/*Load data modal view detail*/
		$("#btnViewDetail").click(function(){
			var flag = $("#table-staff-list > tbody > tr").length;
			if(value.length < 3){
				 alert("Please choose a staff from list!");
				 return;
			}
			if(flag > 0){
				var dt = {	
						'searchid'  : $("#staffidlb").val()
				};  	
				$.ajax({
		            url: "<?php echo base_url('StaffInfoController/get_staff_detail'); ?>",
		            async: true,
		            type: "POST",
		            data: dt,
		            dataType: "json",
		            beforeSend : function(){
		            	$("body").css("cursor","wait");
		            },
		            complete: function(){
		    			$("body").css("cursor","default");
		    			$("#myModalViewDetail").modal();
		            },
		            success: function(data) {
			            
		            	/*insert type readonly all input view*/	            	
						$(".input-view").attr("readonly", "true");
						/*end insert type readonly all input view*/	 
											
		            	/*load staff info */
		            	
		            	console.log(data);
		            	$("#txtStaffID").val(data[0]["StaffID"]);
		        		$("#txtStaffName").val(data[0]["StaffName"]);  
		        		$("#txtDOB").val(data[0]["DOB"]);  
		        		$("#txtJP").val(data[0]["JP"]);
		        		$("#txtLastName").val(data[0]["LastName"]);    
		        		$("#txtMiddleName").val(data[0]["MiddleName"]);    
		        		$("#txtFirstName").val(data[0]["FirstName"]);    	
		        		$("#txtStaffOffice").val(data[0]["StaffOffice"]);
		        		$("#txtStaffBranch").val(data[0]["staffBranch"]);
		        		$("#txtStaffDept").val(data[0]["StaffDept"]);  
		        		$("#txtWorkStt").val(data[0]["WorkStt"]);  
		        		$("#txtJoinedDate").val(data[0]["JoinedDate"]);    
		        		$("#txtResignedDate").val(data[0]["ResignedDate"]);    
		        		$("#txtNote").val(data[0]["Note"]);	
		        		$("#txtEmail").val(data[0]["Email"]);
		        		$("#txtDomain").val(data[0]["Domain"]);
		        		if(data[0]["Email"]!=""){     
		        		$("#txtEmailAdd").val(data[0]["Email"]+data[0]["Domain"]);
		        		}
		        		else {
		        			$("#txtEmailAdd").val("");
		        		}
		        		$("#txtAlias1").val(data[0]["Alias1"]);    
		        		$("#txtAlias2").val(data[0]["Alias2"]);
		        		$("#txtEmailCreate").val(data[0]["EmailCreate"]);    
		        		$("#txtEmailCLC").val(data[0]["EmailCLC"]);
		        		$("#txtAD").val(data[0]["AD"]);    
		        		$("#txtADCreate").val(data[0]["ADCreate"]);    
		        		$("#txtADCLC").val(data[0]["ADCLC"]);    
		        		$("#txtHisgo").val(data[0]["Hisgo"]);        
		        		$("#txtHisgoCreate").val(data[0]["HisgoCreate"]);    
		        		$("#txtHisgoCLC").val(data[0]["HisgoCLC"]); 
		        		$("#txtNippo").val(data[0]["Nippo"]);    
		        		$("#txtNippoCreate").val(data[0]["NippoCreate"]);    
		        		$("#txtNippoCLC").val(data[0]["NippoCLC"]); 
		        		$("#txtChallenge").val(data[0]["Challenge"]);    
		        		$("#txtChallengeCreate").val(data[0]["ChallengeCreate"]);    
		        		$("#txtChallengeCLC").val(data[0]["ChallengeCLC"]); 
		        		$("#txtVacation").val(data[0]["Vacation"]);    
		        		$("#txtVacationCreate").val(data[0]["VacationCreate"]);    
		        		$("#txtVacationCLC").val(data[0]["VacationCLC"]); 
		        		$("#txtOther").val(data[0]["Other"]);

		        		            	
		            	/*end load staff info*/            	
		            }

		        });		
				
			};
		});
		/*End Load data modal view detail*/
		/*Load data modal update*/
		$("#btnUpdate").click(function(){
			var flag = $("#table-staff-list > tbody > tr").length;
			if(value.length < 3){
				 alert("Please choose a staff from list!");
				 return;
			}
			else{
				var dt = {	
						'searchid'  : $("#staffidlb").val()
				};  	
				$.ajax({
		            url: "<?php echo base_url('StaffInfoController/get_staff_detail'); ?>",
		            async: true,
		            type: "POST",
		            data: dt,
		            dataType: "json",
		            beforeSend : function(){
		            	$("body").css("cursor","wait");
		            },
		            complete: function(){
		    			$("body").css("cursor","default");
		    			$("#myModalUpdate").modal();
		            },
		            success: function(data) {
			            
		            	/*insert type readonly all input view*/	            	
						$("#btnSave").attr("disabled",false);	
						/*end insert type readonly all input view*/	 
											
		            	/*load staff info */
		            	
		            	//console.log(data);
		            	$("#txtStaffID_u").val(data[0]["StaffID"]);
		        		$("#txtStaffName_u").val(data[0]["StaffName"]);  
		        		$("#txtDOB_u").val(data[0]["DOB"]);  
		        		$("#txtJP_u").val(data[0]["JP"]);
		        		$("#txtLastName_u").val(data[0]["LastName"]);    
		        		$("#txtMiddleName_u").val(data[0]["MiddleName"]);    
		        		$("#txtFirstName_u").val(data[0]["FirstName"]);    	
		        		$("#txtStaffOffice_u").val(data[0]["StaffOffice"]);
		        		$("#txtStaffBranch_u").val(data[0]["staffBranch"]);
		        		$("#txtStaffDept_u").val(data[0]["StaffDept"]);  
		        		$("#txtWorkStt_u").val(data[0]["WorkStt"]);  
		        		$("#txtJoinedDate_u").val(data[0]["JoinedDate"]);    
		        		$("#txtResignedDate_u").val(data[0]["ResignedDate"]);    
		        		$("#txtNote_u").val(data[0]["Note"]);	
		        		$("#txtEmail_u").val(data[0]["Email"]);
		        		$("#txtDomain_u").val(data[0]["Domain"]);     
		        		$("#txtEmailAdd_u").val(data[0]["Email"]+data[0]["Domain"]);
		        		$("#txtAlias1_u").val(data[0]["Alias1"]);    
		        		$("#txtAlias2_u").val(data[0]["Alias2"]);
		        		$("#txtEmailCreate_u").val(data[0]["EmailCreate"]);    
		        		$("#txtEmailCLC_u").val(data[0]["EmailCLC"]);    
		        		$("#txtAD_u").val(data[0]["AD"]);    
		        		$("#txtADCreate_u").val(data[0]["ADCreate"]);    
		        		$("#txtADCLC_u").val(data[0]["ADCLC"]);    
		        		$("#txtHisgo_u").val(data[0]["Hisgo"]);        
		        		$("#txtHisgoCreate_u").val(data[0]["HisgoCreate"]);    
		        		$("#txtHisgoCLC_u").val(data[0]["HisgoCLC"]); 
		        		$("#txtNippo_u").val(data[0]["Nippo"]);    
		        		$("#txtNippoCreate_u").val(data[0]["NippoCreate"]);    
		        		$("#txtNippoCLC_u").val(data[0]["NippoCLC"]); 
		        		$("#txtChallenge_u").val(data[0]["Challenge"]);    
		        		$("#txtChallengeCreate_u").val(data[0]["ChallengeCreate"]);    
		        		$("#txtChallengeCLC_u").val(data[0]["ChallengeCLC"]); 
		        		$("#txtVacation_u").val(data[0]["Vacation"]);    
		        		$("#txtVacationCreate_u").val(data[0]["VacationCreate"]);    
		        		$("#txtVacationCLC_u").val(data[0]["VacationCLC"]); 
		        		$("#txtOther_u").val(data[0]["Other"]);   	
		            	/*end load staff info*/            	
		            }
		        });		
				
			};
		});
		/*End Load data modal update*/		
		//button update when view
		$("#btnUpdate_").click(function(){
			var flag = $("#table-staff-list > tbody > tr").length;
			if(value.length < 3){
				 alert("Please choose a staff from list!");
				 return;
			}
			else{
				var dt = {	
						'searchid'  : $("#staffidlb").val()
				};  	
				$.ajax({
		            url: "<?php echo base_url('StaffInfoController/get_staff_detail'); ?>",
		            async: true,
		            type: "POST",
		            data: dt,
		            dataType: "json",
		            beforeSend : function(){
		            	$("body").css("cursor","wait");
		            },
		            complete: function(){
		    			$("body").css("cursor","default");
		    			$("#myModalUpdate").modal();
		            },
		            success: function(data) {
			            
		            	/*insert type readonly all input view*/	            	
						$("#btnSave").attr("disabled",false);	
						/*end insert type readonly all input view*/	 
											
		            	/*load staff info */
		            	
		            	//console.log(data);
		            	$("#txtStaffID_u").val(data[0]["StaffID"]);
		        		$("#txtStaffName_u").val(data[0]["StaffName"]);  
		        		$("#txtDOB_u").val(data[0]["DOB"]);  
		        		$("#txtJP_u").val(data[0]["JP"]);
		        		$("#txtLastName_u").val(data[0]["LastName"]);    
		        		$("#txtMiddleName_u").val(data[0]["MiddleName"]);    
		        		$("#txtFirstName_u").val(data[0]["FirstName"]);    	
		        		$("#txtStaffOffice_u").val(data[0]["StaffOffice"]);
		        		$("#txtStaffBranch_u").val(data[0]["staffBranch"]);
		        		$("#txtStaffDept_u").val(data[0]["StaffDept"]);  
		        		$("#txtWorkStt_u").val(data[0]["WorkStt"]);  
		        		$("#txtJoinedDate_u").val(data[0]["JoinedDate"]);    
		        		$("#txtResignedDate_u").val(data[0]["ResignedDate"]);    
		        		$("#txtNote_u").val(data[0]["Note"]);	
		        		$("#txtEmail_u").val(data[0]["Email"]);
		        		$("#txtDomain_u").val(data[0]["Domain"]);     
		        		$("#txtEmailAdd_u").val(data[0]["Email"]+data[0]["Domain"]);
		        		$("#txtAlias1_u").val(data[0]["Alias1"]);    
		        		$("#txtAlias2_u").val(data[0]["Alias2"]);
		        		$("#txtEmailCreate_u").val(data[0]["EmailCreate"]);    
		        		$("#txtEmailCLC_u").val(data[0]["EmailCLC"]);    
		        		$("#txtAD_u").val(data[0]["AD"]);    
		        		$("#txtADCreate_u").val(data[0]["ADCreate"]);    
		        		$("#txtADCLC_u").val(data[0]["ADCLC"]);    
		        		$("#txtHisgo_u").val(data[0]["Hisgo"]);        
		        		$("#txtHisgoCreate_u").val(data[0]["HisgoCreate"]);    
		        		$("#txtHisgoCLC_u").val(data[0]["HisgoCLC"]); 
		        		$("#txtNippo_u").val(data[0]["Nippo"]);    
		        		$("#txtNippoCreate_u").val(data[0]["NippoCreate"]);    
		        		$("#txtNippoCLC_u").val(data[0]["NippoCLC"]); 
		        		$("#txtChallenge_u").val(data[0]["Challenge"]);    
		        		$("#txtChallengeCreate_u").val(data[0]["ChallengeCreate"]);    
		        		$("#txtChallengeCLC_u").val(data[0]["ChallengeCLC"]); 
		        		$("#txtVacation_u").val(data[0]["Vacation"]);    
		        		$("#txtVacationCreate_u").val(data[0]["VacationCreate"]);    
		        		$("#txtVacationCLC_u").val(data[0]["VacationCLC"]); 
		        		$("#txtOther_u").val(data[0]["Other"]);   	
		            	/*end load staff info*/            	
		            }
		        });		
				
			};
		});
		/*End Load data modal update*/	

//     	$("#btnNewStaff").click(function(){
    		
//     	});		

		
		
function staff_delete_record(){
	if(recordidindb == ""){
		alert("Please choose a record in Staff List!")
		return;
	}
	else{
    	var r = confirm("This function will delete record on Database and cannot recovery! Do you want to continue?");
    	if (r) {
    		var pwdelete = prompt("Please enter PW", "Min");
    		if(pwdelete = "Min"){
    			var dt = {
    					recordid	: recordidindb
    			};
    			$.ajax({
    				async: false,
    				url  : "<?php echo base_url('StaffInfoController/delete_staffinfo_record'); ?>",
    				type : "POST",
    				data : dt,
    				dataType: "json",
    				success: function(data)
    				{
    					//console.log(data);
    					if (data.error == 0) {
    						get_data_search(' ');
    						$("#staffidlb").val("");
    						alert(data.msg);
    					}
    					else{
    						alert(data.msg);
    					}
    				}
    			});	
    		}
    		else alert("You can go to the hell!");
    	}
	}
}

		
function staff_reset_id(resetid){
	var resetid = $("#staffidlb").val();
	//alert(recordidindb);
	var newidinput = prompt("Please enter new ID", "StaffID");
	if (newidinput != null) {
		var dt = {
			oldrecordid			: recordidindb,
			recordnewstaffid	: newidinput
		};
		$.ajax({
			async: false,
			url  : "<?php echo base_url('StaffInfoController/resetid'); ?>",
			type : "POST",
			data : dt,
			dataType: "json",
			success: function(data)
			{
				console.log(data);
				if (data.error == 0) {
					get_data_search(' ');
					$("#staffidlb").val("");
					alert(data.msg);
				}
				else{
					alert(data.msg);
				}
			}
		});	
	}
	else alert("New ID invalid");
}

/**Update existed staff info
 * StaffID: disable to change
 *
 */
function staff_update(){
	 alert(recordidindb);
	var r = confirm("Data hasn't been added to booking list yet. Do you want to continue ?");
		if (r) {
			var dt = {	
					id 	    	: 	recordidindb,				
					data        :   collect_data_array()					
				};				
				$.ajax({
					async: false,
					url  : "<?php echo base_url('StaffInfoController/update_staffinfo_record'); ?>",
					async: false,
					type : "POST",
					data : dt,
					dataType: "json",
					success: function(data)
					{
						console.log(data);
						if (data['error'] == 0) {
							get_data_search(' ');
							$("#staffidlb").val("");
							alert(data.msg);
						}
						else{
							alert(data.msg);
						}
					}
				});	
			//alert("Chua lam xong");
		};
}

function collect_data_array()
{
	//gia tri StaffID khong the null, set truc tiep
	var data_array = {
		'StaffID' : $("#txtStaffID_u").val()
	};
	if ($("#txtFirstName_u").val()!="") 
		data_array["FirstName"] = $("#txtFirstName_u").val();
	if ($("#txtMiddleName_u").val()!="") 
		data_array["MiddleName"] = $("#txtMiddleName_u").val();
	if ($("#txtLastName_u").val()!="") 
		data_array["LastName"] = $("#txtLastName_u").val();
	if ($("#txtJP_u").val()!="") 
		data_array["JP"] = $("#txtJP_u").val();
	if ($("#txtStaffBranch_u").val()!="") 
		data_array["staffBranch"] = $("#txtStaffBranch_u").val();
	if ($("#txtStaffDept_u").val()!="") 
		data_array["StaffDept"] = $("#txtStaffDept_u").val();
	if ($("#txtStaffName_u").val()!="") 
		data_array["StaffName"] = $("#txtStaffName_u").val();
	if ($("#txtStaffOffice_u").val()!="") 
		data_array["StaffOffice"] = $("#txtStaffOffice_u").val();
	if ($("#txtWorkStt_u").val()!="") 
		data_array["WorkStt"] = $("#txtWorkStt_u").val();
	if ($("#txtDOB_u").val()!="") 
		data_array["DOB"] = $("#txtDOB_u").val();
	if ($("#txtJoinedDate_u").val()!="") 
		data_array["JoinedDate"] = $("#txtJoinedDate_u").val();
	if ($("#txtResignedDate_u").val()!="") 
		data_array["ResignedDate"] = $("#txtResignedDate_u").val();
	
	if ($("#txtDomain_u").val()!="") 
		data_array["Domain"] = $("#txtDomain_u").val();
	if ($("#txtAlias1_u").val()!="") 
		data_array["Alias1"] = $("#txtAlias1_u").val();
	if ($("#txtAlias2_u").val()!="") 
		data_array["Alias2"] = $("#txtAlias2_u").val();
	if ($("#txtEmail_u").val()!="") 
		data_array["Email"] = $("#txtEmail_u").val();
	if ($("#txtEmailCLC_u").val()!="") 
		data_array["EmailCLC"] = $("#txtEmailCLC_u").val();
	if ($("#txtEmailCreate_u").val()!="") 
		data_array["EmailCreate"] = $("#txtEmailCreate_u").val();
	if ($("#txtAD_u").val()!="") 
		data_array["AD"] = $("#txtAD_u").val();
	if ($("#txtADCLC_u").val()!="") 
		data_array["ADCLC"] = $("#txtADCLC_u").val();
	if ($("#txtADCreate_u").val()!="") 
		data_array["ADCreate"] = $("#txtADCreate_u").val();
	if ($("#txtChallenge_u").val()!="") 
		data_array["Challenge"] = $("#txtChallenge_u").val();
	if ($("#txtChallengeCLC_u").val()!="") 
		data_array["ChallengeCLC"] = $("#txtChallengeCLC_u").val();
	if ($("#txtChallengeCreate_u").val()!="") 
		data_array["ChallengeCreate"] = $("#txtChallengeCreate_u").val();
	if ($("#txtHisgo_u").val()!="") 
		data_array["Hisgo"] = $("#txtHisgo_u").val();
	if ($("#txtHisgoCLC_u").val()!="") 
		data_array["HisgoCLC"] = $("#txtHisgoCLC_u").val();
	if ($("#txtHisgoCreate_u").val()!="") 
		data_array["HisgoCreate"] = $("#txtHisgoCreate_u").val();
	if ($("#txtNippo_u").val()!="") 
		data_array["Nippo"] = $("#txtNippo_u").val();
	if ($("#txtNippoCLC_u").val()!="") 
		data_array["NippoCLC"] = $("#txtNippoCLC_u").val();
	if ($("#txtNippoCreate_u").val()!="") 
		data_array["NippoCreate"] = $("#txtNippoCreate_u").val();
	if ($("#txtVacation_u").val()!="") 
		data_array["Vacation"] = $("#txtVacation_u").val();
	if ($("#txtVacationCLC_u").val()!="") 
		data_array["VacationCLC"] = $("#txtVacationCLC_u").val();
	if ($("#txtVacationCreate_u").val()!="") 
		data_array["VacationCreate"] = $("#txtVacationCreate_u").val();

	return data_array;
}

$("#btnCheckdata").click(function(){
	 var data = collect_data_array();
	console.log(data);
});

</script>
<?php echo $this->load->view('Layout/footer')?>