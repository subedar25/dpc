 <div class="container-fluid">
     <div>
         <h1 class="chart-h1"><?php echo $categoryName; ?> PANEL CHART</h1>
         <div class="para3">
             <h2 style="font-size: 14px;margin: 0px;"> <?php echo $categoryName; ?> PANEL RESULT CHART RECORDS </h2>
             <p style="margin: 0;font-size: 12px;line-height: 14px;">Dpboss5g <?php echo $categoryName; ?> panel chart, <?php echo $categoryName; ?> panel chart, old <?php echo $categoryName; ?> panel chart,
                 <?php echo $categoryName; ?> pana patti chart, dpboss5g <?php echo $categoryName; ?>, <?php echo $categoryName; ?> panel record, <?php echo $categoryName; ?> panel record, <?php echo $categoryName; ?> panel chart 2015,
                 <?php echo $categoryName; ?> panel chart 2012, <?php echo $categoryName; ?> panel chart 2012 to 2023, <?php echo $categoryName; ?> final ank, <?php echo $categoryName; ?> panel chart.co,
                 <?php echo $categoryName; ?> panel chart matka, <?php echo $categoryName; ?> panel chart book, <?php echo $categoryName; ?> matka chart, matka panel chart <?php echo $categoryName; ?>, matka <?php echo $categoryName; ?> chart,
                 satta <?php echo $categoryName; ?> chart panel, <?php echo $categoryName; ?> state chart, <?php echo $categoryName; ?> chart result,
                 डीपी बॉस, सट्टा चार्ट, सट्टा मटका पैनल चार्ट, सट्टा मटका पैनल चार्ट, टाइम बाजार मटका पैनल चार्ट, सट्टा मटका टाइम बाजार चार्ट पैनल, टाइम बाजार सट्टा चार्ट, टाइम बाजार पैनल चार्ट </p>
         </div>
         <div class="chart-result">
             <div><?php echo $categoryName; ?></div>
             <span>
                 <?php if (isset($todayResult[0]) && is_object($todayResult[0])) { ?>
                    <?php echo $todayResult[0]->com_open ?? ''; ?>-<?php echo $todayResult[0]->com_mid ?? ''; ?>-<?php echo $todayResult[0]->com_close ?? ''; ?>
                <?php } ?></span><br>
             <a href="<?php echo site_url('panelchart?id=' . $id); ?>">Refresh Result</a>
         </div>

         <div id="top"></div>
         <a href="<?php echo site_url('panelchart?id=' . $id); ?>#bottom" class="button2"> Go to Bottom </a>

         <div class="panel panel-info">
             <div class="panel-heading text-center" style="background: #3f51b5;">
                 <h3><?php echo $categoryName; ?> MATKA PANEL RECORD</h3>
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
                                    $hasOpen = is_object($day_record) && !empty($day_record->com_open);
                                    $openVal = $hasOpen ? $day_record->com_open : '***';
                                    if ($hasOpen && ctype_digit($openVal) && strlen($openVal) === 3) {
                                        $openDisplay = implode('<br>', str_split($openVal));
                                    } else {
                                        $openDisplay = $hasOpen ? str_replace(['-', ' '], '<br>', $openVal) : implode('<br>', str_split($openVal));
                                    }
                                    $hasMid = is_object($day_record) && !empty($day_record->com_mid);
                                    $midVal = $hasMid ? $day_record->com_mid : '*';

                                    $hasClose = is_object($day_record) && !empty($day_record->com_close);
                                    $closeVal = $hasClose ? $day_record->com_close : '***';
                                    if ($hasClose && ctype_digit($closeVal) && strlen($closeVal) === 3) {
                                        $closeDisplay = implode('<br>', str_split($closeVal));
                                    } else {
                                        $closeDisplay = $hasClose ? str_replace(['-', ' '], '<br>', $closeVal) : implode('<br>', str_split($closeVal));
                                    }

                                    $midClass  = $hasMid  ? 'chart-bold chart-' . $day_record->com_mid : 'r';
                                    $openClass = $hasOpen ? 'chart-' . $midVal : 'r';
                                    $closeClass = $hasClose ? 'chart-' . $midVal : 'r';
                                ?>
                                <td class="<?php echo $openClass; ?>"><?php echo $openDisplay; ?></td>
                                <td class="<?php echo $midClass; ?>"><?php echo $midVal; ?></td>
                                <td class="<?php echo $closeClass; ?>"><?php echo $closeDisplay; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>


                     </tbody>
                 </table>
             </div>
         </div>
         <div class="chart-result">
             <div><?php echo $categoryName; ?></div>
             <span> <?php if (isset($todayResult[0]) && is_object($todayResult[0])) { ?>
                    <?php echo $todayResult[0]->com_open ?? ''; ?>-<?php echo $todayResult[0]->com_mid ?? ''; ?>-<?php echo $todayResult[0]->com_close ?? ''; ?>
                <?php } ?> </span><br>
             <a href="<?php echo site_url('jodichart?id=' .$id); ?>">Refresh Result</a>
         </div>
         <div class="container-fluid footer-text-div">
             <p>Dpboss5g Services is a leading provider of accurate and reliable <?php echo $categoryName; ?> Panel Chart Records. As a trusted name in the world of online matka gaming, Dpboss5g Services has established itself as a go-to platform for enthusiasts seeking comprehensive and up-to-date panel chart records for the <?php echo $categoryName; ?> market.</p>
             <br>
             <div class="small-heading">Get <?php echo $categoryName; ?> Panel Chart Records</div>
             <p>Our <?php echo $categoryName; ?> Panel Chart Records are meticulously curated, ensuring that users have access to the most recent and precise data to make informed decisions. The panel chart records offer a detailed insight into the market trends, patterns, and historical data, empowering players with the knowledge they need for strategic gameplay. At Dpboss5g Services, we understand the importance of real-time information in the matka world, and our commitment is to provide users with the most accurate and reliable panel chart records for the <?php echo $categoryName; ?> market. </p>
             <br>
             <div class="faq-heading">Frequently Asked Questions (FAQ) for <?php echo $categoryName; ?> Panel Chart Records:</div>
             <p class="faq-title">Q1: How frequently are the <?php echo $categoryName; ?> Panel Chart Records updated?</p>
             <p class="faq-ans">Our <?php echo $categoryName; ?> Panel Chart Records are updated regularly to reflect the latest market trends and results. We strive to ensure that users have access to real-time data for their matka gaming experience.</p>
             <p class="faq-title">Q2: Is there a subscription fee for accessing <?php echo $categoryName; ?> Panel Chart Records on Dpboss5g Services?</p>
             <p class="faq-ans">Dpboss5g Services believes in providing essential information to the matka community, and as such, access to <?php echo $categoryName; ?> Panel Chart Records is offered free of charge. We are committed to creating a user-friendly platform that caters to the needs of matka enthusiasts without any subscription fees.</p>
         </div><br><br>
         <center>
             <div id="bottom"></div>
             <a href="<?php echo site_url('jodichart?id=' .$id); ?>#top" class="button2"> Go to Top </a>
         </center>
         <!-- adv & links -->
         <!-- footer -->
         <footer style="font-style: normal;">
             <a class="ftr-icon" href="#">Dpboss5g.in</a>
             <p>
                 All Rights Reseved®
                 <br>
                 (1998-2024)
                 <br>
                 Contact (Astrologer-<span>Dpboss5g</span>)
             </p>
         </footer>
     </div>
 </div>
