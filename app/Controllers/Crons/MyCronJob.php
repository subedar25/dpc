<?php
namespace App\Controllers\Crons;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CompanyModel;
use App\Models\CategoryModel;
use App\Models\CompanymulModel;
use App\Models\CompanymulhistoryModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

#[\AllowDynamicProperties]
class MyCronJob extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'cron:mytask';
    protected $description = 'This is a sample cron job for CodeIgniter 4';

    public function run(array $params)
    {
        // Your task logic here (e.g., sending emails, updating database, etc.)
        CLI::write('Cron Job Executed Successfully!', 'green');
        
        // Example: Updating a database record
      //  $db = \Config\Database::connect();
       // $db->query("UPDATE tasks SET status = 'done' WHERE due_date < NOW()");
    }
}