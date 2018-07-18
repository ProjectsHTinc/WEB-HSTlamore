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
							<li><a href="<?php echo base_url(); ?>category/"><span> Sub Category</span></a></li>
						<li class="active"><span>edit</span></li>
					  </ol>
					</div>
			</div>
		</div>
		<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Update  Category </h6>
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
													<?php  foreach($res as $rows){} ?>
													<form action="<?php echo base_url(); ?>category/update_sub_category" method="post" enctype="multipart/form-data" id="adminform" name="adminform">
														<div class="form-body">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Main Category</label>
																		<select class="form-control" data-placeholder="Choose a Status" tabindex="1" name="main_cat_id" id="main_cat_id">
																			<?php foreach($main_cat as $row_cat){ ?>
																					<option value="<?php  echo $row_cat->id; ?>"><?php echo $row_cat->category_name; ?></option>
																		<?php	} ?>
																		<script> $('#main_cat_id').val('<?php echo $rows->parent_id; ?>');</script>



																		</select>
																	</div>
																</div>
																<!--/span-->

																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Category Title</label>
																		<input type="text" id="firstName" name="cat_name" class="form-control" value="<?php echo $rows->category_name; ?>">
																		<input type="hidden" id="firstName" name="cat_id" class="form-control" value="<?php echo base64_encode($rows->id*9876); ?>">

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
																		<label class="control-label mb-10">change Cover image</label>
																		<input type="file" class="form-control" name="cat_cover_img" >
																		<input type="hidden" id="firstName" name="cat_cover_img_id" class="form-control" value="<?php echo $rows->category_image; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">

																	<?php if(empty($rows->category_image)){ ?>

																<?php 	}else{ ?>
																		<label class="control-label mb-10">Cover image</label><br>
																				<img src="<?php echo base_url(); ?>assets/category/<?php  echo $rows->category_image; ?>" style="width:100px;">
																	<?php	} ?>
																	<!-- <img src="<?php echo base_url(); ?>assets/category/<?php echo $rows->category_image; ?>" style="width:100px;"> -->
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Category Thumbnail</label>
																		<input type="file" class="form-control" name="cat_thumb_img" >
																			<input type="hidden" id="firstName" name="cat_thumb_img_id" class="form-control" value="<?php echo $rows->category_thumbnail; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">

																	<?php if(empty($rows->category_thumbnail)){ ?>

																<?php 	}else{ ?>
																		<label class="control-label mb-10">Thumbnail image</label><br>
																				<img src="<?php echo base_url(); ?>assets/category/thumbnail/<?php  echo $rows->category_thumbnail; ?>" style="width:100px;">
																	<?php	} ?>
																	<!-- <img src="<?php echo base_url(); ?>assets/category/thumbnail/<?php echo $rows->category_thumbnail; ?>" style="width:100px;"> -->
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Category Description</label>
																	<textarea class="form-control" placeholder="" name="cat_desc"><?php echo $rows->category_desc; ?></textarea>
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
																		<select class="form-control" data-placeholder="Choose a Status" tabindex="1" name="cat_status" id="cat_status">
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
																		<label class="control-label mb-10">Category Meta Title</label>
																		<input type="text" class="form-control" name="cat_meta_title" value="<?php echo $rows->category_meta_title; ?>">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Category Meta Desc</label>
																		<input type="text" class="form-control" name="cat_meta_desc" value="<?php echo $rows->category_meta_desc; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Category Keywords</label>
																		<input type="text" class="form-control" name="cat_meta_keywords" value="<?php echo $rows->category_keywords; ?>">
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->

														</div>
														<div class="form-actions mt-10">
															<button type="submit" class="btn btn-success  mr-10"> Update </button>
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



	</div>
</div>
<script>
('#master').addClass("active");
$('#adminform').validate({ // initialize the plugin
    rules: {
        cat_name: {required: true,
          remote: {
                url: "<?php echo base_url(); ?>category/check_category_exist/<?php echo base64_encode($rows->id*9876); ?>",
                type: "post"
             }
           },
        cat_desc : {
           required: true,
       },


			 cat_status : {
					required: true,
			}
    },
    messages: {
        cat_name: { required:"Enter the Category",remote:"Category name already exist" },
        cat_desc: { required:"Enter the Description"}



    }

});
</script>
