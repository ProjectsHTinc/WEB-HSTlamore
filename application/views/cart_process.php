        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">checkout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Breadcrumb End -->
        
        <!-- checkout-area start -->
        <div class="checkout-area pt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                     <?php
                        if (count($res_orders['address'])>0){
							foreach($res_orders['address'] as $olist){ }
						?>
                             <h3>Delivery Details</h3>
                             		<div class="col-md-12">
                                     <div class="checkout-form-list mtb-20">
                                            <label>Order ID : <?php echo $res_orders['order_id']; ?></label>
                                                <p><?php echo $olist->full_name; ?></p>
                                                <p><?php echo $olist->house_no; ?>, <?php echo $olist->street; ?></p>
                                                <p><?php echo $olist->city; ?>, <?php echo $olist->state; ?></p>
                                                <p><?php echo $olist->country_name; ?></p>
                                                <p><?php echo $olist->pincode; ?></p>
                                                <p>Mobile Number  : <?php echo $olist->mobile_number ; ?> <?php if ($olist->alternative_mobile_number !=''){ echo $olist->alternative_mobile_number; } ?></p><br />
                                                <?php if ($olist->landmark !=''){ ?>
                                                <p>Landmark : <?php echo $olist->landmark; ?></p>
                                                <?php } ?>
                                        </div>
                                    </div>
                                    
                         <?php } ?>
                   </div>
                     <div class="col-lg-6 col-md-6">
                         <?php
                        if (count($cart_list)>0){
						?>
                            <div class="your-order">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                 
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
<?php 
									$total_amount = '0';
									foreach($cart_list as $clist){ 
										$cart_id = $clist->id;
										$sproduct_id = $clist->product_id;
										$product_combined_id = $clist->product_combined_id;
										$product_name = $clist->product_name;
										$product_id = $clist->product_id * 663399;
										$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $clist->product_name));
										$enc_product_id = base64_encode($product_id);
										$quantity = $clist->quantity;
										$stotal = $clist->total_amount;
										$price = $clist->price;;
										
										
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
                                        
                                            <tr class="cart_item">
                                                <td class="product-name"><?php echo $product_name;?> <strong class="product-quantity"> × <?php echo $quantity;?></strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">₹<?php echo $stotal;?></span>
                                                </td>
                                            </tr>
                                      <?php $total_amount = $total_amount + $stotal;
									  } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">₹<?php echo number_format((float)$total_amount, 2, '.', ''); ?></span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">₹<?php echo number_format((float)$total_amount, 2, '.', ''); ?></span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <div class="order-button-payment">
										
										<form method="post" name="customerData"  class="confirm_process" action="<?php echo base_url(); ?>ccavenue/ccavRequestHandler.php">
											<input type="hidden" name="merchant_id" value="216134"/>
											<input type="hidden" name="order_id" value="<?php echo $res_orders['order_id'];?>"/>
											<input type="hidden" name="amount" value="<?php echo number_format((float)$total_amount, 2, '.', '');?>"/>
											<input type="hidden" name="currency" value="INR"/>
											<input type="hidden" name="redirect_url" value="<?php echo base_url(); ?>ccavenue/ccavResponseHandler.php"/>
											<input type="hidden" name="cancel_url" value="<?php echo base_url(); ?>"/>
											<input type="hidden" name="language" value="EN"/>
											<input type="submit" value="CheckOut" class="btn btn-primary">
										</form>
										
			                          </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                </div>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function(){
	 $("customerData").submit(function() {
			$(this).submit(function() {
				return false;
			});
			return true;
		}); 

}); 
</script>