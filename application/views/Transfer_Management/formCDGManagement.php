<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.popup {
	width: 400px;
	height: 200px;
	position: absolute;
	z-index: 3002;
	left: 33%;
	top: 30%;
	font-size: 17px;
	text-align: center;
	display: none;
}

.popup_save {
	width: 300px;
	height: 130px;
	position: absolute;
	z-index: 3000;
	left: 38%;
	top: 30%;
	font-size: 17px;
	text-align: center;
	display: none;
}

.popup_content {
	background-color: white;
	height: 130px;
	margin-top: 5px;
	border: 1px;
	border-style: solid;
	border-radius: 3px;
}

.popoup_note {
	font-size: 15px;
	padding-top: 20px;
	margin-left: -10px;
}

.popup_btn {
	text-align: right;
	padding-right: 15px;
	padding-top: 35px;
}

.popup_btn input {
	width: 85px;
	font-size: 15px;
}

.dataTables_info {
	display: none;
}

#table-guide_filter, #table-car_filter {
	display: none;
}

#div-car, #div-guide {
	overflow: hidden;
}

.deleted {
	display: none;
}

.input-selected {
	background-color: #397FDB;
	color: white;
	opacity: 0.8;
}

input[type=text] {
	border: none;
}
</style>
<div class="content">

	<div class="container">

		<div class="popup">

			<div class="popup_content">
				<div class="popoup_note">Data has been changed.Do you want to
					update?</div>
				<div class="popup_btn">
					<input type="button" value="Yes" class="btn_yes"> <input
						type="button" value="No" class="btn_no">
				</div>
			</div>
		</div>

		<div class="popup_save">

			<div class="popup_content">
				<div class="popoup_note">Are you sure to save?</div>
				<div class="popup_btn">
					<input type="button" value="Yes" class="btn_yes_save"> <input
						type="button" value="No" class="btn_no_save">
				</div>
			</div>
		</div>
		<h3 style="margin-top: 6px; margin-bottom: 0px;">
			UPDATE GUIDE - DRIVER - CAR
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='<?php echo base_url();?>transfer-management/update-tour-information'">Back</button>
		</h3>
		<input type="hidden" id="id-new" value="1">
		<div class="row line-strong">
			<input id="id-car" type="hidden"
				value="<?php echo ($max_car)?$max_car:""; ?>"> <input id="id-guide"
				type="hidden" value="<?php echo ($max_guide)?$max_guide:""; ?>">
		</div>
		<div class="row">
			<div class="col-md-5">
				<?php echo form_open('transfer-management/guide-report'); ?>
					<div class="button-action-div" style="margin-bottom: 10px;">
					<button class="btn btn-primary btn-sm button-md btn-action">Guide
						Report</button>
				</div>
				<?php echo form_close();?>
					<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Guide</label>
					</div>
					<div id="div-guide" class="list-scroll" tabindex="4">
						<table id="table-guide" class="table table-bordered"
							style="width: 100%">
							<thead>
								<tr>
									<td style="width: 7%"></td>
									<td style="width: 31%">Guide Name</td>
									<td style="width: 31%">Tel</td>
									<td style="width: 31%">Type</td>
								</tr>
							</thead>
							<tbody>
									<?php
        if ($guide) {
            foreach ($guide as $row) {
                ?>
									        	<tr id="guide-<?php echo $row['GuideID']?>"
									data-id="<?php echo $row['GuideID']?>"
									onclick="editing_guide(<?php echo $row['GuideID']?>)"
									class="guide_table original">
									<td style="width: 7%"
										onclick="selectRow('guide-<?php echo $row['GuideID']?>')">
										<div class="glyphicon glyphicon-pencil icon-edit"></div>
									</td>
									<td style="width: 31%" title="<?php echo $row['GuideName']?>">
										<div style="display: none"><?php echo $row['GuideName']?></div>
										<input name="GuideName" style="width: 100%"
										onchange="getguide(<?php echo $row['GuideID']?>)"
										id="guidename<?php echo $row['GuideID']?>" type="text"
										value="<?php echo $row['GuideName']?>" class="key_up">
									</td>
									<td style="width: 31%" title="<?php echo $row['GuideTel']?>">
										<div style="display: none"><?php echo $row['GuideTel']?></div>
										<input name="GuideTel" style="width: 100%"
										onchange="getguide(<?php echo $row['GuideID']?>)"
										id="guidetel<?php echo $row['GuideID']?>" type="text"
										value="<?php echo $row['GuideTel']?>" class="key_up">
									</td>
									<td style="width: 31%" title="<?php echo $row['Type']?>">
										<div style="display: none"><?php echo $row['Type']?></div> <input
										name="Type" style="width: 100%"
										onchange="getguide(<?php echo $row['GuideID']?>)"
										id="type<?php echo $row['GuideID']?>" type="text"
										value="<?php echo $row['Type']?>" class="key_up">
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

			<div class="col-md-7">
				<?php echo form_open('transfer-management/car-report'); ?>
					<div class="button-action-div" style="margin-bottom: 10px;">
					<button class="btn btn-primary btn-sm button-md btn-action">Car
						Report</button>
				</div>
				<?php echo form_close();?>
					<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Driver</label>
					</div>
					<div id="div-car" class="list-scroll">
						<table id="table-car" class="table table-bordered"
							style="width: 100%" tabindex="5">
							<thead>
								<td style="width: 6%"></td>
								<td style="width: 16%">Car No</td>
								<td style="width: 16%">Car Seat</td>
								<td style="width: 31%">Driver Name</td>
								<td style="width: 31%">Driver Tel</td>
							</thead>
							<tbody>
									<?php
        if ($car) {
            foreach ($car as $row) {
                ?>
									        	<tr id="car-<?php echo $row['CarDriverID']?>"
									data-id="<?php echo $row['CarDriverID']?>"
									onclick="editing_car(<?php echo $row['CarDriverID']?>)"
									class="car_table original">
									<td style="width: 6%"
										onclick="selectRow('car-<?php echo $row['CarDriverID']?>')"
										data-first="true">
										<div class="glyphicon glyphicon-pencil icon-edit">
											<input type="hidden"
												value="<?php echo $row['CarDriverID'];?>" name="car-id[]">
										</div>
									</td>
									<td style="width: 16%" title="<?php echo $row['CarNo']?>">
										<div style="display: none"><?php echo $row['CarNo']?></div> <input
										name="CarNo" style="width: 100%"
										data-id="<?php echo $row['CarDriverID']?>"
										onchange="getinput(<?php echo $row['CarDriverID']?>)"
										id="carno<?php echo $row['CarDriverID']?>" type="text"
										value="<?php echo $row['CarNo']?>">
									</td>
									<td style="width: 16%" title="<?php echo $row['CarSeat']?>">
										<div style="display: none"><?php echo $row['CarSeat']?></div>
										<input name="CarSeat" style="width: 100%"
										data-id="<?php echo $row['CarDriverID']?>"
										onchange="getinput(<?php echo $row['CarDriverID']?>)"
										id="carseat<?php echo $row['CarDriverID']?>" type="text"
										value="<?php echo $row['CarSeat']?>">
									</td>
									<td style="width: 31%" title="<?php echo $row['DriverName']?>">
										<div style="display: none"><?php echo $row['DriverName']?></div>
										<input name="DriverName" style="width: 100%"
										data-id="<?php echo $row['CarDriverID']?>"
										onchange="getinput(<?php echo $row['CarDriverID']?>)"
										id="drivername<?php echo $row['CarDriverID']?>" type="text"
										value="<?php echo $row['DriverName']?>">
									</td>
									<td style="width: 31%" title="<?php echo $row['DriverTel']?>">
										<div style="display: none"><?php echo $row['DriverTel']?></div>
										<input name="DriverTel" style="width: 100%"
										data-id="<?php echo $row['CarDriverID']?>"
										onchange="getinput(<?php echo $row['CarDriverID']?>)"
										id="drivertel<?php echo $row['CarDriverID']?>" type="text"
										value="<?php echo $row['DriverTel']?>">
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
		<div class="row btn-center">
			<button class="btn btn-primary btn-sm button-md"
				onclick="click_update()">Update</button>
		</div>

	</div>

</div>

<script type="text/javascript">
var lastid_car = 0;
var lastid_guide = 0;
var data_arr_car = new Array();
var data_arr_guide = new Array();
var data_new_car = new Array();
var data_new_guide = new Array();
var d=0;
var g=0;
var nc=0;
var ng=0;
var origanalLen = {guide: 0, car: 0};
var car_driver_id = 0;

var removeSelect = true;
var guildTable;
var carTable;
var currentDataId ;
var inputFocus;
var newCarAdd;
var newGuideAdd;
/* Create an array with the values of all the input boxes in a column */
$.fn.dataTable.ext.order['dom-text'] = function  ( settings, col )
{
	return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
		return $('input', td).val();
	} );
}

/* Create an array with the values of all the input boxes in a column, parsed as numbers */
$.fn.dataTable.ext.order['dom-text-numeric'] = function  ( settings, col )
{
	return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
		return $('input', td).val() * 1;
	} );
}
	$(document).ready(function(){
		origanalLen.guide = $("#table-guide tbody tr").length;
		origanalLen.car = $("#table-car tbody tr").length;

		lastid_car =  parseInt($("#id-car").val());
		// editing_car(lastid_car-1);
		lastid_guide =  parseInt($("#id-guide").val());

		lastid_guide++;
        guildTable = $('#table-guide').DataTable({
			responsive: true,
			scrollY: 350,
			paging: false,
			scrollX: false,
			columns: [
				null,
				{ "orderDataType": "dom-text" },
				{ "orderDataType": "dom-text" },
				{ "orderDataType": "dom-text" }
			],
			fnDrawCallback: function() {
				// after table is redrawndo something here
				addNewGuide();
			},
		});

		lastid_car++;
		carTable = $('#table-car').DataTable({
			responsive: true,
			scrollY: 350,
			paging: false,
			scrollX: false,
			columns: [
                null,
				{ "orderDataType": "dom-text" },
				{ "orderDataType": "dom-text-numeric" },
				{ "orderDataType": "dom-text" },
				{ "orderDataType": "dom-text" }
			],
            "order": [[ 0, "desc" ]],
			fnDrawCallback: function() {
				// after table is redrawndo something here
				addNewCar();
			},
		});

		$('.dataTables_scrollHead').height(35);

		/*begin guide table*/
		$("#table-guide").on("focus", "td>input[type=text]", function(e) {
            editing_car($(this).attr('data-id'));
            if (currentDataId == $(this).attr('data-id') || currentDataId == undefined) {
                currentDataId = $(this).attr('data-id');
                e.preventDefault();
            } else {
                inputFocus = $(this);
                //not select last row
                if (lastid_guide != parseInt(currentDataId)) {
                    if (newGuideAdd) {
                        newGuideAdd = false;
                        var _guideName = $('#guidename' + (lastid_guide-1)).val();
                        var _guideTel = $('#guidetel' + (lastid_guide-1)).val();
                        var type = $('#type' + (lastid_guide-1)).val();

                        var _pencilHTML = '<div class="glyphicon glyphicon-pencil icon-edit" style="display: none;"></div>';
                        var _guideHTML = '<input name="GuideName" data-id="' + (lastid_guide-1) + '" type="text" id="guidename' + (lastid_guide-1) + '" ' +
                            'value="' + _guideName + '" onchange="getguide(' + (lastid_guide-1) + ')" onkeyup="keyup_guide(event, ' + (lastid_guide-1) + ')">';
                        var _guideTelHTML = '<input name="GuideTel" data-id="' + (lastid_guide-1) + '" type="text" id="guidetel' + (lastid_guide-1) + '" ' +
                            'value="' + _guideTel + '" onchange="getguide(' + (lastid_guide-1) + ')" onkeyup="keyup_guide(event, ' + (lastid_guide-1) + ')">';
                        var _typeHTML = '<input name="Type" data-id="' + (lastid_guide-1) + '" type="text" id="type' + (lastid_guide-1) + '" ' +
                            'value="' + type + '" onchange="getguide(' + (lastid_guide-1) + ')" onkeyup="keyup_guide(event, ' + (lastid_guide-1) + ')">';
                        guildTable.row.add([_pencilHTML,_guideHTML, _guideTelHTML, _typeHTML]).draw(false).nodes().to$().addClass( 'new');
                    }

                    currentDataId = $(this).attr('data-id');
                    // reorder after change value
                    var _order = guildTable.order();
                    var _orderColumn = _order[0][0];
                    var _orderType = _order[0][1]; // asc or desc
                    guildTable.order( [ _orderColumn, _orderType ] ).draw();
                    $(this).focus();
                }

            }
        });
       	// guildTable.on('click',function(){ console.log($(this).html());});
		/*end guide table*/

        $("#table-car").on("focus", "td>input[type=text]", function(e) {
            editing_car($(this).attr('data-id'));
            if (currentDataId == $(this).attr('data-id') || currentDataId == undefined) {
                currentDataId = $(this).attr('data-id');
                e.preventDefault();
            } else {
                inputFocus = $(this);
                //not select last row
                if (lastid_car != currentDataId) {
                    if (newCarAdd) {
                        newCarAdd = false;

                        var _carNo = $('#carno' + (lastid_car-1)).val();
                        var _carSeat = $('#carseat' + (lastid_car-1)).val();
                        var _driverName = $('#drivername' + (lastid_car-1)).val();
                        var _driverTel = $('#drivertel' + (lastid_car-1)).val();

                        var _carNoHTML = '<input name="CarNo" data-id="' + (lastid_car-1) + '" type="text" id="carno' + (lastid_car-1) + '" ' +
                            'value="' + _carNo + '" onchange="getinput(' + (lastid_car-1) + ')" onkeyup="keyup_car(event, ' + (lastid_car-1) + ')">';
                        var _carSeatHTML = '<input name="CarSeat" data-id="' + (lastid_car-1) + '" type="text" id="carseat' + (lastid_car-1) + '" ' +
                            'value="' + _carSeat + '" onchange="getinput(' + (lastid_car-1) + ')" onkeyup="keyup_car(event, ' + (lastid_car-1) + ')">';
                        var _driverNameHTML = '<input name="DriverName" data-id="' + (lastid_car-1) + '" type="text" id="drivername' + (lastid_car-1) + '" ' +
                            'value="' + _driverName + '" onchange="getinput(' + (lastid_car-1) + ')" onkeyup="keyup_car(event, ' + (lastid_car-1) + ')">';
                        var _driverTelHTML = '<input name="DriverTel" data-id="' + (lastid_car-1) + '" type="text" id="drivertel' + (lastid_car-1) + '" ' +
                            'value="' + _driverTel + '" onchange="getinput(' + (lastid_car-1) + ')" onkeyup="keyup_car(event, ' + (lastid_car-1) + ')">';

                        carTable.row.add(['',_carNoHTML, _carSeatHTML, _driverNameHTML, _driverTelHTML]).draw(false).nodes().to$().addClass( 'new' );

                    }

                    currentDataId = $(this).attr('data-id');
                    // reorder after change value
                    var _order = carTable.order();
                    var _orderColumn = _order[0][0];
                    var _orderType = _order[0][1]; // asc or desc
                    carTable.order( [ _orderColumn, _orderType ] ).draw();
                    $(this).focus();
                }

            }
        });

	});
