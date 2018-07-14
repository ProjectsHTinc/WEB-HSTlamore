<div class="page-wrapper">
      <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Person Info</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
                          <?php foreach($res as $rows){} ?>
													<form class="form-horizontal" method="post" enctype="multipart/form-data" id="adminform" name="adminform">
														<div class="form-group">
															<label for="exampleInputuname_3" class="col-sm-3 control-label">Username*</label>
															<div class="col-sm-9">
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-user"></i></div>
																	<input type="text" class="form-control" id="exampleInputuname_3" name="username" placeholder="Username" value="<?php echo $rows->user_name; ?>" readonly>
																</div>
															</div>
														</div>
                            <div class="form-group">
                              <label for="exampleInputuname_3" class="col-sm-3 control-label">Name</label>
                              <div class="col-sm-9">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="icon-user"></i></div>
                                  <input type="text" class="form-control" id="exampleInputuname_3" name="name" placeholder="Username" value="<?php echo $rows->name; ?>">
                                </div>
                              </div>
                            </div>
														<div class="form-group">
															<label for="exampleInputEmail_3" class="col-sm-3 control-label">Email*</label>
															<div class="col-sm-9">
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																	<input type="email" class="form-control" id="exampleInputEmail_3" name="email" placeholder="Enter email" value="<?php echo $rows->email; ?>">
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="exampleInputweb_31" class="col-sm-3 control-label">Phone Number</label>
															<div class="col-sm-9">
																<div class="input-group">
																	<div class="input-group-addon"><i class="icon-phone"></i></div>
																	<input type="text" class="form-control" id="exampleInputweb_31" name="phone_number" placeholder="Enter Phone number" value="<?php echo $rows->phone_number; ?>">
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
        email: {required: true,
          remote: {
                url: "<?php echo base_url(); ?>adminlogin/checkemail",
                type: "post"
             }
           },
           phone_number: {required: true,minlength : 10,maxlength:10,
             remote: {
                   url: "<?php echo base_url(); ?>adminlogin/checkphone",
                   type: "post"
                }
              },
        name : {
           required: true,
       }
    },
    messages: {
        email: { required:"Enter the email",remote:"Email already exist" },
        name: { required:"Enter the Name"},
        phone_number: {   required: "Enter  phone number",minlength: "Min is 10", maxlength: "Max is 10",remote:"phone number already exist"}

    },
    submitHandler: function(form) {
        $.ajax({
            url: "<?php echo base_url(); ?>adminlogin/updateprofile",
            type: 'POST',
            data: $('#adminform').serialize(),
            success: function(response) {
            //  alert(response);
                if (response == "success") {
                  swal({
                  title: "Success",
                  text: " Profile Has been Updated Successfully",
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
