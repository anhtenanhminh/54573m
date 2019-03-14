<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.dataTables_length {
	display: none;
}

table thead tr th {
	background-color: #2D6CA2;
	color: white;
	padding: 5px 2px;
}
</style>
<div class="content">

	<div class="container">
		<h3 style="margin-top: 6px; margin-bottom: 0px;">GUIDE CAR SCHEDULING
		</h3>

		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields </label>
			</div>

			<div class="col-md-6">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Infomation</label>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">VN Code</label> <input type="text"
									id="vn-code" class="form-control input-sm select-size"
									placeholder="VN Code">
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Guest</label> <input type="text"
									id="guest" class="form-control input-sm select-size"
									placeholder="Guest">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">City</label> <select id="city"
									class="form-control input-sm select-size">
									<?php
        if ($city) {
            foreach ($city as $row) {
                if ($row['City'] == "HCM") {
                    ?>

												<option value="<?php echo $row['City']?>" selected><?php echo $row['City']?></option>
												<?php
                } else {
                    ?>
											<option value="<?php echo $row['City']?>"><?php echo $row['City']?></option>
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
								<label class="label-item">Hotel Name</label> <select id="hotel"
									class="form-control input-sm select-size">
									<option></option>
								<?php

if ($hotel) {
            foreach ($hotel as $key => $value) {
                ?>
										<option value="<?php echo $value['HotelName']?>"><?php echo $value['HotelName']?></option>
										<?php
            }
        }
        ?>
								<option></option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Date</label>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">From Date</label>
							<div id="from-date" class="form-group bfh-datepicker"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="from-date"
								data-input="form-control input-sm select-size-md" data-date=""></div>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">To Date</label>
							<div id="to-date" class="form-group bfh-datepicker"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="to-date"
								data-input="form-control input-sm  select-size-md" data-date=""></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="button-action-div">
					<button class="btn-search btn btn-primary button-md btn-action"
						onclick="get_data_search()">Search</button>
					</br>
					<button class="btn btn-primary button-md btn-action"
						onclick="clear_data()">Clear</button>
				</div>
			</div>

		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Result</label>
			</div>
			<div id="div-guide-car-search" class="list-scroll">
				<table id="table-guide-car-search"
					class="display nowrap cell-border">
					<tbody></tbody>
				</table>
			</div>
		</div>
		<form method="POST"
			action="<?php echo base_url('TransferController/export_guide_car'); ?>">
			<input type="hidden" name="vn_code" id="vn_code" value=""> <input
				type="hidden" name="guest_name" id="guest_name"> <input
				type="hidden" name="cty" id="cty"> <input type="hidden" name="htel"
				id="htel"> <input type="hidden" name="from_date" id="from_date"> <input
				type="hidden" name="to_date" id="to_date">
			<div class="row btn-center">
				<input class="btn btn-primary button-md" id="btn-print"
					value="Print" onclick="return check_print()" type="submit" />
			</div>
		</form>


	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
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

		$('#city').change(function () {
			var city=$(this).val();
			$.ajax({   
				url: "<?php echo base_url('TransferController/get_hotel'); ?>",
				async: false,
				type: "POST",  
				data: "city="+ city, 
				dataType: "html",				                         
				success: function(data) {
					$('#hotel').html(data);
				}
			});
		});
	});
var i = 0;
pos = 0;

var resultTable = false;

function check_print()
{
	if($("#table-guide-car-search > tbody > tr").length==0)
	{
		alert("Please try agian data...");
		return false;
	}
	else
	{
		return true;
	}
}
function getData()
{
	return {
		vn_code			: 	$("#vn-code").val(),
		guest_name		: 	$("#guest").val(),
		city 			: 	$("#city").val(),
		hotel 			: 	$("#hotel").val(),
		from_date		: 	$("input[name=from-date]").val(),
		to_date			: 	$("input[name=to-date]").val()
	};
}
var flag="false";
function get_data_search()
{
	flag = "true";
	$("#vn_code").val($("#vn-code").val());
	$("#guest_name").val($("#guest").val());
	$("#cty").val($("#city").val());
	$("#htel").val($("#hotel").val());
	$("#from_date").val($("input[name=from-date]").val());
	$("#to_date").val($("input[name=to-date]").val());
	if (resultTable) 
	{
		resultTable.ajax.reload();
	} else {
		resultTable = $("#table-guide-car-search").DataTable({
			responsive: true,
			paging: true,
			scrollX: true,
			searching: false,
			info: false,
			"serverSide": true,
			"deferRender": true,
			ajax: {
				url: "<?php echo base_url('TransferController/get_data_search_guide_car'); ?>",
			    type: "POST",  
			    data: function(x){
			    	x.vn_code = $("#vn-code").val();
			    	x.guest_name = $("#guest").val();
			    	x.city = $("#city").val();
			    	x.hotel = $("#hotel").val();
			    	x.from_date = $("#input[name=from-date]").val();
			    	x.to_date = $("#input[name=to-date]").val();
			    	x.length = 10;
			    	x.flag = flag;
			    }, 
			    dataType: "json",
			    dataSrc: function(result){
			    	flag = "false";
			    	return result.data;
			    },
			},
			columns: [
				{"data":"Vncode", "title":"Vn Code", "width": "105px"},
				{"data":"ArrvDate1", "title":"Date In", "width": "90px"},
				{"data":"DeptDate1", "title":"Date Out", "width": "90px"},
				{"data":"InFlight", "title":"InFlight", "width": "70px"},
				{"data":"OutFlight", "title":"OutFlight", "width": "70px"},
				{"data":"FromPlace", "title":"FromPlace", "width": "90px"},
				{"data":"ToPlace", "title":"ToPlace", "width": "90px"},
				{"data":"TimeIn", "title":"TimeIn", "width": "75px"},
				{"data":"TimeOut", "title":"TimeOut", "width": "75px"},
				{"data":"Hotel", "title":"Hotel", "width": "200px"},
				{"data":"NPer", "title":"NPer", "width": "50px"},
				{"data":"GroupName", "title":"Guest Name", "width": "220px"},
				{"data":"TourName", "title":"Tour Name", "width": "320px"},
				{"data":"Date", "title":"Date", "width": "90px"},
				{"data":"tourID", "title":"Tour ID", "width": "130px"},
			],
	        "processing": true,
		    order:[]
		});
	}
}

function clear_data()
{
	$("#vn-code").val("");
	$("#guest").val("");
	$("#city").val("");
	$("#hotel").html("<option></optiom><option></optiom>");
	$("#from-date").val("");
	$("#to-date").val("");
}
</script>
<?php echo $this->load->view('Layout/footer');?>