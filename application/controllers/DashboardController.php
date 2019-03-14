<?php
/**
 * HotelBooking Manager
 */
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
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
        // $this->get_all();
        $this->load->view('dashboard');
    }
    public function hopslite()
    {
        // $this->get_all();
        $this->load->view('GoogleForm/HopsliteAccountRequest');
    }
    public function idrequest()
    {
        // $this->get_all();
        $this->load->view('GoogleForm/IDApplicationForm');
    }
    public function iddelete()
    {
        // $this->get_all();
        $this->load->view('GoogleForm/DeleteAndChangeForm');
    }
    public function grouprequest()
    {
        // $this->get_all();
        $this->load->view('GoogleForm/GroupAddressCreationForm');
    }
    public function passwordreset()
    {
        // $this->get_all();
        $this->load->view('GoogleForm/PasswordResetForm');
    }
    public function testpage()
    {
        // $this->get_all();
        $this->load->view('TestPage/new');
    }
    public function sysinfo()
    {
        // $this->get_all();
        $this->load->view('System/formSysinfo');
    }
    
    //Lay thong tin report
    public function get_reportinfo()
    {
        $msg = array();
        $msg['Coming'] = 'Im coming';
        $msg['Working'] = 'Im Working';
        $msg['Resigned'] = 'Im Resigned';
        $data = $this->input->post('data', TRUE);
        if($data['data']= 'Start'){
            $comingstaffist = $this->StaffInfoModel->get_staffbyWorkStt('Coming');
            $workingstaffist = $this->StaffInfoModel->get_staffbyWorkStt('Working');
            $resignedstaffist = $this->StaffInfoModel->get_staffbyWorkStt('Resigned');
            if($comingstaffist){
                //$msg['Coming'] = count($comingstaffist);
                $msg['Coming'] = count($comingstaffist);
            };
            if($workingstaffist){
                $msg['Working'] = count($workingstaffist);
            };
            if($resignedstaffist){
                $msg['Resigned'] = count($resignedstaffist);
            };
        }    
        echo json_encode($msg);
    }
    //Lay thong tin report email
    public function get_emailreportinfo()
    {
        $msg = array();
        $msg['Requesting'] = 'Im Requesting';
        $msg['Using'] = 'Im Using';
        $msg['Deleted'] = 'Im Deleted';
        $data = $this->input->post('data', TRUE);
        if($data['data']= 'Start'){
            $requestinglist = $this->StaffInfoModel->get_emailinfo('where Email != "" and EmailRQ IS NOT NULL and EmailCreate IS NULL');
            $usinglist = $this->StaffInfoModel->get_emailinfo('where DATE(EmailCreate) < CURDATE() and EmailCLC IS NULL');
            $deletedlist = $this->StaffInfoModel->get_emailinfo('where EmailCLC IS NOT NULL');
            if($requestinglist){
                //$msg['Coming'] = count($comingstaffist);
                $msg['Requesting'] = count($requestinglist);
            }
            else {
                $msg['Requesting'] = $requestinglist;
            }
            ;
            if($usinglist){
                $msg['Using'] = count($usinglist);
            };
            if($deletedlist){
                $msg['Deleted'] = count($deletedlist);
            };
        }
        echo json_encode($msg);
    }
}
