<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\OrderstatuslogModel;
use CodeIgniter\Session\Session;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Libraries\EmailSms;

#[\AllowDynamicProperties]
class AdminController extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;
    protected $adminModel;
    protected $siteVariables;

    public function __construct() {
        $this->session = session();
        $this->siteVariables = new SiteVariables();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');

        $this->adminModel = new AdminModel();
    }

    public function adminusers() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        set_title('Welcome | ' . SITE_NAME);

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');

        $data['admin_type'] = $admin_type;
        $data['pagetitle'] = "Users List";
        $data['action'] = "adminusers";
        $data['accountype'] = $this->siteVariables->getVariable('accountype');
        $txtsearch = $this->request->getGet('txtsearch');
        $user_type = $this->request->getGet('user_type');
        $searchArray = array();
        $paginationnew = new Paginationnew();

       

        if ($user_type) {
            $searchArray["user_type"] = $user_type;
        }

        if ($txtsearch) {
            $searchArray['txtsearch'] = $txtsearch;
        }
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $this->adminModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["salesData"] = $this->adminModel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArray;

        $this->template->render('admintemplate', 'contents', 'admin/listaccount', $data);
    }

    public function newAccount() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        set_title('Welcome | ' . SITE_NAME);

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
        $data['admin_type'] = $admin_type;
        $data['zonalmanager'] = $this->adminModel->where("admin_type", "zonalmanager")->get()->getResultArray();
        $data['accountype'] = $this->siteVariables->getVariable('accountype');
        $data['ordertype'] = $this->siteVariables->getVariable('ordertype');
//echo "<pre>";print_r($data);die;
        $this->template->render('admintemplate', 'contents', 'admin/newaccount', $data);
    }

    public function editAccount() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        set_title('Welcome | ' . SITE_NAME);

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
        $data['admin_type'] = $admin_type;
        $data['ordertype'] = $this->siteVariables->getVariable('ordertype');
        $data['zonalmanager'] = $this->adminModel->where("admin_type", "zonalmanager")->get()->getResultArray();
        $data['accountype'] = $this->siteVariables->getVariable('accountype');

        $id = $this->request->getGet('id');
        if ($id) {
            $data['userid'] = $id;
            $data['adminDetails'] = $this->adminModel->where('id', $id)->first();
        } else {
            return redirect()->to(site_url('newaccount'));
        }
