<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\SettingsModel;
use App\Models\UserModel;
use CodeIgniter\Session\Session;
use App\Libraries\Paginationnew;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

#[\AllowDynamicProperties]
class Settings extends BaseController {

	
    protected $session;
    protected  $isAdminLoggedIn;
    protected $adminModel;

    public function __construct()
    {
        $this->session = session();
        $this->SettingsModel = new SettingsModel();
        $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn');
       

    }
    

    public function index()
	{

        if(!$this->isAdminLoggedIn)
	    {  
	           return redirect()->to(site_url('admin'));
        }  
            
        set_title('Welcome | ' . SITE_NAME);    
        
        $data = array();
        
        $data['settings'] =  $this->SettingsModel->getNameValuepair();
        
        $this->template->render('admintemplate', 'contents' , 'admin/settings', $data);
				
    }


    

    public function updatesetting()
    {
        $data = array();     
        $response = array("status"=>false,"error"=>"","message"=>'',"data"=>"");

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
         //  search variables

         $settingname = $this->request->getPost('settingname');
        $uploadedfile = $this->request->getFiles('filename');
        

        $extc = '';
       
        //create order folder
       $orderFolderpath = FCPATH.'catalog/';
       if (!is_dir($orderFolderpath)) {
           mkdir($orderFolderpath, 0777);
           chmod($orderFolderpath, 0777);
       }

       if($settingname =='FRONT_LOGO' || $settingname =='FUJI_LOGO' || $settingname =='FRONT_BACKGROUND_IMAGE')
       {
        $orderFolderpath = FCPATH.'images/';
       }
       else if($settingname =='SAMPLE_EXCEL')
       {
         $orderFolderpath = FCPATH;
       }

       // print_r($uploadedfile);die;
       $newfilenameName ='';
       $excelnotupload = true;
        if($uploadedfile)
        {
          $fileObject = $uploadedfile['filename'];
        
          $newfilenameName = $fileObject->getName();
          $extc     = $fileObject->guessExtension();
          
          //if excel sample excel then allow only excel file
          if($settingname =='SAMPLE_EXCEL' && (!in_array($extc ,array('xlsx','xlx'))))
          {
              $excelnotupload = false;
              
          }

          if($excelnotupload)
          {
            if (!$fileObject->isValid())
            {
              $response['error'] =$file->getErrorString().'-'.$file->getError();
            }
            else{
              $fileObject->move($orderFolderpath, $newfilenameName);
              $newfilenameName = $fileObject->getName();
            }
        }

        }
        else
        {
          $response['message'] = "File not uploaded";
        }


            if($newfilenameName && $settingname && $excelnotupload)
            {
                    $udateArray['varvalue']= $newfilenameName;
                    
                    $this->SettingsModel->set($udateArray)->where("name",$settingname)->update();

                    $response['status'] =201;
                    $response['message'] = "File uploaded";
                    $response['data'] = array("filename"=>$newfilenameName);
            }
            else
             {
                $response['message'] ="File not uploaded.";
             }

             echo json_encode($response) ;
            die;
    }

    public function updatesettingvalues()
    {
        $data = array();     
        $response = array("status"=>false,"error"=>"","message"=>'',"data"=>"");

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
         //  search variables
      $postdata = $this->request->getPost();

        


            if(count($postdata))
            {
              foreach($postdata as $keyname => $kevalue)
              {
                    $udateArray['varvalue']= $kevalue;
                    
                    $this->SettingsModel->set($udateArray)->where("name",$keyname)->update();
              }
                    $response['status'] =201;
                    $response['message'] = "Data updated successfully";
            }
            else
             {
                $response['message'] ="Please provide data";
             }

             echo json_encode($response) ;
            die;
    }


    public function removesetting()
    {
        $data = array();     
        $response = array("status"=>false,"error"=>"","message"=>'',"data"=>"");

        $admin_type = $this->session->get('admin_type');
        $admin_id = $this->session->get('admin_id');
         //  search variables

         $settingname = $this->request->getPost('settingname');
        
        //create order folder
       $orderFolderpath = FCPATH.'catalog/';
       

       // print_r($uploadedfile);die;
       $newfilenameName ='';
        


            if($settingname)
            {
              $settingdata = $this->SettingsModel->getvaluebyname($settingname);

              if($settingdata)
              {

                if($settingdata['name']=='FRONT_LOGO' || $settingdata['name'] =='FUJI_LOGO' || $settingdata['name'] =='FRONT_BACKGROUND_IMAGE')
                {
                  $orderFolderpath = FCPATH.'images/'.$settingdata['varvalue'];;
                }
                else if($settingdata['name'] == 'SAMPLE_EXCEL')
                {
                  $orderFolderpath = FCPATH.$settingdata['varvalue'];
                }
                else
                {
                  $orderFolderpath = FCPATH.'catalog/'.$settingdata['varvalue'];
                }

                @unlink($orderFolderpath);
              }
             
                    $udateArray['varvalue']= "";
                    
                    $this->SettingsModel->set($udateArray)->where("name",$settingname)->update();

                    $response['status'] =201;
                    $response['message'] = "File removed successfully";
                    $response['data'] = array("filename"=>$newfilenameName);
            }
            else
             {
                $response['message'] ="File not removed.";
             }

             echo json_encode($response) ;
            die;
    }



}
