
<form action="javascript:void(0);"  method="post" id="editcompanyform" onSubmit="updateresult();" >


    <div id="orderformdata" class=" col-lg-12">
        <div class="row  form-group">
            <label>Company Name<i class="text-danger">*</i></label>
            <input class="form-control"  name="com_name" id="com_name" type="text" value="<?php echo $orderDetails->name; ?>" required="" >
        </div>

        <div class="row  form-group">
            <label>Start Time<i class="text-danger"></i></label>
        </div>
        <div class="row  form-group">
          
         <?php
            $start_time = explode(":", (string) $orderDetails->start_time);
            $start_hr = $start_time[0] ?? '00';
            $start_min = $start_time[1] ?? '00';
         ?>
                <div style="width:150px;float: left;">
                     <select class="form-control" id="start_hr" name="start_hr">
                        <option value="00">Start Hours</option>
                        <?php for($i=1;$i<=24;$i++){ ?>
                        <option value="<?php echo $i; ?>" <?php if($start_hr==$i){ echo 'selected="selected"';}?>><?php echo ($i < 10) ? date('h A',  strtotime('0'.$i.":00")) : date('h A',  strtotime($i.":00")); ?></option>
                        <?php } ?>
                      </select>

                </div>
                <div style="width:150px; float: left;">                                                
                     <select class="form-control" id="start_min" name="start_min">
                        <option value="00">Start Min</option>
                        <?php for($i=0;$i<60;$i++){ ?>
                        <option value="<?php echo $i; ?>" <?php if($start_min==$i){ echo 'selected="selected"';}?>><?php echo ($i < 10) ? '0'.$i." Mints" : $i." Mints"; ?></option>
                        <?php } ?>
                      </select>

                </div>
        </div>



        <div class="row  form-group">
            <label>End Time<i class="text-danger"></i></label>
        </div>
        <div class="row  form-group">

           
            <?php
                $end_time = explode(":", (string) $orderDetails->end_time);
                $end_hr = $end_time[0] ?? '00';
                $end_min = $end_time[1] ?? '00';
            ?>
                <div style="width:150px;float: left;">
                     <select class="form-control" id="end_time" name="end_hr">
                        <option value="00">End Hour</option>
                        <?php for($i=1;$i<=24;$i++){ ?>
                        <option value="<?php echo $i; ?>" <?php if($end_hr==$i){ echo 'selected="selected"';}?>><?php echo ($i < 10) ? date('h A',  strtotime('0'.$i.":00")) : date('h A',  strtotime($i.":00")); ?></option>
                        <?php } ?>
                      </select>

                </div>
                <div style="width:150px; float: left;">
                     <select class="form-control" id="end_min" name="end_min">
                        <option value="00">End Min</option>
                        <?php for($i=0;$i<60;$i++){ ?>
                        <option value="<?php echo $i; ?>" <?php if($end_min==$i){ echo 'selected="selected"';}?>><?php echo ($i < 10) ? '0'.$i." Mints" : $i." Mints"; ?></option>
                        <?php } ?>
                      </select>

                </div>

        </div>

        <div class="row  form-group">
            <label>Description</label>
            <textarea rows="4" class="form-control" name="com_desc" id="com_desc"><?php echo $orderDetails->description; ?></textarea>
        </div>
        <div class="row form-group">
            <label>Background Color</label>
            <input class="form-control" name="bg_color" id="bg_color" type="text" value="<?php echo isset($orderDetails->bg_color) ? $orderDetails->bg_color : ''; ?>" placeholder="#ff0000 or red">
        </div>

        <div class="row  form-group">

            <label>Company Type</label>
            <select id="txtStatus" name="txtResulttype" class="form-control">
                <option <?php if ($orderDetails->result_type == 'single') { ?> selected="selected" <?php } ?> value="single">Single Result</option>
                <option <?php if ($orderDetails->result_type == 'multiple') { ?> selected="selected"<?php } ?> value="multiple">Multiple Result</option>
            </select>
        </div>
        <div class="row  form-group">

            <label>Interval</label>
            <select id="txtinterval" name="txtinterval" class="form-control">
                <option value="">Select Interval</option>
                <option value="15" <?php if ($orderDetails->com_interval == 15) { ?> selected="selected" <?php } ?> >15 Mints</option>
                <option value="30" <?php if ($orderDetails->com_interval == 30) { ?> selected="selected" <?php } ?>>30 Mints</option>
                <option value="45" <?php if ($orderDetails->com_interval == 45) { ?> selected="selected" <?php } ?>>45 Mints</option>
                <option value="60" <?php if ($orderDetails->com_interval == 60) { ?> selected="selected" <?php } ?>>1 Hours</option>
                <option value="120" <?php if ($orderDetails->com_interval == 120) { ?> selected="selected" <?php } ?>>2 Hours</option>
            </select>
        </div>
        <div class="row  form-group">

            <label>Status</label>
            <select id="txtStatus" name="txtStatus" class="form-control">
                <option <?php if ($orderDetails->status == 0) { ?> selected="selected" <?php } ?> value="0">Inactive</option>
                <option <?php if ($orderDetails->status == 1) { ?> selected="selected"<?php } ?> value="1">Active</option>
            </select>
        </div>
        <div class="row  form-group">

            <label>Result Type</label>
            <?php $resultMode = isset($orderDetails->result_mode) ? $orderDetails->result_mode : "manual"; ?>
            <select id="result_mode" name="result_mode" class="form-control">
                <option <?php if ($resultMode == 'manual') { ?> selected="selected" <?php } ?> value="manual">Manual</option>
                <option <?php if ($resultMode == 'auto') { ?> selected="selected"<?php } ?> value="auto">Auto</option>
            </select>
        </div>
        
        <div class="row  form-group">

            <label>Show Result</label>
            <select id="txtStatus" name="showresult" class="form-control">
                <option <?php if ($orderDetails->com_showresult == 0) { ?> selected="selected" <?php } ?> value="0">Inactive</option>
                <option <?php if ($orderDetails->com_showresult == 1) { ?> selected="selected"<?php } ?> value="1">Active</option>
            </select>
        </div>
        <div class="row  form-group">

            <label>Order no</label>
            <select id="txtStatus" name="com_order" class="form-control">
            <?php for($i=0;$i<60;$i++){ ?>
                        <option value="<?php echo $i; ?>" <?php if($orderDetails->com_order==$i){ echo 'selected="selected"';}?>><?php echo $i; ?></option>
                        <?php } ?>
            </select>
        </div>
        
        <?php $working = $orderDetails->com_working; $workingArr = explode(",", $working); ?>
        <div class="row  form-group">

            <label>Working</label>
            <div style="margin-bottom:6px;">
                <input type="checkbox" class="workingday-select-all" id="workingday_select_all_edit">
                <label for="workingday_select_all_edit" style="margin-left:4px;">Select All</label>
            </div>
            <table width="100%" >
                <tr>
                    <td><input type="checkbox" class="workingday" id="edit_working_mon" name="workingday[]" value="MON" <?php if(in_array("MON", $workingArr)){ echo "checked"; } ?>> </td>
                    <td><label for="edit_working_mon">Monday</label></td>
                    <td><input type="checkbox" class="workingday" id="edit_working_tue" name="workingday[]" value="TUE" <?php if(in_array("TUE", $workingArr)){ echo "checked"; } ?>> </td>
                    <td><label for="edit_working_tue">Tuesday</label></td>
                    <td><input type="checkbox" class="workingday" id="edit_working_wed" name="workingday[]" value="WED" <?php if(in_array("WED", $workingArr)){ echo "checked"; } ?>> </td>
                    <td><label for="edit_working_wed">Wednesday</label></td>
                </tr>
                <tr>

                    <td><input type="checkbox" class="workingday" id="edit_working_thu" name="workingday[]" value="THU"<?php if(in_array("THU", $workingArr)){ echo "checked"; } ?> > </td>
                    <td><label for="edit_working_thu">Thursday</label></td>
                    <td><input type="checkbox" class="workingday" id="edit_working_fri" name="workingday[]" value="FRI" <?php if(in_array("FRI", $workingArr)){ echo "checked"; } ?> > </td>
                    <td><label for="edit_working_fri">Friday</label></td>
                    <td><input type="checkbox" class="workingday" id="edit_working_sat" name="workingday[]" value="SAT" <?php if(in_array("SAT", $workingArr)){ echo "checked"; } ?>> </td>
                    <td><label for="edit_working_sat">Saturday</label></td>
                </tr>
                <tr>

                    <td><input type="checkbox" class="workingday" id="edit_working_sun" name="workingday[]" value="SUN" <?php if(in_array("SUN", $workingArr)){ echo "checked"; } ?>> </td>
                    <td><label for="edit_working_sun">Sunday</label></td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
            </table>

        </div>

        <div class="row  form-group">

            <div class="col-5 ">

                <input type="hidden" name="com_id" value="<?php echo $resultid; ?>">
                <input type="submit" name="exsubmit" class="btn btn-primary waves-effect waves-light mr-1" value="Submit">
            </div>
            <div class="col-5 ">


            </div>

        </div>







        <!-- Form elements here -->

    </div>



</form>   
