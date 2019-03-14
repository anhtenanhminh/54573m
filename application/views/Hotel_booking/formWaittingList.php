<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.dataTables_filter {
	display: none;
}

#table-waitting-list_info {
	display: none;
}

#table-waitting-list {
	white-space: nowrap;
	table-layout: fixed;
}

#table-waitting-list td {
	overflow: hidden;
	text-overflow: ellipsis;
}

.dataTables_scrollHeadInner table {
	white-space: nowrap;
	table-layout: fixed;
}

.dataTables_scrollHeadInner td {
	overflow: hidden;
	text-overflow: ellipsis;
}

#table-waitting-list thead tr th {
	padding: 0px !important;
}
</style>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h4>Waitting List</h4>
			</div>
			<div class="col-md-4">
				<div class="form-inline" style="margin-top: 10px">
					<form
						action="<?php echo base_url('HotelBookingController/export_ExcelWaitingListForm');?>"
						method="POST">
					<?php

if (isset($waitting_list)) {
        $watting_tourcode = "";
        $watting_tltcode = "";
        foreach ($waitting_list as $key => $row) {
            $watting_tourcode .= $row["TourCode"] . ",";
            $watting_tltcode .= $row["TLTCode"] . ",";
        }
    }
    ?>
					<input type="hidden" name="array_tourcode" id="array_tourcode"
							value="<?php echo $watting_tourcode;?>"> <input type="hidden"
							name="array_tltcode" id="array_tltcode"
							value="<?php echo $watting_tltcode;?>"> <input
							id="print-waiting-list"
							class="btn btn-sm button-md btn-primary btn-action" value="Print"
							type="submit" name="print_waitting_home" /> <input
							id="pirnt_close"
							class="btn btn-sm button-md btn-primary btn-action" value="Close"
							type="submit" name="close_form" />
					</form>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Conditions </label>
			</div>
			<div class="col-md-3">
				<div class="form-group form-inline">
					<label for="tourcode" class=" label-item ">Tour Code</label> <input
						type="text" class="form-control input-sm select-size"
						id="tour-code">
				</div>
				<div class="form-group form-inline">
					<label for="tourcode" class=" label-item ">VN Code</label> <input
						type="text" class="form-control input-sm select-size" id="vn-code">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group form-inline">
					<label for="tourcode" class=" label-item ">BLK Code</label> <input
						type="text" class="form-control input-sm select-size-sm"
						id="blk-code">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group form-inline">
					<label for="sel1">City</label> <select
						class="form-control input-sm select-size-sm" id="city">
						<option value=""></option>
    					<?php
        if ($city) {
            foreach ($city as $city) {
                if ($city['city'] != '' && $city['city'] != NULL) {
                    ?>
						    <option value="<?php echo $city['city']?>"><?php echo $city['city']?></option>
						<?php }}}?>	
    				</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group form-inline">
					<label for="sel1">Hotel</label> <select
						class="form-control input-sm select-size" id="hotel">
						<option value=""></option>

					</select>
				</div>
				<div class="form-inline" style="margin-top: 20px">
					<button class="btn btn-sm button-md btn-primary btn-action"
						onclick="clear_form()">Clear</button>
					<button
						class="btn-search btn btn-sm button-md btn-primary btn-action"
						onclick="get_data_search()">Search</button>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Waitting List</label>
					</div>
					<div id="div-table-watting-list" class="list-scroll"
						style="height: 350px;">
						<table id="table-waitting-list" class="cell-border">
							<thead>
								<td style="width: 120px" title='Tour Code'>Tour Code</td>
								<td style="width: 90px" title='VN Code'>VN Code</td>
								<td style="width: 150px" title='BKL Code'>BKL Code</td>
								<td style="width: 80px" title='City'>City</td>
								<td style="width: 150px" title='Hotel' title=''>Hotel</td>
								<td style="width: 120px" title='Entry Date Time'>Entry Date Time</td>
								<td style="width: 80px" title='Arrv Date'>Arrv Date</td>
								<td style="width: 80px" title='Dept Date'>Dept Date</td>
								<td style="width: 150px" title='Group Name'>Group Name</td>
								<td style="width: 50px" title='Pax.No'>Pax.No</td>
								<td style="width: 75px" title='Room Type'>Room Type</td>
								<td style="width: 131px" title='Note'>Note</td>
							</thead>
							<tbody style="">
								<?php
        if ($waitting_list) {
            foreach ($waitting_list as $key => $row) {
                ?>
										   	<tr id=''>
									<td title="<?php echo $row["TourCode"]; ?>"
										style="width: 120px"><?php echo $row["TourCode"]; ?></td>
									<td title="<?php echo $row["VnCode"]; ?>" style="width: 90px"><?php echo $row["VnCode"]; ?></td>
									<td title="<?php echo $row["TLTCode"]; ?>"
										style="width: 150px;"><?php echo $row["TLTCode"]; ?></td>
									<td title="<?php echo $row["City"]; ?>" style="width: 80px"><?php echo $row["City"]; ?></td>
									<td title="<?php echo $row["Hotel"]; ?>" style="width: 150px"><?php echo $row["Hotel"];  ?></td>
									<td title="<?php echo $row["EntryDate"]; ?>"
										style="width: 120px"><?php echo $row["EntryDate"]; ?></td>
									<td title="<?php echo $row["ArrvDate1"]; ?>"
										style="width: 80px"><?php echo $row["ArrvDate1"]; ?></td>
									<td title="<?php echo $row["DeptDate1"]; ?>"
										style="width: 80px"><?php echo $row["DeptDate1"]; ?></td>
									<td title="<?php echo $row["GroupName"]; ?>"
										style="width: 150px"><?php echo $row["GroupName"]; ?></td>
									<td title="<?php echo $row["PaxNo1"]; ?>" style="width: 50px"><?php echo $row["PaxNo1"]; ?></td>
									<td title="<?php echo $row["RoomType1"]; ?>"
										style="width: 75px"><?php echo $row["RoomType1"]; ?></td>
									<td title="<?php echo $row["Note"]; ?>" style="width: 131px"><?php echo $row["Note"]; ?></td>
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

	</div>

</div>
<script
	src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
 
  	$(document).ready(function(){
  		  		$('#table-waitting-list').DataTable({
  				responsive: true,
                paging: false,
                scrollY: 270,
                scrollX: true,
                "order": []
  		});
  			$('.dataTables_scrollHead').height(35);
  		/*get hotel when select city*/
	  	$('#city').change(function () {
	    	var city=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('TransferController/get_hotel'); ?>",
	            async: false,
	            type: "POST",  
	            data: "city="+ city, 
	            dataType: "html",				                         
	            success: function(data) {
	                $('#hotel').html(data);
	            }
	        });
	 	});	 	
 	});

