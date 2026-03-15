<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\ParseDataService;
use App\Models\CategoryModel;
use App\Models\CompanyModel;

#[\AllowDynamicProperties]
class Parsedata extends Controller
{
    public function index()
    {
        $url = 'https://dpboss.boston/';
        $results = [];
        $error = null;
        $parser = new ParseDataService();
        $categoryModel = new CategoryModel();
        $companyModel = new CompanyModel();

        try {
            $html = $parser->fetchHtml($url);
            if ($html) {
                $results = $parser->parseResults($html);

                if (empty($results)) {
                    $error = 'No results found';
                } else {
                    // $this->syncCategories($results, $categoryModel);
                   $results = $this->updateCompanyResultsFromHtml($results, $categoryModel, $companyModel);
                }
            } else {
                $error = 'Empty response from source';
            }
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }

        if ($error) {
            return $this->response->setJSON([
                'status' => false,
                'message' => $error,
                'count' => 0,
                'data' => [],
            ]);
        }

        return $this->response->setHeader('Content-Type', 'text/plain')
            ->setBody(print_r($results, true));
    }

    private function syncCategories(array $results, CategoryModel $categoryModel): void
    {
        $db = \Config\Database::connect();
        foreach ($results as $row) {
            $name = isset($row['name']) ? trim($row['name']) : '';
            $name = preg_replace('/\s+/', ' ', $name);
            if ($name === '') {
                continue;
            }

            $exists = $db->query(
                "SELECT id FROM category WHERE CONVERT(name USING utf8) = ? LIMIT 1",
                [$name]
            )->getRowArray();
            if ($exists) {
                continue;
            }

            $startTime = $this->to24Hour($row['start_time'] ?? null);
            $endTime = $this->to24Hour($row['end_time'] ?? null);

            $categoryModel->insert([
                'name' => $name,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'com_interval' => '',
                'status' => 1,
                'result_type' => 'single',
                'result_mode' => 'auto',
                'com_showresult' => 1,
                'com_working' => 'MON,TUE,WED,THU,FRI,SAT',
            ]);
        }
    }

    private function to24Hour(?string $time12): ?string
    {
        if (!$time12) {
            return null;
        }
        $time12 = trim($time12);
        $dt = \DateTime::createFromFormat('h:i A', strtoupper($time12));
        if ($dt instanceof \DateTime) {
            return $dt->format('H:i:s');
        }
        $dt = \DateTime::createFromFormat('h:iA', strtoupper($time12));
        if ($dt instanceof \DateTime) {
            return $dt->format('H:i:s');
        }
        return null;
    }

    private function updateCompanyResultsFromHtml(
        array $parsedResults,
        CategoryModel $categoryModel,
        CompanyModel $companyModel
    ): array {
        if (empty($parsedResults)) {
            return [];
        }

        $categories = $categoryModel->select('id,name,result_mode')->findAll();
        $categoryMap = [];
        foreach ($categories as $cat) {
            $key = strtoupper(preg_replace('/\s+/', ' ', trim($cat['name'] ?? '')));
            if ($key !== '') {
                $categoryMap[$key] = [
                    'id' => $cat['id'],
                    'result_mode' => $cat['result_mode'] ?? null,
                ];
            }
        }

        $today = date('Y-m-d');
        $updated = [];

        foreach ($parsedResults as $row) {
            $name = isset($row['name']) ? trim($row['name']) : '';
            $nameKey = strtoupper(preg_replace('/\s+/', ' ', $name));
            if ($nameKey === '' || !isset($categoryMap[$nameKey])) {
                continue;
            }
            if (($categoryMap[$nameKey]['result_mode'] ?? null) !== 'auto') {
                continue;
            }

            $result = isset($row['result']) ? trim($row['result']) : '';
            $parts = array_values(array_filter(array_map('trim', explode('-', $result)), 'strlen'));
            if (count($parts) < 1) {
                continue;
            }
            $parts = array_pad($parts, 3, '');

            $parentId = $categoryMap[$nameKey]['id'];
            $companyModel->set([
                'com_open' => $parts[0],
                'com_mid' => $parts[1],
                'com_close' => $parts[2],
            ])
            ->where('com_parentid', $parentId)
            ->where('com_date', $today)
            ->update();

            $updated[] = [
                'name' => $name,
                'com_parentid' => $parentId,
                'com_open' => $parts[0],
                'com_mid' => $parts[1],
                'com_close' => $parts[2],
                'com_date' => $today,
            ];
        }

        return $updated;
    }

}
