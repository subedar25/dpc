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

<!--                            <div class="col-md-3 mt-4 float-left  ">

                                <div class="input-daterange input-group">
                                    <input type="hidden" class="form-control" name="fromdate" id="startDate"
                                        placeholder="From date">
                                    <input type="hidden" class="form-control" name="todate" id="endDate"
                                        placeholder="To date">
                                    <div id="reportrange"
                                        style="background: #fff; cursor: pointer; padding: 5px 8px; width:100%;border: 1px solid #ccc;">
                                        <span></span>
                                    </div>
                                </div>

                            </div>-->


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

<script>
function setorderid(id)
          {

           
                // console.log(form_data1);
            
                var request = $.ajax( {
                            url : "<?php echo site_url('addordernumber'); ?>?odid="+id,
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: "",
                            type: 'GET',
                            
                            success: function(res) {
//                              console.log(res);
                               responsedata = JSON.parse(res);
                               if(responsedata.status==201)
                               {
                                $('#succMsgstatusupdate').css('display','block');
                                $('#succMsgstatusupdate').html(responsedata.message);
                                $('#errMsgstatusupdate').css('display','none');
                               // window.location.reload();
                               }
                               else
                               {
                                   $('#succMsgstatusupdate').css('display','none');
                                   $('#errMsgstatusupdate').css('display','block');
                                    $('#errMsgstatusupdate').html(responsedata.message);
                               }
                                
                            },
                            fail: function(res) {
                                errorFlag = true;
                               // console.log(res);
                                
                            },
                            error: function(xhr, status, error) {
                                errorFlag = true;
                                var errorMessage = xhr.status + ': ' + xhr.statusText;
                                console.log('Error - ' + errorMessage);
                                
                            }
                        })
               

                   
          }
          
          function removeorderid(id)
          {

           
                // console.log(form_data1);
            
                var request = $.ajax( {
                            url : "<?php echo site_url('removeordernumber'); ?>?odid="+id,
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: "",
                            type: 'GET',
                            
                            success: function(res) {
                              // console.log(res);
                               responsedata = JSON.parse(res);
                               if(responsedata.status==201)
                               {
                                $('#succMsgstatusupdate').css('display','block');
                                $('#succMsgstatusupdate').html(responsedata.message);
                                $('#errMsgstatusupdate').css('display','none');
                               // window.location.reload();
                               }
                               else
                               {
                                   $('#succMsgstatusupdate').css('display','none');
                                   $('#errMsgstatusupdate').css('display','block');
                                    $('#errMsgstatusupdate').html(responsedata.message);
                               }
                                
                            },
                            fail: function(res) {
                                errorFlag = true;
                               // console.log(res);
                                
                            },
                            error: function(xhr, status, error) {
                                errorFlag = true;
                                var errorMessage = xhr.status + ': ' + xhr.statusText;
                                console.log('Error - ' + errorMessage);
                                
                            }
                        })
               

                   
          }

</script>
