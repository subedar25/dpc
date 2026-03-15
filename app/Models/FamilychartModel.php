<?php

namespace App\Models;

use CodeIgniter\Model;

#[\AllowDynamicProperties]
class FamilychartModel extends Model {

    protected $table = 'family_chart';
    protected $primaryKey = 'ch_id';
    protected $allowedFields = ['ch_id','ch_cat', 'ch_number'];
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

        $query = $this->db->query($sql);
        $result = $query->getResult();

        if ($coutOnly) {
            return isset($result[0]) ? $result[0]->total_count : 0;
        }

        return $result;
    }
    
    public function getNumber()
    {
          $sql = "SELECT ch_number  FROM $this->table AS OT ";
           $sql .= " ";
        $sql .= " WHERE 1 ";
        $sql .= " ORDER BY RAND() ";
        
         $query = $this->db->query($sql);
        $result = $query->getResult();
        
        return isset($result[0]) ? $result[0]->ch_number : 0;
        
    }


}

?>