<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Invoice controller, process invoice functions
 *
 * @package HIS Convert
 * @author Creater: Ho Quoc Nghi
 * @author Updater: Ho Quoc Nghi
 *        
 *         Created date: 14-08-2015
 *         Last updated date: 14-08-2015
 *         File location: application/controllers/InvoiceController.php
 */
class InvoiceController extends MX_Controller
{

    private $connectCouter = 0;

    private $NoCurrentConnection = 0;

    private $childPageHeader = array(
        "No",
        "Ch",
        "RQ",
        "RQ-IVR",
        "IVR",
        "AGT",
        "Com",
        "Resv No.",
        "CLS",
        "City",
        "AGT",
        "Date",
        "ETD",
        "ETA",
        "Term",
        "H-Person",
        "PAX",
        "E",
        "M",
        "R",
        "A",
        "FLT No.",
        "B",
        "L",
        "M",
        "D",
        "FLT NO",
        "Ptr"
    );

    private $strTourTariff = "";

    private $messages = "";

    private $priceSurcharge = 0;

    private $HOTELCLASS = array(
        "LUX",
        "DLX",
        "SUP",
        "STD",
        "CPN"
    );

    private $NAMECLASS = array(
        "L",
        "A",
        "B",
        "C",
        "D"
    );

    private $currentFile = '';

    private $connection = 0;

    function __construct()
    {
        parent::__construct();
        if (isset($this->session->userdata['logged_in'])) {
            $username = ($this->session->userdata['logged_in']['username']);
        } else {
            redirect('AuthenController/index');
        }
        $this->load->model('InvoiceModel', 'Invoice');
        $this->loadMessage();
    }

    /**
     * Default invoice controller
     * Show main screen of invoice
     */
    public function index()
    {
        $this->load->view('Invoice/formInvoiceMain');
    }

