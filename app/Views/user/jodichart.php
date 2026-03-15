<div class="page-content">

    <div class="container-fluid">

        <div class="row">


            <div class="col-lg-12 ">               
                      <?php if(count($hisdata)){ ?>                  
                    <div  class=" box-rounded text-uppercase text-white" style="background-color: #003399;font-family:Times new roman; font-weight: bold; font-size:14px;" align="center">
                        
                            <?php echo $hisdata[0]->name; ?> Jodi CHART
                    </div>
                        <div align="center" style="padding-top:5px; padding-bottom: 5px;"> 
                            
                            <table class="text-dark  font-weight-bold" style="border:1px solid #06082e; padding:2px; text-align:center; "  width="100%">
                                
                                 <thead>
                                     <tr  style=" border-bottom: 1px solid #260459;color: #000;font-size: 16px; background-color:#ffc107; ">
                                       
                                        <th style="border-right:1px solid #260459; text-align: center" >Mon</th>
                                        <th style="border-right:1px solid #260459; text-align: center" >Tue</th>
                                        <th style="border-right:1px solid #260459; text-align: center" >Wed</th>
                                        <th style="border-right:1px solid #260459; text-align: center" >Thu</th>
                                        <th style="border-right:1px solid #260459; text-align: center" >Fri</th>
                                        <th style="border-right:1px solid #260459; text-align: center" >Sat</th>
                                        <th style="border-right:1px solid #260459; text-align: center" >Sun</th>
                                    </tr>
                                </thead>

                                <tr style=" border-bottom: 1px solid #260459;">
                                
                                <?php 
                            // take first day from where is started
                            $firstDay = date('D', strtotime($startdate));  
                            $start_day_week = date('N', strtotime($firstDay));

                           // $remainingDay = 7 -$start_day_week;
                           for($i=1; $i < $start_day_week;$i++)
                           {
                            ?>
                            <td style="border-right:1px solid #260459;" >&nbsp;</td>
                           <?php } ?>
                            
                         <?php 
                          $begin = new DateTime( $startdate);
                          $end   = new DateTime( $enddate);
                          $dayCount = $start_day_week;
                         for($i = $begin; $i <= $end; $i->modify('+1 day')){
                            $middle_number = -2;
                            $datekey =$i->format("d-m-Y");
                            if(key_exists($datekey,$resultdata)){
                                $middle_number = $resultdata[$datekey]->com_mid;
                              // echo "<pre>"; print_r($arrOpen );
                            }
                             ?>
                               
                                <td style="border-right:1px solid #260459; <?php echo  (($middle_number > 0) && ($middle_number % 11) ==0) ?  "color:red;" :  "color: #000;"  ?> font-size: 22px;">
                                    <b><?php echo (isset($middle_number) && $middle_number >  -1) ? $middle_number : "<font color='red'>**</font>"; ?></b>
                                </td>
                                <?php if($dayCount%7==0){?>
                                </tr><tr style=" border-bottom: 1px solid #260459;">
                                <?php } ?> 
                              <?php $dayCount++; } ?>
                    
                    </tr>



                            </table>
                        </div>

                    
                   
                      <?php }else{ ?>
                    <div align="center" > <b> No Result Found</b></div>
                      <?php } ?>

                   <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => $action, 'varExtra' => $searchArray)); ?>
                
            
                    <div> <a href="javascript:javascript:history.go(-1)" class="btn btn-info"> <i class="fa fa-arrow-circle-left"></i>  <b>Back</b></a> | 
                    <a href="<?php echo site_url('') ?>" class="btn btn-info"> <i class="fa fa-home"></i>  <b>Home</b></a></div>
            </div>
                

            </div>

        </div> <!-- container-fluid -->
    </div>
    