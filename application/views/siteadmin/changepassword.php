<div class="page-wrapper">
    <div class="container-fluid">
          <div class="row">
      <div class="col-md-6">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Change Password</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="adminform" name="adminform">


														<div class="form-group">
															<label for="exampleInputweb_41" class="col-sm-4 control-label">Current Password</label>
															<div class="col-sm-8">
																<div class="input-group">
																	<input type="text" class="form-control" id="exampleInputweb_41" name="currentpassword" placeholder="Enter Password ">
																	<div class="input-group-addon"><i class="icon-lock"></i></div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="exampleInputpwd_5" class="col-sm-4 control-label">Password*</label>
															<div class="col-sm-8">
																<div class="input-group">
																	<input type="password" class="form-control" id="exampleInputpwd_5" name="newpassword" placeholder="Enter password">
																	<div class="input-group-addon"><i class="icon-lock"></i></div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="exampleInputpwd_6" class="col-sm-4 control-label">Re-enter Password*</label>
															<div class="col-sm-8">
																<div class="input-group">
																	<input type="password" class="form-control" id="exampleInputpwd_6" name="retypepassword" placeholder="Re-enter Password">
																	<div class="input-group-addon"><i class="icon-lock"></i></div>
																</div>
															</div>
														</div>

														<div class="form-group mb-0">
															<div class="col-sm-offset-3 col-sm-9">
																<button type="submit" class="btn btn-info ">Update </button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
            </div>

    </div>
    </div>
    <script>
    $('#adminform').validate({ // initialize the plugin
        rules: {
            currentpassword: {required: true,
              remote: {
                    url: "<?php echo base_url(); ?>adminlogin/checkpassword",
                    type: "post"
                 }
               },
            newpassword : {
              required: true, minlength : 6,maxlength:12,
           },
           retypepassword : {

               equalTo : '[name="newpassword"]',
           }
        },
        messages: {
            currentpassword: { required:"Enter the Current Password",remote:"Password was Wrong" },
            newpassword: {   required: "Enter  New Password",minlength: "Min is 6", maxlength: "Max is 12"},
             retypepassword: {
                 required: "Enter Confirm Password",
                 equalTo:"New password should not match",
                 notEqualTo: "Password Should Match"
             }

        },
        submitHandler: function(form) {
            $.ajax({
                url: "<?php echo base_url(); ?>adminlogin/updatepassword",
                type: 'POST',
                data: $('#adminform').serialize(),
                success: function(response) {
                //  alert(response);
                    if (response == "success") {
                      swal({
                      title: "Success",
                      text: " Password Has been Changed Successfully",
                      type: "success"
                  }).then(function() {
                      location.href = '<?php echo base_url(); ?>adminlogin/home';
                  });

                    } else{
                        sweetAlert("Oops...", response, "error");
                    }
                }
            });
        }
    });
    </script>
