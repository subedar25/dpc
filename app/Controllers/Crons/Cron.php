<?php
namespace App\Controllers\Crons;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CompanyModel;
use App\Models\CategoryModel;
use App\Models\CompanymulModel;
use App\Models\CompanymulhistoryModel;


#[\AllowDynamicProperties]
class Cron extends ResourceController
{

    use ResponseTrait;

    public function index()
    {
        $this->generatesingleresult();
        $this->generatemultipleresult();
    }


    public function generatesingleresult()
    {
       
        
        $category = new CategoryModel();
        
        $resultCompany = $category->where("result_type","single")->find();
        
       
            foreach($resultCompany as $hisDetails)
            {
                $companyModel = new CompanyModel();
                
               $resultCompanycheck = $companyModel->where("com_parentid",$hisDetails['id'])->where('com_starttime',$hisDetails['start_time'])->where('com_date',date('Y-m-d'))->first();
              //  echo $companyModel->getLastQuery();die;
              // print_r($resultCompanycheck);die;
                if(!$resultCompanycheck)
                {
                    $arrDetails = array(
                                        'com_parentid'=>$hisDetails['id'],
                                        'com_desc'=>$hisDetails['description'],
                                        'com_starttime'=>$hisDetails['start_time'],
                                        'com_endtime'=>$hisDetails['end_time'],
                                        'com_date'=>date('Y-m-d')
                                        );
                    
                    $companyModel->save($arrDetails);
                }
            }
            
           
            echo " sigle result generated";
    }
    
    
    public function generatemultipleresult()
    {
        
          $starttime ='';
            $endtime ='';
              // take back up of historical data
            $category = new CategoryModel();
        
            $resultCompany = $category->where("result_type","multiple")->find();
       
            foreach($resultCompany as $hisDetails)
            {
                 $starttime = $hisDetails['start_time'];
                    $endtime = $hisDetails['end_time'];
                    $time_interval = $hisDetails['com_interval'];
                     $startTimestamp = strtotime($starttime);
                     $endTimestamp = strtotime($endtime);
                     if ($endTimestamp <= $startTimestamp && $starttime !== $endtime) {
                         $endTimestamp = strtotime($endtime . ' +1 day');
                     }

                     $currentTimestamp = $startTimestamp;
                     while($currentTimestamp <= $endTimestamp)
                     {
                       $exection_time = date("H:i", $currentTimestamp);

                       $companyModel = new CompanymulhistoryModel();
                       
                       $resultCompanycheck = $companyModel->where("com_parentid",$hisDetails['id'])->where('com_starttime',$exection_time)->where('com_date',date('Y-m-d'))->first();
                        
                         if(!$resultCompanycheck)
                         {
                             $arrDetails = array(
                                                 'com_parentid'=>$hisDetails['id'],
                                                 'com_desc'=>$hisDetails['description'],
                                                 'com_starttime'=>$exection_time,
                                                 'com_endtime'=>$hisDetails['end_time'],
                                                 'com_date'=>date('Y-m-d')
                                                 );

                            $companyModel->save($arrDetails);
                         }
                        $currentTimestamp = strtotime("+$time_interval minutes", $currentTimestamp);
                     }
            }
            
        
            
            echo "multiple result done"; 
    }
    
    
    public function backupmultipleresult()
    {
      
              // take back up of historical data
             $companyModel = new   CompanymulModel();
            $resultCompany = $companyModel->find();
      
            foreach($resultCompany as $hisDetails)
            {
                $compantmulhistory = new CompanymulhistoryModel();
                
               $resultCompanycheck =  $compantmulhistory->where("com_starttime",$hisDetails['com_starttime'])->where('com_date',$hisDetails['com_date'])->first();
               
                if(!$resultCompanycheck)
                {
                    $arrDetails = array(
                                        'com_parentid'=>$hisDetails['com_parentid'],
                                        'com_desc'=>$hisDetails['com_desc'],
                                        'com_starttime'=>$hisDetails['com_starttime'],
                                        'com_endtime'=>$hisDetails['com_endtime'],
                                        'com_open'=>$hisDetails['com_open'],
                                        'com_mid'=>$hisDetails['com_mid'],
                                        'com_close'=>$hisDetails['com_close'],
                                        'com_date'=>$hisDetails['com_date']
                                        );
                  $compantmulhistory->save($arrDetails);
                }
            }
            
           $companyModel->truncate();
           
            echo "multiple result done"; 
    }

    public function writeinFile($stringData='')
    {
       // if($stringData) {
            $fh = fopen(PUBLIC_PATH.'query.txt', 'a');
            $stringData = "\n\n".date('d-m-y H:i')." - ".$stringData;
            fwrite($fh, $stringData);
          fclose($fh);
       // }
echo "Done";
    }



}