$("#div-car").bind('keydown', function(event) {
	if(event.keyCode == 46 && $(".tr-selected").length > 0) {
		if ($(".tr-selected").hasClass("new")) {
			$(".tr-selected").remove();
			return false;
		} else if ($(".tr-selected").hasClass("blank")) {
			return false;
		}
		$(".tr-selected").removeClass("edited");
		$(".tr-selected").addClass("deleted");
	}
});

$("#div-guide").bind('keydown', function(event) {
	if(event.keyCode == 46 && $(".tr-selected").length > 0) {
		if ($(".tr-selected").hasClass("new")) {
			$(".tr-selected").remove();
			return false;
		} else if ($(".tr-selected").hasClass("blank")) {
			return false;
		}
		$(".tr-selected").removeClass("edited");
		$(".tr-selected").addClass("deleted");
	}
});

function selectRow(id) {
	$(".tr-selected").removeClass("tr-selected");
	$(".input-selected").removeClass("input-selected");
	$("#" + id).addClass("tr-selected");
	$("#" + id + " input").addClass("input-selected");
	removeSelect = false;
}

	function keyup_car(event, id){
		$(".tr-selected").removeClass("tr-selected");
		var _carNo = $('#carno' + id).val();
        var _carSeat = $('#carseat' + id).val();
        var _driverName = $('#drivername' + id).val();
        var _driverTel = $('#drivertel' + id).val();

        if (id == lastid_car && (_carNo != '' || _carSeat != '' || _driverName != '' || _driverTel != '') ){
            newCarAdd = true;
            lastid_car++;
            addNewCar();
        }

        var current_focus = $(event.currentTarget).attr("id");
        var next_id = $("#table-car>tbody>tr:last").attr('data-id');
        var theEvent = event.which || event.keyCode;
        if((current_focus == "carno"+id && _carNo!="" && theEvent == 13)){
            $("#carno"+next_id).focus();
            editing_car(next_id);
        }
        if((current_focus == "carseat"+id && _carSeat!="" && theEvent == 13)){
            $("#carseat"+next_id).focus();
            editing_car(next_id);
        }
        if((current_focus == "drivername"+id && _driverName!="" && theEvent == 13)){
            $("#drivername"+next_id).focus();
            editing_car(next_id);
        }
        if((current_focus == "drivertel"+id && _driverTel!="" && theEvent == 13)){
            $("#drivertel"+next_id).focus();
            editing_car(next_id);
        }



    }

	function addNewCar()
	{
		var row_insert_car = "<tr id='car-"+lastid_car+"' data-id='"+lastid_car+"' class=\"car_table blank\" onclick=\"editing_car("+lastid_car+")\">";
		row_insert_car += "<td style='width:20px'  data-first=\"true\" onclick=\"selectRow('car-"+lastid_car+"')\"><div class='glyphicon glyphicon-pencil icon-edit'></div></td>";
		row_insert_car += "<td style='width:50px'><input name='CarNo' data-id='"+lastid_car+"' type='text' id='carno"+lastid_car+"' value='' onchange='getinput("+lastid_car+")'  onkeyup=\"keyup_car(event, "+lastid_car+")\"></td>";
		row_insert_car += "<td style='width:50px'><input name='CarSeat' data-id='"+lastid_car+"' type='text' id='carseat"+lastid_car+"' value='' onchange='getinput("+lastid_car+")' onkeyup=\"keyup_car(event, "+lastid_car+")\"></td>";
		row_insert_car += "<td style='width:100px'><input name='DriverName' data-id='"+lastid_car+"' type='text' id='drivername"+lastid_car+"' value='' onchange='getinput("+lastid_car+")' onkeyup=\"keyup_car(event, "+lastid_car+")\"></td>";
		row_insert_car += "<td style='width:100px'><input name='DriverTel' data-id='"+lastid_car+"' type='text' id='drivertel"+lastid_car+"' value='' onchange='getinput("+lastid_car+")' onkeyup=\"keyup_car(event, "+lastid_car+")\"></td>";
		row_insert_car += "</tr>";
		$("#table-car tbody").append(row_insert_car);
	}

	function keyup_guide(event,id){
		$(".tr-selected").removeClass("tr-selected");
		var guide_name = $("#guidename"+id).val();
        var guide_tel = $("#guidetel"+id).val();
        var type = $("#type"+id).val();
		if (id == lastid_guide && (guide_name !="" || guide_tel!="" || type != "")){
			newGuideAdd = true;
			lastid_guide++;
			addNewGuide();
		}
		var current_focus = $(event.currentTarget).attr("id");
		var next_id = $("#guide-"+id).closest('tr').next('tr').data('id');
		var theEvent = event.which || event.keyCode;
		if((current_focus == "guidename"+id && guide_name != "" && theEvent == 13)){
			$("#guidename"+next_id).focus();
			editing_guide(next_id);
		}
		if((current_focus == "guidetel"+id && guide_tel != "" && theEvent == 13)){
			$("#guidetel"+next_id).focus();
			editing_guide(next_id);
		}
		if((current_focus == "type"+id && type != "" && theEvent == 13)){
			$("#type"+next_id).focus();
			editing_guide(next_id);
		}
	}
	$(".key_up").keydown(function(evt){
		var id = $(this).parent().parent().data('id');
		var next_id = $(this).parent().parent().closest('tr').next('tr').data('id');
		var current_focus = $("*:focus").attr("id");
		var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
		if((current_focus == "type"+id && theEvent.keyCode == 9)){
			editing_guide(next_id);
		}
	});
	function addNewGuide()
	{
		var row_insert_guide = "<tr id='guide-"+lastid_guide+"' data-id='"+lastid_guide+"' class=\"guide_table blank\"  onclick=\"editing_guide(" + lastid_guide + ")\">";
			row_insert_guide += "<td style='width:20px' onclick=\"selectRow('guide-"+lastid_guide+"')\"><div class='glyphicon glyphicon-pencil icon-edit'></div></td>";
			row_insert_guide += "<td style='width:150px'><input name=\"GuideName\" data-id='"+lastid_guide+"' type='text' id='guidename"+lastid_guide+"' value='' onchange='getguide("+lastid_guide+")' class='key_up' onkeyup=\"keyup_guide(event,"+lastid_guide+")\"></td>";
			row_insert_guide += "<td style='width:150px'><input name=GuideTel data-id='"+lastid_guide+"' type='text' id='guidetel"+lastid_guide+"' value='' onchange='getguide("+lastid_guide+")' onkeyup=\"keyup_guide(event,"+lastid_guide+")\"></td>";
			row_insert_guide += "<td style='width:128px'><input name=\"Type\" data-id='"+lastid_guide+"' type='text' id='type"+lastid_guide+"' value='' onchange='getguide("+lastid_guide+")'  onkeyup=\"keyup_guide(event,"+lastid_guide+")\" onkeydown=\"keydown_guide(event,"+lastid_guide+")\"></td>";
			row_insert_guide += "</tr>";
			$("#table-guide tbody").append(row_insert_guide);

	}

	function editing_guide(id){
		if (removeSelect) {
			$(".input-selected").removeClass("input-selected");
			$(".tr-selected").removeClass("tr-selected");
			$("#table-guide tbody tr td").find("div").css("display","none");
		} else {
			removeSelect = true;
		}
		$("#table-guide tbody tr td").find("div").css("display","none");
		$("#guide-"+id + " td:nth-child(1)").find("div").css("display","block");
	}

	function editing_car(id){
		if (removeSelect) {
			$(".input-selected").removeClass("input-selected");
			$(".tr-selected").removeClass("tr-selected");
		} else {
			removeSelect = true;
		}
		$("#table-car tbody tr td").find("div").css("display","none");
		$("#car-"+id + " td:nth-child(1)").find("div").css("display","block");
	}
	function getinput (id) 
	{
		if($("#car-" + id).hasClass("original")) {
			$("#car-" + id).removeClass("original");
			$("#car-" + id).addClass("edited");
		} else if ($("#car-" + id).hasClass("blank")) {
			$("#car-" + id).removeClass("blank");
			$("#car-" + id).addClass("new");
		}
	}
	function getguide(id)
	{
		if($("#guide-" + id).hasClass("original")) {
			$("#guide-" + id).removeClass("original");
			$("#guide-" + id).addClass("edited");
		} else if ($("#guide-" + id).hasClass("blank")) {
			$("#guide-" + id).removeClass("blank");
			$("#guide-" + id).addClass("new");
		}
		
	}
	$(".btn_no").click(function(){
		$(".popup").css("display","none");
	});

	$(".btn_no_save").click(function(){
		$(".popup_save").css("display","none");
	});

	function click_update()
	{
		//Processing for guide
		var updateGuide = $("#table-guide tr.edited");
		var newGuide = $("#table-guide tr.new");
		var deleteGuide = $("#table-guide tr.deleted");
		var stopGuide = false;

		if (deleteGuide.length > 0) {
			if (confirm("Are you sure to delete?")) {
				var idList = [];
				deleteGuide.each(function(){
					idList.push($(this).data('id'))
				});

				$.ajax({
					url: "<?php echo base_url('transfer-management/deleteGuideReport'); ?>",
					method:"POST",
					data: {ids:idList}
				});
			} else {
				stopGuide = true;
			}
		}

		if (updateGuide.length > 0 && !stopGuide) {
			if (confirm("Data has been changed. Do you want to update?")) {
				var data = getGuideData(updateGuide);
				$.ajax({
					url: "<?php echo base_url('transfer-management/updateGuideReport'); ?>",
					method:"POST",
					data: {guides:data}
				});
			} else {
				stopGuide = true;
			}
		}

		if(newGuide.length > 0  && !stopGuide) {
			if (confirm("Are you sure to save?")) {
				var data = getGuideData(newGuide);
				$.ajax({
					url: "<?php echo base_url('transfer-management/addNewGuide'); ?>",
					method:"POST",
					data: {guides:data},
					success: function(fs){
					}
				});
			}
		}

		//Processing for cars
		var updateCar = $("#table-car tr.edited");
		var newCar = $("#table-car tr.new");
		var deleteCar = $("#table-car tr.deleted");
		var stopCar = false;

		if (deleteCar.length > 0) {
			if (confirm("Are you sure to delete?")) {
				var idList = [];
				deleteCar.each(function(){
					idList.push($(this).data('id'))
				});
				$.ajax({
					url: "<?php echo base_url('transfer-management/deleteCarReport'); ?>",
					method:"POST",
					data: {ids:idList}
				});
			} else {
				stopCar = true;
			}
		}

		if (updateCar.length > 0 && !stopCar) {
			if (confirm("Data has been changed. Do you want to update?")) {
				var data = getCarData(updateCar);
				$.ajax({
					url: "<?php echo base_url('transfer-management/updateCarReport'); ?>",
					method:"POST",
					data: {cars:data}
				});
			} else {
				stopCar = true;
			}
		}

		if(newCar.length > 0  && !stopCar) {
			if (confirm("Are you sure to save?")) {
				var data = getCarData(newCar);
				$.ajax({
					url: "<?php echo base_url('transfer-management/addNewCar'); ?>",
					method:"POST",
					data: {cars:data}
				});
			}
		}
		setTimeout(function(){
			window.location.reload(true);
		}, 100);
	}


