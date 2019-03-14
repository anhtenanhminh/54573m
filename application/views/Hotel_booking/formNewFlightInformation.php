<?php echo $this->load->view('Layout/header'); ?>
<div class="content">
	<div class="container">
		<h4>New Flight Information</h4>
		<div class="row line-strong"></div>

		<div class="row">
			<div class="col-md-12">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Flight Detail</label>
					</div>
					<div class="row">
						<div class="col-md-8 form-inline">
							<div class="col-md-2 col-md-offset-1">
								<input value="from" type="radio" name="rb_flight" checked>From
							</div>
							<div class="col-md-3">
								<input value="to" type="radio" name="rb_flight">To
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Name</label> <input type="text"
										class="form-control input-sm select-size" id="name">
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Place</label> <input type="text"
										class="form-control input-sm select-size" id="place">
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Time</label> <input type="text"
										class="form-control input-sm select-size check_time" id="time">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item" style="vertical-align: top">Note</label>
									<textarea id="note" cols="50" rows="4"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-2 ">
				<br>
				<div class="form-inline">
					<button class="btn btn-primary btn-sm button-md btn-print"
						onclick="add_new_flight()">Save</button>
					<button class="btn btn-primary btn-sm button-md btn-print"
						onclick="cancel()">Cancel</button>
				</div>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		flag = '<?php echo $flag ?>';
		if(flag != '')
		{
			if(flag == 'from')
			{
				$('input[name=rb_flight][value=from]').prop('checked',true);
				$('input[name=rb_flight][value=to]').prop('disabled',true);
			}
			else
			{
				$('input[name=rb_flight][value=to]').prop('checked',true);
				$('input[name=rb_flight][value=from]').prop('disabled',true);
			}
		}
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
  		//end Duong
	});
	function add_new_flight(){
		if($("#name").val()==""){
			alert("Please Choose name");
		}else if($("#place").val()==""){
			alert("Please choose place ");
		}else if($("#time").val()==""){
			alert("Please choose time ");
		}else if(!flag_check_time){
			alert('Time must be formatted as [HH:MM]');
		}else{
			var dt = {
				name		: 	$("#name").val(),
				place		: 	$("#place").val(),
				time		: 	$("#time").val(),
				note        :   $("#note").val(),
				check_flag	:   $('input:radio[name=rb_flight]:checked').val()
			};
			$.ajax({
				url: "<?php echo base_url('HotelBookingController/add_new_flight'); ?>",
			    async: false,
			    type: "POST",  
			    data: dt, 
			    dataType: "json",                         
			    success: function(data) {
			    	alert(data["msg"]);
                                location.href='<?php echo base_url();?>hotel-booking/flight-information';
			    }
			});
		}
	}
	function cancel(){
		location.href='<?php echo base_url();?>hotel-booking/flight-information';
	}
</script>
<?php echo $this->load->view('Layout/footer');?>