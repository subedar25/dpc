<?php foreach ($historyData as $comDetails) {

    $todayresultmulData = $companymulhistory->getTodayResult($comDetails->com_parentid, $comDetails->result_date);

?>
    <div align="center" style="border:1px solid #470882;" class="mt-3">
        <?php if (count($todayresultmulData)) {    ?>
            <div class="top_heading_purple">
                <h5 style="font-weight:600;color:white;"><?php echo  date('F d, Y', strtotime($comDetails->com_date)); ?></h5>

            </div>


            <div align="center" class="table-responsive" style="margin-top:15px">

            <?php $arrpieces = array_chunk($todayresultmulData, ceil(count($todayresultmulData) / 2)); ?>

                    <table width="100%">
                         <tbody style="vertical-align: top;">
                        <tr>

                            <?php foreach ($arrpieces as $singleDetails) { ?>
                                <td>
                                    <table style="border:1px solid #ff0016; padding:3px; text-align:center; " width="99%">
                                        <thead>
                                            <tr style=" border-bottom: 1px solid #ff0016;">
                                                <td style="border-right:1px solid #ff0016;">
                                                    <font size="5" color="#ff0016"><b>Time</b></font>
                                                </td>
                                                <td>
                                                    <font size="5" color="Red"><b>Result</b></font>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($singleDetails as $details) { ?>
                                                <tr style=" border-bottom: 1px solid #ff0016;">
                                                    <td style="border-right:1px solid #ff0016;">
                                                    <p class="result_multiple" style="font-size:14px;"> <?php echo date('h:i A', strtotime($details['com_starttime'])); ?></p>
                                                       
                                                    </td>
                                                    <td>
                                                    <p class="result_multiple" style="font-size:16px;"><?php echo $details['com_open'] ? $details['com_open'] . '- ' . $details['com_mid'] : "** &nbsp &nbsp "; ?></p>
                                                       
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </td>
                            <?php } ?>

                        </tr>

                         </tbody>
                    </table>



            </div>



        <?php } ?>
    </div>
<?php   } ?>