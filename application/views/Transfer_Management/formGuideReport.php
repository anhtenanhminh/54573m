<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.dataTables_scrollHead {
	height: 35px;
}

.tb-tr-selected {
	background: #397FDB none repeat scroll 0% 0%;
}

.dataTables_info {
	display: none;
}

#table-guide-search_filter {
	display: none;
}

#div-guide-search {
	overflow: hidden;
}

#table-guide-search {
	white-space: nowrap;
	table-layout: fixed;
}

#table-guide-search td {
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
</style>
<div class="content">

	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h1 style="margin: 10px 10px 0px;">GUIDE REPORT</h1>
			</div>
			<div class="col-md-2" style="text-align: right; margin-top: 13px;">
				<button class="btn btn-primary"
					onclick="location.href='././c-d-g-managerment'">Back</button>
			</div>
			<div style="clear: both"></div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields </label>
			</div>
			<div class="col-md-5">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Guide</label>
					</div>
					<div class="col-md-7">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">Guide Name</label> <select id="guide"
									class="form-control input-sm select-size">
									<option value=""></option>
			    					<?php
            if ($guide) {
                foreach ($guide as $row) {
                    ?>
											<option value="<?php echo $row['GuideID']?>"><?php echo $row['GuideName']?></option>
										<?php
                }
            }
            ?>
			    				</select>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item-sm">Rank</label> <input id="guide-type"
									type="text" class="form-control input-sm select-size-sm">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Date</label>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">From Date</label>
								<div id="from-date" class="form-group bfh-datepicker"
									data-placeholder="yyyy/mm/dd" data-format="y/m/d"
									data-align="right" data-name="from-date"
									data-input="form-control input-sm select-size-md" data-date=""></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-inline form-margin-bottom">
							<div class="form-group">
								<label class="label-item">To Date</label>
								<div id="to-date" class="form-group bfh-datepicker"
									data-placeholder="yyyy/mm/dd" data-format="y/m/d"
									data-align="right" data-name="to-date"
									data-input="form-control input-sm select-size-md" data-date=""></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="button-action-div">
					<button class="btn btn-primary button-sm btn-action" id="cleardata">Clear</button>
					<button class="btn-search btn btn-primary button-sm btn-action"
						onclick="get_data_search()">Search</button>

				</div>
			</div>

		</div>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-10">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Guide Information</label>
					</div>
					<div id="div-guide-search" class="list-scroll">
						<table id="table-guide-search" class=""></table>
					</div>
				</div>
				<div class="row row-border-1">
					<div class="title-row-div">
						<label class="title-row">Complain Infomation</label>
					</div>
					<div class="col-md-7">
						<div style="height: 100px">
							<table id="process-info" class="table table-bordered">
								<tbody></tbody>
							</table>
						</div>
						<button class="btn btn-primary"
							style="margin-left: 50px; margin-top: 10px;" disabled="true"
							id="get-complain-info">Get Complain Information</button>
					</div>
					<div class="col-md-5">
						<div class="row row-border">
							<div class="title-row-div">
								<label class="title-row">Complain</label>
							</div>
							<textarea class="form-control" rows="3" readonly></textarea>
							<div class="form-inline form-margin-bottom">
								<div class="form-group form-margin-top-right">
									<label class="label-item-xlg">Pecuniary Penalty</label> <input
										id="penalty" type="text"
										class="form-control input-sm select-size-sm" readonly> <label
										class="label-item-sm">VND</label>
								</div>
								<div class="checkbox form-margin-top-right">
									<label> <input type="checkbox" name="finish"> Finished
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="button-action-div">
					<form
						action="<?php echo base_url('TransferController/export_guide');?>"
						method="POST">
						<input type="hidden" name="guidename" id="guidename" value=""> <input
							type="hidden" name="guide_type" id="guide_type"> <input
							type="hidden" name="from_date" id="from_date"> <input
							type="hidden" name="to_date" id="to_date"> <input
							class="btn btn-primary button-md btn-action" disabled="true"
							id="print-guide" value="Print" type="submit" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  	$(document).ready(function(){
  		$("input[name=finish]").prop("disabled", true);
		$('input[name=from-date]').attr('readonly', false);
  		$('#from-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=from-date]').val())){
  				$('input[name=from-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  			} else {
  				$('input[name=from-date]').css('border', "1px solid #ccc");
  			}
		});

		$('input[name=to-date]').attr('readonly', false);
  		$('#to-date').on("change.bfhdatepicker",function () {
  			if (!isdate($('input[name=to-date]').val())){
  				$('input[name=to-date]').css('border', "1px solid red");
  				window.alert("Input Invalid");
  			} else {
  				$('input[name=to-date]').css('border', "1px solid #ccc");
  			}
		});
		$('#guide').change(function () {
	    	var guide=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('TransferController/get_type_guide'); ?>",
	            async: false,
	            type: "POST",  
	            data: "guide="+ guide, 
	            dataType: "text",				                         
	            success: function(data) {
	                $('#guide-type').val(data);
	            }
	        });
	 	});

	 	<?php if(isset($guideName) and $guideName) { ?>
	 		var id = $('#guide option').filter(function () { return $(this).html() == "<?php echo $guideName; ?>"; }).val();

	 		$('#guide').val(id);
	 		$('#guide').change();
	 		get_data_search();
	 		<?php if (isset($table) and is_array($table)) { ?>
	 			processTable = $("#process-info").DataTable({
					scrollY: 95,
					columns: [
						{"data":"date", "title": "DATE"},
						{"data":"guide", "title": "Guide Name"},
						{"data":"start", "title": "Start Time"},
						{"data":"end", "title": "End Time"},
						{"data":"tour", "title": "Tour"},
						{"data":"pax", "title": "PAX"},
						{"data":"id","visible": false},
						{"data":"note","visible": false},
						{"data":"penalty","visible": false},
						{"data":"finished","visible": false},
						{"data":"tel","visible": false}
					],
					searching:false,
					info: false,
					paging: false
				});

				<?php foreach($table as $sour) { ?>
					var data = {
		 				'id':"<?php echo $sour['id']; ?>",
		 				'note':"<?php echo $sour['note']; ?>",
		 				'penalty':"<?php echo $sour['penalty']; ?>",
		 				'finished':"<?php echo $sour['finished']; ?>",
		 				'start':"<?php echo $sour['start']; ?>",
		 				'end':"<?php echo $sour['end']; ?>",
		 				'date':"<?php echo $sour['date']; ?>",
		 				'guide':"<?php echo $sour['guide']; ?>",
		 				'tel':"<?php echo $sour['tel']; ?>",
		 				'tour':"<?php echo $sour['tour']; ?>",
		 				'pax':"<?php echo $sour['pax']; ?>",
		 			};
		 			
					processTable.row.add(data).draw( false );
				<?php } ?>
				$("textarea").val(data.note);
				$("#penalty").val(data.penalty);
				if(data.finished == "1") {
					$("input[name=finish]").prop("checked", true);
				}
	 		<?php } ?>
	 	<?php } ?>
	 	
 	});
	$("#cleardata").click(function() {

		$("#guide").val('');
		$("#guide-type").val('');
		$('input[name=from-date]').val('');
		$('input[name=to-date]').val('');
		$('#table-guide-search').html('');
	});
