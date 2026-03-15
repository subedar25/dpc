<?php $session = session(); 
$admin_type = $session->get('admin_type');
?>
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title"></li>

                            <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('dashboard'); ?>" class="waves-effect ">
                                    <i class="ti-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            
                            
                            <li class="" style="border-bottom: 1px solid #5f6369">
                               <a href="<?php echo site_url('todayresult'); ?>" class="waves-effect ">
                                <i class="dripicons-bell"></i>
                                    <span>Today Result </span>
                                </a>
                                
                            </li>
                            <li class="" style="border-bottom: 1px solid #5f6369">
                               <a href="<?php echo site_url('multipleresult'); ?>" class="waves-effect ">
                                <i class="dripicons-bell"></i>
                                    <span>Today Multiple Result </span>
                                </a>
                                
                            </li>
                            
                            <?php if(in_array($admin_type,array('admin'))){ ?>
                            
                            
                            
                            <li class="" style="border-bottom: 1px solid #5f6369">
                               <a href="<?php echo site_url('mulhistory'); ?>" class="waves-effect ">
                                <i class="dripicons-alarm"></i>
                                    <span>Result History</span>
                                </a>
                                
                            </li>
                            
                            <!-- <li style="border-bottom: 1px solid #5f6369" >
                                <a href="<?php echo site_url('cyclemotor'); ?>" >
                                        <i class="dripicons-bell "></i>
                                        <span>Cycle Motor Patti</span>
                                    </a>
                                    
                                </li> -->
                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <i class="far fa-file"></i>
                                    <span>Manage Company</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('company'); ?>">List Company</a>
                                    </li>
                                    
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('companymul'); ?>">List Company Multiple result</a>
                                    </li>
                                     <li style="border-bottom: 1px solid #5f6369;">
                                         <a href="#" data-toggle="modal" data-target="#addcategory"  >Create Company</a></li> 
                                </ul>
                            </li>
                            
                           
                                <li style="border-bottom: 1px solid #5f6369" >
                                <a href="<?php echo site_url('settings'); ?>" >
                                        <i class="mdi mdi-settings "></i>
                                        <span>Settings</span>
                                    </a>
                                    
                                </li>
                            
                            <?php } ?>   
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
          <?php echo view('admin/category/_addcategory'); ?>