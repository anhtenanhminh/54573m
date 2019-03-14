<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.selected {
	background-color: #397FDB;
}

table thead tr th {
	background-color: #2D6CA2;
	color: white;
	/*padding: 8px 10px !important;*/
}
</style>
<div class="content">
	<div class="container">
		<h3 style="margin-top: 6px; margin-bottom: 0px;">OPTIONAL TOUR GUIDE
			TABLE</h3>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields</label>
			</div>
			<div class="col-md-3">
				<form class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">City</label> <select id="city"
							class="form-control input-sm select-size">
							<option value=""></option>
							<?php
    if ($city) {
        foreach ($city as $row) {
            ?>
								<option value="<?php echo $row['City']?>"
								<?php if(isset($search_option_tour['ci_ty'])&&$search_option_tour['ci_ty']==$row['City']){echo 'selected';}?>><?php echo $row['City']?></option>
								<?php

}
    }
    ?>
						</select>
					</div>
				</form>
				<form class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Guide Name</label> <select
							id="guide-name" class="form-control input-sm select-size">
							<option value=""></option>
							<?php
    if ($guide) {
        foreach ($guide as $row) {
            ?>
								<option value="<?php echo $row['GuideName']?>"
								<?php if(isset($search_option_tour['gdname'])&&$search_option_tour['gdname']==$row['GuideName']){echo 'selected';} ?>><?php echo $row['GuideName']?></option>
								<?php
        }
    }
    ?>
					</select>
					</div>
				</form>

			</div>
			<div class="col-md-2">
				<form class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item-md">Car No.</label> <select id="car-no"
							class="form-control input-sm select-size-sm">
							<option value=""></option>
						<?php
    if ($car_info) {
        foreach ($car_info as $row) {
            ?>
							<option value="<?php echo $row['CarNo'];?>"
								<?php if(isset($search_option_tour['crno'])&&$search_option_tour['crno']==$row['CarNo']){echo 'selected';} ?>><?php echo $row['CarNo'];?></option>
							<?php
        }
    }
    ?>		    				
				</select>
					</div>
				</form>
				<form class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item-md">Dri.Name</label> <select
							id="driver-name" class="form-control input-sm select-size-sm">
							<option value=""></option>   					
					<?php
    if ($car_info) {
        foreach ($car_info as $row) {
            ?>
						<option value="<?php echo $row['DriverName'];?>"
								<?php if(isset($search_option_tour['drname'])&&$search_option_tour['drname']==$row['DriverName']){echo 'selected';} ?>><?php echo $row['DriverName'];?></option>
						<?php
        }
    }
    ?>
			</select>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<form class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Guest Name</label> <input
							id="guest-name" type="text" id="datepicker1"
							class="form-control input-sm select-size"
							placeholder="Guest Name"
							value="<?php if(isset($search_option_tour['gsname'])){echo $search_option_tour['gsname'];} ?>">
					</div>
				</form>
				<form class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Tour Name</label> <select id="tour-name"
							class="form-control input-sm select-size">
							<option value=""></option>
				<?php
    if ($tour) {
        foreach ($tour as $row) {
            ?>
					<option value="<?php echo $row['TourName']?>"
								<?php if(isset($search_option_tour['trname'])&&$search_option_tour['trname']==$row['TourName']){echo 'selected';} ?>><?php echo $row['TourName']?></option>
					<?php
        }
    }
    ?>
		</select>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				<div class="row row-border-center">
					<form class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">From Date</label>
							<div id="from-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="from-date"
								data-input="form-control input-sm"
								data-date="<?php if(isset($search_option_tour['fr_date'])){echo $search_option_tour['fr_date'];} ?>"
								data-close='false'></div>
						</div>
					</form>
					<form class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">To Date</label>
							<div id="to-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="to-date"
								data-input="form-control input-sm"
								data-date="<?php if(isset($search_option_tour['t_date'])){echo $search_option_tour['t_date'];} ?>"
								data-close='false'></div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-1">
				<div class="button-action-div">
					<button class="btn btn-primary button-sm btn-sm btn-action"
						onclick="clear_data()">Clear</button>
					<button class="btn btn-primary button-sm btn-sm btn-action"
						onclick="get_data_search()">Search</button>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Optional Guide Table</label>
			</div>
	<?php //echo form_open('optional-tour/update-optional-tour-guide-table'); ?>
	<div class="row">
				<div class="col-md-10">
					<div id="div-optional-tour-guide" class="list-scroll">
						<table id="table-optional-tour-guide"
							class="display nowrap cell-border">
							<tbody></tbody>
						</table>
					</div>
				</div>
				<div class="col-md-2">
					<div class="button-action-div">
						<button class="btn btn-sm button-lg btn-primary btn-action"
							onClick="location.href='new-optional-tour-guide'">New Guide</button>
						<br>
						<button class="btn btn-sm button-lg btn-primary btn-action"
							onClick="update_guide_table()" disabled="true" id="update_guide">Update
							Guide-Table</button>
						<br>
						<button class="btn btn-sm button-lg btn-primary btn-action"
							onclick="delete_guide_table()" disabled="true" id="delete_guide">Delete
							Guide-Table</button>
						<br>
						<form method="POST"
							action="<?php echo base_url('OptionalController/export_ExcelOptionalTourGuideForm');?>">
							<!-- print_single -->
							<input type="hidden" name="date" id="date" value=""> <input
								type="hidden" name="tltcode" id="tltcode"> <input type="hidden"
								name="guide_name" id="guide_name"> <input type="hidden"
								name="guide_tel" id="guide_tel"> <input type="hidden"
								name="driver_name" id="driver_name"> <input type="hidden"
								name="driver_tel" id="driver_tel"> <input type="hidden"
								name="car_no" id="car_no"> <input type="hidden" name="tour_name"
								id="tour_name">
							<!-- print_all -->
							<input type="hidden" name="ci_ty" id="ci_ty" value=""
								class="search_condition"> <input type="hidden" name="gdname"
								id="gdname" class="search_condition"> <input type="hidden"
								name="crno" id="crno" class="search_condition"> <input
								type="hidden" name="drname" id="drname" class="search_condition">
							<input type="hidden" name="gsname" id="gsname"
								class="search_condition"> <input type="hidden" name="trname"
								id="trname" class="search_condition"> <input type="hidden"
								name="fr_date" id="fr_date" class="search_condition"> <input
								type="hidden" name="t_date" id="t_date" class="search_condition">

							<input class="btn btn-sm button-md btn-primary btn-action"
								id="print-optional-tour-guide" disabled="true" value="Print"
								type="submit" name="print_single" /><br> <input
								class="btn btn-sm button-md btn-primary btn-action"
								disabled="true" id="print_all" value="Print All" type="submit"
								name="print_all" />
						</form>
					</div>
				</div>
			</div>
	<?php //echo form_close();?>
	<div class="row">
				<label id="lb-total">Total of Guests</label> <label id="total"
					class="red-label"></label> <label id="lb-person">Person(s)</label>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-5">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Registered in Japan</label>
					</div>
					<div id="div-guest-jp" class="list-scroll">
						<table id="table-guest-jp" class="table table-fixed"></table>
					</div>
					<div class="row">
						<label id="lb-total">Total of Guests</label> <label id="total-jp"
							class="red-label"></label> <label id="lb-person">Person(s)</label>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Registered in VietNam</label>
					</div>
					<div id="div-guest-vn" class="list-scroll">
						<table id="table-guest-vn" class="table table-fixed"></table>
					</div>
					<div class="row">
						<label id="lb-total">Total of Guests</label> <label id="total-vn"
							class="red-label"></label> <label id="lb-person">Person(s)</label>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">
	$('input[name=from-date]').attr('id', 'from_date_input');
	$('input[name=to-date]').attr('id', 'to_date_input');
	var tourTable = false;
	$(document).ready(function(){
		var check_data = '<?php echo isset($search_option_tour);?>';
		if(check_data)
		{
			get_data_search();
		}
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

	});
