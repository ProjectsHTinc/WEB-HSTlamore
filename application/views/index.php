        <!-- Slider Area Start -->
        <div class="slider-area pb-100">
            <!-- Main Slider Area Start -->
            <div class="slider-wrapper theme-default">
                <!-- Slider Background  Image Start-->
                <div id="slider" class="nivoSlider">
                    <img src="<?php echo base_url(); ?>assets/front/img/slider/5.jpg" data-thumb="<?php echo base_url(); ?>assets/front/<?php echo base_url(); ?>assets/front/img/slider/5.jpg" alt="" title="#htmlcaption" />
                    <img src="<?php echo base_url(); ?>assets/front/img/slider/6.jpg" data-thumb="<?php echo base_url(); ?>assets/front/<?php echo base_url(); ?>assets/front/img/slider/6.jpg" alt="" title="#htmlcaption2" />
                </div>
                <!-- Slider Background  Image Start-->
                <!-- Slider htmlcaption Start-->
                <div id="htmlcaption" class="nivo-html-caption slider-caption">
                    <!-- Slider Text Start -->
                    <div class="slider-text">
                        <h2 class="wow fadeInLeft" data-wow-delay="1s">Home Decor Shopping <br> Made Easy</h2>
                        <p class="wow fadeInRight" data-wow-delay="1s">Register now and get 10% off</p>
                        <a class="wow bounceInDown" data-wow-delay="0.8s" href="categorie-page.html">shop now</a>
                    </div>
                    <!-- Slider Text End -->
                </div>
                <!-- Slider htmlcaption End -->
                <!-- Slider htmlcaption Start -->
                <div id="htmlcaption2" class="nivo-html-caption slider-caption">
                    <!-- Slider Text Start -->
                    <div class="slider-text">
                        <h2 class="wow zoomInUp" data-wow-delay="0.5s">Shelves With Home Decor <br> In Modern Room</h2>
                        <p class="wow zoomInUp" data-wow-delay="0.6s">We’ll give you a FREE delivery!</p>
                        <a class="wow zoomInUp" data-wow-delay="1s" href="categorie-page.html">shop now</a>
                    </div>
                    <!-- Slider Text End -->
                </div>
                <!-- Slider htmlcaption End -->
            </div>
            <!-- Main Slider Area End -->
        </div>
        <!-- Slider Area End -->
        
       <?php  if (count($home_newproducts)>0){ ?>
        
        <!-- New Products Selection Start -->
        <div class="new-products-selection pb-80">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="col-xs-12">
                        <div class="section-title text-center mb-40">
                            <span class="section-desc mb-15">Top new in this week</span>
                            <h3 class="section-info">new products</h3>
                        </div>
                    </div>
                    <!-- Section Title End -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- New Products Activation Start -->
                        <div class="new-products owl-carousel">
                        
                        <?php foreach($home_newproducts as $npro){ 
								$sproduct_id = $npro->id;
								$product_id = $npro->id * 663399;
								$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $npro->product_name));
								$enc_product_id = base64_encode($product_id);
								
								$combined_status = $npro->combined_status;
								
								$posteddate = date("d-m-Y",strtotime($npro->created_at));
								$check_date = date("d-m-Y",strtotime("-15 day"));
                            ?>                    
                            <!-- Double Product Start -->
                            <div class="double-products">
                                <!-- Single Product Start -->
                                <div class="single-product">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/">
                                            <img class="primary-img" src="<?php echo base_url(); ?>assets/products/<?php echo $npro->product_cover_img; ?>" alt="single-product">
                                            <!--<img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/1_2.jpg" alt="single-product">-->
                                        </a>
                                        <!--<div class="quick-view">
                                            <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                        </div>-->
                                        <span class="sticker-new">new</span>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content text-center">
                                        <h4><a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/"><?php echo $npro->product_name; ?></a></h4>
                                        <p class="price"><span>₹<?php echo $npro->prod_actual_price; ?></span></p>
                                        <div class="action-links2">
                                         <?php if ($combined_status == '1'){ ?>
                                            <a data-toggle="tooltip" title="View Products" href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/" style="background:#FAA320;">view products</a>
                                        <?php } else { ?>
                                            <a data-toggle="tooltip" title="Add to Cart" href="<?php echo base_url(); ?>home/addcart/<?php echo $sproduct_id; ?>/">add to cart</a>
                                         <?php }?>
                                        </div>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                <!-- Single Product End -->
                            </div>
                            <!-- Double Product End -->
                            <?php } ?>
                                                       
                        </div>
                        <!-- New Products Activation End -->
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- New Products Selection End -->
        
        <?php } ?>
        
        
        
        <!-- New Products Banner Start -->
        <div class="new-products-banner pb-100">
            <div class="container">
                <div class="row mb-100">
                    <!-- Single Banner Start -->
                    <div class="col-sm-6">
                        <div class="single-banner">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/front/img/products-banner/10.jpg" alt="product-banner"></a>
                        </div>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="col-sm-6">
                        <div class="single-banner">
                            <div class="banner-description">
                                <h3>Chandeliers & Pendants</h3>
                                <h5>Extra 10% off Select Lingting</h5>
                                <a href="categorie-page.html">shop now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Banner End -->   
                </div>
                <!-- Row End -->
                <div class="row">
                    <!-- Single Banner Start -->
                    <div class="col-sm-6">
                        <div class="single-banner">
                            <div class="banner-description">
                                <h3>Home Decor</h3>
                                <h5>Sale 30% Off</h5>
                                <a href="categorie-page.html">shop now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="col-sm-6">
                        <div class="single-banner">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/front/img/products-banner/11.jpg" alt="product-banner"></a>
                        </div>
                    </div>
                    <!-- Single Banner End -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- New Products Banner End -->
        <!-- home-2 Big Banner Start -->
        <div class="h2-big-banner pb-100">
            <div class="container">
                <div class="row">
                    <!-- Big Banner Start -->
                    <div class="col-sm-12">
                        <div class="big-banner text-center">
                            <div class="big-banner-desc">
                                <h2>Interior Creativity with Nevara</h2>
                                <a href="categorie-page.html">view more</a>
                            </div>
                        </div>
                    </div>
                    <!-- Big Banner End -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- home-2 Big Banner End -->
        
  	<?php  if (count($home_popularproducts)>0){ ?>       
        <!-- Best Seller Products Start -->
        <div class="best-seller-products pb-100">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="col-xs-12">
                        <div class="section-title text-center mb-40">
                            <span class="section-desc mb-20">Most Viewed from customers</span>
                            <h3 class="section-info">popular products</h3>
                        </div>
                    </div>
                    <!-- Section Title End -->
                </div>
                <!-- Row End -->
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Best Seller Product Activation Start -->
                        <div class="best-seller new-products owl-carousel">
                        
                            <?php foreach($home_popularproducts as $npro){ 
								$sproduct_id = $npro->id;
								$product_id = $npro->id * 663399;
								$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $npro->product_name));
								$enc_product_id = base64_encode($product_id);
								
								$combined_status = $npro->combined_status;
								
								$posteddate = date("d-m-Y",strtotime($npro->created_at));
								$check_date = date("d-m-Y",strtotime("-15 day"));
                            ?>                    
                            <!-- Double Product Start -->
                            <div class="double-products">
                                <!-- Single Product Start -->
                                <div class="single-product">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/">
                                            <img class="primary-img" src="<?php echo base_url(); ?>assets/products/<?php echo $npro->product_cover_img; ?>" alt="single-product">
                                            <!--<img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/1_2.jpg" alt="single-product">-->
                                        </a>
                                        <!--<div class="quick-view">
                                            <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                        </div>
                                        <span class="sticker-new">new</span>-->
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content text-center">
                                        <h4><a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/"><?php echo $npro->product_name; ?></a></h4>
                                        <p class="price"><span>₹<?php echo $npro->prod_actual_price; ?></span></p>
                                        <div class="action-links2">
                                         <?php if ($combined_status == '1'){ ?>
                                            <a data-toggle="tooltip" title="View Products" href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/" style="background:#FAA320;">view products</a>
                                        <?php } else { ?>
                                            <a data-toggle="tooltip" title="Add to Cart" href="<?php echo base_url(); ?>home/addcart/<?php echo $sproduct_id; ?>/">add to cart</a>
                                         <?php }?>
                                        </div>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                <!-- Single Product End -->
                            </div>
                            <!-- Double Product End -->
                            <?php } ?>
                                               

                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Best Seller Products End -->      
        <?php } ?>
