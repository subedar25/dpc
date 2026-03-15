<?php 
$session = session();
 $settingObj= new \App\Models\SettingsModel();
 $settingarr= $settingObj->getNameValuepair();
 
?>
<header >
    <div class="bg-seconday home-logo-box">
       

        <div class="logo-bottom" align="center">

                        <img src="<?php echo base_url('images/dpcash.png'); ?>" alt="Dpboss.cash" width="320" height="88" >
                        
                    </div>

            </div>
           

        </div>

    </div>
</header>
