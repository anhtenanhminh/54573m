<?php
/**
 * Staffinformation Management
 */
defined('BASEPATH') or exit('No direct script access allowed');

class StaffInfoController extends CI_Controller
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
        $this->load->view('Employee/formEmployeeList');
    }

    /**
     * Load formEmployee with data (branches + offices)
     */
    public function staff_list()
    {
        $data = array();
        // $this->get_all();
        $data['branches'] = $this->StaffInfoModel->get_branch();
        $data['offices'] = $this->StaffInfoModel->get_office();
        // var_dump($data);die;
        $this->load->view('Employee/formEmployeeList', $data);
    }
    
    /**
     * Load formAccountList with data (branches + offices)
     */
    public function account_list()
    {
        $data = array();
        // $this->get_all();
        $data['branches'] = $this->StaffInfoModel->get_branch();
        $data['offices'] = $this->StaffInfoModel->get_office();
        $data['depts'] = $this->StaffInfoModel->get_dept();
        //var_dump($data);die;
        $this->load->view('Employee/formAccountList', $data);
    }
    

    /**
     * staff_new
     */
    public function staff_new()
    {
        $data['branches'] = $this->StaffInfoModel->get_branch();
        $data['offices'] = $this->StaffInfoModel->get_office();
        $data['depts'] = $this->StaffInfoModel->get_dept();
        $this->load->view('Employee/formEmployeeNew',$data);
    }
    
    /**
     * acc_new
     */
    public function account_new()
    {
        // ham get variable tu URL
        // syntax $this->input->get('ten_bien', true);
        $id = $this->input->get('id', true);
        //echo 'id lay duoc la: '.$id;
        $stid = array();
        $stid['StaffID'] = $id;
        //var_dump($stid);
        if($id!=null){
            $db = $this->StaffInfoModel->get_data_search_staffoffice_list($stid);
        }
        //echo 'Staffid lay duoc la: '.$db[0]['StaffID'].'_het_';
        //echo 'Staffid lay duoc la: '.$db[0]['StaffID'].'_het_';
        //print_r($db);
        
        //$data['branches'] = $this->StaffInfoModel->get_branch();
        //var_dump($data);
        //$data['offices'] = $this->StaffInfoModel->get_office();
        //$data['depts'] = $this->StaffInfoModel->get_dept();
        $this->load->view('Employee/formAccountNew',$db[0]);
        
        /*
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

         */
        
        
        
    }
    

    public function get_StaffOffice()
    {
        $branch = $this->input->post('branch', TRUE);
        $rows = $this->StaffInfoModel->get_staffoffice_by_branch($branch);
        $output = '<option value=""></option>';
        foreach ($rows as $row) {
            $output .= "<option value=\"" . $row->StaffOffice . "\">" . $row->StaffOffice . "</option>";
        }
        echo $output;
    }
