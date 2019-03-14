<?php echo $this->load->view('Layout/header')?>

<div class="content">
	<div class="container">

		<div class="form-group">
			<h4 style="margin-top: 6px; margin-bottom: 0px;">
				Tour Detail
				<button class="btn btn-sm button-sm btn-primary"
					style="float: right;" onclick="back_home()">Back</button>
			</h4>

		</div>
		<div class="row line-strong" style="margin-top: 2px;"></div>
		<div class="row row-border" style="margin-bottom: 12px">
			<div class="title-row-div">
				<label class="title-row">Tour Detail</label>
			</div>
			<div class="col-md-3" style="margin-bottom: -10px">
				<div class="form-group form-inline form-margin-bottom">
					<!-- <div class="form-group"> -->
					<label class="label-item">Tour Code</label> <input type="text"
						id="tour-code" class="form-control input-sm select-size-md"
						value="<?php echo ($tour_info)?$tour_info[0]["TourCode"]:"" ?>"> <input
						type="hidden" value="<?php echo $type_sr;?>" id="type_search">
					<!-- </div> -->
				</div>
				<div class="form-group form-inline form-margin-bottom">
					<!-- <div class="form-group"> -->
					<label class="label-item">VN Code</label> <input type="text"
						id="vn-code" class="form-control input-sm select-size-md"
						value="<?php echo ($tour_info)?$tour_info[0]["VnCode"]:"" ?>">
					<!-- </div> -->
				</div>
				<div class="form-group form-inline form-margin-bottom">
					<!-- <div class="form-group"> -->
					<label class="label-item">Group Name</label> <input type="text"
						id="group-name" class="form-control input-sm select-size-md"
						value="<?php echo ($tour_info)?$tour_info[0]["GroupName"]:"" ?>">
					<!-- </div> -->
				</div>
			</div>
			<div class="col-md-3" style="margin-bottom: -10px">
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Status</label> <input type="text"
							id="group-name" class="form-control input-sm select-size-sm"
							value="<?php echo ($tour_info)?$tour_info[0]["TourStatus"]:"" ?>">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Campaign</label> <input type="text"
							id="campaign" class="form-control input-sm select-size"
							value="<?php if($campaign){echo $campaign[0]["Cam_Name"];}else{echo "";}?>">
					</div>
				</div>
				<div class="form-inline form-margin-bottom">
					<div class="form-group">
						<label class="label-item">Note</label> <input type="text"
							id="note" class="form-control select-size"
							value="<?php echo ($tour_info)?$tour_info[0]["Note"]:"" ?>">
					</div>
				</div>
			</div>
			<div class="col-md-3" style="margin-bottom: -10px">
				<div class="form-margin-bottom">
					<div class="form-group">
						<div class="list-scroll" style="height: 80px; width: 220px;">
							<table class="table table-fixed">
								<thead style="">
									<tr>
										<td style="width: 20px"></td>
										<td style='width: 200px'>Guest Name</td>
									</tr>
								</thead>
								<tbody style="width: 286px; height: 80%">
									<?php
        if ($guest) {
            foreach ($guest as $row) {
                ?>
											<tr>
										<td style="width: 20px"><div
												class="glyphicon glyphicon-play icon-edit"></div></td>
										<td style='width: 200px'><?php echo $row["GuestName"]; ?></td>
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
		<div class="row row-border">
			<div class="title-row-div">
				<label class="title-row">Booking Detail</label>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-inline form-margin-bottom col-md-3">
						<div class="form-group">
							<label>BKL Code</label>
                                                        <?php if($booking){?>
                                                        <input
								type="text" id="bkl-code" class="form-control select-size"
								value="<?php echo $booking[0]['TLTCode'];?>">
                                                        <?php }else{?>
                                                        <input
								type="text" id="bkl-code" class="form-control select-size"
								value="   ">
                                                        <?php }?>
						</div>
					</div>
					<div class="form-inline col-md-3">
						<label>City</label>
                                              <?php if($booking){?>
						<input type="text" id="city"
							class="form-control input-sm select-size"
							value="<?php echo $booking[0]['City'];?>">
                                              <?php }else{?>
                                                <input type="text"
							id="city" class="form-control input-sm select-size" value="">
                                              <?php }?>
					</div>
					<div class="form-inline col-md-3">
						<label>Hotel</label>
                                             <?php if($booking){?>
						<input type="text" id="hotel"
							class="form-control input-sm select-size"
							value="<?php echo $booking[0]['Hotel'];?>">
                                             <?php }else{?>
                                                <input type="text"
							id="hotel" class="form-control input-sm select-size" value="">
                                             <?php }?>
					</div>
					<div class="form-inline form-margin-bottom col-md-3">
						<div class="form-group">
							<label>Note</label>
                                                        <?php if($booking){?>
							<input type="text" class="form-control select-size"
								value="<?php echo $booking[0]['Note'];?>" id="note-bk">
                                                        <?php }else{?>
                                                        <input
								type="text" class="form-control select-size" value=""
								id="note-bk">
                                                        <?php }?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row-border">
						<div class="title-row-div">
							<label class="title-row">From</label>

						</div>
                                                <?php if($booking){?>
                                                <input
							class="form-control" type="text"
							value="<?php echo $booking[0]['VNFlight1'];?>" id="from-hcm">
                                                <?php }else{?>
                                                <input
							class="form-control" type="text" value="" id="from-hcm">
                                                <?php }?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row-border">
						<div class="title-row-div">
							<label class="title-row">Back</label>
						</div>
                                            <?php if( !empty($booking) and $booking[0]['VNFlight2']){?>
                                            <input class="form-control"
							type="text" value="<?php echo $booking[0]['VNFlight2'];?>"
							id="back-hcm">
                                            <?php }else{?>
                                            <input class="form-control"
							type="text" value="" id="back-hcm">
                                            <?php }?>   
					</div>
				</div>
			</div>

			<div class="row-border" style="border-color: #4aa9ff">
				<div class="title-row-div">
					<label class="title-row">Stage 1</label>
				</div>
				<div class="row form-inline form-margin-bottom"
					style="background-color: #f0f8ff; margin: 0px;">
					<div class="col-md-12" style="margin-bottom: 5px;">
						<div class="form-group">
							<label class="label-item-1">Arr Date</label>
                                                        <?php if($booking){?>
                                                        <input
								type="text" class="form-control input-sm" id="arrv-date-1"
								value="<?php echo $booking[0]['ArrvDate1'];?>">
                                                        <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="arrv-date-1"
								value="">
                                                        <?php }?>
		  				</div>
						<div class="form-group">
							<label class="label-item-1">Dept Date</label>
                                                <?php if(!empty($booking)){?>
                                                <input type="text"
								class="form-control  input-sm" id="dept-date-1"
								value="<?php echo $booking[0]['DeptDate1'];?>">
                                                <?php }else{?> 
                                                   <input type="text"
								class="form-control  input-sm" id="dept-date-1">
                                                <?php }?>
		  				</div>
						<div class="form-group form-inline">
							<label class="label-item-md">Night No</label>
                                                <?php if(!empty($booking) and $booking[0]['NiteNo1']){?>
                                                    <input type="text"
								size=1 id="nite-no-1"
								value="<?php echo $booking[0]['NiteNo1'];?>">
                                                <?php }else{?> 
                                                    <input type="text"
								size=1 id="nite-no-1" value="">
                                                <?php }?>    
						</div>
						<div class="form-group form-inline">
							<label class="label-item-1">Pax No</label>
                                                <?php if(!empty($booking) and $booking[0]['PaxNo1']){?>        
                                                    <input type="text"
								size=1 id="pax-no-1" value="<?php echo $booking[0]['PaxNo1'];?>">
                                                <?php }else{?> 
                                                    <input type="text"
								size=1 id="pax-no-1">
                                                <?php }?> 
						</div>
						<div class="form-group form-inline">
							<label class="label-item-md">Edition Fee</label>
                                                <?php if($booking){?>        
                                                        <input
								type="text" class="form-control input-sm" id="holiday-no-1"
								value="<?php if($booking[0]['HoilidaySum1']!=""&&$booking[0]['HoilidaySum1']!="NULL")echo $booking[0]['HoilidaySum1'];?>"
								disabled="true">
                                                <?php }else{?> 
                                                        <input
								type="text" class="form-control input-sm" id="holiday-no-1"
								value="" disabled="true">
                                                 <?php }?>
						</div>
						<div class="form-group">
							<label class="label-item-1"
								style="margin-left: 10px; margin-bottom: 10px;">Note</label>
                                                <?php if(!empty($booking) and $booking[0]['Note1']){?>
                                                <input id="note-1"
								rows="1" style="margin-top: 6px; width: 450px;"
								value="<?php echo $booking[0]['Note1'];?>" />
		    				<?php }else{?> 
                                                <input id="note-1"
								rows="1" style="margin-top: 6px; width: 450px;" />
                                                <?php }?> 
		  				</div>
					</div>
					<div class="col-md-12" style="margin-bottom: 5px;">
						<div class="form-group">
							<label class="label-item-1">R/No</label>
                                                        <?php if(!empty($booking) and $booking[0]['RoomNo1']){?>
                                                        <input
								type="text" class="form-control input-sm" id="r-no-1"
								value="<?php echo $booking[0]['RoomNo1'];?>">
                                                        <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="r-no-1" value="">
                                                        <?php }?>
						</div>
						<div class="form-group">
							<label class="label-item-1">R/Type</label>
                                                        <?php if(!empty($booking) and $booking[0]['RoomType1']){?>
                                                        <input
								type="text" class="form-control input-sm" id="r-type-1"
								value="<?php echo $booking[0]['RoomType1'];?>">
                                                        <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="r-type-1" value="">
                                                        <?php }?>
						</div>
						<div class="form-group ">
							<label class="label-item-1">R/Class</label>
                                                        <?php if(!empty($booking) and $booking[0]['RoomClass1']){?>
                                                        <input
								type="text" id="r-class-1" class="form-control input-sm"
								value="<?php echo $booking[0]['RoomClass1'];?>">
                                                        <?php }else{?>
                                                        <input
								type="text" id="r-class-1" class="form-control input-sm"
								value="">
                                                        <?php }?>
						</div>
						<div class="form-group ">
							<label class="label-item-sm" style="margin-left: 5px;">Allotment</label>
                                                        <?php if(!empty($booking) and $booking[0]['Allotment1']){?>
                                                        <input
								type="checkbox" name="allotment" style="margin-left: 17px;"
								checked="true" disabled id="checkbox-allotment-1">
                                                        <?php }else{?>
                                                        <input
								type="checkbox" name="allotment" style="margin-left: 17px;"
								disabled id="checkbox-allotment-1">
                                                        <?php }?>
						</div>
						<div class="form-group">
							<label class="label-item-1">Status</label>
                                                        <?php if(!empty($booking) and $booking[0]['HotelStatus1']){?>
                                                        <input
								type="text" class="form-control input-sm" id="hotel-status-1"
								value="<?php echo $booking[0]['HotelStatus1'];?>">
                                                        <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="hotel-status-1">
                                                        <?php }?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="label-item-1">SPE</label> <input type="text"
								class="form-control input-sm" id="class-name-1"
								style="height: 25px; width: 200px;">
						</div>
						<div class="form-group">
							<label class="label-item-1">Transfer Stage </label>
                                                    <?php if(!empty($booking) and $booking[0]['Transfer_price1']){?>
                                                        <input
								type="text" class="form-control input-sm" id="transfer-price-1"
								style="height: 25px; width: 200px;"
								value="<?php echo $booking[0]['Transfer_price1'];?>">
                                                    <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="transfer-price-1"
								style="height: 25px; width: 200px;">
                                                    <?php }?>
						</div>
						<div class="form-group">
							<label class="label-item-1">Check Out</label>
                                                        <?php if(!empty($booking) and $booking[0]['CheckOut1']){?>
                                                        <input
								type="text" class="form-control input-sm" id="check-out-1"
								style="height: 25px; width: 400px;"
								value="<?php echo $booking[0]['CheckOut1'];?>">
                                                        <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="check-out-1"
								style="height: 25px; width: 400px;" value="">
                                                        <?php }?>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="padding: 5px 0px;">
				<div class="col-md-2" style="padding-right: 0px">
					<label class="label-item-1">Room List Stage 1</label>
				</div>
				<div class="col-md-4" style="padding-left: 0px; text-align: left">
                                    <?php if($RoomList1){?>
                                        <input type="text"
						class="form-control" value="<?php echo $RoomList1;?>" readonly
						id="room-list-1">
                                    <?php }else{?>
                                        <input type="text"
						class="form-control" value="" readonly id="room-list-1">
                                    <?php }?>
				</div>
				<div class="col-md-2" style="padding: 0px">
					<label class="label-item-1">Room List Stage 2</label>
				</div>
				<div class="col-md-4">
                                    <?php if($RoomList2){?>
		  			<input type="text" class="form-control"
						value="<?php echo $RoomList1;?>" disabled="true" readonly
						id="room-list-2">
                                    <?php }else{?>
                                        <input type="text"
						class="form-control" value="" readonly id="room-list-2">
                                    <?php }?>   
                                       
				</div>
			</div>
			<div class="row-border"
				style="border-color: #5151ff; margin-bottom: 7px;">
				<div class="title-row-div">
					<label class="title-row">Stage 2</label>
				</div>
				<div class="row form-inline form-margin-bottom"
					style="background-color: #f8f8ff; margin: 0px;">
					<div class="col-md-12" style="margin-bottom: 5px;">
						<div class="form-group">
							<label class="label-item-1">Arr Date</label>
                                                <?php if(!empty($booking) and $booking[0]['ArrvDate2']){ ?>
                                                <input type="text"
								class="form-control input-sm" id="arrv-date-2"
								value="<?php echo $booking[0]['ArrvDate2'];?>">
                                                <?php }else{?>
                                                <input type="text"
								class="form-control input-sm" id="arrv-date-2">
                                                <?php }?>
                                                
		  				</div>
						<div class="form-group">
							<label class="label-item-1">Dept Date</label>
                                                <?php if(!empty($booking) and $booking[0]['DeptDate2']){ ?>
                                                   <input type="text"
								class="form-control  input-sm" id="dept-date-2"
								value="<?php echo $booking[0]['DeptDate2'];?>">
                                                <?php }else{?>
                                                   <input type="text"
								class="form-control  input-sm" id="dept-date-2">
                                                <?php }?>   
		  				</div>
						<div class="form-group form-inline">
							<label class="label-item-1">Night No</label>
                                                <?php if(!empty($booking) and $booking[0]['NiteNo2']){ ?>
                                                    <input type="text"
								size=1 id="nite-no-2"
								value="<?php echo $booking[0]['NiteNo2'];?>">
                                                <?php }else{?>
                                                    <input type="text"
								size=1 id="nite-no-2">
                                                <?php }?>          
						</div>
						<div class="form-group form-inline">
							<label class="label-item-1">Pax No</label>
                                                <?php if(!empty($booking) and $booking[0]['PaxNo2']){ ?>        
                                                        <input
								type="text" size=1 id="pax-no-2"
								value="<?php echo $booking[0]['PaxNo2'];?>">
                                                <?php }else{?>
                                                    <input type="text"
								size=1 id="pax-no-2">
                                                <?php }?>        
						</div>
						<div class="form-group form-inline">
							<label class="label-item-md">Edition Fee</label>
                                                <?php if(!empty($booking) and $booking[0]['HoilidaySum2']){ ?> 
                                                        <input
								type="text" class="form-control input-sm" id="holiday-no-2"
								value="<?php echo $booking[0]['HoilidaySum2'];?>"
								disabled="true">
                                                <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="holiday-no-2"
								disabled="true" value="0">
                                                <?php }?>        
						</div>
						<div class="form-group">
							<label class="label-item-1"
								style="margin-left: 10px; margin-bottom: 10px;">Note</label>
                                                <?php if(!empty($booking) and $booking[0]['Note2']){ ?>  
                                                <input id="note-2"
								rows="1" style="margin-top: 6px; width: 450px;"
								value="<?php echo $booking[0]['Note2'];?>" />
                                                <?php }else{?>
                                                    <input id="note-2"
								rows="1" style="margin-top: 6px; width: 450px;" />
                                                <?php }?>    
		  				</div>
					</div>
					<div class="col-md-12" style="margin-bottom: 5px;">
						<div class="form-group">
							<label class="label-item-1">R/No</label>
                                                <?php if(!empty($booking) and $booking[0]['RoomNo2']){ ?>        
                                                        <input
								type="text" class="form-control input-sm" id="r-no-2"
								value="<?php echo $booking[0]['RoomNo2'];?>">
                                                <?php }else{?>
                                                    <input type="text"
								class="form-control input-sm" id="r-no-2">
                                                <?php }?>    
						</div>
						<div class="form-group">
							<label class="label-item-1">R/Type</label>
                                                <?php if(!empty($booking) and $booking[0]['RoomType2']){ ?>        
                                                        <input
								type="text" class="form-control input-sm" id="r-type-2"
								value="<?php echo $booking[0]['RoomType2'];?>">
                                                <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="r-type-2">
                                                <?php }?>         
						</div>
						<div class="form-group ">
							<label class="label-item-1">R/Class</label>
                                                <?php if(!empty($booking) and $booking[0]['RoomClass2']){ ?>        
                                                        <input
								type="text" id="r-class-2" class="form-control input-sm"
								value="<?php echo $booking[0]['RoomClass2'];?>">
                                                <?php }else{?>
                                                        <input
								type="text" id="r-class-2" class="form-control input-sm">
                                                <?php }?>        
						</div>
						<div class="form-group ">
							<label class="label-item-sm" style="margin-left: 5px;">Allotment</label>
                                                <?php if(!empty($booking) and $booking[0]['Allotment2']){ ?>  
                                                        <input
								type="checkbox" name="allotment" style="margin-left: 17px;"
								checked="true" disabled="true" id="checkbox-allotment-2">
                                                <?php }else{?>
                                                        <input
								type="checkbox" name="allotment" style="margin-left: 17px;"
								disabled="true" id="checkbox-allotment-2">
                                                <?php }?>        
						</div>
						<div class="form-group">
							<label class="label-item-1">Status</label>
                                                <?php if(!empty($booking) and $booking[0]['Allotment2']){ ?>          
                                                        <input
								type="text" class="form-control input-sm" id="hotel-status-2"
								value="<?php echo $booking[0]['Allotment2'];?>">
                                                <?php }else{?>
                                                        <input
								type="text" class="form-control input-sm" id="hotel-status-2">
                                                <?php }?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="label-item-1">SPE</label> <input type="text"
								class="form-control input-sm" id="class-name-2"
								style="height: 25px; width: 200px;">


							<div class="form-group">
								<label class="label-item-1">Transfer Stage 2</label>
                                                        <?php if(!empty($booking) and $booking[0]['Transfer_price1']){?>
                                                        <input
									type="text" class="form-control input-sm" id="transfer-price-2"
									style="height: 25px; width: 200px;"
									value="<?php echo $booking[0]['Transfer_price2'];?>">
                                                        <?php }else{?>
                                                        <input
									type="text" class="form-control input-sm" id="transfer-price-2"
									style="height: 25px; width: 200px;">
                                                        <?php }?>
						</div>
							<div class="form-group">
								<label class="label-item-1">Check Out</label>
                                                        <?php if(!empty($booking) and $booking[0]['CheckOut2']){?>
                                                        <input
									type="text" class="form-control input-sm" id="check-out-2"
									style="height: 25px; width: 400px;"
									value="<?php echo $booking[0]['CheckOut2'];?>">
                                                        <?php }else{?>
                                                        <input
									type="text" class="form-control input-sm" id="check-out-2"
									style="height: 25px; width: 400px;" value="">
                                                        <?php }?>
						</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row row-border">
						<div class="title-row-div">
							<label class="title-row">Booking list</label>
						</div>
						<div class="list-scroll" style="height: 90px;">
							<table class="table table-bordered table-template"
								id="table-booking-info"
								style="max-width: 120%; width: 100%; font-size: 11px">
								<thead>
									<th style="width: 130px">BKL Code</th>
									<th style="width: 80px">City</th>
									<th style="width: 80px">Hotel</th>
									<th style="width: 80px">Arrv Date</th>
									<th style="width: 80px">Dept Date</th>
									<th style="width: 50px">Nite. No</th>
									<th style="width: 50px">Pax No</th>
									<th style="width: 50px">Check Out</th>
									<th style="width: 80px">Room Type</th>
									<th style="width: 50px">Status</th>
								</thead>
								<tbody>
								<?php
        if ($booking) {
            $key = 1;
            foreach ($booking as $row) {
                ?>
											<tr id="row-booking-<?php echo $key;?>"
										onclick="show_info(<?php echo $key;?>)">
										<td style="width: 130px"><?php echo $row['TLTCode']?></td>
										<td style="width: 80px"><?php echo $row['City']?></td>
										<td style="width: 80px"><?php echo substr($row['Hotel'],0,20);?></td>
										<td style="display: none;"><?php echo $row['Note']?></td>
										<td style="display: none;"><?php echo $row['VNFlight1']?></td>
										<td style="display: none;"><?php echo $row['VNFlight1DeptDate']?></td>
										<td style="display: none;"><?php echo $row['VNFlight1DeptTime']?></td>
										<td style="display: none;"><?php echo $row['VNFlight2']?></td>
										<td style="display: none;"><?php echo $row['VNFlight2DeptDate']?></td>
										<td style="display: none;"><?php echo $row['VNFlight2DeptTime']?></td>
										<td style="display: none;"><?php echo $row['VNFlight2ArrvTime']?></td>

										<!-- Stage1 -->
										<td style="width: 80px"><?php echo $row['ArrvDate1']?></td>
										<td style="width: 80px"><?php echo $row['DeptDate1']?></td>
										<td style="width: 50px"><?php echo $row['NiteNo1']?></td>
										<td style="width: 50px"><?php echo $row['PaxNo1']?></td>
										<td style="width: 50px"><?php echo $row['CheckOut1']?></td>
										<td style="display: none;"><?php echo $row['RoomNo1']?></td>
										<td style="width: 80px"><?php echo $row['RoomType1']?></td>
										<td style="display: none;"><?php echo $row['RoomClass1']?></td>
										<td style="display: none;"><?php echo $row['Allotment1']?></td>
										<td style="width: 50px"><?php echo $row['HotelStatus1']?></td>
										<td style="display: none;"><?php echo $row['Note1']?></td>
										<td style="display: none;"><?php echo $row['Room_List1']?></td>
										<!-- Stage 2 -->
										<td style="display: none;"><?php echo $row['ArrvDate2']?></td>
										<td style="display: none;"><?php echo $row['DeptDate2']?></td>
										<td style="display: none;"><?php echo $row['NiteNo2']?></td>
										<td style="display: none;"><?php echo $row['PaxNo2']?></td>
										<td style="display: none;"><?php echo $row['CheckOut2']?></td>
										<td style="display: none;"><?php echo $row['Room_List2']?></td>
										<td style="display: none;"><?php echo $row['RoomNo2']?></td>
										<td style="display: none;"><?php echo $row['RoomType2']?></td>
										<td style="display: none;"><?php echo $row['RoomClass2']?></td>
										<td style="display: none;"><?php echo $row['Allotment2']?></td>
										<td style="display: none;"><?php echo $row['HotelStatus2']?></td>
										<td style="display: none;"><?php echo $row['Note2']?></td>
										<td style="display: none;"><?php echo $row['Transfer_price1']?></td>
										<td style="display: none;"><?php echo $row['Transfer_price2']?></td>
										<td style="display: none;"><?php echo $row['SPE1']?></td>
										<td style="display: none;"><?php echo $row['HoilidaySum1']?></td>
										<td style="display: none;"><?php echo $row['SPE2']?></td>
										<td style="display: none;"><?php echo $row['HoilidaySum2']?></td>
										<td style="display: none;"><?php echo $row['LC1']?></td>
										<td style="display: none;"><?php echo $row['LC2']?></td>
									</tr>
										<?php
                $key ++;
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
	<script type="text/javascript">
	$(document).ready(function(){
		//All input are readonly
		var n = $("#table-booking-info > tbody tr").length;
		if(n>0)
		{
			show_info(1);
		}
		$("input").attr("readonly", "true");
		var onSampleResized = function(e){
			var columns = $(e.currentTarget).find("th");
		};	

		$("#table-booking-info").colResizable({
			liveDrag:true,
			draggingClass:"dragging", 
			onResize:onSampleResized});
		$(".table-template").find("tr").css("cursor","default");
		$(".table-template").tablesorter();		
	});
function show_info(key)
{
	$("#table-booking-info").find("tr").css("background","transparent");
	$("#row-booking-"+key).css("background","#397FDB");
	var RList1; var RList2;
	if($("#row-booking-"+key+" td:nth-child(1)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(1)").html()!="")
	{
		$("#bkl-code").val($("#row-booking-"+key+" td:nth-child(1)").html());
	}
	else
	{
		$("#bkl-code").val("");
	}	

	if($("#row-booking-"+key+" td:nth-child(2)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(2)").html()!="")
	{
		$("#city").val($("#row-booking-"+key+" td:nth-child(2)").html());
	}
	else
	{
		$("#city").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(3)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(3)").html()!="")
	{
		$("#hotel").val($("#row-booking-"+key+" td:nth-child(3)").html());
	}
	else
	{
		$("#hotel").val("");
	}	

	if($("#row-booking-"+key+" td:nth-child(4)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(4)").html()!="")
	{
		$("#note-bk").val($("#row-booking-"+key+" td:nth-child(4)").html());
	}
	else
	{
		$("#note-bk").val("");
	}	
	/*from hcm*/
	if($("#row-booking-"+key+" td:nth-child(5)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(5)").html()!="")
	{
		$("#from-hcm").val($("#row-booking-"+key+" td:nth-child(5)").html());
	}
	else
	{
		$("#from-hcm").val("");
	}	
	/*back hcm*/
	if($("#row-booking-"+key+" td:nth-child(8)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(8)").html()!="")
	{
		$("#back-hcm").val($("#row-booking-"+key+" td:nth-child(8)").html());
	}
	else
	{
		$("#back-hcm").val("");
	}
	/*stage 1*/
	if($("#row-booking-"+key+" td:nth-child(12)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(12)").html()!="")
	{
		$("#arrv-date-1").val($("#row-booking-"+key+" td:nth-child(12)").html());
	}
	else
	{
		$("#arrv-date-1").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(13)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(13)").html()!="")
	{
		$("#dept-date-1").val($("#row-booking-"+key+" td:nth-child(13)").html());
	}
	else
	{
		$("#dept-date-1").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(14)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(14)").html()!="")
	{
		$("#nite-no-1").val($("#row-booking-"+key+" td:nth-child(14)").html());
	}
	else
	{
		$("#nite-no-1").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(15)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(15)").html()!="")
	{
		$("#pax-no-1").val($("#row-booking-"+key+" td:nth-child(15)").html());
	}
	else
	{
		$("#pax-no-1").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(16)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(16)").html()!="")
	{
		$("#check-out-1").val($("#row-booking-"+key+" td:nth-child(16)").html());
	}
	else
	{
		$("#check-out-1").val("");
	}

	RList1 = $("#row-booking-"+key+" td:nth-child(23)").html();
	if(RList1!="")
	{
		$("#room-list-1").val(RList1);
	}

	if(RList1=="")
	{
		if($("#row-booking-"+key+" td:nth-child(17)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(17)").html()!="")
		{
			$("#r-no-1").val($("#row-booking-"+key+" td:nth-child(17)").html());
		}
		else
		{
			$("#r-no-1").val("");
		}

		if($("#row-booking-"+key+" td:nth-child(18)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(18)").html()!="")
		{
			$("#r-type-1").val($("#row-booking-"+key+" td:nth-child(18)").html());
		}
		else
		{
			$("#r-type-1").val("");
		}
		
		if($("#row-booking-"+key+" td:nth-child(19)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(19)").html()!="")
		{
			$("#r-class-1").val($("#row-booking-"+key+" td:nth-child(19)").html());
		}
		else
		{
			$("#r-class-1").val("");
		}		
	}
	
	var s1_Al1 = $("#row-booking-"+key+" td:nth-child(20)").html();
	if(s1_Al1!="")
	{
		$("#checkbox-allotment-1").prop("checked",true);
	}
	else
	{
		$("#checkbox-allotment-1").prop("checked",false);
	}

	if($("#row-booking-"+key+" td:nth-child(21)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(21)").html()!="")
	{
		$("#hotel-status-1").val($("#row-booking-"+key+" td:nth-child(21)").html());
	}
	else
	{
		$("#hotel-status-1").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(22)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(22)").html()!="")
	{
		$("#note-1").val($("#row-booking-"+key+" td:nth-child(22)").html());
	}
	else
	{
		$("#note-1").val("");
	}
	/*stage 2*/ 
	if($("#row-booking-"+key+" td:nth-child(24)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(24)").html()!="")
	{
		$("#arrv-date-2").val($("#row-booking-"+key+" td:nth-child(24)").html());
	}
	else
	{
		$("#arrv-date-2").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(25)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(25)").html()!="")
	{
		$("#dept-date-2").val($("#row-booking-"+key+" td:nth-child(25)").html());
	}
	else
	{
		$("#dept-date-2").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(26)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(26)").html()!="")
	{
		$("#nite-no-2").val($("#row-booking-"+key+" td:nth-child(26)").html());
	}
	else
	{
		$("#nite-no-2").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(27)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(27)").html()!="")
	{
		$("#pax-no-2").val($("#row-booking-"+key+" td:nth-child(27)").html());
	}
	else
	{
		$("#pax-no-2").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(28)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(28)").html()!="")
	{
		$("#check-out-2").val($("#row-booking-"+key+" td:nth-child(28)").html());
	}
	else
	{
		$("#check-out-2").val("");
	}	

	RList2 = $("#row-booking-"+key+" td:nth-child(29)").html();
	if(RList2!="")
	{
		$("#room-list-2").val(RList2);
	}
	if(RList2=="")
	{
		if($("#row-booking-"+key+" td:nth-child(30)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(30)").html()!="")
		{
			$("#r-no-2").val($("#row-booking-"+key+" td:nth-child(30)").html());
		}
		else
		{
			$("#r-no-2").val("");
		}	

		if($("#row-booking-"+key+" td:nth-child(31)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(31)").html()!="")
		{
			$("#r-type-2").val($("#row-booking-"+key+" td:nth-child(31)").html());
		}
		else
		{
			$("#r-type-2").val("");
		}

		if($("#row-booking-"+key+" td:nth-child(32)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(32)").html()!="")
		{
			$("#r-class-2").val($("#row-booking-"+key+" td:nth-child(32)").html());
		}
		else
		{
			$("#r-class-2").val("");
		}		
	}
	var s2_Al2 = $("#row-booking-"+key+" td:nth-child(33)").html();
	if(s2_Al2!="")
	{
		$("#checkbox-allotment-2").prop("checked",true);
	}
	else
	{
		$("#checkbox-allotment-2").prop("checked",false);
	}

	if($("#row-booking-"+key+" td:nth-child(34)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(34)").html()!="")
	{
		$("#hotel-status-2").val($("#row-booking-"+key+" td:nth-child(34)").html());
	}
	else
	{
		$("#hotel-status-2").val("");
	}	

	if($("#row-booking-"+key+" td:nth-child(35)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(35)").html()!="")
	{
		$("#note-2").val($("#row-booking-"+key+" td:nth-child(35)").html());
	}
	else
	{
		$("#note-2").val("");
	}	

	if($("#row-booking-"+key+" td:nth-child(36)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(36)").html()!="")
	{
		var tf_price = "";
		var dt = {
			transfer_price : $("#row-booking-"+key+" td:nth-child(36)").html()
		};
		 $.ajax({                
                url: "<?php echo base_url('TransferController/GetContant'); ?>",
                type: "POST", 
                async: false,
                data: dt, 
                dataType: "json",              
                success: function(data) 
                {
                	tf_price = data.ct;
                }
         });
         $("#transfer-price-1").val(tf_price);
	}
	else
	{
		$("#transfer-price-1").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(37)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(37)").html()!="")
	{
		var tf_price = "";
		var dt = {
			transfer_price : $("#row-booking-"+key+" td:nth-child(37)").html()
		};
		 $.ajax({                
                url: "<?php echo base_url('TransferController/GetContant'); ?>",
                type: "POST", 
                async: false,
                data: dt, 
                dataType: "json",              
                success: function(data) 
                {
                	tf_price = data.ct;
                }
         });
         $("#transfer-price-2").val(tf_price);
	}
	else
	{
		$("#transfer-price-2").val("");
	}

	if($("#row-booking-"+key+" td:nth-child(39)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(39)").html()!="")
	{
		$("#holiday-no-1").val($("#row-booking-"+key+" td:nth-child(39)").html());
	}
	else
	{
		$("#holiday-no-1").val("");
	}	

	if($("#row-booking-"+key+" td:nth-child(41)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(41)").html()!="")
	{
		$("#holiday-no-2").val($("#row-booking-"+key+" td:nth-child(41)").html());
	}
	else
	{
		$("#holiday-no-2").val("");
	}	

	if($("#row-booking-"+key+" td:nth-child(42)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(42)").html()!="")
	{
		var CName1 = $("#row-booking-"+key+" td:nth-child(42)").html();	
		CName1   = CName1.substr(CName1.lastIndexOf("-")+1);
		$("#class-name-1").val(CName1);
	}

	if($("#row-booking-"+key+" td:nth-child(43)").html()!="NULL"&&$("#row-booking-"+key+" td:nth-child(43)").html()!="")
	{
		var CName1 = $("#row-booking-"+key+" td:nth-child(43)").html();	
		CName1   = CName1.substr(CName1.lastIndexOf("-")+1);
		$("#class-name-2").val(CName1);
	}

}
function back_home()
{
    location.href ="<?php echo base_url('/hotel-booking');?>?sr_bk="+$("#type_search").val();
}
</script>
	<style type="text/css">
/*.label-item
	{
		width:auto;
	}*/
.form-inline .form-group {
	margin: 0px 5px
}

input[type=text] {
	height: 25px;
	font-size: 12px;
}

.title-row-div {
	height: 20px;
}

label {
	font-size: 12px;
}

.row-border {
	margin-top: 12px;
}
/*#table-booking-info tr td, #table-booking-info tr th
	{
		height: 25px !important;
		padding: 1px;
		text-align: center;
		width: 70px
	}*/

/*.dataTables_info
	{
		display: none;
	}
	#table-booking-info_filter
	{
		display: none;
	}
	#table-booking-info thead
	{
		display: none;
	}
	td.sorting
	{
		padding: 0px !important;
		height: 22px;
	}
	td.sorting_asc
	{
		padding: 0px !important;
		height: 22px;
	}
	.dataTables_scrollHead
	{
		height: 25px
	}
	.list-scroll table
	{
		width:100% !important;
	}
	.dataTables_scrollHeadInner
	{
		width: 100% !important
	}*/
</style>