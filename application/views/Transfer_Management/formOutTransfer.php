<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
#table-tour-info-intransfer_filter {
	display: none;
}

.dataTables_info {
	display: none;
}

#div-tour-info-intransfer {
	overflow: hidden;
}

#table-tour-info-intransfer {
	white-space: nowrap;
	table-layout: fixed;
}

#table-tour-info-intransfer td {
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
	<input type="hidden" id="msg"
		value="<?php if (isset($msg)) echo $msg; else echo ""; ?>">
	<div class="container">
		<h3 style="margin-top: 6px; margin-bottom: 0px;">OUT TRANSFER</h3>
		<div class="row line-strong"
			style="margin-top: 0px; margin-bottom: 12px;"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields</label>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Table Code</label> <input type="text"
							id="table-code"
							class="form-control input-sm select-size search_condition"
							placeholder="Table Code"
							value="<?php if(isset($search_out['table-code'])){echo $search_out['table-code'];}?>">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Guest Name</label> <input type="text"
							id="guest-name"
							class="form-control input-sm select-size search_condition"
							placeholder="Guest Name"
							value="<?php if(isset($search_out['guest-name'])){echo $search_out['guest-name'];}?>">
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-inline form-margin">
					<div class="form-group">
						<label class="label-item-md">Car No.</label> <select id="car-num"
							class="form-control input-sm select-size-sm search_condition">
							<option value=""></option>
	    					<?php
        if ($car_info) {
            foreach ($car_info as $row) {
                ?>
									<option value="<?php echo $row['CarNo']?>"
								<?php if(isset($search_out['car-num'])&&$search_out['car-num']==$row['CarNo']){echo 'selected';}?>><?php echo $row['CarNo']?></option>
								<?php
            }
        }
        ?>	
	    				</select>
					</div>
				</div>
				<!-- <div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Date</label>
					</div>
					<form class="form-inline form-margin">
							<div class="form-group">
								<label class="label-item">From Date</label>
	    						<input type="date" class="form-control input-sm select-size" >
	  						</div>
  						</form>
  						<form class="form-inline form-margin">
							<div class="form-group">
								<label class="label-item">To Date</label>
		    					<input type="date" class="form-control input-sm select-size" >	  						
	    					</div>
  						</form>
				</div> -->
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Driver Name</label> <select
							id="driver-name"
							class="form-control input-sm select-size search_condition">
							<option value=""></option>
	    					<?php
        if ($car_info) {
            foreach ($car_info as $row) {
                ?>
									<option value="<?php echo $row['DriverName']?>"
								<?php if(isset($search_out['driver-name'])&&$search_out['driver-name']==$row['DriverName']){echo 'selected';}?>><?php echo $row['DriverName']?></option>
								<?php
            }
        }
        ?>
	    				</select>
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Guide Name</label> <select
							id="guide-name"
							class="form-control input-sm select-size search_condition">
							<option value=""></option>
	    					<?php
        if ($guide) {
            foreach ($guide as $row) {
                ?>
									<option value="<?php echo $row['GuideName']?>"
								<?php if(isset($search_out['guide-name'])&&$search_out['guide-name']==$row['GuideName']){echo 'selected';}?>><?php echo $row['GuideName']?></option>
								<?php
            }
        }
        ?>
	    				</select>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row row-border-center">
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">From Date</label>
							<div id="from-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="from-date"
								data-input="form-control input-sm select-size-md search_condition"
								data-date="<?php if(isset($search_out['from_date_input'])){echo $search_out['from_date_input'];}?>"></div>
						</div>
					</div>
					<div class="form-inline form-margin-bottom">
						<div class="form-group">
							<label class="label-item">To Date</label>
							<div id="to-date" class="form-group bfh-datepicker select-size"
								data-placeholder="yyyy/mm/dd" data-format="y/m/d"
								data-align="right" data-name="to-date"
								data-input="form-control input-sm select-size-md search_condition"
								data-date="<?php if(isset($search_out['to_date_input'])){echo $search_out['to_date_input'];}?>"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="button-action-div">
					<button class="btn btn-primary btn-sm button-sm btn-action"
						onclick="clear_data()">Clear</button>
					<button class="btn btn-primary btn-sm button-sm btn-action"
						onclick="get_data_search()">Search</button>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<?php //echo form_open('transfer-management/update-out-transfer'); ?>
			<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Common Tour Information</label>
			</div>
			<div class="row">
				<div class="col-md-10">
					<div id="div-tour-info-intransfer" class="list-scroll">
						<table id="table-tour-info-intransfer"
							class="table table-bordered"></table>
					</div>
				</div>
				<div class="col-md-2">
					<div class="button-action-div">
						<button class="btn btn-primary btn-sm button-lg btn-action"
							onclick="location.href='<?php echo base_url();?>transfer-management/new-out-transfer'">New
							Out-Transfer</button>
						<br> <input type="submit"
							class="btn btn-sm button-lg btn-primary btn-action"
							value="Update Out-Transfer" onclick="update_out_tranfer()"
							disabled="true" id="update-out-tranfer" name="update_out_tranfer"></input><br>
						<button class="btn btn-primary btn-sm button-lg btn-action"
							onclick="delete_out_tranfer()" disabled="true"
							id="delete-out-tranfer">Delete Out-Transfer</button>
						<br>
						<form method="POST"
							action="<?php echo base_url('TransferController/print_outtranfer');?>">
							<input type="hidden" name="code" id="code" value=""> <input
								type="hidden" name="table-code" id="tblcode"> <input
								type="hidden" name="guest-name" id="guestname"> <input
								type="hidden" name="car-num" id="carnum"> <input type="hidden"
								name="driver-name" id="drivername"> <input type="hidden"
								name="guide-name" id="guidename"> <input type="hidden"
								name="from_date_input" id="fromdate"> <input type="hidden"
								name="to_date_input" id="todate"> <input
								class="btn btn-sm button-md btn-primary btn-action"
								disabled="true" id="print-single" type="submit" value="Print"
								name="print_single"> <input
								class="btn btn-sm button-md btn-primary btn-action"
								disabled="true" id="btnPrintAll" type="submit" value="Print All">
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<label id="lb-total">Total of Guests</label> <label
					id="total_person"></label> <label id="lb-person">Person(s)</label>
			</div>
		</div>
		<?php //echo form_close();?>
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-10">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Update Transfer Detail</label>
					</div>
					<div id="div-update-transfer-detail-intransfer" class="list-scroll">
						<table id="table-update-transfer-detail-intransfer"
							class="table table-fixed"></table>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Transfered Guest</label>
					</div>
					<div id="div-guest-transfer-intransfer" class="list-scroll">
						<table id="guest-transfer-intransfer" class="table table-fixed"></table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">


	var cur_TBLCodeOut = '';
	var cur_outId = '';
	var search_condition_obj={};
  	$(document).ready(function()
  	{
  		$('input[name=from-date]').attr('id', 'from_date_input');
		$('input[name=to-date]').attr('id', 'to_date_input');
  		var check = '<?php echo isset($search_out) ?>';
  		if(check)
  		{
  			get_data_search();
  		}
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
 	});

 function get_data_search(){
 	
	$("body").css("cursor","wait");
	var dt = {
		table_code		: 	$("#table-code").val(),
		guest_name		: 	$("#guest-name").val(),
		car_num 		: 	$("#car-num").val(),
		driver_name 	        : 	$("#driver-name").val(),
		guide_name		: 	$("#guide-name").val(),
		from_date		: 	$("input[name=from-date]").val(),
		to_date 		: 	$("input[name=to-date]").val()
	};
	$.ajax({
		url: "<?php echo base_url('TransferController/get_data_search_outtransfer'); ?>",
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
                $('#div-tour-info-intransfer').html('<table id="table-tour-info-intransfer" class="table table-bordered"></table>');
	    	var output = "";
	        output += "<thead>";
				output	+= "<tr>";
					output	+= "<td style='width:145px' title='Table Code'>Table Code</td>";
					output	+= "<td style='width:105px' title='Date'>Date</td>";
					output	+= "<td style='width:105px' title='Guide Name'>Guide Name</td>";
					output	+= "<td style='width:95px' title='Tel'>Tel</td>";
					output	+= "<td style='width:105px' title='Driver Name'>Driver Name</td>";
					output	+= "<td style='width:80px' title='Tel'>Tel</td>";
					output	+= "<td style='width:70px' title='Car No'>Car No</td>";
					output	+= "<td style='width:110px' title='Car Seat'>Car Seat</td>";
					output	+= "<td style='width:110px' title='No. of Guest'>No. of Guest</td>";
				output	+= "</tr>";
			output	+= "</thead>";
			output	+= "<tbody>";
	    	$.each (data, function(key, opj) {
	    		if (key=="msg")
                        {
	    			if (opj=="false")
	    			{
		    			window.alert("Data not found!!!");		    			
                       	$("#btnPrintAll").attr("disabled",true);
                        $("#update-out-tranfer").attr("disabled",false);
                        $("#delete-out-tranfer").attr("disabled",false);
                        $('#print-single').attr("disabled",true);
                        $("#table-update-transfer-detail-intransfer").html("");
                        return false;
		    		}
                    else
                    {   
                                    $("#update-out-tranfer").attr("disabled",false);
                                    $("#delete-out-tranfer").attr("disabled",false);
                                    $("#btnPrintAll").attr("disabled",false);
                                    $("#table-update-transfer-detail-intransfer").html("");
                                }
	    					} 
                        else if(key=="totalperson")
                        {
                            $('#total_person').html(opj);
                        }
                        else 
                        {
	    			$.each (opj, function(key, row) {
		    			output += "<tr id='tour-"+row["OutID"]+"' onclick=\"get_info_tour('"+row["OutID"]+"','"+row["TBLCodeOut"]+"','"+row["DateOut"]+"')\">";
				            output += "<td title='"+((row["TBLCodeOut"]!=null)?row["TBLCodeOut"]:"")+"' style='width:145px'>"+((row["TBLCodeOut"]!=null)?row["TBLCodeOut"]:"")+"</td>";
				            output += "<td title='"+((row["DateOut"]!=null)?row["DateOut"]:"")+"' style='width:105px'>"+((row["DateOut"]!=null)?row["DateOut"]:"")+"</td>";
				            output += "<td title='"+((row["GuideName"]!=null)?row["GuideName"]:"")+"' style='width:105px'>"+((row["GuideName"]!=null)?row["GuideName"]:"")+"</td>";
				            output += "<td title='"+((row["GuideTel"]!=null)?row["GuideTel"]:"")+"' style='width:95px'>"+((row["GuideTel"]!=null)?row["GuideTel"]:"")+"</td>";
				            output += "<td title='"+((row["DriverName"]!=null)?row["DriverName"]:"")+"' style='width:105px'>"+((row["DriverName"]!=null)?row["DriverName"]:"")+"</td>";
				            output += "<td title='"+((row["DriverTel"]!=null)?row["DriverTel"]:"")+"' style='width:80px'>"+((row["DriverTel"]!=null)?row["DriverTel"]:"")+"</td>";
				            output += "<td title='"+((row["CarNo"]!=null)?row["CarNo"]:"")+"' style='width:70px'>"+((row["CarNo"]!=null)?row["CarNo"]:"")+"</td>";
				            output += "<td title='"+((row["CarSeat"]!=null)?row["CarSeat"]:"")+"' style='width:110px'>"+((row["CarSeat"]!=null)?row["CarSeat"]:"")+"</td>";
				            output += "<td title='"+((row["noguest"]!=null)?row["noguest"]:"")+"' style='width:110px'>"+((row["noguest"]!=null)?row["noguest"]:"")+"</td>";
			            output += "</tr>";
		        	});
	    		}
            });
            output	+= "</tbody>";
	       	$('#table-tour-info-intransfer').html(output);
	       	$('#table-tour-info-intransfer').DataTable({
	       			paging: false,
				    responsive:true,
				    scrollY: 140
	       	});
	       		$('.dataTables_scrollHead').height(38);
	       	$("body").css("cursor","");
	       	$(".table-fixed").find("tr").css("cursor","default");
	       	$('.search_condition').each(function(){
					search_condition_obj[$(this).attr('id')] = $(this).val();
				});
			$("#table-update-transfer-detail-intransfer").html("");
			$("#guest-transfer-intransfer").html("");
	    }
	});
}
function get_info_tour(OutID,TBLCodeOut,DateOut){
	cur_TBLCodeOut = TBLCodeOut;
        $("#guest-transfer-intransfer").html("");
        $("#btnPrint").attr("disabled",false);
	cur_outId = OutID;
	$('#print-single').attr("disabled",false);
	$("#code").val($("#tour-"+OutID+" td:nth-child(1)").html());
	$("#tblcode").val($("#table-code").val());
	$("#guestname").val($("#guest-name").val());
	$("#carnum").val($("#car-num").val());
	$("#drivername").val($("#driver-name").val());
	$("#guidename").val($("#guide-name").val());
	$("#fromdate").val($("input[name=from-date]").val());
	$("#todate").val($("input[name=to-date]").val());
	
	$("#table-tour-info-intransfer").find("tr").css("background","transparent");
	$("#tour-"+OutID).css("background","#397FDB");
	var dt = {
		TBLCodeOut 	: 	TBLCodeOut		
	};
    $.ajax({   
        url: "<?php echo base_url('TransferController/get_info_tour_outtransfer'); ?>",
        type: "POST",  
        data: dt, 
        dataType: "json", 
        beforeSend: function(){
		    $("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},                    
        success: function(data){
        	$.each (data, function(key, opj) {
            	var outputTransfer = "";
		    	$.each (data, function(key, opj) {
		    		if (key=="tour"){
		    			outputTransfer += "<thead>";
							outputTransfer	+= "<tr>";
								outputTransfer	+= "<td style='width:40px'>In FLT</td>";
								outputTransfer	+= "<td style='width:50px'>From</td>";
								outputTransfer	+= "<td style='width:70px'>Time In</td>";
								outputTransfer	+= "<td style='width:70px'>Pick In</td>";
								outputTransfer	+= "<td style='width:90px'>Tour Code</td>";
								outputTransfer	+= "<td style='width:70px'>Status</td>";
								outputTransfer	+= "<td style='width:90px'>BKL Code</td>";
								outputTransfer	+= "<td style='width:90px'>Hotel</td>";
								outputTransfer	+= "<td style='width:40px'>R/Type</td>";
								outputTransfer	+= "<td style='width:40px'>R/No.</td>";
								outputTransfer	+= "<td style='width:70px'>Day In</td>";
								outputTransfer	+= "<td style='width:50px'>Out FLT</td>";
								outputTransfer	+= "<td style='width:50px'>To</td>";
								outputTransfer	+= "<td style='width:70px'>Day Out</td>";
								outputTransfer	+= "<td style='width:70px'>Time Out</td>";
								outputTransfer	+= "<td style='width:70px'>Pick Out</td>";
								outputTransfer	+= "<td style='width:110px'>Optional Tour</td>";
							outputTransfer	+= "</tr>";
						outputTransfer	+= "</thead>";
						outputTransfer	+= "<tbody>";
                                                outputTransfer+=opj;
						outputTransfer	+= "</tbody>";
		    		}
                                else
                                {
                                    outputTransfer += "<thead>";
							outputTransfer	+= "<tr>";
								outputTransfer	+= "<td style='width:40px'>In FLT</td>";
								outputTransfer	+= "<td style='width:50px'>From</td>";
								outputTransfer	+= "<td style='width:70px'>Time In</td>";
								outputTransfer	+= "<td style='width:70px'>Pick In</td>";
								outputTransfer	+= "<td style='width:90px'>Tour Code</td>";
								outputTransfer	+= "<td style='width:70px'>Status</td>";
								outputTransfer	+= "<td style='width:90px'>BKL Code</td>";
								outputTransfer	+= "<td style='width:90px'>Hotel</td>";
								outputTransfer	+= "<td style='width:40px'>R/Type</td>";
								outputTransfer	+= "<td style='width:40px'>R/No.</td>";
								outputTransfer	+= "<td style='width:70px'>Day In</td>";
								outputTransfer	+= "<td style='width:50px'>Out FLT</td>";
								outputTransfer	+= "<td style='width:50px'>To</td>";
								outputTransfer	+= "<td style='width:70px'>Day Out</td>";
								outputTransfer	+= "<td style='width:70px'>Time Out</td>";
								outputTransfer	+= "<td style='width:70px'>Pick Out</td>";
								outputTransfer	+= "<td style='width:110px'>Optional Tour</td>";
							outputTransfer	+= "</tr>";
						outputTransfer	+= "</thead>";
                                }
	            });
	       	$('#table-update-transfer-detail-intransfer').html(outputTransfer);
	       	$(".table-fixed").find("tr").css("cursor","default");
            });
        }
    });
	$("#tblcodeout").val(TBLCodeOut);
}

function delete_out_tranfer()
{
	
	var code = cur_TBLCodeOut;
	//alert(cur_TBLCodeOut);
        if(code=="")
        {
            alert("No TranferIn selected!!!");
        }
        else
        {
           var r = confirm("The selected tour and all related TranferOut will be deleted.Are you sure to continue ?");
           if (r == true) 
           {
                $.ajax({
                        async: false,
                        url  : "<?php echo base_url('TransferController/delete_out_transferbycode'); ?>",
                        type : "POST",
			data : "code="+code                        
                });              
           }
           $("#div-update-transfer-detail-intransfer").html("<table id='table-update-transfer-detail-intransfer' class='table table-fixed'></table>");
           get_data_search();
        }	
}

function get_guest_transfer(TourID,TLTCode){
	$("#table-update-transfer-detail-intransfer").find("tr").css("background","transparent");
	$("#transfer-"+TourID+"-"+TLTCode).css("background","#397FDB");
	var dt = {
		TourID 		: 	TourID,
		TLTCode 	: 	TLTCode,
		Choose		: 	false
	};
        $("#guest-transfer-intransfer").html("");
	$.ajax({   
        url: "<?php echo base_url('TransferController/get_guest_transfer_intransfer'); ?>",
        type: "POST",  
        data: dt, 
        dataType: "json",      
        beforeSend: function(){
		    $("body").css("cursor", "wait");
		},    
		complete: function() {
			$("body").css("cursor","default");
		},               
        success: function(data){
        	var outputGuest = "";
			$.each (data, function(key, opj) {
				if (key=="guest") {
			    	outputGuest += "<thead>";
			    		outputGuest += "<td style='width:174px'>Guest Name</td>";
			    	outputGuest += "</thead>";
			    	outputGuest	+= "<tbody>";
			    	$.each (opj, function(key1, row) {
			    		outputGuest += "<tr id='guest-tour-"+row["GuestID"]+"' onclick=select_guest_tour('"+row["GuestID"]+"')>";
			    			outputGuest += "<td style='width:174px'>"+row["GuestName"]+"</td>";
			    		outputGuest += "</tr>";
			    	});
			    	outputGuest	+= "</tbody>";
			    }
		   	});
		    $('#guest-transfer-intransfer').html(outputGuest);
        }
    });
}


function clear_data()
{
	$("#table-code").val("");
	$("#guest-name").val("");
	$("#car-num").val("");
	$("#driver-name").val("");
	$("#guide-name").val("");
	$("#from-date").val("");
	$("#to-date").val("");
}

$("#btnPrint").click(function() {	
        
	 
    //      var dt = {
    //         code                :       cur_TBLCodeOut,
    //         table_code		: 	$("#table-code").val(),
    //         guest_name		: 	$("#guest-name").val(),
    //         car_num 		: 	$("#car-num").val(),
    //         driver_name 	: 	$("#driver-name").val(),
    //         guide_name		: 	$("#guide-name").val(),
    //         from_date		: 	$("input[name=from-date]").val(),
    //         to_date 		: 	$("input[name=to-date]").val()
    //     };
    //     $.ajax({                
    //             url: "<?php echo base_url('TransferController/print_outtranfer'); ?>",
    //             type: "POST", 
    //             async: true ,
    //             data: dt, 
    //             dataType: "json",
    //           	 success: function(data) 
    //             {
    //             	 $.each (data, function(key, opj)
    //                     {     
    //                     	if(key=="msg")
    //                     	{
    //                     		if(opj!="")
    //                     		{                        			
    //                     			alert(opj);
    //                     		} 
    //                     		else
    //                     		{
    //                     			$("body").css("cursor","default");
				// 					window.open("<?php echo base_url('newTransfer_Out.xls'); ?>", '_blank');
    //                     		}
    //                     	}                    
                                                                                                                            
    //                     });					
				// }

    //         });
              
});

$("#btnPrintAll").click(function() {       
	 
         var dt = {            
            table_code		: 	$("#table-code").val(),
            guest_name		: 	$("#guest-name").val(),
            car_num 		: 	$("#car-num").val(),
            driver_name 	: 	$("#driver-name").val(),
            guide_name		: 	$("#guide-name").val(),
            from_date		: 	$("input[name=from-date]").val(),
            to_date 		: 	$("input[name=to-date]").val()
        };
        $.ajax({                
                url: "<?php echo base_url('TransferController/print_all_outtranfer'); ?>",
                type: "POST", 
                async: true ,
                data: dt, 
                dataType: "json",
            	 success: function(data) 
	               {
	                	if(data.msg!="")
	                	{
	                		alert(data.msg);
	                	}
	                	else
	                	{
	                		$("body").css("cursor","default");
							window.open("<?php echo base_url('newTransferOutAll.xls'); ?>", '_blank');
	                	}		
					}		   
            });  
});
function update_out_tranfer()
{
    var code = cur_TBLCodeOut;
	//alert(cur_TBLCodeOut);
        if(code=="")
        {
            alert("No TranferIn selected!!!");
        }
        else
        {
            var string_href = '<?php echo base_url();?>transfer-management/update-out-transfer?code='+code;
			for(var key in search_condition_obj)
			{
				if(search_condition_obj[key] != '')
				{
					string_href += '&'+key+'='+search_condition_obj[key];
				}
			}
	      	location.href =string_href;           
        }
}


</script>
<?php echo $this->load->view('Layout/footer');?>