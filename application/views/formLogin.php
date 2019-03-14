<?php
if (isset($this->session->userdata['logged_in'])) {
    redirect('index');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SIGN IN</title>
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/wrapper.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
			<div class="mes_login">SYSTEM INFO</div>
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" style="text-align: center">Log In</h3>
					</div>
					<div class="panel-body">
                      <?php echo form_open('index'); ?>
                      <?php
                    echo "<div class='error_msg'>";
                    if (isset($error_message)) {
                        echo $error_message;
                    }
                    echo validation_errors();
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
								<input class="form-control" placeholder="Username"
									name="username" type="txt" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password"
									name="password" type="password" value="">
							</div>
							<!-- Change this to a button or input when using this as a form -->
							<input type="submit" class="btn btn-lg btn-success btn-block"
								value="Login">
						</fieldset>
                      <?php echo form_close();?>
                    </div>
				</div>
				<div style="text-align: center">Version 2.0 Release on 21 Nov 2018 &copy;AnhMinh</div>
			</div>
		</div>
	</div>


</body>

</html>
