<div class="page-content">

    <div>

        <!-- <div class="col-lg-12 "> -->
        <?php if (isset($settingData['HOME_WELCOME_MESSAGE']) && $settingData['HOME_WELCOME_MESSAGE']) {
            $wecome_message = str_replace("##COMPANY_NAME##", SITE_NAME, $settingData['HOME_WELCOME_MESSAGE']); ?>


            <div class="rond-box-red message-box" align="center">

                <img class="message-box__img" src="<?php echo base_url('images/money.png'); ?>" alt="dpboss cash" border="0" style="margin-top:0px;width: 75px;height: 70px;border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                <p class="message-box__text message-box__text--blue" style="display: inline-block;"><?php echo $wecome_message; ?> </p>

            </div>


        <?php } ?>

        <?php if (isset($settingData['TOP_CONTENT']) && $settingData['TOP_CONTENT']) {
            $top_message = $settingData['TOP_CONTENT']?>


            <div class="rond-box-red mt-2 message-box" align="center">
                <div class="message-box__text message-box__text--blue top-content-box">
                    <?php echo $top_message; ?>
                </div>
            </div>


        <?php } ?>


        <?php if ((isset($settingData['MOTOR_PATTI']) && $settingData['MOTOR_PATTI']) || (isset($settingData['CYCLE_PATTI']) && $settingData['CYCLE_PATTI'])) { ?>

            <div class="rond-box-red mt-1 dv-text" align="center">

                <div class="rounded-box-title title-heading">Today Lucky Number</div>
                <div class="today-lucky-grid">
                    <div class="today-lucky-col left">
                        <h3><?php echo !empty($settingData['CYCLE_PATTI']) ? nl2br(esc($settingData['CYCLE_PATTI'])) : "&nbsp;"; ?></h3>
                    </div>
                    <div class="today-lucky-col right">
                        <h3><?php echo !empty($settingData['MOTOR_PATTI']) ? nl2br(esc($settingData['MOTOR_PATTI'])) : "&nbsp;"; ?></h3>
                    </div>
                </div>

            </div>
        <?php } ?>

  <!-- Live result-->


        <div style=" border: 2px solid #8100B9; border-radius:8px;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;font-weight:bold;font-style:none;text-align:center;font-size:large;margin-top: 9px; margin-bottom: 9px;font-family:Times new roman; " align="center">
            <div class="rounded-box-title title-heading">☔LIVE RESULT☔ &nbsp;&nbsp;&nbsp;<a onclick="javascript:refresh_page();" value="Refresh Result" title="Refresh Result" type="button" class="btn btn-sm"><i class="typcn text-white typcn-refresh font-size-20"></i></a></div>

            <div id="live-result-list">
            <?php
            //check today date and hrs for result show
            $today = strtoupper(date('D'));
            $currenthr = date("H");
            if (count($liveresultData)) {
                $i = 1;

            ?>
                <?php foreach ($liveresultData as $resultdata) { ?>
                    <?php
                    $com_working_day = $resultdata['com_working'] ? explode(",", $resultdata['com_working']) : array();
                    // print_r($com_working_day);

                    $company_holiday = (in_array($today, $com_working_day)) ? 0 : 1;
                    ?>
                    <div style=" border-bottom: 1px solid red;padding-bottom: 11px;">

                        <div>
                            <font size="5" color="#0033cc"><?php echo $resultdata['name']; ?></font>
                        </div>
                        <?php if ((isset($settingData['GLOBAL_HOLIDAY']) && $settingData['GLOBAL_HOLIDAY']) || $company_holiday) { ?>
                            <h4 style="color:#880e4f;">Holiday</h4>
                        <?php } else { ?>
                            <?php if ($resultdata['com_open'] || $resultdata['com_mid']) { ?>
                                <i class="fa fa-hand-o-right"></i>
                                <font color="#009933"><big></big></font>
                                <font size="5" color="#000"><?php echo $resultdata['com_open']; ?>-<?php echo $resultdata['com_mid']; ?>-<?php echo $resultdata['com_close']; ?></font> <br>

                            <?php } else { ?>
                                <font size="5" color="#ff0066">Loading... </font>
                                <!--                                            <img src="<?php echo base_url('images/loading.gif'); ?>" height="75px" >-->
                        <?php
                            }
                        }
                        $description = $resultdata['desc'] ? $resultdata['desc'] : ($resultdata['com_desc'] ? $resultdata['com_desc'] : "");
                        ?>
                        <div style="background-color: #f7f40e; color: #ce1105; font-size: 18px;"><?php echo nl2br($description); ?></div>
                        <font size="3" color="#8B0000">(<?php echo date('h:iA', strtotime($resultdata['com_starttime'])); ?> - <?php echo date('h:iA', strtotime($resultdata['com_endtime'])); ?>)</font>

                        <?php
                        // calculate time for display fatafat
                        $start_time = strtotime($resultdata['com_lastupdate']);
                        $end_time = strtotime(date('h:iA'));
                        $minutesdiff = ($start_time - $end_time) / 60;

                        ?>
                        <?php if ($minutesdiff <= 0 && $minutesdiff > -25 && ($resultdata['com_open'] || $resultdata['com_close'])) { ?>



                            <br>
                            <span class="badge   font-size-18" style=" background-color: #0033cc;">
                                <font size="4" color="#fff">फटाफट आया </font>
                            </span>
                            <!--                                    <font size="4" color="#ff0066">फटाफट  आया </font>-->

                        <?php }  ?>
                    </div>

                <?php } ?>
            <?php } else { ?>
                <div> No Result Now. </div>
            <?php } ?>
            </div>

        </div>

        <!-- Live result-->
        <?php if (isset($settingData['SPECIAL_MESSAGE']) && $settingData['SPECIAL_MESSAGE']) { ?>
            <div class="rond-box-red mt-2 message-box" align="center">
                <div class="message-box__text">
                    <?php echo $settingData['SPECIAL_MESSAGE']; ?>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($settingData['MESSAGE_TOP']) && $settingData['MESSAGE_TOP']) { ?>
            <div class="rond-box-red mt-2 message-box" align="center">
                <p class="message-box__text message-box__text--blue">
                    <?php echo $settingData['MESSAGE_TOP']; ?>
                </p>
            </div>
        <?php } ?>

        <!-- All result-->

        <div style=" border: 2px solid #8100B9; border-radius:8px;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;font-weight:bold;font-style:none;text-align:center;font-size:large;margin-top: 9px; margin-bottom: 9px;font-family:Times new roman; " align="center">

         <div class="rounded-box-title title-heading">WORLD ME SABSE FAST SATTA MATKA RESULT</div>

            
            <?php
            $show_message = 0;
            $i = 1;
            foreach ($todayresultData as $resultdata) { //print_r($resultdata);die;
                $show_old_result = 0;

                $start_hr = date('H', strtotime($resultdata['com_starttime']));
                $current_hr = date('H');
                //   echo $start_hr.' -'.$current_hr;
                if ($start_hr < 18 && $current_hr >= 12) {
                    $show_old_result = 1;
                } else if ($start_hr >= 18 && $current_hr >= 18) {
                    $show_old_result = 1;
                }
                $show_old_result = 0;
                $company_holiday = 0;
            ?>

                <?php if (($start_hr > 17) && !$show_message) {
                    $show_message = 1;
                ?>

                    <div class="rond-box-red big-message">
                        <?php
                        if (isset($settingData['MESSAGE_CONTACT']) && $settingData['MESSAGE_CONTACT']) {
                            echo $settingData['MESSAGE_CONTACT'];
                        }
                        ?>
                    </div>
                    <div style="border-bottom: 1px solid red;padding-bottom: 13px;"></div>

                <?php } ?>
                <?php $description = $resultdata['desc'] ? $resultdata['desc'] : ($resultdata['com_desc'] ? $resultdata['com_desc'] : ""); ?>
                <div class="live-result" style=" <?php if ($description) {
                                                        echo "background-color: #f7f40e;";
                                                    } ?>;border-bottom: 2px solid red;padding-bottom: 1px;padding-top: 2px;">
                    <table width="100%">
                        <tr>
                            <td><a href="<?php echo site_url('jodichart?id=' . $resultdata['id']); ?>"><span class="badge badge-pill badge-purple float-left font-size-14">Jodi</span></a></td>
                            <td>
                                <div class="compname"><?php echo $resultdata['name']; ?></div>

                                <?php if ((isset($settingData['GLOBAL_HOLIDAY']) && $settingData['GLOBAL_HOLIDAY']) || $company_holiday) { ?>
                                    <h4 style="color:#880e4f;">Holiday</h4>
                                <?php } else { ?>
                                    <?php if ($resultdata['com_open'] || $show_old_result) { ?>

                                        <div class="number"><?php echo $resultdata['com_open']; ?>-<?php echo $resultdata['com_mid']; ?>-<?php echo $resultdata['com_close']; ?></div>

                                        <div style="background-color: #f7f40e; color: #ce1105; font-size: large;"><?php echo nl2br($description); ?></div>
                                        <?php
                                    } else {
                                        $resLast = $companyModel->getLastResult($resultdata['id']);
                                        if ($resLast) {

                                            $description = $resultdata['desc'] ? $resultdata['desc'] : ($resLast['com_desc'] ? $resLast['com_desc'] : "");
                                        ?>
                                            <?php if (isset($settingData['GLOBAL_HOLIDAY']) && $settingData['GLOBAL_HOLIDAY']) { ?>
                                                <h5>Holiday</h5>
                                            <?php } else { ?>
                                                <div class="number text-dark"><?php echo $resLast['com_open']; ?>-<?php echo $resLast['com_mid']; ?>-<?php echo $resLast['com_close']; ?></div>
                                            <?php } ?>
                                            <div style="background-color: #f7f40e; color: #ce1105; font-size: large;"><?php echo nl2br($description); ?></div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                                <font size="3" class="time-display">(<?php echo date('h:iA', strtotime($resultdata['start_time'])); ?> - <?php echo date('h:iA', strtotime($resultdata['end_time'])); ?>)</font>
                            </td>
                            <td align="right"><a href="<?php echo site_url('panelchart?id=' . $resultdata['id']); ?>"><span class="badge badge-pill badge-purple font-size-14">Panel</span></a></td>
                        </tr>
                    </table>
                </div>

            <?php } ?>



        </div>
        <a onclick="javascript:refresh_page();" value="Refresh Result" type="button" class="btn btn-success badge-purple"><i class="typcn typcn-refresh font-size-20"></i> Refresh Result</a>


        <!-- All result-->
        <?php echo view("user/_multipleresult"); ?>

        <?php echo view("user/_matkajodichart"); ?>

        <?php if (isset($settingData['WARNING']) && $settingData['WARNING']) { ?>
            <div class="box-rounded" style="color:#3d0702;font-size:large;border-style:inset;font-family:Times new roman;">
                <div style=" background-color: #ff4233;text-align:center;">
                    <font size="5" color="mintcream"><big>WARNING</big> </font>
                </div>
                <font size="4">
                    <?php echo $settingData['WARNING']; ?>
                </font>
            </div>
        <?php } ?>


        <?php if (isset($settingData['DISCLAIMER']) && $settingData['DISCLAIMER']) { ?>
            <div class="card  bg-warning box-rounded" style="color:#030a54;font-size:large;border-style:inset;font-family:Times new roman;">
                <div style="text-align:center;">
                    <font size="5" color="black"><big>DISCLAIMER :-</big> </font>
                </div>
                <div><?php echo $settingData['DISCLAIMER']; ?>
                </div>
            </div>
        <?php } ?>



        <!-- </div> -->

        <!-- </div> -->

        <!-- </div>  -->
        <!-- container-fluid -->
    </div>
    <a style="position:fixed;bottom:12px;right:5px;margin:0;padding:5px 3px;" class="btn btn-info" onclick="javascript:refresh_page();"><i class="typcn typcn-refresh font-size-20"></i> Refresh</a>

    <div class="spinner-border text-danger m-1 font-size-24" style="position:fixed;bottom:250px;right:150px;margin:0;padding:5px 3px; display:none;" id="loaderdiv" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <script type="text/javascript">
        function refresh_page() { //alert('hi');
            $("#loaderdiv").show();
            document.location.reload();
            //  window.scrollTo(0, 0);

        }

        function timeToMinutes(t) {
            if (!t) return null;
            var parts = t.split(':');
            if (parts.length < 2) return null;
            var h = parseInt(parts[0], 10);
            var m = parseInt(parts[1], 10);
            if (isNaN(h) || isNaN(m)) return null;
            return (h * 60) + m;
        }

        function withinWindow(nowMin, targetMin, before, after) {
            if (targetMin === null) return false;
            return nowMin >= (targetMin - before) && nowMin <= (targetMin + after);
        }

        function buildResultText(row) {
            var open = row.com_open || '';
            var mid = row.com_mid || '';
            var close = row.com_close || '';
            if (!open && !mid && !close) return '';
            return [open, mid, close].filter(function (p) { return p !== ''; }).join('-');
        }

        function renderLiveResults(items) {
            var now = new Date();
            var nowMin = now.getHours() * 60 + now.getMinutes();
            var html = '';

            items.forEach(function (row) {
                var startMin = timeToMinutes(row.com_starttime || row.start_time);
                var endMin = timeToMinutes(row.com_endtime || row.end_time);
                var showOpen = withinWindow(nowMin, startMin, 5, 15);
                var showClose = withinWindow(nowMin, endMin, 5, 15);
                if (!showOpen && !showClose) return;

                var loading = (showOpen && !row.com_open) || (showClose && !row.com_close);
                var resultText = loading ? 'Loading...' : buildResultText(row);

                html += '<div style=" border-bottom: 1px solid red;padding-bottom: 11px;">' +
                    '<div><font size="5" color="#0033cc">' + (row.name || '') + '</font></div>' +
                    '<font size="5" color="#000">' + (resultText || '') + '</font><br>' +
                    '</div>';
            });

            if (!html) {
                html = '<div> No Result Now. </div>';
            }

            document.getElementById('live-result-list').innerHTML = html;
        }

        function fetchLiveResults() {
            fetch("<?php echo site_url('liveresultjson'); ?>")
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (data && data.data) {
                        renderLiveResults(data.data);
                    }
                })
                .catch(function () {});
        }

        fetchLiveResults();
        setInterval(fetchLiveResults, 10000);
    </script>
