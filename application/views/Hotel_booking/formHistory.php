<?php $this->load->view('Layout/header')?>
<style type="text/css">
</style>
<div class="content">
	<div class="container">
		<h1>
			History
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;" onclick="back_home()">Back</button>
		</h1>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-6">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Search Conditions </label>
					</div>
					<div class="col-md-6">
						<div class="form-group form-inline">
							<label for="tourcode" class=" label-item ">Tour Code</label> <input
								type="text" class="form-control input-sm select-size"
								id="tour-code" value="<?php echo $tourCode; ?>"> <input
								type="hidden" value="<?php echo $type_sr;?>" id="type_search">
						</div>
						<div class="form-group form-inline">
							<label for="tourcode" class=" label-item ">VN Code</label> <input
								type="text" class="form-control input-sm select-size"
								id="vn-code" value="<?php echo $VnCode; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="button-action-div form-inline">
							<button class="btn button-sm btn-primary" onclick="clear_form()">Clear</button>
							<button class="btn-search btn button-sm btn-primary"
								onclick="search_history()">Search</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border col-md-12">
			<div class="title-row-div">
				<label class="title-row">History List</label>
			</div>
			<div class="list-scroll" id="div-table" style="height: 350px">
				<table id="table-hotel-list" class="display nowdrap cell-border"
					style="width: 100%;">
					<thead>
						<td>Date Time</td>
						<td>Field Name</td>
						<td>Old Value</td>
						<td>New Value</td>
						<td>Computer</td>
						<td>User</td>
					</thead>
					<tbody>
						<?php
    if ($history) {
        foreach ($history as $key => $row) {
            ?>
							<tr>
							<td><?php echo $row["DateTime"]; ?></td>
							<td><?php echo $row["FieldName"]; ?></td>
							<td><?php echo $row["OldValue"]; ?></td>
							<td><?php echo $row["NewValue"]; ?></td>
							<td><?php echo $row["Computer"];  ?></td>
							<td><?php echo $row["User"]; ?></td>
						</tr>
							<?php

}
    }
    ?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() 
	{      
		$('#table-hotel-list').DataTable({
			// responsive: true,
			paging:false,
			scrollY: 300,
			scrollX: false,
			order:[], 
			info: false,
			searching: false
		});				
	}); 
	 
	
	function search_history(){
		var dt = {
			tour_code	: 	$("#tour-code").val(),
			vn_code		: 	$("#vn-code").val(),
		};
		$.ajax({
			url: "<?php echo base_url('HotelBookingController/search_history'); ?>",
			async: false,
			type: "POST",  
			data: dt, 
			dataType: "json",
			beforeSend: function(){
				$("body").css('cursor', "wait");
			},
			complete: function(){
				$("body").css('cursor', "default");
			},
			success: function(data) {
				$("#div-table").html("<table style=\"width:100%;\" id=\"table-hotel-list\" class=\"display nowdrap cell-border\"></table>");
				var html = '';
				html += '<thead style="background-color:#2d6ca2;color: white;text-align:left;">';
				html += '<tr>';
				html += '<td>Date Time</td>';
				html += '<td>Field Name</td>';
				html += '<td>Old Value</td>';
				html += '<td>New Value</td>';
				html += '<td>Computer</td>';
				html += '<td>User</td>';
				html += '</tr>';
				html += '</thead>';
				if(data.msg=="true")
				{
					$.each (data.dt, function(key, row) {
						html += '<tr>';
						html += '<td title="'+((row["DateTime"]!=null)?row["DateTime"]:"")+'">'+((row["DateTime"]!=null)?row["DateTime"]:"")+'</td>';
						html += '<td title="'+((row["FieldName"]!=null)?row["FieldName"]:"")+'">'+((row["FieldName"]!=null)?row["FieldName"]:"")+'</td>';
						html += '<td title="'+((row["OldValue"]!=null)?row["OldValue"]:"")+'">'+((row["OldValue"]!=null)?row["OldValue"]:"")+'</td>';
						html += '<td title="'+((row["NewValue"]!=null)?row["NewValue"]:"")+'">'+((row["NewValue"]!=null)?row["NewValue"]:"")+'</td>';
						html += '<td title="'+((row["Computer"]!=null)?row["Computer"]:"")+'">'+((row["Computer"]!=null)?row["Computer"]:"")+'</td>';
						html += '<td title="'+((row["User"]!=null)?row["User"]:"")+'">'+((row["User"]!=null)?row["User"]:"")+'</td>';
						html += '</tr>';
					});
				}
				else
				{
					alert("Data not found.");
				}

				$("#table-hotel-list").html(html);
				$('#table-hotel-list').DataTable({
					responsive: true,
					paging:false,
					scrollY: 300,
					scrollX: false,
					order:[],
					info: false,
					searching: false
				});
			}
		});
}
function clear_form(){
	$("#tour-code").val("");
	$("#vn-code").val("");
	$("#table-hotel-list tbody").html("");
}
function back_home()
{
    location.href ="<?php echo base_url('/hotel-booking');?>?sr_bk="+$("#type_search").val();
}
</script>