var i = 0;
var search_condition_obj={};
function get_data_search()
{
	$("#ci_ty").val($("#city").val());
	$("#gdname").val($("#guide-name").val());
	$("#crno").val($("#car-no").val());
	$("#drname").val($("#driver-name").val());
	$("#gsname").val($("#guest-name").val());
	$("#trname").val($("#tour-name").val());
	$("#fr_date").val($("input[name=from-date]").val());
	$("#t_date").val($("input[name=to-date]").val());

	if (tourTable) {
		tourTable.ajax.reload();
	} else {
		tourTable = $("#table-optional-tour-guide").DataTable({
			responsive: true,
			scrollY: 145,
			scrollX: true,
			paging: false,
			searching: false,
			info: false,
			order:[],
			ajax: {
				url: "<?php echo base_url('OptionalController/search_optional_tour_guide'); ?>",
				async: false,
				type: "POST",  
				data: function(x){
					x.city = $("#city").val();
					x.guide_name = $("#guide-name").val();
					x.car_no = $("#car-no").val();
					x.driver_name = $("#driver-name").val();
					x.guest_name = $("#guest-name").val();
					x.tour_name = $("#tour-name").val();
					x.from_date = $("input[name=from-date]").val();
					x.to_date = $("input[name=to-date]").val();
				},

				dataType: "json",
				dataSrc: function( json ) {
					$('#total').html(json.data.count);
			    	return json.tableData;
				},
			},
			columns: [
				{"data":"TBLCodeOptionalTour", "title":"Table Code"},
				{"data":"TourName", "title":"Tour Name"},
				{"data":"DateGo", "title":"Date"},
				{"data":"GuideName", "title":"Guide Name"},
				{"data":"GuideTel", "title":"Tel"},
				{"data":"DriverName", "title":"Driver Name"},
				{"data":"DriverTel", "title":"Tel"},
				{"data":"CarNo", "title":"Car No"},
				{"data":"CarSeat", "title":"Car Seat"},
				{"data":"GPecuPenalty", "title":"GPecuPenalty", "visible": false},
				{"data":"GComplainNote", "title":"GComplainNote", "visible": false},
				{"data":"GComplain", "title":"GComplain", "visible": false},
				{"data":"ATimeFrom", "title":"ATimeFrom", "visible": false},
				{"data":"ATimeTo", "title":"ATimeTo", "visible": false},
				{"data":"STimeFrom", "title":"STimeFrom", "visible": false},
				{"data":"STimeTo", "title":"STimeTo", "visible": false},
				{"data":"DateGo", "title":"DateGo", "visible": false},
				{"data":"GuideName", "title":"GuideName", "visible": false},
				{"data":"GuideTel", "title":"GuideTel", "visible": false},
				{"data":"DriverName", "title":"DriverName", "visible": false},
				{"data":"DriverTel", "title":"DriverTel", "visible": false},
				{"data":"PUFrom", "title":"PUFrom", "visible": false},
				{"data":"PUTo", "title":"PUTo", "visible": false}
			],
			"processing": true,
		});
	}

	if (tourTable.rows().data().length > 0) {
		$("#update_guide").prop("disabled",false);
		$("#delete_guide").prop("disabled",false);
		$("#print-optional-tour-guide").prop("disabled",false);
		$("#print_all").prop("disabled",false);

		$("#table-optional-tour-guide tbody tr:nth-child(1)").click();
	} else {
		$("#update_guide").prop("disabled",true);
		$("#delete_guide").prop("disabled",true);
		$("#print-optional-tour-guide").prop("disabled",true);
		$("#print_all").prop("disabled",true);
	}
}

