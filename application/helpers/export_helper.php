<?php

/**
 * This file contain functions export to excel file.
 * 
 * Class name: Export
 *
 * @author Creator: Ho Quoc Nghi
 * @author Updater: Ho Quoc Nghi
 * 
 * File location: application/helpers/export_helper.php
 */
class Export
{

    // Constant
    const EXCEL_INVOICE = "InvoiceReport.xls";

    const EXCEL_INVOICE_TOKYO = "InvoiceReportTokyo.xls";

    const EXCEL_INVOICE_OVERSEA = "InvoiceReportOverSea.xls";

    const EXCEL_INVOICE_SURCHANGE = "InvoiceReportSurcharge.xls";

    const EXCEL_INVOICE_TOKYO_SURCHANGE = "InvoiceReportTokyoSurcharge.xls";

    const EXCEL_TRANSFER_IN = "Transfer_In.xls";

    /**
     * CI instance, to load PHP excel library
     *
     * @var object
     * @access private
     */
    private static $ci;

    /**
     * Excel object
     *
     * @var object
     * @access private
     */
    private static $objPHPExcel;

    /**
     * Excel output file type
     *
     * Potential values: "Excel5", "Excel2007"
     * Default value is "Excel5"
     *
     * @var string
     * @access private
     */
    private static $excelExtension = "Excel5";

    /**
     * Function name: __construct
     * Construct function
     *
     * @access private
     */
    private function __construct()
    {
        if (is_null(self::$ci)) {
            self::$ci = & get_instance();
        }

        self::$ci->load->library('Excel');
    }

    /**
     * Function name: _init
     * Initialize excel object
     *
     * @param string $p_fileName
     *            name of sample file
     * @return null
     * @access private
     * @static
     */
    private static function _init($p_fileName)
    {
        new self();

        $objReader = PHPExcel_IOFactory::createReader(self::$excelExtension);
        self::$objPHPExcel = $objReader->load($p_fileName);
    }

    /**
     * Function name: _output
     * Send excel ouput to browser
     *
     * @param string $p_fileName
     *            name of ouput file
     * @return null
     * @access private
     * @static
     */
    private static function _output($p_fileName)
    {
        $objWriter = PHPExcel_IOFactory::createWriter(self::$objPHPExcel, self::$excelExtension);
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $p_fileName . '"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        header("Content-Transfer-Encoding: binary ");
        $objWriter->save('php://output');
    }

    /**
     * Function name: exportInvoice
     * Export to excel file of invoice
     *
     * @param string $p_location
     *            location keyword
     * @param boolean $p_flagSurchange
     *            surchange status
     *            
     * return output the file to download
     * @access public
     * @static
     */
    public static function exportInvoice($p_location, $p_flagSurchange)
    {
        $fileName = false;
        if ($p_flagSurchange) {
            switch ($p_location) {
                case 'TP':
                    $fileName = self::EXCEL_INVOICE_TOKYO;
                    break;

                case 'OP':
                case 'NP':
                case 'KP':
                    $fileName = self::EXCEL_INVOICE;
                    break;

                default:
                    $fileName = self::EXCEL_INVOICE_OVERSEA;
                    break;
            }
        } else {
            switch ($p_location) {
                case 'TP':
                    $fileName = self::EXCEL_INVOICE_TOKYO_SURCHANGE;
                    break;

                case 'OP':
                case 'NP':
                case 'KP':
                    $fileName = self::EXCEL_INVOICE_SURCHANGE;
                    break;

                default:
                    $fileName = self::EXCEL_INVOICE_OVERSEA;
                    break;
            }
        }

        $worksheetName = "1"; // TODO
    }

