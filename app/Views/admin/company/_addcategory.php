<div class="modal fade bs-example-modal-center" id="addcategory" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" >Add Company</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <div id="formupdatemsg" style="display:none" class="alert alert-success alert-dismissible fade show mb-0  mb-4 mt-2 col-lg-4"></div>
                    <div>
                            <div class="card-body">
                               
                                    <div class=" col-lg-12">
                                        
                                        <form action="javascript:void(0);"  method="post" id="addcategoryform" onSubmit="addcayegory();" >


                                <div  class=" col-lg-12">
                                    <div class="row  form-group">
                                        <label>Company Name<i class="text-danger">*</i></label>
                                        <input class="form-control"  name="com_name" id="com_name" type="text" value="" required="" >
                                    </div>

                                    <div class="row  form-group">
                                        <label>Start Time<i class="text-danger"></i></label>
                                    </div>
                                    <div class="row  form-group">
                                            <div style="width:150px;float: left;">
                                                 <select class="form-control" id="start_hr" name="start_hr">
                                                    <option value="00">Start Hours</option>
                                                    <?php for($i=1;$i<=24;$i++){ ?>
                                                    <option value="<?php echo $i; ?>" ><?php echo ($i < 10) ? date('h A',  strtotime('0'.$i.":00")) : date('h A',  strtotime($i.":00")); ?></option>
                                                    <?php } ?>
                                                  </select>

                                            </div>
                                            <div style="width:150px; float: left;">                                                
                                                 <select class="form-control" id="start_min" name="start_min">
                                                    <option value="00">Start Min</option>
                                                    <?php for($i=0;$i<60;$i++){ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo ($i < 10) ? '0'.$i." Mints" : $i." Mints"; ?></option>
                                                    <?php } ?>
                                                  </select>

                                            </div>
                                    </div>



                                    <div class="row  form-group">
                                        <label>End Time<i class="text-danger"></i></label>
                                    </div>
                                    <div class="row  form-group">
                                       
                                            <div style="width:150px;float: left;">
                                                 <select class="form-control" id="end_time" name="end_hr">
                                                    <option value="00">End Hour</option>
                                                    <?php for($i=1;$i<=24;$i++){ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo ($i < 10) ? date('h A',  strtotime('0'.$i.":00")) : date('h A',  strtotime($i.":00")); ?></option>
                                                    <?php } ?>
                                                  </select>

                                            </div>
                                            <div style="width:150px; float: left;">
                                                 <select class="form-control" id="end_min" name="end_min">
                                                    <option value="00">End Min</option>
                                                    <?php for($i=0;$i<60;$i++){ ?>
                                                    <option value="<?php echo $i; ?>" ><?php echo ($i < 10) ? '0'.$i." Mints" : $i." Mints"; ?></option>
                                                    <?php } ?>
                                                  </select>

                                            </div>

                                    </div>

                                    <div class="row  form-group">
                                        <label>Description</label>
                                        <textarea rows="2" class="form-control" name="com_desc" id="com_desc"></textarea>
                                    </div>
                                    <div class="row form-group">
                                        <label>Background Color</label>
                                        <input class="form-control" name="bg_color" id="bg_color" type="text" placeholder="#ff0000 or red">
                                    </div>

                                    <div class="row  form-group">

                                        <label>Company Type</label>
                                        <select id="txtStatus" name="txtResulttype" class="form-control">
                                            <option  value="single">Single Result</option>
                                            <option  value="multiple">Multiple Result</option>
                                        </select>
                                    </div>

                                    <div class="row  form-group">

                                        <label>Interval</label>
                                        <select id="txtinterval" name="txtinterval" class="form-control">
                                            <option value="">Select Interval</option>
                                            <option value="15" >15 Mints</option>
                                            <option value="30">30 Mints</option>
                                            <option value="45">45 Mints</option>
                                            <option value="60">1 Hours</option>
                                            <option value="120">2 Hours</option>
                                        </select>
                                    </div>
                                    <div class="row  form-group">

                                        <label>Status</label>
                                        <select id="txtStatus" name="txtStatus" class="form-control">
                                             <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                           
                                        </select>
                                    </div>

                                    <div class="row  form-group">

                                        <label>Show Result</label>
                                        <select id="txtStatus" name="showresult" class="form-control">
                                             <option  value="1">Active</option>
                                            <option  value="0">Inactive</option>
                                           
                                        </select>
                                    </div>
                                    <div class="row  form-group">

                                        <label>Working</label>
                                        <table width="100%" >
                                            <tr>
                                                <td><input type="checkbox" name="workingday[]" value="MON" > </td>
                                                <td>Monday </td>
                                                <td><input type="checkbox" name="workingday[]" value="TUES" > </td>
                                                <td>Tuesday </td>
                                                <td><input type="checkbox" name="workingday[]" value="WED" > </td>
                                                <td>Wednesday </td>
                                            </tr>
                                            <tr>
                                                
                                                <td><input type="checkbox" name="workingday[]" value="THURS" > </td>
                                                <td>Thursday </td>
                                                <td><input type="checkbox" name="workingday[]" value="FRI" > </td>
                                                <td>Friday </td>
                                                <td><input type="checkbox" name="workingday[]" value="SAT" > </td>
                                                <td>Saturday </td>
                                            </tr>
                                            <tr>
                                                
                                                <td><input type="checkbox" name="workingday[]" value="SUN" > </td>
                                                <td>Sunday </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                            </tr>
                                        </table>
                                       
                                    </div>

                                    <div class="row  form-group">

                                        <div class="col-5 ">
                                            
                                            <input type="submit" name="exsubmit" class="btn btn-primary waves-effect waves-light mr-1" value="Submit">
                                        </div>
                                        <div class="col-5 ">


                                        </div>

                                    </div>







                                    <!-- Form elements here -->

                                </div>



                            </form>   
                                    
                                    </div>
                               
                            </div>

                            
                        </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>

    
 function addcayegory()
          {
            
            var form = $('#addcategoryform')[0];
            var formdata = new FormData(form);

                var request = $.ajax( {
                            url : "<?php echo site_url('addcompany'); ?>",
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: formdata,
                            type: 'POST',
                            
                            success: function(res) {
                            //   console.log(res);
                                responsedata = JSON.parse(res);
                                
                                if (responsedata.status == 201) {

                                $("#formupdatemsg").html(responsedata.message);
                                $('#formupdatemsg').css('display','block');
                                
                                 $('#addorder').modal('toggle');
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
