<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\CategoryModel;
use CodeIgniter\Session\Session;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;

#[\AllowDynamicProperties]
class Category extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;
    protected $adminModel;

    public function __construct() {
        $this->session = session();
        $this->siteVariables = new SiteVariables();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
        $this->CategoryModel = new CategoryModel();
    }

    public function index() {

        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        set_title('Welcome | ' . SITE_NAME);

        
        $searchArray = array();
        $searchArrayQrrString = array();
        
        $data['pagetitle'] = "Company List";
        $data['action'] = "company";
        
        $txtsearch = $this->request->getGet('txtsearch');
        $result_mode = $this->request->getGet('result_mode');
         $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');
        
        $data['fromdate'] = $fromdate;
        $data['todate'] = $todate;
       
        if ($txtsearch) {
            $searchArrayQrrString['txtsearch'] = $searchArray['txtsearch'] = $txtsearch;
        }
        if ($result_mode) {
            $searchArrayQrrString['result_mode'] = $searchArray['result_mode'] = $result_mode;
        }
        
        if ($fromdate) {
            $searchArrayQrrString['fromdate'] = $searchArray['fromdate'] = $fromdate;
        }
        if ($todate) {
            $searchArrayQrrString['todate'] = $searchArray['todate'] = $todate;
        }
        
        $searchArray['result_type'] ="single";
        $paginationnew = new Paginationnew();

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $this->CategoryModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['result_mode'] = $result_mode;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["resultData"] = $this->CategoryModel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArrayQrrString;

        $this->template->render('admintemplate', 'contents', 'admin/category/listcompany', $data);
    }
    
    
    public function companymul() {

        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        set_title('Welcome | ' . SITE_NAME);

        
        $searchArray = array();
        $searchArrayQrrString = array();
        
        $data['pagetitle'] = "Multiple Company List";
        $data['action'] = "companymul";
        
        $txtsearch = $this->request->getGet('txtsearch');
        $result_mode = $this->request->getGet('result_mode');
         $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');
        
        $data['fromdate'] = $fromdate;
        $data['todate'] = $todate;
       
        if ($txtsearch) {
            $searchArrayQrrString['txtsearch'] = $searchArray['txtsearch'] = $txtsearch;
        }
        if ($result_mode) {
            $searchArrayQrrString['result_mode'] = $searchArray['result_mode'] = $result_mode;
        }
        
        if ($fromdate) {
            $searchArrayQrrString['fromdate'] = $searchArray['fromdate'] = $fromdate;
        }
        if ($todate) {
            $searchArrayQrrString['todate'] = $searchArray['todate'] = $todate;
        }
        $searchArray['result_type'] ="multiple";
        $paginationnew = new Paginationnew();

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $this->CategoryModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['result_mode'] = $result_mode;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["resultData"] = $this->CategoryModel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArrayQrrString;

        $this->template->render('admintemplate', 'contents', 'admin/category/listmulcompany', $data);
    }

    
    public function editcategoryform() {
        $data = array();
       
        $orderModel = new CategoryModel();
         $resultid = $this->request->getGet('oid');
        
        $data['resultid'] = $resultid;
        
        $ordersearchArray = array("id" => $resultid);
        $orderDetails = $orderModel->getData($ordersearchArray, 0, 1);
        $data['orderDetails'] = isset($orderDetails[0]) ? $orderDetails[0] : array();
       

        echo view('admin/category/_editcategoryform', $data);
    }
    
     public function updatcompany() {
        $session = session();
        $formdata = array();
        $response = array("status" => false, "error" => "", "message" => '', "data" => "");
        $formdata = $this->request->getPost();
        $working = (isset($formdata['workingday']) && $formdata['workingday']) ? implode(",", $formdata['workingday']) : "";
        $companyName = isset($formdata['com_name']) ? trim($formdata['com_name']) : '';

        if ($companyName) {
            $duplicateCount = $this->CategoryModel
                ->where('name', $companyName)
                ->where('id !=', $formdata['com_id'])
                ->countAllResults();

            if ($duplicateCount > 0) {
                $response['status'] = 400;
                $response['message'] = "Company name already exists";
                echo json_encode($response);
                return;
            }
        }
        $orderData = array(
            "name"=>$companyName,
            "start_time"=>$formdata['start_hr'].":".$formdata['start_min'],
            "end_time"=>$formdata['end_hr'].":".$formdata['end_min'],
            "description"=>$formdata['com_desc'],
            "com_interval"=>$formdata['txtinterval'],
            "result_type"=>$formdata['txtResulttype'],
            "result_mode"=>isset($formdata['result_mode']) ? $formdata['result_mode'] : "manual",
            "status"=>$formdata['txtStatus'],
            "com_showresult"=>$formdata['showresult'],
            "com_working"=>$working,
            "com_order"=>isset($formdata['com_order']) ? $formdata['com_order'] :0,
            "bg_color"=>isset($formdata['bg_color']) ? $formdata['bg_color'] : '',
        );
        
        
      
        if($formdata['com_id'])
        {
            $orderModel = new CategoryModel();
            $orderModel->set($orderData)->where("id",$formdata['com_id'])->update();
            
          //  echo $this->adminModel->getInsertID();
        }
      
        $response['status'] = 201;
        $response['message'] = "Updated successfully";
        echo json_encode($response);
    }
    
    public function addcompany() {
        $session = session();
        $formdata = array();
        $response = array("status" => false, "error" => "", "message" => '', "data" => "");
        $formdata = $this->request->getPost();
        $working = (isset($formdata['workingday']) && $formdata['workingday']) ? implode(",", $formdata['workingday']) : "";
        $companyName = isset($formdata['com_name']) ? trim($formdata['com_name']) : '';

        if ($companyName) {
            $duplicateCount = $this->CategoryModel
                ->where('name', $companyName)
                ->countAllResults();

            if ($duplicateCount > 0) {
                $response['status'] = 400;
                $response['message'] = "Company name already exists";
                echo json_encode($response);
                return;
            }
        }
        $orderData = array(
            "name"=>$companyName,
            "start_time"=>$formdata['start_hr'].":".$formdata['start_min'],
            "end_time"=>$formdata['end_hr'].":".$formdata['end_min'],
            "description"=>$formdata['com_desc'],
            "com_interval"=>$formdata['txtinterval'],
            "result_type"=>$formdata['txtResulttype'],
            "result_mode"=>isset($formdata['result_mode']) ? $formdata['result_mode'] : "manual",
            "status"=>$formdata['txtStatus'],
            "com_showresult"=>$formdata['showresult'],
            "com_working"=>$working,
            "com_order"=>isset($formdata['com_order']) ? $formdata['com_order'] : 0,
            "bg_color"=>isset($formdata['bg_color']) ? $formdata['bg_color'] : '',
        );
        
        
      
       
            $orderModel = new CategoryModel();
            $orderModel->save($orderData);
      
        $response['status'] = 201;
        $response['message'] = "Created successfully";
        echo json_encode($response);
    }
    
    
    
    public function delcategory() {
        
        $orderModel = new CategoryModel();
         $id = $this->request->getGet("id");
        $orderModel->where('id', $id)->delete();
        $this->session->setFlashdata('message', 'Company deleted succesfully.');

        return redirect()->to(site_url('company'));
    }


}