    /**
     * Function name: exportInTransfer
     * Export intransfer information to excel file
     *
     * @param array $p_intransfer
     *
     * @return excel file to download
     * @access public
     * @static
     */
    /**
     * Function name: allotment_report()
     * build : Tuan 02/11/2015
     */
    public static function print_allotment_report()
    {
        self::$ci->load->model('HotelBookingModel');
        $data_print_allotment = self::$ci->session->data_allotment("searchallotment");
        if ($data_print_allotment['city'] == "")
            self::$ci->session->set_error_printalloment('errorprintcity', "Please choose City");
        else if ($data_print_allotment['hotel'] == "")
            self::$ci->session->set_error_printalloment('errorprinthotel', "Please choose Hotel");
        else if ($data_print_allotment['room_class'] == "")
            self::$ci->session->set_error_printalloment('errorprintroom', "Please choose Room Class");
        if (self::$ci->HotelBookingModel->search_allotment_report($data_print_allotment))
            self::$ci->session->set_error_printalloment('errorprintall', "The choosen hotel doesn't have allotment. Please try again");
        $dtb = self::$ci->HotelBookingModel->get_allotment_print($data_print_allotment);

        $AllotmentId = array();
        $FromDate = array();
        $ToDate = array();
        $RoomDay = array();
        $i = 0;
        foreach ($dtb as $item) {
            $AllotmentId[$i] = $item['AllotmentId'];
            $FromDate[$i] = date_format(date_create($item['FromDate']), "Y/m/d");
            $ToDate[$i] = date_format(date_create($item['ToDate']), "Y/m/d");
            $RoomDay[$i] = $item['RoomDay'];
        }
        try {
            $currentRow;
            $currentCol;
            $rng;
            self::$objPHPExcel->getActiveSheet()
                ->getStyle("A1")
                ->getFont()
                ->setSize(16)
                ->setBold(true)
                ->setValue("BANG KIEM TRA ALLOTMENT HOTEL " . $data_print_allotment['hotel']);

            self::$objPHPExcel->getActiveSheet()
                ->getStyle("L3")
                ->getFont()
                ->setSize(20)
                ->setBold(true)
                ->setValue($data_print_allotment['date_from'] . ' - ' . $data_print_allotment['date_to']);
            $currentRow = 4;
            $currentCol = 1;
            if (count($dtb) > 1) {
                for ($j = 0; count($dtb) - 2; $j ++) {
                    $currentRow += 4 + $RoomDay[$j];
                    $rng = self::$objPHPExcel->getActiveSheet()->rangeToArray('A4:B7', null, true, true, false);
                    self::$objPHPExcel->getActiveSheet()->setCellValue($currentRow . "A", $rng); // fromArray($source = null, $nullValue = null, $startCell = 'A1', $strictNullComparison = false)
                }
            }

            $currentRow = 6;
            $currentCol = 1;
            for ($j = 0; count($dtb) - 1; $j ++) {
                for ($k = 0; $k <= $RoomDay[$j]; $k ++) {
                    $rng = self::$objPHPExcel->getActiveSheet()->rangeToArray("A" . $currentRow + $k . ':' . "B" . $currentRow + $k, null, true, true, false);
                    self::$objPHPExcel->getActiveSheet()
                        ->setCellValue($currentRow + 1 + $k . "A", $rng)
                        ->setCellValue($currentRow + 1 . "A", "Room " . $k + 1);
                }
                $currentRow += 4 + $RoomDay($j);
            }
            $currentRow = 5;
            $currentCol = 2;
            $DaysArr = array();
            for ($k = 0; $k < count($dtb) - 1; $k ++) {
                $fromday = date_parse($FromDate[$k]); // return $fromday['day']==> day from result
                $frommonth = date_parse($FromDate[$k]); // return $frommonth['month']==> month form result
                $today = date_parse($ToDate[$k]); // return $today['day']==> day to result
                $tomonth = date_parse($ToDate[$k]); // return $today['month']==> month to result
                $days = 0;
                if ($frommonth == $tomonth) {
                    self::$objPHPExcel->getActiveSheet()->setCellValue($currentRow - 1 . "B", $frommonth['month']);
                    for ($j = $fromday['day']; $j <= $today; $j ++) {
                        $rng = self::$objPHPExcel->getActiveSheet()->rangeToArray("A" . $currentRow + $k . ':' . "B" . $currentRow + $k, null, true, true, false);
                        // ngung vi khong co file mau
                    }
                }
            }
        } catch (Exception $ex) {}
    }

    public function GetMinValueOfColumn($data, $columnname)
    {
        self::$ci->load->model('TransferModel');
        if (count($data) == 0)
            return "";
        $min;
        try {
            $i;
            $tmp;
            $min = $data[$columnname]['0'];
            foreach ($data as $item) {
                $tmp = self::$ci->TransferModel->checkdata($item[$columnname]);
                if ($tmp < $min)
                    $min = $tmp;
            }
        } catch (Exception $ex) {
            return "";
        }
    }

    public function print_success()
    {
        $FromArrvDate = "";
        $ToArrvDate = "";
        $data = $this->session->get_bookingsearch("bookingsearch");
        self::$ci->load->model('HotelBookingModel');
        $dtb = self::$ci->HotelBookingModel->get_booking_report($data);
        self::$objPHPExcel->getActiveSheet()
            ->setCellValue("B2", $data['hotel'])
            ->setCellValue("B5", self::$ci->GetMinValueOfColumn($dtb['ArrvDate']))
            ->setCellValue("C5", self::$ci->GetMinValueOfColumn($dtb['ArrvDate']))
            ->setCellValue("B6", self::$ci->GetMinValueOfColumn($dtb['DeptDate']))
            ->setCellValue("C6", self::$ci->GetMinValueOfColumn($dtb['DeptDate']));
        /*
         * $HeadRow1 = 10;
         * $NumRow1 = 10;
         * $curRow1 = 0;
         * $i=0; $j; $k; $NiteNo; $PaxNo;
         * $strTemp;
         * //combobox Room Type thieu du lieu
         * //combobox Room Class thieu du lieu
         *
         */
        $HeadRow = 36;
        $NumRow = 36;
        $curRow = 0;
        $roomtype1;
        $roomclass1;
        $s1;
    }

    public function success_Report($data)
    {
        $data = $this->session->get_bookingsearch("bookingsearch");
        if (count($data)) {}
    }

