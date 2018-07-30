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
						<li class="active"><span>Create</span></li>
					  </ol>
					</div>
			</div>
		</div>


    <div class="row">
      <div class="col-lg-12">

    <div id='progress'><div id='progress-complete'></div></div>

    <form id="SignupForm" action="<?php echo base_url(); ?>productmaster/create" method="post" enctype="multipart/form-data" name="SignupForm">
        <fieldset>
            <legend>Product  information</legend>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Product Name</label>
                  <input type="text" id="color_name" name="product_name" class="form-control" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Sku Code</label>
                  <input type="text" id="sku_code" name="sku_code" class="form-control" placeholder="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Category</label>
                  <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat_id" id="cat_id" onchange="getsubcat()">
											<option value="">--select--</option>
										<?php foreach($res_cat as $rows_cat){ ?>
											<option value="<?php echo $rows_cat->id; ?>"><?php echo $rows_cat->category_name; ?></option>
										<?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Sub Category</label>
                  <select class="form-control" data-placeholder="Choose a Sub Category" tabindex="1" name="sub_cat_id" id="sub_cat_id">
                    <option value="Active"></option>

                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Product Description</label>
                    <textarea class="form-control" name="product_desc" id="product_desc"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
									  <label class="control-label mb-10">Delivery Fees </label>
									<select class="form-control" data-placeholder="Choose a Sub Category" tabindex="1" name="delivery_fee" id="delivery_fee">
										<option value="Not Available">Not Available</option>
										<option value="Available">Available</option>

                  </select>
                </div>
              </div>
            </div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label mb-10">Product Cover image</label>
										  <input type="file" id="product_cover_img" name="product_cover_img"  placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label mb-10">Product Size Chart</label>
											<input type="file" id="product_size_chart" name="product_size_chart"  placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label mb-10">Product Actual Price<small class="notes">(Note : Actual Price)</small></label>
										<input type="text" id="prod_actual_price" name="prod_actual_price" class="form-control"  placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label mb-10">M.R.P Price</label>
									<input type="text" id="prod_mrp_price" name="prod_mrp_price" class="form-control" placeholder="">
								</div>
							</div>
						</div>
						<div class="row">
								<div class="col-md-6">
							<div class="form-group mb-30">
									<label class="control-label mb-10 text-left">Checkbox</label>
									<div class="checkbox checkbox-success">
										<input id="checkbox3" type="checkbox" onchange="valueChanged()" class="combined_status" name="combined_status" value="1">
										<label for="checkbox3">
											Combined Products
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-6"></div>
						</div>

						<div class="com_div" id="com_div">
						<div class="row" id="">
						<a id="append" class="plus_more_text"><i class="fa fa-plus-circle"></i></a>
						<div class="form-group">
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label mb-10">Select Size</label>
									<select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="mas_size[]" id="mas_size">
										<?php foreach($res_size as $row_size ){ ?>
											<option value="<?php echo  $row_size->id; ?>"><?php echo  $row_size->attribute_value; ?></option>
									<?php	} ?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label mb-10">Select Color</label>
									<select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="mas_color[]" id="mas_color">
										<?php foreach($res_color as $row_color ){ ?>
											<option value="<?php echo  $row_color->id; ?>"><?php echo  $row_color->attribute_name; ?></option>
									<?php	} ?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label mb-10">M.R.P Price</label>
									<input type="text" id="prod__comb_mrp_price_1" name="prod_comb_mrp_price[]" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label mb-10">Actual  Price</label>
									<input type="text" id="prod_comb_actual_price_1" name="prod_comb_actual_price[]" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label mb-10">Total Stocks</label>
									<input type="text" id="prod_comb_total_stocks_1" name="prod_comb_total_stocks[]" class="form-control"  placeholder="">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label"></label>
									<div class="">
												<input type="radio" name="prod_default[]" id="prod_default_1" value="1" checked >
												<label for="radio1">Set as Default</label>
									</div>
								</div>
							</div>
					</div>
						</div>
						<div class="inc">
						</div>
						</div>



						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label mb-10">Offer Percentage</label>
										<input type="text" id="prod_offer_percentage" name="prod_offer_percentage" class="form-control"  placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label mb-10">Product Return Policy</label>
									<input type="text" id="prod_return_policy" name="prod_return_policy" class="form-control" placeholder="10 Days Return Policy">
								</div>
							</div>
						</div>


        </fieldset>

        <fieldset>
            <legend>Social Meta Tags</legend>


            <div class="row">
							<div class="col-md-6">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Multiple Tags </h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<p class="text-muted"> Add Tags to Product <code>While searching it is Usefull</code> </p>
										<div class="row mt-40">
											<div class="col-sm-12">
												<h5 class="box-title"></h5>
												<select id='pre-selected-options' multiple='multiple' name="product_tags[]">
													<?php foreach($res_tags as $rows_tag){ ?>
															<option value='<?php echo $rows_tag->id; ?>'><?php echo $rows_tag->tag_name; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
              <div class="col-md-6">

              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Product Meta title</label>
                  <input type="text" id="prod_meta_title" name="prod_meta_title" class="form-control" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Product Meta Keywords</label>
                  <input type="text" id="prod_meta_keywords" name="prod_meta_keywords" class="form-control" placeholder="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label mb-10">Product Meta Description</label>
                <textarea class="form-control" name="product_meta_desc" id="product_meta_desc"></textarea>
                </div>
              </div>
              <div class="col-md-6">

              </div>
            </div>
        </fieldset>

        <fieldset class="form-horizontal" role="form">
        <legend>Product details</legend>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Product total Stocks</label>
							<input type="text" id="prod_total_stocks" name="prod_total_stocks" class="form-control" placeholder="">
						</div>
					</div>
					<div class="col-md-6">
						<!-- <div class="form-group">
								<label class="control-label mb-10">Product Minimum stocks remain</label>
							<input type="text" id="prod_minimum_stocks" name="prod_minimum_stocks" class="form-control" placeholder="">
						</div> -->
						<label class="control-label mb-10">Product display </label>
					<select class="form-control" data-placeholder="Choose a Sub Category" tabindex="1" name="prod_status" id="prod_status">
						<option value="Active">Active</option>
						<option value="Inactive">Inactive</option>
					</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label mb-10">Cash  on Delivery</label>
							<select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="prod_cod" id="prod_cod">
								<option value="Not Available">Not Available</option>
								<option value="Available">Available</option>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">

						</div>
					</div>
				</div>


        </fieldset>
        <p>
            <button id="SaveAccount" class="btn btn-primary submit">Create Product</button>
        </p>
      </form>
    </div>
  </div>





  </div>
</div>
<style>
.form-horizontal .form-group{
	margin-left: 0px;
	margin-right: 0px;
}
.notes{
	color: red;
}
.plus_more_text{
	font-size: 30px;
	margin-left: 20px;
}
.remove_this{
		font-size: 20px;
		margin-left: 20px;
}
#steps { margin: 80px 0 0 0 }
      .commands { overflow: hidden; margin-top: 30px; }
      .prev {float:left}
      .next, .submit {float:right}
      .error { color: #b33; }
      #progress { position: relative; height: 5px; background-color: #fff; margin-bottom: 20px; }
      #progress-complete { border: 0; position: absolute; height: 5px; min-width: 10px; background-color: #337ab7; transition: width .2s ease-in-out; }
</style>
<script>

var numberIncr = 2;
$("#append").click( function(e) {

          e.preventDefault();

        $(".inc").append('<div class="row com_div" id="com_div"><a href="#" class="remove_this"><i class="fa fa-minus-circle"></i></a><div  class="form-group"><div class="col-md-2"><div class="form-group"><label class="control-label mb-10">Select Size</label><select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="mas_size[]" id="mas_size"><?php foreach($res_size as $row_size){ ?><option value="<?php echo $row_size->id;?>"><?php echo $row_size->attribute_value; ?></option><?php } ?></select></div></div><div class="col-md-2"><div class="form-group"><label class="control-label mb-10">Select Color</label><select class="form-control" data-placeholder="Choose a Color" tabindex="1" name="mas_color[]" id="mas_color"><?php foreach($res_color as $row_color ){ ?><option value="<?php echo  $row_color->id; ?>"><?php echo  $row_color->attribute_name; ?></option><?php } ?></select></div></div><div class="col-md-2"><div class="form-group"><label class="control-label mb-10">M.R.P Price</label><input type="text" id="prod_comb_mrp_price_' + numberIncr + '" name="prod_comb_mrp_price[]" class="form-control" placeholder=""></div></div><div class="col-md-2"><div class="form-group"><label class="control-label mb-10">Actual Price</label><input type="text" id="prod_comb_actual_price_' + numberIncr + '" name="prod_comb_actual_price[]" class="form-control" placeholder=""></div></div><div class="col-md-2"><div class="form-group"><label  class="control-labelmb-10">Total Stocks</label><input type="text" id="prod_comb_total_stocks_' + numberIncr + '" name="prod_comb_total_stocks[]" class="form-control prod_comb_total_stocks" placeholder="" required="required"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label"></label><div class=""><input type="radio" name="prod_default[]" id="prod_default" value="1" required><label for="radio1">Set as Default</label> </div></div></div></div></div>');


				// $('#prod_comb_mrp_price').rules('add',  { required: true });
				// $('#prod_comb_actual_price').rules('add',  { required: true });
				// $('#prod_comb_total_stocks_'+ numberIncr +'').rules('add',  { required: true });
 numberIncr++;
        return false;
        });
				jQuery(document).on('click', '.remove_this', function() {
			 jQuery(this).parent().remove();
			 return false;
			 });
function valueChanged()
{
    if($('.combined_status').is(":checked"))
    $('#com_div').show();
    else
    $('#com_div').hide();
}

$('#com_div').hide();
      $( function() {
          var $signupForm = $( '#SignupForm' );

          $signupForm.validate({errorElement: 'em'});

          $signupForm.formToWizard({
              submitButton: 'SaveAccount',
              nextBtnClass: 'btn btn-primary next',
              prevBtnClass: 'btn btn-default prev',
              buttonTag:    'button',
              validateBeforeNext: function(form, step) {
                  var stepIsValid = true;
                  var validator = form.validate();
                  $(':input', step).each( function(index) {
                      var xy = validator.element(this);
                      stepIsValid = stepIsValid && (typeof xy == 'undefined' || xy);
                  });
                  return stepIsValid;
              },
              progress: function (i, count) {
                  $('#progress-complete').width(''+(i/count*100)+'%');
              }
          });
      });


			$.validator.addMethod('le', function (value, element, param) {
			    return this.optional(element) || parseInt(value) <= parseInt($(param).val());
			}, 'lesser than total stocks');

		$("#SignupForm").validate({
			ignore: ":hidden",
		rules: {
       	product_name: {required: true,    remote: {
	                url: "<?php echo base_url(); ?>productmaster/check_product_name",
	                type: "post"
	             }
						  },
        sku_code: {  required: true,remote: {
	                url: "<?php echo base_url(); ?>productmaster/check_sku_code",
	                type: "post"
	             }
						  },
				cat_id: {required: true },
				product_desc: {  required: true },
		 		product_cover_img: {required: true,accept: "jpg,jpeg,png" },
				prod_actual_price:{required:true,number: true},
				prod_mrp_price:{required:true,number: true},
				prod_return_policy: {required: true },
				prod_stock_left: {required: true },

				prod_meta_title: {required: true },
				prod_meta_keywords: {required: true },
				product_meta_desc: {required: true },
				prod_total_stocks: {required: true,digits:true },
				prod_minimum_stocks:{required:false,digits:true,le: '#prod_total_stocks' },
				"prod_default[]": "required",
				'prod_comb_actual_price[]': {"required": true,number: true},
				'prod_comb_mrp_price[]': {"required": true,number: true},
				'product_tags[]': {"required": true},
				'prod_comb_total_stocks[]':{"required": true,digits: true}
		},
      messages: {
          product_name: { required:"Enter  product name",remote:"Product name already exist" },
					product_desc: { required:"Enter  product description" },
          sku_code: { required:"Enter  SKU CODE",remote:"sku code already exist"},
					prod_mrp_price: { required:"Enter  m.r.p price"},
					prod_actual_price: { required:"Enter  actual price"},
					prod_return_policy: { required:"Enter  Return Policy"},
					prod_meta_title: { required:"Enter  meta title"},
					prod_meta_keywords: { required:"Enter  meta keywords"},
					product_meta_desc: { required:"Enter meta description"},

					prod_total_stocks: {required:"Enter total stocks" },
					prod_minimum_stocks:{required:"Enter minimum stocks to remain"},

					cat_id:{required:"Select Category"},
					'product_tags[]': {"required": "Select tags"},
					'prod_comb_actual_price[]': {"required": "enter actual price"},
					'prod_comb_mrp_price[]': {"required": "enter the mrp price"},
					product_cover_img:{required:"Select cover image", accept:"Please upload .jpg or .png .",fileSize:"File must be JPG or PNG, less than 200kb"}

      }
		// submitHandler: function (form) {
		// 		alert("Validation Success!");
		// 		return false; // if you need to block normal submit because you used ajax
		// }
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

  </script>
