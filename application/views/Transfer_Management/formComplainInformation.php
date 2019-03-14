<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.dataTables_scrollHead {
	height: 40px;
}

.dataTables tbody tr {
	min-height: 15px;
}

.selected {
	background: #397FDB none repeat scroll 0% 0%;
}
</style>
<div class="content">

	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h1 style="margin: 10px 10px 0px;">GET COMPLAINS INFORMATION</h1>
			</div>
			<div class="col-md-2" style="text-align: right; margin-top: 13px;">
				<form
					action="<?php echo base_url('transfer-management/guide-report'); ?>"
					method="post">
					<input type="hidden" name="guide"
						value="<?php echo $name? $name : ''; ?>"> <input type="submit"
						id="goBack" class="btn btn-primary" value="Back">
				</form>
			</div>
			<div style="clear: both"></div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields </label>
			</div>
			<div class="col-md-5">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Guide</label>
					</div>
					<div class="col-md-7">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Guide Name</label> <input id="guide"
									class="form-control input-sm select-size" disabled=""
									value="<?php echo $name? $name : ''; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item-sm">Rank</label> <input id="guide-type"
									type="text" class="form-control input-sm select-size-sm"
									disabled="" value="<?php echo $rank? $rank : ''; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Date</label>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">From Date</label>
								<div id="from-date" class="form-group bfh-datepicker"
									data-placeholder="yyyy/mm/dd" data-format="y/m/d"
									data-align="right" data-name="from-date"
									data-input="form-control input-sm select-size-md" data-date=""></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">To Date</label>
								<div id="to-date" class="form-group bfh-datepicker"
									data-placeholder="yyyy/mm/dd" data-format="y/m/d"
									data-align="right" data-name="to-date"
									data-input="form-control input-sm select-size-md" data-date=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="button-action-div">
					<button class="btn btn-primary button-sm btn-action" id="cleardata">Clear</button>
					<button class="btn-search btn btn-primary button-sm btn-action"
						onclick="get_data_search()">Search</button>

				</div>
			</div>
			<div class="col-md-10" style="margin-top: -20px;">
				<input type="checkbox" checked="true" name="not-finish"
					id="not-finish"> <label for="not-finish">Not Yes Finished</label>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Complain Infomation</label>
					</div>
					<div class="col-md-7">
						<div id="div-complain-info" style="height: 190px;">
							<table id="complain-info" class="table table-bordered">
								<tbody></tbody>
							</table>
						</div>
						<button class="btn btn-primary"
							style="margin-left: 50px; margin-top: 10px;" disabled="true"
							id="add-processing">Add For Processing</button>
					</div>
					<div class="col-md-5">
						<div class="row row-border">
							<div class="title-row-div">
								<label class="title-row">Complain</label>
							</div>
							<textarea class="form-control" rows="3" readonly name="complain"></textarea>
							<div class="form-inline form-margin-bottom">
								<div class="form-group form-margin-top-right">
									<label class="label-item-xlg">Pecuniary Penalty</label> <input
										type="text" class="form-control input-sm select-size-sm"
										readonly name="pecuniary"> <label class="label-item-sm">VND</label>
								</div>
								<div class="form-group form-margin-top-right">
									<input type="checkbox" name="finish" id="finished"> <label
										for="finished"> Finished</label>
									<button class="btn btn-primary" style="margin-left: 30px"
										id="update-complain" disabled="true">Update</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Complain Process</label>
					</div>
					<div class="col-md-10" id="div-process" style="padding-left: 1px">
						<table id="process-info" class="table table-bordered">
							<tbody></tbody>
						</table>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary" id="remove-process"
							disabled="true">Remove</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-8">
				<form
					action="<?php echo base_url('transfer-management/guide-report'); ?>"
					method="post">
					<input type="hidden" name="datasource" value=""> <input
						type="hidden" name="guide"
						value="<?php echo $name? $name : ''; ?>"> <input type="submit"
						id="saveProcess" class="btn btn-primary" style="margin-top: -55px"
						value="Save">
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var dtTable = false;
	var processTable = false;
  	$(document).ready(function(){
  		$("input[name=finish]").prop("disabled", true);
		$('input[name=from-date]').attr('readonly', false);
  		$('#from-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=from-date]').val())){
  				$('input[name=from-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  			} else {
  				$('input[name=from-date]').css('border', "1px solid #ccc");
  			}
		});

		$('input[name=to-date]').attr('readonly', false);
  		$('#to-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=to-date]').val())){
  				$('input[name=to-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  			} else {
  				$('input[name=to-date]').css('border', "1px solid #ccc");
  			}
		});
		get_data_search();
		processTable = $("#process-info").DataTable({
			scrollY: 150,
			columns: [
				{"data":"date", "title": "DATE"},
				{"data":"guide", "title": "Guide Name"},
				{"data":"tour", "title": "Tour"},
				{"data":"start", "title": "Start Time"},
				{"data":"end", "title": "End Time"},
				{"data":"pax", "title": "PAX"},
				{"data":"id","visible": false},
				{"data":"note","visible": false},
				{"data":"penalty","visible": false},
				{"data":"finished","visible": false},
				{"data":"tel","visible": false}
			],
			searching:false,
			info: false,
			paging: false
		});
 	});
	$("#cleardata").click(function()
	{
		$("#guide").val('');
		$("#guide-type").val('');
		$('input[name=from-date]').val('');
		$('input[name=to-date]').val('');
		$('#table-guide-search').html('');
		$("input[name=pecuniary]").val("");
		$("textarea[name=complain]").val("");
		$("#finished").prop("checked", false);
		$("#add-processing").prop("disabled", true);
		$("#update-complain").prop("disabled", true);
		$("#remove-process").prop("disabled", true);

		processTable.clear().draw();
		dtTable.clear().draw();
	});
