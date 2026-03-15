<div class="col-xl-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">TOP PERFORMING CHANNEL PARTNERS</h4>
            <ol class="activity-feed">

            <?php if(isset($toperformerchannelpartner)){ foreach($toperformerchannelpartner as $cusdetails){ ?>

                <li class="feed-item">
                    <div class="feed-item-list">
                        <span><?php echo $cusdetails->fname." ".$cusdetails->lname; ?></span>
                        
                    </div>
                </li>
                <?php } }else{ ?>
                <div> No performer yet. </div>
                <?php } ?>

                
            </ol>
            
        </div>
    </div>
</div>