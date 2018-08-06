<script src="<?php echo base_url(); ?>dist/js/productorders-data.js"></script>

<div class="page-wrapper">
	<div class="container-fluid">
          <div class="row">
    				<div class="row heading-bg bg-blue">
    					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    					  <h5 class="txt-light">Products Review</h5>
    					</div>

    					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    					  <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
    							<li><a href="<?php echo base_url(); ?>admin/products"><span> Products</span></a></li>
    							<li class="active"><span>Review </span></li>
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
									<h6 class="panel-title txt-dark">Product  Review</h6>
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
														<th>#</th>
														<th>Sus Name</th>
														<th>Rating</th>
														<th  style="width:300px;">comments</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php $i=1; foreach($res as $row_prod){  ?>
													<tr>
														<td><?php  echo $i; ?></td>
														<td><?php echo $row_prod->name; ?></td>
														<td><?php echo $row_prod->rating; ?></td>
														<td><?php echo $row_prod->comment; ?></td>

														<td>
															<?php if($row_prod->status=='Active'){ ?>
																<button class="label label-success font-weight-100" onclick="change_stat('<?php echo base64_encode($row_prod->id*9876); ?>','Inactive')">Active</button>
															<?php }else{ ?>
																	<button class="label label-danger font-weight-100"  onclick="change_stat('<?php echo base64_encode($row_prod->id*9876); ?>','Active')">Inactive</button>
															<?php } ?>

														</td>

													</tr>
												<?php  $i++; } ?>



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
function change_stat(rw_id,stat_id){

	var rw_id=rw_id;
	var stat_id=stat_id;
			swal({
    title: "Are you sure?",
    text: "You want to Change status",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yes, I am sure!',
    cancelButtonText: "No, cancel it!"
 }).then(
       function () {
				 $.ajax({
						 url: "<?php echo base_url(); ?>productmaster/change_status",
						 type: 'POST',
						data:{rw_id:rw_id,stat_id:stat_id},
						 success: function(response) {
						 //	alert(response);
						 if (response == "success") {
							 $.toast({
										 heading: 'Updated',
										 text: 'Status Updated Successfully',
										 position: 'top-right',
										 loaderBg:'#3cb878',
										icon: 'success',
										hideAfter: 3500,
										 stack: 6
									 });
									 $("#myTable").load(location.href+" #myTable>*","");
								 } else{
										 sweetAlert("Oops...", response, "error");
								 }
						 }
				 });
			 },
       function () { return false; });
}
</script>
