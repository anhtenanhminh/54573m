<?php
defined('BASEPATH') or exit('No direct script access allowed');

// class HotelBookingModel extends CI_Model
class StaffInfoModel extends CI_Model
{

    // Minh
    /**
     * Count & report
     * by WorkStatus
     *
     * @return array
     */
    public function get_staffbyWorkStt($workstt)
    {
        //$this->db->distinct()
        //->select('*');
        //$query = $this->db->get('staffinfo');
        //$this->db->where('WorkStt', $workstt);
        
        //return $result = $this->db->count_all_results();
        $sql = "select distinct * from staffinfo where WorkStt =  '{$workstt}'" ;
        return $this->db->query($sql)->result_array();
        
        //return $query->result_array()->count_all_results();
    }
    
    public function get_emailinfo($con)
    {
        $sql = "select * from accinfo {$con}" ;
        return $this->db->query($sql)->result_array();
        //return $sql;
    }
    
    /**
     * Lấy all staffinfo
     * sort by staffName
     *
     * @return string
     */
    public function get_staffinfo()
    {
        $this->db->distinct()
            ->select('*')
            ->order_by("staffID", "asc");
        $query = $this->db->get('staffinfo');
        return $query->result_array();
    }

    /**
     * Lấy staffBranch
     *
     * @return string
     */
    public function get_branch()
    {
        $this->db->distinct()->select('staffBranch');
        $this->db->order_by("staffBranch", "asc");
        // $this->db->where("User", $this->session->userdata["logged_in"]["username"]);
        $query = $this->db->get('staffinfo');
        return $query->result_array();
    }

    /**
     * Lấy StaffOffice
     *
     * @return string
     */
    public function get_office()
    {
        $this->db->distinct()->select('StaffOffice');
        $this->db->order_by("StaffOffice", "asc");
        $query = $this->db->get('staffinfo');
        return $query->result_array();
    }
    
    /**
     * Lấy Dept
     *
     * @return string
     */
    public function get_dept()
    {
        //$sql = "select distinct StaffDept from staffinfo order by StaffDept asc";
        //return $this->db->query($sql)->result_array();
        $this->db->distinct()->select('StaffDept');
        $this->db->order_by("StaffDept", "asc");
        $query = $this->db->get('staffinfo');
        return $query->result_array();
    }

    /**
     * Lay ds nhan vien tu 3 bien staffBranch, StaffOffice va staffID:
     * Select * from staffinfo where staffID or staffBranch and StaffOffice
     * order by StaffOffice
     */
    public function get_data_search_staffoffice_list($data)
    {
        $sql = "SELECT staffinfo.id AS id, staffinfo.StaffID AS StaffID, staffinfo.StaffID2, staffinfo.StaffName, staffinfo.StaffDept, staffinfo.WorkStt, staffinfo.JP, staffinfo.StaffOffice, staffinfo.staffBranch, staffinfo.LastName, staffinfo.MiddleName, staffinfo.FirstName, staffinfo.DOB, staffinfo.JoinedDate, staffinfo.ResignedDate, staffinfo.Note, accinfo.Email, accinfo.EmailRQ, accinfo.EmailCreate, accinfo.EmailCLC, accinfo.Domain, accinfo.Alias1, accinfo.Alias2, accinfo.EmailHistory, accinfo.AD, accinfo.ADCreate, accinfo.ADCLC, accinfo.Nippo, accinfo.NippoRQ, accinfo.NippoCreate, accinfo.NippoCLC, accinfo.Hisgo, accinfo.HisgoRQ, accinfo.HisgoCreate, accinfo.HisgoCLC, accinfo.Challenge, accinfo.ChallengeRQ, accinfo.ChallengeCreate, accinfo.ChallengeCLC, accinfo.Vacation, accinfo.VacationRQ, accinfo.VacationCreate, accinfo.VacationCLC, accinfo.Other FROM staffinfo INNER JOIN accinfo ON staffinfo.StaffID = accinfo.StaffID";
        $sort = " ORDER BY accinfo.EmailRQ DESC";
        $con = "";
        //if (isset($data['staffID']) && $data['staffID'] != '') {
        if ($data['StaffID']!=null && $data['StaffID'] != '') {
            $con = " Where staffinfo.StaffID ='{$data['StaffID']}'";
            //return $con.$data;
        } else {
            if ($data["StaffOffice"] != '') {
                $con = " Where StaffOffice = '{$data['StaffOffice']}'";
            }
            elseif ($data["staffBranch"] != '') {
                $con = " Where staffBranch = '{$data['staffBranch']}'";
            }
            
        }
        $sql = $sql.$con.$sort;

        return $this->db->query($sql)->result_array();
        //return $sql;
        //return $data;
    }

