<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-8">
                    <h4 class="text-uppercase text-center">ORDER SUMMARY</h4>
                    <div class="row">
                        <div class="col-xl-6">

                            <table class="table table-bordered  mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>Orders pending for approval RGB:</h6>
                                        </td>
                                        <td><?php echo $totalrbgpendingorder ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Today RGB:</h6>
                                        </td>
                                        <td><?php echo $todayrgborder ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>Today RGB Payment: </h6>
                                        </td>
                                        <td><?php echo $todaypaidrgborder ?> </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>Yesterday RGB:</h6>
                                        </td>
                                        <td><?php echo $yesterdayrgborder; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Yesterday Paid:</h6>
                                        </td>
                                        <td><?php echo $yesterdaypaidrgborder; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>MTD RGB:</h6>
                                        </td>
                                        <td><?php echo $monthalyrgborder ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>MTD RGB Payment:</h6>
                                        </td>
                                        <td><?php echo $monthalypaidrgborder ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-xl-6">

                            <table class="table table-bordered  mb-0">
                                <tbody>
                                 <tr>
                                        <td>
                                            <h6>Orders pending for approval CMYK :</h6>
                                        </td>
                                        <td><?php echo $totalpendingordercmyk ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Today CMYK:</h6>
                                        </td>
                                        <td><?php echo $todaycmykorder ?> </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>Today CMYK Payment: </h6>
                                        </td>
                                        <td><?php echo $todaypaidcmykorder ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>Yesterday CMYK:</h6>
                                        </td>
                                        <td><?php echo $yesterdaycmykorder ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Yesterday Paid CMYK:</h6>
                                        </td>
                                        <td><?php echo $yesterdaypaidcmykorder ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>MTD CMYK:</h6>
                                        </td>
                                        <td><?php echo $monthalycmykorder ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>MTD CMYK Payment:</h6>
                                        </td>
                                        <td><?php echo $monthalypaidcmykborder ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <h4 class="text-uppercase text-center">CUSTOMERS SUMMARY</h4>
                    <div class="row">
                        <div class="col-xl-12">

                            <table class="table table-bordered  mb-0">
                                <tbody>

                                    <tr>
                                        <td>
                                            <h6>Ordering Partners today:</h6>
                                        </td>
                                        <td><?php echo $todaypartnerorders ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>Ordering Partners This week: </h6>
                                        </td>
                                        <td><?php echo $weekpartnerorders ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>Ordering Partners MTD:</h6>
                                        </td>
                                        <td><?php echo $monthpartnerorders; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>New partners added Today:</h6>
                                        </td>
                                        <td><?php echo $todaypartners; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>New partners added this week:</h6>
                                        </td>
                                        <td><?php echo $weekpartners ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>New partners added MTD:</h6>
                                        </td>
                                        <td><?php echo $monthpartners ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 ">
                <div class="col-xl-12">
                    <h4 class=" text-uppercase text-center mb-4">Month Till Date summary </h4>
                    <div class="row">
                        <div class="col-xl-6">
                        <h4 class=" text-uppercase text-center ">RGB </h4>
                            <table class="table table-bordered  mb-0">
                                <tbody>

                                    <tr>
                                        <td>
                                            <h6>Front Office:</h6>
                                        </td>
                                        <td><?php echo $monthalyfrontoffice ?> </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>CC: </h6>
                                        </td>
                                        <td><?php echo $monthalycc ?> </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>CC Hold :</h6>
                                        </td>
                                        <td><?php echo $monthalycchold; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Printing:</h6>
                                        </td>
                                        <td><?php echo $monthalyprinting; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Hot Press:</h6>
                                        </td>
                                        <td><?php echo $monthalyhotpress ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Post production:</h6>
                                        </td>
                                        <td><?php echo $monthalypostproduction ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Completed:</h6>
                                        </td>
                                        <td><?php echo $monthalycompleted ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Dispached :</h6>
                                        </td>
                                        <td><?php echo $monthalydispached ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-xl-6">
                        <h4 class=" text-uppercase text-center ">CMYK </h4>
                            <table class="table table-bordered  mb-0">
                                <tbody>

                                <tr>
                                        <td>
                                            <h6>Front Office:</h6>
                                        </td>
                                        <td><?php echo $monthalyfrontofficecmyk; ?> </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>CC: </h6>
                                        </td>
                                        <td><?php echo $monthalycccmyk; ?> </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6>CC Hold :</h6>
                                        </td>
                                        <td><?php echo $monthalyccholdcmyk; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Printing:</h6>
                                        </td>
                                        <td><?php echo $monthalyprintingcmyk; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <h6>Post production:</h6>
                                        </td>
                                        <td><?php echo $monthalypostproductioncmyk ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Completed:</h6>
                                        </td>
                                        <td><?php echo $monthalycompletedcmyk ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Dispached :</h6>
                                        </td>
                                        <td><?php echo $monthalydispachedcmyk ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>