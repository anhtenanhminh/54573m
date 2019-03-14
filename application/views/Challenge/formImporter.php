<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CHALENGE SYSTEM DATA IMPORTER</title>
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/wrapper.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap-formhelpers.css">

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-formhelpers.js"></script>

<style>
.login-panel {
	margin-top: 25%;
}

.error_msg {
	color: red;
	font-weight: bold;
}

.success_msg {
	color: green;
	font-weight: bold;
}

.mes_login {
	text-align: center;
	margin-bottom: -40px;
	margin-top: 40px;
	font-size: 40px;
	font-weight: bold;
}
</style>

</head>

<body>

	<div class="container">

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" style="text-align: center">CHALLENGE
							SYSTEM PARAMETERS</h3>
					</div>
					<div class="panel-body">
						<?php echo form_open('challenge/get_importer'); ?>
						<?php
    echo "<div class='error_msg'>";
    if (isset($error_message)) {
        echo $error_message;
    }
    echo "</div>";
    ?>
						<?php
    echo "<div class='success_msg'>";
    if (isset($message_display)) {
        echo $message_display;
    }
    echo "</div>";
    ?>
						<fieldset>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>FromDate</label>
									</div>
									<div class="col-md-9">
										<div id="date-from"
											class="form-group bfh-datepicker select-size-lg"
											data-input="form-control input-sm"
											data-date="<?php echo date("Y/m/d");?>" data-name="date_from"
											data-align="right" data-format="y/m/d"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>ToDate</label>
									</div>
									<div class="col-md-9">
										<div id="date-to"
											class="form-group bfh-datepicker select-size-lg"
											data-input="form-control input-sm"
											data-date="<?php echo date("Y/m/d");?>" data-name="date_to"
											data-align="right" data-format="y/m/d"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>Max Tour Code </label>
									</div>
									<div class="col-md-9">
										<input id="max-tour-code" name="max_tour_code" value="">
									</div>
								</div>
							</div>
							<!-- Change this to a button or input when using this as a form -->
							<input type="submit" class="btn btn-lg btn-success btn-block"
								value="Import">
						</fieldset>
							<?php echo form_close();?>
						</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$("input[type=submit]").click(function() {
			var from = $("input[name=date_from]").val();
			var to = $("input[name=date_to]").val();

			var regex = /^\d{4}\/\d{2}\/\d{2}$/;
			
			if (!regex.test(from.trim())) {
				alert("Date must be format as YYYY/MM/DD");
				return false;
			}

			if (!regex.test(to.trim())) {
				alert("Date must be format as YYYY/MM/DD");
				return false;
			}

			from = new Date(from);
			to = new Date(to);

			var oneDate = 1000*60*60*24;
			var dif = Math.round((to.getTime() - from.getTime()) / oneDate);

			if (dif < 0) {
				alert("To date must be larger than From date");
				return false;
			}

			if (dif > 31) {
				alert("Period of Request Day must be in 31 days");
				return false;
			}

		});

			$("#max-tour-code").keydown(function (e) {
				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					// Allow: Ctrl+A, Command+A
					(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
					// Allow: home, end, left, right, down, up
					(e.keyCode >= 35 && e.keyCode <= 40)) {
					// let it happen, don't do anything
					return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			})
		</script>
</body>

</html>