    public static function exportInTransfer($p_intransfer)
    {
        self::_init(self::EXCEL_TRANSFER_IN);

        // load models
        self::$ci->load->model('GuestModel');
        self::$ci->load->model("OptionalTourModel");
        self::$objPHPExcel->getActiveSheet()
            ->setCellValue("F4", $p_intransfer["DateIn"])
            ->setCellValue("F5", $p_intransfer["TBLCodeIn"])
            ->setCellValue("F6", $p_intransfer["GuideName"])
            ->setCellValue("F7", $p_intransfer["GuideTel"])
            ->setCellValue("F8", $p_intransfer["DriverName"])
            ->setCellValue("F9", $p_intransfer["DriverTel"])
            ->setCellValue("F10", $p_intransfer["CarNo"]);
        self::$objPHPExcel->getActiveSheet()
            ->getStyle("6F")
            ->getFont()
            ->setName('Arial');
        self::$objPHPExcel->getActiveSheet()
            ->getStyle("8F")
            ->getFont()
            ->setName('Arial');

        $startContentRow = 13;
        $i = 0;
        foreach ($p_intransfer['transferDetail'] as $currentRow) {
            $i ++;
            self::$objPHPExcel->getActiveSheet()
                ->setCellValue("A" . ($startContentRow + $i), $currentRow['InFlight'])
                ->setCellValue("B" . ($startContentRow + $i), $currentRow['FromPlace'])
                ->setCellValue("C" . ($startContentRow + $i), $currentRow['TimeIn'])
                ->setCellValue("D" . ($startContentRow + $i), $currentRow['PUIn'])
                ->setCellValue("E" . ($startContentRow + $i), $currentRow['TourCode'])
                ->setCellValue("G" . ($startContentRow + $i), $currentRow['Hotel']);

            if (isset($currentRow["Room_List1"])) {
                if (empty($currentRow["Room_List1"])) {
                    $roomType1 = $currentRow["RoomType1"];
                    $roomNo1 = $currentRow["RoomNo1"];
                    $roomClass1 = $currentRow['RoomClass1'];
                } else {
                    $roomType1 = self::formatStr($currentRow["Room_List1"]);
                    $roomType1 = substr($RoomType1, 0, strpos($RoomType1, "*"));
                    $roomNo1 = " - ";
                    $roomClass1 = $currentRow['Room_List1'];
                }
            } else {
                $RoomNo1 = " - ";
            }

            self::$objPHPExcel->getActiveSheet()
                ->setCellValue("H" . ($startContentRow + $i), $roomType1)
                ->setCellValue("I" . ($startContentRow + $i), $roomClass1)
                ->setCellValue("J" . ($startContentRow + $i), $RoomNo1)
                ->setCellValue("K" . ($startContentRow + $i), $currentRow['PaxNo1'])
                ->setCellValue("L" . ($startContentRow + $i), $currentRow['ArrvDate1'])
                ->setCellValue("M" . ($startContentRow + $i), $currentRow['OutFlight'])
                ->setCellValue("N" . ($startContentRow + $i), $currentRow['ToPlace'])
                ->setCellValue("O" . ($startContentRow + $i), $currentRow['DeptDate1'])
                ->setCellValue("P" . ($startContentRow + $i), $currentRow['TimeOut'])
                ->setCellValue("Q" . ($startContentRow + $i), $currentRow['PUOut']);

            $strNote = (isset($currentRow["NoteTransfer"])) ? $currentRow["NoteTransfer"] : "";
            $strNoteIn = (isset($currentRow["NoteIn"])) ? $currentRow["NoteIn"] : "";

            if (! empty($strNote) and ! empty($strNoteIn)) {
                $strNote .= chr(13) . chr(10) . $strNoteIn;
                self::$objPHPExcel->getActiveSheet()->setCellValue("T" . ($startContentRow + $i), $strNote);
            } else {
                self::$objPHPExcel->getActiveSheet()->setCellValue("T" . ($startContentRow + $i), $strNote . $strNoteIn);
            }

            // get guest
            $guestTable = self::$ci->GuestModel->getGuestByTourIDAndTLTCode($currentRow["TourID"], $currentRow["TLTCode"]);

            $firstGuest = reset($guestTable);
            $optionalTour = array();
            if ($firstGuest) {
                $optionalTour = self::$ci->OptionalTourModel->getByTourCodeAndGuestId($currentRow["TourID"], $firstGuest["GuestID"]);
            }

            foreach ($guestTable as $guest) {
                self::$objPHPExcel->getActiveSheet()->setCellValue("F" . ($startContentRow + $i), $guest["GuestName"]);
            }
        }

        self::_output();
    }

