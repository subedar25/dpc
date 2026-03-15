<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\CompanyModel;
use App\Models\CategoryModel;
use App\Models\CompanymulModel;
use App\Models\CompanymulhistoryModel;
use App\Models\FamilychartModel;
use App\Libraries\Paginationnew;

#[\AllowDynamicProperties]
class UserController extends BaseController
{

  protected $session;
  protected $isUserLoggedIn;

  public function __construct()
  {
    $this->session = session();
    $this->isUserLoggedIn = $this->session->get('isUserLoggedIn');
  }

  public function index()
  {
    set_title('Welcome | ' . SITE_NAME);
    $setting = new SettingsModel();
    $settingData = $setting->getNameValuepair();

    $categoryModel = new CategoryModel();
    $companyModel = new CompanyModel();
    $companyMulModel = new CompanymulhistoryModel();
    $todayresult = $companyModel->getTodayResult();
    $liveresultData = $companyModel->getLiveResult();
    $allMultipleCompany = $categoryModel->getData(array('result_type' => "multiple","sort_by"=>"com_order"));

    $keywords = "";
    $description = "";

    foreach ($todayresult as $deails) {
      $keywords .= $deails['name'] . ", ";
      $description .= $deails['name'] . " | ";
    }
    $metatag = array('keywords' => '', 'description' => '', 'content' => '');
    $metatag['keywords'] .= $keywords;
    $metatag['description'] .= $description;
    $metatag['content'] .= $description;

    set_metas($metatag);

    //        print_r($todayresult);die;
    $data = array();
    $data['settingData'] = $settingData;

    $data['liveresultData'] = $liveresultData;
    $data['todayresultData'] = $todayresult;
    $data['companyModel'] = $companyModel;
    $data['allMultipleCompany'] = $allMultipleCompany;
    $data['companyMulModel'] = $companyMulModel;

    $this->template->render('usertemplate', 'contents', 'user/index', $data);
  }

  public function jodichart()
  {
    set_title('Welcome | ' . SITE_NAME);
    $companyModel = new CompanyModel();

    $searchArray = array();
    $searchArrayQrrString = array();
    $data['action'] = 'jodichart';
    $paginationnew = new Paginationnew();

    $id = $this->request->getGet('id');

    $searchArrayQrrString['id'] = $id;
    $searchArray['parentid'] = $id;
    $page = $this->request->getGet('page');
    $page = $page ? $page : 1;
    $Limit = 1000;
    $totalRecord = $companyModel->getData($searchArray, '', '', 1);

    $startLimit = ($page - 1) * $Limit;
    $data['startLimit'] = $startLimit;

    $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);

    $data['startLimit'] = $startLimit;
    $data['pagination'] = $pagination;

    $hisdata = $companyModel->getData($searchArray, $startLimit, $Limit);
    $resultdata = array();
    foreach ($hisdata as $singleDetails) {
      $resultDate = date('d-m-Y', strtotime($singleDetails->com_date));
      $resultdata[$resultDate] =  $singleDetails;
    }

    // $data["historyData"] = $companyModel->getData($searchArray,$startLimit,$Limit);
    //  echo "<pre>";  print_r($resultdata);die;
    $startDate = isset($hisdata[0]->result_date) ? $hisdata[0]->result_date : '';

    // get next sunday            
    $date = new \DateTime($startDate);
    // Modify the date it contains
    $date->modify('next sunday');
    $nextDate = $date->format('Y-m-d');
    $data["startdate"] =  $startDate;
    $data["enddate"] =  date('Y-m-d');
    $data["nextDate"] =  $nextDate;

    $data['searchArray'] = $searchArrayQrrString;
    $data['resultdata'] = $resultdata;
    $data['hisdata'] = $hisdata;

