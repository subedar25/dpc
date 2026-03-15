<div class="col-xl-12">
    <div class="card">
        <div class="card-body">


            <div class="row">
            <?php if($production_unit_type =='RGB'){ ?>
                <div class="mt-4 col-xl-6 ">
                <h4 class="text-uppercase text-center">ORDER SUMMARY</h4>
                    <table class="table table-bordered  mb-0">
                        <tbody>

                            <tr>
                                <td>
                                    <h6>Today RGB:</h6>
                                </td>
                                <td><?php echo $todayrgbcount ?> </td>
                            </tr>

                            <tr>
                                <td>
                                    <h6>Today RGB Payment : </h6>
                                </td>
                                <td><?php echo $todayrgbpaidcount ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="mt-4 col-xl-6">
                <h4 class="text-uppercase text-center">Month Till Date summary </h4>
                <table class="table table-bordered  mb-0">
                    <tbody>

                        <tr>
                            <td>
                                <h6>RGB orders :</h6>
                            </td>
                            <td width="15%"><?php echo $monthalyrgbcount ?></td>
                        </tr>

                        <tr>
                            <td>
                                <h6>Paid Orders:</h6>
                            </td>
                            <td><?php echo $monthalyrgbpaidcount ?></td>
                            
                        </tr>

                        <tr>
                            <td>
                                <h6>Front Office :</h6>
                            </td>
                            <td><?php echo $monthalyrgbfrontcount ?></td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php }else{ ?>
                <div class="mt-4 col-xl-6 ">
                    <h4 class="card-title mb-4">ORDER SUMMARY</h4>
                    <table class="table table-bordered  mb-0">
                        <tbody>

                            <tr>
                                
                                <td>
                                    <h6>Today CMYK:</h6>
                                </td>
                                <td><?php echo $todaycmykcount ?> </td>
                            </tr>

                            <tr>
                                
                                <td>
                                    <h6>Today CMYK Payment : </h6>
                                </td>
                                <td><?php echo $todaycmykpaidcount ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="mt-4 col-xl-6">
                <h4 class="card-title mb-4">Month Till Date summary </h4>
                <table class="table table-bordered  mb-0">
                    <tbody>

                        <tr>
                            <td>
                                <h6>CMYK orders: </h6>
                            </td>
                            <td width="15%"><?php echo $monthalycmykcount ?></td>

                        </tr>

                        <tr>
                            
                            <td>
                                <h6>Paid Orders:</h6>
                            </td>
                            <td><?php echo $monthalycmykpaidcount ?></td>

                        </tr>

                        <!-- <tr>
                            
                            <td>
                                <h6>Front Office :</h6>
                            </td>
                            <td><?php echo $monthalycmykfrontcount ?></td>

                        </tr> -->
                    </tbody>
                </table>
            </div>
            <?php } ?>
            </div>

            
        </div>
    </div>

</div>