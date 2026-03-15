<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4 class="font-size-18">Customers List</h4>
                    </div>
                </div>
           
                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo site_url('newuser'); ?>">
                                <i class="ion ion-md-add-circle-outline"></i> Add
                            </a>
                        </div>
                    </div>
                </div>
        
            </div>
            <?php echo view('admin/users/_searchform'); ?>
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <?php echo view('admin/_topmessage'); ?>
                        <div class="card-body">
                        
                        <?php if($pagination["getNbResults"] >0 ){ ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-centered table-nowrap ">
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Company Name</th>
                                            
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                           
                                           
                                            <th>Created Date</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        foreach($usersData as $kdata){ ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$startLimit ; ?></th>
                                            <td><?php echo $kdata->companyname; ?></td>
                                           
                                            <td><?php echo $kdata->fname.' '.$kdata->lname; ?></td>
                                            <td><?php echo $kdata->phone; ?></td>
                                            <td><?php echo $kdata->email; ?></td>
                                           
                                            <td><?php echo $kdata->user_created; ?></td>
                                           
                                            <td width="8%">
                                                    <a href="<?php echo site_url('edituser?id=' . $kdata->id) ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?php echo site_url('deluser?id=' . $kdata->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a> 
                                          
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php if ($pagination['haveToPaginate']) { ?>
                                <br>
                                <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'users', 'varExtra' => $searchArray)); ?>

                                <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo view('admin/_noresult'); ?>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->

    </div>
    <!-- End Page-content -->  

    