<?php
$arrcolors = array('#f8b425', '#cab629', '#3ea6d1',  '#61210a');
$colorcount = 0;
?>

<?php
$today_date = date('Y-m-d');
foreach ($allMultipleCompany as $comDetails) {
    $todayresultmulData = $companyMulModel->getTodayResult($comDetails->id, $today_date);

    if (count($todayresultmulData)) {

        $colorcount = $colorcount >= count($arrcolors) ? 0 : $colorcount;
?>
        <!-- <div class="box-rounded text-white" style="font-family:Helvetica, sans-serif !important; border:1px solid red;"> -->
            <div class="box-rounded" style="background-color: <?php echo $arrcolors[$colorcount++]; ?>;text-align:center; font-size:22px;font-weight:600; color:#000; "><?php echo $comDetails->name; ?>
                <?php if ($comDetails->com_template == 'newsingletable') { ?>
                    <span style="float: right;"><a href="<?php echo site_url('viewresult?id=' . $comDetails->id); ?>"><span class="badge badge-pill badge-purple font-size-14">Chart</span></a></span>
                <?php } ?>
            </div>

            <?php if ($comDetails->com_template == 'newsingletable') { ?>

                <?php

                $current_hr_min = date('H:i:00');

                $mintunesofHrs = date('i');
                $last_15_mins = floor($mintunesofHrs / 15) * 15;
                $last_15_mins = ($last_15_mins < 1) ? "0" . $last_15_mins : $last_15_mins;

                $search_time = date('H') . ":" . $last_15_mins . ":00";

                $result = array_filter($todayresultmulData, function ($item) use ($search_time) {
                    return $item['com_starttime'] == $search_time;
                });

                $diffInMinutes = (strtotime($current_hr_min) - strtotime($search_time)) / 60;

                $result_value = "--";
                $show_result = 0;

                if ($result) {
                    $result = array_values($result);

                    $result_value = $result[0]['com_open'] . " - " . $result[0]['com_mid'];

                    //   $interval = $result[0]['com_interval'] - 5;  // before 5 min result hide
                    $interval = $result[0]['com_interval'] + 1;  // after 1 min result hide

                    if ($diffInMinutes < $interval) {
                        $show_result = 1;
                    }
                }

                //  echo "<pre>";   print_r($todayresultmulData); die;
                ?>
                <?php echo view("user/_multipleresult_spiner", array("show_result" => $show_result, "result_value" => $result_value)); ?>
                <?php echo view("user/_multipleresult_list", array("todayresultmulData" => $todayresultmulData, "today_date" => $today_date)); ?>
            <?php } else { ?>
                <div align="center" style="padding-top:5px; padding-bottom: 5px;">
                    <?php $arrpieces = array_chunk($todayresultmulData, ceil(count($todayresultmulData) / 2)); ?>

                    <table width="100%">
                        <tr>

                            <?php foreach ($arrpieces as $singleDetails) { ?>
                                <td>
                                    <table style="border:1px solid #ff0016; padding:3px; text-align:center; " width="99%">
                                        <thead>
                                            <tr style=" border-bottom: 1px solid #ff0016;">
                                                <td style="border-right:1px solid #ff0016;">
                                                    <font size="4" color="#ff0016"><b>Time</b></font>
                                                </td>
                                                <td>
                                                    <font size="4" color="Red"><b>Result</b></font>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($singleDetails as $details) { ?>
                                                <tr style=" border-bottom: 1px solid #ff0016;">
                                                    <td style="border-right:1px solid #ff0016;">
                                                        <font size="4" color="#0A0E23"> <?php echo date('h:iA', strtotime($details['com_starttime'])); ?></font>
                                                    </td>
                                                    <td>
                                                        <font size="4" color="#0808b2"> <?php echo $details['com_open'] ? $details['com_open'] . '-' . $details['com_mid'] : "**"; ?></font>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </td>
                            <?php } ?>

                        </tr>

                        <tr>
                            <td colspan="2" align="right"><a href="<?php echo site_url("viewresult?id=" . $details['com_parentid']); ?>" class="text-primary"><b>View All</b></a></td>
                        </tr>
                    </table>
                </div>
            <?php } ?>

        </div>
<?php
    }
}
?>