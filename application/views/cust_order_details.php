        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">account</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Page Breadcrumb End -->
        <!-- My Account Page Start Here -->
        <div class="my-account white-bg pb-100">
            <div class="container">
                <div class="account-dashboard">
                   <div class="dashboard-upper-info">
                       <div class="row no-gutters align-items-center">
                           <div class="col-lg-3 col-md-3 col-sm-6">
                               <div class="d-single-info">
                                   <p class="user-name">Hello <span><?php echo $this->session->userdata('cust_email')?></span></p>
                                   <p>(not yourmail@info? <a href="<?php echo base_url(); ?>logout/">Log Out</a>)</p>
                               </div>
                           </div>
                           <div class="col-lg-4 col-md-3 col-sm-6">
                               <div class="d-single-info">
                                   <p>Need Assistance? Customer service at.</p>
                                   <p>admin@example.com.</p>
                               </div>
                           </div>
                           <div class="col-lg-2 col-md-3 col-sm-6">
                               <div class="d-single-info">
                                   <p>E-mail them at </p>
                                   <p>support@example.com</p>
                               </div>
                           </div>
                           <div class="col-lg-3 col-md-2 col-sm-6">
                               <div class="d-single-info text-center">
                                   <?php
                               if (count($count_cart_session) >0) { ?>
                                   <a class="view-cart" href="<?php echo base_url(); ?>viewcart/"><i class="fa fa-cart-plus" aria-hidden="true"></i>view cart</a>
                                   <?php } ?>
                               </div>
                           </div>
                       </div>
                   </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <!-- Nav tabs -->
                            <ul class="nav flex-column dashboard-list" role="tablist">
                                <li><a href="<?php echo base_url(); ?>myaccount/">Dashboard</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>cust_orders/">Orders</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_address/">Addresses</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_details/">Account Details</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_change_password/">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
                            </ul>
                        </div>
                        
                        
                        <div class="col-lg-10 col-md-10">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content mt-all-40">
                                
                                <div id="orders" class="tab-pane fade in active">
                                    <h3>Order Details</h3>
                                    <div class="table-content table-responsive">
                       
                        <?php
                       if (count($address_details)>0){
						   foreach($address_details as $order_address){ 
									$timestamp = strtotime($order_address->purchase_date);
									$print_total_amount = $order_address->total_amount;
						   }
						?>
                         <table width="100%" class="table">
                          <tr>
                            <td style="text-align:left;line-height:30px;width:50%">
							<?php echo $order_address->full_name; ?><br>
							<?php echo $order_address->house_no; ?>, <?php echo $order_address->street; ?><br>
							<?php echo $order_address->state; ?>, <?php echo $order_address->city; ?><br>
							<?php echo $order_address->pincode; ?><br>
							<?php echo $order_address->country_name; ?><br>
							<?php echo $order_address->mobile_number; ?><br>
							<?php echo $order_address->email_address; ?><br>
							</td>
                            <td style="text-align:left;line-height:30px;width:50%;">
								Order ID : <?php echo $order_address->order_id; ?><br>
								Order Date : <?php echo date('d/m/Y', $timestamp); ?><br>
								Order Status : <?php echo $order_address->order_stauts; ?>
							</td>
                          </tr>
                        </table>
                        <?php
						}
						if (count($order_details)>0){
						?>
                                        <table width="100%" class="table">
                                            <thead>
                                                <tr>
                                                    <th style="width:60%">Product Name</th>
                                                    <th style="width:20%">Quantity</th>
                                                    <th style="width:20%">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
												foreach($order_details as $order){
											?>
                                                <tr>
                                                    <td style="text-align:left;width:60%"><?php echo $order->product_name; ?></td>
                                                    <td style="width:20%"><?php echo $order->quantity; ?></td>
                                                    <td style="width:20%">₹<?php echo $order->total_amount; ?></td>
                                                </tr>
                                           <?php } ?>
										  
											
												<tr>
                                                    <th style="width:60%">&nbsp;</th>
                                                    <th style="width:20%"><b>Total Amount</b></th>
                                                    <th style="width:20%"><b>₹<?php echo $print_total_amount; ?></b></th>
                                                </tr>

                                             </tbody>
                                        </table>
                               <?php } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account Page End Here -->
