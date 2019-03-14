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
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- html page -->
<div class="container" style="width: 80%">
	<div class="content">
		<div class="row row-border" style="margin-bottom: 11px;">
			<div class="form-group">
				<h4 style="margin-top: 6px; margin-bottom: 0px;">
					Add A New Staff Info		<?php echo $StaffName ?>					
					<button type="button" class="btn btn-sm button-sm btn-primary"
						style="float: right;" id="btnAdd" onclick="return staff_new()">Add</button>
					<button type="button" class="btn btn-sm button-sm btn-primary"
						style="float: left;" id="btnCheckindex"
						onclick="return checkindex()">Check index</button>
					<button type="button" class="btn btn-sm button-sm btn-primary"
						style="float: right;" id="btnClear" onclick="clear_input()">Clear</button>
					<button type="button" class="btn btn-sm button-sm btn-primary"
						style="float: right;" id="btnAddid" onclick="add_id()">Add ID</button>
					<button type="button" class="btn btn-sm button-sm btn-primary"
						style="float: right;" id="btnCheckinput" onclick="check_input()">CheckInput</button>
				</h4>
			</div>
			<div class="row line-strong" style="margin-top: 2px;"></div>
			<div class="title-row-div">
				<label class="title-row">Personal info:</label>
			</div>
			<div class = "row">
    			<div class="col-md-3">
    				<div class="form-inline form-margin-bottom form-group">
    						<label class="label-item">Staff ID</label>
    						<input id="txtStaffID_u" type="text" style="height: 30px;"
    							class="form-control input-sm select-size-md" value=""> <br>
    						<label class="label-item">Last Name</label> 
    						<input id="txtLastName_u" type="text" style="height: 30px;"
    							class="form-control input-sm select-size-md" value="">
    						<label class="label-item">Middle Name</label>
    						<input id="txtMiddleName_u" type="text" style="height: 30px;"
    							class="form-control input-sm select-size-md" value=""> <br>
							<label class="label-item">First Name</label>
							<input id="txtFirstName_u" type="text" style="height: 30px;"
							class="form-control input-sm select-size-md" value="">	 
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="form-inline form-margin-bottom form-group">
    						<label class="label-item">Staff Name</label>
    						<input id="txtStaffName_u" type="text" style="height: 30px;"
    							class="form-control input-sm select-size-lg" value="">
    						<label class="label-item">D.O.B.</label>
    						<div id="txtDOB_u"
    							class="form-group bfh-datepicker select-size-md chung"
    							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
    							data-align="right" data-name="txtDOB_u"
    							data-input="form-control input-sm" data-date=""></div><br>
    						<label class="label-item">Japanese</label>
    						<select class="form-control input-sm select-size-md" id="txtJP_u">
								<option>No</option>
								<option>Yes</option>
							</select>
    						
    				</div>
    			</div>
    			<div class="col-md-5">
					<label class="label-item">Note:</label> <input id="txtNote_u"
    					type="text" style="height: 150px;width: 100%" class="form-control input-sm"
    					value="">
				</div>
    		</div>
    		<!-- Het personal info -->
    		<div class="row title-row-div" style="display: inline-block; text-align: left">
				<label class="title-row">Working info:</label>
			</div>
    		<div class = "row">
    			<div class="col-md-3">
    				<div class="form-inline form-margin-bottom form-group">
    						<label class="label-item">Office</label>
    						<select class="form-control input-sm select-size-md" id="txtStaffOffice_u">
								<?php if($offices) {foreach($offices as $office) { ?>
								<option value="<?php echo $office['StaffOffice']?>"><?php echo $office['StaffOffice']?></option>
								<?php }}?>
							</select><br>
    						<label class="label-item">Branch</label>
    						<select class="form-control input-sm select-size-md" id="txtstaffBranch_u">
								<option></option>
								<?php if($branches) {foreach($branches as $branch) { ?>
								<option value="<?php echo $branch['staffBranch']?>"><?php echo $branch['staffBranch']?></option>
								<?php }}?>	
							</select> <br>
    						<label class="label-item">Dept</label>
    						<select class="form-control input-sm select-size-md" id="txtStaffDept_u">
								<option></option>
								<?php if($depts) {foreach($depts as $dept) { ?>
								<option value="<?php echo $dept['StaffDept']?>"><?php echo $dept['StaffDept']?></option>
								<?php }}?>	
							</select><br>
    				</div>
    			</div>
    			<div class="col-md-3">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
    						<label class="label-item">Working stt</label>
    						<select class="form-control input-sm select-size-md"
								id="txtWorkStt_u">
								<option>Coming</option><option>Working</option><option>Resigned</option>
								</select>
    						<!-- <input id="txtWorkStt_u" type="text" style="height: 30px;"
    							class="form-control input-sm select-size-md" value="">  -->
    							<br>
    						<label class="label-item">Joined</label>
    						<div id="txtJoinedDate_u"
    							class="form-group bfh-datepicker select-size-md chung"
    							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
    							data-align="right" data-name="txtJoinedDate_u"
    							data-input="form-control input-sm" data-date=""></div>
    						<br>
    						<label class="label-item">Resigned</label>
    						<div id="txtResignedDate_u"
    							class="form-group bfh-datepicker select-size-md chung"
    							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
    							data-align="right" data-name="txtResignedDate_u"
    							data-input="form-control input-sm" data-date=""></div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<!-- end html page -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- script -->
