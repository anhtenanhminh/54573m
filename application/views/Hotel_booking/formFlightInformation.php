<?php echo $this->load->view('Layout/header'); ?>
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
		<h4>Flight Information</h4>
		<div class="row line-strong"></div>

		<div class="row">
			<div class="col-md-12">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Flight Detail</label>
					</div>
					<div class="row">
						<div class="col-md-6 form-inline">
							<div class="col-md-3 col-md-offset-1">
								<input value="from" type="radio" name="rb_flight" checked>From
							</div>
							<div class="col-md-3">
								<input value="to" type="radio" name="rb_flight">To
							</div>
						</div>
						<div class="col-md-2">
							<button class="btn-search btn btn-primary button-md btn-action"
								onclick="get_data_search()">Search</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Name</label> <input type="text"
										id="name" class="form-control input-sm select-size">
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Place</label> <input type="text"
										id="place" class="form-control input-sm select-size">
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Time</label> <input type="text"
										id="time" class="form-control input-sm select-size check_time">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item-sm" style="vertical-align: top;">Note</label>
									<textarea name="" id="note" cols="30" rows="3"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-md-offset-1">
							<div class="form-inline">
								<button class="btn btn-primary btn-sm button-md btn-print"
									onclick="new_flight()">New</button>
								<button class="btn btn-primary btn-sm button-md btn-print"
									onclick="update_flight()">Update</button>
								<button class="btn btn-primary btn-sm button-md btn-print"
									onclick="delete_flight()">Delete</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-7">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Flight List</label>
					</div>
					<div id="div-flight-info" class="list-scroll"
						style="height: 340px;">
						<table id="table-flight-info" class="display nowrap cell-border">
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script
	src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
	var flightTable = false;
	$(document).ready(function(){  
		$("input[type=text]").val("");
		$('textarea').val('');
  		//Duong - check time format
  		flag_check_time = true;
  		$('.check_time').keypress(function(evt){
  			var theEvent = evt || window.event;
  			var key = theEvent.keyCode || theEvent.which;
  			key = String.fromCharCode( key );
  			var regex = /[0-9\b\t:]/;
  			if( !regex.test(key)) 
  			{
  				theEvent.returnValue = false;
  				if(theEvent.preventDefault) theEvent.preventDefault();
  			}
  		});
  		$('.check_time').blur(function(event)
  		{
  			var time = $(this).val();
  			if (checkChange(time)) {
  				$(this).val(reFormat(time));
  			}
  		});

  		get_data_search();
  	});

	/*get data after click search*/
	function get_data_search(){

		if (flightTable) {
			flightTable.ajax.reload();
		} else {
			flightTable = $("#table-flight-info").DataTable({
				responsive: true,
				scrollY: 270,
				paging: false,
				searching: false,
					// scrollX: true,
					info: false,
					order:[],
					ajax: {
						url: "<?php echo base_url('HotelBookingController/get_data_search_flight_information'); ?>",
						async: false,
						type: "POST",  
						data: function(x){
							x.name = $("#name").val();
							x.place = $("#place").val();
							x.time = $("#time").val();
							x.note = $("#note").val();
							x.check_flag = $('input:radio[name=rb_flight]:checked').val();
						},

						dataType: "json",
						dataSrc: "tableData"
					},
					columns: [
					{"data":"index", "title":"No"},
					{"data":"FltName", "title":"Name"},
					{"data":"FltPlace", "title":"Place"},
					{"data":"FltTime", "title":"Time"},
					{"data":"FltNote", "title":"Note"},
					{"data":"FltID", "title":"FltID", "visible": false},
					{"data":"FltFlg", "title":"FltFlg", "visible": false},
					],
					"processing": true,
					"drawCallback": function(setting) {
						if ( setting.bSorted || setting.bFiltered )
						{
							for ( var i=0, iLen=setting.aiDisplay.length ; i<iLen ; i++ )
							{
								$('td:eq(0)', setting.aoData[ setting.aiDisplay[i] ].nTr ).html( i+1 );
							}
						}
					}
				});
}
}
$('#table-flight-info tbody').on( 'click', 'tr', function () {
	flightTable.$('tr.selected').removeClass('selected');
	$(this).addClass('selected');

	$("#name").val(flightTable.row(this).data().FltName);
	$("#place").val(flightTable.row(this).data().FltPlace);
	$("#time").val(flightTable.row(this).data().FltTime);
	$("#note").val(flightTable.row(this).data().FltNote);
	
});

function update_flight(){
	var select_flight = flightTable.row(flightTable.$("tr.selected")).data().FltID;
	if (select_flight==""){
		alert("No flight selected!!!");
	} 
	else if(!flag_check_time)
	{

	}
	else {
		location.href='<?php echo base_url();?>hotel-booking/update-flight?id='+select_flight;
	}
}
function delete_flight(){
	var select_flight = flightTable.row(flightTable.$("tr.selected")).data().FltID;
	if (select_flight==""){
		alert("No flight selected!!!");
	} else{
		var r = confirm("Are you sure to delete the flight ?");
		if(r == true) {
			$.ajax({
				url: "<?php echo base_url('HotelBookingController/delete_flight'); ?>",
				type: "POST",  
				data: "id_flight=" + select_flight,
				dataType: "json",            
				beforeSend: function(){
					$("body").css("cursor", "wait");
				},    
				complete: function() {
					$("body").css("cursor","default");
				},                
				success: function(result) {
					$.each (result, function(key, obj) {
						if (obj=="true"){
							alert("Delete success!!");
							flightTable.row(flightTable.$("tr.selected")).remove().draw();
						} else {
							alert("Delete fail!!");
						}
					});
				}
			});
			
		}
		
	}
}

$("input[name=rb_flight]").click(function(){
	$("#name").val('');
	$("#place").val('');
	$("#time").val('');
	$("#note").val('');
})
//Duong
function new_flight()
{
	location.href='<?php echo base_url();?>hotel-booking/new-flight?flag='+$('input[name=rb_flight]:checked').val();
}
//end Duong
</script>
<?php echo $this->load->view('Layout/footer');?>