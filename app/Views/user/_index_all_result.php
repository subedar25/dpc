<h4 class="flyr24"> WORLD ME SABSE FAST SATTA MATKA RESULT </h4>
<div class="tkt-val" style="border-color: #aa00c0;margin-bottom: 2px;">




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
        <?php $description = $resultdata['description'] ? $resultdata['description'] : ($resultdata['com_desc'] ? $resultdata['com_desc'] : ""); ?>

        <?php $background_color = $description  ? "background-color: #f7f40e;" : "background-color:#fec790;"; ?>

        <div style="<?php echo $background_color; ?>">
            <h4><?php echo $resultdata['name']; ?></h4>
            <span><?php echo $resultdata['com_open']; ?>-<?php echo $resultdata['com_mid']; ?>-<?php echo $resultdata['com_close']; ?></span>
            <p><?php echo date('h:iA', strtotime($resultdata['start_time'])); ?> &nbsp;&nbsp; <?php echo date('h:iA', strtotime($resultdata['end_time'])); ?></p>
            <a href="<?php echo site_url('jodichart?id=' . $resultdata['id']); ?>" class="vl-clk gm-clk">Jodi</a>
            <a href="<?php echo site_url('panelchart?id=' . $resultdata['id']); ?>" class="vl-clk-2 gm-clk">Panel</a>
        </div>






    <?php } ?>




</div>