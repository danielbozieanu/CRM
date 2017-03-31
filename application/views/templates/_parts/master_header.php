<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?=base_url()?>favicon.ico">

    <title><?php echo $page_title; ?></title>
    <meta name="description" value="<?php echo $page_description;?>" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/skin-blue.min.css">

    <!--  Date picker  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/daterangepicker/daterangepicker.css">

    <!--  Data table  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.css">

    <!--  Data table  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/select2/select2.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $before_closing_head;?>
</head>
<body class="skin-blue sidebar-mini" >
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="<?php echo base_url(); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>CRM</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>CRM</b>LOW</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- Logout button -->
                            <li>
                                <?php echo anchor('user/logout', '<i class="fa fa-sign-out" aria-hidden="true"></i>', 'title="Sign out!"');?>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" title="Profile settings" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>


