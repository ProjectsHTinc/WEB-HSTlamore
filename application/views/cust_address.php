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
                                   <a class="view-cart" href="<?php echo base_url(); ?>/cart"><i class="fa fa-cart-plus" aria-hidden="true"></i>view cart</a>
                               </div>
                           </div>
                       </div>
                   </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <!-- Nav tabs -->
                            <ul class="nav flex-column dashboard-list" role="tablist">
                                <li><a href="<?php echo base_url(); ?>myaccount/">Dashboard</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_orders/">Orders</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>cust_address/">Addresses</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_details/">Account Details</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_change_password/">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-10 col-md-10" style="border:1px solid #F7F7F7;">
                        <h4 class="billing-address">Billing address</h4>
                        <form class="form-horizontal pb-100" name="registration"  id="registration" method="post" action="<?php echo base_url(); ?>home/cust_default_address/">
								<?php
								if (count($cust_address)>0) {
									foreach($cust_address as $rowm){
								?>
                               <div class="col-lg-4 col-md-3 col-sm-4" style="padding:20px; min-height:300px; background:#F7F7F7;">
                               <?php if ($rowm->address_mode == '1') {  ?>
                               <p style="font-size:10px; color:#81C341;">
                               <input type="radio" name="address_id" value="<?php echo $rowm->id; ?>" checked="checked" /> Default Address <?php //echo $rowm->address_type; ?></p>
                              <?php } else { ?>
                              <p style="font-size:10px; color:#81C341;">
                              <input type="radio" name="address_id" value="<?php echo $rowm->id; ?>"  /> <?php //echo $rowm->address_type; ?></p>
                              <?php } ?>
                               <p><?php echo $rowm->full_name; ?></p>
                               <p><?php echo $rowm->house_no; ?>, <?php echo $rowm->street; ?></p>
                               <p><?php echo $rowm->city; ?>, <?php echo $rowm->state; ?></p>
                               <p><?php echo $rowm->country_name; ?></p>
                               <p>Mobile Number  : <?php echo $rowm->mobile_number ; ?>, <?php echo $rowm->alternative_mobile_number  ; ?></p><br />
                               <p>Landmark : <?php echo $rowm->landmark; ?></p><br />
                               <p><a href="<?php echo base_url(); ?>home/cust_address_delete/<?php echo $rowm->id; ?>/" style="color:#FAA320;" onclick="return confirm('Are you sure?')">Delete</a></p>
                           </div>
                           <?php
									}
								}
							?>
                              
                           <div class="register-box mt-40 mb-20">
								<button type="submit" class="return-customer-btn f-right">Save</button>
							</div>
                            </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- My Account Page End Here -->
