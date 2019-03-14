<?php
/**
 * HotelBooking Manager
 */
defined('BASEPATH') or exit('No direct script access allowed');

class HotelBookingController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->userdata['logged_in'])) {
            $username = ($this->session->userdata['logged_in']['username']);
        } else {
            redirect('AuthenController/index');
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function index()
    {
        $this->get_all();
    }

    public function new_tour()
    {
        $data['location'] = $this->HotelBookingModel->get_location();
        $data['tourstatus'] = $this->HotelBookingModel->get_tour_status();
        $data["max_guest"] = $this->HotelBookingModel->make_id("guest", "GuestID") + 1;
        $data['campaign'] = $this->HotelBookingModel->get_campaign();
        $data['city'] = $this->HotelBookingModel->get_city();
        $data['rclass'] = $this->HotelBookingModel->get_rclass();
        $data['rtype'] = $this->HotelBookingModel->get_rtype();
        $this->load->view('Hotel_booking/formNewTour', $data);
    }

    public function create_new_tour()
    {
        $id_tour = date('Ymdhis', time());
        $dt_tour = $this->input->post('data_tour', TRUE);
        $dt_bk = $this->input->post('data_booking', TRUE);
        $data_guest = $this->input->post('data_guest', TRUE);
        $dt_tour['NPer'] = count($data_guest);
        $result_tour = $this->HotelBookingModel->create_new_tour($id_tour, $dt_tour, $dt_bk);
        if ($dt_bk != "") {
            /* check allotment */
            $this->HotelBookingModel->check_allotment_change_new_tour($dt_tour["VnCode"], $dt_bk);
            /* check allotment */
            $this->HotelBookingModel->create_new_booking($id_tour, $dt_bk);
        }
        $this->HotelBookingModel->create_new_guest($id_tour, $data_guest, $dt_tour);
        $msg = array();

        if ($result_tour) {
            $msg['tourid'] = $id_tour;
        } else {
            $msg["msg"] = "Data create new tour not fail!!";
        }
        echo json_encode($msg);
    }

    public function count_guest($dt_guest)
    {
        $j = 0;
        foreach ($dt_guest as $key => $item) {
            if ($item != "") {
                foreach ($item as $value) {
                    if ($value != "") {
                        $j ++;
                    }
                }
            }
        }
        return $j;
    }

    public function check_tourcode()
    {
        $code = $this->input->post('code', TRUE);
        $result = $this->HotelBookingModel->check_tourcode($code);
        if (count($result) != 0) {
            echo 1;
        } else
            echo 0;
    }

    public function create_VNCode()
    {
        $location = $this->input->post('location', TRUE);
        $arrv_date = $this->input->post('arrv_date', TRUE);
        $code = $location . "-" . substr($arrv_date, 2, 2) . substr($arrv_date, 5, 2) . substr($arrv_date, 8, 2);
        $result = $this->HotelBookingModel->create_VNCode($code, "tourinfo", "VnCode");
        echo json_encode($result);
    }

    public function create_TLTCode()
    {
        $dt["location"] = $this->input->post("location", TRUE);
        $dt["hotel"] = $this->input->post("hotel", TRUE);
        $dt["arrv_date_1"] = $this->input->post("arrv_date_1", TRUE);
        $dt["i_TLTCode"] = $this->input->post("i_TLTCode", TRUE);
        $result = $this->HotelBookingModel->create_TLTCode($dt);
        echo json_encode($result);
    }

    public function create_booking_form_update()
    {
        $data = $this->input->post('data', TRUE);
        $data['TourID'] = $this->input->post('id_tour', TRUE);
        $data['TLTCode'] = trim($this->input->post('tlt_code', TRUE));

        $result = $this->HotelBookingModel->create_booking_form_update($data);
        $msg = array();
        if ($result)
            $msg["msg"] = "Data insert success!!";
        else
            $msg["msg"] = "Data insert fail!!";
        echo json_encode($msg);
    }

    // public function update_tour()
    // {
    // $id_tour = $this->input->get('id',TRUE);
    // $type = $this->input->get('type',TRUE);
    // $data_get = $this->input->get();
    // if(isset($data_get["tourcode"]))
    // {
    // unset($data_get["id"]);
    // $this->session->set_userdata('search_tourinfo',$data_get);
    // }
    // if($type==1)
    // {
    // $booking_get = $this->input->get();
    // $this->session->set_userdata('search_booking',$booking_get);
    // }
    // $data["tour_info"] = $this->HotelBookingModel->get_tour_update($id_tour);
    // $data["max_guest"] = $this->HotelBookingModel->make_id("guest","GuestID")+1;
    // $data["guest"]=$this->HotelBookingModel->get_tour_guest($id_tour);
    // $data['type'] = $type;
    // $data["booking"]=$this->HotelBookingModel->get_info_booking($id_tour, false);
    // $dt1 = $data["booking"];
    // $data['campaign']=$this->HotelBookingModel->get_campaign();
    // $data['type_sr']= $data_get["type_sr"];
    // if(count($dt1)>0)
    // {
    // $dt["arr_date"] = $dt1[0]["ArrvDate1"];
    // $dt["dept_date"] = $dt1[0]["DeptDate1"];
    // $niteno = $this->HotelBookingModel->NoDay_Stage1($dt);
    // $data["NiteNo"] = $niteno;
    // $hotel = $this->HotelBookingModel->get_hotel_city($dt1[0]["City"]);
    // $data['transfer']= $this->HotelBookingModel->Load_Transfer($dt1[0]["City"]);
    // }
    // else
    // {
    // $data['transfer'] = "";
    // $hotel = "";
    // $data["NiteNo"]=0;
    // }
    // $data['tourstatus']=$this->HotelBookingModel->get_tour_status();
    // $data['city']=$this->HotelBookingModel->get_city();
    // $data['hotel'] = $hotel;
    // $data['rclass']=$this->HotelBookingModel->get_rclass();
    // $data['rtype']=$this->HotelBookingModel->get_rtype();
    // $data['hotelstatus']=$this->HotelBookingModel->get_status();

    // $this->load->view('Hotel_booking/formUpdateTour',$data);
    // }
    /**
     * Function: get_infomation update tour page
     * Creater: Le Ngoc Tuan
     *
     * @access public
     *         pagarm no
     *         return json
     */
    public function update_tour()
    {
        $id_tour = $this->input->post('id', TRUE);
        $toure_code = $this->input->post('code', TRUE);
        $tour_info = $this->HotelBookingModel->get_tour_update($id_tour);
        $booking = $this->HotelBookingModel->get_info_booking($id_tour, false);
        $data_tourstatus = $this->HotelBookingModel->get_tour_status();
        $data_campaign = $this->HotelBookingModel->get_campaign();
        $data_guest = $this->HotelBookingModel->get_tour_guest($id_tour);
        $data_city = $this->HotelBookingModel->get_city();
        $max_guest = $this->HotelBookingModel->make_id("guest", "GuestID") + 1;
        $data = array();
        // die(var_dump($booking));
        if (count($booking) > 0) {
            $data["data_booking"] = $booking;
        } else {
            $data["data_booking"] = "";
        }

        /* tour info */
        if (count($tour_info) > 0) {
            $data["location_name"] = $tour_info[0]["Location_name"];
            $data["location_code"] = $tour_info[0]["Location_code"];
            $data["tour_code"] = $toure_code;
            $data["tour_id"] = $id_tour;
            $data["vn_code"] = $tour_info[0]["VnCode"];
            $data["group_name"] = $tour_info[0]["GroupName"];
            $data["tourstatus"] = $tour_info[0]["TourStatus"];
            $data["cam_code"] = $tour_info[0]['Cam_Code'];
            $data["note"] = $tour_info[0]["Note"];
        }
        $data["data_campaign"] = $data_campaign;
        $data["data_tourstatus"] = $data_tourstatus;
        /* end tour info */
        /* booking info */
        if (count($booking) > 0) {
            // $data["Room_List1"] = $booking[0]["Room_List1"];
            // $data["Room_List2"] = $booking[0]["Room_List2"];
            // $data["TLTCode"] = $booking[0]["TLTCode"];
            // $data["VNFlight1DeptDate"] = $booking[0]["VNFlight1DeptDate"];
            // $data["VNFlight1DeptTime"] = $booking[0]["VNFlight1DeptTime"];
            // $data["VNFlight1ArrvTime"] = $booking[0]["VNFlight1ArrvTime"];
            // $data["VNFlight2DeptDate"] = $booking[0]["VNFlight2DeptDate"];
            // $data["VNFlight2DeptTime"] = $booking[0]["VNFlight2DeptTime"];
            // $data["VNFlight2ArrvTime"] = $booking[0]["VNFlight2ArrvTime"];
            // $data["Allotment1_Old"] = $booking[0]["Allotment1_Old"];
            // $data["Allotment2_Old"] = $booking[0]["Allotment2_Old"];
            // $data["City"] = $booking[0]["City"];
            // $data_hotel = $this->HotelBookingModel->get_hotel_city($booking[0]["City"]);
            // $data["data_hotel"] = $data_hotel;
            // $data["Hotel"] = $booking[0]["Hotel"];
            // $data_rtype = $this->HotelBookingModel->get_rtypebyhotelcity($data["Hotel"] ,$data["City"]);
            // $data_rclass = $this->HotelBookingModel->get_rclassbyhotelcity($data["Hotel"] ,$data["City"]);
            $data_transfer = $this->HotelBookingModel->Load_Transfer($data["City"]);
            // $data["Note"] = $booking[0]["Note"];
            // $data["VNFlight1"] = $booking[0]["VNFlight1"];
            // $data["VNFlight2"] = $booking[0]["VNFlight2"];
            // $data["ArrvDate1"] = $booking[0]["ArrvDate1"]!=""?$booking[0]["ArrvDate1"]:"";
            // $data["DeptDate1"] = $booking[0]["DeptDate1"]!=""?$booking[0]["DeptDate1"]:"";
            // $data["SPE1"] = $booking[0]["DeptDate1"]==1?true:false;
            // $data["NiteNo1"] = $booking[0]["NiteNo1"]!=0?$booking[0]["NiteNo1"]:"";
            // $data["PaxNo1"] = $booking[0]["PaxNo1"];
            // $data["Note1"] = $booking[0]["Note1"];
            // $data["RoomType1"] = $booking[0]["RoomType1"]!=""?$booking[0]["RoomType1"]:"";
            // $data["RoomClass1"] = $booking[0]["RoomClass1"]!=""?$booking[0]["RoomClass1"]:"";
            // $data["RoomNo1"] = $booking[0]["RoomNo1"]!=""?$booking[0]["RoomNo1"]:"";
            // $data["CheckOut1"] = $booking[0]["CheckOut1"]!=""?$booking[0]["CheckOut1"]:"";
            // $data["HotelStatus1"] = $booking[0]["HotelStatus1"]!=""?$booking[0]["HotelStatus1"]:"";
        } else {
            // $data["data_hotel"] = "";
            // $data_rtype = "";
            // $data_rclass = "";
            $data_transfer = "";
        }
        /* end booking info */
        /* info guest */
        $data["data_guest"] = $data_guest;
        /* end info guest */
        /* info city */
        $data["city"] = $data_city;
        /* end info city */
        /* info data transfer */
        $data["data_transfer"] = $data_transfer;
        /* end info data transfer */
        /* info max_guest */
        $data["max_guest"] = $max_guest;
        /* end max_guest */
        echo json_encode($data);
        // die(var_dump($data["tour_info"]));
        // $data_get = $this->input->get();
        // if(isset($data_get["tourcode"]))
        // {
        // unset($data_get["id"]);
        // $this->session->set_userdata('search_tourinfo',$data_get);
        // }
        // if($type==1)
        // {
        // $booking_get = $this->input->get();
        // $this->session->set_userdata('search_booking',$booking_get);
        // }
        // $data["tour_info"] = $this->HotelBookingModel->get_tour_update($id_tour);
        // $data["max_guest"] = $this->HotelBookingModel->make_id("guest","GuestID")+1;
        // $data["guest"]=$this->HotelBookingModel->get_tour_guest($id_tour);
        // $data['type'] = $type;
        // $data["booking"]=$this->HotelBookingModel->get_info_booking($id_tour, false);
        // $dt1 = $data["booking"];
        // $data['campaign']=$this->HotelBookingModel->get_campaign();
        // $data['type_sr']= $data_get["type_sr"];
        // if(count($dt1)>0)
        // {
        // $dt["arr_date"] = $dt1[0]["ArrvDate1"];
        // $dt["dept_date"] = $dt1[0]["DeptDate1"];
        // $niteno = $this->HotelBookingModel->NoDay_Stage1($dt);
        // $data["NiteNo"] = $niteno;
        // $hotel = $this->HotelBookingModel->get_hotel_city($dt1[0]["City"]);
        // $data['transfer']= $this->HotelBookingModel->Load_Transfer($dt1[0]["City"]);
        // }
        // else
        // {
        // $data['transfer'] = "";
        // $hotel = "";
        // $data["NiteNo"]=0;
        // }
        // $data['tourstatus']=$this->HotelBookingModel->get_tour_status();
        // $data['city']=$this->HotelBookingModel->get_city();
        // $data['hotel'] = $hotel;
        // $data['rclass']=$this->HotelBookingModel->get_rclass();
        // $data['rtype']=$this->HotelBookingModel->get_rtype();
        // $data['hotelstatus']=$this->HotelBookingModel->get_status();

        // $this->load->view('Hotel_booking/formUpdateTour',$data);
    }

    public function get_booking_info_update()
    {
        $bookingID = $this->input->post('bookingID', TRUE);
        $TLTCode = $this->input->post('TLTCode', TRUE);
        $rows = $this->HotelBookingModel->get_booking_info_update($bookingID, $TLTCode);

        $result["booking"] = $rows;
        echo json_encode($result);
    }

    public function delete_booking()
    {
        $bookingID = $this->input->post('TourID', TRUE);
        $TLTCode = $this->input->post('TLTCode', TRUE);
        $rows = $this->HotelBookingModel->delete_booking($bookingID, $TLTCode);
        $result["booking"] = $rows;
        echo json_encode($result);
    }

    public function update_booking()
    {
        $data = $this->input->post('data', TRUE);
        $bookingID = $this->input->post('TourID', TRUE);
        $TLTCode = $this->input->post('TLTCode', TRUE);
        $result = $this->HotelBookingModel->update_booking($bookingID, $TLTCode, $data);
        $msg = array();
        if ($result)
            $msg["msg"] = "Data updated success!!";
        else
            $msg["msg"] = "Data update fail!!";
        echo json_encode($msg);
    }

    public function update_tour_info()
    {
        $tour_code = $this->input->post('tour_code', TRUE);
        $data = $this->input->post('data', TRUE);
        $result = $this->HotelBookingModel->update_tour_info($tour_code, $data);

        $msg = array();
        if ($result)
            $msg["msg"] = "Data update success!!";
        else
            $msg["msg"] = "Data update fail!!";
        echo json_encode($msg);
    }

    public function save_update_tour()
    {
        $id_tour = $this->input->post('TourID', TRUE);
        $data_tour = $this->input->post('data', TRUE);
        $data_guest = $this->input->post('data_guest', TRUE);
        $data_id = $this->input->post('data_id', TRUE);
        $location_code = $data_tour["Location_Code"];
        $data_booking = $this->input->post('data_booking', TRUE);
        $AllontmentID1 = $this->input->post('AllontmentID1', TRUE);
        $AllontmentID2 = $this->input->post('AllontmentID2', TRUE);
        $roomno_stage1 = $this->input->post('roomno_stage1', TRUE);
        $roomno_stage2 = $this->input->post('roomno_stage2', TRUE);
        $delete_booking = $this->input->post('delete_booking', TRUE);
        $dt_guest = $this->input->post('dt_guest', TRUE);
        $dt_id = $this->input->post('dt_id', TRUE);
        $vn_code = $data_tour["VnCode"];
        $data_tour['NPer'] = count($data_guest);
        $result1 = $this->HotelBookingModel->update_tourinfo($id_tour, $data_tour, $data_booking);
        $result2 = $this->HotelBookingModel->update_guestinfo($id_tour, $data_guest, $data_id, $location_code, $dt_guest, $dt_id);
        $result3 = $this->HotelBookingModel->update_booking_info($id_tour, $data_booking, $AllontmentID1, $AllontmentID2, $roomno_stage1, $roomno_stage2, $delete_booking, $vn_code);
        if ($result1 == true) {
            $result["msg_tour"] = "";
        } else {
            $result["msg_tour"] = $result1;
        }

        if ($result2 == true) {
            $result["msg_guest"] = "";
        } else {
            $result["msg_guest"] = $result2;
        }

        if ($result3 == true) {
            $result["msg_booking"] = "";
        } else {
            $result["msg_booking"] = $result3;
        }
        // die(var_dump($result));
        echo json_encode($result);
    }

    public function delete_tour()
    {
        $id_tour = $this->input->post('id_tour', TRUE);
        $result = $this->HotelBookingModel->delete_tour($id_tour);
        if ($result)
            die("OK");
    }

    /**
     * Function: get_infomation tour detail
     * Creater: Le Ngoc Tuan
     *
     * @access public
     *         pagarm no
     *         return json
     */
    public function tour_detail()
    {
        $id_tour = $this->input->post('id', TRUE);
        $toure_code = $this->input->post('code', TRUE);
        $data = array();
        $tour_info = $this->HotelBookingModel->get_tour_update($id_tour);
        $data["guest"] = $this->HotelBookingModel->get_tour_guest($id_tour);
        $booking = $this->HotelBookingModel->get_info_booking($id_tour, false);
        $data["booking"] = $booking;
        if (count($tour_info) > 0) {
            $data["location_name"] = $tour_info[0]["Location_name"];
            $data["location_code"] = $tour_info[0]["Location_code"];
            $data["tour_code"] = $toure_code;
            $data["tour_id"] = $id_tour;
            $data["vn_code"] = $tour_info[0]["VnCode"];
            $data["group_name"] = $tour_info[0]["GroupName"];
            $data["tourstatus"] = $tour_info[0]["TourStatus"];
            $cam_code = $tour_info[0]['Cam_Code'];
            if ($cam_code != "") {
                $campaign = $this->HotelBookingModel->get_campaignbycode($cam_code);
                $data['campaign'] = $campaign[0]["Cam_Name"];
            } else {
                $data['campaign'] = "";
            }
            $data["note"] = $tour_info[0]["Note"];
        }
        echo json_encode($data);
    }

    public function allotment_detail()
    {
        $data['city'] = $this->HotelBookingModel->get_city();
        $data['hotel'] = $this->HotelBookingModel->get_hotel();
        $data['allotment_info'] = $this->HotelBookingModel->get_allotment_price("", "");
        $this->load->view('Hotel_booking/formAllotmentDetail', $data);
    }

    public function allotment_report()
    {
        $data['city'] = $this->HotelBookingModel->get_city();
        $data['hotel'] = $this->HotelBookingModel->get_hotel();
        $this->load->view('Hotel_booking/formAllotmentReport', $data);
    }

    public function hotel_list()
    {
        $data['cities'] = $this->HotelBookingModel->get_city();
        $data['hotel'] = $this->HotelBookingModel->get_hotel();
        $this->load->view('Hotel_booking/formHotelList', $data);
    }

    public function search_hotel_lists()
    {}

    public function booking_report()
    {
        $data['location'] = $this->HotelBookingModel->get_location();
        $data['city'] = $this->HotelBookingModel->get_city();
        $data['hotel'] = $this->HotelBookingModel->get_hotel();

        $this->load->view('Hotel_booking/formBookingReport', $data);
    }

    public function get_booking_report()
    {
        $data['location_is_checked'] = $this->input->post('location_is_checked', TRUE);
        $data["city"] = $this->input->post('city', TRUE);
        $data['hotel'] = $this->input->post('hotel', TRUE);
        $data["location"] = $this->input->post('location', TRUE);

        $data["arrv_check"] = $this->input->post('arrv_check', TRUE);
        $data["dept_check"] = $this->input->post('dept_check', TRUE);

        $data["arrv_date_1"] = $this->input->post('arrv_date_1', TRUE);
        $data["arrv_date_2"] = $this->input->post('arrv_date_2', TRUE);
        $data["dept_date_1"] = $this->input->post('dept_date_1', TRUE);
        $data["dept_date_2"] = $this->input->post('dept_date_2', TRUE);
        $rows = $this->HotelBookingModel->get_booking_report($data);
        if (count($rows) != 0) {
            $result["msg"] = "true";
            $result["data"] = $rows;

            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    public function get_booking_report_cancel()
    {
        $data['location_is_checked'] = $this->input->post('location_is_checked', TRUE);
        $data["city"] = $this->input->post('city', TRUE);
        $data['hotel'] = $this->input->post('hotel', TRUE);
        $data["location"] = $this->input->post('location', TRUE);

        $data["arrv_check"] = $this->input->post('arrv_check', TRUE);
        $data["dept_check"] = $this->input->post('dept_check', TRUE);

        $data["arrv_date_1"] = $this->input->post('arrv_date_1', TRUE);
        $data["arrv_date_2"] = $this->input->post('arrv_date_2', TRUE);
        $data["dept_date_1"] = $this->input->post('dept_date_1', TRUE);
        $data["dept_date_2"] = $this->input->post('dept_date_2', TRUE);
        $rows = $this->HotelBookingModel->get_booking_report_cancel($data);

        if (count($rows) != 0) {
            $result["msg"] = "true";
            $result["data"] = $rows;
            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    public function waitting_list()
    {
        $data['city'] = $this->HotelBookingModel->get_city();
        $data['hotel'] = $this->HotelBookingModel->get_hotel();
        $data['waitting_list'] = $this->HotelBookingModel->load_waitting_list();
        $this->load->view('Hotel_booking/formWaittingList', $data);
    }

    public function flight_information()
    {
        $data["name"] = '';
        $data['place'] = '';
        $data['time'] = '';
        $data['note'] = '';
        $data["check_flag"] = 'from';

        $data["flight"] = $this->HotelBookingModel->load_all_flight();
        $this->load->view('Hotel_booking/formFlightInformation', $data);
    }

    /**
     * Function: get_infomation history and search history
     * Creater: Le Ngoc Tuan
     *
     * @access public
     *         pagarm no
     *         return json
     */
    public function history()
    {
        $id_tour = $this->input->post('id', TRUE);
        $data = array();
        $data["history"] = $this->HotelBookingModel->get_history($id_tour);
        echo json_encode($data);
    }

    public function search_history()
    {
        $data["tour_code"] = $this->input->post('tour_code', TRUE);
        $data["vn_code"] = $this->input->post('vn_code', TRUE);
        $rows = $this->HotelBookingModel->search_history($data);
        // $output = "";
        // foreach ($rows as $key => $value)
        // {
        // $output .= "<tr>";
        // $output .= "<td style='width:160px'>".(($value["DateTime"]!="NULL")?$value["DateTime"]:"")."</td>";
        // $output .= "<td style='width:120px'>".(($value["FieldName"]!="NULL")?$value["FieldName"]:"")."</td>";
        // $output .= "<td style='width:130px'>".(($value["OldValue"]!="NULL")?$value["OldValue"]:"")."</td>";
        // $output .= "<td style='width:200px'>".(($value["NewValue"]!="NULL")?$value["NewValue"] :"")."</td>";
        // $output .= "<td style='width:100px'>".(($value["Computer"]!="NULL")?$value["Computer"]:"")."</td>";
        // $output .= "<td style='width:100px'>".(($value["User"]!="NULL")?$value["User"]:"")."</td>";
        // $output .= "</tr>";
        // }
        if (count($rows) != 0) {
            $result["msg"] = "true";
            $result["dt"] = $rows;
            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    public function new_flight()
    {
        $data['flag'] = $this->input->get('flag');
        $this->load->view('Hotel_booking/formNewFlightInformation', $data);
    }

    public function add_new_flight()
    {
        $rb = 0;
        if ($this->input->post('check_flag', TRUE) == "from") {
            $rb = 0;
        } else {
            $rb = 1;
        }
        $data = array(
            'FltName' => $this->input->post('name', TRUE),
            'FltPlace' => $this->input->post('place', TRUE),
            'FltTime' => $this->input->post('time', TRUE),
            'FltNote' => $this->input->post('note', TRUE),
            'FltFlg' => $rb
        );
        $result = $this->HotelBookingModel->add_new_flight($data);

        $msg = array();
        if ($result)
            $msg["msg"] = "Add New Flight success!!";
        else
            $msg["msg"] = "Add New Flight fail!!";
        echo json_encode($msg);
    }

    public function update_flight()
    {
        $id_flight = $this->input->get('id', TRUE);
        $data["flight_info"] = $this->HotelBookingModel->get_flight_update($id_flight);
        $this->load->view('Hotel_booking/formUpdateFlightInformation', $data);
    }

    public function update_flight_info()
    {
        $rb = 0;
        $id_flight = $this->input->post('id', TRUE);
        if ($this->input->post('check_flag', TRUE) == "from") {
            $rb = 0;
        } else {
            $rb = 1;
        }

        $data_update = array(
            'FltName' => $this->input->post('name', TRUE),
            'FltPlace' => $this->input->post('place', TRUE),
            'FltTime' => $this->input->post('time', TRUE),
            'FltNote' => $this->input->post('note', TRUE),
            'FltFlg' => $rb
        );

        $result = $this->HotelBookingModel->update_flight_info($data_update, $id_flight);

        $msg = array();
        if ($result)
            $msg["msg"] = "Data updated success!!";
        else
            $msg["msg"] = "Data update fail!!";
        echo json_encode($msg);
    }

    public function delete_flight()
    {
        $id_flight = $this->input->post('id_flight', TRUE);
        $result = $this->HotelBookingModel->delete_flight($id_flight);
        $msg = array();
        if ($result)
            $msg["msg"] = "true";
        else
            $msg["msg"] = "false";
        echo json_encode($msg);
    }

    public function get_all()
    {
        $data['location'] = $this->HotelBookingModel->get_location();
        $data['tourstatus'] = $this->HotelBookingModel->get_tour_status();
        $data['city'] = $this->HotelBookingModel->get_city();
        $data['hotel'] = $this->HotelBookingModel->get_hotel();
        $data['campaign'] = $this->HotelBookingModel->get_campaign();
        if ($sr_bk = $this->input->get("sr_bk")) {
            $data['sr_bk'] = $sr_bk;
        }
        if ($this->session->userdata('search_booking') !== false && empty($sr_bk)) {
            $data['search_booking'] = $this->session->userdata('search_booking');
            $this->session->unset_userdata('search_booking');
        } else {
            $this->session->unset_userdata('search_booking');
        }
        $this->load->view('formMain', $data);
    }

    public function ajax_call()
    {
        $city = $this->input->post('city', TRUE);
        $rows = $this->HotelBookingModel->get_hotel_by_city($city);
        $output = '<option value=""></option>';
        foreach ($rows as $row) {
            $output .= "<option value='" . $row->HotelName . "'>" . $row->HotelName . "</option>";
        }
        echo $output;
    }

    public function get_rclass_by_hotel()
    {
        $hotel = $this->input->post('hotel', TRUE);
        $rows = $this->HotelBookingModel->get_rclass_by_hotel($hotel);
        $output = '<option value=""></option>';
        foreach ($rows as $row) {
            $result = explode(';', $row->RoomClass);
            foreach ($result as $value) {
                $output .= "<option value='" . $value . "'>" . $value . "</option>";
            }
        }
        echo $output;
    }

    public function get_rtype_by_hotel()
    {
        $hotel = $this->input->post('hotel', TRUE);
        $rows = $this->HotelBookingModel->get_rtype_by_hotel($hotel);
        $output = '<option value=""></option>';
        foreach ($rows as $row) {
            $result = explode(';', $row->RoomType);
            foreach ($result as $value) {
                $output .= "<option value='" . $value . "'>" . $value . "</option>";
            }
        }
        echo $output;
    }

    public function get_data_search_tour_info()
    {
        ini_set('memory_limit', '1024M');
        $data["location"] = $this->input->post('location', TRUE);
        $data["tour_code"] = $this->input->post('tour_code', TRUE);
        $data['vn_code'] = $this->input->post('vn_code', TRUE);
        $data["tour_status"] = $this->input->post('tour_status', TRUE);
        $data["guest_name"] = $this->input->post('guest_name', TRUE);
        $data["campaign"] = $this->input->post('campaign', TRUE);

        $data["hotel_status"] = $this->input->post('hotel_status', TRUE);
        $data["blk_code"] = $this->input->post('blk_code', TRUE);
        $data["city"] = $this->input->post('city', TRUE);
        $data["hotel"] = $this->input->post('hotel', TRUE);
        $data["flight_in"] = $this->input->post('flight_in', TRUE);
        $data["flight_out"] = $this->input->post('flight_out', TRUE);
        $data["arrv_check"] = $this->input->post('arrv_check', TRUE);
        $data["dept_check"] = $this->input->post('dept_check', TRUE);

        $data["arrv_date_1"] = $this->input->post('arrv_date_1', TRUE);
        $data["arrv_date_2"] = $this->input->post('arrv_date_2', TRUE);
        $data["dept_date_1"] = $this->input->post('dept_date_1', TRUE);
        $data["dept_date_2"] = $this->input->post('dept_date_2', TRUE);
        $data["type"] = $this->input->post('type', TRUE);
        $rows = $this->HotelBookingModel->get_data_search_tour_info($data);
        $result["msg"] = "true";
        if (count($rows) > 0) {
            $totals = $this->count_night_tour($rows, $data);
            $result["tableData"] = $rows;
            $result["data"]["count_tour"] = $totals['sumt'];
            $result["data"]["count_booking"] = $totals['sumb'];
            $result["data"]["count_guest"] = $totals['sumg'];
            $result["data"]["count_room"] = $totals['sumr'];
            $result["data"]["count_night"] = $totals['sumn'];
        } else {
            $result["msg"] = "false";
        }
        echo json_encode($result);
    }

    public function get_data_find_tour_info()
    {
        $data["location"] = $this->input->post('location', TRUE);
        $data["tour_code"] = $this->input->post('tour_code', TRUE);
        $data['vn_code'] = $this->input->post('vn_code', TRUE);
        $data["tour_status"] = $this->input->post('tour_status', TRUE);
        $data["guest_name"] = $this->input->post('guest_name', TRUE);
        $data["hotel_status"] = $this->input->post('hotel_status', TRUE);
        $data["tlt_code"] = $this->input->post('tlt_code', TRUE);
        $data["city"] = $this->input->post('city', TRUE);
        $data["hotel"] = $this->input->post('hotel', TRUE);
        $data["flight_in"] = $this->input->post('flight_in', TRUE);
        $data["flight_out"] = $this->input->post('flight_out', TRUE);
        $data["arrv_check"] = $this->input->post('arrv_check', TRUE);
        $data["dept_check"] = $this->input->post('dept_check', TRUE);
        $data["type"] = $this->input->post('type', TRUE);
        $data["arrv_date_1"] = $this->input->post('arrv_date_1', TRUE);
        $data["arrv_date_2"] = $this->input->post('arrv_date_2', TRUE);
        $data["dept_date_1"] = $this->input->post('dept_date_1', TRUE);
        $data["dept_date_2"] = $this->input->post('dept_date_2', TRUE);

        $rows = $this->HotelBookingModel->get_data_find_tour_info($data);
        if (count($rows) != 0) {
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
        $bookingID = $this->input->post('bookingID', TRUE);
        $rows_transfer = $this->HotelBookingModel->get_info_booking($bookingID, false);
        if (count($rows_transfer) > 0) {
            $result["tableData"] = $rows_transfer;
            $result["msg"] = true;
        } else {
            $result["msg"] = false;
        }
        echo json_encode($result);
    }

    public function get_data_search_hotel_list()
    {
        $data["city"] = $this->input->post('city', TRUE);
        $data['hotel'] = $this->input->post('hotel', TRUE);
        $data['id'] = $this->input->post('id', TRUE);
        $rows = $this->HotelBookingModel->get_data_search_hotel_list($data);
        echo json_encode(array(
            'tableData' => $rows
        ));
    }

    public function get_hotel_info_update()
    {
        $hotelID = $this->input->post('hotelid', TRUE);
        $rows = $this->HotelBookingModel->get_hotel_info_update($hotelID);
        $result["hotel"] = $rows;
        echo json_encode($result);
    }

    public function update_hotel()
    {
        $msg = array();
        $data = $this->input->post('data', TRUE);
        $HotelID = $this->input->post('HotelID', TRUE);
        $check_hotel = $this->HotelBookingModel->CheckInput($HotelID, $data);
        if ($check_hotel != "") {
            $msg["msg"] = "Hotel existed.";
            $msg['error'] = 1;
        } else {
            if ($HotelID != "new") {
                $result = $this->HotelBookingModel->update_hotel($HotelID, $data);
                if ($result) {
                    $msg["msg"] = "Data updated success!!!";
                    $msg['error'] = 0;
                    $msg['data'] = $HotelID;
                }
            } else {
                $data['HotelID'] = $this->HotelBookingModel->insertHotel($data);
                if ($data['HotelID'] != "") {
                    $msg['msg'] = "Data insert success!!!";
                    $msg['error'] = 0;
                    $msg['data'] = $data['HotelID'];
                }
            }
        }
        echo json_encode($msg);
    }

    public function get_data_search_flight_information()
    {
        $data["name"] = $this->input->post('name', TRUE);
        $data['place'] = $this->input->post('place', TRUE);
        $data['time'] = $this->input->post('time', TRUE);
        $data['note'] = $this->input->post('note', TRUE);
        $data["check_flag"] = $this->input->post('check_flag', TRUE);
        $rows = $this->HotelBookingModel->get_data_search_flight_information($data);
        foreach ($rows as $key => $value) {
            $rows[$key]['index'] = $key + 1;
        }
        echo json_encode(array(
            "tableData" => $rows
        ));
    }

    public function get_data_search_waitting_list()
    {
        $data["tour_code"] = $this->input->post('tour_code', TRUE);
        $data['vn_code'] = $this->input->post('vn_code', TRUE);
        $data['blk_code'] = $this->input->post('blk_code', TRUE);
        $data['city'] = $this->input->post('city', TRUE);
        $data['hotel'] = $this->input->post('hotel', TRUE);
        $rows = $this->HotelBookingModel->get_data_search_waitting_list($data);

        if (count($rows) != 0) {
            $result["msg"] = "true";
            $result["data"] = $rows;
            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    public function get_data_hotel_detail()
    {
        $hotelID = $this->input->post('hotel_ID', TRUE);
        $row = $this->HotelBookingModel->get_data_hotel_detail($hotelID);

        if (count($row) != 0) {
            $result["msg"] = "true";
            $result["data"] = $row;
            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    public function get_hotel_by_city()
    {
        $city = $this->input->post('city', TRUE);
        $rows = $this->HotelBookingModel->get_hotel_by_city($city);
        $output = '<option value=""></option>';
        foreach ($rows as $row) {
            $output .= "<option value='" . $row->HotelName . "'>" . $row->HotelName . "</option>";
        }
        echo $output;
    }

    public function get_hotelalias()
    {
        $hotel = $this->input->post('hotelname', TRUE);
        $rows = $this->HotelBookingModel->get_hotelalias($hotel);
        $result = "";
        foreach ($rows as $row) {
            $result = $row["HotelAlias"];
        }
        if ($result == "") {
            echo "";
        } else {
            echo $result;
        }
    }

    public function get_room_hotel()
    {
        $city = $this->input->post('city', TRUE);
        $hotel = $this->input->post('hotel', TRUE);
        $rows = $this->HotelBookingModel->get_room_hotel($hotel, $city);
        $output = '<option value=""></option>';
        foreach ($rows as $row) {
            $output .= "<option value='" . $row . "'>" . $row . "</option>";
        }
        echo $output;
    }

    public function search_allotment_report()
    {
        $msg = array();
        $data_post = $this->input->post();
        $data_where = array();
        if ($data_post["hotel"] != "") {
            $data_where["HotelName"] = $data_post["hotel"];
        }
        if ($data_post["room_class"] != "") {
            $data_where["RoomClass"] = $data_post["room_class"];
        }
        if ($data_post["date_from"] != "") {
            $data_where["Date >= "] = $data_post["date_from"];
        }
        if ($data_post["date_to"] != "") {
            $data_where["Date <= "] = $data_post["date_to"];
        }
        $row = $this->HotelBookingModel->search_allotment_report($data_where);
        if (count($row) != 0) {
            $result["msg"] = "true";
            $result["data"] = $row;
            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    public function search_allotment_price()
    {
        $msg = array();
        $city = $this->input->post('city', TRUE);
        $hotel = $this->input->post('hotel', TRUE);
        $row = $this->HotelBookingModel->get_allotment_price($city, $hotel);
        if (count($row) != 0) {
            $result["msg"] = "true";
            $result["data"] = $row;
            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    public function create_allotment_price()
    {
        $data = $this->input->post('data', TRUE);
        $sql = "SELECT FromDate,ToDate FROM Allotment WHERE City='" . $data['City'] . "' and HotelName='" . $data['HotelName'] . "' and RoomClass='" . $data['RoomClass'] . "'";
        $list = $this->db->query($sql)->result_array();
        foreach ($list as $value) {
            if (strtotime($data['FromDate']) >= strtotime($value['FromDate']) && strtotime($data['FromDate']) <= strtotime($value['ToDate'])) {
                $msg["msg"] = 'The chosen date is duplicate with exist allotment. Please try again';
                echo json_encode($msg);
                exit();
            }
            if (strtotime($data['ToDate']) >= strtotime($value['FromDate']) && strtotime($data['ToDate']) <= strtotime($value['ToDate'])) {
                $msg["msg"] = 'The chosen date is duplicate with exist allotment. Please try again';
                echo json_encode($msg);
                exit();
            }
            if (strtotime($data['FromDate']) < strtotime($value['FromDate']) && strtotime($data['ToDate']) > strtotime($value['FromDate'])) {
                $msg["msg"] = 'The chosen date is duplicate with exist allotment. Please try again';
                echo json_encode($msg);
                exit();
            }
            if (strtotime($data['FromDate']) < strtotime($value['FromDate']) && strtotime($data['ToDate']) > strtotime($value['FromDate'])) {
                $msg["msg"] = "The chosen date is duplicate with exist allotment. Please try again";
                echo json_encode($msg);
                exit();
            }
        }

        $result = $this->HotelBookingModel->create_allotment_price($data);
        if ($result) {
            $msg["msg"] = "Data insert success!!";
            $msg["status"] = 'success';
        } else
            $msg["msg"] = "Data insert fail!!";
        echo json_encode($msg);
    }

    public function export_ExcelBookingForm()
    {
        $tourId = $this->input->post('tour_id', TRUE);
        $tltCode = $this->input->post('tltcode', TRUE);
        $result = $this->HotelBookingModel->export_ExcelBookingForm($tourId, $tltCode);
        if ($result === false) {
            $data_post = $this->input->post();
            $this->session->set_userdata('search_booking', $data_post);
            $link = base_url() . "hotel-booking";
            echo "<script>location.href='" . $link . "';</script>";
        }
    }

    /*
     * Function export waiting list to excel
     * Parameter: none
     * Return: json array
     * Author: Huy Nguyen
     */
    public function export_ExcelWaitingListForm()
    {
        if ($this->input->post('print_waitting_home', TRUE) == "Print") {
            $arr_tourcode = $this->input->post('array_tourcode', TRUE);
            $array_tltcode = $this->input->post('array_tltcode', TRUE);
            $arr_tourcode = explode(",", $arr_tourcode);
            $array_tltcode = explode(",", $array_tltcode);
            $arr_data = array();
            for ($i = 0; $i <= count($arr_tourcode) - 1; $i ++) {
                if ($arr_tourcode[$i] != "") {
                    $arr_data[$i]["TourCode"] = $arr_tourcode[$i];
                }
                if ($array_tltcode[$i] != "") {
                    $arr_data[$i]["TLTCode"] = $array_tltcode[$i];
                }
            }
            $this->HotelBookingModel->export_ExcelWaitingListForm($arr_data);
        } else {
            $link = base_url() . "hotel-booking";
            echo "<script>location.href='" . $link . "';</script>";
        }
    }

    public function delete_allotment_price()
    {
        $idAllotment = $this->input->post('id', TRUE);
        $result = $this->HotelBookingModel->delete_allotment_price($idAllotment);
        $msg["msg"] = $result;
        echo json_encode($msg);
    }

    /*
     * Function count tour
     * Parameter: array of tour
     * Return: int
     * Author: Huy Nguyen
     */
    public function count_tour($arr_tour)
    {
        $result = 0;
        foreach ($arr_tour as $key => $value) {
            if ($value['TourStatus'] != "CXL")
                $result += 1;
        }
        return $result;
    }

    /*
     * Function count booking of tour
     * Parameter: array of tour
     * Return: int
     * Author: Huy Nguyen
     */
    public function count_booking_tour($arr_tour)
    {
        $result = 0;
        foreach ($arr_tour as $key => $value) {
            if ($value['TourStatus'] != "CXL") {
                $result += count($this->HotelBookingModel->get_booking_of_tour($value["TourID"]));
            }
        }
        return $result;
    }

    /*
     * Function count room of tour
     * Parameter: array of tour
     * Return: int
     * Author: Huy Nguyen
     */
    public function count_room_tour($arr_tour)
    {
        $result = 0;
        foreach ($arr_tour as $key => $value) {
            if ($value['TourStatus'] != "CXL") {
                $rows = $this->HotelBookingModel->get_booking_of_tour($value["TourID"]);
                foreach ($rows as $key1 => $value1) {
                    $str_RT_One = $value1["RoomType1"];
                    $str_RT_Two = $value1["RoomType2"];
                    $str_RL_One = $value1["Room_List1"];
                    $str_RL_Two = $value1["Room_List2"];

                    if (strlen($str_RT_One) > 0 || strlen($str_RT_Two) > 0) {
                        $result += $this->exec_Total($str_RT_One);
                        $result += $this->exec_Total($str_RT_Two);
                    } else {
                        $result += $this->exec_Total($str_RL_One);
                        $result += $this->exec_Total($str_RL_Two);
                    }
                }
            }
        }
        return $result;
    }

    /*
     * Function count night of tour
     * Parameter: array of tour
     * Return: int
     * Author: Huy Nguyen
     */
    public function count_night_tour($arr_tour, $data)
    {
        $result = array(
            'sumb' => 0,
            "sumg" => 0,
            "sumt" => 0,
            "sumn" => 0,
            "sumr" => 0
        );
        foreach ($arr_tour as $key => $value) {
            if ($value['TourStatus'] != "CXL") {
                $dtBooking = $this->HotelBookingModel->getDTBooking($data, $value["TourID"]);
                $dtRoom = $this->HotelBookingModel->getDTRoom($value["TourID"]);
                $rows = $this->HotelBookingModel->get_night_of_tour($value["TourID"], $data);

                $result['sumb'] += count($dtRoom);
                $result['sumg'] += $value['NPer'];
                $result['sumt'] += 1;

                $bookingRows = $this->HotelBookingModel->get_booking_of_tour($value["TourID"]);
                foreach ($bookingRows as $key1 => $value1) {
                    $str_RT_One = $value1["RoomType1"];
                    $str_RT_Two = $value1["RoomType2"];
                    $str_RL_One = $value1["Room_List1"];
                    $str_RL_Two = $value1["Room_List2"];

                    if (strlen($str_RT_One) > 0 || strlen($str_RT_Two) > 0) {
                        $result['sumr'] += $this->exec_Total($str_RT_One);
                        $result['sumr'] += $this->exec_Total($str_RT_Two);
                    } else {
                        $result['sumr'] += $this->exec_Total($str_RL_One);
                        $result['sumr'] += $this->exec_Total($str_RL_Two);
                    }
                }
                foreach ($rows as $key1 => $value1) {
                    $result['sumn'] += $value1["NiteNo"];
                }
            }
        }
        if ($data['city'] and $data['hotel']) {
            $result['sumn'] = 0;
            $dt = $this->HotelBookingModel->loadRoom($data['hotel'], $data['city']);
            $arrRoomType = array();
            $arrRoomClass = array();
            if (! empty($dt)) {
                $arrRoomType = explode(";", $dt[0]['RoomType']);
                $arrRoomClass = explode(";", $dt[0]['RoomClass']);
            }

            if (! empty($arrRoomClass) and ! empty($arrRoomType)) {
                $tableSuccess = $this->HotelBookingModel->get_Tour_Success($data);
                foreach ($arrRoomType as $type) {
                    foreach ($arrRoomClass as $class) {
                        $result['sumn'] += $this->HotelBookingModel->ParseTotalNiteNo($type, $class, $tableSuccess);
                    }
                }
            }
        }
        return $result;
    }

    /*
     * Function count guest of tour
     * Parameter: array of tour
     * Return: int
     * Author: Huy Nguyen
     */
    public function count_guest_tour($arr_tour)
    {
        $result = 0;
        foreach ($arr_tour as $key => $value) {
            if ($value['TourStatus'] != "CXL") {
                $result += intval($value["NPer"]);
            }
        }
        return $result;
    }

    /*
     * Function count total room of tour
     * Parameter: array of tour
     * Return: int
     * Author: Huy Nguyen
     */
    public function exec_Total($str_String)
    {
        $i_Result = 0;
        $str_Save_char = '';
        if (strlen($str_String) == 3) {
            $i_Result = 1;
        } else {
            for ($i_Next = 0; $i_Next <= strlen($str_String) - 1; $i_Next ++) {
                $str_Char = substr($str_String, $i_Next, 1);
                if (is_numeric($str_Char)) {
                    if (strlen($str_Save_char) == 0) {
                        $str_Save_char = (string) $str_Char;
                    } else {
                        $str_Save_char .= (string) $str_Char;
                    }
                } else if (! is_numeric($str_Char)) {
                    if (strlen($str_Save_char) > 0) {
                        if ($i_Result == 0) {
                            $i_Result = (int) $str_Save_char;
                            $str_Save_char = '';
                        } else {
                            $i_Result += (int) $str_Save_char;
                            $str_Save_char = '';
                        }
                    }
                } else if ($str_Char == ';') {
                    if ($i_Result == 0) {
                        $i_Result = (int) $str_Save_char;
                        $str_Save_char = '';
                    } else {
                        $i_Result += (int) $str_Save_char;
                        $str_Save_char = '';
                    }
                } else {
                    return $i_Result;
                }
            }
        }
        return $i_Result;
    }

    public function export_booking_success()
    {
        // set_time_limit(0);
        // ignore_user_abort(true);
        ini_set('memory_limit', '1024M');
        log_message("ERROR", "export_booking_success");
        $dt["city"] = $this->input->post('ci_ty', TRUE);
        $dt["hotel"] = $this->input->post('ho_tel', TRUE);
        $dt["location"] = $this->input->post('location_code', TRUE);
        $hotel = $dt["hotel"];
        $city = $dt["city"];
        $dt["arrv_check"] = $this->input->post('arrv_check', TRUE);
        $dt["dept_check"] = $this->input->post('dept_check', TRUE);

        $dt["arrv_date_1"] = $this->input->post('arrv_date_1', TRUE);
        $dt["arrv_date_2"] = $this->input->post('arrv_date_2', TRUE);
        $dt["dept_date_1"] = $this->input->post('dept_date_1', TRUE);
        $dt["dept_date_2"] = $this->input->post('dept_date_2', TRUE);
        if ($dt["location"] == "false") {
            $dt["location"] = false;
        }
        $data = $this->HotelBookingModel->get_booking_report($dt);
        $this->HotelBookingModel->print_success($hotel, $city, $data);
    }

    public function export_booking_cancel()
    {
        $dt["city"] = $this->input->post('cty', TRUE);
        $dt["hotel"] = $this->input->post('htel', TRUE);
        $dt["location"] = $this->input->post('locationcode', TRUE);
        $hotel = $dt["hotel"];
        $city = $dt["city"];
        $dt["arrv_check"] = $this->input->post('arrvcheck', TRUE);
        $dt["dept_check"] = $this->input->post('deptcheck', TRUE);

        $dt["arrv_date_1"] = $this->input->post('arrvdate_1', TRUE);
        $dt["arrv_date_2"] = $this->input->post('arrvdate_2', TRUE);
        $dt["dept_date_1"] = $this->input->post('deptdate_1', TRUE);
        $dt["dept_date_2"] = $this->input->post('deptdate_2', TRUE);
        if ($dt["location"] == "false") {
            $dt["location"] = false;
        }
        $data = $this->HotelBookingModel->get_booking_report_cancel($dt);
        $this->HotelBookingModel->print_cancel($hotel, $city, $data);
    }

    public function export_alloment_report()
    {
        $data["city"] = $this->input->post('ci_ty', TRUE);
        $data["hotel"] = $this->input->post('ho_tel', TRUE);
        $data["room_class"] = $this->input->post('room_class', TRUE);
        $data["date_from"] = $this->input->post('date_from', TRUE);
        $data["date_to"] = $this->input->post('date_to', TRUE);
        $this->HotelBookingModel->print_alloment_report($data);
    }

    public function export_hotel_booking()
    {
        $data['hotel'] = $this->input->post('h_tel', TRUE);
        $data['city'] = $this->input->post('c_ty', TRUE);
        $data['location'] = $this->input->post('lction', TRUE);
        $data['arrv_check'] = $this->input->post('arrcheck', TRUE);
        $data['dept_check'] = $this->input->post('depcheck', TRUE);
        $data['arrv_date_1'] = $this->input->post('arrvdate1', TRUE);
        $data['arrv_date_2'] = $this->input->post('arrvdate2', TRUE);
        $data['dept_date_1'] = $this->input->post('deptdate1', TRUE);
        $data['dept_date_2'] = $this->input->post('deptdate2', TRUE);
        if ($data["location"] == "false") {
            $data["location"] = false;
        }
        $booking = $this->HotelBookingModel->get_booking_report($data);

        $dt = $this->HotelBookingModel->get_data_search_hotel_list($data);

        if (count($dt) != 0) {
            $this->HotelBookingModel->print_hotelbycity($data, $dt, $booking);
        }
    }

    public function load_rtype()
    {
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $row = $this->HotelBookingModel->get_rtypebyhotelcity($dt["hotel"], $dt["city"]);

        $output = '<option value=""></option>';
        foreach ($row as $item) {
            $output .= "<option value='" . str_replace(" ", "", $item) . "'>" . str_replace(" ", "", $item) . "</option>";
        }
        $result["data"] = $output;
        echo json_encode($result);
    }

    public function load_rclass()
    {
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $row = $this->HotelBookingModel->get_rclassbyhotelcity($dt["hotel"], $dt["city"]);

        $output = '<option value=""></option>';
        foreach ($row as $item) {
            $output .= "<option value='" . str_replace(" ", "", $item) . "'>" . str_replace(" ", "", $item) . "</option>";
        }
        $result["data"] = $output;
        echo json_encode($result);
    }

    public function sum_niteno_paxno()
    {
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $dt["cb_rtype"] = $this->input->post('cb_rtype', TRUE);
        $dt["cb_rclas"] = $this->input->post('cb_rclas', TRUE);
        $dt["location"] = $this->input->post('location', TRUE);

        $dt["arrv_check"] = $this->input->post('arrv_check', TRUE);
        $dt["dept_check"] = $this->input->post('dept_check', TRUE);

        $dt["arrv_date_1"] = $this->input->post('arrv_date_1', TRUE);
        $dt["arrv_date_2"] = $this->input->post('arrv_date_2', TRUE);
        $dt["dept_date_1"] = $this->input->post('dept_date_1', TRUE);
        $dt["dept_date_2"] = $this->input->post('dept_date_2', TRUE);
        $data = $this->HotelBookingModel->get_booking_report($dt);
        $NiteNo = $this->HotelBookingModel->ParseTotalNiteNo($dt["cb_rtype"], $dt["cb_rclas"], $data);
        $PaxNo = $this->HotelBookingModel->ParseTotalRoomNo($dt["cb_rtype"], $dt["cb_rclas"], $data);
        $result["niteno"] = $NiteNo;
        $result["paxno"] = $PaxNo;
        echo json_encode($result);
    }

    public function sum_niteno_paxno1()
    {
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $dt["cb_rtype"] = $this->input->post('cb_rtype', TRUE);
        $dt["cb_rclas"] = $this->input->post('cb_rclas', TRUE);
        $dt["location"] = $this->input->post('location', TRUE);

        $dt["arrv_check"] = $this->input->post('arrv_check', TRUE);
        $dt["dept_check"] = $this->input->post('dept_check', TRUE);

        $dt["arrv_date_1"] = $this->input->post('arrv_date_1', TRUE);
        $dt["arrv_date_2"] = $this->input->post('arrv_date_2', TRUE);
        $dt["dept_date_1"] = $this->input->post('dept_date_1', TRUE);
        $dt["dept_date_2"] = $this->input->post('dept_date_2', TRUE);
        $data = $this->HotelBookingModel->get_booking_report_cancel($dt);
        $NiteNo = $this->HotelBookingModel->ParseTotalNiteNo($dt["cb_rtype"], $dt["cb_rclas"], $data);
        $PaxNo = $this->HotelBookingModel->ParseTotalRoomNo($dt["cb_rtype"], $dt["cb_rclas"], $data);
        $result["niteno1"] = $NiteNo;
        $result["paxno1"] = $PaxNo;
        echo json_encode($result);
    }

    public function get_niteno_paxno()
    {
        $id_tour = $this->input->post('idtour', TRUE);
        $dt["arr_date"] = $this->input->post('arr_date', TRUE);
        $dt["dept_date"] = $this->input->post('dept_date', TRUE);
        $result["msg"] = $this->HotelBookingModel->check_date($dt);
        if ($result["msg"] == "") {
            $niteno = $this->HotelBookingModel->NoDay_Stage1($dt);
            $result["niteno"] = $niteno;
        } else {
            $result["niteno"] = 0;
        }

        echo json_encode($result);
    }

    public function get_rtypeandrclass()
    {
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        if ($dt["city"] != "" && $dt["hotel"] != "") {
            $rtype = $this->HotelBookingModel->get_rtypebyhotelcity($dt["hotel"], $dt["city"]);
            $rclass = $this->HotelBookingModel->get_rclassbyhotelcity($dt["hotel"], $dt["city"]);
            $output = '<option value=""></option>';
            foreach ($rtype as $item) {
                $output .= "<option value='" . str_replace(" ", "", $item) . "'>" . str_replace(" ", "", $item) . "</option>";
            }

            $output1 = '<option value=""></option>';
            foreach ($rclass as $item) {
                $output1 .= "<option value='" . str_replace(" ", "", $item) . "'>" . str_replace(" ", "", $item) . "</option>";
            }
            $result["rtype"] = $output;
            $result["rclass"] = $output1;
        } else {
            $result["rtype"] = "";
            $result["rclass"] = "";
        }
        echo json_encode($result);
    }

    public function add_more_room()
    {
        $dt["rtye"] = $this->input->post('rtye', TRUE);
        $dt["rclass"] = $this->input->post('rclass', TRUE);
        $dt["rno"] = $this->input->post('rno', TRUE);
        $dt["check_spe"] = $this->input->post('check_spe', TRUE);
        $dt["roomlist"] = $this->input->post('roomlist', TRUE);
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $dt["checkout"] = $this->input->post('checkout', TRUE);
        $dt["niteno"] = $this->input->post('niteno', TRUE);
        $dt["paxno"] = $this->input->post('paxno', TRUE);
        $dt["holiday"] = $this->input->post('holiday', TRUE);
        $dt["vncode"] = $this->input->post('vncode', TRUE);
        $dt["arnomore"] = $this->input->post('arnomore', TRUE);
        $dt["arrivedate"] = $this->input->post('arrivedate', TRUE);
        $dt["deptdate"] = $this->input->post('deptdate', TRUE);
        $dt["arnomore2"] = $this->input->post('arnomore2', TRUE);
        $data = $this->HotelBookingModel->add_more_room($dt);
        $reslut["msg"] = $data["error"];
        $reslut["r_list"] = $data["r_list"];
        $reslut["allotment_list"] = $data["allotment1"];
        $reslut["allotment_id"] = $data["AllotmentID"];
        $reslut["room_no"] = $data["RoomNo"];
        echo json_encode($reslut);
    }

    public function update_alloment_price()
    {
        $allotment_list = $this->input->post('allotment_list', TRUE);
        if (is_array($allotment_list) && ! empty($allotment_list)) {
            foreach ($allotment_list as $allotment) {
                if (is_array($allotment) && ! empty($allotment)) {
                    $update_result = $this->HotelBookingModel->update_allotment($allotment);
                    if ($update_result == 0) {
                        $result['mes'] = 'Data update failed !';
                    } else {
                        $result['mes'] = 'Data has been saved successfully !';
                    }
                }
            }
        }
        echo json_encode($result);
    }

    public function delete_hotel_list()
    {
        $data['hotel_id'] = $this->input->post('hotel_id', TRUE);
        $result = $this->HotelBookingModel->delete_hotel_list($data);
        if ($result) {
            $msg['msg'] = "true";
        } else {
            $msg['msg'] = "false";
        }
        echo json_encode($msg);
    }

    public function waiting_hotel_clear()
    {
        $rows = $this->HotelBookingModel->get_hotel();
        $output = '<option value=""></option>';
        foreach ($rows as $value) {
            $output .= "<option value='" . $value['HotelName'] . "'>" . $value['HotelName'] . "</option>";
        }
        $result['msg'] = $output;
        echo json_encode($result);
    }

    public function check_lc()
    {
        $check_lc = $this->input->post('check_out', TRUE);
        $result['msg'] = "";
        if (strpos($check_lc, ":") !== false) {
            $h = substr($check_lc, 0, strpos($check_lc, ":"));
            $m = substr($check_lc, strpos($check_lc, ":") + 1);
            if (is_numeric($h) && strlen($h) < 3 && is_numeric($m) && strlen($m) < 3) {
                $result['msg'] = "";
            } else {
                $result['msg'] = "Please input with : HH:mm";
            }
        } else {
            $result['msg'] = "Please input with : HH:mm";
        }
        echo json_encode($result);
    }

    public function load_transfer()
    {
        $city = $this->input->post('city', TRUE);
        if ($city != "") {
            $transfer = $this->HotelBookingModel->Load_Transfer($city);
            if (count($transfer) > 0) {
                $output1 = "<option value=''></option>";
                foreach ($transfer as $key => $value) {
                    $output1 .= "<option value='" . $value['Location'] . "'>" . $value['Content'] . "</option>";
                }
                echo $output1;
            } else {
                echo "<option value=''></option>";
            }
        }
    }

    /**
     * Function: Check allotment new tour
     * Creater: Le Ngoc Tuan
     *
     * @access public
     *         pagarm no
     *         return msg
     */
    public function check_allotment()
    {
        $dt = $this->input->post();
        $dt_where = array(
            "City" => $dt["city"],
            "HotelName" => $dt["hotel"],
            "RoomClass" => $dt["r_class"],
            "FromDate <= " => $dt["arrv_date"],
            "ToDate >=" => $dt["dept_date"]
        );
        $allotment_data = $this->HotelBookingModel->get_all_allotment($dt_where);
        if (count($allotment_data) > 0) {
            $roomday = $allotment_data[0]["RoomDay"];
            $reslut["AllotmentID"] = $allotment_data[0]["AllotmentID"];
        } else {
            $roomday = 0;
        }
        $cutoftime = $this->HotelBookingModel->GetAllotmentCutday($dt);
        $currentday = $this->HotelBookingModel->getnowday($dt);
        $reslut["msg"] = "";
        if ($currentday < $cutoftime) {
            $reslut["msg"] = "Check cut of day please !";
        }
        $strstage1 = $this->HotelBookingModel->CheckFreeDayStage1($dt, 2);
        $strstage2 = $this->HotelBookingModel->CheckFreeDayStage2($dt, 2);
        try {
            if (trim($strstage1) != "") {
                $strstage1 = substr($strstage1, 0, strrpos($strstage1, "-"));
            } else {
                $strstage1 = "0";
            }

            if (trim($strstage2) != "") {
                $strstage2 = substr($strstage2, 0, strrpos($strstage2, "-"));
            } else {
                $strstage2 = "0";
            }
        } catch (Exception $e) {}

        $strstage = $strstage1 . "-" . $strstage2;
        $strArr = explode("-", $strstage);
        $i = 0;
        $Arr = array();
        foreach ($strArr as $key => $value) {
            $Arr[$i] = (int) $value;
            $i ++;
        }
        $room = $this->HotelBookingModel->GetMaxMun($Arr);

        $dayofmonth1 = $this->HotelBookingModel->CheckDayOfMonth1($dt, 2);

        $dayofmonth2 = $this->HotelBookingModel->CheckDayOfMonth2($dt, 2);
        $month = explode("/", $dt["arrv_date"])[1];

        if ($roomday == 0) {
            $reslut["msg"] = "The selected hotel does not have allotment1 in month " . $month;
        } // else if((int)$dt['room_no']>($roomday-$room))
        // {
        // $reslut["msg2"] = "Distance time , room stage1 has used full in stage1";
        // }
        // else if($dayofmonth1==-1)
        // {
        // $reslut["msg2"] = "Check allotment please !";
        // }
        // else if($dayofmonth1==-2)
        // {
        // $reslut["msg2"] = "All allotment has been booked in stage1!";
        // }
        // else if($dayofmonth1>0)
        // {
        // $reslut["msg2"] = "There are only ".$dayofmonth1." allotment(s) left in stage1";
        // }
        else {
            $msg_check = $this->HotelBookingModel->check_allotment_today($dt, $allotment_data);
            $reslut["msg"] = $msg_check;
        }
        // $allotCounter = 0;
        // $allotCounter = $this->HotelBookingModel->CheckDay($dt);
        // if(($allotCounter!=0) &&($roomday-$room) < (int)$dt['room_no'])
        // {
        // $reslut["msg3"] = "Please choose other distance time in stage1";
        // }
        // else if($allotCounter!=0 && $room>=$roomday)
        // {
        // $reslut["msg3"] = "Please choose other distance time in stage1";
        // }
        echo json_encode($reslut);
    }

    /**
     * Function: Check allotment new tour
     * Creater: Le Ngoc Tuan
     *
     * @access public
     *         pagarm no
     *         return msg
     */
    public function check_allotment_update()
    {
        $dt = $this->input->post();
        $reslut["msg"] = "";
        $dt_where = array(
            "City" => $dt["city"],
            "HotelName" => $dt["hotel"],
            "RoomClass" => $dt["r_class"],
            "FromDate <= " => $dt["arrv_date"],
            "ToDate >=" => $dt["dept_date"]
        );
        $allotment_data = $this->HotelBookingModel->get_all_allotment($dt_where);
        if (count($allotment_data) > 0) {
            $roomday = $allotment_data[0]["RoomDay"];
            $reslut["AllotmentID"] = $allotment_data[0]["AllotmentID"];
        } else {
            $roomday = 0;
        }
        $cutoftime = $this->HotelBookingModel->GetAllotmentCutday($dt);
        $currentday = $this->HotelBookingModel->getnowday($dt);

        if ($currentday < $cutoftime) {
            $reslut["msg"] = "Check cut of day please !";
        }
        $strstage1 = $this->HotelBookingModel->CheckFreeDayStage1($dt, 2);
        $strstage2 = $this->HotelBookingModel->CheckFreeDayStage2($dt, 2);
        try {
            if (trim($strstage1) != "") {
                $strstage1 = substr($strstage1, 0, strrpos($strstage1, "-"));
            } else {
                $strstage1 = "0";
            }

            if (trim($strstage2) != "") {
                $strstage2 = substr($strstage2, 0, strrpos($strstage2, "-"));
            } else {
                $strstage2 = "0";
            }
        } catch (Exception $e) {}

        $strstage = $strstage1 . "-" . $strstage2;
        $strArr = explode("-", $strstage);
        $i = 0;
        $Arr = array();
        foreach ($strArr as $key => $value) {
            $Arr[$i] = (int) $value;
            $i ++;
        }
        $room = $this->HotelBookingModel->GetMaxMun($Arr);

        $dayofmonth1 = $this->HotelBookingModel->CheckDayOfMonth1($dt, 2);

        $dayofmonth2 = $this->HotelBookingModel->CheckDayOfMonth2($dt, 2);
        $month = explode("/", $dt["arrv_date"])[1];

        if ($roomday == 0) {
            $reslut["msg"] = "The selected hotel does not have allotment1 in month " . $month;
        } // else if((int)$dt['room_no']>($roomday-$room))
        // {
        // $reslut["msg2"] = "Distance time , room stage1 has used full in stage1";
        // }
        // else if($dayofmonth1==-1)
        // {
        // $reslut["msg2"] = "Check allotment please !";
        // }
        // else if($dayofmonth1==-2)
        // {
        // $reslut["msg2"] = "All allotment has been booked in stage1!";
        // }
        // else if($dayofmonth1>0)
        // {
        // $reslut["msg2"] = "There are only ".$dayofmonth1." allotment(s) left in stage1";
        // }
        else {
            $msg_check = $this->HotelBookingModel->check_allotment_today_update($dt, $allotment_data);
            $reslut["msg"] = $msg_check;
        }
        // $allotCounter = 0;
        // $allotCounter = $this->HotelBookingModel->CheckDay($dt);
        // if(($allotCounter!=0) &&($roomday-$room) < (int)$dt['room_no'])
        // {
        // $reslut["msg3"] = "Please choose other distance time in stage1";
        // }
        // else if($allotCounter!=0 && $room>=$roomday)
        // {
        // $reslut["msg3"] = "Please choose other distance time in stage1";
        // }
        echo json_encode($reslut);
    }

    public function GetAllotmentID()
    {
        $dt['city'] = $this->input->post('city', TRUE);
        $dt['hotel'] = $this->input->post('hotel', TRUE);
        $dt['arrv_date'] = $this->input->post('arrv_date', TRUE);
        $dt['dept_date'] = $this->input->post('dept_date', TRUE);
        $dt['room_no'] = $this->input->post('room_no', TRUE);
        $dt['r_class'] = $this->input->post('r_class', TRUE);
        $Allotment1 = $this->HotelBookingModel->GetAllotmentID($dt);
        $result['idallotment'] = $Allotment1;
        echo json_encode($result);
    }

    public function GetTransferPrice()
    {
        $TransferID = $this->input->post('tranferID', TRUE);
        $Tranfer_Price1 = $this->HotelBookingModel->GetTransferPrice($TransferID);
        echo $Tranfer_Price1;
    }

    public function chck_date()
    {
        $id_tour = $this->input->post('idtour', TRUE);
        $dt["arr_date"] = $this->input->post('arr_date', TRUE);
        $dt["dept_date"] = $this->input->post('dept_date', TRUE);
        $reslut["msg"] = $this->HotelBookingModel->check_date($dt);
        echo json_encode($reslut);
    }

    public function check_rno()
    {
        $r_no = $this->input->post('r_no', TRUE);
        if (is_numeric($r_no)) {
            $reslut["msg"] = "true";
        } else {
            $reslut["msg"] = "Please input room no is number";
        }
        echo json_encode($reslut);
    }

    public function check_allotmenet()
    {
        $dt["arr_date"] = $this->input->post('arr_date', TRUE);
        $dt["dept_date"] = $this->input->post('dept_date', TRUE);
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $dt["r_no"] = $this->input->post('r_no', TRUE);
        $msg = $this->HotelBookingModel->check_allotmenet($dt);
        echo json_encode($msg);
    }

    public function chk_Allotment_RNo()
    {
        $str_allotment = $this->input->post('str_allotment', TRUE);
        $reslut["rno_allotment"] = $this->HotelBookingModel->chk_Allotment_RNo($str_allotment);
        echo json_encode($reslut);
    }

    public function GetPriceSPE()
    {
        $dt["rtye"] = $this->input->post('r_type', TRUE);
        $dt["rclass"] = $this->input->post('r_class', TRUE);
        $dt["rno"] = $this->input->post('room_no_1', TRUE);
        $dt["check_spe"] = $this->input->post('spe', TRUE);
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $dt["checkout"] = $this->input->post('check_out', TRUE);
        $dt["niteno"] = $this->input->post('nite_no_1', TRUE);
        $dt["paxno"] = $this->input->post('pax_no_1', TRUE);
        $result["obj_List_1"] = $this->HotelBookingModel->GetPriceSPE($dt);
        echo json_encode($result);
    }

    public function GetHotelClassName()
    {
        $dt["rtye"] = $this->input->post('r_type', TRUE);
        $dt["rclass"] = $this->input->post('r_class', TRUE);
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $result["class_name"] = $this->HotelBookingModel->GetHotelClassName($dt);
        echo json_encode($result);
    }

    public function GetPrice()
    {
        $dt["rtye"] = $this->input->post('rtye', TRUE);
        $dt["rclass"] = $this->input->post('rclass', TRUE);
        $dt["rno"] = $this->input->post('rno', TRUE);
        $dt["check_spe"] = $this->input->post('check_spe', TRUE);
        $dt["roomlist"] = $this->input->post('roomlist', TRUE);
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $dt["checkout"] = $this->input->post('checkout', TRUE);
        $dt["niteno"] = $this->input->post('niteno', TRUE);
        $dt["paxno"] = $this->input->post('paxno', TRUE);
        $dt["holiday"] = $this->input->post('holiday', TRUE);
        $dt["vncode"] = $this->input->post('vncode', TRUE);
        $dt["arnomore"] = $this->input->post('arnomore', TRUE);
        $dt["arrivedate"] = $this->input->post('arrivedate', TRUE);
        $dt["deptdate"] = $this->input->post('deptdate', TRUE);
        $dt["arnomore2"] = $this->input->post('arnomore2', TRUE);
        $result["obj_List_1"] = $this->HotelBookingModel->GetPrice($dt);
        echo json_encode($result);
    }

    public function GetHotelPrice()
    {
        $dt["city"] = $this->input->post('city', TRUE);
        $dt["hotel"] = $this->input->post('hotel', TRUE);
        $dt["rtye"] = $this->input->post('rtye', TRUE);
        $dt["rclass"] = $this->input->post('rclass', TRUE);
        $dt["check_spe"] = $this->input->post('check_spe', TRUE);
        $dt["vn_code"] = $this->input->post('vn_code', TRUE);
        $result["hotel_price"] = $this->HotelBookingModel->GetHotelPrice($dt);
        echo json_encode($result);
    }

    public function GetContant()
    {
        $transfer_price = $this->input->post('transfer_price', TRUE);
        $reslut["ct"] = $this->HotelBookingModel->GetContant($transfer_price);
        echo json_encode($reslut);
    }
}
