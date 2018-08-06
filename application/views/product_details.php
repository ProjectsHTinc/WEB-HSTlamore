<?php
$cust_session_id = $this->session->userdata('cust_session_id');
if (count($product_details)>0){
	foreach($product_details as $prod){ 
		$product_id = $prod->id;
		$cat_id = $prod->cat_id;
		$product_name = $prod->product_name;
		$sku_code = $prod->sku_code;
		$size_chart = $prod->prod_size_chart;
		$product_description = $prod->product_description;
		$product_cover_img = $prod->product_cover_img;
		$prod_mrp_price = $prod->prod_mrp_price ;
		$prod_actual_price = $prod->prod_actual_price;
		$combined_status = $prod->combined_status;
		$offer_status = $prod->offer_status;
		$stocks_left = $prod->stocks_left;
		
		if ($offer_status =='1'){
			$offer_details = $this->homemodel->get_offer_details($product_id);
			if (count($offer_details)>0){
				foreach($offer_details as $offer){ 
					$offer_percentage = $offer->offer_percentage;
				}
			}
			$soffer_price = ($offer_percentage / 100) * $prod_actual_price;
			$doffer_price = $prod_actual_price - $soffer_price;
			$offer_price = number_format((float)$doffer_price, 2, '.', '');
		}
		
		
		if ($combined_status =='1'){
			$cproduct_details = $this->homemodel->get_cproduct_details($product_id);
			if (count($cproduct_details)>0){
				foreach($cproduct_details as $cprod){ 
					$c_product_id = $cprod->id;
					$c_size_id = $cprod->mas_size_id;
					$c_color_id = $cprod->mas_color_id;
					$c_prod_actual_price = $cprod->prod_actual_price;
					$c_mrp_price = $cprod->prod_mrp_price;
				}
			}
			
			if ($offer_status =='1'){
				$offer_details = $this->homemodel->get_offer_details($product_id);
			if (count($offer_details)>0){
				foreach($offer_details as $offer){ 
					$offer_percentage = $offer->offer_percentage;
				}
			}
				$soffer_price = ($offer_percentage / 100) * $c_prod_actual_price;
				$doffer_price = $c_prod_actual_price - $soffer_price;
				$offer_price = number_format((float)$doffer_price, 2, '.', '');
			}
			
			
			$c_size_result = $this->homemodel->get_size($product_id);
			$c_colour_result = $this->homemodel->get_colour($product_id,$c_size_id);
		}
		$product_gallery = $this->homemodel->get_gallery($product_id);
	}
}
?>
        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <h1>DETAIL PRODUCT</h1>
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">product details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Breadcrumb End -->
        <!-- Product Thumbnail Start -->
        <div class="main-product-thumbnail pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <img id="big-img" src="<?php echo base_url(); ?>assets/products/<?php echo $product_cover_img;?>" data-zoom-image="<?php echo base_url(); ?>assets/products/<?php echo $product_cover_img;?>" alt="product-image" />

                        <div id="small-img" class="mt-20">
   
                            <div class="thumb-menu owl-carousel">
                                <a href="#" data-image="<?php echo base_url(); ?>assets/products/<?php echo $product_cover_img;?>" data-zoom-image="<?php echo base_url(); ?>assets/products/<?php echo $product_cover_img;?>">
                                    <img src="<?php echo base_url(); ?>assets/products/<?php echo $product_cover_img;?>" alt="product-image" />
                                </a>
