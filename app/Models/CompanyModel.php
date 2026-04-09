<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;

#[\AllowDynamicProperties]
class CompanyModel extends Model {

    protected $table = 'company_result_history';
    protected $parentTable = 'category';
    protected $primaryKey = 'com_id';
    protected $allowedFields = ['com_id', 'com_parentid', 'com_desc', 'com_starttime', 'com_endtime', 'com_open', 'com_mid', 'com_close', 'com_date', 'com_showresult','com_lastupdate'];
    protected $db;

    public function getData($searchArray = array(), $offset = '', $limit = '', $coutOnly = '', $counField = '', $showsql = '') {
        if ($coutOnly) {
            $fieldCount = $counField ? " DISTINCT " . $counField : $this->primaryKey;
            $sql = "SELECT COUNT($fieldCount) as total_count FROM $this->table AS OT ";
        } else {
            $sql = "SELECT OT.*,C.name,OT.com_date AS result_date ";
            $sql .= " FROM $this->table AS OT ";
        }
        $sql .= " LEFT JOIN category as C ON (OT.com_parentid = C.id) ";

        $sql .= " ";
        $sql .= " WHERE 1 ";

        if (isset($searchArray['txtsearch']) && $searchArray['txtsearch']) {
            $sql .= " AND ( C.name LIKE '%" . $searchArray['txtsearch'] . "%' )";
        }

        if ((isset($searchArray['fromdate']) && $searchArray['fromdate']) && (isset($searchArray['todate']) && $searchArray['todate'])) {
            $sql .= " AND ( DATE_FORMAT(OT.com_date, '%Y-%m-%d') >= '" . $searchArray['fromdate'] . "' ";
            $sql .= " AND DATE_FORMAT(OT.com_date, '%Y-%m-%d') <= '" . $searchArray['todate'] . "' ) ";
        }

        if (isset($searchArray['parentid']) && is_array($searchArray['parentid'])) {
            $strorderid = implode("','", $searchArray['parentid']);
            $sql .= " AND OT.com_parentid IN ('" . $strorderid . "') ";
        } else if (isset($searchArray['parentid']) && $searchArray['parentid']) {
            $sql .= " AND OT.com_parentid = '" . $searchArray['parentid'] . "' ";
        }
        
        if (isset($searchArray['ownerid']) && is_array($searchArray['ownerid'])) {
            $strorderid = implode("','", $searchArray['ownerid']);
            $sql .= " AND C.cat_userid IN ('" . $strorderid . "') ";
        } else if (isset($searchArray['ownerid']) && $searchArray['ownerid']) {
            $sql .= " AND C.cat_userid = '" . $searchArray['ownerid'] . "' ";
        }

        if (isset($searchArray['result_mode']) && $searchArray['result_mode']) {
            $sql .= " AND C.result_mode = '" . $searchArray['result_mode'] . "' ";
        }
        
        if (isset($searchArray['comid']) && is_array($searchArray['comid'])) {
            $strorderid = implode("','", $searchArray['comid']);
            $sql .= " AND OT.com_id IN ('" . $strorderid . "') ";
        } else if (isset($searchArray['comid']) && $searchArray['comid']) {
            $sql .= " AND OT.com_id = '" . $searchArray['comid'] . "' ";
        }


        if (isset($searchArray['sort_by']) && $searchArray['sort_by']) {
            $sql .= " ORDER BY " . $searchArray['sort_by'] . " ASC";
        } else {
           // $sql .= " ORDER BY " . $this->primaryKey . " DESC";
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

    public function getLiveResult() {

        $display_time = date('H:i');
        $compare_time = date('Hi');
        $today_date = date('Y-m-d');
        $today = strtoupper(date('D'));

        if ($compare_time < 2359) {
            $end_time = date('H:i', strtotime($display_time . "-20 minutes"));
        } else {
            $end_time = date('H:i', strtotime($display_time . ""));
        }

        if ($compare_time < 0015) {
            $today_date = date('Y-m-d', strtotime($today_date . ' -1 day'));
            $display_time = "23:59";
            $end_time = "23:59";
        }

         $display_time_plus_5 = date('H:i', strtotime(date('H:i') . ' +5 minutes'));

         $sql = "SELECT * FROM  $this->table AS CR ";
           $sql .="  LEFT JOIN $this->parentTable C ON (CR.com_parentid = C.id) ";
           $sql .=" WHERE 1 ";
           $sql .=" AND CR.com_starttime <= '".$display_time_plus_5."' AND CR.com_endtime > '".$end_time."' ";
           $sql .=" AND CR.com_date ='".$today_date."' ";
           $sql .=" AND C.com_showresult =1 ";
           $sql .=" AND C.com_working LIKE '%".$today."%' ";
            $sql .=" ORDER BY CR.com_lastupdate DESC, CR.com_endtime,CR.com_starttime  DESC ";
        //  echo $sql;
        $query = $this->db->query($sql);
        $result = $query->getResultArray();

        return $result;
    }

    function getTodayResult() {

        $today_date = date('Y-m-d');

        // 1) Load all active single-result categories
        $categories = $this->db->query("SELECT * FROM {$this->parentTable} WHERE result_type='single' AND com_showresult=1")->getResultArray();
        if (!$categories) {
            return [];
        }

        $ids = array_column($categories, 'id');
        $idList = implode(",", array_map('intval', $ids));

        // 2) Fetch all results up to today for these companies, newest first
        $rows = $this->db->query("
            SELECT * FROM {$this->table}
            WHERE com_parentid IN ($idList) AND com_date <= '{$today_date}'
            ORDER BY com_date DESC, com_starttime DESC
        ")->getResultArray();

        // Helper: check if all three fields are empty
        $isEmptyResult = function ($row) {
            if (!$row) return true;
            $o = isset($row['com_open']) ? trim($row['com_open']) : '';
            $m = isset($row['com_mid']) ? trim($row['com_mid']) : '';
            $c = isset($row['com_close']) ? trim($row['com_close']) : '';
            return ($o === '' && $m === '' && $c === '');
        };

        // 3) Choose best row per company: prefer most recent non-empty; if none, most recent (even empty)
        $best = [];
        foreach ($rows as $row) {
            $pid = $row['com_parentid'];
            if (!isset($best[$pid])) {
                $best[$pid] = $row; // provisional (newest)
                continue;
            }
            if ($isEmptyResult($best[$pid]) && !$isEmptyResult($row)) {
                $best[$pid] = $row; // replace empty with non-empty older
            }
        }

        // 4) Merge category info with chosen rows
        $results = [];
        foreach ($categories as $cat) {
            $pid = $cat['id'];
            $row = $best[$pid] ?? null;
            $results[] = array_merge($cat, $row ?? []);
        }

        // Sort consolidated by scheduled start_time asc, then com_starttime asc, then result date desc
        usort($results, function ($a, $b) {
            $st = strcmp($a['start_time'] ?? '', $b['start_time'] ?? '');
            if ($st !== 0) {
                return $st;
            }
            $cst = strcmp($a['com_starttime'] ?? '', $b['com_starttime'] ?? '');
            if ($cst !== 0) {
                return $cst;
            }
            $da = $a['com_date'] ?? '';
            $db = $b['com_date'] ?? '';
            return strcmp($da, $db); // oldest date first
        });

        return $results;
    }

    function getLastResult($parentid) {

        $result = '';
        if ($parentid) {
            $sql = "SELECT * FROM  $this->parentTable C
						LEFT JOIN $this->table AS CR ON (C.id = CR.com_parentid)
						 WHERE 1 AND com_parentid = " . $parentid . " AND com_open <>''
						ORDER BY CR.com_date DESC LIMIT 0,1";

            $query = $this->db->query($sql);
            $result = $query->getResultArray();
        }
        return $result ? $result[0] : '';
    }

}

?>
