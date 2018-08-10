<style>
.form-control .error{
	border:1px solid red;
}
th{
	width:150px!important;
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
						<li><a href="">Dashboard</a></li>
						<li><a href="#"><span>Orders</span></a></li>
						<li class="active"><span>View order cart </span></li>
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
								<h6 class="panel-title txt-dark">Cart</h6>
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
													<th>Product  </th>
													<th>Quantity </th>
													<th>Amount</th>
													<th>Total Amount</th>

												</tr>
											</thead>

											<tbody>

												<?php $i=1; foreach($res_cart as $rows){ ?>

												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $rows->order_id; ?></td>
													<td><?php echo $rows->product_name; ?>
													<?php if(empty($rows->attribute_name)){}else{ ?>
															(<?php echo $rows->attribute_name.'-'.$rows->size; ?>)
													<?php	} ?>
													</td>
													<td><?php echo $rows->quantity; ?></td>
														<td><?php echo $rows->price; ?></td>
													<td><?php echo $rows->total_amount; ?></td>

												</tr>
						<?php	 $i++; }  ?>


											</tbody>
										</table>
										<?php if($rows->status!="Pending" && $rows->status!="Payment Error" && $rows->status!="Failure"){ ?>
												<a target="_blank" href="<?php echo base_url(); ?>admin/invoice/<?php echo base64_encode($rows->order_id); ?>" class="btn  btn-primary btn-outline">Print</a>
									<?php	} ?>

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
