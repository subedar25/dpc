<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;

#[\AllowDynamicProperties]
class CategoryModel extends Model {

    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','cat_userid', 'name', 'description', 'start_time', 'end_time', 'com_interval', 'status', 'result_type','result_mode','com_showresult','com_working','com_order','com_created','com_template','bg_color'];
    protected $db;

    public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '', $counField = '', $showsql = '') {
        if ($coutOnly) {
            $fieldCount = $counField ? " DISTINCT " . $counField : $this->primaryKey;
            $sql = "SELECT COUNT($fieldCount) as total_count FROM $this->table AS OT ";
        } else {
            $sql = "SELECT OT.* ";
            $sql .= " FROM $this->table AS OT ";
        }

        $sql .= " ";
        $sql .= " WHERE 1 ";

        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND ( OT.name LIKE '%" . $searchArray['txtsearch'] . "%' )";
        }

         if (isset($searchArray['id']) && is_array($searchArray['id'])) {
            $strorderid = implode("','", $searchArray['id']);
            $sql .= " AND OT.id IN ('" . $strorderid . "') ";
        } else if (isset($searchArray['id']) && $searchArray['id']) {
            $sql .= " AND OT.id = '" . $searchArray['id'] . "' ";
        }
        
        if (isset($searchArray['ownerid']) && is_array($searchArray['ownerid'])) {
            $strorderid = implode("','", $searchArray['ownerid']);
            $sql .= " AND OT.cat_userid IN ('" . $strorderid . "') ";
        } else if (isset($searchArray['ownerid']) && $searchArray['ownerid']) {
            $sql .= " AND OT.cat_userid = '" . $searchArray['ownerid'] . "' ";
        }
        
         if (isset($searchArray['result_type']) && $searchArray['result_type']) {
            $sql .= " AND OT.result_type = '" . $searchArray['result_type'] . "' ";
        }
        if (isset($searchArray['result_mode']) && $searchArray['result_mode']) {
            $sql .= " AND OT.result_mode = '" . $searchArray['result_mode'] . "' ";
        }


        if (isset($searchArray['sort_by']) && $searchArray['sort_by']) {
            $sql .= " ORDER BY " . $searchArray['sort_by'] . " ASC";
        } else {
            $sql .= " ORDER BY " . $this->primaryKey . " DESC";
        }

       

        if ($limit) {
            $sql .= " LIMIT $offset,$limit";
        }
        if ($showsql) {
            echo $sql;
        }
// echo $sql;die;
        $query = $this->db->query($sql);
        $result = $query->getResult();

        if ($coutOnly) {
            return isset($result[0]) ? $result[0]->total_count : 0;
        }

        return $result;
    }


}

?>