<script type="text/javascript">
/*
$("#txtStaffID_u").on("input", function(e) {
	  var input = $(this);
	  var val = input.val();

	  if (input.data("lastval") != val) {
	    input.data("lastval", val);

	    //your change action goes here 
	    //console.log(val);
	    //check_staffid();
	  }
	});
*/

/*co time out, nhap xong 1 chuoi roi moi xu ly*/
var timerid;
var noti;
$("#txtStaffID_u").on("input", function(e) {
  var value = $(this).val();
  if ($(this).data("lastval") != value) {

    $(this).data("lastval", value);
    clearTimeout(timerid);

    timerid = setTimeout(function() {
      //your change action goes here 
      //console.log(value);
    	//check_staffid();
    	check_input_onchange();
    }, 500);
  };
});

function capital_letter(str) 
{
    str = str.split(" ");

    for (var i = 0, x = str.length; i < x; i++) {
        str[i] = str[i][0].toUpperCase() + str[i].substr(1);
    }

    return str.join(" ");
}

//console.log(capital_letter("Write a JavaScript program to capitalize the first letter of each word of a given string."));

//remove duplicate white space in a string
String.prototype.allTrim = String.prototype.allTrim ||
     function(){
        return this.replace(/\s+/g,' ')
                   .replace(/^\s+|\s+$/,'');
     };


//connect Last Mid First name
function fullname($last, $middle, $first)
{
	var name = "";
	if($middle == "" || $middle == null)
	{
		name = name.concat($last," ",$first);
		name = name.trim();
	}else
	{
		name = name.concat($last," ",$middle," ",$first);
		name = name.trim();		
	}
	console.log(name);
	name = capital_letter(name.allTrim());
	return name;
}

//Excute txtStaffName_u
function staffname()
{
	str = fullname($("#txtLastName_u").val(),$("#txtMiddleName_u").val(),$("#txtFirstName_u").val());
	$("#txtStaffName_u").val(str);
	return str;
}

$("#txtLastName_u").on("input", function(lastname_onchange) {
	  var value = $(this).val();
	  if ($(this).data("lastval") != value) {

	    $(this).data("lastval", value);
	    clearTimeout(timerid);

	    timerid = setTimeout(function() {
	    	$("#txtLastName_u").val(capital_letter($("#txtLastName_u").val().trim()));
		  	console.log($("#txtLastName_u").val());
		  	var a = staffname();
	    }, 500);
	  };
	});

$("#txtMiddleName_u").on("input", function(middlename_onchange) {
	  var value = $(this).val();
	  if ($(this).data("lastval") != value) {

	    $(this).data("lastval", value);
	    clearTimeout(timerid);

	    timerid = setTimeout(function() {
	    	$("#txtMiddleName_u").val(capital_letter($("#txtMiddleName_u").val().trim()));
		  	console.log($("#txtMiddleName_u").val());
		  	var a = staffname();
	    }, 500);
	  };
	});

$("#txtFirstName_u").on("input", function(middlename_onchange) {
	  var value = $(this).val();
	  if ($(this).data("lastval") != value) {

	    $(this).data("lastval", value);
	    clearTimeout(timerid);

	    timerid = setTimeout(function() {
	    	$("#txtFirstName_u").val(capital_letter($("#txtFirstName_u").val().trim()));
		  	console.log($("#txtFirstName_u").val());
		  	var a = staffname();
	    }, 500);
	  };
	});


