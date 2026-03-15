<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-18">Settings</h4>
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


                        
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="list-group" id="settings-tabs" role="tablist">
                                    <a class="list-group-item list-group-item-action active" data-target="#settings-cpatti" href="javascript:void(0)">Cycle Motor Patti</a>
                                    <a class="list-group-item list-group-item-action" data-target="#settings-holiday" href="javascript:void(0)">Holiday</a>
                                    <a class="list-group-item list-group-item-action" data-target="#settings-message" href="javascript:void(0)">Message Details</a>
                                    <a class="list-group-item list-group-item-action" data-target="#settings-support" href="javascript:void(0)">Support Details</a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="border p-3">
                                    <div id="settings-holiday" class="settings-panel" style="display:none;">
                                        <form action="" id="frmholiday">
                                            <div class="row mb-2">
                                                <h4>Holiday</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label>Set Holiday</label>
                                                    <select name="GLOBAL_HOLIDAY" class="form-control">
                                                        <option value="0" <?php if(isset($settings['GLOBAL_HOLIDAY']) && $settings['GLOBAL_HOLIDAY']==0){ echo "selected"; }?>> No</option>
                                                        <option value="1" <?php if(isset($settings['GLOBAL_HOLIDAY']) && $settings['GLOBAL_HOLIDAY']==1){ echo "selected"; }?>> Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-lg-12">
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light mr-1"
                                                        onClick="updatesetting('frmholiday');">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="settings-message" class="settings-panel" style="display:none;">
                                        <form action="" id="frmmessage">
                                            <div class="row mb-2">
                                                <h4>Message Details</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label>Welcome Message</label>
                                                   <textarea rows="8" type="text" name="HOME_WELCOME_MESSAGE" id="HOME_WELCOME_MESSAGE"
                                                        class="form-control"><?php if(isset($settings['HOME_WELCOME_MESSAGE'])){ echo $settings['HOME_WELCOME_MESSAGE']; }?></textarea>
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>Top Message</label>
                                                   <textarea rows="8" type="text" name="MESSAGE_TOP" id="MESSAGE_TOP"
                                                        class="form-control"><?php if(isset($settings['MESSAGE_TOP'])){ echo $settings['MESSAGE_TOP']; }?></textarea>
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>Top Content</label>
                                                   <textarea rows="8" type="text" name="TOP_CONTENT" id="TOP_CONTENT"
                                                        class="form-control"><?php if(isset($settings['TOP_CONTENT'])){ echo $settings['TOP_CONTENT']; }?></textarea>
                                                </div>
                                            </div>
                                            <div class="row pt-4">
                                                <div class="col-lg-8">
                                                    <label>DISCLAIMER Message</label>
                                                   <textarea rows="8" type="text" name="DISCLAIMER" id="DISCLAIMER"
                                                        class="form-control"><?php if(isset($settings['DISCLAIMER'])){ echo $settings['DISCLAIMER']; }?></textarea>
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>WARNING Message</label>
                                                   <textarea rows="8" type="text" name="WARNING" id="WARNING"
                                                        class="form-control"><?php if(isset($settings['WARNING'])){ echo $settings['WARNING']; }?></textarea>
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>Special Message</label>
                                                    <textarea rows="8" type="text" name="SPECIAL_MESSAGE" id="SPECIAL_MESSAGE"
                                                        class="form-control"><?php if(isset($settings['SPECIAL_MESSAGE'])){ echo $settings['SPECIAL_MESSAGE']; }?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-8">
                                                    <label>Contact Message</label>
                                                   <textarea rows="8" type="text" name="MESSAGE_CONTACT" id="MESSAGE_CONTACT"
                                                        class="form-control"><?php if(isset($settings['MESSAGE_CONTACT'])){ echo $settings['MESSAGE_CONTACT']; }?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-lg-12">
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light mr-1"
                                                        onClick="updatesetting('frmmessage');">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="settings-support" class="settings-panel" style="display:none;">
                                        <form action="" id="frmsupport">
                                            <div class="row mb-2">
                                                <h4>Support Details</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label>Support Number</label>
                                                    <input type="text" name="SUPPORT_PHONE" id="SUPPORT_PHONE" class="form-control" value="<?php if(isset($settings['SUPPORT_PHONE'])){ echo $settings['SUPPORT_PHONE']; }?>">
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>Contact Number</label>
                                                    <input type="text" name="CONTACT_PHONE" id="CONTACT_PHONE" class="form-control" value="<?php if(isset($settings['CONTACT_PHONE'])){ echo $settings['CONTACT_PHONE']; }?>">
                                                    <span id="divsupportnumber"></span>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-lg-12">
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light mr-1"
                                                        onClick="updatesetting('frmsupport');">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="settings-cpatti" class="settings-panel">
                                        <form action="" id="frmcpatti">
                                            <div class="row mb-2">
                                                <h4>Cycle Motor Patti</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label>Cycle Patti</label>
                                                    <textarea type="text" name="CYCLE_PATTI" id="CYCLE_PATTI"
                                                        class="form-control" rows="10"><?php if(isset($settings['CYCLE_PATTI'])){ echo $settings['CYCLE_PATTI']; } ?></textarea>
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>Motor Patti</label>
                                                    <textarea type="text" name="MOTOR_PATTI" id="MOTOR_PATTI"
                                                        class="form-control" rows="10"><?php if(isset($settings['MOTOR_PATTI'])){ echo $settings['MOTOR_PATTI']; }?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-lg-12">
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light mr-1"
                                                        onClick="updatesetting('frmcpatti');">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->

</div>
<!-- End Page-content -->
<script>
// Settings left panel navigation
$(document).on('click', '#settings-tabs .list-group-item', function () {
    $('#settings-tabs .list-group-item').removeClass('active');
    $(this).addClass('active');
    $('.settings-panel').hide();
    $($(this).data('target')).show();
});



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
//                  console.log(res);
               responsedata = JSON.parse(res);
//                console.log(responsedata);
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
