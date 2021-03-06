<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.selected-location {
	background-color: #E0E0E0;
}

.table {
	margin-top: 5px;
	margin-bottom: 5px;
}

.table tr td {
	border-bottom: 1px solid #DDD;
}
</style>
<div class="content">
	<div class="container">
		<h4>Change Password</h4>
		<div class="row line-strong"></div>
		<div class="col-md-4 col-md-offset-4">
			<?php echo form_open(base_url('user/change_password'));?>
			<div class="row row-border">
				<div class="title-row-div">
					<label class="title-row">Change Password</label>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label style="width: 150px">User ID</label> <input type="text"
							class="form-control input-sm select-size" required
							name="username"> <br /> <span
							style="color: red; margin-left: 155px; display: none;"
							id="err-id">Please enter user ID</span>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label style="width: 150px">Current Password</label> <input
							type="password" class="form-control input-sm select-size"
							required name="curpassword"> <br /> <span
							style="color: red; margin-left: 155px; display: none;"
							id="err-cur">Please enter current password</span>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label style="width: 150px">New Password</label> <input
							type="password" class="form-control input-sm select-size"
							required name="password"> <br /> <span
							style="color: red; margin-left: 155px; display: none;"
							id="err-pas">Please enter password</span>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label style="width: 150px">Confirm Password</label> <input
							type="password" class="form-control input-sm select-size"
							required name="cfpassword"> <br /> <span
							style="color: red; margin-left: 155px; display: none;"
							id="err-cof">Please enter confirm password</span>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label style="width: 150px">Full Name</label> <input type="text"
							class="form-control input-sm select-size" name="fullname">
					</div>
				</div>
			</div>
			<div class="row row-border">
				<div class="button-action-div form-group col-md-offset-4"
					style="margin-top: 15px;">
					<button class="btn btn-primary button-sm btn-sm" id="save">Ok</button>
					<a href="<?php echo base_url(); ?>"><span
						class="btn btn-warning button-sm btn-sm">Cancel</span></a>
				</div>

				<div class="col-md-12">
					<?php if(isset($success)){ ?>
					<font color="green"><?php echo $success; ?></font>
					<?php } elseif(isset($error)){ ?>
					<font color="red"><?php echo $error; ?></font>
					<?php } ?>
				</div>
			</div>
			<input value="" name="locations" hidden>
			<?php echo form_close();?>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog"
	data-callback="setDesHeight">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Select Locations</h4>
			</div>
			<div class="modal-body">
				<div class="row" style="margin-right: -10px;">
					<div class="col-md-5">
						<div class="row row-border" id="src">
							<div class="title-row-div">
								<label class="title-row">Locations</label>
							</div>
							<div
								style="height: 300px; overflow-y: scroll; overflow-x: hidden;">
								<div class="table-responsive">
									<table class="table no-footer" id="tb-location">
										<tbody>
											<?php

foreach ($locations as $key => $value) {
            echo '<tr><td id="loc' . $key . '" data-id="' . $key . '" data-value="' . $value['Location_code'] . '">' . $value['Location_name'] . '</td></tr>';
        }
        ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="row row-border">
							<button id="select-all" class="btn btn-default btn-select">>></button>
							<button id="unselect-all" class="btn btn-default btn-select"
								style="margin-bottom: 25px;"><<</button>
							<button id="select" class="btn btn-default btn-select">></button>
							<button id="unselect" class="btn btn-default btn-select"><</button>
						</div>
					</div>
					<div class="col-md-5">
						<div class="row row-border" id="des">
							<div class="title-row-div">
								<label class="title-row">Select Location</label>
							</div>
							<div
								style="height: 300px; overflow-y: scroll; overflow-x: hidden;">
								<div class="table-responsive">
									<table class="table no-footer" id="tb-selected-location">
										<tbody><?php

