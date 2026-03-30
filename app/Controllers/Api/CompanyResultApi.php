<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use CodeIgniter\API\ResponseTrait;

#[\AllowDynamicProperties]
class CompanyResultApi extends BaseController
{
    use ResponseTrait;

    public function update()
    {
        //  $payload = $this->request->getJSON(true);
        //  if (! is_array($payload)) {
            $payload = $this->request->getPost();
        // }
// print_r($payload);
        $comId = isset($payload['com_id']) ? (int) $payload['com_id'] : 0;
       
        $todayDate = isset($payload['com_date']) ? $payload['com_date'] : '';
        $hasUpdateFields = false;
        $orderData = [];

        foreach (['com_open', 'com_mid', 'com_close'] as $field) {
            if (array_key_exists($field, $payload)) {
                $orderData[$field] = $payload[$field];
                $hasUpdateFields = true;
            }
        }

        if (! $hasUpdateFields) {
            return $this->failValidationErrors('No fields provided to update.');
        }

        $companyModel = new CompanyModel();
        $categoryModel = new CategoryModel();

        if (! $comId) {
            return $this->failValidationErrors('Provide com_id.');
        }

        $existing = $categoryModel->where('id', $comId)->first();

        if (! $existing) {
            return $this->failNotFound('Company not exist.');
        }

        // $todayDate = date('Y-m-d');
        // if (! empty($existing['com_date']) && $existing['com_date'] !== $todayDate) {
        //     return $this->failValidationErrors('Result can only be updated for today.');
        // }

        // $nowTime = date('H:i');
        // if (! empty($existing['com_starttime'])) {
        //     $startTime = date('H:i', strtotime($existing['com_starttime']));
        //     if (strtotime($nowTime) < strtotime($startTime)) {
        //         return $this->failValidationErrors('Result update not allowed before start time.');
        //     }
        // }
        // if (! empty($existing['com_endtime'])) {
        //     $endTime = date('H:i', strtotime($existing['com_endtime']));
        //     if (strtotime($nowTime) > strtotime($endTime)) {
        //         return $this->failValidationErrors('Result update not allowed after end time.');
        //     }
        // }

        // $parentId = isset($existing['com_parentid']) ? (int) $existing['com_parentid'] : 0;
        // if (! $parentId || ! $companyModel->find($parentId)) {
        //     return $this->failNotFound('Category not found for given company.');
        // }

       // $orderData['com_date'] = $todayDate;
        $orderData['com_lastupdate'] = date('H:i');

        $updated = $companyModel
            ->set($orderData)
            ->where('com_parentid', $comId)
            ->where('com_date', $todayDate)
            ->where('com_starttime', $existing['start_time'])
            ->update();

        // $lastQuery = (string) $companyModel->db->getLastQuery();

        if (! $updated) {
            return $this->failServerError('Failed to update result.');
        }

        return $this->respond([
            'status' => true,
            'message' => 'Updated successfully',
            'com_id' => $comId,
            // 'query' => $lastQuery,
        ]);
    }
}
