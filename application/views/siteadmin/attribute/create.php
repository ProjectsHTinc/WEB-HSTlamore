<style>
.form-control .error{
	border:1px solid red;
}
</style>
<div class="page-wrapper">
	<div class="container-fluid">
      <div class="row">
				<div class="row heading-bg bg-green">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-light">Attribute</h5>
					</div>

					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						 <li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
						<li><a href="<?php echo base_url(); ?>attribute"><span>Attribute</span></a></li>
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
										<h6 class="panel-title txt-dark">Create Attribute </h6>
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
													<form action="#" method="post" enctype="multipart/form-data" id="adminform" name="adminform">
														<div class="form-body">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Attribute Type</label>
																		<select class="form-control" data-placeholder="Choose a Attribute" tabindex="1" name="att_type" id="att_type">
																				<option value="">Select Attribute</option>
																				<option value="1">Size</option>
																				<option value="2">Color</option>

																		</select>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">

																</div>
																<!--/span-->
															</div>
															<div class="row" id="color_div">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Color Name</label>
																		<input type="text" id="color_name" name="color_name" class="form-control" placeholder="">

																	</div>
																</div>
															<div class="col-md-6">
																<label class="control-label mb-10 text-left">Color Value</label>
																<div id="cp3" class="colorpicker input-group colorpicker-component">
																	<input type="text" value="#00AABB" class="form-control"  id="attribute_color_value" name="attribute_color_value" />
																	<span class="input-group-addon"><i></i></span>
																</div>


																</div>
															</div>
															<div class="row" id="size_div">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Size</label>
																		<input type="text" id="attribute_size_value" name="attribute_size_value" class="form-control" placeholder="">

																	</div>
																</div>

															</div>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Status</label>
																		<select class="form-control" data-placeholder="Choose a Status" tabindex="1" name="att_status">
																			<option value="Active">Active</option>
																			<option value="Inactive">Inactive</option>

																		</select>
																	</div>
																</div>

															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-actions">
																		<button type="submit" class="btn btn-success  mr-10"> Save</button>
																		<button type="button" class="btn btn-default">Cancel</button>
																	</div>
																</div>
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
								<h6 class="panel-title txt-dark">List  of Attribute</h6>
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
													<th>Attribute type</th>
													<th>Value</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>S.no</th>
													<th>Attribute type</th>
													<th>Value</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>

												<?php $i=1; foreach($res as $rows){ ?>

												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $rows->attribute_type_name.'->'.$rows->attribute_name; ?></td>
														<td><?php echo $rows->attribute_value; ?></td>


													<td><?php if($rows->status=='Active'){ ?>
														<button class="btn  btn-success btn-rounded">Active</button>
													<?php }else{ ?>
														<button class="btn  btn-danger btn-rounded">Inactive</button>
												<?php 	} ?></td>
													<td><a href="<?php echo base_url(); ?>attribute/edit_attr/<?php  echo base64_encode($rows->id*9876); ?>"><i class="ti-pencil-alt"></i></a>

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



	</div>
</div>

<script>

$("#size_div").hide();
	$("#color_div").hide();
$('#att_type').on('change', function() {
		if ( this.value == '1')
		{
			$("#size_div").show();
			$("#color_div").hide();
		}
		else
		{
			$("#color_div").show();
			$("#size_div").hide();
		}
	});

$('#adminform').validate({
	  ignore: ":hidden",
    rules: {
        att_type: {required: true, },
        color_name : {
           required: true,
       },
			attribute_color_value : {required: true,},
			attribute_size_value : {required: true,},
			att_status : {required: true,}
    },
    messages: {
        att_type: { required:"Select attribute" },
				color_name: { required:"Select color" },
        attribute_color_value: { required:"Enter color code"},
				attribute_size_value: { required:"Enter size"},
		   	att_status: { required:"Select status"},
    },
    submitHandler: function(form) {
        $.ajax({
            url: "<?php echo base_url(); ?>attribute/create_attribute",
            type: 'POST',
            data: $('#adminform').serialize(),
            success: function(response) {
            if (response == "success") {
                  swal({
                  title: "Success",
                  text: "Added Successfully",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>attribute/';
              });

                } else{
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }

});
</script>
