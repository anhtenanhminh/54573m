<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TransferController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
		} else {
			redirect('AuthenController/index');
		}     
		$this->load->model('GuestModel','Guest');
		$this->load->model('OptionalTourModel');                
		$this->load->model('HotelBookingModel','hotel');
	}
	public function update_tour_information()
	{		
		if($this->session->userdata('search_tourinfo')!==false)
		{
			$data['search_tourinfo'] = $this->session->userdata('search_tourinfo');	
			$where = array(
					"TourCode"  => $data['search_tourinfo']["tourcode"]
				);			
			$db_tourinfo = $this->TransferModel->get_where_table("tourinfo",$where);						
			$data["tour_id"] = $db_tourinfo[0]["TourID"];
			$this->session->unset_userdata('search_tourinfo');
		}
		elseif($this->input->get('id')){
			$data["tour_id"] = $this->input->get('id');
			$where = array(
					"TourID"  => $data['tour_id']
				);
			$db_tourinfo = $this->TransferModel->get_where_table("tourinfo",$where);
			if(count($db_tourinfo)>0){
				$data["tour_code"] = $db_tourinfo[0]["TourCode"];
			}
		}

		$data['tranferguest']="";
		$data["tourinfo"] ="";
		$data["booking"] ="";
		$data["guest"]="";
		$data['message'] = false;
		$data['TourCode'] = false;
		$data["city"]=$this->TransferModel->get_city();
		if($this->session->flashdata("success"))
		{
			$data['message'] = $this->session->flashdata("success");
		}
		if($this->session->flashdata("TourCode"))
		{
			$data['TourCode'] = $this->session->flashdata("TourCode");
		}
		$this->load->view('Transfer_Management/formUpdateTourInformation',$data);		
	}

	public function in_transfer()
	{	
		//Dương- lấy dữ liệu search cũ
		if($this->session->userdata('search_condition')!== FALSE)
		{
			$data['search_condition'] = $this->session->userdata('search_condition');
			$this->session->unset_userdata('search_condition');
		}
		if($this->session->userdata('search_in')!==false)
		{
			$data['search_in'] = $this->session->userdata('search_in');			
			$this->session->unset_userdata('search_in');
		}
		//end Dương
		$data["car_info"]=$this->TransferModel->get_car_information();
		$data["guide"]=$this->TransferModel->get_guide();
		$this->load->view('Transfer_Management/formInTransfer',$data);		
	}

	public function out_transfer()
	{
		$data["car_info"]=$this->TransferModel->get_car_information();
		$data["guide"]=$this->TransferModel->get_guide();

		if($this->session->userdata('search_out') !== false)
		{
			$data['search_out'] = $this->session->userdata('search_out');			
			$this->session->unset_userdata('search_out');				
		}
		$this->load->view('Transfer_Management/formOutTransfer',$data);
	}

	public function new_in_transfer()
	{

		if($this->input->post("submit"))
		{
			$id = $this->Guest->makeID('inid','transferin');
			$list_check  = $this->input->post('list_check');
			if($this->Guest->validateBltcode($this->input->post('TBLCodeIn'))&&is_array($list_check ))
			{
				$data_transfer = array(
					'InID'=>$id,
					'TBLCodeIn'=>$this->input->post('TBLCodeIn'),
					'GuideID'=>$this->input->post('GuideID'),
					'CarDriverID'=>$this->input->post('CarDriverID'),
					'STimeFrom'=>$this->input->post('STimeFrom'),
					'DateIn'=>$this->input->post('date-in'),
					'STimeTo'=>$this->input->post('STimeTo'),
					);
				/*check TBLCodeIn from database before insert*/				
				$db = $this->TransferModel->get_transfer_by_code($data_transfer["TBLCodeIn"]);							
				if(count($db)>0){
					$like = array("TBLCodeIn"=>substr($data_transfer["TBLCodeIn"], 0,strpos($data_transfer["TBLCodeIn"], "-")));
					$result = $this->TransferModel->get_table_code("transferin",$like,"max(TBLCodeIn)");
					if(!empty($result[0]["max(TBLCodeIn)"])){	
						/*set TBLCodeIn*/		
						$data_transfer["TBLCodeIn"] = substr($result[0]["max(TBLCodeIn)"],-2)+1;
						/*end set TBLCodeIn*/
					}	
				}
				/*end check TBCodeIn from database before insert*/
				if($data_transfer['GuideID']=='false')
				{
					echo "OK";
				}
				$insert_success = $this->Guest->inserttransferin($data_transfer);
				if($insert_success)
				{
					$data_booking_update = array();
					foreach ($list_check as $key => $value) {
						$dta_booking = explode('*', $value);
						$data_booking_update = array('TourID'=>$dta_booking[0],'TLTCode'=>$dta_booking[1],'TBLCodeIn'=>array('TBLCodeIn'=>$this->input->post('TBLCodeIn')));
						$update_success =  $this->Guest->Update_booking_for_transfer_in($data_booking_update);
					}
					$search_in  = array("tblcode"=>$data_transfer["TBLCodeIn"]);
					$this->session->set_userdata('search_in',$search_in);
					redirect('transfer-management/in-transfer');
				}

			}
		}
		if($this->Guest->validateBltcode($this->Guest->gettransferintltcode()))
			$data['Btl_code']=$this->Guest->gettransferintltcode();
		else
			$data['Btl_code']=$this->Guest->generateRandomString();
		$data["car_info"]=$this->TransferModel->get_car_information();
		$data["guide"]=$this->TransferModel->get_guide();
		$data['datetime_now'] = date('Y/m/d');
		$data['from_place']=$this->Guest->getfromplace(date('Y/m/d'));
		$this->load->view('Transfer_Management/formNewInTransfer',$data);
	}
	
	public function delete_in_transferbycode()
	{		
		$code  = ($this->input->post('code'));            
		$data = $this->TransferModel->get_booking_TBLCodeIN("TBLCodeIn",$code);
		foreach ($data as $key => $value)
		{
			$this->TransferModel->Update_booking_for_transfer_in($value,"TBLCodeIn","");
		}		
		$this->Guest->delete_tranger_in($code);

	}
	public function delete_out_transferbycode($code='')
	{
		$code  = $this->input->post('code');            
		$data = $this->TransferModel->get_booking_TBLCodeIN("TBLCodeOut",$code);
		foreach ($data as $key => $value)
		{
			$this->TransferModel->Update_booking_for_transfer_in($value,"TBLCodeOut","");
		} 		
		$this->Guest->delete_tranger_out($code);
	}
	public function new_out_transfer()
	{


		if($this->Guest->validateBltcodeout($this->Guest->gettransferouttltcode()))
			$data['Btl_code']=$this->Guest->gettransferouttltcode();
		else
			$data['Btl_code']=$this->Guest->generateRandomStringout();
		$data["car_info"]=$this->TransferModel->get_car_information();
		$data["guide"]=$this->TransferModel->get_guide();
	// var_dump($data["guide"]);
		$this->load->view('Transfer_Management/formNewOutTransfer',$data);
	}
	public function addnewtransferout()
	{
		$result['msg'] = false;
		$result_update = 0;
		$id = $this->Guest->makeID('OutID','transferout');
		$list_check  = $this->input->post('list_check');
		if($this->Guest->validateBltcodeout($this->input->post('TBLCodeOut')) &&is_array($list_check ))
		{
			$data_insert= array(
				'OutID' =>$id,
				'TBLCodeOut' =>$this->input->post('TBLCodeOut'),
				'GuideID' =>$this->input->post('GuideID'),
				'CarDriverID' =>$this->input->post('CarDriverID'),
				'STimeFrom' =>$this->input->post('STimeFrom'),
				'STimeTo' =>$this->input->post('STimeTo'),
				'DateOut' =>$this->input->post('DateOut'),
				'TimeSearch'=>$this->input->post('TimeSearch')
				);			
			$insert_success = $this->Guest->inserttransferout($data_insert);
			if($insert_success)
			{
				$data_booking_update = array();
				foreach ($list_check as $key => $value) 
				{
					$dta_booking = explode('*', $value);
					$data_booking_update = array('TourID'=>$dta_booking[0],'TLTCode'=>$dta_booking[1],'TBLCodeOut'=>array('TBLCodeOut'=>$this->input->post('TBLCodeOut')));
					$update_success =  $this->Guest->Update_booking_for_transfer_out($data_booking_update);
				}	
				$result['msg'] = true;				
			}			

		}
		echo json_encode($result);
	}
	public function c_d_g_managerment()
	{
		$data["car"] = $this->TransferModel->get_all_car();
		$data["guide"] = $this->TransferModel->get_all_guide();
		$data["max_car"] = $this->TransferModel->make_id("cardriver","CarDriverid")+1;
		//echo $data["max_car"];
		$data["max_guide"] = $this->TransferModel->make_id("guide","GuideID")+1;
		$this->load->view('Transfer_Management/formCDGManagement',$data);
	}

	public function guide_car_scheduling()
	{
		$data["city"]=$this->TransferModel->get_city();
		$data["hotel"] = $this->TransferModel->get_hotel();
		$this->load->view('Transfer_Management/formGuideCarScheduling',$data);
	}

	public function update_guest_optional_tour()
	{
		$id_tour = $this->input->get('id',TRUE);
		$cout_guest = $this->input->get('count',TRUE);
		$data_get = $this->input->get();
		unset($data_get["id"]);
		unset($data_get["count"]);
		$this->session->set_userdata('search_tourinfo',$data_get);	

		$data["id_tour"] = $id_tour;
		$data["tour_info"] = $this->TransferModel->get_guest_optional_tour_update($id_tour);
		$data["city"] =  $this->TransferModel->get_city();
		$data["optional_tour"] = $this->TransferModel->get_optional_tour_info("");
		$data["guest"] = $this->TransferModel->get_tour_guest($id_tour);
		$data["count_guest"] = $cout_guest;
		$data["optional_tour_reg_common"] = $this->TransferModel->get_optional_tour_reg_common($data["tour_info"][0]["TourCode"]);
		//echo $data["guest"][0]["GuestID"];
		$data["optional_tour_reg_individual"] = $this->TransferModel->get_optional_tour_reg_individual($data["tour_info"][0]["TourCode"],$data["guest"][0]["GuestID"]);
		//print_r($data["optional_tour_reg_individual"]);
		$this->load->view('Transfer_Management/formUpdateGuestOptionalTour',$data);
	}

	public function update_transfer_detail()
	{
		$data_get = $this->input->get();		
		unset($data_get["id"]);
		unset($data_get["code"]);
		$this->session->set_userdata('search_tourinfo',$data_get);
		$flights=array();
		$tour= '';
		$booking='';
		$id=($this->input->get('id'));
		$code=($this->input->get('code'));  

		$booking = $this->TransferModel->get_booking_tour($id,$code);				
		$out_tour_guest= $this->Guest->getGuestByTltCodeAndTourid($id,$code,false);
		$out_tour_tranfer_guest= $this->Guest->getTranferGuestByTltCodeAndTourid($id,$code,false);
		$in_tour_guest= $this->Guest->getGuestByTltCodeAndTourid($id,$code,true);
		$in_tour_tranfer_guest= $this->Guest->getTranferGuestByTltCodeAndTourid($id,$code,true);
		$data['bkl_code'] = $code; 
		$data['in_tour_guest']= $in_tour_guest;
		$data['in_tour_tranfer_guest']= $in_tour_tranfer_guest;
		$data['out_tour_guest'] = $out_tour_guest;
		$data['out_tour_tranfer_guest']= $out_tour_tranfer_guest;

		$data_flight = $this->OptionalTourModel->get_flight_in() ;
		foreach ($data_flight as $key => $value) {
			$flights[$value['FltName']]=$value['FltName'];
		}

		$data['flights'] = $flights;
		//print_r($data['flights']);
		$data_flight_to = $this->OptionalTourModel->get_flight_out() ;

		foreach ($data_flight_to as $key => $value) {
			$flights_to[$value['FltName']]=$value['FltName'];
		}
		$data['flights_to'] = $flights_to;		
		$str_no_1 = '';
		$str_type_1='';

		if(is_array($booking) AND !empty($booking))
		{
			$booking= $booking[0];
			$str_no_1 = $booking['RoomNo1'];
			if($booking['Room_List1'])
			{
				$str_type_1 = $booking['Room_List1'];
				$str_no_1='';
			}
			else
			{
				$str_type_1 = $booking['RoomType1'];

			}
		}
		$data['RoomNo1']=$str_no_1;
		$data['RoomType1']=$str_type_1;
		$data['booking']=$booking;

		$tour= $this->OptionalTourModel->get_tour_by_id($id);
		if(is_array($tour))
		{
			$tour= $tour[0];
		}
		$data['tour']= $tour;
		$this->load->view('Transfer_Management/formUpdateTransferDetail',$data);
	}
	function format_type_str($str="")
	{
		$s='';
		if($str!="")
		{
			$list_type = explode(";", $str);
			if(is_array($list_type))
			{
				foreach ($list_type as $key => $value) {
					if($value){ 
						$t = substr($value, 0,intval (strpos($value,'/' )));

						$s= $s. $t.',';
					}
				}


				$s=substr($s,0 ,strlen($s)-1);

			}

		}
		return $s;
	}
	public function update_in_transfer()
	{	
		//Dương lấy điều kiện search gửi qua từ intranfer
		$data_get = $this->input->get();
		unset($data_get['tblcode']);
		unset($data_get['code']);
		unset($data_get['id']);

		$this->session->set_userdata('search_in',$data_get);
		//end Dương
		
		$tblcodein = $this->input->get('tblcode',TRUE);
		$tltcode = $this->input->get('code',TRUE);
		$tourid  = $this->input->get('id',TRUE);
		$tranfer = $this->TransferModel->getintranferload($tblcodein);				
		if(count($tranfer)>0)
		{
			$tranfer = $tranfer[0];
			$dt=$this->TransferModel->get_info_tour_intransfer($tblcodein,$tranfer["DateIn"]);			
			if(count($dt)>0)
			{
				$data["search_data"] = $this->TransferModel->get_search_booking_transfer_in($dt,$tblcodein);
				$data["dt"] = $dt;
			}
			else
			{
				$data["dt"]="";
				$data["search_data"] = "";
			}			
		}

		$data['codein'] = $tblcodein;
		$data['tourid'] = $tourid;
		$data['tltcode']= $tltcode;
		$data['transfer']=$tranfer;
		$data["car_info"]=$this->TransferModel->get_car_information();
		$data["guide"]=$this->TransferModel->get_guide();	
		
		$this->load->view('Transfer_Management/formUpdateInTransfer',$data);
	}
	public function coutguesttotalseat()
	{
		$tblcodein  = $this->input->post('tblcode',TRUE);
		$data_check = $this->input->post('data_check',TRUE);
		//echo $tblcodein;
		$tranfer = $this->Guest->getintranferbytblcodin($tblcodein);
		if(is_array($tranfer) && $tranfer)
		{
			$tranfer = $tranfer[0];
			$dsTransferDetail=$this->TransferModel->get_info_tour_intransfer($tblcodein,$tranfer["DateIn"]);
			$guesttotal = $this->TransferModel->CountTotalGuestChkSeat_InOut($dsTransferDetail,$data_check);
		}
		else
		{
			$guesttotal = 0;
		}	
		$result["gt"] = $guesttotal;	
		echo json_encode($result);
	}
	public function coutguesttotalseat1()
	{
		$tblcodeout  = $this->input->post('tblcode',TRUE);
		$data_check = $this->input->post('data_check',TRUE);
		//echo $tblcodein;
		$tranfer = $this->Guest->getintranferbytblcodout($tblcodeout);
		if(is_array($tranfer) && $tranfer)
		{
			$tranfer = $tranfer[0];
			$dsTransferDetail=$this->TransferModel->get_info_tour_intransfer($tblcodeout,$tranfer["DateOut"]);
			$guesttotal = $this->TransferModel->CountTotalGuestChkSeat_InOut($dsTransferDetail,$data_check);
		}
		else
		{
			$guesttotal = 0;
		}	
		$result["gt"] = $guesttotal;	
		echo json_encode($result);
	}
	public function update_out_transfer()
	{   
		$data_get = $this->input->get();
		// unset($data_get['tblcode']);
		// unset($data_get['code']);
		// unset($data_get['id']);
		$this->session->set_userdata('search_out',$data_get);


		$tblcodeout = $this->input->get('code',TRUE);
                //echo $tblcodeout;
		$tranfer = $this->Guest->getintranferbytblcodout($tblcodeout);
		if(count($tranfer)==0)
		{
			$tranfer  =  $this->TransferModel->getouttranfer($tblcodeout);
		}
                //print_r($tranfer);
		$booking = $this->TransferModel->getbookinginforfortransferbycodeout($tblcodeout);
                //print_r($booking);
		if(is_array($tranfer) && $tranfer)
			$tranfer = $tranfer[0];
		if($booking)
		{
			$data['booking'] = $booking;
		}
		$data['codeout'] = $tblcodeout;
		$data['transfer']=$tranfer;
		$data["car_info"]=$this->TransferModel->get_car_information();
		$data["guide"]=$this->TransferModel->get_guide();
		$data["search_data"]=$this->TransferModel->get_data_search_booking_outtransfer($tblcodeout);
                //print_r($data["guide"]);
		$this->load->view('Transfer_Management/formUpdateOutTransfer',$data);
	}

	public function guide_report()
	{
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			$source = $this->input->post('datasource');
			$data['guideName'] = $this->input->post('guide');
			if ($source) {
				$source = explode("|:|", $source);
				foreach ($source as $str) {
					if(!empty($str)) {
						$data['table'][] = json_decode($str, true);
					}
				}
				
			}
		}
		$data["guide"]=$this->TransferModel->get_guide();
		$this->load->view('Transfer_Management/formGuideReport',$data);
	}

	public function car_report()
	{
		$data["car_info"]=$this->TransferModel->get_car_information();
		$this->load->view('Transfer_Management/formCarReport',$data);
	}

	public function get_hotel()
	{
		$city = $this->input->post('city',TRUE);
		$rows = $this->TransferModel->get_hotel_by_city($city);
		$output = '<option value=""></option>';
		foreach ($rows as $row)
		{
			$output .= "<option value=\"".$row->HotelName."\">".$row->HotelName."</option>";
		}
		echo $output;
	}

	public function get_tel_guide()
	{
		$guide = $this->input->post('guide',TRUE);
		$rows = $this->TransferModel->get_tel_by_guide($guide);
		$result = "";

		foreach ($rows as $row)
		{
			$result = $row["GuideTel"];
		}
		echo $result;
	}

	public function get_type_guide()
	{
		$guide = $this->input->post('guide',TRUE);
		$rows = $this->TransferModel->get_type_by_guide($guide);
		$result = "";

		foreach ($rows as $row)
		{
			$result = $row["Type"];
		}
		echo $result;
	}
	/*
	* access public
	* function get tabale_code in
	* param
	* return text
	*/
	public function get_table_code(){
		$table_code = $this->input->post('table_code',TRUE);
		$like = array("TBLCodeIn"=>$table_code);		
		$result = $this->TransferModel->get_table_code("transferin",$like,"max(TBLCodeIn)");		
		if(!empty($result[0]["max(TBLCodeIn)"])){			
			echo (substr($result[0]["max(TBLCodeIn)"],-2)+1)<10?"0".(substr($result[0]["max(TBLCodeIn)"],-2)+1):substr($result[0]["max(TBLCodeIn)"],-2)+1;
		}
		else{
			echo "01";
		}
	}
	/*
	* access public
	* function get tabale_code out
	* param
	* return text
	*/
	public function get_table_code_out(){
		$table_code = $this->input->post('table_code',TRUE);
		$like = array("TBLCodeOut"=>$table_code);		
		$result = $this->TransferModel->get_table_code("transferout",$like,"max(TBLCodeOut)");		
		if(!empty($result[0]["max(TBLCodeOut)"])){			
			echo (substr($result[0]["max(TBLCodeOut)"],-2)+1)<10?"0".(substr($result[0]["max(TBLCodeOut)"],-2)+1):substr($result[0]["max(TBLCodeOut)"],-2)+1;
		}
		else{
			echo "01";
		}
	}
	public function get_info_car()
	{
		$driver = $this->input->post('driver',TRUE);
		$result = $this->TransferModel->get_info_car($driver);
		echo json_encode($result);
	}

	public function get_name_driver()
	{
		$driver = $this->input->post('driver',TRUE);
		$rows = $this->TransferModel->get_name_by_driver($driver);
		$result = "";

		foreach ($rows as $row)
		{
			$result = $row["DriverName"];
		}
		echo $result;
	}

	public function get_from_place()
	{
		$datein = $this->input->post('datein',TRUE);
		$rows = $this->TransferModel->get_from_place($datein);
		$output = '<option value=""></option>';
		foreach ($rows as $row)
		{
			if($row["FromPlace"])
				$output .= "<option value='".$row["FromPlace"]."'>".$row["FromPlace"]."</option>";
		}
		echo $output;
	}

	public function get_flight()
	{
		$datein = $this->input->post('date_in',TRUE);
		$formplace = $this->input->post('from_place',TRUE);
		$rows = $this->TransferModel->get_flight($datein,$formplace);
		$output1 = '<option value=""></option>';
		$output2 = '<option value=""></option>';
		foreach ($rows as $row)
		{
			if($row["TimeIn"])
				$output1 .= "<option value='".$row["TimeIn"]."'>".$row["TimeIn"]."</option>";
			if($row["InFlight"])
				$output2 .= "<option value='".$row["InFlight"]."'>".$row["InFlight"]."</option>";
		}
		$result["TimeIn"]=$output1;
		$result["InFlight"]=$output2;
		echo json_encode($result);
	}

	public function get_time_out()
	{
		$dateout = $this->input->post('dateout',TRUE);
		$rows = $this->TransferModel->get_time_out($dateout);
		$output = '<option value=""></option>';
		foreach ($rows as $row)
		{
			if($row["TimeOut"])
				$output .= "<option value='".$row["TimeOut"]."'>".$row["TimeOut"]."</option>";
		}
		echo $output;
	}
	public function get_pickup_out_from()
	{
		$dateout = $this->input->post('dateout',TRUE);
		$rows = $this->Guest->getPickUpFrom($dateout);
		$output = '<option value=""></option>';
		foreach ($rows as $row)
		{
			if($row["PUOutFrom"])
				$output .= "<option value='".$row["PUOutFrom"]."'>".$row["PUOutFrom"]."</option>";
		}
		echo $output;
	}
	public function get_pickup_out_to()
	{
		$from = $this->input->post('from',TRUE);
		$date = $this->input->post('date',TRUE);

		$rows = $this->Guest->getPickUpTo($from,$date);
		$output = '<option value=""></option>';
		foreach ($rows as $row)
		{
			$output .= "<option value='".$row["PUOutTo"]."'>".$row["PUOutTo"]."</option>";
		}
		echo $output;
	}
	public function get_data_search_tour_info()
	{
		$id = $this->input->post('id');
		$rows = array();
		if($id)
		{
			$rows = $this->TransferModel->get_data_tour_info_by_id($id);
		}
		else
		{
			$data["tour_code"] 		= $this->input->post('tour_code',TRUE);
			$data['vn_code'] 		= $this->input->post('vn_code',TRUE);
			$data["tour_status"] 	        = $this->input->post('tour_status',TRUE);
			$data["guest_name"] 	        = $this->input->post('guest_name',TRUE);
			$data["not_yet_update"]         = $this->input->post('not_yet_update',TRUE);
			$data["tlt_code"] 		= $this->input->post('tlt_code',TRUE);
			$data["city"] 			= $this->input->post('city',TRUE);
			$data["hotel"] 			= $this->input->post('hotel',TRUE);
			$data["flight_in"] 		= $this->input->post('flight_in',TRUE);
			$data["flight_out"] 	        = $this->input->post('flight_out',TRUE);
			$data["date_in"] 		= $this->input->post('date_in',TRUE);
			$data["date_out"] 		= $this->input->post('date_out',TRUE);
			$data['vt']			= $this->input->post('vi_tri',TRUE);
                        //echo $data["tour_status"];
			foreach($data as $key => $value)
			{
				if($key == 'vt')
				{
					continue;
				}
				elseif(empty($value))
				{
					unset($data[$key]);
				}
			}
			if($data['not_yet_update'] == 'false')
			{
				$data['not_yet_update'] = false;
			}
			else
			{
				$data['not_yet_update'] = true;
			}
			$rows = $this->TransferModel->get_data_search_tour_info($data);
		}
                //print_r($data);
		if (count($rows)!=0){
			$result["msg"] = "true";
			$result["data"] = $rows;
			echo json_encode($result);
		} else {
			$result["msg"] = "false";
			echo json_encode($result);
		}

	}

	public function get_info_booking()
	{
		$bookingID = $this->input->post('bookingID',TRUE);
                //echo $bookingID;
		$rows_transfer = $this->TransferModel->get_info_booking($bookingID);     
		$rows_guest = $this->TransferModel->get_tour_guest($bookingID);
		$data["guest"] = $rows_guest;
		if(count($rows_transfer)!=0)
		{
			$result["transfer"] = $rows_transfer;
			$result["msg"] = "";
		}
		else
		{
			$result["msg"]  = "true";
		}
		$result["guest"] = $rows_guest;
   // var_dump($result);exit;
		echo json_encode($result);
	}

	public function get_guest_transfer()
	{
		$bookingID = $this->input->post('bookingID',TRUE);
		$TLTCode = $this->input->post('TLTCode',TRUE);
		$rows_guest = $this->TransferModel->get_transfer_guest($bookingID,$TLTCode);
		$result["guest"] = $rows_guest;
		echo json_encode($result);
	}

	public function get_data_search_intransfer()
	{
		$data["table_code"] 	= $this->input->post('table_code',TRUE);
		$data['guest_name'] 	= $this->input->post('guest_name',TRUE);
		$data["car_num"] 		= $this->input->post('car_num',TRUE);
		$data["driver_name"] 	= $this->input->post('driver_name',TRUE);
		$data["guide_name"] 	= $this->input->post('guide_name',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);
		$rows = $this->TransferModel->get_data_search_intransfer($data); 		
		for($i=0;$i<count($rows);$i++)
		{
			$guest_transfer = $this->TransferModel->CountGuest("TBLCodeIn",$rows[$i]["TBLCodeIn"],"true");
			$rows[$i]["noguest"] = $guest_transfer[0]["GuestCount"];
		}

		$guest_total = $this->TransferModel->CountTotalGuest($rows,"TBLCodeIn","true");  
		if (count($rows)!=0)
		{
			$result["msg"] = "true";
			$result["data"] = $rows;
			$result["totalperson"]=$guest_total;
			echo json_encode($result);
		} 
		else
		{
			$result["totalperson"]="";
			$result["msg"] = "false";
			echo json_encode($result);
		}
	}

	public function get_info_tour_intransfer()
	{
    	$TBLCodeIn = $this->input->post('TBLCodeIn',TRUE);//'TRI.061116-02';
    	$DateIn = $this->input->post('DateIn',TRUE);//'2011/09/08';
        //echo $TBLCodeIn;
    	$rows_tour = $this->TransferModel->get_info_tour_intransfer($TBLCodeIn,$DateIn);
    	$outputTransfer="";
    	for($i=0;$i<=count($rows_tour)-1;$i++)
    	{
    		$outputTransfer.="<tr id='transfer-".$rows_tour[$i]["TourID"]."-".$rows_tour[$i]["TLTCode"]."' onclick=get_guest('".$rows_tour[$i]["TourID"]."','".$rows_tour[$i]["TLTCode"]."')>";            
    		$outputTransfer.= "<td title='".(($rows_tour[$i]["InFlight"]!=null)?$rows_tour[$i]["InFlight"]:"")."' style='width:40px'>".$rows_tour[$i]["InFlight"]."</td>";
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["FromPlace"]!=null)?$rows_tour[$i]["FromPlace"]:"")."' style='width:50px'>".(($rows_tour[$i]["FromPlace"]!=null)?$rows_tour[$i]["FromPlace"]:"")."</td>";
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["TimeIn"]!=null)?$rows_tour[$i]["TimeIn"]:"")."' style='width:70px'>".(($rows_tour[$i]["TimeIn"]!=null)?$rows_tour[$i]["TimeIn"]:"")."</td>";
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["PUIn"]!=null)?$rows_tour[$i]["PUIn"]:"")."' style='width:70px'>".(($rows_tour[$i]["PUIn"]!=null)?$rows_tour[$i]["PUIn"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["TourCode"]!=null)?$rows_tour[$i]["TourCode"]:"")."' style='width:90px'>".(($rows_tour[$i]["TourCode"]!=null)?$rows_tour[$i]["TourCode"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["TourStatus"]!=null)?$rows_tour[$i]["TourStatus"]:"")."' style='width:70px'>".(($rows_tour[$i]["TourStatus"]!=null)?$rows_tour[$i]["TourStatus"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["TLTCode"]!=null)?$rows_tour[$i]["TLTCode"]:"")."' style='width:90px'>".(($rows_tour[$i]["TLTCode"]!=null)?$rows_tour[$i]["TLTCode"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["Hotel"]!=null)?$rows_tour[$i]["Hotel"]:"")."' style='width:90px'>".(($rows_tour[$i]["Hotel"]!=null)?$rows_tour[$i]["Hotel"]:"")."</td>";               
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["RoomType1"]!=null)?$rows_tour[$i]["RoomType1"]:"")."' style='width:40px'>".(($rows_tour[$i]["RoomType1"]!=null)?$rows_tour[$i]["RoomType1"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["RoomNo1"]!=null)?$rows_tour[$i]["RoomNo1"]:"")."' style='width:40px'>".(($rows_tour[$i]["RoomNo1"]!=null)?$rows_tour[$i]["RoomNo1"]:"")."</td>";
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["ArrvDate1"]!=null)?$rows_tour[$i]["ArrvDate1"]:"")."' style='width:70px'>".(($rows_tour[$i]["ArrvDate1"]!=null)?$rows_tour[$i]["ArrvDate1"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["OutFlight"]!=null)?$rows_tour[$i]["OutFlight"]:"")."' style='width:50px'>".(($rows_tour[$i]["OutFlight"]!=null)?$rows_tour[$i]["OutFlight"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["ToPlace"]!=null)?$rows_tour[$i]["ToPlace"]:"")."' style='width:50px'>".(($rows_tour[$i]["ToPlace"]!=null)?$rows_tour[$i]["ToPlace"]:"")."</td>";            
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["DeptDate1"]!=null)?$rows_tour[$i]["DeptDate1"]:"")."' style='width:70px'>".(($rows_tour[$i]["DeptDate1"]!=null)?$rows_tour[$i]["DeptDate1"]:"")."</td>";
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["TimeOut"]!=null)?$rows_tour[$i]["TimeOut"]:"")."' style='width:70px'>".(($rows_tour[$i]["TimeOut"]!=null)?$rows_tour[$i]["TimeOut"]:"")."</td>";
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["PUOutTo"]!=null)?$rows_tour[$i]["PUOutTo"]:"")."' style='width:70px'>".(($rows_tour[$i]["PUOutTo"]!=null)?$rows_tour[$i]["PUOutTo"]:"")."</td>";
    		$outputTransfer .= "<td title='".(($rows_tour[$i]["NoteIn"]!=null)?$rows_tour[$i]["NoteIn"]:"")."' style='width:110px'>".(($rows_tour[$i]["NoteIn"]!=null)?$rows_tour[$i]["NoteIn"]:"")."</td>";
    		$outputTransfer .= "</tr>";
    	}       
    	$result["tour"] = $outputTransfer;    
    	echo json_encode($result);
    }

    public function get_guest_transfer_intransfer()
    {
    	$TourID = $this->input->post('TourID',TRUE);
    	$TLTCode = $this->input->post('TLTCode',TRUE);
		$choose = $this->input->post('Choose',TRUE);
    	$rows_guest = $this->TransferModel->get_transfer_guest_intransfer($TourID,$TLTCode,$choose);
    	$result["guest"] = $rows_guest;
    	echo json_encode($result);
    }

    public function get_data_search_outtransfer()
    {    	
    	$data["table_code"] 	= $this->input->post('table_code',TRUE);
    	$data['guest_name'] 	= $this->input->post('guest_name',TRUE);
    	$data["car_num"] 		= $this->input->post('car_num',TRUE);
    	$data["driver_name"] 	= $this->input->post('driver_name',TRUE);
    	$data["guide_name"] 	= $this->input->post('guide_name',TRUE);
    	$data["from_date"] 		= $this->input->post('from_date',TRUE);
    	$data["to_date"] 		= $this->input->post('to_date',TRUE);

    	$rows = $this->TransferModel->get_data_search_outtransfer($data);
    	$guest_total = $this->TransferModel->CountTotalGuest($rows,"TBLCodeOut","false");
    	for($i=0;$i<count($rows);$i++)
    	{
    		$guest_transfer = $this->TransferModel->CountGuest("TBLCodeOut",$rows[$i]["TBLCodeOut"],"true");
    		$rows[$i]["noguest"] = $guest_transfer[0]["GuestCount"];
    	}   
    	if (count($rows)!=0)
    	{
    		$result["msg"] = "true";
    		$result["totalperson"]=$guest_total;
    		$result["data"] = $rows;
    		echo json_encode($result);
    	} 
    	else 
    	{
    		$result["msg"] = "false";
    		$result["totalperson"]="";
    		echo json_encode($result);
    	}
    }

    public function get_info_tour_outtransfer()
    {
	    $TBLCodeOut = $this->input->post('TBLCodeOut',TRUE);//'TRI.061116-02';

           // echo  $TBLCodeOut;
	    $rows_tour = $this->TransferModel->get_info_tour_outtransfer($TBLCodeOut);
	    $outputTransfer="";
	    for($i=0;$i<=count($rows_tour)-1;$i++)
	    {
	    	$outputTransfer.="<tr id='transfer-".$rows_tour[$i]["TourID"]."-".$rows_tour[$i]["TLTCode"]."' onclick=get_guest_transfer('".$rows_tour[$i]["TourID"]."','".$rows_tour[$i]["TLTCode"]."')>";
	    	$outputTransfer.= "<td title='".(($rows_tour[$i]["InFlight"]!=null)?$rows_tour[$i]["InFlight"]:"")."' style='width:40px'>".$rows_tour[$i]["InFlight"]."</td>";
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["FromPlace"]!=null)?$rows_tour[$i]["FromPlace"]:"")."' style='width:50px'>".(($rows_tour[$i]["FromPlace"]!=null)?$rows_tour[$i]["FromPlace"]:"")."</td>";
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["TimeIn"]!=null)?$rows_tour[$i]["TimeIn"]:"")."' style='width:70px'>".(($rows_tour[$i]["TimeIn"]!=null)?$rows_tour[$i]["TimeIn"]:"")."</td>";
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["PUIn"]!=null)?$rows_tour[$i]["PUIn"]:"")."' style='width:70px'>".(($rows_tour[$i]["PUIn"]!=null)?$rows_tour[$i]["PUIn"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["TourCode"]!=null)?$rows_tour[$i]["TourCode"]:"")."' style='width:90px'>".(($rows_tour[$i]["TourCode"]!=null)?$rows_tour[$i]["TourCode"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["TourStatus"]!=null)?$rows_tour[$i]["TourStatus"]:"")."' style='width:70px'>".(($rows_tour[$i]["TourStatus"]!=null)?$rows_tour[$i]["TourStatus"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["TLTCode"]!=null)?$rows_tour[$i]["TLTCode"]:"")."' style='width:90px'>".(($rows_tour[$i]["TLTCode"]!=null)?$rows_tour[$i]["TLTCode"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["Hotel"]!=null)?$rows_tour[$i]["Hotel"]:"")."' style='width:90px'>".(($rows_tour[$i]["Hotel"]!=null)?$rows_tour[$i]["Hotel"]:"")."</td>";               
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["RoomType1"]!=null)?$rows_tour[$i]["RoomType1"]:"")."' style='width:40px'>".(($rows_tour[$i]["RoomType1"]!=null)?$rows_tour[$i]["RoomType1"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["RoomNo1"]!=null)?$rows_tour[$i]["RoomNo1"]:"")."' style='width:40px'>".(($rows_tour[$i]["RoomNo1"]!=null)?$rows_tour[$i]["RoomNo1"]:"")."</td>";
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["ArrvDate1"]!=null)?$rows_tour[$i]["ArrvDate1"]:"")."' style='width:70px'>".(($rows_tour[$i]["ArrvDate1"]!=null)?$rows_tour[$i]["ArrvDate1"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["OutFlight"]!=null)?$rows_tour[$i]["OutFlight"]:"")."' style='width:50px'>".(($rows_tour[$i]["OutFlight"]!=null)?$rows_tour[$i]["OutFlight"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["ToPlace"]!=null)?$rows_tour[$i]["ToPlace"]:"")."' style='width:50px'>".(($rows_tour[$i]["ToPlace"]!=null)?$rows_tour[$i]["ToPlace"]:"")."</td>";            
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["DeptDate1"]!=null)?$rows_tour[$i]["DeptDate1"]:"")."' style='width:70px'>".(($rows_tour[$i]["DeptDate1"]!=null)?$rows_tour[$i]["DeptDate1"]:"")."</td>";
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["TimeOut"]!=null)?$rows_tour[$i]["TimeOut"]:"")."' style='width:70px'>".(($rows_tour[$i]["TimeOut"]!=null)?$rows_tour[$i]["TimeOut"]:"")."</td>";
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["PUOutTo"]!=null)?$rows_tour[$i]["PUOutTo"]:"")."' style='width:70px'>".(($rows_tour[$i]["PUOutTo"]!=null)?$rows_tour[$i]["PUOutTo"]:"")."</td>";
	    	$outputTransfer .= "<td title='".(($rows_tour[$i]["NoteIn"]!=null)?$rows_tour[$i]["NoteIn"]:"")."' style='width:110px'>".(($rows_tour[$i]["NoteIn"]!=null)?$rows_tour[$i]["NoteIn"]:"")."</td>";
	    	$outputTransfer .= "</tr>";
	    }
	    if(count($rows_tour)>0)
	    {              
	    	$result["tour"] = $outputTransfer;
	    }
	    else
	    {
	    	$result["msg"]  = false;
	    }
	    echo json_encode($result);              
	}

	public function search_new_intransfer()
	{
		$data["date_in"] 		= $this->input->post('date_in',TRUE);
		$data['from_place'] 	= $this->input->post('from_place',TRUE);
		$data["time_in"] 		= $this->input->post('time_in',TRUE);
		$data["flight_in"] 		= $this->input->post('flight_in',TRUE);	
		$rows = $this->TransferModel->search_new_intransfer($data);
		   // $output	.= "</tbody>";
		if (count($rows)!=0)
		{
			$dt['TourID']  = $rows[0]['TourID'];	
			$dt['TLTCode'] = $rows[0]['TLTCode'];
			$result["msg"] = "true";
			$result["data"] = $rows;
			$result["dt"] = $dt;
			echo json_encode($result);
		} else {
			$result["msg"] = "false";
			echo json_encode($result);
		}

	}

	public function get_guest_transfer_new_intransfer()
	{
		$TourID       = $this->input->post('TourID',TRUE);
		$TLTCode      = $this->input->post('TLTCode',TRUE);
		$check_detail = $this->input->post('check_detail',TRUE);
		$rows_guest = $this->TransferModel->get_transfer_guest_new_intransfer($TourID,$TLTCode);		
		$result["guest_no"] = count($rows_guest);
		
		
		$result["guest"] = $rows_guest;
		echo json_encode($result);
	}

	public function search_new_outtransfer()
	{
		$data["date_out"] 		= $this->input->post('date_out',TRUE);
		$data['time_out'] 	= $this->input->post('time_out',TRUE);
		$data["pick_out_from"] 		= $this->input->post('pick_out_from',TRUE);
		$data["pick_out_to"] 		= $this->input->post('pick_out_to',TRUE);

		$rows = $this->TransferModel->search_new_outtransfer($data);
		if (count($rows)!=0){
			$dt['TourID']  = $rows[0]['TourID'];	
			$dt['TLTCode'] = $rows[0]['TLTCode'];
			$result["msg"] = "true";
			$result["data"] = $rows;
			$result["dt"] = $dt;
			echo json_encode($result);
		} else {
			$result["msg"] = "false";
			echo json_encode($result);
		}
	}

	public function get_guest_transfer_new_outtransfer()
	{
		$TourID = $this->input->post('TourID',TRUE);
		$TLTCode = $this->input->post('TLTCode',TRUE);
		$rows_guest = $this->TransferModel->get_transfer_guest_new_outtransfer($TourID,$TLTCode);
		$result["guest"] = $rows_guest;
		$result["guest_no"] = count($rows_guest);
		echo json_encode($result);
	}



	public function search_guide_report()
	{
		$data["guide"] 			= $this->input->post('guide',TRUE);
		$data['guide_type'] 	= $this->input->post('guide_type',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);

		$rows = $this->TransferModel->search_guide_report($data);
		$rows = $this->sort_array($rows);
		if (count($rows)!=0){
			$result["msg"] = "true";
			$result["data"] = $rows;
			echo json_encode($result);
		} else {
			$result["msg"] = "false";
			echo json_encode($result);
		}
	}

	public function search_car_report()
	{
		$data["driver"] 		= $this->input->post('driver',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);

		$rows = $this->TransferModel->search_car_report($data);

		foreach ($rows['intransfer'] as $key => $tour) {
			$rows['intransfer'][$key][] = '';
			$pax = $this->TransferModel->CountGuest_TransferIn($tour['ID']);
			$rows['intransfer'][$key][] = $pax? $pax->pax : '0';
		}
		foreach ($rows['outtransfer'] as $key => $tour) {
			$rows['outtransfer'][$key][] = '';
			$pax = $this->TransferModel->CountGuest_TransferOut($tour['ID']);
			$rows['outtransfer'][$key][] = $pax? $pax->pax : '0';
		}
		foreach ($rows['optionalTourE'] as $key => $tour) {
			$rows['optionalTourE'][$key][] = '';
			$pax = $this->TransferModel->CountGuest_TourE($tour['ID']);
			$rows['optionalTourE'][$key][] = $pax? $pax->pax : '0';
		}
		foreach ($rows['optionalTourI'] as $key => $tour) {
			$rows['optionalTourI'][$key][] = '';
			$pax = $this->TransferModel->CountGuest_TourI($tour['ID']);
			$rows['optionalTourI'][$key][] = $pax? $pax->pax : '0';
		}
		$rows = $this->sort_array($rows);
		$keys = array('ID','GPecuPenalty','GFinished','ATimeFrom','AtimeTo','DateIn','CarNo','DriverTel','DriverName','TourName', 'TimeGo', 'Pax');

		foreach ($rows as $key => $tour) {
			$rows[$key] = array_combine($keys, $tour);
		}
		
		// uasort($rows, function($a, $b) {
		// 	if ($a['DateIn'] < $b['DateIn']) return true;
		// 	return false;
		// });
		echo json_encode(array('data' => array_values($rows)));
		// if (count($rows)!=0){
		// 	$result["msg"] = "true";
		// 	$result["data"] = $rows;
		// 	echo json_encode($result);
		// } else {
		// 	$result["msg"] = "false";
		// 	echo json_encode($result);
		// }
	}

	public function sort_array($array)
	{
		$result = array_merge($array['intransfer'], $array['outtransfer'], $array['optionalTourI'], $array['optionalTourE']);

		return $result;
	}

	public function get_data_search_guide_car()
	{
		$data["vn_code"] 		= $this->input->post('vn_code',TRUE);
		$data['guest_name']     = $this->input->post('guest_name',TRUE);
		$data["city"] 			= $this->input->post('city',TRUE);
		$data["hotel"] 			= $this->input->post('hotel',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);    
		$data['start']			= $this->input->post('start',TRUE);
		$data['length']			= $this->input->post('length',TRUE);

		$draw = $this->input->post('draw',TRUE);
		$start = $this->input->post('start',TRUE);
		$length = $this->input->post('length',TRUE);

		$column = $this->input->post('columns',TRUE);
		$order = $this->input->post('order',TRUE);

		if($column and $order) {
			foreach ($order as $od) {
				$data['order'][] = array('col' => $column[$od['column']]['data'],'dir' => $od['dir']);
			}
		}

		$rows = $this->TransferModel->search_guide_car($data);
		$flag = $this->input->post("flag",true);
		if($flag == "true" || $this->session->userdata("count") === false)
		{
			$count = $this->TransferModel->get_count_search_guide_car($data)['total_rows'];
			$this->session->set_userdata("count", $count);
		}
		else
		{
			$count = $this->session->userdata("count");
		}

		$result['recordsTotal'] = $count;
		$result['recordsFiltered'] = $result['recordsTotal'];
		$result['draw'] = (int)$draw;
		$result["data"] = $rows;
		echo json_encode($result);
	}

	public function delete_booking_by_tltcode()
	{
		$tour_id = $this->input->post("tour_id");
		$tlt_code = $this->input->post('tlt_code');

		$this->GuestTltcodeModel->delete_by_tltcode($tlt_code);
		$this->HotelBookingModel->delete_by_tltcode($tour_id,$tlt_code);
		echo $tour_id.$tlt_code;
	}

	public function select_flight_byid()
	{
		$id = $this->input->post("id");
		echo  json_encode($this->OptionalTourModel->get_flight_byid($id));

	}


	public function get_optional_tour_update()
	{
		$city = $this->input->post('city',TRUE);

		$result["optional_tour_info"] = $this->TransferModel->get_optional_tour_info($city);
		echo json_encode($result);
	}

	public function update_tour_optional_common()
	{
		$tour_code = $this->input->post('tour_code',TRUE);
		$data = $this->input->post('data',TRUE);
		$result = $this->TransferModel->update_tour_optional_common($tour_code,$data);
		$msg = array();
		if ($result) $msg["msg"] = "Data update success!!";
		else $msg["msg"] = "Data update fail!!";
		echo json_encode($msg);
	}

	public function update_tour_optional_individual()
	{
		$tour_code = $this->input->post('tour_code',TRUE);
		$guestid = $this->input->post('guestid',TRUE);
		$data = $this->input->post('data',TRUE);
		$result = $this->TransferModel->update_tour_optional_individual($tour_code,$guestid,$data);
		$msg = array();
		if ($result) $msg["msg"] = "Data update success!!";
		else $msg["msg"] = "Data update fail!!";
		echo json_encode($msg);
	}

	public function get_optional_tour_reg_individual()
	{
		$tour_code = $this->input->post('tour_code',TRUE);
		$guestid = $this->input->post('guestid',TRUE);
		$rows = $this->TransferModel->get_optional_tour_reg_individual($tour_code,$guestid);
		if (count($rows)!=0){
			$result["msg"] = "true";
			$result["data"] = $rows;
			echo json_encode($result);
		} else {
			$result["msg"] = "false";
			echo json_encode($result);
		}
	}

	public function add_guide_car()
	{

		$arr_guide = array();
		$arr_car = array();

    // update guide
		if (isset($_POST['data_arr_guide']))
		{
			$arr_guide = $_POST['data_arr_guide'];
			foreach ($arr_guide as $key => $value) 
			{
				$guide1 = array();
				$guide1['GuideName'] = $value[1];
				$guide1['GuideTel'] = $value[2];
				$guide1['Type'] = $value[3];
				$this->TransferModel->edit_guide($value[0], $guide1);

			}

		}

    // update car
		if(isset($_POST['data_arr_car']))
		{
			$arr_car = $_POST['data_arr_car'];

			foreach ($arr_car as $key => $value) 
			{
				$car1 = array();
				$car1['CarNo'] = $value[1];
				$car1['CarSeat'] = $value[2];
				$car1['DriverName'] = $value[3];
				$car1['DriverTel'] = $value[4];
				$this->TransferModel->edit_car($value[0], $car1);
            //var_dump($value);
			}

		}


	}
	public function insert_new()
	{
      //insert car
		$arr_new_guide = array();
		$arr_new_car = array();
		//$arr_new_car = $_POST['data_new_car'];
		//print_r($arr_new_car);
		if (isset($_POST['data_new_car']))
		{
			$arr_new_car = $_POST['data_new_car'];
			//print_r($arr_new_car);
			for ($i=0; $i < sizeof($arr_new_car)-1; $i++) 
			{       
				$car2 = array();
				$car2['CarDriverID'] = $arr_new_car[$i][0];
				$car2['CarNo'] = $arr_new_car[$i][1];
				$car2['CarSeat'] = $arr_new_car[$i][2];
				$car2['DriverName'] = $arr_new_car[$i][3];
				$car2['DriverTel'] = $arr_new_car[$i][4];
				if($car2['CarNo']!=""||$car2['CarSeat']!=""||$car2['DriverName']!=""||$car2['DriverTel']!="")
				{
					$this->TransferModel->insert_car($car2);
				}
				
			}
		}
		
    // insert guide
		
		if (isset($_POST['data_new_guide']))
		{
			$arr_new_guide = $_POST['data_new_guide'];
			for($i=0; $i < sizeof($arr_new_guide)-1; $i++) 
			{
				$new_guide = array();
				$new_guide['GuideID'] = $arr_new_guide[$i][0];
				$new_guide['GuideName'] = $arr_new_guide[$i][1];
				$new_guide['GuideTel'] = $arr_new_guide[$i][2];
				$new_guide['Type'] = $arr_new_guide[$i][3];
				if($new_guide['GuideName']!="" || $new_guide['GuideTel']!=""|| $new_guide['Type']!="")
				{
					$this->TransferModel->insert_guide($new_guide);
				}				
			}
		}

	}
	public function get_copy_booking()
	{
		$TourID = $this->input->post('TourID',TRUE);
		$TLTCode = $this->input->post('TLTCode',TRUE);
		$rows = $this->TransferModel->get_copy_booking($TourID,$TLTCode);
	}

	/*
	* Controller export excel tour information
	* Parameter: none
	* Return: true if export success, false if export fail
	* Author: Huy Nguyen
	*/
	public function export_ExcelTourInfoForm()
	{
		$tourId   = $this->input->post('tour-id',TRUE);
		$tltCode  = $this->input->post('tltcode',TRUE);
		$tourCode = $this->input->post('tourcode',TRUE);
		$vnCode   = $this->input->post('vncode',TRUE); 
		$t_code   = $this->input->post('t_code',TRUE);
		$vn_code  = $this->input->post('vn_code',TRUE);
	
		if(!empty($tourId))
		{
			$data_tranferdetail = $this->TransferModel->get_info_booking($tourId);           
			$this->TransferModel->export_ExcelTourInfoForm($tourId, $tltCode,$tourCode,$vnCode,$data_tranferdetail);
		}		 		
	}
	public function export_golf_spa() 
	{
		$dt["OptionalTourListID"]       = $this->input->post('optionaltourlistid',TRUE);

		$dt["TourName"]                 = $this->input->post('tourname',TRUE);

		$dt["Date"]                     = $this->input->post('date',TRUE);
		$date                           = $dt["Date"] ;
		$dt["PU"]                       = $this->input->post('pu_from',TRUE);
		$pu                             = $dt["PU"];
		$dt["Time"]                     = $this->input->post('time',TRUE);
		$time                           =  $dt["Time"] ;
		$dt["City"]                     = $this->input->post('cty',TRUE);
		$dt["Tee"]                      = $this->input->post('tee_time',TRUE);
		$tee                            = $dt["Tee"];
		$dt["Payment"]                  = $this->input->post('pay_ment',TRUE);
		$payment                        =  $dt["Payment"] ;
		$dt["Tourcode"]                 = $this->input->post('tourcode',TRUE);
		$dt["VNcode"]                   = $this->input->post('vncode',TRUE);
		$tourcode                       = $dt["Tourcode"];
		$vncode                         = $dt["VNcode"];
		$guest = $this->TransferModel->get_guest_by_tourcode($tourcode);
		if(strpos($dt["TourName"], "GOLF")!==false)
		{			
			$this->TransferModel->export_golf($dt,$tourcode,$vncode,$guest); 
		}
		if(strpos($dt["TourName"], "SPA")!==false)
		{
			$this->TransferModel->export_spa($dt,$tourcode,$vncode,$guest);
		}
		if(strpos($dt["TourName"], "RESTAURANT")!==false)
		{
			$this->TransferModel->export_restaurant($dt,$tourcode,$vncode,$guest); 
		}
	}
	public function print_intranfer() 
	{	
		$code                   = $this->input->post('code',TRUE);              
		$data["table_code"] 	= $this->input->post('tblcode',TRUE);			
		$data['guest_name'] 	= $this->input->post('guest_name',TRUE);
		$data["car_num"] 		= $this->input->post('car_num',TRUE);
		$data["driver_name"] 	= $this->input->post('driver_name',TRUE);
		$data["guide_name"] 	= $this->input->post('guide_name',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);	
		if($this->input->post('print_single',TRUE)=="Print")
		{					
			
			$result = $this->TransferModel->chk_State_CXL( $code,"TBLCodeIn");	       
			if($result=="")
			{	
				$dt = $this->TransferModel->get_data_search_intransfer($data);  			
				$this->TransferModel->print_intranfer($code,$dt);            
			}          
			else
			{			
				$data_post = $this->input->post();			
				$this->session->set_userdata('search_in',$data_post);
				$link  = base_url()."transfer-management/in-transfer";
				echo "<script>alert('Some data of ".$result." were CXL, Please re-check!');location.href='".$link."'</script>";						
			}
		}
		else
		{			
			$dtTransferIn = $this->TransferModel->get_data_search_intransfer($data);			
			foreach($dtTransferIn as $value)
			{
				$result = $this->TransferModel->chk_State_CXL($value['TBLCodeIn'],'TBLCodeIn');
				if($result=="")
				{
					break;
				}
			}
			if($result=="")
			{
				$this->TransferModel->print_all_intranfer($dtTransferIn);
			}
			else
			{
				$data_post = $this->input->post();			
				$this->session->set_userdata('search_in',$data_post);
				$link  = base_url()."transfer-management/in-transfer";
				echo "<script>alert('Some data of ".$result." were CXL, Please re-check!');location.href='".$link."'</script>";							
			}
		}		
	}
	
	public function print_outtranfer() 
	{
		$code                   = $this->input->post('code',TRUE);              
		$data["table_code"] 	= $this->input->post('table-code',TRUE);
		$data['guest_name'] 	= $this->input->post('guest-name',TRUE);
		$data["car_num"] 		= $this->input->post('car-num',TRUE);
		$data["driver_name"] 	= $this->input->post('driver-name',TRUE);
		$data["guide_name"] 	= $this->input->post('guide-name',TRUE);
		$data["from_date"] 		= $this->input->post('from_date_input',TRUE);
		$data["to_date"] 		= $this->input->post('to_date_input',TRUE);
		if($this->input->post('print_single',TRUE)=="Print")
		{
			$result = $this->TransferModel->chk_State_CXL( $code,"TBLCodeOut");
            //echo $result;
			if($result=="")
			{	
				$dsTransferOut = $this->TransferModel->get_data_search_outtransfer($data);
				$this->TransferModel->print_outtranfer($code,$dsTransferOut); 				        
			}          
			else
			{
				$data_post = $this->input->post();			
				$this->session->set_userdata('search_out',$data_post);
				$link  = base_url()."transfer-management/out-transfer";
				echo "<script>alert('Some data of ".$result." were CXL, Please re-check!');location.href='".$link."'</script>";
			}
		}
		else
		{
			$dsTransferOut    = $this->TransferModel->get_data_search_outtransfer($data);
			foreach ($dsTransferOut as $key => $value)
			{
				$result = $this->TransferModel->chk_State_CXL( $value["TBLCodeOut"],"TBLCodeOut");				
				if($result=="")
				{
					break;
				}
			}			
			
			if($result=="")
			{
				$this->TransferModel->print_all_outtranfer($dsTransferOut);
			}
			else
			{
				$data_post = $this->input->post();			
				$this->session->set_userdata('search_out',$data_post);
				$link  = base_url()."transfer-management/out-transfer";
				echo "<script>alert('Some data of ".$result." were CXL, Please re-check!');location.href='".$link."'</script>";							
			}
		}
	}
	
	public function export_car()
	{
		$data["driver"] 		= $this->input->post('driver_id',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);
		$dt = $this->TransferModel->search_car_report($data);
		
		$dt = $this->sort_array($dt);
		$this->TransferModel->export_car($dt,$data);
	}
	public function export_guide()
	{
		$data["guide"] 			= $this->input->post('guide',TRUE);
		$data['guide_type'] 	        = $this->input->post('guide_type',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);
		$rows = $this->TransferModel->search_guide_report($data);
		$rows = $this->sort_array($rows);
		$this->TransferModel->export_guide($rows,$data);
	}
	public function export_guide_car() 
	{
		$data["vn_code"] 		= $this->input->post('vn_code',TRUE);
		$data['guest_name']     = $this->input->post('guest_name',TRUE);
		$data["city"] 			= $this->input->post('cty',TRUE);
		$data["hotel"] 			= $this->input->post('htel',TRUE);
		$data["from_date"] 		= $this->input->post('from_date',TRUE);
		$data["to_date"] 		= $this->input->post('to_date',TRUE);		
		$this->TransferModel->export_guide_car($data);
	}
	public function check_date()
	{
		$result['msg'] = "";
		$date = $this->input->post('date',TRUE);  

		$data_date = explode('/', $date); 

		if($date == '')
		{
			$result['msg'] = '';
		}
		else
		{
			if(count($data_date) == 3)
			{
				if(!checkdate($data_date[1], $data_date[2], $data_date[0]))
				{
					$result['msg'] = 'Invalid date format !!';
				}
				else
				{
					$result['msg'] = '';
				}
			}
			else
			{
				$result['msg'] = 'Invalid date format !!';
			}
		}
		echo json_encode($result);
	}
	public function check_time()
	{
		$time = $this->input->post('time');
		if($time == '')
		{
			$result['msg'] = '';
		}
		else if(preg_match("/^(2[0-3]|[01]?[0-9]):([0-5][0-9])$/", $time))
		{
			$result['msg'] = '';
		}
		else
		{
			$result['msg'] = 'Invalid time format!!';
		}
		echo json_encode($result);
	}
	public function update_transfer()
	{ 
		$data_booking["bkl_code"]      =  $this->input->post("bkl_code",TRUE);
		$data_booking["tour_id"]       =  $this->input->post("tour_id",TRUE);
		$data_booking["tour_code"]     =  $this->input->post("tour_code",TRUE);
		$data_booking["inflight"]      =  $this->input->post("inflight",TRUE);
		$data_booking["fromplace"]     =  $this->input->post("fromplace",TRUE);
		$data_booking["timein"]        =  $this->input->post("timein",TRUE);
		$data_booking["puin"]          =  $this->input->post("puin",TRUE);
		$data_booking["arrv_date"]     =  $this->input->post("arrv_date",TRUE);
		$data_booking["hotel"]         =  $this->input->post("hotel",TRUE);
		$data_booking["hotel_status"]  =  $this->input->post("hotel_status",TRUE);
		$data_booking["room_type"]     =  $this->input->post("room_type",TRUE);
		$data_booking["room_class"]    =  $this->input->post("room_class",TRUE);
		$data_booking["room_no"]       =  $this->input->post("room_no",TRUE);
		$data_booking["dept_date"]     =  $this->input->post("dept_date",TRUE);
		$data_booking["out_flight"]    =  $this->input->post("out_flight",TRUE);
		$data_booking["to_place"]      =  $this->input->post("to_place",TRUE);
		$data_booking["time_out"]      =  $this->input->post("time_out",TRUE);
		$data_booking["puout_from"]    =  $this->input->post("puout_from",TRUE);
		$data_booking["puout_to"]      =  $this->input->post("puout_to",TRUE);
		$data_booking["note_transfer"] =  $this->input->post("note_transfer",TRUE);
		$data_booking["note_in"]       =  $this->input->post("note_in",TRUE);

		$guest_in_id 				   =  $this->input->post("data_in_id",TRUE);
		$guest_out_id 				   =  $this->input->post("data_out_id",TRUE);
		$guest_in 					   =  $this->input->post("data_in_guest",TRUE);
		$guest_out 					   =  $this->input->post("data_out_guest",TRUE);
		try 
		{
			$this->TransferModel->UpdateData_Grid($data_booking["bkl_code"],$guest_in_id,$guest_in,$guest_out_id,$guest_out);
		} 
		catch (Exception $e) 
		{		
		}
		$this->TransferModel->Del_TBLCodeIn($data_booking);
		$result = $this->TransferModel->update_booking_tranfer_detail($data_booking);
		if($result)
		{
			echo json_encode("Data has been updated successfully.");
		}
		else
		{
			echo json_encode("Data has been updated fail.");
		}
	}
	public function SaveData()
	{
		$tblcodein       = $this->input->post("TBLCodeIn",TRUE);
		$guide_info      = $this->input->post("guide_info",TRUE);
		$car_info        = $this->input->post("car_info",TRUE);
		$schedule_f      = $this->input->post("schedule_f",TRUE);
		$schedule_t      = $this->input->post("schedule_t",TRUE);
		$actual_f        = $this->input->post("actual_f",TRUE);
		$actual_t        = $this->input->post("actual_t",TRUE);
		$search_field    = $this->input->post("search_field",TRUE);
		$data_array_check = $this->input->post("data_array_check",TRUE);				
		$dt=$this->TransferModel->get_info_tour_intransfer($tblcodein,$search_field["date_in"]);
		$data = $this->TransferModel->get_search_booking_transfer_in($dt,$tblcodein);
		$result = $this->TransferModel->SaveData($tblcodein,$guide_info,$car_info,$schedule_f,$schedule_t,$actual_f,$actual_t,$data_array_check,$search_field,$data);    	    	
		if($result=="")
		{
			$rs["msg"] = "";
		}
		else
		{
			$rs["msg"] = $result;
		}
		echo json_encode($rs);
	}

	public function SVData()
	{
		$tblcodeout       = $this->input->post("TBLCodeOut",TRUE);
		$guide_info       = $this->input->post("guide_info",TRUE);		
		$car_info         = $this->input->post("car_info",TRUE);
		$schedule_f       = $this->input->post("schedule_f",TRUE);
		$schedule_t       = $this->input->post("schedule_t",TRUE);
		$actual_f         = $this->input->post("actual_f",TRUE);
		$actual_t         = $this->input->post("actual_t",TRUE);
		$search_field     = $this->input->post("search_field",TRUE);
		$data_array_check = $this->input->post("data_array_check",TRUE);			
		$data = $this->TransferModel->getbookinginforfortransferbycodeout($tblcodeout);		
		$result = $this->TransferModel->SVData($tblcodeout,$guide_info,$car_info,$schedule_f,$schedule_t,$actual_f,$actual_t,$data_array_check,$search_field,$data);    	    			
		if($result=="")
		{
			$rs["msg"] = "";
		}
		else
		{
			$rs["msg"] = $result;
		}
		echo json_encode($rs);
	}

	public function deleteCarReport()
	{
		$deleteIds = $this->input->post("ids");
		if (is_array($deleteIds)) {
			foreach ($deleteIds as $id) {
				$this->db->where('CarDriverID', $id);
				$this->db->delete("cardriver");
			}
		}
	}
	public function updateCarReport() {
		$cars = $this->input->post("cars");
		if (is_array($cars)) {
			foreach ($cars as $car) {
				$this->TransferModel->updateCar($car);
			}
		}
	}

	public function addNewCar()
	{
		$cars = $this->input->post("cars");
		if (is_array($cars)) {
			foreach ($cars as $car) {
				$this->db->select_max("CarDriverID");
				$nextId = $this->db->get("cardriver")->row();
				$car['CarDriverID'] = $nextId->CarDriverID + 1;
				$this->db->insert("cardriver", $car);
			}
		}
	}

	public function deleteGuideReport()
	{
		$deleteIds = $this->input->post("ids");
		if (is_array($deleteIds)) {
			foreach ($deleteIds as $id) {
				$this->db->where('GuideID', $id);
				$this->db->delete("guide");
			}
		}
	}
	public function updateGuideReport() {
		$guides = $this->input->post("guides");
		if (is_array($guides)) {
			foreach ($guides as $guide) {
				$this->TransferModel->updateGuide($guide);
			}
		}
	}

	public function addNewGuide()
	{
		$guides = $this->input->post("guides");
		if (is_array($guides)) {
			foreach ($guides as $guide) {
				$this->db->select_max("GuideID");
				$nextId = $this->db->get("guide")->row();
				$guide['GuideID'] = $nextId->GuideID + 1;

				$this->db->insert("guide", $guide);
			}
		}
	}


	public function delete_tour_optional_common()
	{		
		$tour_code            = $this->input->post("tour_code",TRUE);
		$option_list_id       = $this->input->post("option_list_id",TRUE);
		$count_guest          = $this->input->post("count_guest",TRUE);
		$ds = 	$this->TransferModel->get_optional_tour_reg_common($tour_code);
		$bookingOptionID = ""; 
		foreach($ds as $key => $value)
		{
			if($option_list_id == $value["OptionalTourListID"])
			{
				$bookingOptionID = $value["BookingOptionalID"];
				break;
			}
		}		
		if($bookingOptionID!="")
		{
			$result = $this->TransferModel->delete_tour_optional_common($bookingOptionID,$tour_code,$count_guest);
		}
	}
	public function delete_tour_reg_individual()
	{
		$tour_code            = $this->input->post("tour_code",TRUE);
		$option_list_id       = $this->input->post("option_list_id",TRUE);		
		$count_guest          = $this->input->post("count_guest",TRUE);
		$id_tour              = $this->input->post("id_tour",TRUE);
		$ds_guest             = $this->TransferModel->get_tour_guest($id_tour);
		$ds     			  = $this->TransferModel->get_optional_tour_reg_individual($tour_code,$ds_guest[0]["GuestID"]);
		$bookingOptionID      = "";
		foreach ($ds as $key => $value)
		{
			if($option_list_id==$value["OptionalTourListID"])
			{
				$bookingOptionID = $value["BookingOptionalID"];
				break;
			}
		}
		if($bookingOptionID!="")
		{
			$result = $this->TransferModel->delete_tour_reg_individual($bookingOptionID,$tour_code,$count_guest);
		}		
	}

	public function getComplain() {
		$id = $this->input->get('id');
		$guide = $this->TransferModel->get_type_by_guide($id);
		$data['name'] = empty($guide)? "" : $guide[0]['GuideName'];
		$data['rank'] = empty($guide)? "" : $guide[0]['Type'];

		$this->load->view('Transfer_Management/formComplainInformation', $data);
	}

	public function searchComplain()
	{
		$guide = $this->input->post("guide", true);
		$rank = $this->input->post("rank", true);
		$from = $this->input->post("from", true);
		$to = $this->input->post("to", true);
		$notFinish = $this->input->post("notFinish", true);
		if(!$guide or !$rank) return array();
		$inTransfer = $this->TransferModel->getComplainIntranfer($guide, $rank, $from, $to, $notFinish);
		$outTransfer = $this->TransferModel->getComplainOutTransfer($guide, $rank, $from, $to, $notFinish);
		$transferOptionalTour1 = $this->TransferModel->getComplainTransferOptionalTour1($guide, $rank, $from, $to, $notFinish);
		$transferOptionalTour2 = $this->TransferModel->getComplainTransferOptionalTour2($guide, $rank, $from, $to, $notFinish);

		foreach ($inTransfer as $key => $tour) {
			$inTransfer[$key]['TourName'] = "Transfer-In";
			$pax = $this->TransferModel->CountGuestTI($tour['InID']);
			$inTransfer[$key][] = $pax ? $pax->pax : '0';
		}
		foreach ($outTransfer as $key => $tour) {
			$outTransfer[$key]['TourName'] = "Transfer-Out";
			$pax = $this->TransferModel->CountGuestTO($tour['OutID']);
			$outTransfer[$key][] = $pax ? $pax->pax : '0';
		}
		foreach ($transferOptionalTour1 as $key => $tour) {
			$pax = $this->TransferModel->CountGuestTOTI($tour['OptionalTourID']);
			$transferOptionalTour1[$key][] = $pax ? $pax->pax : '0';
		}
		foreach ($transferOptionalTour2 as $key => $tour) {
			$pax = $this->TransferModel->CountGuestTOTE($tour['OptionalTourID']);
			$transferOptionalTour2[$key][] = $pax ? $pax->pax : '0';
		}

		$data = array_merge($inTransfer, $outTransfer, $transferOptionalTour1, $transferOptionalTour2);
		$filter = array();
		$dataKeys = array("id", "note", "penalty", "finished", "start", "end", "date", "guide", "tel", "tour", "pax");
		foreach($data as $row) {
			if (!in_array($row, $filter)) {
				$temp = array_combine($dataKeys, $row);
				// $pax = $this->TransferModel->CountGuestTOTE($temp['id']);
				// $temp['pax'] = $pax ? $pax->pax : '0';
				$filter[] = $temp;
			}
		}

		// $dataKeys[] = 'pax';
		// $order = $this->input->post('order');
		// if (count($order) > 0) {
		// 	foreach ($order as $key => $value) {
		// 		$dir = $value['dir'];
		// 		$col = $value['column'];

		// 		uasort($filter, function($a, $b) use($dir, $col, $dataKeys){
		// 			if($a[$dataKeys[$col]] > $b[$dataKeys[$col]]) return $dir == 'asc'? false : true;
		// 			return $dir == 'asc'? true : false;
		// 		});
		// 	}
		// }
		
		echo json_encode(array("data" => array_values($filter)));
	}

	public function updateComplain()
	{
		$id = $this->input->post('id', true);
		$penalty = $this->input->post('pen', true);
		$note = $this->input->post('note', true);
		$finished = $this->input->post('fin');
		$tour = $this->input->post('tour', true);

		if ($id and $penalty and $note and $tour) {
			$this->TransferModel->updateComplain($id, $penalty, $note, $tour,$finished);
		}
	}

}