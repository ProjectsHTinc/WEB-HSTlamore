<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Lil' amore</title>
    <meta name="description" content="" />
    <meta name="keywords" content="a" />
    <meta name="author" content="" />
    <link href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>dist/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/dist/js/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bower_components/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css">

	  <script src="<?php echo base_url(); ?>assets/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/dist/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/additional-methods.min.js"></script>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->
    <div class="wrapper">
        <!-- Top Menu Items -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block mr-20 pull-left" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a href="<?php echo base_url(); ?>adminlogin/home"><img class="brand-img pull-left" src="<?php echo base_url(); ?>/assets/dist/img/logo.png" alt="brand" /></a>
            <ul class="nav navbar-right top-nav pull-right">

                <li>
                    <a id="open_right_sidebar" href="javascript:void(0);"><i class="fa fa-cog top-nav-icon"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th top-nav-icon"></i></a>
                    <ul class="dropdown-menu app-dropdown" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <li>
                            <ul class="app-icon-wrap">
                                <li>
                                    <a href="#" class="connection-item">
                                        <i class="pe-7s-umbrella txt-info"></i>
                                        <span class="block">weather</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="connection-item">
                                        <i class="pe-7s-mail-open-file txt-success"></i>
                                        <span class="block">e-mail</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="connection-item">
                                        <i class="pe-7s-date txt-primary"></i>
                                        <span class="block">calendar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="connection-item">
                                        <i class="pe-7s-map txt-danger"></i>
                                        <span class="block">map</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="connection-item">
                                        <i class="pe-7s-comment txt-warning"></i>
                                        <span class="block">chat</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="connection-item">
                                        <i class="pe-7s-notebook"></i>
                                        <span class="block">contact</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="divider"></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url(); ?>/assets/dist/img/user1.png" alt="user_auth" class="user-auth-img img-circle" /><span class="user-online-status"></span></a>
                    <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>adminlogin/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>adminlogin/changepassword"><i class="fa fa-fw fa-gear"></i>Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url(); ?>adminlogin/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-search-overlap" id="site_navbar_search">
                <form role="search">
                    <div class="form-group mb-0">
                        <div class="input-search">
                            <div class="input-group">
                                <input type="text" id="overlay_search" name="overlay-search" class="form-control pl-30" placeholder="Search">
                                <span class="input-group-addon pr-30">
									<a  href="javascript:void(0)" class="close-input-overlay" data-target="#site_navbar_search" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="fa fa-times"></i></a>
									</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        <div class="fixed-sidebar-left">
            <ul class="nav navbar-nav side-nav nicescroll-bar">
                <li>
                    <a id="dashboard" href="<?php echo base_url(); ?>adminlogin/home"><i class="icon-picture mr-10"></i>Dashboard

                    </a>

                </li>
                <li>
                    <a href="javascript:void(0);" id="master" data-toggle="collapse" data-target="#ecom_dr"><i class="icon-basket-loaded mr-10"></i>Masters<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="ecom_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url(); ?>category/">Category</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/specification">Specification</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>attribute">Attribute</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/tags">Tags</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/zipcode">Zip code Masters</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a id="products" href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><i class="icon-grid mr-10"></i>Products <span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="app_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url(); ?>admin/products">Create Products</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/view_products">View Products</a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_tr"><i class="icon-vector mr-10"></i>Tracking <span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="ui_tr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url(); ?>admin/tracking">View orders</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>admin/list_of_orders">List of orders</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><i class="icon-vector mr-10"></i>Promotional <span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="ui_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url(); ?>admin/banner">Banners</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/ads">Ads Banner</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/offers">Offer Products</a>
                        </li>

                    </ul>
                </li>
                <?php 	$user_role=$this->session->userdata('role_type_id');
                if($user_role=='1'){?>
                  <li>
                      <a href="javascript:void(0);" data-toggle="collapse" data-target="#form_dr"><i class=" icon-flag mr-10"></i>Customer<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                      <ul id="form_dr" class="collapse collapse-level-1">
                          <li>
                              <a href="<?php echo base_url(); ?>admin/customers">View Customers</a>
                          </li>

                      </ul>
                  </li>
                  <li>
                      <a href="javascript:void(0);" data-toggle="collapse" data-target="#sales_menu"><i class=" icon-flag mr-10"></i>Sales<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                      <ul id="sales_menu" class="collapse collapse-level-1">
                          <li>
                              <a href="<?php echo base_url(); ?>admin/sales">Sales Report</a>
                          </li>

                      </ul>
                  </li>

                <?php } ?>




            </ul>
        </div>
