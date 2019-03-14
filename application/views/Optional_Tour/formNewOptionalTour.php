<?php echo $this->load->view('Layout/header')?>
<div class="content">

	<div class="container">
		<h4>
			NEW OPTIONAL TOUR
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='<?php echo base_url();?>optional-tour/option-tour-list'">Back</button>
		</h4>
		<div class="row line-strong" style="margin-top: 20px;"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Optional Tour List </label>
			</div>
			<div class="col-md-4">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">City</label> <select id="city"
							class="form-control input-sm select-size-lg">
							<option></option>
		    				<?php
        if ($city) {
            foreach ($city as $row) {
                ?>
									    <option value="<?php echo $row['City']?>"><?php echo $row['City']?></option>
							<?php

}
        }
        ?>	
		    			</select>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Tour Code</label> <input id="tour-code"
							type="text" class="form-control input-sm select-size-lg"
							placeholder="Tour Code">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">To</label> <input id="to-place"
							type="text" class="form-control input-sm select-size-lg">
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Tour Name</label> <input id="tour-name"
							type="text" class="form-control input-sm select-size-xlg"
							placeholder="Tour Name">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Time</label>
						<!-- <input id="time-from" type="text" class="form-control input-sm select-size-xsm"> -->
						<div id="time-from" class="form-group bfh-timepicker"
							data-placeholder="hh:ii" data-format="y/m/d" data-align="right"
							data-name="time-from"
							data-input="form-control input-sm select-size-xsm" data-time=""></div>
						<label class="label-item-xsm">-</label>
						<!-- <input id="time-to" type="text" class="form-control input-sm select-size-xsm"> -->
						<div id="time-to" class="form-group bfh-timepicker"
							data-placeholder="hh:ii" data-format="y/m/d" data-align="right"
							data-name="time-to"
							data-input="form-control input-sm select-size-xsm" data-time=""></div>

					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Duration</label> <input id="duration"
							type="text" class="form-control input-sm select-size-xsm"
							readonly>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">PaxN</label> <input id="PaxN"
							type="text" class="form-control input-sm select-size-xsm">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Fax</label> <input id="Fax" type="text"
							class="form-control input-sm select-size">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Tel</label> <input id="tele" type="text"
							class="form-control input-sm select-size">
					</div>
				</div>
			</div>

		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Option Tour Content</label>
			</div>
			<textarea id="tour-content" class="form-control" rows="10"></textarea>
		</div>
		<div class="row btn-center">
			<button class="btn btn-primary button-md"
				onclick="create_new_optional_tour()">Save</button>
		</div>

	</div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#time-from').on("change.bfhtimepicker", function(){
			if (formatTime($('input[name=time-from]').val())){
				$("#duration").val(calTime($('input[name=time-from]').val()+":00", $('input[name=time-to]').val()+":00"));
				return true;
			} else {
				if (parseInt($('input[name=time-from]').val())<24){
					$('input[name=time-from]').val($('input[name=time-from]').val()+":00");
					$("#duration").val(calTime($('input[name=time-from]').val()+":00", $('input[name=time-to]').val()+":00"));
				} else {
					$('input[name=time-from]').val("");
					alert("Not format time!");
				}
			}
		});
		$('#time-to').on("change.bfhtimepicker", function(){
			if (formatTime($('input[name=time-to]').val())){
				$("#duration").val(calTime($('input[name=time-from]').val()+":00", $('input[name=time-to]').val()+":00"));
				return true;
			} else {
				if (parseInt($('input[name=time-to]').val())<24){
					$('input[name=time-to]').val($('input[name=time-to]').val()+":00");
					$("#duration").val(calTime($('input[name=time-from]').val()+":00", $('input[name=time-to]').val()+":00"));
				} else {
					$('input[name=time-to]').val("");
					alert("Not format time!");
				}
			}
		});
		$('input[name=time-to]').attr('readonly', "readonly");
		$('input[name=time-from]').attr('readonly', "readonly");
		$('#PaxN').keypress(function(evt){
			var theEvent = evt || window.event;
		    var key = theEvent.keyCode || theEvent.which;
		    key = String.fromCharCode( key );
		    //alert(key);
		    var regex = /[0-9\b\t:]/;
		     if( !regex.test(key)) 
		    {
		        theEvent.returnValue = false;
		    	if(theEvent.preventDefault) theEvent.preventDefault();
		  	}
		});
	});
	/*
	Create new optional tour by ajax
	Parameter: none
	Return: none
	*/
	function create_new_optional_tour(){
		if ($("#tour-name").val()!="") {
			if ($("#tour-code").val()!="") {
				var dt = {
					data : create_array_data()
				};
				$.ajax({
					url: "<?php echo base_url('OptionalController/create_new_optional_tour'); ?>",
				    async: false,
				    type: "POST",  
				    data: dt, 
				    dataType: "json",                         
				    success: function(data) {
				    	alert(data["msg"]);
                                        location.href = "<?php echo base_url();?>optional-tour/option-tour-list";
				    }
				});
			} else alert("Please input Tour Code!!!");
		} else alert("Please input Tour Name!!!");
	}

	/*
	Create array data to insert
	Parameter: none
	Return: Array data
	*/
	function create_array_data(){
		var list_result = {
			City			: 	$("#city").val(),
			Opt_Tour_Code	: 	$("#tour-code").val(),
			To				: 	$("#to-place").val(),
			TourName		: 	$("#tour-name").val(),
			FromTime		: 	$("input[name=time-from]").val(),
			ToTime			: 	$("input[name=time-to]").val(),
			Duration		: 	$("#duration").val(),
			Tel				: 	$("#tele").val(),
			Fax				: 	$("#Fax").val(),
			TourContent 	: 	$("#tour-content").val(),
			PaxNo 			: 	($("#PaxN").val()=="")?"0":$("#PaxN").val()
		}
		return list_result;
	}
	
</script>
<?php echo $this->load->view('Layout/footer');?>