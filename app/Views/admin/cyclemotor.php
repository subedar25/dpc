<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-18">Cycle Motor Patti</h4>
                </div>
            </div>

           
        </div>



        <div class="row">
            <div class="col-xl-12">
                <div class="card">

                    <div class="card-body border">

                        <?php echo view('admin/_topmessage'); ?>

                        <div class="row mb-4">
                            <div class="col-lg-12 ">
                                <div id="errMsgs" style="display:none;"
                                    class="alert alert-danger alert-dismissible fade show mb-0 w-50  mt-2" role="alert">
                                </div>
                                <div id="succMsg" style="display:none;"
                                    class="alert alert-success alert-dismissible fade show mb-0 w-50  mt-2"
                                    role="alert"> </div>
                            </div>
                        </div>


                        <div class="row ">
                            <div class="col-xl-12 mr-4 border">
                                <form action="" id="frmcpatti">
                                    <div class="row ">
                                        <div class="col-xl-12">

                                            <!-- Row start -->
                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                                <label>Cycle Patti:</label>
                                                    <textarea type="text" name="CYCLE_PATTI" id="CYCLE_PATTI"
                                                        class="form-control"><?php if(isset($settings['CYCLE_PATTI'])){ echo $settings['CYCLE_PATTI']; } ?></textarea>
                                                </div>
                                                <div class="col-lg-6">
                                                <label>Motor Patti:</label>
                                                    <textarea type="text" name="MOTOR_PATTI" id="MOTOR_PATTI"
                                                        class="form-control"><?php if(isset($settings['MOTOR_PATTI'])){ echo $settings['MOTOR_PATTI']; }?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-lg-12  ">
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light mr-1"
                                                        onClick="updatesetting('frmcpatti');">
                                                        Update
                                                    </button>
                                                    
                                                </div>

                                            </div>

                                            <!-- row end -->
                                        </div>
                                    </div>
                                </form>
                            </div>




                            
                        </div>
                        <hr>

                        

                        
                        
                        
                        

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->

</div>
<!-- End Page-content -->
<script>



function updatesetting(formid) {
    var formid = $('#' + formid);
    var form = formid[0];
    var form_data = new FormData(form);

    //console.log(fileList);
    $('#succMsg').css('display', 'none');
    $('#errMsgs').css('display', 'none');

        var request = $.ajax({
            url: "<?php echo site_url('updatesettingvalues'); ?>",
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: form_data,
            type: 'POST',
            
            success: function(res) {
               //   console.log(res);
               responsedata = JSON.parse(res);
               // console.log(responsedata);
                if (responsedata.status == 201) {
                 
                    $('#succMsg').css('display', 'block');
                    $('#succMsg').html(responsedata.message);
                    $('#errMsgs').css('display', 'none');
                } else {
                    $('#errMsgs').css('display', 'block');
                    $('#errMsgs').html(responsedata.message);
                    $('#succMsg').css('display', 'none');

                }



            },
            fail: function(res) {
                errorFlag = true;
                // console.log(res);
                uploadajax();
            },
            error: function(xhr, status, error) {
                errorFlag = true;
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.log('Error - ' + errorMessage);

            }
        })
    
}
</script>