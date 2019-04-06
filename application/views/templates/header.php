<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSU - IS</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>vendor/font-awesome/css/font-awesome.min.css">
  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>css/fontastic.css">
  <!-- Google fonts - Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <!-- jQuery Circle-->
  <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>css/grasp_mobile_progress_circle-1.0.0.min.css">
  <!-- Custom Scrollbar-->
  <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>css/style.sea.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="<?= base_url() . 'assets/' ?>img/favicon.ico">

  <script src="<?= base_url() . 'assets/' ?>vendor/jquery/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <!-- <style>
    .fa-stack {
      font-size: 1.0em;
    }
  </style> -->
</head>

<body>
  <?php if ($this->session->userdata('logged_in')) : ?>

    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="<?= base_url() . 'assets/' ?>img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5"><?= $this->session->userdata('user_lname') . ', ' . $this->session->userdata('user_fname') ?></h2><span><?= $this->session->userdata('depart_code') ?></span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="<?= base_url() ?>" class="brand-small text-center"> <strong>I</strong><strong class="text-primary">S</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main Menu</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li class="<?= ($title == 'Home') ? 'active' : '' ?>"><a href="<?= base_url() ?>"> <i class="icon-home"></i>Home </a></li>
            <li class="<?= ($title == 'Users') ? 'active' : '' ?>"><a href="#sideBarUserDropDown" aria-expanded="<?= ($title == 'Users') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-user" aria-hidden="true"></i>User Menu</a>
              <ul id="sideBarUserDropDown" class="collapse list-unstyled <?= ($title == 'Users') ? 'show' : '' ?>">
                <li><a href="<?= base_url() ?>users/">Users</a></li>
              </ul>
            </li>
            <li class="<?= ($title == 'Department') ? 'active' : '' ?>"><a href="#sideBarDepartDropDown" aria-expanded="<?= ($title == 'Department') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-building" aria-hidden="true"></i></i>Department Menu</a>
              <ul id="sideBarDepartDropDown" class="collapse list-unstyled <?= ($title == 'Department') ? 'show' : '' ?>">
                <li><a href="<?= base_url() ?>departments/">Departments</a></li>
              </ul>
            </li>
            <li class="<?= ($title == 'Product') ? 'active' : '' ?>"><a href="#sideBarProdDropDown" aria-expanded="<?= ($title == 'Product') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-product-hunt" aria-hidden="true"></i></i></i>Product Menu</a>
              <ul id="sideBarProdDropDown" class="collapse list-unstyled <?= ($title == 'Product') ? 'show' : '' ?>">
                <li><a href="<?= base_url() ?>products/">Products</a></li>
                <li><a href="<?= base_url() ?>prod_units/">Units</a></li>
                <li><a href="<?= base_url() ?>prod_categories/">Categories</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="admin-menu">
          <h5 class="sidenav-heading">Admin menu</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled">
            <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
          </ul>
        </div>
      </div>
    </nav>

  <?php endif; ?>

  <div class="<?= ($this->session->userdata('logged_in')) ? 'page' : '' ?>">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar">
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <div class="navbar-header">
              <?php if ($this->session->userdata('logged_in')) : ?>
                <a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
              <?php endif; ?>
              <a href="<?= base_url() ?>" class="navbar-brand">
                <div class="brand-text d-none d-md-inline-block"><span>showcase </span><strong class="text-primary">Dashboard</strong></div>
              </a></div>
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

              <?php if ($this->session->userdata('logged_in')) : ?>
                <li class="nav-item"><a href="<?= base_url() ?>userslogin/logout" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
              <?php endif; ?>

            </ul>
          </div>
        </div>
      </nav>
    </header>

    <?php if ($this->session->flashdata('success')) : ?>
      <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
        <p class="text-center p-0 m-0"><?= $this->session->flashdata('success') ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
      <div class="alert alert-danger alert-dismissible fade show" id="success-alert" role="alert">
        <p class="text-center p-0 m-0"><?= $this->session->flashdata('error') ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>