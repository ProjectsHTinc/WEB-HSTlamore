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
													<th>Action</th>
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
													<td>
														<a href="<?php echo base_url(); ?>admin/check_orders/<?php  echo base64_encode($rows->order_id); ?>" data-toggle="tooltip" title="view items & Invoice" ><i class="ti-align-justify"></i></a> &nbsp;&nbsp;
														<a data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" title="Update status" data-id="<?php echo $rows->order_id; ?>" data-order-status="<?php echo $rows->status; ?>"><i class="fa fa-edit"></i></a>

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

			<div class="modal fade open-AddBookDialog" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h5 class="modal-title" id="exampleModalLabel1">Update status</h5>
													</div>
														<form action="#" method="post" id="order_form" name="order_form" enctype="multipart/form-data">
													<div class="modal-body">

															<div class="form-group">
																<label for="message-text" class="control-label mb-10">Current status</label>
																<input type="text" class="form-control" id="current_order_status" name="current_order_status" value="" readonly>
															</div>
															<div class="form-group">
																<label for="recipient-name" class="control-label mb-10">Change status</label>
																<select class="form-control" id="order_status" name="order_status" >
																	<option value="">--Select--</option>
																	<option value="Processing">Processing</option>

																	<option value="Shipped">Shipped</option>
																	<option value="Out for Delivery">Out for Delivery</option>
																	<option value="Payment Error">Payment Error</option>
																</select>
																	<script> </script>
																<input type="hidden" id="order_id" name="order_id" value="">

															</div>
															<div class="form-group">
																<label for="message-text" class="control-label mb-10">This message will sent to Customer:</label>
																<textarea class="form-control" id="msg_to_customer" rows="6" name="msg_to_customer"></textarea>
															</div>

													</div>
													<div class="modal-footer">

														<button type="submit" class="btn btn-primary">Update Status</button>
													</div>
														</form>
												</div>
											</div>
										</div>



	</div>
</div>
<script>

$('#order_status').change(function(){
	var status_name=$(this).val();
		$('#msg_to_customer').val("");
	$.ajax({
		 url: "<?php echo base_url(); ?>tracking/get_status_msg",
		 type: 'POST',
		 data:{status_name:status_name},
		 dataType: "JSON",
		 cache: false,
		 success: function(response){

				$('#msg_to_customer').val(response[0].msg);

			}
	});
});
$('#exampleModal').on('show.bs.modal', function(e) {
		 	var bookId = $(e.relatedTarget).data('id');
    	$(e.currentTarget).find('input[name="order_id"]').val(bookId);
			var order_status = $(e.relatedTarget).data('order-status');
			$(e.currentTarget).find('input[name="order_status"]').val(order_status);
			var order_status = $(e.relatedTarget).data('order-status');
			$(e.currentTarget).find('input[name="current_order_status"]').val(order_status);
		//	$('#order_status').val(order_status);
});
jQuery.validator.addMethod("notEqual", function(value, element, param) {
 return this.optional(element) || value != $(param).val();
}, "This is the current status");

$("#order_form").validate({
	ignore: ":hidden",
rules: {
		order_status:{required:true,notEqual: "#current_order_status" },
		msg_to_customer:{required:true}

},
	messages: {
		order_status:{required:"Select status"},
		msg_to_customer:{required:"Enter Message"}
	},
submitHandler: function (form) {
	swal('Please wait')
	swal.showLoading();
	$.ajax({
			url: "<?php echo base_url(); ?>tracking/get_update_status",
			type: 'POST',
			data: $('#order_form').serialize(),
			success: function(response) {
				if (response == "success") {
					swal('Please wait')
					swal.showLoading();
					window.setTimeout(function () {
					 location.href = "<?php echo base_url(); ?>admin/tracking";
			 }, 2000);
				}else{
						sweetAlert("Oops...", response, "error");
				}
			}
	});
}
});


</script>
