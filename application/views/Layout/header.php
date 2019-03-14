<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SYSTEM INFO</title>
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/bootstrap-formhelpers.css">

<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/keyTable.dataTables.min.css">

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-formhelpers.js"></script>
<script src="<?php echo base_url();?>assets/js/script.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script
	src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url();?>assets/js/jquery.datetimepicker.js"></script>
<script
	src="<?php echo base_url();?>assets/js/jquery.dataTables.1.10.12.min.js"></script>
<script
	src="<?php echo base_url();?>assets/js/dataTables.keyTable.min.js"></script>
<!--
	<script src="<?php echo base_url();?>assets/js/colResizable-1.5.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.dataTables.scrolling.js"></script>
	-->
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/jquery-ui.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/style.css">
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/css/jquery.datetimepicker.css">
<link rel="stylesheet"
	href="<?php echo base_url('assets/css/jquery.dataTables.min.css');?>">
<style>
body {
	padding-top: 25px;
}

h4 {
	color: blue;
	text-align: center;
}

.navbar-inverse .navbar-nav>li>a {
	color: #D4CBCB;
}

.navbar {
	background-color: #FFFFFF;
	max-height: 25px;
	height: 25px;
}

ul>li:hover {
	background-color: #dbdbdb;
	color: #1a1717;
}

ul li a {
	color: #0671CE;
}

.dropdown-menu {
	background-color: #9C9A9A;
}

.navbar-static-top {
	position: fixed;
	width: 100%;
	margin-top: -25px;
}

.navbar-brand {
	height: 25px !important;
}

.navbar-xs {
	min-height: 25px;
	height: 25px;
	padding-bottom: 0px;
	background-color: #FFFFFF;
	border-bottom: 1px solid #AFB5AF;
}

.navbar-xs .navbar-brand {
	padding: 0px 12px;
	font-size: 16px;
	line-height: 25px;
	border-bottom: 1px solid #AFB5AF;
}

.navbar-xs .navbar-nav>li>a {
	padding-top: 0px;
	padding-bottom: 0px;
	line-height: 24px;
	border-bottom: 1px solid #AFB5AF;
}
</style>
</head>
<body>
	<script>
 	$(document).ready(function(){
            
	    jQuery('ul.nav li.dropdown').hover(function() {
 		 jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
		}, function() {
  			jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
		});

	    var height = $("#header nav:nth-child(1)").height() + $("#header nav:nth-child(2)").height() + 4;
		$("#disable-header").css("height", height + "px");
		$("#disable-header").css("width", $("#header nav:nth-child(1)").width() + "px");

	});

	function disableMenu() {
		$("#disable-header").css("display","");
	}

	function enableMenu() {
		$("#disable-header").css("display","none");
	}
 	</script>
	<div id="disable-header"
		style="position: fixed; z-index: 1900; top: 0px; display: none; background-color: black; opacity: 0.3;"></div>
	<div id="header">
		<nav class="navbar navbar-fixed-top navbar-xs">
			<div class="container ulnav">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target="#menu">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
						<?php echo anchor('dashboard', 'Dashboard', 'class="navbar-brand"');?>
					</div>
				<div class="navbar-collapse collapse" id="menu">
					<ul class="nav navbar-nav">
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" data-hover="dropdown" data-delay="1000"
							data-close-others="true">Staff Info<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('staffinfo/staff-list', 'Employee List') ?></li>
								<li><?php echo anchor('staffinfo/newstaff', 'New Employee') ?></li>
								<li><?php echo anchor('accinfo/account-list', 'ID List') ?></li>
								<li><?php echo anchor('accinfo/newaccount', 'New ID') ?></li>
							</ul></li>
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" data-hover="dropdown" data-delay="1000"
							data-close-others="false">Google Sheets<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="https://docs.google.com/spreadsheets/d/1jK9nz_5umDy1cjrNn1kXUVtFcTtnrf-eQOV3AwIEN9k/edit#gid=1249885436" target="_blank"> Resigned / New Staff</a></li>
								<li><a href="https://docs.google.com/spreadsheets/d/1rLzOGWFSLs7jn7ROOlpKxkncWwyIbQD1ABuiOOZng74/edit#gid=284829817" target="_blank"> Sysinfo - CPUI</a></li>
								<li><a href="https://docs.google.com/spreadsheets/d/1cNz6OMVesfIXIXn3tj_O3xBCqyo2XVQNtL6hxw1ZfUk/edit#gid=2146829006" target="_blank">Forbidden Netinfo</a></li>
							</ul></li>
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" data-hover="dropdown" data-delay="1000"
							data-close-others="false">Google Forms<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('googleform/hopslite', 'Hopslite Request') ?></li>
								<li><?php echo anchor('googleform/idrequest', 'ID Application Request') ?></li>
								<li><?php echo anchor('googleform/iddelete', 'Delete Request') ?></li>
								<li><?php echo anchor('googleform/grouprequest', 'Group Request') ?></li>
								<li><?php echo anchor('googleform/passwordreset', 'Reset Password') ?></li>
							</ul></li>
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" data-hover="dropdown" data-delay="1000"
							data-close-others="false">System<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('sysinfo', 'System Info') ?></li>
								<li><?php echo anchor('user/adduser', 'Add New User') ?></li>
								<li><?php echo anchor('user/change_password', 'Change Password') ?></li>
								<li><?php echo anchor('AuthenController/logout', 'Log Out') ?></li>
							</ul></li>
						<li><?php if (isset($this->session->userdata['logged_in'])) {$username = ($this->session->userdata['logged_in']['username']); echo "User: " & $username; }?></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>