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
					  <h5 class="txt-light">Zip Code</h5>
					</div>

					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="">Dashboard</a></li>
						<li><a href="<?php echo base_url(); ?>admin/zipcode"><span>Zip Code</span></a></li>
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
										<h6 class="panel-title txt-dark">Create zip code  </h6>
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

															<div class="row" id="">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Zip code</label>
																		<input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="641001">

																	</div>
																</div>
															<div class="col-md-6">
																</div>
															</div>
															<div class="row" id="">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Excepted delivery description </label>
																	<textarea class="form-control" name="zip_desc" id="zip_desc" placeholder="Delivery in 3-6 days working days"></textarea>

																	</div>
																</div>
															<div class="col-md-6">
																</div>
															</div>


															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Status</label>
																		<select class="form-control" data-placeholder="Choose a Status" tabindex="1" name="zip_status" id="zip_status">
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
								<h6 class="panel-title txt-dark">List  of Zip Code</h6>
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
													<th>Zip Code </th>
													<th>Delivery description </th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>S.no</th>
													<th>Zip Code </th>
													<th>Delivery description </th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>

												<?php $i=1; foreach($res as $rows){ ?>

												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $rows->zip_code; ?></td>
														<td><?php echo $rows->zip_desc; ?></td>


													<td><?php if($rows->status=='Active'){ ?>
														<button class="btn  btn-success btn-rounded">Active</button>
													<?php }else{ ?>
														<button class="btn  btn-danger btn-rounded">Inactive</button>
												<?php 	} ?></td>
													<td><a href="<?php echo base_url(); ?>admin/zipcode/<?php  echo base64_encode($rows->id*9876); ?>"><i class="ti-pencil-alt"></i></a>

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
//
$('#adminform').validate({
	  ignore: ":hidden",
    rules: {
        zip_code : {
           required: true,digits:true,
					 remote: {
                 url: "<?php echo base_url(); ?>zipcodemaster/check_zip_code",
                 type: "post"
              }
       },
			zip_desc : {required: true},
			zip_status : {required: true,}
    },
    messages: {
        zip_code: { required:"Enter  Zip Code",remote:"Zip code alreaady exist" },
				zip_desc : {required: "Enter the excepted delievery ",},
		   	tag_status: { required:"Select status"},
    },
    submitHandler: function(form) {
        $.ajax({
            url: "<?php echo base_url(); ?>zipcodemaster/create_zip_code",
            type: 'POST',
            data: $('#adminform').serialize(),
            success: function(response) {
            if (response == "success") {
                  swal({
                  title: "Success",
                  text: "Added Successfully",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>admin/zipcode';
              });

                } else{
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }

});
</script>
