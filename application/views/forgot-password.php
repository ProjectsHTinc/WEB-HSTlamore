        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">account</a></li>
                                <li><a href="#">Forgotten Password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Page Breadcrumb End -->
        <!-- Register Account Start -->
        <div class="register-account">
            <div class="container">
                <div class="row">
                    <div class="register-title">
                        <h3 class="mb-10">Forgot Password</h3>
                        <p class="mb-10">If you already have an account with us, please login at the login page.</p>
                    </div>
                </div>
                <!-- Row End -->
                <div class="row">
                    <form class="form-horizontal pb-100" name="registration"  id="registration" method="post" action="">
                        <fieldset>
                            <legend>Your Personal Details</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-3 left" for="email"><span class="require">*</span>Enter you email address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter you email address here...">
                                </div>
                            </div>
                        </fieldset>
                         <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
    						<strong>Sorry!.. Please Check Your Email id.
  						</div>
                        <div class="alert alert-success alert-dismissible" id="reset" style="display:none;">
    						<strong>Password Reset!</strong> New Password sent to your Email Address.
  						</div>
                        <div class="buttons newsletter-input">
                           <div class="pull-left">
                                <a class="return-customer-btn mr-20" href="<?php echo base_url(); ?>login/">Back</a>
                            </div>
                            <div class="pull-right">
                                <input type="submit" value="Continue" class="newsletter-btn">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Register Account End -->
  <script language="javascript">

	$('#registration').validate({ // initialize the plugin
    rules: {
        email: {
            required: true,email:true,
        },
    },
    messages: {
		email: { required:"Enter your Email"},
    },
    submitHandler: function(form) {
		$.ajax({
            url: "<?php echo base_url(); ?>home/resetpassword",
            type: 'POST',
            data: $('#registration').serialize(),
            success: function(response) {
                if (response == "reset") {
					$('#error').hide();
                     $('#reset').show();
                } else {
					$('#error').show();
                }
            }
        });
    }
});
</script>