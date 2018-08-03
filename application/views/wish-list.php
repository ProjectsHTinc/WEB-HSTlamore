        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Page Breadcrumb End -->
        <!-- Wish List Start -->
        <div class="cart-main-area wish-list pb-50">
            <div class="container">
                <!-- Section Title Start -->
                <div class="section-title mb-50">
                    <h2>wish list</h2>
                </div>
                <!-- Section Title Start End -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        if (count($count_wishlist)>0){
						?>
                        <!-- Form Start -->
                        <form action="#">
                            <!-- Table Content Start -->
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-remove">Remove</th>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <!--<th class="product-price">Price</th>-->
                                            <th class="product-quantity">Stock Status</th>
                                            <th class="product-subtotal">View Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php 
									foreach($count_wishlist as $wlist){ 
										$product_id = $wlist->product_id;
										$wishlist_id = $wlist->id;
										$combined_status = $wlist->combined_status;
										$sproduct_id = $wlist->product_id * 663399;
										$product_name = $wlist->product_name;
										$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $wlist->product_name));
										$enc_product_id = base64_encode($sproduct_id);
										$prod_price = $wlist->prod_actual_price;
										$offer_status = $wlist->offer_status;
										$stocks_left = $wlist->stocks_left;
										$product_cover_img = $wlist->product_cover_img;
										if ($offer_status >0){
											$disp_offer_status = '[Offer Product]';
										} else {
											$disp_offer_status = '';
										}
										if ($stocks_left >0){
											$stocks_status = 'in stock';
											$stock_colour='#81C341';
										} else {
											$stocks_status = 'out of stock';
											$stock_colour='#FAA320';
										}
									?>
                                        <tr>
                                            <td class="product-remove"> <a href="<?php echo base_url(); ?>home/deletewishlist/<?php echo $wishlist_id; ?>/" onclick="return confirm('Are you sure?')"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                            <td class="product-thumbnail">
                                                <a href="<?php echo base_url(); ?>home/product_details/<?php echo $product_id; ?>/<?php echo $enc_product_name ; ?>/"><img src="<?php echo base_url(); ?>assets/products/<?php echo $product_cover_img; ?>" alt="cart-image" /></a>
                                            </td>
                                            <td class="product-name"><a href="<?php echo base_url(); ?>home/product_details/<?php echo $product_id; ?>/<?php echo $enc_product_name ; ?>/"><?php echo $product_name; ?></a></td>
                                            <!--<td class="product-price"><span class="amount">₹<?php echo $prod_price;?></span></td>-->
                                            <td class="product-stock-status"><span style="color:<?php echo $stock_colour ?>;"><?php echo $stocks_status;?> <?php echo $disp_offer_status; ?></span></td>
                                            <td class="product-add-to-cart"><a href="<?php echo base_url(); ?>home/product_details/<?php echo $product_id; ?>/<?php echo $enc_product_name ; ?>/">View Product</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table Content Start -->
                        </form>
                        <!-- Form End -->
                        <?php } ?>
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Wish List End -->
