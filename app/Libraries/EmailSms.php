<?php namespace App\Libraries;

/* * ***************************************************************************\
  +-----------------------------------------------------------------------------+
  | Project        : Cameron                                           		  |
  | FileName       : EmailSms.php                                           |
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
class EmailSms {

	private $arrMessage = array();
	
    public function getMessage($key){


		//message for registration
		$this->arrMessage['register'] = " Dear ##USER_NAME## 
													 Thank you for registering with us.
												";


		//message for gorgot password
		$this->arrMessage['forgotpassword'] = " Dear ##USER_NAME## <br>
													 Your Password generation link ##PASSWPRD_LINK## . <br> Please click above link and reset your password.
                        ";
                        
    //message for gorgot password
		$this->arrMessage['renewpassword'] = " Dear ##USER_NAME## <br>
    Your Password updated succesfully.
 ";
		
		if(array_key_exists($key,$this->arrMessage))
		{
			return $this->arrMessage[$key];
		}
  }
  
  //function for making email link design
  public function generate_mail_link($action,$linkname)
  {
     return '<a href="'.$action.'" target="_blank" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;  font-size: 12px; color: #626ed4; text-decoration: none; font-weight: bold; text-align: center; cursor: pointer; display: inline-block;  text-transform: capitalize;  margin: 0;">'.$linkname.'</a>';
  }

  public function getEmailFooter()
  {
     return "Thanks & Regards <br> ".SITE_NAME." Team";
  }

  //function for send email

  public function sendEmail($toEmail,$subject='',$mailbody='')
  {
        $email = \Config\Services::email();

        $config['protocol'] = 'sendmail';
        $config['mailPath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'iso-8859-1';
        $config['wordWrap'] = true;

        $email->initialize($config);

        $email->setFrom('admin@cameron.com', 'Cameron Team');
        $email->setTo($toEmail);
        // $email->setCC('another@another-example.com');
        // $email->setBCC('them@their-example.com');

        $email->setSubject($subject);
        $email->setMessage($mailbody);

        $email->send();
  }


	

}

?>