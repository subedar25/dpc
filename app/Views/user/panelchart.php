<div class="page-content">

    <div>

        <div class="row">


            <div class="col-lg-12 ">               
                      <?php if (count($hisdata)) { ?>                  
               
                    
                    <div  class=" box-rounded text-uppercase text-white" style="background-color: #003399;font-family:Times new roman; font-weight: bold; font-size:14px;" align="center">
                        
                            <?php echo $hisdata[0]->name; ?> PANEL CHART
                    </div>
                    
                    
                    <div align="center" style="padding-top:5px; padding-bottom: 5px;">                        


                        <table class="text-dark  font-weight-bold" style="border:1px solid #06082e; padding:2px; text-align:center; " width="100%">
                            <thead>
                                    <tr  style=" border-bottom: 1px solid #260459;color: #000;font-size: 16px; background-color:#ffc107; ">
                                        <th style="border-right:1px solid #260459; text-align: center">Date</th>
                                        <th style="border-right:1px solid #260459; text-align: center" colspan="3">Mon</th>
                                        <th style="border-right:1px solid #260459; text-align: center" colspan="3">Tue</th>
                                        <th style="border-right:1px solid #260459; text-align: center" colspan="3">Wed</th>
                                        <th style="border-right:1px solid #260459; text-align: center" colspan="3">Thu</th>
                                        <th style="border-right:1px solid #260459; text-align: center" colspan="3">Fri</th>
                                        <th style="border-right:1px solid #260459; text-align: center" colspan="3">Sat</th>
                                        <th style="border-right:1px solid #260459; text-align: center" colspan="3">Sun</th>
                                    </tr>
                                </thead>

                                <?php 
                                
                                $date = new DateTime($startdate);
                                $date->modify('last Monday');            
                                $startDate = $date->format('d-m-Y');
                                
                                 $date->modify('next Sunday'); 
                                $nextDate = $date->format('d-m-Y');

                                ?>

                                <tr style=" border-bottom: 1px solid #260459;">
                                
                                <td  style="border-right:1px solid #260459;font-size: 12px; ">
                                    <p style="margin: 0px !important;"><?php echo $startDate; ?></p>
                                    <p style="margin: 0px !important;">TO</p>
                                    <p style="margin: 0px !important;"><?php echo $nextDate ; ?></p>
                                </td>
                                <?php 
                                // take first day from where is started
                                $firstDay = date('D', strtotime($startdate));  
                                $start_day_week = date('N', strtotime($firstDay));
                               // $remainingDay = 7 -$start_day_week;
                               for($i=1; $i < $start_day_week;$i++)
                               {
                                ?>
                                <td style="border-right:1px solid #260459;" colspan="3">&nbsp;</td>
                               <?php }  ?>
                                <?php 
                               
                                $begin = new DateTime( $startdate);
                                $end   = new DateTime( $enddate);
                                $dayCount = $start_day_week;
                                for($i = $begin; $i <= $end; $i->modify('+1 day')){

                                    $arrOpen = array();
                                    $arrClose = array();
                                    $com_mid = -2;

                                    $datekey =$i->format("d-m-Y");
                                    if(key_exists($datekey,$resultdata)){
                                        $arrOpen = str_split($resultdata[$datekey]->com_open);
                                        $arrClose = str_split($resultdata[$datekey]->com_close);
                                        $com_mid = $resultdata[$datekey]->com_mid;
                                      // echo "<pre>"; print_r($arrOpen );
                                    }
                                    ?>

                                <td style="font-size: 14px;"> 
                                    <p style="margin: 0px !important;color: #4D4644;"><b><?php echo (isset($arrOpen[0])) ? $arrOpen[0] : "<font color='red'>*</font>"; ?></b></p>
                                     <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrOpen[1]) ) ? $arrOpen[1] : "<font color='red'>*</font>"; ?></p>
                                     <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrOpen[2]) ) ? $arrOpen[2] : "<font color='red'>*</font>"; ?></p>
                                    </td>
                                    <td>
                                    <p style="margin: 0px !important;">&nbsp;</p>
                                    <p style=" font-size: 18px; font-weight:600; margin: 0px !important;color: #860D23;"><?php  echo (isset($com_mid) && $com_mid >  -1) ? $com_mid: "<font color='red'>**</font>"; ?></p>
                                    <p style="margin: 0px !important;">&nbsp;</p>
                                    </td>
                                    <td style="border-right:1px solid #260459;font-size: 14px;">
                                    <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrClose[0]) ) ? $arrClose[0] : "<font color='red'>*</font>"; ?></p>
                                    <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrClose[1]) ) ? $arrClose[1] : "<font color='red'>*</font>"; ?></p>
                                    <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrClose[2])) ? $arrClose[2] : "<font color='red'>*</font>"; ?></p>
                                    </td>
                                
                                    
                            <?php if ($dayCount % 7 == 0) { 
                                
                                 $startDate = $i->format("Y-m-d");
                                // get next sunday            
                                   $date = new DateTime($startDate);
                                   $date->modify('next Monday');            
                                   $startDate = $date->format('d-m-Y');

                                   $date->modify('next Sunday');            
                                   $nextDate = $date->format('d-m-Y');
                           
                                ?>
                                </tr>
                                <tr class="font-weight-bold" style=" border-bottom: 1px solid #260459;">
                                    <td style="border-right:1px solid #260459;font-size: 12px;">
                                    <p style="margin: 0px !important;"><?php echo date('d-m-Y',strtotime($startDate)); ?></p>
                                    <p style="margin: 0px !important;">TO</p>
                                    <p style="margin: 0px !important;"><?php echo date('d-m-Y',strtotime($nextDate)); ?></p>
                                </td>
                            <?php } 
                            
                            $dayCount++;
                            }
                                ?>

                        </tr>

