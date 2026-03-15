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
class Cyclemotor extends BaseController {

	
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
        
        $this->template->render('admintemplate', 'contents' , 'admin/cyclemotor', $data);
				
    }


}
