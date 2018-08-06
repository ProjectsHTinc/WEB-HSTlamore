<script src="<?php echo base_url(); ?>dist/js/productorders-data.js"></script>

<div class="page-wrapper">
	<div class="container-fluid">
          <div class="row">
    				<div class="row heading-bg bg-blue">
    					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    					  <h5 class="txt-light">Products</h5>
    					</div>

    					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    					  <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
    							<li><a href="<?php echo base_url(); ?>admin/products"><span> Products</span></a></li>
    							<li class="active"><span>View </span></li>
    					  </ol>
    					</div>
    			</div>
    		</div>
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Product </h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display responsive product-overview mb-30" id="myTable">
												<thead>
													<tr>
														<th style="width:300px;">Name</th>
														<th>Sku code</th>
														<th>Category</th>
														<th>Cover img</th>
														<th>Total / Stocks left</th>
														<th>Price</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($res as $row_prod){  ?>
													<tr>
														<td><?php echo $row_prod->product_name; ?></td>
														<td><?php echo $row_prod->sku_code; ?></td>
														<td><?php echo $row_prod->category_name;echo "->";echo $row_prod->sub_cat; ?></td>
														<td>
															<?php if(empty($row_prod->product_cover_img)){ ?>

				                        <?php 	}else{ ?>
				                              <img src="<?php echo base_url(); ?>assets/products/<?php  echo $row_prod->product_cover_img; ?>" style="width:80px;">
				                            <?php	} ?>
														</td>

														<td><?php echo $row_prod->total_stocks; ?>&nbsp; / &nbsp;<?php echo $row_prod->stocks_left; ?></td>
														<td><?php echo $row_prod->prod_actual_price; ?></td>
														<td>
															<?php if($row_prod->status=='Active'){ ?>
																<span class="label label-success font-weight-100">Active</span>
															<?php }else{ ?>
																	<span class="label label-danger font-weight-100">Inactive</span>
															<?php } ?>

														</td>
														<td>
									<a href="<?php echo base_url(); ?>admin/products/<?php echo base64_encode($row_prod->id*9876); ?>" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit" ><i class="fa fa-pencil-square-o"></i>
									</a>
									<a href="<?php echo base_url(); ?>admin/product/review/<?php echo base64_encode($row_prod->id*9876); ?>" class="text-inverse" title="View Review" data-toggle="tooltip">	<i class="fa fa-navicon"></i></a>
								</td>
													</tr>
												<?php } ?>



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

</script>
