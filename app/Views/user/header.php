<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en-in"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

 <?php include_title(); ?>
<?php include_metas(); ?>

        <link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>">
		<!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>">

        <?php
            $pageAction = isset($action) ? $action : '';
            if (in_array($pageAction, ['index'])) {
        ?>
            <link rel="stylesheet" href="<?php echo base_url('css/frontend_home.css'); ?>">
        <?php } else  if (in_array($pageAction, ['panelchart', 'jodichart'])) { ?>
            <link rel="stylesheet" href="<?php echo base_url('css/frontend_chart.css'); ?>">
        <?php } else { ?>
            <link rel="stylesheet" href="<?php echo base_url('css/frontend.css'); ?>">
        <?php } ?>
        
</head>
<body>
<?php echo view('user/topmenu'); ?>
          
