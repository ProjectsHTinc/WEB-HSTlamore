        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Page Breadcrumb End -->
        <!-- cart-main-area & wish list start -->
        <div class="cart-main-area pb-100">
            <div class="container">
               <!-- Section Title Start -->
                <div class="section-title mb-50">
                    <h2>cart</h2>
                </div>
                <!-- Section Title Start End -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Form Start -->
                        <?php
                        if (count($cart_list)>0){
						?>
                        <form name="checkout" id="checkout" method="post" action="<?php echo base_url(); ?>home/updatecart/">
                            <!-- Table Content Start -->
                            <div class="table-content table-responsive mb-50">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$total_amount = '0';
									foreach($cart_list as $clist){ 
										$cart_id = $clist->id;
										$sproduct_id = $clist->product_id;
										$product_combined_id = $clist->product_combined_id;
										$product_id = $clist->product_id * 663399;
										$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $clist->product_name));
										$enc_product_id = base64_encode($product_id);
										$stotal = $clist->total_amount;
										$price = $clist->price;
										
										if ($product_combined_id >0){
											$cproduct_details = $this->homemodel->get_colour_size($product_combined_id);
											if (count($cproduct_details)>0){
												foreach($cproduct_details as $cprod){ 
													 $product_size = $cprod->size;
													 $product_colour = $cprod->attribute_name;
												}
											} 
										}else {
												$product_size = '';
												$product_colour = '';
											}
									?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/"><img src="<?php echo base_url(); ?>assets/products/<?php echo $clist->product_cover_img; ?>" alt="cart-image" /></a>
                                            </td>
                                            <td class="product-name"><a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/"><?php echo $clist->product_name; ?></a><br /><?php echo $product_size;?>, <?php echo $product_colour;?></td>
                                            <td class="product-price"><span class="amount">₹<?php echo $clist->price; ?></span></td>
                                            <td class="product-quantity"><input name="quantity[]" type="number" value="<?php echo $clist->quantity; ?>" min="1" max="10" /></td>
                                            <td class="product-subtotal">₹<?php echo $clist->total_amount; ?></td>
                                            <td class="product-remove"> <a href="<?php echo base_url(); ?>home/deletecart/<?php echo $cart_id; ?>/" onclick="return confirm('Are you sure?')"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <input type="hidden" name="cart_id[]" value="<?php echo $cart_id; ?>" />
                                        <input type="hidden" name="price[]" value="<?php echo $price; ?>" />
                                       <?php 
									   $total_amount = $total_amount + $stotal;
									   } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table Content Start -->
                            <div class="row">
                               <!-- Cart Button Start -->
                                <div class="col-md-8 col-sm-7 col-xs-12">
                                    <div class="buttons-cart">
                                        <input type="submit" value="Update Cart" />
                                        <a href="<?php echo base_url(); ?>">Continue Shopping</a>
                                    </div>
                                </div>
                                <!-- Cart Button Start -->
                                <!-- Cart Totals Start -->
                                <div class="col-md-4 col-sm-5 col-xs-12">
                                    <div class="cart_totals">
                                        <h2>Cart Totals</h2>
                                        <br />
                                        <table>
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td><span class="amount">₹<?php echo number_format((float)$total_amount, 2, '.', ''); ?></span></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td>
                                                        <strong><span class="amount">₹<?php echo number_format((float)$total_amount, 2, '.', ''); ?></span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="wc-proceed-to-checkout">
                                            <a href="<?php echo base_url(); ?>home/checkout/">Proceed to Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cart Totals End -->
                            </div>
                            <!-- Row End -->
                        </form>
                        <?php } ?>
                        <!-- Form End -->
                    </div>
                </div>
                 <!-- Row End -->
            </div>
        </div>
        <!-- cart-main-area & wish list end -->
