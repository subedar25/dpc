<div style=" border: 2px solid #eb008b; text-align:center;margin:0px 0px 10px 0px;font-size:17px; color:#000; font-weight:bold;text-shadow: 1px 0px 1px #ffffff; margin-top: 2px;box-shadow: 0 0 20px 0 rgb(0 0 0 / 40%)!important;">
    <div class="top_heading_purple">
        <h5 style="font-weight:600;color:white;"><?php echo  date('F d, Y'); ?></h5>

    </div>
    <div class="row">
        <div class="col-xl-12">

            <div class="table-responsive" style="text-align:center;">
                <table width="100%" align="center">

                    <tbody>
                        <tr style="border: none !important;">
                            <?php $i = 0;
                            foreach ($todayresultmulData as $resultDetail) { //echo "<pre>"; print_r($resultDetail); die; 
                            ?>

                                <?php if ($i > 1 && ($i % 9) == 0) { ?>
                                </tr>
                                <tr style="border: none !important;">
                                <?php } ?>

                                <td style="text-align:center;word-wrap: break-word; ">
                                <span>
                                    <p class="result_multiple" style="font-size:14px;"> <?php echo date('h:i A', strtotime($resultDetail['com_starttime'])); ?></p>

                                    <p class="result_multiple_value" style="font-size:16px;"><?php echo $resultDetail['com_open'] ? $resultDetail['com_open'] . '- ' . $resultDetail['com_mid'] : "** &nbsp &nbsp "; ?></p>
                                </span>
                            </td>

                            <?php $i++;
                                    } ?>
                        </tr>
                    </tbody>
                </table>

                <!-- </div> -->
            </div>
        </div>

    </div>