function check_staffid() 
{
	noti = "";
	var dt = {
			searchid: $("#txtStaffID_u").val()
			//$("#txtStaffID_u").val();
	};
	//console.log(dt);
	$.ajax({
		async: true,
		url  : "<?php echo base_url('StaffInfoController/get_staff_detail'); ?>",
		type : "POST",
		data : dt,
		dataType: "json",
		success: function(data)
		{
			console.log(data);
			if(data.length != 0){
			$("#txtStaffName_u").val(data[0]["StaffName"]);  
			$("#txtDOB_u").val(data[0]["DOB"]);  
    		$("#txtJP_u").val(data[0]["JP"]);
    		$("#txtLastName_u").val(data[0]["LastName"]);    
    		$("#txtMiddleName_u").val(data[0]["MiddleName"]);    
    		$("#txtFirstName_u").val(data[0]["FirstName"]);    	
    		$("#txtStaffOffice_u").val(data[0]["StaffOffice"]);
    		$("#txtstaffBranch_u").val(data[0]["staffBranch"]);
    		$("#txtStaffDept_u").val(data[0]["StaffDept"]);  
    		$("#txtWorkStt_u").val(data[0]["WorkStt"]);  
    		$("#txtJoinedDate_u").val(data[0]["JoinedDate"]);    
    		$("#txtResignedDate_u").val(data[0]["ResignedDate"]);    
    		$("#txtNote_u").val(data[0]["Note"]);
    		$("#btnAdd").attr("disabled",true);
			}
			else {
				noti = "ID available";
				console.log(noti);
				//clear_input(); //gan vao ham sau
				$("#btnAdd").attr("disabled",false);
			}	
		}
	});	
}

function check_input_onchange() 
{
	check_staffid();
	if (noti = "ID available" && $("#txtStaffID_u").val() !="")
	{
		//console.log("herr");
		clear_input();
		$("#btnAdd").attr("disabled",false);
	}
}

function check_input_before_add() 
{
	var alertnoti ="";
	check_staffid();
	//check cac input box khac
	if($("#txtLastName_u").val() =="" || $("#txtLastName_u").val() == null){
		alertnoti += "<Last Name> ";
	}
	if($("#txtJP_u").val() =="" || $("#txtJP_u").val() == null){
		alertnoti += "<JP> ";
	}
	if($("#txtstaffBranch_u").val() =="" || $("#txtstaffBranch_u").val() == null){
		alertnoti += "<Staff Branch> ";
	}
	if($("#txtWorkStt_u").val() =="" || $("#txtWorkStt_u").val() == null){
		alertnoti += "<Work Status>";
	}
	if (noti = "ID available" && $("#txtStaffID_u").val() !="" && alertnoti == "")
	{
		alertnoti = "OK";
		console.log(alertnoti);
		//clear_input();
		$("#btnAdd").attr("disabled",false);
	}
	else{
		alertnoti += " invalid!";
	}
	return alertnoti;
}

function check_input()
{
    var dt = {
    		data: collect_data_array()
    };
    //var tmp = dt[0]["StaffID"];
    console.log(dt);
	//console.log(dt[0][0]);
    var acc = {
    	  acc1: {'StaffID': dt.data['StaffID']}
    };
    	//console.log(items[0][1]); // 1
    	console.log(acc);
   
}

function checkindex(){
	var dt = {
			'id' : 'RQ'
	};
	console.log(dt);
	$.ajax({
		async: true,
		url  : "<?php echo base_url('StaffInfoController/check_index'); ?>",
		type : "POST",
		data : dt,
		dataType: "json",
		success: function(data)
		{
			console.log(data);
			alert(data['id']);
		}
	});	

	
	
}

function clear_input()
{
	//$("#txtStaffID_u").val("");
	$("#txtFirstName_u").val("");
	$("#txtMiddleName_u").val("");
	$("#txtLastName_u").val("");
	$("#txtJP_u").val("");
	$("#txtstaffBranch_u").val("");
	$("#txtStaffDept_u").val("");
	$("#txtStaffName_u").val("");
	$("#txtStaffOffice_u").val("");
	$("#txtWorkStt_u").val("");
	$("#txtDOB_u").val("");
	$("#txtJoinedDate_u").val("");
	$("#txtResignedDate_u").val("");
	$("#txtNote_u").val("");
	
	$("#txtStaffID_u").select();	
}

/**Add new staff info
 */
