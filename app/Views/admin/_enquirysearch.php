<form action="" id="frmenquiry">
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
            var formdata = $('#frmenquiry').serialize();
            window.open("<?php echo site_url('enquiryexportexcel'); ?>?"+formdata);   
          }
    </script>