    $this->template->render('usertemplate', 'contents', 'user/jodichart', $data);
  }

  public function panelchart()
  {
    set_title('Welcome | ' . SITE_NAME);
    $companyModel = new CompanyModel();

    $searchArray = array();
    $searchArrayQrrString = array();
    $data['action'] = 'panelchart';
    $paginationnew = new Paginationnew();

    $id = $this->request->getGet('id');

    $searchArrayQrrString['id'] = $id;
    $searchArray['parentid'] = $id;
    $searchArray['sort_by'] = "com_date";
    $page = $this->request->getGet('page');
    $page = $page ? $page : 1;
    $Limit = 1000;
    $totalRecord = $companyModel->getData($searchArray, '', '', 1);

    $startLimit = ($page - 1) * $Limit;
    $data['startLimit'] = $startLimit;

    $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);

    $data['startLimit'] = $startLimit;
    $data['pagination'] = $pagination;
    $hisdata = $companyModel->getData($searchArray, $startLimit, $Limit);
    $resultdata = array();
    foreach ($hisdata as $singleDetails) {
      $resultDate = date('d-m-Y', strtotime($singleDetails->com_date));
      $resultdata[$resultDate] =  $singleDetails;
    }
    //  echo "<pre>";print_r($resultdata);die;
    // $data["historyData"] = $companyModel->getData($searchArray,$startLimit,$Limit);
    //  echo "<pre>";  print_r($resultdata);die;
    $startDate = isset($hisdata[0]->result_date) ? $hisdata[0]->result_date : '';

    // get next sunday            
    $date = new \DateTime($startDate);
    // Modify the date it contains
    $date->modify('next sunday');
    $nextDate = $date->format('Y-m-d');
    $data["startdate"] =  $startDate;
    $data["enddate"] =  date('Y-m-d');
    $data["nextDate"] =  $nextDate;

    $data['searchArray'] = $searchArrayQrrString;
    $data['resultdata'] = $resultdata;
    $data['hisdata'] = $hisdata;

    $this->template->render('usertemplate', 'contents', 'user/panelchart', $data);
  }

  public function liveResultJson()
  {
    $companyModel = new CompanyModel();
    $todayresult = $companyModel->getTodayResult();
    return $this->response->setJSON([
      'status' => true,
      'data' => $todayresult,
    ]);
  }

  public function singlepanelchart()
  {
    set_title('Welcome | ' . SITE_NAME);
    $companyModel = new CompanyModel();

    $searchArray = array();
    $data['action'] = 'singlepanelchart';
    $paginationnew = new Paginationnew();

    $id = $this->request->getGet('id');

    $searchArray['parentid'] = $id;
    $searchArray['sort_by'] = "com_date";
    $page = $this->request->getGet('page');
    $page = $page ? $page : 1;
    $Limit = 1000;
    $totalRecord = $companyModel->getData($searchArray, '', '', 1);

    $startLimit = ($page - 1) * $Limit;
    $data['startLimit'] = $startLimit;

    $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);

    $data['startLimit'] = $startLimit;
    $data['pagination'] = $pagination;
    $hisdata = $companyModel->getData($searchArray, $startLimit, $Limit);

    // echo "<pre>";print_r($hisdata);die;
    $resultdata = array();
    foreach ($hisdata as $singleDetails) {
      $resultDate = date('d-m-Y', strtotime($singleDetails->com_date));
      $resultdata[$resultDate] =  $singleDetails;
    }
    //  echo "<pre>";print_r($resultdata);die;
    // $data["historyData"] = $companyModel->getData($searchArray,$startLimit,$Limit);
    //  echo "<pre>";  print_r($resultdata);die;
    $startDate = isset($hisdata[0]->result_date) ? $hisdata[0]->result_date : '';

    // get next sunday            
    $date = new \DateTime($startDate);
    // Modify the date it contains
    $date->modify('next day');
    $nextDate = $date->format('Y-m-d');
    $data["startdate"] =  $startDate;
    $data["enddate"] =  date('Y-m-d');
    $data["nextDate"] =  $nextDate;

    $data['searchArray'] = $searchArray;
    $data['resultdata'] = $resultdata;
    $data['hisdata'] = $hisdata;

    if (isset($data["historyData"][0])  && $data["historyData"][0]->com_template == 'newsingletable') {
      $this->template->render('usertemplate', 'contents', 'user/viewallresultsingleline', $data);
    } else {
      $this->template->render('usertemplate', 'contents', 'user/viewallresult', $data);
    }

    // $this->template->render('usertemplate', 'contents', 'user/viewallresultsingleline', $data);
  }

  public function viewresult()
  {
    set_title('Welcome | ' . SITE_NAME);

    $data = array();

    $companyModel = new CompanymulhistoryModel();

    $searchArray = array();
    $searchArrayQrrString = array();

    $paginationnew = new Paginationnew();

    $id = $this->request->getGet('id');

    $searchArrayQrrString['id'] =   $searchArray['com_parentid'] = $id;
    $searchArray['group_by'] = "com_date";
    $page = $this->request->getGet('page');
    $page = $page ? $page : 1;
    $Limit = 10;
    $totalRecord = $companyModel->getData($searchArray, '', '', 1);

    $startLimit = ($page - 1) * $Limit;
    $data['startLimit'] = $startLimit;

    $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);

    $data['startLimit'] = $startLimit;
    $data['pagination'] = $pagination;

    $data["historyData"] = $companyModel->getData($searchArray, $startLimit, $Limit);
    $data["companymulhistory"] = $companyModel;
    //    echo "<pre>"; print_r($data["historyData"]);die;
    $startDate = isset($data["historyData"][0]) ? $data["historyData"][0]->com_date : '';

    // get next sunday            
    $date = new \DateTime($startDate);
    // Modify the date it contains
    $date->modify('next sunday');
    $nextDate = $date->format('Y-m-d');
    $data["startdate"] =  $startDate;
    $data["nextDate"] =  $nextDate;
    $data['action'] = "viewresult";
    $data['id'] = $id;
    $data['searchArray'] = $searchArrayQrrString;

    if (isset($data["historyData"][0])  && $data["historyData"][0]->com_template == 'newsingletable') {
      $this->template->render('usertemplate', 'contents', 'user/viewallresultsingleline', $data);
    } else {
      $this->template->render('usertemplate', 'contents', 'user/viewallresult', $data);
    }
  }


  public function loadmoreesult()
  {
      

        $data = array();

        $companyModel = new CompanymulhistoryModel();

        $searchArray = array();
        $searchArrayQrrString = array();

        $paginationnew = new Paginationnew();

        $id = $this->request->getGet('id');

        $searchArrayQrrString['id'] =   $searchArray['com_parentid'] = $id;
        $searchArray['group_by'] = "com_date";
        $page = $this->request->getGet('page');
        $page = $page ? $page : 1;
        $Limit = 10;
        $totalRecord = $companyModel->getData($searchArray, '', '', 1);

        $startLimit = ($page - 1) * $Limit;
        $data['startLimit'] = $startLimit;

        $pagination = $paginationnew->getPaginate($totalRecord, $page, $Limit);

        $data['startLimit'] = $startLimit;
        $data['pagination'] = $pagination;

        $data["historyData"] = $companyModel->getData($searchArray, $startLimit, $Limit);
        $data["companymulhistory"] = $companyModel;
        //    echo "<pre>"; print_r($data["historyData"]);die;
        $startDate = isset($data["historyData"][0]) ? $data["historyData"][0]->com_date : '';

        // get next sunday            
        $date = new \DateTime($startDate);
        // Modify the date it contains
        $date->modify('next sunday');
        $nextDate = $date->format('Y-m-d');
        $data["startdate"] =  $startDate;
        $data["nextDate"] =  $nextDate;
        $data['action'] = "viewresult";
        $data['searchArray'] = $searchArrayQrrString;
      if(count($data["historyData"])){
        if (isset($data["historyData"][0])  && $data["historyData"][0]->com_template == 'newsingletable') {
          echo view('user/_viewallresultsingle', $data);
        } else {
         echo view('user/_viewallresult', $data);
        }
      }
      return "";
  }




  public function generatesingleresult()
  {

    $returnval = $this->request->getGet('rt');

    $category = new CategoryModel();

    $resultCompany = $category->where("result_type", "single")->find();


    foreach ($resultCompany as $hisDetails) {
      $companyModel = new CompanyModel();

      $resultCompanycheck = $companyModel->where("com_parentid", $hisDetails['id'])->where('com_starttime', $hisDetails['start_time'])->where('com_date', date('Y-m-d'))->first();
      //  echo $companyModel->getLastQuery();die;
      // print_r($resultCompanycheck);die;
      if (!$resultCompanycheck) {
        $arrDetails = array(
          'com_parentid' => $hisDetails['id'],
          'com_desc' => $hisDetails['desc'],
          'com_starttime' => $hisDetails['start_time'],
          'com_endtime' => $hisDetails['end_time'],
          'com_date' => date('Y-m-d')
        );

        $companyModel->save($arrDetails);
      }
    }

    if ($returnval) {
      $this->session->setFlashdata('message', 'Created succesfully.');
      return redirect()->to(site_url('dashboard'));
    }

    echo " sigle result generated";
    die;
  }


  public function generatemultipleresult()
  {

    $returnval = $this->request->getGet('rt');

    $starttime = '';
    $endtime = '';
    // take back up of historical data
    $category = new CategoryModel();

    $resultCompany = $category->where("result_type", "multiple")->find();

    foreach ($resultCompany as $hisDetails) {
      $starttime = $hisDetails['start_time'];
      $endtime = $hisDetails['end_time'];
      $time_interval = $hisDetails['com_interval'];;
      while (strtotime($starttime) <= strtotime($endtime)) {

        $maxTime = date("H", strtotime($starttime));

        $exection_time = $maxTime == '00' ? date("H:i", strtotime($endtime)) : date("H:i", strtotime($starttime));

        $companyModel = new   CompanymulhistoryModel();

        $resultCompanycheck = $companyModel->where("com_parentid", $hisDetails['id'])->where('com_starttime', $exection_time)->where('com_date', date('Y-m-d'))->first();


        if (!$resultCompanycheck) {
          $arrDetails = array(
            'com_parentid' => $hisDetails['id'],
            'com_desc' => $hisDetails['desc'],
            'com_starttime' => $exection_time,
            'com_endtime' => $hisDetails['end_time'],
            'com_date' => date('Y-m-d')
          );

          $companyModel->save($arrDetails);
        }
        $starttime = date("H:i", strtotime("$starttime +" . $time_interval . " minutes"));
        // echo "<br>". $maxTime;
        if ($maxTime >= 0 && $maxTime <= 2)
          break;
      }
    }

    if ($returnval) {
      $this->session->setFlashdata('message', 'Created succesfully.');
      return redirect()->to(site_url('dashboard'));
    }

    echo "multiple result done";
    die;
  }


  public function backupmultipleresult()
  {

    $starttime = '';
    $endtime = '';
    // take back up of historical data
    $companyModel = new   CompanymulModel();
    $resultCompany = $companyModel->find();

    foreach ($resultCompany as $hisDetails) {
      $compantmulhistory = new CompanymulhistoryModel();

      $resultCompanycheck =  $compantmulhistory->where("com_starttime", $hisDetails['com_starttime'])->where('com_date', $hisDetails['com_date'])->first();

      if (!$resultCompanycheck) {
        $arrDetails = array(
          'com_parentid' => $hisDetails['com_parentid'],
          'com_desc' => $hisDetails['com_desc'],
          'com_starttime' => $hisDetails['com_starttime'],
          'com_endtime' => $hisDetails['com_endtime'],
          'com_open' => $hisDetails['com_open'],
          'com_mid' => $hisDetails['com_mid'],
          'com_close' => $hisDetails['com_close'],
          'com_date' => $hisDetails['com_date']
        );
        $compantmulhistory->save($arrDetails);
      }
    }

    $companyModel->truncate();

    echo "multiple result done";
    die;
  }

  public function generateresult()
  {
    helper('text');

    $ObjFamily = new FamilychartModel();

    for ($i = 28; $i > 0; $i--) {

      $first = $ObjFamily->getNumber();
      $arrfirst = str_split($first);
      $firstString = implode($arrfirst);

      $firstSum = array_sum($arrfirst);
      $arrFsum = str_split($firstSum);
      $firstjodi = isset($arrFsum[1]) ? $arrFsum[1] : $arrFsum[0];

      $third = $ObjFamily->getNumber();
      $arrThird = str_split($third);

      $thirdstring = implode($arrThird);

      $thirdSum = array_sum($arrThird);
      $arrThsum = str_split($thirdSum);
      $secondjodi = isset($arrThsum[1]) ? $arrThsum[1] : $arrThsum[0];

      $second = $firstjodi . $secondjodi;

      $startdate = date("Y-m-d", strtotime("-" . $i . " day"));
      echo    $day = strtoupper(date('D', strtotime("-" . $i . " day")));
      if ($day == "SUN") {
        $firstString = "";
        $second = "";
        $thirdstring = "";
      }
      $arrinsert = array(
        "com_parentid" => 62,
        "com_starttime" => "11:00:00",
        "com_endtime" => "12:00:00",
        "com_open" => $firstString,
        "com_mid" => $second,
        "com_close" => $thirdstring,
        "com_date" => $startdate,
        "com_showresult" => 1,
      );

      $objMulHis = new CompanyModel();

      //  $objMulHis->save($arrinsert);

      echo "<pre>";
      print_r($arrinsert);
    }

    //  print_r($arrinsert);
  }

  public function matkajodichart()
  {
    set_title('Welcome | ' . SITE_NAME);

    $data = array();

      $this->template->render('usertemplate', 'contents', 'user/matkajodichart', $data);
   
  }

  public function fixopentoclosebydate()
  {
    set_title('Welcome | ' . SITE_NAME);

    $data = array();

      $this->template->render('usertemplate', 'contents', 'user/fixopentoclosebydate', $data);
   
  }

  public function jodichartfamilymatka()
  {
    set_title('Welcome | ' . SITE_NAME);

    $data = array();

      $this->template->render('usertemplate', 'contents', 'user/jodichartfamilymatka', $data);
   
  }

  public function penalcountchart()
  {
    set_title('Welcome | ' . SITE_NAME);

    $data = array();

      $this->template->render('usertemplate', 'contents', 'user/penalcountchart', $data);
   
  }

  public function penaltotalchart()
  {
    set_title('Welcome | ' . SITE_NAME);

    $data = array();

      $this->template->render('usertemplate', 'contents', 'user/penaltotalchart', $data);
   
  }

}
