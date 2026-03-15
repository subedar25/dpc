<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\CompanymulModel;
use App\Models\CompanymulhistoryModel;
use CodeIgniter\Session\Session;
use App\Libraries\Paginationnew;
use App\Libraries\SiteVariables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

#[\AllowDynamicProperties]
class Companymultiple extends BaseController {

    protected $session;
    protected $isAdminLoggedIn;
    protected $adminModel;

    public function __construct() {
        $this->session = session();
        $this->siteVariables = new SiteVariables();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
        $this->CompanymulModel = new CompanymulModel();
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
        $data['action'] = "multipleresult";
        
        $txtsearch = $this->request->getGet('txtsearch');
        $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');
        
        $fromdate = $fromdate ? $fromdate : date("Y-m-d");  
        $todate = $todate ? $todate : date("Y-m-d"); 
        
        $data['fromdate'] = $fromdate;
        $data['todate'] = $todate;
        $data['showdate'] = 0;
       
        if($adminType =="subowner")
        { 
            $searchArray['ownerid'] = $admin_id;
        }
        if ($txtsearch) {
            $searchArrayQrrString['txtsearch'] = $searchArray['txtsearch'] = $txtsearch;
        }
        
        if ($fromdate) {
            $searchArrayQrrString['fromdate'] = $searchArray['fromdate'] = $fromdate;
        }
        if ($todate) {
            $searchArrayQrrString['todate'] = $searchArray['todate'] = $todate;
        }
        
        $paginationnew = new Paginationnew();

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $this->CompanymulModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["resultData"] = $this->CompanymulModel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArrayQrrString;

        $this->template->render('admintemplate', 'contents', 'admin/companymul/todayresult', $data);
    }
    
    
    public function mulhistory() {

        if (!$this->isAdminLoggedIn) {
            return redirect()->to(site_url('admin'));
        }

        set_title('Welcome | ' . SITE_NAME);

        
        $searchArray = array();
        $searchArrayQrrString = array();
        
        $data['pagetitle'] = "Multiple Company Result History";
        $data['action'] = "mulhistory";
        
        $txtsearch = $this->request->getGet('txtsearch');
         $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');
        
        $data['fromdate'] = $fromdate;
        $data['todate'] = $todate;
       $data['showdate'] = 1;
        if ($txtsearch) {
            $searchArrayQrrString['txtsearch'] = $searchArray['txtsearch'] = $txtsearch;
        }
        
        if ($fromdate) {
            $searchArrayQrrString['fromdate'] = $searchArray['fromdate'] = $fromdate;
        }
        if ($todate) {
            $searchArrayQrrString['todate'] = $searchArray['todate'] = $todate;
        }
        
        $companymulhistoryModel = new CompanymulhistoryModel();
        $paginationnew = new Paginationnew();

        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = PER_PAGE_RECORD;
        $totalRecord = $companymulhistoryModel->getData($searchArray, '', '', 1); // return count value

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);
        $data['txtsearch'] = $txtsearch;
        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;
        $data["resultData"] = $companymulhistoryModel->getData($searchArray, $startLimit, $Limit);
        $data["searchArray"] = $searchArrayQrrString;

        $this->template->render('admintemplate', 'contents', 'admin/companymul/listhistory', $data);
    }

    
    public function editmulresultform() {
        $data = array();
       
        $orderModel = new CompanymulModel();
        $resultid = $this->request->getGet('oid');
       
        $data['resultid'] = $resultid;
        
        $ordersearchArray = array("comid" => $resultid);
        $orderDetails = $orderModel->getData($ordersearchArray, 0, 1);
        $data['orderDetails'] = isset($orderDetails[0]) ? $orderDetails[0] : array();
       

        echo view('admin/companymul/_editresultform', $data);
    }
    
     public function updatmulresult() {
        $session = session();
        $formdata = array();
        $response = array("status" => false, "error" => "", "message" => '', "data" => "");
        $formdata = $this->request->getPost();
        
        $orderData = array(
            "com_open"=>$formdata['com_open'],
            "com_mid"=>$formdata['com_mid'],
            "com_close"=>$formdata['com_close'],
            "com_desc"=>$formdata['com_desc'],
        );
        
        
      
        if($formdata['com_id'])
        {
            $orderModel = new CompanymulModel();
            $orderModel->set($orderData)->where("com_id",$formdata['com_id'])->update();
            
          //  echo $this->adminModel->getInsertID();
        }
      
        $response['status'] = 201;
        $response['message'] = "Updated successfully";
        echo json_encode($response);
    }
    
    
    
    public function delmulresult() {
        
        $orderModel = new CompanymulModel();
         $id = $this->request->getGet("id");
        $orderModel->where('com_id', $id)->delete();
        $this->session->setFlashdata('message', 'Result deleted succesfully.');

        return redirect()->to(site_url('multipleresult'));
    }
    
    public function delmulhistoryresult() {
        
        $orderModel = new CompanymulhistoryModel();
         $id = $this->request->getGet("id");
        $orderModel->where('com_id', $id)->delete();
        $this->session->setFlashdata('message', 'Result deleted succesfully.');

        return redirect()->to(site_url('mulhistory'));
    }


}
