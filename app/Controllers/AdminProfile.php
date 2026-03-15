<?php namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\AdminModel;

#[\AllowDynamicProperties]
class AdminProfile extends BaseController {
    
    protected $session;
    protected  $isAdminLoggedIn;
    public $adminModel;
    
	function __construct()
	{
		
        $this->adminModel = new AdminModel();
          
            $this->session = session();
        
           $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn'); 

            
	}
	
	public function index()
	{
        set_title('Profile | ' . SITE_NAME);

        if(!$this->isAdminLoggedIn)
            {  
                   return redirect()->to(site_url('admin'));
            }

                $data =array();
                $userid = $this->session->get('admin_id');
		        
                $metatag = array("content" => "", "keywords" => "", "description" => "");
                set_metas($metatag);
                
                $data['profiledata'] = $this->adminModel->where("id",$userid)->first();
               // echo "<pre>";print_r($data);die;
		 $this->template->render('admintemplate', 'contents' , 'admin/profile', $data);
		
    }
    
    

	
	public function UpdateProfile(){
		
            
            if(!$this->isAdminLoggedIn)
            {  
                   return redirect()->to(site_url('admin'));
            }

            $userid = $this->session->get('admin_id');
            
            $first_name =$this->request->getPost('first_name'); 
            
            $arrSaveData = array(
                'name'=>$first_name
                );
            $this->adminModel->where('id',$userid)->set($arrSaveData)->update();
            
            $this->session->setFlashdata('message', 'Profle updated succesfully.');
            return redirect()->to(site_url('profile'));

	}
	
	
	function cpassword(){		
		
		$data = array();
             $this->template->render('admintemplate', 'contents' , 'admin/change_password', $data);
           
	}
        
        public function UpdatePassword(){
		
            

            $userid = $this->session->get('admin_id');
            
            $old_password =$this->request->getPost('old_password'); 
            $new_password =$this->request->getPost('new_password'); 
            $cnf_new_password =$this->request->getPost('cnf_new_password'); 
            
            if($new_password != $cnf_new_password)
            {
                $this->session->setFlashdata('errmessage', 'New Password and Confirm password not match.');
                 return redirect()->to(site_url('cpassword'));
            }
            $arrSaveData = array(
                'password'=>password_hash($new_password, 1)
                );
           
            $this->adminModel->where('id',$userid)->set($arrSaveData)->update();
           
            $this->session->setFlashdata('message', 'Profle updated succesfully.');
            return redirect()->to(site_url('cpassword'));

	}
	
	
}