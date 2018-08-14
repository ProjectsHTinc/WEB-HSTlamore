<style>
.form-control .error{
	border:1px solid red;
}
th{
	width:150px!important;
}
@media print {
  body * {
    visibility: hidden;
  }
  #invoice, #invoice * {
    visibility: visible;
  }
  #invoice {
    position: absolute;
    left: 0;
    top: 0;
  }
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
						<li class="active"><span>View order cart </span></li>
					  </ol>
					</div>
			</div>
		</div>
		<div class="pull-right">
			<button type="button" class="btn btn-success  btn-icon left-icon" onclick="javascript:window.print();">
				<i class="fa fa-print"></i><span>Print</span>
			</button>
		</div>

<?php foreach($res_cart as $rows_details){} ?>
		<div class="row">

								<div class="col-md-12" id="invoice">
									<div class="panel panel-default card-view">
										<div class="panel-heading">
											<div class="pull-left">
												<h6 class="panel-title txt-dark">Invoice</h6>
											</div>
											<div class="pull-right">
												<h6 class="txt-dark">Order id # <?php echo $rows_details->order_id; ?></h6>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="panel-wrapper collapse in">
											<div class="panel-body">
												<div class="row">
													<div class="col-xs-6">
														<span class="txt-dark head-font inline-block capitalize-font mb-5">Billed from:</span>
														<address class="mb-15">
															<span class="address-head mb-5">Lila more.</span>
														Coimbatore <br>
														India <br>
															<abbr title="Phone">P:</abbr>1234567
														</address>
														<address>
															<span class="txt-dark head-font capitalize-font mb-5">Order date:</span><br>
															<?php echo  date("d-M-y"); ?><br><br>
														</address>
													</div>
													<div class="col-xs-6 text-right">
														<span class="txt-dark head-font inline-block capitalize-font mb-5">Delivery Address:</span>
														<address class="mb-15">
															<span class="address-head mb-5"><?php echo $rows_details->full_name; ?></span>
															<?php echo $rows_details->house_no.','.$rows_details->street; ?> <br>
															<?php echo $rows_details->city.'-'.$rows_details->pincode; ?> <br>
															<?php echo $rows_details->state; ?> <br><br>
															<abbr>Landmark : </abbr>	<?php echo $rows_details->landmark; ?>	</address>

															<abbr>Phone : </abbr>	<?php echo $rows_details->mobile_number; ?>
														</address><br>
														<abbr >Email : </abbr>	<?php echo $rows_details->email_address; ?>
													</address>
													</div>
												</div>

												<div class="row">
													<div class="col-xs-6">
													</div>
													<div class="col-xs-6 text-right">

													</div>
												</div>

												<div class="seprator-block"></div>

												<div class="invoice-bill-table">
													<div class="table-responsive">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th style="width:200px;">Item</th>
																	<th>Price</th>
																	<th>Quantity</th>
																	<th>Totals</th>
																</tr>
															</thead>
															<tbody>
																	<?php $i=1; foreach($res_cart as $rows){ ?>
																<tr>
																	<td><?php echo $rows->product_name; ?>
																	<?php if(empty($rows->attribute_name)){}else{ ?>
																			(<?php echo $rows->attribute_name.'-'.$rows->size; ?>)
																	<?php	} ?></td>
																	<td><?php echo $rows->price; ?></td>
																	<td><?php echo $rows->quantity; ?></td>
																	<td class="sum"><?php echo $rows->total_amount; ?></td>
																</tr>
															<?php	 $i++; }  ?>



																<tr class="txt-dark">
																	<td></td>
																	<td></td>
																	<td>Total</td>
																	<td class="result"></td>
																</tr>
															</tbody>
														</table>
													</div>

													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>



	</div>
</div>
<script>

$(document).ready(function(){
     colSum();
});

function colSum() {
    var sum=0;
    //iterate through each input and add to sum
    $('.sum').each(function() {
            sum += parseInt($(this).text());
    });
    //change value of total
    $('.result').html(sum+".00");
}
</script>