<?php
if (count($product_gallery)>0){
	foreach($product_gallery as $gallery){ 
	$gallery_img = $gallery->gallery_img;
?>
                                <a href="#" data-image="<?php echo base_url(); ?>assets/products/images/<?php echo $gallery_img;?>" data-zoom-image="<?php echo base_url(); ?>assets/products/images/<?php echo $gallery_img;?>">
                                    <img src="<?php echo base_url(); ?>assets/products/images/<?php echo $gallery_img;?>" alt="product-image" />
                                </a>
<?php
	}
}
?>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Description Start -->
                    <div class="col-sm-7">
                     <form id="product-form" name="product-form" class="contact-form" action="<?php echo base_url(); ?>home/insertcart/" method="post">
                        <div class="thubnail-desc fix">
                            <h2 class="product-header mb-20"><?php echo $product_name; ?></h2>
							
							<?php  
							$disprating =0;
							$countreviews=0;
							if (count($review_details)>0){ 
									$countreviews = count($review_details);
									$srating = 0;
										foreach($review_details as $rev){ 
											$rating = $rev->rating;
											$srating = round($srating + $rating);
										}
										$disprating =  round($srating/$countreviews) ;
								}
							?>
                            <!-- Product Rating Start -->
                            <div class="rating-summary fix mtb-20">
                                <div class="rating f-left mr-10">
                                 <?php
                     				for ($i=1; $i <6; $i++)
            							{
										if ($i <= $disprating){
											echo "<i class='fa fa-star'></i>";
										} else {
											echo "<i class='fa fa-star-o'></i>";
										}
									}
					?>

                                </div>
                                <div class="rating-feedback f-left">
                                    <a href="#creview"><?php echo $countreviews;?> reviews</a>
                                   <?php if (isset($cust_session_id)){ ?>  <a href="#" data-toggle="modal" data-target="#myModal"> / Write a review</a> <?php } ?>
                                </div>
                            </div>
                            <!-- Product Rating End -->
							
                             <!-- Product Price Description Start -->
                            <div class="product-price-desc mb-20">
                                <ul class="pro-desc-list">
                                    <li>Product Code: <span><?php echo $sku_code; ?></span></li>
									<?php if ($size_chart!="") {
										echo "<li class='mt-10'><a href='".base_url()."assets/products/charts/".$size_chart."' target='_blank' style='color:#FAA320;'>Size Chart</a></li>";
									} ?>
                                </ul>
                            </div>
                            <!-- Product Price Description End -->
                           
