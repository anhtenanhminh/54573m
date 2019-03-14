<?php echo $this->load->view('Layout/header')?>
<style type="text/css">
.dataTables_info {
	display: none;
}

#table-booking-success_filter, #table-booking-canceled_filter {
	display: none;
}

#div-booking-success, #div-booking-canceled {
	overflow: hidden;
}

.dataTables_scrollBody {
	overflow: hidden;
}

#table-booking-success, #table-booking-canceled {
	white-space: nowrap;
	table-layout: fixed;
}

#table-booking-success td, #table-booking-canceled td {
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

.chung1, .chung2 {
	width: 100px
}
</style>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h4 style="margin-top: 5px; margin-bottom: 5px">
					Booking Report
					<div class="col-md-2" style="float: right;">
						<form
							action="<?php echo base_url('HotelBookingController/export_hotel_booking');?>"
							method="POST">
							<input type="hidden" name="lction" id="lction"> <input
								type="hidden" name="arrcheck" id="arrcheck"> <input
								type="hidden" name="depcheck" id="depcheck"> <input
								type="hidden" name="c_ty" id="c_ty"> <input type="hidden"
								name="h_tel" id="h_tel"> <input type="hidden" name="arrvdate1"
								id="arrvdate1"> <input type="hidden" name="arrvdate2"
								id="arrvdate2"> <input type="hidden" name="deptdate1"
								id="deptdate1"> <input type="hidden" name="deptdate2"
								id="deptdate2">
							<!-- <input class="btn btn-primary btn-sm button-sm btn-action"  disabled="true" id="printHotel" value="Print Hotel Report" type="submit" />							 -->
							<button class="btn btn-sm btn-primary btn-action" disabled="true"
								id="printHotel" type="submit">Print Hotel Report</button>
						</form>
					</div>
				</h4>
			</div>
			<div class="col-md-2">
				<div class="form-inline " style="margin-top: 5px">
					<button class="btn btn-sm button-sm btn-primary"
						onclick="location.href='<?php echo base_url();?>hotel-booking'">Back</button>
				</div>
			</div>
		</div>
		<div class="row line-strong"
			style="margin-top: 5px; margin-bottom: 5px"></div>
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Search Conditions</label>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<input type="radio" value="city" name="sr" checked id="cb_city"
							onclick="select_city()"> <label class="label-item-sm">City</label>
						<select class="form-control input-sm select-size chung" id="city">
							<option value=""></option>
                            <?php
                            if ($city) {
                                foreach ($city as $city) {
                                    ?>
                                <option
								value="<?php echo $city['city']?>"><?php echo $city['city']?></option>
                            <?php }}?>
                        </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<label class="label-item-sm">Hotel</label> <select id="hotel"
							class="form-control input-sm select-size chung">
							<option value=""></option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-inline">
						<input type="radio" value="location" id="cb_locat" name="sr"
							onclick="select_location()"> <label class="label-item">Location</label>
						<select id="location" class="form-control input-sm select-size">
							<option value=""></option>
                            <?php
                            if ($location) {
                                foreach ($location as $row) {
                                    ?>
                                <option
								value="<?php echo $row['Location_code']?>"><?php echo $row['Location_name']?></option>
                            <?php }}?>
                        </select>
					</div>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="col-md-4">
					<div class="row row-border"
						style="margin-left: 5px; padding-bottom: 0px;">
						<div class="title-row-div">
							<label class="title-row">Arrv Date</label>
						</div>
						<div class="form-inline ">
							<input type="radio" value="arrv_today" name="arrv_radio">Today <input
								type="radio" value="arrv_month" name="arrv_radio">This month
						</div>
						<div class="form-inline">
							<input type="radio" id="arrv_date" value="arrv_date"
								name="arrv_radio" onclick="click_arrv_date()">Date <input
								type="text" name="arrv-date-1" class="chung1 check_date"> - <input
								type="text" name="arrv-date-2" class="chung1 check_date">
							<!-- <div id="date-in" class="form-group bfh-datepicker select-size-md chung1" data-placeholder="yyyy/mm/dd" data-format="y/m/d" data-align="right" data-name="arrv-date-1" data-input="form-control input-sm check_date" data-date=""></div> - <div id="date-in" class="form-group bfh-datepicker select-size-md chung1" data-placeholder="yyyy/mm/dd" data-format="y/m/d" data-align="right" data-name="arrv-date-2" data-input="form-control input-sm check_date" data-date=""></div> -->
						</div>
						<div class="form-inline">
							<input type="radio" value="arrv_unspecified" name="arrv_radio"
								checked>Unspecified
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row row-border" style="padding-bottom: 0px;">
						<div class="title-row-div">
							<label class="title-row">Dept Date</label>
						</div>
						<div class="form-inline ">
							<input type="radio" value="dept_today" name="dept_radio">Today <input
								type="radio" value="dept_month" name="dept_radio">This month
						</div>
						<div class="form-inline">
							<input type="radio" id="dept_date" value="dept_date"
								name="dept_radio" onclick="click_dept_date()">Date <input
								type="text" name="dept-date-1" class="chung2 check_date"> - <input
								type="text" name="dept-date-2" class="chung2 check_date">
							<!-- <div id="date-in" class="form-group bfh-datepicker select-size-md chung2" data-placeholder="yyyy/mm/dd" data-format="y/m/d" data-align="right" data-name="dept-date-1" data-input="form-control input-sm check_date" data-date=""></div> - <div id="date-in" class="form-group bfh-datepicker select-size-md chung2" data-placeholder="yyyy/mm/dd" data-format="y/m/d" data-align="right" data-name="dept-date-2" data-input="form-control input-sm check_date" data-date=""></div> -->
						</div>
						<div class="form-inline">
							<input type="radio" value="dept_unspecified" name="dept_radio"
								checked>Unspecified
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="button-action-div-1">
						<button
							class="btn-search btn btn-primary btn-sm button-sm btn-action"
							onclick="get_booking_report()">Search</button>
						<br>
						<button class="btn btn-primary btn-sm button-sm btn-action"
							onclick="clear_data()">Clear</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border" style="padding-bottom: 0px;">
			<div class="title-row-div">
				<label class="title-row">Successful Bookings</label>
			</div>
			<div class="list-scroll" id="div-booking-success"
				style="height: 117px">
				<table id="table-booking-success" class="cell-border">
				</table>
			</div>
			<div class="row" style="padding-top: 5px;">
				<div class="col-md-2">
					<div class="form-inline form-margin-bottom">
						<label for="sel1" class="label-item">Room Type</label> <select
							id="cb_rtypesc" onchange="sum_niteno_paxno()">
							<option></option>
							<option></option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<label for="sel1" class="label-item">Room Class</label> <select
							id="cb_rclasssc" onchange="sum_niteno_paxno()">
							<option></option>
							<option></option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<label for="BLL Code">Total Night No<input type="text" size=1
							id="nitenosc" readonly style="width: 100px"></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<label for="BLL Code">Total Room No<input type="text" size=1
							id="romnosc" readonly style="width: 100px"></label>
					</div>
				</div>
				<div class="col-md-1">
					<div>
						<form
							action="<?php echo base_url('HotelBookingController/export_booking_success');?>"
							method="POST">
							<input type="hidden" name="location_code" id="location_code"> <input
								type="hidden" name="arrv_check" id="arrv_check"> <input
								type="hidden" name="dept_check" id="dept_check"> <input
								type="hidden" name="ci_ty" id="ci_ty"> <input type="hidden"
								name="ho_tel" id="ho_tel"> <input type="hidden"
								name="arrv_date_1" id="arrv_date_1"> <input type="hidden"
								name="arrv_date_2" id="arrv_date_2"> <input type="hidden"
								name="dept_date_1" id="dept_date_1"> <input type="hidden"
								name="dept_date_2" id="dept_date_2"> <input
								class="btn btn-primary btn-sm button-sm btn-action"
								disabled="true" id="printsuccess" value="Print" type="submit" />
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row line-strong"></div>
		<div class="row row-border" style="padding-bottom: 0px;">
			<div class="title-row-div">
				<label class="title-row">Cancelled Bookings</label>
			</div>
			<div class="list-scroll" id="div-booking-canceled">
				<table id="table-booking-canceled" class="cell-border"></table>
			</div>
			<div class="row" style="padding-top: 5px;">
				<div class="col-md-2">
					<div class="form-inline form-margin-bottom">
						<label for="sel1" class="label-item">Room Type</label> <select
							class="" id="cb_rtypecancel" onchange="sum_niteno_paxno1()">
							<option value=""></option>
							<option></option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<label for="sel1" class="label-item">Room Class</label> <select
							id="cb_rclasscancel" onchange="sum_niteno_paxno1()">
							<option></option>
							<option></option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<label for="BLL Code">Total Night No<input type="text" size=1
							readonly id="nitenocc" readonly style="width: 100px"></label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group form-inline" style="margin-bottom: 0px;">
						<label for="BLL Code">Total Room No<input type="text" size=1
							id="romnocc" readonly style="width: 100px"></label>
					</div>
				</div>
				<div class="col-md-1">
					<div>
						<form
							action="<?php echo base_url('HotelBookingController/export_booking_cancel');?>"
							method="POST">
							<input type="hidden" name="locationcode" id="locationcode"> <input
								type="hidden" name="arrvcheck" id="arrvcheck"> <input
								type="hidden" name="deptcheck" id="deptcheck"> <input
								type="hidden" name="cty" id="cty"> <input type="hidden"
								name="htel" id="htel"> <input type="hidden" name="arrvdate_1"
								id="arrvdate_1"> <input type="hidden" name="arrvdate_2"
								id="arrvdate_2"> <input type="hidden" name="deptdate_1"
								id="deptdate_1"> <input type="hidden" name="deptdate_2"
								id="deptdate_2"> <input
								class="btn btn-primary btn-sm button-sm btn-action"
								disabled="true" id="pritncancel" value="Print" type="submit" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    var select_tour = "";
    var flag1 = 0;
    var flag2 = 0;
    $(document).ready(function(){
        $('#hotel').change(function(){
            if ($('#hotel').val()!='' && $('#city').val()!='') {
                load_rclass();
                load_rtype();
                load_rclass1();
                load_rtype1();
            };
        });
        $('#location').prop('disabled',true);
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
            $('#cb_rtypesc').html('');
            $('#cb_rclasssc').html('');
            $('#cb_rtypecancel').html('');
            $('#cb_rclasscancel').html('');
            var city=$(this).val();
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/ajax_call'); ?>",
                async: true,
                type: "POST",
                data: "city="+ city,
                dataType: "html",
                success: function(data)
                {
                    $('#hotel').html(data);
                }
            });
        });
        // $("#cb_city").attr('checked', 'true');
        // $("#location").attr('disabled', 'true');
        $("input[name=arrv-date-1]").prop('disabled', true);
        $("input[name=arrv-date-2]").prop('disabled', true);
        $("input[name=dept-date-1]").prop('disabled', true);
        $("input[name=dept-date-2]").prop('disabled', true);
        $('.chung1').attr('disabled', 'true');
        $('.chung2').attr('disabled', 'true');
        $("input[name=sr]").change(function(){
            // if ($(this).val()=="location") {
            $('input[name=arrv_radio]').attr('checked',false);
            $('input[name=dept_radio]').attr('checked',false);
            $("input[name=arrv-date-1]").prop('disabled', true);
            $("input[name=arrv-date-2]").prop('disabled', true);
            $("input[name=dept-date-1]").prop('disabled', true);
            $("input[name=dept-date-2]").prop('disabled', true);
            $("input[name=arrv-date-1]").val("");
            $("input[name=arrv-date-2]").val("");
            $("input[name=dept-date-1]").val("");
            $("input[name=dept-date-2]").val("");
            //Duong-Clear success and cancel data
            $('#div-booking-success').html('<table id="table-booking-success" class="cell-border"></table>');
            $('#cb_rtypesc').html('');
            $('#cb_rclasssc').html('');
            $('#nitenosc').val('');
            $('#romnosc').val('');
            $('#div-booking-canceled').html('<table id="table-booking-canceled" class="cell-border"></table>');
            $('#cb_rtypecancel').html('');
            $('#cb_rclasscancel').html('');
            $('#nitenocc').val('');
            $('#romnocc').val('');
            //end Duong
            // }
        });
        $('input[name=arrv_radio]').change(function(){
            if ($(this).val()=="arrv_date"){
                $("input[name=arrv-date-1]").prop('disabled', false);
                $("input[name=arrv-date-2]").prop('disabled', false);
            } else {
                $("input[name=arrv-date-1]").prop('disabled', true);
                $("input[name=arrv-date-2]").prop('disabled', true);
                $("input[name=arrv-date-1]").val("");
                $("input[name=arrv-date-2]").val("");
            }
        });
        $('input[name=dept_radio]').change(function(){
            if ($(this).val()=="dept_date"){
                $("input[name=dept-date-1]").prop('disabled', false);
                $("input[name=dept-date-2]").prop('disabled', false);
            } else {
                $("input[name=dept-date-1]").prop('disabled', true);
                $("input[name=dept-date-2]").prop('disabled', true);
                $("input[name=dept-date-1]").val("");
                $("input[name=dept-date-2]").val("");
            }
        });
    });
    function get_booking_report()
    {
        /*print success*/
        $("#ci_ty").val($("#city").val());
        $("#ho_tel").val($("#hotel").val());
        $("#arrv_check").val($('input:radio[name=arrv_radio]:checked').val());
        $("#dept_check").val($('input:radio[name=dept_radio]:checked').val());
        $("#arrv_date_1").val($("input[name=arrv-date-1]").val());
        $("#arrv_date_2").val($("input[name=arrv-date-2]").val());
        $("#dept_date_1").val($("input[name=dept-date-1]").val());
        $("#dept_date_2").val($("input[name=dept-date-2]").val());
        /*print cancel*/
        $("#cty").val($("#city").val());
        $("#htel").val($("#hotel").val());
        $("#arrvcheck").val($('input:radio[name=arrv_radio]:checked').val());
        $("#deptcheck").val($('input:radio[name=dept_radio]:checked').val());
        $("#arrvdate_1").val($("input[name=arrv-date-1]").val());
        $("#arrvdate_2").val($("input[name=arrv-date-2]").val());
        $("#deptdate_1").val($("input[name=dept-date-1]").val());
        $("#deptdate_2").val($("input[name=dept-date-2]").val());
        /*print hotel*/
        $("#c_ty").val($("#city").val());
        $("#h_tel").val($("#hotel").val());
        $("#arrcheck").val($('input:radio[name=arrv_radio]:checked').val());
        $("#depcheck").val($('input:radio[name=dept_radio]:checked').val());
        $("#arrvdate1").val($("input[name=arrv-date-1]").val());
        $("#arrvdate2").val($("input[name=arrv-date-2]").val());
        $("#deptdate1").val($("input[name=dept-date-1]").val());
        $("#deptdate2").val($("input[name=dept-date-2]").val());
        if($("#cb_locat").prop("checked"))
        {
            $("#location_code").val($("#location").val());
            $("#locationcode").val($("#location").val());
            $("#lction").val($("#location").val());
        }
        else
        {
            $("#location_code").val(false);
            $("#locationcode").val(false);
            $("#lction").val(false);
        }
        if ($("input[name=sr]:checked").val()=="city" && $("#city").val()=="")
        {
            alert("Please select the city!");
            return false;
        }
        else
        {
            if ($("input[name=sr]:checked").val()=="city" && $("#hotel").val()=="")
            {
                alert("Please select the hotel!");
                return false;
            }
            else if($('#arrv_date').is(':checked') == true)
            {
                if($('input[name=arrv-date-1]').val() == '' && $('input[name=arrv-date-2]').val() == '' )
                {
                    alert('Please input arrv date from');
                    setTimeout(function(){
                        $('input[name=arrv-date-1]').focus();
                    },1);
                    return false;
                }
            }
            else if($('#dept_date').is(':checked') == true)
            {
                if($('input[name=dept-date-1]').val() == '' && $('input[name=dept-date-2]').val() == '' )
                {
                    alert('Please input dept date from');
                    setTimeout(function(){
                        $('input[name=dept-date-1]').focus();
                    },1);
                    return false;
                }
            }
            {
                var dt = {};
                if($("#cb_locat").prop("checked"))
                {
                    dt.location = $("#location").val();
                }
                else
                {
                    dt.arrv_check = $('input:radio[name=arrv_radio]:checked').val();
                    dt.dept_check = $('input:radio[name=dept_radio]:checked').val();
                    dt.city = $("#city").val();
                    dt.hotel = $("#hotel").val();
                    dt.arrv_date_1 = $("input[name=arrv-date-1]").val();
                    dt.arrv_date_2 = $("input[name=arrv-date-2]").val();
                    dt.dept_date_1 = $("input[name=dept-date-1]").val();
                    dt.dept_date_2 = $("input[name=dept-date-2]").val();
                }
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_booking_report'); ?>",
                    async: true,
                    type: "POST",
                    data: dt,
                    beforeSend  : function () {
                        $("body").css("cursor" , "wait");
                    },
                    complete    : function () {
                        $("body").css("cursor" , "default");
                    },
                    dataType: "json",
                    success: function(data)
                    {
                        $('#div-booking-success').html('<table id="table-booking-success" class="cell-border"></table>');
                        var output = "";
                        output += "<thead style=' background-color:#2d6ca2;color: white; width:1151px;'>";
                        output	+= "<tr class='testRow' style='text-align:center;'>";
                        output	+= "<td style='width:110px' title='Tour Code'>Tour Code</td>";
                        output	+= "<td style='width:90px' title='VN Code'>VN Code</td>";
                        output	+= "<td style='width:111px' title='BKL Code'>BKL Code</td>";
                        output	+= "<td style='width:145px' title='Group Name'>Group Name</td>";
                        output	+= "<td style='width:65px' title='No.Per'>No.Per</td>";
                        output	+= "<td style='width:65px' title='Pax. No'>Pax. No</td>";
                        output	+= "<td style='width:90px' title='Arrival Date'>Arrival Date</td>";
                        output	+= "<td style='width:90px' title='Dept Date'>Dept Date</td>";
                        output	+= "<td style='width:70px' title='Nite No'>Nite No</td>";
                        output	+= "<td style='width:95px' title='Room Type'>Room Type</td>";
                        output	+= "<td style='width:110px' title='Room Class'>Room Class</td>";
                        output	+= "<td style='width:92px' title='Campaign'>Campaign</td>";
                        output	+= "</tr>";
                        output	+= "</thead>";
                        output	+= "<tbody style='width:1151px;'>";
                        $.each (data, function(key, opj) {
                            if (key=="msg")
                            {
                                if (opj=="false")
                                {
                                    $('#printHotel').attr("disabled",true);
                                    $('#printsuccess').attr("disabled",true);
                                    $('#cb_rtypesc').html("<option></option>");
                                    $('#cb_rclasssc').html("<option></option>");
                                    if($("#cb_locat").prop("checked")){
                                        $("#cb_rtypesc").val("");
                                        $("#cb_rclasssc").val("");
                                    }
                                    else{
                                        load_rtype();
                                        load_rclass();
                                    }
                                }
                                else
                                {
                                    $('#printHotel').attr("disabled",false);
                                    $('#printsuccess').attr("disabled",false);
                                    if($("#cb_locat").prop("checked")){
                                        $("#cb_rtypesc").val("");
                                        $("#cb_rclasssc").val("");
                                    }
                                    else{
                                        load_rtype();
                                        load_rclass();
                                    }
                                    $('#nitenosc').val("");
                                    $('#nitenocc').val("");
                                    $('#romnosc').val("");
                                    $('#romnocc').val("");
                                }
                            }
                            else
                            {
                                $.each (opj, function(key, row) {
                                    output += "";
                                    output += "<td title='"+((row["TourCode"]!==null)?row["TourCode"]:"")+"' style='width:110px;'>"+((row["TourCode"]!==null)?row["TourCode"]:"")+"</td>";
                                    output += "<td title='"+((row["VnCode"]!==null)?row["VnCode"]:"")+"' style='width:90px;'>"+((row["VnCode"]!==null)?row["VnCode"]:"")+"</td>";
                                    output += "<td title='"+((row["TLTCode"]!==null)?row["TLTCode"]:"")+"' style='width:111px;'>"+((row["TLTCode"]!==null)?row["TLTCode"]:"")+"</td>";
                                    output += "<td title='"+((row["GroupName"]!==null)?row["GroupName"]:"")+"' style='width:145px'>"+((row["GroupName"]!==null)?row["GroupName"]:"")+"</td>";
                                    output += "<td title='"+((row["NoPer"]!==null)?row["NoPer"]:"")+"' style='width:65px'>"+((row["NoPer"]!==null)?row["NoPer"]:"")+"</td>";
                                    output += "<td title='"+((row["PaxNo"]!==null)?row["PaxNo"]:"")+"' style='width:65px;'>"+((row["PaxNo"]!==null)?row["PaxNo"]:"")+"</td>";
                                    output += "<td title='"+((row["ArrvDate"]!==null)?row["ArrvDate"]:"")+"' style='width:90px;'>"+((row["ArrvDate"]!==null)?row["ArrvDate"]:"")+"</td>";
                                    output += "<td title='"+((row["DeptDate"]!==null)?row["DeptDate"]:"")+"' style='width:90px;'>"+((row["DeptDate"]!==null)?row["DeptDate"]:"")+"</td>";
                                    output += "<td title='"+((row["NiteNo"]!==null)?row["NiteNo"]:"")+"' style='width:70px'>"+((row["NiteNo"]!==null)?row["NiteNo"]:"")+"</td>";
                                    output += "<td title='"+((row["RoomType"]!==null)?row["RoomType"]:"")+"' style='width:95px'>"+((row["RoomType"]!==null)?row["RoomType"]:"")+"</td>";
                                    output += "<td title='"+((row["RoomClass"]!==null)?row["RoomClass"]:"")+"' style='width:110px'>"+((row["RoomClass"]!==null)?row["RoomClass"]:"")+"</td>";
                                    output += "<td title='"+((row["Cam_Code"]!==null)?row["Cam_Code"]:"")+"' style='width:92px'>"+((row["Cam_Code"]!==null)?row["Cam_Code"]:"")+"</td>";
                                    output += "</tr>";
                                    flag1 = flag1+1;
                                });
                            }
                        });
                        output	+= "</tbody>";
                        $('#table-booking-success').html(output);
                        $('#table-booking-success').DataTable({
                            paging: false,
                            responsive:true,
                            scrollY: 80,
                            scrollX: 2000,
                            order:[]
                        });
                        $('.dataTables_scrollHead').height(20);
                        $("body").css("cursor","");
                        $(".table-fixed").find("tr").css("cursor","default");
                    }
                });
                $.ajax({
                    url: "<?php echo base_url('HotelBookingController/get_booking_report_cancel'); ?>",
                    async: true ,
                    type: "POST",
                    data: dt,
                    dataType: "json",
                    beforeSend  : function () {
                        $("body").css("cursor" , "wait");
                    },
                    complete    : function () {
                        $("body").css("cursor" , "default");
                    },
                    success: function(data) {
                        $('#div-booking-canceled').html('<table id="table-booking-canceled" class="cell-border"></table>');
                        var output = "";
                        output += "<thead style=' background-color:#2d6ca2;color: white; width:1151px;'>";
                        output	+= "<tr class='testRow' style='text-align:center;'>";
                        output	+= "<td style='width:110px'>Tour Code</td>";
                        output	+= "<td style='width:90px'>VN Code</td>";
                        output	+= "<td style='width:111px'>BKL Code</td>";
                        output	+= "<td style='width:145px'>Group Name</td>";
                        output	+= "<td style='width:65px'>Pax. No</td>";
                        output	+= "<td style='width:90px'>Arrival Date</td>";
                        output	+= "<td style='width:90px'>Dept Date</td>";
                        output	+= "<td style='width:70px'>Nite No</td>";
                        output	+= "<td style='width:95px'>Room Type</td>";
                        output	+= "<td style='width:110px'>Room Class</td>";
                        output	+= "<td style='width:92px'>Campaign</td>";
                        output	+= "</tr>";
                        output	+= "</thead>";
                        output	+= "<tbody style='width:1151px;'>";
                        $.each (data, function(key, opj)
                        {
                            if (key==="msg")
                            {
                                if (opj==="false")
                                {
                                    $('#pritncancel').attr("disabled",true);
                                    $('#cb_rtypecancel').html("<option></option>");
                                    $('#cb_rclasscancel').html("<option></option>");
                                    if($("#cb_locat").prop("checked")){
                                        $("#cb_rtypecancel").val("");
                                        $("#cb_rclasscancel").val("");
                                    }
                                    else{
                                        load_rclass1();
                                        load_rtype1();
                                    }
                                }
                                else
                                {
                                    $('#pritncancel').attr("disabled",false);
                                    if($("#cb_locat").prop("checked")){
                                        $("#cb_rtypecancel").val("");
                                        $("#cb_rclasscancel").val("");
                                    }
                                    else{
                                        load_rclass1();
                                        load_rtype1();
                                    }
                                }
                            }
                            else
                            {
                                $.each (opj, function(key, row) {
                                    output += "";
                                    output += "<td style='width:110px;' title='"+((row["TourCode"]!==null)?row["TourCode"]:"")+"'>"+((row["TourCode"]!==null)?row["TourCode"]:"")+"</td>";
                                    output += "<td style='width:90px;'title='"+((row["VnCode"]!==null)?row["VnCode"]:"")+"'>"+((row["VnCode"]!==null)?row["VnCode"]:"")+"</td>";
                                    output += "<td style='width:111px;'title='"+((row["TLTCode"]!==null)?row["TLTCode"]:"")+"'>"+((row["TLTCode"]!==null)?row["TLTCode"]:"")+"</td>";
                                    output += "<td style='width:145px'title='"+((row["GroupName"]!==null)?row["GroupName"]:"")+"'>"+((row["GroupName"]!==null)?row["GroupName"]:"")+"</td>";
                                    output += "<td style='width:65px;'title='"+((row["PaxNo"]!==null)?row["PaxNo"]:"")+"'>"+((row["PaxNo"]!==null)?row["PaxNo"]:"")+"</td>";
                                    output += "<td style='width:90px;'title='"+((row["ArrvDate"]!==null)?row["ArrvDate"]:"")+"'>"+((row["ArrvDate"]!==null)?row["ArrvDate"]:"")+"</td>";
                                    output += "<td style='width:90px;'title='"+((row["DeptDate"]!==null)?row["DeptDate"]:"")+"'>"+((row["DeptDate"]!==null)?row["DeptDate"]:"")+"</td>";
                                    output += "<td style='width:70px'title='"+((row["NiteNo"]!==null)?row["NiteNo"]:"")+"'>"+((row["NiteNo"]!==null)?row["NiteNo"]:"")+"</td>";
                                    output += "<td style='width:95px'title='"+((row["RoomType"]!==null)?row["RoomType"]:"")+"'>"+((row["RoomType"]!==null)?row["RoomType"]:"")+"</td>";
                                    output += "<td style='width:110px'title='"+((row["RoomClass"]!==null)?row["RoomClass"]:"")+"'>"+((row["RoomClass"]!==null)?row["RoomClass"]:"")+"</td>";
                                    output += "<td style='width:92px'title='"+((row["Cam_Code"]!==null)?row["Cam_Code"]:"")+"'>"+((row["Cam_Code"]!==null)?row["Cam_Code"]:"")+"</td>";
                                    output += "</tr>";
                                    flag2 = flag2 +1;
                                });
                            }
                        });
                        output	+= "</tbody>";
                        $('#table-booking-canceled').html(output);
                        $('#table-booking-canceled').DataTable({
                            paging: false,
                            responsive:true,
                            scrollY: 80,
                            scrollX: 2000,
                            order:[]
                        });
                        $('.dataTables_scrollHead').height(35);
                        $(".table-fixed").find("tr").css("cursor","default");
                        //	alert(flag1);
                        if(flag1==0 && flag2==0)
                        {
                            window.alert("Data Not Found!!!");
                        }
                        else
                        {
                            flag1 = 0;
                            flag2 = 0;
                        }
                    }
                });
            }
        }
    }
    function select_location(){
        var location_radiobox =$("#cb_locat").is(':checked');
        if(location_radiobox==true){
            $('.chung').attr('disabled', 'true');
            $("#location").prop("disabled",false);
            $("#city").val("");
            $("#hotel").val("");
        }else{
            $('.chung').removeAttr("disabled");
        }
    }
    function select_city(){
        var city_radiobox =$("#cb_city").is(':checked');
        if(city_radiobox==true){
            $('.chung').removeAttr("disabled");
            $("#location").attr('disabled', 'true');
            $("#location").val("");
        }else{
            $('.chung').attr('disabled', 'true');
        }
    }
    /*click radio date event*/
    function click_arrv_date(){
        var check =$('#arrv_date').is(':checked');
        if(check==true){
            $('.chung1').removeAttr('disabled');
        }else{
            $('.chung1').attr('disabled', 'true');
        }
    }
    function click_dept_date(){
        var check =$('#dept_date').is(':checked');
        if(check==true){
            $('.chung2').removeAttr('disabled');
        }else{
            $('.chung2').attr('disabled', 'true');
        }
    }
    function clear_data(){
        $("#city").val("");
        $("#hotel").val("");
        $("#cb_rtypesc").html("");
        $("#cb_rclasssc").html("");
        $("#nitenosc").val("");
        $("#romnosc").val("");
        $("#cb_rtypecancel").html("");
        $("#cb_rclasscancel").html("");
        $("#nitenocc").val("");
        $("#romnocc").val("");
    }
    function  load_rtype()
    {
        var dt = {
            city			: 	$("#city").val(),
            hotel			: 	$("#hotel").val()
        };
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/load_rtype'); ?>",
            async: true,
            type: "POST",
            data: dt,
            dataType: "json",
            success: function(data)
            {
                var output ="";
                $.each (data, function(key, opj)
                {
                    output+=opj;
                    $('#cb_rtypesc').html(output);
                });
            }
        });
    }
    function  load_rtype1()
    {
        var dt = {
            city			: 	$("#city").val(),
            hotel			: 	$("#hotel").val()
        };
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/load_rtype'); ?>",
            async: true,
            type: "POST",
            data: dt,
            dataType: "json",
            success: function(data)
            {
                var output ="";
                $.each (data, function(key, opj)
                {
                    output+=opj;
                    $('#cb_rtypecancel').html(output);
                });
            }
        });
    }
    function  load_rclass()
    {
        var dt = {
            city			: 	$("#city").val(),
            hotel			: 	$("#hotel").val()
        };
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/load_rclass'); ?>",
            async: true,
            type: "POST",
            data: dt,
            dataType: "json",
            success: function(data)
            {
                var output ="";
                $.each (data, function(key, opj)
                {
                    output+=opj;
                    $('#cb_rclasssc').html(output);
                });
            }
        });
    }
    function  load_rclass1()
    {
        var dt = {
            city			: 	$("#city").val(),
            hotel			: 	$("#hotel").val()
        };
        $.ajax({
            url: "<?php echo base_url('HotelBookingController/load_rclass'); ?>",
            async: true,
            type: "POST",
            data: dt,
            dataType: "json",
            success: function(data)
            {
                var output ="";
                $.each (data, function(key, opj)
                {
                    output+=opj;
                    $('#cb_rclasscancel').html(output);
                });
            }
        });
    }
    function sum_niteno_paxno()
    {
        if($('#cb_rtypesc').val()!="" && $('#cb_rclasssc').val()!="")
        {
            var dt = {};
            if($("#cb_locat").prop("checked")) {
                dt.location = $("#location").val();
            } else {
                dt.arrv_check = $('input:radio[name=arrv_radio]:checked').val();
                dt.dept_check = $('input:radio[name=dept_radio]:checked').val();
                dt.city = $("#city").val();
                dt.hotel = $("#hotel").val();
                dt.arrv_date_1 = $("input[name=arrv-date-1]").val();
                dt.arrv_date_2 = $("input[name=arrv-date-2]").val();
                dt.dept_date_1 = $("input[name=dept-date-1]").val();
                dt.dept_date_2 = $("input[name=dept-date-2]").val();
                dt.cb_rtype    = $('#cb_rtypesc').val();
                dt.cb_rclas     = $("#cb_rclasssc").val();
            }
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/sum_niteno_paxno'); ?>",
                async: true,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data)
                {
                    $.each (data, function(key, opj)
                    {
                        if(key==="niteno")
                        {
                            $('#nitenosc').val(opj);
                        }
                        else
                        {
                            $('#romnosc').val(opj);
                        }
                    });
                }
            });
        }
    }
    function sum_niteno_paxno1()
    {
        if($('#cb_rclasscancel').val()!="" && $('#cb_rtypecancel').val()!="")
        {
            var dt = {};
            if($("#cb_locat").prop("checked")) {
                dt.location = $("#location").val();
            } else {
                dt.arrv_check = $('input:radio[name=arrv_radio]:checked').val();
                dt.dept_check = $('input:radio[name=dept_radio]:checked').val();
                dt.city = $("#city").val();
                dt.hotel = $("#hotel").val();
                dt.arrv_date_1 = $("input[name=arrv-date-1]").val();
                dt.arrv_date_2 = $("input[name=arrv-date-2]").val();
                dt.dept_date_1 = $("input[name=dept-date-1]").val();
                dt.dept_date_2 = $("input[name=dept-date-2]").val();
                dt.cb_rtype    = $('#cb_rtypecancel').val();
                dt.cb_rclas     = $("#cb_rclasscancel").val();
            }
            $.ajax({
                url: "<?php echo base_url('HotelBookingController/sum_niteno_paxno1'); ?>",
                async: true,
                type: "POST",
                data: dt,
                dataType: "json",
                success: function(data)
                {
                    $.each (data, function(key, opj)
                    {
                        if(key==="niteno1")
                        {
                            $('#nitenocc').val(opj);
                        }
                        else
                        {
                            $('#romnocc').val(opj);
                        }
                    });
                }
            });
        }
    }
</script>