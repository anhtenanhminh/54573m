<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.dataTables_info {
	display: none;
}

#table-allotment-report {
	white-space: nowrap;
	width: auto !important;
	/*table-layout: fixed;*/
}

#table-allotment-report td {
	overflow: hidden;
	text-overflow: ellipsis;
	padding-left: 0px !important;
	padding-right: 0px !important;
	text-align: center !important;
}

.dataTables_scrollHeadInner {
	width: auto !important;
}

.dataTables_scrollHeadInner table {
	white-space: nowrap;
	/*table-layout: fixed;*/
	width: auto !important;
}

.dataTables_scrollHeadInner th {
	overflow: hidden;
	text-overflow: ellipsis;
	text-align: center !important;
}

.dataTables_scrollHeadInner th:nth-child(1) {
	width: 10% !important;
}

.dataTables_scrollHeadInner th:nth-child(2) {
	width: 40% !important;
}

.dataTables_scrollHeadInner th:nth-child(3) {
	width: 10% !important;
}

.dataTables_scrollHeadInner th:nth-child(4) {
	width: 10% !important;
}

.dataTables_scrollHeadInner th:nth-child(5) {
	width: 10% !important;
}

.dataTables_scrollHeadInner th:nth-child(6) {
	width: 10% !important;
}

.dataTables_scrollHeadInner th:nth-child(7) {
	width: 10% !important;
}