<?php if ($combined_status =='1') { ?>
                             
                             <!-- Product Price Start -->
                            <div class="pro-price mb-20">
                               <ul class="pro-price-list">
                               <?php if ($offer_status =='1'){
                                   echo '<li id ="offer_price" class="price">₹'.$offer_price.'</li>';
                                   echo '<li id ="act_price" class="mrp">₹'.$c_prod_actual_price.'</li>';
                                } else {
									echo '<li id ="act_price" class="price">₹'.$c_prod_actual_price.'</li>';
								}
                                ?>
                               </ul>
                            </div>
                            <!-- Product Price End -->
                            
                            <!-- Product Box Quantity Start -->
                            <div class="box-quantity mtb-10">
                                <div class="quantity-item">
                                    <label>Qty: </label>
                                    <input type="number" value="1" min="1" max="10" style="height: 45px;"  name="qty" id="qty" onchange="getStock()" /><!--
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="0">
                                    </div>-->
                                </div>
                            </div>
                            <!-- Product Box Quantity End -->
                             <!-- Product Box Quantity Start -->
                            <div class="box-quantity mtb-10">
                                <div class="quantity-item">
                                    <label>Size: </label>
                                     <select name="product_size" id="product_size" onchange="disp_colours()">
                                     <option value=''>Select Size</option>
                                       <?php if ($c_size_result >0) {
											foreach($c_size_result as $size){ 
												echo '<option value="'.$size->id.'">'.$size->attribute_value.'</option>';
											} 
										} ?>
                                       </select><script> $('#product_size').val('<?php echo $c_size_id; ?>');</script>
                                </div>
                            </div>
                            <!-- Product Box Quantity End -->
                            
                            <!-- Product Box Quantity Start -->
                            <div class="box-quantity mtb-10">
                                <div class="quantity-item">
                                    <label>Colour: </label>
                                       <div id="pro_colours">
                                       <select name="product_colour" id="product_colour" onchange="disp_price()">
                                       <option value=''>Select Colour</option>
                                          <?php if ($c_colour_result >0) {
											foreach($c_colour_result as $color){ 
												echo '<option value="'.$color->id.'">'.$color->attribute_name.'</option>';
											} 
										} ?>
                                       </select><script> $('#product_colour').val('<?php echo $c_color_id; ?>');</script></div>
                                </div>
                            </div>
                            <!-- Product Box Quantity End -->
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>" />
                            <input type="hidden" name="com_product_id" id="com_product_id" value="<?php echo $c_product_id; ?>" />
                            <?php if ($offer_status =='1'){ ?>
                            	<input type="hidden" name="price" id="price" value="<?php echo $offer_price; ?>" />
                            <?php } else { ?>
                            	<input type="hidden" name="price" id="price" value="<?php echo $c_prod_actual_price; ?>" />
                              <?php } ?>
                            <input type="hidden" name="offer_status" id="offer_status" value="<?php echo $offer_status ?>" />
                            <?php if ($offer_status =='1'){ ?>
                            	<input type="hidden" name="offer_percentage" id="offer_percentage" value="<?php echo $offer_percentage ?>" />
                            <?php } ?>
                            
<?php } else { ?>
                            
                             <!-- Product Price Start -->
                            <div class="pro-price mb-20">
                               <ul class="pro-price-list">
                               <?php if ($offer_status =='1'){
                                   echo '<li class="price">₹'.$offer_price.'</li>';
                                   echo '<li class="mrp">₹'.$prod_actual_price.'</li>';
                                } else {
									echo '<li class="price">₹'.$prod_actual_price.'</li>';
								}
                                ?>
                               </ul>
                            </div>
                            <!-- Product Price End -->
                            
                            <!-- Product Box Quantity Start -->
                            <div class="box-quantity mtb-10">
                                <div class="quantity-item">
                                    <label>Qty: </label>
                                    <input type="number" value="1" min="1" max="10" style="height: 45px;"  name="qty" id="qty" onchange="getStock()" /><!--
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="0">
                                    </div>-->
                                </div>
                            </div>
                            <!-- Product Box Quantity End -->
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>" />
                            <?php if ($offer_status =='1'){?>
                            	<input type="hidden" name="price" id="price" value="<?php echo $offer_price; ?>" />
                            <?php } else { ?>
                            	<input type="hidden" name="price" id="price" value="<?php echo $prod_actual_price; ?>" />
                            <?php } ?>
<?php } ?>
                            
                            
                            <!-- Product Button Actions Start -->
                            <div class="product-button-actions">
                            <?php 
								if ($stocks_left>0){ ?>
                               	<button id='addcart' type="submit" class="add-to-cart">add to cart</button>
                                <button id='emptycart' type="button" class="add-to-cart" style="background:#e20202;display:none;">Out of Stock</button>
                             <?php } else { ?>
                             	<button id='emptycart' type="button" class="add-to-cart" style="background:#e20202;">Out of Stock</button>
                             <?php } ?>
                              
							  <?php 
							 	if (isset($cust_session_id)){ ?> 
                                <a href="<?php echo base_url(); ?>home/addwishlist/<?php echo $product_id; ?>/" data-toggle="tooltip" title="Add to Wishlist" class="same-btn mr-15"><i class="pe-7s-like"></i></a>
							<?php } ?>
                             <!--<a href="wish-list.html" data-toggle="tooltip" title="Add to Wishlist" class="same-btn1 mr-15"><i class="pe-7s-like"></i></a>-->	
                            </div>
                            <!-- Product Button Actions End -->
                            <!-- Product Social Link Share Start -->
                            <div class="social-shared">
                                <ul>
                                    <li class="f-book">
                                        <a href="#">
                                            <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
                                            <span>like</span>
                                            <span>1</span>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <span><i class="fa fa-twitter" aria-hidden="true"></i></span>
                                            <span>tweet</span>
                                        </a>
                                    </li>
                                    <li class="pinterest">
                                        <a href="#">
                                            <span><i class="fa fa-google" aria-hidden="true"></i></span>
                                            <span>plus</span>
                                        </a>
                                    </li>
                                    <!-- Product Social Link Share Dropdown Start -->
                                    <li class="share-post">
                                        <a href="#">
                                            <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                                            <span>share</span>
                                        </a>
                                        <ul class="sharable-dropdown">
                                            <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i>facebook</a></li>
                                            <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i>twitter</a></li>
                                            <li><a href="#"><i class="fa fa-print" aria-hidden="true"></i>print</a></li>
                                            <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>email</a></li>
                                            <li><a href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i>pinterest</a></li>
                                            <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i>google+</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square" aria-hidden="true"></i>more(99)</a></li>
                                        </ul>
                                    </li>
                                    <!-- Product Social Link Share Dropdown End -->
                                </ul>
                            </div>
                            <!-- Product Social Link Share End -->
                        </div>
                        </form>
                    </div>
                    <!-- Thumbnail Description End -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Product Thumbnail End -->
        
		
		
		
		<!-- Product Thumbnail Description Start -->
        <div class="thumnail-desc pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="main-thumb-desc text-center list-inline">
                            <li class="active"><a data-toggle="tab" href="#detail">Details</a></li>
                            <li><a data-toggle="tab" href="#specification">Specification</a></li>
                        </ul>
                        <!-- Product Thumbnail Tab Content Start -->
                        <div class="tab-content thumb-content">
                            
							<div id="detail" class="tab-pane fade in active pb-40">
                                <p class="mb-10"><?php echo $product_description; ?></p>
                            </div>
							
                            <div id="specification" class="tab-pane fade pb-40">
							
							<?php if (count($product_spec)>0){ ?>
							<!-- Table Content Start -->
                            <div class="table-content table-responsive mb-50">
                                <table>
									<?php
									foreach($product_spec as $spec){
									$spec_name = $spec->spec_name;
									$spec_value = $spec->spec_value;
										?>
                                        <tr>
                                            <td><?php echo $spec_name; ?></td>
                                            <td><?php echo $spec_value; ?></td>
                                        </tr>
									<?php } ?>
								</table>
								</div>
							<?php } ?>
                            </div>
                           
                        </div>
                        <!-- Product Thumbnail Tab Content End -->
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Product Thumbnail Description End -->
   



		
        <!-- Reviews Start -->
        <div class="best-seller-products pb-100" id='creview'>
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="col-xs-12">
                        <div class="section-title text-center mb-40">
                            <h3 class="section-info">Customer Reviews</h3>
                        </div>
                    </div>
                    <!-- Section Title End -->
                </div>
                <!-- Row End -->
                <div class="row">
				<?php
			if (count($review_details)>0){
                   foreach($review_details as $review){
						$rating = $review->rating;
						$cust_name = $review->name;
						$comment = $review->comment;
				?>
					<p class="mtb-10"><strong><?php echo $cust_name; ?></strong></p>
					<p class="mtb-10"><?php echo $comment; ?></p>
					<div class="rating f-left mr-10 ">
					<?php
					for ($i=1; $i <6; $i++)
						{
						if ($i <= $rating){
							echo "<i class='fa fa-star'></i>";
						} else {
							echo "<i class='fa fa-star-o'></i>";
						}
					}
					?>
					</div>
					<hr>
				<?php } 
				
			} else { ?>
				<p class="mb-10">There are no reviews for this product.</p>
		<?php } ?>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Reviews End -->






   
        <?php
			$related_products = $this->homemodel->related_products($cat_id,$product_id);
			if (count($related_products)>0){
		?>
        <!-- Best Seller Products Start -->
        <div class="best-seller-products pb-100">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="col-xs-12">
                        <div class="section-title text-center mb-40">
                            <h3 class="section-info">RELATED PRODUCTS</h3>
                        </div>
                    </div>
                    <!-- Section Title End -->
                </div>
                <!-- Row End -->
                <div class="row">
                    <!-- Best Seller Product Activation Start -->
                    <div class="best-seller new-products owl-carousel">
                        
                        <?php foreach($related_products as $npro){ 
								$sproduct_id = $npro->id;
								$tproduct_id = $npro->id * 663399;
								$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $npro->product_name));
								$enc_product_id = base64_encode($tproduct_id);
								
								$combined_status = $npro->combined_status;
								
								$offer_status = $npro->offer_status;
								$prod_actual_price = $npro->prod_actual_price;
								
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
                                        <?php if ($offer_status == '1'){ ?>
                                        <p class="price"><span class="mrp">₹<?php echo $prod_actual_price;?></span> <span>₹<?php echo $offer_price;?></span></p>										<?php } else { ?>
                                        <p class="price"><span>₹<?php echo $prod_actual_price;?></span></p>
                                        <?php } ?>
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

                            <?php } ?>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Best Seller Products End -->
        </div>
        <?php } ?>
        
