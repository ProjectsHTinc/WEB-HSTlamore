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
                                <li><a href="<?php echo base_url(); ?>cust_address/">Addresses</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_details/">Account Details</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>cust_change_password/">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content mt-all-40">
      
                                <div id="account-details" class="tab-pane fade in active">
                                    <h3>Change Password </h3>
                                    <div class="register-form login-form clearfix">
                                    <form class="form-horizontal pb-100" name="registration"  id="registration" method="post" action="<?php echo base_url(); ?>home/change_password/">
                                    	
                                        <fieldset>
                                        <div class="form-group row">
                                            <label for="f-name" class="col-lg-4 col-md-4 col-form-label">New Password: <span class="require">*</span></label>
                                            <div class="col-lg-8 col-md-8">
                                            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="f-name" class="col-lg-4 col-md-4 col-form-label">Confirm New Password: <span class="require">*</span></label>
                                            <div class="col-lg-8 col-md-8">
                                            <input type="password" class="form-control" name="pwdconfirm" id="pwdconfirm" placeholder="Password">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="buttons newsletter-input">
                                        <div class="pull-right">
                                            <input type="submit" value="Update" class="newsletter-btn">
                                        </div>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 pro-img">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account Page End Here -->
        
<script language="javascript">

	$('#registration').validate({ // initialize the plugin
    rules: {
		 
		pwd: {
            required: true,
        },
		pwdconfirm: {
            required: true,equalTo: "#pwd"
        },
    },
    messages: {
		pwd: { required:"Enter New Password"},
		pwdconfirm: { required:"Enter Confirm New Password"},
    },
    
});
</script>