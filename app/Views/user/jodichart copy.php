<?php //print_r($hisdata);die;?>
<div class="container-fluid">
    <div>
        <h1 class="chart-h1"> <?php echo $hisdata[0]->name; ?> JODI CHART</h1>
        <div class="para3">
            <h2 style="font-size: 14px;margin: 0px;"> <?php echo $hisdata[0]->name; ?> JODI RESULT CHART RECORDS </h2>
            <p style="margin: 0;font-size: 12px;line-height: 14px;">Dpboss <?php echo $hisdata[0]->name; ?> jodi chart, <?php echo $hisdata[0]->name; ?> jodi chart, old <?php echo $hisdata[0]->name; ?> jodi chart,
                <?php echo $hisdata[0]->name; ?> pana patti chart, dpboss5g <?php echo $hisdata[0]->name; ?> , <?php echo $hisdata[0]->name; ?> jodi record, <?php echo $hisdata[0]->name; ?> jodi record, <?php echo $hisdata[0]->name; ?> jodi chart 2015,
                <?php echo $hisdata[0]->name; ?> jodi chart 2012, <?php echo $hisdata[0]->name; ?> jodi chart 2012 to 2023, <?php echo $hisdata[0]->name; ?> final ank, <?php echo $hisdata[0]->name; ?> jodi chart.co,
                <?php echo $hisdata[0]->name; ?> jodi chart matka, <?php echo $hisdata[0]->name; ?> jodi chart book, <?php echo $hisdata[0]->name; ?> matka chart, matka jodi chart <?php echo $hisdata[0]->name; ?> , matka <?php echo $hisdata[0]->name; ?> chart,
                satta <?php echo $hisdata[0]->name; ?> chart jodi, <?php echo $hisdata[0]->name; ?> state chart, <?php echo $hisdata[0]->name; ?> chart result,
                डीपी बॉस, सट्टा चार्ट, सट्टा मटका पैनल चार्ट, सट्टा मटका पैनल चार्ट, टाइम बाजार मटका पैनल चार्ट, सट्टा मटका टाइम बाजार चार्ट पैनल, टाइम बाजार सट्टा चार्ट, टाइम बाजार पैनल चार्ट </p>
        </div>
        <div class="chart-result">
            <div> <?php echo $hisdata[0]->name; ?> </div>
            <span>
                126-97-890 </span><br>
            <a href="<?php echo site_url('jodichart?id=' . $hisdata[0]->com_parentid); ?>">Refresh Result</a>
        </div>

        <div id="top"></div>
        <a href="<?php echo site_url('jodichart?id=' . $hisdata[0]->com_parentid); ?>#bottom" class="button2"> Go to Bottom </a>

        <div class="panel panel-info">
            <div class="panel-heading text-center" style="background: #3f51b5;">
                <h3><?php echo $hisdata[0]->name; ?>  MATKA JODI RECORD</h3>
            </div>
            <div class="panel-body">
                <table style="width: 100%; text-align:center;" class="panel-chart chart-table" cellpadding="2">
                    <thead>
                        <tr>
                            <th class="text-center">Date</th>
                            <th colspan="3" class="text-center">Mon</th>
                            <th colspan="3" class="text-center">Tue</th>
                            <th colspan="3" class="text-center">Wed</th>
                            <th colspan="3" class="text-center">Thu</th>
                            <th colspan="3" class="text-center">Fri</th>
                            <th colspan="3" class="text-center">Sat</th>
                            <th colspan="3" class="text-center">Sun</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach($all_records as $weekly_record){ ?>
                        <tr>
                            <td><?php echo $weekly_record['start_date']; ?> <br> To <br> <?php echo $weekly_record['end_date']; ?></td>
                            <?php foreach($weekly_record['items'] as  $day_record){ ?>
                            <?php if(is_object($day_record)){ ?>
                            <td class="chart-bold"><?php $day_record->com_mid?></td>
                            <?php } else { ?>
                            <td class="r">***</td>
                            <?php } ?>
                            <?php } ?>
                        </tr>

                        <?php } ?>
                       
                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="chart-result">
            <div><?php echo $hisdata[0]->name; ?> </div>
            <span>126-97-890 </span><br>
            <a href="<?php echo site_url('jodichart?id=' . $hisdata[0]->com_parentid); ?>">Refresh Result</a>
        </div>
        <div class="container-fluid footer-text-div">
            <p>Dpboss5g Services is a leading provider of accurate and reliable <?php echo $hisdata[0]->name; ?>  Jodi Chart Records. As a trusted name in the world of online matka gaming, Dpboss5g Services has established itself as a go-to platform for enthusiasts seeking comprehensive and up-to-date jodi chart records for the <?php echo $hisdata[0]->name; ?>  market.</p>
            <br>
            <div class="small-heading">Get <?php echo $hisdata[0]->name; ?>  Jodi Chart Records</div>
            <p>Our <?php echo $hisdata[0]->name; ?>  Jodi Chart Records are meticulously curated, ensuring that users have access to the most recent and precise data to make informed decisions. The jodi chart records offer a detailed insight into the market trends, patterns, and historical data, empowering players with the knowledge they need for strategic gameplay. At Dpboss5g Services, we understand the importance of real-time information in the matka world, and our commitment is to provide users with the most accurate and reliable jodi chart records for the <?php echo $hisdata[0]->name; ?>  market. </p>
            <br>
            <div class="faq-heading">Frequently Asked Questions (FAQ) for <?php echo $hisdata[0]->name; ?>  Jodi Chart Records:</div>
            <p class="faq-title">Q1: How frequently are the <?php echo $hisdata[0]->name; ?>  Jodi Chart Records updated?</p>
            <p class="faq-ans">Our <?php echo $hisdata[0]->name; ?>  Jodi Chart Records are updated regularly to reflect the latest market trends and results. We strive to ensure that users have access to real-time data for their matka gaming experience.</p>
            <p class="faq-title">Q2: Is there a subscription fee for accessing <?php echo $hisdata[0]->name; ?>  Jodi Chart Records on Dpboss5g Services?</p>
            <p class="faq-ans">Dpboss5g Services believes in providing essential information to the matka community, and as such, access to <?php echo $hisdata[0]->name; ?>  Jodi Chart Records is offered free of charge. We are committed to creating a user-friendly platform that caters to the needs of matka enthusiasts without any subscription fees.</p>
        </div><br><br>
        <center>
            <div id="bottom"></div>
            <a href="<?php echo site_url('jodichart?id=' . $hisdata[0]->com_parentid); ?>#top" class="button2"> Go to Top </a>
        </center>
        <!-- adv & links -->
        <!-- footer -->
        <footer style="font-style: normal;">
            <a class="ftr-icon" href="<?php echo site_url('/'); ?>">dpboss.cash</a>
            <p>
                All Rights Reseved®
                <br>
                (1998-<?php echo date('Y');?>)
                <br>
                Contact (Astrologer-<span>Dpboss.cash</span>)
            </p>
        </footer>
    </div>
