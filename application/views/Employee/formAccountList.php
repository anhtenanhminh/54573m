
<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
/*Account information Form */

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
	height: 275px !important;
}

#div-acc-list {
	height: 250px !important;
}
.very-small {
	width: 55px !important;
}
</style>

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<div class="content" style="width: 95%">
	<div class="container" style="width: 95%">
		<div class="row">
			<div class="col-md-5" style="padding-top: 15px">
				<div class="title-row-div">
					<label class="title-row" style="font-size: 25px">Employee's account
						Information</label>
				</div>
			</div>
			<div class="col-md-5 col-md-offset-2" style="padding-top: 10px">
				<div class="row">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<input type = hidden class="form-control input-sm select-size-sm" id="staffID">
							<label class="label-item" style="width: 50px">Branch</label>
							<select class="form-control input-sm select-size-sm"
								id="staffBranch">
								<option></option>
								<?php if($branches) {foreach($branches as $branch) { ?>
								<option value="<?php echo $branch['staffBranch']?>"><?php echo $branch['staffBranch']?></option>
								<?php }}?>	
							</select>
						</div>
						<div class="form-group">
							<label class="label-item" style="width: 50px">Office</label>
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

				</div>
			</div>
			<div class="col-md-11">
				<div class="row row-border-1 table-border">
					<div class="title-row-div">
						<label class="title-row">Account's Detail</label>
					</div>
					<div class="list-scroll" id="div-acc-list">
						<div class="col-md-11">
						<label class="label-item">Email ID</label>
						<input type="text" id="emailidlb" class="form-control input-sm select-size" style="display:inline-block" value=" ">
						<input type="text" id="domainlb" class="form-control input-sm select-size" style="display:inline-block" value=" ">
						<input type="text" id="alias1lb" class="form-control input-sm select-size" style="display:inline-block" value=" ">
						<input type="text" id="alias2lb" class="form-control input-sm select-size" style="display:inline-block" value=" ">
						</div>
						<div class="col-md-11">
						<div class="col-md-3">
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">RQ Date: </label>
									<div id="emailrqlb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										data-format="y-m-d"
										data-align="right" data-name="emailrqlb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
            						<label class="label-item">Create: </label>
            						<div id="emailcreatelb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										data-format="y-m-d"
										data-align="right" data-name="emailclclb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
        							<label class="label-item">Delete: </label>
        							<div id="emailclclb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										data-format="y-m-d"
										data-align="right" data-name="emailclclb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="col-md-11">
							<div class="col-md-3">
								<label style="width:60px" class="label-item">Hisgo ID</label>
								<input type="text" id="hisgolb" class="form-control input-sm select-size-xsm" style="display:inline-block" value=" ">
							</div>
							<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">RQ Date: </label>
									<div id="hisgorqlb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										data-format="y-m-d"
										data-align="right" data-name="hisgorqlb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
            						<label class="label-item">Create: </label>
            						<div id="hisgocreatelb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										data-format="y-m-d"
										data-align="right" data-name="hisgocreatelb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
        							<label class="label-item">Delete: </label>
        							<div id="hisgoclclb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="hisgoclclb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						</div>
    					<div class="col-md-11">
							<div class="col-md-3">
								<label style="width:60px" class="label-item">Nippo ID</label>
								<input type="text" id="nippolb" class="form-control input-sm select-size-xsm" style="display:inline-block" value=" ">
							</div>
							<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">RQ Date: </label>
									<div id="nipporqlb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="nipporqlb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
            						<label class="label-item">Create: </label>
            						<div id="nippocreatelb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="nippocreatelb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
        							<label class="label-item">Delete: </label>
        							<div id="nippoclclb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="nippoclclb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						</div>
    					<div class="col-md-11">
							<div class="col-md-3">
								<label style="width:60px" class="label-item">Chal ID</label>
								<input type="text" id="challengelb" class="form-control input-sm select-size-xsm" style="display:inline-block" value=" ">
							</div>
							<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">RQ Date: </label>
									<div id="challengerqlb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="challengerqlb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
            						<label class="label-item">Create: </label>
            						<div id="challengecreatelb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="challengecreatelb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
        							<label class="label-item">Delete: </label>
        							<div id="challengeclclb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="challengeclclb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						</div>
    					<div class="col-md-11">
							<div class="col-md-3">
								<label style="width:60px" class="label-item">Vac ID</label>
								<input type="text" id="vacationlb" class="form-control input-sm select-size-xsm" style="display:inline-block" value=" ">
							</div>
							<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">RQ Date: </label>
									<div id="vacationrqlb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="vacationrqlb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
            						<label class="label-item">Create: </label>
            						<div id="vacationcreatelb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="vacationcreatelb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
        							<label class="label-item">Delete: </label>
        							<div id="vacationclclb" style="width:125px; display:inline-block"
										class="bfh-datepicker"
										 data-format="y-m-d"
										data-align="right" data-name="vacationclclb"
										data-input="form-control input-sm" data-date="">
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Detail nhan vien -->
	</div>
