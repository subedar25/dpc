<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Session\Session;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\CategoryModel;

#[\AllowDynamicProperties]
class Admin extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;

    public function __construct() {

        $this->session = session();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
    }

    public function index() {

        //$session = session();

        $isAdminLoggedIn = $this->session->get('isAdminLoggedIn');

        if ($isAdminLoggedIn) {

            return redirect()->to(site_url('dashboard'));
        }
        $data = array();

        if (isset($_COOKIE['adminremember'])) {

            $data['adminremember'] = $_COOKIE['adminremember'];
            $data['cameronadmin'] = $_COOKIE['cameronadmin'];
            $data['cameronadminpass'] = $_COOKIE['cameronadminpass'];
        }
        $method = $this->request->getMethod();

        $adminModel = new AdminModel();

        if ($method == 'POST') {

            $username = $this->request->getPost('username');

            $password = $this->request->getPost('password');
            $adminremember = $this->request->getPost('adminremember');

            if ($username != '' && $password != '') {

                $return = $adminModel->checkAdminLogin($username, $password);
                if ($return == 2) {
                    $this->session->setFlashdata('errmessage', 'Your account is not active');
                } else if ($return) {
                    //set cookie for login
                    if ($adminremember) {

                        setcookie('adminremember', $adminremember, strtotime('+1 year'), '/');
                        setcookie('cameronadmin', $username, strtotime('+1 year'), '/');
                        setcookie('cameronadminpass', $password, strtotime('+1 year'), '/');
                    } else {
                        setcookie('adminremember', $adminremember, time() - 3600, '/');
                        setcookie('cameronadmin', $username, time() - 3600, '/');
                        setcookie('cameronadminpass', $password, time() - 3600, '/');
                    }

                    return redirect()->to(site_url('dashboard'));
                } else {
                    $this->session->setFlashdata('errmessage', 'Invalid Email / Password');
                }
            } else {

                $this->session->setFlashdata('errmessage', 'Invalid Email / Password');
            }
        }

        $this->template->render('admintemplate', 'contents', 'admin/loginTpl', $data);
    }

   

    public function dashboard() {
        //print_r( $this->session->get() );
        $arrVeiwcontent = array('errorMsg' => '');
     
        $userModel = new UserModel();
        $companyModel = new CategoryModel();
      
        if (!$this->isAdminLoggedIn) {

            return redirect()->to(site_url('admin'));
        }
        
        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
        
        $admindashbaord = 'admin/dashboard';
        
        if($admin_type =="subowner")
        {
            $admindashbaord = 'admin/owners/dashboard';
        }
        
         $arrVeiwcontent['companycount'] = $companyModel->getData("", '', '', 1);
         $arrVeiwcontent['userscount'] = $userModel->getData("", '', '', 1);
         
         

        $this->template->render('admintemplate', 'contents', $admindashbaord, $arrVeiwcontent);
    }

    public function logout() {
        //$session = session();
        $adminSession = array('admin_id', 'admin_email', 'admin_name', 'isAdminLoggedIn', 'admin_type', 'adminLoggedIn');
        $this->session->remove($adminSession);
        return redirect()->to(site_url('admin'));
    }

}