<?php /*
                            <tr style=" border-bottom: 1px solid #260459;">
                                
                                <td  style="border-right:1px solid #260459;font-size: 12px; ">
                                    <p style="margin: 0px !important;"><?php echo $startdate; ?></p>
                                    <p style="margin: 0px !important;">TO</p>
                                    <p style="margin: 0px !important;"><?php echo $nextDate; ?></p>
                                </td>
                                <?php 
                                // take first day from where is started
                                $firstDay = date('D', strtotime($historyData[0]->result_date));  
                                $start_day_week = date('N', strtotime($firstDay));
                               // $remainingDay = 7 -$start_day_week;
                               for($i=1; $i < $start_day_week;$i++)
                               {
                                ?>
                                <td style="border-right:1px solid #260459;" colspan="3">&nbsp;</td>
                               <?php } ?>

                            <?php $dayCount = $start_day_week;
                            foreach ($historyData as $singleDetails) {
                                $arrOpen = str_split($singleDetails->com_open);
                                $arrClose = str_split($singleDetails->com_close);
                                $dayOfweek =  date('D', strtotime($singleDetails->com_date));   
                            //   echo "--", $day_of_week = date('N', strtotime($dayOfweek));
                              //  echo "=",$singleDetails->com_date;
                               // echo $singleDetails->com_date; echo $dayOfweek;
                                ?> 
                                
                                <td style="font-size: 14px;"> 
                                    <p style="margin: 0px !important;color: #4D4644;"><b><?php echo (isset($arrOpen[0])) ? $arrOpen[0] : "<font color='red'>*</font>"; ?></b></p>
                                     <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrOpen[1]) ) ? $arrOpen[1] : "<font color='red'>*</font>"; ?></p>
                                     <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrOpen[2]) ) ? $arrOpen[2] : "<font color='red'>*</font>"; ?></p>
                                    </td>
                                    <td>
                                    <p style="margin: 0px !important;">&nbsp;</p>
                                    <p style=" font-size: 18px; margin: 0px !important;color: #860D23;"><?php echo ($singleDetails->com_mid > -1) ? $singleDetails->com_mid : "<font color='red'>**</font>"; ?></p>
                                    <p style="margin: 0px !important;">&nbsp;</p>
                                    </td>
                                    <td style="border-right:1px solid #260459;font-size: 14px;">
                                    <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrClose[0]) ) ? $arrClose[0] : "<font color='red'>*</font>"; ?></p>
                                    <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrClose[1]) ) ? $arrClose[1] : "<font color='red'>*</font>"; ?></p>
                                    <p style="margin: 0px !important;color: #4D4644;"><?php echo (isset($arrClose[2])) ? $arrClose[2] : "<font color='red'>*</font>"; ?></p>
                                    </td>
                                
                                    
                            <?php if ($dayCount % 7 == 0) { 
                                
                                $startDate = $singleDetails->com_date;
                                // get next sunday            
                                   $date = new DateTime($startDate);
                                   // Modify the date it contains
                                   $date->modify('next Monday');            
                                   $startDate = $date->format('Y-m-d');
                                   $date->modify('next Sunday');            
                                   $nextDate = $date->format('Y-m-d');
                           
                                ?>
                                </tr>
                                <tr class="font-weight-bold" style=" border-bottom: 1px solid #260459;">
                                    <td style="border-right:1px solid #260459;font-size: 12px;">
                                    <p style="margin: 0px !important;"><?php echo $startDate; ?></p>
                                    <p style="margin: 0px !important;">TO</p>
                                    <p style="margin: 0px !important;"><?php echo $nextDate; ?></p>
                                </td>
                            <?php } ?> 
        <?php $dayCount++;
    } ?>

                    </tr>                   
               */ ?>     
                </table>
            </div>
              <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => $action, 'varExtra' => $searchArray)); ?>

        

    <?php } else { ?>
        <div align="center" > <b> No Result Found</b></div>
<?php } ?>

                   
        <div> <a href="javascript:javascript:history.go(-1)" class="btn btn-info"> <i class="fa fa-arrow-circle-left"></i>  <b>Back</b></a> | 
                    <a href="<?php echo site_url('') ?>" class="btn btn-info"> <i class="fa fa-home"></i>  <b>Home</b></a></div>
                    
                </div>
                

            </div>

        </div> <!-- container-fluid -->
    </div>
    
