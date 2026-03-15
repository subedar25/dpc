    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <h2 class="pb-4">Create New Customer</h2>
                                <form class="custom-validation" method='post'
                                    action="<?php echo site_url('adduser'); ?>" enctype='multipart/form-data'>

                                    <?php echo view('admin/_topmessage'); ?>


                                    <div class="row  form-group">

                                        <div class="col-5 ">
                                            <label>Company Name<i class="text-danger">*</i></label>
                                            <input type="text" class="form-control form-control-lg" required
                                                placeholder="" name="companyname" />

                                        </div>
                                        <div class="col-5 ">
                                            <label>Full Name<i class="text-danger">*</i></label>
                                            <input type="text" class="form-control form-control-lg" required
                                                placeholder="" name="firstname" />

                                        </div>

                                    </div>

                                    <div class="row  form-group">
                                        <div class="col-5 ">
                                            <label>Mobile Number</label>
                                            <input data-parsley-type="digits" type="text"
                                                class="form-control form-control-lg"  maxlength="10"
                                                placeholder="" name="mobilenumber" />
                                        </div>
                                        <div class="col-5 ">
                                            <label>E-Mail</label>
                                            <input type="email" class="form-control form-control-lg" 
                                                parsley-type="email" placeholder="" name="email" />

                                        </div>
                                    </div>

                                    <div class="row  form-group">
                                        
                                        <div class="col-5 ">
                                            <label>Address</label>
                                            <textarea class="form-control form-control-lg" name="address"></textarea>

                                        </div>
                                        <div class="col-5 ">
                                                <label>GST Number</label>
                                                <input type="text" name="gstnumber" class="form-control form-control-lg"  placeholder=""  />

                                            </div>
<!--                                        <div class="col-5 ">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control form-control-lg" maxlength="10"
                                                placeholder="" name="pincode" />
                                        </div>-->
                                    </div>

                                    <div id="divdocuments">
<!--                                        <div class="row  form-group">
                                            <div class="col-5 ">
                                                <label>GST Number</label>
                                                <input type="text" name="gstnumber" class="form-control form-control-lg"  placeholder=""  />

                                            </div>
                                            <div class="col-5 ">
                                                <label>PAN Number</label>
                                                <input type="text" name="pannumber" class="form-control form-control-lg"  placeholder=""  />

                                            </div>
                                        </div>-->
<!--                                        <div class="row  form-group">
                                            <div class="col-5 ">
                                                <label>GST Document</label>
                                                <input type="file" name="gstdoc" class="filestyle">

                                            </div>
                                            <div class="col-5 ">
                                                <label>PAN Card</label>
                                                <input type="file" name="pandoc" class="filestyle">

                                            </div>
                                        </div>-->
                                    </div>

                                    <div class="row  form-group">
                                        <div class="col-5 ">
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
function showhideChanelpartner() {
    if ($('#user_type').val() == "channelpartnerstudio") {
        $('#chanelpartnerbox').css("display", "block")
        $('#partnerlevelbox').css("display", "none")
        $('#divdocuments').css("display", "none");

    } else if ($('#user_type').val() == "channelpartner") {
        $('#chanelpartnerbox').css("display", "none");
        $('#partnerlevelbox').css("display", "block");
        $('#divdocuments').css("display", "block");
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
                '<select name="district" id="district" onChange="getCity();" class="form-control form-control-lg"><option value=""> -Select District -</option>';
            if (data1.status) {
                for (i = 0; i < data1.districs.length; i++) {
                    districsstr += '<option value="' + data1.districs[i].ds_id + '">' + data1.districs[i]
                        .ds_name + '</option>';
                }
            }

            districsstr += "</select>";
            $("#districbox").html(districsstr);

        }
    });
    getCity();

}
    </script>