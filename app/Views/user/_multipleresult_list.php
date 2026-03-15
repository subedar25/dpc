<div style=" border: 2px solid #eb008b; text-align:center;margin:0px 0px 10px 0px;font-size:17px; color:#000; font-weight:bold;text-shadow: 1px 0px 1px #ffffff; margin-top: 2px;box-shadow: 0 0 20px 0 rgb(0 0 0 / 40%)!important;">
    <div class="top_heading_purple">
        <h5 style="font-weight:600;color:white;"><?php echo  date('F d, Y'); ?></h5>

    </div>
    <div class="row">
        <div class="col-xl-12">

        <div align="center" style="padding-top:5px; padding-bottom: 5px;">
           
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
                                                        <font size="4" color="#0A0E23"> <?php echo date('h:i A', strtotime($details['com_starttime'])); ?></font>
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

                         </tbody>
                    </table>
                </div>
        </div>

    </div>