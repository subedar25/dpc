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
                
<!--                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                                                data-toggle="modal" data-target="#addorder"><i class="ion ion-md-add-circle-outline"></i> Add New</button>
                    </div>
                </div>-->
               
            </div>
            
            <?php $showcheckbox =0;
             echo view('admin/companymul/_searchform',array("searchArray"=>$searchArray)); ?>
           

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <?php echo view('admin/_topmessage'); ?>
                        <div class="card-body">
                        
                        <?php if($pagination["getNbResults"] >0 ){ ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-centered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                        <?php if($showcheckbox){?>
                                            <th><input type="checkbox" name="checkall" id="checkall"></th>
                                        <?php } ?>
                                            <th>S No.</th>
                                            <th>Company Name</th>
                                            <th>Open</th>
                                            <th>Middle</th>
                                            <th>Close</th>
                                            <th>Description</th>
                                            
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Date</th>
                                          
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        foreach($resultData as $kdata){ ?>
                                        <tr>
                                        <?php if($showcheckbox){ ?>
                                            <th scope="row"><input type="checkbox" name="orderid[]" class="checkSingle" value="<?php echo $kdata->com_id; ?>"  <?php if(in_array($kdata->com_id, $arrselectedorderid)){ echo "checked"; }; ?>></th>
                                        <?php } ?>
                                            <th scope="row"><?php echo ++$startLimit ; ?></th>
                                           
                                            <td><?php echo $kdata->name; ?></td>
                                            <td><?php echo $kdata->com_open; ?></td>
                                            <td><?php echo $kdata->com_mid; ?></td>
                                            <td><?php echo $kdata->com_close; ?></td>
                                            <td><?php echo $kdata->com_desc; ?></td>
                                            <td><?php echo $kdata->com_starttime; ?></td>
                                            <td><?php echo $kdata->com_endtime; ?></td>
                                            <td><?php echo $kdata->com_date; ?></td>
                                           
                                            <td>
                                              
<!--                                                <a href="#" onclick="gethistoryEdit('<?php echo $kdata->com_id; ?>');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editorder">Edit</a>-->

                                              <a href="<?php echo site_url('delmulhistoryresult?id=' . $kdata->com_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                                     
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

<?php echo view('admin/companymul/_editresult'); ?>

    <!-- End Page-content -->  
    <script>

        


        $(document).ready(function() {
            $("#checkall").change(function() { 
                if (this.checked) {
                    $(".checkSingle").each(function() {
                        this.checked=true;
                        setorderid($(this).val());
                    });
                } else {
                    $(".checkSingle").each(function() {
                        this.checked=false;
                        removeorderid($(this).val());
                    });
                }
            });

            $(".checkSingle").click(function () {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;

                    $(".checkSingle").each(function() {
                        if (!this.checked)
                            isAllChecked = 1;
                    });

                    if (isAllChecked == 0) {
                        $("#checkall").prop("checked", true);
                    }  
                    setorderid($(this).val());
                }
                else {
                    $("#checkall").prop("checked", false);
                    removeorderid($(this).val());
                }
            });
        });

</script>
 
                <script type="text/javascript">
                     
                     
                    
                    function updateorderstatus(ordersnumber) {
            
                            var orderstatus ="correction";
                        //console.log(ordersnumber);
                            var request = $.ajax({
                                url: "<?php echo site_url('updateorderstatusfinal?ordersnumber='); ?>"+ordersnumber+"&orderstatus="+orderstatus,
                                cache: false,
                                contentType: false,
                                processData: false,
                                async: false,
                                data: "",
                                type: 'GET',

                                success: function(res) {
                                    console.log(res);
                                    responsedata = JSON.parse(res);
                                   // console.log(responsedata);
                                    if (responsedata.status == 201) {
                //                        console.log(responsedata.message);
                                         window.location.reload();
                                    }
                                },
                                fail: function(res) {
                                    errorFlag = true;
                                    console.log(res);

                                },
                                error: function(xhr, status, error) {
                                    errorFlag = true;
                                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                                    console.log('Error - ' + errorMessage);

                                }
                            })


                        }
                    </script>