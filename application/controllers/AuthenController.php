<?php include 'AuthenController';?>
<?php
/**
 * User Manager
 */
defined('BASEPATH') or exit('No direct script access allowed');

class AuthenController extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('formLogin');
    }

    public function checkUser()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                redirect('dashboard');
            } else {
                $this->load->view('formLogin');
            }
        } else {
            $this->load->library("Cryptographic");
            $data = array(
                'username' => $this->input->post('username'),
                'password' => Cryptographic::encrypt($this->input->post('password'))
            );
            $this->load->model('AuthenModel');
            $result = $this->AuthenModel->login($data);
            if ($result == true) {
                $username = $this->input->post('username');
                $result = $this->AuthenModel->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]['UserName'],
                        'fullname' => $result[0]['FullName']
                    );
                }
                $this->session->set_userdata('logged_in', $session_data);
                redirect('dashboard');
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('formLogin', $data);
            }
        }
    }

    public function adduser()
    {
        $isAuthed = $this->session->flashdata("admin_authenticated");
        if ($isAuthed) {
            $this->load->view('System/formAddUser');
        } else {
            redirect(base_url("user/check_admin"));
        }
    }

    public function do_add_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[cfpassword]');
        $this->form_validation->set_rules('cfpassword', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('locations', 'Location', 'required');

        // set error
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        $this->form_validation->set_message("required", "This field is required");
        $this->form_validation->set_message("matches", "Password must matches with confirm password");

        $data = array();

        $this->load->model('InvoiceModel', "Invoice");

        if ($this->form_validation->run() !== FALSE) {
            $this->load->library("Cryptographic");
            $userData = array(
                'UserName' => $this->input->post('username'),
                'Password' => Cryptographic::encrypt($this->input->post('password')),
                'FullName' => $this->input->post('fullname')
            );
            $this->load->model('AuthenModel');
            $userExist = $this->AuthenModel->read_user_information($userData['UserName']);

            if ($userExist) {
                $data["error"] = "The user ID is already existed";
            } else {
                //$locations = explode(",", $this->input->post("locations"));
                //$locations = $this->Invoice->get_location_by_code($locations);
                //foreach ($locations as $key => $value) {
                //    $locations[$key]['User'] = $userData['UserName'];
                //}

                //$result = $this->AuthenModel->registration_insert($userData);
                if ($result != false) {
                    $this->AuthenModel->insert_locations($locations);
                    $data['success'] = 'Add New User Successfully !';
                } else {
                    $data['error'] = 'Add Fail !';
                }
            }
        }
        $data['locations'] = $this->Invoice->get_location('admin');
        $this->load->view('System/formAddUser', $data);
    }

    public function change_pass()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $user = $this->input->post("username");
            $currentPass = Cryptographic::encrypt($this->input->post("curpassword"));
            $newPass = $this->input->post("password");
            $confirmPass = $this->input->post("cfpassword");

            $this->load->model('AuthenModel');
            $userExist = $this->AuthenModel->read_user_information($user);

            if ($userExist) {
                $userExist = $userExist[0];
                if ($userExist['Password'] == $currentPass) {
                    if ($newPass == $confirmPass) {
                        $update = array(
                            'FullName' => $this->input->post('fullname'),
                            'Password' => Cryptographic::encrypt($newPass)
                        );
                        $this->AuthenModel->edit($userExist['ID'], $update);
                        $data['success'] = "Data has been saved Successfully";
                    } else {
                        $data['error'] = 'Password and confirm password are not the same';
                    }
                } else {
                    $data['error'] = 'Incorrect user id or password';
                }
            } else {
                $data['error'] = 'Incorrect user id or password';
            }
        }

        $this->load->view('System/formChangePass', $data);
    }

    public function logout()
    {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout !';
        $this->load->view('formLogin', $data);
    }

    public function get_user_location()
    {
        $user = $this->input->post('user');

        $this->load->model('InvoiceModel', "Invoice");
        $locations = $this->Invoice->get_location($user);

        echo json_encode($locations);
        exit();
    }

    public function save_location()
    {
        $user = $this->input->post("user");
        $location = $this->input->post("location");
        if ($user) {
            $this->update_location($user, $location);
            echo "OK";
            die();
        }
        echo "fail";
    }

    private function update_location($user, $location)
    {
        $this->db->where("User", $user);
        $this->db->delete("locations");
        $uploadList = explode(",", $location);

        $this->load->model('InvoiceModel', "Invoice");
        $this->load->model('AuthenModel');

        $locations = $this->Invoice->get_location_by_code($uploadList);

        foreach ($locations as $key => $value) {
            $locations[$key]['User'] = $user;
        }
        $this->AuthenModel->insert_locations($locations);
    }

    public function admin_auth()
    {
        $data = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $user = $this->input->post("username");
            if ($user == "admin") {
                $this->load->library("Cryptographic");
                $data = array(
                    'username' => $user,
                    'password' => Cryptographic::encrypt($this->input->post('password'))
                );
                $this->load->model('AuthenModel');
                $isAdmin = $this->AuthenModel->login($data);
                if ($isAdmin) {
                    $this->session->set_flashdata("admin_authenticated", TRUE);
                    redirect(base_url("user/adduser"));
                } else {
                    $data['error'] = "Password is invalid.";
                }
            } else {
                $data['error'] = "User ID is invalid.";
            }
        }
        $this->load->view("System/formAdminLogin", $data);
    }
}