    /**
     * Function name: exportOutTransfer
     * Export out transfer information to excel file
     *
     * @return excel file to download
     * @access public
     * @static
     */
    public static function exportOutTransfer()
    {
        /**
         * TODO
         */
        self::_init();
        self::$ci->load->model('TransferModel');
        self::$ci->load->model('GuestModel');
        self::$ci->load->model("OptionalTourModel");
        $tabcode = self::$ci->session->tbcode("tabcode");
        // inputout search booking database
        $out_tranferdetail = self::$ci->TransferModel->get_data_search_booking_intransfer($tabcode);
        // inputout tranferout database
        $p_outtranfer = self::$ci->TransferModel->get_outtransfer($out_tranferdetail["TBLCodeOut"]); //
        self::$objPHPExcel->getActiveSheet()
            ->setCellValue("F4", $p_outtranfer["DateIN"])
            ->setCellValue("F5", $p_outtranfer["TBLCodeIn"])
            ->setCellValue("F6", $p_outtranfer["GuideName"])
            ->setCellValue("F7", $p_outtranfer["GuideTel"])
            ->setCellValue("F8", $p_outtranfer["DriverName"])
            ->setCellValue("F9", $p_outtranfer["DriverTel"])
            ->setCellValue("F10", $p_outtranfer["CarNo"]);
        self::$objPHPExcel->getActiveSheet()
            ->getStyle("6F")
            ->getFont()
            ->setName('Arial');
        self::$objPHPExcel->getActiveSheet()
            ->getStyle("8F")
            ->getFont()
            ->setName('Arial');

        $startContentRow = 13;
        $i = 0;

        foreach ($out_tranferdetail as $currentRow) {
            $i ++;
            self::$objPHPExcel->getActiveSheet()
                ->setCellValue("A" . ($startContentRow + $i), $currentRow['InFlight'])
                ->setCellValue("B" . ($startContentRow + $i), $currentRow['FromPlace'])
                ->setCellValue("C" . ($startContentRow + $i), $currentRow['TimeIn'])
                ->setCellValue("D" . ($startContentRow + $i), $currentRow['PUIn'])
                ->setCellValue("E" . ($startContentRow + $i), $currentRow['TourCode'])
                ->setCellValue("G" . ($startContentRow + $i), $currentRow['Hotel'])
                ->setCellValue("H" . ($startContentRow + $i), $currentRow['RoomType1'])
                ->setCellValue("I" . ($startContentRow + $i), $currentRow['RoomNo1'])
                ->setCellValue("J" . ($startContentRow + $i), $currentRow['ArrvDate1'])
                ->setCellValue("K" . ($startContentRow + $i), $currentRow['OutFlight'])
                ->setCellValue("L" . ($startContentRow + $i), $currentRow['ToPlace'])
                ->setCellValue("M" . ($startContentRow + $i), $currentRow['TimeOut'])
                ->setCellValue("N" . ($startContentRow + $i), $currentRow['PUOut'])
                ->setCellValue("O" . ($startContentRow + $i), $currentRow['NoteTransfer']);
            // guest name
            $guestTable = self::$ci->GuestModel->getGuestByTourIDAndTLTCode($currentRow["TourID"], $currentRow["TLTCode"]);
            $firstGuest = reset($guestTable);
            $optionalTour = array();
            if ($firstGuest) {
                $optionalTour = self::$ci->OptionalTourModel->getByTourCodeAndGuestId($currentRow["TourID"], $firstGuest["GuestID"]);
            }
            foreach ($guestTable as $guest) {
                self::$objPHPExcel->getActiveSheet()->setCellValue("F" . ($startContentRow + $i), $guest["GuestName"]);
            }
        }
    }

    /**
     * Function name: exportGiudeReport
     * Export guide report information to excel file
     *
     * @return excel file to download
     * @access public
     * @static
     */
    public static function exportGiudeReport()
    {
    /**
     * TODO
     */
    }

    /**
     * Function name: exportCarReport
     * Export car report information to excel file
     *
     * @return excel file to download
     * @access public
     * @static
     */
    // public static function exportCarReport()
    // {
    // /**
    // TODO
    // */
    // self::_init();
    // self::$ci->load->model('TransferModel');
    // $searchdata = self::$ci->session->datasearch("datasearch");