/*get data after click search*/
function get_data_search(){
	$("body").css("cursor","wait");
	var dt = {
		tour_code		: 	$("#tour-code").val(),
		vn_code			: 	$("#vn-code").val(),
		blk_code		: 	$("#blk-code").val(),
		city 			: 	$("#city").val(),
		hotel 			: 	$("#hotel").val(),
	};
	var array_tourcode = "";
	var array_tltcode = "";
	$.ajax({
		url: "<?php echo base_url('HotelBookingController/get_data_search_waitting_list'); ?>",
	    type: "POST",  
	    data: dt, 
	    dataType: "json",  
	    beforeSend: function(){
		    $("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},                        
	    success: function(data) {
	    	$('#div-table-watting-list').html('<table id="table-waitting-list" class="cell-border"></table>');
	    	var output = "";
	    	output += '<thead>';
	    	output += '<tr>';
			output += '<td style="width:120px" title="Tour Code">Tour Code</td>';
			output += '<td style="width:90px"title="VN Code">VN Code</td>';
			output += '<td style="width:150px"title="BKL Code">BKL Code</td>';
			output += '<td style="width:80px"title="City">City</td>';
			output += '<td style="width:150px"title="Hotel">Hotel</td>';
			output += '<td style="width:120px"title="Entry Date Time">Entry Date Time</td>';
			output += '<td style="width:80px"title="Arrv Date">Arrv Date</td>';
			output += '<td style="width:80px"title="Dept Date">Dept Date</td>';
			output += '<td style="width:150px"title="Group Name">Group Name</td>';
			output += '<td style="width:50px"title="Pax.No">Pax.No</td>';
			output += '<td style="width:75px"title="Room Type">Room Type</td>';
			output += '<td style="width:131px"title="Note">Note</td>';
			output += '</tr>';
			output += '</thead>';		
			output += '<tbody>';	
	    	$.each (data, function(key, opj) {
	    		if (key=="msg"){
	    			if (opj=="false"){
	    				$('#print-waiting-list').attr('disabled',true);
		    			window.alert("Data not found!!!");
		    			return false;
		    		}
	    		} else {
	    			$('#print-waiting-list').prop('disabled',false);
	    			
	    			$.each (opj, function(key, row) 
	    			{	
	    				array_tourcode += row["TourCode"]+",";
	    				array_tltcode  += row["TLTCode"]+",";		    	
		    			output += "<tr>";
				            output += "<td title='"+((row["TourCode"]!=null)?row["TourCode"]:"")+"' style='width:120px'>"+((row["TourCode"]!=null)?row["TourCode"]:"")+"</td>";
				            output += "<td title='"+((row["VnCode"]!=null)?row["VnCode"]:"")+"' style='width:90px'>"+((row["VnCode"]!=null)?row["VnCode"]:"")+"</td>";
				            output += "<td title='"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"' style='width:150px'>"+((row["TLTCode"]!=null)?row["TLTCode"]:"")+"</td>";
				            output += "<td title='"+((row["City"]!=null)?row["City"]:"")+"' style='width:80px'>"+((row["City"]!=null)?row["City"]:"")+"</td>";
				            output += "<td title='"+((row["Hotel"]!=null)?row["Hotel"]:"")+"' style='width:150px'>"+((row["Hotel"]!=null)?row["Hotel"]:"")+"</td>";
				            output += "<td title='"+((row["EntryDate"]!=null)?row["EntryDate"]:"")+"' style='width:120px'>"+((row["EntryDate"]!=null)?row["EntryDate"]:"")+"</td>";
				            output += "<td title='"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"' style='width:80px'>"+((row["ArrvDate1"]!=null)?row["ArrvDate1"]:"")+"</td>";
				            output += "<td title='"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"' style='width:80px'>"+((row["DeptDate1"]!=null)?row["DeptDate1"]:"")+"</td>";
				            output += "<td title='"+((row["GroupName"]!=null)?row["GroupName"]:"")+"' style='width:150px'>"+((row["GroupName"]!=null)?row["GroupName"]:"")+"</td>";
				            output += "<td title='"+((row["PaxNo1"]!=null)?row["PaxNo1"]:"")+"' style='width:50px'>"+((row["PaxNo1"]!=null)?row["PaxNo1"]:"")+"</td>";
				            output += "<td title='"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"' style='width:75px'>"+((row["RoomType1"]!=null)?row["RoomType1"]:"")+"</td>";
				            output += "<td title='"+((row["Note"]!=null)?row["Note"]:"")+"' style='width:131px'>"+((row["Note"]!=null)?row["Note"]:"")+"</td>";
			            output += "</tr>";
			            
		        	});
	    		}
            });
            output	+= "</tbody>";
			$("#table-waitting-list").html(output);
			$("body").css("cursor","");
       		$(".table-fixed").find("tr").css("cursor","default");
       		$('#table-waitting-list').DataTable({
			  				responsive: true,
			                paging: false,
			                scrollY: 270,
			                scrollX: true,
			                "order": []
			  				});
       		$('.dataTables_scrollHead').height(35);
       		$("#array_tourcode").val(array_tourcode);
			$("#array_tltcode").val(array_tltcode);
	    }
	});

}




function clear_form()
{
	$("#tour-code").val('');
	$("#vn-code").val('');
	$("#blk-code").val('');
	$("#city").val('');
	var city="";
	        $.ajax({   
	            url: "<?php echo base_url('HotelBookingController/waiting_hotel_clear'); ?>",
	            async: true,
	            type: "POST",  
	            data: "city="+ city, 
	            dataType: "json",				                         
	            success: function(data) {
	                $.each (data, function(key, opj) {
	                	if(key == "msg")
	                	{
	                		$('#hotel').html(opj);
	                	}
	                });
	            }
	        });
}
</script>