.dataTables_scrollBody {
	height: 260px !important;
}
</style>
<div class="content">
	<div class="container">
		<h4>
			Allotment Report
			<button class="btn btn-sm button-sm btn-primary"
				style="float: right;"
				onclick="location.href='<?php echo base_url();?>hotel-booking'">Back</button>
		</h4>
		<div class="row line-strong" style="margin-top: 20px;"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Conditions</label>
			</div>
			<div class="row form-inline">
				<div class="col-md-12">
					<div class="form-group">
						<label class="label-item-sm">City</label> <select
							class="form-control input-sm select-size" id="city">
							<option value=""></option>
								<?php
        if ($city) {
            foreach ($city as $city) {
                if ($city['city'] != '' && $city['city'] != null) {
                    ?>
							      	<option value="<?php echo $city['city']?>"><?php echo $city['city']?></option>
							    <?php }}}?>
							  </select>
					</div>
					<div class="form-group">
						<label class="label-item-sm">Hotel</label> <select id="hotel"
							class="form-control input-sm select-size">
							<option value=""></option>
						</select>
					</div>
					<div class="form-group">
						<label class="label-item-sm">R/Class</label> <select
							class="form-control input-sm select-size-sm" id="room-class">
							<option></option>
						</select>
					</div>
					<div class="form-group">
						<label class="label-item">Day From</label>
						<div id="from-date" class="form-group bfh-datepicker select-size"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="from-date"
							data-input="form-control input-sm check_date" data-date=""></div>
					</div>
					<div class="form-group">
						<label class="label-item-sm">To</label>
						<div id="to-date" class="form-group bfh-datepicker select-size"
							data-placeholder="yyyy/mm/dd" data-format="y/m/d"
							data-align="right" data-name="to-date"
							data-input="form-control input-sm check_date" data-date=""></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-md-offset-9">
					<div class="form-inline" style="margin-top: 20px">
						<button class="btn btn-sm btn-primary btn-action"
							onclick="clear_form()">Clear</button>
						<button
							class="btn-search btn btn-sm button-md btn-primary btn-action"
							onclick="search_allotment_report()">Search</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Allotment List</label>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="div-allotment-report" style="height: 300px;">
						<table id="table-allotment-report" class="cell-border"></table>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 20px">
			<div class="col-md3 col-md-offset-5">
				<form method="POST"
					action="<?php echo base_url('HotelBookingController/export_alloment_report');?>">
					<input type="hidden" name="ci_ty" id="ci_ty" value=""> <input
						type="hidden" name="ho_tel" id="ho_tel"> <input type="hidden"
						name="room_class" id="room_class" value=""> <input type="hidden"
						name="date_from" id="date_from"> <input type="hidden"
						name="date_to" id="date_to">
					<!--				<input class="btn btn-sm button-md btn-primary btn-action" onclick="return check_print()" id="btnPrint" value="Print" type="submit" />-->
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
        var flag =0;
	$(document).ready(function(){
		//Check date ========Duong
		$('.check_date').blur(function(event){
			name = $(this).attr('name');
			date = $(this).val();
			dt = {date : date}
			$.ajax({
				url:'<?php echo base_url("TransferController/check_date") ?>',
				type:'POST',
				dataType:'json',
				data:dt,
				success: function(data)
				{
					if(data['msg'] !='')
					{
						alert('Date must be formatted as [YYYY/MM/DD].');
						setTimeout(function(){
								$("input[name="+name+"]").focus();
								},1);
					}
				}
			});
		});
		//End Check date
		//get hotel by city
		$('#city').change(function () {
	    	var city=$(this).val();
	        $.ajax({   
	            url: "<?php echo base_url('HotelBookingController/get_hotel_by_city'); ?>",
	            async: false,
	            type: "POST",  
	            data: "city="+ city, 
	            dataType: "html",				                         
	            success: function(data) {
	                $('#hotel').html(data);
	            }
	        });
	 	});

	 	$('#hotel').change(function () {
	    	var dt = {
	    		city 	: 	$("city").val(),
	    		hotel 	: 	$(this).val()
	    	};
	        $.ajax({   
	            url: "<?php echo base_url('HotelBookingController/get_room_hotel'); ?>",
	            async: false,
	            type: "POST",  
	            data: dt, 
	            dataType: "html",		                         
	            success: function(data) {
	                $('#room-class').html(data);
	            }
	        });
	 	});

		$("#table-allotment-report > tbody > tr > td").focus(function() {
			$(this).select();
		});
	});
	/*check print allotment*/
	function check_print()
	{
		$("#ci_ty").val($("#city").val());
		$("#ho_tel").val($("#hotel").val());
		$("#room_class").val($("#room-class").val());
		$("#date_from").val($('input[name=from-date]').val());
		$("#date_to").val($('input[name=to-date]').val());
		if($("#city").val()=='')
		{
			alert("Please choose City");
			return false;
		}
		else if($("#hotel").val()=='')
		{
			 alert("Please choose Hotel");
			 return false;
		}
		else if($("#room-class").val()=='')
		{
			 alert("Please choose Room Class");
			 return false;
		}
		else if(flag==0)
		{
			alert("The choosen hotel doesn't have allotment. Please try again");
			return false;
		}
		else
		{
			return true;
		}
	}
	/*get data after click search*/
	function search_allotment_report()
	{          
		var dt = {
	   		hotel 	   : 	$("#hotel").val(),
	   		room_class :    $("#room-class").val(),
	   		date_from  :    $('input[name=from-date]').val(),
  			date_to    :    $('input[name=to-date]').val()
		};

		$.ajax({
			url: "<?php echo base_url('HotelBookingController/search_allotment_report'); ?>",
		    async: true,
		    type: "POST",  
		    data: dt, 
		    dataType: "json",
			beforeSend	: function () {
				$("body").css("cursor" , "wait");
			},
			complete	: function () {
				$("body").css("cursor" , "default");
			},
		    success: function(data) {
		    	flag = 0;
		    	$('#div-allotment-report').html('<table id="table-allotment-report" class="cell-border"></table>');
		    	var output = "";
		        output += "<thead style=' background-color:#2d6ca2;color: white;'>";
					output	+= "<tr class='testRow' style='text-align:center;height:37px;'>";
						output	+= "<th title = 'Date'>Date</th>";
						output	+= "<th title = 'Hotel Name'>Hotel Name</th>";
						output	+= "<th title = 'No. Allotment'>No. Allotment</th>";
						output	+= "<th title = 'Use Allotment'>Use Allotment</th>";
						output	+= "<th title = 'Remain Allotment'>Remain Allotment</th>";
						output	+= "<th title = 'VNCode'>VNCode</th>";
						output	+= "<th title = 'Room Class'>Room Class</th>";
					output	+= "</tr>";
				output	+= "</thead>";
				output	+= "<tbody>";
		    	$.each (data, function(key, opj) {
		    		if (key=="msg"){
		    			if (opj=="false"){
			    			window.alert("Data not found!!!");
			    		}
		    		} else {
		    			$.each (opj, function(key, row) {
			    			output += "<tr style='height:37px;'>";
					            output += "<td contenteditable='true' style='width: 10%;' title='"+((row["Date"]!=null)?row["Date"]:"")+"'>"+((row["Date"]!=null)?row["Date"]:"")+"</td>";
					            output += "<td contenteditable='true' style='width: 40%;' title='"+((row["HotelName"]!=null)?row["HotelName"]:"")+"'>"+((row["HotelName"]!=null)?row["HotelName"]:"")+"</td>";
					            output += "<td contenteditable='true' style='width: 10%;' title='"+((row["RoomNo_Day"]!=null)?row["RoomNo_Day"]:"")+"'>"+((row["RoomNo_Day"]!=null)?row["RoomNo_Day"]:"")+"</td>";
					            output += "<td contenteditable='true' style='width: 10%;' title='"+((row["Use_RoomNo_Day"]!=null)?row["Use_RoomNo_Day"]:"")+"'>"+((row["Use_RoomNo_Day"]!=null)?row["Use_RoomNo_Day"]:"")+"</td>";
					            output += "<td contenteditable='true' style='width: 10%;' title='"+((row["Remain_RoomNo_Day"]!=null)?row["Remain_RoomNo_Day"]:"")+"'>"+((row["Remain_RoomNo_Day"]!=null)?row["Remain_RoomNo_Day"]:"")+"</td>";
					            output += "<td contenteditable='true' style='width: 10%;' title='"+((row["VNCode"]!=null)?row["VNCode"]:"")+"'>"+((row["VNCode"]!=null)?row["VNCode"]:"")+"</td>";
					            output += "<td contenteditable='true' style='width: 10%;' title='"+((row["RoomClass"]!=null)?row["RoomClass"]:"")+"'>"+((row["RoomClass"]!=null)?row["RoomClass"]:"")+"</td>";
				            output += "</tr>";
							flag = flag +1;
			        	});
		    		}
	            });
	            output	+= "</tbody>";
		       	$('#table-allotment-report').html(output);
		       	$("body").css("cursor","");
		       	$(".table-fixed").find("tr").css("cursor","default");
		       	$('#table-allotment-report').DataTable({
		                responsive: true,
		                scrollY: 150,
		                paging: false,
		                scrollX: 2000,
		                searching: false,
		                order:[]
		        });
                        
		        $('.dataTables_scrollHead').height(35);
		       	/*$('#table-allotment-report tbody tr td[title]').tooltip( {
			        "delay": 0,
			        "track": true,
			        "fade": 250
			    } );*/		    
		       }
		});
	}

