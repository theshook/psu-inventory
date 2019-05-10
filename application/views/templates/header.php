<?php
defined('BASEPATH') or exit('No direct script access allowed');

$sub_title = $this->uri->segment(1);
$sub_equipments = $this->uri->segment(2);
$user_type = $this->session->userdata('role_id');
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
  <script src="<?= base_url() . 'assets/' ?>js/jquery.print.js"></script>
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
          <div class="sidenav-header-inner text-center">
            <!-- <img src="<?= base_url() . 'assets/' ?>img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle"> -->
            <h2 class="h5"><?= $this->session->userdata('user_lname') . ', ' . $this->session->userdata('user_fname') ?></h2><span><?= $this->session->userdata('depart_code') ?></span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="<?= base_url() ?>" class="brand-small text-center"> <strong>I</strong><strong class="text-primary">S</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <ul class="side-menu list-unstyled">
            <li class="<?= ($title == 'Home') ? 'active' : '' ?>" <?= ($user_type == 4) ? 'hidden' : '' ?>><a href="<?= base_url() ?>"> <i class="icon-home"></i>Home </a></li>
          </ul>
          <h5 class="sidenav-heading">Main Menu</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <li class="<?= ($title == 'Product') ? 'active' : '' ?>" <?= ($user_type == 4) ? 'hidden' : '' ?>><a href="#sideBarProdDropDown" aria-expanded="<?= ($title == 'Product') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-product-hunt" aria-hidden="true"></i>Product Menu</a>
              <ul id="sideBarProdDropDown" class="collapse list-unstyled <?= ($title == 'Product') ? 'show' : '' ?>">
                <li class="<?= ($sub_title == 'products') ? 'active' : '' ?>"><a href="<?= base_url() ?>products/">Products</a></li>
                <li class="<?= ($sub_title == 'prod_units') ? 'active' : '' ?>"><a href="<?= base_url() ?>prod_units/">Units</a></li>
                <li class="<?= ($sub_title == 'prod_categories') ? 'active' : '' ?>"><a href="<?= base_url() ?>prod_categories/">Categories</a></li>
              </ul>
            </li>
            <li class="<?= ($title == 'Request') ? 'active' : '' ?>"><a href="#sideBarReqDropDown" aria-expanded="<?= ($title == 'Request') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-envelope" aria-hidden="true"></i>Request Menu</a>
              <ul id="sideBarReqDropDown" class="collapse list-unstyled <?= ($title == 'Request') ? 'show' : '' ?>">
                <li class="<?= ($sub_title == 'requests') ? 'active' : '' ?>"><a href="<?= base_url() ?>requests/">Requests</a></li>
              </ul>
            </li>
            <li class="<?= ($title == 'Inventory') ? 'active' : '' ?>" <?= ($user_type == 4) ? 'hidden' : '' ?>>
              <a href="#sideBarInvDropDown" aria-expanded="<?= ($title == 'Inventory') ? 'true' : 'false' ?>" data-toggle="collapse">
                <i class="fa fa-cubes" aria-hidden="true"></i>Inventory Menu
              </a>
              <ul id="sideBarInvDropDown" class="collapse list-unstyled <?= ($title == 'Inventory') ? 'show' : '' ?>">
                <li class="<?= ($sub_title == 'inventories') ? 'active' : '' ?>"><a href="<?= base_url() ?>inventories/">Stocks</a></li>
                <!-- <li class="<?= ($sub_title == 'release') ? 'active' : '' ?>"><a href="<?= base_url() ?>release/">Release</a></li> -->
                <li class="<?= ($sub_equipments == 'equipments') ? 'active' : '' ?>"><a href="<?= base_url() ?>release/equipments">Release Equipments</a></li>
                <li class="<?= ($sub_equipments == 'consumables') ? 'active' : '' ?>"><a href="<?= base_url() ?>release/consumables">Release Consumables</a></li>
              </ul>
            </li>
            <li class="<?= ($title == 'Supply') ? 'active' : '' ?>" <?= ($user_type == 4) ? 'hidden' : '' ?>><a href="#sideBarSuppDropDown" aria-expanded="<?= ($title == 'Supply') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-truck" aria-hidden="true"></i>Supply Menu</a>
              <ul id="sideBarSuppDropDown" class="collapse list-unstyled <?= ($title == 'Supply') ? 'show' : '' ?>">
                <li class="<?= ($sub_title == 'supplies') ? 'active' : '' ?>"><a href="<?= base_url() ?>supplies/">Supplies</a></li>
              </ul>
            </li>
            <li class="<?= ($title == 'reports') ? 'active' : '' ?>" <?= ($user_type == 4) ? 'hidden' : '' ?>>
              <a href="#sideBarRepDropDown" aria-expanded="<?= ($title == 'reports') ? 'true' : 'false' ?>" data-toggle="collapse">
                <i class="fa fa-file" aria-hidden="true"></i>
                  Reports Menu
              </a>
              <ul id="sideBarRepDropDown" class="collapse list-unstyled <?= ($title == 'reports') ? 'show' : '' ?>">
                <li class="<?= ($sub_equipments == 'property_acknowledgement' || $sub_equipments == 'property_acknowledgement_show') ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>reports/property_acknowledgement/">
                    Property Acknowledgement
                  </a>
                </li>
                <li class="<?= ($sub_equipments == 'supply_availability_inquiry') ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>reports/supply_availability_inquiry/">
                    Supply Availability Inquiry
                  </a>
                </li>
                <li class="<?= ($sub_equipments == 'yearly_issued_summary') ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>reports/yearly_issued_summary/">
                    Yearly Issued Summary
                  </a>
                </li>
                <li class="<?= ($sub_equipments == 'monthly_issued_summary') ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>reports/monthly_issued_summary/">
                    Monthly Issued Summary
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="admin-menu" <?= ($user_type != 1) ? 'hidden' : ''?>>
          <h5 class="sidenav-heading">Admin</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled">
            <li class="<?= ($title == 'Users') ? 'active' : '' ?>"><a href="#sideBarUserDropDown" aria-expanded="<?= ($title == 'Users') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-user" aria-hidden="true"></i>User Menu</a>
              <ul id="sideBarUserDropDown" class="collapse list-unstyled <?= ($title == 'Users') ? 'show' : '' ?>">
                <li class="<?= ($sub_title == 'users') ? 'active' : '' ?>"><a href="<?= base_url() ?>users/">Users</a></li>
              </ul>
            </li>
            <li class="<?= ($title == 'Department') ? 'active' : '' ?>"><a href="#sideBarDepartDropDown" aria-expanded="<?= ($title == 'Department') ? 'true' : 'false' ?>" data-toggle="collapse"><i class="fa fa-building" aria-hidden="true"></i>Department Menu</a>
              <ul id="sideBarDepartDropDown" class="collapse list-unstyled <?= ($title == 'Department') ? 'show' : '' ?>">
                <li class="<?= ($sub_title == 'departments') ? 'active' : '' ?>"><a href="<?= base_url() ?>departments/">Departments</a></li>
              </ul>
            </li>
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