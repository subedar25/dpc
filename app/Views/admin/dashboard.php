<?php 
use CodeIgniter\HTTP\RequestInterface;
$session = session(); 
$admin_type = $session->get('admin_type');
?>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Dashboard</h4>
                        <?php echo view('admin/_topmessage'); ?>
                        <div class="row">
                        
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card mini-stat camron_bg text-white">
                                    <a href="<?php echo site_url('todayresult');?>">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Today Result</h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;
                                            </h4>
                                            <div class="mini-stat-label bg-info">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">Today Result</p>
                                            </div>
                                        
                                    </div>
                                        </a>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="<?php echo site_url('multipleresult');?>">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Today Result Multiple </h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;
                                            </h4>
                                            <div class="mini-stat-label bg-danger">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">Today Result Multiple</p>
                                            </div>
                                        
                                    </div>
                                        </a>
                                </div>
                            </div>
                            
                            
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card mini-stat bg-success text-white">
                                    <a href="<?php echo site_url('cyclemotor');?>">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Cycle & Motor Patti</h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;
                                            </h4>
                                            <div class="mini-stat-label bg-warning">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">Cycle & Motor Patti</p>
                                            </div>
                                       
                                    </div>
                                         </a>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card mini-stat bg-warning text-white">
                                    <a href="<?php echo site_url('company');?>">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Company</h5>
                                            <h4 class="font-weight-medium font-size-24"><?php echo $companycount; ?>
                                            </h4>
                                            <div class="mini-stat-label bg-dark">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">All Company</p>
                                            </div>
                                       
                                    </div>
                                  </a>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card mini-stat bg-danger text-white">
                                    <a href="#" data-toggle="modal" data-target="#addcategory">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Create Company </h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;
                                            </h4>
                                            <div class="mini-stat-label bg-primary">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">Create Company</p>
                                            </div>
                                        
                                    </div>
                                        </a>
                                </div>
                            </div>
                        
                           
                            <div class="col-xl-3 col-md-6 ">
                                <a href="<?php echo site_url('companymul');?>">
                                <div class="card mini-stat bg-success text-white">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">List Multiple Company</h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;
                                            </h4>
                                            <div class="mini-stat-label bg-danger">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">List Multiple Company</p>
                                            </div>
                                       
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card mini-stat bg-dark text-white">
                                    <a href="<?php echo site_url('mulhistory');?>">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">List Result History</h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;
                                            </h4>
                                            <div class="mini-stat-label bg-warning">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">List Result History</p>
                                            </div>
                                       
                                    </div>
                                         </a>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 ">
                                <div class="card mini-stat bg-danger text-white">
                                    <a href="<?php echo site_url('settings');?>">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Setting & Notice</h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;
                                            </h4>
                                            <div class="mini-stat-label bg-primary">
                                               &nbsp;
                                            </div>
                                        </div>
                                        
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">Setting & Notice</p>
                                            </div>
                                       
                                    </div>
                                         </a>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-success text-white">
                                     <a href="<?php echo site_url('singleresult?rt=1');?>">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Create Sigle result</h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;</h4>

                                            <div class="mini-stat-label bg-dark">
                                                 &nbsp;
                                            </div>
                                        </div>
                                       
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">Create Single result</p>
                                            </div>
                                       
                                    </div>
                                          </a>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                 <a href="<?php echo site_url('multipleresults?rt=1');?>">
                                <div class="card mini-stat camron_bg text-white">
                                    <div class="card-body">
                                        <div class="mb-4">

                                            <h5 class="font-size-16 text-uppercase mt-0 text-white">Create Multiple result</h5>
                                            <h4 class="font-weight-medium font-size-24">&nbsp;</h4>

                                            <div class="mini-stat-label bg-danger">
                                                 &nbsp;
                                            </div>
                                        </div>
                                       
                                            <div class="pt-2">

                                                <div class="float-right">
                                                    <i class="mdi mdi-arrow-right h5 text-white"></i>
                                                </div>

                                                <p class="text-white mb-0 mt-1">Create Multiple result</p>
                                            </div>
                                        
                                    </div>
                                </div>
                                     </a>
                            </div>
                          
                        </div>
                       
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="<?php echo site_url(); ?>" target="_blank"> Go to Front end </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->