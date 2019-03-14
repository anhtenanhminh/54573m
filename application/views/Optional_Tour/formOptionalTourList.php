<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
#table-condensed {
	white-space: nowrap;
	table-layout: fixed;
}

#table-condensed td {
	overflow: hidden;
	text-overflow: ellipsis;
}

.dataTables_scrollHeadInner td {
	overflow: hidden;
	text-overflow: ellipsis;
}

.dataTables_scrollHeadInner table {
	white-space: nowrap;
	table-layout: fixed;
}
</style>
<div class="content">

	<div class="container">
		<h1>
			OPTIONAL TOUR MANAGEMENT
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;" onclick="location.href='<?php echo $back; ?>'">Close</button>
		</h1>
		<div class="row line-strong"></div>
		<div class="row">

			<div class="col-md-7">
				<div class="row row-border-1 table-border">
					<div class="title-row-div">
						<label class="title-row">Optional Tour List</label>
					</div>
					<div id="table-optional-tour" class="list-scroll">
						<table id="table-condensed"
							class="table table-condensed cell-border" style="width: 100%">
							<thead>
								<tr class="testRow">
									<!-- <td style=""></td> -->
									<td style="" title='Tour Name'>Tour Name</td>
									<td style="" title='From Time'>From Time</td>
									<td style="" title='To Time'>To Time</td>
									<td style="" title='Duration'>Duration</td>
									<td style="" title='City Name'>City Name</td>
									<td style="" title='Pax No'>Pax No</td>
								</tr>
							</thead>
							<tbody>
							<?php
    if ($list_tour) {
        foreach ($list_tour as $row) {
            ?>
									<tr id="row-<?php echo $row['OptionalTourListID']?>"
									onclick="get_content(<?php echo $row['OptionalTourListID']?>)">
									<!-- <td style="padding-left: 0px;"><div class="glyphicon glyphicon-play icon-edit"></div></td> -->
									<td style="" title="<?php echo  $row['Tourname'] ?>"><?php echo  $row['Tourname'] ?></td>
									<td style="" title="<?php echo  $row['FromTime'] ?>"><?php echo  $row['FromTime'] ?></td>
									<td style="" title="<?php echo  $row['ToTime'] ?>"><?php echo  $row['ToTime'] ?></td>
									<td style="" title="<?php echo  $row['Duration'] ?>"><?php echo  $row['Duration'] ?></td>
									<td style="" title="<?php echo  $row['City'] ?>"><?php echo  $row['City'] ?></td>
									<td style=""
										title="<?php echo  str_replace(".00", "", $row['PaxNo']); ?>"><?php echo  str_replace(".00", "", $row['PaxNo']); ?></td>

								</tr>
								<?php
        }
    }
    ?>
							</tbody>
						</table>
					</div>
					<div class="row btn-center">
						<button class="btn btn-primary btn-sm button-md"
							onClick="location.href='new-optional-tour'">New Tour</button>
						<button class="btn btn-primary btn-sm button-md"
							onClick="update_optional_tour()">Update Tour</button>
						<button class="btn btn-primary btn-sm button-md"
							onclick="delete_optional_tour()">Delete Tour</button>
					</div>
				</div>

			</div>
			<div class="col-md-5">
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Optional Tour Content</label>
					</div>
					<textarea id="optional-tour-content" class="form-control" rows="20"
						readonly=""></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var optional_tour_selected = "";
$(document).ready(function(){
	$('#table-condensed').DataTable({
		responsive: true,
        scrollY: 355,
        paging: false,
        scrollX: false,
        searching:false,
        info: false,
        "columnDefs": [
					    { "width": "20%", "targets": 0 }
					  ]
	});
	$('.dataTables_scrollHead').height(30);
	$(".table-condensed").find("tr").css("cursor","default");
});
function get_content(optionaltourid){
	// window.alert(optionaltourid);
	optional_tour_selected = optionaltourid;
	$("#table-optional-tour table tbody tr td:nth-child(1)").find("div").css("display","none");
	$("#row-"+optionaltourid+" td:nth-child(1)").find("div").css("display","block");
	$(".table-condensed").find("tr").css("background","transparent");
	$("#row-"+optionaltourid).css("background","#397FDB");
	$.ajax({   
	    url: "<?php echo base_url('OptionalController/get_content_optionaltour'); ?>",
	    type: "POST",  
	    data: "optionaltourid="+optionaltourid, 
	    dataType: "json",
	    beforeSend: function(){
	    	$("body").css("cursor", "wait");
	    },    
	    complete: function() {
	    	$("body").css("cursor","default");
	    },  				                         
	  	success: function(data){
	    	$.each (data, function(key, opj) {
	        	$("#optional-tour-content").val(opj["TourContent"]);
	        });
	    }
	});
}
	// $(document).ready(function(){
function update_optional_tour(){
	if (optional_tour_selected==""){
		alert("No tour selected!!!");
	} else {
		location.href='update-optional-tour/?id='+optional_tour_selected;
	}
	// });
}

function delete_optional_tour(){
	if (optional_tour_selected==""){
		alert("No tour selected!!!");
	} else {
		var r = confirm("Are you sure to delete!");
		if (r){
			$.ajax({   
			    url: "<?php echo base_url('OptionalController/delete_optional_tour'); ?>",
			    type: "POST",  
			    data: "optionaltourid="+optional_tour_selected, 
			    dataType: "json",
			    beforeSend: function(){
			    	$("body").css("cursor", "wait");
			    },    
			    complete: function() {
			    	$("body").css("cursor","default");
			    },  				                         
			  	success: function(data){
			    	$.each (data, function(key, opj) {
			    		if (key=="sta"){
			    			if (opj) {
			    				alert("Data delete success!!");
			    				$("#row-"+optional_tour_selected).remove();
			    				optional_tour_selected="";
			    			} else {
			    				alert("Data delete fail!!");
			    			}
			    		}
			        });
			    }
			});
		}
		
	}
	// });
}
</script>

<?php echo $this->load->view('Layout/footer');?>