function getCarData(rows)
{
	var result = [];
	rows.each(function(){
        var _carNo = $(this).find("input[name=CarNo]").val();
        var _carSeat = $(this).find("input[name=CarSeat]").val();
        var _driverTel = $(this).find("input[name=DriverTel]").val();
        var _driverName = $(this).find("input[name=DriverName]").val();
        if (_carNo == '' && _carSeat == '' && _driverName == '' && _driverTel == '') {
            return true;
        }
		var data = {
			"CarNo": $(this).find("input[name=CarNo]").val(),
			"CarSeat": $(this).find("input[name=CarSeat]").val(),
			"DriverTel": $(this).find("input[name=DriverTel]").val(),
			"DriverName": $(this).find("input[name=DriverName]").val(),
		};
		if(typeof($(this).data('id')) != "undefined") data.CarDriverID = $(this).data('id');
		result.push(data);
	});
	return result;
}

function getGuideData(rows)
{
	var result = [];
	rows.each(function(){
		var data = {
			"GuideName": $(this).find("input[name=GuideName]").val(),
			"GuideTel": $(this).find("input[name=GuideTel]").val(),
			"Type": $(this).find("input[name=Type]").val(),
		};
		if(typeof($(this).data('id')) != "undefined") data.GuideID = $(this).data('id');
		result.push(data);
	});
	return result;
}

</script>
<?php echo $this->load->view('Layout/footer');?>