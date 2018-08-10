
        <!-- /Right Sidebar Menu -->

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid">

                <!-- Title -->
                <div class="row heading-bg  bg-red">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-light">Dashboard</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="">Home</a></li>
                            <li class="active"><a href="#"><span>dashboard</span></a></li>

                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 ">
                      <div class="panel panel-default card-view pa-0">
          							<div class="panel-wrapper collapse in">
          								<div class="panel-body pa-0">
          									<div class="sm-data-box bg-yellow">
          										<div class="row ma-0">
          											<div class="col-xs-5 text-center pa-0 icon-wrap-left">
          												<i class="icon-rocket txt-light"></i>
          											</div>
          											<div class="col-xs-7 text-center data-wrap-right">
          												<h6 class="txt-light">Total Products</h6>
          												<span class="txt-light counter"><?php foreach($res_count_product as $rows_pro_count){}  echo $rows_pro_count->count_product; ?></span>
          											</div>
          										</div>
          									</div>
          								</div>
          							</div>
          						</div>
                      <div class="panel panel-default card-view pa-0">
          							<div class="panel-wrapper collapse in">
          								<div class="panel-body pa-0">
          									<div class="sm-data-box bg-red">
          										<div class="row ma-0">
          											<div class="col-xs-5 text-center pa-0 icon-wrap-left">
          												<i class="icon-briefcase txt-light"></i>
          											</div>
          											<div class="col-xs-7 text-center data-wrap-right">
          												<h6 class="txt-light">Total Customers</h6>
          												<span class="txt-light counter counter-anim"><?php foreach($res_count_cust as $rows_cus_count){}  echo $rows_cus_count->count_cust; ?></span>
          											</div>
          										</div>
          									</div>
          								</div>
          							</div>
          						</div>

                      
                        <!-- <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">downloads</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="sm-graph-box">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div id="sparkline_6"></div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="counter-wrap text-right">
                                                    <span class="counter-cap"><i class="fa  fa-level-down txt-danger"></i></span><span class="counter">1122</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                      <div class="panel panel-default card-view">
                          <div class="panel-heading">
                              <div class="pull-left">
                                  <h6 class="panel-title txt-dark">Recent orders</h6>
                              </div>
                              <div class="pull-right">
                                  <h6 class="panel-title"><a href="">View all orders</a></h6>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                          <div class="panel-wrapper collapse in">
                              <div class="panel-body">
                                  <div class="table-wrap">
                                      <div class="table-responsive">
                                          <table class="table display product-overview" id="statement">
                                              <thead>
                                                  <tr>
                                                      <th>date</th>
                                                      <th>Order ID</th>
                                                      <th>Payment</th>
                                                      <th>Cus name</th>
                                                      <th>price</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                <?php foreach($res_recent_orders as $res_prod){ ?>
                                                  <tr>
                                                      <td><?php echo $newDate = date("d-m-Y H:i:s", strtotime($res_prod->purchase_date));  ?></td>
                                                      <td><?php echo $res_prod->order_id; ?></td>
                                                      <td>
                                                          <span class="label label-primary font-weight-100"><?php echo $res_prod->status; ?></span>
                                                      </td>
                                                      <td>
                                                        <?php echo $res_prod->name; ?>
                                                      </td>
                                                      <td><?php echo $res_prod->total_amount; ?></td>
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


        <div class="row">
					<!-- Table Hover -->
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Stocks Left</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
										  <table class="table table-hover mb-0" id="datable_1">
											<thead>
											  <tr>
												<th>#</th>
												<th style="width:400px;">Products</th>
                        <th>Offer / Combined</th>
												<th>Total</th>
												<th>Stocks Left</th>
											  </tr>
											</thead>
											<tbody>
                        <?php $i=1; foreach($res_prod_stocks as $rows_prod_stocks){  ?>
                          <tr>
  												<td><?php echo $i; ?></td>
  												<td><?php echo $rows_prod_stocks->product_name; ?></td>
                          	<td><?php if($rows_prod_stocks->offer_status=='1'){ ?>
                            <span class="badge  badge-danger">offer</span>
                          <?php  }
                          if($rows_prod_stocks->combined_status=='1'){ ?>
                          <span class="badge badge-info">Combined</span>
                        <?php  } ?></td>
  												<td><?php echo $rows_prod_stocks->total_stocks; ?></td>
  												<td><span class="text-danger text-semibold"> <?php echo $rows_prod_stocks->stocks_left; ?></span> </td>
  											  </tr>
                      <?php  $i++;  } ?>




											</tbody>
										  </table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Table Hover -->

				</div>


            </div>
            <!-- Footer -->
<script>
$('#dashboard').addClass("active");
</script>