$('#table-optional-tour-guide tbody').on( 'click', 'tr', function () {
    tourTable.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');

    var data = tourTable.row(this).data();

    get_guest_transfer(data.DateGo, data.TBLCodeOptionalTour,data.GuideName,data.GuideTel,data.DriverName,data.DriverTel,data.CarNo,data.TourName);
});


function get_guest_transfer(date,TLTCode,guidename,guidetel,drivername,drivertel,carno,tourname){
	$("#date").val(date);
	$("#tltcode").val(TLTCode);
	$("#guide_name").val(guidename);
	$("#guide_tel").val(guidetel);
	$("#driver_name").val(drivername);
	$("#driver_tel").val(drivertel);
	$("#car_no").val(carno);
	$("#tour_name").val(tourname);
	var dt = {
		TLTCode 	: 	TLTCode,
		strDate     :   date
	};	
	$.ajax({   
		url: "<?php echo base_url('OptionalController/get_guest_transfer_tour_guide'); ?>",
		type: "POST",  
		data: dt, 
		dataType: "json",  
		beforeSend: function(){
			$("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},               
		success: function(data){
			var outputGuest_jp = "";
			var outputGuest_vn = "";
			var count_get_jp = 0;
			var count_get_vn = 0;
			$.each (data, function(key, opj) {
				if (key=="guest_jp") {
					// arrGuestJapan = opj;					
					outputGuest_jp += "<thead>";
					outputGuest_jp += "<td style='width:300px'>Guest Name</td>";
					outputGuest_jp += "<td style='width:150px'>Hotel</td>";
					outputGuest_jp += "</thead>";
					outputGuest_jp	+= "<tbody>";
					$.each (opj, function(key1, row) {
						outputGuest_jp += "<tr>";
						outputGuest_jp += "<td style='width:300px'>"+((row["GuestName"]!=null)?row["GuestName"]:"")+"</td>";
						outputGuest_jp += "<td style='width:150px'>"+((row["Hotel"]!=null)?row["Hotel"]:"")+"</td>";
						outputGuest_jp += "</tr>";
					});
					outputGuest_jp	+= "</tbody>";
				}
				if (key=="guest_vn") {
					// arrGuestVietnam = opj;			    	
					outputGuest_vn += "<thead>";
					outputGuest_vn +=  "<td style='width:300px'>Guest Name</td>";
					outputGuest_vn +=  "<td style='width:150px'>Hotel</td>";
					outputGuest_vn += "</thead>";
					outputGuest_vn	+= "<tbody>";
					$.each (opj, function(key1, row) {
						outputGuest_vn += "<tr>";
						outputGuest_vn += "<td style='width:300px'>"+((row["GuestName"]!=null)?row["GuestName"]:"")+"</td>";
						outputGuest_vn += "<td style='width:150px'>"+((row["Hotel"]!=null)?row["Hotel"]:"")+"</td>";
						outputGuest_vn += "</tr>";
					});
					outputGuest_vn	+= "</tbody>";
				}
			});
	$('#table-guest-jp').html(outputGuest_jp);
	$('#table-guest-vn').html(outputGuest_vn);
	$('#total-jp').html($('#table-guest-jp > tbody > tr').length);
	$('#total-vn').html($('#table-guest-vn > tbody > tr').length);
	}
	});
}

function update_guide_table()
{
	var select_optional_guide = tourTable.row(tourTable.$("tr.selected")).data().TBLCodeOptionalTour;
	
	if (select_optional_guide==""){
		alert("No optional guide selected!!!");
	} else {
		var string_href ='update-optional-tour-guide-table?code='+select_optional_guide;
		$('.search_condition').each(function(){
					search_condition_obj[$(this).attr('id')] = $(this).val();
				});

		for(var key in search_condition_obj)
		{
			if(search_condition_obj[key] != '')
			{
				string_href += '&'+key+'='+search_condition_obj[key];
			}
		}
		
		location.href =string_href;	
	}
}

function delete_guide_table(){
	var select_optional_guide = tourTable.row(tourTable.$("tr.selected")).data().TBLCodeOptionalTour;

	if (select_optional_guide==""){
		alert("No optional guide selected!!!");
	} else {
		var n = $("#table-optional-tour-guide > tbody > tr").length;
		var r = confirm("Are you sure to delete!!!");
		if (r == true) {
			$("body").css("cursor", "wait");
			var dt = {
				TBLCode : select_optional_guide
			};

			$.ajax({   
				url: "<?php echo base_url('OptionalController/delete_optional_tour_guide'); ?>",
				type: "POST", 
				data: dt, 
				dataType: "json", 
				beforeSend: function(){
					$("body").css("cursor", "wait");
				},    
				complete: function() {
					$("body").css("cursor","default");
				},                   
				success: function(data){
					if (data.result.trim() == "OK") {
						tourTable.row(tourTable.$("tr.selected")).remove().draw();
					} else {
						alert("Cann't delete!")
					}
				}
			});
		}
	}
}



function clear_data()
{
	$("#city").val("");
	$("#guide-name").val("");
	$("#car-no").val("");
	$("#driver-name").val("");
	$("#guest-name").val("");
	$("#tour-name").val("");
	$("input[name=from-date]").val("");
	$("input[name=to-date]").val("");
}
</script>
<?php echo $this->load->view('Layout/footer');?>