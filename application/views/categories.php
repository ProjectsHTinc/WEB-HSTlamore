<?php
if (count($category_details)>0){
	foreach($category_details as $cat){ 
		$base_cat_id = $cat->id;
		$cat_name = $cat->category_name;
		$cat_desc = $cat->category_desc;
		$cat_image = $cat->category_image;
		if ($cat_image == ''){
			$cat_image = 'no_category.png';
		}
		$cat_image_url = base_url()."assets/category/".$cat_image;
	}
}
?>
        <!-- Page Breadcrumb Start -->
        <div class="mb-100" style="background: rgba(0, 0, 0, 0) url(<?php echo $cat_image_url; ?>) no-repeat scroll center center / cover;">
        
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center ptb-70" >
                            <h1><?php echo $cat_name;?></h1>
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="<?php echo base_url(); ?>">home</a></li>
                                <li><?php echo $cat_name;?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Breadcrumb End -->
        <!-- Categories Product Start -->
        <div class="all-categories pb-100">
            <div class="container">
                <div class="row">
                   <!-- Sidebar Content Start -->
                    <div class="col-md-9 col-md-push-3">
                        <!-- Sidebar Right Top Content Start -->
                        <div class="sidebar-desc-content">
                            <p><?php echo $cat_desc; ?></p><hr>
                        </div>
                        <!-- Sidebar Right Top Content Start -->
                        <!-- Best Seller Product Start -->
                        <div class="best-seller">
                            <div class="row mt-20">
                                <div class="col-md-3 col-sm-4 pull-left"><!--
                                    <div class="grid-list-view">
                                        <ul class="list-inline">
                                            <li class="active"><a data-toggle="tab" href="#grid-view" aria-expanded="true"><i class="zmdi zmdi-view-dashboard"></i><i class="pe-7s-keypad"></i></a></li>
                                            <li><a data-toggle="tab" href="#list-view" aria-expanded="false"><i class="zmdi zmdi-view-list"></i><i class="pe-7s-menu"></i></a></li>
                                        </ul>
                                    </div>-->
                                </div>
                                <div class="col-md-4 col-sm-5 pull-right">
                                    <select name="shorer" id="shorter" class="form-control select-varient">
                                        <option value="#">Sort By:Default</option>
                                        <option value="#">Sort By:Name (A - Z)</option>
                                        <option value="#">Sort By:Name (Z - A)</option>
                                        <option value="#">Sort By:Price (Low > High)</option>
                                        <option value="#">Sort By:Price (High > Low)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-content categorie-list ">
                                        
                                        <div id="grid-view" class="tab-pane fade in active mt-40">
                                            <div class="row">
                                            <?php
											if (count($cat_products)>0){
												foreach($cat_products as $prod){ 
													$sproduct_id = $prod->id;
													$product_id = $prod->id * 663399;
													$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $prod->product_name));
													$enc_product_id = base64_encode($product_id);
													$combined_status = $prod->combined_status;
													$offer_status = $prod->offer_status;
													$prod_actual_price = $prod->prod_actual_price;
													$stocks_left = $prod->stocks_left;
													$posteddate = date("d-m-Y",strtotime($prod->created_at));
													$check_date = date("d-m-Y",strtotime("-15 day"));
													if ($offer_status =='1'){
														$offer_details = $this->homemodel->get_offer_details($sproduct_id);
													if (count($offer_details)>0){
														foreach($offer_details as $offer){ 
															$offer_percentage = $offer->offer_percentage;
														}
													}
														$soffer_price = ($offer_percentage / 100) * $prod_actual_price;
														$doffer_price = $prod_actual_price - $soffer_price;
														$offer_price = number_format((float)$doffer_price, 2, '.', '');
													}
                                            ?>
                                                <div class="col-md-4 col-sm-6">
                                                    <!-- Single Product Start -->
                                                    <div class="single-product">
                                                        <!-- Product Image Start -->
                                                        <div class="pro-img">
                                                            <a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/">
                                                               <img class="primary-img" src="<?php echo base_url(); ?>assets/products/<?php echo $prod->product_cover_img; ?>" alt="single-product">
                                                            </a>
                                                            <!--<div class="quick-view">
                                                                <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                                            </div>-->
                                                            <?php 
                                                                if (strtotime($posteddate) >= strtotime($check_date)) 
                                                                {
                                                                     echo '<span class="sticker-new">new</span>';
                                                                } 
                                                               ?>
                                                        </div>
                                                        <!-- Product Image End -->
                                                        <!-- Product Content Start -->
                                                        <div class="pro-content text-center">
                                                            <h4><a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/"><?php echo $prod->product_name; ?></a></h4>
                                         <?php if ($offer_status == '1'){ ?>
                                        <p class="price"><span class="mrp">₹<?php echo $prod_actual_price;?></span> <span>₹<?php echo $offer_price;?></span></p>										<?php } else { ?>
                                        <p class="price"><span>₹<?php echo $prod_actual_price;?></span></p>
                                        <?php } ?>
											<div class="action-links2">
                                                      <?php 
										 if ($stocks_left>0){
											 if ($combined_status == '1'){ ?>
												<a data-toggle="tooltip" title="View Products" href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/" style="background:#FAA320;">view products</a>
											<?php } else { ?>
												<a data-toggle="tooltip" title="Add to Cart" href="<?php echo base_url(); ?>home/addcart/<?php echo $sproduct_id; ?>/">add to cart</a>
											 <?php }
										 } else {
										?>
											 <a data-toggle="tooltip" title="Out of Stock" style="background:#e11313;">Out of Stock</a>
										 <?php } ?>
                                             </div>
                                                        </div>
                                                        <!-- Product Content End -->
                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                               <?php
												}
											}
											?>
 
                                            </div>
                                            <!-- Row End -->

                                        </div>
                                        <!-- #Grid-view End -->
                                    </div>
                                    <!-- .Tab Content End -->
                                </div>
                            </div>
                            <!-- Row End -->
                        </div>
                        <!-- Best Seller Product End -->
                    </div>
                    <!-- Sidebar Content End -->
                    <!-- Sidebar Start -->
                    <div class="col-md-3 col-md-pull-9">
                        <aside class="categorie-sidebar mb-100">
                            <!-- Categories Module Start -->
                            <div class="categorie-module mb-80">
                                <h3>categories</h3>
                                 <ul class="categorie-list">
								<?php 
									if (count($main_catmenu)>0){
										foreach($main_catmenu as $rowm){ 
										$cat_id = $rowm->id;
										//$cat_count = $rowm->count;
										$category_id = $rowm->id * 564738;
										$category_name = strtolower(preg_replace("/[^\w]/", "-", $rowm->category_name));
										$enc_category_id = base64_encode($category_id);
										if ($base_cat_id == $cat_id){
											echo '<li class="active"><a href="'.base_url().'home/categories/'.$cat_id.'/'.$category_name.'/">'.$rowm->category_name.'</a>';
											} else {
											echo '<li><a href="'.base_url().'home/categories/'.$cat_id.'/'.$category_name.'/">'.$rowm->category_name.'</a>';
										}
                                    	$sub_catmenu = $this->homemodel->get_sub_catmenu($cat_id);
											if (count($sub_catmenu)>0){
                                    			echo '<ul class="sub-categorie pl-30">';
                                          		foreach($sub_catmenu as $rows) {
													$sub_cat_id = $rows->id;
													//$subcat_count = $rows->count;
													$sub_category_id = $rows->id * 564738;
													$sub_category_name = strtolower(preg_replace("/[^\w]/", "-", $rows->category_name));
													$enc_sub_category_id = base64_encode($sub_category_id);
													if ($base_cat_id == $sub_cat_id){
											echo '<li class="active"><a href="'.base_url().'home/subcategories/'.$sub_cat_id.'/'.$sub_category_name.'/">'.$rows->category_name.'</a></li>';
											} else {
											echo '<li><a href="'.base_url().'home/subcategories/'.$sub_cat_id.'/'.$sub_category_name.'/">'.$rows->category_name.'</a></li>';
										}
                                    				
                                    			}
                                    			echo '</ul>';
                                   			}
                                    	echo '</li>';
                                   		}
									} ?>
								</ul><!--
                                <ul class="categorie-list">
                                    <li class="active"><a href="#">Furniture (19)</a>
                                        <ul class="sub-categorie pl-30">
                                            <li><a href="#">Sofas & Loveseats (19)</a></li>
                                            <li><a href="#">Chairs & Recliners (19)</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Sectionals (16)</a></li>
                                    <li><a href="#">Decor (19)</a></li>
                                    <li><a href="#">Decorative Accessories (19)</a></li>
                                    <li><a href="#">Window Treatments (16)</a></li>
                                    <li><a href="#">Bookshelves (16)</a></li>
                                    <li><a href="#">Coffee & Accent Tables (17)</a></li>
                                </ul>-->
                            </div>
                            <!-- Categories Module End -->
                            <!-- Filter Option Start -->
                            <!--<div class="flter-option mb-80">
                                <h3>PRICE FILTER</h3>
                                <form action="#">
                                    <div id="slider-range"></div>
                                    <input type="text" id="amount" class="amount" readonly>
                                </form>
                            </div>-->
                            <!-- Filter Option End -->
                            <!-- Categories Color Start -->
                           <!-- <div class="cat-color mb-80">
                               <h3>Color</h3>
                                <ul class="cat-color-list">
                                    <li><a href="#">Black (13)</a></li>
                                    <li><a href="#">Blue (13)</a></li>
                                    <li><a href="#">Grey (13)</a></li>
                                    <li><a href="#">Green (13)</a></li>
                                    <li><a href="#">Red (13)</a></li>
                                </ul>
                            </div>-->
                            <!-- Categories Color End -->
                            
                            
                        </aside>
                    </div>
                    <!-- Sidebar End -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Categories Product End -->