foreach ($locations as $key => $value) {
            echo '<tr><td id="sec' . $key . '" data-id="' . $key . '" data-value="' . $value['Location_code'] . '">' . $value['Location_name'] . '</td></tr>';
        }
        ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary button-sm btn-sm" id="save-location">Save</button>
				<button class="btn btn-warning button-sm btn-sm" id="close-modal">Close</button>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$("#tb-selected-location").ready(function(){
		$("#tb-selected-location tbody tr td").css("display", "none");
	});

	$("#choose-location").click(function(){
		if($("input[name=username]").val())
		{
			var user = $("input[name=username]").val();
			$.ajax({
				url: "<?php echo base_url('user/get_location'); ?>",
				method: "POST",
				data: "user=" + user,
				success: function(data)
				{
					var objJson = $.parseJSON(data);
					var current = "";
					$("#tb-selected-location tr td").removeClass("selected");
					$("#tb-selected-location tr td").css("display", "none");
					$("#tb-location tr td").css("display", "");
					for(var i = 0; i < objJson.length; i++)
					{
						var temp = $("#tb-selected-location tr td[data-value=" + objJson[i].Location_code + "]");
						temp.css("display", "block");
						temp.addClass("selected");

						$("#tb-location tr td[data-value=" + objJson[i].Location_code + "]").css("display", "none");
						current += objJson[i].Location_code + ",";
					}
					current = current.substring(0, current.length - 1);
					$("input[name=locations]").val( current );
				},
				complete: function(){
					$("#myModal").modal('show');
				}
			});

		}
		return false;
	});

	$("#tb-location tr td").click(function(){
		$("#tb-location tr td").removeClass('selected-location');
		$(this).addClass('selected-location');
	});

	$("#tb-selected-location tr td").click(function(){
		$("#tb-selected-location tr td").removeClass('selected-location');
		$(this).addClass('selected-location');
	});

	$("#select-all").click(function(){
		$("#tb-location tr td").removeClass('selected-location');
		$("#tb-selected-location tr td").removeClass('selected-location');

		$("#tb-location tr td").css("display", "none");
		$("#tb-selected-location tr td").css("display", "block");

		$("#tb-selected-location tr td").addClass('selected');
	});

	$("#unselect-all").click(function(){

		$("#tb-location tr td").removeClass('selected-location');
		$("#tb-selected-location tr td").removeClass('selected-location');

		$("#tb-location tr td").css("display", "block");
		$("#tb-selected-location tr td").css("display", "none");

		$("#tb-selected-location tr td").removeClass('selected');
	});

	$("#select").click(function(){
		var id = $("#tb-location tr td.selected-location").data("id");
		$("#sec" + id).css("display", "block");
		$("#loc" + id).css("display", "none");
		$("#loc" + id).removeClass("selected-location");

		$("#sec" + id).addClass("selected");
	});

	$("#unselect").click(function(){
		var id = $("#tb-selected-location tr td.selected-location").data("id");
		$("#sec" + id).css("display", "none");
		$("#loc" + id).css("display", "block");
		$("#sec" + id).removeClass("selected-location");
		$("#sec" + id).removeClass("selected");
	});

	$("#close-modal").click(function(){
		$("#myModal").modal('hide');
	});

	$("#save-location").click(function(){
		var current = "";
		$("#tb-selected-location tr td.selected").map(function(){
			if(current)
			{
				current += ",";
			}
			current += $(this).data("value");
		});
		$.ajax({
			url:"<?php echo base_url('user/save_location'); ?>",
			data: "user=" + $("input[name=username]").val() + "&location=" + current,
			method: "POST",
			success: function(data)
			{
				if(data.trim() == "OK")
				{
					$("#myModal").modal('hide');
				}
				else
				{

				}
			}
		});
	});

	$("#save").click(function()
	{
		var name = $("input[name=username]").val();
		var password = $("input[name=password]").val();
		var confirm =  $("input[name=cfpassword]").val();
		var isOK = true;
		if(!$("input[name=username]").val())
		{
			isOK = false;
			$("#err-id").css("display", "block");
		}
		if(!$("input[name=curpassword]").val())
		{
			isOK = false;
			$("#err-cur").css("display", "block");
		}
		if(!$("input[name=password]").val())
		{
			isOK = false;
			$("#err-pas").css("display", "block");
		}

		if(!$("input[name=cfpassword]").val())
		{
			isOK = false;
			$("#err-cof").css("display", "block");
		}

		if(isOK)
		{
			$("form").submit();
		}
		else
		{
			return false;
		}
	});
	$("input[name=username]").keypress(function(){
		$("#err-id").css("display", "none");
	});
	$("input[name=curpassword]").keypress(function(){
		$("#err-cur").css("display", "none");
	});
	$("input[name=password]").keypress(function(){
		$("#err-pas").css("display", "none");
	});
	$("input[name=cfpassword]").keypress(function(){
		$("#err-cof").css("display", "none");
	});
</script>
<?php echo $this->load->view('Layout/footer');?>