//clear form
	function clear_form(){
		$("#city").val('');
		$("#hotel").val('');
		$("#room-class").val('');
		$('.check_date').val('');
	}
        // function export_alloment_report()
        // {
        //     var i =1;
        //     if($("#city").val()=='')
        //     {
        //         i=0;
        //         alert("Please choose City");
        //     }
        //     else if($("#hotel").val()=='')
        //     {
        //         i=0;
        //         alert("Please choose Hotel");
        //     }
        //     else if($("#room-class").val()=='')
        //     {
        //         i=0;
        //         alert("Please choose Room Class");
        //     }
        //     else if(flag==0)
        //     {
        //         alert("The choosen hotel doesn't have allotment. Please try again");
        //         i=0;
        //     }
        //     if(i)
        //     {
        //         var dt = {
        //                     city	   : 	$("#city").val(),
        //                     hotel 	   : 	$("#hotel").val(),
        //                     room_class :    $("#room-class").val(),
        //                     date_from  :    $('input[name=from-date]').val(),
        //                     date_to    :    $('input[name=to-date]').val()
        //             };
        //         $.ajax({                
        //                 url: "<?php echo base_url('HotelBookingController/export_alloment_report'); ?>",
        //                 type: "POST",  
        //                 data: dt, 
        //                 dataType: "json",
        //                 beforeSend: function(){
        //                     $("body").css("cursor", "wait");
        //                         },
        //                 complete: function() {
        //                                 $("body").css("cursor","default");
        //                                 window.open("<?php echo base_url('newAllotmentReport.xls'); ?>", '_blank');
        //                         }              
        //             });
        //     }
        // }

</script>