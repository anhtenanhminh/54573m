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
	href="<?php echo base_url();?>assets/css/bootstrap-formhelpers.css">
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-formhelpers.js"></script>
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/wrapper.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/script.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>

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
			<div class="col-md-10">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" style="text-align: center">CHALLENGE
							SYSTEM PARAMETERS</h3>
					</div>
					<div class="panel-body">
						<form method="POST"
							action="<?php echo base_url('dataextraction/Extraction/btnExportToExcel_Click');?>">
							<fieldset>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label>User Name :</label>
										</div>
										<div class="col-md-3">
											<input class="form-control" placeholder="Username"
												name="username" type="text"
												value="<?php if(isset($user_name)){echo $user_name;}else{echo "";}?>"
												id="user_name" />
										</div>

										<div class="col-md-2">
											<label>From Date :</label>
										</div>
										<div class="col-md-3">
											<div id="date-from"
												class="form-group bfh-datepicker select-size-lg"
												data-input="form-control input-sm check-num"
												data-date="<?php echo date("Y/m/d");?>"
												data-name="date_from" data-align="right" data-format="y/m/d"
												onchange="check_date()"></div>
										</div>
										<div class="col-md-2">
											<input type="submit" class="btn btn-primary col-md-12"
												value="Export To Excel" name="submit" id="print_to_excel"
												onclick="myWait()" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label>Password :</label>
										</div>
										<div class="col-md-3">
											<input class="form-control" placeholder="Password"
												name="password" type="password"
												value="<?php if(isset($pass_word)){echo $pass_word;}else{echo "";}?>"
												id="pass_word" />
										</div>

										<div class="col-md-2">
											<label>To Date :</label>
										</div>
										<div class="col-md-3">
											<div id="date-to"
												class="form-group bfh-datepicker select-size-lg"
												data-input="form-control input-sm check-num"
												data-date="<?php echo date("Y/m/d");?>" data-name="date_to"
												data-align="right" data-format="y/m/d"
												onchange="check_date()"></div>
										</div>
									</div>
								</div>

								<!-- Change this to a button or input when using this as a form -->

							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(".check_num").keypress(function(event)
		{		
			var _event = event || window.event;
			var _key  = _event.keyCode || _event.which;
			alert(_key);
			if(_key==13)
			{
				check_date();
			}		
		});
		function check_date()
		{			
			var dt = {
				date_from : $("#date-from > div > input").val(),
				date_to   : $("#date-to > div > input").val()
			};
				
				$.ajax({                
						url: "<?php echo base_url('dataextraction/Extraction/check_date'); ?>",
						type: "POST",  
						data: dt, 
						dataType: "json",
						success: function(data) 
						{
							if(data.msg!="")
							{
								alert(data.msg);
								$("#print_to_excel").attr("disabled",true);	
							}
							else
							{
								$("#print_to_excel").attr("disabled",false);	
							}
						}
				});
			
						
		}		

		function myWait()
		{
			alert("Please wait.....");
			return true;
		}
		
		</script>



</body>

</html>
