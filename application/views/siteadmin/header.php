<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Admin Panel</title>
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
            <a href="index.html"><img class="brand-img pull-left" src="<?php echo base_url(); ?>/assets/dist/img/logo.png" alt="brand" /></a>
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
                        <li class="text-center"><a href="#">More</a></li>
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
                    <a class="active" href="<?php echo base_url(); ?>adminlogin/home"><i class="icon-picture mr-10"></i>Dashboard

                    </a>

                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><i class="icon-basket-loaded mr-10"></i>Masters<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="ecom_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url(); ?>category/">Category</a>
                        </li>
                        <li>
                            <a href="">Specification</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>attribute">Attribute</a>
                        </li>
                        <li>
                            <a href="">Tags</a>
                        </li>
                        <li>
                            <a href="">Zip code Masters</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><i class="icon-grid mr-10"></i>Apps <span class="pull-right"><span class="label label-info mr-10">9</span><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="app_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="chats.html">chats</a>
                        </li>
                        <li>
                            <a href="calendar.html">calendar</a>
                        </li>
                        <li>
                            <a href="weather.html">weather</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#email_dr">Email<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                            <ul id="email_dr" class="collapse">
                                <li>
                                    <a href="inbox.html">inbox</a>
                                </li>
                                <li>
                                    <a href="inbox-detail.html">detail email</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#contact_dr">Contacts<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                            <ul id="contact_dr" class="collapse">
                                <li>
                                    <a href="contact-list.html">list</a>
                                </li>
                                <li>
                                    <a href="contact-card.html">cards</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="file-manager.html">File Manager</a>
                        </li>
                        <li>
                            <a href="todo-tasklist.html">To Do/Tasklist</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><i class="icon-vector mr-10"></i>UI Elements<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="ui_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="panels-wells.html">Panels & Wells</a>
                        </li>
                        <li>
                            <a href="modals.html">Modals</a>
                        </li>
                        <li>
                            <a href="sweetalert.html">Sweet Alerts</a>
                        </li>
                        <li>
                            <a href="notifications.html">notifications</a>
                        </li>
                        <li>
                            <a href="typography.html">Typography</a>
                        </li>
                        <li>
                            <a href="buttons.html">Buttons</a>
                        </li>
                        <li>
                            <a href="accordion-toggle.html">Accordion / Toggles</a>
                        </li>
                        <li>
                            <a href="tabs.html">Tabs</a>
                        </li>
                        <li>
                            <a href="progressbars.html">Progress bars</a>
                        </li>
                        <li>
                            <a href="skills-counter.html">Skills & Counters</a>
                        </li>
                        <li>
                            <a href="pricing.html">Pricing Tables</a>
                        </li>
                        <li>
                            <a href="nestable.html">Nestables</a>
                        </li>
                        <li>
                            <a href="dorpdown.html">Dropdowns</a>
                        </li>
                        <li>
                            <a href="bootstrap-treeview.html">Tree View</a>
                        </li>
                        <li>
                            <a href="carousel.html">Carousel</a>
                        </li>
                        <li>
                            <a href="range-slider.html">Range Slider</a>
                        </li>
                        <li>
                            <a href="grid-styles.html">Grid</a>
                        </li>
                        <li>
                            <a href="bootstrap-ui.html">Bootstrap UI</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#form_dr"><i class=" icon-flag mr-10"></i>Forms<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="form_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="form-element.html">Basic Forms</a>
                        </li>
                        <li>
                            <a href="form-layout.html">form Layout</a>
                        </li>
                        <li>
                            <a href="form-advanced.html">Form Advanced</a>
                        </li>
                        <li>
                            <a href="form-mask.html">Form Mask</a>
                        </li>
                        <li>
                            <a href="form-picker.html">Form Picker</a>
                        </li>
                        <li>
                            <a href="form-validation.html">form Validation</a>
                        </li>
                        <li>
                            <a href="form-wizard.html">Form Wizard</a>
                        </li>
                        <li>
                            <a href="form-x-editable.html">X-Editable</a>
                        </li>
                        <li>
                            <a href="cropperjs.html">Cropperjs</a>
                        </li>
                        <li>
                            <a href="form-file-upload.html">File Upload</a>
                        </li>
                        <li>
                            <a href="dropzone.html">Dropzone</a>
                        </li>
                        <li>
                            <a href="bootstrap-wysihtml5.html">Bootstrap Wysihtml5</a>
                        </li>
                        <li>
                            <a href="tinymce-wysihtml5.html">Tinymce Wysihtml5</a>
                        </li>
                        <li>
                            <a href="summernote-wysihtml5.html">summernote</a>
                        </li>
                        <li>
                            <a href="typeahead-js.html">typeahead</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart_dr"><i class="icon-graph mr-10"></i>Charts <span class="pull-right"><span class="label label-primary mr-10">7</span><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="chart_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="flot-chart.html">Flot Chart</a>
                        </li>
                        <li>
                            <a href="morris-chart.html">Morris Chart</a>
                        </li>
                        <li>
                            <a href="chart.js.html">chartjs</a>
                        </li>
                        <li>
                            <a href="chartist.html">chartist</a>
                        </li>
                        <li>
                            <a href="easy-pie-chart.html">Easy Pie Chart</a>
                        </li>
                        <li>
                            <a href="sparkline.html">Sparkline</a>
                        </li>
                        <li>
                            <a href="peity-chart.html">Peity Chart</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#table_dr"><i class="icon-list mr-10"></i>Tables<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="table_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="basic-table.html">Basic Table</a>
                        </li>
                        <li>
                            <a href="bootstrap-table.html">Bootstrap Table</a>
                        </li>
                        <li>
                            <a href="data-table.html">Data Table</a>
                        </li>
                        <li>
                            <a href="export-table.html"><span class="pull-right"><span class="label label-warning">New</span></span>Export Table</a>
                        </li>
                        <li>
                            <a href="responsive-data-table.html"><span class="pull-right"><span class="label label-warning">New</span></span>RSPV DataTable</a>
                        </li>
                        <li>
                            <a href="responsive-table.html">Responsive Table</a>
                        </li>
                        <li>
                            <a href="editable-table.html">Editable Table</a>
                        </li>
                        <li>
                            <a href="foo-table.html">Foo Table</a>
                        </li>
                        <li>
                            <a href="jsgrid-table.html">Jsgrid Table</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="widgets.html"><i class="icon-drawar mr-10"></i>widgets</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#icon_dr"><i class="icon-options mr-10"></i>Icons<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="icon_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="fontawesome.html">Fontawesome</a>
                        </li>
                        <li>
                            <a href="themify.html">Themify</a>
                        </li>
                        <li>
                            <a href="linea-icon.html">Linea</a>
                        </li>
                        <li>
                            <a href="simple-line-icons.html">Simple Line</a>
                        </li>
                        <li>
                            <a href="pe-icon-7.html">Pe-icon-7</a>
                        </li>
                        <li>
                            <a href="glyphicons.html">Glyphicons</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#pages_dr"><i class="icon-layers mr-10"></i>Special Pages<span class="pull-right"><span class="label label-danger mr-10">12</span><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="pages_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="blank.html">Blank Page</a>
                        </li>
                        <li>
                            <a href="login.html">Login Page</a>
                        </li>
                        <li>
                            <a href="signup.html">Register</a>
                        </li>
                        <li>
                            <a href="forgot-password.html">Recover Password</a>
                        </li>
                        <li>
                            <a href="reset-password.html">reset Password</a>
                        </li>
                        <li>
                            <a href="locked.html">Lock Screen</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#invoice_dr">Invoice<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                            <ul id="invoice_dr" class="collapse">
                                <li>
                                    <a href="invoice.html">Invoice</a>
                                </li>
                                <li>
                                    <a href="invoice-archive.html">Invoice Archive</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="404.html">Error 404</a>
                        </li>
                        <li>
                            <a href="500.html">Error 500</a>
                        </li>
                        <li>
                            <a href="gallery.html">Gallery</a>
                        </li>
                        <li>
                            <a href="timeline.html">Timeline</a>
                        </li>
                        <li>
                            <a href="faq.html">FAQ</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#maps_dr"><i class="icon-map mr-10"></i>maps<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="maps_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="vector-map.html">Vector Map</a>
                        </li>
                        <li>
                            <a href="google-map.html">Google Map</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="documentation.html"><i class="icon-doc mr-10"></i>documentation</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#dropdown_dr_lv1"><i class="icon-arrow-down-circle mr-10"></i>Dropdown leavel 1<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                    <ul id="dropdown_dr_lv1" class="collapse collapse-level-1">
                        <li>
                            <a href="#">Dropdown Item</a>
                        </li>
                        <li>
                            <a href="#">Dropdown Item</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dropdown_dr_lv2">Dropdown leavel 2<span class="pull-right"><i class="fa fa-fw fa-angle-down"></i></span></a>
                            <ul id="dropdown_dr_lv2" class="collapse collapse-level-2">
                                <li>
                                    <a href="#">Dropdown Item</a>
                                </li>
                                <li>
                                    <a href="#">Dropdown Item</a>
                                </li>
                                <li>
                                    <a href="#">Dropdown Item</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
