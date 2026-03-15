<?php namespace App\Libraries;

/* * ***************************************************************************\
  +-----------------------------------------------------------------------------+
  | Project        : fluid9                                           		  |
  | FileName       : smsMessage.php                                           |
  | Version        : 1.0                                                      |
  | Developer      : subedar Yadav                                            |
  | Created On     : 15-03-2021                                               |
  | Modified On    :                                                          |
  | Modified   By  :                                                          |
  | Authorised By  :  subedar Yadav                                           |
  | Comments       :  This class used for site message		  		          |
  | Email          : subedar2507@gmail.com                                    |
  +-----------------------------------------------------------------------------+
  \**************************************************************************** */

#[\AllowDynamicProperties]
class smsMessage {

	private $arrMessage = array();
	
    public function getMessage($key){


		//message for registration
		$this->arrMessage['register'] = " Dear ##USER_NAME## 
													 Thank you for registering with us.
												";


		//message for gorgot password
		$this->arrMessage['forgotpassword'] = " Dear ##USER_NAME## 
													 Your Password is ##PASSWPRD## 
												";
		
		if(array_key_exists($key,$this->arrMessage))
		{
			return $this->arrMessage[$key];
		}
	}


	

}

?>