    /**
     * Lay ds nhan vien tu dua theo ngay sinh va thang hien tai
     * Select * from staffinfo where Month(DOB) = month(today()) and WorkStt = Working
     * order by DOB
     */
    public function get_data_search_staffbirthday_list()
    {
        $sql = "select * from staffinfo where WorkStt = 'Working' and Month(DOB) = MONTH(CURRENT_DATE()) order by day(DOB) desc";       
        return $this->db->query($sql)->result_array();
        //return $sql;
    }
    
    
    
    /**
     * Loc danh sach office theo branch
     *
     * @return string
     */
    public function get_staffoffice_by_branch($branch)
    {
        $this->db->distinct()
            ->select('StaffOffice')
            ->order_by("StaffOffice", "asc");
        $this->db->where('staffBanch', $branch);
        $query = $this->db->get('staffinfo');
        return $query->result();
    }

    /**
     * Lay thong tin nhan vien de update:
     * Select * from staffinfo where id = hotelID
     */
    public function get_staff_info_by_staffid($staffID)
    {
        $this->db->select('*');
        $this->db->where('StaffID', $staffID);
        $this->db->from('staffinfo');
        $query = $this->db->get();
        if($query != false)
        {
            return $query->result_array();
        }
        else {
            return "Query failed";
        }
    }

    /**
     * check if new StaffID exist or not, tra ve gia tri msg: New ID invalid, ID existed and OK + loi e
     *
     * @param string $newid
     * @return string $result
     */
    public function check_staffid($newid)
    {
        if ($newid == "") {
            $result = "New ID invalid!";
            return $result;
        }

        try {
            // $dtr = get_staff_info_by_staffid($newid);
            $dtr = $this->db->select('StaffID')
                ->where('StaffID', $newid)
                ->from('staffinfo')
                ->get()
                ->result_array();
            if (count($dtr) > 0) {
                $result = "ID existed!";
                return $result;
            } else {
                $result = "OK";
                return $result;
            }
        } catch (Exception $e) {
            $result = $e;
            return $result;
        }
    }

    /**
     * Update StaffID by newStaffid, index by oldid
     */
    public function updateid($oldid, $newStaffid)
    {
        $this->db->set('StaffID', $newStaffid);
        $this->db->where('id', $oldid);
        $query = $this->db->update('staffinfo');
        if ($query == false)
            return false;
        else
            return true;
    }

    /**
     * check if record id (index) exist or not, tra ve gia tri msg: id existed (OK) and not found + loi e
     *
     * @param string $id
     * @return string $result
     */
    public function check_id_if_exist($id)
    {
        // id khong the co gia tri null
        if ($id == "") {
            $result = "Not found!";
            return $result;
        }
        try {
            $dtr = $this->db->select('id')
                ->where('id', $id)
                ->from('staffinfo')
                ->get()
                ->result_array();
            // id la ton tai duy nhat, nguoc lai failed
            if (count($dtr) == 1) {
                $result = "OK";
                return $result;
            } else {
                $result = "Error on ID";
                return $result;
            }
        } catch (Exception $e) {
            $result = $e;
            return $result;
        }
    }

    /**
     * delete record with index
     */
    public function deleterecord($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('staffinfo');
        if ($query == false)
            return false;
        else
            return true;
    }

    /**
     * Update staffinfo
     * return result
     */
    public function update_staff_info($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('staffinfo', $data);
        if ($query == false)
            return false;
        else
            return true;
    }

    /**
     * query current max id, create newid = id+1
     *
     * @return string newid
     */
    public function create_index_id()
    {
        $this->db->from('staffinfo');
        $this->db->select('id');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        $newid = $query[0]['id'] + 1;
        return $newid;
    }

    public function check_index_id()
    {
        // $this->db->query('select id from staffinfo order by id desc;');
        // $this->db->limit(1);
        // $query = $this->db->get('staffinfo');
        // $this->db->select('id');
        // $this->db->order_by('id','desc');
        // $query = $this->db->from('staffinfo')->get()->result_array();
        $query = $this->db->select('id')
            ->from('staffinfo')
            ->get()
            ->result_array();
        return $query;
    }

    public function add_staff_info($data)
    {
        $query = $this->db->insert('staffinfo', $data);
        if ($query == false)
            return false;
        else
            return true;
    }
    
    public function add_acc_info($acc)
    {
        $query = $this->db->insert('accinfo', $acc);
        if ($query == false)
            return false;
        else
            return true;
    }
    
    /**
     * Update accinfo
     * return result
     */
    public function update_acc_info($staffid, $data)
    {
        $this->db->where('StaffID', $staffid);
        $query = $this->db->update('accinfo', $data);
        if ($query == false)
            return false;
        else
            return true;
    }
}