function staff_new(){
	var fnck = check_input_before_add();
	var id = $("#txtStaffID_u").val();
	//if(noti = "ID available" && $("#txtStaffID_u").val() !="")
	if(fnck == "OK")
	{
		var r = confirm("Do you want to add this Employee to database?");
		if (r) {
			var dt = {	
					data        :   collect_data_array(),		
					acc			:	collect_acc_array()			
				};
				console.log(dt);				
				
				$.ajax({
					async: false,
					url  : "<?php echo base_url('StaffInfoController/add_staffinfo_record'); ?>",
					type : "POST",
					data : dt,
					dataType: "json",
					success: function(data)
					{
						console.log(data)
						if (data['error'] == 0) {
							//clear
							//alert(data.msg);
							var r = confirm(data.msg)
                            if (r) {
                                location.href = "<?php echo base_url();?>accinfo/newaccount?id=" + id;
                            }
                            else {
                                location.href = "<?php echo base_url();?>staffinfo/newstaff?id=" + id;
                            }
						}
						else{
							alert(data.msg);
						}
					}
				});	
			//alert("Chua lam xong");
		};
	}
	else {
		alert(fnck);
		$("#txtStaffID_u").select();
	}
}

function add_id()
{
	if($("#txtStaffID_u").val()!="" || $("#txtStaffID_u").val()!=null)
	{
		location.href = "<?php echo base_url();?>accinfo/newaccount?id=" + $("#txtStaffID_u").val();
	}
	else
	{
		location.href = "<?php echo base_url();?>accinfo/newaccount";	
	}
}


function load_default_data()
{
	var data_array = {
		'StaffID' : ""
			};
	data_array["FirstName"] = "";
	data_array["MiddleName"] = "";
    data_array["LastName"] ="";
    data_array["JP"] = "";
    data_array["staffBranch"] = "";
    data_array["StaffDept"] = "";
    data_array["StaffName"] = "";
    data_array["StaffOffice"] ="";
    data_array["WorkStt"] = "";
    data_array["DOB"] = null;
    data_array["JoinedDate"] = null;
    data_array["ResignedDate"] = null;
    data_array["Note"] = "";

	return data_array;
}

function collect_acc_array()
{
	var acc_array = {
			'StaffID': $("#txtStaffID_u").val()	
	}
	return acc_array;
}

function collect_data_array()
{
	//lay string
	var data_array = {
			'StaffID': $("#txtStaffID_u").val()
	};
//	if ($("#txtStaffID_u").val()!="" && $("#txtStaffID_u").val()!= null) {
//		data_array["StaffID"] = $("#txtStaffID_u").val();
//	}
	if ($("#txtFirstName_u").val()!="" && $("#txtFirstName_u").val()!= null) {
		data_array["FirstName"] = $("#txtFirstName_u").val();
	}
	if ($("#txtMiddleName_u").val()!="" && $("#txtMiddleName_u").val()!= null) {
		data_array["MiddleName"] = $("#txtMiddleName_u").val();
	}
	if ($("#txtLastName_u").val()!="" && $("#txtLastName_u").val()!= null) {
		data_array["LastName"] = $("#txtLastName_u").val();
	}
	if ($("#txtJP_u").val()!="" && $("#txtJP_u").val()!= null) {
		data_array["JP"] = $("#txtJP_u").val();
	}
	if ($("#txtstaffBranch_u").val()!="" && $("#txtstaffBranch_u").val()!= null) {
		data_array["staffBranch"] = $("#txtstaffBranch_u").val();
	}
	if ($("#txtStaffDept_u").val()!="" && $("#txtStaffDept_u").val()!= null) {
		data_array["StaffDept"] = $("#txtStaffDept_u").val();
	}
	if ($("#txtStaffName_u").val()!="" && $("#txtStaffName_u").val()!= null) {
		data_array["StaffName"] = $("#txtStaffName_u").val();
	}
	if ($("#txtStaffOffice_u").val()!="" && $("#txtStaffOffice_u").val()!= null) {
		data_array["StaffOffice"] = $("#txtStaffOffice_u").val();
	}
	if ($("#txtWorkStt_u").val()!="" && $("#txtWorkStt_u").val()!= null) {
		data_array["WorkStt"] = $("#txtWorkStt_u").val();
	}
	if ($("#txtDOB_u").val()!="" && $("#txtDOB_u").val()!= null) {
		data_array["DOB"] = $("#txtDOB_u").val();
	}
	if ($("#txtJoinedDate_u").val()!="" && $("#txtJoinedDate_u").val()!= null) {
		data_array["JoinedDate"] = $("#txtJoinedDate_u").val();
	}
	if ($("#txtResignedDate_u").val()!="" && $("#txtResignedDate_u").val()!= null) {
		data_array["ResignedDate"] = $("#txtResignedDate_u").val();	
	}
	if ($("#txtNote_u").val()!="" && $("#txtNote_u").val()!= null) {
		data_array["Note"] = $("#txtNote_u").val();	
	}
	return data_array;
}
	
</script>
<!-- end script -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

