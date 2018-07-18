<div class="page-wrapper">
	<div class="container-fluid">
      <div class="row">
				<div class="row heading-bg bg-blue">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-light">category</h5>
					</div>

					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
							<li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
							<li><a href="<?php echo base_url(); ?>category/"><span> Category</span></a></li>
							<li><a href=""><span>Sub Category</span></a></li>
							<li class="active"><span>Create</span></li>
					  </ol>
					</div>
			</div>
		</div>
		<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Create Sub Category </h6>
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
													<form action="<?php echo base_url(); ?>category/create_sub_category" method="post" enctype="multipart/form-data" id="adminform" name="adminform">
														<div class="form-body">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Sub Category Title</label>
																		<input type="text" id="firstName" name="cat_name" class="form-control" placeholder="">
																			<input type="hidden" id="firstName" name="sub_cat_id" class="form-control" value="<?php echo $this->uri->segment(3);  ?>">

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
																		<label class="control-label mb-10">Sub Category Cover image</label>
																		<input type="file" class="form-control" name="cat_cover_img" placeholder="">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">

																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Sub Category Thumbnail</label>
																		<input type="file" class="form-control" name="cat_thumb_img" placeholder="">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">

																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Sub Category Description</label>
																	<textarea class="form-control" placeholder="" name="cat_desc"></textarea>
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
																		<select class="form-control" data-placeholder="Choose a Status" tabindex="1" name="cat_status">
																			<option value="Active">Active</option>
																			<option value="Inactive">Inactive</option>

																		</select>
																	</div>
																</div>
																<!--/span-->

																<!--/span-->
															</div>
															<!-- /Row -->

															<div class="seprator-block"></div>

															<h6 class="txt-dark capitalize-font"><i class="icon-notebook mr-10"></i>SEO </h6>
															<hr>
															<div class="row">
																<div class="col-md-12 ">
																	<div class="form-group">
																		<label class="control-label mb-10">Sub Category Meta Title</label>
																		<input type="text" class="form-control" name="cat_meta_title">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Sub Category Meta Desc</label>
																		<input type="text" class="form-control" name="cat_meta_desc">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Sub Category Keywords</label>
																		<input type="text" class="form-control" name="cat_meta_keywords">
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->

														</div>
														<div class="form-actions mt-10">
															<button type="submit" class="btn btn-success  mr-10"> Save</button>
															<button type="button" class="btn btn-default">Cancel</button>
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

					<!-- Row -->


	</div>
</div>
<script>
('#master').addClass("active");
$('#adminform').validate({ // initialize the plugin
    rules: {
        cat_name: {required: true,
          remote: {
                url: "<?php echo base_url(); ?>category/check_category",
                type: "post"
             }
           },
        cat_desc : {
           required: true,
       },

			cat_cover_img : {
			required: false,accept: "jpg,jpeg,png",filesize: 1048576,
		 },
			 cat_status : {
					required: true,accept: "jpg,jpeg,png",filesize: 1048576,
			}
    },
    messages: {
        cat_name: { required:"Enter the Category",remote:"Category name already exist" },
        cat_desc: { required:"Enter the Description"},
				cat_cover_img: { required:"Select cover image", accept:"Please upload .jpg or .png .",fileSize:"File must be JPG or PNG, less than 1MB"},
				cat_thumb_img: { required:"Select thumbnail image",accept:"Please upload .jpg or .png .",fileSize:"File must be JPG or PNG, less than 1MB"}


    }

});
</script>
