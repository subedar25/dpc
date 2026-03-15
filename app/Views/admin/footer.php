<?php $session = session(); ?>
<?php if($session->get('isAdminLoggedIn')){ ?>
<footer class="footer">
    <div class="container-fluid">
        <!-- <div class="row">
            <div class="col-12">
                © <script>document.write(new Date().getFullYear())</script> 
            </div> -->
        </div>
    </div>
</footer>
<?php } ?>