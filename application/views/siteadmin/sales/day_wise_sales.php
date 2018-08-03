<script src="<?php echo base_url(); ?>dist/js/productorders-data.js"></script>
<style>
.result{
	font-size: 18px;
	margin-right: 100px;
}
</style>
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
					<!-- Table Hover -->
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Day Wise Sales Report</h6>
								</div>
								<div class="pull-right">
									<h6 class="panel-title txt-dark">Total Amount : <span class="result"></span></h6>
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
												<th style="width:200px;">Customer Name</th>
												<th>Purchase date</th>
												<th>Order id</th>
												<th>Total</th>
												<th>Check orders</th>

												</tr>
											</thead>
											<tbody>
												<?php $i=1; foreach($res_day_wise as $row_val){ ?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $row_val->name; ?></td>
														<td><?php echo $row_val->purchase_date; ?></td>
														<td><?php echo $row_val->order_id; ?></td>
														<td class="sum"><?php echo $row_val->total_amount; ?></td>
														<td>
														<a target="_blank" href="<?php echo base_url(); ?>admin/check_orders/<?php  echo base64_encode($row_val->order_id); ?>" data-toggle="tooltip" title="view items" ><i class="ti-align-justify"></i></a>
														</td>
													</tr>

											<?php $i++;	} ?>
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
