<script src="<?php echo base_url(); ?>dist/js/productorders-data.js"></script>

<div class="page-wrapper" id="">
	<div class="container-fluid">
          <div class="row">
    				<div class="row heading-bg bg-blue">
    					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    					  <h5 class="txt-light">Customer</h5>
    					</div>

    					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    					  <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
    							<li><a href="<?php echo base_url(); ?>admin/customers"><span> Customer </span></a></li>
    							<li class="active"><span>View </span></li>
    					  </ol>
    					</div>
    			</div>
    		</div>



				<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">View  only</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<?php foreach($res_profile as $rows_profile){} ?>
													<form class="form-horizontal" role="form">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Customer's Info</h6>
															<hr>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">First Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $rows_profile->first_name; ?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Last Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $rows_profile->last_name; ?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Gender:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $rows_profile->gender; ?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Date of Birth:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"> <?php echo $rows_profile->birth_date; ?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Status:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">  <?php echo $rows_profile->cus_status; ?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Newsletter:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">  <?php echo $rows_profile->newsletter_status; ?> </p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->



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
					<div class="row" id="">
						<div class="col-sm-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark"> List of address</h6>
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
															<th style="width:100px;">S.no</th>
															<th style="width:100px;">Name</th>
															<th>Phone number / Email</th>
															<th>landmark</th>
															<th>Address</th>

														</tr>
													</thead>
													<tbody>
														<?php  $i=1; foreach($res_address as $row_cus){   ?>
														<tr>
																<td><?php echo $i; ?></td>
															<td><?php echo $row_cus->full_name; ?></td>
															<td><?php echo $row_cus->mobile_number; ?><?php echo $row_cus->email_address; ?></td>
															<td><?php echo $row_cus->landmark; ?></td>
															<td><?php echo  $row_cus->house_no.','. $row_cus->street;  echo "<br>";echo  $row_cus->city.'-'. $row_cus->pincode; echo "<br>";echo  $row_cus->state; ?>


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
