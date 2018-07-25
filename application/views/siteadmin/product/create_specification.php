<style>
.alert-danger{
	color: #fff;
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
						<li><a href="<?php echo base_url(); ?>admin/view_products"><span>Product </span></a></li>
						<li><a href="">Specification</a></li>
						<li class="active"><span>Create </span></li>
					  </ol>
					</div>
			</div>
		</div>
		<?php
		$in = $this->session->flashdata('in');
		if($in=='already exist'){ ?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Already! exists.
			</div>
	<?php 		}else{

					}

		?>
    <div class="row">
						<div class="col-md-8">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Add Specification</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">

													<form action="<?php echo base_url(); ?>productmaster/create_specification" method="post" name="comb_form" id="comb_form" enctype="multipart/form-data">
                            <div class="form-group">
                              <label class="control-label mb-10">Size</label>
                              <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="spec_id" id="spec_id">
                                <?php foreach($res_specs as $row_specs ){ ?>
                                  <option value="<?php echo  $row_specs->id; ?>"><?php echo  $row_specs->spec_name; ?></option>
                              <?php	} ?>
                              </select>
                            </div>
														<div class="form-group">
                              <label class="control-label mb-10">Specification Description</label>
                    						<textarea class="form-control" name="spec_value" id="spec_value"></textarea>
                        				<input type="hidden" id="product_id" name="product_id" class="form-control" placeholder="" value="<?php echo $this->uri->segment(3); ?>">
                            </div>
                            <div class="form-group">
                              <label class="control-label mb-10">status</label>
                              <select class="form-control" data-placeholder="Choose a " tabindex="1" name="spec_status" id="spec_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                              </select>
                            </div>
														<button type="submit" class="btn btn-success mr-10">Create Specification </button>
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
$("#comb_form").validate({
  ignore: ":hidden",
rules: {
    spec_id: {required: true },
    spec_value: {  required: true },
    spec_status:{required:true}
},
 messages: {
          spec_id: { required:"Select Specification" },
					spec_value: { required:"Enter  description"},
					spec_status:{required:"Select status"}
      }
      });

</script>