//print_r($data['adminDetails']);die;
        $this->template->render('admintemplate', 'contents', 'admin/editaccount', $data);
    }

    public function addAccount() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        // $session = session();

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');

        $fname = $this->request->getPost('firstname');
        $lname = $this->request->getPost('lastname');
        $password = $this->request->getPost('password');
        //$rep_password =$this->request->getPost('rep_password'); 
        $email = $this->request->getPost('email');
        $mobile = $this->request->getPost('mobilenumber');
        $user_unit_type = $this->request->getPost('user_unit_type');
        $zonalmanager = $this->request->getPost('zonalmanager');
        
        
        
        $password = $password ? $password : $mobile;
        if ($admin_type == "zonalmanager") {
            $user_type = "salesexecutive";
        } else {
            $user_type = $this->request->getPost('user_type');
        }

        
        if ($fname && $password  ) {
            $searchArray = array('txtsearch' => $email);

            $totalRecord = $this->adminModel->getData($searchArray, '', '', 1); // return count value

            if ($totalRecord < 1) {

                $arrSaveData = array(
                    'fname' => $fname,
                    'lname' => $lname,
                    'password' => password_hash($password, 1),
                    'email' => $email,
                    'phone' => $mobile,
                    'admin_type' => $user_type,
                    'created_by' => $admin_id,
                );
                if (in_array($user_type, array('productionunit', 'downloader', 'frontoffice', 'ccteam', 'printer'))) {
                    $arrSaveData['production_unit_type'] = $user_unit_type;
                }

                $this->adminModel->save($arrSaveData);
                $adminId = $this->adminModel->getInsertID();

                if ($adminId) {
                    $this->session->setFlashdata('message', 'Account created successfully.');
                } else {
                    $this->session->setFlashdata('errmessage', 'Account not created');
                }
            } else {
                $this->session->setFlashdata('errmessage', 'Email already exist');
            }
        } else {
            $this->session->setFlashdata('errmessage', 'Please provide all data');
        }

        return redirect()->to(site_url('newaccount'));
    }

    public function updateAccount() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        // $session = session();

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');

        $userid = $this->request->getPost('userid');

        if ($userid) {

            $fname = $this->request->getPost('firstname');
            $lname = $this->request->getPost('lastname');
            $password = $this->request->getPost('password');
            $rep_password = $this->request->getPost('rep_password');
            $email = $this->request->getPost('email');
            $mobile = $this->request->getPost('mobilenumber');
            $user_status = $this->request->getPost('user_status');
            $user_unit_type = $this->request->getPost('user_unit_type');
            $zonalmanager = $this->request->getPost('zonalmanager');
            
            //sales head can create sales executive
            if ($admin_type == "zonalmanager") {
                $user_type = "salesexecutive";
            } else if ($admin_type == "productionhead") { // production create production production unit only
                $user_type = "productionunit";
            } else {
                $user_type = $this->request->getPost('user_type');
            }
            

            if ($fname && $email && $mobile && $user_type) {
                $searchArray = array('txtsearch' => $email);
                $totalRecord = $this->adminModel->where("email", $email)->where("id !=", $userid)->first();

                if (!$totalRecord) {

                    $arrSaveData = array(
                        'fname' => $fname,
                        'lname' => $lname,
                        'email' => $email,
                        'phone' => $mobile,
                        'admin_type' => $user_type,
                        'admin_status' => $user_status,
                    );
                    
                    // if zonal manager change then update it
                    if($zonalmanager && $user_type == "salesexecutive")
                    {
                        $arrSaveData['created_by'] = $zonalmanager;
                    }
                    if ($password) {
                        $arrSaveData['password'] = password_hash($password, 1);
                    }
                    if ($user_type == 'productionunit') {
                        $arrSaveData['production_unit_type'] = $user_unit_type;
                    }

                    $this->adminModel->set($arrSaveData)->where('id', $userid)->update();
                    $this->session->setFlashdata('message', 'Account updated successfully.');
                } else {
                    $this->session->setFlashdata('errmessage', 'Email already exist');
                }
            } else {
                $this->session->setFlashdata('errmessage', 'Please provide all data');
            }
        } else {
            $this->session->setFlashdata('errmessage', 'Invalid access');
        }

        return redirect()->to(site_url('editaccount?id=' . $userid));
    }

    public function delAccount() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        $id = $this->request->getGet("id");
        $this->adminModel->where('id', $id)->delete();
        $this->session->setFlashdata('message', 'Account deleted succesfully.');

        return redirect()->to(site_url('sales'));
    }
    
    
    

    public function userslist() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        set_title('Welcome | ' . SITE_NAME);

        $usermodel = new UserModel();
        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');

        $data['customertype'] = $this->siteVariables->getVariable('customertype');
        $data['customerstatus'] = $this->siteVariables->getVariable('customerstatus');
        //if sales head then get data according to him
        $saleshead = "";
        $searchArray = array();
         
        $paginationnew = new \App\Libraries\Paginationnew();
        $txtsearch = $this->request->getGet('txtsearch');
        $user_type = $this->request->getGet('user_type');
        $user_itstatus = $this->request->getGet('user_itstatus');
        $user_status = $this->request->getGet('user_status');

        $data['txtsearch'] = $txtsearch;
        $data['user_type'] = $user_type;
        $data['admin_type'] = $admin_type;
        $data['user_itstatus'] = $user_itstatus;
        $data['user_status'] = $user_status;
        if ($txtsearch) {
            $searchArray['txtsearch'] = $txtsearch;
        }
        if ($user_type) {
            $searchArray['user_type'] = $user_type;
        }
        if ($user_status || $user_status==='0') {
            $searchArray['user_status'] = $user_status;
        }

        $searchArray['sort_by'] ='companyname';

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $usermodel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['pagination'] = $pagination;
        $data["usersData"] = $usermodel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArray;

        $this->template->render('admintemplate', 'contents', 'admin/users/userlist', $data);
    }

    public function newUser() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        set_title('Welcome | ' . SITE_NAME);

        $userModel = new UserModel();
        $objState = new \App\Models\StateModel();
        $objCity = new \App\Models\CitiesModel();
        $objDistrics = new \App\Models\DistricsModel();
        $admin_id = $this->session->get('admin_id');

        $data = array();
        $admin_type = $this->session->get('admin_type');
        $data['admin_type'] = $admin_type;
        
        // print_r($data);die;
        $this->template->render('admintemplate', 'contents', 'admin/users/newaccount', $data);
    }

    public function editUser() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        // $session = session();

        $id = $this->request->getGet("id");

        if (!$id) {
            $this->session->setFlashdata('errmessage', 'User ID number doesnot exist! Please try again.');

            return redirect()->to(site_url('users'));
        }
        set_title('Welcome | ' . SITE_NAME);
        $data = array();
        $userModel = new UserModel();
        $objState = new \App\Models\StateModel();
        $objCity = new \App\Models\CitiesModel();
        $objDistrics = new \App\Models\DistricsModel();

        //get user details
        $data['userid'] = $id;
        $userdetails = $userModel->where('id', $id)->first();
        $data['userdetails'] = $userdetails;
