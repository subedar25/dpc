<?php


foreach ($historyData as $comDetails) {

    $todayresultmulData = $companymulhistory->getTodayResult($comDetails->com_parentid, $comDetails->result_date);

?>
    <?php if (count($todayresultmulData)) {
        $arrpieces = array_chunk($todayresultmulData, ceil(count($todayresultmulData) / 2));

    ?>

        <div class=" box-rounded text-uppercase text-white font-size-18" style="background-color:#510d61;"><?php echo $comDetails->com_date; ?></div>

        <table width="100%">
            <tr>

                <?php foreach ($arrpieces as $singleDetails) { ?>
                    <td>
                        <table style="border:1px solid #06082e; padding:3px; text-align:center; " width="100%">
                            <thead>
                                <tr style=" border-bottom: 1px solid #260459;">
                                    <td style="border-right:1px solid #260459;">
                                        <font size="4" color="Red"><b>Time</b></font>
                                    </td>
                                    <td>
                                        <font size="4" color="Red"><b>Result</b></font>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($singleDetails as $details) { ?>
                                    <tr style=" border-bottom: 1px solid #260459;">
                                        <td style="border-right:1px solid #260459;">
                                            <font size="4" color="#010105"> <?php echo date('h:iA', strtotime($details['com_starttime'])); ?></font>
                                        </td>
                                        <td>
                                            <font size="4" color="#1616f2"> <?php echo $details['com_open'] ? $details['com_open'] . '-' . $details['com_mid'] : "**"; ?></font>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </td>
                <?php } ?>

            </tr>
        </table>



<?php }
}
?>