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