    // if(self::$ci->TransferModel->get_data_search_guide_car($searchdata)=="")
    // {
    // self::$ci->session->set_errordata('error_search',"PLease choose tour to print");
    // }
    // try
    // {
    // // leave date
    // $leavedata=self::$ci->TransferModel->get_data_leave_date($searchdata);
    // //new data add array with oder
    // $k=0;
    // $ArrVnCode=array();
    // $ArrFromDate = array();
    // $ArrOption =array();
    // $ArrNameFlight=array();
    // $ArrFromPlace =array();
    // $ArrTimeOut=array();
    // $ArrHotel =array();
    // $ArrNper =array();
    // $ArrTourID =array();
    // $ArrGuest=array();
    // foreach($leavedata as $item)
    // {
    // $ArrVnCode[$k]=self::$ci->TransferModel->checkdata($item['Vncode']);
    // $ArrFromDate[$k]=self::$ci->TransferModel->checkdata($item['ArrvDate1']);
    // $ArrOption[$k]="TRF OUT";
    // $ArrNameFlight[$k]=self::$ci->TransferModel->checkdata($item['InFlight']);
    // $ArrFromPlace[$k]=self::$ci->TransferModel->checkdata($item['FromPlace'])."SGN/";
    // $ArrTimeOut[$k]=self::$ci->TransferModel->checkdata($item['TimeIn']);
    // $ArrHotel[$k]=self::$ci->TransferModel->checkdata($item['Hotel']);
    // $ArrNper[$k]=self::$ci->TransferModel->checkdata($item['NPer']);
    // $ArrTourID[$k]=self::$ci->TransferModel->checkdata($item['TourID']);
    // $ArrGuest[$k]=self::$ci->TransferModel->checkdata($item['GroupName']);
    // $k++;
    // }
    // //return date
    // $returndate=self::$ci->TransferModel->get_data_return_date($searchdata);
    // foreach($returndata as $it)
    // {
    // $ArrVnCode[$k]=self::$ci->TransferModel->checkdata($it['Vncode']);
    // $ArrFromDate[$k]=self::$ci->TransferModel->checkdata($it['DeptDate1']);
    // $ArrOption[$k]="TRF OUT";
    // $ArrNameFlight[$k]=self::$ci->TransferModel->checkdata($it['OutFlight']);
    // $ArrFromPlace[$k]="SGN/".self::$ci->TransferModel->checkdata($it['ToPlace']);
    // $ArrTimeOut[$k]=self::$ci->TransferModel->checkdata($it['TimeOut']);
    // $ArrHotel[$k]=self::$ci->TransferModel->checkdata($it['Hotel']);
    // $ArrNper[$k]=self::$ci->TransferModel->checkdata($it['NPer']);
    // $ArrTourID[$k]=self::$ci->TransferModel->checkdata($it['TourID']);
    // $ArrGuest[$k]=self::$ci->TransferModel->checkdata($it['GroupName']);
    // $k++;
    // }

    // //data option tuour
    // $optiontourdata=self::$ci->TransferModel->get_data_option_tour($search_data);
    // foreach($optiontourdata as $i)
    // {
    // $ArrVnCode[$k]=self::$ci->TransferModel->checkdata($i['Vncode']);
    // $ArrFromDate[$k]=self::$ci->TransferModel->checkdata($i['Date']);
    // $ArrOption[$k]=self::$ci->TransferModel->checkdata($i['optionalTourListID']);
    // $ArrNameFlight[$k]="";
    // $ArrFromPlace[$k]="";
    // $ArrTimeOut[$k]="";
    // $ArrHotel[$k]=self::$ci->TransferModel->checkdata($i['Hotel']);
    // $ArrNper[$k]=self::$ci->TransferModel->checkdata($i['NPer']);
    // $ArrTourID[$k]=self::$ci->TransferModel->checkdata($i['TourID']);
    // $ArrGuest[$k]=self::$ci->TransferModel->checkdata($i['GroupName']);
    // $k++;
    // }
    // //sorting with date asc
    // $count = k;
    // $Array = 0;
    // $flag = 0;
    // $flag1 =0;
    // $ArrVnCode[$count]="";
    // $ArrFromDate[$count] ="";
    // $ArrOption [$count]="";
    // $ArrNameFlight[$count]="";
    // $ArrFromPlace [$count]="";
    // $ArrTimeOut[$count]="";
    // $ArrHotel[$count] ="";
    // $ArrNper [$count]="";
    // $ArrTourID [$count]="";
    // $ArrGuest[$count]="";
    // do
    // {
    // $minFormdate = $ArrFromDate[$Array];
    // for($min = $Array;$min<=count-1;$min++)
    // {
    // if($minFormdate > $ArrFromDate[$min])
    // {
    // $ArrVnCode[$count] = $ArrVnCode[$Array];
    // $ArrFromDate[$count] = $ArrFromDate[$Array];
    // $ArrOption[$count] = $ArrOption[$Array];
    // $ArrNameFlight[$count] = $ArrNameFlight[$Array];
    // $ArrFromPlace[$count] = $ArrFromPlace[$Array];
    // $ArrTimeOut[$count] = $ArrTimeOut[$Array];
    // $ArrHotel[$count] = $ArrHotel[$Array];
    // $ArrNper[$count] = $ArrNper[$Array];
    // $ArrTourID[$count] = $ArrTourID[$Array];
    // $ArrGuest[$count] = $ArrGuest[$Array];

    // $ArrVnCode[$Array] = $ArrVnCode[$min];
    // $ArrFromDate[$Array] = $ArrFromDate[$min];
    // $ArrOption[$Array] = $ArrOption[$min];
    // $ArrNameFlight[$Array] = $ArrNameFlight[$min];
    // $ArrFromPlace[$Array] = $ArrFromPlace[$min];
    // $ArrTimeOut[$Array] = $ArrTimeOut[$min];
    // $ArrHotel[$Array] = $ArrHotel[$min];
    // $ArrNper[$Array] = $ArrNper[$min];
    // $ArrTourID[$Array] = $ArrTourID[$min];
    // $ArrGuest[$Array] = $ArrGuest[$min];