//        dd( $data);


        $admin_type = $this->session->get('admin_type');
        $data['admin_type'] = $admin_type;
       

        if (!$data) {
            $this->session->setFlashdata('errmessage', 'Customer does not exist!');
            return redirect()->to(site_url('userlist'));
        }
        // echo "<pre>";print_r($array[0]); die();
        $this->template->render('admintemplate', 'contents', 'admin/users/editaccount', $data);
    }

    public function viewUser() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        // $session = session();

        $id = $this->request->getGet("id");

        if (!$id) {
            $this->session->setFlashdata('errmessage', 'User ID number doesnot exist! Please try again.');

            return redirect()->to(site_url('users'));
        }
        set_title('Welcome | ' . SITE_NAME);

        $data = array();

        $userModel = new UserModel();
       
        $userdetails = $userModel->getData(array('id' => $id));
        // print_r($userdetails);die;
        $userdetails = $userdetails ? $userdetails[0] : array();
        $data['userdetails'] = $userdetails;

        //echo "<pre>"; print_r($userdetails);die;
        $admin_type = $this->session->get('admin_type');
        $data['admin_type'] = $admin_type;
       
        $data['userid'] = $id;

        if (!$data) {
            $this->session->setFlashdata('errmessage', 'Customer does not exist!');
            return redirect()->to(site_url('userlist'));
        }
        // echo "<pre>";print_r($array[0]); die();
        $this->template->render('admintemplate', 'contents', 'admin/users/viewaccount', $data);
    }

   

    public function addUser() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        // $session = session();

        $userModel = new UserModel();

        $companyname = $this->request->getPost('companyname');
        $fname = $this->request->getPost('firstname');
        $lname = $this->request->getPost('lastname');
       
        $email = $this->request->getPost('email');
        $mobile = $this->request->getPost('mobilenumber');
        $address = $this->request->getPost('address');
        $pincode = $this->request->getPost('pincode');
       
        $gstnumber = $this->request->getPost('gstnumber');
        $pannumber = $this->request->getPost('pannumber');
        

        $admin_id = $this->session->get("admin_id");

        if ($companyname && $fname ) {
            $searchArray = array('txtsearch' => $email);

            $totalRecord = $userModel->where(['fname' => $fname])
                    ->countAllResults();

            if ($totalRecord < 1) {

                // upload documents
                $gstdoc = $this->request->getFile('gstdoc');
                $pandoc = $this->request->getFile('pandoc');
                $pandocnewName = "";
                $gstdocnewName = "";
                if ($gstdoc != "") {
                    $gstdocnewName = $gstdoc->getRandomName();
                    $gstdoc->move(FCPATH . 'userdoc', $gstdocnewName);
                }
                if ($pandoc != "") {
                    $pandocnewName = $pandoc->getRandomName();
                    $pandoc->move(FCPATH . 'userdoc', $pandocnewName);
                }
                
               

                $arrSaveData = array(
                    'companyname' => $companyname,
                    'fname' => $fname,
                    'lname' => $lname,
               
                    'email' => $email,
                    'phone' => $mobile,
                    'address' => $address,
                    'pincode' => $pincode,
                
                    'user_type' => $user_type,
                    'adminid' => $admin_id,
                    'user_status' => "1",
                    'idproof' => $pannumber,
                    'gst_number' => $gstnumber,
                    'paynow_status' => $paynow,
                );

                // pancard doc
//                if ($pandocnewName) {
//                    $arrSaveData['idproof_doc'] = $pandocnewName;
//                }
//                // gst doc
//                if ($gstdocnewName) {
//                    $arrSaveData['gst_doc'] = $gstdocnewName;
//                }
                
//                if($user_type =="channelpartnerstudio")
//                {
//                    $arrSaveData['user_status'] = '1';
//                    $arrSaveData['it_status'] = 'accepted';
//                }
               // print_r($arrSaveData);die;

                $userModel->save($arrSaveData);
                $adminId = $userModel->getInsertID();
                if ($adminId) {
                    $this->session->setFlashdata('message', 'Account created successfully.');
                } else {
                    $this->session->setFlashdata('errmessage', 'Account not created');
                }
            } else {
                $this->session->setFlashdata('errmessage', 'Account already exist');
            }
        } else {
            $this->session->setFlashdata('errmessage', 'Please provide all data');
        }

        return redirect()->to(site_url('users'));
    }

    public function updateUser() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        // $session = session();


        $id = $this->request->getPost('userid');

        if (!$id) {
            $this->session->setFlashdata('errmessage', 'Customer does not exist!');

            return redirect()->to(site_url('users'));
        }

        $companyname = $this->request->getPost('companyname');
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
       // $password = $this->request->getPost('password');
        $email = $this->request->getPost('email');
        $mobile = $this->request->getPost('mobilenumber');
     //   $user_type = $this->request->getPost('user_type');
        $user_status = $this->request->getPost('user_status');
        $address = $this->request->getPost('address');
        $pincode = $this->request->getPost('pincode');
