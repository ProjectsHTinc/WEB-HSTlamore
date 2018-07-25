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
						<li><a href="<?php echo base_url(); ?>admin/zipcode"><span>Product </span></a></li>
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
										<h6 class="panel-title txt-dark">Add combined Products</h6>

									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">

													<form action="<?php echo base_url(); ?>productmaster/create_combined_products" method="post" name="comb_form" id="comb_form" enctype="multipart/form-data">
                            <div class="form-group">
                              <label class="control-label mb-10">Size</label>
                              <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="mas_size" id="mas_size">
                                <?php foreach($res_size as $row_size ){ ?>
                                  <option value="<?php echo  $row_size->id; ?>"><?php echo  $row_size->attribute_value; ?></option>
                              <?php	} ?>
                              </select>

                            </div>
                            <div class="form-group">
                              <label class="control-label mb-10">Color</label>
                              <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="mas_color" id="mas_color">
            										<?php foreach($res_color as $row_color ){ ?>
            											<option value="<?php echo  $row_color->id; ?>"><?php echo  $row_color->attribute_name; ?></option>
            									<?php	} ?>
            									</select>

                            </div>
                            <div class="form-group">
                              <label class="control-label mb-10">M.R.P</label>
                              <input type="text" id="prod_mrp_price" name="prod_mrp_price" class="form-control" placeholder="" value="">
                            </div>
                            <div class="form-group">
                              <label class="control-label mb-10">Actual Price</label>
                        <input type="text" id="prod_actual_price" name="prod_actual_price" class="form-control" placeholder="" value="">
                        <input type="hidden" id="product_id" name="product_id" class="form-control" placeholder="" value="<?php echo $this->uri->segment(3); ?>">
                            </div>
                            <div class="form-group">
                              <label class="control-label mb-10">Total Stocks</label>
                              <input type="text" id="total_stocks" name="total_stocks" class="form-control" placeholder="" value="">
                            </div>
                            <div class="form-group">
                              <label class="control-label mb-10">status</label>
                              <select class="form-control" data-placeholder="Choose a " tabindex="1" name="comb_status" id="comb_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                              </select>

                            </div>


														<button type="submit" class="btn btn-success mr-10">Create New   </button>

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
    mas_size: {required: true },
    mas_color: {  required: true },
    prod_actual_price:{required:true,digits: true},
    prod_mrp_price:{required:true,digits: true},
    comb_status:{required:true},
    total_stocks: {required: true,digits:true }
},
 messages: {
          mas_size: { required:"Select size" },
					mas_color: { required:"Select Color" },
					prod_mrp_price: { required:"Enter  M.R.P price"},
					prod_actual_price: { required:"Enter  actual price"},
					total_stocks: {required:"Enter total stocks" },
					comb_status:{required:"Select status"}
      }
      });

</script>