    public function invoice()
    {
        log_message('INFO', 'start invoice');
        $data['tours'] = array();
        $location = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $location = $this->input->post('location');
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
            $startDate = str_replace('-', '/', $data['from']);
            $startTo = str_replace('-', '/', $data['to']);
            $data['tours'] = array();

            $whereParams = array(
                'TourInfo.Location_Code = ' => $location,
                'TourInfo.ArrvDate >= ' => $startDate,
                'TourInfo.ArrvDate <= ' => $startTo,
                'BOOKING.ArrvDate1 >= ' => $startDate,
                'BOOKING.ArrvDate1 <= ' => $startTo
            );
            if ($location != 'OP' and $location != 'TP' and $location != 'NP' and $location != 'KP') {
                $whereParams['TourStatus <> '] = 'CXL';
            }

            $tableRow = $this->Invoice->get_data($whereParams);

            if (count($tableRow) == 0) {
                echo "<script>alert('Data not found.');</script>";
            }

            if ($this->input->post('submit') == "Start") {
                $list_check = $this->input->post('list');
                $data['listcheck'] = $list_check;
                $start = microtime(true);
                if (count($tableRow) > 0) {
                    $list_invoice = $this->start($location, $tableRow, $list_check);
                    if ($location == "OP" || $location == "NP" || $location == "KP" || $location == "TP") {
                        if ($list_check != "") {
                            if (count($list_invoice) > 0) {
                                $data["option_tour"] = $list_invoice[0]["OptionalTour"];
                                $data['tours'] = $tableRow;
                            } else {
                                $data['tours'] = $tableRow;
                            }
                        } else {
                            $data['tours'] = $tableRow;
                        }
                    } else {
                        $data["Starttours"] = $list_invoice;
                    }
                }
                $data['executeTime'] = microtime(true) - $start;
            } else if ($this->input->post('submit') == "Get Data") {
                $data['tours'] = $tableRow;
            } else if ($this->input->post('submit') == "Export") {
                $data_export = $this->input->post();
                $result = $this->export_invoice($data_export);
                if (isset($result["tours"]) && count($result["tours"]) > 0 && ! empty($result["tours"])) {
                    $data['tours'] = $result["tours"];
                }
                if (isset($result["option_tour"]) && count($result["option_tour"]) > 0 && ! empty($result["option_tour"])) {
                    $data['option_tour'] = $result["option_tour"];
                }
            }
        }
        $data['locations'] = $this->Invoice->get_location($this->session->userdata('logged_in')['username']);
        $data['current'] = $location;
        $this->load->view('Invoice/formInvoice', $data);
    }

    public function tour_tariff()
    {
        $this->load->view('Invoice/formTourTariff');
    }

    public function optional_tariff()
    {
        $this->load->view('Invoice/formOptionsTariff');
    }

    public function transfer_tariff()
    {
        $this->load->view('Invoice/formTransferTariff');
    }

    public function hotel_tariff()
    {
        $this->load->view('Invoice/formHotelsTariff');
    }

    public function surcharge()
    {
        $dt = array();
        if ($this->input->post()) {
            $FromDate = $this->input->post('FromDate');
            $ToDate = $this->input->post('ToDate');
            $data['FromDate'] = $FromDate;
            $data['ToDate'] = $ToDate;
            $result = $this->Invoice->get_data_search_surcharge($data);
            $dt['result'] = $result;
            $dt['FromDate'] = $FromDate;
            $dt['ToDate'] = $ToDate;
        }
        $this->load->view('Invoice/formSurcharge', $dt);
    }

    private function getListHotelInRoomList($dataRow, $ncount)
    {
        if (is_numeric($dataRow["NiteNo" . $ncount])) {
            $roomList = trim($dataRow["Room_List" . $ncount]);
            $arrString = explode(";", $roomList);

            foreach ($arrString as $str) {
                $invoiceHotel = "";
                $str = trim($str);
                if (! empty($str)) {
                    $i = 0;
                    for ($i = 0; $i < strlen($str); $i ++) {
                        if (! is_numeric($str[$i])) {
                            $i -= 1;
                            break;
                        }
                    }
                    $index = strpos($str, "/");
                    $invoiceHotel['HotelName'] = $dataRow['Hotel'];
                    $invoiceHotel['ArriveDate'] = $dataRow['ArrvDate' . $ncount];
                    $invoiceHotel['NoRoom'] = substr($str, 0, $i + 1);
                    $invoiceHotel['RoomType'] = substr($str, $i + 1, $index - $i - 1);
                    $invoiceHotel['RoomClass'] = substr($str, $index + 1, strlen($str) - $i - $index);
                    $lstInvoiceHotelTemp[] = $invoiceHotel;
                }
            }
        }
        return $lstInvoiceHotelTemp;
    }

    public function check_date()
    {
        $date_from = $this->input->post("date_from", TRUE);
        $date_to = $this->input->post("date_to", TRUE);
        $result = "";
        $date1 = explode('/', $date_from);
        $date2 = explode('/', $date_to);
        if (count($date1) == 3 && count($date2) == 3) {
            if (! checkdate($date1[1], $date1[2], $date1[0])) {
                $result = "Invalid date !!";
            } else if (! checkdate($date2[1], $date2[2], $date2[0])) {
                $result = "Invalid date !!";
            } else if (strtotime($date_from) > strtotime($date_to)) {
                $result = "Arr date no bigger deptdate...";
            }
        } else {
            $result = "Invalid date !!";
        }
        $msg["msg"] = $result;
        // echo $result;
        echo json_encode($msg);
    }

    private function sortHotelList($lstHotel)
    {
        if (empty($lstHotel))
            return array();
        $lstInvoiceHotel = array();
        if (count($lstHotel) > 1) {
            $removed = array();
            foreach ($lstHotel as $key => $hotel) {
                if (! empty($hotel)) {
                    $hotel['NoRoom'] = 1;
                }
                foreach ($lstHotel as $k => $v) {
                    if ($k > $key and $hotel['HotelName'] == $v['HotelName'] and $hotel['ArriveDate'] == $v['ArriveDate'] and $hotel['RoomType'] == $v['RoomType'] and $hotel['NoNight'] == $v['NoNight']) {
                        $hotel['NoRoom'] += 1;
                        $removed[$k] = $k;
                    }
                }
                $lstInvoiceHotel[] = $hotel;
            }
        } elseif (count($lstHotel) == 1) {
            $hotel = end($lstHotel);
            $hotel['NoRoom'] = 1;
            return array(
                $hotel
            );
        }
        foreach ($lstInvoiceHotel as $key => $value) {
            if (in_array($key, $removed)) {
                unset($lstInvoiceHotel[$key]);
            }
        }
        if (count($lstInvoiceHotel) > 1) {
            foreach ($lstInvoiceHotel as $k1 => $hotel1) {
                if ($hotel1['HotelName'] != "") {
                    foreach ($lstInvoiceHotel as $k2 => $hotel2) {
                        if ($k1 < $k2 and $hotel1['HotelName'] == $hotel2['HotelName'] and $hotel1['ArriveDate'] == $hotel2['ArriveDate']) {
                            $lstInvoiceHotel[$k2]['HotelName'] = "";
                        }
                    }
                }
            }
        }
        $lstInvoiceHotel = array_values($lstInvoiceHotel);
        return $lstInvoiceHotel;
    }

    private function getDataFromNguyenTrai($row, $id)
    {
        $invoiceHotelTemp = array();
        $invoiceDTO = $row;
        $invoiceDTO['HisCode'] = $row['TourCode'];
        $invoiceDTO['GuestName'] = $row['GroupName'];
        $invoiceDTO['NoPax'] = $row['NPer'];
        $invoiceDTO['Code'] = $row['VnCode'];
        $invoiceDTO['StartDate'] = $row['ArrvDate'];
        $invoiceDTO['Status'] = $row['TourStatus'];
        $invoiceDTO['Hotel'] = array();
        $lstInvoiceHotelTemp = array();

        $bookingTable = $this->Invoice->get_invoice_from_nguyen_trai($row['TourCode']);

        foreach ($bookingTable as $ivRow) {
            $invoiceHotelDTO = $ivRow;
            if (empty($ivRow['Room_List1'])) {
                $invoiceHotelDTO['HotelName'] = $ivRow['Hotel'];
                if (false === strpos($invoiceHotelDTO['HotelName'], "KHONG") and $ivRow['HotelStatus1'] != "CXL" and $ivRow['HotelStatus1'] != "") {
                    $invoiceHotelDTO['NoRoom'] = (empty($ivRow['RoomNo1'])) ? 0 : $ivRow['RoomNo1'];

                    $invoiceHotelDTO['RoomType'] = $ivRow['RoomType1'];
                    $invoiceHotelDTO['RoomClass'] = $ivRow['RoomClass1'];
                    $invoiceHotelDTO['NoNight'] = $ivRow['NiteNo1'];

                    if (! empty($invoiceHotelTemp)) {
                        $nDay = strtotime($ivRow['ArrvDate1']) - strtotime("12:00:00");
                        if ($nDay > 0) {
                            $invoiceDTO['Hotel'][] = $invoiceHotelTemp;
                        }
                    } else {
                        $invoiceDTO['Hotel'][] = $invoiceHotelDTO;
                    }

                    if (! isset($ivRow['RoomType2']) and ! isset($ivRow['RoomType2']) and ($ivRow['HotelStatus1'] != 'CLXL' or $ivRow['HotelStatus1'] != '')) {
                        $invoiceHotelTemp = array();
                        $date2 = strtotime($ivRow['ArrvDate2']);
                        $invoiceHotelTemp['HotelName'] = $ivRow['Hotel'];
                        $invoiceHotelDTO['NoRoom'] = (empty($ivRow['RoomNo2'])) ? 0 : $ivRow['RoomNo2'];

                        $invoiceHotelDTO['RoomType'] = $ivRow['RoomType2'];
                        $invoiceHotelDTO['RoomClass'] = $ivRow['RoomClass2'];
                        $invoiceHotelDTO['NoNight'] = $ivRow['NiteNo2'];
                    }
                }
            } else {
                $lstInvoiceHotelTemp = $this->getListHotelInRoomList($ivRow, 1);

                if (! empty($ivRow['Room_List2']) and ($ivRow['HotelStatus2'] != "CXL" or ! empty($ivRow['HotelStatus2']))) {
                    $lstInvoiceHotelTemp = $this->getListHotelInRoomList($ivRow, 2);
                }

                $invoiceDTO['Hotel'] = $lstInvoiceHotelTemp;
            }
        }
        $invoiceDTO['Hotel'] = $this->sortHotelList($invoiceDTO['Hotel']);
        return $invoiceDTO;
    }

    private function start($location, $ds_tour, $list_check)
    {
        if ($location == "OP" || $location == "NP" || $location == "KP" || $location == "TP") {
            $strCodeTariff = "";
            if ($location == "KP") {
                $strCodeTariff = $this->getTariffCode("KYUSIU");
            } else if ($location == "OP") {
                $strCodeTariff = $this->getTariffCode("OSAKA");
            } else if ($location == "TP") {
                $strCodeTariff = $this->getTariffCode("TOKYO");
            } else if ($location == "NP") {
                $strCodeTariff = $this->getTariffCode("NAGOYA");
            }
            if ($strCodeTariff != "") {
                $this->strTourTariff = $this->getTariffCode("TARIFF");
                $this->strTourTariff .= "," . $strCodeTariff;

                $strHost = $this->config->item('challenge_host');
                $strUrl = "http://{$strHost}/l/ltcq5_2_43_05?scid=_new";
                log_message('INFO', '[Invoice] Prepare to connection 1st time to Challenge in start');
                $htmlDoc = $this->getWeb($strUrl);
                $this->connection ++;
                $checked_tour = array();
                $tour_coude = explode(",", $list_check);
                // $tour_coude = array("03916001888");
                foreach ($tour_coude as $key => $value) {
                    if ($value != "") {
                        // TODO: change here
                        for ($i = 0; $i <= count($ds_tour) - 1; $i ++) {
                            if ($value == $ds_tour[$i]["TourCode"]) {
                                $checked_tour[] = $ds_tour[$i];
                            }
                        }
                    }
                }
                $result = $this->getData($htmlDoc, $checked_tour, $location);
                return $result;
            } else {
                echo "<script>alert('Don\'t load code tariff .Try Get Data Again');</script>";
            }
        } else {
            $lstInvoice = array();
            foreach ($ds_tour as $key => $row) {
                $invoice = $this->getDataFromNguyenTrai($row, $key);
                $lstInvoice[] = $invoice;
            }
            return $lstInvoice;
        }
    }

    private function getTariffCode($strCode)
    {
        $xml = file_get_contents("TourTariff.xml");

        $val = "";
        $index = "";
        $parser = xml_parser_create();
        xml_parse_into_struct($parser, $xml, $val, $index);

        if (isset($index[$strCode])) {
            return $val[$index[$strCode][0]]["value"];
        } else {
            return "";
        }
    }

    private function getData($htmlDoc, $checkedTour, $location)
    {
        $lstInvoice = array();
        foreach ($checkedTour as $key => $tour) {
            $invoice = array();
            $this->connection = 0;
            $invoice = $this->getDataInChallenge($tour, $location);
            if (! empty($invoice["Hotel"])) {
                if (count($invoice["Hotel"]) > 0) {
                    // if ($invoice["TypeCharge"] != "NoCharge") {
                    $invoice["Hotel"] = $this->sortHotelList($invoice["Hotel"]);
                    $invoice = $this->getTourTariff($invoice, $location);
                    $invoice = $this->setCodeDongKhoiForHotel($invoice);
                    $lstInvoice[] = $invoice;
                    $this->addInvoiceToDataGrid($invoice, $key);
                    // } else {
                    // $this->addInvoiceCancelToDataGrid($key);
                    // }
                } else {
                    if (! empty($invoice["TypeCharge"]) and $invoice["TypeCharge"] != "NoCharge") {
                        $this->addInvoiceToDataGrid($invoice, $key);
                    } else {
                        $this->addInvoiceCancelToDataGrid($key);
                    }
                }
            }
            sleep(5);
        }
        return $lstInvoice;
    }

    private function getTourTariff($invoice, $location)
    {
        $strMain = "";
        if (count($invoice["OptionalTour"]) > 0) {
            foreach ($invoice["OptionalTour"] as $str) {
                if (strpos($this->strTourTariff, strtoupper($str)) !== false) {
                    $strMain = $str;
                } elseif (strpos($str, "L/C18") !== false) {
                    $invoice["LC"] = "LCO18:00PM ";
                } elseif (strpos($str, "LCDPT") !== false) {
                    $invoice["LC"] = "LCO23:00PM ";
                }

                if ($location == "OP") {
                    if (strpos($strMain, "nss-1") === false and strpos($str, "NSS-1") !== false and (strpos($strMain, "OSA49") !== false or strpos($strMain, "OSA54") !== false or strpos($strMain, "OSA53") !== false or strpos($strMain, "OSA56") !== false)) {
                        $strMain .= "(nss-1)";
                    }
                }
            }
        }
        $flagHAN = false;
        $flagB17 = false;

        if ($strMain == "HLHAN") {
            $strMain = "HANHL";
        }

        if (strpos($strMain, "OSA49") !== false or strpos($strMain, "OSA54") !== false or strpos($strMain, "OSA53") !== false or strpos($strMain, "KYU27") !== false) {
            if (count($invoice["Hotel"]) >= 2) {
                $flagHAN = false;
                $flagB17 = false;
                foreach ($invoice["Hotel"] as $key => $value) {
                    if (isset($value["City"]) and strpos($value["City"], "HAN") !== false) {
                        $flagHAN = true;
                    } elseif (isset($value["City"]) and strpos($value["City"], "B17") !== false) {
                        $flagB17 = true;
                    }
                }
            }

            if ($flagB17 and $flagHAN) {
                $strMain .= "(hanhl)";
            }
        }

        $invoice['TourTariff'] = $strMain;

        return $invoice;
    }

    private function setCodeDongKhoiForHotel($invoiceDTO)
    {
        $flagDK = false;
        $flagQuota = true;

        if (isset($invoiceDTO["OptionalTour"]) and count($invoiceDTO["OptionalTour"]) > 0) {
            foreach ($invoiceDTO["OptionalTour"] as $str) {
                if (strpos($str, "DONKO") !== false) {
                    $flagDK = true;
                } elseif ($flagQuota and strpos($str, "QUOTA")) {
                    $invoiceDTO["TourTariff"] .= "(QUOTATION)";
                    $flagQuota = ffalse;
                }
            }
        }

        if ($flagDK and count($invoiceDTO["Hotel"]) > 0) {
            foreach ($invoiceDTO["Hotel"] as $key => $hotel) {
                if (strpos($hotel["City"], "SGN") !== false) {
                    $invoiceDTO["Hotel"][$key]["HotelName"] = str_replace(")", "d)", $hotel["HotelName"]);
                }
            }
        }
        return $invoiceDTO;
    }

    private function addInvoiceToDataGrid()
    {
    /**
     * TODO
     */
    }

    private function addInvoiceCancelToDataGrid()
    {
    /**
     * TODO
     */
    }

    private function getDataInChallenge($row, $location)
    {
        $flagComplete = true;
        while ($flagComplete) {
            $invoiceDTO = $this->createInvoiceDTOObj();

            $invoiceDTO['HisCode'] = $row["TourCode"];

            if (! empty($row["NPer"])) {
                $invoiceDTO["NoPax"] = $row["NPer"];
            } else {
                $invoiceDTO["NoPax"] = 0;
            }
            $invoiceDTO["Code"] = $row["VnCode"];
            $invoiceDTO["StartDate"] = $row["ArrvDate"];
            $invoiceDTO["Status"] = $row["TourStatus"];
            $invoiceDTO["DateRequest"] = "";
            // TODO: change here

            $strHost = $this->config->item('challenge_host');
            $strURL = "http://{$strHost}/l/ltcq5_43_08?scid=_new&IvrCD=01&nbRsvNo=" . $invoiceDTO["HisCode"];
            log_message('INFO', '[Invoice] Prepare to connection 1st time to Challenge in getDataInChallenge');
            $htmlDoc = $this->getWeb($strURL);
            $this->connection ++;
            $data = $this->dataParse($htmlDoc);
            $postTo = $this->getFormUrl($htmlDoc);
            $strUrl = "http://{$strHost}/{$postTo}";
            log_message('INFO', '[Invoice] Prepare to connection 2nd time to Challenge in getDataInChallenge');
            $this->currentFile = 'getDataChallenge_2_post.html';
            $htmlDoc = $this->getWeb($strUrl, true, $data);
            $this->connection ++;
            $data = $this->parseDataFromWbTemp($htmlDoc);
            $htmlTablesElements = $this->getTagFullFromHtml($htmlDoc, "<TABLE", "</TABLE>");
            $eleTableNewBook = end($htmlTablesElements);

            if (count($htmlTablesElements) > 0) {
                $flagNPax = true;
                $flagIn = true;
                $lstURLCustomer = array();
                $lstUrlClassHotel = array();
                $optionCode = "";
                $flag = false;
                foreach ($data as $value) {
                    $lstUrlClassHotel[] = $value["hotelUrl"];
                    $lstURLCustomer[] = $value["CustomerURL"];
                    $optionCode = $value["Resv_No"];
                    if (empty($value["CLS"])) {
                        $flag = true;
                    } elseif ($value["CLS"] == "IN") {
                        $flagIn = false;
                    }
                    if ($flag and $flagIn and ($value["ETA"] == "JP" or $value["ETA"] == "LP") and $value["IVR"] != "CW") {
                        $invoiceDTO["OptionalTour"][] = $this->ConvertOptionTour($optionCode);
                    }
                }
                if ($invoiceDTO["Status"] != "CXL") {
                    if ($location == "OP" or $location == "NP") {
                        if (count($htmlTablesElements) == 3) {
                            $invoiceDTO["DateRequest"] = $this->getDateRequestOSA($eleTableNewBook);
                        }

                        if (empty($invoiceDTO["DateRequest"])) {
                            $invoiceDTO["DateRequest"] = $this->getDateRequest($data, $lstUrlClassHotel);
                            if (empty($invoiceDTO["DateRequest"])) {
                                $invoiceDTO["CommentDataRequest"] = "Check Date in Booking Paper";
                            } else {
                                $invoiceDTO["CommentDataRequest"] = "Data Request Cach 2";
                            }
                        }
                    } else {
                        $invoiceDTO["DateRequest"] = $this->getDateRequest($data, $lstUrlClassHotel);
                    }
                    $invoiceDTO = $this->getNameGuestNonCancel($data, $invoiceDTO); // tuan change

                    // $invoiceDTO = $this->getNoGuest($data, $invoiceDTO); // tuan change

                    $invoiceDTO = $this->getHotelClassOfTour($data, $lstUrlClassHotel, $invoiceDTO, $location); // tuan change
                } else {
                    if ($location == "OP" or $location == "NP") {
                        if (count($htmlTablesElements) == 3) {
                            $invoiceDTO["DateRequest"] = $this->getDateRequestOSA($eleTableNewBook);
                        }

                        if (empty($invoiceDTO["DateRequest"])) {
                            $invoiceDTO["DateRequest"] = $this->getDateRequest($data, $lstUrlClassHotel);
                            if (empty($invoiceDTO["DateRequest"])) {
                                $invoiceDTO["CommentDataRequest"] = "Check Date in Booking Paper";
                            } else {
                                $invoiceDTO["CommentDataRequest"] = "Data Request Cach 2";
                            }
                        }
                    } else {
                        // 25-04-2016: Nghi Ho changed
                        $invoiceDTO["DateRequest"] = $this->getDateRequestCXL($data, $lstUrlClassHotel);
                    }
                    $invoiceDTO = $this->getNameGuestCancel($data, $invoiceDTO); // tuan change
                    $invoiceDTO = $this->proccessTourCancel($data, $invoiceDTO, $location); // tuan change
                }
            }
            $flagComplete = false;
        }
        return $invoiceDTO;
    }

    private function ConvertOptionTour($code)
    {
        $sub = substr($code, strpos($code, "(") + 1, ((strpos($code, ")") - 1) - strpos($code, "(")));
        return $sub;
    }

    private function convertGridToChidPage($data)
    {
        $result = array();
        foreach ($data as $key => $value) {
            // if(count($value)>0)
            if (count($value) >= 27) {
                $value = array_values($value);

                $childPage = array();
                $childPage["No"] = $value[0];
                $childPage["Ch"] = $value[1];
                $childPage["RQ"] = $value[2];
                $childPage["RQ_IVR"] = $value[3];
                $childPage["IVR"] = $value[4];
                $childPage["AGT"] = $value[5];
                $childPage["Com"] = $value[6];
                $childPage["Resv_No"] = $value[7];
                $childPage["CLS"] = $value[8];
                $childPage["City"] = $value[9];
                $childPage["AGT1"] = $value[10];
                $childPage["strDate"] = $value[11];
                $childPage["ETD"] = $value[12];
                $childPage["ETA"] = $value[13];
                $childPage["Term"] = $value[14];
                $childPage["H_Person"] = $value[15];
                $childPage["Pax"] = $value[16];
                $childPage["E"] = $value[17];
                $childPage["M"] = $value[18];
                $childPage["R"] = $value[19];
                $childPage["A"] = $value[20];
                $childPage["FLT_No"] = $value[21];
                $childPage["B"] = $value[22];
                $childPage["L"] = $value[23];
                $childPage["M1"] = $value[24];
                $childPage["D"] = $value[25];
                $childPage["Conf_Ref"] = $value[26];
                // $childPage["Ptr"] = $value[27];
                $result[] = $childPage;
            }
        }
        return $result;
    }

    private function getNameGuestCancel($lstChildPage, $invoiceDTO)
    {
        if (count($lstChildPage) > 0) {
            $nRow = 0;
            foreach ($lstChildPage as $key => $value) {
                if ($nRow > count($lstChildPage) - 2) {
                    break;
                }

                $nRow ++;

                if (is_numeric($value["Term"]) and false !== strpos($value["IVR"], "CW") and false !== strpos($value["IVR"], "CF") and false !== strpos($value["IVR"], "CR")) {
                    $invoiceDTO["GuestName"] = substr($value["H_Person"], 0, strpos($value["H_Person"], "("));
                    break;
                }
            }
        }
        return $invoiceDTO;
    }

    private function proccessTourCancel($data, $invoiceDTO, $location)
    {
        $invoiceHotel = "";
        $currentRow = 0;
        // $lstCancelLinkCW = array();
        $lstCancelLinkCF = array();
        $lstUrl = array();
        $lstUrlClassHotel = array();
        $flagIn = true;
        $flagCF = false;
        $optionalCode = "";
        $strHotel = "";
        $flag = false;
        foreach ($data as $key => $value) {
            if ($value["IVR"] == "CF") {
                $flagCF = true;
            } elseif ($value["IVR"] == "CW") {
                $flagCF = false;
            }
            $strHotel = $value["hotelUrl"];
            if (! empty($value["Resv_No"])) {
                $optionalCode = $value["Resv_No"];
            }
            if (empty($value["CLS"])) {
                $flag = true;
            } elseif ($value["CLS"] == "IN") {
                $flagIn = false;
            }
            if (is_numeric($value["Term"])) {
                $lstUrlClassHotel[] = $strHotel;
                if ($flagCF) {
                    $lstCancelLinkCF[] = $strHotel;
                }
            }
            if ($flag and $flagIn and ($value["ETA"] == "JP" or $value["ETA"] == "LP")) {
                $invoiceDTO["OptionalTour"][] = $this->ConvertOptionTour($optionalCode);
            }
        }
        if (count($lstCancelLinkCF) > 0) {
            $invoiceDTO["Hotel"] = $this->getHotelClassOfTourCancel($lstCancelLinkCF, $lstUrlClassHotel, $invoiceDTO, $location);
        }
        if ($invoiceDTO["TypeCharge"] == "NoCharge") {
            if (count($invoiceDTO["Hotel"]) > 0) {
                $invoiceDTO = $this->checkBeachHotelCancel($invoiceDTO);
            }
        }
        return $invoiceDTO;
    }

    /*
     * create by : Le Ngoc Tuan
     * date create : 08/03/2106
     * version : 1.0
     */
    private function getHotelClassOfTourCancel($lstURLClassHotelCancel, $lstURLClassHotel, $invoiceDTO, $location)
    {
        $lstInvoiceHotelDTO = array();
        if (sizeof($lstURLClassHotelCancel) > 0) {
            $strURL = "http://" . $this->config->item("challenge_host") . "/";
            if (count($lstURLClassHotelCancel) == 1) {
                $strURL .= $lstURLClassHotelCancel[0];
                $invoiceHotelTemp = $this->chargeHotelClassOfTourCancel($strURL, $invoiceDTO, $location);
                if (! empty($invoiceHotelTemp)) {
                    $lstInvoiceHotelDTO[] = $invoiceHotelTemp;
                }
                /*
                 * Waiting and set max connection challenge
                 */
                $this->connection ++;
                sleep(5);
                /*
                 * End Waiting and set max connection challenge
                 */
            } else {
                foreach ($lstURLClassHotel as $value) {
                    $invoiceHotelTemp = array();
                    $strURL = "http://" . $this->config->item("challenge_host") . "/";
                    $strURL .= $value;
                    $invoiceHotelTemp = $this->chargeHotelClassOfTourCancel($strURL, $invoiceDTO, $location);
                    if (! empty($invoiceHotelTemp["TypeCharge"])) {
                        if ($invoiceHotelTemp["TypeCharge"] != "NoCharge") {
                            if (! empty($invoiceHotelTemp)) {
                                $lstInvoiceHotelDTO[] = $invoiceHotelTemp;
                            }
                        }
                    }
                    /*
                     * Waiting and set max connection challenge
                     */
                    if ($this->connection >= 500) {
                        break;
                    }
                    $this->connection ++;
                    sleep(5);
                    /*
                     * End Waiting and set max connection challenge
                     */
                }
            }
        }
        /* Write Log */
        if ($this->connection >= 500) {
            log_message('INFO', '[Invoice] MAX Connection Get Hotel Cancel Information');
        }
        /* End Write Log */
        return $lstInvoiceHotelDTO;
    }

    private function parseHTMLTableTour($wbMain)
    {
        $htmlTrInElementTable = "";
        $htmlTablesElements = $this->getTagFullFromHtml($wbMain, "<TABLE", "</TABLE>");
        // Add $start 20160427
        $start = microtime(true);
        while (count($htmlTablesElements) == 0) {
            $htmlTablesElements = $this->getTagFullFromHtml($wbMain, "<TABLE", "</TABLE>");
            if (microtime(true) - $start > 60) {
                break;
            }
        }
        if (count($htmlTablesElements) > 0) {
            $htmlTableTarget = $this->GetTableTargetBasedOnHtmlElementCollection($htmlTablesElements);
            if ($htmlTableTarget != "") {
                $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR", "</TR>");
            }
        }
        return $htmlTrInElementTable;
    }

    private function getHotelClassOfTour($lstChildPage, $lstURLHotel, $invoiceDTO, $location)
    {
        $lstInvoiceHotelDTO = array();
        $strURL = "";
        /* get hotel no cancel. */
        $nRow = 0;
        $lstHotelElement = $lstURLHotel;
        foreach ($lstChildPage as $childPage) {
            if ($nRow > count($lstChildPage) - 1) {
                break;
            }
            $strURL = "http://" . $this->config->item("challenge_host") . "/";
            if (is_numeric($childPage["Term"]) and false === strpos($childPage["IVR"], "CW") and false === strpos($childPage["IVR"], "CF") and false === strpos($childPage["IVR"], "CR")) {
                $strURL = $strURL . $lstHotelElement[$nRow];
                $invoiceHotelDTO = $this->getClassOfHotel($strURL); // check update function getClassOfHotel
                $invoiceHotelDTO["HotelCode"] = $childPage["Resv_No"];
                $invoiceHotelDTO["ArriveDate"] = $childPage["Date"];
                $invoiceHotelDTO["City"] = $childPage["City"];
                $invoiceHotelDTO["DeptDate"] = $childPage["ETD"];
                $lstInvoiceHotelDTO[] = $invoiceHotelDTO;
                /*
                 * Waiting and set max connection challenge
                 */
                if ($this->connection >= 500) {
                    break;
                }
                $this->connection ++;
                sleep(5);
                /*
                 * End Waiting and set max connection challenge
                 */
            }
            $nRow ++;
        }
        /* Write Log */
        if ($this->connection >= 500) {
            log_message('INFO', '[Invoice] MAX Connection Get Hotel Information');
        }
        /* End Write Log */
        /* end get hotel no cancel. */

        // Edit 20160427
        /* get hotel cancel. */
        $nRow = 0;
        foreach ($lstChildPage as $key => $childPage) {
            if (is_numeric($childPage["Term"]) and false !== strpos($childPage["IVR"], "CF")) {
                $strURL = "http://" . $this->config->item("challenge_host");
                $strURL .= '/' . $childPage["hotelUrl"];
                $invoiceHotelDTO = $this->chargeHotelClassOfTourCancel($strURL, $invoiceDTO, $location); // check update function chargeHotelClassOfTourCancel
                if (! empty($invoiceHotelDTO)) {
                    if (! empty($invoiceHotelDTO["TypeCharge"]) and $invoiceHotelDTO["TypeCharge"] != "NoCharge") {
                        $invoiceHotelDTO["HotelCode"] = $childPage["Resv_No"];
                        $invoiceHotelDTO["ArriveDate"] = $childPage["Date"];
                        $invoiceHotelDTO["City"] = $childPage["City"];
                        $invoiceHotelDTO["DeptDate"] = $childPage["ETD"];
                        if (strpos($childPage["ETA"], "-") !== false) {
                            $invoiceHotelDTO["RoomType"] = substr($childPage["ETA"], 0, strpos($childPage["ETA"], "-"));
                        } else {
                            $invoiceHotelDTO["RoomType"] = $childPage["ETA"];
                        }
                        $invoiceHotelDTO["RoomClass"] = $childPage["CLS"];
                        if (count($invoiceHotelDTO) > 0) {
                            $result = $this->isExitsHotel($lstInvoiceHotelDTO, $invoiceHotelDTO);
                            if ($result['result'] == false) {
                                $invoiceHotelDTO["HotelComment"] = " Hotel Change CXL >> Full Charge";
                                $lstInvoiceHotelDTO[] = $invoiceHotelDTO;
                            } else {
                                $lstInvoiceHotelDTO = $result['content'];
                                foreach ($lstInvoiceHotelDTO as $key => $value) {
                                    if ($value["HotelCode"] == $invoiceHotelDTO["HotelCode"] && $value["RoomType"] == $invoiceHotelDTO["RoomType"] && $value["RoomClass"] == $invoiceHotelDTO["RoomClass"]) {
                                        if ($invoiceHotelDTO["ArriveDate"] == $value["ArriveDate"]) {
                                            $lstInvoiceHotelDTO[$key]["HotelComment"] .= "\r\n" . $invoiceHotelDTO["TypeCharge"];
                                            break;
                                        }
                                    }
                                }
                            }
                        } else {
                            $lstInvoiceHotelDTO[] = $invoiceHotelDTO;
                        }
                    }
                }
                /*
                 * Waiting and set max connection challenge
                 */
                if ($this->connection >= 500) {
                    break;
                }
                $this->connection ++;
                sleep(5);
                /*
                 * End Waiting and set max connection challenge
                 */
            }
        }
        /* Write Log */
        if ($this->connection >= 500) {
            log_message('INFO', '[Invoice] MAX Connection Get Hotel Information');
        }
        /* End Write Log */
        $invoiceDTO["Hotel"] = $lstInvoiceHotelDTO;
        return $invoiceDTO;
    }

    /*
     * create by : Le Ngoc Tuan
     * date create : 08/03/2106
     * version : 1.0
     */
    private function chargeHotelClassOfTourCancel($strURL, $invoiceDTO, $location)
    {
        $strCodeHotelClass = "";
        log_message('INFO', '[Invoice] Prepare to connection 1st time to Challenge in chargeHotelClassOfTourCancel');
        $this->currentFile = 'chargeHotelClassOfTourCancel' . md5($strURL) . '.html';
        $wbrCus = $this->getWeb($strURL);
        $invoiceHotelDTO = array();
        $array_charge = array();
        $str_check = "";
        $htmlTablesElements = $this->getTagFullFromHtml($wbrCus, "<TABLE", "</TABLE>");
        if (count($htmlTablesElements) == 2) {
            $htmlTableTarget = $htmlTablesElements[0];
            if (! empty($htmlTableTarget)) {
                $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
                foreach ($htmlTrInElementTable as $key => $element) {
                    $htmlTdIntr = $this->getTagFullFromHtml($element, "<TD>", "</TD>");
                    $eleIndex = 0;
                    if (count($htmlTdIntr) != 0) {
                        foreach ($htmlTdIntr as $ele) {
                            $innerText = trim(preg_replace("/<[^>]*>/", "", $ele));
                            if ($eleIndex == 0) {
                                $invoiceHotelDTO["HotelName"] = $innerText;
                            } elseif ($eleIndex == 1) {
                                $invoiceHotelDTO["RoomClass"] = $innerText;
                            } elseif ($eleIndex == 2) {
                                $invoiceHotelDTO["City"] = $innerText;
                            } elseif ($eleIndex == 7) {
                                $invoiceHotelDTO["RoomType"] = $innerText;
                            } elseif ($eleIndex == 8) {
                                $invoiceHotelDTO["NoNight"] = $innerText;
                            } elseif ($eleIndex == 10) {
                                // Add 20160427
                                $innerText = trim($innerText);
                                if (is_numeric($innerText[0]))
                                    $invoiceHotelDTO["Pax"] = (int) $innerText[0];
                            }
                            $eleIndex ++;
                        }
                    }
                }
            }
            $htmlTableTarget = $htmlTablesElements[1];
            if (! empty($htmlTableTarget)) {
                $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
                $flagAnswerOK = false;
                $date_challenge = "";
                $flag = false;
                foreach ($htmlTrInElementTable as $key => $element) {
                    $htmlTdIntr = $this->getTagFullFromHtml($element, "<TD>", "</TD>");
                    $eleIndex = 0;
                    if (count($htmlTdIntr) != 0) {
                        foreach ($htmlTdIntr as $ele) {
                            $innerText = trim(preg_replace("/<[^>]*>/", "", $ele));
                            if ($eleIndex == 1) {
                                $date_challenge = $innerText;
                            } elseif ($eleIndex == 3) {
                                $strCode = $innerText;
                                $strCode = str_replace(" ", "", $strCode);
                                if (! empty($strCode) && $strCode != "&nbsp;") {
                                    $strCodeHotelClass = $strCode;
                                }
                            } elseif ($eleIndex == 11) {
                                if (strpos($innerText, "OK") !== false) {
                                    $flagAnswerOK = true;
                                } elseif (strpos($innerText, "CR") !== false && $flag) {
                                    $strTypeCharge = $this->chargeConditionTourCancel($date_challenge, $invoiceDTO["StartDate"], $location);
                                    $flag = false;
                                    break;
                                } elseif (strpos($innerText, "CF") !== false) {
                                    $flag = true;
                                }
                            }
                            $eleIndex ++;
                        }
                    }
                }
            }
            if ($flagAnswerOK) {
                $flagHotelCode = false;
                $invoiceHotelDTO["TypeCharge"] = $strTypeCharge;
                $i = 0;
                foreach ($this->HOTELCLASS as $hotel) {
                    if (strpos($strCodeHotelClass, $hotel) !== false) {
                        $flagHotelCode = true;
                        if (strpos($strCodeHotelClass, "DON") !== false) {
                            $strCodeHotelClass = "(" . $this->NAMECLASS[$i] . "d)";
                        } else {
                            $strCodeHotelClass = "(" . $this->NAMECLASS[$i] . ")";
                        }
                        break;
                    }
                    $i ++;
                }
                $invoiceHotelDTO["HotelName"] = str_replace(" HOTEL", "", $invoiceHotelDTO["HotelName"]);
                $invoiceHotelDTO["HotelName"] = str_replace("$", "", $invoiceHotelDTO["HotelName"]);
                if (strpos($invoiceHotelDTO["HotelName"], "(") !== false) {
                    $invoiceHotelDTO["HotelName"] = substr($invoiceHotelDTO["HotelName"], 0, strpos($invoiceHotelDTO["HotelName"], "("));
                } elseif (strpos($invoiceHotelDTO["HotelName"], "（") !== false) {
                    $invoiceHotelDTO["HotelName"] = substr($invoiceHotelDTO["HotelName"], 0, strpos($invoiceHotelDTO["HotelName"], "（"));
                }
                if ($flagHotelCode) {
                    $invoiceHotelDTO["HotelName"] = $invoiceHotelDTO["HotelName"] . $strCodeHotelClass;
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        return $invoiceHotelDTO;
    }

    /*
     * create by : Le Ngoc Tuan
     * date create : 08/03/2106
     * version : 1.0
     */
    private function getClassOfHotel($strURL)
    {
        log_message('INFO', '[Invoice] Prepare to connection 1st time to Challenge in getClassOfHotel');
        $this->currentFile = 'getClassOfHotel' . md5($strURL) . '.html';

        $wbrCus = $this->getWeb($strURL);
        // $invoiceHotelDTO = array();
        $invoiceHotelDTO["HotelName"] = '';
        $invoiceHotelDTO["RoomClass"] = '';
        $invoiceHotelDTO["RoomType"] = '';
        $invoiceHotelDTO["NoNight"] = '';
        $invoiceHotelDTO["Pax"] = '';
        $strCodeHotelClass = "";
        $htmlTablesElements = $this->getTagFullFromHtml($wbrCus, "<TABLE", "</TABLE>");
        if (count($htmlTablesElements) == 2) {
            $htmlTableTarget = $htmlTablesElements[0];
            if (! empty($htmlTableTarget)) {
                $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
                foreach ($htmlTrInElementTable as $key => $element) {
                    $htmlTdIntr = $this->getTagFullFromHtml($element, "<TD>", "</TD>");
                    $eleIndex = 0;
                    if (count($htmlTdIntr) != 0) {
                        foreach ($htmlTdIntr as $ele) {
                            $innerText = trim(preg_replace("/<[^>]*>/", "", $ele));
                            // Added 20160427
                            $innerText = trim($innerText);
                            if ($eleIndex == 0) {
                                $invoiceHotelDTO["HotelName"] = $innerText;
                            } elseif ($eleIndex == 1) {
                                $invoiceHotelDTO["RoomClass"] = $innerText;
                            } elseif ($eleIndex == 7) {
                                $invoiceHotelDTO["RoomType"] = $innerText;
                            } elseif ($eleIndex == 8) {
                                $invoiceHotelDTO["NoNight"] = $innerText;
                            } elseif ($eleIndex == 10) {
                                if (is_numeric($innerText[0]))
                                    $invoiceHotelDTO["Pax"] = (int) $innerText[0];
                            }
                            $eleIndex ++;
                        }
                    }
                }
            }
            $htmlTableTarget = $htmlTablesElements[1];
            if (! empty($htmlTableTarget)) {
                $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
                foreach ($htmlTrInElementTable as $key => $element) {
                    $htmlTdIntr = $this->getTagFullFromHtml($element, "<TD>", "</TD>");
                    $eleIndex = 0;
                    if (count($htmlTdIntr) != 0) {
                        foreach ($htmlTdIntr as $ele) {
                            $innerText = trim(preg_replace("/<[^>]*>/", "", $ele));
                            $strCode = $innerText;
                            $strCode = str_replace('&nbsp;', '', $strCode);
                            if ($eleIndex == 3) {
                                if (! empty($strCode)) {
                                    $strCodeHotelClass = $strCode;
                                }
                            }

                            // Added 20160427
                            $eleIndex ++;
                        }
                    }
                }
            }
            $flagCodeHotel = false;
            $i = 0;
            foreach ($this->HOTELCLASS as $hotel) {
                if (strpos($strCodeHotelClass, $hotel) !== false) {
                    $flagCodeHotel = true;
                    if (strpos($strCodeHotelClass, "DON") !== false) {
                        $strCodeHotelClass = "(" . $this->NAMECLASS[$i] . "d)";
                    } else {
                        $strCodeHotelClass = "(" . $this->NAMECLASS[$i] . ")";
                    }
                    break;
                }
                $i ++;
            }

            $invoiceHotelDTO["HotelName"] = str_replace(" HOTEL", "", $invoiceHotelDTO["HotelName"]);
            $invoiceHotelDTO["HotelName"] = str_replace("$", "", $invoiceHotelDTO["HotelName"]);
            $invoiceHotelDTO["HotelName"] = mb_convert_encoding(str_replace("&amp;", "&", $invoiceHotelDTO['HotelName']), 'UTF-8', 'SJIS');
            if (strpos($invoiceHotelDTO["HotelName"], "(") !== false) {
                $invoiceHotelDTO["HotelName"] = substr($invoiceHotelDTO["HotelName"], 0, strpos($invoiceHotelDTO["HotelName"], "("));
            } elseif (strpos($invoiceHotelDTO["HotelName"], "（") !== false) {
                $invoiceHotelDTO["HotelName"] = substr($invoiceHotelDTO["HotelName"], 0, strpos($invoiceHotelDTO["HotelName"], "（"));
            }
            if ($flagCodeHotel) {
                $invoiceHotelDTO["HotelName"] = $invoiceHotelDTO["HotelName"] . $strCodeHotelClass;
            }
        }
        return $invoiceHotelDTO;
    }

    private function getDateRequestOSA($htmlTablesElements)
    {
        $strDateTemp = "";
        $strDate = "";

        if (! empty($htmlTablesElements)) {
            $htmlTrInEmlementTable = $this->getTagFullFromHtml($htmlTablesElements, "<TR>", "</TR>");

            foreach ($htmlTrInEmlementTable as $element) {
                $htmlTdInTr = $this->getTagFullFromHtml($element, "<TD>", "</TD>");

                $eleIndex = 0;
                if (count($htmlTdInTr) > 0) {
                    foreach ($htmlTdInTr as $ele) {
                        $innerText = trim(preg_replace("/<[^>]*>/", "", $ele));
                        if ($eleIndex == 0) {
                            $strDate = date("d/m/Y", strtotime($innerText));
                        } elseif ($eleIndex == 10) {
                            if (false !== strpos($innerText, "NEWBOOK") or false !== strpos($innerText, "NB") or false !== strpos($innerText, "NB:OK") or false !== strpos($innerText, "N/B")) {
                                $strDateTemp = $strDate;
                            }
                        }
                        $eleIndex ++;
                    }
                }
            }
        }

        return $strDateTemp;
    }

    private function getDateRequest($lstTotalChildPag, $lstURLHotel)
    {
        $strURL = "http://" . $this->config->item("challenge_host");
        foreach ($lstURLHotel as $key => $url) {
            if (isset($lstTotalChildPag[$key]) and trim($lstTotalChildPag[$key]["CLS"]) == "" and false !== strpos("FN", $lstTotalChildPag[$key]["IVR"])) {
                $start = strpos($lstTotalChildPag[$key]["Resv_No"], "(") + 1;
                $number = strpos($lstTotalChildPag[$key]["Resv_No"], ")") - $start - 1;
                $strMainCode = substr($lstTotalChildPag[$key]["Resv_No"], $start, $number);
                if (strpos($this->strTourTariff, $strMainCode) !== false) {
                    $strURL = "http://" . $this->config->item("challenge_host");
                    $strURL .= '/' . $this->convertUrl($url);
                    $date = $this->getDateRequestInChanlenge($strURL);
                    $this->connection ++;
                    return empty($date) ? '' : date("d/m/Y", strtotime($date));
                }
            } elseif (is_numeric(trim($lstTotalChildPag[$key]["Term"]))) {
                $strURL .= '/' . $this->convertUrl($url);
            }
        }

        $date = $this->getDateRequestInChanlenge($strURL);
        $this->connection ++;
        return empty($date) ? '' : date("d/m/Y", strtotime($date));
    }

    private function getNameGuestNonCancel($lstChildPage, $invoiceDTO)
    {
        $person_array = array();
        foreach ($lstChildPage as $page) {
            if (is_numeric($page["Term"]) and strpos($page["IVR"], "CW") === false and strpos($page["IVR"], "CF") === false and strpos($page["IVR"], "CR") === false) {
                $guest_name = substr($page["H_Person"], 0, strpos($page["H_Person"], "("));
                if (in_array($guest_name, $person_array)) {
                    continue;
                }
                $person_array[] = $guest_name;
            }
        }
        $cancel_guest = 0;

        foreach ($lstChildPage as $page) {
            if (is_numeric($page["Term"]) and strpos($page["IVR"], "CF") !== false) {
                $pax = substr($page["PAX"], 0, strpos($page["PAX"], "("));
                if ($pax > 1) {
                    $guestname = $this->guest_name($page["CustomerURL"]);
                    foreach ($guestname as $guest) {
                        if (in_array($guest["Name"], $person_array)) {
                            continue;
                        }
                        $person_array[] = $guest["Name"];
                        $cancel_guest += 1;
                    }
                    /*
                     * Waiting and set max connection challenge
                     */
                    if ($this->connection >= 500) {
                        break;
                    }
                    $this->connection ++;
                    sleep(5);
                    /*
                     * End Waiting and set max connection challenge
                     */
                } else {
                    $guest_name = substr($page["H_Person"], 0, strpos($page["H_Person"], "("));
                    if (in_array($guest_name, $person_array)) {
                        continue;
                    }
                    $person_array[] = $guest_name;
                    $cancel_guest += substr($page["PAX"], 0, strpos($page["PAX"], "("));
                }
            }
        }
        /* Write log */
        if ($this->connection >= 500) {
            log_message('INFO', '[Invoice] Max Connection Get CustomerName.');
        }
        /* End Write log */
        $invoiceDTO['CancelCharge'] = $cancel_guest;

        $nRow = 0;
        if (count($lstChildPage) > 0) {
            foreach ($lstChildPage as $page) {
                if ($nRow >= count($lstChildPage) - 2) {
                    break;
                }
                if (is_numeric($page["Term"]) and strpos($page["IVR"], "CW") === false and strpos($page["IVR"], "CF") === false and strpos($page["IVR"], "CR") === false) {
                    $invoiceDTO["GuestName"] = substr($page["H_Person"], 0, strpos($page["H_Person"], "("));
                    break;
                }
                $nRow += 1;
            }
        }
        return $invoiceDTO;
    }

    function guest_name($str_URL)
    {
        $strUrl = "";
        $strURLCustomer = "";
        $htmlTablesElements = "";
        $flagComplete = true;
        $lstCustomer = array();
        $strURLCustomer = $str_URL;

        $i = 1;
        while ($flagComplete) {
            $strUrl = $strURL = "http://" . $this->config->item("challenge_host");
            $strUrl .= "/" . $strURLCustomer;
            $i ++;
            log_message('INFO', '[Invoice] Prepare to connection ' . $i . '(th) time to Challenge in getCustomersFromLink');
            $this->currentFile = 'getCustomersFromLink' . md5($strUrl) . '.html';
            $html = $this->getWeb($strUrl);

            $htmlTrInElementTable = $this->getTagFullFromHtml($html, "<TABLE", "</TABLE>");

            $htmlTableTarget = "";
            if (count($htmlTrInElementTable) > 0) {
                $htmlTableTarget = reset($htmlTrInElementTable);
            }

            $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
            if (count($htmlTrInElementTable) > 0) {
                foreach ($htmlTrInElementTable as $key => $value) {
                    $customer = array();
                    $customerChange = array();
                    $htmlTdInTr = $this->getTagFullFromHtml($value, "<TD>", "</TD>");
                    $eleIndex = 0;

                    if (count($htmlTdInTr) > 0) {
                        foreach ($htmlTdInTr as $ele) {
                            $innerText = preg_replace("/<[^>]*>/", "", $ele);
                            if ($eleIndex == 0) {
                                $customer["ID"] = trim($innerText);
                            } elseif ($eleIndex == 1) {
                                $customer["Name"] = trim($innerText);
                            } elseif ($eleIndex == 2) {
                                if (! empty($innerText)) {
                                    $customerChange["Name"] = $innerText;
                                    $customerChange["ID"] = $customer["ID"];
                                }
                            } elseif ($eleIndex == 3) {
                                $customer["Age"] = trim($innerText);
                            } elseif ($eleIndex == 4) {
                                $customer["Type"] = trim($innerText);
                            }
                            $eleIndex ++;
                        }
                    }
                    if (count($customer) > 0) {
                        $lstCustomer[] = $customer;
                    }
                }
            }

            $flagComplete = false;
        }
        return $lstCustomer;
    }

    function getUrl($html)
    {
        /**
         * TODO: Code lay url o day
         */
        $html_input = $html->find("input");
        $array_url = array();

        foreach ($html_input as $as) {
            $array_url[$as->attr["name"]] = $as->attr["value"];
            // if($as->attr["name"] == "scid" || $as->attr["name"] == "dv:res" || $as->attr["name"] == "dv:msgid" || $as->attr["name"] == "dv:svr"|| $as->attr["name"] == "dv:svrmgr" || $as->attr["name"] == "dv:queue" || $as->attr["name"] == "dv:count"){
            //
            // if($as->attr["name"] == "scid"){
            // $array_url[] = $as->attr["name"] ."=".$as->attr["value"];
            // }
            // if($as->attr["name"] == "dv:res"){
            // $array_url[] = "r=".$as->attr["value"];
            // }
            // if($as->attr["name"] == "dv:msgid"){
            // $array_url[] = "i=".$as->attr["value"];
            // }
            // if($as->attr["name"] == "dv:svr"){
            // $array_url[] = "s=".$as->attr["value"];
            // }
            // if($as->attr["name"] == "dv:svrmgr"){
            // $array_url[] = "m=".$as->attr["value"];
            // }
            // if($as->attr["name"] == "dv:queue"){
            // $array_url[] = "q=".$as->attr["value"];
            // }
            // if($as->attr["name"] == "dv:count"){
            // $array_url[] = "c=".$as->attr["value"];
            // }
            // }
        }
        // $str_Url = "http://" . $this->config->item("challenge_host")."/b/btcq1_9_1_1?";
        // $str_Url .= implode("&" , $array_url);
        return $array_url;
    }

    function isWaiting($html)
    {
        /**
         * TODO: Kiem tra xem co thanh phan dac biet cua waiting hay khong
         */
        $table = $html->find("table");
        if (count($table) > 0) {
            return false;
        }
        return true;
    }

    private function getNoGuest($lstChildPage, $invoiceDTO)
    {
        foreach ($lstChildPage as $key => $childPage) {
            if (is_numeric($childPage["Term"]) and false !== strpos($childPage["IVR"], "CF")) {
                $strURL = "http://" . $this->config->item("challenge_host");
                $strURL .= "/b/btcq1_9_1_1?scid=_new&nbRsvNo=" . $invoiceDTO["HisCode"];
                $html = $this->getWeb($strURL);
                $domElements = str_get_html($html);
                $array_data_post = $this->getUrl($domElements);
                $count = 0;
                $maxWaitingLoop = 100;
                $isWaiting = $this->isWaiting($domElements);
                while ($isWaiting) {
                    // sleep(10);
                    $html = $this->getWeb($strURL, true, $array_data_post);
                    $domElements = str_get_html($html);
                    $array_data_post = $this->getUrl($domElements);
                    $isWaiting = $this->isWaiting($domElements);
                    $count ++;
                    if ($count == $maxWaitingLoop)
                        break;
                }
                break;
            }
        }

        // $flagComplete = true;
        // while ($flagComplete) {
        // $lstURLCW = array();
        // $lstURL = array();
        // $lsCustomer = array();
        // $lsCustomerCancel = array();
        // foreach ($lstTotalChildPag as $key => $page) {
        // if (is_numeric($page["Term"])) {
        // $flag = false;
        // if (strpos($page["IVR"], "CF") !== false) {
        // foreach ($lstURLCW as $url) {
        // if (isset($lstURLCancel[$key]) and $url == $lstURLCancel[$key]) {
        // $flag = true;
        // break;
        // }
        // }
        //
        // if (!$flag and isset($lstURLCancel[$key]) and isset($lstURLCustomer[$key])) {
        // $lstURLCW[] = $lstURLCancel[$key] . "$$$" . $lstURLCustomer[$key];
        // }
        // } else {
        // foreach ($lstURL as $url) {
        // if (isset($lstURLCancel[$key]) and $url == $lstURLCancel[$key]) {
        // $flag = true;
        // break;
        // }
        // }
        //
        // if (!$flag and isset($lstURLCancel[$key]) and isset($lstURLCustomer[$key])) {
        // $lstURL[] = $lstURLCancel[$key] . "$$$" . $lstURLCustomer[$key];
        // }
        // }
        // }
        // }
        // /*Lay khach CanCel late*/
        // foreach ($lstURLCW as $url) {
        // $arrUrl = explode("$$$", $url);
        // if ($this->checkCancelCustomer($arrUrl[0], $invoiceDTO, $location)) {
        // // if (count($arrUrl) >= 4) {
        // $lsCustomerCancel[] = $this->getCustomersFromLink($arrUrl, 0, $invoiceDTO, $location); // tuan change
        // // }
        // }
        // }
        // /*Lay so khach di tour*/
        // foreach ($lstURL as $url) {
        // $arrUrl = explode("$$$", $url);
        // // if (count($arrUrl) >= 4) {
        // $lsCustomer[] = $this->getCustomersFromLink($arrUrl, 1, $invoiceDTO, $location); // tuan change
        // // }
        // }
        //
        // if (count($lsCustomerCancel) > 0) {
        // $noPaxCancel = 0;
        // foreach ($lsCustomerCancel as $cusCancel) {
        // foreach ($cusCancel as $cus){
        // if (false === $this->isExitsCustomer($lsCustomer, $cus)) {
        // $lsCustomer[] = $cusCancel;
        // $noPaxCancel++;
        // }
        // }
        // }
        //
        // if ($noPaxCancel <> 0) {
        // // if (!empty($invoiceDTO["CommentCustomer"])) {
        // // if ($invoiceDTO["CommentCustomer"] != "NoCharge") {
        // $arrDate = explode("-", $invoiceDTO["CommentCustomer"]);
        // $invoiceDTO["CommentCustomer"] = $noPaxCancel . " Pax " . reset($arrDate) . " for late CXL";
        // // }
        // // }
        // } else {
        // $invoiceDTO["CommentCustomer"] = "";
        // }
        // $invoiceDTO["Customer"] = $lsCustomer;
        // } else {
        // if (count($lsCustomer) > 0) {
        // $invoiceDTO["Customer"] = $lsCustomer;
        // }
        // }
        //
        // $flagComplete = false;
        // }
        return $invoiceDTO;
    }

    private function checkCancelCustomer($strCancelLink, $invoiceDTO, $location)
    {
        $strURL = "";
        $htmlTablesElements = "";
        $htmlTrInElementTable = "";

        $strURL = "http://" . $this->config->item("challenge_host");
        $strURL .= '/' . $this->convertUrl($strCancelLink);

        log_message('INFO', '[Invoice] Prepare to connection 1st time to Challenge in checkCancelCustomer');
        $this->currentFile = 'checkCancelCustomer' . md5($strURL) . '.html';

        $html = $this->getWeb($strURL);

        $htmlTablesElements = $this->getTagFullFromHtml($html, "<TABLE", "</TABLE>");

        $table_hotel = $htmlTablesElements[0];
        $tr_hotel = $this->getTagFullFromHtml($table_hotel, "<TR>", "</TR>");
        $eleIndex = 0;
        $flag = false;
        foreach ($tr_hotel as $value) {
            $td_hotel = $this->getTagFullFromHtml($value, "<TD>", "</TD>");
            foreach ($td_hotel as $td) {
                $innerText = trim(preg_replace("/<[^>]*>/", "", $td));
                $innerText = str_replace("\n", "", $innerText);
                $innerText = trim($innerText);
                if ($eleIndex == 16 && $innerText == "CW") {
                    $flag = true;
                    break;
                }
                $eleIndex ++;
            }
        }
        if ($flag) {
            return false;
        } else {
            return true;
        }
        // if (count($htmlTablesElements) == 2) {
        // $htmlTableTarget = end($htmlTablesElements);
        // $flag = true;
        //
        // if (!empty($htmlTableTarget)) {
        // $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
        //
        // $element = $htmlTrInElementTable[1];
        //
        // $htmlTdInTr = $this->getTagFullFromHtml($element, "<TD>", "</TD>");
        //
        // $eleIndex = 0;
        // $strCode = "";
        // $strComment = "";
        //
        // foreach ($htmlTdInTr as $ele) {
        // $innerText = preg_replace("/<[^>]*>/", "", $ele);
        // if ($eleIndex == 1) {
        // $strComment = $this->chargeConditionTourCancel($innerText, $invoiceDTO["StartDate"], $location);
        // if ($strComment != "NoCharge") {
        // $invoiceDTO["CommentCustomer"] = $strComment;
        // return true;
        // } else {
        // if (isset($invoiceDTO["CommentCustomer"]) and $invoiceDTO["CommentCustomer"] == "NoCharge") {
        // $invoiceDTO["CommentCustomer"] = "";
        // return false;
        // }
        // }
        // }
        // $eleIndex++;
        // }
        // }
        // }
    }

    private function chargeConditionTourCancel($dateChanlenge, $dateArrive, $location)
    {
        $dateC = date_create($dateChanlenge);
        $dateA = date_create($dateArrive);

        $nDay = abs(date_diff($dateC, $dateA)->format("%a"));
        $result = "NoCharge";
        if ($nDay > 21) {
            $result = "NoCharge";
        } else {
            if ($location == "OP") {
                if ($nDay <= 4) {
                    $result = "NoCharge" . $dateChanlenge;
                } elseif ($nDay <= 10 && $nDay > 4) {
                    $result = "Chagre 1 Nite - Date CXL " . date("d/m/y", strtotime($dateChanlenge));
                }
            } elseif ($nDay <= 14) {
                $result = "Date CXL " . date("d/m/y", strtotime($dateChanlenge));
            } else {
                $result = "NoCharge";
            }
        }
        return $result;
    }

    private function getDateRequestInChanlenge($url)
    {
        $strDateRequest = "";
        $html = $this->getWeb($url);
        $htmlTablesElements = $this->getTagFullFromHtml($html, "<TABLE", "</TABLE>");
        if (count($htmlTablesElements) == 2) {
            $htmlTableTarget = end($htmlTablesElements);
            $flag = false;

            if (! empty($htmlTableTarget)) {
                $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
                $flag = false;

                foreach ($htmlTrInElementTable as $element) {
                    $ele = "";
                    $strCode = "";
                    $htmlTdInTr = $this->getTagFullFromHtml($element, "<TD>", "</TD>");

                    $eleIndex = 0;
                    foreach ($htmlTdInTr as $ele) {
                        $innerText = preg_replace("/<[^>]*>/", "", $ele);

                        if ($eleIndex == 1) {
                            $strDateRequest = $innerText;
                        }

                        if ($eleIndex == 11 and strpos($innerText, "RQ") !== false) {
                            $flag = true;
                        }

                        $eleIndex ++;
                    }
                }
            }
        }

        return $strDateRequest;
    }

    private function checkBeachHotelCancel($invoiceDTO)
    {
        foreach ($invoiceDTO as $inv) {
            if (false !== strpos($this->messages["content"][$this->messages["keys"]["INFO_BEACH_HOTEL"][0]], $inv["City"])) {
                $invoiceDTO["TypeCharge"] = "CXL > 21 Day Beach Hotel. Check in Chanlenge again.";
                break;
            }
        }
        return $invoiceDTO;
    }

    private function getCustomersFromLink($arrURL, $flag, $invoiceDTO, $location)
    {
        $strUrl = "";
        $strURLCustomer = "";
        $htmlTablesElements = "";
        $flagComplete = true;
        $lstCustomer = array();
        $strURLCustomer = $arrURL[1];

        $i = 1;
        while ($flagComplete) {
            $strUrl = $strURL = "http://" . $this->config->item("challenge_host");
            $strUrl .= "/" . $strURLCustomer;
            $i ++;

            log_message('INFO', '[Invoice] Prepare to connection ' . $i . '(th) time to Challenge in getCustomersFromLink');
            $this->currentFile = 'getCustomersFromLink' . md5($strUrl) . '.html';
            $html = $this->getWeb($strUrl);

            $htmlTrInElementTable = $this->getTagFullFromHtml($html, "<TABLE", "</TABLE>");

            $htmlTableTarget = "";
            if (count($htmlTrInElementTable) > 0) {
                $htmlTableTarget = reset($htmlTrInElementTable);
            }

            $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
            if (count($htmlTrInElementTable) > 0) {
                foreach ($htmlTrInElementTable as $key => $value) {
                    $customer = array();
                    $customerChange = array();
                    $htmlTdInTr = $this->getTagFullFromHtml($value, "<TD>", "</TD>");
                    $eleIndex = 0;

                    if (count($htmlTdInTr) > 0) {
                        foreach ($htmlTdInTr as $ele) {
                            $innerText = preg_replace("/<[^>]*>/", "", $ele);
                            if ($eleIndex == 0) {
                                $customer["ID"] = trim($innerText);
                            } elseif ($eleIndex == 1) {
                                $customer["Name"] = trim($innerText);
                            } elseif ($eleIndex == 2) {
                                if (! empty($innerText)) {
                                    $customerChange["Name"] = $innerText;
                                    $customerChange["ID"] = $customer["ID"];
                                }
                            } elseif ($eleIndex == 3) {
                                $customer["Age"] = trim($innerText);
                            } elseif ($eleIndex == 4) {
                                $customer["Type"] = trim($innerText);
                            }

                            $eleIndex ++;
                        }
                    }

                    if ($this->isExitsCustomer($lstCustomer, $customer) === false and ! empty($customer)) {
                        $lstCustomer[] = $customer;
                    }

                    if (! empty($customerChange)) {
                        if ($flag == 1 and $this->checkGuestChangeName($arrURL[0], $invoiceDTO, $location)) {
                            $customerChange["Age"] = $customer["Age"];
                            $customerChange["Type"] = $customer["Type"];
                            $invoiceDTO["CommentCustomer"] = " Guest Change Name late";
                            $lstCustomer[] = $customerChange;
                            $customerChange = array();
                        }
                    }
                }
            }

            $flagComplete = false;
        }
        return $lstCustomer;
    }

    private function isExitsHotel($lstInvoiceHotelDTO, $invoiceHotelDTO)
    {
        $strID = "";
        $i = 0;
        $result = array();
        if (! empty($invoiceHotelDTO)) {
            $strID = $invoiceHotelDTO["HotelCode"];

            if (count($lstInvoiceHotelDTO) > 0) {
                foreach ($lstInvoiceHotelDTO as $key => $invHotel) {
                    if ($invHotel["HotelCode"] == $strID) {
                        if ($invHotel["NoNight"] < $invoiceHotelDTO["NoNight"] && is_numeric($invoiceHotelDTO["NoNight"])) {
                            $lstInvoiceHotelDTO[$key]["HotelComment"] = ($invoiceHotelDTO["NoNight"] - $invHotel["NoNight"]) . " Nite CXL";
                            $lstInvoiceHotelDTO[$key]["NoNight"] = $invoiceHotelDTO["NoNight"];
                        }
                        $result['content'] = $lstInvoiceHotelDTO;
                        $result['result'] = true;
                        return $result;
                    }
                }
            }
        }
        $result['content'] = '';
        $result['result'] = false;
        return $result;
    }

    private function checkGuestChangeName($strCancelLink, $invoiceDTO, $location)
    {
        $strURL = "";
        $htmlTablesElements = "";
        $htmlTrInElementTable = "";

        $strURL = "http://" . $this->config->item("challenge_host");
        $strURL .= $this->convertUrl($strCancelLink);

        log_message('INFO', '[Invoice] Prepare to connection 1st time to Challenge in checkGuestChangeName');
        $this->currentFile = 'checkGuestChangeName' . md5($strURL) . '.html';

        $html = $this->getWeb($strURL);

        $htmlTablesElements = $this->getTagFullFromHtml($html, "<TABLE", "</TABLE>");

        if (count($htmlTablesElements) == 2) {
            $htmlTableTarget = end($htmlTablesElements);
            $flag = true;

            if (! empty($htmlTableTarget)) {
                $htmlTrInElementTable = $this->getTagFullFromHtml($htmlTableTarget, "<TR>", "</TR>");
                $strDate = "";

                foreach ($htmlTrInElementTable as $element) {
                    $htmlTdInTr = $this->getTagFullFromHtml($html, "<TD", "</TD>");
                    $eleIndex = 0;

                    foreach ($htmlTdInTr as $ele) {
                        $innerText = preg_replace("/<[^>]*>/", "", $ele);

                        if ($eleIndex == 1) {
                            $strDate = $innerText;
                        }

                        if ($eleIndex == 11) {
                            if (strpos($innerText, "NC") and ! empty($strDate)) {
                                if ($this->checkConditionGuestChangeName($strDate, $invoiceDTO, $location)) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        }

                        $eleIndex ++;
                    }
                }
            }
        }
        // Nghi edit 20160427
        return false;
    }

    private function checkConditionGuestChangeName($dateChanlenge, $dateArrive, $location)
    {
        $dateC = date_create($dateChanlenge);
        $dateA = date_create($dateArrive);

        $nDay = abs(date_diff($dateC, $dateA)->format("%a"));

        if ($location == "OP") {
            if ($nDay <= 2) {
                return true;
            }
        } elseif ($nDay <= 14) {
            return true;
        }

        return false;
    }

    private function isExitsCustomer($lstCustomer, $customer)
    {
        if (! empty($customer) and count($lstCustomer) > 0) {
            if (in_array($customer["ID"], $lstCustomer)) {
                return true;
            }
        }

        return false;
    }

    private function getTableTargetBasedOnHtmlElementCollection($tables)
    {
        foreach ($tables as $table) {
            $isMatch = true;
            foreach ($this->childPageHeader as $title) {
                if (false === strpos(strtoupper($table), strtoupper($title))) {
                    $isMatch = false;
                    break;
                }
            }

            if ($isMatch) {
                return $table;
            }
        }

        // 20160427 check again!
        return false;
    }

    private function createInvoiceDTOObj()
    {
        $obj = array(
            "mHisCode" => "",
            "mToKyoCode" => "",
            "mCode" => "",
            "mStartDate" => "",
            "mGuestName" => "",
            "mNoPax" => 0,
            "mHotel" => "",
            "mCustomer" => "",
            "mHTL_NT" => 0,
            "mHTL_Price" => 0,
            "mLateCheckOut" => "",
            "mHTL_Total" => 0,
            "mTransferPax" => 0,
            "mTransfer" => 0,
            "mOP_Course" => "",
            "mOP_Pax" => 0,
            "mOP" => 0,
            "mPackagePax" => 0,
            "mPricePackagePax" => 0,
            "mStyle" => 0,
            "mTotal" => 0,
            "mTypeCharge" => "",
            "mStatus" => "",
            "mOptionTour" => "",
            "mTourTariff" => "",
            "mDateRequest" => "",
            "mCommentDateRequest" => "",
            "mCommentCustomer" => "",
            "mLC" => ""
        );
        $hotel = array();
        if ($obj["mHotel"] != "") {
            $hotel[] = $obj["mHotel"];
        }
        $obj["Hotel"] = $hotel;

        $typecharge = array();
        if ($obj["mTypeCharge"] != "") {
            $typecharge[] = $obj["mTypeCharge"];
        }
        $obj["TypeCharge"] = $typecharge;

        $OptionTour = array();
        if ($obj["mOptionTour"] != "") {
            $OptionTour[] = $obj["mOptionTour"];
        }
        $obj["OptionTour"] = $OptionTour;
        return $obj;
    }

    private function getWeb($strUrl, $isPost = false, $data = "", $time = null)
    {
        // if(file_exists('application/logs/invoice_web/' . $this->currentFile)){
        // $html = file_get_contents('application/logs/invoice_web/' . $this->currentFile);
        // return $html;
        // }
        // Delay
        // $startDelay = microtime(true);
        // while ($this->NoCurrentConnection > 150) { //maximum 150 connection
        // $current = microtime(true);
        // if ($current - $startDelay > 30) {//delay in 30 second
        // log_message('error', '[Invoice] Connection to ' . $strUrl . ' is denied. Number of connection is ' . $this->NoCurrentConnection);
        // return '';
        // }
        // }
        // Nghi added - 20160423
        $this->NoCurrentConnection += 1;
        $strUser = $this->config->item('challenge_user');
        $strPass = $this->config->item('challenge_passwd');
        $header = array(
            'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0',
            'Accept-Charset:=UTF-8, *;q=0',
            'Authorization: Basic ' . base64_encode("{$strUser}:{$strPass}")
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_COOKIE, "applweb.center.his=R2712831102");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($isPost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        // set timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        // curl_setopt($ch , CURLOPT_TIMEOUT_MS , 1000);
        $this->connectCouter += 1;
        log_message('INFO', '[Invoice] Connection No. ' . $this->connectCouter . ' => Start connect to' . $strUrl);
        $htmlDoc = curl_exec($ch);
        curl_close($ch);
        log_message('INFO', '[Invoice] Connection No. ' . $this->connectCouter . ' => End connect to' . $strUrl);
        $this->NoCurrentConnection -= 1;

        return $htmlDoc;
    }

    /* end update */
    private function parseDataFromWbTemp($html)
    {
        $notuseKeys = array(
            2,
            6,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            20,
            39,
            31
        );
        $keys = array(
            "No",
            "Ch",
            "RQ",
            "RQ_IVR",
            "IVR",
            "AGT",
            "Com",
            "Resv_No",
            "CLS",
            "City",
            "AGT1",
            "Date",
            "ETD",
            "ETA",
            "Term",
            "H_Person",
            "PAX",
            "E",
            "M",
            "R",
            "A",
            "FLT_No",
            "B",
            "L",
            "M1",
            "D",
            "Conf_Ref",
            "Ptr",
            "CustomerURL",
            "hotelUrl"
        );

        preg_match_all('/h\(.*\);/i', $html, $matches);
        foreach ($matches[0] as $key => $value) {
            $substr = substr($value, strpos($value, ",") + 2);
            $substr = str_replace('&nbsp;', '', str_replace("<>", "", $substr));
            $splited = explode("&&", $substr);
            $hotelUrl = preg_match('/href=\\\\?["|\'](..\/)?([^"\'\\\\]*)\\\\?["|\']/i', $splited[5], $url) ? $url[2] : '';
            if (! empty($hotelUrl)) {
                $hotelUrl = explode("&", $hotelUrl);
                if (strlen($hotelUrl[2]) == 11) {
                    $hotelUrl[2] .= "0";
                }
                $strurl = "";
                foreach ($hotelUrl as $row) {
                    $strurl .= $row . "&";
                }
                $strurl = subStr($strurl, 0, strrpos($strurl, "&"));
                $hotelUrl = $strurl;
            }

            $customUrl = preg_match('/href=\\\\?["|\'](..\/)?([^"\'\\\\]*)\\\\?["|\']/i', $splited[25], $url) ? $url[2] : '';
            foreach ($splited as $i => $v) {
                $splited[$i] = trim(preg_replace('/ *<[^>]*>?/', '', $v));
            }

            $splited[1] = preg_replace("/<BR>/i", "", $splited[1]);

            $splited[16] = str_replace("&nbsp;", "", $splited[16]);
            $splited = array_diff_key($splited, array_flip(($notuseKeys)));

            $splited[] = empty($customUrl) ? '' : $customUrl;
            $splited[] = empty($hotelUrl) ? '' : $hotelUrl;
            $matches[0][$key] = array_combine($keys, $splited);
        }
        return $matches[0];
    }

    private function dataParse($str)
    {
        preg_match_all('/<\w+.*(type="[^"]+".*)?name="[^"]+"(type="[^"]+".*)?/', $str, $matchs);
        $inputs = array_map(function ($a) {
            $type = preg_replace("/<(\w+) .*/", "$1", $a);
            $typ = preg_replace('/.*type="([^"]+)".*/', "$1", $a);
            $name = preg_replace('/.*name="([^"]+)".*/', "$1", $a);
            return array(
                "name" => $name,
                "type" => $type,
                "classify" => $typ
            );
        }, $matchs[0]);

        $post["body:CXLDsp"] = $this->getInputValue($str, "body:CXLDsp");
        $post["body:CXLDsp"] = str_replace(" ", "+", $post["body:CXLDsp"]);
        foreach ($inputs as $inp) {
            switch (strtolower($inp["type"])) {
                case 'input':
                    switch (strtolower($inp["classify"])) {
                        case 'submit':
                        case 'button':
                            break;
                        case 'radio':
                            if (! isset($post[$inp['name']]) or empty($post[$inp['name']]))
                                $post[$inp['name']] = $this->getRadioValue($str, $inp['name']);
                            break;
                        case 'checkbox':
                            $value = $this->getRadioValue($str, $inp['name']);
                            if (! empty($value)) {
                                $post[$inp['name']] = $value;
                            }
                            break;
                        default:
                            $post[$inp['name']] = $this->getInputValue($str, $inp['name']);
                            break;
                    }
                    break;
                case 'select':
                    $post[$inp['name']] = $this->getSelectboxValue($str, $inp['name']);
                    break;
                case 'textarea':
                    $post[$inp['name']] = $this->getTextAreaValue($str, $inp['name']);
                    break;

                default:
                    break;
            }
        }
        $data = "";
        $connecter = "";
        foreach ($post as $key => $value) {
            $data .= "$connecter$key=$value";
            $connecter = "&";
        }

        return $data;
    }

    public function delete_surcharge()
    {
        $surcharge_id = $this->input->post('id');
        $result = $this->Invoice->delete_surcharge($surcharge_id);
        echo $result;
    }

    public function save_surcharge()
    {
        $surcharge_id = $this->input->post('id');
        $data['FromDate'] = $this->input->post('FromDate');
        $data['ToDate'] = $this->input->post('ToDate');
        $data['Price'] = $this->input->post('Price');
        $data['Description'] = $this->input->post('Description');
        $result = $this->Invoice->save_surcharge($surcharge_id, $data);
        echo $result;
    }

    public function insert_surcharge()
    {
        $data['FromDate'] = $this->input->post('FromDate');
        $data['ToDate'] = $this->input->post('ToDate');
        $data['Price'] = $this->input->post('Price');
        $data['Description'] = $this->input->post('Description');
        $result = $this->Invoice->insert_surcharge($data);
        echo $result;
    }

    private function getInputValue($html, $inputId)
    {
        $text = preg_match("/<.*name=\"$inputId\".*\/>/", $html, $matchs) ? $matchs[0] : false;
        if ($text) {
            $text = preg_replace('/.*value="([^"]*)".*/', "$1", $text);
        } else {
            $text = "";
        }

        return $text;
    }

    private function getSelectboxValue($html, $selectId)
    {
        $subStr = substr($html, strpos($html, "name=\"$selectId"));
        $subStr = substr($subStr, 0, strpos($subStr, "</SELECT>"));
        $subStr = preg_match("/<.*selected.*>/", $subStr, $matchs) ? $matchs[0] : "";

        return preg_replace('/.*value="([^"]*)".*/', "$1", $subStr);
    }

    private function getRadioValue($html, $inputId)
    {
        $sub = preg_match("/<input.*name=\"$inputId\".*checked.*>/i", $html, $matchs) ? $matchs[0] : "";
        return preg_replace('/.*value="([^"]+)".*/', "$1", $sub);
    }

    private function getTextAreaValue($html, $inputId)
    {
        $sub = preg_match("/<textarea.*$inputId.*>.*<\/textarea>/i", $html, $matchs) ? $matchs[0] : "";
        return preg_replace('/.*>([^<]*)<.*/', "$1", $sub);
    }

    private function getFormUrl($html)
    {
        $sub = preg_match('/<FORM.*action.*/i', $html, $matchs) ? $matchs[0] : "";
        $url = preg_replace('/.*FORM.*action="([^"]*)".*/i', "$1", $sub);
        return str_replace("..", "", $url);
    }

    private function loadMessage()
    {
        $parser = xml_parser_create();
        xml_parse_into_struct($parser, file_get_contents("msg.xml"), $messages, $keys);
        $this->messages = array(
            "content" => $messages,
            "keys" => $keys
        );
    }

    private function removeSymbol($str)
    {
        $str = str_replace("\r", "", $str);
        return str_replace("\n", "", $str);
    }

    private function convertUrl($strURLHotel)
    {
        if (strpos($strURLHotel, 'href') === false) {
            return $strURLHotel;
        }
        $strURL = "";
        $plit = explode("\"\"", $strURLHotel);
        for ($i = 1; $i < count($plit); $i ++) {
            if (strpos($plit[$i - 1], "href=") !== false) {
                $strURL = $plit[$i];
            }
        }
        $strURL = str_replace("../", "/", $strURL);
        $strURL = str_replace("&amp;", "&", $strURL);
        return $strURL;
    }

    // Get tag full, such as: <table> ... </table>, <option> ... </option>
    private function getTagFullFromHtml($html, $tagStart, $tagEnd)
    {
        $result = array();

        do {
            $end = strpos($html, $tagEnd) + strlen($tagEnd);
            $start = strpos($html, $tagStart);

            if ($end === false or $start === false) {
                break;
            }
            $value = substr($html, $start, $end - $start);

            $html = substr($html, $end);

            if (! empty($value)) {
                $result[] = $value;
            }
        } while (! empty($value));

        return $result;
    }

    public function getSurcharge()
    {
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $dt = $this->Invoice->getSurcharge($date_from, $date_to);
        if (count($dt) > 0) {
            $flagSurchage = true;
            $this->priceSurcharge = $dt[0]["Price"];
        } else {
            $flagSurchage = false;
        }
        $result["msg"] = $flagSurchage;
        echo json_encode($result);
    }

    public function export_invoice($data_export)
    {
        // $location = $data_export['location_code'];
        // $date_from = $data_export['date_from'];
        // $date_to = $data_export['date_to'];
        // $startDate = str_replace('-', '/', $date_from);
        // $startTo = str_replace('-', '/', $date_to);
        $location = $data_export['location'];
        $date_from = $data_export['from'];
        $date_to = $data_export['to'];
        $startDate = str_replace('-', '/', $date_from);
        $startTo = str_replace('-', '/', $date_to);
        $list_check = $data_export["listcheck"];
        $result = array();
        $whereParams = array(
            'TourInfo.Location_Code = ' => $location,
            'TourInfo.ArrvDate >= ' => $startDate,
            'TourInfo.ArrvDate <= ' => $startTo,
            'BOOKING.ArrvDate1 >= ' => $startDate,
            'BOOKING.ArrvDate1 <= ' => $startTo
        );
        if ($location != 'OP' and $location != 'TP' and $location != 'NP' and $location != 'KP') {
            $whereParams['TourStatus <> '] = 'CXL';
        }

        $tableRow = $this->Invoice->get_data($whereParams);

        if (count($tableRow) > 0) {
            $list_invoice = $this->start($location, $tableRow, $list_check);
            $result["tours"] = $tableRow;
            if (count($list_invoice) > 0) {
                $result["option_tour"] = $list_invoice[0]["OptionalTour"];
            }
        }
        $filename = "";
        $priceSurcharge = $this->Invoice->getSurcharge($date_from, $date_to);
        if (count($priceSurcharge) > 0) {
            if ($location == "TP") {
                $filename = "InvoiceReportTokyoSurcharge.xlsx";
            } elseif ($location == "OP" || $location == "NP" || $location == "KP") {
                $filename = "InvoiceReportSurcharge.xlsx";
            } else {
                $filename = "InvoiceReportOverSea.xlsx";
            }
        } else {
            if ($location == "TP") {
                $filename = "InvoiceReportTokyo.xlsx";
            } elseif ($location == "OP" || $location == "NP" || $location == "KP") {
                $filename = "InvoiceReport.xlsx";
            } else {
                $filename = "InvoiceReportOverSea.xlsx";
            }
        }
        $result["flag"] = $this->Invoice->print_invoice($date_from, $date_to, $location, $filename, $list_invoice);
        return $result;
    }

    /**
     * Function: getDateRequestCXL
     *
     * @access private
     */
    private function getDateRequestCXL($lstTotalChildPag, $lstURLHotel)
    {
        $strURL = '';

        foreach ($lstURLHotel as $key => $url) {
            $strURL = "http://" . $this->config->item("challenge_host");
            if (isset($lstTotalChildPag[$key]) and trim($lstTotalChildPag[$key]["CLS"]) == "" and false !== strpos("CF", $lstTotalChildPag[$key]["IVR"])) {

                $start = strpos($lstTotalChildPag[$key]["Resv_No"], "(") + 1;
                $number = strpos($lstTotalChildPag[$key]["Resv_No"], ")") - $start - 1;
                $strMainCode = substr($lstTotalChildPag[$key]["Resv_No"], $start, $number);
                if (strpos($this->strTourTariff, $strMainCode) !== false) {
                    $strURL .= '/' . $this->convertUrl($url);

                    $date = $this->getDateRequestInChanlenge($strURL);
                    $this->connection ++;
                    return date("d/m/Y", strtotime($date));
                }
            } elseif (is_numeric(trim($lstTotalChildPag[$key]["Term"]))) {
                $strURL .= '/' . $this->convertUrl($url);
            }
        }

        $date = $this->getDateRequestInChanlenge($strURL);
        $this->connection ++;
        return date("d/m/Y", strtotime($date));
    }
}
