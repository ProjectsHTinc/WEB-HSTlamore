<script src="<?php echo base_url(); ?>dist/js/productorders-data.js"></script>

<div class="page-wrapper">
	<div class="container-fluid">
          <div class="row">
    				<div class="row heading-bg bg-blue">
    					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    					  <h5 class="txt-light">Sales</h5>
    					</div>

    					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    					  <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
    							<li><a href="<?php echo base_url(); ?>admin/sales"><span> Sales</span></a></li>
    							<li class="active"><span>Report </span></li>
    					  </ol>
    					</div>
    			</div>
    		</div>

				<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Day wise sales</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
														<form action="<?php echo base_url(); ?>admin/day_wise_sales" method="post" enctype="multipart/form-data" id="day_wise_report" name="day_wise_report">
														<div class="form-group">
																<label class="control-label mb-10 text-left">Pick Date</label>
																<div class='input-group date' id='datetimepicker1'>
																	<input type='text' class="form-control" name="day_name" required/>
																	<span class="input-group-addon">
																		<span class="fa fa-calendar"></span>
																	</span>
																</div>
															</div>

														<button type="submit" class="btn btn-success mr-10">Submit</button>

													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Month wise sales</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form action="<?php echo base_url(); ?>admin/month_wise_sales" method="post" enctype="multipart/form-data" id="month_wise_form" name="month_wise_form">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_2">Month</label>
															<select class="form-control" name="month_id"  required>
                                     <option value=''>--Select Month--</option>
                                        <option  value='1'>Janaury</option>
                                        <option value='2'>February</option>
                                        <option value='3'>March</option>
                                        <option value='4'>April</option>
                                        <option value='5'>May</option>
                                        <option value='6'>June</option>
                                        <option value='7'>July</option>
                                        <option value='8'>August</option>
                                        <option value='9'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                   </select>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_2">Year</label>
															<select class="form-control" name="year_id" required>
                                    <option value=''>--Select Year--</option>
                                       <option  value='2018'>2018</option>
                                        <option  value='2019'>2019</option>
                                        <option  value='2020'>2020</option>
																				<option  value='2021'>2021</option>
																				<option  value='2022'>2022</option>
                                  </select>
														</div>


														<div class="form-group mb-0">
															<button type="submit" class="btn btn-success  mr-10">Submit</button>

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


<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
$('#datetimepicker1').datetimepicker({
	format: 'DD-MM-YYYY'
});
</script>
