<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthenModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function registration_insert($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function login($data)
    {
        $condition = "uname =" . "'" . $data['username'] . "' AND " . "pw =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Read data from database to show data in admin page
    public function read_user_information($username)
    {
        $condition = "uname =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Function get_location
     *
     *
     * @param
     *            $user
     */
    public function get_location($user)
    {
        $sql = "SELECT DISTINCT ID,Location_name,Location_code,User FROM Locations WHERE Locations.User='$user' ORDER BY Location_name";
        return $this->db->query($sql)->result_array();
    }

    /**
     * Function: insert_locations
     * Add locations for user
     *
     *  param $locations locations
     *            information
     */
    public function insert_locations($locations)
    {
        foreach ($locations as $location) {
            $this->db->insert("locations", $location);
        }
    }

    /**
     * Function delete_location
     * Delete location from locations table
     *
     * @param array $locations
     */
    public function delete_location($locations)
    {
        foreach ($locations as $location) {
            $this->db->where($location);
            $this->db->delete("locations");
        }
    }

    /**
     * Function edit
     * Update user's information
     *
     * param $id user
     *            id
     * param $update updated
     *            information
     */
    public function edit($id, $update)
    {
        $this->db->where("id", $id);
        $this->db->update("user", $update);
    }
}