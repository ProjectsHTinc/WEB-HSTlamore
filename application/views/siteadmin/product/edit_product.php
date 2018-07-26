<script src="<?php echo base_url(); ?>assets/dist/jquery.formtowizard.js"></script>
<link href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bower_components/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/form-advance-data.js"></script>
<script src="<?php echo base_url(); ?>dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/dropzone/dist/dropzone.js"></script>
<!-- <script src="<?php echo base_url(); ?>dist/js/toast-data.js"></script> -->
<style>
.addmore{
	color:#fff;
}
</style>

<div class="page-wrapper">
	<div class="container-fluid">
      <div class="row">
				<div class="row heading-bg bg-green">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-light">Product </h5>
					</div>

					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="">Dashboard</a></li>
						<li><a href="<?php echo base_url(); ?>admin/zipcode"><span>Product </span></a></li>
						<li class="active"><span>Edit</span></li>
					  </ol>
					</div>
			</div>
		</div>


		<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Update Product information</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<?php foreach($res_prod as $rows_prod){} ?>
													<form action="#" method="post" name="prod_info" id="prod_info" enctype="multipart/form-data">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Product Info</h6>
															<hr>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product Name</label>
									                  <input type="text" id="color_name" name="product_name" class="form-control" value="<?php echo $rows_prod->product_name; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Sku Code</label>
									                  <input type="text" id="sku_code" name="sku_code" class="form-control"  value="<?php echo $rows_prod->sku_code; ?>">
																		 <input type="hidden" id="product_token" name="product_token" class="form-control"  value="<?php echo base64_encode($rows_prod->id*9876); ?>">
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Category</label>
																		<select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat_id" id="cat_id" onchange="getsubcat()">
																			<?php foreach($res_cat as $rows_cat){ ?>
																				<option value="<?php echo $rows_cat->id; ?>"><?php echo $rows_cat->category_name; ?></option>
																			<?php } ?>
									                  </select>
																		<script> $('#cat_id').val('<?php echo $rows_prod->cat_id; ?>');</script>

																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10 id_100 ">Sub Category</label>
																		<?php
																	 	$select="SELECT id,category_name FROM category_masters WHERE parent_id='$rows_prod->cat_id' AND status='Active'";
																		$res=$this->db->query($select);
																		$sub_cat_data=$res->result();
																		?>
																		<select class="form-control"  name="sub_cat_id" id="sub_cat_id">
																			<?php foreach($sub_cat_data as $rows_sub_cat){ ?>
																				<option value="<?php echo $rows_sub_cat->id; ?>"><?php echo $rows_sub_cat->category_name; ?></option>
																			<?php } ?>
									                  </select>
																			<script> $('#sub_cat_id').val('<?php echo $rows_prod->sub_cat_id; ?>');</script>
																	</span>



																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product Description</label>
									                    <textarea class="form-control" name="product_desc" id="product_desc"><?php echo $rows_prod->product_description; ?></textarea>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Delivery Fees </label>
	 						 										<select class="form-control" data-placeholder="Choose a Sub Category" tabindex="1" name="delivery_fee" id="delivery_fee">
	 						 										<option value="Not Available">Not Available</option>
	 						 										<option value="Available">Available</option>
	 						                   </select>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->

															<div class="seprator-block"></div>

															<h6 class="txt-dark capitalize-font"><i class="icon-notebook mr-10"></i>Product price details</h6>
															<hr>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product Actual Price<small class="notes">(Note : Actual Price)</small></label>
																			<input type="text" id="prod_actual_price" name="prod_actual_price" class="form-control"   value="<?php echo $rows_prod->prod_actual_price; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">M.R.P Price</label>
																		<input type="text" id="prod_mrp_price" name="prod_mrp_price" class="form-control" value="<?php echo $rows_prod->prod_mrp_price; ?>">
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Offer Percentage</label>
																			<input type="text" id="prod_offer_percentage" name="prod_offer_percentage" class="form-control"   value="<?php echo $rows_prod->offer_percentage; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product Return Policy</label>
																		<input type="text" id="prod_return_policy" name="prod_return_policy" class="form-control" placeholder="10 Days Return Policy"  value="<?php echo $rows_prod->prod_return_policy; ?>">
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product total Stocks</label>
																		<input type="text" id="prod_total_stocks" name="prod_total_stocks" class="form-control" placeholder=""  value="<?php echo $rows_prod->total_stocks; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product Minimum stocks remain</label>
																	<input type="text" id="prod_minimum_stocks" name="prod_minimum_stocks" class="form-control" placeholder="" value="<?php echo $rows_prod->min_stocks_status; ?>">
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Cash  on Delivery</label>
																		<select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="prod_cod" id="prod_cod">
																			<option value="Not Available">Not Available</option>
																			<option value="Available">Available</option>
																		</select>
																			<script> $('#prod_cod').val('<?php echo $rows_prod->prod_cod; ?>');</script>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product display </label>
																	<select class="form-control" data-placeholder="Choose a Sub Category" tabindex="1" name="prod_status" id="prod_status">
																		<option value="Active">Active</option>
																		<option value="Inactive">Inactive</option>
																	</select>
																			<script> $('#prod_status').val('<?php echo $rows_prod->status; ?>');</script>
																	</div>
																</div>
																<!--/span-->
															</div>

															<div class="seprator-block"></div>

															<h6 class="txt-dark capitalize-font"><i class="icon-notebook mr-10"></i>Meta Tags </h6>
															<hr>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product meta title</label>
																		<input type="text" id="prod_meta_title" name="prod_meta_title" class="form-control" placeholder=""  value="<?php echo $rows_prod->product_meta_title; ?>">
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Product meta keywords</label>
																	<input type="text" id="prod_meta_keywords" name="prod_meta_keywords" class="form-control" placeholder="" value="<?php echo $rows_prod->product_meta_keywords; ?>">
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label mb-10">Product meta description</label>
																	 <textarea class="form-control" name="product_meta_desc" id="product_meta_desc"><?php echo $rows_prod->product_meta_desc; ?></textarea>
																	</div>
																</div>

															</div>

														</div>
														<div class="form-actions mt-10">
															<button type="submit" class="btn btn-success  mr-10"> Update</button>
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


					<div class="row" id="cover">
								<div class="col-md-6">
									<div class="panel panel-default card-view">
										<div class="panel-heading">
											<div class="pull-left">
												<h6 class="panel-title txt-dark">Product Cover image</h6>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="panel-wrapper collapse in">
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 col-xs-12">
														<div class="form-wrap">
															<form class="form-horizontal" method="post" name="product_cover_img_form" id="product_cover_img_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>productmaster/upload_cover_img">
																<div class="form-group">
																	<div class="text-center">
																		<div class="input-group">
																		<img src="<?php echo base_url(); ?>assets/products/<?php echo $rows_prod->product_cover_img; ?>" style="width:100px;">
																			<input type="hidden" class="form-control" id="product_token"  name="product_token" value="<?php echo base64_encode($rows_prod->id*9876); ?>">
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-9">
																		<div class="input-group">
																			<input type="file" class="form-control" id="product_cover_img"  name="product_cover_img">
																		</div>
																	</div>
																</div>
																<div class="form-group mb-0">
																	<div class="col-sm-offset-3 col-sm-9">
																		<button type="submit" class="btn btn-info ">Update Cover images</button>
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

								<div class="col-md-6" id="">
									<div class="panel panel-default card-view">
										<div class="panel-heading">
											<div class="pull-left">
												<h6 class="panel-title txt-dark">Product size chart</h6>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="panel-wrapper collapse in">
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 col-xs-12">
														<div class="form-wrap">
															<form class="form-horizontal" method="post" name="prod_size_chart_form" id="prod_size_chart_form" action="<?php echo base_url(); ?>productmaster/upload_size_chart" enctype="multipart/form-data">
																<div class="form-group">
																	<div class="text-center">
																		<div class="input-group">
																			<?php if(empty($rows_prod->prod_size_chart)){
																				echo "No Image Found";
																			}else{ ?>
																				<img src="<?php echo base_url(); ?>assets/products/charts/<?php echo $rows_prod->prod_size_chart; ?>" style="width:100px;">
																		<?php 	} ?>
																			<input type="hidden" class="form-control" id="product_token"  name="product_token" value="<?php echo base64_encode($rows_prod->id*9876); ?>">
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-9">
																		<div class="input-group">
																			<input type="file" class="form-control" id="product_size_chart"  name="product_size_chart">
																		</div>
																	</div>
																</div>
																<div class="form-group mb-0">
																	<div class="col-sm-offset-3 col-sm-9">
																		<button type="submit" class="btn btn-info ">Update Size Chart</button>
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

					<!-- Row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">List  of  Combined Products</h6>
							</div>
							<div class="pull-right">
								<div class=" btn btn-info ">
									<a href="<?php echo base_url(); ?>admin/add_sub_product/<?php echo base64_encode($rows_prod->id*9876); ?>" class="addmore" id="combined">Add More</a>
								</div>
								<div class=" btn btn-danger ">
									<a  onclick="deletecomb('<?php echo base64_encode($rows_prod->id*9876); ?>')" class="addmore">Delete All </a>
							</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="table-wrap">
									<div class="table-responsive">
										<table id="datable_1" class="table table-hover display  pb-30" >
											<thead>
												<tr>
													<th>S.no</th>
													<th>Size</th>
													<th>Color</th>
													<th>Price</th>
													<th>Total Stocks / Left</th>
														<th>default</th>
													<th>status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>S.no</th>
													<th>Size</th>
													<th>Color</th>
													<th>Price</th>
													<th>Total Stocks / Left</th>
													<th>default</th>
													<th>status</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>
												<?php $i=1; foreach($res_comb as $rows_comb){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $rows_comb->size; ?></td>
													<td><?php echo $rows_comb->attribute_name; ?></td>
													<td><?php echo $rows_comb->prod_actual_price; ?></td>
													<td><?php echo $rows_comb->total_stocks; ?> / <?php echo $rows_comb->stocks_left; ?></td>
													<td>	<?php if($rows_comb->prod_default=='1'){ ?>
														<span class="pe-7s-cart"></span>
												<?php	}else{

													} ?></td>
													<td><?php if($rows_comb->status=='Active'){ ?>
														<button class="btn  btn-success btn-rounded">Active</button>
													<?php }else{ ?>
														<button class="btn  btn-danger btn-rounded">Inactive</button>
												<?php 	} ?></td>
													<!-- <td><a data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $rows_comb->id; ?>" data-productid="<?php echo $rows_comb->product_id; ?>" ><i class="ti-pencil-alt"></i></a> -->
															<td><a  href="<?php echo base_url(); ?>admin/edit_combined_products/<?php echo base64_encode($rows_comb->id*9876); ?>" ><i class="ti-pencil-alt"></i></a>
												</td>
												</tr>
						<?php	 $i++; }  ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Row -->


			<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">List  of  Specification</h6>
					</div>
					<div class="pull-right">
						<div class=" btn btn-info ">
							<a href="<?php echo base_url(); ?>admin/add_specification/<?php echo base64_encode($rows_prod->id*9876); ?>" class="addmore" id="specs">Add More Specs</a>
						</div>
						<div class=" btn btn-danger ">
							<a  onclick="deletecomb('<?php echo base64_encode($rows_prod->id*9876); ?>')" class="addmore">Delete All </a>
					</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="table-wrap">
							<div class="table-responsive">
								<table id="datable_2" class="table table-hover display  pb-30" >
									<thead>
										<tr>
											<th>S.no</th>
											<th>Specification Name</th>
											<th>Value</th>
											<th>status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>S.no</th>
											<th>Specification Name</th>
											<th>Value</th>
											<th>status</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										<?php $i=1; foreach($res_spec as $rows_spec){ ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $rows_spec->spec_name; ?></td>
											<td><?php echo $rows_spec->spec_value; ?></td>

											<td><?php if($rows_spec->status=='Active'){ ?>
												<button class="btn  btn-success btn-rounded">Active</button>
											<?php }else{ ?>
												<button class="btn  btn-danger btn-rounded">Inactive</button>
										<?php 	} ?></td>

													<td><a  href="<?php echo base_url(); ?>admin/edit_specifcation/<?php echo base64_encode($rows_spec->id*9876); ?>" ><i class="ti-pencil-alt"></i></a>
										</td>
										</tr>
				<?php	 $i++; }  ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->

	<!-- Row -->
