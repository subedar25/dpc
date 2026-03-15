<?php namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\UserModel;

#[\AllowDynamicProperties]
class Profile extends BaseController {
    
    protected $session;
    protected  $isAdminLoggedIn;
    public $userModel;
    
	function __construct()
	{
		
             $this->userModel = new UserModel();
          
            $this->session = session();
        
            $this->isAdminLoggedIn = $this->session->get('isAdminLoggedIn'); 
     
            
            
            
	}
	
	public function index()
	{
            
            
                $data =array();
                $userid = $this->session->get('user_id');
		        set_title('Profile | ' . SITE_NAME);
                $metatag = array("content" => "", "keywords" => "", "description" => "");
                set_metas($metatag);
                
                $data['profile_data'] = $this->userModel->getUserDetail($userid);
               // echo "<pre>";print_r($data);die;
		 $this->template->render('admintemplate', 'contents' , 'admin/profile/admin_profile', $data);
		
	}

	
	public function UpdateProfile(){
		
            
            if(!$this->isAdminLoggedIn)
            {  
                   return redirect()->to(site_url('admin'));
            }

            $userid = $this->session->get('user_id');
            
            $first_name =$this->request->getPost('first_name'); 
            
            $arrSaveData = array(
                'name'=>$first_name
                );
            $this->userModel->where('id',$userid)->set($arrSaveData)->update();
            
            $this->session->setFlashdata('message', 'Profle updated succesfully.');
            return redirect()->to(site_url('profile'));

	}
	
	
	function changepwd(){		
		
		$data = array();
             $this->template->render('usertemplate', 'contents' , 'user/changepwd', $data);
           
	}
        
        public function UpdatePassword(){

            $userid = $this->session->get('user_id');
            
            //$old_password =$this->request->getPost('old_password'); 
            $new_password =$this->request->getPost('new_password'); 
            $cnf_new_password =$this->request->getPost('cnf_new_password'); 
            
            if($new_password != $cnf_new_password)
            {
                $this->session->setFlashdata('errmessage', 'New Password and Confirm password not match.');
                 return redirect()->to(site_url('changepwd'));
            }
            $arrSaveData = array(
                'password'=>password_hash($new_password,1)
                );
           
            $this->userModel->where('id',$userid)->set($arrSaveData)->update();
           
            $this->session->setFlashdata('message', 'Profle updated succesfully.');
            return redirect()->to(site_url('changepwd'));

	}
	
	
}