</div>









<div class="page-content">

    <div class="container-fluid">

        <div class="row">


            <div class="col-lg-12 ">
                <?php if (count($hisdata)) { ?>
                    <div class=" box-rounded text-uppercase text-white" style="background-color: #003399;font-family:Times new roman; font-weight: bold; font-size:14px;" align="center">

                        <?php echo $hisdata[0]->name; ?> Jodi CHART
                    </div>
                    <div align="center" style="padding-top:5px; padding-bottom: 5px;">

                        <table class="text-dark  font-weight-bold" style="border:1px solid #06082e; padding:2px; text-align:center; " width="100%">

                            <thead>
                                <tr style=" border-bottom: 1px solid #260459;color: #000;font-size: 16px; background-color:#ffc107; ">

                                    <th style="border-right:1px solid #260459; text-align: center">Mon</th>
                                    <th style="border-right:1px solid #260459; text-align: center">Tue</th>
                                    <th style="border-right:1px solid #260459; text-align: center">Wed</th>
                                    <th style="border-right:1px solid #260459; text-align: center">Thu</th>
                                    <th style="border-right:1px solid #260459; text-align: center">Fri</th>
                                    <th style="border-right:1px solid #260459; text-align: center">Sat</th>
                                    <th style="border-right:1px solid #260459; text-align: center">Sun</th>
                                </tr>
                            </thead>

                            <tr style=" border-bottom: 1px solid #260459;">

                                <?php
                                // take first day from where is started
                                $firstDay = date('D', strtotime($startdate));
                                $start_day_week = date('N', strtotime($firstDay));

                                // $remainingDay = 7 -$start_day_week;
                                for ($i = 1; $i < $start_day_week; $i++) {
                                ?>
                                    <td style="border-right:1px solid #260459;">&nbsp;</td>
                                <?php } ?>

                                <?php
                                $begin = new DateTime($startdate);
                                $end   = new DateTime($enddate);
                                $dayCount = $start_day_week;
                                for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                                    $middle_number = -2;
                                    $datekey = $i->format("d-m-Y");
                                    if (key_exists($datekey, $resultdata)) {
                                        $middle_number = $resultdata[$datekey]->com_mid;
                                        // echo "<pre>"; print_r($arrOpen );
                                    }
                                ?>

                                    <td style="border-right:1px solid #260459; <?php echo (($middle_number > 0) && ($middle_number % 11) == 0) ?  "color:red;" :  "color: #000;"  ?> font-size: 22px;">
                                        <b><?php echo (isset($middle_number) && $middle_number >  -1) ? $middle_number : "<font color='red'>**</font>"; ?></b>
                                    </td>
                                    <?php if ($dayCount % 7 == 0) { ?>
                            </tr>
                            <tr style=" border-bottom: 1px solid #260459;">
                            <?php } ?>
                        <?php $dayCount++;
                                } ?>

                            </tr>



                        </table>
                    </div>



                <?php } else { ?>
                    <div align="center"> <b> No Result Found</b></div>
                <?php } ?>

                <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => $action, 'varExtra' => $searchArray)); ?>


                <div> <a href="javascript:javascript:history.go(-1)" class="btn btn-info"> <i class="fa fa-arrow-circle-left"></i> <b>Back</b></a> |
                    <a href="<?php echo site_url('') ?>" class="btn btn-info"> <i class="fa fa-home"></i> <b>Home</b></a>
                </div>
            </div>


        </div>

    </div> <!-- container-fluid -->
</div>