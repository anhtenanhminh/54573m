<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * | -------------------------------------------------------------------------
 * | URI ROUTING
 * | -------------------------------------------------------------------------
 * | This file lets you re-map URI requests to specific controller functions.
 * |
 * | Typically there is a one-to-one relationship between a URL string
 * | and its corresponding controller class/method. The segments in a
 * | URL normally follow this pattern:
 * |
 * | example.com/class/method/id/
 * |
 * | In some instances, however, you may want to remap this relationship
 * | so that a different class/function is called than the one
 * | corresponding to the URL.
 * |
 * | Please see the user guide for complete details:
 * |
 * | http://codeigniter.com/user_guide/general/routing.html
 * |
 * | -------------------------------------------------------------------------
 * | RESERVED ROUTES
 * | -------------------------------------------------------------------------
 * |
 * | There area two reserved routes:
 * |
 * | $route['default_controller'] = 'welcome';
 * |
 * | This route indicates which controller class should be loaded if the
 * | URI contains no data. In the above example, the "welcome" class
 * | would be loaded.
 * |
 * | $route['404_override'] = 'errors/page_missing';
 * |
 * | This route will tell the Router what URI segments to use if those provided
 * | in the URL cannot be matched to a valid route.
 * |
 */

$route['default_controller'] = "AuthenController";
$route['index'] = 'AuthenController/checkUser';
$route['dashboard'] = 'DashboardController';
$route['staffinfo'] = 'StaffInfoController/index';
$route['staffinfo/staff-list'] = 'StaffInfoController/staff_list';
$route['staffinfo/newstaff'] = 'StaffInfoController/staff_new';
$route['accinfo/account-list'] = 'StaffInfoController/account_list';
$route['accinfo/newaccount'] = 'StaffInfoController/account_new';
$route['testpage'] = 'DashboardController/testpage';
$route['sysinfo'] = 'DashboardController/sysinfo';

$route['user/adduser'] = "AuthenController/adduser";
$route['user/padd'] = "AuthenController/do_add_user";
$route['user/get_location'] = 'AuthenController/get_user_location';
$route["user/save_location"] = 'AuthenController/save_location';
$route["user/change_password"] = "AuthenController/change_pass";
$route["user/check_admin"] = "AuthenController/admin_auth";

$route["delete_surcharge"] = "InvoiceController/delete_surcharge";
$route["save_surcharge"] = "InvoiceController/save_surcharge";
$route["insert_surcharge"] = "InvoiceController/insert_surcharge";
$route["print_intransfer"] = "TransferController/printSingle";
$route['googleform/hopslite'] = "DashboardController/hopslite";
$route['googleform/idrequest'] = "DashboardController/idrequest";
$route['googleform/iddelete'] = "DashboardController/iddelete";
$route['googleform/grouprequest'] = "DashboardController/grouprequest";
$route['googleform/passwordreset'] = "DashboardController/passwordreset";

$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */