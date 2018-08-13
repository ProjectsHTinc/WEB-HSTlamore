<div class="page-wrapper">
	<div class="container-fluid">
      <div class="row">
				<div class="row heading-bg bg-blue">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-light">Banner</h5>
					</div>

					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
							<li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
							<li><a href="<?php echo base_url(); ?>admin/banner"><span>Banner</span></a></li>
						<li class="active"><span>Edit </span></li>
					  </ol>
					</div>
			</div>
		</div>
		<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Edit  Banner </h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<?php if($this->session->flashdata('msg')): ?>
											<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Yay! <?php echo $this->session->flashdata('msg'); ?>
											</div>
    						<?php endif; ?>

										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<?php  foreach($res_ban as $rows_ban){ }?>
													<form action="<?php echo base_url(); ?>banner/update_banner" method="post" enctype="multipart/form-data" id="adminform" name="adminform">
														<div class="form-body">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product name</label>
																		<select class="form-control" data-placeholder="Choose a Status" tabindex="1" name="prod_id" id="prod_id">

																		<?php foreach($res_prod as $row_prod){ ?>
																				<option value="<?php echo $row_prod->id ?>"><?php echo $row_prod->product_name ?></option>
																	<?php 	} ?>


																		</select>

																			<script> $('#prod_id').val('<?php echo $rows_ban->product_id; ?>');</script>
																	</div>
																</div>
																<!--/span-->

																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Banner Title</label>
																		<input type="text" id="firstName" name="banner_title" id="banner_title" class="form-control" placeholder="" value="<?php echo $rows_ban->banner_title; ?>">
																		<input type="hidden" id="firstName" name="banner_token" id="banner_token" class="form-control" placeholder="" value="<?php echo base64_encode($rows_ban->id*9876); ?>">

																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">

																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Banner  image</label>
																		<input type="file" class="form-control" name="banner_img" id="banner_img" placeholder="">
																			<input type="hidden"  name="banner_old_image" id="banner_old_image" class="form-control" placeholder="" value="<?php echo $rows_ban->banner_image; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																		<img src="<?php echo base_url(); ?>assets/banner/<?php  echo $rows_ban->banner_image; ?>" style="width:100px;">
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">

																</div>
																<!--/span-->
																<div class="col-md-6">

																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Banner Description</label>
																	<textarea class="form-control" placeholder="" name="banner_desc" id="banner_desc"><?php echo $rows_ban->banner_desc; ?></textarea>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">

																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Status</label>
																		<select class="form-control"  tabindex="1" name="banner_status" id="banner_status">
																			<option value="Active">Active</option>
																			<option value="Inactive">Inactive</option>
																		</select>
																		<script> $('#banner_status').val('<?php echo $rows_ban->status; ?>');</script>
																	</div>
																</div>
																<!--/span-->

																<!--/span-->
															</div>
															<!-- /Row -->


															<!-- /Row -->

														</div>
														<div class="form-actions mt-10">
															<button type="submit" class="btn btn-success  mr-10" id="upload"> Save</button>

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
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 1 Mb');

$('#adminform').validate({ // initialize the plugin
    rules: {
        prod_id: {required: true,
          remote: {
                url: "<?php echo base_url(); ?>banner/check_banner_exist/<?php echo base64_encode($rows_ban->id*9876);  ?>",
                type: "post"
             }
           },
        banner_title : {
           required: true, maxlength: 100
       },
			 banner_desc : {
					required: true,maxlength: 100
			},

			banner_img : {
				 required: false,accept: "jpg,jpeg,png",filesize: 1048576,
		 },
			 cat_status : {
					required: true
				}
    },
    messages: {
        prod_id: { required:"select product",remote:"product  already added for banner" },
				banner_title: { required:"Enter the title",maxlength:"Max length is 100 characters"},
        banner_desc: { required:"Enter the Description",maxlength:"Max length is 100 characters"},
				banner_img: { required:"Select banner image", accept:"Please upload .jpg or .png .",fileSize:"File must be JPG or PNG, less than 1MB"}
    }

});
</script>