    // $ArrVnCode[$min] = $ArrVnCode[$count];
    // $ArrFromDate[$min] = $ArrFromDate[$count];
    // $ArrOption[$min] = $ArrOption[$count];
    // $ArrNameFlight[$min] = $ArrNameFlight[$count];
    // $ArrFromPlace[$min] = $ArrFromPlace[$count];
    // $ArrTimeOut[$min] = $ArrTimeOut[$count];
    // $ArrHotel[$min] = $ArrHotel[$count];
    // $ArrNper[$min] = $ArrNper[$count];
    // $ArrTourID[$min] = $ArrTourID[$count];
    // $ArrGuest[$min] = $ArrGuest[$count];
    // }
    // else
    // {
    // $minFormdate = $ArrFromDate[$Array];
    // }
    // }
    // $Array++;
    // }while($Array<$count-1);

    // //sort with hour when date lop

    // $Array =0;
    // $flag = 0;
    // for($l=0;$l<=$count -1 ; $l++)
    // {
    // $testFromDate = $ArrFromDate[$flag];
    // if($testFromDate!=$ArrFromDate[$l])
    // {
    // do
    // {
    // $minTimeOut = $ArrTimeOut[$Array];
    // for($min = $Array;$min<=$l-1;$min++)
    // {
    // if($minTimeOut > $ArrTimeOut[$min])
    // {
    // $ArrVnCode[$count] = $ArrVnCode[$Array];
    // $ArrFromDate[$count] = $ArrFromDate[$Array];
    // $ArrOption[$count] = $ArrOption[$Array];
    // $ArrNameFlight[$count] = $ArrNameFlight[$Array];
    // $ArrFromPlace[$count] = $ArrFromPlace[$Array];
    // $ArrTimeOut[$count] = $ArrTimeOut[$Array];
    // $ArrHotel[$count] = $ArrHotel[$Array];
    // $ArrNper[$count] = $ArrNper[$Array];
    // $ArrTourID[$count] = $ArrTourID[$Array];
    // $ArrGuest[$count] = $ArrGuest[$Array];

    // $ArrVnCode[$Array] = $ArrVnCode[$min];
    // $ArrFromDate[$Array] = $ArrFromDate[$min];
    // $ArrOption[$Array] = $ArrOption[$min];
    // $ArrNameFlight[$Array] = $ArrNameFlight[$min];
    // $ArrFromPlace[$Array] = $ArrFromPlace[$min];
    // $ArrTimeOut[$Array] = $ArrTimeOut[$min];
    // $ArrHotel[$Array] = $ArrHotel[$min];
    // $ArrNper[$Array] = $ArrNper[$min];
    // $ArrTourID[$Array] = $ArrTourID[$min];
    // $ArrGuest[$Array] = $ArrGuest[$min];

    // $ArrVnCode[$min] = $ArrVnCode[$count];
    // $ArrFromDate[$min] = $ArrFromDate[$count];
    // $ArrOption[$min] = $ArrOption[$count];
    // $ArrNameFlight[$min] = $ArrNameFlight[$count];
    // $ArrFromPlace[$min] = $ArrFromPlace[$count];
    // $ArrTimeOut[$min] = $ArrTimeOut[$count];
    // $ArrHotel[$min] = $ArrHotel[$count];
    // $ArrNper[$min] = $ArrNper[$count];
    // $ArrTourID[$min] = $ArrTourID[$count];
    // $ArrGuest[$min] = $ArrGuest[$count];
    // }
    // else
    // {
    // $minTimeOut = $ArrTimeOut[$Array];
    // }
    // }
    // $Array++;
    // }while($Array<$l);
    // }
    // else
    // {
    // $flag=$l;
    // }
    // if($ArrFromDate[$count - 1] = $ArrFromDate[$l])
    // {
    // $flag1=2;
    // $Array = $l;
    // break;
    // }
    // }
    // if($flag1=="2")
    // {
    // do
    // {
    // $minTimeOut = $ArrTimeOut[$Array];
    // for($min=$Array;$min<$count-1;$min++)
    // {
    // if($minTimeOut > $ArrTimeOut[$min])
    // {
    // $ArrVnCode($count) = $ArrVnCode($Array);
    // $ArrFromDate($count) = $ArrFromDate($Array);
    // $ArrOption($count) = $ArrOption($Array);
    // $ArrNameFlight($count) = $ArrNameFlight($Array);
    // $ArrFromPlace($count) = $ArrFromPlace($Array);
    // $ArrTimeOut($count) = $ArrTimeOut($Array);
    // $ArrHotel($count) = $ArrHotel($Array);
    // $ArrNper($count) = $ArrNper($Array);
    // $ArrTourID($count) = $ArrTourID($Array);
    // $ArrGuest($count) = $ArrGuest($Array);

