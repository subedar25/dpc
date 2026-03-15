<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;

#[\AllowDynamicProperties]
class CompanymulhistoryModel extends Model {

    protected $table = 'company_result_history_multiple';
     protected $parentTable = "category";
     protected $primaryKey = 'com_id';
     protected $allowedFields = ['com_id','com_parentid','com_desc', 'com_starttime','com_endtime','com_open','com_mid', 'com_template','com_close','com_date'];
     
     protected $db ;
     

  public function getData($searchArray=array(), $offset='', $limit='',$coutOnly='',$counField='',$showsql='')
   {
        if($coutOnly)
        {
            $fieldCount = $counField ? " DISTINCT ".$counField : $this->primaryKey;
            $sql = "SELECT COUNT($fieldCount) as total_count FROM $this->table AS OT ";
        }
        else
        {
            $sql = "SELECT OT.*,C.name,OT.com_date AS result_date, C.com_template ";
            $sql .= " FROM $this->table AS OT ";
           
        }
        $sql .= " LEFT JOIN   category   as C ON (OT.com_parentid = C.id) ";

        $sql .= " ";
        $sql .= " WHERE 1 ";

       
        if(isset($searchArray['txtsearch']) && $searchArray['txtsearch'])
        {
            $sql .= " AND ( C.name LIKE '%".$searchArray['txtsearch']."%' )";
          
        }

        if((isset($searchArray['fromdate']) && $searchArray['fromdate']) && (isset($searchArray['todate']) && $searchArray['todate']))
        {
            $sql .= " AND ( DATE_FORMAT(OT.com_date, '%Y-%m-%d') >= '".$searchArray['fromdate']."' ";
            $sql .= " AND DATE_FORMAT(OT.com_date, '%Y-%m-%d') <= '".$searchArray['todate']."' ) ";
           
        }
        
         if(isset($searchArray['comid']) && is_array($searchArray['comid']))
        {
            $strorderid = implode("','",$searchArray['comid']);
            $sql .= " AND OT.com_id IN ('".$strorderid."') ";
          
        }
        else if(isset($searchArray['comid']) && $searchArray['comid'])
        {
            $sql .= " AND OT.com_id = '".$searchArray['comid']."' ";
           
        }
        
         if(isset($searchArray['com_parentid']) && is_array($searchArray['com_parentid']))
        {
            $strorderid = implode("','",$searchArray['com_parentid']);
            $sql .= " AND OT.com_parentid IN ('".$strorderid."') ";
          
        }
        else if(isset($searchArray['com_parentid']) && $searchArray['com_parentid'])
        {
            $sql .= " AND OT.com_parentid = '".$searchArray['com_parentid']."' ";
           
        }

        if(isset($searchArray['group_by']) && $searchArray['group_by'])
        {
            $sql .= " GROUP BY ".$searchArray['group_by']." "; 
        }
       
         if(isset($searchArray['sort_by']) && $searchArray['sort_by'])
        {
            $sql .= " ORDER BY ".$searchArray['sort_by']." ASC"; 
        }
        else
        {
            // $sql .= " ORDER BY com_date DESC, ".$this->primaryKey." DESC"; 
            $sql .= " ORDER BY OT.com_date DESC,OT.com_parentid, OT.com_starttime"; 
        }

     

        if($limit)
        {
            $sql .= " LIMIT $offset,$limit";
        }
        if($showsql)
        {
            echo $sql;
        }
    
     //   echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->getResult();
        
        if($coutOnly)
        { 
            return isset($result[0]) ? $result[0]->total_count :0;
        }

        return $result;
    }


     public function getTodayResult($parentid='',$date='') {

        $sql = "SELECT * FROM  $this->table AS CR LEFT JOIN $this->parentTable C ON (CR.com_parentid = C.id) WHERE 1";
        if($parentid)
        {
            $sql .= " AND com_parentid=".$parentid;
        }
        if($date)
        {
         $sql .= " AND com_date='".$date."'";
        }
        $sql .= " ORDER BY CR.com_starttime ASC";
//        echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->getResultArray();

        return $result;
    }
    


}

?>