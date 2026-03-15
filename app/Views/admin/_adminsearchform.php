<form action="" id="frmusers">
<div class="row">
    <div class="col-xl-12">
            <div class="card ">
                
                    <div class="card-body">

                        <div class="row ">

                            <div class="col-lg-4 ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search by name, mobile" >
                                    </div>
                                </div>
                            </div>
                        <?php if($admin_type =="admin"){ ?>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select class="form-control" name="user_type">
                                            <option value="">-Select user type-</option>
                                            <?php foreach($accountype as $key=>$value){ ?>
                                                <option value="<?php echo $key;?>" <?php if($key ==$user_type){ echo "selected"; }?>> <?php echo $value; ?> </option>
                                                <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                        Submit
                                    </button>

                                    <button type="button" class="btn btn-primary waves-effect waves-light mr-1" onClick="exportdata();" data-toggle="tooltip" data-placement="top" title="" data-original-title="Export to excel">
                                       <i class="fas fa-file-export "></i> Export
                                    </button>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
            </div>
        </div>
</div>
</form> 

<script>
function exportdata()
          {
            var formdata = $('#frmusers').serialize();
            window.open("<?php echo site_url('usersexportexcel'); ?>?"+formdata);   
          }
    </script>