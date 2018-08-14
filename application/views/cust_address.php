<?php
if (!empty($cust_details)){
		foreach($cust_details as $cust_res){ }
}
?>
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
                                <li><a href="<?php echo base_url(); ?>cust_orders/">Orders</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>cust_address/">Addresses</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_details/">Account Details</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_change_password/">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
                            </ul>
                        </div>
                        
                         <div class="col-lg-10 col-md-10">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content mt-all-40">
                                <div id="address" class="tab-pane fade in active">
                                    <h3>Address</h3>
                                    
							<?php if (count($cust_address)>0) { ?>
                             <div class="row">
                              <form class="form-horizontal pb-100" name="registration"  id="registration" method="post" action="<?php echo base_url(); ?>home/cust_default_address/">
								<?php
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
                           <?php } ?>
                                   	<div class="col-lg-12 col-md-3 col-sm-4 mt-10 mb-10">
                                        <button type="submit" class="return-customer-btn">Save</button>
                                    </div>
                           		 </form>
                                    </div>
                                 <?php } else { ?>
                                 
                                 <form name="naddress" id="naddress" method="post" action="<?php echo base_url(); ?>home/cust_address_add/">
                                 <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="country-select">
                                            <label>Country <span class="required">*</span></label>
                                            <select name="ncountry_id" id="ncountry_id" >
                                           <?php
												if (count($countrylist)>0) {
													foreach($countrylist as $rowc){
														echo "<option value='".$rowc->id."'>".$rowc->country_name."</option>";
													}
												}
											?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mtb-20">
                                            <label>Full Name <span class="required">*</span></label>
                                            <input placeholder="Full Name" type="text" name="nname" id="nname" value="<?php echo $this->session->userdata('cust_name'); ?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label> 
                                            <input placeholder="Door no." type="text" name="naddress1" id="naddress1">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mtb-20">
                                            <input placeholder="Apartment, Street etc" type="text" name="naddress2" id="naddress2">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-20">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input placeholder="Town / City" type="text" name="ntown" id="ntown">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-20">
                                            <label>State / Region <span class="required">*</span></label>
                                            <input placeholder="State / Region" type="text" name="nstate" id="nstate">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-20">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input placeholder="Postcode / Zip" type="text" name="nzip" id="nzip">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-20">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input placeholder="Email Address" type="email" name="nemail" id="nemail" value="<?php echo $this->session->userdata('cust_email'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-40">
                                            <label>Phone  <span class="required">*</span></label>
                                            <input placeholder="Phone or Mobile" type="text" name="nphone" id="nphone" value="<?php echo $this->session->userdata('cust_mobile'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-20">
                                            <label>Alternative Phone</label>
                                            <input placeholder="Alternative Phone or Mobile" type="text" name="nphone1" id="nphone1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-40">
                                            <label>Landmark</label>
                                            <input placeholder="Nearest Landmark" type="text" name="nlandmark" id="nlandmark">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-3 col-sm-4 mt-10 mb-10">
                                        <button type="submit" class="return-customer-btn">Save</button>
                                    </div>
                                    
                        		</div>
                                 </form>
                                 <?php } ?>
                                 </div>
                             </div>
                         </div>

                </div>
            </div>
        </div>
        <!-- My Account Page End Here -->
<script language="javascript">
	$('#naddress').validate({ // initialize the plugin
	ignore: ":hidden",
    rules: {
		 nname: {
            required: true,
        },
		 naddress1: {
            required: true,
        },
		naddress2: {
            required: true,
        },
		ntown: {
            required: true,
        },
		nstate: {
            required: true,
        },
		nzip: {
            required: true,minlength: 6, maxlength: 6, digits: true,
            remote: {
                  url: "<?php echo base_url(); ?>home/zipcode_check",
                   type: "post"
                 }
        },
		nemail: {
            required: true,email:true,
        },
        nphone: {
            required: true,minlength: 10, maxlength: 10, digits: true,
        },
    },
    messages: {
		nname: { required:"Enter your Name"},
		naddress1: { required:"Enter Address Line 1"},
		naddress2: { required:"Enter Address Line 2"},
		ntown: { required:"Enter Town / City"},
		nstate: { required:"Enter State / Region"},
		nzip: { required:"Postcode / Zip",remote:"Delivery is not available for this Postal code"},
		nemail: { required:"Enter your Email"},
		nphone: { required:"Enter your Mobile number", minlength: "Min is 10", maxlength: "Max is 11"},
    }
});
</script>