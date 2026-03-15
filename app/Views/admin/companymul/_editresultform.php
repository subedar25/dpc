
<form action="javascript:void(0);"  method="post" id="editmultipleform" onSubmit="updatemultipleresult();" >


    <div id="orderformdata" class=" col-lg-12">
        <div class="row  form-group">
            <label>Company Name<i class="text-danger">*</i></label>
            <input class="form-control"  type="text" value=" <?php echo $orderDetails->name; ?>" readonly="">
        </div>

        <div class="row  form-group">
            <label>Open<i class="text-danger"></i></label>
            <input class="form-control" name="com_open" id="com_open" type="text" value="<?php echo $orderDetails->com_open; ?>" autocomplete="off">
        </div>



        <div class="row  form-group">

            <label>Middle</label>
            <input class="form-control" name="com_mid" id="com_mid" type="text" value="<?php echo $orderDetails->com_mid; ?>" autocomplete="off">

        </div>

        <div class="row  form-group">

            <label>Close</label>
            <input class="form-control" name="com_close" id="com_close" type="text" value="<?php echo $orderDetails->com_close; ?>" autocomplete="off">
        </div>

        <div class="row  form-group">
            <label>Description</label>
            <textarea rows="4" class="form-control" name="com_desc" id="com_desc"><?php echo $orderDetails->com_desc; ?></textarea>
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