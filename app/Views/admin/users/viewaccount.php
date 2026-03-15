<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <h2 class="mb-4"> Account Details</h2>
                            <form class="custom-validation" method='post'
                                action="<?php echo site_url('ituserupdate'); ?>" enctype='multipart/form-data'>

                                <?php echo view('admin/_topmessage'); ?>

                                <div class="row  form-group">

                                    <div class="col-5">
                                        <label>Studio/Company Name</label>
                                        <div class=" form-control"><?php echo $userdetails->companyname; ?></div>
                                    </div>
                                    <div class="col-5 ">
                                        <label>Full Name</label>
                                        <div class=" form-control"><?php echo $userdetails->fname; ?></div>
                                    </div>
                                </div>

                                <div class="row  form-group">

                                    <div class="col-5 ">
                                        <label>E-Mail</label>
                                        <div class="form-control"><?php echo $userdetails->email; ?></div>
                                    </div>

                                    <div class="col-5 ">
                                        <label>Mobile Number</label>
                                        <div class="form-control"><?php echo $userdetails->phone; ?></div>
                                    </div>

                                </div>

                                <div class="row  form-group">
                                    <div class="col-5 ">
                                        <label>Address</label>
                                        <div class="form-control"><?php echo $userdetails->address; ?></div>
                                    </div>

                                    <div class="col-5 ">
                                        <label>Pincode</label>
                                        <div class="form-control"><?php echo $userdetails->pincode; ?></div>
                                    </div>

                                </div>

                                <div class="row  form-group">

                                    <div class="col-5 ">

                                        <label>State</label>
                                        <div class="form-control">
                                            <?php foreach($states as $statedetail){  ?>
                                            <?php echo ($statedetail["st_id"] ==$userdetails->stateid) ? $statedetail['st_name'] : ''; ?>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-5 ">

                                        <label> District</label>
                                        <div class="form-control">

                                            <?php foreach($districts as $districsdetail){ ?>
                                            <?php echo ($districsdetail['ds_id'] ==$userdetails->districid) ? $districsdetail["ds_name"] : ''; ?>

                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row  form-group">


                                    <div class="col-5 ">

                                        <label> City</label>
                                        <div class="form-control">
                                            <?php foreach($cities as $citydetail){ ?>
                                            <?php echo ($citydetail["ct_id"] ==$userdetails->cityid) ? $citydetail["ct_name"] : ''; ?>

                                            <?php } ?>

                                        </div>

                                    </div>

                                </div>

                                <div class="row  form-group">


                                    <div class="col-5 ">
                                        <label> Accout Type</label>
                                        <div class="form-control"><?php echo $userdetails->user_type; ?></div>

                                    </div>
                                    <?php if($userdetails->user_type=='channelpartnerstudio'){?>
                                    <div class="col-5 ">
                                        <label> Channel Partner</label>
                                        <div class="form-control"><?php echo $userdetails->channelpartnername; ?></div>
                                    </div>
                                    <?php } if($userdetails->user_type=='channelpartner'){?>
                                    <div class="col-5 ">
                                        <label> Partnership Level</label>
                                        <div class="form-control"><?php echo $userdetails->partner_type; ?></div>
                                    </div>
                                    <?php } ?>
                                </div>
                        </div>

                        <div id="divdocuments" <?php if($userdetails->user_type!="studio"){?> style="display:none"
                            <?php }?>>

                            <div class="row  form-group">

                                <div class="col-5 ">
                                    <label>GST Number</label>
                                    <div class="form-control"><?php echo $userdetails->gst_number; ?></div>

                                </div>
                                <div class="col-5 ">
                                    <label>PAN Number</label>
                                    <div class="form-control"><?php echo $userdetails->idproof; ?></div>
                                </div>

                            </div>

                            <div class="row  form-group">

                                <div class="col-5 ">
                                    <label>GST Document</label>


                                    <?php if($userdetails->gst_doc){ ?>
                                    <div class="mt-2" id="gstdoc"><a target="_blank"
                                            href="<?php echo base_url('userdoc/'.$userdetails->gst_doc); ?>"><?php echo $userdetails->gst_doc; ?></a>

                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-5 ">
                                    <label>PAN Card</label>

                                    <?php if($userdetails->idproof_doc){ ?>
                                    <div class=" mt-2" id="idproof"><a target="_blank"
                                            href="<?php echo base_url('userdoc/'.$userdetails->idproof_doc); ?>"><?php echo $userdetails->idproof_doc; ?></a>

                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                        <?php if($admin_type =='ituser'){ ?>
                        <div class="row  form-group">

                            <div class="col-5 ">

                                <label>Status</label>

                                <select name="it_status" class="form-control">
                                    <option value=""> -Status -</option>
                                    <option value="accepted"
                                        <?php echo ($userdetails->it_status =="accepted") ? "selected" : ''; ?>>
                                        Accept</option>
                                    <option value="rejected"
                                        <?php echo ($userdetails->it_status =="rejected") ? "selected" : ''; ?>>
                                        Reject</option>

                                </select>


                            </div>
                            <div class="col-5 ">

                                <label>Comment</label>

                                <textarea class="form-control"
                                    name="itcomment"><?php echo $userdetails->it_comment; ?></textarea>


                            </div>


                        </div>
                        <?php } ?>


                        <div class="row  form-group">

                            <div class="col-5 ">
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                <button type="submit"
                                    class="btn btn-lg btn-block btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                            </div>
                            <div class="col-5 ">
                                <a href="<?php echo site_url("users");?>"
                                    class="btn btn-lg btn-block btn-secondary waves-effect"> Cancel </a>
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
function delFile(id, filetype) {
    if (confirm("Are you sure?")) {
        $.ajax({
            url: "<?php echo site_url('deluserfile'); ?>",
            data: {
                id: id,
                filetype: filetype
            },
            success: function(data, status) {
                var data1 = JSON.parse(data);
                if (data1.status) {
                    $("#" + filetype).html("");
                }
            }
        });

    }


}

function showhideChanelpartner() {
    if ($('#user_type').val() == "channelpartnerstudio") {
        $('#chanelpartnerbox').css("display", "block")
        $('#partnerlevelbox').css("display", "none")
        $('#divdocuments').css("display", "none");

    } else if ($('#user_type').val() == "channelpartner") {
        $('#chanelpartnerbox').css("display", "none");
        $('#partnerlevelbox').css("display", "block");
        $('#divdocuments').css("display", "none");
    } else {
        $('#chanelpartnerbox').css("display", "none");
        $('#partnerlevelbox').css("display", "none");
        $('#divdocuments').css("display", "block");
    }
}

function getCity() {
    var stid = $('#state').val();
    var district = $('#district').val();

    // get cities of state
    $.ajax({
        url: "<?php echo site_url('getcity'); ?>",
        data: {
            stid: stid,
            district: district
        },
        success: function(data, status) {
            var data1 = JSON.parse(data);

            var citiesstr;
            citiesstr =
                '<select name="city" class="form-control form-control-lg"><option value=""> -Select City -</option>';
            if (data1.status) {
                for (i = 0; i < data1.cities.length; i++) {
                    citiesstr += '<option value="' + data1.cities[i].ct_id + '">' + data1.cities[i]
                        .ct_name + '</option>';
                }
            }

            citiesstr += "</select>";
            $("#citybox").html(citiesstr);

        }
    });




}

function getDistrict() {
    var stid = $('#state').val();
    // get distric of state
    $.ajax({
        url: "<?php echo site_url('getdistric'); ?>",
        data: {
            stid: stid
        },
        success: function(data, status) {
            var data1 = JSON.parse(data);

            var districsstr;
            districsstr =
                '<select name="district" id="district" class="form-control form-control-lg" onChange="getCity();"><option value=""> -Select Distric -</option>';
            if (data1.status) {
                for (i = 0; i < data1.districs.length; i++) {
                    districsstr += '<option value="' + data1.districs[i].ds_id + '">' + data1.districs[i]
                        .ds_name + '</option>';
                }
            }

            districsstr += "</select>";
            //  console.log(districsstr);
            $("#districbox").html(districsstr);

        }
    });

    getCity();

}
</script>