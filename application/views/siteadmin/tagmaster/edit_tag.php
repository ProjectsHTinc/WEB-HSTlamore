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
					  <h5 class="txt-light">Tags</h5>
					</div>

					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="">Dashboard</a></li>
						<li><a href="<?php echo base_url(); ?>admin/tags"><span>Tags</span></a></li>
						<li class="active"><span>Update</span></li>
					  </ol>
					</div>
			</div>
		</div>
		<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Update Tag </h6>
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
													<?php foreach($res as $rows){} ?>
													<form action="#" method="post" enctype="multipart/form-data" id="adminform" name="adminform">
														<div class="form-body">

															<div class="row" id="">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Specification Name</label>
												<input type="text" id="tag_name" name="tag_name" class="form-control" placeholder="" value="<?php echo $rows->tag_name; ?>">
												<input type="hidden" id="tag_id" name="tag_id" class="form-control"  value="<?php echo base64_encode($rows->id*9876); ?>">

																	</div>
																</div>
															<div class="col-md-6">
																</div>
															</div>


															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label mb-10">Status</label>
																		<select class="form-control" data-placeholder="Choose a Status" tabindex="1" name="tag_status" id="tag_status">
																			<option value="Active">Active</option>
																			<option value="Inactive">Inactive</option>

																		</select>
																			<script> $('#tag_status').val('<?php echo $rows->status; ?>');</script>
																	</div>
																</div>

															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-actions">
																		<button type="submit" class="btn btn-success  mr-10"> Update</button>
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




	</div>
</div>

<script>

$('#adminform').validate({
	  ignore: ":hidden",
    rules: {
        tag_name : {
           required: true,
					 remote: {
                 url: "<?php echo base_url(); ?>tagmaster/check_tag_exist/<?php echo  base64_encode($rows->id*9876); ?>",
                 type: "post"
              }
       },

			tag_status : {required: true,}
    },
    messages: {
        tag_name: { required:"Enter  Tag",remote:"Tag Name Alreaady Exist" },
		   	tag_status: { required:"Select status"},
    },
    submitHandler: function(form) {
        $.ajax({
            url: "<?php echo base_url(); ?>tagmaster/update_tag",
            type: 'POST',
            data: $('#adminform').serialize(),
            success: function(response) {
            if (response == "success") {
                  swal({
                  title: "Success",
                  text: "Updated Successfully",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>admin/tags';
              });

                } else{
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }

});
</script>
