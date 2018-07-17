        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">account</a></li>
                                <li><a href="#">register</a></li>
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
                        <h3 class="mb-10">REGISTER ACCOUNT</h3>
                        <p class="mb-10">If you already have an account with us, please login at the <a href="<?php echo base_url(); ?>login/">login page</a>.</p>
                    </div>
                </div>
                <!-- Row End -->
                <div class="row">
                    <form class="form-horizontal pb-100" name="registration"  id="registration" method="post" action="">
                        <fieldset>
                            <legend>Your Personal Details</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="f-name"><span class="require">*</span>Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email"><span class="require">*</span>Email Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="number"><span class="require">*</span>Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Your Password</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd"><span class="require">*</span>Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Password">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd-confirm"><span class="require">*</span>Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="pwdconfirm" id="pwdconfirm" placeholder="Confirm password">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="newsletter-input">
                            <legend>Newsletter</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Subscribe</label>
                                <div class="col-sm-10"> <label class="radio-inline">
                                    <input type="radio" name="newsletter" value="1">
                                    Yes</label>
                                    <label class="radio-inline">
                                    <input type="radio" name="newsletter" value="0" checked="checked">
                                    No</label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons newsletter-input">
                            <div class="pull-right">I have read and agree to the <a href="#" class="agree"><b>Privacy Policy</b></a>
                                <input type="checkbox" name="agree" id="agree" value=""> &nbsp;
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
		 name: {
            required: true,
        },
        email: {
            required: true,email:true,
            remote: {
                   url: "<?php echo base_url(); ?>home/existemail",
                   type: "post"
                }
        },
        mobile: {
            required: true,minlength: 10, maxlength: 10, digits: true,
            remote: {
                   url: "<?php echo base_url(); ?>home/existmobile",
                   type: "post"
                }
        },
		pwd: {
            required: true,
        },
		pwdconfirm: {
            required: true,equalTo: "#pwd"
        },
		agree: {
            required: true,
        },
    },
    messages: {
		name: { required:"Enter your Name"},
		email: { required:"Enter your Email",remote:"Email id Already Exists" },
		mobile: { required:"Enter your Mobile number", minlength: "Min is 10", maxlength: "Max is 11",remote:"Mobile Number Already Exists" },
		pwd: { required:"Enter Password"},
		pwdconfirm: { required:"Enter Confirm Password"},
		agree: { required:"Please Accept Our Policy"},
    },
    submitHandler: function(form) {
       
		$.ajax({
            url: "<?php echo base_url(); ?>home/customer_registration",
            type: 'POST',
            data: $('#registration').serialize(),
            success: function(response) {
                if (response == "register") {
                        location.href = '<?php echo base_url(); ?>login/';
                } else {
					alert("error");
                }
            }
        });
    }
});
</script>