<!-- Quick View Content Start -->
        <div class="modal modal-box fade" id="myModal" role="dialog">
            <!-- Modal Dialog Box Start -->
            <div class="modal-dialog max-width">
                <!-- Modal content Start -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body Start -->
                    <div class="modal-body">
                    <div class="container">
                      <div class="row">
                    <!-- Reviews Field Start -->
                        <div class="riview-field mt-30">
                        
                        <?php if (count($check_review)>0){ 
								foreach($check_review as $review){ 
									$comment = $review->comment;
									$rating = $review->rating;
									$review_id = $review->id;
								}
						?>
                            <form name="reviewformup" id="reviewformup" method="post" action="" autocomplete="off">
                                <div class="form-group">
                                    <label class="req" for="comments">your Review</label>
                                    <textarea class="form-control" rows="5" id="comments" name="comments" required="required"><?php echo $comment;?></textarea>
                                    <div class="help-block">
                                        <span class="text-danger">Note:</span> HTML is not translated!
                                    </div>
                                </div>
                                <div class="form-group required radio-label">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label req">Rating</label> &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                            <?php for ($i=1; $i <6; $i++) { ?>
                                                   <input type="radio" name="rating" value="1" <?php if ($i==$rating) { echo "checked"; } ?>> &nbsp;
                                             <?php } ?>Good
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                	 <input type="hidden" name="rproduct_id" id="rproduct_id" value="<?php echo $product_id; ?>" />
                                     <input type="hidden" name="ruser_id" id="ruser_id" value="<?php echo $cust_session_id; ?>" />
                                     <input type="hidden" name="review_id" id="review_id" value="<?php echo $review_id; ?>" />
                                    <button type="submit" id="button-review">Continue</button>
                                </div>
                            </form>
                            <?php } else { ?>
                            <form name="reviewform" id="reviewform" method="post" action="" autocomplete="off">
                                <div class="form-group">
                                    <label class="req" for="comments">your Review</label>
                                    <textarea class="form-control" rows="5" id="comments" name="comments" required="required"></textarea>
                                    <div class="help-block">
                                        <span class="text-danger">Note:</span> HTML is not translated!
                                    </div>
                                </div>
                                <div class="form-group required radio-label">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label req">Rating</label> &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                            <input type="radio" name="rating" value="1"> &nbsp;
                                            <input type="radio" name="rating" value="2"> &nbsp;
                                            <input type="radio" name="rating" value="3"> &nbsp;
                                            <input type="radio" name="rating" value="4"> &nbsp;
                                            <input type="radio" name="rating" value="5"> &nbsp;Good
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                	 <input type="hidden" name="rproduct_id" id="rproduct_id" value="<?php echo $product_id; ?>" />
                                     <input type="hidden" name="ruser_id" id="ruser_id" value="<?php echo $cust_session_id; ?>" />
                                    <button type="submit" id="button-review">Continue</button>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                        <!-- Reviews Field Start -->
                    
                    </div>
                    </div>
                    </div>
                    <!-- Modal Body End -->
                </div>
                <!-- Modal Content End -->
            </div>
            <!-- Modal Dialog Box End -->
        </div>
        <!-- Quick View Content End -->
        
        
        
<script>
$('#product-form').validate({ // initialize the plugin
    rules: {
		 qty: {
            required: true,
        },
        product_size: {
            required: true
        },
        product_colour: {
            required: true,
        },
    },
    messages: {
		qty: { required:"Select Quantity"},
		product_size: { required:"Select Product Size"},
		product_colour: { required:"Select Colour"},
    },
	
});

function getStock()
	{
	var product_id = $('#product_id').val();
	var com_product_id = $('#com_product_id').val();
	var qty = $('#qty').val();
	var result = '';
	//alert(com_product_id);
	//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>home/checkqty/',
		type: 'POST',
		data: {product_id : product_id,com_product_id : com_product_id,qty : qty},
		success: function(response) {

			 if (response == "false") {
				 $("#addcart").hide();
				 $("#emptycart").show();
			 } else {
				 $("#addcart").show();
				 $("#emptycart").hide();
			 }
		}
		});
	}
