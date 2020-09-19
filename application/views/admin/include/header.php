<!DOCTYPE html>

<html lang="en">

<!-- Mirrored from www.saerox-design.com/elisyam/db-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Apr 2020 01:15:06 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Elisyam - Dashboard</title>
<meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
<script type="text/javascript">
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url().'assets/img/apple-touch-icon.png'?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().'assets/img/favicon-32x32.png'?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url().'assets/img/favicon-16x16.png'?>">

<link rel="stylesheet" href="<?php echo base_url().'assets/vendors/css/base/bootstrap.min.css'?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/vendors/css/base/elisyam-1.5.min.css'?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/owl-carousel/owl.carousel.min.css'?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/owl-carousel/owl.theme.min.css'?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-select/bootstrap-select.min.css'?>">

<script src="<?php echo base_url().'assets/js/jquery/jquery-3.4.1.js'?>"></script>
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body id="page-top">

<div id="preloader">
  <div class="canvas">
    <img src="<?php echo base_url()."assets/img/logo.png"?>" alt="logo" class="loader-logo">
    <div class="spinner"></div>
  </div>
</div>

<div class="page">
  <header class="header">
    <nav class="navbar fixed-top">
      <div class="search-box">
        <button class="dismiss"><i class="ion-close-round"></i></button>
        <form id="searchForm" action="#" role="search">
          <input type="search" placeholder="Search something ..." class="form-control">
        </form>
      </div>
      <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
        <div class="navbar-header">
          <a href="db-default.html" class="navbar-brand">
            <div class="brand-image brand-big">
              <img src="<?php echo base_url()."assets/img/logo-big.png"?>" alt="logo" class="logo-big">
            </div>
            <div class="brand-image brand-small">
              <img src="<?php echo base_url()."assets/img/logo.png"?>" alt="logo" class="logo-small">
            </div>
          </a>
          <a id="toggle-btn" href="#" class="menu-btn active">
            <span></span>
            <span></span>
            <span></span>
          </a>
        </div>
        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
          <span>Admin</span>
          <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="<?php echo base_url()."assets/img/".$_SESSION['data']['admin']['image']?>" alt="..." class="avatar rounded-circle"></a>
            <ul aria-labelledby="user" class="user-size dropdown-menu">
            <li class="welcome">
            <a href="#" class="edit-profil"><i class="la la-gear"></i></a>
            <img src="<?php echo base_url()."assets/img/".$_SESSION['data']['admin']['image']?>" alt="..." class="rounded-circle">
          </li>
          <li>
          <a href="<?php echo site_url("admin/profile");?>" class="dropdown-item">
          Profile
          </a>
          </li>
     
          <li class="separator"></li>
         
          <li><a rel="nofollow" href="<?php echo site_url("login/logout");?>" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li>
          </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="page-content d-flex align-items-stretch">
    <div class="default-sidebar">
      <nav class="side-navbar box-scroll sidebar-scroll">
        <ul class="list-unstyled">
      	 <li class="active"><a href="<?php echo site_url("admin/dashboard");?>"><i class="ti ti-desktop"></i><span>Dashboard</span></a>
      	 </li>
         <li><a href="#dropdown-app" aria-expanded="false" data-toggle="collapse"><i class="ti ti-shopping-cart"></i><span>Order Manage</span></a>
          <ul id="dropdown-app" class="collapse list-unstyled pt-0">
            <li><a href="<?php echo site_url("admin/new_order");?>">New Order</a></li>
            <li><a href="<?php echo site_url("admin/orders");?>">Order List</a></li>

            <li><a href="<?php echo site_url("admin/deliver_orders");?>">Deliver Orders</a></li>
          </ul>
          </li>
         <li><a href="#dropdown-app4" aria-expanded="false" data-toggle="collapse"><i class="ti ti-layout-grid3"></i><span>Category Manage</span></a>
          <ul id="dropdown-app4" class="collapse list-unstyled pt-0">
            <li><a href="<?php echo site_url("admin/addCategoryForm")?>">Add Category</a></li>
            <li><a href="<?php echo site_url("admin/category")?>">Category List</a></li>
          </ul>
          </li>
          <li><a href="#dropdown-app1" aria-expanded="false" data-toggle="collapse"><i class="ti ti-package"></i><span>Product Manage</span></a>
          <ul id="dropdown-app1" class="collapse list-unstyled pt-0">
            <li><a href="<?php echo site_url("admin/addProduct")?>">Add Product</a></li>
            <li><a href="<?php echo site_url("admin/productList")?>">Product List</a></li>
          </ul>
          </li>
         <li><a href="#dropdown-app2" aria-expanded="false" data-toggle="collapse"><i class="la ti-user"></i><span>Vendors</span></a>
          <ul id="dropdown-app2" class="collapse list-unstyled pt-0">
             <li><a href="<?php echo site_url("admin/vendorForm")?>">Add Vendors</a></li>
            <li><a href="<?php echo site_url("admin/vendor")?>">Vendors List</a></li>
          </ul>
          </li>
          <li><a href="#dropdown-app6" aria-expanded="false" data-toggle="collapse"><i class="la la-user"></i><span>Agents</span></a>
          <ul id="dropdown-app6" class="collapse list-unstyled pt-0">
            <li><a href="<?php echo site_url("admin/add_agent_form")?>">Add Agent</a></li>
            <li><a href="<?php echo site_url("admin/agent_list")?>">Agent List</a></li>
          </ul>
          </li>
          <li><a href="#dropdown-app9" aria-expanded="false" data-toggle="collapse"><i class="la la-cubes"></i><span>Inventory</span></a>
          <ul id="dropdown-app9" class="collapse list-unstyled pt-0">
            <li><a href="<?php echo site_url("admin/manage_stock")?>">Manage Stock</a></li>
            <li><a href="<?php echo site_url("admin/stock_list")?>">Stock List</a></li>
          </ul>
          </li>
          <li><a href="<?php echo site_url("admin/customer");?>"><i class="la la la-users"></i><span>Customers</span></a>
          </li>
          <li><a href="<?php echo site_url("admin/shipping");?>"><i class="la la la-users"></i><span>Shipping</span></a>
          </li>
        </ul>
      </nav>
    </div>