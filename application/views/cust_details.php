<?php
	//print_r($cust_details);
	$redirect_url = base_url()."login/";
	if (!empty($cust_logindetails)){
		foreach($cust_logindetails as $cust_logres){ }
	} else {
		header("Location: ".$redirect_url);
	}
	if (!empty($cust_details)){
		foreach($cust_details as $cust_res){ }
	} else {
		$redirect_url = base_url()."login/";
	}
?>
<style>
.ui-widget.ui-widget-content {
    border: none;
    background: #F7F7F7;
}
</style>
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
                                <li class="active"><a href="<?php echo base_url(); ?>cust_details/">Account Details</a></li>
                                 <li><a href="<?php echo base_url(); ?>cust_change_password/">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content mt-all-40">
      
                                <div id="account-details" class="tab-pane fade in active">
                                    <h3>Account details </h3>
                                    <div class="register-form login-form clearfix">
                                    	<form class="form-horizontal pb-100" enctype="multipart/form-data" name="registration"  id="registration" method="post" action="<?php echo base_url(); ?>home/customer_update/">
                                            <div class="form-group row">
                                                <label for="f-name" class="col-lg-4 col-md-4 col-form-label">First Name</label>
                                                <div class="col-lg-8 col-md-8">
                                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $cust_res->first_name; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="l-name" class="col-lg-4 col-md-4 col-form-label">Last Name</label>
                                                <div class="col-lg-8 col-md-8">
                                                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $cust_res->last_name; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-lg-4 col-md-4 col-form-label">Email address</label>
                                                <div class="col-lg-8 col-md-8">
                                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $cust_logres->email; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputpassword" class="col-lg-4 col-md-4 col-form-label">Mobile</label>
                                                <div class="col-lg-8 col-md-8">
                                                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $cust_logres->phone_number; ?>">
                                                </div>
                                            </div>
                                             <div class="form-group row">
                                                <label for="birth" class="col-lg-4 col-md-4 col-form-label">Gender</label>
                                                <div class="col-lg-8 col-md-8">
                                                    <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="Male" <?php if ($cust_res->gender=='Male'){ echo 'checked'; } ?>>
                                                    Male</label>
                                                    <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="Female" <?php if ($cust_res->gender=='Female'){ echo 'checked'; } ?>>
                                                    Female</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="birth" class="col-lg-4 col-md-4 col-form-label">Birthdate</label>
                                                <div class="col-lg-8 col-md-8">
                                                    <input type="text" class="form-control" name="dob" id="dob" placeholder="MM-DD-YYYY" value="<?php echo $cust_res-> 	birth_date; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="birth" class="col-lg-4 col-md-4 col-form-label">Profile Picture</label>
                                                <div class="col-lg-8 col-md-8">
                                                    <input type="file" class="form-control" name="profile_pic" id="profile_pic">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="birth" class="col-lg-4 col-md-4 col-form-label">Newsletter Subscribe</label>
                                                <div class="col-lg-8 col-md-8">
                                                    <label class="radio-inline">
                                                    <input name="newsletter" value="1" type="radio" <?php if ($cust_res->newsletter_status=='1'){ echo 'checked'; } ?>>
                                                    Yes</label>
                                                    <label class="radio-inline">
                                                    <input name="newsletter" value="0" type="radio" <?php if ($cust_res->newsletter_status=='0'){ echo 'checked'; } ?>>
                                                    No</label>
                                                    <label class="form-check-label" for="subscribe" style="font-size:10px;">Subscribe to our newsletters now and stay up-to-date with new collections, the latest lookbooks and exclusive offers..</label>
                                                </div>
                                                
                                            </div>

                                            <div class="register-box mt-40">
                                                <button type="submit" class="return-customer-btn f-right">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 pro-img">
                        <?php if ($cust_res->profile_picture != '') { ?>
                        	<img src="<?php echo base_url(); ?>assets/front/profile/<?php echo $cust_res->profile_picture; ?>"/>
                        <?php } else { ?>
                        	<img src="<?php echo base_url(); ?>assets/front/profile/no-image.jpg"/>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account Page End Here -->
        
<script language="javascript">
	$( function() {
		$("#dob").datepicker({
		  dateFormat: 'dd-mm-yy',
		  changeMonth: true,
			changeYear: true
		});
	});
  
	$('#registration').validate({ // initialize the plugin
    rules: {
		 fname: {
            required: true,
        },
        email: {
            required: true,email:true,
            remote: {
                   url: "<?php echo base_url(); ?>home/existemailcustomer",
                   type: "post"
                }
        },
        mobile: {
            required: true,minlength: 10, maxlength: 10, digits: true,
            remote: {
                   url: "<?php echo base_url(); ?>home/existmobilecustomer",
                   type: "post"
                }
        },
    },
    messages: {
		fname: { required:"Enter your First Name"},
		email: { required:"Enter your Email",remote:"Email id Already Exists" },
		mobile: { required:"Enter your Mobile number", minlength: "Min is 10", maxlength: "Max is 11",remote:"Mobile Number Already Exists" },
    },
});
</script>