function disp_colours()
	{
		var product_id = $('#product_id').val();
		var product_size = $('#product_size').val();
		var result = '';
		
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>home/disp_colour/',
		type: 'POST',
		data: {product_id : product_id,size_id : product_size},
		success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			result +="<select name='product_colour' id='product_colour' onchange='disp_price()'><option value=''>Select Colour</option>";
			for (var i = 0; i < dataArray.length; i++){
				var id = dataArray[i].id;
				var attribute_name = dataArray[i].attribute_name;
				
				result +="<option value='"+id+"'>"+attribute_name+"</option>";
			};
				result +="</</select>>";

			$("#pro_colours").html(result).show();
		} else {
			result +="No Records found!..";
		}
		}
		});
	}
	
function disp_price()
	{
		var product_id = $('#product_id').val();
		var product_size = $('#product_size').val();
		var product_colour = $('#product_colour').val();
		var offer_status = $('#offer_status').val();
		var offer_percentage = $('#offer_percentage').val();
		var offer_price ='';
		//alert(offer_percentage);
		var result = '';
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>home/disp_price/',
		type: 'POST',
		data: {product_id : product_id,size_id : product_size,colour_id : product_colour},
		success: function(data) {
		var dataArray = JSON.parse(data);
		//alert(data);
			if (dataArray.length>0) {
				for (var i = 0; i < dataArray.length; i++){
					var id = dataArray[i].id;
					var mrp_price = dataArray[i].prod_mrp_price;
					var actual_price = dataArray[i].prod_actual_price;
					var disp_actual_price = '₹' + actual_price;
					var default_qty = '1';
				}
				$('#com_product_id').val(id);
				if (offer_status==1){
					var offer_amount = actual_price*(offer_percentage/100);
					var disp_amount = (actual_price - offer_amount).toFixed(2);
					var disp_price = '₹' + disp_amount;
					//alert(disp_amount);
					$("#offer_price").html(disp_price).show();
					$("#act_price").html(disp_actual_price).show();
					$('#price').val(disp_amount);
					$('#qty').val(default_qty);
					
				} else {
					//alert(actual_price);
					$("#act_price").html(disp_actual_price).show();
					$('#price').val(actual_price);
					$('#qty').val(default_qty);
				}
			} else {
				result +="No Records found!..";
			}
		}
		});
	}
	
$('#reviewform').validate({ // initialize the plugin
    rules: {
		comments: {
            required: true,
        },
    },
    messages: {
		comments: { required:"Enter your Comments"},
    },
    submitHandler: function(form) {
		$.ajax({
            url: "<?php echo base_url(); ?>home/addreview",
            type: 'POST',
            data: $('#reviewform').serialize(),
            success: function(response) {
				if(response=="success"){
					$('#reviewform')[0].reset();
					location.reload();
				} else {
					alert("Error");
				}
            }
        });
    }
});

$('#reviewformup').validate({ // initialize the plugin

    rules: {
		comments: {
            required: true,
        },
    },
    messages: {
		comments: { required:"Enter your Comments"},
    },
    submitHandler: function(form) {
		$.ajax({
            url: "<?php echo base_url(); ?>home/reviewupdate",
            type: 'POST',
            data: $('#reviewformup').serialize(),
            success: function(response) {
				if(response=="success"){
					//$('#reviewform')[0].reset();
					location.reload();
				} else {
					alert("Error");
				}
            }
        });
    }
});
</script>