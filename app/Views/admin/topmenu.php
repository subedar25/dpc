<?php $session = session(); ?>
<header id="page-topbar">

                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="<?php echo site_url('dashboard'); ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url('admin/images/logo.png'); ?>" alt="" >
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url('admin/images/logo.png'); ?>" alt="" >
                                </span>
                            </a>

                            <a href="<?php echo site_url('dashboard'); ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url('admin/images/logo.png'); ?>" alt="" >
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url('admin/images/logo.png'); ?>" alt="" >
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>

                       
                    </div>

                    

                    <div class="d-flex" style="color:#FFF;">
                    
                    <?php echo view('admin/_clock'); ?>
                   
                    </div>
                    <div class="d-flex " >

                        <div class="d-flex  " >

            
                        </div>

                        <div class="d-flex">

                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-settings" style="font-size:24px;"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <!-- item-->
                                    <a class="dropdown-item text-primary h4" > <?php echo  $session->get('admin_name'); ?> <br> <span class="text-muted h6"><?php echo  $session->get('admin_email'); ?><span> </a>
                                    <a class="dropdown-item" href="<?php echo site_url('adminprofile');?>"><i class="mdi mdi-account-outline font-size-17 align-middle mr-1"></i> Profile</a>
                                    <a class="dropdown-item" href="<?php echo site_url('cpassword');?>"><i class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Change Password</a>
                                    <!--<a class="dropdown-item" href="<?php echo site_url('settings');?>"><i class="mdi mdi-settings font-size-17 align-middle mr-1"></i> Settings</a>-->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="<?php echo site_url('logout'); ?>"><i class="ion ion-md-power  font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
                                </div>
                            </div>
                
                        </div>
                    </div>
                </div>
            </header>