    // $ArrVnCode($Array) = $ArrVnCode($min);
    // $ArrFromDate($Array) = $ArrFromDate($min);
    // $ArrOption($Array) = $ArrOption($min);
    // $ArrNameFlight($Array) = $ArrNameFlight($min);
    // $ArrFromPlace($Array) = $ArrFromPlace($min);
    // $ArrTimeOut($Array) = $ArrTimeOut($min);;
    // $ArrHotel($Array) = $ArrHotel($min);
    // $ArrNper($Array) = $ArrNper($min);
    // $ArrTourID($Array) = $ArrTourID($min);
    // $ArrGuest($Array) = $ArrGuest($min);

    // $ArrVnCode($min) = $ArrVnCode($count);
    // $ArrFromDate($min) = $ArrFromDate($count);
    // $ArrOption($min) = $ArrOption($count);
    // $ArrNameFlight($min) = $ArrNameFlight($count);
    // $ArrFromPlace($min) = $ArrFromPlace($count);
    // $ArrTimeOut($min) = $ArrTimeOut($count);
    // $ArrHotel($min) = $ArrHotel($count);
    // $ArrNper($min) = $ArrNper($count);
    // $ArrTourID($min) = $ArrTourID($count);
    // $ArrGuest($min) = $ArrGuest($count);
    // }
    // else
    // {
    // $minTimeOut = $ArrTimeOut($Array);
    // }
    // }
    // $Array++;
    // }while($Array<$count-1);
    // }
    // //export excel
    // $flag1 = 0;
    // $test = 0;
    // $flag2 = 0;
    // $row=2;
    // $flag_TourContent=0;
    // $TourContent="";
    // $TourName="";
    // $test=0;
    // for($l=0;$l<=$count-1;$l++)
    // {
    // $flag_TourContent=0;
    // $flag_TourName=0;
    // $flag_Row=0;
    // if($l=0)
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."A",$ArrVnCode($l))
    // ->setCellValue($row."B",$ArrFromDate($l));
    // if($ArrOption($l)=="TRF IN" || $ArrOption($l)=="TRF OUT")
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F",$ArrOption($l));
    // }
    // else
    // {
    // //xem lai co so du lieu truy van
    // $tourlist = self::$ci->TransferModel->get_data_optiontourlist($ArrOption($l),$ArrFromDate($l));
    // foreach($tourlist as $tr)
    // {
    // $TourContent=self::$ci->TransferModel->checkdata($tr['tourcontent']);
    // $TourName=self::$ci->TransferModel->checkdata($tr['tourname']);
    // $flag_TourContent++;
    // }
    // if($flag_TourContent==0)
    // {
    // $tourlistname = self::$ci->TransferModel->get_data_booking_option_toure($ArrOption($l),$ArrFromDate($l));
    // //check du lieu dau ra
    // foreach($tourlistname as $trname)
    // {
    // $TourName=self::$ci->TransferModel->checkdata($trname['tourname']);
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // $flag_TourName++;
    // }
    // if($flag_TourName==0)
    // {
    // $flag_Row++;
    // }
    // else
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // }
    // }
    // else
    // {
    // if($TourContent!="")
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourContent));
    // }
    // else
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // }
    // }
    // }
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."G",$ArrNameFlight($l))
    // ->setCellValue($row."H",$ArrFromPlace($l))
    // ->setCellValue($row."I",$ArrTimeOut($l))
    // ->setCellValue($row."J",$ArrHotel($l))
    // ->setCellValue($row."K",$ArrNper($l))
    // ->setCellValue($row."L",$ArrGuest($l));
    // if($flag_Row==0)
    // {
    // $row++;
    // }
    // }
    // if($l!=0)
    // {
    // if($ArrFromDate($l) != $ArrFromDate($l - 1))
    // {
    // $flag1 = $l;
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."A",$ArrVnCode($l))
    // ->setCellValue($row."B",$ArrFromDate($l));
    // if($ArrOption($l)=="TRF IN" || $ArrOption($l) == "TRF OUT")
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($ArrOption($l)));
    // }
    // else
    // {
    // $dtoptiontour = self::$ci->TransferModel->get_data_optiontourlist($ArrOption($l),$ArrFromDate($l));
    // foreach($dtoptiontour as $op)
    // {
    // $TourContent=self::$ci->TransferModel->checkdata($op['tourcontent']);
    // $TourName=self::$ci->TransferModel->checkdata($op['tourname']);
    // $flag_TourContent ++;
    // }
    // if($flag_TourContent==0)
    // {
    // $bokingtour = self::$ci->TransferModel->get_data_booking_option_toure($ArrOption($l),$ArrFromDate($l));
    // foreach($bookingtour as $bk)
    // {
    // $TourName=self::$ci->TransferModel->checkdata($bk['tourname']);
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // $flag_TourName ++;
    // }
    // if($flag_TourName==0)
    // {
    // $flag_Row++;
    // }
    // else
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // }
    // }
    // else
    // {
    // if($TourContent!="")
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourContent));
    // }
    // else
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // }
    // }
    // }
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."G",$ArrNameFlight($l))
    // ->setCellValue($row."H",$ArrFromPlace($l))
    // ->setCellValue($row."I",$ArrTimeOut($l))
    // ->setCellValue($row."J",$ArrHotel($l))
    // ->setCellValue($row."K",$ArrNper($l))
    // ->setCellValue($row."L",$ArrGuest($l));
    // if($flag_Row==0)
    // {
    // $row++;
    // }
    // }
    // else
    // {
    // $test=0;
    // for($flag2=$flag1;$flag2<=$l-1;$flag2++)
    // {
    // if($ArrVnCode($flag2) == $ArrVnCode($l) && $ArrFromDate($flag2) == $ArrFromDate($l) && $ArrNameFlight($flag2) == $ArrNameFlight($l) && $ArrFromPlace($flag2) == $ArrFromPlace($l) && $ArrTimeOut($flag2) == $ArrTimeOut($l) && $ArrHotel($flag2) == $ArrHotel($l) && $ArrNper($flag2) == $ArrNper($l) && $ArrOption($flag2) == $ArrOption($l))
    // {
    // $test=1;
    // break;
    // }
    // }
    // if($test!=1)
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."A",$ArrVnCode($l))
    // ->setCellValue($row."B",$ArrFromDate($l));
    // if($ArrOption($l)=="TRF IN" || $ArrOption($l) == "TRF OUT")
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($ArrOption($l)));
    // }
    // else
    // {
    // $tourlistdata = self::$ci->TransferModel->get_data_optiontourlist($ArrOption($l),$ArrFromDate($l));
    // foreach($tourlistdata as $tr)
    // {
    // $TourContent=self::$ci->TransferModel->checkdata($tr['tourcontent']);
    // $flag_TourContent++;
    // }
    // if($flag_TourContent==0)
    // {
    // $bktour = self::$ci->TransferModel->get_data_booking_option_toure($ArrOption($l),$ArrFromDate($l));
    // foreach($bktour as $bk)
    // {
    // $TourName=self::$ci->TransferModel->checkdata($bk['tourname']);
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // $flag_TourName ++;
    // }
    // if($flag_TourName==0)
    // {
    // $flag_Row++;
    // }
    // else
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // }
    // }
    // else
    // {
    // if($TourContent!="")
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourContent));
    // }
    // else
    // {
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."F", strtoupper($TourName));
    // }
    // }
    // }
    // self::$objPHPExcel->getActiveSheet()->setCellValue($row."G",$ArrNameFlight($l))
    // ->setCellValue($row."H",$ArrFromPlace($l))
    // ->setCellValue($row."I",$ArrTimeOut($l))
    // ->setCellValue($row."J",$ArrHotel($l))
    // ->setCellValue($row."K",$ArrNper($l))
    // ->setCellValue($row."L",$ArrGuest($l));
    // if($flag_Row==0)
    // {
    // $row++;
    // }
    // }
    // }
    // }
    // }
    // //line style boder
    // $style_boder = 1;
    // $column = array("1"=>"A","2"=>"B","3"=>"C","4"=>"D","5"=>"E","6"=>"F",
    // "7"=>"G","8"=>"H","9"=>"I","10"=>"J","11"=>"K","12"=>"L");

    // foreach($column as $column2)
    // {
    // for($row2 = 2;$row2<=$row-1;$row++)
    // {
    // self::$objPHPExcel->getActiveSheet()->getStyle($column2,$row)->getBorders()->getTop()->setBorderStyle($style_boder);
    // self::$objPHPExcel->getActiveSheet()->getStyle($column2,$row)->getBorders()->getBottom()->setBorderStyle($style_boder);
    // self::$objPHPExcel->getActiveSheet()->getStyle($column2,$row)->getBorders()->getLeft()->setBorderStyle($style_boder);
    // self::$objPHPExcel->getActiveSheet()->getStyle($column2,$row)->getBorders()->getRight()->setBorderStyle($style_boder);
    // }
    // }
    // }
    // catch (Exception $e)
    // {
    // self::$ci->session->set_errordata('error_print',"Don't click when this file running");
    // }
    // }

    /**
     * Function name: exportCarScheduling
     * Export car scheduling information to excel file
     *
     * @return excel file to download
     * @access public
     * @static
     */
    public static function exportCarScheduling()
    {
    /**
     * TODO
     */
    }

    /**
     * Function name: exportOptionalTourGuide
     * Export optional tour guide table to excel file
     *
     * @return excel file to download
     * @access public
     * @static
     */
    public static function exportOptionalTourGuide()
    {
    /**
     * TODO
     */
    }

    /**
     * Function name: formatStr
     * Copy from formatStr in TR002
     *
     * @param string $str
     *            input string
     * @return string output
     *        
     * @access private
     * @static
     */
    private static function formatStr($str)
    {
        $roomType = '';
        $roomClass = '';
        $arr = array();

        if (isset($str) and ! empty($str)) {
            $arr = explode(";", $str);
        }

        $deli = "";
        for ($i = 0; $i < count($arr) - 2; $i ++) {
            $tempStr = $arr[$i];
            $roomType .= $deli . substr($tempStr, 0, strpos($tempStr, "/"));
            $roomClass .= $deli . $tempStr;
        }

        return ($roomType . "*" . $roomClass);
    }
}
