
<div class="container-fluid">
    <div>
        <h1 class="chart-h1"> <?php echo $categoryName; ?> JODI CHART</h1>
        <div class="para3">
            <h2 style="font-size: 14px;margin: 0px;"> <?php echo $categoryName; ?> JODI RESULT CHART RECORDS </h2>
            <p style="margin: 0;font-size: 12px;line-height: 14px;">Dpboss <?php echo $categoryName; ?> jodi chart, <?php echo $categoryName; ?> jodi chart, old <?php echo $categoryName; ?> jodi chart,
                <?php echo $categoryName; ?> pana patti chart, dpboss5g <?php echo $categoryName; ?> , <?php echo $categoryName; ?> jodi record, <?php echo $categoryName; ?> jodi record, <?php echo $categoryName; ?> jodi chart 2015,
                <?php echo $categoryName; ?> jodi chart 2012, <?php echo $categoryName; ?> jodi chart 2012 to 2023, <?php echo $categoryName; ?> final ank, <?php echo $categoryName; ?> jodi chart.co,
                <?php echo $categoryName; ?> jodi chart matka, <?php echo $categoryName; ?> jodi chart book, <?php echo $categoryName; ?> matka chart, matka jodi chart <?php echo $categoryName; ?> , matka <?php echo $categoryName; ?> chart,
                satta <?php echo $categoryName; ?> chart jodi, <?php echo $categoryName; ?> state chart, <?php echo $categoryName; ?> chart result,
                डीपी बॉस, सट्टा चार्ट, सट्टा मटका पैनल चार्ट, सट्टा मटका पैनल चार्ट, टाइम बाजार मटका पैनल चार्ट, सट्टा मटका टाइम बाजार चार्ट पैनल, टाइम बाजार सट्टा चार्ट, टाइम बाजार पैनल चार्ट </p>
        </div>
        <div class="chart-result">
            <div> <?php echo $categoryName; ?> </div>
            <span>
                <?php if (isset($todayResult[0]) && is_object($todayResult[0])) { ?>
                    <?php echo $todayResult[0]->com_open ?? ''; ?>-<?php echo $todayResult[0]->com_mid ?? ''; ?>-<?php echo $todayResult[0]->com_close ?? ''; ?>
                <?php } ?>
            </span><br>
            <a href="<?php echo site_url('jodichart?id=' . $id); ?>">Refresh Result</a>
        </div>

        <div id="top"></div>
        <a href="<?php echo site_url('jodichart?id=' . $id); ?>#bottom" class="button2"> Go to Bottom </a>

        <div class="panel panel-info">
            <div class="panel-heading text-center" style="background: #3f51b5;">
                <h3><?php echo $categoryName; ?>  MATKA JODI RECORD</h3>
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
                    <?php if(!empty($all_records)) { ?>
                    <?php foreach($all_records as $weekly_record){ ?>
                        <tr>
                            <td><?php echo $weekly_record['start_date']; ?> <br> To <br> <?php echo $weekly_record['end_date']; ?> </td>
                            <?php foreach($weekly_record['items'] as  $day_record){ ?>
                                <?php
                                    $hasMid = is_object($day_record) && !empty($day_record->com_mid);
                                    $midVal = $hasMid ? $day_record->com_mid : '**';
                                    $midClass = $hasMid ? 'chart-bold chart-' . $day_record->com_mid : 'r';
                                ?>
                                <td class="r"></td>
                                <td class="<?php echo $midClass; ?>"><?php echo $midVal; ?></td>
                                <td class="r"></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
                       
                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="chart-result">
            <div><?php echo $categoryName; ?> </div>
            <span> <?php if (isset($todayResult[0]) && is_object($todayResult[0])) { ?>
                    <?php echo $todayResult[0]->com_open ?? ''; ?>-<?php echo $todayResult[0]->com_mid ?? ''; ?>-<?php echo $todayResult[0]->com_close ?? ''; ?>
                <?php } ?> </span><br>
            <a href="<?php echo site_url('jodichart?id=' .$id); ?>">Refresh Result</a>
        </div>
        <div class="container-fluid footer-text-div">
            <p>Dpboss5g Services is a leading provider of accurate and reliable <?php echo $categoryName; ?>  Jodi Chart Records. As a trusted name in the world of online matka gaming, Dpboss5g Services has established itself as a go-to platform for enthusiasts seeking comprehensive and up-to-date jodi chart records for the <?php echo $categoryName; ?>  market.</p>
            <br>
            <div class="small-heading">Get <?php echo $categoryName; ?>  Jodi Chart Records</div>
            <p>Our <?php echo $categoryName; ?>  Jodi Chart Records are meticulously curated, ensuring that users have access to the most recent and precise data to make informed decisions. The jodi chart records offer a detailed insight into the market trends, patterns, and historical data, empowering players with the knowledge they need for strategic gameplay. At Dpboss5g Services, we understand the importance of real-time information in the matka world, and our commitment is to provide users with the most accurate and reliable jodi chart records for the <?php echo $categoryName; ?>  market. </p>
            <br>
            <div class="faq-heading">Frequently Asked Questions (FAQ) for <?php echo $categoryName; ?>  Jodi Chart Records:</div>
            <p class="faq-title">Q1: How frequently are the <?php echo $categoryName; ?>  Jodi Chart Records updated?</p>
            <p class="faq-ans">Our <?php echo $categoryName; ?>  Jodi Chart Records are updated regularly to reflect the latest market trends and results. We strive to ensure that users have access to real-time data for their matka gaming experience.</p>
            <p class="faq-title">Q2: Is there a subscription fee for accessing <?php echo $categoryName; ?>  Jodi Chart Records on Dpboss5g Services?</p>
            <p class="faq-ans">Dpboss5g Services believes in providing essential information to the matka community, and as such, access to <?php echo $categoryName; ?>  Jodi Chart Records is offered free of charge. We are committed to creating a user-friendly platform that caters to the needs of matka enthusiasts without any subscription fees.</p>
        </div><br><br>
        <center>
            <div id="bottom"></div>
            <a href="<?php echo site_url('jodichart?id=' . $id); ?>#top" class="button2"> Go to Top </a>
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