<div class="row" id="tags">
<div class="col-sm-12">
	<div class="panel panel-default card-view">
		<div class="panel-heading">
			<div class="pull-left">
				<h6 class="panel-title txt-dark">List  of  tags</h6>
			</div>
			<div class="pull-right">
				<div class=" btn btn-info ">
					<a  href="<?php echo base_url(); ?>admin/add_tags/<?php echo base64_encode($rows_prod->id*9876); ?>" class="addmore" id="specs">Add tags </a>
				</div>

			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-wrapper collapse in">
			<div class="panel-body">
				<div class="table-wrap">
					<?php foreach($res_prod_tag as $rows_tag_name){ ?>
							<button class="btn btn-warning btn-rounded btn-lable-wrap right-label" onclick="delete_tags('<?php echo base64_encode($rows_tag_name->id*9876); ?>')"><span class="btn-text"><?php echo $rows_tag_name->tag_name; ?></span> <span class="btn-label"><i class="fa fa-times"></i> </span></button>
				<?php	} ?>



				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- /Row -->

<!-- Row -->
			<div class="row" id="gallery">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Product Gallery </h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<p class="text-muted">Drag and Drop the multiple image files here </p>
								<div class="mt-40">
									<form action="<?php echo base_url(); ?>productmaster/product_gallery" method="post" name="prod_gallery_form" id="prod_gallery_form" enctype="multipart/form-data">
										<div class="form-group">
											<div class="field" align="left">
									  <h3>Upload your images</h3>
									  <input type="file" id="files" name="files[]" multiple  required/>
										</div>
										  <input type="hidden" id="product_token" name="product_token" value="<?php echo base64_encode($rows_prod->id*9876); ?>" accept="image/*"/>
										</div>
										<div class="form-group">
										</div>
										<button type="submit" class="btn btn-success mr-10">Update </button>
									</form>
									<p class="text-muted">Gallery images  </p>
									<div class="row">
										<?php  foreach($res_galley as $rows_gallery){  ?>
	       				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
							<div class="panel panel-default card-view pa-0">
								<div class="panel-wrapper collapse in">
									<div class="panel-body pa-0">
										<article class="col-item">
											<div class="photo">
												<div class="options">


													<button class="btn btn-info btn-icon-anim btn-circle" onclick="delete_gallery('<?php echo base64_encode($rows_gallery->id*9876); ?>')"><i class="icon-trash"></i></button>
												</div>

												<a href="#"> <img src="<?php echo base_url(); ?>assets/products/images/<?php echo $rows_gallery->gallery_img; ?>" class="img-responsive" alt="Product Image"> </a>
											</div>

										</article>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>



					</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Row -->



  </div>
</div>
<style>
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.col-item .photo img{
	width: 100%;
	height: 200px;
}
</style>
<script>
 $('#datable_2').DataTable();
 if (window.File && window.FileList && window.FileReader) {
	$("#files").on("change", function(e) {
		var files = e.target.files,
			filesLength = files.length;
		for (var i = 0; i < filesLength; i++) {
			var f = files[i]
			var fileReader = new FileReader();
			fileReader.onload = (function(e) {
				var file = e.target;
				$("<span class=\"pip\">" +
					"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
					"<br/>" +
					"</span>").insertAfter("#files");




			});
			fileReader.readAsDataURL(f);
		}
	});
} else {
	alert("Your browser doesn't support to File API")
}

function delete_gallery(prod_gall_id){
	var gal_id=prod_gall_id;
			swal({
		title: "Are you sure?",
		text: "You want to delete image",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, I am sure!',
		cancelButtonText: "No, cancel it!"
 }).then(
			 function () {
				 $.ajax({
						 url: "<?php echo base_url(); ?>productmaster/get_delete_prod_gallery",
						 type: 'POST',
						data:{gal_id:gal_id},
						 success: function(response) {
						 //	alert(response);
						 if (response == "success") {
							 $.toast({
										 heading: 'Tag Deleted',
										 text: 'Product images deleted Successfully',
										 position: 'top-right',
										 loaderBg:'#3cb878',
										icon: 'success',
										hideAfter: 3500,
										 stack: 6
									 });
									 $("#gallery").load(location.href+" #gallery>*","");
								 } else{
										 sweetAlert("Oops...", response, "error");
								 }
						 }
				 });
			 },
			 function () { return false; });
}


function delete_tags(tag_id){
	var tag_id=tag_id;
			swal({
    title: "Are you sure?",
    text: "You want to delete tag",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!"
 }).then(
       function () {
				 $.ajax({
						 url: "<?php echo base_url(); ?>productmaster/get_delete_prod_tags",
						 type: 'POST',
						data:{tag_id:tag_id},
						 success: function(response) {
						 //	alert(response);
						 if (response == "success") {
							 $.toast({
										 heading: 'Tag Deleted',
										 text: 'Product tag deleted Successfully',
										 position: 'top-right',
										 loaderBg:'#3cb878',
										icon: 'success',
										hideAfter: 3500,
										 stack: 6
									 });
									 $("#tags").load(location.href+" #tags>*","");
								 } else{
										 sweetAlert("Oops...", response, "error");
								 }
						 }
				 });
			 },
       function () { return false; });
}



function deletecomb(a_id){
	var prod_id=a_id;
			swal({
    title: "Are you sure?",
    text: "You want to delete all combined products",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!"
 }).then(
       function () {
				 $.ajax({
						 url: "<?php echo base_url(); ?>productmaster/get_delete_sub_prod",
						 type: 'POST',
						data:{prod_id:prod_id},
						 success: function(response) {
						 //	alert(response);
						 if (response == "success") {
							 $.toast({
										 heading: 'Product',
										 text: 'Product Deleted Successfully',
										 position: 'top-right',
										 loaderBg:'#3cb878',
										icon: 'success',
										hideAfter: 3500,
										 stack: 6
									 });
									  window.setTimeout(function(){location.reload()},2000)
								 } else{
										 sweetAlert("Oops...", response, "error");
								 }
						 }
				 });
			 },
       function () { return false; });

}

		function getsubcat(){
			var cat_id=$('#cat_id').val();
							    $.ajax({
							    url:'<?php echo base_url(); ?>productmaster/get_sub_cat_id',
							    method:"POST",
							    data:{cat_id:cat_id},
							    dataType: "JSON",
							    cache: false,
							    success:function(data)
							    {
							    var stat=data.status;
							    $("#sub_cat_id").empty();
							    if(stat=="success"){
							    var res=data.sub_cat_id;
							    // alert(res.length);
							    var len=res.length;
									 $('<option>').val('').text('Select').appendTo('#sub_cat_id');
							    for (i = 0; i < len; i++) {
							    $('<option>').val(res[i].id).text(res[i].category_name).appendTo('#sub_cat_id');
							    }

							    }else{
							    $("#sub_cat_id").empty();
							    }
							    }
							    });
		}

			$.validator.addMethod('le', function (value, element, param) {
			    return this.optional(element) || parseInt(value) <= parseInt($(param).val());
			}, 'lesser than total stocks');

		$("#prod_info").validate({
			ignore: ":hidden",
		rules: {
       	product_name: {required: true,    remote: {
	                url: "<?php echo base_url(); ?>productmaster/check_product_name_exist/<?php echo base64_encode($rows_prod->id*9876); ?>",
	                type: "post"
	             }
						  },
        sku_code: {  required: true,remote: {
	                url: "<?php echo base_url(); ?>productmaster/check_sku_code_exist/<?php echo base64_encode($rows_prod->id*9876); ?>",
	                type: "post"
	             }
						  },
				cat_id: {required: true },
				product_desc: {  required: true },
				prod_actual_price:{required:true,digits: true},
				prod_mrp_price:{required:true,digits: true},
				prod_return_policy: {required: true },
				prod_stock_left: {required: true },
				prod_meta_title: {required: true },
				prod_meta_keywords: {required: true },
				product_meta_desc: {required: true },
				prod_total_stocks: {required: true,digits:true },
				prod_minimum_stocks:{required:true,digits:true,le: '#prod_total_stocks' }

		},
      messages: {
          product_name: { required:"Enter  product name",remote:"Product name already exist" },
					prod_meta_title: { required:"Enter  meta title"},
					prod_meta_keywords: { required:"Enter  meta keywords"},
					product_meta_desc: { required:"Enter meta description"},
					product_desc: { required:"Enter  product description" },
          sku_code: { required:"Enter  SKU CODE",remote:"sku code already exist"},
					prod_mrp_price: { required:"Enter  m.r.p price"},
					prod_actual_price: { required:"Enter  actual price"},
					prod_return_policy: { required:"Enter  Return Policy"},
					prod_total_stocks: {required:"Enter total stocks" },
					prod_minimum_stocks:{required:"Enter minimum stocks to remain"},
					cat_id:{required:"Select Category"}
      },
		submitHandler: function (form) {
			$.ajax({
					url: "<?php echo base_url(); ?>productmaster/update_prod_info",
					type: 'POST',
					data: $('#prod_info').serialize(),
					success: function(response) {
					//	alert(response);
					if (response == "success") {
						$.toast({
									heading: 'Product',
									text: 'Product updated Successfully',
									position: 'top-right',
									loaderBg:'#3cb878',
								 icon: 'success',
								 hideAfter: 3500,
									stack: 6
								});
							} else{
									sweetAlert("Oops...", response, "error");
							}
					}
			});
		}
});


function getsubcat(){
	var cat_id=$('#cat_id').val();

					    $.ajax({
					    url:'<?php echo base_url(); ?>productmaster/get_sub_cat_id',
					    method:"POST",
					    data:{cat_id:cat_id},
					    dataType: "JSON",
					    cache: false,
					    success:function(data)
					    {
					    var stat=data.status;
					    $("#sub_cat_id").empty();
					    if(stat=="success"){
					    var res=data.sub_cat_id;
					    // alert(res.length);
					    var len=res.length;
							 $('<option>').val('').text('Select').appendTo('#sub_cat_id');
					    for (i = 0; i < len; i++) {
					    $('<option>').val(res[i].id).text(res[i].category_name).appendTo('#sub_cat_id');
					    }

					    }else{
					    $("#sub_cat_id").empty();
					    }
					    }
					    });
}

		$("#product_cover_img_form").validate({
			  ignore: ":hidden",
				rules: {
				  	product_cover_img: {required: true,accept: "jpg,jpeg,png"  }
					},
			 	messages: {
			    	product_cover_img: { required:"Select images",accept:"Please upload .jpg or .png ." }
			      }
      });
			$("#prod_size_chart_form").validate({
					ignore: ":hidden",
					rules: {
							product_size_chart: {required: true,accept: "jpg,jpeg,png"  }
						},
					messages: {
							product_size_chart: { required:"Select images",accept:"Please upload .jpg or .png ." }
							}
				});

				$("#product_gallery_form").validate({
						ignore: ":hidden",
						rules: {
								'files[]': {"required": true},
							},
						messages: {
								"files[]": { required:"Select images",accept:"Please upload .jpg or .png ." }
								}
					});

  </script>