</div>
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
					scrollY: 250,
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
						{"data":"WorkStt", "title":"Wrk Stt"},
						{"data":"Email", "title":"Email ID"},
						{"data":"Hisgo", "title":"Hisgo ID"},
						{"data":"Nippo", "title":"Nippo ID"},
						{"data":"Challenge", "title":"Chal ID"},
						{"data":"Vacation", "title":"Vac ID"},
						{"data":"Other", "title":"Other"},
						{"data":"EmailHistory", "title":"Email History"},
						/*{"data":"staffBranch", "title":"Branch"},
						{"data":"StaffOffice", "title":"Office"},
						{"data":"StaffDept", "title":"Dept."},
						{"data":"DOB", "title":"DOB"},
						{"data":"JoinedDate", "title":"Joined"},
						{"data":"ResignedDate", "title":"Resigned"},
						
						{"data":"Note", "title":"Note"},
						*/
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
    	    $("#emailidlb").val(staffTable.row(this).data().Email);
    	    $("#domainlb").val(staffTable.row(this).data().Domain);
    	    $("#alias1lb").val(staffTable.row(this).data().Alias1);
    	    $("#alias2lb").val(staffTable.row(this).data().Alias2);
    	    $("#emailrqlb").val(staffTable.row(this).data().EmailRQ);
    	    $("#emailcreatelb").val(staffTable.row(this).data().EmailCreate);
    	    $("#emailclclb").val(staffTable.row(this).data().EmailCLC);
    	    $("#emailhistorylb").val(staffTable.row(this).data().EmailHistory);
    	    $("#adlb").val(staffTable.row(this).data().AD);
    	    $("#adcreatelb").val(staffTable.row(this).data().ADCreate);
    	    $("#adclclb").val(staffTable.row(this).data().ADCLC);
    	    $("#nippolb").val(staffTable.row(this).data().Nippo);
    	    $("#nipporqlb").val(staffTable.row(this).data().NippoRQ);
    	    $("#nippocreatelb").val(staffTable.row(this).data().NippoCreate);
    	    $("#nippoclclb").val(staffTable.row(this).data().NippoCLC);
    	    $("#hisgolb").val(staffTable.row(this).data().Hisgo);
    	    $("#hisgorqlb").val(staffTable.row(this).data().HisgoRQ);
    	    $("#hisgocreatelb").val(staffTable.row(this).data().HisgoCreate);
    	    $("#hisgoclclb").val(staffTable.row(this).data().HisgoCLC);
    	    $("#challengelb").val(staffTable.row(this).data().Challenge);
    	    $("#challengerqlb").val(staffTable.row(this).data().ChallengeRQ);
    	    $("#challengecreatelb").val(staffTable.row(this).data().ChallengeCreate);
    	    $("#challengeclclb").val(staffTable.row(this).data().ChallengeCLC);
    	    $("#vacationlb").val(staffTable.row(this).data().Vacation);
    	    $("#vacationrqlb").val(staffTable.row(this).data().VacationRQ);
    	    $("#vacationcreatelb").val(staffTable.row(this).data().VacationCreate);
    	    $("#vacationclclb").val(staffTable.row(this).data().VacationCLC);
    	    $("#otherlb").val(staffTable.row(this).data().Other);
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