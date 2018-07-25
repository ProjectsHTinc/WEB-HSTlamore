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
                <form name="checkout" id="checkout" method="post" action="<?php echo base_url(); ?>home/cartprocess/">
                    <?php 
					$address_id = $this->session->userdata('address_id');
					if ($address_id =='') { ?>
                    <div class="col-lg-6 col-md-6">
                            <div class="checkbox-form pb-50">
                                <h3>Billing Details</h3>
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
                                    <div class="order-notes">
                                        <div class="checkout-form-list">
                                            <label>Order Notes</label>
                                            <textarea id="ncheckout_mess" name="ncheckout_mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                   </div><input type="hidden" name="address_value" value="new" />
                    
                    <?php } else { 
						$address_id = $this->session->userdata('address_id');
						if ($address_id != "") {
							echo '<input type="hidden" name="address_id" value="'.$address_id.'" />';
						}
					?>
                        <div class="col-lg-6 col-md-6">
                            <div class="checkbox-form pb-50">
                                <h3>Billing Details</h3>
                                <div id="oldship-box-info" class="row">
                                    <div class="col-md-12">
                                        <div class="country-select">
                                            <label>Country <span class="required">*</span></label>
                                            <select name="ocountry_id" id="ocountry_id">
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
                                            <input placeholder="Full Name" type="text" name="nname" id="nname" value="<?php echo $this->session->userdata('address_full_name'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input placeholder="Door no." type="text" name="oaddress1" id="oaddress1" value="<?php echo $this->session->userdata('address_house_no'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mtb-30">
                                        <input placeholder="Apartment, Street etc" type="text" name="oaddress2" id="oaddress2" value="<?php echo $this->session->userdata('address_street'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-30">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input placeholder="Town / City" type="text" name="otown" id="otown" value="<?php echo $this->session->userdata('address_city'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>State / Region <span class="required">*</span></label>
                                             <input placeholder="State / Region" type="text" name="ostate" id="ostate" value="<?php echo $this->session->userdata('address_state'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input placeholder="Postcode / Zip" type="text" name="ozip" id="ozip" value="<?php echo $this->session->userdata('address_pincode'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input placeholder="Email Address" type="email" name="oemail" id="oemail" value="<?php echo $this->session->userdata('address_email'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Phone  <span class="required">*</span></label>
                                            <input placeholder="Phone or Mobile" type="text" name="ophone" id="ophone" value="<?php echo $this->session->userdata('address_mobile'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Alternative Phone </label>
                                            <input placeholder="Alternative Phone or Mobile" type="text" name="ophone1" id="ophone1" value="<?php echo $this->session->userdata('address_mobile_alter'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Landmark</label>
                                            <input placeholder="Phone or Mobile" type="text" name="olandmark" id="olandmark" value="<?php echo $this->session->userdata('address_landmark'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="different-address">
                                    <div class="ship-different-title">
                                        <h3>
                                            <label>Ship to a different address?</label>
                                            <input id="ship-box" name="ship-box" type="checkbox" />
                                        </h3>
                                    </div>
                                    <div id="ship-box-info" class="row">
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
                                            <input placeholder="Full Name" type="text" name="nname" id="nname" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label> 
                                            <input placeholder="Door no." type="text" name="naddress1" id="naddress1" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mtb-20">
                                            <input placeholder="Apartment, Street etc" type="text" name="naddress2" id="naddress2" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-20">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input placeholder="Town / City" type="text" name="ntown" id="ntown" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-20">
                                            <label>State / Region <span class="required">*</span></label>
                                            <input placeholder="State / Region" type="text" name="nstate" id="nstate" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-20">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input placeholder="Postcode / Zip" type="text" name="nzip" id="nzip" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-20">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input placeholder="Email Address" type="email" name="nemail" id="nemail" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-40">
                                            <label>Phone  <span class="required">*</span></label>
                                            <input placeholder="Phone or Mobile" type="text" name="nphone" id="nphone" >
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
                                   </div>
                                    <div class="order-notes">
                                        <div class="checkout-form-list">
                                            <label>Order Notes</label>
                                            <textarea id="scheckout_mess" name="scheckout_mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div><input type="hidden" name="address_value" value="old" />
                         <?php } ?>
                        <div class="col-lg-6 col-md-6">
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
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    Vestibulum suscipit <strong class="product-quantity"> × 1</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">₹165.00</span>
                                                </td>
                                            </tr>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    Vestibulum dictum magna <strong class="product-quantity"> × 1</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">₹50.00</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">₹215.00</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">₹215.00</span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <div class="order-button-payment">
                                            <input type="submit" value="Place order" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
 <script language="javascript">

	$('#checkout').validate({ // initialize the plugin
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
            //remote: {
            //      url: "<?php echo base_url(); ?>home/zipcode_check",
            //       type: "post"
            //     }
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
		naddress1: { required:"Enter Password"},
		naddress2: { required:"Enter Confirm Password"},
		ntown: { required:"Please Accept Our Policy"},
		nstate: { required:"Please Accept Our Policy"},
		nzip: { required:"Please Accept Our Policy"},
		//nzip: { required:"Please Accept Our Policy",remote:"Delivery is not available for this Postal code"},
		nemail: { required:"Enter your Email"},
		nphone: { required:"Enter your Mobile number", minlength: "Min is 10", maxlength: "Max is 11"},
    }
});
</script>