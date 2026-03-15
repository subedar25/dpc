<form action="" id="ordersearch">
    <div class="row">
        <div class="col-xl-12">
            <div class="card ">

                <div class="card-body">
                    <!-- Row start -->
                    
                        <h4>Search Orders</h4>
                  
                    <div class="row">
                        <div class="col-xl-12 ">
                            <div class="col-md-3 mt-4 float-left ">
                                <input class="form-control" name="txtsearch" type="text"
                                    value="<?php echo $txtsearch; ?>" placeholder="Search by Company name">

                            </div>

                            <div class="col-md-3 mt-4 float-left ">
                                <select class="form-control" name="result_mode">
                                    <option value="">All Result Mode</option>
                                    <option value="manual" <?php if(isset($result_mode) && $result_mode=='manual'){ echo 'selected="selected"'; } ?>>Manual</option>
                                    <option value="auto" <?php if(isset($result_mode) && $result_mode=='auto'){ echo 'selected="selected"'; } ?>>Auto</option>
                                </select>
                            </div>
                            


                            <div class="col-lg-6 mt-6 float-left mt-4 " >

                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                                <a href="#"><button type="button" class="btn btn-primary waves-effect waves-light mr-1"
                                     data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="Clear Search Filters">
                                    <i class="mdi mdi-refresh"></i>Clear
                                </button></a>

                               
                                
                                
                                

                            </div>

                        </div>
                    </div>
                    <!-- row end -->

                    <div class="row">
                        <div class="col-lg-12 ">
                            <div id="errMsgstatusupdate" style="display:none;" class="alert alert-danger alert-dismissible fade show mb-0 w-50  mt-2" role="alert"> </div>
                            <div id="succMsgstatusupdate" style="display:none;" class="alert alert-success alert-dismissible fade show mb-0 w-50  mt-2" role="alert"> </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
