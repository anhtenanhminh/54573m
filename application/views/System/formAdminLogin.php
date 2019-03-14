<?php echo $this->load->view('Layout/header'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default" style="margin-top: 25%;">
				<div class="panel-heading">
					<h3 class="panel-title">ADMINISTRATOR LOGIN</h3>
				</div>
				<div class="panel-body">

					<fieldset>
						<form method="POST" action="">
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<span>User ID</span>
									</div>
									<div class="col-md-9">
										<input class="form-control" placeholder="Username"
											name="username" type="txt" autofocus>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<span>Password</span>
									</div>
									<div class="col-md-9">
										<input class="form-control" placeholder="Password"
											name="password" type="password" value="">
									</div>
								</div>
							</div>
						</form>
						<!-- Change this to a button or input when using this as a form -->
						<div class="row">
							<div class="button-action-div form-group col-md-offset-4"
								style="margin-top: 15px;">
								<button class="btn btn-primary button-sm btn-sm" id="submit">OK</button>
								<a href="<?php echo base_url(); ?>"><button
										class="btn btn-primary button-sm btn-sm">Cancel</button></a>
							</div>
							<div class="col-md-12">
								<?php if(isset($success)){ ?>
								<font color="green"><?php echo $success; ?></font>
								<?php } elseif(isset($error)){ ?>
								<font color="red"><?php echo $error; ?></font>
								<?php } ?>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#submit").click(function(){
		$("form").submit();
	});
</script>
<?php echo $this->load->view('Layout/footer');?>