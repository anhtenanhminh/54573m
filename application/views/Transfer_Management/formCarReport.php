<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.selected {
	background: #397FDB none repeat scroll 0% 0%;
}

table thead tr th {
	background-color: #2D6CA2;
	color: white;
	/*padding: 8px 10px !important;*/
}
</style>
<div class="content">

	<div class="container">
		<h3 style="margin-top: 6px; margin-bottom: 0px;">
			CAR REPORT
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='././c-d-g-managerment'">Close</button>
		</h3>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields </label>
			</div>
			<div class="col-md-4">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Car</label>
					</div>
					<div class="col-md-12">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item-lg">Car No</label> <select id="car-no"
									class="form-control input-sm select-size">
									<option value=""></option>
			    					<?php
            if ($car_info) {
                foreach ($car_info as $row) {
                    ?>
											<option value="<?php echo $row['CarNo']?>"><?php echo $row['CarNo']?></option>
										<?php
                }
            }
            ?>
			    				</select>
							</div>
						</div>
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item-lg">Driver Name</label> <input
									type="text" id="driver-name"
									class="form-control input-sm select-size" readonly="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Date</label>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-lg">From Date</label>
							<div id="from-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="from-date"
								data-input="form-control input-sm" data-date=""></div>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item-lg">To Date</label>
							<div id="to-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="to-date"
								data-input="form-control input-sm" data-date=""></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="button-action-div">
					<button class="btn-search btn btn-primary button-md btn-action"
						onclick="get_data_search()">Search</button>
					</br>
					<button class="btn btn-primary button-md btn-action"
						onclick="clear_car_report()">Clear</button>
				</div>
			</div>

		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Result</label>
			</div>
			<div class="col-md-10">
				<div id="div-car-search" class="list-scroll">
					<table id="table-car-search" class="display nowrap">
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="col-md-2">
				<div class="button-action-div">
					<form method="POST"
						action="<?php echo base_url('TransferController/export_car');?>">
						<input type="hidden" name="driver_id" id="driver_id" value=""> <input
							type="hidden" name="from_date" id="from_date"> <input
							type="hidden" name="to_date" id="to_date"> <input
							class="btn btn-primary button-md btn-action" id="btn-print"
							disabled="true" value="Print" type="submit" />
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  	var falg = 0;
  	var resultTable = false;
    $(document).ready(function(){
		$('input[name=from-date]').attr('readonly', false);
  		$('#from-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=from-date]').val())){
  				$('input[name=from-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  				setTimeout(function(){
  					$('input[name=from-date]').focus();
  				},1);
  			} else {
  				$('input[name=from-date]').css('border', "1px solid #ccc");
  			}
		});

		$('input[name=to-date]').attr('readonly', false);
  		$('#to-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=to-date]').val())){
  				$('input[name=to-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  				setTimeout(function(){
  					$('input[name=to-date]').focus();
  				},1);
  			} else {
  				$('input[name=to-date]').css('border', "1px solid #ccc");
  			}
		});

		$('#car-no').change(function () 
		{
			// console.log("aaaa");
	    	var driver=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('TransferController/get_name_driver'); ?>",
	            async: false,
	            type: "POST",  
	            data: "driver="+ driver, 
	            dataType: "text",				                         
	            success: function(data) {
	                $('#driver-name').val(data);
	            }
	        });
	 	});
 	});

function get_data_search(){
    if($("#car-no").val()=="")
    {
        window.alert("Please enter Car No.");
    }
    else
    {
		$("#btn-print").prop("disabled", true);
		if (resultTable)
		{
			resultTable.ajax.reload();
		} 
		else 
		{
			resultTable = $("#table-car-search").DataTable({
				scrollY: 250,
				searching:false,
				info: false,
				paging: false,
				ajax: {
					url: "<?php echo base_url('TransferController/search_car_report'); ?>",
				    async: false,
				    type: "POST",  
				    data: searchData, 
				    dataType: "json",
				    dataSrc: "data"
				},
				columns:[
					{"data":"ID", "title": "ID","visible": false},
					{"data":"DateIn", "title": "DATE"},
					{"data":"CarNo", "title": "Car No"},
					{"data":"DriverName", "title": "Driver Name"},
					{"data":"TourName", "title": "Tour Name"},
					{"data":"ATimeFrom", "title": "Start Time"},
					{"data":"AtimeTo", "title": "End Time"},
					{"data":"TimeGo", "title": "Time"},
					{"data":"Pax", "title": "Pax"},
					{"data":"GPecuPenalty", "title": "GPecuPenalty","visible": false},
					{"data":"GFinished", "title": "GFinished","visible": false},
					{"data":"DriverTel", "title": "DriverTel","visible": false},
				],
				"order": [[ 1, "desc" ]]
			})
		}
		resultTable.$('tr:nth-child(1)').click();
		if (resultTable.rows().data().length == 0) 
		{
			alert("Data Not Fault!");			
		} else 
		{
			$("#driver_id").val($("#car-no").val());
			$("#from_date").val($("input[name=from-date]").val());
			$("#to_date").val($("input[name=to-date]").val());
			$("#btn-print").prop("disabled", false);

		}		
    }
}
$('#table-car-search tbody').on( 'click', 'tr', function () {
    resultTable.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
});
function searchData()
{
	var dt = {
		driver			: 	$("#car-no").val(),
		from_date		: 	$("input[name=from-date]").val(),
		to_date			: 	$("input[name=to-date]").val()
	};
	return dt;
}
function clear_car_report()
{
    $('#btn-print').attr('disabled',true);
    $("#car-no").val("");
    $("input[name=from-date]").val("");
    $("input[name=to-date]").val("");
    $("#driver-name").val("");
    $('#div-car-search').html("");
}
function print_car()
{
 //    var dt = {
	// 	driver			: 	$("#car-no").val(),
	// 	from_date		: 	$("input[name=from-date]").val(),
	// 	to_date			: 	$("input[name=to-date]").val()
	// };
	// $.ajax({
 //            url: "<?php echo base_url('TransferController/export_car'); ?>",
	//     async: false,
	//     type: "POST",  
	//     data: dt, 
	//     dataType: "json",
 //            beforeSend: function(){
	// 	    $("body").css("cursor", "wait");
	// 		},
 //                complete: function() {
	// 			$("body").css("cursor","default");
	// 			window.open("<?php echo base_url('newCarReport.xls'); ?>", '_blank');
	// 		}              
 //    });
}
</script>
<?php echo $this->load->view('Layout/footer');?>