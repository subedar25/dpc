<div class="col-xl-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">TOP PERFORMING CUSTOMERS</h4>
            <div class="mt-4">
                <table class="table mb-0">
                    <tbody>
                        <?php if(isset($toperformercustomer)){ $count=1; foreach($toperformercustomer as $cusdetails){ ?>
                        <tr>
                            <td width="10%"><?php echo $count++; ?></td>
                            <td><?php echo $cusdetails->fname." ".$cusdetails->lname; ?></td>
                        </tr>
                        <?php } }else{?>

                            <tr>
                                <td>No performer yet.</td>
                              </tr>

                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>