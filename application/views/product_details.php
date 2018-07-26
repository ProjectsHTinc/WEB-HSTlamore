<?php
if (count($product_details)>0){
	foreach($product_details as $prod){ 
		$product_id = $prod->id;
		$product_name = $prod->product_name;
		$sku_code = $prod->sku_code;
		$product_description = $prod->product_description;
		$prod_mrp_price = $prod->prod_mrp_price ;
		$prod_actual_price = $prod->prod_actual_price;
		$combined_status = $prod->combined_status;
		
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
			$c_size_result = $this->homemodel->get_size($product_id);
			$c_colour_result = $this->homemodel->get_colour($product_id,$c_size_id);
		}
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
                        <img id="big-img" src="<?php echo base_url(); ?>assets/front/img/new-products/1_1.jpg" data-zoom-image="<?php echo base_url(); ?>assets/front/img/new-products/1_1.jpg" alt="product-image" />

                        <div id="small-img" class="mt-20">

                            <div class="thumb-menu owl-carousel">
                                <a href="#" data-image="<?php echo base_url(); ?>assets/front/img/new-products/1_2.jpg" data-zoom-image="<?php echo base_url(); ?>assets/front/img/new-products/1_2.jpg">
                                    <img src="<?php echo base_url(); ?>assets/front/img/new-products/1_2.jpg" alt="product-image" />
                                </a>

                                <a href="#" data-image="<?php echo base_url(); ?>assets/front/img/new-products/2_1.jpg" data-zoom-image="<?php echo base_url(); ?>assets/front/img/new-products/2_1.jpg">
                                    <img src="<?php echo base_url(); ?>assets/front/img/new-products/2_1.jpg" alt="product-image" />
                                </a>

                                <a href="#" data-image="<?php echo base_url(); ?>assets/front/img/new-products/2_2.jpg" data-zoom-image="<?php echo base_url(); ?>assets/front/img/new-products/2_2.jpg">
                                    <img src="<?php echo base_url(); ?>assets/front/img/new-products/2_2.jpg" alt="product-image" />
                                </a>

                                <a href="#" data-image="<?php echo base_url(); ?>assets/front/img/new-products/3_1.jpg" data-zoom-image="<?php echo base_url(); ?>assets/front/img/new-products/3_1.jpg">
                                    <img src="<?php echo base_url(); ?>assets/front/img/new-products/3_1.jpg" alt="product-image" />
                                </a>

                                <a href="#" data-image="<?php echo base_url(); ?>assets/front/img/new-products/2_1.jpg" data-zoom-image="<?php echo base_url(); ?>assets/front/img/new-products/2_1.jpg">
                                    <img src="<?php echo base_url(); ?>assets/front/img/new-products/2_1.jpg" alt="product-image" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Description Start -->
                    <div class="col-sm-7">
                     <form id="product-form" name="product-form" class="contact-form" action="" method="post">
                        <div class="thubnail-desc fix">
                            <h2 class="product-header mb-20"><?php echo $product_name; ?></h2>
                            <!-- Product Rating Start -->
                            <!--<div class="rating-summary fix mtb-20">
                                <div class="rating f-left mr-10">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="rating-feedback f-left">
                                    <a href="#">0 reviews</a> /
                                    <a href="#">Write a review</a>
                                </div>
                            </div>-->
                            <!-- Product Rating End -->
                             <!-- Product Price Description Start -->
                            <div class="product-price-desc mb-20">
                                <ul class="pro-desc-list">
                                    <li>Product Code: <span><?php echo $sku_code; ?></span></li>
                                    <!--<li>Availability: <span>in Stock</span></li>-->
                                </ul>
                            </div>
                            <!-- Product Price Description End -->
                           
                             <?php if ($combined_status =='1') { ?>
                             
                             <!-- Product Price Start -->
                            <div class="pro-price mb-20">
                               <ul class="pro-price-list">
                                   <li class="price">₹<span id="act_price"><?php echo $c_prod_actual_price;?></span></li>
                                   <li class="tax">₹<span id="mrp_price"><?php echo $c_mrp_price;?></span></li>
                               </ul>
                            </div>
                            <!-- Product Price End -->
                            
                            <!-- Product Box Quantity Start -->
                            <div class="box-quantity mtb-10">
                                <div class="quantity-item">
                                    <label>Qty: </label>
                                    <input type="number" value="1" min="1" max="10" style="height: 45px;"  name="qty" id="qty" /><!--
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
                                       <select name="product_colour" id="product_colour">
                                       <option value=''>Select Colour</option>
                                          <?php if ($c_colour_result >0) {
											foreach($c_colour_result as $color){ 
												echo '<option value="'.$color->id.'">'.$color->attribute_name.'</option>';
											} 
										} ?>
                                       </select><script> $('#product_colour').val('<?php echo $c_color_id; ?>');</script>
                                </div>
                            </div>
                            <!-- Product Box Quantity End -->
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>" />
                            <?php } else { ?>
                            
                             <!-- Product Price Start -->
                            <div class="pro-price mb-20">
                               <ul class="pro-price-list">
                                   <li class="price">₹<?php echo $prod_actual_price;?></li>
                                   <li class="tax">₹<?php echo $prod_mrp_price;?></li>
                               </ul>
                            </div>
                            <!-- Product Price End -->
                            
                            <!-- Product Box Quantity Start -->
                            <div class="box-quantity mtb-10">
                                <div class="quantity-item">
                                    <label>Qty: </label>
                                    <input type="number" value="1" min="1" max="10" style="height: 45px;"  name="qty" id="qty" /><!--
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="0">
                                    </div>-->
                                </div>
                            </div>
                            <!-- Product Box Quantity End -->
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>" />
                            <?php } ?>
                            <!-- Product Button Actions Start -->
                            <div class="product-button-actions">
                               <button type="submit" class="add-to-cart">add to cart</button>
                               <a href="wish-list.html" data-toggle="tooltip" title="Add to Wishlist" class="same-btn mr-15"><i class="pe-7s-like"></i></a>
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
                            <li><a data-toggle="tab" href="#review">Reviews (0)</a></li>
                        </ul>
                        <!-- Product Thumbnail Tab Content Start -->
                        <div class="tab-content thumb-content">
                            <div id="detail" class="tab-pane fade in active pb-40">
                                <p class="mb-10"><?php echo $product_description; ?></p>
                            </div>
                            <div id="review" class="tab-pane fade">
                                <!-- Reviews Start -->
                                <div class="review">
                                    <p class="mb-10">There are no reviews for this product.</p>
                                    <h2>WRITE A REVIEW</h2>
                                </div>
                                <!-- Reviews End -->
                                <!-- Reviews Field Start -->
                                <div class="riview-field mt-30">
                                    <form autocomplete="off" action="#">
                                        <div class="form-group">
                                            <label class="req" for="sure-name">name</label>
                                            <input type="text" class="form-control" id="sure-name" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="req" for="comments">your Review</label>
                                            <textarea class="form-control" rows="5" id="comments" required="required"></textarea>
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
                                            <button type="submit" id="button-review">Continue</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Reviews Field Start -->
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
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="#">
                                    <img class="primary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/1_2.jpg" alt="single-product">
                                    <img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/5_1.jpg" alt="single-product">
                                </a>
                                <div class="quick-view">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                </div>
                                <span class="sticker-new">new</span>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content text-center">
                                <h4><a href="product-page.html">Decorative Vase</a></h4>
                                <p class="price"><span>₹241.99</span></p>
                                <div class="action-links2">
                                    <a data-toggle="tooltip" title="Add to Cart" href="cart.html">add to cart</a>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="#">
                                    <img class="primary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/3_1.jpg" alt="single-product">
                                    <img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/6_2.jpg" alt="single-product">
                                </a>
                                <div class="quick-view">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                </div>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content text-center">
                                <h4><a href="product-page.html">Decorative Vase</a></h4>
                                <p class="price"><span>₹241.99</span></p>
                                <div class="action-links2">
                                    <a data-toggle="tooltip" title="Add to Cart" href="cart.html">add to cart</a>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="#">
                                    <img class="primary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/1_1.jpg" alt="single-product">
                                    <img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/2_2.jpg" alt="single-product">
                                </a>
                                <div class="quick-view">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                </div>
                                <span class="sticker-new">new</span>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content text-center">
                                <h4><a href="product-page.html">Decorative Vase</a></h4>
                                <p class="price"><span>₹241.99</span></p>
                                <div class="action-links2">
                                    <a data-toggle="tooltip" title="Add to Cart" href="cart.html">add to cart</a>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="#">
                                    <img class="primary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/6_1.jpg" alt="single-product">
                                    <img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/6_2.jpg" alt="single-product">
                                </a>
                                <div class="quick-view">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                </div>
                                <span class="sticker-new">new</span>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content text-center">
                                <h4><a href="product-page.html">Decorative Vase</a></h4>
                                <p class="price"><span>₹241.99</span></p>
                                <div class="action-links2">
                                    <a data-toggle="tooltip" title="Add to Cart" href="cart.html">add to cart</a>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="#">
                                    <img class="primary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/2_1.jpg" alt="single-product">
                                    <img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/2_2.jpg" alt="single-product">
                                </a>
                                <div class="quick-view">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                </div>
                                <span class="sticker-new">new</span>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content text-center">
                                <h4><a href="product-page.html">Decorative Vase</a></h4>
                                <p class="price"><span>₹241.99</span></p>
                                <div class="action-links2">
                                    <a data-toggle="tooltip" title="Add to Cart" href="cart.html">add to cart</a>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                        <!-- Single Product Start -->
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="#">
                                    <img class="primary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/8_1.jpg" alt="single-product">
                                    <img class="secondary-img" src="<?php echo base_url(); ?>assets/front/img/new-products/3_2.jpg" alt="single-product">
                                </a>
                                <div class="quick-view">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                </div>
                                <span class="sticker-new">new</span>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content text-center">
                                <h4><a href="product-page.html">Decorative Vase</a></h4>
                                <p class="price"><span>₹241.99</span></p>
                                <div class="action-links2">
                                    <a data-toggle="tooltip" title="Add to Cart" href="cart.html">add to cart</a>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                        <!-- Single Product End -->
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Best Seller Products End -->
<script>
function disp_colours()
	{
		var product_id = $('#product_id').val();
		var product_size = $('#product_size').val();
		var result = '';
		
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>home/disp_colour_price/',
		type: 'POST',
		data: {event_id : <?php echo $event_id; ?>,size_id : product_size},
		success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			result +="<fieldset><p class='event-desc-head'>Select Time</p><div class='form-group'><div class='col-md-4'><select class='form-control input-lg select_booking' id='show_time' onchange='disp_plan()'><option value=''>Select Time</option>";

			for (var i = 0; i < dataArray.length; i++){
				var id = dataArray[i].id;
				var show_time = dataArray[i].show_time;
				
				result +="<option value='"+show_time+"'>"+show_time+"</option>";
			};
				result +="</select></div></div></fieldset>";

			$("#plan_time").html(result).show();
		} else {
			result +="No Records found!..";
			$("#plan_time").html(result).show();
			$('#plan_details').hide();
			$('#plan_seats').hide();
		}
		}
		});
	}
</script>