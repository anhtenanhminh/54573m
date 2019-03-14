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
				<h4>Employee Info</h4>
			</div>
		</div>
		<div class="row row-border" style="margin-bottom: 11px;">
			<div class="title-row-div">
				<label class="title-row">Personal info:</label>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Staff ID</label> <input type="text"
							class="form-control select-size chung input-small" id="vn-code"
							style="height: 30px;"> <label class="label-item">Staff Name</label>
						<input type="text"
							class="form-control select-size chung input-small"
							id="group-name" style="height: 30px;"> <label class="label-item"
							style="height: 50px;">D.O.B.</label> <input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()">
						<div class="form-inline form-margin-bottom" style="color: blue;">
							<label class="title-row">Working Info:</label>
						</div>
						<label class="label-item">Office</label> <input type="text"
							class="form-control select-size chung input-small" id="vn-code"
							style="height: 30px;"> <label class="label-item">Branch</label> <input
							type="text" class="form-control select-size chung input-small"
							id="group-name" style="height: 30px;"> <label class="label-item">Dept</label>
						<input type="text"
							class="form-control select-size chung input-small"
							id="group-name" style="height: 30px;">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Last Name</label> <input type="text"
							class="form-control select-size chung input-small"
							id="group-name" style="height: 30px;"> <label class="label-item">Middle
							Name</label> <input type="text"
							class="form-control select-size chung input-small"
							id="group-name" style="height: 30px;"> <label class="label-item"
							style="height: 50px;">First Name</label> <input type="text"
							class="form-control select-size chung input-small" id="note"
							style="height: 30px;">
						<div class="form-inline form-margin-bottom" style="color: white;">
							<label class="title-row">---</label>
						</div>
						<label class="label-item">Working stt</label> <input type="text"
							class="form-control select-size chung input-small" id="vn-code"
							style="height: 30px;"> <label class="label-item">Joined</label> <input
							type="text" class="form-control select-size chung input-small"
							id="group-name" style="height: 30px;"> <label class="label-item">Resigned</label>
						<input type="text"
							class="form-control select-size chung input-small"
							id="group-name" style="height: 30px;">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<label class="label-item">Note:</label> <input type="text"
					class="form-control select-size chung input-small" id="group-name"
					style="height: 215px;">
			</div>
			<div class="col-md-3">
				<button class="btn btn-sm button-md btn-primary btn-action chung"
					onclick="clear_tour()">Clear</button>
				<button class="btn btn-sm button-md btn-primary btn-action chung"
					onclick="clear_tour()">Clear</button>
				<button class="btn btn-sm button-md btn-primary btn-action chung"
					onclick="clear_tour()">Clear</button>
				<button class="btn btn-sm button-md btn-primary btn-action chung"
					onclick="clear_tour()">Clear</button>
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
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()"> <label class="label-item">AD</label> <input
							type="text" class="input-small form-control select-size chung"
							id="tour-code" required="required" style="height: 30px;"
							onchange="change_flag()"> <label class="label-item">Hisgo</label>
						<input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()"> <label class="label-item">Nippo</label>
						<input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()"> <label class="label-item">Challenge</label>
						<input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()"> <label class="label-item">Vacation</label>
						<input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()">

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Domain</label> <input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()"> <label class="label-item">Created Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">Created Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">Created Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">Created Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">Created Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Alias 1</label> <input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()"> <label class="label-item">CLC Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">CLC Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">CLC Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">CLC Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>
						<label class="label-item">CLC Date</label>
						<div id="arrv-date-1"
							class="form-group bfh-datepicker select-size-md chung"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="arrv-date-1"
							data-input="form-control input-sm"
							data-date="<?php echo date('Y/m/d') ?>"
							onchange="get_niteno_paxno('stage1')"></div>

					</div>
				</div>

			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Alias 2</label> <input type="text"
							class="input-small form-control select-size chung" id="tour-code"
							required="required" style="height: 30px;"
							onchange="change_flag()">

						<div class="col-md-1">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item"> </label>
									<button
										class="btn btn-sm button-md btn-primary btn-action chung"
										onclick="clear_tour()">Clear</button>
									<button
										class="btn btn-sm button-md btn-primary btn-action chung"
										onclick="clear_tour()">Clear</button>
									<button
										class="btn btn-sm button-md btn-primary btn-action chung"
										onclick="clear_tour()">Clear</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>