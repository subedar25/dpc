<?php namespace App\Models;

use CodeIgniter\Model;

#[\AllowDynamicProperties]
class UserModel extends Model{
    
     protected $table = 'users';
     protected $primaryKey = 'id';
     protected $allowedFields = ['id', 'adminid','channelpartnerid','fname', 'lname',  'email', 'phone',  'password', 'user_type', 'partner_type','user_status','paynow_status','gender', 'order_form', 'companyname','address','pincode','stateid', 'districid','cityid', 'idproof', 'idproof_doc', 'user_created', 'gst_number', 'gst_doc','temp_password','it_status','it_comment','it_approvedate'];

    
    function checkUserLogin($username,$password){

        $txtreturn = false;

        $objResult =  $this->asObject()
                            ->where(['phone' => $username])
                            ->first();
            if($objResult) {
                       
            $dbPassword = $objResult->password;
         
            if(password_verify($password,$dbPassword))
            {
                $userSession = array(
                    'user_id' => $objResult->id,
                    'email'   => $objResult->email,
                    'name'   => $objResult->fname,
                    'phone'   => $objResult->phone,
                    'user_type'   => $objResult->user_type,
                    'partner_type'   => $objResult->partner_type,
                    'address'   => $objResult->address,
                    'paynowstatus'   => $objResult->paynow_status,
                    'isUserLoggedIn'   => TRUE
                );

                if($objResult->user_status)
                { 
                    $session = session();
                    $session->set($userSession);
                    $txtreturn = 1;
                }
                else
                {
                    $txtreturn =2; // user exist but his account not active
                }
                
            }
            
        }

            return $txtreturn;
    }

	public function getData($searchArray=array(), $offset='', $limit='',$coutOnly='',$showquery='')
    {
        if($coutOnly)
        {
            $sql = "SELECT COUNT(ad.$this->primaryKey) as total_count FROM $this->table AS ad ";
        }
        else
        {
            $sql = "SELECT ad.*, DATE_FORMAT(ad.user_created, '%d %M  %Y') as user_created  FROM $this->table AS ad ";
        }
      //  $sql .= " LEFT JOIN admin a ON(ad.adminid = a.id) ";
       // $sql .= " LEFT JOIN admin AS SA ON (a.created_by = SA.id) ";
       // $sql .= " LEFT JOIN users AS CP ON(ad.channelpartnerid = CP.id) ";
       // $sql .= " LEFT JOIN state s ON(ad.stateid = s.st_id) ";
        
        
        $sql .= " ";
        $sql .= " WHERE 1 ";
        
        if(isset($searchArray['id']) && $searchArray['id'])
        {
            $sql .= " AND ad.id = '".$searchArray['id']."' ";
           
        }
        if(isset($searchArray['saleshead']) && $searchArray['saleshead'])
        {
            $sql .= " AND a.created_by = '".$searchArray['saleshead']."' ";
           
        }

        if(isset($searchArray['salesexecutive']) && $searchArray['salesexecutive'])
        {
            $sql .= " AND ad.adminid  = '".$searchArray['salesexecutive']."' ";
           
        }
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND (ad.phone LIKE '".$searchArray['txtsearch']."%' ";
            $sql .= " OR ad.email LIKE '".$searchArray['txtsearch']."%' ";
          //  $sql .= " OR ad.companyname LIKE '".$searchArray['txtsearch']."%' ";
            $sql .= " OR ad.fname LIKE '".$searchArray['txtsearch']."%' )";
        }
        if(isset($searchArray['user_type']) && $searchArray['user_type'])
        {
            $sql .= " AND ad.user_type = '".$searchArray['user_type']."' ";
        }
        
        if(isset($searchArray['user_status']))
        {
            $sql .= " AND ad.user_status = '".$searchArray['user_status']."' ";
        }

        if(isset($searchArray['user_itstatus']) && $searchArray['user_itstatus'])
        {
            $sql .= " AND ad.it_status = '".$searchArray['user_itstatus']."' ";
        }

        if(isset($searchArray['fromdate']) && isset($searchArray['todate']))
        {
            $sql .= " AND ( DATE_FORMAT(ad.user_created, '%Y-%m-%d') >= '".$searchArray['fromdate']."' ";
            $sql .= " AND DATE_FORMAT(ad.user_created, '%Y-%m-%d') <= '".$searchArray['todate']."' ) ";
           
        }
        
        if(isset($searchArray['sort_by']) && $searchArray['sort_by'])
        {
            $sql .= " ORDER BY ".$searchArray['sort_by']." ASC"; 
        }
        else
        {
      //      $sql .= " ORDER BY companyname ASC"; 
        }

      

        if($limit)
        {
            $sql .= " LIMIT $offset,$limit";
        }
        if($showquery)
        {
            echo $sql;
        }
       
        $query = $this->db->query($sql);
        $result = $query->getResult();
        
        if($coutOnly)
        {
            return $result[0]->total_count;
        }

        return $result;
    }

    public function getUserdetail($id)
    {
        $arrResult =  $this->asArray()
                    ->where(['id' => $id])
                    ->first();

        return $arrResult;
    }


    function UserLoginApi($username,$password)
    {

        $txtreturn = false;

        $objResult =  $this->asObject()
                            ->where(['phone' => $username])
                            ->first();

        if($objResult) {
                   
            $dbPassword = $objResult->password;
            
            if(password_verify($password,$dbPassword))
            {
                $userSession = array(
                    'user_id' => $objResult->id,
                    'email'   => $objResult->email,
                    'name'   => $objResult->fname,
                    'user_type'   => $objResult->user_type,
                    'isUserLoggedIn'   => TRUE
                );
                                    
                $session = session();
                $session->set($userSession);
            
                $txtreturn = array(
                    'id' => $objResult->id,
                    'user_type' => $objResult->user_type,
                    'company'   => $objResult->company,
                );
            }
            
        }

        return $txtreturn;
    }

    public function checkEmailExist($username)
    {
        $arrResult =  $this->asArray()
                    ->where(['phone' => $username])
                    ->countAllResults();

        return $arrResult;
    }


}

?>
