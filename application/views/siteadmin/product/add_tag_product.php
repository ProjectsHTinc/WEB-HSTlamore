<script src="<?php echo base_url(); ?>assets/dist/jquery.formtowizard.js"></script>
<link href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/form-advance-data.js"></script>
<script src="<?php echo base_url(); ?>dist/js/dropdown-bootstrap-extended.js"></script>


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
						<li class="active"><span>Add Tags </span></li>
					  </ol>
					</div>
			</div>
		</div>



                <div class="row">
    							<div class="col-md-6">
    							<div class="panel panel-default card-view">
    								<div class="panel-heading">
    									<div class="pull-left">
    										<h6 class="panel-title txt-dark">Multiple Tags </h6>
    									</div>
    									<div class="clearfix"></div>
    								</div>
              <form action="<?php echo base_url(); ?>productmaster/add_tag_product" method="post" name="comb_form" id="comb_form" enctype="multipart/form-data">
    								<div class="panel-wrapper collapse in">
    									<div class="panel-body">
    										<p class="text-muted"> Add Tags to Product <code>While searching it is Usefull</code> </p>
    										<div class="row mt-40">
    											<div class="col-sm-12">
    												<h5 class="box-title"></h5>
    												<select id='pre-selected-options' multiple='multiple' name="product_tags[]">
    													<?php foreach($res_tag_value as $rows_tag){ ?>
    															<option value='<?php echo $rows_tag->id; ?>'><?php echo $rows_tag->tag_name; ?></option>
    													<?php } ?>
    												</select>
                            <input type="hidden" name="product_token" id="product_token" value="<?php echo 	$prod_id=$this->uri->segment(3); ?>">
    											</div>
    										</div>
                        <p class="pull-right" style="margin-top:20px;">
                            <button id="SaveAccount" class="btn btn-primary submit">Add tags</button>
                        </p>
    									</div>

    								</div>
                  </form>

    							</div>
    						</div>
                  <div class="col-md-6">

                  </div>
                </div>

  </div>
</div>
<script>
$("#comb_form").validate({
  ignore: ":hidden",
rules: {
    	'product_tags[]': {"required": true}

},
 messages: {
        	'product_tags[]': {"required": "select tags"},
      }
      });

</script>
