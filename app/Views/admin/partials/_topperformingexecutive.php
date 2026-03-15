<?php $session = session(); 
$admin_type = $session->get('admin_type');

?>
<?php if($admin_type != "salesexecutive"){ ?>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">TOP PERFORMING EXECUTIVE</h4>
                    <div class="mt-4">
                        <table class="table mb-0">
                            <tbody>
                            <?php if(isset($toperformerexecutive)){ $count=1; foreach($toperformerexecutive as $cusdetails){ ?>
                                <tr>
                                    <td width="10%"><?php echo $count++; ?></td>
                                    <td><?php echo $cusdetails->executivename ?></td>
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
<?php } ?>