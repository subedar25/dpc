<?php $session = session(); ?>
<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="msapplication-TileColor" content="#ff685c">
        <meta name="theme-color" content="#32cafe">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">


    <style>
        .page-content {
                padding: calc(14px) calc(24px / 2) 47px calc(18px / 2) !important;
        }
    </style>
        <!-- Title -->
        <?php include_title(); ?>
        <?php include_metas(); ?>

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>">

        <!-- Summernote css -->
        <!-- <link href="<?php echo base_url('admin/libs/summernote/summernote-bs4.min.css'); ?>" rel="stylesheet" type="text/css" /> -->

        <!-- <link href="<?php echo base_url('admin/libs/chartist/chartist.min.css'); ?>" rel="stylesheet"> -->
        <link href="<?php echo base_url('admin/libs/dropzone/min/dropzone.min.css'); ?>" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('admin/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url('admin/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('admin/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('admin/css/app.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/custom.css'); ?>"  rel="stylesheet" type="text/css" />


    </head>

        <body  style="background-color:#fc9 !important;" >
            <!-- Begin page -->
            <div id="layout-wrapper bg-white">
                <?php echo view('user/topmenu'); ?>
          