<?php 
	header("Cache-Control: no cache");
	session_cache_limiter("private_no_expire");
	$browser_sess_id = 'lil'.$_SESSION["__ci_last_regenerate"];
	$this->session->set_userdata('browser_sess_id', $browser_sess_id);
	$cust_session_id = $this->session->userdata('cust_session_id');
	//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
	//echo get_cookie('search_values');
?>
<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Little A More - Online Shopping Cart</title>
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/front/img/icon/favicon.png">
    <!-- mobile menu css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/meanmenu.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/animate.css">
    <!-- nivo slider css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/nivo-slider.css">
    <!-- owl carousel css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/owl.carousel.min.css">
     <!-- fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/font-awesome.css">-->
    <!-- icon font pack css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/pixen.css">-->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css">
    <!-- default css  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/default.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/responsive.css">

    <!-- modernizr js -->
    <script src="<?php echo base_url(); ?>assets/front/js/modernizr-2.8.3.min.js"></script>
    
    <!-- jquery 3.12.4 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery-ui.css">
    
    <script src="<?php echo base_url(); ?>assets/front/js/jquery-1.12.4.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/additional-methods.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Wrapper Start -->
    <div class="wrapper home-3">
       <!-- Preloader Start -->
        <div class="preloader">
            <div class="loading-center">
                <div class="loading-center-absolute">
                    <div class="object object_one"></div>
                    <div class="object object_two"></div>
                    <div class="object object_three"></div>
                </div>
            </div>
        </div>
        <!-- Preloader End -->
       
       
        <!-- Header Area Start -->
        <header>
           <div class="container-fluid header-top-area header-sticky">
               <div class="row">
                    <!-- Logo Start -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-5 full-col pl-0">
                        <div class="logo">
                             <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/img/logo/logo.png" alt="Little A More"></a>
                        </div>
                    </div>
                    <!-- Logo End -->
                    <div class="col-xs-12 visible-xs visible-control">
                        <ul class="search-form mobile-form">
                            <li>
                                <form method="post" action="<?php echo base_url(); ?>home/search/" name="search_form">
                                    <input type="text" class="search" name="search_tags1" id="search_tags1" placeholder="Search for products...">
                                </form>
                                <i class="pe-7s-search"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- Primary-Menu Start -->
                    <div class="col-lg-6 col-md-7 col-sm-12  hidden-sm hidden-xs">
                        <div class="primary-menu">
                            <nav>
                                <ul class="primary-menu-list">
                                    <li><a href="<?php echo base_url(); ?>">home</a></li>
									<?php 
									if (count($main_catmenu)>0){
										foreach($main_catmenu as $rowm){ 
										$cat_id = $rowm->id;
										$category_id = $rowm->id * 564738;
										$category_name = strtolower(preg_replace("/[^\w]/", "-", $rowm->category_name));
										$enc_category_id = base64_encode($category_id);
                                    	echo '<li><a href="'.base_url().'home/categories/'.$cat_id.'/'.$category_name.'/">'.$rowm->category_name.'<i class="pe-7s-angle-down"></i></a>';
                                    	$sub_catmenu = $this->homemodel->get_sub_catmenu($cat_id);
											if (count($sub_catmenu)>0){
                                    			echo '<ul class="ht-dropdown">';
                                          		foreach($sub_catmenu as $rows) {
													$sub_cat_id = $rows->id;
													$sub_category_id = $rows->id * 564738;
													$sub_category_name = strtolower(preg_replace("/[^\w]/", "-", $rows->category_name));
													$enc_sub_category_id = base64_encode($sub_category_id);
                                    				echo '<li><a href="'.base_url().'home/subcategories/'.$sub_cat_id.'/'.$sub_category_name.'/">'.$rows->category_name.'</a></li>';
                                    			}
                                    			echo '</ul>';
                                   			}
                                    	echo '</li>';
                                   		}
									} ?>
                                    <!--<li><a href="<?php echo base_url(); ?>aboutus/">about us</a></li>
                                    <li><a href="<?php echo base_url(); ?>contactus/">contact us</a></li>-->
                                  </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Primary-Menu End -->
                    <!-- Header All Shopping Selection Start -->
                    <div class="col-lg-4 col-md-2 col-sm-6 col-xs-7 full-col pr-0">
                        <div class="main-selection">
                            <ul class="selection-list text-right">
                            <li class="hidden-control">
                                <form method="post" action="<?php echo base_url(); ?>home/search/" name="search_form">
                                    <input type="text" class="form-control" name="search_tags" id="search_tags" placeholder="Search for products...">
                                </form>
							</li>
                                <!-- Searcch Box Start -->
                                <!--<li class="hidden-control">
                                <i class="pe-7s-search"></i>
                                    <ul class="search-form ht-dropdown">
                                        <li>
										<form method="post" action="<?php echo base_url(); ?>home/search/" name="search_form">
											<input type="text" class="search" name="search_tags" id="search_tags" placeholder="Search for products...">
											<i class="pe-7s-search"></i>
										</form>
                                        </li>
                                    </ul>
                                </li>-->
                                <!-- Search Box End -->
                                <?php if ($cust_session_id !=''){ ?><li><a href="<?php echo base_url(); ?>wishlist/"><i class="pe-7s-like"></i><span><?php echo count($count_wishlist); ?></span></a></li><?php } ?>
                                <li><a href="<?php echo base_url(); ?>viewcart/"><i class="pe-7s-shopbag"></i><span><?php echo count($count_cart_session); ?></span></a></li>
                                <!-- Dropdown Currency Selection Start -->
                                <li><i class="pe-7s-config"></i>
                                    <ul class="ht-dropdown currrency">
                                        <li>
                                            <h3>my account</h3>
                                            <ul>
                                            <?php if (isset($_SESSION['cust_session_id'])) { ?>
                                            	<li><a href="<?php echo base_url(); ?>myaccount/">My Account</a></li>
                                                <li><a href="<?php echo base_url(); ?>logout/">logout</a></li>
                                            <?php } else { ?>
                                                <li><a href="<?php echo base_url(); ?>register/">register</a></li>
                                                <li><a href="<?php echo base_url(); ?>login/">log in</a></li>
                                             <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Dropdown Currency Selection End -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header All Shopping Selection End -->
                   
                    <!-- Mobile Menu  Start -->
                    <div class="mobile-menu visible-sm visible-xs">
							<nav>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">home</a></li>
									<?php 
									if (count($main_catmenu)>0){
										foreach($main_catmenu as $rowm){ 
										$cat_id = $rowm->id;
										$category_id = $rowm->id * 564738;
										$category_name = strtolower(preg_replace("/[^\w]/", "-", $rowm->category_name));
										$enc_category_id = base64_encode($category_id);
                                    	echo '<li><a href="'.base_url().'home/categories/'.$cat_id.'/'.$category_name.'/">'.$rowm->category_name.'</a>';
                                    	$sub_catmenu = $this->homemodel->get_sub_catmenu($cat_id);
											if (count($sub_catmenu)>0){
                                    			echo '<ul>';
                                          		foreach($sub_catmenu as $rows) {
													$sub_cat_id = $rows->id;
													$sub_category_id = $rows->id * 564738;
													$sub_category_name = strtolower(preg_replace("/[^\w]/", "-", $rows->category_name));
													$enc_sub_category_id = base64_encode($sub_category_id);
                                    				echo '<li><a href="'.base_url().'home/subcategories/'.$sub_cat_id.'/'.$sub_category_name.'/">'.$rows->category_name.'</a></li>';
                                    			}
                                    			echo '</ul>';
                                   			}
                                    	echo '</li>';
                                   		}
									} ?>
                                     <!--<li><a href="<?php echo base_url(); ?>aboutus/">about us</a></li>
                                    <li><a href="<?php echo base_url(); ?>contactus/">contact us</a></li>-->
                                </ul>
                            </nav>
                    </div>
                    <!-- Mobile Menu  End -->
               </div>
           </div>
        </header>
        <!-- Header Area End -->