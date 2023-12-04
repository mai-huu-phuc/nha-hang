<?php
 

$hostname = $_SERVER['HTTP_HOST'];
$port = $_SERVER['SERVER_PORT'];

$base_url = "http://".$hostname."/banhang";


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý Hải sản</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  

  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/plugins/fontawesome-free/css/all.min.css'; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->

  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'; ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css'; ?>">

  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/plugins/jqvmap/jqvmap.min.css'; ?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/dist/css/adminlte.min.css'; ?>">
 
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'; ?>">
  
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/plugins/daterangepicker/daterangepicker.css'; ?>">
 
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo $base_url.'/Admin/plugins/summernote/summernote-bs4.min.css'; ?>">
 
  <script src="<?php echo $base_url.'/js/jquery-3.7.1.min.js'; ?>"></script>

<script src="<?php echo $base_url.'/js/jquery.dataTables.min.js'; ?>"></script>
<script src="<?php echo $base_url.'/js/dataTables.select.min.js'; ?>"></script>

  
  <link href="<?php echo $base_url.'/js/jquery.dataTables.min.css'; ?>" rel="stylesheet">
  <link href="<?php echo $base_url.'/js/select.dataTables.min.css'; ?>" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo $base_url.'/images/logo.png'; ?>" alt="AdminLTELogo" height="500" width="500">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Trang chủ</a>
      </li> 
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
     

      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>