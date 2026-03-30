    <div class="m-icon">
       <a href="<?php echo site_url('/'); ?>"><img src="<?php echo base_url('images/dpcash.png'); ?>" height="84" width="250"></a> 
    </div>

     <?php if (isset($settingData['HOME_WELCOME_MESSAGE']) && $settingData['HOME_WELCOME_MESSAGE']) {
            $wecome_message = str_replace("##COMPANY_NAME##", SITE_NAME, $settingData['HOME_WELCOME_MESSAGE']); ?>

    <div style="margin-bottom: 5px;display: flex;padding: 5px;align-items: center;justify-content: space-between;border-radius: 10px;border: 2px solid #ff182c;box-shadow: 0 0 20px 0 rgb(0 0 0 / 40%);">
        <img src="<?php echo base_url('images/money.png'); ?>" width="90" height="68">
        <p style="color: black;display: inline-block;font-size: 16px;"><?php echo $wecome_message; ?></p>
    </div>


        <?php } ?>

