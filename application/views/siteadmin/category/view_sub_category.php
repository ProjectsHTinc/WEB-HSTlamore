<div class="page-wrapper">
	<div class="container-fluid">
          <div class="row">
    				<div class="row heading-bg bg-blue">
    					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    					  <h5 class="txt-light">category</h5>
    					</div>

    					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    					  <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>adminlogin/home">Dashboard</a></li>
    							<li><a href="<?php echo base_url(); ?>category/"><span> Category</span></a></li>
    							<li><a href=""><span>Sub Category</span></a></li>
    						<li class="active"><span>View </span></li>
    					  </ol>
    					</div>
    			</div>
    		</div>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">List  of Sub Categories</h6>
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
                      <th>Category Title</th>
                      <th>Cover img</th>
                      <th>Thumb img</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S.no</th>
                      <th>Category Title</th>
                      <th>Cover img</th>
                      <th>Thumb img</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php $i=1; foreach($res as $rows){ ?>

                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $rows->category_name; ?></td>
                      <td><?php if(empty($rows->category_image)){ ?>

                        <?php 	}else{ ?>
                              <img src="<?php echo base_url(); ?>assets/category/<?php  echo $rows->category_image; ?>" style="width:100px;">
                            <?php	} ?>
                            </td>

                      <td><?php if(empty($rows->category_thumbnail)){ ?>

                    <?php 	}else{ ?>
                            <img src="<?php echo base_url(); ?>assets/category/thumbnail/<?php  echo $rows->category_thumbnail; ?>" style="width:100px;">
                      <?php	} ?>

                        </td>
                      <td><?php if($rows->status=='Active'){ ?>
                        <button class="btn  btn-success btn-rounded">Active</button>
                      <?php }else{ ?>
                        <button class="btn  btn-danger btn-rounded">Inactive</button>
                    <?php 	} ?></td>
                      <td><a href="<?php echo base_url(); ?>category/edit_sub_cat/<?php  echo base64_encode($rows->id*9876); ?>"><i class="ti-pencil-alt"></i></a>

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

  </div>
</div>
<script>

</script>