//        $state = $this->request->getPost('state');
//        $city = $this->request->getPost('city');
//        $district = $this->request->getPost('district');
        $gstnumber = $this->request->getPost('gstnumber');
        $pannumber = $this->request->getPost('pannumber');
//        $paynow = $this->request->getPost('paynow');

//        $user_type = $user_type ? $user_type : 'studio';
//        $channelpartner = ($user_type == 'channelpartnerstudio') ? $this->request->getPost('channelpartner') : 0;
//        $partnerlevel = ($user_type != 'studio') ? $this->request->getPost('partnerlevel') : '';

        // upload documents
        $gstdoc = $this->request->getFile('gstdoc');
        $pandoc = $this->request->getFile('pandoc');

        $pandocnewName = "";
        $gstdocnewName = "";
        if ($gstdoc != "") {
            $gstdocnewName = $gstdoc->getName();
            $gstdoc->move(FCPATH . 'userdoc', $gstdocnewName);
            $gstdocnewName = $gstdoc->getName(); // after upload file name
        }
        if ($pandoc != "") {
            $pandocnewName = $pandoc->getName();
            $pandoc->move(FCPATH . 'userdoc', $pandocnewName);
            $pandocnewName = $pandoc->getName();
        }


        $userModel = new UserModel();

        $arrResult = $userModel->where('id!=', $id)
                ->where(['fname' => $firstname])
                ->countAllResults();

        if ($arrResult) {

            $this->session->setFlashdata('errmessage', 'Mobile no already exists! Please try a different Mobile no.');

            return redirect()->to(site_url('edituser?id=' . $id));
        } else {

            $arrSaveData = array(
                'companyname' => $companyname,
                'fname' => $firstname,
                'lname' => $lastname,
                'email' => $email,
                'phone' => $mobile,
                'address' => $address,
                'pincode' => $pincode,
//                'channelpartnerid' => $channelpartner,
//                'partner_type' => $partnerlevel,
//                'stateid' => $state,
//                'districid' => $district,
//                'cityid' => $city,
//                'user_type' => $user_type,
                'idproof' => $pannumber,
                'gst_number' => $gstnumber,
//                'paynow_status' => $paynow,
            );

            //if user status then update it
            if (isset($user_status)) {
                $arrSaveData['user_status'] = $user_status;
            }

           
            // pancard doc
//            if ($pandocnewName) {
//                $arrSaveData['idproof_doc'] = $pandocnewName;
//            }
//            // gst doc
//            if ($gstdocnewName) {
//                $arrSaveData['gst_doc'] = $gstdocnewName;
//            }



            $Update = $userModel->where('id', $id)->set($arrSaveData)->update();
        
            if ($Update) {

                $this->session->setFlashdata('message', 'Details updated succesfully.');

                return redirect()->to(site_url('edituser?id=' . $id));
            } else {

                $this->session->setFlashdata('errmessage', 'Something Went Wrong! Try Again.');

                return redirect()->to("users");
            }
        }
    }

    public function delUser() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        // $session = session();

        $isAdminLoggedIn = $this->session->get('isAdminLoggedIn');

        $id = $this->request->getGet("id");

        $userModel = new UserModel();

        if ($isAdminLoggedIn) {
            $userModel->where('id', $id)->delete();

            $this->session->setFlashdata('message', 'Account deleted succesfully.');
        } else {
            $this->session->setFlashdata('errmessage', 'Invalid access.');
        }
        return redirect()->to(site_url('users'));
    }

    public function deluserfile() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        // $session = session();
        $response = array("status" => false, "message" => "");
        $isAdminLoggedIn = $this->session->get('isAdminLoggedIn');

        $id = $this->request->getGet("id");
        $filetype = $this->request->getGet("filetype");

        $userModel = new UserModel();

        if ($isAdminLoggedIn) {
            $userDetail = $userModel->where('id', $id)->first();

            if ($userDetail) {
                $updatedata = array();
                if ($filetype == "idproof") {
                    $filepath = FCPATH . 'userdoc/' . $userDetail["idproof_doc"];
                    $updatedata['idproof_doc'] = "";
                } else {
                    $filepath = FCPATH . 'userdoc/' . $userDetail["gst_doc"];
                    $updatedata['gst_doc'] = "";
                }
                $userModel->set($updatedata)->where('id', $id)->update();
                unlink($filepath);
                $response["status"] = true;
                $response["message"] = "File Deleted";
            } else {
                $response["message"] = "File not exist";
            }


            // $this->session->setFlashdata('message', 'Account deleted succesfully.');
        } else {
            $response["message"] = "You are not permited";
        }

        echo json_encode($response);

        die;
    }

    public function getCity() {

        $response = array("status" => false, "message" => "");
        $isAdminLoggedIn = $this->session->get('isAdminLoggedIn');

        $stid = $this->request->getGet("stid");
        $district = ''; // $this->request->getGet("district");
        $objCity = new \App\Models\CitiesModel();

        if ($district) {
            $objCity->where('ct_disticid', $district);
        }

        $cityArray = $objCity->getData(array('stateid' => $stid));

        if ($cityArray) {
            $response["cities"] = $cityArray;
            $response["status"] = true;
            $response["message"] = "Successfully";
        } else {
            $response["message"] = "No cities found";
        }



        echo json_encode($response);

        die;
    }

    public function getDistric() {

        $response = array("status" => false, "message" => "");
        $isAdminLoggedIn = $this->session->get('isAdminLoggedIn');

        $stid = $this->request->getGet("stid");

        $objDistrics = new \App\Models\DistricsModel();

        $districArray = $objDistrics->getData(array('stateid' => $stid));

        if ($districArray) {
            $response["districs"] = $districArray;
            $response["status"] = true;
            $response["message"] = "Successfully";
        } else {
            $response["message"] = "No disctric found";
        }



        echo json_encode($response);

        die;
    }

    public function adminenquiry() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        set_title('Welcome | ' . SITE_NAME);

        $enquiryModel = new \App\Models\EnquiryModel();

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');

        $data['pagetitle'] = "Enquiry List";
        $data['action'] = "adminenquiry";

        $txtsearch = $this->request->getGet('txtsearch');
        $searchArray = array();
        $paginationnew = new Paginationnew();

        if ($txtsearch) {
            $searchArray['txtsearch'] = $txtsearch;
        }
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $enquiryModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["salesData"] = $enquiryModel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArray;

        $this->template->render('admintemplate', 'contents', 'admin/enquiry', $data);
    }

    public function delEnquiry() {
        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }
        $enquiryModel = new \App\Models\EnquiryModel();
        $id = $this->request->getGet("id");
        $enquiryModel->where('en_id', $id)->delete();
        $this->session->setFlashdata('message', 'Enquiry deleted succesfully.');

        return redirect()->to(site_url('adminenquiry'));
    }

    public function customerexportexcel() {

        $usermodel = new UserModel();
        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');

        $txtsearch = $this->request->getGet('txtsearch');
       

        $data['txtsearch'] = $txtsearch;
        $data['user_type'] = $user_type;
        $data['admin_type'] = $admin_type;
        if ($txtsearch) {
            $searchArray['txtsearch'] = $txtsearch;
        }
        
        $totalRecord = $usermodel->getData($searchArray, '', '', 1); // return count value

        $startLimit = 0;
        $Limit = $totalRecord;
        $usersData = $usermodel->getData($searchArray, $startLimit, $Limit);

        //echo "<pre>"; print_r($usersData);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $cellrow = 1;

        // column heading
        $sheet->setCellValue('A' . $cellrow, "Comapany Name");
        $sheet->setCellValue('B' . $cellrow, "Name");
        $sheet->setCellValue('C' . $cellrow, "Mobile");
        $sheet->setCellValue('D' . $cellrow, "Email");
        $sheet->setCellValue('E' . $cellrow, "Address");
        $sheet->setCellValue('F' . $cellrow, "Pincode");
        $sheet->setCellValue('G' . $cellrow, "Created Date");
        $j = 1;
        for ($i = 0; $i < $totalRecord; $i++) {
            $j = $j + 1;
            $sheet->setCellValue('A' . $j, $usersData[$i]->companyname);
            $sheet->setCellValue('B' . $j, $usersData[$i]->fname);
            $sheet->setCellValue('C' . $j, $usersData[$i]->phone);
            $sheet->setCellValue('D' . $j, $usersData[$i]->email);
            $sheet->setCellValue('E' . $j, $usersData[$i]->address);
            $sheet->setCellValue('F' . $j, $usersData[$i]->pincode);
            $sheet->setCellValue('G' . $j, $usersData[$i]->user_created);
        }
        $fileName = 'customerslist_' . date('d-m-y') . ".xlsx";

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');

        $writer->save('php://output');
        die;
    }

    public function usersexportexcel() {

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
        $arraccountype = $this->siteVariables->getVariable('accountype');
        //if sales head then get data according to him
        $saleshead = "";
        if ($admin_type == "saleshead") {
            //	$saleshead = $admin_id;
        }

        $txtsearch = $this->request->getGet('txtsearch');
        $user_type = $this->request->getGet('user_type');
        $searchArray = array();

        $searchArray['saleshead'] = $saleshead;

        if ($user_type) {
            $searchArray["user_type"] = $user_type;
        }

        if ($txtsearch) {
            $searchArray['txtsearch'] = $txtsearch;
        }

        $totalRecord = $this->adminModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = 0;
        $Limit = $totalRecord;
        $usersData = $this->adminModel->getData($searchArray, $startLimit, $Limit);

        // echo "<pre>"; print_r($usersData);die;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $cellrow = 1;

        // column heading
        $sheet->setCellValue('A' . $cellrow, "Name");
        $sheet->setCellValue('B' . $cellrow, "Email");
        $sheet->setCellValue('C' . $cellrow, "Mobile");
        $sheet->setCellValue('D' . $cellrow, "Role");
        $j = 1;
        for ($i = 0; $i < $totalRecord; $i++) {
            $j = $j + 1;
            $role = isset($arraccountype[$usersData[$i]->admin_type]) ? $arraccountype[$usersData[$i]->admin_type] : '';
            $sheet->setCellValue('A' . $j, $usersData[$i]->fname);
            $sheet->setCellValue('B' . $j, $usersData[$i]->email);
            $sheet->setCellValue('C' . $j, $usersData[$i]->phone);
            $sheet->setCellValue('D' . $j, $role);
        }
        $fileName = 'userslist_' . date('d-m-y') . ".xlsx";
        // $outputFileName = FCPATH.'download_excel/'.$fileName;

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        die;
    }

    public function enquiryexportexcel() {

        $enquiryModel = new \App\Models\EnquiryModel();

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');

        $txtsearch = $this->request->getGet('txtsearch');
        $searchArray = array();

        if ($txtsearch) {
            $searchArray['txtsearch'] = $txtsearch;
        }

        $totalRecord = $enquiryModel->getData($searchArray, '', '', 1); // return count value
        $startLimit = 0;
        $Limit = $totalRecord;

        $enquieryData = $enquiryModel->getData($searchArray, $startLimit, $Limit);

        //    echo "<pre>"; print_r($enquieryData);die;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $cellrow = 1;

        // column heading
        $sheet->setCellValue('A' . $cellrow, "Studio Name");
        $sheet->setCellValue('B' . $cellrow, "Mobile");
        $sheet->setCellValue('C' . $cellrow, "State");
        $sheet->setCellValue('D' . $cellrow, "Description");
        $sheet->setCellValue('E' . $cellrow, "Date");
        $j = 1;
        for ($i = 0; $i < $totalRecord; $i++) {
            $j = $j + 1;

            $sheet->setCellValue('A' . $j, $enquieryData[$i]->en_studioname);
            $sheet->setCellValue('B' . $j, $enquieryData[$i]->en_mobile);
            $sheet->setCellValue('C' . $j, $enquieryData[$i]->st_name);
            $sheet->setCellValue('D' . $j, $enquieryData[$i]->en_description);
            $sheet->setCellValue('E' . $j, $enquieryData[$i]->en_date);
        }
        $fileName = 'Enquirylist_' . date('d-m-y') . ".xlsx";
        $outputFileName = FCPATH . 'download_excel/' . $fileName;

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        die;
    }

}