//return table data
    public function get_data_search_staffoffice_list()
    {
        $data = array();
        $data['staffBranch'] = $this->input->post('staffBranch', TRUE);
        $data['StaffOffice'] = $this->input->post('StaffOffice', TRUE);
        $data['StaffID'] = $this->input->post('StaffID', TRUE);
        $rows = $this->StaffInfoModel->get_data_search_staffoffice_list($data);
        echo json_encode(array(
            'tableData' => $rows
        ));
    }
    
    public function get_data_search_staffbirthday_list()
    {
        $rows = $this->StaffInfoModel->get_data_search_staffbirthday_list();
        echo json_encode(array(
            'tableData' => $rows
        ));
    }

    /**
     * lay thong tin staff
     */
    public function get_staff_detail()
    {
        $staffid['StaffID'] = $this->input->post('StaffID', TRUE);
        $data = $this->StaffInfoModel->get_data_search_staffoffice_list($staffid);
        if($data)
        {
            $data[0]['Noti']="Invalid";
        }
        echo json_encode($data);
    }
    

    /**
     * new id OK -> update, not ok -> show error
     */
    public function resetid()
    {
        $msg = array();
        $newid = $this->input->post('recordnewstaffid', TRUE);
        $oldid = $this->input->post('oldrecordid', TRUE);
        $check_staffidre = $this->StaffInfoModel->check_staffid($newid);
        if ($check_staffidre != "OK") {
            $msg['msg'] = $check_staffidre;
            $msg['error'] = 1;
        } else {
            $result = $this->StaffInfoModel->updateid($oldid, $newid);
            if ($result) {
                $msg['msg'] = "New Staff ID was updated!";
                $msg['error'] = 0;
            } else {
                $msg['msg'] = "Update database failed!";
                $msg['error'] = 1;
            }
        }
        echo json_encode($msg);
    }

    /**
     * id existed -> delete, not ok -> show error
     * delete when data is wrong, if staff resigned, change WorkStt only
     */
    public function delete_staffinfo_record()
    {
        $msg = array();
        // id of record need to delete
        $recordid_delete = $this->input->post('recordid', TRUE);
        $check_idresult = $this->StaffInfoModel->check_id_if_exist($recordid_delete);
        // msg khac OK la loi id
        if ($check_idresult != "OK") {
            $msg['msg'] = $check_idresult;
            $msg['error'] = 1;
        } else {
            $result = $this->StaffInfoModel->deleterecord($recordid_delete);
            if ($result) {
                $msg['msg'] = "Deleting completed!";
                $msg['error'] = 0;
            } else {
                $msg['msg'] = "Deleting failed!";
                $msg['error'] = 1;
            }
        }
        echo json_encode($msg);
    }

    /**
     * id existed -> delete, not ok -> show error
     * delete when data is wrong, if staff resigned, change WorkStt only
     */
    public function update_staffinfo_record()
    {
        $msg = array();
        // id of record need to update
        $recordid_update = $this->input->post('id', TRUE);
        $data = $this->input->post('data', TRUE);
        $check_idresult = $this->StaffInfoModel->check_id_if_exist($recordid_update);
        // msg khac OK la loi id
        if ($check_idresult != "OK") {
            $msg['msg'] = $check_idresult;
            $msg['error'] = 1;
        } else {
            $result = $this->StaffInfoModel->update_staff_info($recordid_update, $data);
            if ($result) {
                $msg['msg'] = "Staff info updated!";
                $msg['error'] = 0;
            } else {
                $msg['msg'] = "Updating failed!";
                $msg['error'] = 1;
            }
        }
        echo json_encode($msg);
    }

    /**
     * Add new staff record to staffinfo
     * 
     * @return string msg
     */
    public function add_staffinfo_record()
    {
        // bien message msg tra ve ket qua
        $msg = array();
        // bien data nhap vao tu page newstaff
        $data = $this->input->post('data', TRUE);
        $acc  = $this->input->post('acc', TRUE);
        $result  = $this->StaffInfoModel->add_staff_info($data);
        $result_acc  = $this->StaffInfoModel->add_acc_info($acc);
        
        if ($result) {
            if($result_acc)
            {
                //staffinfo + accinfo
                $msg['msg'] = "Staff info updated! Click OK to add more accounts!";
                $msg['error'] = 0;
                $msg['id'] = 123;
            }
            else 
            {
                //staffinfo ok accinfo failed
                $msg['msg'] = "Staff info updated! Error on Acc info!";
                $msg['error'] = 1;
                $msg['id'] = 123;
            }
        } else {
            $msg['msg'] = "Updating failed!";
            $msg['error'] = 1;
        }
        echo json_encode($msg);
        /*
        // step 1: kiem tra StaffID bi trung hay ko
        $checkidresult = $this->StaffInfoModel->check_staffid($data['StaffID']);
        // msg khac OK la loi id (ID existed!)
        /*if ($checkidresult != "OK") {
            $msg['msg'] = $checkidresult;
            $msg['error'] = 1;
        } else {
            // step 2: tao id index record
            $index_id_new = $this->StaffInfoModel->check_index_id();
            // $index_id_new = 817;
            // die("here" + $index_id_new);
            // $msg['msg'] = $index_id_new['id'];
            // $msg['error'] = 1;
            if ($index_id_new['id'] > 0) {
                // step 3: add vao database
                alert($index_id_new['id']);
                $data['id'] = $index_id_new;
                $result = $this->StaffInfoModel->add_staff_info($data);
                if ($result) {
                    $msg['msg'] = "Staff info updated!";
                    $msg['error'] = 0;
                } else {
                    $msg['msg'] = "Updating failed!";
                    $msg['error'] = 1;
                }
            } else {
                $msg['msg'] = "Creating index failed";
                $msg['error'] = 1;
            }
        }
        echo json_encode($msg);
        */
    }
    
    /**
     * Update staff's account to accinfo
     *
     * @return string msg
     */
    public function update_accinfo_record()
    {
        $msg = array();
        $data = $this->input->post('data', TRUE);
        $result  = $this->StaffInfoModel->add_acc_info($data);
        if ($result) {
                //staffinfo + accinfo
                $msg['msg'] = "Updated successfully!";
                $msg['error'] = 0;            
        }
        else {
            $msg['msg'] = "Updating failed!";
            $msg['error'] = 1;
        }
        echo json_encode($msg);
    }
    
    
    

    public function check_index()
    {

        // $data = $this->input->post('data',TRUE);
        // if($data['id'] == 'RQ')
        $result = $this->StaffInfoModel->check_index_id();
        // else $result['id'] = 'error';
        return $result;
    }
}