var i = 0;
pos = 0;
function get_data_search()
{
	if(!$("#guide").val() && !$("#guide-type").val())
	{
		alert("Please enter guide name");
		return false;
	}
	$("body").css("cursor","wait");
	var dt = {
		guide			: 	$("#guide").val(),
		guide_type		: 	$("#guide-type").val(),
		from_date		: 	$("input[name=from-date]").val(),
		to_date			: 	$("input[name=to-date]").val()
	};
	$.ajax({
		url: "<?php echo base_url('TransferController/search_guide_report'); ?>",
	    async: false,
	    type: "POST",  
	    data: dt, 
	    dataType: "json",                         
	    success: function(data) {
	    	$('#div-guide-search').html('<table id="table-guide-search"></table>');
	    	var output = "";
	        output += "<thead>";
				output	+= "<tr>";
					output	+= "<td style='width:90px' title='DATE'>DATE</td>";
					output	+= "<td style='width:90px' title='Guide Name'>Guide Name</td>";
					output	+= "<td style='width:250px' title='Tour'>Tour</td>";
					output	+= "<td style='width:70px' title='Start Time'>Start Time</td>";
					output	+= "<td style='width:70px' title='End Time'>End Time</td>";
					output	+= "<td style='width:50px' title='Pax'>Pax</td>";
				output	+= "</tr>";
			output	+= "</thead>";
			output	+= "<tbody>";
	    	$.each (data, function(key, opj) {
	    		if (key=="msg"){
	    			if (opj=="false")
	    			{
		    			window.alert("Data not found!!!");		    			
                        $('#print-guide').attr("disabled",true);
                        $('#get-complain-info').attr("disabled",true);
                        return false;
		    		}
                    else
                    {
                        $('#print-guide').attr("disabled",false);
                     	$('#get-complain-info').attr("disabled",false);
                     	$("#guidename").val($("#guide").val());
                     	$("#guide_type").val($("#guide-type").val());
                     	$("#from_date").val($("input[name=from-date]").val());
                     	$("#to_date").val($("input[name=to-date]").val());
                    }
	    		} else {
	    			$.each (opj, function(key, row) {
		    			output += "<tr id='tour-"+ key + row["ID"]+"' onclick=select_row('"+ key + row["ID"]+"')>";
				            output += "<td style='width:90px' title='"+((row["Date"]!=null)?row["Date"]:"")+"'>"+((row["Date"]!=null)?row["Date"]:"")+"</td>";
				            output += "<td style='width:90px' title='"+((row["GuideName"]!=null)?row["GuideName"]:"")+"'>"+((row["GuideName"]!=null)?row["GuideName"]:"")+"</td>";
				            output += "<td style='width:250px' title='"+((row["TourName"]!=null)?row["TourName"]:"")+"'>"+((row["TourName"]!=null)?row["TourName"]:"")+"</td>";
				            output += "<td style='width:70px' title=''></td>";
				            output += "<td style='width:70px' title=''></td>";
				            output += "<td style='width:50px' title='0'>0</td>";
			            output += "</tr>";
		        	});
	    		}
            });
            output	+= "</tbody>";
	       	$('#table-guide-search').html(output);
	       	$('#table-guide-search').DataTable({
	       			responsive: true,
	                scrollY: 115,
	                paging: false,
	                scrollX: false,
	       	});
	       	// $('.dataTables_scrollHead').height(35);

	       	$("body").css("cursor","");
	       	$(".table-fixed").find("tr").css("cursor","default");
	    }
	});
}

function select_row(id)
{
	$("#table-guide-search tbody tr.tb-tr-selected").removeClass("tb-tr-selected");
	$("#tour-" + id).addClass("tb-tr-selected");
}
function print_guide_report()
{
 //    var dt = {
	// 	guide			: 	$("#guide").val(),
	// 	guide_type		: 	$("#guide-type").val(),
	// 	from_date		: 	$("input[name=from-date]").val(),
	// 	to_date			: 	$("input[name=to-date]").val()
	// };
	// $.ajax({
 //            url: "<?php echo base_url('TransferController/export_guide'); ?>",
	//     async: false,
	//     type: "POST",  
	//     data: dt, 
	//     dataType: "json",
 //            beforeSend: function(){
	// 	    $("body").css("cursor", "wait");
	// 		},
 //                complete: function() 
 //                        {
	// 			$("body").css("cursor","default");
	// 			window.open("<?php echo base_url('newGuideReport.xls'); ?>", '_blank');
	// 		}              
 //    });
}

$("#get-complain-info").click(function(){
	window.location.href = "<?php echo base_url('transfer-management/get_complain'); ?>" + "?id=" + $("#guide").val();
})
</script>
<?php echo $this->load->view('Layout/footer');?>