var i = 0;
pos = 0;

function get_data_search(){
	if(!$("#guide").val() && !$("#guide-type").val())
	{
		alert("Please enter Guide name");
		return false;
	}

	$("input[name=pecuniary]").val("");
	$("textarea[name=complain]").val("");
	$("#finished").prop("checked", false);

	if (dtTable) dtTable.ajax.reload();
	else {
		dtTable = $("#complain-info").DataTable({
			scrollY: 150,
			// serverSide: true,
			ajax: {
				url: "<?php echo base_url('TransferController/searchComplain'); ?>",
			    async: false,
			    type: "POST",  
			    data: searchData, 
			    dataType: "json",
			    dataSrc: "data",
			},
			columns: [
				{"data":"date", "title": "DATE"},
				{"data":"guide", "title": "Guide Name"},
				{"data":"tour", "title": "Tour"},
				{"data":"start", "title": "Start Time"},
				{"data":"end", "title": "End Time"},
				{"data":"pax", "title": "PAX"},
				{"data":"id","visible": false},
				{"data":"note","visible": false},
				{"data":"penalty","visible": false},
				{"data":"finished","visible": false},
				{"data":"tel","visible": false}
			],
			searching:false,
			info: false,
			paging: false
		});
	}

	$("body").css("cursor", "default");
	dtTable.$('tr:nth-child(1)').addClass('selected');
	if (dtTable.rows().data().length == 0) {
		alert('Data not fault');
		$('#table-guide-search').html('');
		$("input[name=pecuniary]").val("");
		$("textarea[name=complain]").val("");
		$("#finished").prop("checked", false);
		$("#add-processing").prop("disabled", true);
		$("#update-complain").prop("disabled", true);
		$("#remove-process").prop("disabled", true);
	} else {
		$("#complain-info_wrapper").css("display", "");
		$("#add-processing").prop("disabled", false);
		$("#update-complain").prop("disabled", false);
		$("#remove-process").prop("disabled", false);
		$("textarea[name=complain]").removeAttr("readonly");
		$("input[name=pecuniary]").removeAttr("readonly");
		$("#finished").prop("disabled", false);
	}
}
$('#complain-info').on( 'length.dt', function ( e, settings, len ) {
    if ($("#complain-info").html().includes("No data available in table")) {
			    		$("#add-processing").prop("disabled", true);
						$("#update-complain").prop("disabled", true);
						$("#remove-process").prop("disabled", true);
			    	}
} );

$('#complain-info tbody').on( 'click', 'tr', function () {
    dtTable.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
    var data = dtTable.row(this).data();
    $("textarea[name=complain]").val(data.note);
    $("input[name=pecuniary]").val(data.penalty);
    if (dtTable.row(this).data().finished == "1") {
    	$("#finished").prop("checked", true);
    }    
} );

$('#process-info tbody').on( 'click', 'tr', function () {
    processTable.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
} );

function searchData()
{
	var result = {
		guide		: 	$("#guide").val(),
		rank		: 	$("#guide-type").val(),
		from		: 	$("input[name=from-date]").val(),
		to			: 	$("input[name=to-date]").val()
	};
	if ($("#not-finish").prop("checked")) {
		result.notFinish = "true";
	}

	return result;
}


$("#remove-process").click(function() {
	var selectedRow = $("#process-info tbody tr.selected");
	var currentDatas = processTable.rows().data();
	if (currentDatas.length > 0 && selectedRow.length == 0){
		alert("Please select row to remove");
	} else {
		processTable.row(selectedRow).remove().draw();
	}	
});

$("#add-processing").click(function(){
	var data = dtTable.row($("#complain-info tbody tr.selected")).data();
	var currentDatas = processTable.rows().data();
	var duplicate = false;
	if (currentDatas.length > 0) {
		$.each(currentDatas, function(){
			if (this.id == data.id){
				duplicate = true;
			}
		});
	}
	if(!duplicate) {
		processTable.row.add(data).draw( false );
	}
	processTable.$('tr.selected').removeClass('selected');
    processTable.$('tr:nth-child(1)').addClass('selected');
});

$("#update-complain").click(function(){
	var updateData = {
		id : dtTable.row($("#complain-info tbody tr.selected")).data().id,
		pen : $("input[name=pecuniary]").val(),
		note : $("textarea[name=complain]").val(),
		fin : $("#finished").prop("checked") ? "1" : "",
		tour: dtTable.row($("#complain-info tbody tr.selected")).data().tour,
	};

	$.ajax({
		url: "<?php echo base_url('transfer-management/update-complain'); ?>",
		method: "POST",
		data : updateData,
		complete: function(){
			get_data_search();
		}
	});
});

$("#saveProcess").click(function() {
	var noData = $("#process-info").html().includes("No data available in table");
	if (!noData) {
		var datas = processTable.rows().data();
		var strData = JSON.stringify(datas[0]);
		for(var i = 1; i < datas.length; i++) {
			strData += "|:|" +  JSON.stringify(datas[i]);
		}

		$("input[name=datasource]").val(strData);
	}
})
</script>
<?php echo $this->load->view('Layout/footer');?>