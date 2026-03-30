<?php 
$session = session();
 $settingObj= new \App\Models\SettingsModel();
 $settingarr= $settingObj->getNameValuepair();
 
?>
<header>
    <div class="m-icon" align="center">
        <a href="<?php echo site_url('/'); ?>">
            <img src="<?php echo base_url('images/dpcash.png'); ?>" alt="Dpboss.cash" width="292" height="84" >
        </a>
    </div>
</header>
