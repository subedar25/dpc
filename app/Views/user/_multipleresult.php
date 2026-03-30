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





<div class="my-table mr-sl">
    <h3 style="font-size:22px; border: 2px solid white;text-align:center;border-top-left-radius: 15px;border-top-right-radius: 15px;border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;border-color:white;margin-top:4px;background-color:#ff00a2;color:white;text-shadow: 1px 1px 2px #000;font-weight: 700;padding:5px;"> MAST STARLINE <a href="https://dpboss1.pro/pannel/MASTSTARLINE/193" style="text-decoration:none;font-size:14px;color:white;background-color:#000;border:1px solid white;border-radius:7px;float:right;margin:1px 3px;padding:2px 4px;display:;">CHART</a></h3>
    <div class="roulette-container" style="background-color:#d9c3ed;overflow: hidden;width: 100%;">
        <img src="./DPBOSS _ SATTA MATKA _ KALYAN MATKA _ MATKA RESULT _ MATKA _ SATTA_files/4.png" class="imgrotate">
        <div class="result-box">
            <span class="result-text">xxx-x</span>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Result</th>
                <th>Time</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> 11:15 AM </td>
                <td> *** </td>
                <td> 03:45 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 11:30 AM </td>
                <td> *** </td>
                <td> 04:00 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 11:45 AM </td>
                <td> *** </td>
                <td> 04:15 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 12:00 PM </td>
                <td> *** </td>
                <td> 04:30 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 12:15 PM </td>
                <td> *** </td>
                <td> 04:45 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 12:30 PM </td>
                <td> *** </td>
                <td> 05:00 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 12:45 PM </td>
                <td> *** </td>
                <td> 05:15 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 01:00 PM </td>
                <td> *** </td>
                <td> 05:30 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 01:15 PM </td>
                <td> *** </td>
                <td> 05:45 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 01:30 PM </td>
                <td> *** </td>
                <td> 06:00 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 01:45 PM </td>
                <td> *** </td>
                <td> 06:15 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 02:00 PM </td>
                <td> *** </td>
                <td> 06:30 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 02:15 PM </td>
                <td> *** </td>
                <td> 06:45 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 02:30 PM </td>
                <td> *** </td>
                <td> 07:00 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 02:45 PM </td>
                <td> *** </td>
                <td> 07:15 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 03:00 PM </td>
                <td> *** </td>
                <td> 07:30 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 03:15 PM </td>
                <td> *** </td>
                <td> 07:45 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 03:30 PM </td>
                <td> *** </td>
                <td> 08:00 PM </td>
                <td> *** </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="my-table mr-sl">
    <h3 style="font-size:22px; border: 2px solid white;text-align:center;border-top-left-radius: 15px;border-top-right-radius: 15px;border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;border-color:white;margin-top:4px;background-color:#ff00a2;color:white;text-shadow: 1px 1px 2px #000;font-weight: 700;padding:5px;"> TEEN PATTI <a href="https://dpboss1.pro/pannel/TEENPATTI/194" style="text-decoration:none;font-size:14px;color:white;background-color:#000;border:1px solid white;border-radius:7px;float:right;margin:1px 3px;padding:2px 4px;display:;">CHART</a></h3>
    <div class="roulette-container" style="background-color:#ffffff; padding:10px;">
        <div class="slots-images"><img src="./DPBOSS _ SATTA MATKA _ KALYAN MATKA _ MATKA RESULT _ MATKA _ SATTA_files/2.png" class="slot-image"><img src="./DPBOSS _ SATTA MATKA _ KALYAN MATKA _ MATKA RESULT _ MATKA _ SATTA_files/2.png" class="slot-image"><img src="./DPBOSS _ SATTA MATKA _ KALYAN MATKA _ MATKA RESULT _ MATKA _ SATTA_files/2.png" class="slot-image"></div>
        <div class="result-text">
            <span>xxx-x</span>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Result</th>
                <th>Time</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> 10:30 AM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/587" class="btn btn-sm btn-primary">***</a> </td>
                <td> 05:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/594" class="btn btn-sm btn-primary">***</a> </td>
            </tr>
            <tr>
                <td> 11:30 AM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/588" class="btn btn-sm btn-primary">***</a> </td>
                <td> 06:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/595" class="btn btn-sm btn-primary">***</a> </td>
            </tr>
            <tr>
                <td> 12:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/589" class="btn btn-sm btn-primary">***</a> </td>
                <td> 07:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/596" class="btn btn-sm btn-primary">***</a> </td>
            </tr>
            <tr>
                <td> 01:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/590" class="btn btn-sm btn-primary">***</a> </td>
                <td> 08:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/597" class="btn btn-sm btn-primary">***</a> </td>
            </tr>
            <tr>
                <td> 02:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/591" class="btn btn-sm btn-primary">***</a> </td>
                <td> 09:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/598" class="btn btn-sm btn-primary">***</a> </td>
            </tr>
            <tr>
                <td> 03:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/592" class="btn btn-sm btn-primary">***</a> </td>
                <td> 10:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/599" class="btn btn-sm btn-primary">***</a> </td>
            </tr>
            <tr>
                <td> 04:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/593" class="btn btn-sm btn-primary">***</a> </td>
                <td> 11:30 PM </td>
                <td> <a href="https://dpboss1.pro/admin-touch-result/194/600" class="btn btn-sm btn-primary">***</a> </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="my-table mr-sl">
    <h3 style="font-size:22px; border: 2px solid white;text-align:center;border-top-left-radius: 15px;border-top-right-radius: 15px;border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;border-color:white;margin-top:4px;background-color:#ff00a2;color:white;text-shadow: 1px 1px 2px #000;font-weight: 700;padding:5px;"> MAIN STARLINE <a href="https://dpboss1.pro/pannel/MAINSTARLINE/180" style="text-decoration:none;font-size:14px;color:white;background-color:#000;border:1px solid white;border-radius:7px;float:right;margin:1px 3px;padding:2px 4px;display:;">CHART</a></h3>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Result</th>
                <th>Time</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> 09:05 AM </td>
                <td> 260-8 </td>
                <td> 03:05 PM </td>
                <td> 440-8 </td>
            </tr>
            <tr>
                <td> 10:05 AM </td>
                <td> 129-2 </td>
                <td> 04:05 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 11:05 AM </td>
                <td> 170-8 </td>
                <td> 05:05 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 12:05 PM </td>
                <td> 135-9 </td>
                <td> 06:05 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 01:05 PM </td>
                <td> 368-7 </td>
                <td> 07:05 PM </td>
                <td> *** </td>
            </tr>
            <tr>
                <td> 02:05 PM </td>
                <td> 299-0 </td>
                <td> 08:05 PM </td>
                <td> *** </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- DPBOSS Special Game Zone -->
<div class="sky-23">
    <h4>DPBOSS Special Game Zone</h4>
    <a href="#"> All market free fix game </a>
    <a href="#"> Ratan Khatri Fix Panel Chart </a>
    <a href=""> Matka Final Number Trick Chart </a>
    <!-- <a href="ever-green-tricks/satta-matka-tricks-zone.html"> EverGreen Trick Zone And Matka Tricks By DPBOSS </a> -->
</div>