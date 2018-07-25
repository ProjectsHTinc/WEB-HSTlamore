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
                            
                   </div>
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