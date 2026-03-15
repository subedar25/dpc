<?php

namespace App\Libraries;

/* * ***************************************************************************\
  +-----------------------------------------------------------------------------+
  | Project        : fluid9                                           		  |
  | FileName       : sitevariables.php                                           |
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
class SiteVariables {

    private $arrMessage = array();

    public function getVariable($key) {


        //message for registration 
        $this->arrMessage['paymentstatus'] = 
                array('pending' => 'Pending', 
                    'paid' => 'Paid');
        
        $this->arrMessage['orderstatus'] = 
                                        array(
                                            'pending' => 'Pending', 
                                            'dispatch' => 'Dispatch', 
                                            
                                            );
       
        
        $this->arrMessage['orderstatuscpdropdown'] = 
                                            array(
                                                'pending' => 'pending', 
                                                'dispatch' => 'Dispatch', 
                                               
                                                );
        
        
       
      


        if (array_key_exists($key, $this->arrMessage)) {
            return $this->arrMessage[$key];
        }
    }

}

?>