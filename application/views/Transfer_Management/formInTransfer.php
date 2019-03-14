<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
	#table-tour-info-intransfer_filter
	{
		display: none;
	}
	.dataTables_info
	{
		display: none;
	}
	#div-tour-info-intransfer
	{
		overflow: hidden;
	}

	#table-tour-info-intransfer
	{
		white-space: nowrap;
		table-layout: fixed;
	}
	#table-tour-info-intransfer td
	{
		
		overflow: hidden;
		text-overflow: ellipsis;

	}
	.dataTables_scrollHeadInner table
	{
		white-space: nowrap;
		table-layout: fixed;
	}
	.dataTables_scrollHeadInner td
	{
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>
<div class="content">
	<input type="hidden" id="msg" value="<?php if (isset($msg)) echo $msg; else echo ""; ?>">
	<div class="container">
		<h3 style="margin-top:6px;margin-bottom:0px;">IN TRANSFER</h3>
		<div class="row line-strong" style="margin-top:0px; margin-bottom:12px;"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Fields </label>
			</div>
			<div class="col-md-3">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
	    				<label class="label-item">Table Code</label>
	    				<input type="text" id="table-code" class="form-control input-sm select-size search_condition" placeholder="Table Code" value="<?php if(isset($search_condition['table-code'])) {echo $search_condition['table-code'];}elseif(isset($search_in['tblcode'])) {echo $search_in['tblcode'];}?>">
	  				</div>
  				</div>
  				<div class="form-inline form-margin-bottom">
					<div class="form-group">
	    				<label class="label-item">Guest Name</label>
	    				<input type="text" id="guest-name" class="form-control input-sm select-size search_condition" placeholder="Guest Name" value="<?php if(isset($search_condition['guest-name'])) {echo $search_condition['guest-name'];}elseif(isset($search_in['guest_name'])) {echo $search_in['guest_name'];} ?>">
	  				</div>
	   			</div>
			</div>
			<div class="col-md-2">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
	    				<label class="label-item-md">Car No.</label>
	    				<select id="car-num" class="form-control input-sm select-size-sm search_condition" >
	    					<option value=""></option>
	    					<?php
							if($car_info) 
							{
								foreach($car_info as $row) { ?>
									<option <?php if((isset($search_condition['car-num'])&&($search_condition['car-num']==$row['CarNo']))){echo 'selected';}elseif((isset($search_in['car_num'])&&($search_in['car_num']==$row['CarNo']))){echo 'selected';} ?> value="<?php echo $row['CarNo']?>"><?php echo $row['CarNo']?></option>
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
	    				<label class="label-item">Driver Name</label>
	    				<select id="driver-name" class="form-control input-sm select-size search_condition">
	    					<option value=""></option>
	    					<?php
							if($car_info) 
							{
								foreach($car_info as $row) { ?>
									<option <?php if(isset($search_condition['driver-name'])&&($search_condition['driver-name']==$row['DriverName'])){echo 'selected';}elseif(isset($search_in['driver_name'])&&($search_in['driver_name']==$row['DriverName'])){echo 'selected';} ?> value="<?php echo $row['DriverName']?>"><?php echo $row['DriverName']?></option>
								<?php 	
								}
							}
							?>
	    				</select>
	  				</div>
  				</div>
  				<div class="form-inline form-margin-bottom">
					<div class="form-group">
	    				<label class="label-item">Guide Name</label>
	    				<select id="guide-name" class="form-control input-sm select-size search_condition" name="GuideID">
	    					<option value=""></option>
	    					<?php
							if($guide) 
							{
								foreach($guide as $row) { ?>
									<option <?php if(isset($search_condition['guide-name'])&&($search_condition['guide-name']==$row['GuideName'])){echo 'selected';}elseif(isset($search_in['guide_name'])&&($search_in['guide_name']==$row['GuideName'])){echo 'selected';}?> value="<?php echo $row['GuideName']?>"><?php echo $row['GuideName']?></option>
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
		    				<div id="from-date" class="form-group bfh-datepicker select-size" data-placeholder="yyyy/mm/dd" data-format="y/m/d" data-align="right" data-name="from-date" data-input="form-control input-sm select-size-md search_condition" data-date="<?php if(isset($search_condition['from_date_input'])){echo $search_condition['from_date_input'];}elseif(isset($search_in['from_date'])){echo $search_in['from_date'];} ?>"></div>
		  				</div>
	  				</div>
	  				<div class="form-inline form-margin-bottom">
						<div class="form-group">
		    				<label class="label-item">To Date</label>
		    				<div id="to-date" class="form-group bfh-datepicker select-size" data-placeholder="yyyy/mm/dd" data-format="y/m/d" data-align="right" data-name="to-date" data-input="form-control input-sm select-size-md search_condition" data-date="<?php if(isset($search_condition['to_date_input'])){echo $search_condition['to_date_input'];}elseif(isset($search_in['to_date'])){echo $search_in['to_date'];}?>"></div>
		  				</div>
	  				</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="button-action-div">					
					<button class="btn btn-primary button-sm btn-sm btn-action" onclick="clear_data()">Clear</button>
                                        <button class="btn btn-primary button-sm btn-sm btn-action" onclick="get_data_search()">Search</button>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		
			<div class="row row-border">
				<div class="title-row-div">
					<label class="title-row">Common Tour Information</label>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div id="div-tour-info-intransfer" class="list-scroll">
							<table id="table-tour-info-intransfer" class="table table-bordered">							
							</table>
						</div>
					</div>
					<div class="col-md-2">
						<div class="button-action-div">
                       <button class="btn btn-sm button-lg btn-primary btn-action" onClick="location.href='<?php echo base_url();?>transfer-management/new-in-transfer'">New In-Transfer</button><br>
                       <button class="btn btn-sm button-lg btn-primary btn-action" onclick="update_in_tranfer()" disabled="true" id="update_intranfer">Update In-Transfer</button><br>
                       <button class="btn btn-sm button-lg btn-primary btn-action" onclick="deleteTransferIn()" disabled="true" id="delete_intranfer">Delete In-Transfer</button><br>	
						<form method="POST" action="<?php echo base_url('TransferController/print_intranfer');?>">
							<input type="hidden" name="code" id="code" value="" >
							<input type="hidden" name="tblcode" id="tblcode" >
							<input type="hidden" name="guest_name" id="guestname" >
							<input type="hidden" name="car_num" id="carnum" >
							<input type="hidden" name="driver_name" id="drivername">
							<input type="hidden" name="guide_name" id="guidename">
							<input type="hidden" name="from_date" id="fromdate">
							<input type="hidden" name="to_date" id="todate">
							<input class="btn btn-sm button-md btn-primary btn-action" disabled="true" id="print-single" type="submit" value="Print" name="print_single">
							<input class="btn btn-sm button-md btn-primary btn-action" disabled="true" id="btnPrintAll" type="submit" value="Print All">	
						</form>	    
						            
						</div>
					</div>
				</div>

				<div class="row">
					<label id="lb-total"> Total of Guests</label>
                                        <label id="total_person"></label>
					<label id="lb-person">Person(s)</label>
				</div>
			</div>
		
		<div class="row line-strong"></div>
		<div class="row">
			<div class="col-md-10">
				<div class="row row-border">
					<div class="title-row-div">
						<label class="title-row">Update Transfer Detail</label>
					</div>
					<div id="div-update-transfer-detail-intransfer" class="list-scroll">
						<table id="table-update-transfer-detail-intransfer" class="table table-fixed"></table>
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
var tblcode='';
var inID= '';
$(document).ready(function(){
	//Dương đặt id cho 2 datepicker
	$('input[name=from-date]').attr('id', 'from_date_input');
	$('input[name=to-date]').attr('id', 'to_date_input');
	//Dương kiểm tra có phải trở về từ trang update hay không nếu có thì lấy lại data đã search
	var check_back = '<?php echo isset($search_condition) ?>';
	var search_in = '<?php echo isset($search_in) ?>';
	if(search_in)
	{
		get_data_search();
	}

	if(check_back)
	{
		get_data_search();
	}
	//end Dương	
});

var tourid = "";
var tltcode = "";
var search_condition_obj={};
  	$(document).ready(function(){
  		if ($("#msg").val()!=""){
			if ($("#msg").val()=="true") alert("Update success!!!");
			else alert("Update fail!!!");
			$("#msg").val("");
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

function get_data_search()
{
	$('#print-single').attr("disabled",true);	
	$("#tb_lcode").val($("#table-code").val());
	$("#guest_name").val($("#guest-name").val());
	$("#car_num").val($("#car-num").val());
	$("#driver_name").val($("#driver-name").val());
	$("#guide_name").val($("#guide-name").val());
	$("#from_date").val($("input[name=from-date]").val());
	$("#to_date").val($("input[name=to-date]").val());

	$("body").css("cursor","wait");
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
		url: "<?php echo base_url('TransferController/get_data_search_intransfer'); ?>",
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
	    		if (key=="msg"){
	    			if (opj=="false"){
		    			window.alert("Data not found!!!");
                                        $('#update_intranfer').attr("disabled",true);
                                        $('#delete_intranfer').attr("disabled",true);
                                        $('#btnPrintAll').attr("disabled",true);
                                        $('#print-single').attr("disabled",true);	
                                        return false;
		    		}
                                else
                                {        
                                    $('#update_intranfer').attr("disabled",false);
                                    $('#delete_intranfer').attr("disabled",false);
                                    $('#btnPrintAll').attr("disabled",false);
                                }
	    		} 
                        else if(key == "totalperson")
                        {
                            $('#total_person').html(opj);
                        }
                        else {
	    			$.each (opj, function(key, row) {
		    			output += "<tr id='tour-"+row["InID"]+"' onclick=\"get_info_tour('"+row["InID"]+"','"+row["TBLCodeIn"]+"','"+row["DateIn"]+"')\">";
				            output += "<td title='"+((row["TBLCodeIn"]!=null)?row["TBLCodeIn"]:"")+"' style='width:145px'>"+((row["TBLCodeIn"]!=null)?row["TBLCodeIn"]:"")+"</td>";
				            output += "<td title='"+((row["DateIn"]!=null)?row["DateIn"]:"")+"' style='width:105px'>"+((row["DateIn"]!=null)?row["DateIn"]:"")+"</td>";
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
				    scrollY: 140,
				    order: []
	       	});
	       	$('.dataTables_scrollHead').height(38);
	       	$("body").css("cursor","");
	       	$(".table-fixed").find("tr").css("cursor","default");
	       	//Dương- tạo oject điều kiện search
	       	$('.search_condition').each(function(){
					search_condition_obj[$(this).attr('id')] = $(this).val();
				});
			$("#table-update-transfer-detail-intransfer").html("");
			$("#guest-transfer-intransfer").html("");
	    }
	});
}

function get_info_tour(InID,TBLCodeIn,DateIn)
{
	tblcode = TBLCodeIn;
	inID = InID;	
    $('#print-single').attr("disabled",false);
	// window.alert("#tour-"+InID);
	$(".tr-selected").css("background","transparent");
	$(".tr-selected").removeClass("tr-selected");
        //$("#tranfer-guest").html("");
    $("#guest-transfer-intransfer").html("");
	$("#tour-"+InID).css("background","#397FDB");
	$("#tour-"+InID).addClass("tr-selected");
	$("#code").val($("#tour-"+InID+" td:nth-child(1)").html());
	$("#tblcode").val($("#table-code").val());
	$("#guestname").val($("#guest-name").val());
	$("#carnum").val($("#car-num").val());
	$("#drivername").val($("#driver-name").val());
	$("#guidename").val($("#guide-name").val());
	$("#fromdate").val($("input[name=from-date]").val());
	$("#todate").val($("input[name=to-date]").val());
	var dt = {
		TBLCodeIn 	: 	TBLCodeIn,
		DateIn 		: 	DateIn
	};
    $.ajax({   
        url: "<?php echo base_url('TransferController/get_info_tour_intransfer'); ?>",
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
		    		if (key=="tour")
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
						outputTransfer	+= "<tbody>";
                       	outputTransfer  += opj;
						outputTransfer	+= "</tbody>";
		    		}              
	            });			
	       	$('#table-update-transfer-detail-intransfer').html(outputTransfer);
	       	$(".table-fixed").find("tr").css("cursor","default");	       	
            });
        }
    });
	$("#tblcodein").val(tblcode);
}
function deleteTransferIn()
{
	var code = tblcode;        
        //alert(id);        
        if(code=="")
        {
            alert("No TranferIn selected!!!");
        }
        else
        {
           var r = confirm("The selected tour and all related TranferIN will be deleted.Are you sure to continue ?");
           if (r == true) 
           {
                $.ajax({
                        async: false,
                        url  : "<?php echo base_url('TransferController/delete_in_transferbycode'); ?>",
                        type : "POST",
			data : "code="+code
                        
                });              
           }
           get_data_search();
           $('#div-update-transfer-detail-intransfer').html('<table id="table-update-transfer-detail-intransfer" class="table table-fixed"></table>');
        }
            
}
function get_guest(TourID,TLTCode){
	$("#table-update-transfer-detail-intransfer").find("tr").css("background","transparent");
	$("#transfer-"+TourID+"-"+TLTCode).css("background","#397FDB");
	tourid = TourID;
	tltcode = TLTCode;
	var dt = {
		TourID 		: 	TourID,
		TLTCode 	: 	TLTCode,
		Choose		: 	true
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
function update_in_tranfer()
{
	
	if(tblcode=='')
	{
		window.alert("please select a row");		
	}
	else
	{	
		//Dương gửi điều kiện search qua trang update để khi quay lại hiện data đã search trước đó
		var string_href = '<?php echo base_url();?>transfer-management/update-in-transfer?id='+tourid+'&code='+tltcode+'&tblcode='+tblcode;
		for(var key in search_condition_obj)
		{
			if(search_condition_obj[key] != '')
			{
				string_href += '&'+key+'='+search_condition_obj[key];
			}
		}
      	location.href =string_href;	
      	//end Dương	
	}
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

$("#print-single").click(function() {
	// var code = $(".tr-selected td:nth-child(1)").html();
	// 	$("body").css("cursor","wait");
 //         var dt = {
 //            code            :       code,
 //            table_code		: 	$("#table-code").val(),
 //            guest_name		: 	$("#guest-name").val(),
 //            car_num 		: 	$("#car-num").val(),
 //            driver_name 	: 	$("#driver-name").val(),
 //            guide_name		: 	$("#guide-name").val(),
 //            from_date		: 	$("input[name=from-date]").val(),
 //            to_date 		: 	$("input[name=to-date]").val()
 //        };
 //        $.ajax({                
 //                url: "<?php echo base_url('TransferController/print_intranfer'); ?>",
 //                type: "POST", 
 //                async: true ,
 //                data: dt, 
 //                dataType: "json",              
 //                success: function(data) 
 //                {
 //                	if(data.msg!="")
 //                	{
 //                		$("body").css("cursor","default");
 //                		alert(data.msg);
 //                	}
 //                	else
 //                	{
 //                		$("body").css("cursor","default");
	// 					window.open("<?php echo base_url('newTransfer_In.xls'); ?>", '_blank');
 //                	}                		
	// 			}

 //            });  
});

$("#btnPrintAll").click(function() 
{
	// $("body").css("cursor","wait");
 //         var dt = {     
 //            table_code		: 	$("#table-code").val(),
 //            guest_name		: 	$("#guest-name").val(),
 //            car_num 		: 	$("#car-num").val(),
 //            driver_name 	: 	$("#driver-name").val(),
 //            guide_name		: 	$("#guide-name").val(),
 //            from_date		: 	$("input[name=from-date]").val(),
 //            to_date 		: 	$("input[name=to-date]").val()
 //        };
 //        $.ajax({                
 //                url: "<?php echo base_url('TransferController/print_all_intranfer'); ?>",
 //                type: "POST", 
 //                async: true ,
 //                data: dt, 
 //                dataType: "json",

 //               success: function(data) 
 //               {
 //                	if(data.msg!="")
 //                	{
 //                		$("body").css("cursor","default");
 //                		alert(data.msg);
 //                	}
 //                	else
 //                	{
 //                		$("body").css("cursor","default");
	// 					window.open("<?php echo base_url('newTransferInAll.xls'); ?>", '_blank');
 //                	}		
	// 			}		   
 //            });  
});


</script>
<?php echo $this->load->view('Layout/footer');?>