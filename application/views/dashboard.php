<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to SystemInfo</title>

<style type="text/css">
::selection {
	background-color: #E13300;
	color: white;
}
/* #div-staff-list anh huong chieu cao staff list, ket hop voi scrolly*/
#div-birthday-list {
	height: 275px !important;
}

::-moz-selection {
	background-color: #E13300;
	color: white;
}

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#body {
	margin: 0 15px 0 15px;
}

p.footer {
	text-align: right;
	font-size: 11px;
	border-top: 1px solid #D0D0D0;
	line-height: 32px;
	padding: 0 10px 0 10px;
	margin: 20px 0 0 0;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}
</style>
</head>
<body>
	<div><?php echo $this->load->view('Layout/header')?></div>
	<div id="container">
		<h1>Welcome to System Information!</h1>

		<div id="body">
			<label>General Info:</label>
			<table style="border: 1px solid #b4b4b4;">
				<tr class="table-border">
					<th><p>Employee</p></th>
					<th style="width:120px"><p>Result</p></th>
					<th><p>Email</p></th>
					<th style="width:120px"><p>Result</p></th>
				</tr>
				<tr class="table-border">
					<td>Total Employee:</td>
					<td><label id="total-staff" class="red-label"></label></td>
					<td>Total Email:</td>
					<td><label id="total-email" class="red-label"></label></td>
				</tr>
				<tr>
					<td>Coming:</td>
					<td><label id="coming-staff" class="red-label"></label></td>
					<td>Requesting:</td>
					<td><label id="requesting-email-no" class="red-label"></label></td>
				</tr>
				<tr class="table-border">
					<td>Working:</td>
					<td><label id="working-staff" class="red-label"></label></td>
					<td>Using:</td>
					<td><label id="using-email-no" class="red-label"></label></td>
				</tr>
				<tr class="table-border">
					<td>Resigned:</td>
					<td><label id="resigned-staff" class="red-label"></label></td>
					<td>Deleted:</td>
					<td><label id="deleted-email-no" class="red-label"></label></td>
				</tr>
				
			</table>

			<div class="row">
			<div class="col-md-6">
				<div class="row row-border-1 table-border">
					<div class="title-row-div">
						<label class="title-row">This month birthday:</label>
					</div>
					<div class="list-scroll" id="div-birthday-list">
						<table id="table-birthday-list" class="nowrap cell-border">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row row-border-1 table-border">
					<div class="title-row-div">
						<label class="title-row">Email RQ</label>
					</div>
					<div class="list-scroll" id="div-birthday-list">
						<table id="table-emailrq-list" class="nowrap cell-border">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			</div>

			<br>
			<br>
			<button
								class="btn-search btn btn-primary btn-sm button-md btn-action"
								onclick="getreport()">Get Report</button>
						<button
								class="btn-search btn btn-primary btn-sm button-md btn-action"
								onclick="get_birthday()">Get birthday</button>
			<br>
			<br>
			<p>Code CSS:</p>
			<code>application/views/welcome_message.php</code>

			<p>
				URL Code: <a href="user_guide/">User Guide offline</a>.
			</p>
			<p>
				URL Code: <a href="https://codeigniter.com/user_guide/">User Guide
					online</a>.
			</p>
		
			
	</div>
	<script type="text/javascript">
	//Lay kq Total
	var staffTable = false;
	var dashboard = false;
	function getreport(){
		var dt = {
				data : 'Start'
		};
		$.ajax({
			async: false,
			url  : "<?php echo base_url('DashboardController/get_reportinfo'); ?>",
			type : "POST",
			data : dt,
			dataType: "json",
			success: function(data)
			{
				console.log(data);
				$("#total-staff").html(data.Coming+data.Working+data.Resigned);
				$("#coming-staff").html(data.Coming);
				$("#working-staff").html(data.Working);
				$("#resigned-staff").html(data.Resigned);
			}
		});	
	
	}
	function getemailreport(){
		var dt = {
				data : 'Start'
		};
		$.ajax({
			async: false,
			url  : "<?php echo base_url('DashboardController/get_emailreportinfo'); ?>",
			type : "POST",
			data : dt,
			dataType: "json",
			success: function(data)
			{
				console.log(data);
				$("#total-email").html(data.Using+data.Deleted);
				$("#requesting-email-no").html(data.Requesting);
				$("#using-email-no").html(data.Using);
				$("#deleted-email-no").html(data.Deleted);
			}
		});	
	
	}
	if(!dashboard){
		getreport();
		getemailreport();
		get_birthday();
	}	
	
	function get_birthday() {
		var dt = {
				data : 'Start'
		};
		if (staffTable) {
			staffTable.ajax.reload();
		} else {
			staffTable = $("#table-birthday-list").DataTable({
				responsive: true,
				//anh huong chieu cao staff list
				scrollY: 250,
				paging: false,
				searching: false,
				scrollX: true,
				info: false,
				order:[],
				ajax: {
					url: "<?php echo base_url('StaffInfoController/get_data_search_staffbirthday_list'); ?>",
					async: false,
					type: "POST",
					data: dt,  
					dataType: "json",
					dataSrc: "tableData"
				},
				columns: [
					{"data":"StaffID", "title":"ID"},
					{"data":"StaffName", "title":"Full Name"},
					/*{"data":"staffBranch", "title":"Branch"},*/
					{"data":"StaffOffice", "title":"Office"},
					{"data":"StaffDept", "title":"Dept."},
					{"data":"DOB", "title":"DOB"},
					{"data":"JoinedDate", "title":"Joined"},
				],
				"processing": true,
				"columnDefs": [ {
		            "searchable": false,
		            "orderable": false,
		            "targets": 0
		        } ]
			});
		}			
	}
	</script>

		<p class="footer">
			Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>