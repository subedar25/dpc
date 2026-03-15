<div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        <div class="col-12 border-bottom  pb-2">
                            <h2>Change Password</h2>
                        </div>

                        <div class="col-8 mt-2">
                            
                               <form class="custom-validation"  id='add_member_form' method='post' action="<?php echo site_url('updatepassword'); ?>"  enctype='multipart/form-data'>

                               <?php echo view('admin/_topmessage'); ?>

                               <!-- <div class="form-group">
                                    <label>Old Password</label>
                                    <div>
                                    <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control form-control-lg" required>
                                    </div>
                                </div> -->

                                <div class=" form-group" >
                                    <label>New Password</label>
                                    <div class="input-group form-group" id="show_hide_password">
                                            <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </span>
                                            <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" placeholder="New password" required>
                                            <div class="input-group-append" >
                                                <span class="input-group-text"><a href="javascript::void(0);" onclick="showhidepass()"><i class="fa fa-eye-slash"></a></i></span>
                                            </div>
                                        </div>
                                </div>

                                <div class=" form-group" >
                                     <label>Confirm Password</label>
                                    <div class="input-group form-group" id="show_hide_password">
                                            <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </span>
                                            <input type="password" class="form-control form-control-lg" id="cnf_new_password" name="cnf_new_password" placeholder="Confirm password" required>
                                            <div class="input-group-append" >
                                                <span class="input-group-text"><a href="javascript::void(0);" onclick="showhidepass()"><i class="fa fa-eye-slash"></a></i></span>
                                            </div>
                                        </div>
                                </div>


                                
                               
                                <div class="form-group ">
                                    <div class="w-50 float-left pr-4">
                                        <button type="submit" class="btn btn-lg btn-block btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>
                                    </div>
                                    <div class="w-50 float-right pl-4">
                                        <button type="reset" class="btn btn-lg btn-block btn-secondary waves-effect" onClick="window.history.back();">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->    
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <script>

        function showhidepass()
        {
            if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
        }

    
    </script>