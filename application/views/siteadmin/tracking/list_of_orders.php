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
					  <h5 class="txt-light">Orders</h5>
					</div>

					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
						<li><a href="<?php echo base_url(); ?>admin/tracking"><span>Orders</span></a></li>
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
								<h6 class="panel-title txt-dark">List  of Orders</h6>
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
													<th>Order id </th>
													<th>Purchase date </th>
													<th>Customer name </th>
													<th>Amount</th>
													<th>Payment Status</th>
													<th>View</th>
												</tr>
											</thead>

											<tbody>

												<?php $i=1; foreach($res_orders as $rows){ ?>

												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $rows->order_id; ?></td>
													<td><?php echo $rows->purchase_date; ?></td>
													<td><?php echo $rows->name; ?></td>
														<td><?php echo $rows->total_amount; ?></td>
														<td><?php if($rows->status=='Success'){ ?>
															<button class="label label-success font-weight-100">Success</button>
													<?php	}else if($rows->status=='Processing'){ ?>
													<button class="label label-warning font-weight-100">Processing</button>
													<?php	}else if($rows->status=='Shipped'){ ?>
														<button class="label label-primary font-weight-100">Shipped</button>
													<?php	}else if($rows->status=='Out for Delivery'){ ?>
														<button class="label label-info font-weight-100">Out for Delivery</button>
													<?php	}else if($rows->status=='Out for Delivery'){ ?>
														<button class="label label-danger font-weight-100">Payment Error</button>
													<?php	}else{ ?>
														<button class="label label-default font-weight-100"><?php echo $rows->status; ?></button>
													<?php	} ?>
												</td>
													<td><a href="<?php echo base_url(); ?>admin/check_orders/<?php  echo base64_encode($rows->order_id); ?>" data-toggle="tooltip" title="view items" ><i class="ti-align-justify"></i></a>

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
