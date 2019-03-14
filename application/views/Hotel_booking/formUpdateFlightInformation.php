<?php echo $this->load->view('Layout/header'); ?>
<div class="content">
	<div class="container">
		<h4>Update Flight Information</h4>
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
								<input value="from" type="radio" name="rb_flight"
									<?php
        if ($flight_info[0]["FltFlg"] == "0") {
            echo "checked";
        } else {
            echo 'disabled';
        }

        ?>>From
							</div>
							<div class="col-md-3">
								<input value="to" type="radio" name="rb_flight"
									<?php
        if ($flight_info[0]["FltFlg"] == "1") {
            echo "checked";
        } else {
            echo 'disabled';
        }
        ?>>To
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Name</label> <input type="text"
										id="name" class="form-control input-sm select-size"
										value="<?php echo ($flight_info)?$flight_info[0]["FltName"]:"" ?>">
									<input type="hidden" id="id"
										class="form-control input-sm select-size"
										value="<?php echo ($flight_info)?$flight_info[0]["FltID"]:"" ?>">
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Place</label> <input type="text"
										id="place" class="form-control input-sm select-size"
										value="<?php echo ($flight_info)?$flight_info[0]["FltPlace"]:"" ?>">
								</div>
							</div>
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item">Time</label> <input type="text"
										id="time" class="form-control input-sm select-size check_time"
										value="<?php echo ($flight_info)?$flight_info[0]["FltTime"]:"" ?>">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-inline form-margin-bottom">
								<div class="form-group">
									<label class="label-item" style="vertical-align: top">Note</label>
									<textarea id="note" cols="50" rows="4"><?php echo ($flight_info)?$flight_info[0]["FltNote"]:"" ?></textarea>
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
						onclick="update_flight_info()">Update</button>
					<button class="btn btn-primary btn-sm button-md btn-print"
						onclick="back_flight_list()">Cancel</button>
				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
		
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
	function update_flight_info(){
		if(!flag_check_time)
		{
			alert('Time must be formartted as [HH:MM]');
		}
		else
		{
			var dt = {
				id  		:   $("#id").val(),
				name		: 	$("#name").val(),
				place		: 	$("#place").val(),
				time		: 	$("#time").val(),
				note		: 	$("#note").val(),
				check_flag	:   $('input:radio[name=rb_flight]:checked').val(),
			};
			$.ajax({
				url: "<?php echo base_url('HotelBookingController/update_flight_info'); ?>",
			    async: false,
			    type: "POST",  
			    data: dt, 
			    dataType: "json",                         
			    success: function(data) {
			    	alert(data["msg"]);
			    	back_flight_list();
			    }
			});
		}
		
	}
	function back_flight_list(){
		location.href='<?php echo base_url();?>hotel-booking/flight-information';
	}

</script>
<?php echo $this->load->view('Layout/footer');?>