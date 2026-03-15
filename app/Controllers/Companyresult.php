<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\CompanyModel;
use CodeIgniter\Session\Session;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

#[\AllowDynamicProperties]
class Companyresult extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;
    protected $adminModel;

    public function __construct() {
        $this->session = session();
        $this->siteVariables = new SiteVariables();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
        $this->CompanyModel = new CompanyModel();
    }

    public function index() {

        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        set_title('Welcome | ' . SITE_NAME);

        $adminType = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
        $searchArray = array();
        $searchArrayQrrString = array();
        
        $data['pagetitle'] = "Today Result";
        $data['action'] = "todayresult";
        
        $txtsearch = $this->request->getGet('txtsearch');
        $result_mode = $this->request->getGet('result_mode');
        $fromdate = $this->request->getGet('fromdate');
        $todate =  $this->request->getGet('todate');
        
        if(!($fromdate && $todate)){
         $fromdate =date("Y-m-d"); 
         $todate = date("Y-m-d"); 
        }
        
        $data['fromdate'] = $fromdate;
        $data['todate'] = $todate;
       
        
        if($adminType =="subowner")
        {
            $searchArray['ownerid'] = $admin_id;
        }
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
        $searchArray['sort_by'] ="com_starttime";
        $paginationnew = new Paginationnew();

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $this->CompanyModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['result_mode'] = $result_mode;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["resultData"] = $this->CompanyModel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArrayQrrString;

        $this->template->render('admintemplate', 'contents', 'admin/company/todayresult', $data);
    }

    
    public function editresultform() {
        $data = array();
       
        $orderModel = new CompanyModel();
        $resultid = $this->request->getGet('oid');
        
        $data['resultid'] = $resultid;
        
        $ordersearchArray = array("comid" => $resultid);
        $orderDetails = $orderModel->getData($ordersearchArray, 0, 1);
        $data['orderDetails'] = isset($orderDetails[0]) ? $orderDetails[0] : array();
       

        echo view('admin/company/_editresultform', $data);
    }
    
     public function updatresult() {
        $session = session();
        $formdata = array();
        $response = array("status" => false, "error" => "", "message" => '', "data" => "");
        $formdata = $this->request->getPost();
        
        $orderData = array(
            "com_open"=>$formdata['com_open'],
            "com_mid"=>$formdata['com_mid'],
            "com_close"=>$formdata['com_close'],
            "com_desc"=>$formdata['com_desc'],
            'com_lastupdate'=>date('H:i')
        );
        
        
      
        if($formdata['com_id'])
        {
            $orderModel = new CompanyModel();
            $orderModel->set($orderData)->where("com_id",$formdata['com_id'])->update();
            
          //  echo $this->adminModel->getInsertID();
        }
      
        $response['status'] = 201;
        $response['message'] = "Updated successfully";
        echo json_encode($response);
    }
    
    
    
   
    
    public function delresult() {
        
        $orderModel = new CompanyModel();
         $id = $this->request->getGet("id");
        $orderModel->where('com_id', $id)->delete();
        $this->session->setFlashdata('message', 'Result deleted succesfully.');

        return redirect()->to(site_url('todayresult'));
    }


}
