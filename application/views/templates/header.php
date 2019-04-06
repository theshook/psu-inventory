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
  <!-- Side Navbar -->
  <nav class="side-navbar">
    <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <!-- User Info-->
        <div class="sidenav-header-inner text-center"><img src="<?= base_url() . 'assets/' ?>img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
          <h2 class="h5">Nathan Andrews</h2><span>Web Developer</span>
        </div>
        <!-- Small Brand information, appears on minimized sidebar-->
        <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>I</strong><strong class="text-primary">S</strong></a></div>
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
              <li><a href="<?= base_url() ?>departments/">Products</a></li>
              <li><a href="<?= base_url() ?>departments/create">New Product</a></li>
              <li><a href="<?= base_url() ?>departments/create">Units</a></li>
              <li><a href="<?= base_url() ?>departments/create">Categories</a></li>
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
  <div class="page">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar">
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="<?= base_url() ?>" class="navbar-brand">
                <div class="brand-text d-none d-md-inline-block"><span>showcase </span><strong class="text-primary">Dashboard</strong></div>
              </a></div>
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Notifications dropdown-->
              <!-- <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
                <ul aria-labelledby="notifications" class="dropdown-menu">
                  <li><a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification d-flex justify-content-between">
                        <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                        <div class="notification-time"><small>4 minutes ago</small></div>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification d-flex justify-content-between">
                        <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                        <div class="notification-time"><small>4 minutes ago</small></div>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification d-flex justify-content-between">
                        <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                        <div class="notification-time"><small>4 minutes ago</small></div>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification d-flex justify-content-between">
                        <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                        <div class="notification-time"><small>10 minutes ago</small></div>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications </strong></a></li>
                </ul>
              </li> -->
              <!-- Messages dropdown-->
              <!-- <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a>
                <ul aria-labelledby="notifications" class="dropdown-menu">
                  <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                      <div class="msg-profile"> <img src="<?= base_url() . 'assets/' ?>img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle">
                      </div>
                      <div class="msg-body">
                        <h3 class="h5">Jason Doe</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm
                          - 10.06.2014</small>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                      <div class="msg-profile"> <img src="<?= base_url() . 'assets/' ?>img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle">
                      </div>
                      <div class="msg-body">
                        <h3 class="h5">Frank Williams</h3><span>sent you a direct message</span><small>3 days ago at
                          7:58 pm - 10.06.2014</small>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                      <div class="msg-profile"> <img src="<?= base_url() . 'assets/' ?>img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle">
                      </div>
                      <div class="msg-body">
                        <h3 class="h5">Ashley Wood</h3><span>sent you a direct message</span><small>3 days ago at 7:58
                          pm - 10.06.2014</small>
                      </div>
                    </a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Read all messages </strong></a></li>
                </ul>
              </li> -->
              <!-- Languages dropdown    -->
              <!-- <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="<?= base_url() . 'assets/' ?>img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                <ul aria-labelledby="languages" class="dropdown-menu">
                  <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="<?= base_url() . 'assets/' ?>img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a></li>
                  <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="<?= base_url() . 'assets/' ?>img/flags/16/FR.png" alt="English" class="mr-2"><span>French </span></a></li>
                </ul>
              </li> -->
              <!-- Log out-->
              <li class="nav-item"><a href="login.html" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <?php if ($this->session->flashdata('success')) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="text-center p-0 m-0"><?= $this->session->flashdata('success') ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>