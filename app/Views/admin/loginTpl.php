    <div class="account-pages ">
    
        <div class="navbar-header bg-seconday border-bottom" style="background-color:#e9ecef">
            <div class="d-flex float-left ml-4">
            <a href="<?php echo site_url('dashboard'); ?>" > <img src="<?php echo base_url('images/dpcash.png'); ?>"  alt="<?php echo SITE_NAME; ?>"></a>
            </div>
                <div class="d-flex">
                
                </div>
            <div class="d-flex float-right">
           
            </div>
        </div>

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <div class="p-3">
                                <form class="form-horizontal mt-4" method="post" role="form" name="loginForm" id="loginForm" action="<?php echo site_url("admin");?>" >

                                	<?php echo \Config\Services::validation()->listErrors(); ?>
                                    <?php echo csrf_field() ?>
                                    <?php echo view('admin/_topmessage'); ?>

                                    <div class=" form-group">
                                        <!-- <label for="username">Username</label> -->
                                        <div class="input-group ">
                                        <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </span>
                                        <input type="text" class="form-control form-control-lg " id="username" name="username" value="<?php echo isset($cameronadmin) ? $cameronadmin : ''; ?>" placeholder="Email Id" required="">
                                        </div>
                                    </div>
                                    

                                    <div class=" form-group" >
                                        <!-- <label for="username">Password</label> -->
                                        <div class="input-group form-group" id="show_hide_password">
                                                <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </span>
                                                <input type="password" class="form-control form-control-lg" id="password" name="password" value="<?php echo isset($cameronadminpass) ? $cameronadminpass : ''; ?>" placeholder="Enter password" required>
                                                <div class="input-group-append" >
                                                    <span class="input-group-text"><a href="javascript::void(0);" onclick="showhidepass()"><i class="fa fa-eye-slash"></a></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="custom-control  custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline" name="adminremember" <?php echo isset($adminremember) ? 'checked' : 'checked'; ?>>
                                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div> -->
                                    </div>
                                    
                                   

                                    <div class="form-group">
                                            <button class="btn btn-block btn-lg btn-primary camron_bg w-md waves-effect waves-light" type="submit">Log In</button>
                                        
                                    </div>

                                    <div class="form-group mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>

                    <!-- <div class="mt-5 text-center">
                       <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Fluid9. </p>
                    </div> -->


                </div>
            </div>
        </div>
    </div>

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