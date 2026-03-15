<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4 class="font-size-18"><?php echo $pagetitle; ?></h4>
                    </div>
                </div>

                <!-- <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo site_url('newaccount'); ?>">
                                <i class="ion ion-md-add-circle-outline"></i> Add
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
            <?php echo view('admin/_enquirysearch'); ?>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <?php echo view('admin/_topmessage'); ?>
                        <div class="card-body">
                       
                        <?php if($pagination["getNbResults"] >0 ){ ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-centered table-nowrap mb-0" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th onclick="sortTable(1)">Studio Name</th>
                                            <th>Mobile</th>
                                            <th>State</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        foreach($salesData as $kdata){ ?>
                                        <tr>
                                            <td scope="row"><?php echo ++$startLimit ; ?></td>
                                            <td ><?php echo $kdata->en_studioname; ?></td>
                                            <td><?php echo $kdata->en_mobile; ?></td>
                                            <td><?php echo $kdata->en_state; ?></td>
                                            <td><?php echo $kdata->en_description; ?></td>
                                            <td><?php echo $kdata->en_date; ?></td>
                                            <td width="8%">
                                                    <a href="<?php echo site_url('delenquiry?id=' . $kdata->en_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php if ($pagination['haveToPaginate']) { ?>
                                <br>
                                <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => $action, 'varExtra' => $searchArray)); ?>

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

    