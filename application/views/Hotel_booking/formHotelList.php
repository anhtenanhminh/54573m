<?php echo $this->load->view('Layout/header'); ?>
<style type="text/css">
.selected {
	background-color: #397FDB;
}

table thead tr th {
	background-color: #2D6CA2;
	color: white;
	padding: 5px 2px;
}

.very-small {
	width: 55px !important;
}
</style>
<div class="content">
	<div class="container">
		<h4 style="margin-top: 5px; margin-bottom: 0px">
			Hotel List
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='<?php echo base_url();?>hotel-booking'">Back</button>
		</h4>
		<div class="row line-strong"
			style="margin-top: 15px; margin-bottom: 8px"></div>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Search Conditions</label>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">City</label> <select
								class="form-control input-sm select-size-sm" id="city">
								<option></option>
								<?php
        if ($cities) {
            foreach ($cities as $city) {
                ?>
								<option value="<?php echo $city['city']?>"><?php echo $city['city']?></option>
								<?php }}?>	
							</select>
						</div>
						<div class="form-group">
							<label class="label-item">Hotel</label> <select
								class="form-control input-sm select-size-sm" id="hotel">
								<option></option>
								<?php
        if ($hotel) {
            foreach ($hotel as $hotel) {
                ?>
								<option value="<?php echo $hotel['HotelName']?>"><?php echo $hotel['HotelName']?></option>
								<?php }}?>
							</select>
						</div>
						<button class="btn btn-primary btn-sm button-md btn-action"
							onclick="clear_data()">Clear</button>
						<button
							class="btn-search btn btn-primary btn-sm button-md btn-action"
							onclick="get_data_search('')">Search</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"
			style="margin-top: 5px; margin-bottom: 8px"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="row row-border-1 table-border">
					<div class="title-row-div">
						<label class="title-row">Hotel List</label>
					</div>
					<div class="list-scroll" id="div-hotel-list" style="height: 175px">
						<table id="table-hotel-list" class="display nowrap cell-border"
							style="width: 100%">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"
			style="margin-top: 5px; margin-bottom: 10px"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Detailed Info</label>
					</div>
					<div class="col-md-12">
						<form class="form-inline">
							<div class="form-group">
								<label class="label-item-sm">City</label> <select
									id="city-update" class="form-control input-sm select-size-sm">
									<option></option>
									<?php
        if ($cities) {
            foreach ($cities as $city) {
                ?>
									<option value="<?php echo $city['city']?>"><?php echo $city['city']?></option>
									<?php }}?>	
								</select>
							</div>
							<div class="form-group">
								<label class="label-item-sm">Hotel</label> <input type="text"
									id="hotel-update" class="form-control input-sm select-size">
							</div>
							<div class="form-group">
								<label class="label-item-sm">Alias</label> <input type="text"
									id="alias" class="form-control input-sm select-size-sm"
									maxlength="6">
							</div>
							<div class="form-group">
								<label class="label-item-sm">Tel</label> <input id="tel"
									type="text" class="form-control input-sm select-size"
									maxlength="20">
							</div>
							<div class="form-group">
								<label class="label-item-sm">Fax</label> <input id="fax"
									type="text" class="form-control select-size" maxlength="20">
							</div>
							<div class="form-group">
								<label class="label-item" style="width: 85px;">Late Checkout</label>
								<div id="late-checkout"
									class="form-group bfh-timepicker select-size-md"
									data-align="right"
									data-input="form-control input-sm select-size-md very-small"
									data-name="late-checkout" data-time=""></div>
							</div>
						</form>
					</div>
					<div class="col-md-12" style="padding-top: 10px;">
						<div class="col-md-5">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 0px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">Address</label>
										</div>
										<div class="col-md-8">
											<textarea id="address" cols="45" rows="1"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 0px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">R/type</label>
										</div>
										<div class="col-md-8">
											<textarea id="r-type" cols="45" rows="1"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 0px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">R/Class</label>
										</div>
										<div class="col-md-8">
											<textarea id="r-class" cols="45" rows="1"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 0px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">Benefit</label>
										</div>
										<div class="col-md-8">
											<textarea id="benefit" cols="45" rows="1"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 0px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">Attn</label>
										</div>
										<div class="col-md-8">
											<textarea id="attn" cols="40" rows="1"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 0px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">Remark</label>
										</div>
										<div class="col-md-8">
											<textarea id="remark" cols="25" rows="2"></textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 15px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">Payment</label>
										</div>
										<div class="col-md-8">
											<textarea id="payment" cols="25" rows="2"></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"
											style="width: 75px; padding-left: 0px; padding-right: 0px; vertical-align: top;">
											<label class="label-item">CXL Policy</label>
										</div>
										<div class="col-md-8">
											<textarea id="cxl-policy" cols="50" rows="2"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="button-action-div">
						<button class="btn btn-primary button-sm btn-sm btn-action"
							onclick="add_new_hotel()">New</button>
						<button class="btn btn-primary button-sm btn-sm btn-action"
							onclick="update_hotel()">Save</button>
						<button class="btn btn-primary button-sm btn-sm btn-action"
							disabled="true" id="delete-hotel-list"
							onclick="delete_hotel_list()">Delete</button>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="hotelID">
	</div>
	<script
		src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript">
		var hotelTable = false;
		var hotel_ID = "";
		$(document).ready(function(){
			$("input[name=late-checkout]").attr("readonly", true);
			get_data_search("");
			/*get hotel when select city*/
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

		function get_data_search(id) {
			$("#hotelID").val(id);
			if (hotelTable) {
				hotelTable.ajax.reload();
			} else {
				hotelTable = $("#table-hotel-list").DataTable({
					responsive: true,
					scrollY: 140,
					paging: false,
					searching: false,
					scrollX: true,
					info: false,
					order:[],
					ajax: {
						url: "<?php echo base_url('HotelBookingController/get_data_search_hotel_list'); ?>",
						async: false,
						type: "POST",  
						data: function(x){
							x.city = $("#city").val();
							x.hotel = $("#hotel").val();
							x.id = $("#hotelID").val();
						},

						dataType: "json",
						dataSrc: "tableData"
					},
					columns: [
						{"data":"City", "title":"City"},
						{"data":"HotelName", "title":"Hotel Name"},
						{"data":"RoomType", "title":"Room Type"},
						{"data":"RoomClass", "title":"Room Class"},
						{"data":"Address", "title":"Address"},
						{"data":"Tel", "title":"Tel"},
						{"data":"Fax", "title":"Fax"},
						{"data":"LateCheckOut", "title":"Late CheckOut"},
						{"data":"HotelID", "title":"HotelID", "visible": false},
						{"data":"HotelAlias", "title":"HotelAlias", "visible": false},
						{"data":"Attn", "title":"Attn", "visible": false},
						{"data":"Remarks", "title":"Remarks", "visible": false},
						{"data":"Benefit", "title":"Benefit", "visible": false},
						{"data":"Payment", "title":"Payment", "visible": false},
						{"data":"CancelPolicy", "title":"CancelPolicy", "visible": false},
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



	$('#table-hotel-list tbody').on( 'click', 'tr', function () {
	    hotelTable.$('tr.selected').removeClass('selected');
	    $(this).addClass('selected');
	    var hotelId = hotelTable.row(this).data().HotelID;
	    select_hotel(hotelId);
	});

	function select_hotel(hotel_id){
		hotel_ID = hotel_id;
		if(hotel_id!="")
		{
			$('#delete-hotel-list').attr("disabled",false);
		}
		$.ajax({   
			url: "<?php echo base_url('HotelBookingController/get_hotel_info_update'); ?>",
			async: false,
			type: "POST",  
			data: "hotelid="+hotel_id, 
			dataType: "json",                   
			success: function(data){
				$.each (data, function(key, opj) {
					if (key=="hotel"){
						$.each (opj, function(key1, row) {
							$("#alias").val(row["HotelAlias"]);
							$("#tel").val(row["Tel"]);
							$("#fax").val(row["Fax"]);
							$("input[name=late-checkout]").val(row["LateCheckOut"]);
							$("#remark").val(row["Remarks"]);
							$("#payment").val(row["Payment"]);
							$("#city-update").val(row["City"]);
							$("#hotel-update").val(row["HotelName"]);
							$("#r-class").val(row["RoomClass"]);
							$("#cxl-policy").val(row["CancelPolicy"]);
							$("#address").val(row["Address"]);
							$("#r-type").val(row["RoomType"]);
							$("#attn").val(row["Attn"]);
							$("#benefit").val(row["Benefit"]);
						});
					}
				});
			}
		});
	}

	function update_hotel(){
		if ($("#address").val()=="" || $("#hotel-update").val()==""){
			alert("Hotel Address and Hotel Name must have type");
		}
		else {
				var dt = {					
					data        :   create_array_data(),
					HotelID 	    : 	hotel_ID						
				};				
				$.ajax({
					async: false,
					url  : "<?php echo base_url('HotelBookingController/update_hotel'); ?>",
					async: false,
					type : "POST",
					data : dt,
					dataType: "json",
					success: function(data)
					{
						if (data['error'] == 0) {
							get_data_search(data.data);
							clearHotelInfo();
							alert(data.msg);
						}
						else{
							alert(data.msg);
						}
					}
				});	
		}
	}
	function create_array_data()
	{
		var list_result = {
			HotelAlias			:	$("#alias").val(),
			Tel	                : 	$("#tel").val(),
			Fax	                : 	$("#fax").val(),
			LateCheckOut	    : 	$("input[name=late-checkout]").val(),
			Remarks	            : 	$("#remark").val(),
			Payment	            : 	$("#payment").val(),
			City	            : 	$("#city-update").val(),
			HotelName	        : 	$("#hotel-update").val().trim(),
			RoomClass	        : 	$("#r-class").val().replace(/ /g ,""),
			CancelPolicy	    : 	$("#cxl-policy").val(),
			Address	            : 	$("#address").val(),
			RoomType	        : 	$("#r-type").val(),
			Attn	            : 	$("#attn").val(),
			Benefit	            : 	$("#benefit").val()
		}		
		return list_result;
	}

	function load_default(){
		hotel_ID ="new";		
		$("#alias").val("");
		$("#tel").val("");
		$("#fax").val("");
		$("input[name=late-checkout]").val("");
		$("#remark").val("Please confirm WITHIN 1 HOUR");
		$("#payment").val("Hotel room charge will be paid by HIS - Song Han  Co.");
		$("#city-update").val("");
		$("#hotel-update").val("");
		$("#r-class").val("ROH;DLX;DLX-CV;DLX-RX;SUITE;J-SUITE");
		$("#cxl-policy").val("");
		$("#address").val("");
		$("#r-type").val("SGL;TWN;DBL;TPL");
		$("#attn").val("Hotel Reservation Department");
		$("#benefit").val("");
	}
	function add_new_hotel()
	{
		load_default();
		$("#delete-hotel-list").prop("disabled", true);
	}

	function clear_data()
	{
		$("#city").val("");
		$("#hotel").val("");
	}
	function delete_hotel_list()
	{
	    var hotel_id = hotelTable.row(hotelTable.$('tr.selected')).data().HotelID;
		if(typeof(hotel_id) == "undefined")
		{
			window.alert("Please select Hotel in List Hotel.");
		}
		else
		{
			var r = confirm("Are you sure to delete.");
			if(r)
			{			
				var dt = {
					hotel_id  : hotel_id
				};
				$.ajax({                
					url: "<?php echo base_url('HotelBookingController/delete_hotel_list'); ?>",
					type: "POST",  
					data: dt, 
					dataType: "json",
					success: function(data) {   
						$.each (data, function(key, opj)
						{
							if(key=="msg")
							{
								if(opj=="true")
								{	
									$("#table-hotel-list").find("tr");
									$("#"+hotel_id).remove();
									$('#delete-hotel-list').attr("disabled",true);
									clearHotelInfo();
									hotelTable.row(hotelTable.$('tr.selected')).remove().draw();
									add_new_hotel();
								}
								else
								{
									window.alert("Delete hotel fail.");
								}
							}  
						});
					get_data_search();	
					}         
				});       
			}
		}
	}

	function clearHotelInfo () {
		$("#alias").val("");
		$("#tel").val("");
		$("#fax").val("");
		$("input[name=late-checkout]").val("");
		$("#remark").val("");
		$("#payment").val("");
		$("#hotel-update").val("");
		$("#r-class").val("");
		$("#cxl-policy").val("");
		$("#address").val("");
		$("#r-type").val("");
		$("#attn").val("");
		$("#benefit").val("");
		$("#city").val("");
		$("#hotel").val("");
	}
</script>