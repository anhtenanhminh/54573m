<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OptionalController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (isset($this->session->userdata['logged_in'])) {
            $username = ($this->session->userdata['logged_in']['username']);
        } else {
            redirect('AuthenController/index');
        }
        $this->load->model('TransferModel');
    }

    /*
     * Controller send data for view Optional Tour Transfer
     * Parameter: none
     * Return: Load view
     */
    public function optional_tour_transfer()
    {
        if ($this->session->userdata('search_option_tour') !== FALSE) {
            $data['search_option_tour'] = $this->session->userdata('search_option_tour');
            $this->session->unset_userdata('search_option_tour');
        }
        $data["city"] = $this->OptionalTourModel->get_city();
        $data["car_info"] = $this->OptionalTourModel->get_car_information();
        $data["guide"] = $this->OptionalTourModel->get_guide();
        $data["tour"] = $this->OptionalTourModel->get_tour();
        $this->load->view('Optional_Tour/formOptionalTourTransfer', $data);
    }

    /*
     * Controller send data for view New Tour Guide
     * Parameter: none
     * Return: Load view
     */
    public function new_optional_tour_guide()
    {
        $data["car_info"] = $this->OptionalTourModel->get_car_information();
        $data["guide"] = $this->OptionalTourModel->get_guide();
        $today = date("Y-m-d");
        $today = substr($today, 2, 2) . substr($today, 5, 2) . substr($today, 8, 2);
        $data["TBLCode"] = $this->OptionalTourModel->make_TBLCode($today, "TransferOptionalTour", "TBLCodeOptionalTour");
        $this->load->view('Optional_Tour/formNewTourGuide', $data);
    }

    /*
     * Controller send data for view Optional Tour List
     * Parameter: none
     * Return: Load view
     */
    public function option_tour_list()
    {
        $comeFrom = $this->input->get("c");
        $data["list_tour"] = $this->OptionalTourModel->get_tour_list();
        $data['back'] = $comeFrom ? base_url("transfer-management/update-guest-optional-tour?id={$comeFrom}") : base_url("optional-tour/optional-tour-transfer");
        $this->load->view('Optional_Tour/formOptionalTourList', $data);
    }

    /*
     * Controller send data for view Update Optional Tour Guide
     * Parameter: none
     * Return: Load view
     */
    public function update_optional_tour_guide_table()
    {
        $table_code = $this->input->get('code', TRUE);
        $data_get = $this->input->get();
        unset($data_get['code']);
        $this->session->set_userdata('search_option_tour', $data_get);

        $data["optional_tour_guide"] = $this->OptionalTourModel->get_optional_tour_guide_by_TBL($table_code);
        // var_dump($data["optional_tour_guide"]);exit;
        $data["guide"] = $this->OptionalTourModel->get_guide();
        $data["cardriver"] = $this->OptionalTourModel->get_car_information();
        $strDate = ($data["optional_tour_guide"]) ? $data["optional_tour_guide"][0]["DateGo"] : "";
        if (count($data["optional_tour_guide"]) != 0) {
            $dt["date_in"] = $data["optional_tour_guide"][0]["DateGo"];
            $data["optional_tour_list"] = $this->OptionalTourModel->search_update_optional_tour_guide($dt, $table_code, $strDate);
        }
        $this->load->view('Optional_Tour/formUpdateOptionalTourGuideTable', $data);
    }

    /*
     * Controller send data for view New Optional Tour
     * Parameter: none
     * Return: Load view
     */
    public function new_optional_tour()
    {
        $data["city"] = $this->OptionalTourModel->get_city();
        $this->load->view('Optional_Tour/formNewOptionalTour', $data);
    }

    /*
     * Controller send data for view Update Optional Tour
     * Parameter: none
     * Return: Load view
     */
    public function update_optional_tour()
    {
        $optional_tour_id = $this->input->get('id', TRUE);
        $data["city"] = $this->OptionalTourModel->get_city();
        $data["optional_tour_info"] = $this->OptionalTourModel->get_optional_tour_by_id($optional_tour_id);
        $this->load->view('Optional_Tour/formUpdateOptionalTour', $data);
    }

    /*
     * Controller get numberphone of guide
     * Parameter: none
     * Return: String numberphone of guide
     */
    public function get_tel_guide()
    {
        $guide = $this->input->post('guide', TRUE);
        $rows = $this->OptionalTourModel->get_tel_by_guide($guide);
        // var_dump($guide);
        $result = "";
        foreach ($rows as $row) {
            $result = $row["GuideTel"];
        }
        echo $result;
    }

    /*
     * Controller get infomation of cardriver
     * Parameter: none
     * Return: String json infomation of cardriver
     */
    public function get_info_car()
    {
        $driver = $this->input->post('driver', TRUE);
        $result = $this->OptionalTourModel->get_info_car($driver);
        // var_dump($result);
        echo json_encode($result);
    }

    /*
     * Controller get content of optional tour
     * Parameter: none
     * Return: String json content of optional tour
     */
    public function get_content_optionaltour()
    {
        $optionaltourid = $this->input->post('optionaltourid', TRUE);
        $result = $this->OptionalTourModel->get_content_optionaltour($optionaltourid);
        // var_dump($result);
        echo json_encode($result);
    }

    /*
     * Controller search list Optional tour guide
     * Parameter: none
     * Return: String json list Optional tour guide
     */
    public function search_optional_tour_guide()
    {
        $data["city"] = $this->input->post('city', TRUE);
        $data['guide_name'] = $this->input->post('guide_name', TRUE);
        $data["car_no"] = $this->input->post('car_no', TRUE);
        $data["driver_name"] = $this->input->post('driver_name', TRUE);
        $data["guest_name"] = $this->input->post('guest_name', TRUE);
        $data["tour_name"] = $this->input->post('tour_name', TRUE);
        $data["from_date"] = $this->input->post('from_date', TRUE);
        $data["to_date"] = $this->input->post('to_date', TRUE);
        $rows = $this->OptionalTourModel->search_optional_tour_guide($data);
        $result["tableData"] = $rows;
        $count_guest = $this->OptionalTourModel->count_guest($rows);
        $result["data"]["count"] = $count_guest;
        echo json_encode($result);
    }

    public function get_guest_transfer_tour_guide()
    {
        $TLTCode = $this->input->post('TLTCode', TRUE);
        $strDate = $this->input->post('strDate', TRUE);
        $rows_guest_jp = $this->OptionalTourModel->get_guest_transfer_tour_guide_jp($TLTCode, $strDate);
        $rows_guest_vn = $this->OptionalTourModel->get_guest_transfer_tour_guide_vn($TLTCode, $strDate);
        $result["guest_jp"] = $rows_guest_jp;
        $result["guest_vn"] = $rows_guest_vn;
        echo json_encode($result);
    }

    /*
     * Controller search optional tour guide in form new
     * Parameter: none
     * Return: String json list optional tour guide
     */
    public function search_new_optional_tour_guide()
    {
        $data["date_in"] = $this->input->post('date_in', TRUE);
        $rows = $this->OptionalTourModel->search_new_optional_tour_guide($data);
        if (count($rows) != 0) {
            $result["msg"] = "true";
            $result["data"] = $rows["data"];
            $result["total"] = $rows["total"];
            echo json_encode($result);
        } else {
            $result["msg"] = "false";
            echo json_encode($result);
        }
    }

    /*
     * Controller get guest transfer in view new optional tour
     * Parameter: none
     * Return: String json content of optional tour
     */
    public function get_guest_transfer_new_optional()
    {
        $TLTCode = $this->input->post('TLTCode', TRUE);
        $TourName = $this->input->post('TourName', TRUE);
        $rows_guest_E = $this->OptionalTourModel->get_guest_transfer_new_optional_E($TLTCode, $TourName);
        $rows_guest_I = $this->OptionalTourModel->get_guest_transfer_new_optional_I($TLTCode, $TourName);
        $result["guest_E"] = $rows_guest_E;
        $result["guest_I"] = $rows_guest_I;
        echo json_encode($result);
    }

    /*
     * Controller create new optional tour
     * Parameter: none
     * Return: String json massage
     */
    public function create_new_optional_tour()
    {
        $data = $this->input->post('data', TRUE);
        // echo $tour_code;
        // var_dump($data);
        $result = $this->OptionalTourModel->create_new_optional_tour($data);
        // $output .= "</tbody>";
        $msg = array();
        if ($result)
            $msg["msg"] = "Data insert success!!";
        else
            $msg["msg"] = "Data insert fail!!";
        echo json_encode($msg);
    }

    /*
     * Controller update optional tour
     * Parameter: none
     * Return: String json massage
     */
    public function update_optional_tour_action()
    {
        $data = $this->input->post('data', TRUE);
        $idOptionalTour = $this->input->post('idOptionalTour', TRUE);
        // echo $idOptionalTour;
        // var_dump($data);
        $result = $this->OptionalTourModel->update_optional_tour_action($idOptionalTour, $data);
        // $output .= "</tbody>";
        $msg = array();
        if ($result)
            $msg["msg"] = "Data updated success!!";
        else
            $msg["msg"] = "Data update fail!!";
        echo json_encode($msg);
    }

    /*
     * Controller create optional tour guide by ajax
     * Parameter: none
     * Return: json string
     */
    public function create_optional_tour_guide()
    {
        $data = $this->input->post('data', TRUE);
        $list_check = $this->input->post('list_check', TRUE);
        $result = $this->OptionalTourModel->create_optional_tour_guide($data, $list_check);
        $msg = array();
        if ($result)
            $msg["msg"] = "";
        else
            $msg["msg"] = "Data insert fail!!";
        echo json_encode($msg);
    }

    /*
     * Controller make table code
     * Parameter: none
     * Return: string table code
     */
    public function make_TBLCode()
    {
        $today = $this->input->post('TBLCode', TRUE);
        $today = substr($today, 2, 2) . substr($today, 5, 2) . substr($today, 8, 2);
        $result = $this->OptionalTourModel->make_TBLCode($today, "TransferOptionalTour", "TBLCodeOptionalTour");
        echo $result;
    }

    public function update_optional_tour_guide()
    {
        $data = $this->input->post('data', TRUE);
        $list_check = $this->input->post('list_check', TRUE);
        $TBLCodeOptionalTour = $this->input->post('TBLCodeOptionalTour', TRUE);
        // echo $tour_code;
        // var_dump($TBLCodeOptionalTour);
        $result = $this->OptionalTourModel->update_optional_tour_guide($data, $list_check, $TBLCodeOptionalTour);
        // $output .= "</tbody>";
        $msg = array();
        if ($result)
            $msg["msg"] = "true";
        else
            $msg["msg"] = "false";
        echo json_encode($msg);
    }

    public function delete_optional_tour_guide()
    {
        $TBLCode = $this->input->post('TBLCode', TRUE);
        // echo $tour_code;
        // var_dump($TBLCodeOptionalTour);
        $result = $this->OptionalTourModel->delete_optional_tour_guide($TBLCode);
        // $output .= "</tbody>";
        $msg = $result ? array(
            'result' => 'OK'
        ) : array(
            'result' => false
        );
        // if ($result) $msg["msg"] = "Data delete success!!";
        // else $msg["msg"] = "Data delete fail!!";
        echo json_encode($msg);
    }

    public function delete_optional_tour()
    {
        $optionaltourid = $this->input->post('optionaltourid', TRUE);
        // echo $tour_code;
        // var_dump($TBLCodeOptionalTour);
        $result = $this->OptionalTourModel->delete_optional_tour($optionaltourid);
        // $output .= "</tbody>";
        $msg = array();
        if ($result) {
            $msg["sta"] = $result;
            $msg["msg"] = "Data delete success!!";
        } else {
            $msg["sta"] = $result;
            $msg["msg"] = "Data delete fail!!";
        }
        echo json_encode($msg);
    }

    /*
     * Controller export excel tour information
     * Parameter: none
     * Return: true if export success, false if export fail
     * Author: Huy Nguyen
     */
    public function export_ExcelOptionalTourGuideForm()
    {
        if ($this->input->post('print_single', TRUE) == "Print") {
            $data_post = $this->input->post();
            $data["date"] = $this->input->post('date', TRUE);
            $data["tltcode"] = $this->input->post('tltcode', TRUE);
            $data["guidename"] = $this->input->post('guide_name', TRUE);
            $data["guidetel"] = $this->input->post('guide_tel', TRUE);
            $data["drivername"] = $this->input->post('driver_name', TRUE);
            $data["drivertel"] = $this->input->post('driver_tel', TRUE);
            $data["carno"] = $this->input->post('car_no', TRUE);
            $data["tourname"] = $this->input->post('tour_name', TRUE);
            $guestJapan = $this->OptionalTourModel->get_guest_transfer_tour_guide_jp($data["tltcode"], $data["date"]);
            $guestVietnam = $this->OptionalTourModel->get_guest_transfer_tour_guide_vn($data["tltcode"], $data["date"]);
            $strKQ = "";
            for ($i = 0; $i <= count($guestJapan) - 1; $i ++) {
                if (isset($guestJapan[$i])) {
                    if (count($guestJapan) == 1) {
                        $strKQ = $this->TransferModel->chk_State_CXL($guestJapan[$i]["TourCode"], "TourCode");
                    } else {
                        if (isset($guestJapan[$i - 1]) && ($guestJapan[$i]["TourCode"] == $guestJapan[$i - 1]["TourCode"])) {
                            if ($strKQ != "") {
                                $strKQ .= " AND " . $this->TransferModel->chk_State_CXL($guestJapan[$i]["TourCode"], "TourCode");
                            } else {
                                $strKQ = $this->TransferModel->chk_State_CXL($guestJapan[$i]["TourCode"], "TourCode");
                            }
                        }
                    }
                }
            }

            for ($i = 0; $i <= count($guestVietnam) - 1; $i ++) {
                if (isset($guestVietnam[$i])) {
                    if (count($guestVietnam) == 1) {
                        $strKQ = $this->TransferModel->chk_State_CXL($guestVietnam[$i]["TourCode"], "TourCode");
                    } else {
                        if (isset($guestVietnam[$i - 1]) && ($guestVietnam[$i]["TourCode"] == $guestVietnam[$i - 1]["TourCode"])) {
                            if ($strKQ != "") {
                                $strKQ .= " AND " . $this->TransferModel->chk_State_CXL($guestVietnam[$i]["TourCode"], "TourCode");
                            } else {
                                $strKQ = $this->TransferModel->chk_State_CXL($guestVietnam[$i]["TourCode"], "TourCode");
                            }
                        }
                    }
                }
            }

            if ($strKQ != "") {
                $this->session->set_userdata('search_option_tour', $data_post);
                $link = base_url() . "optional-tour/optional-tour-transfer";
                echo "<script> alert('" . $strKQ . "');location.href='" . $link . "'</script>";
            } else {
                $this->OptionalTourModel->export_ExcelOptionalTourGuideForm($data, $guestJapan, $guestVietnam);
            }
        } else {
            $data["city"] = $this->input->post('ci_ty', TRUE);
            $data['guide_name'] = $this->input->post('gdname', TRUE);
            $data["car_no"] = $this->input->post('crno', TRUE);
            $data["driver_name"] = $this->input->post('drname', TRUE);
            $data["guest_name"] = $this->input->post('gsname', TRUE);
            $data["tour_name"] = $this->input->post('trname', TRUE);
            $data["from_date"] = $this->input->post('fr_date', TRUE);
            $data["to_date"] = $this->input->post('t_date', TRUE);
            $rows = $this->OptionalTourModel->search_optional_tour_guide($data);
            $this->OptionalTourModel->print_all_optional_tour($data, $rows);
        }
    }

    public function CheckDuplicadeTBLCodeOptionalTour()
    {
        $TBLCodeOptionalTour = $this->input->post('TBLCodeOptionalTour', TRUE);
        $result = $this->OptionalTourModel->CheckDuplicadeTBLCodeOptionalTour($TBLCodeOptionalTour);
        echo json_encode($result);
    }

    public function CountTotalGuestChkSeat()
    {
        $ds = $this->input->post('data', TRUE);
        $result = $this->OptionalTourModel->CountTotalGuestChkSeat($ds);
        echo json_encode($result);
    }
}
?>