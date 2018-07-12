<?php 
$guest_data = 'lil'.$_SESSION["__ci_last_regenerate"]; 
$this->session->set_userdata('guest_user', $guest_data);
//echo $_SESSION['guest_user'];
?>
<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nevara-Furniture & Interior Ecommerce HTML Template</title>
    <meta name="description" content="Default Description">
    <meta name="keywords" content="E-commerce" />
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
    <!-- price slider css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery-ui.min.css">
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
    <script src="<?php echo base_url(); ?>assets/front/js/vendor/modernizr-2.8.3.min.js"></script>
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
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-5 full-col pl-0">
                        <div class="logo">
                             <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/img/logo/logo.png" alt="brand-image"></a>
                        </div>
                    </div>
                    <!-- Logo End -->
                    <div class="col-xs-12 visible-xs visible-control">
                        <ul class="search-form mobile-form">
                            <li>
                                <form action="#">
                                    <input type="text" class="search" name="search" placeholder="Search for products...">
                                </form>
                                <i class="pe-7s-search"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- Primary-Menu Start -->
                    <div class="col-lg-7 col-md-7 col-sm-12  hidden-sm hidden-xs">
                        <div class="primary-menu">
                            <nav>
                                <ul class="primary-menu-list text-center">
                                    <li><a href="<?php echo base_url(); ?>">home</a></li>
										<li><a href="#">furniture<i class="pe-7s-angle-down"></i></a>
                                        <!-- Mega Menu Start -->
                                        <ul class="ht-dropdown mega-menu">
                                            <!-- Single Mega Sub Menu Start -->
                                            <li>
                                                <h3>SOFAS & LOVESEATSs</h3>
                                                <ul>
                                                    <li><a href="categorie-page.html">convallis neceros</a></li>
                                                    <li><a href="categorie-page.html">Outdoor Rugs</a></li>
                                                    <li><a href="categorie-page.html">Mice and Trackballs</a></li>
                                                    <li><a href="categorie-page.html">Cameras</a></li>
                                                </ul>
                                            </li>
                                            <!-- Single Mega Sub Menu Start -->
                                            <!-- Single Mega Sub Menu Start -->
                                            <li>
                                                <h3>Chairs & Recliners</h3>
                                                <ul>
                                                    <li><a href="categorie-page.html">commodo nunc</a></li>
                                                    <li><a href="categorie-page.html">dignissim porta</a></li>
                                                    <li><a href="categorie-page.html">necvelit dignissim</a></li>
                                                    <li><a href="categorie-page.html">venenatis lacinia</a></li>
                                                </ul>
                                            </li>
                                            <!-- Single Mega Sub Menu Start -->
                                        </ul>
                                        <!-- Mega Menu End -->
                                    </li>
                                    <li class="static-menu"><a href="#">decor<i class="pe-7s-angle-down"></i></a>
                                        <!-- Mega Menu Start -->
                                        <ul class="ht-dropdown mega-menu-2">
                                            <!-- Single Mega Sub Menu Start -->
                                            <li>
                                                <h3>Art Gallery</h3>
                                                <ul>
                                                    <li><a href="categorie-page.html">congue nonorna</a></li>
                                                    <li><a href="categorie-page.html">Etiam sapien</a></li>
                                                    <li><a href="categorie-page.html">Outdoor Lighting</a></li>
                                                    <li><a href="categorie-page.html">sapien enim</a></li>
                                                </ul>
                                            </li>
                                            <!-- Single Mega Sub Menu Start -->
                                            <!-- Single Mega Sub Menu Start -->
                                            <li>
                                                <h3>Lighting</h3>
                                                <ul>
                                                    <li><a href="categorie-page.html">commodo nunc</a></li>
                                                    <li><a href="categorie-page.html">elementum dolor</a></li>
                                                    <li><a href="categorie-page.html">ligula velvenen</a></li>
                                                    <li><a href="categorie-page.html">Vestibulum tempor</a></li>
                                                </ul>
                                            </li>
                                            <!-- Single Mega Sub Menu Start -->
                                            <!-- Single Mega Sub Menu Start -->
                                            <li>
                                                <h3>Rugs</h3>
                                                <ul>
                                                    <li><a href="categorie-page.html">blandit vehicula</a></li>
                                                    <li><a href="categorie-page.html">Praesent molestie</a></li>
                                                    <li><a href="categorie-page.html">sagittis ipsum</a></li>
                                                    <li><a href="categorie-page.html">venenatis innunc</a></li>
                                                </ul>
                                            </li>
                                            <!-- Single Mega Sub Menu Start -->
                                            <!-- Single Mega Sub Menu Start -->
                                            <li>
                                                <h3>Throw Pillows</h3>
                                                <ul>
                                                    <li><a href="categorie-page.html">Fire Pits</a></li>
                                                    <li><a href="categorie-page.html">Garden Accents</a></li>
                                                    <li><a href="categorie-page.html">Outdoor Fountains</a></li>
                                                    <li><a href="categorie-page.html">Patio Heaters</a></li>
                                                </ul>
                                            </li>
                                            <!-- Single Mega Sub Menu Start -->
                                        </ul>
                                        <!-- Mega Menu End -->
                                    </li>
                                    <li><a href="#">pages<i class="pe-7s-angle-down"></i></a>
                                        <!-- Home Version Dropdown Start -->
                                        <ul class="ht-dropdown">
                                            <li><a href="categorie-page.html">shop</a></li>
                                            <li><a href="product-page.html">Product Details</a></li>
                                            <li><a href="cart.html">cart</a></li>
                                            <li><a href="checkout.html">checkout</a></li>
                                            <li><a href="wish-list.html">wish list</a></li>
                                            <li><a href="blog.html">blog</a></li>
                                            <li><a href="blog-details.html">blog details</a></li>
                                            <li><a href="contact.html">contact</a></li>
                                            <li><a href="privacy.html">Privacy Policy</a></li>
                                            <li><a href="404.html">404</a></li>
                                        </ul>
                                        <!-- Home Version Dropdown End -->
                                    </li>
                                    <li><a href="<?php echo base_url(); ?>aboutus/">about us</a></li>
                                    <li><a href="<?php echo base_url(); ?>contactus/">contact us</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Primary-Menu End -->
                    <!-- Header All Shopping Selection Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-7 full-col pr-0">
                        <div class="main-selection">
                            <ul class="selection-list text-right">
                                <!-- Searcch Box Start -->
                                <li class="hidden-control"><i class="pe-7s-search"></i>
                                    <ul class="search-form ht-dropdown">
                                        <li>
                                            <form action="#">
                                                <input type="text" class="search" name="search" placeholder="Search for products...">
                                            </form>
                                            <i class="pe-7s-search"></i>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Search Box End -->
                                <li><a href="<?php echo base_url(); ?>wishlist"><i class="pe-7s-like"></i><span>2</span></a></li>
                                <li><i class="pe-7s-shopbag"></i><span>2</span>
                                    <ul class="ht-dropdown main-cart-box">
                                        <li>
                                            <!-- Cart Box Start -->
                                            <div class="single-cart-box">
                                                <div class="cart-img">
                                                    <a href="#"><img src="<?php echo base_url(); ?>assets/front/img/menu/1.jpg" alt="cart-image"></a>
                                                </div>
                                                <div class="cart-content">
                                                    <h6><a href="#">Alpha Block Black Polo T-Shirt</a></h6>
                                                    <span>1 × $399.00</span>
                                                </div>
                                                <i class="pe-7s-close"></i>
                                            </div>
                                            <!-- Cart Box End -->
                                            <!-- Cart Box Start -->
                                            <div class="single-cart-box">
                                                <div class="cart-img">
                                                    <a href="#"><img src="<?php echo base_url(); ?>assets/front/img/menu/2.jpg" alt="cart-image"></a>
                                                </div>
                                                <div class="cart-content">
                                                    <h6><a href="#">Red Printed Round Neck T-Shirt</a></h6>
                                                    <span>2 × $299.00</span>
                                                </div>
                                                <i class="pe-7s-close"></i>
                                            </div>
                                            <!-- Cart Box End -->
                                            <!-- Cart Footer Inner Start -->
                                            <div class="cart-footer fix">
                                                <h5>total :<span class="f-right">$698.00</span></h5>
                                                <div class="cart-actions">
                                                    <a class="checkout" href="checkout.html">Checkout</a>
                                                </div>
                                            </div>
                                            <!-- Cart Footer Inner End -->
                                        </li>
                                    </ul>
                                </li>
                                <!-- Dropdown Currency Selection Start -->
                                <li><i class="pe-7s-config"></i>
                                    <ul class="ht-dropdown currrency">
                                        
                                        <li>
                                            <h3>my account</h3>
                                            <ul>
                                                <li><a href="register.html">register</a></li>
                                                <li><a href="account.html">My Account</a></li>
                                                <li><a href="log-in.html">log in</a></li>
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
                                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                <li><a href="#">Furniture</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="#">sofas & loveseats</a>
                                            <!-- Mobile Menu Sub-Dropdown Start -->
                                            <ul>
                                                <li><a href="categorie-page.html">convallis neceros</a></li>
                                                <li><a href="categorie-page.html">Outdoor Rugs</a></li>
                                                <li><a href="categorie-page.html">Mice and Trackballs</a></li>
                                                <li><a href="categorie-page.html">Cameras</a></li>
                                            </ul>
                                            <!-- Mobile Menu Sub-Dropdown End -->
                                        </li>
                                        <li><a href="#">chairs & recliners</a>
                                            <!-- Mobile Menu Sub-Dropdown Start -->
                                            <ul>
                                                <li><a href="categorie-page.html">commodo nunc</a></li>
                                                <li><a href="categorie-page.html">dignissim porta</a></li>
                                                <li><a href="categorie-page.html">necvelit dignissim</a></li>
                                                <li><a href="categorie-page.html">venenatis lacinia</a></li>
                                            </ul>
                                            <!-- Mobile Menu Sub-Dropdown End -->
                                        </li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="#">decor</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="#">art gallery</a>
                                            <!-- Mobile Menu Sub-Dropdown Start -->
                                            <ul>
                                                <li><a href="categorie-page.html">congue nonorna</a></li>
                                                <li><a href="categorie-page.html">Etiam sapien</a></li>
                                                <li><a href="categorie-page.html">Outdoor Lighting</a></li>
                                                <li><a href="categorie-page.html">sapien enim</a></li>
                                            </ul>
                                            <!-- Mobile Menu Sub-Dropdown End -->
                                        </li>
                                        <li><a href="#">lighting</a>
                                            <!-- Mobile Menu Sub-Dropdown Start -->
                                            <ul>
                                                <li><a href="categorie-page.html">commodo nunc</a></li>
                                                <li><a href="categorie-page.html">elementum dolor</a></li>
                                                <li><a href="categorie-page.html">ligula velvenen</a></li>
                                                <li><a href="categorie-page.html">Vestibulum tempor</a></li>
                                            </ul>
                                            <!-- Mobile Menu Sub-Dropdown End -->
                                        </li>
                                        <li><a href="#">rugs</a>
                                            <!-- Mobile Menu Sub-Dropdown Start -->
                                            <ul>
                                                <li><a href="categorie-page.html">blandit vehicula</a></li>
                                                <li><a href="categorie-page.html">Praesent molestie</a></li>
                                                <li><a href="categorie-page.html">sagittis ipsum</a></li>
                                                <li><a href="categorie-page.html">venenatis innunc</a></li>
                                            </ul>
                                            <!-- Mobile Menu Sub-Dropdown End -->
                                        </li>
                                        <li><a href="#">throw pillows</a>
                                            <!-- Mobile Menu Sub-Dropdown Start -->
                                            <ul>
                                                <li><a href="categorie-page.html">Fire Pits</a></li>
                                                <li><a href="categorie-page.html">Garden Accents</a></li>
                                                <li><a href="categorie-page.html">Outdoor Fountains</a></li>
                                                <li><a href="categorie-page.html">Patio Heaters</a></li>
                                            </ul>
                                            <!-- Mobile Menu Sub-Dropdown End -->
                                        </li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="#">pages</a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul>
                                        <li><a href="categorie-page.html">shop</a></li>
                                        <li><a href="product-page.html">Product Details</a></li>
                                        <li><a href="cart.html">cart</a></li>
                                        <li><a href="checkout.html">checkout</a></li>
                                        <li><a href="wish-list.html">wish list</a></li>
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                        <li><a href="contact.html">contact</a></li>
                                        <li><a href="privacy.html">Privacy Policy</a></li>
                                        <li><a href="404.html">404</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="<?php echo base_url(); ?>aboutus/">about us</a></li>
                                <li><a href="<?php echo base_url(); ?>contactus/">contact us</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Mobile Menu  End -->
               </div>
           </div>
        </header>
        <!-- Header Area End -->